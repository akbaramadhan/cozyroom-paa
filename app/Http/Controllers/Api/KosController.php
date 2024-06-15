<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kos::orderBy('kos', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datakos = new kos();

        $rules = [
            'kos' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'lokasi' => 'required',
            'gambar' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Gagal memasukkan data',
                'data'    => $validator->errors()
            ]);
        }

        $datakos->kos = $request->kos;
        $datakos->deskripsi = $request->deskripsi;
        $datakos->harga = $request->harga;
        $datakos->lokasi = $request->lokasi;

        // Proses upload gambar
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $filename = date('d-m-Y') . '_' . $gambar->getClientOriginalName();
            $gambar->storeAs('public/kos', $filename);
            $datakos->gambar = $filename;
        }

        $datakos->save();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil memasukkan data',
            'data'    => $datakos
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Kos::find($id);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $datakos = Kos::find($id);
        if (empty($datakos)) {
            return response()->json([
                'status'  => false,
                'message' => 'Data tidak ditemukan',
            ]);
        }

        $rules = [
            'kos'    => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'lokasi' => 'required',
            'gambar' => 'nullable',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Gagal mengupdate data',
                'data'    => $validator->errors()
            ]);
        }

        $datakos->kos = $request->kos;
        $datakos->deskripsi = $request->deskripsi;
        $datakos->harga = $request->harga;
        $datakos->lokasi = $request->lokasi;

        // Proses upload gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($datakos->gambar && file_exists(storage_path('app/public/kos/' . $datakos->gambar))) {
                unlink(storage_path('app/public/kos/' . $datakos->gambar));
            }

            // Unggah gambar baru
            $gambar = $request->file('gambar');
            $filename = date('d-m-Y') . '_' . $gambar->getClientOriginalName();
            $gambar->storeAs('public/kos', $filename);
            $datakos->gambar = $filename;
        }

        $datakos->save();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil mengupdate data',
            'data' => $datakos
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $datakos = Kos::find($id);
        if (empty($datakos)) {
            return response()->json([
                'status'  => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }


        $post = $datakos->delete();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil menghapus data',
        ]);
    }
}
