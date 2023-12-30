<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use App\Models\Petcredentialimages;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;
use DB;

class manageAccountController extends Controller
{
    ////Pet Owner 
    public function viewOwners(Request $request): View
    {
        // $accounttype = "owner";
        // $owners = User::where('accounttype', $accounttype)->paginate(10);
        // return view('manageAcc.petowner.index', compact('owners'))->with('owners', $owners);
        // $owners = User::getUsers('');
        // return view('manageAcc.petowner.index', compact('owners'))->with('owners', $owners);
        $query = $request->get('query');
        $owners = User::where('accounttype', 'owner')->where(function ($q) use ($query) {
            $q->where('userID', 'LIKE', '%' . $query . '%')
                ->orWhere('firstname', 'LIKE', '%' . $query . '%')
                ->orWhere('lastname', 'LIKE', '%' . $query . '%')
                ->orWhere('email', 'LIKE', '%' . $query . '%')
                ->orWhere('address', 'LIKE', '%' . $query . '%')
                ->orWhere('age', 'LIKE', '%' . $query . '%')
                ->orWhere('accountstatus', 'LIKE', '%' . $query . '%');
        })->paginate(10);

        if ($request->ajax()) {
            return view('manageAcc.petowner.search.results', compact('owners'))->with('owners', $owners);
        }

        return view('manageAcc.petowner.index', compact('owners'))->with('owners', $owners);
    }
    public function showOwners(string $id): View
    {
        // $owners = User::find($id);
        // return view('manageAcc.petowner.show')->with('owners', $owners);
        $owners = User::find($id);

        Session::put('type', 'Cat Pets');

        $pets = Pet::where('owner_id', $id)->where('pettype', 'Cat')->paginate(5);
        return view('manageAcc.petowner.show', compact('pets'))->with('owners', $owners)->with('pets', $pets)->with('Cat', 'Cat Pets');
    }
    public function showCatOwners(string $id): View
    {
        // $owners = User::find($id);
        // return view('manageAcc.petowner.show')->with('owners', $owners);
        $owners = User::find($id);
        Session::forget('type');

        Session::put('type', 'Cat Pets');
        $pets = Pet::where('owner_id', $id)->where('pettype', 'Cat')->paginate(5);
        return view('manageAcc.petowner.show', compact('pets'))->with('owners', $owners)->with('pets', $pets);
    }
    public function showDogOwners(string $id): View
    {
        $owners = User::find($id);
        Session::forget('type');

        Session::put('type', 'Dog Pets');

        $pets = Pet::where('owner_id', $id)->where('pettype', 'Dog')->paginate(5);
        return view('manageAcc.petowner.show', compact('pets'))->with('owners', $owners)->with('pets', $pets)->with('Dog', 'Dog Pets');

    }
    public function showRabbitOwners(string $id): View
    {
        $owners = User::find($id);
        Session::forget('type');

        Session::put('type', 'Rabbit Pets');

        $pets = Pet::where('owner_id', $id)->where('pettype', 'Rabbit')->paginate(5);
        return view('manageAcc.petowner.show', compact('pets'))->with('owners', $owners)->with('pets', $pets)->with('Rabbit', 'Dog Pets');

    }
    public function showHamsterOwners(string $id): View
    {
        $owners = User::find($id);
        Session::forget('type');

        Session::flash('type', 'Hamster Pets');

        $pets = Pet::where('owner_id', $id)->where('pettype', 'Hamster')->paginate(5);
        return view('manageAcc.petowner.show', compact('pets'))->with('owners', $owners)->with('pets', $pets)->with('Rabbit', 'Dog Pets');

    }
    public function showBirdOwners(string $id): View
    {
        $owners = User::find($id);
        Session::forget('type');

        Session::put('type', 'Bird Pets');

        $pets = Pet::where('owner_id', $id)->where('pettype', 'Bird')->paginate(5);
        return view('manageAcc.petowner.show', compact('pets'))->with('owners', $owners)->with('pets', $pets)->with('Rabbit', 'Dog Pets');

    }
    // public function showOwnersPets(string $id): View
    // {
    //     $owners = User::find($id);
    //     $pets = Pet::where('owner_id', $id)->where('pettype', 'Cats')->get();
    //     return view('manageAcc.petowner.search.petsresults', compact('pets'))->with('owners', $owners)->with('pets', $pets);

    // }


    ////Pet Shooter 
    public function viewPetshooters(Request $request): View
    {
        // $accounttype = "petshooter";
        // $petshooter = User::where('accounttype', $accounttype)->paginate(10);
        // return view('manageAcc.petshooter.index', compact('petshooter'))->with('petshooter', $petshooter);
        $query = $request->get('query');
        $petshooter = User::where('accounttype', 'petshooter')->where(function ($q) use ($query) {
            $q->where('userID', 'LIKE', '%' . $query . '%')
                ->orWhere('firstname', 'LIKE', '%' . $query . '%')
                ->orWhere('lastname', 'LIKE', '%' . $query . '%')
                ->orWhere('email', 'LIKE', '%' . $query . '%')
                ->orWhere('address', 'LIKE', '%' . $query . '%')
                ->orWhere('age', 'LIKE', '%' . $query . '%')
                ->orWhere('accountstatus', 'LIKE', '%' . $query . '%');
        })->paginate(10);

        if ($request->ajax()) {
            return view('manageAcc.petshooter.search.results', compact('petshooter'))->with('petshooter', $petshooter);
        }

        return view('manageAcc.petshooter.index', compact('petshooter'))->with('petshooter', $petshooter);
    }
    public function showPetshooters(string $id): View
    {
        $petshooter = User::find($id);
        return view('manageAcc.petshooter.show')->with('petshooter', $petshooter);
    }
    ////Dual 
    public function viewDual(Request $request): View
    {
        // $accounttype = "dual";
        // $dual = User::where('accounttype', $accounttype)->paginate(10);
        // return view('manageAcc.dual.index', compact('dual'))->with('dual', $dual);
        $query = $request->get('query');
        $dual = User::where('accounttype', 'dual')->where(function ($q) use ($query) {
            $q->where('userID', 'LIKE', '%' . $query . '%')
                ->orWhere('firstname', 'LIKE', '%' . $query . '%')
                ->orWhere('lastname', 'LIKE', '%' . $query . '%')
                ->orWhere('email', 'LIKE', '%' . $query . '%')
                ->orWhere('address', 'LIKE', '%' . $query . '%')
                ->orWhere('age', 'LIKE', '%' . $query . '%')
                ->orWhere('accountstatus', 'LIKE', '%' . $query . '%');
        })->paginate(10);

        if ($request->ajax()) {
            return view('manageAcc.dual.search.results', compact('dual'))->with('dual', $dual);
        }

        return view('manageAcc.dual.index', compact('dual'))->with('dual', $dual);
    }
    public function showDual(string $id): View
    {
        // $dual = User::find($id);
        // return view('manageAcc.dual.show')->with('dual', $dual);
        $dual = User::find($id);
        Session::forget('type');

        Session::put('type', 'Cat Pets');
        $pets = Pet::where('owner_id', $id)->where('pettype', 'Cat')->paginate(5);
        return view('manageAcc.dual.show', compact('pets'))->with('dual', $dual)->with('pets', $pets);

    }

    public function showCatDual(string $id): View
    {
        // $owners = User::find($id);
        // return view('manageAcc.petowner.show')->with('owners', $owners);
        $dual = User::find($id);
        Session::forget('type');

        Session::put('type', 'Cat Pets');
        $pets = Pet::where('owner_id', $id)->where('pettype', 'Cat')->paginate(5);
        return view('manageAcc.dual.show', compact('pets'))->with('dual', $dual)->with('pets', $pets);
    }
    public function showDogDual(string $id): View
    {
        $dual = User::find($id);
        Session::forget('type');

        Session::put('type', 'Dog Pets');

        $pets = Pet::where('owner_id', $id)->where('pettype', 'Dog')->paginate(5);
        return view('manageAcc.dual.show', compact('pets'))->with('dual', $dual)->with('pets', $pets)->with('Dog', 'Dog Pets');

    }
    public function showRabbitDual(string $id): View
    {
        $dual = User::find($id);
        Session::forget('type');

        Session::put('type', 'Rabbit Pets');

        $pets = Pet::where('owner_id', $id)->where('pettype', 'Rabbit')->paginate(5);
        return view('manageAcc.dual.show', compact('pets'))->with('dual', $dual)->with('pets', $pets)->with('Rabbit', 'Dog Pets');

    }
    public function showHamsterDual(string $id): View
    {
        $dual = User::find($id);
        Session::forget('type');

        Session::flash('type', 'Hamster Pets');

        $pets = Pet::where('owner_id', $id)->where('pettype', 'Hamster')->paginate(5);
        return view('manageAcc.dual.show', compact('pets'))->with('dual', $dual)->with('pets', $pets)->with('Rabbit', 'Dog Pets');

    }
    public function showBirdDual(string $id): View
    {
        $dual = User::find($id);
        Session::forget('type');

        Session::put('type', 'Bird Pets');

        $pets = Pet::where('owner_id', $id)->where('pettype', 'Bird')->paginate(5);
        return view('manageAcc.dual.show', compact('pets'))->with('dual', $dual)->with('pets', $pets)->with('Rabbit', 'Dog Pets');

    }
    ////Pets 
    public function viewPets(Request $request): View
    {
        // $pet = Pet::paginate(10);
        // return view('manageAcc.pet.index', compact('pet'))->with('pet', $pet);
        $query = $request->get('query');

        // $getCats = DB::table('pets')
        //     ->rightJoin('users', 'users.userID', '=', 'pets.owner_id')
        //     ->where('pets.pettype', 'Cat')
        //     ->wherenot('breeding_posts.owner_id', auth()->user()->userID)
        //     ->rightJoin('users', 'users.userID', '=', 'breeding_posts.owner_id')
        //     ->orderBy('breeding_posts.created_at', 'desc')
        //     ->get();

        $pet = Pet::where(function ($q) use ($query) {
            $q->where('petID', 'LIKE', '%' . $query . '%')
                ->orWhere('petname', 'LIKE', '%' . $query . '%')
                ->orWhere('pettype', 'LIKE', '%' . $query . '%')
                ->orWhere('petbreed', 'LIKE', '%' . $query . '%')
                ->orWhere('petgender', 'LIKE', '%' . $query . '%')
                ->orWhere('petstatus', 'LIKE', '%' . $query . '%')

            ;
        })->orWhereHas('user', function ($q) use ($query) {
            $q->where('firstname', 'LIKE', '%' . $query . '%')->orWhere('lastname', 'LIKE', '%' . $query . '%');
        })
            ->with('user')
            ->paginate(10);

        if ($request->ajax()) {
            return view('manageAcc.pet.search.results', compact('pet'))->with('pet', $pet);
        }

        return view('manageAcc.pet.index', compact('pet'))->with('pet', $pet);
    }
    public function showPets(string $id): View
    {
        $pet = Pet::find($id);
        $petimg = Petcredentialimages::where('pet_id', $id);
        return view('manageAcc.pet.show', compact('pet', 'petimg'))->with('pet', $pet);
    }

    //Find  all userID
    public function findOwner(string $id)
    {
        $owner = User::find($id);
        return response()->json($owner);
    }

    public function activateUser(string $id)
    {
        $user = User::find($id);
        $user->update([
            'accountstatus' => "Active",
        ]);
        DB::table('pets')->where('owner_id', $id)->update(
            array('petstatus' => 'Active')
        );
        //  $pet = Pet::select('petname', 'petID', 'petstatus')->where('owner_id', 2)->get();
        return response()->json(['message' => 'User has been Activated']);

        //return back()->with('activeStatus', 'User has been activated');
    }

    public function deactUser(string $id)
    {
        $user = User::find($id);
        // $pets = Pet::where('owner_id', $id)->first();

        $user->update([
            'accountstatus' => 'Deactivated',
        ]);
        // $pets->update([
        //     'petstatus' => "Active",
        // ]);
        DB::table('pets')->where('owner_id', $id)->update(
            array('petstatus' => 'Deactivated')
        );
        //  $pet = Pet::select('petname', 'petID', 'petstatus')->where('owner_id', 2)->get();

        return response()->json(['message' => 'User has been deactivated']);
        //return back()->with('deactStatus', 'User has been deactivated');
    }


    ///SEARCH owners
    public function searchOwners(Request $request)
    {
        $query = $request->get('query');
        $owners = User::where('firstname', 'LIKE', '%' . $query . '%')->paginate(10);

        if ($request->ajax()) {
            return view('manageAcc.petowner.search.results', compact('owners'))->with('owners', $owners);
            ;
        }

        return view('manageAcc.petowner.search.results', compact('owners'))->with('owners', $owners);
        ;
    }
}
