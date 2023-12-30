<!doctype html>
<html lang="en">

<head>
    <title>Settings</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
                    <h2 style="color: white; font-weight:bold">SETTINGS</h2>
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

    <div class="container " style="background-color: white;padding: 35px; border-radius: 15px; margin-bottom: 50px">
        <div class="column">
            <div class="row-md-12" style="">
                <h2>Profile</h2>
                <hr style="border-bottom: 1px solid silver; margin-top:-3px;" />
            </div>
        </div>
        <form action="{{ route('editProfile') }}" method="POST">
            @csrf
            <div class="row align-items-center">
                <div class="col-md-4 text-end">
                    <h4>First Name:</h4>

                </div>
                <div class="col-md-8">
                    <div class="input-container" style="width: 400px; float:left;">
                        <i class="fa fa-user icon"></i>
                        <input type="text" class="form-control input-field border border-secondary" id="firstname"
                            placeholder="Enter Firstname" name="firstname">
                        <br><br>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-4 text-end">
                    <h4>Last Name:</h4>

                </div>
                <div class="col-md-8">
                    <div class="input-container" style="width: 400px; float:left;">
                        <i class="fa fa-user icon"></i>
                        <input type="text" class="form-control input-field border border-secondary" id="lastname"
                            placeholder="Enter Lastname" name="lastname">
                        <br><br>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-4 text-end">
                    <h4>Email:</h4>

                </div>
                <div class="col-md-8">
                    <div class="input-container float-start" style="width: 400px">
                        <i class="fa fa-envelope icon"></i>
                        <input type="email" class="form-control input-field  border border-secondary" id="email"
                            placeholder="Enter Email Address" name="email"> <br><br>
                    </div>
                </div>
            </div>
            <div class="row align-items-center" style="padding-bottom: 35px">
                <div class="col-md-8 text-end">

                    @if (Session::has('editProfileSuccess'))
                        <center>
                            <div style="float: right; color: green; font-weight:bold;">
                                <i class=" fa fa-check"></i> {{ Session::get('editProfileSuccess') }}
                            </div>
                        </center>
                        {{-- <script>
                            $('#modalid').modal('show');
                        </script> --}}
                    @elseif (Session::has('editProfileError'))
                        <center>

                            <div style="float: right; color: red; font-weight:bold;">
                                <i class=" fa fa-exclamation"></i> {{ Session::get('editProfileError') }}
                            </div>
                        </center>
                    @endif
                </div>
                <div class="col-md-4 text-end">
                    <button class="btn btn-login" style="padding:10px;width: 250px">Edit Profile</button>
                </div>
            </div>

        </form>

        <form action="{{ route('changePassword') }}" method="POST">
            @csrf
            <div class="column align-items-end">
                <div class="row-md-12" style="">
                    <h2>Security</h2>
                    <hr style="border-bottom: 1px solid silver; margin-top:-3px;" />
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-4 text-end">
                    <h4>Current Password:</h4>

                </div>
                <div class="col-md-8">
                    <div class="input-container float-start" style="width: 400px">
                        <i class="fa fa-key icon"></i>
                        <input type="password" class="input-field border border-secondary" id="password"
                            placeholder="Enter Password " name="password">
                        <i class="far fa-eye icon" id="togglePassword"
                            style="margin-left: -50px; cursor: pointer;"></i>
                        <br><br>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-4 text-end">
                    <h4>New Password:</h4>

                </div>
                <div class="col-md-8">
                    <div class="input-container float-start" style="width: 400px">
                        <i class="fa fa-key icon"></i>
                        <input type="password" class="input-field border border-secondary" id="newPassword"
                            placeholder="Enter New Password " name="newPassword">
                        <i class="far fa-eye icon" id="toggleNewPassword"
                            style="margin-left: -50px; cursor: pointer;"></i>
                        <br><br>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-4 text-end">
                    <h4>Confirm Password:</h4>

                </div>
                <div class="col-md-8 align-middle">
                    <div class="input-container float-start" style="width: 400px">
                        <i class="fa fa-key icon"></i>
                        <input type="password" class="input-field border border-secondary" id="confPassword"
                            placeholder="Confirm Password " name="confPassword">
                        <i class="far fa-eye icon" id="toggleConfPassword"
                            style="margin-left: -50px; cursor: pointer;"></i>

                        <br><br>
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
                    <button class="btn btn-login " style="padding:10px; width: 250px">Change Password</button>
                </div>
            </div>

        </form>
    </div>
</body>

</html>

<script>
    ////////show Password////////
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function(e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });

    ////////show New Password////////
    const toggleNewPassword = document.querySelector('#toggleNewPassword');
    const newpassword = document.querySelector('#newPassword');

    toggleNewPassword.addEventListener('click', function(e) {
        // toggle the type attribute
        const type2 = newpassword.getAttribute('type') === 'password' ? 'text' : 'password';
        newpassword.setAttribute('type', type2);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });

    ////////show confirm Password////////

    const toggleConPassword = document.querySelector('#toggleConfPassword');
    const conPassword = document.querySelector('#confPassword');

    toggleConPassword.addEventListener('click', function(e) {
        // toggle the type attribute
        const type1 = conPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        conPassword.setAttribute('type', type1);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });
</script>
