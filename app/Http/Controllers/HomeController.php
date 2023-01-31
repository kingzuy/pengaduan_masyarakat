<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $datas = Pengaduan::latest()->get();

        return view('user.index', compact('datas'));
    }
}
