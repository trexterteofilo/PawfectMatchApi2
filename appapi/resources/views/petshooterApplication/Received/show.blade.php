@extends('layout')
@section('styles')
    <style>
        /* Add some basic styling for demonstration purposes */
        .image-container {
            display: flex;
            overflow-x: auto;
            /* Enable horizontal scrolling if needed */
        }

        .image-item {
            margin-right: 10px;
            /* Adjust spacing between images */
        }
    </style>
@endsection
@section('content')
    <!-- The activate Modal -->
    <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveThisApplication" aria-hidden="true">
        <div class="modal-dialog">

            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="approveThisApplication">Confirmation</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="modal-body-edit">
                    <h4>Approve this application?</h4>
                    <input type="hidden" id="petshooterAppId" name="petshooterAppId" value="">

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <form action="{{ route('approveApplication', $petshooterapp->petshooterAppID) }}" method="POST"
                        role="search">
                        @csrf
                        <button class="btn btn-danger" type="submit" id="activeUserBtn">Confirm</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                </div>
            </div>
        </div>
    </div>
    <!-- The deactivate Modal -->
    <div class="modal fade" id="declineModal" tabindex="-1" aria-labelledby="deactThisUser" aria-hidden="true">
        <div class="modal-dialog">

            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="deactThisUser">Confirmation</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="modal-body-edit">
                    <h4>Deactivate this user?</h4>
                    <input type="hidden" id="petshooterAppId" name="petshooterAppId" value="">
                    <input type="hidden" id="acctype" name="acctype" value="">

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <form action="{{ route('declineApplication', $petshooterapp->petshooterAppID) }}" method="POST"
                        role="search">
                        @csrf
                        <button class="btn btn-danger" type="submit" id="deactUserBtn">Confirm</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                </div>
            </div>
        </div>
    </div>




    <div class="container login">
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-sm-2">

            </div>
            <div class="col-sm-8 text-center">

                <div class="row-sm" style="font-size: 40px; font-weight: bold; color:white;">PET SHOOTER</div>

            </div>
            <div class="col-sm-2 text-center">
            </div>
        </div>
        <div class="row" style="background-color: #dec3f0; padding:  20px 50px 20px 50px ; border-radius: 5px;">
            <div class="col-lg-2">
                {{--  --}}
                {{-- // <img src="{{ asset('img/' . $post->image) }}" /> --}}
                <img src="{{ $petshooterapp->petshooter->image }}"
                    style="height: 115px;width:115px; border: 2px solid white;">
                </hr>
            </div>
            <div class="col-lg-10">
                <div class="row pb-1">
                    <div class="col-lg-2 text-start">
                        <h5 class="card-title">ID :</h5>
                    </div>
                    <div class="col-lg-3 text-start">
                        <h5> {{ $petshooterapp->petshooterAppID }}</h5>
                    </div>
                    <div class="col-lg-1 text-start"></div>
                    <div class="col-lg-2 text-start">
                        <h5 class="card-title">Status :</h5>
                    </div>

                    @if ($petshooterapp->verification_status == 'Pending')
                        <div class="col-lg-2 text-start">
                            <p class="fw-bold" style="color: #fd7e14;">{{ $petshooterapp->verification_status }}</p>
                        </div>
                    @endif
                </div>
                <div class="row pb-1">
                    <div class="col-lg-2 text-start">
                        <p class="card-text">Name :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <input type="text" id="name" name="name"
                            style="background-color: #e9d6f4; width: 100%; border: 1px solid black; padding: 0px;"
                            value="{{ $petshooterapp->petshooter->firstname ?? 'null name' }}   {{ $petshooterapp->petshooter->lastname ?? 'null lastname' }}"
                            readonly>
                    </div>
                    <div class="col-lg-1 text-start">
                    </div>
                    <div class="col-lg-2 pl-5 text-start" style="padding-left: ">
                        <p class="card-text">Age :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <input type="text" id="email" name="email"
                            style="background-color: #e9d6f4; width: 100%;border: 1px solid black; padding: 0px;"
                            value="{{ $petshooterapp->petshooter->age }}" readonly>
                    </div>
                </div>
                <div class="row pb-1">
                    <div class="col-lg-2 text-start">
                        <p class="card-text">Address :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <input type="text" id="address" name="address"
                            style="background-color: #e9d6f4; width:  100%; border: 1px solid black; padding: 0px;"
                            value="{{ $petshooterapp->petshooter->address }}" readonly>
                    </div>
                    <div class="col-lg-1 text-start">
                    </div>
                    <div class="col-lg-2 pl-5 text-start" style="padding-left: ">
                        <p class="card-text">Email :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <input type="text" id="email" name="email"
                            style="background-color: #e9d6f4; width: 100%;border: 1px solid black; padding: 0px;"
                            value="{{ $petshooterapp->petshooter->email }}" readonly>
                    </div>
                </div>

            </div>
            <div class="row mt-5">

                <h5>Breed Types</h5>
                <ul>
                    @foreach ($petshootertype as $breedType)
                        <li>{{ $breedType->name }}</li>
                        <!-- Add more fields as needed -->
                    @endforeach
                </ul>
                <div class="container w-100">

                    <h5>Credential Images</h5>
                    {{-- <div class="row">
                        @foreach ($petshooterimg as $img)
                            <div class="colx"> <img src="{{ $img->image }}}"
                                    style="height: 115px;width:115px; border: 2px solid white;"></div>
                        @endforeach
                    </div> --}}
                    <div>
                        @foreach ($petshooterimg as $img)
                            <img src="{{ $img->image }}}" style="height: 115px;width:115px; border: 2px solid white;">

                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-6 text-end">
                <a href="" id="showApproveModal" data-bs-toggle="modal" data-bs-target="#approveModal"
                    class="btn btn-success d-inline btn-sm" title="Accept">
                    <i class="fa fa-check" aria-hidden="true"></i>
                    Accept
                </a>
            </div>
            <div class="col-lg-6 text-start">
                <a href="" id="showDeclineModal" data-bs-toggle="modal" data-bs-target="#declineModal"
                    class="btn btn-danger d-inline btn-sm" title="Decline">
                    <i class="fa fa-remove" aria-hidden="true"></i>
                    Decline
                </a>
            </div>
        </div>

    </div>


    </div>
@endsection
