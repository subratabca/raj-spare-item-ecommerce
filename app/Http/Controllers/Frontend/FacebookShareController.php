<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;
use App\Models\Food;
use App\Models\FacebookUser;

class FacebookShareController extends Controller
{

    public function shareToFacebook(Request $request, $foodId)
    {
        try {
            // Retrieve food details
            $food = Food::with('foodImages')->findOrFail($foodId);

            // Get the Facebook user access token
            $user_id = $request->header('id');
            $fbUser = FacebookUser::where('user_id', $user_id)->first();
            
            if (!$fbUser || !$fbUser->access_token) {
                return response()->json(['message' => 'Facebook authentication required'], 401);
            }

            // Construct Open Graph Data
            $postData = [
                'message'       => 'Check out this food item: ' . $food->name,
                'link'          => url('/food-details/' . $food->id),
                'picture'       => asset('/upload/food/large/' . ($food->image ?? 'no_image.jpg')),
                'name'          => $food->name,
                'description'   => $food->description ?? 'Delicious food available for collection!',
                'access_token'  => $fbUser->access_token,
            ];

            // Make API request to Facebook
            $response = Http::post("https://graph.facebook.com/v18.0/me/feed", $postData);

            // Handle Facebook API response
            if ($response->failed()) {
                return response()->json([
                    'message' => 'Failed to share to Facebook.',
                    'error' => $response->json()
                ], 400);
            }

            return response()->json([
                'message' => 'Successfully shared to Facebook!',
                'response' => $response->json()
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function shareToFacebook111(Request $request, $foodId)
    {
        try {
            $food = Food::with('foodImages')->findOrFail($foodId);
            $user_id = $request->header('id');
            $fbUser = FacebookUser::where('user_id', $user_id)->first();
            if (!$fbUser) {
                return response()->json([
                    'status' => 'unauthorized',
                    'message' => 'User not found. Connect your Facebook account first.',
                ], 401);
            }

            $fb = new Facebook([
                'app_id' => env('FACEBOOK_CLIENT_ID'),
                'app_secret' => env('FACEBOOK_CLIENT_SECRET'),
                'default_graph_version' => 'v12.0',
            ]);

            $mainImage = asset('/upload/food/large/' . $food->image);
            $message = "Check out this food item: {$food->name}!";
            $response = $fb->post(
                '/me/photos',
                [
                    'url' => $mainImage,
                    'caption' => $message,
                ],
                $fbUser->access_token
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Shared successfully to Facebook.',
                'response' => $response->getGraphNode()->asArray(),
            ], 200);

        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Graph returned an error.',
                'error' => $e->getMessage(),
            ], 500);
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Facebook SDK error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while sharing to Facebook.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function shareFacebookURL(Request $request, $foodId)
    {
        try {

            $user_id = $request->header('id');
            $fbUser = FacebookUser::where('user_id', $user_id)->first();
            if (!$fbUser) {
                return response()->json([
                    'status' => 'unauthorized',
                    'message' => 'User not found. Connect your Facebook account first.',
                ], 401);
            }

            $food = Food::with('foodImages')->findOrFail($foodId);
            $mainImage = url('/upload/food/large/' . $food->image);
            $shareURL = url("https://spareitems.org/food-details/{$food->id}");
            $facebookAppId = env('FACEBOOK_CLIENT_ID');

            $facebookShareUrl = 'https://www.facebook.com/dialog/share?' . http_build_query([
                'app_id' => $facebookAppId,
                'display' => 'popup',
                'href' => $shareURL,
                'quote' => "Check out this amazing food: {$food->name}!",
                'redirect_uri' => url('https://spareitems.org/auth/facebook/callback')
            ]);

            return response()->json([
                'status' => 'success',
                'facebook_share_url' => $facebookShareUrl,
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Food item not found.',
                'error' => $e->getMessage(),
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'An error occurred while generating the Facebook share URL.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function oldshareToFacebook(Request $request, $foodId)
    {
        $food = Food::with('foodImages')->findOrFail($foodId);
        $user_id = $request->header('id');
        $fbUser = FacebookUser::where('user_id',$user_id)->first();

        if (!$fbUser) {
            return response()->json([
                'status' => 'unauthorized',
                'message' => 'User not found.Connect your Facebook account first.',
            ], 401);
        }

        $fb = new Facebook([
            'app_id' => env('FACEBOOK_CLIENT_ID'),
            'app_secret' => env('FACEBOOK_CLIENT_SECRET'),
            'default_graph_version' => 'v12.0',
        ]);

        try {
            // Main image path
            $mainImage = asset('/upload/food/large/' . $food->image);

            // Post to timeline with the main image
            $message = "Check out this food item: {$food->name}!";
            $response = $fb->post(
                '/me/photos',
                [
                    'url' => $mainImage,
                    'caption' => $message, // Caption for the image
                ],
                $fbUser->access_token
            );

            return redirect()->back()->with('success', 'Shared successfully to Facebook.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}

