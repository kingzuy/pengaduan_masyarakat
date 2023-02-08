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
        $finish = Pengaduan::where('status', 'Finish')->get()->count();
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

    public function tambahPetugas(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', 'min:6'],
            'nik' => ['numeric'],
            'telp' => ['numeric'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nik' => $request->nik,
            'telp' => $request->telp,
        ]);

        // kurang kondisi
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
            'nik' => ['required', 'numeric'],
            'telp' => ['required', 'numeric'],
        ]);

        $user = User::findOrFail(auth()->user()->id);

        $user->name = $request->name;
        $user->nik = $request->nik;
        $user->telp = $request->telp;
        $user->save();

        if (!$user) return die();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
