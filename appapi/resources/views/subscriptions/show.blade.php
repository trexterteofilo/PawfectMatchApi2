@extends('layout')
@section('content')
    <div class="container login">
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-sm-2">
                {{-- <div class="row-sm">
                    <a href="{{ url('/subscription') }}">
                        <img src="{{ asset('img/back.png') }}" alt="PawfectMatch" width="auto" height="35px"></a>
                </div> --}}
            </div>
            <div class="col-sm-8 text-center">

                <div class="row-sm" style="font-size: 40px; font-weight: bold; color:white;">SUBSCRIPTION</div>

            </div>
            <div class="col-sm-2 text-center">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-body">
                    <h5 class="card-title">ID : {{ $subs->id }}</h5>
                    <p class="card-text">Users: {{ $subs->subs_user ?? 'null' }}
                    </p>
                    <p class="card-text">Type: {{ $subs->subs_type ?? 'null' }}
                    </p>
                    <p class="card-text">Plan :{{ $subs->subs_plan ?? 'null' }}</p>
                    <p class="card-text">Price :{{ $subs->subs_price ?? 'null' }}</p>

                    <a href="{{ url('/subscription/edit/' . $subs->id) }}"> <button class="btn btn-login"
                            style="padding:10px;width: 250px">Edit
                            Subscription</button></a>

                </div>
                </hr>

            </div>
        </div>
    </div>
@endsection
