<?php

namespace App\Http\Controllers;

use App\Models\kos;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ToApiKosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_kos(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $url = "http://localhost:8000/api/kos";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];

        if ($request->has('keyword')) {
            $keyword = $request->keyword;
            $data = array_filter($data, function ($item) use ($keyword) {
                return stripos($item['kos'], $keyword) !== false ||
                    stripos($item['deskripsi'], $keyword) !== false ||
                    stripos($item['lokasi'], $keyword) !== false;
            });
        }

        if ($request->ajax()) {
            return view('partials.search-results', ['data' => $data])->render();
        }

        return view('search', ['data' => $data]);
    }
    public function index_kos_login(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $url = "http://localhost:8000/api/kos";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];

        if ($request->has('keyword')) {
            $keyword = $request->keyword;
            $data = array_filter($data, function ($item) use ($keyword) {
                return stripos($item['kos'], $keyword) !== false ||
                    stripos($item['deskripsi'], $keyword) !== false ||
                    stripos($item['lokasi'], $keyword) !== false;
            });
        }

        if ($request->ajax()) {
            return view('partials.search-results', ['data' => $data])->render();
        }

        return view('search-login', ['data' => $data]);
    }
    public function produk_kos(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $url = "http://localhost:8000/api/kos";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];

        if ($request->has('keyword')) {
            $keyword = $request->keyword;
            $data = array_filter($data, function ($item) use ($keyword) {
                return stripos($item['kos'], $keyword) !== false ||
                    stripos($item['deskripsi'], $keyword) !== false ||
                    stripos($item['lokasi'], $keyword) !== false;
            });
        }

        if ($request->ajax()) {
            return view('partials.search-results', ['data' => $data])->render();
        }

        return view('produk-kos', ['data' => $data]);
    }

    public function produk_kos_update($id)
    {
        // Ambil data kos berdasarkan ID
        $item = Kos::findOrFail($id); // Menggunakan metode findOrFail untuk menangani jika ID tidak ditemukan

        // Render view produk-kos-update.blade.php sambil mengirimkan data kos
        return view('produk-kos-update', compact('item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nama_kost = $request->nama;
        $deskripsi = $request->deskripsi;
        $lokasi = $request->lokasi;
        $harga = $request->harga;

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'lokasi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Ambil file gambar dari request
        $gambar = $request->file('gambar');

        // Simpan gambar sementara di storage laravel
        $gambarPath = $gambar->store('public/kos');

        // Ubah path ke URL yang bisa diakses
        $gambarUrl = asset('storage/' . str_replace('public/', '', $gambarPath));

        // Buat array untuk dikirimkan sebagai body request
        $data = [
            'nama' => $nama_kost,
            'deskripsi' => $deskripsi,
            'lokasi' => $lokasi,
            'harga' => $harga,
            'gambar_url' => $gambarUrl, // kirimkan URL gambar untuk disimpan di database
        ];

        // Kirim request ke API menggunakan Guzzle HTTP Client
        $client = new Client();
        $url = "http://localhost:8000/api/kos";

        try {
            $response = $client->post($url, [
                'multipart' => [
                    [
                        'name' => 'nama',
                        'contents' => $data['nama']
                    ],
                    [
                        'name' => 'deskripsi',
                        'contents' => $data['deskripsi']
                    ],
                    [
                        'name' => 'lokasi',
                        'contents' => $data['lokasi']
                    ],
                    [
                        'name' => 'harga',
                        'contents' => $data['harga']
                    ],
                    [
                        'name' => 'gambar',
                        'contents' => fopen($gambar->getPathname(), 'r'), // membuka gambar untuk dikirim
                        'filename' => $gambar->getClientOriginalName(),
                    ],
                ],
            ]);

            $content = $response->getBody()->getContents();
            $contentArray = json_decode($content, true);

            if ($contentArray['status']) {
                return redirect()->route('beranda')->with('success', 'Data berhasil ditambahkan');
            } else {
                return redirect()->route('beranda')->withErrors($contentArray['data'])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->route('beranda')->with('error', 'Gagal memproses data: ' . $e->getMessage());
        }
    }

    public function store_kos(Request $request)
    {
        $customMessage = [
            'kos.required'          => 'Semua data wajib diisi',
            'lokasi.required'       => 'Semua data wajib diisi',
            'harga.required'        => 'Semua data wajib diisi',
            'deskripsi.required'    => 'Semua data wajib diisi',
            'gambar.required'       => 'Semua data wajib diisi',
            'gambar.mimes'          => 'Maaf data anda tidak valid',
            'gambar.max'            => 'Maaf data anda tidak valid',
        ];

        $validator = Validator::make($request->all(), [
            'kos'         => 'required',
            'lokasi'      => 'required',
            'harga'       => 'required|numeric',
            'deskripsi'   => 'required',
            'gambar'      => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], $customMessage);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if (empty($request->kos) || empty($request->deskripsi) || empty($request->gambar) || empty($request->lokasi) || empty($request->harga)) {
            return redirect()->back()->withErrors('Semua Data Wajib Diisi')->withInput();
        }

        $gambar = $request->file('gambar');
        $filename = date('Y-m-d') . '_' . $gambar->getClientOriginalName();
        $path = 'public/kos/' . $filename;

        Storage::put($path, file_get_contents($gambar));

        $data = [
            'kos'        => $request->kos,
            'lokasi'     => $request->lokasi,
            'harga'      => $request->harga,
            'deskripsi'  => $request->deskripsi,
            'gambar'     => str_replace('public/', 'storage/', $path),
        ];

        Kos::create($data);

        return redirect()->route('beranda')->with('success', 'Data Berhasil Ditambahkan');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = new \GuzzleHttp\Client();
        $url = "http://localhost:8000/api/kos/{$id}";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $item = json_decode($content, true)['data'];

        return view('detail', ['item' => $item]);
    }
    public function show_login(string $id)
    {
        $client = new \GuzzleHttp\Client();
        $url = "http://localhost:8000/api/kos/{$id}";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $item = json_decode($content, true)['data'];

        return view('detail-login', ['item' => $item]);
    }


    public function update(Request $request, $id)
    {
        Log::info('Request data:', $request->all());

        $customMessage = [
            'kos.required'        => 'Nama kost wajib diisi',
            'deskripsi.required'  => 'Deskripsi wajib diisi',
            'harga.required'      => 'Harga wajib diisi',
            'harga.numeric'       => 'Harga harus berupa angka',
            'lokasi.required'     => 'Lokasi wajib diisi',
            'gambar.mimes'        => 'Maaf, gambar harus berupa file jpeg, png, jpg, atau gif',
            'gambar.max'          => 'Ukuran gambar maksimal adalah 2MB',
        ];

        $validator = Validator::make($request->all(), [
            'kos' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'lokasi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], $customMessage);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Ambil data input
        $nama_kost = $request->input('kos');
        $deskripsi = $request->input('deskripsi');
        $lokasi = $request->input('lokasi');
        $harga = $request->input('harga');

        // Siapkan array data untuk dikirim ke API
        $multipart = [
            [
                'name' => 'kos',
                'contents' => $nama_kost
            ],
            [
                'name' => 'deskripsi',
                'contents' => $deskripsi
            ],
            [
                'name' => 'lokasi',
                'contents' => $lokasi
            ],
            [
                'name' => 'harga',
                'contents' => $harga
            ],
        ];

        // Handle file upload jika ada gambar baru
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $filename = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('public/kos', $filename);

            $multipart[] = [
                'name' => 'gambar',
                'contents' => fopen(storage_path("app/public/kos/{$filename}"), 'r'),
                'filename' => $filename,
            ];
        }

        // Kirim request ke API menggunakan Guzzle HTTP Client
        $client = new Client();
        $url = "http://localhost:8000/api/kos/{$id}";

        try {
            $response = $client->request('PUT', $url, [
                'multipart' => $multipart,
            ]);

            $content = $response->getBody()->getContents();
            $contentArray = json_decode($content, true);

            if ($contentArray['status']) {
                // Jika API mengembalikan path gambar baru, update path gambar di database lokal
                $datakos = Kos::find($id);
                $datakos->kos = $nama_kost;
                $datakos->deskripsi = $deskripsi;
                $datakos->lokasi = $lokasi;
                $datakos->harga = $harga;
                if (isset($contentArray['data']['gambar'])) {
                    $datakos->gambar = $contentArray['data']['gambar'];
                }
                $datakos->save();

                return redirect()->route('search-login')->with('success', 'Data berhasil diubah');
            } else {
                return redirect()->back()->withErrors($contentArray['data'])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memproses data: ' . $e->getMessage());
        }
    }

    public function update_kos(Request $request, $id)
    {
        $customMessage = [
            'kos.required'        => 'Nama kost wajib diisi',
            'deskripsi.required'  => 'Deskripsi wajib diisi',
            'harga.required'      => 'Harga wajib diisi',
            'harga.numeric'       => 'Harga harus berupa angka',
            'lokasi.required'     => 'Lokasi wajib diisi',
            'gambar.mimes'        => 'Maaf, gambar harus berupa file jpeg, png, jpg, atau gif',
            'gambar.max'          => 'Ukuran gambar maksimal adalah 2MB',
        ];

        $validator = Validator::make($request->all(), [
            'kos' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'lokasi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], $customMessage);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Ambil data input
        $ardata['kos'] = $request->kos;
        $ardata['deskripsi'] = $request->deskripsi;
        $ardata['harga'] = $request->harga;
        $ardata['lokasi'] = $request->lokasi;

        // Handle file upload jika ada gambar baru
        $gambar = $request->file('gambar');
        if ($gambar) {
            $filename = date('Y-m-d') . $gambar->getClientOriginalName();
            $path = 'kos/' . $filename;

            Storage::disk('public')->put($path, file_get_contents($gambar));

            $ardata['gambar'] = $filename;
        }

        // Update data ke database
        Kos::whereId($id)->update($ardata);

        return redirect()->route('search-login')->with('success', 'Data berhasil diubah');
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
