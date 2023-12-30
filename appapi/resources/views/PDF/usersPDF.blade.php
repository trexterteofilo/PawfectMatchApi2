<!doctype html>
<html lang="en">

<head>
    <title>Users List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('cssfile/style.css') }}">
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        td {
            padding: 5px;
        }
    </style>
</head>

<body class="body-style">
    <center>
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/img/LOGOwithTITLE.png'))) }}"
            width="200px" height="auto" style="padding: 0; margin: 0;">
        <h4 style="padding: 0; margin: 0">M.J. Cuenco Ave, Cor R. Palma Street, 6000 Cebu</h4>
        <h4 style="padding: 0; margin: 0"> (032) 412 1399</h4>
    </center>
    <p>Date/Time:<span style="font-weight: bold"> {{ $date }}</span></p>
    {{-- <p>lorem ipsum sit amte</p> --}}
    <center>
        <h1>{{ $title }}</h1>
    </center>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Contact Number</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->userID }}</td>
                    <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->contactnumber }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <p style="margin-top: 50px;">Prepared by:
        <span style="font-weight: bold;"> {{ $admin->firstname }} {{ $admin->lastname }}</span>
    </p>

</body>

</html>
