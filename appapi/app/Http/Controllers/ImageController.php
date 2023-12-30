<?php

namespace App\Http\Controllers;

use Storage;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\URL;

class ImageController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    //   public function multImageUpload2($file, $path='public'){
    //     $files=$request->file('file');
    //     foreach($files as $file){
    //          $filename = time().'.png';

    //          \Illuminate\Support\Facades\Storage::disk($path)->put($filename, $file);
    //         //$file->storeAs('public/storage/', $file->getClientOriginalName());
    //     }
    //    URL::to('/').'/storage/'.$path.'/'.$filename;
    // }
    //  public function imageUpload(Request $request){
    //     $files=$request->file('file');
    //     foreach($files as $file){
    //          $filename = time().'.png';

    //          \Illuminate\Support\Facades\Storage::disk($path)->put($filename, base64_decode($image));
    //         $file->storeAs('public/storage/', $file->getClientOriginalName());
    //     }
    //     return response()->json(['result'=>"success"]);
    // }

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
}
