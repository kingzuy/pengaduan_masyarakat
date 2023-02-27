<?php

namespace App\Http\Controllers;

use App\Models\RekapPengaduan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $datas = RekapPengaduan::get();

        return view('admin.rekap.index', compact('datas'));
    }
}
