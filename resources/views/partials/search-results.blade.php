@foreach ($data as $item)
    <div class="card">
        <img src="{{ asset('storage/kos/' . $item['gambar']) }}" alt="{{ $item['nama'] }}">
        <div class="card-body">
            <h5 class="card-title">{{ $item['kos'] }}</h5>
            <p class="card-text">{{ $item['deskripsi'] }}</p>
            <p class="card-text"><small class="text-muted">{{ $item['lokasi'] }}</small></p>
            <p class="card-text"><strong>{{ $item['harga'] }}</strong></p>
        </div>
    </div>
@endforeach
