<?php

namespace App\Http\Controllers;

use App\Models\tanggapan;
use App\View\Components\auth;
use Illuminate\Http\Request;

class TanggapanController extends Controller
{
    public function proses(Request $request)
    {
        $tanggapan = new tanggapan;

        $tanggapan->pengaduan_id = $request->pengaduan_id;
        $tanggapan->user_id = auth()->user()->id;
        $tanggapan->pesan = $request->pesan;

        $tanggapan->save();

        if (!$tanggapan) return redirect()->back()->with('message_error', 'Pesan gagal terkirim');

        if (auth()->user()->role == "admin") return redirect()->back()->with('message', 'Pesan berhasil terkirim');
        if (auth()->user()->role == "petugas") return redirect()->back()->with('message', 'Pesan berhasil terkirim');
        if (auth()->user()->role == "user") return redirect()->route('user.home')->with('message', 'Pesan berhasil terkirim');
    }
}
