<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Pemilik Kost</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            z-index: 1;
        }

        .form-container {
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
            margin-bottom: 50px;
            margin-left: 100px;
            margin-right: 100px;
            display: ruby-base-container;

        }

        .form-group label {
            font-weight: bold;
        }

        .custom-image {
            border-radius: px;
        }

        .btn-primary {
            background-color: #ffc107;
            border: none;
        }

        .btn-primary:hover {
            background-color: #5a6268;
            border: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center mb-4">Daftar Sebagai Owner</h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register-proses') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ old('email') }}">
                </div>
                <div class="form-group">

                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        value="{{ old('password') }}">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        value="{{ old('password_confirmation') }}">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="showPassword">
                        <label class="custom-control-label" for="showPassword">Show Password</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="btn btn-link">Sudah punya akun?</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#showPassword").click(function() {
                var passwordField = $("#password");
                var passwordConfirmationField = $("#password_confirmation");
                if ($(this).is(":checked")) {
                    passwordField.attr("type", "text");
                    passwordConfirmationField.attr("type", "text");
                } else {
                    passwordField.attr("type", "password");
                    passwordConfirmationField.attr("type", "password");
                }
            });
        });
    </script>
</body>

</html>
