<?php

namespace App\Http\Controllers;
use App\Models\VisiMisiBudaya;
use App\Models\SekilasPerusahaan;
use App\Models\SertifikatPenghargaan;
use App\Models\FotoLayanan;
use Illuminate\Http\Request;

class TentangkamiController extends Controller
{
    public function sekilasPerusahaan()
    {
        $sekilasPerusahaan = SekilasPerusahaan::all();
        $fotolayanan = FotoLayanan::all();
        
        return view('tentangkami.main-sekilas', compact('sekilasPerusahaan', 'fotolayanan'));
    }
    public function visiMisiBudaya()
    {
        $visiMisiBudaya = VisiMisiBudaya::all();
        
        return view('tentangkami.main-visimisi', compact('visiMisiBudaya'));
    }
    public function sertifikat()
    {
        $sertifikatPenghargaan = SertifikatPenghargaan::all();
        return view('tentangkami.sertifikatPenghargaan', compact('sertifikatPenghargaan'));
    }
}
