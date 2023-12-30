<!doctype html>
<html lang="en">

<head>
    <title>Login Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('cssfile/style.css') }}">
</head>

<body class="body-style">
    <div class="container login">
        <img src="{{ asset('img/LOGOwithTITLE.png') }}" alt="PawfectMatch" width="500" height="auto">
        <h1 class="admin-text">Admin</h1> <br>
        <div class="form-style">
            @if (Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error') }}
                </div>
                {{-- @else
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('success') }}
                </div> --}}
            @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="input-container">
                    <i class="fa fa-envelope icon"></i>
                    <input type="email" class="form-control  input-field" id="email"
                        placeholder="Enter Email Address" name="email"> <br><br>
                </div>

                <div class="input-container">
                    <i class="fa fa-key icon"></i>
                    <input type="password" class="form-control  input-field" id="password"
                        placeholder="Enter Password " name="password">
                    <i class="far fa-eye icon" id="togglePassword" style="margin-left: -50px; cursor: pointer;"></i>
                    <br><br>

                </div>
                <button class="btn btn-login">Login</button>
                <p>Don't have an account? <a href="{{ url('/register') }}">Register</a></p>

            </form>
        </div>
    </div>
</body>

</html>



<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function(e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });
</script>
