<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Kost</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: url({{ asset('bg/bg.mp4') }});
        }

        .container {
            background-color: rgba(255, 255, 255, 0.6);
            margin-top: 50px;
            margin-bottom: 50px;
            max-width: 400px;
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .bg-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .preview-image {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            display: block;
        }
    </style>
</head>

<body>
    <video autoplay muted loop class="bg-video">
        <source src="{{ asset('bg/bg.mp4') }}" type="video/mp4">
    </video>
    <div class="container">
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
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        <div class="form-container">
            <h2 class="text-center mb-4">Update Kost</h2>
            <form action="{{ route('produk-kos-update-proses', $item['id']) }}" method="POST"
                enctype="multipart/form-data" id="uploadForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $item['id'] }}">
                <input type="hidden" name="old_gambar" value="{{ $item['gambar'] }}">
                <div class="form-group">
                    <label for="kos">Nama Kost</label>
                    <input type="text" class="form-control" id="kos" name="kos"
                        value="{{ old('kos', $item['kos']) }}">
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $item['deskripsi']) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga"
                        value="{{ old('harga', $item['harga']) }}">
                </div>
                <div class="form-group">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" class="form-control" id="lokasi" name="lokasi"
                        value="{{ old('lokasi', $item['lokasi']) }}">
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" class="form-control-file" id="gambar" name="gambar"
                        onchange="previewImage()">
                    <img src="{{ asset('storage/kos/' . $item['gambar']) }}" alt="Preview" id="preview"
                        class="preview-image">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Update</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function previewImage() {
            var file = document.getElementById('gambar').files[0];
            var reader = new FileReader();
            reader.onloadend = function() {
                document.getElementById('preview').src = reader.result;
                document.getElementById('preview').style.display = 'block';
            }
            if (file) {
                reader.readAsDataURL(file);
            } else {
                document.getElementById('preview').src = "";
                document.getElementById('preview').style.display = 'none';
            }
        }
    </script>
</body>

</html>
