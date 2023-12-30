<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AgreementController extends Controller
{
    public function createagreement(Request $request)
    {
        $attrs = $request->validate(
            [
                'agreement_date' => 'nullable|string',
                'recipient_id' => 'nullable|string',
                'pettype' => 'nullable|string',
                'recipient_pet_id' => 'nullable|string',
                'requester_pet_id' => 'nullable|string|',
                'agreement_location' => 'nullable|string|',
                'agreement_payperson' => 'nullable|string|',
                'agreement_shooter' => 'nullable|string|',
                'first_session' => 'nullable|string',
                'second_session' => 'nullable|string',
                'third_session' => 'nullable|string',
                'agreement_payment' => 'nullable|string|',
                'agreement_paymode' => 'nullable|string|',
                'agreement_info' => 'nullable|string|',
            ]
        );
        $agreement = Agreement::create([

            'agreement_date' => $attrs['agreement_date'],
            'recipient_id' => $attrs['recipient_id'],
            'pettype' => $attrs['pettype'],
            'recipient_pet_id' => $attrs['recipient_pet_id'],
            'requester_pet_id' => $attrs['requester_pet_id'],
            'agreement_location' => $attrs['agreement_location'],
            'agreement_payperson' => $attrs['agreement_payperson'],
            'agreement_shooter' => $attrs['agreement_shooter'],
            'first_session' => $attrs['first_session'],
            'second_session' => $attrs['second_session'],
            'third_session' => $attrs['third_session'],
            'agreement_payment' => $attrs['agreement_payment'],
            'agreement_paymode' => $attrs['agreement_paymode'],
            'agreement_info' => $attrs['agreement_info'],
            'agreement_status' => 'Pending',
            'requester_id' => auth()->user()->userID,

        ]);


        return Response([
            'agreement' => $agreement,
        ], 200);

    }

    public function getAgreementRequest()
    {
        return response([
            'agreement' => Agreement::orderBy('created_at', 'desc')
                ->with('requester:userID,firstname,lastname')
                ->with('recipient:userID,firstname,lastname')
                ->with('requesterpet:petID,petname,pettype,petbreed,petimage')
                ->with('recipientpet:petID,petname,pettype,petbreed,petimage')
                ->get()
        ], 200);


    }
    public function agreementList()
    {
        return Response([
            'agreement' => Agreement::orderBy('created_at', 'desc')->where('requester_id', auth()->user()->userID)
                ->with('requester:userID,firstname,lastname')
                ->with('recipient:userID,firstname,lastname')
                ->with('requesterpet:petID,petname,pettype,petbreed,petimage')
                ->with('recipientpet:petID,petname,pettype,petbreed,petimage')
                ->get()
        ], 200);
    }

    //get requestor pending 
    public function getrequestorpendingagreements()
    {
        return Response([
            'agreement' => Agreement::orderBy('created_at', 'desc')
                ->where('requester_id', auth()->user()->userID)
                ->with('requester:userID,firstname,lastname')
                ->with('recipient:userID,firstname,lastname')
                ->with('requesterpet:petID,petname,pettype,petbreed,petimage')
                ->with('recipientpet:petID,petname,pettype,petbreed,petimage')
                ->where('agreement_status', 'Pending')

                ->get()
        ], 200);
    }
    //get recipient pending 
    public function getrecipientpendingagreements()
    {
        return Response([
            'agreement' => Agreement::orderBy('created_at', 'desc')
                ->where('recipient_id', auth()->user()->userID)
                ->with('requester:userID,firstname,lastname')
                ->with('recipient:userID,firstname,lastname')
                ->with('requesterpet:petID,petname,pettype,petbreed,petimage')
                ->with('recipientpet:petID,petname,pettype,petbreed,petimage')
                ->where('agreement_status', 'Pending')
                ->get()
        ], 200);
    }

    //get requestor pending 
    public function getrequestorcancelagreements()
    {
        return Response([
            'agreement' => Agreement::orderBy('created_at', 'desc')
                ->where('requester_id', auth()->user()->userID)
                ->with('requester:userID,firstname,lastname')
                ->with('recipient:userID,firstname,lastname')
                ->with('requesterpet:petID,petname,pettype,petbreed,petimage')
                ->with('recipientpet:petID,petname,pettype,petbreed,petimage')
                ->where('agreement_status', 'Cancelled')
                ->get()
        ], 200);
    }
    //get recipient pending 
    public function getcancelledagreements()
    {
        return Response([
            'agreement' => Agreement::orderBy('created_at', 'desc')
                ->with('requester:userID,firstname,lastname')
                ->with('recipient:userID,firstname,lastname')
                ->with('requesterpet:petID,petname,pettype,petbreed,petimage')
                ->with('recipientpet:petID,petname,pettype,petbreed,petimage')
                ->where('agreement_status', 'Cancelled')
                ->where('recipient_id', auth()->user()->userID)
                ->orWhere('requester_id', auth()->user()->userID)
                ->get()
        ], 200);
    }

    //get requestor complete 
    public function getcompletedagreements()
    {
        return Response([
            'agreement' => Agreement::orderBy('created_at', 'desc')
                ->with('requester:userID,firstname,lastname')
                ->with('recipient:userID,firstname,lastname')
                ->with('requesterpet:petID,petname,pettype,petbreed,petimage')
                ->with('recipientpet:petID,petname,pettype,petbreed,petimage')
                ->where('agreement_status', 'Complete')
                ->where('recipient_id', auth()->user()->userID)
                ->orWhere('requester_id', auth()->user()->userID)
                ->get()
        ], 200);
    }
    //   //get recipient complete 
    // public function getrequestorcompleteagreements(){    return Response([
    //         'agreement' => Agreement::orderBy('created_at', 'desc')->where('requester_id', auth()->user()->userID)
    //         ->with('requester:userID,firstname')
    //         ->with('recipient:userID,firstname')
    //         ->with('requesterpet:petID,pettype,petbreed')
    //         ->with('recipientpet:petID,pettype,petbreed')
    //         ->where('agreement_status', 'Complete')
    //         ->where('recipient_id', auth()->user()->userID)
    //         ->get()
    //     ], 200);
    // }

    public function cancelagreementrequest(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'id' => 'required'
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'message' => 'Validations fails',
        //         'errors' => $validator->errors()
        //     ], 422);
        // }

        $user = $request->user();

        $agreement = Agreement::where('agreementID', $request->id)->first();

        $agreement->update([
            'agreement_status' => 'Cancelled',

        ]);
        return response()->json([
            'message' => 'Cancelled succesfully',
            'adoptionreq' => $agreement
        ], 200);
    }

    public function completeagreementrequest(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'id' => 'required'
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'message' => 'Validations fails',
        //         'errors' => $validator->errors()
        //     ], 422);
        // }

        $user = $request->user();

        $agreement = Agreement::where('agreementID', $request->id)->first();

        $agreement->update([
            'agreement_status' => 'Completed',

        ]);
        return response()->json([
            'message' => 'Completed succesfully',
            'adoptionreq' => $agreement
        ], 200);
    }

    public function show($id)
    {
        $agreement = Agreement::find($id);

        if (!$agreement) {
            return response()->json(['error' => 'Agreement not found'], 404);
        }

        return response()->json(['agreement' => $agreement]);
    }
}



