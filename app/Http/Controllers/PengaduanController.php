<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\View\Components\auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;


class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Pengaduan::latest()->get();

        $status = ["Pending", "Proses", "Done"];

        return view('pengaduan.pengaduan', compact('datas', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (auth()->user()->nik == null || auth()->user()->telp == null) return redirect()->back()->with('validasi_nik_telp', 'Harap lengkapi NIK dan nomer telepon anda');

        $this->validate($request, [
            'laporan' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->file()) {
            //upload image
            $image = $request->file('image');
            $image->storeAs('public/image', $image->hashName());

            $pengaduan = Pengaduan::create([
                'image' => $image->hashName(),
                'laporan' => trim($request->laporan),
                'user_id' => auth()->user()->id,
            ]);
        } else {
            $pengaduan = Pengaduan::create([
                'laporan' => trim($request->laporan),
                'user_id' => auth()->user()->id,
            ]);
        }



        if (!$pengaduan) return redirect()->back()->with('message_error', 'Data gagal di tambahkan');

        return redirect()->route('user.home')->with('message', 'Data berhasil di tambahkan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function upStatus(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $pengaduan->ststus = $request->ststus;
        $pengaduan->save();

        if (!$pengaduan) return redirect()->back()->with('message_error', 'Data gagal di tambahkan');

        return redirect()->route('user.home')->with('message', 'Data berhasil di tambahkan');
    }
}
