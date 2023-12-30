@extends('layout')
@section('content')
    <div class="container login mt-0">

        <div class="row" style="margin-bottom: 50px; margin-top: 20px">
            <div class="col-lg-6" style="margin-bottom: 30px; height: 270px">
                <button class="btn btn-style" style="height: inherit; width: 450px; padding: 0px"
                    onclick="window.location='{{ route('manageOwners') }}'">
                    {{-- padding: 35px 90px 35px 90px; --}}
                    <div class="column">
                        <div class="row-sm"><img src="{{ asset('img/dashboard/manageAcc.png') }}" height="103"></div>
                        <div class="row-sm" style="font-size: 30px">MANAGE ACCOUNTS</div>
                    </div>
                </button>
            </div>
            <div class="col-lg-6" style="margin-bottom: 30px; height: 270px">
                <button class="btn btn-style"style="height: inherit; width: 450px; padding: 0px 90px 0px 90px;"
                    onclick="window.location='{{ route('viewReceivedApp') }}'">
                    <div class="column">
                        <div class="row-sm"><img src="{{ asset('img/dashboard/application.png') }}" height="103">
                        </div>
                        <div class="row-sm" style="font-size: 30px">PET SHOOTER'S &nbsp; APPLICATION</div>
                    </div>
            </div>
            </button>
        </div>
        <div class="row" style="margin-bottom: 50px; margin-top: 20px">

            <div class="col-lg-6" style="margin-bottom: 30px; height: 270px">
                <button class="btn btn-style" style="height: inherit; width: 450px; padding: 0px"
                    onclick="window.location='{{ route('bookingreports') }}'">
                    <div class="column">
                        <div class="row-sm"><img src="{{ asset('img/dashboard/reports.png') }}" height="103"></div>
                        <div class="row-sm" style="font-size: 30px"> VIEW REPORTS</div>
                    </div>
                </button>
            </div>
            <div class="col-lg-6" style="margin-bottom: 30px; height: 270px">
                <button class="btn btn-style"style="height: inherit; width: 450px; padding: 0px 90px 0px 90px;"
                    onclick="window.location='{{ url('/subscription') }}'">
                    <div class="column">
                        <div class="row-sm"><img src="{{ asset('img/dashboard/application.png') }}" height="103">
                        </div>
                        <div class="row-sm" style="font-size: 30px">MANAGE &nbsp; SUBSCRIPTIONS</div>
                    </div>
                </button>
            </div>
        </div>
    </div>
@endsection
