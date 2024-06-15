<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function landing(){
        
        // dd(auth()->user()->getRoleNames());
        return view('welcome');
    }
}
