<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GiasuToanController extends Controller
{
    public function showToan()
    {
        return view('pages.giasutoan'); // The page for Gia Su Mon Toan
    }
}
