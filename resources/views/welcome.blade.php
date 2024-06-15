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
    </style>
</head>

<body>
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
                <div class="d-flex">
                    <button class="btn btn-primary me-2" onclick="location.href='{{ route('search') }}'">Temukan
                        Kost</button>
                    <button class="btn btn-primary me-2"
                        onclick="location.href='{{ route('register') }}'">Owner</button>

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
</body>

</html>
