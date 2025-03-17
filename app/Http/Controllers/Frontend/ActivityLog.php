<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Notifications\BannedCustomerNotification;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Models\User;
use App\Models\Order;
use App\Models\BannedCustomer;
use Carbon\Carbon;

class ClientBannedController extends Controller
{
    public function delete(Request $request)
    {
        try {
            $client_id = $request->header('id');
            $ban_id = $request->input('id');
            $banCustomer = BannedCustomer::where('id',$ban_id)->where('client_id', $client_id)->first();

            if (!empty($banCustomer->message)) {
                $this->deleteImagesFromHTML($banCustomer->message); 
            }
            $banCustomer->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Customer remove from ban list successfully.'
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Complain not found',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Deletion failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}



Just apply ActivityLogger::log($activityType, $description, $userId = null, $role, $relatedTable). Here  $role will be client and relatedTableand will be banned_customers. Give me updated public function delete(Request $request).


if customer request success:
                'activity_type' => 'Email Verified By Customer',
                'description' => 'Success,Email Verified',

if customer request failed: failed then write reason for failed in description: 
                'activity_type' => 'Email Verified By Customer',
                'description' => 'Failed, Email Verified',


    
                











