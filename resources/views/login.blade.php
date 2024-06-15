<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: sans-serif;
            /* Add a clean font */
        }

        .container {
            margin-top: 50px;
            max-width: 400px;
            /* Set a max width for responsiveness */
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            /* Display labels on their own line */
            margin-bottom: 5px;
        }

        .form-control {
            border-radius: 3px;
            /* Add rounded corners to inputs */
        }

        .btn-primary {
            background-color: #ffc107;
            /* Change button color */
            border: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center mb-4">Login</h2>
            <form action="{{ route('login-proses') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="showPassword">
                        <label class="custom-control-label" for="showPassword">Show Password</label>
                    </div>
                </div>
                <div class="mt-4 pt-2">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $alert)
                                    @if ($loop->first || !in_array($alert, array_slice($errors->all(), 0, $loop->index)))
                                        <li>{{ $alert }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#showPassword").click(function() {
                if ($(this).is(":checked")) {
                    $("#password").attr("type", "text");
                } else {
                    $("#password").attr("type", "password");
                }
            });
        });
    </script>
</body>

</html>
