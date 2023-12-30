<?php
//this
namespace App\Http\Controllers;


use App\Models\Pet;
use App\Models\BreedingPost;
use App\Models\Adoption;
use App\Models\Petpreference;
use App\Models\Petcredentialtype;
use App\Models\Petcredentialimages;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

class Petcontroller extends Controller
{

    public function checkpetadd(Request $request)
    {
        $attrs = $request->validate(
            [
                // 'sterilization' => 'nullable|string|in:Neutered,Sprayed',
                // 'vaccined'=> 'nullable|string|in:Vaccinated,Unvaccinated',
                // 'dewormed'=>'nullable|string|in:Yes,No',
                // 'petcolor'=>'required|string|', 
                // 'petage'=>'required|int|',
                // 'petbreed'=>'required|string|',  
                // 'petsize'=>'required|string|in:Small,Medium,Large', 
                // 'petgender'=>'required|string|in:Male, Female', 

                'petname' => 'nullable|string',



            ]
        );
        $pets = Pet::where('owner_id', auth()->user()->userID)->get();
        foreach ($pets as $pet) {

            if ($pet->petname == $attrs['petname']) {
                return response([
                    'messsage' => 'pet already exists'
                ], 200);

            }
        }


        return Response([
            // 'Pet preference added',
            'pet' => $pets,
            'message' => "Pet doesnt exist",
        ], 200);
    }

    public function checkpetbreed(Request $request)
    {
        $attrs = $request->validate(
            [
                // 'sterilization' => 'nullable|string|in:Neutered,Sprayed',
                // 'vaccined'=> 'nullable|string|in:Vaccinated,Unvaccinated',
                // 'dewormed'=>'nullable|string|in:Yes,No',
                // 'petcolor'=>'required|string|', 
                // 'petage'=>'required|int|',
                // 'petbreed'=>'required|string|',  
                // 'petsize'=>'required|string|in:Small,Medium,Large', 
                // 'petgender'=>'required|string|in:Male, Female', 

                'pet_id' => 'nullable|string',

            ]
        );
        $pets = Pet::where('owner_id', auth()->user()->userID)->where('petID', (int) $attrs['pet_id'])->first();
        // foreach ($pets as $pet) {

        //     if ($pet->petname == $attrs['petname']) {
        //         return response([
        //             'messsage' => 'pet already exists'
        //         ], 401);

        //     }
        // }

        $checkage = Str::contains(Str::lower($pets->petage), Str::lower('0 years'));

        $checkadopt = Adoption::where('pet_id', $pets->petID)->first();


        $checkbreedingpost = BreedingPost::where('pet_id', $pets->petID)->first();



        if ($checkbreedingpost) {
            return Response([
                // 'Pet preference added',
                'pet' => $checkbreedingpost,
                'message' => "Pet is already posted in breeding",
            ], 200);
        }
        if ($checkage) {
            return Response([
                // 'Pet preference added',
                'pet' => $checkbreedingpost,
                'message' => "Pet must be at least 1 year old for breeding",
            ], 200);
        }

        if ($checkadopt) {
            return Response([
                // 'Pet preference added',
                'pet' => $checkage,
                'message' => "Pet is already posted in adoption",
            ], 200);
        }



        return Response([
            // 'Pet preference added',
            'pet' => $pets,
            'message' => "Pet doesnt exist",
        ], 200);
    }

    public function checkpetadoption(Request $request)
    {
        $attrs = $request->validate(
            [
                // 'sterilization' => 'nullable|string|in:Neutered,Sprayed',
                // 'vaccined'=> 'nullable|string|in:Vaccinated,Unvaccinated',
                // 'dewormed'=>'nullable|string|in:Yes,No',
                // 'petcolor'=>'required|string|', 
                // 'petage'=>'required|int|',
                // 'petbreed'=>'required|string|',  
                // 'petsize'=>'required|string|in:Small,Medium,Large', 
                // 'petgender'=>'required|string|in:Male, Female', 

                'pet_id' => 'nullable|string',

            ]
        );
        $pets = Pet::where('owner_id', auth()->user()->userID)->where('petID', (int) $attrs['pet_id'])->first();
        // foreach ($pets as $pet) {

        //     if ($pet->petname == $attrs['petname']) {
        //         return response([
        //             'messsage' => 'pet already exists'
        //         ], 401);

        //     }
        // }

        $checkage = Str::contains(Str::lower($pets->petage), Str::lower('0 years'));

        $checkbreed = Adoption::where('pet_id', $pets->petID)->first();

        $checkbreedingpost = BreedingPost::where('pet_id', $pets->petID)->first();



        if ($checkbreedingpost) {
            return Response([
                // 'Pet preference added',
                'pet' => $checkbreedingpost,
                'message' => "Pet is already posted in breeding",
            ], 200);
        }

        if ($checkbreed) {
            return Response([
                // 'Pet preference added',
                'pet' => $checkage,
                'message' => "Pet is already posted in Adoption",
            ], 200);
        }



        return Response([
            // 'Pet preference added',
            'pet' => $pets,
            'message' => "Pet doesnt exist",
        ], 200);
    }


    //register pet0
    /**
     * Summary of petregister
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function petregister(Request $request)
    {
        $attrs = $request->validate(
            [
                'petimage' => 'nullable|string',
                'petname' => 'nullable|string',
                'pettype' => 'nullable|string|',
                'petbreed' => 'nullable|string',
                'petbirthdate' => 'required|date|',
                'petgender' => 'nullable|string|in:Male,Female',
                'petsize' => 'required|string|in:Small,Medium,Large',
                'petsterilized' => 'required|string|in:Neutered,Spayed,None',
                'petvaccinated' => 'nullable|string|in:Vaccinated,Unvaccinated',
                'petdewormed' => 'nullable|string|in:Dewormed,Not Dewormed',
                'pet_eye_color' => 'nullable|string',
                'pet_color' => 'nullable|string',
                'petage' => 'nullable|string',

            ]
        );




        $image = $this->saveImage($request->image, 'petprofile');

        $pet = Pet::create([

            'petimage' => $image,
            'petname' => $attrs['petname'],
            'pettype' => $attrs['pettype'],
            'petbreed' => $attrs['petbreed'],
            'petbirthdate' => $attrs['petbirthdate'],
            'petgender' => $attrs['petgender'],
            'petsize' => $attrs['petsize'],
            'petsterilized' => $attrs['petsterilized'],
            'petvaccinated' => $attrs['petvaccinated'],
            'petdewormed' => $attrs['petdewormed'],
            'petage' => $attrs['petage'],
            'pet_eye_color' => $attrs['pet_eye_color'],
            'pet_color' => $attrs['pet_color'],
            'owner_id' => auth()->user()->userID,


        ]);


        return Response([
            'message' => 'Pet successfully added',
            'petid' => $pet->petID,
        ], 200);

    }


    public function petupdate(Request $request)
    {
        $attrs = $request->validate(
            [
                'petimage' => 'nullable|string',
                'petname' => 'nullable|string',
                'pettype' => 'nullable|string|',
                'petbreed' => 'nullable|string',
                'petbirthdate' => 'required|date|',
                'petgender' => 'nullable|string|in:Male,Female',
                'petsize' => 'required|string|in:Small,Medium,Large',
                'petsterilized' => 'required|string|in:Neutered,Spayed,None',
                'petvaccinated' => 'nullable|string|in:Vaccinated,Unvaccinated',
                'petdewormed' => 'nullable|string|in:Dewormed,Not Dewormed',
                'pet_id' => 'nullable|string',
                'petage' => 'nullable|string',
            ]
        );

        $pet = Pet::find($attrs['pet_id']);

        if ($request['petimage'] == null) {

            $pet->update([

                'petname' => $attrs['petname'],
                'pettype' => $attrs['pettype'],
                'petbreed' => $attrs['petbreed'],
                'petbirthdate' => $attrs['petbirthdate'],
                'petgender' => $attrs['petgender'],
                'petsize' => $attrs['petsize'],
                'petsterilized' => $attrs['petsterilized'],
                'petvaccinated' => $attrs['petvaccinated'],
                'petdewormed' => $attrs['petdewormed'],
                'owner_id' => auth()->user()->userID,
                'petage' => $attrs['petage'],

            ]);
        } else {
            $image = $this->saveImage($request->petimage, 'petprofile');
            $pet->update([
                'petimage' => $image,
                'petname' => $attrs['petname'],
                'pettype' => $attrs['pettype'],
                'petbreed' => $attrs['petbreed'],
                'petbirthdate' => $attrs['petbirthdate'],
                'petgender' => $attrs['petgender'],
                'petsize' => $attrs['petsize'],
                'petsterilized' => $attrs['petsterilized'],
                'petvaccinated' => $attrs['petvaccinated'],
                'petdewormed' => $attrs['petdewormed'],
                'owner_id' => auth()->user()->userID,
                'petage' => $attrs['petage'],


            ]);

        }

        return Response([
            // 'Pet successfully added',
            'message' => 'Pet updated.',
            'pet' => $pet,
        ], 200);

    }

    // public function updatepet(Request $request)
//      {
//          $attrs = $request->validate([
//              'petname' => 'required|string',
//              'petvaccinated' =>  'required|string|in:Vacinated, Unvaccinated',
//              'petdewormed' =>  'required|string|in:Dewormed, NotDewormed',


    //          ]);

    //          if($request['image']==null){
//             auth()->user()->update([
//                 'petname' => $attrs['petname'],
//                 'petvaccinated' => $attrs['petvaccinated'],
//                 'petdewormed' => $attrs['petdewormed'],

    //             ]);

    //          }
//          else{
//             $image = $this->saveImage($request->image, 'profiles');
//             auth()->user()->update([
//                 'petname' => $attrs['petname'],
//                 'petvaccinated' => $attrs['petvaccinated'],
//                 'petdewormed' => $attrs['petdewormed'],
//                 'image' => $image,

    //             ]);
//          }


    //          return response([
//              'message' => 'User updated.',
//              'user' => auth()->user()
//          ], 200);
//      }


    //petpreference
    /**
     * Summary of petprefinput
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function petpreferenceinput(Request $request)
    {
        $attrs = $request->validate(
            [
                // 'sterilization' => 'nullable|string|in:Neutered,Sprayed',
                // 'vaccined'=> 'nullable|string|in:Vaccinated,Unvaccinated',
                // 'dewormed'=>'nullable|string|in:Yes,No',
                // 'petcolor'=>'required|string|', 
                // 'petage'=>'required|int|',
                // 'petbreed'=>'required|string|',  
                // 'petsize'=>'required|string|in:Small,Medium,Large', 
                // 'petgender'=>'required|string|in:Male, Female', 

                'vaccined' => 'nullable|string',
                'dewormed' => 'nullable|string',
                'petcolor' => 'nullable|string',
                'peteyecolor' => 'nullable|string',
                'petage' => 'nullable|string',
                'petbreed' => 'nullable|string',
                'petsize' => 'nullable|string',
                'petgender' => 'nullable|string',
                'pettype' => 'nullable|string',


            ]
        );
        $preference = Petpreference::create([


            'vaccined' => $attrs['vaccined'],
            'dewormed' => $attrs['dewormed'],
            'petcolor' => $attrs['petcolor'],
            'peteyecolor' => $attrs['peteyecolor'],
            'petage' => $attrs['petage'],
            'petbreed' => $attrs['petbreed'],
            'petsize' => $attrs['petsize'],
            'petgender' => $attrs['petgender'],
            'pettype' => $attrs['pettype'],
            'owner_id' => auth()->user()->userID,

        ]);
        return Response([
            // 'Pet preference added',
            'preference' => $preference,
            'message' => "Preference Added",
        ], 200);
    }


    // public function checkpetadd(Request $request)
    // {
    //     $attrs = $request->validate(
    //         [
    //             // 'sterilization' => 'nullable|string|in:Neutered,Sprayed',
    //             // 'vaccined'=> 'nullable|string|in:Vaccinated,Unvaccinated',
    //             // 'dewormed'=>'nullable|string|in:Yes,No',
    //             // 'petcolor'=>'required|string|', 
    //             // 'petage'=>'required|int|',
    //             // 'petbreed'=>'required|string|',  
    //             // 'petsize'=>'required|string|in:Small,Medium,Large', 
    //             // 'petgender'=>'required|string|in:Male, Female', 

    //             'petname' => 'nullable|string',



    //         ]
    //     );
    //     $pets = Pet::where('owner_id', auth()->user()->userID)->get();
    //     foreach ($pets as $pet) {

    //         if ($pet->petname == $attrs['petname']) {
    //             return response([
    //                 'messsage' => 'pet already exists'
    //             ], 200);

    //         }
    //     }


    //     return Response([
    //         // 'Pet preference added',
    //         'pet' => $pets,
    //         'message' => "Pet doesnt exist",
    //     ], 200);
    // }

    // public function checkpetbreed(Request $request)
    // {
    //     $attrs = $request->validate(
    //         [
    //             // 'sterilization' => 'nullable|string|in:Neutered,Sprayed',
    //             // 'vaccined'=> 'nullable|string|in:Vaccinated,Unvaccinated',
    //             // 'dewormed'=>'nullable|string|in:Yes,No',
    //             // 'petcolor'=>'required|string|', 
    //             // 'petage'=>'required|int|',
    //             // 'petbreed'=>'required|string|',  
    //             // 'petsize'=>'required|string|in:Small,Medium,Large', 
    //             // 'petgender'=>'required|string|in:Male, Female', 

    //             'pet_id' => 'nullable|string',

    //         ]
    //     );
    //     $pets = Pet::where('owner_id', auth()->user()->userID)->where('petID', (int) $attrs['pet_id'])->first();
    //     // foreach ($pets as $pet) {

    //     //     if ($pet->petname == $attrs['petname']) {
    //     //         return response([
    //     //             'messsage' => 'pet already exists'
    //     //         ], 401);

    //     //     }
    //     // }

    //     $checkage = Str::contains(Str::lower($pets->petage), Str::lower('0 years'));

    //     $checkadopt = Adoption::where('pet_id', $pets->petID)->first();

    //     if ($checkage) {
    //         return Response([
    //             // 'Pet preference added',
    //             'pet' => $checkage,
    //             'message' => "Pet must be at least 1 year old for breeding",
    //         ], 200);
    //     }

    //     if ($checkadopt) {
    //         return Response([
    //             // 'Pet preference added',
    //             'pet' => $checkage,
    //             'message' => "Pet is already posted in adoption",
    //         ], 200);
    //     }



    //     return Response([
    //         // 'Pet preference added',
    //         'pet' => $pets,
    //         'message' => "Pet doesnt exist",
    //     ], 200);
    // }

    // public function checkpetadoption(Request $request)
    // {
    //     $attrs = $request->validate(
    //         [
    //             // 'sterilization' => 'nullable|string|in:Neutered,Sprayed',
    //             // 'vaccined'=> 'nullable|string|in:Vaccinated,Unvaccinated',
    //             // 'dewormed'=>'nullable|string|in:Yes,No',
    //             // 'petcolor'=>'required|string|', 
    //             // 'petage'=>'required|int|',
    //             // 'petbreed'=>'required|string|',  
    //             // 'petsize'=>'required|string|in:Small,Medium,Large', 
    //             // 'petgender'=>'required|string|in:Male, Female', 

    //             'pet_id' => 'nullable|string',

    //         ]
    //     );
    //     $pets = Pet::where('owner_id', auth()->user()->userID)->where('petID', (int) $attrs['pet_id'])->first();
    //     // foreach ($pets as $pet) {

    //     //     if ($pet->petname == $attrs['petname']) {
    //     //         return response([
    //     //             'messsage' => 'pet already exists'
    //     //         ], 401);

    //     //     }
    //     // }

    //     $checkage = Str::contains(Str::lower($pets->petage), Str::lower('0 years'));

    //     $checkbreed = Adoption::where('pet_id', $pets->petID)->first();


    //     if ($checkbreed) {
    //         return Response([
    //             // 'Pet preference added',
    //             'pet' => $checkage,
    //             'message' => "Pet is already posted in Adoption",
    //         ], 200);
    //     }



    //     return Response([
    //         // 'Pet preference added',
    //         'pet' => $pets,
    //         'message' => "Pet doesnt exist",
    //     ], 200);
    // }




    public function petpreferenceedit(Request $request)
    {
        $attrs = $request->validate(
            [
                // 'sterilization' => 'nullable|string|in:Neutered,Sprayed',
                // 'vaccined'=> 'nullable|string|in:Vaccinated,Unvaccinated',
                // 'dewormed'=>'nullable|string|in:Yes,No',
                // 'petcolor'=>'required|string|', 
                // 'petage'=>'required|int|',
                // 'petbreed'=>'required|string|',  
                // 'petsize'=>'required|string|in:Small,Medium,Large', 
                // 'petgender'=>'required|string|in:Male, Female', 

                'petpref_id' => 'nullable|string',
                'vaccined' => 'nullable|string',
                'dewormed' => 'nullable|string',
                'petcolor' => 'nullable|string',
                'peteyecolor' => 'nullable|string',
                'petage' => 'nullable|string',
                'petbreed' => 'nullable|string',
                'petsize' => 'nullable|string',
                'petgender' => 'nullable|string',


            ]
        );

        $preference = Petpreference::where('owner_id', auth()->user()->userID)->first();

        $preference->update([

            'vaccined' => $attrs['vaccined'],
            'dewormed' => $attrs['dewormed'],
            'petcolor' => $attrs['petcolor'],
            'peteyecolor' => $attrs['peteyecolor'],
            'petage' => $attrs['petage'],
            'petbreed' => $attrs['petbreed'],
            'petsize' => $attrs['petsize'],
            'petgender' => $attrs['petgender'],

        ]);


        return Response([
            'message' => 'Updating preference Success!',
            'preference' => $preference,


        ], 200);
    }

    public function getpreferences()
    {
        // $preferid =(String) Petpreference::select("petpreferID")->where('owner_id', auth()->user()->userID)->get();
        return Response([
            'preference' => Petpreference::select("pettype", "petpreferID", "vaccined", "dewormed", "petcolor", "petage", "petbreed", "petsize", "petgender", "created_at", "updated_at", "peteyecolor", "owner_id")->where('owner_id', auth()->user()->userID)
                // ->with('user:userID')
                ->get(),
        ], 200);
    }


    /**
     * Summary of getpet
     * @return mixed
     */
    public function getallpet()
    {
        return Response([
            'pet' => Pet::select("petID", "petimage", "petname", "pettype", "petbreed", "petbirthdate", "petgender", "petsize", "petsterilized", "petvaccinated", "petdewormed", "petage", "created_at", "updated_at", "owner_id", "old_owner_id")->where('owner_id', auth()->user()->userID)->get()
        ], 200);
    }

    // //unused
    // public function petsWithUser()
    // {
    //     $owner_id = auth()->user()->id;
    //     $users = User::with('pet')->get();
    //     $pets = Pet::with('user')->get();

    //     return Pet::rightJoin('pets', function ($join) use ($owner_id) {
    //         $join->on('pets.owner_id', '=', 'users.id')
    //             ->where('pets.owner_id', '=', $owner_id);
    //     })->get();
    // }

    public function updatePet(Request $request)
    {
        // $attrs = $request->validate([
        //     'name' => 'required|string',
        //     'lastname' => 'required|string',
        //     'address' => 'required|string',
        //     'age' => 'required|string',
        //     'bio' => 'nullable|string',

        // ]);

        // if ($request['image'] == null) {
        //     auth()->user()->update([
        //         'name' => $attrs['name'],
        //         'lastname' => $attrs['lastname'],
        //         'bio' => $attrs['bio'],
        //         'age' => $attrs['age'],
        //         'address' => $attrs['address'],
        //     ]);

        // } else {
        //     $image = $this->saveImage($request->image, 'profiles');
        //     auth()->user()->update([
        //         'name' => $attrs['name'],
        //         'image' => $image,
        //         'lastname' => $attrs['lastname'],
        //         'bio' => $attrs['bio'],
        //         'age' => $attrs['age'],
        //         'address' => $attrs['address'],
        //     ]);
        // }


        return response([
            'message' => 'User updated.',
            'user' => auth()->user()
        ], 200);


    }


    public function getSpecificPet($id)
    {
        return Response([
            'pet' => Pet::select("petID", "petimage", "petname", "pettype", "petbreed", "petbirthdate", "petgender", "petsize", "petsterilized", "petvaccinated", "petdewormed")->where('petID', $id)->first()
        ], 200);
    }
    public function getcredentials($id)
    {
        return Response([
            'petcredentials' => Petcredentialtype::select(
                'id',
                'owner_id',
                'pet_id',
                'cred_type'
            )->where('pet_id', $id)->get()
        ], 200);
    }

    public function getcredential_img($id)
    {
        return Response([
            'petcredential_images' => Petcredentialimages::select(
                'id',
                'owner_id',
                'pet_id',
                'image_path'
            )->where('pet_id', $id)->get()
        ], 200);
    }

    // return Response([
    //     'pet'=> Pet::select("petname", )->where('owner_id', auth()->user()->id)->get()
    // ],200);


    public function getpetforupdate($id)
    {
        return Response([
            'pet' => Pet::select("petID", "petimage", "petname", "pettype", "petbreed", "petbirthdate", "petgender", "petsize", "petsterilized", "petvaccinated", "petdewormed", )->where('petID', (int) $id)->first()
        ], 200);
    }


    public function viewpetprofile()
    {

        return Response([
            //'pet'=> Pet::all()->where('owner_id', auth()->user()->id)
            'pet' => Pet::select("petID", "petimage", "petname", "pettype", "petbreed", "petbirthdate", "petgender", "petsize", "petsterilized", "petvaccinated", "petdewormed", "petage")->where('owner_id', auth()->user()->id)->get()

        ], 200);
    }

    public function delete($id)
    {
        $pet = Pet::find($id);

        if (!$pet) {
            return response([
                'message' => 'Post not found.'
            ], 403);
        }

        // if($pet->user_id != auth()->user()->id)
        // {
        //     return response([
        //         'message' => 'Permission denied.'
        //     ], 403);
        // }

        $pet->delete();

        return response([
            'message' => 'Pet deleted.'
        ], 200);
    }

}

