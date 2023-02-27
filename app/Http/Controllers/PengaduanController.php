<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\RekapPengaduan;
use App\View\Components\auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

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

        $rekap = RekapPengaduan::create([
            'pengadu' => auth()->user()->name,
            'username_pengadu' => auth()->user()->username,
            'laporan' => trim($request->laporan),
            'pesan' => 'Pengaduan masuk',
        ]);

        if (!$rekap) return redirect()->back()->with('message_error', 'Data gagal di tambahkan');

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

        $pengaduan->status = $request->status;
        $pengaduan->save();

        if (!$pengaduan) return redirect()->back()->with('message_error', 'Status gagal di ubah');

        if ($pengaduan->old_name) {

            $rekap = RekapPengaduan::create([
                'pengadu' => $pengaduan->User->old_name,
                'username_pengadu' => $pengaduan->User->old_username,
                'laporan' => $pengaduan->laporan,
                'petugas' => auth()->user()->name,
                'username_petugas' => auth()->user()->username,
                'status' => $request->status,
                'pesan' => 'Status berubah menjadi ' . $request->status,
            ]);
        } else {

            $rekap = RekapPengaduan::create([
                'pengadu' => $pengaduan->User->name,
                'username_pengadu' => $pengaduan->User->username,
                'laporan' => $pengaduan->laporan,
                'petugas' => auth()->user()->name,
                'username_petugas' => auth()->user()->username,
                'status' => $request->status,
                'pesan' => 'Status berubah menjadi ' . $request->status,
            ]);
        }


        if (!$rekap) return redirect()->back()->with('message_error', 'Status gagal di ubah');

        return redirect()->route('admin.pengaduan')->with('message', 'Status berhasil di ubah');
    }

    public function destroy(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);


        if ($pengaduan->old_name) {

            $rekap = RekapPengaduan::create([
                'pengadu' => $pengaduan->User->name,
                'username_pengadu' => $pengaduan->User->username,
                'laporan' => $pengaduan->laporan,
                'petugas' => auth()->user()->name,
                'username_petugas' => auth()->user()->username,
                'status' => 'destroy',
                'pesan' => 'Data di hapus karena ' . $request->pesan,
            ]);
        } else {

            $rekap = RekapPengaduan::create([
                'pengadu' => $pengaduan->User->name,
                'username_pengadu' => $pengaduan->User->username,
                'laporan' => $pengaduan->laporan,
                'petugas' => auth()->user()->name,
                'username_petugas' => auth()->user()->username,
                'status' => 'destroy',
                'pesan' => 'Data di hapus karena ' . $request->pesan,
            ]);
        }

        $pengaduan->delete();

        if (!$pengaduan) return redirect()->back()->with('message_error', 'Data gagal di hapus');

        if (!$rekap) return redirect()->back()->with('message_error', 'Data gagal di hapus');

        return redirect()->route('admin.pengaduan')->with('message', 'Data berhasil di hapus');
    }
}
