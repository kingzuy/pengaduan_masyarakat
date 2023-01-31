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
        return view('user.pengaduan');
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
        } else {
            $image = '';
        }

        $pengaduan = Pengaduan::create([
            'image' => $image->hashName(),
            'laporan' => trim($request->laporan),
            'user_id' => auth()->user()->id,
        ]);

        if (!$pengaduan) return redirect()->back()->with('message', 'Data gagal di tambahkan');

        return redirect()->route('/home')->with('message', 'Data berhasil di tambahkan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
