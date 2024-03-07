<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomApplicationResource;
use App\Models\Allocation;
use App\Models\Room;
use App\Models\RoomApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Carbon\Carbon;

class RoomApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $RoomApplication = RoomApplication::paginate(5);
            return RoomApplicationResource::collection($RoomApplication);
            
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }
    public function getRoomApplication($id)
    {
        try {
            $RoomApplication = RoomApplication::findOrFail($id); // Use findOrFail to retrieve a RoomApplication by its ID
            return new RoomApplicationResource($RoomApplication); // Instantiate RoomApplicationResource with the retrieved RoomApplication
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'nullable',
            'user_name' => 'nullable',
            'hostel_id' => 'required',
            'hostel_name' => 'required',
            'room_type' => 'required',
            'price' => 'required',
            'phone' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        try {
            $orderiD = date('YmdHis');
            $user = $request->user();
            $response = $this->mpesa($data['phone'], $data['price'], $orderiD);
            return $response;
            // if($response == 0) {
            //     // Parse the incoming date string using Carbon
            //     $carbonstartDate = Carbon::parse($data['start_date']);
            //     $carbonendDate = Carbon::parse($data['end_date']);

            //     // Format the date as 'Y-m-d'
            //     $formattedStartDate = $carbonstartDate->format('Y-m-d');
            //     $formattedEndDate = $carbonendDate->format('Y-m-d');
            

            //     $data['user_id'] = $user->id;
            //     $data['user_name'] = $user->firstname;
            //     $data['start_date'] = $formattedStartDate;
            //     $data['end_date'] = $formattedEndDate;
                
            //     $RoomApplication = RoomApplication::create($data);
            //     return response()->json('RoomApplication created', 200);
            // } else {
            //     return response()->json('error: payment failed' , 400);
            // }
            
        } catch (\Exception $e) {
           
            return response()->json(['error' => $e->getMessage()], 400);
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomApplication $RoomApplication)
    {
        //
    }

    /**
     * Assign room.
     */
    public function assign(RoomApplication $RoomApplication, Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required',
            'hostel_id' => 'required',
            'booking_id' => 'required',
            'user_name' => 'nullable',
            'hostel' => 'required',
            'room' => 'required',
            'active' => 'nullable',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        try {
            $user = $request->user();
            $room = Room::where('hostel_id', $data['hostel_id'])->where('room_no', $data['room'])->first();
            $application = RoomApplication::where('id', $data['booking_id'])->first();
            $RoomApplication = Allocation::create($data);
            $room->available = false;
            $application->status = "Allocated";
            $application->save();
            $room->save();
            return response()->json('RoomApplication created', 200);
        } catch (\Exception $e) {
           
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomApplication $RoomApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomApplication $RoomApplication, Request $request, $id)
    {
       

        $RoomApplication = RoomApplication::where('id', $id);
        

        

        $RoomApplication->delete();
        
        return response('', 204);
    }

    private function mpesa($phone, $price, $orderid)
    {
        define('CALLBACK_URL', 'https://a29b-102-5-63-10.ngrok-free.app/callback_hook?order_id=');

        $consumerKey = env('MPESA_CONSUMER_KEY');
        $consumerSecret = env('MPESA_CONSUMER_SECRET');
        $BusinessShortcode = '174379';
        $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        $phone = 254 . $phone;
        $PartyA = $phone;
        $PartyB = 174379;
        $TransactionDesc = 'Pay Order';
        $AccountReference = 'CompanyXLTD';
        $Timestamp = date('YmdHis');
        $Password = base64_encode($BusinessShortcode.$Passkey.$Timestamp);
        $headers = ['Content-Type:application/json; charset=utf8'];

        $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

        $ch = curl_init('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
        $response = curl_exec($ch);
        $response = json_decode($response);
        $access_token = $response->access_token;

        curl_close($ch);        

        
        // Construct your request payload here
        $payload = [
            'BusinessShortCode' => $BusinessShortcode,
            'PhoneNumber' => $PartyA,
            'PartyA' => $PartyA,
            'PartyB' => $PartyB,
            'TransactionType' => 'CustomerPayBillOnline',
            'Timestamp' => $Timestamp,
            'Password' => $Password,
            'Amount' => $price,
            'CallBackURL' => "https://mydomain.com/path",
            'AccountReference' => $orderid,
            'TransactionDesc' => 'Test Payment',
        ];

    
        $ch = curl_init('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer '.$access_token,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload)); // Encode the payload to JSON
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response);
        return $data;
    }

    // private function mpesa($phone, $price, $orderid)
    // {
    //     define('CALLBACK_URL', 'https://a29b-102-5-63-10.ngrok-free.app/callback_hook?order_id=');

    //     $consumerKey = env('MPESA_CONSUMER_KEY');
    //     $consumerSecret = env('MPESA_CONSUMER_SECRET');
    //     $BusinessShortcode = '174379';
    //     $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
    //     $phone = 254 . $phone;
    //     $PartyA = $phone;
    //     $PartyB = 174379;
    //     $TransactionDesc = 'Pay Order';
    //     $AccountReference = 'CompanyXLTD';
    //     $Timestamp = date('YmdHis');
    //     $Password = base64_encode($BusinessShortcode.$Passkey.$Timestamp);
    //     $headers = ['Content-Type:application/json; charset=utf8'];

    //     $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    //     $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

    //     $ch = curl_init('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
        
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    //     curl_setopt($ch, CURLOPT_HEADER, FALSE);
    //     curl_setopt($ch, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
    //     $response = curl_exec($ch);
    //     $response = json_decode($response);
    //     $access_token = $response->access_token;

    //     curl_close($ch);        

        
    //      // Construct your request payload here
    //     $payload = [
    //         // Construct your payload here
    //         'BusinessShortCode' => $BusinessShortcode,
    //         'PhoneNumber' => $PartyA,
    //         'PartyA' => $PartyA,
    //         'PartyB' => $PartyB,
    //         'TransactionType' => 'CustomerPayBillOnline',
    //         'Timestamp' => $Timestamp,
    //         'Password' => $Password,
    //         'Amount' => $price,
    //         'CallBackURL' => "https://mydomain.com/path",
    //         'AccountReference' => $orderid,
    //         'TransactionDesc' => 'Test Payment',
    //     ];

       
    //     $ch = curl_init('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest');
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, [
    //         'Authorization: Bearer '.$access_token,
    //         'Content-Type: application/json'
    //     ]);
    //     curl_setopt($ch, CURLOPT_POST, 1);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, [
    //         'BusinessShortCode' => $BusinessShortcode,
    //         'PhoneNumber' => $PartyA,
    //         'PartyA' => $PartyA,
    //         'PartyB' => $PartyB,
    //         'TransactionType' => 'CustomerPayBillOnline',
    //         'Timestamp' => $Timestamp,
    //         'Password' => $Password,
    //         'Amount' => $price,
    //         'CallBackURL' => "https://mydomain.com/path",
    //         'AccountReference' => $orderid,
    //         'TransactionDesc' => 'Test Payment',
    //     ]);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //     $response     = curl_exec($ch);
    //     curl_close($ch);


    //     //$response = Http::withHeaders([
    //     //   'Authorization' => 'Bearer '.$access_token,
    //     //   'Content-Type' => 'application/json',
    //     //])->post('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', $payload);
            
         

    //     // Handle response
    //     //$statusCode = $response->getStatusCode();
    //     //$data = json_decode($response->getBody(), true);
    //     $data = json_decode($response);
    //     return $data;
    //     //return $response;
    //     //return $responseCode; 
    //     }
}
