<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\URL;
use Storage;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    //$path = public is placeholder
    //$path is changed based on where the image is saved from
    //example in profiles ($image, profiles) will be sent
    //thus changes the values
    public function saveImage($image, $path = 'public')
    {
        //condition if image is null, if it is itll return null
        if (!$image) {
            return null;
        }

        //assigning filename, renaming it by time
        $filename = time() . '.png';

        // save image into Storage folder 
        // disk/public/filname and the decoded base64 image

        \Illuminate\Support\Facades\Storage::disk($path)->put($filename, base64_decode($image));

        //return the path
        // Url is the base url exp: localhost:8000
        return URL::to('/') . '/storage/' . $path . '/' . $filename;
        //example of return
        //http://192.168.41.231:8000/storage/profiles/1696036663.png
    }
    public function multImageUpload(Request $request, $path = 'public')
    {
        $imagecount = 0;
        $files = $request->file;
        foreach ($files as $file) {

            $filename = time() . '.png';
            $fileDB = URL::to('/') . '/storage/' . $path . '/' . $filename;


            $imagecount++;

            // $crendentials = Credential::where('petshooter_id', $id)->first();
            // $credentials->create([
            //    'petshooter_id' => auth()->user()->id,
            //     'image' => $fileDB ,

            // ]);
            \Illuminate\Support\Facades\Storage::disk($path)->put($filename, $file);
            //$file->storeAs('public/storage/', $file->getClientOriginalName());
        }
        // return URL::to('/').'/storage/'.$path.'/'.$filename;
        return $imagecount;
    }

    /**
     * Returns as success with json response
     *
     * @param mixed $data
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function success(mixed $data, string $message = "okay", int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'success' => true,
            'message' => $message,
        ], $statusCode);
    }

    /**
     * Returns as error with json response
     *
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function error(string $message, int $statusCode = 400): JsonResponse
    {
        return response()->json([
            'data' => null,
            'success' => false,
            'message' => $message,
        ], $statusCode);
    }


}
