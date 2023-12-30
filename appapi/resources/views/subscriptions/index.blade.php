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

                <div class="row-sm" style="font-size: 40px; font-weight: bold; color:white;">SUBSCRIPTIONS</div>

            </div>
            <div class="col-sm-2 text-center">
            </div>
        </div>
        <div class="container mt-0">
            <div class="row">
                {{-- <div class="col-lg-2" style=" padding:  20px 0px 20px 0px ; border-radius: 5px;">
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
                        <button class="btn btn-sidenav">Subscription</button>
                    </div>
                </div> --}}
                <div class="col-lg-12"
                    style="background-color: #dec3f0; padding:  20px 50px 20px 50px ; border-radius: 5px;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Users</th>
                                <th>Type</th>
                                <th>Plan</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- // @forelse ($adoptions->chunk(10) as $chunkedadoptions) --}}
                            @foreach ($subs as $item)
                                <tr class="clickable-row"
                                    onclick="window.location='{{ url('/subscription/' . $item->id) }}'"
                                    title="View Subscription">

                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->subs_user }}</td>
                                    <td>{{ $item->sub_type }}</td>
                                    <td>{{ $item->subs_plan }}</td>
                                    <td>{{ $item->subs_price }}</td>
                                    {{-- <td>
                       //<a href="{{ url('/adoption/'.$item->id) }}"></a>
                        <a href="{{ url('/adoptions/' . $item->id) }}" title="View Adoptions"><button
                                class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                        <a href="{{ url('/adoptions/' . $item->id . '/edit') }}" title="Edit Student"><button
                                class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                Edit</button></a>

                        <form method="POST" action="{{ url('/adoptions' . '/' . $item->id) }}" accept-charset="UTF-8"
                            style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Student"
                                onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"
                                    aria-hidden="true"></i> Delete</button>
                        </form>
                        </td> --}}

                                </tr>
                            @endforeach
                            {{-- @empty
                                <tr>There is no data in table</tr>
                            @endforelse --}}
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!! $subs->links() !!}
                    </div>
                </div>
            </div>


        </div>


    </div>
@endsection
