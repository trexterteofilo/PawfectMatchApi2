@extends('layout')
@section('content')
    <div class="container login">
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-sm-2">

            </div>
            <div class="col-sm-8 text-center">

                <div class="row-sm" style="font-size: 40px; font-weight: bold; color:white;">BOOKING</div>

            </div>
            <div class="col-sm-2 text-center">
            </div>
        </div>
        <div class="row justify-content-center"
            style="background-color: #dec3f0; padding:  20px 50px 20px 50px ; border-radius: 5px;">

            <div>

                <div class="row pb-1">
                    <div class="col-lg-2 text-start">
                        <h5 class="card-title">ID :</h5>
                    </div>
                    <div class="col-lg-3 text-start">
                        <h5> {{ $bookings->bookID }}</h5>
                    </div>
                    <div class="col-lg-2 text-start">
                    </div>
                    <div class="col-lg-2 text-start">
                        <h5 class="card-title">Status :</h5>
                    </div>
                    <div class="col-lg-3 text-start">
                        <h5> {{ $bookings->booking_status }}</h5>
                    </div>
                </div>
                {{-- 
                <div class="row  pb-1">
                    <div class="col-lg-5 text-start">
                        <h5 class="card-title">Petshooter:</h5>
                    </div>
                    <div class="col-lg-5 text-start">
                        <h5 class="card-title">Requester:</h5>
                    </div>
                </div> --}}
                <div class="row pb-1">
                    <div class="col-lg-2 text-start">
                        <p class="card-text">Petshooter :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        @if ($bookings->petshooter->accounttype == 'petshooter')
                            <a href="{{ url('/manageAccounts/petshooters', $bookings->petshooter->userID) }}">
                                {{ $bookings->petshooter->firstname }}
                                {{ $bookings->petshooter->lastname }}</a>
                        @else
                            <a href="{{ url('/manageAccounts/dual', $bookings->petshooter->userID) }}">
                                {{ $bookings->petshooter->firstname }}
                                {{ $bookings->petshooter->lastname }}</a>
                        @endif
                    </div>
                    <div class="col-lg-2 text-start">
                    </div>
                    <div class="col-lg-2 pl-5 text-start" style="padding-left: ">
                        <p class="card-text">Booker :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        @if ($bookings->requester->accounttype == 'owner')
                            <a href="{{ url('/manageAccounts/petowners', $bookings->requester->userID) }}">
                                {{ $bookings->requester->firstname }}
                                {{ $bookings->requester->lastname }}</a>
                        @else
                            <a href="{{ url('/manageAccounts/dual', $bookings->requester->userID) }}">
                                {{ $bookings->requester->firstname }}
                                {{ $bookings->requester->lastname }}</a>
                        @endif
                    </div>

                </div>

                <div class="row pb-1">
                    <div class="col-lg-5 text-start">
                        <h5 class="card-title">Schedule :</h5>
                    </div>
                    <div class="col-lg-2 text-start">
                    </div>
                    <div class="col-lg-2 text-start">
                        <p class="card-title">Booking Date :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <p class="card-title"></p>
                    </div>
                </div>
                <div class="row pb-1">
                    <div class="col-lg-2 text-start">
                        <p class="card-text">Date :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <input type="text" id="userID" name="userID"
                            style="background-color: #e9d6f4; width:  100%; border: 1px solid black; padding: 2px;"
                            value="{{ $bookings->booking_date ?? '' }}" readonly>

                    </div>
                    <div class="col-lg-2 text-start">
                    </div>
                    <div class="col-lg-2 text-start">
                        <h5 class="card-title">Agreement ID :</h5>
                    </div>
                    <div class="col-lg-3 text-start">
                        <h5 class="card-title"><a> </a></h5>
                    </div>

                </div>
                <div class="row pb-1">
                    <div class="col-lg-2 text-start">
                        <p class="card-text">Day :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <input type="text" id="userID" name="userID"
                            style="background-color: #e9d6f4; width:  100%; border: 1px solid black; padding: 2px;"
                            value="{{ $bookings->booking_day ?? ' ' }}" readonly>

                    </div>
                    <div class="col-lg-2 text-start">
                    </div>
                    <div class="col-lg-2 pl-5 text-start" style="padding-left: ">
                    </div>
                    <div class="col-lg-3 text-start">
                    </div>

                </div>
                <div class="row pb-1" style="padding-bottom: 20px">
                    <div class="col-lg-2 text-start">
                        <p class="card-text">Time :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <input type="text" id="userID" name="userID"
                            style="background-color: #e9d6f4; width:  100%; border: 1px solid black; padding: 2px;"
                            value="{{ $bookings->booking_time ?? ' ' }}" readonly>

                    </div>
                    <div class="col-lg-2 text-start">
                    </div>
                    <div class="col-lg-2 pl-5 text-start" style="padding-left: ">
                    </div>
                    <div class="col-lg-3 text-start">
                    </div>

                </div>

                {{-- <div class="row pb-1" style="padding-bottom: 20px">
                    <div class="col-lg-2 text-start">
                        <p class="card-text">Paymode :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <input type="text" id="userID" name="userID"
                            style="background-color: #e9d6f4; width:  100%; border: 1px solid black; padding: 2px;"
                            value="{{ $bookings->booking_paymode ?? ' ' }}" readonly>

                    </div>
                    <div class="col-lg-2 pl-5 text-start" style="padding-left: ">
                    </div>
                    <div class="col-lg-3 text-start">
                    </div>

                </div> --}}
                <div class="row pb-1" style="padding-bottom: 20px">
                    <div class="col-lg-2 text-start">
                        <p class="card-text">Payment :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <input type="text" id="userID" name="userID"
                            style="background-color: #e9d6f4; width:  100%; border: 1px solid black; padding: 2px;"
                            value="{{ $bookings->booking_location ?? 'N/A ' }}" readonly>

                    </div>
                    <div class="col-lg-2 text-start">
                    </div>
                    <div class="col-lg-2 pl-5 text-start" style="padding-left: ">
                    </div>
                    <div class="col-lg-3 text-start">
                    </div>
                </div>
                <div class="row" style="padding: 50px">

                </div>
            </div>
        </div>
    </div>
@endsection
