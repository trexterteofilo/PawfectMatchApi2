@extends('layout')
@section('content')
    <!-- The activate Modal -->
    <div class="modal fade" id="activeModal" tabindex="-1" aria-labelledby="activeThisUser" aria-hidden="true">
        <div class="modal-dialog">

            <div class="modal-content">
                <form id="activeform" action="{{ route('activateUser', 1) }}" method="POST">
                    @csrf
                    @method('POST')
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="activeThisUser">Confirmation</h4>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" id="modal-body-edit">
                        <h4>Activate this user?</h4>
                        <input type="hidden" id="userId" name="userId" value="">
                        <input type="hidden" id="acctype" name="acctype" value="">

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">

                        <button class="btn btn-danger" type="submit" id="activeUserBtn">Confirm</button>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- The deactivate Modal -->
    <div class="modal fade" id="deactModal" tabindex="-1" aria-labelledby="deactThisUser" aria-hidden="true">
        <div class="modal-dialog">

            <div class="modal-content">
                <form id="deactform" action="{{ route('deactUser', 1) }}" method="POST">
                    @csrf
                    @method('POST')
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="deactThisUser">Confirmation</h4>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" id="modal-body-edit">
                        <h4>Deactivate this user?</h4>
                        <input type="hidden" id="userId" name="userId" value="">
                        <input type="hidden" id="acctype" name="acctype" value="">

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">

                        <button class="btn btn-danger" type="submit" id="deactUserBtn">Confirm</button>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container login">
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-sm-2">

            </div>
            <div class="col-sm-8 text-center">

                <div class="row-sm" style="font-size: 40px; font-weight: bold; color:white;">DUAL</div>

            </div>
            <div class="col-sm-2 text-center">
            </div>
        </div>
        <div class="row" style="background-color: #dec3f0; padding:  20px 50px 20px 50px ; border-radius: 5px;">
            <div class="col-lg-2">
                {{--  --}}
                {{-- // <img src="{{ asset('img/' . $post->image) }}" /> --}}
                <img src="{{ $dual->image }}" style="height: auto;width:100%; border: 2px solid white;">
                </hr>
            </div>
            <div class="col-lg-10">
                <div class="row pb-1">
                    <div class="col-lg-2 text-start">
                        <h5 class="card-title">ID :</h5>
                    </div>
                    <div class="col-lg-3 text-start">
                        <h5> {{ $dual->userID }}</h5>
                    </div>
                    <div class="col-lg-1 text-start"></div>
                    <div class="col-lg-2 text-start">
                        <h5 class="card-title">Status :</h5>
                    </div>

                    @if ($dual->accountstatus == 'Active')
                        <div class="col-lg-2 text-start">
                            <p class="text-success fw-bold">{{ $dual->accountstatus }}</p>
                        </div>
                        <div class="col-lg-2 text-start">
                            <a href="javascript:void(0)" id="showDeactModal"
                                data-url="{{ route('findOwnerId', $dual->userID) }}" class="btn btn-danger d-inline btn-sm"
                                title="Deactivate User">
                                <i class="fa fa-power-off" aria-hidden="true"></i>
                                Deactivate
                            </a>
                        </div>
                    @elseif($dual->accountstatus == 'Deactivated')
                        <div class="col-lg-2 text-start">

                            <p class="text-danger fw-bold">{{ $dual->accountstatus }}</p>
                        </div>
                        <div class="col-lg-2 text-start">
                            <a href="javascript:void(0)" id="showActivateModal"
                                data-url="{{ route('findOwnerId', $dual->userID) }}" class="btn btn-success d-inline btn-sm"
                                title="Activate User">
                                <i class="fa fa-power-off" aria-hidden="true"></i>
                                Activate
                            </a>
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
                            value="{{ $dual->firstname ?? 'null name' }}   {{ $dual->lastname ?? 'null lastname' }}"
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
                            value="{{ $dual->age }}" readonly>
                    </div>
                </div>
                <div class="row pb-1">
                    <div class="col-lg-2 text-start">
                        <p class="card-text">Address :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <input type="text" id="address" name="address"
                            style="background-color: #e9d6f4; width:  100%; border: 1px solid black; padding: 0px;"
                            value="{{ $dual->address }}" readonly>
                    </div>
                    <div class="col-lg-1 text-start">
                    </div>
                    <div class="col-lg-2 pl-5 text-start" style="padding-left: ">
                        <p class="card-text">Email :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <input type="text" id="email" name="email"
                            style="background-color: #e9d6f4; width: 100%;border: 1px solid black; padding: 0px;"
                            value="{{ $dual->email }}" readonly>
                    </div>
                </div>

            </div>


            {{-- PETS --}}
            <div class="mt-5">
                <div class="row">
                    <div class="col-lg-2" style=" padding:  20px 0px 20px 0px ; border-radius: 5px;">
                        <h3 style="color: white; font-weight: bold;">Pets</h3>
                        <div style="margin-bottom: 5px;">

                            <a href="{{ route('showCatDual', $dual->userID) }}">
                                @if (session('type') == 'Cat Pets')
                                    <button class="btn btn-sidenav"
                                        style="background-color:#c875ff; color:white;">Cat</button>
                                @else
                                    <button class="btn btn-sidenav">Cat</button>
                                @endif
                            </a>
                        </div>
                        <div style="margin-bottom: 5px;">

                            <a href="{{ route('showDogDual', $dual->userID) }}">
                                @if (session('type') == 'Dog Pets')
                                    <button class="btn btn-sidenav"
                                        style="background-color:#c875ff; color:white;">Dog</button>
                                @else
                                    <button class="btn btn-sidenav">Dog</button>
                                @endif
                            </a>
                        </div>
                        <div style="margin-bottom: 5px;">
                            <a href="{{ route('showRabbitDual', $dual->userID) }}">
                                @if (session('type') == 'Rabbit Pets')
                                    <button class="btn btn-sidenav"
                                        style="background-color:#c875ff; color:white;">Rabbit</button>
                                @else
                                    <button class="btn btn-sidenav">Rabbit</button>
                                @endif
                            </a>
                        </div>
                        <div style="margin-bottom: 5px;">
                            <a href="{{ route('showHamsterDual', $dual->userID) }}">
                                @if (session('type') == 'Hamster Pets')
                                    <button class="btn btn-sidenav"
                                        style="background-color:#c875ff; color:white;">Hamster</button>
                                @else
                                    <button class="btn btn-sidenav">Hamster</button>
                                @endif
                            </a>
                        </div>
                        <div style="margin-bottom: 5px;">
                            <a href="{{ route('showBirdDual', $dual->userID) }}">
                                @if (session('type') == 'Bird Pets')
                                    <button class="btn btn-sidenav"
                                        style="background-color:#c875ff; color:white;">Bird</button>
                                @else
                                    <button class="btn btn-sidenav">Bird</button>
                                @endif
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-10"
                        style="background-color: #dec3f0; padding:  20px 50px 20px 50px ; border-radius: 5px;">
                        <div class="row">
                            {{-- <div class="col-lg-8"></div>
                            <div class="col-lg-12 text-center">
                                <div class="form-control input-container" style=" padding:0">
                                    <i class="fa fa-search icon"></i>
                                    <input type="text" class="input-field" style=" padding:0" id="search"
                                        placeholder="Search" name="search">
                                </div>
                            </div> --}}
                        </div>
                        <div class="row">
                            <div id="list">
                                @include('manageAcc.dual.search.petsresults')

                            </div>
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
            // $(".showDeactModal").click(function(event) {
            //     event.preventDefault();
            $('body').on('click', '#showDeactModal', function() {
                var thisURL = $(this).data('url');
                $.get(thisURL, function(data) {
                    $('#deactModal').modal('show');

                    $('#userId').val(data.userID);
                    //     // $('#acctype').val(data.accounttype);

                    // })
                    // $('#deactModal').modal('show');
                    //alert("thisss");
                });
            });


            $(document).on('submit', '#deactform', function(e) {
                e.preventDefault();
                const formData = $(this).serializeArray();
                console.log(formData);

                // Get the row ID from the form

                var ID = $('#userId').val();
                var accType = $('#acctype').val();
                $(this).attr('action', "{{ route('deactUser', ['id' => ':id']) }}"
                    .replace(
                        ':id', ID));
                // $(this).attr('action',
                //     "{{ route('deactUser', ['id' => '+id+']) }}");
                // $(this).attr('action',
                //     "{{ route('deactUser', ['usertype' => '+accType+', 'id' => '+id+']) }}");
                $(this).attr('method', 'POST');

                // AJAX submission or further processing
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),

                    success: function(response) {

                        if (response.message == "User has been deactivated") {
                            alert(response.message);
                            location.reload();

                        }
                        // else {
                        //     alert(session.message);


                        //     $('#showEditModal').modal('show');

                        //     return false;
                        // }
                    },
                    error: function(response) {
                        $(document).ready(function() {
                            alert(response.message);
                        });
                    }
                });
            });



            // $('#showAddModal').on('click', function() {

            //     $('#addModal').modal('show');

        });

        //ACTIVATE
        $('body').on('click', '#showActivateModal', function() {
            var thisURL = $(this).data('url');
            $.get(thisURL, function(data) {
                $('#activeModal').modal('show');

                $('#userId').val(data.userID);
                //     // $('#acctype').val(data.accounttype);

                // })
                // $('#deactModal').modal('show');
                //alert("thisss");
            });
        });


        $(document).on('submit', '#activeform', function(e) {
            e.preventDefault();
            const formData = $(this).serializeArray();
            console.log(formData);

            // Get the row ID from the form

            var ID = $('#userId').val();
            var accType = $('#acctype').val();
            $(this).attr('action', "{{ route('activateUser', ['id' => ':id']) }}"
                .replace(
                    ':id', ID));
            // $(this).attr('action',
            //     "{{ route('deactUser', ['id' => '+id+']) }}");
            // $(this).attr('action',
            //     "{{ route('deactUser', ['usertype' => '+accType+', 'id' => '+id+']) }}");
            $(this).attr('method', 'POST');

            // AJAX submission or further processing
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize(),

                success: function(response) {

                    if (response.message == "User has been Activated") {
                        alert(response.message);
                        location.reload();

                    }
                    // else {
                    //     alert(session.message);


                    //     $('#showEditModal').modal('show');

                    //     return false;
                    // }
                },
                error: function(response) {
                    $(document).ready(function() {
                        alert(response.message);
                    });
                }
            });
        });
    </script>
@endsection
