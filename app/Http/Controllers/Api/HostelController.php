<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Resources\HostelResource; 
use App\Models\Hostel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class HostelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $hostel = Hostel::paginate(5);
            return HostelResource::collection($hostel);
            
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
            'hostel_name' => 'required',
            'location' => 'required',
            'available' => 'required',
            'description' => 'nullable',
            'total_rooms' => 'nullable',
            'billing' => 'nullable',
            'thumbnailimage' => 'nullable',
            
            
        ]);

        try {
            if (isset($data['thumbnailimage'])) {
                $relativePath = $this->saveImage($data['thumbnailimage']);
                $data['thumbnailimage'] = $relativePath;
            }
            $hostel = Hostel::create($data);
            return response()->json('Hostel created', 200);
        } catch (\Exception $e) {
           
            return response()->json(['error' => $e->getMessage()], 400);
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Hostel $Hostel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hostel $Hostel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hostel $Hostel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hostel $Hostel, Request $request, $id)
    {
       

        $Hostel = Hostel::where('id', $id);
        

        // if an old image exist, delete it
        if ($Hostel->thumbnailimage) {
            $absolutePath = public_path($Hostel->thumbnailimage);
            File::delete($absolutePath);
        }

        $Hostel->delete();
        
        return response('', 204);
    }




    private function saveImage($image)
    {
        // check if image is valid base64 string
        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            // Take out the base64 encoded text without mime type
            $image = substr($image, strpos($image, ',') + 1);
            //Get file extention
            $type = strtolower($type[1]); // jpg, png, gif

            // Check if file is an image
            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('invalid image type');
            }
            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);

            if ($image === false) {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception('did not match data URI with image data');
        }

        $dir = 'images/';
        $file = Str::random(). '.' . $type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;
        if (!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }
        file_put_contents($relativePath, $image);

        return $relativePath;
    }


    // Client

    public function getHostel()
    {
        try {
            $allHostel = HostelResource::collection(Hostel::paginate());
            $books = HostelResource::collection(Hostel::where('type', 'Book')->paginate());
            $articles = HostelResource::collection(Hostel::where('type', 'Article')->paginate());
            $videos = HostelResource::collection(Hostel::where('type', 'Video')->paginate());

            $data = [
                'allHostel' => $allHostel,
                'books' => $books,
                'articles' => $articles,
                'videos' => $videos
            ];
            return $data;
            
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }
}
