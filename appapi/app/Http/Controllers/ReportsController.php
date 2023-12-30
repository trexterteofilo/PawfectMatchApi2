<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\Agreement;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    //////WEB/////

    //view reports UNUSED
    public function reports()
    {
        return view('reports');
    }
    //ADOPTIONS
    public function adoptions(Request $request): View
    {
        // $adoptions = Adoption::paginate(10);
        // return view('reports.adoptions.index', compact('adoptions'))->with('adoptions', $adoptions);

        // return view('manageAcc.pet.index', compact('pet'))->with('pet', $pet);
        $query = $request->get('query');

        // $getCats = DB::table('pets')
        //     ->rightJoin('users', 'users.userID', '=', 'pets.owner_id')
        //     ->where('pets.pettype', 'Cat')
        //     ->wherenot('breeding_posts.owner_id', auth()->user()->userID)
        //     ->rightJoin('users', 'users.userID', '=', 'breeding_posts.owner_id')
        //     ->orderBy('breeding_posts.created_at', 'desc')
        //     ->get();

        $adoptions = Adoption::where(function ($q) use ($query) {
            $q->where('adoptID', 'LIKE', '%' . $query . '%')
                ->orWhere('adopt_date', 'LIKE', '%' . $query . '%')
                ->orWhere('adopt_payment', 'LIKE', '%' . $query . '%')
                ->orWhere('adopt_status', 'LIKE', '%' . $query . '%')

            ;
        })->orWhereHas('pet', function ($q) use ($query) {
            $q->where('petname', 'LIKE', '%' . $query . '%');
        })->orWhereHas('currentOwner', function ($q) use ($query) {
            $q->where('firstname', 'LIKE', '%' . $query . '%')->orWhere('lastname', 'LIKE', '%' . $query . '%');
        })
            ->orWhereHas('previousOwner', function ($q) use ($query) {
                $q->where('firstname', 'LIKE', '%' . $query . '%')->orWhere('lastname', 'LIKE', '%' . $query . '%');
            })
            ->with('pet')
            ->with('currentOwner')
            ->with('previousOwner')
            ->paginate(10);

        if ($request->ajax()) {
            return view('reports.adoptions.search.results', compact('adoptions'))->with('adoptions', $adoptions);
        }

        return view('reports.adoptions.index', compact('adoptions'))->with('adoptions', $adoptions);
    }
    public function showAdoption(string $id): View
    {
        $adoption = Adoption::find($id);
        return view('reports.adoptions.show')->with('adoption', $adoption);
    }
    //BOOKINGS
    public function bookings(Request $request): View
    {
        // $bookings = Booking::paginate(10);
        // return view('reports.bookings.index', compact('bookings'))->with('bookings', $bookings);
        $query = $request->get('query');

        $bookings = Booking::where(function ($q) use ($query) {
            $q->where('bookID', 'LIKE', '%' . $query . '%')
                ->orWhere('booking_date', 'LIKE', '%' . $query . '%')
                ->orWhere('booking_payment', 'LIKE', '%' . $query . '%')
                ->orWhere('booking_status', 'LIKE', '%' . $query . '%')

            ;
        })->orWhereHas('petshooter', function ($q) use ($query) {
            $q->where('firstname', 'LIKE', '%' . $query . '%')->orWhere('lastname', 'LIKE', '%' . $query . '%');
        })->orWhereHas('requester', function ($q) use ($query) {
            $q->where('firstname', 'LIKE', '%' . $query . '%')->orWhere('lastname', 'LIKE', '%' . $query . '%');
        })
            ->with('petshooter')
            ->with('requester')
            ->paginate(10);

        if ($request->ajax()) {
            return view('reports.bookings.search.results', compact('bookings'))->with('bookings', $bookings);
        }

        return view('reports.bookings.index', compact('bookings'))->with('bookings', $bookings);

    }
    public function showBooking(string $id): View
    {
        $bookings = Booking::find($id);
        return view('reports.bookings.show')->with('bookings', $bookings);
    }
    //AGREEMENT

    public function agreements(Request $request): View
    {
        // $agreements = Agreement::paginate(10);
        // return view('reports.agreements.index', compact('agreements'))->with('agreements', $agreements);
        $query = $request->get('query');

        $agreements = Agreement::where(function ($q) use ($query) {
            $q->where('agreementID', 'LIKE', '%' . $query . '%')
                ->orWhere('agreement_payment', 'LIKE', '%' . $query . '%')
                ->orWhere('agreement_status', 'LIKE', '%' . $query . '%')

            ;
        })->orWhereHas('recipient', function ($q) use ($query) {
            $q->where('firstname', 'LIKE', '%' . $query . '%')->orWhere('lastname', 'LIKE', '%' . $query . '%');
        })->orWhereHas('requester', function ($q) use ($query) {
            $q->where('firstname', 'LIKE', '%' . $query . '%')->orWhere('lastname', 'LIKE', '%' . $query . '%');
        })
            ->with('recipient')
            ->with('requester')
            ->paginate(10);

        if ($request->ajax()) {
            return view('reports.agreements.search.results', compact('agreements'))->with('agreements', $agreements);
        }

        return view('reports.agreements.index', compact('agreements'))->with('agreements', $agreements);


    }
    public function showAgreement(string $id): View
    {
        $agreements = Agreement::find($id);
        return view('reports.agreements.show')->with('agreements', $agreements);
    }


    /////////MOBILE////////////
    // get all adoptionreports
    public function getreports()
    {

        return response([

            //     'adopt' => Adoption::orderBy('created_at', 'desc')->with('user:id,name,image')->with('pet:id,petname,image')->get()
            // ], 200);    '
            'adopt' => Adoption::orderBy('created_at', 'desc')->with('user:userID,firstname,image')->with('pet:petID,petname,petimage')->
                where('adopt_status', 'Adopted')->where('owner_id', auth()->user()->userID)->get()
        ], 200);
    }




    public function getreportsBooking()
    {

        return response([
            'booking' => Booking::orderBy('created_at', 'desc')->with('petshooter:userID,firstname,image')->with('requester:userID,firstname,image')->get()
        ], 200);
    }

    public function getreportsAgreement()
    {
        $id = auth()->user()->userID;
        return response([
            'agreement' => Agreement::orderBy('created_at', 'desc')->with('recipient')->with('requester')->
                where('recipient_id', (string) $id)->
                where('agreement_status', 'Complete')->get()
        ], 200);
    }
    // {
    //     return response([
    //         'agreement' => Agreement::orderBy('created_at', 'desc')->with('recipient:id,name,image')->with('requester:id,name,image')->get()
    //     ], 200);
    // }

    // public function getreportsBooking()
    // {

    //     return response([
    //         'booking' => Booking::orderBy('created_at', 'desc')->with('petshooter:id,name,image')->with('requester:id,name,image')->get()
    //     ], 200);
    // }

}
