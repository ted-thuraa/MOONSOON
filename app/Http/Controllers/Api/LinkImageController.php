<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Models\Page;
use App\Models\PortfolioData;
use App\Models\User;
use App\Services\FileService;
use Illuminate\Http\Request;

class LinkImageController extends Controller
{
     /**
     * Update the specified resource in storage.
     */
    public function cdn(Request $request)
    {
        $API_TOKEN = '7653238475bhjhjjh234325';
    
        // Initialize cURL session
        $ch = curl_init();
    
        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, 'https://api.digitalocean.com/v2/cdn/endpoints');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $API_TOKEN
        ]);
    
        // Execute the cURL session
        $response = curl_exec($ch);
    
        // Check for cURL errors
        if (curl_errno($ch)) {
            // Handle the error here
            // For example: echo 'Curl error: ' . curl_error($ch);
        }
    
        // Close the cURL session
        curl_close($ch);
    
        // $response now contains the response from the API
        return $response;
    }
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);

        try {
            $user = User::where('id', auth()->user()->id)->first();
            //$links = Link::where('page_id', $page->id)->where('category', "other")->get();
            $link = Link::where('id', $request->input('id'))
                ->where('user_id', $user->id)
                ->first();
            $link = (new FileService)->updateImage($link, $request);
            $link->save();

            return response()->json('Link IMAGE UPDATED', 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
     /**
     * Update the specified resource in storage.
     */
    public function storethumbnail(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);

        try {
            $user = User::where('id', auth()->user()->id)->first();
            //$links = Link::where('page_id', $page->id)->where('category', "other")->get();
            $link = Link::where('id', $request->input('id'))
                ->where('user_id', $user->id)
                ->first();
            $link = (new FileService)->updateThumbnailImage($link, $request);
            $link->save();

            return response()->json('Link Thumbnail UPDATED', 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    public function storeportfoliothumbnail(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);

        try {
            $user = User::where('user_id', auth()->user()->id)->first();
            //$links = Link::where('page_id', $page->id)->where('category', "other")->get();
            $link = Link::where('id', $request->input('id'))
                ->where('user_id', $user->id)
                ->first();
            $portfolio_data = PortfolioData::where('link_id', $link->id)
                ->first();
            $portfolio_data = (new FileService)->updateportfolioThumbnailImage($portfolio_data, $request);
            $portfolio_data->save();

            return response()->json('Portfolio Thumbnail UPDATED', 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
