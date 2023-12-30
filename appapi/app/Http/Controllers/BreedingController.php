<?php

namespace App\Http\Controllers;

use App\Models\Petpreference;
use Illuminate\Http\Request;
use App\Models\BreedingPost;
use App\Models\Agreement;
use App\Models\Pet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Str;

class BreedingController extends Controller
{

    //cats matching algo

    public function matchingalgo(Request $request)
    {
        $pettype = $request->pettype;
        $userid = auth()->user()->id;

        $getpreference = Petpreference::where("owner_id", auth()->user()->userID)->get();

        $getpets = Pet::wherenot("owner_id", auth()->user()->id)->get();


        $getCats = DB::table('pets')
            ->rightJoin('breeding_posts', 'breeding_posts.pet_id', '=', 'pets.petID')
            ->where('pets.pettype', $pettype)
            ->wherenot('breeding_posts.owner_id', auth()->user()->userID)
            ->rightJoin('users', 'users.userID', '=', 'breeding_posts.owner_id')
            ->orderBy('breeding_posts.created_at', 'desc')
            ->get();
        $totalpreference = 0;

        $preferencepettype = '';
        $preferencepetbreed = '';
        $preferencepetgender = '';
        $preferencepetvaccined = '';
        $preferencedewormed = '';
        $preferencesterilization = '';
        $preferencepetsize = '';
        $preferencepeteyecolor = '';
        $preferencepetcolor = '';
        $preferencepetage = '';

        foreach ($getCats as $pets) {
            $matchscore = 0;

            $totalpreference = 0;
            foreach ($getpreference as $preference) {


                if ($preference->pettype) {
                    $totalpreference++;

                    //compare (preference, pet)
                    $preferencepettype = Str::contains(Str::lower($preference->pettype), Str::lower($pets->pettype));
                    if ($preferencepettype) {
                        $matchscore += 10;
                    } else {
                        $matchscore -= 10;
                    }
                }
                if ($preference->petbreed) {
                    $totalpreference++;

                    $preferencepetbreed = Str::contains(Str::lower($preference->petbreed), Str::lower($pets->petbreed));

                    if ($preferencepetbreed) {
                        $matchscore += 10;
                    } else {
                        $matchscore -= 10;
                    }
                } else {
                    //if field is null
                }

                if ($preference->petgender) {
                    $totalpreference++;

                    $preferencepetgender = Str::contains(Str::lower($preference->petgender), Str::lower($pets->petgender));

                    if ($preferencepetgender) {
                        $matchscore += 10;
                    } else {
                        $matchscore -= 10;
                    }
                }
                if ($preference->vaccined) {
                    $totalpreference++;

                    $preferencepetvaccined = Str::contains(Str::lower($preference->vaccined), Str::lower($pets->petvaccinated));

                    if (strtolower($pets->petvaccinated) == strtolower($preference->vaccined)) {
                        $matchscore += 10;
                    } else {
                        $matchscore -= 10;
                    }
                }
                if ($preference->dewormed) {
                    $totalpreference++;

                    $preferencedewormed = Str::contains(Str::lower($preference->dewormed), Str::lower($pets->petdewormed));

                    if ($preferencedewormed) {
                        $matchscore += 10;
                    } else {
                        $matchscore -= 10;
                    }
                }
                if ($preference->sterilization) {
                    $totalpreference++;

                    $preferencesterilization = Str::contains(Str::lower($preference->sterilization), Str::lower($pets->petsterilized));

                    if ($preferencesterilization) {
                        $matchscore += 10;
                    } else {
                        $matchscore -= 10;
                    }
                }
                if ($preference->petsize) {
                    $totalpreference++;

                    $preferencepetsize = Str::contains(Str::lower($preference->petsize), Str::lower($pets->petsize));
                    if ($preferencepetsize) {
                        $matchscore += 10;
                    } else {
                        $matchscore -= 10;
                    }
                }
                if ($preference->peteyecolor) {
                    $totalpreference++;

                    $preferencepeteyecolor = Str::contains(Str::lower($preference->peteyecolor), Str::lower($pets->pet_eye_color));


                    if ($preferencepeteyecolor) {
                        $matchscore += 10;
                    } else {
                        $matchscore -= 10;
                    }
                }
                if ($preference->petcolor) {
                    $totalpreference++;

                    $preferencepetcolor = Str::contains(Str::lower($preference->petcolor), Str::lower($pets->pet_color));

                    if ($preferencepetcolor) {
                        $matchscore += 10;
                    } else {
                        $matchscore -= 10;
                    }
                }
                if ($preference->petage) {
                    $totalpreference++;

                    $preferencepetage = Str::contains(Str::lower($preference->petage), Str::lower($pets->petage));

                    if ($preferencepetage) {
                        $matchscore += 10;
                    } else {
                        $matchscore -= 10;
                    }
                }
            }
            $pets->score = $matchscore;
        }
        $totalmatchpoint = $totalpreference * 10;
        $matchthreshold = $totalmatchpoint * .50;

        // /->where('score', '>',  $matchthreshold )
        $rankedmatches = $getCats->where('score', '>', $matchthreshold)->sortByDesc('score')->values()->toArray();
        $undermatches = $getCats->where('score', '<', $matchthreshold)->sortByDesc('score')->values()->toArray();
        // usort($getpets, function ($a, $b) {
        //     return $b->score - $a->score;
        // });

        $combined = array_merge($rankedmatches, $undermatches);

        $comb = [


            'breed' => $rankedmatches,
            //  'recommend' => $undermatches



        ];

        $getpets->sortBy('score');
        return response([
            'totalpreference' => $totalpreference,
            "threshold" => $matchthreshold,
            // 'algo' => $comb
            'breed' => $rankedmatches,
            'recommend' => $undermatches
        ], 200);


    }



    public function breedingPost(Request $request, )
    {
        $attrs = $request->validate(
            [

                //'breed_status' => 'nullable|string',
                // 'recipient_id' => 'nullable|string',
                'pet_id' => 'nullable|string',

            ]
        );



        $breed = BreedingPost::create([

            'breed_status' => 'Pending',
            // 'recipient_id' => $attrs['recipient_id'],
            'owner_id' => auth()->user()->userID,
            'pet_id' => (int) $attrs['pet_id'],

        ]);

        return Response([
            'message' => 'Posted in Breeding Success',
            'breed' => $breed,

        ], 200);

    }

    //get all breeding post
    public function getBreeding()
    {
        return response([
            'breed' => BreedingPost::orderBy('created_at', 'desc')->with('owner:userID,firstname, lastname,image')->with('pet:petID,petname,petimage,petbreed,pettype,petgender,petbirthdate,petsize,petage,petsterilized,petvaccinated,petdewormed')->get()
        ], 200);
    }

    //get all cats breeding
    public function getCatsBreeding()
    {
        $Cat = "Cat";

        $getCats = DB::table('pets')
            ->rightJoin('breeding_posts', 'breeding_posts.pet_id', '=', 'pets.petID')
            ->where('pets.pettype', $Cat)
            ->wherenot('breeding_posts.owner_id', auth()->user()->userID)
            ->rightJoin('users', 'users.userID', '=', 'breeding_posts.owner_id')
            ->orderBy('breeding_posts.created_at', 'desc')
            ->get();


        return Response([
            'breed' => $getCats
        ], 200);
    }

    //DOG BREEDING
    public function getDogsBreeding()
    {
        $Dog = "Dog";

        $getDogs = DB::table('pets')
            ->rightJoin('breeding_posts', 'breeding_posts.pet_id', '=', 'pets.petID')
            ->where('pets.pettype', $Dog)
            ->orderBy('breeding_posts.created_at', 'desc')
            ->get();


        return Response([
            'breed' => $getDogs,


        ], 200);
    }


    //delete breeding post
    public function deleteBreedPost($id)
    {
        $post = BreedingPost::find($id);

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
    //get all User's Breeding Posts
    public function getBreedingPosts()
    {
        return Response([
            'breed' => BreedingPost::orderBy('created_at', 'desc')->with('owner:userID,firstname,lastname,image')->with('pet:petID,petname,petimage,petbreed,pettype,petgender,petbirthdate,petsize,petage,petsterilized,petvaccinated,petdewormed')->where('owner_id', auth()->user()->userID)->get()
        ], 200);
    }


    //search
    public function searchbreed($petname)
    {
        $searchbreed = $petname;

        $result = DB::table('breeding_posts')
            ->rightJoin('pets', 'breeding_posts.pet_id', '=', 'pets.petID')
            ->rightJoin('users', 'breeding_posts.owner_id', '=', 'users.userID')
            ->where(function ($query) use ($searchbreed) {
                $query->where('pets.petname', 'like', '%' . $searchbreed . '%')
                    ->orWhere('pets.pettype', 'like', '%' . $searchbreed . '%')
                    ->orWhere('pets.petgender', 'like', '%' . $searchbreed . '%')
                    ->orWhere('pets.petsize', 'like', '%' . $searchbreed . '%')
                    ->orWhere('users.firstname', 'like', '%' . $searchbreed . '%')
                    ->orWhere('pets.petbreed', 'like', '%' . $searchbreed . '%');
            })
            ->orderBy('breeding_posts.created_at', 'desc')
            ->get();

        return response(['breed' => $result], 200);
        //return view (index,compact('result','search'));
    }

    //breeding agreement
//  public function breedingAgreement(Request $request)
//  {

    //      $attrs = $request->validate(
//          [
//              'requester_id' => 'nullable|string',
//              'breeding_id' => 'nullable|string',
//              'pet_id' => 'nullable|string|',
//              'breeding_status' => 'Pending',
//              'recipient_id' => 'nullable|string|',  
//          ]
//      );

    //      $breedagreement = Agreement::create([

    //          'requester_id' => (int) $attrs['requester_id'],
//          'requester_id' => auth()->user()->id,
//          'pet_id' => (int) $attrs['pet_id'],
//          'breeding_status' => 'Pending',
//          'recipient_id' => (int) $attrs['recipient_id'],
//      ]);

    //      return Response([
//          'breedagreement' => $breedagreement,
//      ], 200);
//  }

    //  //view all the list of agreements
//  public function viewAgreements()
//  {
//      return response([
//         // 'breedagreement' => Agreement::orderBy('created_at', 'desc')->with('user:id,name,image,email')->with('userowner:id,name,image,email')->with('pet:id,petname,image,petbreed')->where('breeding_status', 'Accepted')->where('requester_id', auth()->user()->id)->get()
//          'breedagreement' => Agreement::orderBy('created_at', 'desc')->with('requester:id,name')->with('recipient:id,name')->with('requesterpet:id,pettype,petbreed')->with('recipientpet:id,pettype,petbreed')->where('breeding_status', 'Accepted')->get()
//      ], 200);
//  }

    //  public function completeAgreements(Request $request)
//     {
//         $validator = Validator::make($request->all(), [
//             'id' => 'required',
//             'recipient_id' => 'required',
//             'pet_id' => 'required'
//         ]);

    //         if ($validator->fails()) {
//             return response()->json([
//                 'message' => 'Validations fails',
//                 'errors' => $validator->errors()
//             ], 422);
//         }

    //         $user = $request->user();

    //         $adoptionrequest = Adoptionrequest::where('id', $request->id)->first();

    //         $adoptionrequest->update([
//             'adoption_req_status' => 'Complete',

    //         ]);

    //         $adoption = Adoption::where('id', $request->adoption_id)->first();
//         $adoption->update([
//             'old_owner_id' => $request->owner_id,
//         ]);

    //         $pet = Pet::where('id', $request->pet_id)->first();
//         $pet->update([
//             'owner_id' => auth()->user()->id,
//         ]);


    //         return response()->json([
//             'message' => 'Transfered succesfully',
//             'adoptionreq' => $adoptionrequest,
//             // 'adoption' => $adoption,
//             // 'pet' => $pet
//         ], 200);

}