<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\View\Components\auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $datas = Pengaduan::where('user_id', auth()->user()->id)->get();

        return view('user.home', compact('datas'));
    }
}
