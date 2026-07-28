<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        return view('pageuser.landing.paket');
    }
}