<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    {{--
    <link rel="icon" href="{{asset('images/zafiro-logo.png')}}"> --}}
    <link rel="stylesheet" href=".../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            margin: 0 auto;
            height: 100vh;
            background-image: url('{{ asset('images/blue-mountains-3-qhd.jpg') }}');
            background-size: cover;
            background-position: center;
        }

        * {
            margin: 0;
            padding: 0;
        }

        .form {
            max-width: 400px;
            background-image: linear-gradient(to bottom right, #1d3a55, #10202f, #0e0f45);
        }

        input {
            background-color: white !important;
            color: black !important;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="d-flex align-items-center justify-content-center  ">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>