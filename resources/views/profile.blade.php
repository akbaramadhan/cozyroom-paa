<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .profile-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            text-align: center;
        }

        .profile-header img {
            border-radius: 50%;
            cursor: pointer;
            max-width: 150px;
            height: auto;
            transition: transform 0.3s ease;
            /* Efek transisi saat dihover */
        }

        .profile-header img:hover {
            transform: scale(1.1);
            background-color: grey;
            filter: grayscale(100%) opacity(0.5);
            /* Perbesar gambar saat dihover */
        }

        .profile-info {
            margin-top: 20px;
        }

        .profile-info label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="profile-container">
            <a href="{{ route('beranda') }}" class="btn btn-outline-secondary back-to-top" role="button"><i
                    class="fas fa-arrow-up"></i>Back</a>
            @if (Auth::check())
                <div class="profile-header">
                    <h2>Profile</h2>
                    <img src="{{ Auth::user()->gambar ? asset('storage/' . Auth::user()->gambar) : 'https://via.placeholder.com/150' }}"
                        alt="Profile Picture" class="img-fluid" id="profile-picture">
                    <input type="file" id="profile-picture-input" style="display: none;">
                    <h4>{{ Auth::user()->name }}</h4>
                    <p>{{ Auth::user()->email }}</p>
                </div>
                <div class="profile-info">
                    <h5>Informasi Profil</h5>
                    <form>
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}"
                                readonly>
                        </div>
                        {{-- <a href="{{ route('produk-kos') }}" class="btn btn-primary btn-block">Produk Saya</a> --}}
                        <a href="{{ route('logout') }}" class="btn btn-danger btn-block">Logout</a>
                    </form>
                </div>
            @else
                <div class="text-center">
                    <h2>Anda belum login</h2>
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                </div>
            @endif
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#profile-picture').click(function() {
                $('#profile-picture-input').click();
            });

            $('#profile-picture-input').change(function() {
                var formData = new FormData();
                formData.append('profile_picture', $('#profile-picture-input')[0].files[0]);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: '{{ route('profile.uploadPicture') }}',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            $('#profile-picture').attr('src', response.profile_picture_url);
                        } else {
                            alert('Gagal mengunggah gambar');
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
