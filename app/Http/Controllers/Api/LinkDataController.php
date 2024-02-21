<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactFormData;
use App\Models\Link;
use App\Models\PortfolioData;
use App\Models\SaasData;
use App\Models\TextData;
use Illuminate\Http\Request;

class LinkDataController extends Controller
{
    public function layout(Request $request, Link $link)
    {
        $request->validate([
            'link_id' => 'required',
            'Layout' => 'nullable',
            
        ]);

        try {
            $link = Link::where('id', $request->input('link_id'))->first();
            $link->layout = $request->input('Layout');
            
            $link->save();

            return response()->json('LINK Layout UPDATED', 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    public function startupdata(Request $request, Link $link)
    {
        $data = $request->validate([
            'user_id' => 'exists:users,id', 
            'data' => 'nullable',
            
        ]);

        try {
            $data['data'] = json_encode($data['data']);
            
            $link = Link::where('id', $request->input('id'))->first();
            $link->update($data);
           
           
            
            return response()->json('LINK saasdata UPDATED', 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
   
    public function formdata(Request $request, Link $link)
    {
        $data = $request->validate([
            'user_id' => 'exists:users,id', 
            'data' => 'nullable',
            
        ]);

        try {
            $data['data'] = json_encode($data['data']);
            $link = Link::where('id', $request->input('id'))->first();
            $link->update($data);
            


            return response()->json('LINK formdata UPDATED', 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    
}
