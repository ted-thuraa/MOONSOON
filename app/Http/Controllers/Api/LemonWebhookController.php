<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PayingCustomers;
use App\Models\Payments;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LemonWebhookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function webhook(Request $request)
    {
        //$secret    = env('LEMON_SQUEEZY_SIGNING_SECRET');
        $secret    ='tedthu7064#';
        
        $payload   = @file_get_contents('php://input');
        $hash      = hash_hmac('sha256', $payload, $secret);
        $signature = $_SERVER['HTTP_X_SIGNATURE'] ?? '';

        if (!hash_equals($hash, $signature)) {
            return new Response(('Invalid signature.'), 400);
        }
        $payloadd = $request->all();
        if (! isset($payloadd['meta']['event_name'])) {
            return new Response(('Webhook received but no event name was found.'), 204);
        }

        

        try {
            if ($payloadd['meta']['event_name'] === 'order_created') {
                if ($payloadd['meta']['custom_data']) {
                    $useruuid = $payloadd['meta']['custom_data']['ouid'];
                    $user = User::where('id', $useruuid)->first();
                
    
                    $order = Order::create([
                        'lemon_order_object_id' => $payloadd['data']['id'],
                        'user_id' => $user->id,
                        'order_status' => $payloadd['data']['attributes']['status'],
                        'customer_id' => $payloadd['data']['attributes']['customer_id'],
                        'user_email' => $user->email,
                        'checkout_email' => $payloadd['data']['attributes']['user_email'],
                        'orderitem_id' => $payloadd['data']['attributes']['first_order_item']['order_id'],
                        'planname' => $payloadd['data']['attributes']['first_order_item']['product_name'],
                        'total_price' => $payloadd['data']['attributes']['total'],
                        'total_formatted' => $payloadd['data']['attributes']['total_formatted'],
                        'product_id' =>$payloadd['data']['attributes']['first_order_item']['product_id'],
                        
                        // Fill other fields for the current date
                    ]);
                }
    
                if ($payloadd['data']['attributes']['status'] === "paid") {
                    //$useremail = $payloadd['meta']['custom_data']['email'];
    
                    $user = User::where('id', $useruuid)->first();
                    $user->currentplan = $payloadd['data']['attributes']['first_order_item']['variant_name'];
                    $user->save();
                    Payments::create([
                        'user_id' => $user->id,
                        'order_id' => $order->id,
                        'user_email' => $user->email,
                        'checkout_email' => $order->checkout_email,
                        'planname' => $payloadd['data']['attributes']['first_order_item']['variant_name'],
                        'total_price' => $payloadd['data']['attributes']['total'],
                        'total_formatted' => $payloadd['data']['attributes']['total_formatted'],
                        // Fill other fields for the current date
                    ]);
                    PayingCustomers::create([
                        'user_id' => $user->id,
                        'lemoncustomer_id' => $payloadd['data']['attributes']['customer_id'],
                        'customer_email' => $user->email,
                        'customer_name' => $payloadd['data']['attributes']['user_name'],
                        'product_name' => $payloadd['data']['attributes']['first_order_item']['product_name'],
                        'product_id' =>$payloadd['data']['attributes']['first_order_item']['product_id'],
                        // Fill other fields for the current date
                    ]);
                    
                }
            }
    
            return response(('ok'), 200);
            
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
       
    }
}
