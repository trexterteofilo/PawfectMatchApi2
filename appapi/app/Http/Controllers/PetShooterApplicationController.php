<?php

namespace App\Http\Controllers;

use App\Models\Petshooterapplication;
use App\Models\PetShooterCredentialImg;
use App\Models\Petshooterbreedtype;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use DB;

class PetShooterApplicationController extends Controller
{
    ////Received Application
    public function viewPendingApp(Request $request): View
    {
        $query = $request->get('query');
        $petshooterapp = Petshooterapplication::where('verification_status', 'Pending')->where(function ($q) use ($query) {
            $q->where('petshooterAppID', 'LIKE', '%' . $query . '%')
                ->orWhere('petshooter_id', 'LIKE', '%' . $query . '%')
                ->orWhere('created_at', 'LIKE', '%' . $query . '%')->orWhereHas('petshooter', function ($q) use ($query) {
                    $q->where('firstname', 'LIKE', '%' . $query . '%')->orWhere('lastname', 'LIKE', '%' . $query . '%');
                });
        })
            ->with('petshooter')
            ->paginate(10);

        if ($request->ajax()) {
            return view('petshooterApplication.received.search.results', compact('petshooterapp'))->with('petshooterapp', $petshooterapp);
        }
        return view('petshooterApplication.received.index', compact('petshooterapp'))->with('petshooterapp', $petshooterapp);
    }
    //show Received/PENDING Application
    public function showPendingApp(string $id): View
    {
        $petshooterapp = Petshooterapplication::find($id);
        $petshootertype = Petshooterbreedtype::where('petshooter_id', $id)->get();
        $petshooterimg = PetShooterCredentialImg::where('petshooter_id', $id)->get();

        return view('petshooterApplication.received.show', compact('petshooterapp', 'petshootertype', 'petshooterimg'));
    }


    ////Accepted Application
    public function viewAcceptedApp(Request $request): View
    {


        $query = $request->get('query');
        $petshooterapp = Petshooterapplication::where('verification_status', 'Approved')->where(function ($q) use ($query) {
            $q->where('petshooterAppID', 'LIKE', '%' . $query . '%')
                ->orWhere('petshooter_id', 'LIKE', '%' . $query . '%')
                ->orWhere('created_at', 'LIKE', '%' . $query . '%')->orWhereHas('petshooter', function ($q) use ($query) {
                    $q->where('firstname', 'LIKE', '%' . $query . '%')->orWhere('lastname', 'LIKE', '%' . $query . '%');
                });
        })->orderBy('updated_at', 'DESC')
            ->with('petshooter')
            ->paginate(10);

        if ($request->ajax()) {
            return view('petshooterApplication.approved.search.results', compact('petshooterapp'))->with('petshooterapp', $petshooterapp);
        }

        return view('petshooterApplication.approved.index', compact('petshooterapp'))->with('petshooterapp', $petshooterapp);
    }
    // public function showPetshooters(string $id): View
    // {
    //     $petshooter = User::find($id);
    //     return view('manageAcc.petshooter.show')->with('petshooter', $petshooter);
    // }
    ////Declined Application
    public function viewDeclinedApp(Request $request): View
    {
        $query = $request->get('query');
        $petshooterapp = Petshooterapplication::where('verification_status', 'Declined')->where(function ($q) use ($query) {
            $q->where('petshooterAppID', 'LIKE', '%' . $query . '%')
                ->orWhere('petshooter_id', 'LIKE', '%' . $query . '%')
                ->orWhere('created_at', 'LIKE', '%' . $query . '%')->orWhereHas('petshooter', function ($q) use ($query) {
                    $q->where('firstname', 'LIKE', '%' . $query . '%')->orWhere('lastname', 'LIKE', '%' . $query . '%');
                });
        })->orderBy('updated_at', 'DESC')
            ->with('petshooter')
            ->paginate(10);

        if ($request->ajax()) {
            return view('petshooterApplication.declined.search.results', compact('petshooterapp'))->with('petshooterapp', $petshooterapp);
        }

        return view('petshooterApplication.declined.index', compact('petshooterapp'))->with('petshooterapp', $petshooterapp);
    }

    // public function showDual(string $id): View
    // {
    //     $dual = User::find($id);
    //     return view('manageAcc.dual.show')->with('dual', $dual);
    // }

    //Accept Pet shooter Application
    public function approveApplication(Request $request)
    {
        $user = Petshooterapplication::find($request->id);
        $user->update([
            'verification_status' => "Approved",
        ]);

        // return response()->json(['message' => 'Pet shooter Application is Approved']);
        return $this->viewAcceptedApp($request)->with('message', 'Pet shooter Application is Approved');

        //return back()->with('activeStatus', 'User has been activated');
    }

    //Decline Pet shooter Application
    public function declineApplication(Request $request)
    {
        $user = Petshooterapplication::find($request->id);
        $user->update([
            'verification_status' => "Declined",
        ]);

        //  return back()->with('message', 'Pet shooter Application is Declined');
        return $this->viewDeclinedApp($request)->with('message', 'Pet shooter Application is Declined');

        //  return response()->json(['message' => 'Pet shooter Application is Declined']);
    }


}
