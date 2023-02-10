<?php

namespace App\Http\Controllers;

use App\Models\User;

class MasyarakatController extends Controller
{
    public function index()
    {
        $datas = User::where('role', '0')->get();

        return view('masyarakat.list', compact('datas'));
    }
}
