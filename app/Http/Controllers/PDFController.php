<?php

namespace App\Http\Controllers;

use App\Models\RekapPengaduan;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function pengaduan()
    {
        return view('admin.rekap.rekap');
    }

    public function previewPdf()
    {
        $rekap = RekapPengaduan::get();

        $data = [
            'title' => 'REKAP DATA PENGADUAN <br> MASYARAKAT',
            'data' => $rekap

        ];

        $pdf = PDF::loadView('admin.rekap.pdf', $data);
        return $pdf->stream();
    }
}
