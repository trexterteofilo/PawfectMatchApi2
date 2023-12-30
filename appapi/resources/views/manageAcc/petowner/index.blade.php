@extends('layout')
@section('content')
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
                        <input type="hidden" id="userID" name="userID" value="">
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
    {{-- @if (session('activeStatus'))
        <script>
            alert("{{ session('activeStatus') }}");
        </script>
    @elseif (session('deactStatus'))
        <script>
            alert("{{ session('deactStatus') }}");
        </script>
    @endif --}}

    <div class="container login mt-0">

        <div class="row" style="margin-bottom: 20px; margin-top: 20px">
            <div class="col-sm-2">

            </div>
            <div class="col-sm-8 text-center">

                <div class="row-sm" style="font-size: 40px; font-weight: bold; color:white;">Manage Accounts</div>

            </div>
            <div class="col-sm-2 text-center">
            </div>
        </div>
        <div class="container mt-0">
            <div class="row">
                <div class="col-lg-2" style=" padding:  20px 0px 20px 0px ; border-radius: 5px;">
                    <div class="indicator-bg">
                        <a href="{{ url('/manageAccounts/petowners') }}"> <button class="btn btn-sidenav">Pet
                                Owners</button></a>
                    </div>
                    <div class="no-indicator-bg">
                        <a href="{{ url('/manageAccounts/petshooters') }}"> <button class="btn btn-sidenav">Pet
                                Shooters</button></a>
                    </div>
                    <div class="no-indicator-bg">
                        <a href="{{ url('/manageAccounts/dual') }}"> <button class="btn btn-sidenav">Dual</button></a>
                    </div>
                    <div class="no-indicator-bg">
                        <a href="{{ url('/manageAccounts/pets') }}"> <button class="btn btn-sidenav">Pets</button></a>
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
                            <div> <a href="{{ url('generate-petowner-pdf') }}" alt="Download PDF">
                                    <i class="fa fa-file-pdf-o icon" style="font-size: 24px"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="list">
                            @include('manageAcc.petowner.search.results')
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
            $('.clickable-row').on('click', '#showDeactModal', function(event) {
                event.preventDefault();

                var thisURL = $(this).data('url');
                $.get(thisURL, function(data) {
                    $('#deactModal').modal('show');

                    //     $('#userID').val(data.id);
                    //     // $('#acctype').val(data.accounttype);

                    // })
                    // $('#deactModal').modal('show');
                    alert("thisss");
                });
            });



            $('#search').on('keyup', function() {
                var query = $(this).val();

                // if (query.length > 1) {
                $.ajax({
                    url: '/manageAccounts/petowners',
                    method: 'GET',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#list').html(data);
                    }
                });
                // }
                //  else {
                //     // Clear results if the query is empty
                //     $('#list').empty();
                // }
            });

            // // Handle pagination links click
            // $(document).on('click', '.pagination a', function(e) {
            //     e.preventDefault();

            //     var page = $(this).attr('href').split('page=')[1];

            //     $.ajax({
            //         url: '/manageAccounts/petowners?page=' + page,
            //         method: 'GET',
            //         success: function(data) {
            //             $('#list').html(data);
            //         }
            //     });
            // });

        });

        // function getSearch(reults) {
        //     $('#list').empty();

        //     $.each(results, function(index, result) {
        //         $('#list').append('<li>' + result.name + '</li>'
        //             ` <tr class="clickable-row"
    //                                 onclick="window.location='{{ url('manageAccounts/petowners/' . `result.userID`) }}'"
    //                                 title="View Owner">

    //                                 <td>{{ `result.userID ` }}</td>
    //                                 <td>{{ ` result.firstname` ?? 'null name' }}
    //                                     {{ `result.lastname` ?? 'null lastname' }}</td>


    //                                 <td>{{ `result.email` }}</td>
    //                                 <td>{{ `result.address` }}</td>
    //                                 <td>{{ `result.age ` }}</td>
    //                                 <td>
    //                                     @if (`result.accountstatus` == 'Active')
    //                                         <h6 class="text-success">{{ `result.accountstatus` }}</h6>
    //                                     @elseif (`result.accountstatus` == 'Deactivated')
    //                                         <h6 class="text-danger">{{ `result.accountstatus` }}</h6>
    //                                     @endif

    //                                 </td>
    //                             </tr>`);
        //         // Customize this based on your actual model attributes
        //     });
        // };
    </script>
@endsection
