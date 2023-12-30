<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petcredentialimages;
use App\Models\Petcredentialtype;

class CredentialImageController extends Controller
{
    public function uploadmultiimage(Request $request)
    {
        // $request->validate([
        //    // 'owner_id' => 'required',
        //     'pet_id' => 'required',
        //     'images' => 'required',
        //     //'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        $images = $this->saveImage($request->images, 'petprofile');


        // Create a new CredentialImage record
        $credentialImage = Petcredentialimages::create([
            'owner_id' => auth()->user()->userID,
            'pet_id' => (int) $request->pet_id,
            'image_path' => $images,
        ]);

        // // Handle and store each image
        // foreach ($request->file('images') as $key => $image) {
        //     $imageName = time() . '_' . $key . '_' . $image->getClientOriginalName();
        //     $image->move(public_path('images'), $imageName);

        //     // Update the corresponding image_path column
        //     $credentialImage->update([
        //         'image_path_' . ($key + 1) => 'images/' . $imageName,
        //     ]);
        // }

        // return response()->json(['success' => $credentialImage]);

        return Response([
            'message' => 'Image added succesfully',
            // 'pet' => $pet,
            'image' => $credentialImage->image_path
        ], 200);
    }

    public function getImages($petId)
    {
        // Retrieve images for a specific pet
        $images = Petcredentialimages::where('pet_id', $petId)->get();

        return response()->json(['images' => $images]);
    }

    public function createcredtype(Request $request)
    {
        // Create a new CredentialImage record
        $credType = Petcredentialtype::create([
            'owner_id' => auth()->user()->userID,
            'pet_id' => (int) $request->pet_id,
            'cred_type' => $request->cred_type,
        ]);

        return Response([
            'message' => 'Cred types added succesfully',
            // 'pet' => $pet,
            // 'image' => $credentialImage->image_path
        ], 200);
    }


}
