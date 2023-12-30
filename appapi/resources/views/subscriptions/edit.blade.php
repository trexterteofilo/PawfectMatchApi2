<!doctype html>
<html lang="en">

<head>
    <title>{{ $sub->id }} - Edit Subscription</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('cssfile/style.css') }}">
</head>

<body class="body-style">
    <nav class="navbar navbar-expand-sm navbar-style">
        <div class="container-fluid">
            <!-- Links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        <img src="{{ asset('img/LOGOwithTITLE.png') }}" alt="PawfectMatch" width="200px"
                            height="auto">
                    </a>
                </li>
            </ul>
            <ul class="nav justify-content-center" style="padding-top: 10px">
                <li class="nav-item">
                    <h2 style="color: white; font-weight:bold">Edit Subscription</h2>
                </li>
            </ul>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link" href="#" style="text-decoration: none; ">
                        <img src="{{ asset('img/dashboard/notification.png') }}" class="rounded-circle" alt="Profile"
                            width="35" height="35">
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link " data-bs-toggle="dropdown" href="#" style="text-decoration: none;">
                        {{-- <img src="{{ asset('img/profpic.png') }}" class="rounded-circle" alt="Profile" width="35"
                            height="35"> --}}
                        <h3>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h3>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ url('/settings') }}">SETTINGS</a></li>
                        <li><a class="dropdown-item" href="" data-bs-toggle="modal"
                                data-bs-target="#myModal">LOGOUT</a></li>
                        {{-- <li><a class="dropdown-item" href="#">Link 3</a></li> --}}
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <!-- The Logout Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Are you sure you want to logout?</h4>
                </div>

                <!-- Modal body -->
                {{-- <div class="modal-body">
                    Modal body..
                </div> --}}

                <!-- Modal footer -->
                <div class="modal-footer">
                    <form action="{{ route('logout') }}" method="POST" role="search">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary" type="submit">Yes</button>
                    </form>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>

                </div>

            </div>
        </div>
    </div>



    {{-- The success edit profile modal --}}
    {{--
    <div class="modal fade" id="modalid">
        <div class="modal-dialog">
            <div class="modal-content">

              // Modal Header
                <div class="modal-header">
                    <h4 class="modal-title"> {{ Session::get('editProfileSuccess') }}</h4>
                </div>

             // Modal body
                <div class="modal-body">
                    Modal body..
                </div>

              //Modal footer
                <div class="modal-footer justify-center">
                    <a href="{{ url('/home') }}"> <button class="btn btn-primary">OK</button></a>

                </div>
            </div>
        </div>
    </div> --}}
    <!--
     end here -->

    <!-- The Edit Benefit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editBenefits" aria-hidden="true">
        <div class="modal-dialog">

            <div class="modal-content">
                <form id="tagform" action="{{ route('editSubBenefit', 1) }}" method="POST">
                    @csrf
                    @method('POST')
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="editBenefits">EDIT BENEFITS</h4>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" id="modal-body-edit">
                        <input type="hidden" id="subsID" name="subsID" value="">

                        <input type="hidden" id="rowIdField" name="rowId" value="">
                        Benefits: <input type="text" class="form-control input-field border border-secondary"
                            id="benefit" placeholder="Enter benefit" name="benefit" value="">
                        Cons:
                        <select class ="form-select  border border-secondary" id="cons" name="cons">
                            <option value="1">
                                Yes
                            </option>
                            <option value="0">
                                No
                            </option>
                        </select>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">

                        <button class="btn btn-primary" type="submit" id="editBenefitBtn">Confirm</button>

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- The Add Benefit Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addBenefits" aria-hidden="true">
        <div class="modal-dialog  modal-lg">

            <div class="modal-content">
                <form id="addBenefitform" action="{{ route('addSubBenefits', $sub->id) }}" method="POST">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="addBenefits">ADD BENEFITS</h4>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" id="modal-body-add">

                        <div class="row">
                            <div class="col-lg-8">
                                Benefits:
                            </div>
                            <div class="col-lg-2">
                                Cons:
                            </div>
                            <div class="col-lg-2 align-self-end">
                            </div>
                        </div>
                        <div id="addInputs">
                            <div class="row">
                                <div class="col-lg-8">
                                    <input type="text" class="form-control input-field border border-secondary"
                                        id="addbenefit" placeholder="Enter benefit" name="inputs[0][addbenefit]"
                                        value="">
                                </div>
                                <div class="col-lg-2">
                                    <select class ="form-select border border-secondary" id="addcons"
                                        name="inputs[0][addcons]">
                                        <option value="">
                                            SELECT
                                        </option>
                                        <option value="1">
                                            Yes
                                        </option>
                                        <option value="0">
                                            No
                                        </option>
                                    </select>
                                </div>
                                <div class="col-lg-2 align-self-end">
                                    <button class="btn btn-success w-100" id="addBenefitBtn">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        @if (isset($message))
                            {{-- //   window.onload = function() { --}}
                            <div style="float: right; color: red; font-weight:bold;">
                                {{ $message }} </div>
                            {{-- /  Display the message(you can customize this)
                                //     window.history.back(); // Redirect back without reloading
                                //  }; --}}
                        @endif
                        <button class="btn btn-primary" type="submit" id="addBenefitBtn">Add</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    @if (Session::has('addBenefitSuccess'))
        <script>
            alert("{{ Session::get('addBenefitSuccess') }}");
        </script>
        {{-- @elseif(Session::has('addBenefiterror'))
        <script>
            //   window.onload = function() {
            alert("{{ Session::get('addBenefiterror') }}"); // Display the message (you can customize this)
            //     window.history.back(); // Redirect back without reloading
            //  };
        </script> --}}
        {{-- @elseif ($errors->any())
        <script>
            alert( < ul >
                    @foreach ($errors->all() as $error)
                        <
                        li > {{ $error }} "</li>
                    @endforeach <
                    /ul> );
        </script> --}}
    @endif
    {{-- (session('addBenefitError'))
        <script>
            alert("{{ session('addBenefitError') }}");
        </script>
    @endif --}}

    {{-- @if  --}}

    {{-- 
    @if (session('addBenefitError'))
        <script>
            alert("{{ session('addBenefitError') }}");
        </script>
    @endif --}}

    {{-- @if (Session::has('editSubSuccess'))
        <script>
            alert("{{ Session::get('editSubSuccess') }}");
        </script>
        <!-- @elseif (Session::has('editSubSuccess'))
         <script>
            alert("{{ Session::get('editSubSuccess') }}");
        </script> -->
    @endif --}}



    <div class="container " style="background-color: white;padding: 35px; border-radius: 15px; margin-bottom: 50px">
        <div class="column">
            <div class="row-md-12" style="">
                <h2>Subscription</h2>
                <hr style="border-bottom: 1px solid silver; margin-top:-3px;" />
            </div>
        </div>
        <form action="{{ route('editSubscription', $sub->id) }}" method="POST">
            @csrf
            <div class="row align-items-center">
                <div class="col-md-4 text-end">
                    <h4>Users:</h4>

                </div>
                <div class="col-md-8">
                    <div class="input-container" style="width: 400px; float:left;">
                        {{-- <input type="text" class="form-control input-field border border-secondary" id="name"
                            placeholder="Enter Name" name="name" value="{{ $sub->subs_user }}"> --}}

                        <select class ="form-select border border-secondary" id="users" name="users">
                            <option value="pet_owner" @if ($sub->subs_user == 'pet_owner') selected='selected' @endif>
                                Pet Owner
                            </option>
                            <option value="pet_shooter" @if ($sub->subs_user == 'pet_shooter') selected='selected' @endif>
                                Pet Shooter
                            </option>
                            <option value="dual" @if ($sub->subs_user == 'dual') selected='selected' @endif>
                                Dual
                            </option>
                        </select>
                        <br><br>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-4 text-end">
                    <h4>Type:</h4>

                </div>
                <div class="col-md-8">
                    <div class="input-container float-start" style="width: 400px">
                        {{-- <input type="email" class="form-control input-field  border border-secondary"
                            id="email" placeholder="Enter Email Address" name="email"> <br><br> --}}
                        <select class ="form-select border border-secondary" id="type" name="type">
                            <option value="Basic" @if ($sub->sub_type == 'Basic') selected='selected' @endif>
                                Basic
                            </option>
                            <option value="Premium" @if ($sub->sub_type == 'Premium') selected='selected' @endif>
                                Premium
                            </option>

                        </select>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-4 text-end">
                    <h4>Plan:</h4>

                </div>
                <div class="col-md-8">
                    <div class="input-container float-start" style="width: 400px">
                        {{-- <input type="email" class="form-control input-field  border border-secondary"
                            id="email" placeholder="Enter Email Address" name="email"> <br><br> --}}
                        <select class ="form-select border border-secondary" id="plan" name="plan">
                            <option value="Monthly" @if ($sub->subs_plan == 'Monthly') selected='selected' @endif>
                                Monthly
                            </option>
                            <option value="Annually" @if ($sub->subs_plan == 'Annually') selected='selected' @endif>
                                Annually
                            </option>

                        </select>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-4 text-end">
                    <h4>Price:</h4>

                </div>
                <div class="col-md-8">
                    <div class="input-container float-start" style="width: 400px">
                        <input type="text" class="form-control input-field border border-secondary" id="price"
                            placeholder="Enter Price" name="price"
                            @if (Session::has('editSubError')) value="" @else value="{{ $sub->subs_price }}" @endif>
                        {{-- <select class ="form-control" id="plan" name="plan">
                            <option value="Monthly" @if ($sub->subs_plan == 'Monthly') selected='selected' @endif>
                                Monthly
                            </option>
                            <option value="Annually" @if ($sub->subs_plan == 'Annually') selected='selected' @endif>
                                Annually
                            </option>

                        </select> --}}
                    </div>
                </div>
            </div>
            <div class="row align-items-center" style="padding-bottom: 35px">
                <div class="col-md-8 text-end">
                    @if (Session::has('editSubSuccess'))
                        <center>
                            <div style="float: right; color: green; font-weight:bold;">
                                <i class=" fa fa-check"></i> {{ Session::get('editSubSuccess') }}
                            </div>
                        </center>
                        {{-- <script>
                            $('#modalid').modal('show');
                        </script> --}}
                    @elseif (Session::has('editSubError'))
                        <center>

                            <div style="float: right; color: red; font-weight:bold;">
                                <i class=" fa fa-exclamation"></i> {{ Session::get('editSubError') }}
                            </div>
                        </center>
                    @endif

                </div>
                <div class="col-md-4 text-end">
                    <button class="btn btn-login" style="padding:10px;width: 250px">Edit Subscription</button>
                </div>
            </div>

        </form>


        <div class="column align-items-end">
            <div class="row-md-12" style="display: flex">
                <h2>Benefits</h2> <button class="btn btn-success" style="margin-left: 20px; height: 40px"
                    title="Add Benefits" id="showAddModal"><i class="fa fa-plus"></i></button>
                <hr style="border-bottom: 1px solid silver; margin-top:-3px;" />
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-12"
                style="background-color: #dec3f0; padding:  20px 50px 20px 50px ; border-radius: 5px;">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Benefits</th>
                            <th>Cons</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- // @forelse ($adoptions->chunk(10) as $chunkedadoptions) --}}
                        @foreach ($benefits as $item)
                            <tr class="clickable-row text-center" {{-- onclick="window.location='{{ url('/subscription/' . $item->id) }}'"
                                    title="View Subscription" --}}>

                                <td id="id">{{ $item->id }}</td>
                                <td id="benefitID">{{ $item->subs_benefit }}</td>
                                @if ($item->subs_cons == '0')
                                    <td id="consID">No </td>
                                @else
                                    <td id="consID">Yes</td>
                                @endif
                                <td class="col-sm-3 mt-0">
                                    <a href="javascript:void(0)" id="showEditModal"
                                        data-url="{{ route('subBenefit', $item->id) }}"
                                        class="btn btn-primary btn-sm" title="Edit Benefit">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route('deleteSubBenefits', $item->id) }}"
                                        accept-charset="UTF-8" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Benefit"
                                            onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                        {{-- @empty
                                <tr>There is no data in table</tr>
                            @endforelse --}}
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $benefits->links() !!}
                </div>
            </div>
        </div>

        <div class="row align-items-center" style="padding-bottom: 35px">
            <div class="col-md-8 text-end">

                @if (Session::has('changePassSuccess'))
                    <center>
                        <div style="float: right; color: green; font-weight:bold;">
                            <i class=" fa fa-check"></i> {{ Session::get('changePassSuccess') }}
                        </div>
                    </center>
                    {{-- <script>
                            $('#modalid').modal('show');
                        </script> --}}
                @elseif (Session::has('changePassError'))
                    <center>

                        <div style="float: right; color: red; font-weight:bold;">
                            <i class=" fa fa-exclamation"></i> {{ Session::get('changePassError') }}
                        </div>
                    </center>
                @endif
            </div>
            <div class="col-md-4 text-end">
            </div>
        </div>

    </div>
</body>

</html>



<script>
    $(document).ready(function() {

        $('body').on('click', '#showEditModal', function() {
            var benefitsURL = $(this).data('url');
            $.get(benefitsURL, function(ey) {
                $('#editModal').modal('show');
                $('#benefit').val(ey.subs_benefit);

                $('#cons').val(ey.subs_cons);

                $('#rowIdField').val(ey.id);
                $('#subsID').val(ey.subs_id);


            });


            $(document).on('submit', '#tagform', function(e) {
                e.preventDefault();
                const formData = $(this).serializeArray();
                console.log(formData);

                // Get the row ID from the form
                const rowId = $('#rowIdField').val();
                var consval = $('#cons').val();
                var subId = parseInt($('#subsID').val());
                $(this).attr('action', "{{ route('editSubBenefit', ['id' => ':id']) }}"
                    .replace(
                        ':id', rowId));
                $(this).attr('method', 'POST');

                // AJAX submission or further processing
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),

                    success: function(response) {

                        if (response.message != "Input Benefit") {
                            alert(response.message);
                            location.reload();

                        } else {
                            alert(response.message);


                            $('#showEditModal').modal('show');

                            return false;
                        }
                    },
                    error: function(response) {
                        $(document).ready(function() {
                            alert(response.message);
                        });
                    }
                });
            });
        });


        $('#showAddModal').on('click', function() {

            $('#addModal').modal('show');

        });

        var i = 0;
        $('#addBenefitBtn').click(function(e) {
            e.preventDefault();
            ++i;
            $('#addInputs').prepend(`  <div class="row" style="margin-bottom: 5px;">
                            <div class="col-lg-8">
                                <input type="text" class="form-control input-field border border-secondary"
                                    id="addbenefit" placeholder="Enter benefit" name="inputs['+i+'][addbenefit]" value="">
                            </div>
                            <div class="col-lg-2">
                                <select class ="form-select border border-secondary" id="addcons" name="inputs['+i+'][addcons]">
                                        <option value="">
                                            SELECT
                                        </option>
                                    <option value="1">
                                        Yes
                                    </option>
                                    <option value="0">
                                        No
                                    </option>
                                </select>
                            </div>
                            <div class="col-lg-2 align-self-end">
                                <button class="btn btn-danger w-100 removeBenefitBtn">Remove</button>
                            </div>
                        </div>`);

        });
        $('#addModal').submit(function(e) {
            //   e.preventDefault();
            // let addBenefitVal = $('#addbenefit').val();
            // let addConsVal = $('#addcons').val();
            // $("#addBenefitform :input").each(function() {
            // var fields = $("#addBenefitform :input");
            var error;
            // alert(field);
            // for (var j = 0; j < fields.length - 4; j++) {
            //     //   var fieldValue = fields.eq(i).val();
            //     let addBenefitVal = inputs[j][addbenefit].val();
            //     let addConsVal = inputs[j][addbenefit].val();
            //     //  console.log("Field Name: " + fields[i].name + ", Field Value: " + fieldValue);
            //     // Add your validation or processing logic here
            //     if (addBenefitVal === '' && addConsVal === '') {
            //         error = 3;
            //     } else if (addConsVal === '') {
            //         error = 2;
            //     } else if (addBenefitVal === '') {
            //         error = 1;

            //     }
            // }
            $("#addBenefitform input[type='text'], #addBenefitform select").each(function() {
                if (($(this).is('input') && $(this).val().trim() === '') && ($(this).is(
                        'select') && $(this).val().trim() === '')) {
                    error = 3;
                } else if ($(this).is('input') && $(this).val().trim() === '') {
                    // Check if the input is empty
                    error = 1;
                    return false;
                } else if ($(this).is('select') && $(this).val().trim() === '') {
                    error = 2;
                }
            });
            // $("#addBenefitform input[type='text']").each(function() {
            //     if ($(this).val().trim() === '') {
            //         // Check if the input is empty
            //         error = 1;
            //         return false;
            //     }
            // });
            // $("#addBenefitform select").each(function() {
            //     if ($(this).val().trim() === '') {
            //         // Check if the input is empty
            //         error = 2;
            //         return false;
            //     }
            // });
            // if(error==3)
            // Check if the input value is empty
            if (error === 3) {
                alert('Input required fields!');
                e.preventDefault(); // Exit the loop early if one input is invalid

            } else
            if (error === 2) {
                alert('Select Cons Options!');
                e.preventDefault(); // Exit the loop early if one input is invalid
            } else if (error === 1) {
                alert('Input Benefit!');
                e.preventDefault(); // Exit the loop early if one input is invalid
            }
        });
        // $(document).on('submit', '#addBenefitform', function(e) {
        //     e.preventDefault();
        //     const formData = $(this).serializeArray();
        //     console.log(formData);

        //     // Get the row ID from the form
        //     // const rowId = $('#rowIdField').val();
        //     // var consval = $('#cons').val();
        //     var subId = parseInt($('#subsID').val());
        //     $(this).attr('action', "{{ route('addSubBenefits', ['id' => ':id']) }}"
        //         .replace(
        //             ':id', subId));
        //     $(this).attr('method', 'POST');

        //     // AJAX submission or further processing
        //     $.ajax({
        //         url: $(this).attr('action'),
        //         method: $(this).attr('method'),
        //         data: $(this).serialize(),

        //         success: function(response) {

        //             if (response.message != "Input Benefit") {
        //                 alert(response.message);
        //                 location.reload();

        //             } else {
        //                 alert(response.message);


        //                 $('#showEditModal').modal('show');

        //                 return false;
        //             }
        //         },
        //         error: function(response) {
        //             $(document).ready(function() {
        //                 alert(response.message);
        //             });
        //         }
        //     });
        // });
        // $.ajax({
        //   
        //     method: 'GET',
        //     dataType: 'json',
        //     success: function(response) {
        //         if (response.message) {
        //             // Display the message in your container
        //             $('#messageContainer').text(response.message);
        //         }
        //     },
        //     error: function() {
        //         // Handle the error
        //         console.error('Error in the AJAX request');
        //     }
        // });

        // $('#addModal').submit(function(e) {
        //     e.preventDefault();
        //     // let addBenefitVal = $('#addbenefit').val();
        //     // let addConsVal = $('#addcons').val();
        //     // $("#addBenefitform :input").each(function() {
        //     var fields = $("#addBenefitform :input");
        //     var error;
        //     alert(fields.length - 4);
        //     for (var j = 0; j < i; j++) {
        //         //   var fieldValue = fields.eq(i).val();
        //         let addBenefitVal = inputs[j][addbenefit].val();
        //         let addConsVal = inputs[j][addbenefit].val();
        //         //  console.log("Field Name: " + fields[i].name + ", Field Value: " + fieldValue);
        //         // Add your validation or processing logic here
        //         if (addBenefitVal === '' && addConsVal === '') {
        //             alert('Input required fields!');
        //         } else if (addConsVal === '') {
        //             alert('Select Cons Options!');
        //         } else if (addBenefitVal === '') {
        //             alert('Input Benefit!');

        //         }
        //     }

        //     if(error==3)
        //     // Check if the input value is empty

        // });

        $(document).on('click', '.removeBenefitBtn', function(e) {
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });
        //         $('#addBenefitform').submit(function(e){
        // e.preventDefault();
        // $
        //         });

    });
</script>
