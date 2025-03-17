<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ValidationHelper;
use App\Helpers\ImageHelper;
use App\Helpers\ItemHelper;
use App\Helpers\LocationHelper;
use Illuminate\Validation\ValidationException;
use App\Notifications\ClientDocumentNotification;
use Exception;
use App\Helpers\ActivityLogger;
use App\Models\ActivityLog;;
use App\Models\User;
use App\Models\Order;
use App\Models\Complain;
use App\Models\Food;
use DB;


class ClientProfileController extends Controller
{
    public function ProfilePage()
    { 
        return view('client.pages.profile.profile-page');
    }

    public function Profile(Request $request)
    {
        try {
            $email = $request->header('email');

            if (!$email) {
                ActivityLogger::log('profile_accessed_failed', 'Unauthorized request: Missing email in request', $request, 'users');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Email header is missing'
                ], 400);
            }

            $user = User::where('email', $email)->first();

            if ($user) {
                $unreadNotifications = $user->unreadNotifications;
                $readNotifications = $user->readNotifications;

                ActivityLogger::log('profile_accessed_success', 'Profile accessed successfully for email: ' . $email, $request, 'users');
                return response()->json([
                    'status' => 'success',
                    'message' => 'Request Successful',
                    'data' => $user,
                    'unreadNotifications' => $unreadNotifications,
                    'readNotifications' => $readNotifications,
                ], 200);
            } else {
                ActivityLogger::log('profile_accessed_failed', 'User not found with email: ' . $email, $request, 'users');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Client not found'
                ], 404);
            }


        } catch (Exception $e) {
            ActivityLogger::log('profile_accessed_failed', 'Error occurred while accessing profile: ' . $e->getMessage(), $request, 'users');
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function updateProfile(Request $request)
    {
        try {
            $id = $request->header('id');
            $request->validate(ValidationHelper::profileValidationRules());
            $user = User::findOrFail($id);

            $imagePath = $request->hasFile('image') 
            ? ImageHelper::processAndSaveProfileImage(
                $request->file('image'),
                config('image.profile')[$user->role],
                $user->image
            )
            : $user->image;

            $profileData = ItemHelper::prepareProfileData($request, $imagePath);
            ItemHelper::storeOrUpdateProfile($profileData, $user);

            ActivityLogger::log('profile_update_success', 'Profile updated successfully for user ID: ' . $id, $request, 'users');
            return response()->json([
                'status' => 'success',
                'message' => 'Profile updated successfully.',
            ], 200);
        } catch (ValidationException $e) {
            ActivityLogger::log('profile_update_failed', 'Validation errors occurred: ' . json_encode($e->errors()), $request, 'users');
            return response()->json([
                'status' => 'fail',
                'message' => 'Validation errors.',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            ActivityLogger::log('profile_update_failed', 'An error occurred while updating profile: ' . $e->getMessage(), $request, 'users');
            return response()->json([
                'status' => 'fail',
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function oldUpdateProfile(Request $request)
    {
        try{
            $request->validate([
                'firstName' => 'required|string|min:3|max:50',
                'lastName' => 'required|string|min:3|max:50',
                'mobile' => 'required|string|min:11|max:50',
                'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $email = $request->header('email');
            $id = $request->header('id');

            $user = User::find($id);
            if (!$user) {
                ActivityLogger::log('Profile Update Failed','User not found',$id,'client','users');
                return response()->json([
                    'status' => 'fail',
                    'message' => 'User not found'
                ], 404);
            }

            $firstName = $request->input('firstName');
            $lastName = $request->input('lastName');
            $mobile = $request->input('mobile');

            if ($request->hasFile('image')) {
                $large_image_path = base_path('public/upload/client-profile/large/');
                $medium_image_path = base_path('public/upload/client-profile/medium/');
                $small_image_path = base_path('public/upload/client-profile/small/');

                if (!empty($user->image)) {
                    foreach (['large', 'medium', 'small'] as $size) {
                        $path = base_path("public/upload/client-profile/{$size}/" . $user->image);
                        if (file_exists($path)) {
                            unlink($path);
                        }
                    }
                }

                $image = $request->file('image');
                $manager = new ImageManager(new Driver());
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $img = $manager->read($image);

                $img->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize(); 
                })
                ->save($large_image_path . $imageName);

                $img->resize(80, 80, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save($medium_image_path . $imageName);

                $img->resize(60, 60, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save($small_image_path . $imageName);

                $user->image = $imageName;
            }

            $user->update([
                'firstName'=>$firstName,
                'lastName'=>$lastName,
                'mobile'=>$mobile,
            ]);

            ActivityLogger::log('Profile Update Success','Profile updated successfully',$id,'client','users');
            return response()->json([
                'status' => 'success',
                'message' => 'Request Successful',
            ],200);

        }catch (ValidationException $e) {
            ActivityLogger::log('Profile Update Failed','Validation errors while updating profile',$id,'client','users');
            return response()->json([
                'status' => 'fail',
                'message' => 'Validation errors',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            ActivityLogger::log('Profile Update Failed','Error occurred while updating profile' . ': ' . $e->getMessage(),$id,'client','users');
            return response()->json([
                'status' => 'fail',
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }


    public function PasswordPage()
    {
        return view('client.pages.profile.password-change-page');
    }


    public function UpdatePassword(Request $request)
    {
        try {
            $request->validate([
                'oldpassword' => 'required|string|min:6',
                'newpassword' => 'required|string|min:6|confirmed', 
            ]);

            $email = $request->header('email');
            $user = User::where('email', $email)->first();

            if (!$user) {
                ActivityLogger::log(
                    'password_update_failed',
                    'User not found with email: ' . $email,
                    $request,
                    'users'
                );
                return response()->json([
                    'status' => 'fail',
                    'message' => 'User not found'
                ], 404);
            }

            $oldPassword = $request->input('oldpassword');
            $hashedPassword = $user->password;

            if (Hash::check($oldPassword, $hashedPassword)) {
                $newPassword = Hash::make($request->input('newpassword'));
                $user->password = $newPassword;
                $user->save();

                ActivityLogger::log(
                    'password_update_success',
                    'Password updated successfully',
                    $request,
                    'users'
                );
                return response()->json([
                    'status' => 'success',
                    'message' => 'Password updated successfully'
                ], 200);
            } else {
                ActivityLogger::log(
                    'password_update_failed',
                    'Incorrect old password provided',
                    $request,
                    'users'
                );
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Old password is incorrect'
                ], 400);
            }
        } catch (ValidationException $e) {
            ActivityLogger::log(
                'password_update_failed',
                'Validation error: ' . json_encode($e->errors()),
                $request,
                'users'
            );
            return response()->json([
                'status' => 'fail',
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            ActivityLogger::log(
                'password_update_failed',
                'Unexpected error occurred: ' . $e->getMessage(),
                $request,
                'users'
            );
            return response()->json([
                'status' => 'fail',
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }


    public function ClientDetailsPage(Request $request)
    {
        $email = $request->header('email');
        $user = User::where('email', $email)->first();

        $notification_id = $request->query('notification_id');
        if ($notification_id) {
            $notification = $user->notifications()->where('id', $notification_id)->first();

            if ($notification && is_null($notification->read_at)) {
                $notification->markAsRead();
            }
        }

        return view('client.pages.profile.client-details');
    }


    public function ClientDetailsInfo($client_id)
    {
        try {
            $client = User::where('id', $client_id)
            ->where('role', 'client')
            ->withCount(['foods' => function ($query) {
                $query->where('status', '!=', 'pending');
            }])
            ->withCount(['ordersBasedOnRole as total_orders'])
            ->withCount(['foods as total_complaints' => function ($query) {
                $query->whereHas('order.complain');
            }])
            ->withCount(['ordersBasedOnRole as total_customers' => function ($query) {
                $query->select(DB::raw('count(distinct user_id)'));
            }]) 
            ->first();

            if (!$client) { 
                ActivityLogger::log(
                    'view_client_details_failed',
                    'No client found with the provided ID.',
                    $request,
                    'users'
                );
                return response()->json([
                    'status' => 'failed',
                    'message' => 'No client found with this ID',
                ], 404);
            }

            ActivityLogger::log(
                'view_client_details_success',
                'Client details successfully retrieved.',
                $request,
                'users'
            );
            return response()->json([
                'status' => 'success',
                'data' => $client
            ], 200);

        } catch (Exception $e) {
            ActivityLogger::log(
                'view_client_details_failed',
                'An error occurred while retrieving client details: ' . $e->getMessage(),
                $request,
                'users'
            );
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while retrieving the customer',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function DocumentPage()
    {
        return view('client.pages.profile.client-document-page');
    }


    public function storeDocumentInfo(Request $request)
    {
        try {
            $request->validate(ValidationHelper::documentValidationRules());
            $id = $request->header('id');
            $user = User::find($id);

            if (!$user) {
                ActivityLogger::log('Client Document Submission Failed', 'Client not found', $id, 'user', 'users');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'User not found.',
                ], 404);
            }

            $geoData = $this->formatAndFetchCoordinates($request);

            if (!$geoData) {
                ActivityLogger::log('document_upload_failed', 'Unable to fetch coordinates for address', $request, 'users');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Unable to fetch coordinates for the provided address.',
                ], 400);
            }

            $oldDocImage1 = $user->doc_image1;
            $oldDocImage2 = $user->doc_image2;

            $docImage1 = $request->hasFile('doc_image1')
            ? ImageHelper::processAndSaveDocumentImage($request->file('doc_image1'), 'client', 'document', $oldDocImage1, 'doc1')
            : $oldDocImage1;

            $docImage2 = $request->hasFile('doc_image2')
            ? ImageHelper::processAndSaveDocumentImage($request->file('doc_image2'), 'client', 'document', $oldDocImage2, 'doc2')
            : $oldDocImage2;

            $docData = ItemHelper::prepareDocumentData($request, $geoData, $docImage1, $docImage2);
            $client = ItemHelper::storeOrUpdateDocument($id, $docData);

            if ($client) {
                $admin = User::where('role', 'admin')->first();
                $admin->notify(new ClientDocumentNotification($client));

                ActivityLogger::log('document_upload_success', 'Customer documents uploaded successfully', $request, 'users');
                return response()->json([
                    'status' => 'success',
                    'message' => 'Document information saved successfully.',
                ], 200);
            }
        } catch (ValidationException $e) {
            ActivityLogger::log('document_upload_failed', 'Validation failed: ' . json_encode($e->errors()), $request, 'users');
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            ActivityLogger::log('document_upload_failed', 'Unexpected error: ' . $e->getMessage(), $request, 'users');
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while saving document information.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    private function formatAndFetchCoordinates(Request $request)
    {
        $formattedAddress = LocationHelper::formatAddress($request);
        $geoData = LocationHelper::getCoordinatesFromAddress($formattedAddress);

        if (!$geoData) {
            throw new Exception('Unable to fetch coordinates for the provided address.');
        }

        return $geoData;
    }

    public function oldStoreDocumentInfo(Request $request)
    {
        try {
            $request->validate([
                'firstName' => 'required|string|max:50',
                'lastName' => 'required|string|max:50',
                'mobile' => 'required|string|min:11|max:50',

                'address1' => 'required|string|min:3|max:50',
                'zip_code' => 'required|string|min:3|max:50',
                'country_id' => 'required|integer|exists:countries,id',
                'county_id' => 'required|integer|exists:counties,id',
                'city_id' => 'required|integer|exists:cities,id',

                'doc_image1' => 'required|image|mimes:jpeg,png,jpg,pdf|max:2048',
                'doc_image2' => 'required|image|mimes:jpeg,png,jpg,pdf|max:2048',
            ]);


            $id = $request->header('id');
            $user = User::find($id);


            $address1 = $request->input('address1');
            $address2 = $request->input('address2');
            $zip_code = $request->input('zip_code');
            $countryId = $request->input('country_id');
            $countyId = $request->input('county_id');
            $cityId = $request->input('city_id');

            $country = Country::find($countryId)->name ?? '';
            $county = County::find($countyId)->name ?? '';
            $city = City::find($cityId)->name ?? '';

            if (!$country || !$county || !$city) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Invalid country, county, or city ID provided.',
                ], 400);
            }

            $getAddress = $address1 . ', ' . $address2 . ', ' . $zip_code . ', ' . $country . ', ' . $county . ', ' . $city;

            $geoData = $this->getCoordinatesFromAddress($getAddress);

            if (!$geoData) {
                ActivityLogger::log('Client Document Submission Failed','Unable to fetch coordinates for address',$user->id,'client','users');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Unable to fetch coordinates for the provided address.',
                ], 400);
            }

            $latitude = $geoData['latitude'];
            $longitude = $geoData['longitude'];

            if ($request->hasFile('doc_image1')) {
                $large_image_path = base_path('public/upload/client-document/large/');
                $medium_image_path = base_path('public/upload/client-document/medium/');
                $small_image_path = base_path('public/upload/client-document/small/');

                if (!empty($user->doc_image1)) {
                    foreach (['large', 'medium', 'small'] as $size) {
                        $path = base_path("public/upload/client-document/{$size}/" . $user->doc_image1);
                        if (file_exists($path)) {
                            unlink($path);
                        }
                    }
                }

                $image = $request->file('doc_image1');
                $manager = new ImageManager(new Driver());
                $imageName = time() . '_doc1.' . $image->getClientOriginalExtension();
                $img = $manager->read($image);

                $img->resize(1200, 1500, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize(); 
                })
                ->save($large_image_path . $imageName);

                $img->resize(800, 1000, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save($medium_image_path . $imageName);

                $img->resize(200, 200, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save($small_image_path . $imageName);

                $uploadPath1 = $imageName;
            } else {
                $uploadPath1 = null;
            }

            if ($request->hasFile('doc_image2')) {
                $large_image_path = base_path('public/upload/client-document/large/');
                $medium_image_path = base_path('public/upload/client-document/medium/');
                $small_image_path = base_path('public/upload/client-document/small/');

                if (!empty($user->doc_image2)) {
                    foreach (['large', 'medium', 'small'] as $size) {
                        $path = base_path("public/upload/client-document/{$size}/" . $user->doc_image2);
                        if (file_exists($path)) {
                            unlink($path);
                        }
                    }
                }

                $image = $request->file('doc_image2');
                $manager = new ImageManager(new Driver());
                $imageName = time() . '_doc2.' . $image->getClientOriginalExtension();
                $img = $manager->read($image);

                $img->resize(1200, 1500, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize(); 
                })
                ->save($large_image_path . $imageName);

                $img->resize(800, 1000, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save($medium_image_path . $imageName);

                $img->resize(200, 200, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save($small_image_path . $imageName);

                $uploadPath2 = $imageName;
            } else {
                $uploadPath2 = null;
            }


            $client = User::updateOrCreate(
                ['id' => $id], 
                [
                    'firstName' => $request->input('firstName'),
                    'lastName' => $request->input('lastName'),
                    'mobile' => $request->input('mobile'),
                    'address1' => $request->input('address1'),
                    'address2' => $request->input('address2'),
                    'zip_code' => $request->input('zip_code'),
                    'country_id' => $request->input('country_id'),
                    'county_id' => $request->input('county_id'),
                    'city_id' => $request->input('city_id'),
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'doc_image1' => $uploadPath1,
                    'doc_image2' => $uploadPath2
                ]
            );

            if ($client) {
                $admin = User::where('role', 'admin')->first();
                $admin->notify(new ClientDocumentNotification($client));

                ActivityLogger::log('Client Document Submission Success','Client document submitted successfully',$client->id,'client','users');
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Your document submitted successful. We will notify you via email once your documet has been approved.'
            ], 201);

        } catch (ValidationException $e) {
            ActivityLogger::log('Client Document Submission Failed','Validation error',null,'client','users');
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Failed',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            ActivityLogger::log('Client Document Submission Failed','Unexpected error - ' . $e->getMessage(),$customer->id,'client','users');
            return response()->json([
                'status' => 'failed',
                'message' => 'Registration failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
