<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Google Fonts-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1165876da6.js" crossorigin="anonymous"></script>
    <!-- My Style-->
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <!-- Logo Title Bar -->
    <link rel="icon" href="img/Group 31.png" type="image/x-icon">
    <title>CozyRoom</title>

    <style>
        .hero-tagline {
            text-align: left;
            padding-top: 50px;
            padding-bottom: 20px;
        }

        .hero-tagline h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .hero-tagline p {
            font-size: 1.2rem;
            line-height: 1.5;
        }

        .button-lg-secondary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 15px 30px;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease-in-out;
            color: #fff;
        }

        .highlight-yellow {
            color: #ffc107;
        }

        /* Additional Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
        }

        .btn-primary {
            background-color: #ffc107;
            border: none;
        }

        .btn-primary:hover {
            background-color: #5a6268;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .custom-image {
            width: 600px;
            height: 500px;
            border-radius: 0px;
        }

        .navbar-custom {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar-custom .navbar-brand {
            font-weight: 700;
            color: #007bff;
        }

        .navbar-custom .navbar-toggler-icon {
            background-color: #007bff;
        }

        .navbar-custom .btn {
            margin: 0 5px;
        }

        .search-button {
            background-color: #f8f8f8;
            color: #218838;
            border: 2px solid #218838;
            padding: 8px 16px;
            border-radius: 17px;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
        }

        .search-button:hover {
            background-color: #218838;
            color: #fff;
        }

        .nav-icon {
            font-size: 1.5rem;
            color: #5a9fe4;
            margin-right: 15px;
            cursor: pointer;
            transition: filter 0.3s ease-in-out, transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            border: 2px solid transparent;
            /* Border transparan default */
            border-radius: 50%;
            /* Membuat ikon menjadi lingkaran */
            padding: 5px;
            /* Menambahkan padding agar border tidak menempel langsung pada ikon */
        }

        .nav-icon:hover {
            color: #007bff;
            transform: scale(1.3) rotate(360deg);
            /* Efek rotasi 360 derajat */
            border: 2px solid #007bff;
            /* Warna border saat di-hover */
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
            /* Efek bayangan saat di-hover */
        }



        .profile-menu {
            display: flex;
            align-items: center;
        }

        .profile-menu img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            transition: filter 0.3s ease-in-out;
        }

        .profile-menu img:hover {
            filter: grayscale(100%);
            transform: scale(1.2);
            background-color: grey;
            box-shadow: 0 0 10px rgba(128, 128, 128, 0.5);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand">CozyRoom</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="d-flex ms-auto align-items-center">
                    <a href="{{ route('upload-kos') }}" class="ms-3">
                        <i class="fas fa-plus-circle nav-icon" data-bs-toggle="modal" data-bs-target="#uploadModal"></i>
                    </a>
                    <button class="search-button" onclick="location.href='{{ route('search-login') }}'">Search</button>
                    <div class="profile-menu ms-3">
                        <a href="{{ route('profil') }}">
                            <img src="{{ asset('storage/' . Auth::user()->gambar) }}" alt="Profile Picture">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="hero">
        <div class="custom-con container h-150 text-align center d-flex">
            <div class="row h-100">
                <div class="col-md-6 hero-tagline my-auto">
                    <h1>Membantu <span class="highlight-yellow">Menemukan Kost</span> Terbaik untuk Kamu</h1>
                    <p><span class="fw-bold">CozyRoom</span> hadir untuk memudahkan Kamu dalam menemukan tempat tinggal
                        sementara
                        atau tempat menginap terbaik yang sesuai dengan kebutuhan dan keinginan Kamu</p>
                </div>

                <div class="col-md-6 hero-tagline my-auto text-align center">
                    <img src="{{ asset('bg/home-bg.png') }}" class="custom-image">
                </div>

            </div>

            <!-- <img src="../img/3588-removebg 1.png" alt="" class="position-absolute end-0 bottom-0 img-hero"> -->
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('a[href^="#"]').click(function(e) {
                e.preventDefault();
                var target = $(this).attr('href');

                $('html, body').animate({
                    scrollTop: $(target).offset().top
                }, 500, 'swing');
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/8p4F5j5b+4V5L+5Rt24W1P6N9+Bp1fW6K22jE1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXlq0YC3skAJG6SFc5tP6N9+C59qEd+8uF8P0u62LU/n0eVPVL8+S4L2jdXG" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9bBodDab6zF3TCH"></script>

    @if (session('message'))
        <script>
            alert("{{ session('message') }}");
        </script>
    @endif
    @if (session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif

</body>

</html>
