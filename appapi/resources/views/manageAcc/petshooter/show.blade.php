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

                <div class="row-sm" style="font-size: 40px; font-weight: bold; color:white;">PET SHOOTER</div>

            </div>
            <div class="col-sm-2 text-center">
            </div>
        </div>
        <div class="row" style="background-color: #dec3f0; padding:  20px 50px 20px 50px ; border-radius: 5px;">
            <div class="col-lg-2">
                {{--  --}}
                {{-- // <img src="{{ asset('img/' . $post->image) }}" /> --}}
                <img src="{{ $petshooter->image }}" style="height: 115px;width:115px; border: 2px solid white;">
                </hr>
            </div>
            <div class="col-lg-10">
                <div class="row pb-1">
                    <div class="col-lg-2 text-start">
                        <h5 class="card-title">ID :</h5>
                    </div>
                    <div class="col-lg-3 text-start">
                        <h5> {{ $petshooter->userID }}</h5>
                    </div>
                    <div class="col-lg-1 text-start"></div>
                    <div class="col-lg-2 text-start">
                        <h5 class="card-title">Status :</h5>
                    </div>

                    @if ($petshooter->accountstatus == 'Active')
                        <div class="col-lg-2 text-start">
                            <p class="text-success fw-bold">{{ $petshooter->accountstatus }}</p>
                        </div>
                        <div class="col-lg-2 text-start">
                            <a href="javascript:void(0)" id="showDeactModal"
                                data-url="{{ route('findOwnerId', $petshooter->userID) }}"
                                class="btn btn-danger d-inline btn-sm" title="Deactivate User">
                                <i class="fa fa-power-off" aria-hidden="true"></i>
                                Deactivate
                            </a>
                        </div>
                    @elseif($petshooter->accountstatus == 'Deactivated')
                        <div class="col-lg-2 text-start">

                            <p class="text-danger fw-bold">{{ $petshooter->accountstatus }}</p>
                        </div>
                        <div class="col-lg-2 text-start">
                            <a href="javascript:void(0)" id="showActivateModal"
                                data-url="{{ route('findOwnerId', $petshooter->userID) }}"
                                class="btn btn-success d-inline btn-sm" title="Activate User">
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
                            value="{{ $petshooter->firstname ?? 'null name' }}   {{ $petshooter->lastname ?? 'null lastname' }}"
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
                            value="{{ $petshooter->age }}" readonly>
                    </div>
                </div>
                <div class="row pb-1">
                    <div class="col-lg-2 text-start">
                        <p class="card-text">Address :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <input type="text" id="address" name="address"
                            style="background-color: #e9d6f4; width:  100%; border: 1px solid black; padding: 0px;"
                            value="{{ $petshooter->address }}" readonly>
                    </div>
                    <div class="col-lg-1 text-start">
                    </div>
                    <div class="col-lg-2 pl-5 text-start" style="padding-left: ">
                        <p class="card-text">Email :</p>
                    </div>
                    <div class="col-lg-3 text-start">
                        <input type="text" id="email" name="email"
                            style="background-color: #e9d6f4; width: 100%;border: 1px solid black; padding: 0px;"
                            value="{{ $petshooter->email }}" readonly>
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
