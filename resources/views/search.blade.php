<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .search-box {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .search-results {
            margin-top: 20px;
        }

        .card {
            margin-bottom: 20px;
        }

        .search-box {
            animation: fadeInDown 1s ease;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-primary {
            background-color: #ffc107;
            border: none;
        }

        .btn-primary:hover {
            background-color: #5a6268;
        }
    </style>
</head>

<body>
    <div class="video-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="search-box">
                        <button class="btn btn-primary me-2" onclick="location.href='{{ route('landing') }}'">Back</button>
                    </div>
                    <div class="search-box">
                        <h2 class="text-center mb-4">Find Your Perfect Room</h2>
                        <form id="search-form">
                            <div class="input-group">
                                <input type="text" class="form-control" id="keyword" name="keyword"
                                    placeholder="Search for Kost...">
                            </div>
                        </form>
                    </div>
                    <div class="search-results" id="search-results">
                        @foreach ($data as $item)
                            <a href="{{ route('kos.show', $item['id']) }}" class="card-link">
                                <div class="card">
                                    <img src="{{ asset('storage/kos/' . $item['gambar']) }}" alt="{{ $item['kos'] }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item['kos'] }}</h5>
                                        <p class="card-text">{{ $item['deskripsi'] }}</p>
                                        <p class="card-text"><small class="text-muted">{{ $item['lokasi'] }}</small></p>
                                        <p class="card-text"><strong>Rp. {{ $item['harga'] }}</strong></p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function goBack() {
            history.back();
            setTimeout(() => {
                location.reload();
            }, 500); // Mengatur waktu penundaan sebelum memuat ulang halaman (dalam milidetik)
        }

        $(document).ready(function() {
            $('#keyword').on('input', function() {
                var keyword = $(this).val();
                $.ajax({
                    url: "{{ route('search') }}",
                    type: 'GET',
                    data: {
                        keyword: keyword
                    },
                    success: function(response) {
                        $('#search-results').html(response);
                    }
                });
            });
        });
    </script>
</body>

</html>
