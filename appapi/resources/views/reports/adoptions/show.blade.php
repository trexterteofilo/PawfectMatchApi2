@extends('layout')
@section('content')
    <div class="container login">
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-sm-2">

            </div>
            <div class="col-sm-8 text-center">

                <div class="row-sm" style="font-size: 40px; font-weight: bold; color:white;">ADOPTION</div>

            </div>
            <div class="col-sm-2 text-center">
            </div>
        </div>
        <div class="row justify-content-center"
            style="background-color: #dec3f0; padding:  20px 50px 20px 50px ; border-radius: 5px;">
            <div>
                <div class="col-lg-12">
                    {{--  --}}
                    {{-- // <img src="{{ asset('img/' . $post->image) }}" /> --}}
                    <img src="{{ $adoption->pet->petimage }}" style="height: 180px;width:180px; border: 2px solid white;">
                    </hr>
                </div>
            </div>
            <div>
                <div class="row  pb-5" style="padding: 10px">
                    <div class="col-lg-12 text-center">
                        <h5 class="card-title">Pet: <a href="{{ url('manageAccounts/pets', $adoption->pet->petID) }}">
                                {{ $adoption->pet->petname }} </a></h5>
                    </div>
                </div>
                <div class="row pb-1">
                    <div class="col-lg-2 text-start">
                        <h5 class="card-title">ID :</h5>
                    </div>
                    <div class="col-lg-3 text-start">
                        <h5> {{ $adoption->adoptID }}</h5>
                    </div>
                    <div class="col-lg-2 text-start">
                        <h5 class="card-title">Status :</h5>
                    </div>
                    <div class="col-lg-3 text-start">
                        <h5> {{ $adoption->adopt_status }}</h5>
                    </div>
                </div>

                {{-- <div class="row  pb-1">
                    <div class="col-lg-12 text-start">
                        <h5 class="card-title">Owner:</h5>
                    </div>
                </div> --}}
                <div class="row pb-1">
                    <div class="col-lg-2 text-start">
                        <p class="card-text">Owner Name :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        @if ($adoption->adopt_status == 'Completed')
                            @if ($adoption->previousOwner->accounttype == 'owner')
                                <a href="{{ url('/manageAccounts/petowners', $adoption->previousOwner->userID) }}">
                                    {{ $adoption->previousOwner->firstname }} {{ $adoption->previousOwner->lastname }}</a>
                            @else
                                <a href="{{ url('/manageAccounts/dual', $adoption->previousOwner->userID) }}">
                                    {{ $adoption->previousOwner->firstname }} {{ $adoption->previousOwner->lastname }}</a>
                            @endif
                        @else
                            @if ($adoption->currentOwner->accounttype == 'owner')
                                <a href="{{ url('/manageAccounts/petowners', $adoption->currentOwner->userID) }}">
                                    {{ $adoption->currentOwner->firstname }}
                                    {{ $adoption->currentOwner->lastname }}</a>
                            @else
                                <a href="{{ url('/manageAccounts/dual', $adoption->currentOwner->userID) }}">
                                    {{ $adoption->currentOwner->firstname }}
                                    {{ $adoption->currentOwner->lastname }}</a>
                            @endif
                        @endif
                    </div>
                    <div class="col-lg-2 pl-5 text-start" style="padding-left: ">
                        <p class="card-text">Pet Adopter :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        @if ($adoption->adopt_status == 'Completed')
                            @if ($adoption->currentOwner->accounttype == 'owner')
                                <a href="{{ url('/manageAccounts/petowners', $adoption->currentOwner->userID) }}">
                                    {{ $adoption->currentOwner->firstname }} {{ $adoption->currentOwner->lastname }}</a>
                            @else
                                <a href="{{ url('/manageAccounts/dual', $adoption->currentOwner->userID) }}">
                                    {{ $adoption->currentOwner->firstname }}
                                    {{ $adoption->currentOwner->lastname }}</a>
                            @endif
                        @else
                            <p>No Adopter yet </p>
                        @endif
                    </div>

                </div>
                <div class="row pb-1">
                    <div class="col-lg-2 text-start">
                        <p class="card-text">Date Adopted :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <input type="text" id="userID" name="userID"
                            style="background-color: #e9d6f4; width:  100%; border: 1px solid black; padding: 2px;"
                            value="{{ $adoption->adopt_date ?? 'Not yet adopted' }}" readonly>

                    </div>
                    <div class="col-lg-2 pl-5 text-start" style="padding-left: ">
                        <p class="card-text">Date Created :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <input type="text" id="userID" name="userID"
                            style="background-color: #e9d6f4; width:  100%; border: 1px solid black; padding: 2px;"
                            value="{{ $adoption->created_at->format('Y-m-d') }}" readonly>

                    </div>

                </div>
                <div class="row pb-1">
                    <div class="col-lg-2 text-start">
                        <p class="card-text">Date Description :</p>
                    </div>
                    <div class="col-lg-10 text-start">

                        <textarea id="bio" name="bio"
                            style="background-color: #e9d6f4; width:  100%; border: 1px solid black; padding: 2px;" readonly>{{ $adoption->adopt_desc ?? 'No description' }}</textarea>
                    </div>
                </div>
                <div class="row pb-1">
                    <div class="col-lg-2 text-start">
                        <p class="card-text">Payment :</p>
                    </div>
                    <div class="col-lg-10 text-start">
                        <input type="text" id="userID" name="userID"
                            style="background-color: #e9d6f4; width:  100%; border: 1px solid black; padding: 2px;"
                            value="{{ $adoption->adopt_payment }}" readonly>
                    </div>
                </div>
                <div class="row" style="padding: 50px">

                </div>
            </div>
        </div>
    </div>
@endsection
