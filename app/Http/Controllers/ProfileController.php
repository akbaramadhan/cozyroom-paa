<?php

namespace App\Http\Controllers;

use App\Models\kos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        // $kosList = kos::where('user_id', $user->id)->get(); // Asumsi Anda memiliki relasi user_id di model Kos

        return view('profile', compact('user'));
    }

    public function uploadPicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        if ($request->hasFile('profile_picture')) {
            // Hapus gambar profil lama jika ada
            if ($user->gambar) {
                Storage::delete('public/profile_pictures/' . $user->gambar);
            }

            // Simpan gambar profil baru
            $path = $request->file('profile_picture')->store('public/profile_pictures');
            // Ubah path agar dapat diakses dari browser
            $path = str_replace('public/', '', $path);

            $user->gambar = $path;
            $user->save();

            return response()->json([
                'success' => true,
                'profile_picture_url' => asset('storage/' . $path),
            ]);
        }
        return response()->json(['success' => false], 400);
    }
}
