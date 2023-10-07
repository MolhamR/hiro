<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
    <title>Document</title>
</head>
<body>
@if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
    <div class="container">
        <form action="{{route('cal.store')}}" method="POST" role="form">
            {{csrf_field()}}
            <legend>Medical Appointments Form</legend>

            <div class="form-group">
                <label for="title">Name:</label>
                <input class="form-control" name="title" placeholder="Enter name" type="text">
            </div>

            <div class="form-group">
                <label for="description">Doctor's Name:</label>
                <input class="form-control" name="description" placeholder="Enter doctor's name" type="text">
            </div>

            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input class="form-control" name="start_date" placeholder="Enter start date" type="text">
            </div>

            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input class="form-control" name="end_date" placeholder="Enter end date" type="text">
            </div>

            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</body>
</html>