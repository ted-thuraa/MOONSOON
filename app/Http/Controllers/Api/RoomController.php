<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        try {
            $Rooms = Room::where('hostel_id', $id)->paginate();
            return RoomResource::collection($Rooms);
            
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
            'hostel_id' => 'required',
            'hostel_name' => 'nullable',
            'available' => 'required',
            'room_type' => 'nullable',
            'room_no' => 'nullable',
            'description' => 'nullable',
            'billing' => 'nullable',
            'thumbnailimage' => 'nullable',
           
            
        ]);

        try {
            if (isset($data['thumbnailimage'])) {
                $relativePath = $this->saveImage($data['thumbnailimage']);
                $data['thumbnailimage'] = $relativePath;
            }
            $room = Room::create($data);
            return response()->json('Room created', 200);
        } catch (\Exception $e) {
           
            return response()->json(['error' => $e->getMessage()], 400);
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $Room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $Room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $Room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $Room, Request $request, $id)
    {
       

        $Room = Room::where('id', $id);
        

        // if an old image exist, delete it
        if ($Room->thumbnailimage) {
            $absolutePath = public_path($Room->thumbnailimage);
            File::delete($absolutePath);
        }

        $Room->delete();
        
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

    public function getRoom()
    {
        try {
            $allRoom = RoomResource::collection(Room::paginate());
            //$books = RoomResource::collection(Room::where('type', 'Book')->paginate());
            //$articles = RoomResource::collection(Room::where('type', 'Article')->paginate());
            //$videos = RoomResource::collection(Room::where('type', 'Video')->paginate());

            $data = [
                'allRoom' => $allRoom,
                //'books' => $books,
                //'articles' => $articles,
                //'videos' => $videos
            ];
            return $data;
            
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }
}
