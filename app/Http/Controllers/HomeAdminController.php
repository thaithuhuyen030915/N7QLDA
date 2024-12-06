<?php

namespace App\Http\Controllers;

class HomeAdminController
{
    public function index(){
        return view('dashboard.home');
    }
}
