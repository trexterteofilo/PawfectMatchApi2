<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Pet;
use App\Models\Petshooter;
use App\Models\Credential;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Booking;
use App\Models\Bookingtimetable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;


class BookingController extends Controller
{
     public function getbookingtime(Request $request)
     {
          $petshooter_id = $request->petshooter_id;
          $clicked_date = $request->clicked_date;
          $time_operationstart = $request->time_start;
          // $time_operationend = $request->time_end;



          $bookingtimereturn = new Bookingtimetable();

          $startTime = Carbon::parse('9:00 AM');
          $endTime = Carbon::parse('5:00 PM');
          // $interval = '1 hour';

          $times = [];

          while ($startTime <= $endTime) {

               foreach ($startTime as $sttime) {
               }
               $times[] = $startTime->format('g:i A');


               $startTime->addHours(1);
          }

          $bookingexists = Booking::select('booking_time')->where('booking_date', $clicked_date)->where('petshooter_id', $petshooter_id)->get();


          $takentime = $bookingexists->pluck('booking_time')->toArray();


          // $i=0;
          // foreach($bookingexists as $booking) {
          //      if($booking->booking_time == $times[$i++]){

          //      }

          // }

          $takentime2 = [];
          function arrayDifference($takentime, $times)
          {
               // $modeltimetable = new Bookingtimetable();

               $differences = [];

               foreach ($takentime as $value) {
                    if (!in_array($value, $times)) {
                         $differences[] = $value;
                         // $modeltimetable->booking_time_status = 'Available';


                    } else {
                         $takentime2[] = $value;
                         // $modeltimetable->booking_time_status = 'Taken';

                    }

                    // $modeltimetable->booking_time = $value;

               }

               foreach ($times as $value) {
                    if (!in_array($value, $takentime) && !in_array($value, $differences)) {
                         $differences[] = $value;
                         // $modeltimetable->booking_time_status = 'Available';

                    } else {
                         $takentime2[] = $value;
                         // $modeltimetable->booking_time_status = 'Taken';

                    }
                    // $modeltimetable->booking_time = $value;

               }

               return $differences;

          }



          $differences = arrayDifference($takentime, $times);


          return response([

               'booking' => $differences,
               'taken' => $takentime

          ], 200);

     }
     public function getlistofpetshooters()
     {
          return response([
               'petshooter' => Petshooter::select('petshooterID', 'petshooter_id', 'contact_number', 'experience')->with('user:userID,firstname,lastname,image,bio,address,email')->whereNot('petshooter_id', auth()->user()->userID)->orderBy('created_at', 'desc')->get()

          ], 200);

     }
     public function getspecificpetshooters($id)
     {
          $userid = auth()->user()->userID;

          //variable for adoption id 
          $adoptionpost = Petshooter::find($id);

          // $Bookingpost = Booking::where($adoptionpost->id, adoption->adoption_id);

          //$Booking = Booking::where(adoptionpost->id ==  )
          return response([
               // 'adoptrequest' =>Booking::where($adoptionpost, 'adoption:id'),
               'value' => Petshooter::orderBy('created_at', 'desc')->select('petshooterID', 'petshooter_id', 'contact_number', "experience")->with('user:userID,firstname,image')->where('petshooterID', $id)->get()->first()
          ], 200);
     }


     //create booking   
     public function createbooking(Request $request)
     {
          $attrs = $request->validate(
               [
                    'booking_date' => 'nullable|string',
                    'booking_day' => 'nullable|string',
                    'booking_time' => 'nullable|string',
                    'booking_payment' => 'nullable|string|',
                    'petshooter_id' => 'nullable|string|',
               ]
          );

          $requesterid = auth()->user()->userID;
          $booking = Booking::create([
               'booking_date' => $attrs['booking_date'],
               'booking_day' => $attrs['booking_day'],
               'booking_time' => $attrs['booking_time'],
               'booking_payment' => $attrs['booking_payment'],
               'booking_status' => 'Pending',
               'requester_id' => auth()->user()->userID,
               'petshooter_id' => (int) $attrs['petshooter_id'],


          ]);

          //variable for adoption id 

          return response([
               'booking' => $booking,
               'message' => 'Booking Success'
          ], 200);
     }

     //get user as petshooter

     public function getuserpetshooter()
     {
          $userid = auth()->user()->userID;

          $petshooter = Petshooter::select('petshooterID', 'petshooter_id', 'contact_number', 'experience')->with('user:userID,email,firstname,lastname,image,address,age,bio,accounttype')->where('petshooter_id', $userid)->orderBy('created_at', 'desc')->get();

          //  $petshooter = Petshooter::select('petshooter_id')->where('petshooter_id', $userid)->get()->first();

          if (!$petshooter) {
               $booking = 'Unauthenticated';
               return response([

                    'petshooter' => $petshooter
               ], 200);
          } else {
               $booking = 'Authenticated';
               return response([

                    'petshooter' => $petshooter
               ], 200);

          }



     }

     //get public bookings
     public function getpublicbookings(Request $request)
     {
          $userid = auth()->user()->userID;

          $petshooter = Petshooter::select('petshooter_id')->where('petshooter_id', $userid)->get()->first();

          $petshooter1 = Petshooter::all();


          $booking = Booking::orderBy('created_at', 'desc')->
               where('petshooter_id', $request->id)->where(function ($query) {
                    $query->where('booking_status', 'Pending')
                         ->orWhere('booking_status', 'Rescheduled');
               })->with('requester:userID,firstname,lastname,email,address,image')
               ->with('petshooter:userID,firstname,image')->get();


          //   where('booking_status', 'Pending',  'Rescheduled')
          //  // ->where('booking_status', 'Rescheduled')
          //   ->with('requester:userID,firstname,lastname,email,address,image')
          //   ->with('petshooter:userID,firstname,image')
          //   ->where('petshooter_id',$request->id)->get();

          return response([
               'booking' => $booking
               //  'petshooter' => $petshooter
          ], 200);

     }

     //get user bookings
     public function getuserbooking(Request $request)
     {
          $userid = auth()->user()->userID;

          //->with('requester:id,name,lastname,image')
          $booking = Booking::orderBy('created_at', 'desc')->where('requester_id', $userid)->where('booking_status', 'FilterStatus.upcoming')->get();

          return response([
               $booking

          ], 200);

     }


     //get requests list of bookings done by the user
     public function getrequestlistbooking()
     {
          $userid = auth()->user()->userID;

          $petshooter = Petshooter::select('petshooter_id')->where('petshooter_id', $userid)->get()->first();

          $petshooter1 = Petshooter::all();

          if (!$petshooter) {
               $booking = 'Authenticated';
          } else {
               $booking = Booking::orderBy('created_at', 'desc')->where('petshooter_id', auth()->user()->userID)->where('booking_status', 'Pending')->with('petshooter:userID,firstname,image')->with('requester:userID,firstname,lastname,email,address,image')->get();

          }


          return response([
               'booking' => $booking,
               'petshooter' => $petshooter
          ], 200);

     }

     //get pending list of bookings for petshooter
     public function getpendinglistbookingpetshooter()
     {
          return response([
               'booking' => Booking::orderBy('created_at', 'desc')->where('petshooter_id', auth()->user()->userID)->where('booking_status', 'Pending')->orWhere('booking_status', 'Rescheduled')->with('petshooter:userID,firstname,image')->with('requester:userID,firstname,lastname,email,address,image')->get()
          ], 200);

     }
     public function getcancelledlistbookingpetshooter()
     {
          return response([
               'booking' => Booking::orderBy('created_at', 'desc')->where('petshooter_id', auth()->user()->userID)->where('booking_status', 'Cancelled')->with('petshooter:userID,firstname,image')->with('requester:userID,firstname,lastname,email,address,image')->get()
          ], 200);

     }

     public function getcompletedlistbookingetshooter()
     {
          return response([
               'booking' => Booking::orderBy('created_at', 'desc')->where('petshooter_id', auth()->user()->userID)->where('booking_status', 'Complete')->with('petshooter:userID,firstname,image')->with('requester:userID,firstname,lastname,email,address,image')->get()
          ], 200);

     }


     //=========================================

     //get pending list of bookings done by the user
     public function getpendinglistbooking()
     {
          return response([
               'booking' => Booking::orderBy('created_at', 'desc')->where('requester_id', auth()->user()->userID)->where('booking_status', 'Pending')->with('petshooter:userID,firstname,image')->with('requester:userID,firstname,lastname,email,address,image')->get()
          ], 200);

     }

     //get cancelled list of bookings done by the user
     public function getcancelledlistbooking()
     {
          return response([
               'booking' => Booking::orderBy('created_at', 'desc')->where('requester_id', auth()->user()->userID)->where('booking_status', 'Cancelled')->with('petshooter:userID,firstname,image')->with('requester:userID,firstname,lastname,email,address,image')->get()
          ], 200);

     }
     //get complete list of bookings done by the user
     public function getcompletedlistbooking()
     {
          return response([
               'booking' => Booking::orderBy('created_at', 'desc')->where('requester_id', auth()->user()->userID)->where('booking_status', 'Complete')->with('petshooter:userID,firstname,image')->with('requester:userID,firstname,lastname,email,address,image')->get()
          ], 200);

     }

     //reschedule booking
     public function reschedulebooking(Request $request)
     {
          //booking id
          $validator = Validator::make($request->all(), [
               'booking_date' => 'required',
               'booking_day' => 'required',
               'booking_time' => 'required'

          ]);

          if ($validator->fails()) {
               return response()->json([
                    'message' => 'Validations fails',
                    'errors' => $validator->errors()
               ], 422);
          }

          $user = $request->user();

          $booking = Booking::where('bookID', $request->id)->first();

          $booking->update([
               'booking_date' => $request->booking_date,
               'booking_day' => $request->booking_day,
               'booking_time' => $request->booking_time,
               //'booking_status' => 'Rescheduled'

          ]);
          return response()->json([
               'message' => 'Rescheduled succesfully',
               'booking' => $booking
          ], 200);
     }


     //cancel booking
     public function cancelbooking(Request $request)
     {
          //booking id
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

          $booking = Booking::where('bookID', $request->id)->first();

          $booking->update([
               'booking_status' => 'Cancelled',

          ]);
          return response()->json([
               'message' => 'Cancelled succesfully',
               'booking' => $booking
          ], 200);
     }

     //complete booking
     public function completebooking(Request $request)
     {
          //booking id
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

          $booking = Booking::where('bookID', $request->id)->first();

          $booking->update([
               'booking_status' => 'Completed',

          ]);
          return response()->json([
               'message' => 'Completed succesfully',
               'booking' => $booking
          ], 200);
     }

}
