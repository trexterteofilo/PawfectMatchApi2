<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\Adoptionrequest;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent;
use Illuminate\View\View;

class AdoptionController extends Controller
{

    public function adoptionPost(Request $request, )
    {
        $attrs = $request->validate(
            [
                'adopt_desc' => 'nullable|string',
                //'adopt_date' => 'nullable|string',
                'adopt_payment' => 'nullable|string|',
                //'adopt_status' => 'nullable|string',
                // 'adopter' => 'nullable|date',
                // 'old_owner_id' => 'nullable|string|',
                'monthsowned' => 'nullable|string|',
                'pet_id' => 'nullable|string',

            ]
        );

        //  $image = $this->saveImage($request->image, 'petprofile');
        if ($request->adopt_payment != null) {
            $adopt = Adoption::create([

                'adopt_desc' => $attrs['adopt_desc'],
                //  'adopt_date' => $attrs['adopt_date'],
                'adopt_payment' => $attrs['adopt_payment'],
                'monthsowned' => $attrs['monthsowned'],

                // 'adopt_status' => $attrs['adopt_status'],
                // 'adopter' => $attrs['adopter'],
                // 'old_owner_id' => $attrs['old_owner_id'],
                'owner_id' => auth()->user()->userID,
                'pet_id' => (int) $attrs['pet_id'],
                'adopt_status' => 'Pending',

            ]);
        } else {
            $adopt = Adoption::create([

                'adopt_desc' => $attrs['adopt_desc'],
                //  'adopt_date' => $attrs['adopt_date'],
                'adopt_payment' => 'FREE',
                'monthsowned' => $attrs['monthsowned'],

                // 'adopt_status' => $attrs['adopt_status'],
                // 'adopter' => $attrs['adopter'],
                // 'old_owner_id' => $attrs['old_owner_id'],
                'owner_id' => auth()->user()->userID,
                'pet_id' => (int) $attrs['pet_id'],
                'adopt_status' => 'Pending',

            ]);
        }

        return Response([
            // 'Pet successfully added',
            'adopt' => $adopt,
        ], 200);

    }


    // public function updatePetID(Request $request){
    //     $attrs = Adoption::find($request->id);
    //     $attrs->
    // }


    // //UNSUED
    // public function getAdoptions(Request $request)
    // {
    //     // return Response([
    //     //     //'adopt' => Adoption::select("id", "adopt_desc", "adopt_date", "adopt_payment", "adopt_status", "adopter", "old_owner_id", "owner_id", "pet_id", "created_at", "updated_at")
    //     //     'adopt' => Adoption::all()
    //     // ], 200);
    //     $pettype = $request->pettype;
    //     return response([
    //         'adopt' => Adoption::orderBy('created_at', 'desc')
    //             ->with('currentOwner:userID,firstname,image')
    //             ->with('pet:petID,petname,petimage,petbreed,pettype,petbirthdate,petage,petsize,petgender,petsterilized,petvaccinated,petdewormed')
    //             // ->
    //             // with('likes', function ($like) {
    //             //     return $like->where('user_id', auth()->user()->id)
    //             //         ->select('id', 'user_id', 'post_id')->get();
    //             // })   
    //             ->get()
    //     ], 200);
    // }

    //get all adoptions
    public function getAllAdoptions(Request $request)
    {


        $pettype = $request->pettype;


        // $catId = Pet::select('petname', 'id')->where('pettype', $Cat)->get();
        // // $cattype = Pet::select('id', 'petname', 'pettype')->where('pettype', $Cat)->with('adoption:id, pet_id')-> where()->get();

        // $catsadopt = Adoption::orderBy('created_at', 'desc')->with('user:id,name,image')->with('pet', function ($pets) {
        //     return $pets->where('pettype', "Cat")->select('id', 'petname', 'pettype');

        // })->where('pet_id', $catId->id)->get();




        // $petadopt = Adoption::pet()->where('pet_id', 'Cat');


        // return response([
        //     'adopt' => Adoption::orderBy('created_at', 'desc')->with('user:id,name,image')->with('pet', function ($pets) {
        //         return $pets->where('pettype', "Cat")->select('id', 'petname', 'pettype');
        //     })->wherehas('pet')->get()


        //     // Adoption::orderBy('created_at', 'desc')->with('user:id,name,image')->where('pet_id', function ($pets) {
        //     //     return $pets->where('pet_id', );

        //     // })->where($catClass->)->get(),
        // ], 200);



        //WORKS 
        $getAdoptions = DB::table('pets')
            ->rightJoin('adoptions', 'adoptions.pet_id', '=', 'pets.petID')
            ->where('pets.pettype', $pettype)
            ->whereNot('adoptions.owner_id', auth()->user()->userID)
            ->orderBy('adoptions.created_at', 'desc')
            ->get();

        // //3rd TRY
        // //$getCats = DB::table('pets')->join('adoptions', 'pets.adoption_id', '=', 'adoptions.id', 'full outer');

        // //2nd TRY  
        // // $getCats = Adoption::Join('pets', 'adoptions.id', 'pets.adoption_id')
        // //     ->select("adopt_desc", "adopt_date", "adopt_payment", "adopt_status", "adopter", "pet_id")
        // //     // ->orderBy('created_at', 'desc')
        // //     ->with('user:id,name,image')
        // //     ->with('pet:id,petname,image,pettype')
        // //     ->where('pets.pettype', $Cat)
        // //     ->get();

        // //retuirn repsonse real
        return Response([
            'adopt' => $getAdoptions


            //1st TRY
            // 'adopt' => Adoption::with('pet.adopt')->whereRelation('adopt', 'adoption_id')->where('pettype', $Cat)->get()
        ], 200);

        //NOT RIGHT
        // $adopt = Adoption::with('pet')->get();
        // $pets = Pet::with('adopt')->get();

        // return Adoption::rightJoin('adopt', function ($join) use ($pettype) {
        //     $join->on('adopt.pet_id', '=', 'pet.id')
        //         ->where('pet.pettype', '=', $pettype);
        // })->get();
    }

    //SEARCH
    public function searchadopt($petname)
    {
        $searchadopt = $petname;

        $result = DB::table('adoptions')
            ->rightJoin('pets', 'adoptions.pet_id', '=', 'pets.petID')
            ->rightJoin('users', 'adoptions.owner_id', '=', 'users.userID')
            ->where(function ($query) use ($searchadopt) {
                $query->where('pets.petname', 'like', '%' . $searchadopt . '%')
                    ->orWhere('pets.pettype', 'like', '%' . $searchadopt . '%')
                    ->orWhere('pets.petgender', 'like', '%' . $searchadopt . '%')
                    ->orWhere('pets.petsize', 'like', '%' . $searchadopt . '%')
                    ->orWhere('pets.petAge', 'like', '%' . $searchadopt . '%')
                    ->orWhere('users.firstname', 'like', '%' . $searchadopt . '%')
                    ->orWhere('pets.petbreed', 'like', '%' . $searchadopt . '%');
            })
            ->orderBy('adoptions.created_at', 'desc')
            ->get();

        return response(['adopt' => $result], 200);
    }

    //EDIT ADoption Post

    public function editAdoptPost(Request $request, $id)
    {
        $post = Adoption::find($id);

        if (!$post) {
            return response([
                'message' => 'Post not found.'
            ], 403);
        }

        if ($post->owner_id != auth()->user()->userID) {
            return response([
                'message' => 'Permission denied.'
            ], 403);
        }

        //validate fields
        $attrs = $request->validate([
            'adopt_desc' => 'nullable|string',
            'adopt_payment' => 'nullable|string|',
            'monthsowned' => 'nullable|string|',

        ]);

        $post->update([
            'adopt_desc' => $attrs['adopt_desc'],
            'adopt_payment' => $attrs['adopt_payment'],
            'monthsowned' => $attrs['monthsowned'],

        ]);

        // for now skip for post image

        return response([
            'message' => 'Post updated.',
            'post' => $post
        ], 200);
    }

    //delete adoption post
    public function deleteAdoptPost($id)
    {
        $post = Adoption::find($id);

        if (!$post) {
            return response([
                'message' => 'Post not found.'
            ], 403);
        }

        if ($post->owner_id != auth()->user()->userID) {
            return response([
                'message' => 'Permission denied.'
            ], 403);
        }

        $post->delete();

        return response([
            'message' => 'Post deleted.'
        ], 200);
    }


    //get all User's Adoption Post
    public function getAdoptionPosts()
    {
        return Response([
            'owner_id' => auth()->user()->userID,
            'adopt' => Adoption::orderBy('created_at', 'desc')->with('currentOwner:userID,firstname,image')->with('pet:petID,petname,petimage,petbreed,pettype,petbirthdate,petage,petsize,petgender,petsterilized,petvaccinated,petdewormed')->where('owner_id', auth()->user()->userID)->get()
        ], 200);
    }

    //SEARCH
    // public function searchadopt($petname)
    // {
    //     $searchadopt = $petname;

    //     $result = DB::table('adoptions')
    //         ->rightJoin('pets', 'adoptions.pet_id', '=', 'pets.petID')
    //         ->rightJoin('users', 'adoptions.owner_id', '=', 'users.userID')
    //         ->where(function ($query) use ($searchadopt) {
    //             $query->where('pets.petname', 'like', '%' . $searchadopt . '%')
    //                 ->orWhere('pets.pettype', 'like', '%' . $searchadopt . '%')
    //                 ->orWhere('pets.petgender', 'like', '%' . $searchadopt . '%')
    //                 ->orWhere('pets.petsize', 'like', '%' . $searchadopt . '%')
    //                 ->orWhere('pets.petAge', 'like', '%' . $searchadopt . '%')
    //                 ->orWhere('users.firstname', 'like', '%' . $searchadopt . '%')
    //                 ->orWhere('pets.petbreed', 'like', '%' . $searchadopt . '%');
    //         })
    //         ->orderBy('adoptions.created_at', 'desc')
    //         ->get();

    //     return response(['adopt' => $result], 200);
    // }













    //========================= for adoption requests

    //adoption request
    public function requestAdoption(Request $request)
    {

        $attrs = $request->validate(
            [
                'owner_id' => 'nullable|string',
                'adoption_id' => 'nullable|string',
                'pet_id' => 'nullable|string|',
                // 'adoption_req_status' => 'nullable|string|',
                'pickup_date' => 'nullable|string|',
                'old_owner_id' => 'nullable|string|',

                //'adopt_status' => 'nullable|string',
                // 'adopter' => 'nullable|date',
                // 'old_owner_id' => 'nullable|string|',


            ]
        );

        //  $image = $this->saveImage($request->image, 'petprofile');

        $adoptreq = Adoptionrequest::create([

            'owner_id' => (int) $attrs['owner_id'],
            'adoption_id' => (int) $attrs['adoption_id'],
            'requester_id' => auth()->user()->userID,
            'pet_id' => (int) $attrs['pet_id'],
            'adoption_req_status' => 'Pending',
            //$attrs['adoption_req_status'],
            'pickup_date' => $attrs['pickup_date'],
            'old_owner_id' => (int) $attrs['old_owner_id'],
        ]);

        return Response([
            // 'Pet successfully added',
            // 'message' => 'Adoption request sent Successfully',
            'adoptrequest' => $adoptreq,
        ], 200);
    }


    //check if user already sent request
    public function checkAdoptionRequest($id)
    {
        $userid = auth()->user()->userID;

        //variable for adoption id 
        $adoptionpost = Adoption::find($id);

        // $adoptionrequestpost = Adoptionrequest::where($adoptionpost->id, adoption->adoption_id);

        //$adoptionrequest = Adoptionrequest::where(adoptionpost->id ==  )
        return response([
            // 'adoptrequest' =>Adoptionrequest::where($adoptionpost, 'adoption:id'),
            'value' => Adoptionrequest::with('user:userID,firstname,image,email')->with('adoption:adoptID,adopt_desc')->with('userowner:userID,firstname,image,email')->with('pet:petID,petname,petimage')->where('requester_id', auth()->user()->userID)->where('adoption_id', $id)->where('adoption_req_status', 'Pending')->get()


        ], 200);



    }
    //getpetadoptionprofile

    public function getpetadoptionprofile($id)
    {
        $adoptionpost = Adoption::select('adoptID', 'adopt_desc', 'adopt_date', 'adopt_payment', "adopt_status", "adopter", "old_owner_id", "owner_id", "pet_id")->where('adoptID', $id)->with('currentOwner:userID,firstname,image')->with('pet:petID,petname,petimage')->get();

        return response([
            'adoption' => $adoptionpost

        ]);

    }


    //get all requestionAdoption
    public function getrequestAdoptionList()
    {
        return response([
            'adoptionrequest' => Adoptionrequest::orderBy('created_at', 'desc')->with('user:userID,firstname,image')->with('adoption:adoptID,adopt_desc')->with('userowner:userID,firstname,image')->with('pet:petID,petname,petimage')->get()
        ], 200);


    }
    //all users adoption request
    public function getmytrequestAdoptionList()
    {
        return response([
            'adoptionrequest' => Adoptionrequest::orderBy('created_at', 'desc')->with('user:userID,firstname,lastname,image,email')->with('adoption:adoptID,adopt_desc')->with('userowner:userID,firstname,lastname,image,email')->with('pet:petID,petname,petimage,petbreed')->where('adoption_req_status', 'Pending')->where('requester_id', auth()->user()->userID)->get()
        ], 200);

    }
    //getpetadoptionprofile

    public function canceladoptionrequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validations fails',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        $cancelledby = auth()->user()->firstname . ' ' . auth()->user()->lastname;

        $adoptionrequest = Adoptionrequest::where('adoptreqID', $request->id)->first();

        $adoptionrequest->update([
            'adoption_req_status' => 'Cancelled',
            'cancelled_by' => $cancelledby

        ]);
        return response()->json([
            'message' => 'Cancelled succesfully',
            'adoptionreq' => $adoptionrequest,
            'cancelled_by' => $cancelledby
        ], 200);



    }

    //view incoming adoption requests;


    public function viewincomingadoptionreq()
    {


        return response([
            // 'adoptionrequest' => Adoptionrequest::orderBy('created_at', 'desc')->with('user:id,name,image,email')->with('adoption:id,adopt_desc')->with('userowner:id,name,image,email')->with('pet:id,petname,image,petbreed')->where('adoption_req_status', 'Pending')->where('requester_id', auth()->user()->id)->get()

            'adoptionrequest' => Adoptionrequest::orderBy('created_at', 'desc')->with('user:userID,firstname,lastname,image,email')->with('adoption:adoptID,adopt_desc')->with('userowner:userID,firstname,lastname,image,email')->with('pet:petID,petname,petimage,petbreed')->where('adoption_req_status', 'Pending')->where('owner_id', auth()->user()->userID)->get()
        ], 200);

    }

    //view incoming adoption requests;
    public function viewacceptedadoptionreq()
    {
        return response([
            // 'adoptionrequest' => Adoptionrequest::orderBy('created_at', 'desc')->with('user:id,name,image,email')->with('adoption:id,adopt_desc')->with('userowner:id,name,image,email')->with('pet:id,petname,image,petbreed')->where('adoption_req_status', 'Pending')->where('requester_id', auth()->user()->id)->get()

            'adoptionrequest' => Adoptionrequest::orderBy('created_at', 'desc')->with('user:userID,firstname,lastname,image,email')->with('adoption:adoptID,adopt_desc')->with('userowner:userID,firstname,lastname,image,email')->with('pet:petID,petname,petimage,petbreed,petbirthdate,petgender,petsize,pettype')->where('adoption_req_status', 'Accepted')->where('requester_id', auth()->user()->userID)->get()
        ], 200);

    }
    //view incoming adoption requests;
    public function viewcompletedadoptionreq()
    {
        return response([
            // 'adoptionrequest' => Adoptionrequest::orderBy('created_at', 'desc')->with('user:id,name,image,email')->with('adoption:id,adopt_desc')->with('userowner:id,name,image,email')->with('pet:id,petname,image,petbreed')->where('adoption_req_status', 'Pending')->where('requester_id', auth()->user()->id)->get()

            'adoptionrequest' => Adoptionrequest::orderBy('created_at', 'desc')->with('user:userID,firstname,lastname,image,email')->with('adoption:adoptID,adopt_desc')->with('userowner:userID,firstname,lastname,image,email')->with('pet:petID,petname,petimage,petbreed')->where('adoption_req_status', 'Complete')->where('requester_id', auth()->user()->userID)->orWhere('owner_id', auth()->user()->userID)->get()
        ], 200);

    }
    //view incoming adoption requests;
    public function viewcanceledadoptionreq()
    {
        return response([
            // 'adoptionrequest' => Adoptionrequest::orderBy('created_at', 'desc')->with('user:id,name,image,email')->with('adoption:id,adopt_desc')->with('userowner:id,name,image,email')->with('pet:id,petname,image,petbreed')->where('adoption_req_status', 'Pending')->where('requester_id', auth()->user()->id)->get()

            'adoptionrequest' => Adoptionrequest::orderBy('created_at', 'desc')->with('user:userID,firstname,lastname,image,email')->with('adoption:adoptID,adopt_desc')->with('userowner:userID,firstname,lastname,image,email')->with('pet:petID,petname,petimage,petbreed')->where('adoption_req_status', 'Cancelled')->where('requester_id', auth()->user()->userID)->orWhere('owner_id', auth()->user()->userID)->get()
        ], 200);

    }

    //accept adoptionrequest
    public function acceptadoptionrequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validations fails',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        $adoptionrequest = Adoptionrequest::where('adoptreqID', $request->id)->first();

        $adoptionrequest->update([
            'adoption_req_status' => 'Accepted',

        ]);
        return response()->json([
            'message' => 'Accepted succesfully',
            'adoptionreq' => $adoptionrequest
        ], 200);

    }

    //complete req and transfer pet ownership
    //ps _ is necessary

    public function completeadoption_request(Request $request)
    {

        $userID = auth()->user()->userID;
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'adoption_id' => 'required',
            'owner_id' => 'required',
            'pet_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validations fails',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        $adoptionrequest = Adoptionrequest::where('adoptreqID', $request->id)->first();

        $adoptionrequest->update([
            'adoption_req_status' => 'Complete',

        ]);

        $adoption = Adoption::where('adoptID', $request->adoption_id)->first();
        $adoption->update([
            'old_owner_id' => $request->owner_id,
            'adopt_status' => 'Completed',
            'adopter' => $userID
        ]);

        $pet = Pet::where('petID', $request->pet_id)->first();
        $pet->update([
            'owner_id' => $userID,
        ]);


        return response()->json([
            'adoptrequest' => $request->id,
            'petID' => $request->pet_id,
            'userid' => $userID,
            'message' => 'Transfered succesfully',
            'adoptionreq' => $adoptionrequest,
            'adoption' => $adoption,
            'pet' => $pet
        ], 200);

    }

}