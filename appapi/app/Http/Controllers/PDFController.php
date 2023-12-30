<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Adoption;
use App\Models\Agreement;
use App\Models\Pet;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    //Pet owner PDF
    public function generatePetOwnerPDF()
    {
        $users = User::where('accounttype', 'owner')->get();
        //   $petowners = User::get();
        $admin = User::where('userID', auth()->user()->userID)->first();

        $data = [
            'title' => 'List of Pet Owners',
            'date' => date('Y-m-d g:i a'),
            'users' => $users,
            'admin' => $admin,

        ];

        $pdf = Pdf::loadView('PDF.usersPDF', $data)->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('PawfectMatch - PetOwners -' . date('Y-m-d') . '.pdf');
        // return $pdf->download('PawfectMatch - PetOwners.pdf');
    }

    //Pet shooter PDF

    public function generatePetShooterPDF()
    {
        $users = User::where('accounttype', 'petshooter')->get();
        //   $petowners = User::get();
        $admin = User::where('userID', auth()->user()->userID)->first();

        $data = [
            'title' => 'List of Pet Shooters',
            'date' => date('Y-m-d g:i a'),
            'users' => $users,
            'admin' => $admin,

        ];

        $pdf = Pdf::loadView('PDF.usersPDF', $data)->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('PawfectMatch - Pet Shooters -' . date('Y-m-d') . '.pdf');
        // return $pdf->download('PawfectMatch - PetOwners.pdf');
    }

    public function generateDualPDF()
    {
        $users = User::where('accounttype', 'dual')->get();
        //   $petowners = User::get();
        $admin = User::where('userID', auth()->user()->userID)->first();

        $data = [
            'title' => 'List of Dual Users',
            'date' => date('Y-m-d g:i a'),
            'users' => $users,
            'admin' => $admin,

        ];

        $pdf = Pdf::loadView('PDF.usersPDF', $data)->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('PawfectMatch - Dual -' . date('Y-m-d') . '.pdf');
        // return $pdf->download('PawfectMatch - PetOwners.pdf');
    }
    public function generatePetPDF()
    {
        $pet = Pet::get();
        //   $petowners = User::get();
        $admin = User::where('userID', auth()->user()->userID)->first();

        $data = [
            'title' => 'List of Dual Users',
            'date' => date('Y-m-d g:i a'),
            'pet' => $pet,
            'admin' => $admin,

        ];

        $pdf = Pdf::loadView('PDF.petPDF', $data)->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('PawfectMatch - Pet -' . date('Y-m-d') . '.pdf');
        // return $pdf->download('PawfectMatch - PetOwners.pdf');
    }
    public function generateBookingPDF()
    {
        $booking = Booking::get();
        $admin = User::where('userID', auth()->user()->userID)->first();

        $data = [
            'title' => 'List of Bookings',
            'date' => date('Y-m-d g:i a'),
            'booking' => $booking,
            'admin' => $admin,

        ];

        $pdf = Pdf::loadView('PDF.bookingPDF', $data)->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('PawfectMatch - Booking -' . date('Y-m-d') . '.pdf');

    }
    public function generateAgreementPDF()
    {
        $agreement = Agreement::get();
        $admin = User::where('userID', auth()->user()->userID)->first();

        $data = [
            'title' => 'List of Agreements',
            'date' => date('Y-m-d g:i a'),
            'agreement' => $agreement,
            'admin' => $admin,

        ];

        $pdf = Pdf::loadView('PDF.agreementPDF', $data)->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('PawfectMatch - Agreement -' . date('Y-m-d') . '.pdf');

    }
    public function generateAdoptionPDF()
    {
        $adoption = Adoption::get();
        $admin = User::where('userID', auth()->user()->userID)->first();

        $data = [
            'title' => 'List of Adoptions',
            'date' => date('Y-m-d g:i a'),
            'adoption' => $adoption,
            'admin' => $admin,

        ];

        $pdf = Pdf::loadView('PDF.adoptionPDF', $data)->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('PawfectMatch - Adoption -' . date('Y-m-d') . '.pdf');

    }
}
