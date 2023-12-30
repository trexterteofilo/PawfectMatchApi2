<!doctype html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('cssfile/style.css') }}">
    {{-- jquery --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    {{-- animals icons --}}
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    {{-- chartjs --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('styles');

</head>


<body class="body-style">
    <nav class="navbar navbar-expand-sm navbar-style">
        <div class="container-fluid">
            <!-- Links -->
            <ul class="navbar-nav">
                <li class="nav-item">

                    <a class="navbar-brand" href="{{ url('/home') }}">
                        <img src="{{ asset('img/LOGOwithTITLE.png') }}" alt="PawfectMatch" width="200px"
                            height="auto"></a>
                </li>
            </ul>

            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#" style="text-decoration: none;  ">
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
                        <li><a class="dropdown-item" href="{{ route('settings') }}">SETTINGS</a></li>
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

                {{-- <!-- Modal body -->
                <div class="modal-body">
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

    @yield('content');
</body>

</html>
@yield('scripts');
