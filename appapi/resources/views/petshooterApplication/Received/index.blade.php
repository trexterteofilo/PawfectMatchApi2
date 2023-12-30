@extends('layout')
@section('content')
    <div class="container login mt-0">

        <div class="row" style="margin-bottom: 20px; margin-top: 20px">
            <div class="col-sm-2">

            </div>
            <div class="col-sm-8 text-center">

                <div class="row-sm" style="font-size: 40px; font-weight: bold; color:white;">Pet Shooter Application</div>

            </div>
            <div class="col-sm-2 text-center">
            </div>
        </div>
        <div class="container mt-0">
            <div class="row">
                <div class="col-lg-2" style=" padding:  20px 0px 20px 0px ; border-radius: 5px;">
                    <div class="indicator-bg">
                        <a href="{{ url('/petshooterApplication/received') }}"> <button
                                class="btn btn-sidenav">Received</button></a>
                    </div>
                    <div class="no-indicator-bg">
                        <a href="{{ url('/petshooterApplication/approved') }}"> <button
                                class="btn btn-sidenav">Approved</button></a>
                    </div>
                    <div class="no-indicator-bg">
                        <a href="{{ url('/petshooterApplication/declined') }}"> <button
                                class="btn btn-sidenav">Declined</button></a>
                    </div>

                </div>
                <div class="col-lg-10 text-center"
                    style="background-color: #dec3f0; padding:  20px 50px 20px 50px ; border-radius: 5px;">
                    <div class="row">
                        {{-- <div class="col-lg-8"></div> --}}
                        <div class="col-lg-12 text-center">
                            <div class="form-control input-container" style=" padding:0">
                                <i class="fa fa-search icon"></i>
                                <input type="text" class="input-field" style=" padding:0" id="search"
                                    placeholder="Search" name="search">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="list">
                            @include('petshooterApplication.received.search.results')
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
                    url: '/petshooterApplication/received',
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
