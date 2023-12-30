@extends('layout')
@section('content')
    <div class="container login">
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-sm-2">

            </div>
            <div class="col-sm-8 text-center">

                <div class="row-sm" style="font-size: 40px; font-weight: bold; color:white;">AGREEMENT</div>

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
                        <h5> {{ $agreements->agreementID }}</h5>
                    </div>
                    <div class="col-lg-2 text-start">
                    </div>
                    <div class="col-lg-2 text-start">
                        <h5 class="card-title">Status :</h5>
                    </div>
                    <div class="col-lg-3 text-start">
                        <h5> {{ $agreements->agreement_status }}</h5>
                    </div>
                </div>

                <div class="row  pb-1">
                    <div class="col-lg-5 text-start">
                        <h5 class="card-title">Owner:</h5>
                    </div>
                    <div class="col-lg-2 text-start">
                    </div>
                    <div class="col-lg-5 text-start">
                        <h5 class="card-title">Requester:</h5>
                    </div>
                </div>
                <div class="row pb-1">
                    <div class="col-lg-2 text-start">
                        <p class="card-text">Name :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        @if ($agreements->recipient->accounttype == 'owner')
                            <a href="{{ url('/manageAccounts/petowners', $agreements->recipient->userID) }}">
                                {{ $agreements->recipient->firstname }}
                                {{ $agreements->recipient->lastname }}</a>
                        @else
                            <a href="{{ url('/manageAccounts/dual', $agreements->recipient->userID) }}">
                                {{ $agreements->recipient->firstname }}
                                {{ $agreements->recipient->lastname }}</a>
                        @endif
                    </div>
                    <div class="col-lg-2 text-start">
                    </div>
                    <div class="col-lg-2 pl-5 text-start" style="padding-left: ">
                        <p class="card-text">Name :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        @if ($agreements->requester->accounttype == 'owner')
                            <a href="{{ url('/manageAccounts/petowners', $agreements->requester->userID) }}">
                                {{ $agreements->requester->firstname }}
                                {{ $agreements->requester->lastname }}</a>
                        @else
                            <a href="{{ url('/manageAccounts/dual', $agreements->requester->userID) }}">
                                {{ $agreements->requester->firstname }}
                                {{ $agreements->requester->lastname }}</a>
                        @endif
                    </div>

                </div>
                <div class="row pb-1">
                    <div class="col-lg-2 text-start">
                        <p class="card-text">Pet :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <a href="{{ url('manageAccounts/pets', $agreements->recipientpet->petID) }}">{{ $agreements->recipientpet->petname ?? '' }}
                        </a>
                    </div>
                    <div class="col-lg-2 text-start">
                    </div>
                    <div class="col-lg-2 pl-5 text-start" style="padding-left: ">
                        <p class="card-text">Pet :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <a
                            href="{{ url('manageAccounts/pets', $agreements->requesterpet->petID) }}">{{ $agreements->requesterpet->petname ?? '' }}</a>
                    </div>

                </div>

                <div class="row pb-1">
                    <div class="col-lg-5 text-start">
                        <h5 class="card-title">Schedule :</h5>
                    </div>
                    <div class="col-lg-2 text-start">
                    </div>
                    <div class="col-lg-2 text-start">
                        <p class="card-title">Agreement Date :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <p class="card-title"></p>
                    </div>

                </div>
                <div class="row pb-1">
                    <div class="col-lg-2 text-start">
                        <p class="card-text">1st Session :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <input type="text" id="userID" name="userID"
                            style="background-color: #e9d6f4; width:  100%; border: 1px solid black; padding: 2px;"
                            value="{{ $agreements->first_session ?? '' }}" readonly>

                    </div>
                    <div class="col-lg-2 text-start">
                    </div>
                    <div class="col-lg-2 pl-5 text-start" style="padding-left: ">
                        <h5 class="card-title">Booking ID:</h5>
                    </div>
                    <div class="col-lg-3 text-start">
                    </div>

                </div>
                <div class="row pb-1">
                    <div class="col-lg-2 text-start">
                        <p class="card-text">2nd Session :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <input type="text" id="userID" name="userID"
                            style="background-color: #e9d6f4; width:  100%; border: 1px solid black; padding: 2px;"
                            value="{{ $agreements->second_session ?? ' ' }}" readonly>

                    </div>
                    <div class="col-lg-2 pl-5 text-start" style="padding-left: ">
                    </div>
                    <div class="col-lg-3 text-start">
                    </div>

                </div>
                <div class="row pb-1" style="padding-bottom: 20px">
                    <div class="col-lg-2 text-start">
                        <p class="card-text">3rd Session :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <input type="text" id="userID" name="userID"
                            style="background-color: #e9d6f4; width:  100%; border: 1px solid black; padding: 2px;"
                            value="{{ $agreements->third_session ?? ' ' }}" readonly>

                    </div>
                    <div class="col-lg-2 pl-5 text-start" style="padding-left: ">
                    </div>
                    <div class="col-lg-3 text-start">
                    </div>

                </div>
                <div class="row pb-1" style="padding-bottom: 20px">
                    <div class="col-lg-2 text-start">
                        <p class="card-text">Location :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <input type="text" id="userID" name="userID"
                            style="background-color: #e9d6f4; width:  100%; border: 1px solid black; padding: 2px;"
                            value="{{ $agreements->agreement_location ?? ' ' }}" readonly>

                    </div>
                    <div class="col-lg-2 pl-5 text-start" style="padding-left: ">
                    </div>
                    <div class="col-lg-3 text-start">
                    </div>

                </div>

                <div class="row pb-1" style="padding-bottom: 20px">
                    <div class="col-lg-2 text-start">
                        <p class="card-text">Paymode :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <input type="text" id="userID" name="userID"
                            style="background-color: #e9d6f4; width:  100%; border: 1px solid black; padding: 2px;"
                            value="{{ $agreements->agreement_paymode ?? ' ' }}" readonly>

                    </div>
                    <div class="col-lg-2 pl-5 text-start" style="padding-left: ">
                    </div>
                    <div class="col-lg-3 text-start">
                    </div>

                </div>
                <div class="row pb-1" style="padding-bottom: 20px">
                    <div class="col-lg-2 text-start">
                        <p class="card-text">Payment :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <input type="text" id="userID" name="userID"
                            style="background-color: #e9d6f4; width:  100%; border: 1px solid black; padding: 2px;"
                            value="{{ $agreements->agreement_payment ?? ' ' }}" readonly>

                    </div>
                    <div class="col-lg-2 pl-5 text-start" style="padding-left: ">
                    </div>
                    <div class="col-lg-3 text-start">
                    </div>

                </div>
                <div class="row pb-1" style="padding-bottom: 20px">
                    <div class="col-lg-2 text-start">
                        <p class="card-text">Payperson :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <input type="text" id="userID" name="userID"
                            style="background-color: #e9d6f4; width:  100%; border: 1px solid black; padding: 2px;"
                            value="{{ $agreements->agreement_payperson ?? ' ' }}" readonly>

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
