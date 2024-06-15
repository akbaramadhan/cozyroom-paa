<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .card {
            position: relative;
        }

        .back-to-search-icon {
            position: absolute;
            top: 10px;
            /* Atur jarak dari atas */
            left: 10px;
            /* Atur jarak dari kanan */
            background-color: rgba(255, 255, 255, 0.8);
            /* Atur opacity background */
            padding: 15px;
            border-radius: 50%;
            transition: background-color 0.3s ease;
            transition: filter 0.3s ease-in-out;
        }

        .back-to-search-icon:hover {
            background-color: rgba(0, 0, 0, 0.1);
            /* Ubah warna background saat hover */
            transform: scale(1.1);
        }

        .back-to-search-icon i {
            color: #000000;
            font-size: 40px;
            transition: filter 0.3s ease-in-out;
            /* Ubah warna ikon */
        }

        .back-to-search-icon i:hover {
            color: #717171;
            transform: scale(1.1);
            /* Ubah warna ikon */
        }

        #back-to-search:hover {
            text-decoration: none;
            color: #007bff;
            /* Ubah warna sesuai kebutuhan */
        }
    </style>

</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="back-to-search-icon">
                <a href="{{ route('search') }}">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <img src="{{ asset('storage/kos/' . $item['gambar']) }}" alt="{{ $item['kos'] }}" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">{{ $item['kos'] }}</h5>
                <p class="card-text">{{ $item['deskripsi'] }}</p>
                <p class="card-text"><small class="text-muted">{{ $item['lokasi'] }}</small></p>
                <p class="card-text"><strong>{{ $item['harga'] }}</strong></p>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
