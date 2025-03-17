<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Notifications\ReviewFoodComplainNotification;
use App\Notifications\FoodComplainNotification;
use App\Notifications\SolvedComplainNotification;
use App\Notifications\ComplainInvestigationNotification;
use Exception;
use App\Helpers\ActivityLogger;
use App\Models\ActivityLog;
use App\Models\ComplainConversation;
use App\Models\Complain;
use App\Models\User;
use Carbon\Carbon;

class AdminComplainController extends Controller
{
    public function ComplainPage()
    {
        return view('backend.pages.complain.complain-list');
    }


    public function ComplainList(Request $request)
    {
        try {
            $complains = Complain::with(['order', 'food.user', 'user'])->latest()->get();

            ActivityLogger::log('retrieve_complaint_success', 'Complaints retrieved successfully .', $request, 'complains');
            return response()->json([
                'status' => 'success',
                'data' => $complains
            ], 200); 

        } catch (Exception $e) {
            ActivityLogger::log('retrieve_complaint_failed', 'An error occurred while retrieving complaints: ' . $e->getMessage(), $request, 'complains');
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while retrieving complaints',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function ComplainDetailsPage(Request $request)
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

        return view('backend.pages.complain.complain-details');
    }


    public function ComplainDetails($complain_id)
    {
        try {
            $complains = Complain::with(['order', 'food', 'food.user', 'food.foodImages', 'user', 'conversations'])
            ->where('id', $complain_id)
            ->first();

            if (!$complains) {
                ActivityLogger::log('access_complaint_details_failed', 'Complain details not found.', $request, 'complains');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Complain information not found'
                ], 404);
            }

            ActivityLogger::log('access_complaint_details_success', 'Complain details accessed successfully.', $request, 'complains');

            return response()->json([
                'status' => 'success',
                'data' => $complains
            ], 200);

        } catch (Exception $e) {
            ActivityLogger::log('access_complaint_details_failed', 'An error occurred while retrieving complain details: ' . $e->getMessage(), $request, 'complains');
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while retrieving complain information',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function ComplainSendToClient($complain_id)
    {
        try {
            $complain = Complain::with(['order', 'food', 'food.user', 'food.foodImages', 'user'])->findOrFail($complain_id);

            if ($complain->status === 'pending') {
                $currentDateTime = Carbon::now();
                $clnt_cmp_date = $currentDateTime->format('d F Y');
                $clnt_cmp_time = $currentDateTime->format('h:i:s A');

                $result = $complain->update([
                    'status' => 'under-review',
                    'clnt_cmp_date' => $clnt_cmp_date, 
                    'clnt_cmp_time' => $clnt_cmp_time, 
                ]);

                $customer = $complain->user;             
                $client = $complain->food->user;        

                if ($customer->role === 'user') {
                    $customer->notify(new ReviewFoodComplainNotification($complain)); 
                }

                if ($client->role === 'client') {
                    $client->notify(new FoodComplainNotification($complain)); 
                }

                ActivityLogger::log(
                    'complaint_status_success',
                    'Complain forwarded successfully to client.',
                    $request,
                    'complains'
                );

                return response()->json([
                    'status' => 'success',
                    'message' => 'Complain sent successfully to client.'
                ], 200);
            } else {
                ActivityLogger::log(
                    'complaint_status_failed',
                    'Complain is not in pending status.',
                    $request,
                    'complains'
                );
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Complain is not in pending status.'
                ], 400);
            }
        } catch (ModelNotFoundException $e) {
            ActivityLogger::log(
                'complaint_status_failed',
                'Complain not found: ' . $e->getMessage(),
                $request,
                'complains'
            );
            return response()->json([
                'status' => 'failed',
                'message' => 'Complain not found',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            ActivityLogger::log(
                'complaint_status_failed',
                'An error occurred while sending complain to client: ' . $e->getMessage(),
                $request,
                'complains'
            );
            return response()->json([
                'status' => 'failed',
                'message' => 'Status update failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function uploadEditorImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(100, 100)->save(public_path('upload/complain_images/admin/' . $imageName));
            $url = asset('/upload/complain_images/admin/' . $imageName);
            return response()->json(['image_url' => $url], 200);
        }
    }


    public function deleteEditorImage(Request $request)
    {
        $imageUrl = $request->input('image_url');

        $imagePath = parse_url($imageUrl, PHP_URL_PATH);

        $fullImagePath = public_path($imagePath);

        if (File::exists($fullImagePath)) {
            File::delete($fullImagePath);
            return response()->json(['status' => 'success', 'message' => 'Image deleted successfully']);
        }

        return response()->json(['status' => 'error', 'message' => 'Image not found'], 404);
    }



    public function ComplainSolved(Request $request)
    {
        try {
            $validated = $request->validate([
                'reply_message' => 'required|string|min:20|max:500',
                'complain_id' => 'required|exists:complains,id',
            ]);

            $user_id = $request->header('id');
            $sender_role = User::where('id', $user_id)->value('role');

            if ($sender_role !== 'admin') {
                ActivityLogger::log('complaint_status_failed', 'Only admins can reply to complaints.', $request, 'complains');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Only clients can reply to complaints.',
                ], 403);
            }

            $complain = Complain::find($validated['complain_id']);
            if (!$complain) {
                ActivityLogger::log('complaint_status_failed', 'Complaint not found.', $request, 'complains');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Complaint not found.',
                ], 404);
            }


            $complainConversation = ComplainConversation::create([
                'complain_id' => $complain->id,
                'sender_id' => $user_id,
                'reply_message' => $validated['reply_message'],
                'sender_role' => $sender_role,
            ]);

            if ($complainConversation) {

                $result = $complain->update([
                    'status' => 'solved',
                ]);

                $customer = $complain->user;             
                $client = $complain->food->user;        

                if ($customer->role === 'user') {
                    $customer->notify(new SolvedComplainNotification($complain)); 
                }

                if ($client->role === 'client') {
                    $client->notify(new SolvedComplainNotification($complain)); 
                }

                ActivityLogger::log('complaint_status_success', 'Complain solved successfully.', $request, 'complain_conversations');
                return response()->json([
                    'status' => 'success',
                    'message' => 'Complain feedback has been sent successfully.',
                ], 201);

            } else {
                ActivityLogger::log('complaint_status_failed', 'Failed to solve the complaint.', $request, 'complain_conversations');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Failed to create complain feedback.',
                ], 500);
            }

        } catch (ValidationException $e) {
            ActivityLogger::log('complaint_status_failed', 'Validation failed: ' . json_encode($e->errors()), $request, 'complain_conversations');
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            ActivityLogger::log('complaint_status_failed', 'Error: ' . $e->getMessage(), $request, 'complain_conversations');
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while processing the request',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function ComplainInvestigation(Request $request)
    {
        try {
            $validated = $request->validate([
                'reply_message' => 'required|string|min:20|max:500',
                'complain_id' => 'required|exists:complains,id',
            ]);

            $user_id = $request->header('id');
            $sender_role = User::where('id', $user_id)->value('role');

            if ($sender_role !== 'admin') {
                ActivityLogger::log('complaint_status_failed', 'Only admins can reply to complaints.', $request, 'complains');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Only clients can reply to complaints.',
                ], 403);
            }

            $complain = Complain::find($validated['complain_id']);
            if (!$complain) {
                ActivityLogger::log('complaint_status_failed', 'Complaint not found.', $request, 'complains');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Complaint not found.',
                ], 404);
            }


            $complainConversation = ComplainConversation::create([
                'complain_id' => $complain->id,
                'sender_id' => $user_id,
                'reply_message' => $validated['reply_message'],
                'sender_role' => $sender_role,
            ]);

            if ($complainConversation) {

                $result = $complain->update([
                    'status' => 'further-investigation',
                ]);

                $customer = $complain->user;             
                $client = $complain->food->user;        

                if ($customer->role === 'user') {
                    $customer->notify(new ComplainInvestigationNotification($complain)); 
                }

                if ($client->role === 'client') {
                    $client->notify(new ComplainInvestigationNotification($complain)); 
                }

                ActivityLogger::log('complaint_status_success', 'Complain is now under further investigation.', $request, 'complain_conversations');
                return response()->json([
                    'status' => 'success',
                    'message' => 'Complain is now under further investigation.',
                ], 201);

            } else {
                ActivityLogger::log('complaint_status_failed', 'Failed to investigate the complaint.', $request, 'complain_conversations');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Failed to create complain feedback.',
                ], 500);
            }

        } catch (ValidationException $e) {
            ActivityLogger::log('complaint_status_failed', 'Validation failed: ' . json_encode($e->errors()), $request, 'complain_conversations');
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            ActivityLogger::log('complaint_status_failed', 'Error: ' . $e->getMessage(), $request, 'complain_conversations');
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while processing the request',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    private function deleteImagesFromHTML($htmlContent)
    {
        preg_match_all('/<img[^>]+src="([^">]+)"/', $htmlContent, $matches);

        if (isset($matches[1])) {
            foreach ($matches[1] as $imageUrl) {
                $imagePath = ltrim(parse_url($imageUrl, PHP_URL_PATH), '/');
                $fullImagePath = public_path($imagePath);
                if (File::exists($fullImagePath)) {
                    File::delete($fullImagePath);
                }
            }
        }
    }

    public function delete(Request $request)
    {
        try {
            $user_id = $request->header('id');
            $complain_id = $request->input('id');

            $complain = Complain::with('conversations')->findOrFail($complain_id);

            if (!empty($complain->message)) {
                $this->deleteImagesFromHTML($complain->message);
            }

            foreach ($complain->conversations as $conversation) {
                if (!empty($conversation->reply_message)) {
                    $this->deleteImagesFromHTML($conversation->reply_message);
                }
            }

            $complain->conversations()->delete();
            $complain->delete();
            ActivityLogger::log(
                'complaint_delete_success',
                'Complain deleted successfully.',
                $request,
                'complains'
            );
            return response()->json([
                'status' => 'success',
                'message' => 'Complain, conversations, and related images deleted successfully.'
            ], 200);

        } catch (ModelNotFoundException $e) {
            ActivityLogger::log(
                'complaint_delete_failed',
                'Complain not found.',
                $request,
                'complains'
            );
            return response()->json([
                'status' => 'failed',
                'message' => 'Complain not found',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            ActivityLogger::log(
                'complaint_delete_failed',
                'An unexpected error occurred while deleting the complain: ' . $e->getMessage(),
                $request,
                'complains'
            );
            return response()->json([
                'status' => 'failed',
                'message' => 'Deletion failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }


}