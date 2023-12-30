<?php

namespace App\Http\Controllers;

use App\Models\AdoptionAgreement;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AdoptionAgreementController extends Controller
{
    public function createadoptionagreement(Request $request)
    {
        $attrs = $request->validate(
            [
                'date_created' => 'nullable|string',
                'adopt_id' => 'nullable|string',
                'ownerId' => 'nullable|string',
                'petId' => 'nullable|string',
                'requesterId' => 'nullable|string|',
                'pickup_location' => 'nullable|string|',
                'pickup_date' => 'nullable|string|',

            ]


        );
        $adoptionagreement = AdoptionAgreement::create([
           
            'date_created' =>$attrs['date_created'],
            'adopt_id' => $attrs['adopt_id'],
            'owner_id' => $attrs['ownerId'],
            'pet_id' => $attrs['petId'],
            'requester_id' => $attrs['requesterId'],
            'pickup_location' => $attrs['pickup_location'],
            'pickup_date' => $attrs['pickup_date'],


        ]);


        return Response([
            'adoptagreementID' => $adoptionagreement->adoptagreementID ,
            'adoptionagreement' => $adoptionagreement,
        ], 200);

    }
    //getpetadoptionprofile

    public function getspecificadoptionagreement($id)
    {
        $adoptionpost = AdoptionAgreement::where('adoptagreementID', $id)->with('user')->with('requester')->with('pet')->with('adoption')->first();

        return response([
            'adoption' => $adoptionpost

        ]);

    }
    public function getadoptionagreement()
    {
        return response([
            'adoptionagreement' => AdoptionAgreement::orderBy('created_at', 'desc')
                ->with('user:userID,firstname,lastname')
                ->with('requester:userID,firstname,lastname')
                ->with('pet:petID,petname,pettype,petbreed,petbirthdate,petsize,petgender')
                ->get()
        ], 200);


    }
    public function adoptionagreementList()
    {
        return Response([
            'adoptionagreement' => AdoptionAgreement::orderBy('created_at', 'desc')->where('owner_id', auth()->user()->userID)
                ->with('user:userID,firstname,lastname')
                ->with('requester:userID,firstname,lastname')
                ->with('pet:petID,petname,pettype,petbreed,petbdate,petsize,petgender')
                ->get()
        ], 200);
    }


    //         //get requestor complete 
    // public function getcompletedagreements(){    return Response([
    //         'agreement' => Agreement::orderBy('created_at', 'desc')
    //         ->with('requester:userID,firstname,lastname')
    //         ->with('recipient:userID,firstname,lastname')
    //          ->with('requesterpet:petID,petname,pettype,petbreed,petimage')
    //         ->with('recipientpet:petID,petname,pettype,petbreed,petimage')
    //         ->where('agreement_status', 'Complete')
    //         ->where('recipient_id', auth()->user()->userID)
    //         ->orWhere('requester_id', auth()->user()->userID)
    //         ->get()
    //     ], 200);
    // }

    //    public function cancelagreementrequest(Request $request)
    // {

    //     $user = $request->user();

    //     $agreement = Agreement::where('agreementID', $request->id)->first();

    //     $agreement->update([
    //         'agreement_status' => 'Cancelled',

    //     ]);
    //     return response()->json([
    //         'message' => 'Cancelled succesfully',
    //         'adoptionreq' => $agreement
    //     ], 200);
    // }

    //    public function completeagreementrequest(Request $request)
    // {
    //     $user = $request->user();

    //     $agreement = Agreement::where('agreementID', $request->id)->first();

    //     $agreement->update([
    //         'agreement_status' => 'Complete',

    //     ]);
    //     return response()->json([
    //         'message' => 'Completed succesfully',
    //         'adoptionreq' => $agreement
    //     ], 200);
    // }

    // public function show($id)
//     {
//         $agreement = Agreement::find($id);

    //         if (!$agreement) {
//             return response()->json(['error' => 'Agreement not found'], 404);
//         }

    //         return response()->json(['agreement' => $agreement]);
//     }









}



