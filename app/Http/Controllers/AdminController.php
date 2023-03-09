<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengaduan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\tanggapan;

class AdminController extends Controller
{
    public function index()
    {
        $datas = DB::table('pengaduans')
            ->select(DB::raw('MONTH(created_at) as bulan'), DB::raw('COUNT(*) as jumlah'))
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get();


        $nama_bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $pending = Pengaduan::where('status', 'Pending')->get()->count();
        $proses = Pengaduan::where('status', 'Proses')->get()->count();
        $finish = Pengaduan::where('status', 'Done')->get()->count();
        $masyarakat = User::where('role', '0')->get()->count();

        foreach ($datas as $data) {
            $data->bulan = $nama_bulan[$data->bulan];
        }

        return view('admin.dashboard', compact('datas', 'pending', 'proses', 'finish', 'masyarakat'));
    }

    public function petugas()
    {
        $datas = User::where('role', '1')->get();

        return view('admin.petugas', compact('datas'));
    }
    public function admin()
    {
        $datas = User::where('role', '2')->get();

        return view('admin.admin', compact('datas'));
    }

    public function tambahPetugas(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'min:6'],
        ]);

        if ($request->nik) {
            $request->validate([
                'nik' => ['numeric'],
            ]);
        }

        if ($request->telp) {
            $request->validate([
                'telp' => ['numeric'],
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nik' => $request->nik,
            'telp' => $request->telp,
            'role' => $request->role,
        ]);

        if (!$user) return redirect()->back()->with('error_message', 'Data gagal di tambahkan');

        return redirect()->back()->with('message', 'Data berhasil di tambahkan');
    }

    public function editPetugas(Request $request, $id)
    {
        $petugas = User::findOrfail($id);

        $request->validate([
            'name' => ['string', 'max:255'],
        ]);

        if ($request->username != $petugas->username) {
            $request->validate([
                'username' => ['string', 'max:255', 'unique:' . User::class],
            ]);
        }

        if ($request->nik) {
            $request->validate([
                'nik' => ['numeric'],
            ]);
        }

        if ($request->password) {
            $request->validate([
                'password' => ['min:6'],
            ]);
            $petugas->password = Hash::make($request->password);
        }

        if ($request->telp) {
            $request->validate([
                'telp' => ['numeric'],
            ]);
        }

        $petugas->name = $request->name;
        $petugas->username = $request->username;
        $petugas->nik = $request->nik;
        $petugas->telp = $request->telp;
        if ($request->role) {
            $petugas->role = $request->role;
        }

        $petugas->save();

        if (!$petugas) return redirect()->back()->with('error_message', 'Data ' . $petugas->name . ' gagal di ubah');

        return redirect()->back()->with('message', 'Data ' . $petugas->name . ' berhasil di ubah');
    }

    public function deletePetugas($id)
    {
        $user = User::findOrFail($id);

        if ($user->Pengaduan->count()) {
            $pengaduan = Pengaduan::where('user_id', $user->id)->update(['old_name' => $user->name, 'old_username' => $user->username, 'user_id' => 0]);
        }

        if ($user->Tanggapan->count()) {
            $tanggapan = tanggapan::where('user_id', $user->id)->update(['old_name' => $user->name, 'old_username' => $user->username, 'user_id' => 0]);
        }

        $user->delete();

        if (!$user) return redirect()->back()->with('error_message', 'Data tidak di temukan');

        return redirect()->back()->with('message', 'Data berhasil di hapus');
    }

    public function edit(Request $request): View
    {
        return view('admin.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => ['required'],
            'nik' => ['numeric'],
            'telp' => ['numeric'],
        ]);


        $user = User::findOrFail(auth()->user()->id);

        if ($request->username != $user->username) {
            $this->validate($request, [
                'username' => ['unique:users,username']
            ]);
        }

        if ($request->password) {
            $this->validate($request, [
                'password' => ['min:6']
            ]);
        }

        $user->name = $request->name;
        $user->nik = $request->nik;
        $user->telp = $request->telp;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        if (!$user) return die();

        return redirect()->back()->with('message', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
}
