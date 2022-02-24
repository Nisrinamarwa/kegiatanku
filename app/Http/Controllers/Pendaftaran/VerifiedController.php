<?php

namespace App\Http\Controllers\Pendaftaran;

use PDF;
use App\Register;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VerifiedController extends Controller
{
    public function index()
    {
        $verifieds = Register::where(['user_id' => Auth::user()->id, 'status' => 'terverifikasi'])->paginate(6);

        return view('daftar.student.verified.index', compact('verifieds'));
    }
    
    public function sertifikat($id)
    {
        $sertifikat = Register::findOrFail($id);

        $pdf = PDF::loadView('cetak.sertifikat', compact('sertifikat'))->setPaper('a4', 'landscape');

        return $pdf->stream('sertifikat.pdf');
    }
}
