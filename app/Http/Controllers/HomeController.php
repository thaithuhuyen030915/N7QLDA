<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lophoc;
use App\Models\Giasu;
use App\Models\Nguoidung;

class homeController extends Controller
{
    public function index(){
        $dsLophoc = Lophoc::whereHas('denghi', function($query) {
            $query->where('TrangThaiDeNghi', 'Chưa duyệt');
        })->get();
        $giasus = Giasu::with('nguoidung')->get();
        
        return view('pages.home', compact('dsLophoc', 'giasus'));
    }
}
