@extends('layout')
@section('content')
    <div class="container login mt-0">

        <div class="row" style="margin-bottom: 20px; margin-top: 20px">
            <div class="col-sm-2">
                {{-- <div class="row-sm">
                    <a href="{{ url('/home') }}">
                        <img src="{{ asset('img/back.png') }}" alt="PawfectMatch" width="auto" height="35px"></a>

                </div> --}}
            </div>
            <div class="col-sm-8 text-center">

                <div class="row-sm" style="font-size: 40px; font-weight: bold; color:white;">VIEW REPORTS</div>

            </div>
            <div class="col-sm-2 text-center">
            </div>
        </div>
        <div class="container mt-0">
            <div class="row">
                <div class="col-lg-2" style=" padding:  20px 0px 20px 0px ; border-radius: 5px;">
                    <h3 style="color: white; font-weight: bold;">Transactions</h3>
                    <div class="no-indicator-bg">
                        <a href="{{ url('/reports/bookings') }}"> <button class="btn btn-sidenav">Booking</button></a>
                    </div>
                    <div class="indicator-bg">
                        <a href="{{ url('/reports/adoptions') }}"> <button class="btn btn-sidenav">Adoption</button></a>
                    </div>
                    <div class="no-indicator-bg">
                        <a href="{{ url('/reports/agreements') }}"> <button class="btn btn-sidenav">Agreement</button></a>
                    </div>
                    <h3 style="color: white; font-size: 25px; font-weight: bold;margin-top: 20px">Income Report</h3>

                    <div class="no-indicator-bg">
                        <a href="{{ url('//monthly-report') }}"><button class="btn btn-sidenav">Subscription</button></a>
                    </div>
                </div>
                <div class="col-lg-10"
                    style="background-color: #dec3f0; padding:  20px 50px 20px 50px ; border-radius: 5px;">
                    <div class="row">
                        {{-- <div class="col-lg-8"></div> --}}
                        <div class="col-lg-12 text-center d-flex justify-content-between">
                            <div class="form-control input-container" style=" padding:0">
                                <i class="fa fa-search icon"></i>
                                <input type="text" class="input-field" style=" padding:0" id="search"
                                    placeholder="Search" name="search">
                            </div>
                            <div> <a href="{{ url('generate-adoption-pdf') }}" alt="Download PDF">
                                    <i class="fa fa-file-pdf-o icon" style="font-size: 24px"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="list">
                            @include('reports.adoptions.search.results')
                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {


            $('#search').on('keyup', function() {
                var query = $(this).val();

                // if (query.length > 1) {
                $.ajax({
                    url: '/reports/adoptions',
                    method: 'GET',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#list').html(data);
                    }
                });
            });
        });
    </script>
@endsection
