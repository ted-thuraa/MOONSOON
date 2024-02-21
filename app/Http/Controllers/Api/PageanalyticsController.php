<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\FormAnalytics;
use App\Models\FormClicks;
use App\Models\FormResponces;
use App\Models\FormViews;
use App\Models\Link;
use App\Models\Page;
use Stevebauman\Location\Facades\Location;
use App\Models\Pageanalytics;
use App\Models\PageClicks;
use App\Models\Pageviews as ModelsPageviews;
use App\Models\Pagevisitorlocationdata;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Google\Service\Blogger\Resource\PageViews;

class PageanalyticsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
           
            $page = Page::where('user_id', auth()->user()->id)->first();

            $linkAnalytics = Pageanalytics::where('page_id', $page->id)->get();
            return response()->json($linkAnalytics, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function trigger(Request $request)
    {
        $request->validate([
            'username' => 'required',
           
        ]);
        //$ip = '101.69.158.14';
        //$ip = '93.199.48.235';
        //$ip = '139.190.208.83';
        //$ip = '54.131.99.37';
        //$ip = '189.22.105.33';
        //$ip = '207.113.125.164;';
        //$ip = '196.83.131.202';
        //$ip = '205.134.50.156';
        //$ip = '247.138.60.150';
        //$ip = '203.160.150.223';
        //$ip = '10.244.14.250';
        $ip = $request->ip();
        

        //$referrer = $request->header('referer');
        // Save the page view

        //$userAgent = $request->header('User-Agent');
        $date = now()->toDateString();
        $username = $request->input('username');
        $visitorInfo = Location::get($ip);
        

        try {
           $user = User::where('username', $username)->first();
           if ($user) {
            // Check if this is a unique visitor
            $pageview = ModelsPageviews::where('user_id', $user->id)->where('ip', $ip)->first();
            $uniquevisitor = $pageview ? 0 : 1;

          
        
            // Capture visitor information if available
             if ($visitorInfo !== false) {
                 ModelsPageviews::create([
                     'user_id' => $user->id,
                     'ip' => $ip,
                     //'referrer' => $referrer, // Uncomment this if needed
                     'country' => $visitorInfo->countryName,
                     'countryCode' => $visitorInfo->countryCode,
                     'cityName' => $visitorInfo->cityName,
                     'areaCode' => $visitorInfo->areaCode,
                     'regionName' => $visitorInfo->regionName,
                     'regionCode' => $visitorInfo->regionCode,
                 ]);
             } else {
                 ModelsPageviews::create([
                     'user_id' => $user->id,
                     'ip' => $ip,
                     //'referrer' => $referrer, // Uncomment this if needed
                 ]);
             }
        
            // // Calculate CTR
             $views = ModelsPageviews::where('user_id', $user->id)
                     ->whereDate('created_at', now()->toDateString())
                     ->count();
            $clicks = PageClicks::where('user_id', $user->id)
                     ->whereDate('created_at', now()->toDateString())
                     ->count();
             $ctr = $views > 0 && $clicks > 0 ? round(($clicks / $views) * 100, 2) : 0;
        
            // Now you can use $ctr as needed
            $linkanalytics = Pageanalytics::firstOrNew(['date' => $date]);
            $linkanalytics->user_id = $user->id;
            $linkanalytics->views += 1;
            //$linkanalytics->clicks = $clicks;
            $linkanalytics->ctr = $ctr;
            $linkanalytics->uniquevisitors += $uniquevisitor;
            $linkanalytics->save();
            $uniquevisitor = 0;
        } else {
            // Handle the case where the user with the given username does not exist
        }
           // Delete analytics data older than one month
           //$oneMonthAgo = Carbon::now()->subMonth()->toDateString();
           //Pageanalytics::whereDate('date', '<', $oneMonthAgo)->delete();
           $this->createLocationData($ip, $user->id);
           return response()->json('good to go', 200);
         } catch (\Exception $e) {
           $uniquevisitor = 0;
            return response()->json(['error' => $e->getMessage()], 400);
         }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function linkclicked(Request $request)
    
        {

            $data = $request->validate([
                'page_id' => 'required|exists:users,id',
                'link_id' => 'required|exists:links,id',
                
            ]);

            $user = User::where('id', $data['page_id'])->first();
            //$page = Page::where('linkname', $user->username)->first();
            $link = Link::where('id', $data['link_id'])->first();

            //$ip = '207.113.125.164';
            $ip = $request->ip();

           
            FormClicks::create([
                'link_id' => $link->id,
                'ip' => $ip,
                //'referrer' => $referrer, // Uncomment this if needed
            ]);

            $clicks = FormClicks::where('link_id', $link->id)
                    ->whereDate('created_at', now()->toDateString())
                    ->count();
            //$linkid = $request->input('link_id');
            //$username = $request->input('username');
            $date = now()->toDateString();
            //update particular link clicks
            //$link = Link::where('id', $linkid )->first();
            $link->clicks += 1;
            $link->save();

            $views = FormViews::where('link_id', $link->id)
                    ->whereDate('created_at', now()->toDateString())
                    ->count();
            $responces = FormResponces::where('link_id', $link->id)
                        ->whereDate('created_at', now()->toDateString())
                        ->count();
            $ctr = $views > 0 && $clicks > 0 ? round(($clicks / $views) * 100, 2) : 0;
            $conversion_rate = $clicks > 0 && $responces > 0 ? round(($clicks / $responces) * 100, 2) : 0;
        
            // Now you can use $ctr as needed
            $formanalytics = FormAnalytics::firstOrNew(['link_id' => $link->id, 'date' => $date]);
            //$formanalytics->date = $date;
            $formanalytics->views += $views;
            $formanalytics->clicks = $clicks;
            $formanalytics->ctr = $ctr;
            $formanalytics->conversion_rate = $conversion_rate;
            
            $formanalytics->save();
             

            //update page clicks
            //$linkanalytics = Pageanalytics::where('date', $date)
            //->where('user_id', $user->id)
            //->first();
            
            $linkanalytics = Pageanalytics::firstOrNew(['user_id' => $user->id, 'date' => $date]);
            
            if ($linkanalytics) {
                $linkanalytics->clicks += 1;
                $ctr = $linkanalytics->views > 0 && $linkanalytics->clicks > 0 ? round(($linkanalytics->clicks / $linkanalytics->views) * 100, 2) : 0;
                $linkanalytics->ctr = $ctr;
                $linkanalytics->save();

                       
            }

            return response()->json('Analytics data stored successfully', 200);
    
        }
    

    /**
     * Display the specified resource.
     */
    public function createLocationData($ip, $userid)
    {
        //$visitorInfo = Location::get($ip);
        //$visitorInfo = Location::get('105.160.109.73');
        
        $visitorInfo = Location::get($ip);
        // Pagevisitorlocationdata::create([
        //     'page_id' => $pageid,
        //     'ip' => $ip,
        //     'country' => $visitorInfo->countryName,
        //     'countryCode' => $visitorInfo->countryCode,
        //     'cityName' => $visitorInfo->cityName,
        //     'areaCode' => $visitorInfo->areaCode,
        //     'regionName' => $visitorInfo->regionName,
        //     'regionCode' => $visitorInfo->regionCode,
            
        // ]);

        
        if ($visitorInfo !== false) {
            Pagevisitorlocationdata::create([
                'user_id' => $userid,
                'ip' => $ip,
                'country' => $visitorInfo->countryName,
                'countryCode' => $visitorInfo->countryCode,
                'cityName' => $visitorInfo->cityName,
                'areaCode' => $visitorInfo->areaCode,
                'regionName' => $visitorInfo->regionName,
                'regionCode' => $visitorInfo->regionCode,
            ]);
        } else {
            Pagevisitorlocationdata::create([
                'user_id' => $userid,
                'ip' => $ip,
            ]);
        }

    }

    

    /**
     * Update the specified resource in storage.
     */
    public function formviewed(Request $request, Pageanalytics $pageanalytics)
    {
        $data = $request->validate([
            'page_id' => 'required|exists:users,id',
            'link_id' => 'required|exists:links,id',
            
        ]);

        $user = User::where('id', $data['page_id'])->first();
        //$page = Page::where('linkname', $user->username)->first();
        $link = Link::where('id', $data['link_id'])->first();

        $ip = '207.113.125.164';
        //$ip = $request->ip();
        $date = now()->toDateString();
        $username = $request->input('username');
        $visitorInfo = Location::get($ip);

        try {
            if ($user) {
             // Check if this is a unique visitor
             $formview = FormViews::where('link_id', $link->id)->where('ip', $ip)->first();
             $uniquevisitor = $formview ? 0 : 1;
         
             // Capture visitor information if available
             
                FormViews::create([
                     'link_id' => $link->id,
                     'ip' => $ip,
                 ]);
             
         
             // Calculate CTR
             $views = FormViews::where('link_id', $link->id)
                    ->whereDate('created_at', now()->toDateString())
                    ->count();
             $clicks = FormClicks::where('link_id', $link->id)
                    ->whereDate('created_at', now()->toDateString())
                    ->count();
             $responces = FormResponces::where('link_id', $link->id)
                    ->whereDate('created_at', now()->toDateString())
                    ->count();
             $ctr = $views > 0 && $clicks > 0 ? round(($clicks / $views) * 100, 2) : 0;
             $conversion_rate = $clicks > 0 && $responces > 0 ? round(($clicks / $responces) * 100, 2) : 0;
         
             // Now you can use $ctr as needed
             $formanalytics = FormAnalytics::firstOrNew(['link_id' => $link->id, 'date' => $date]);
             //$formanalytics->date = $date;
             $formanalytics->views += 1;
             //$formanalytics->clicks = $clicks;
             $formanalytics->ctr = $ctr;
             $formanalytics->conversion_rate = $conversion_rate;
             $formanalytics->uniqueviews += $uniquevisitor;
             $formanalytics->save();
             $uniquevisitor = 0;
         } else {
             // Handle the case where the user with the given username does not exist
         }
            // Delete analytics data older than one month
            //$oneMonthAgo = Carbon::now()->subMonth()->toDateString();
            //Pageanalytics::whereDate('date', '<', $oneMonthAgo)->delete();
            //$this->createLocationData($ip, $user->id);
            return response()->json('Analytics data stored successfully', 200);
          } catch (\Exception $e) {
            $uniquevisitor = 0;
             return response()->json(['error' => $e->getMessage()], 400);
          }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pageanalytics $pageanalytics)
    {
        //
    }
}
