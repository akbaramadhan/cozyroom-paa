<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadKosController extends Controller
{
    public function upload_kos() {
        return view('upload-kos');
    }
}
