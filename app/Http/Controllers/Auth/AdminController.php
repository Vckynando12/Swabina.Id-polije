<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Faq;
use App\Models\SertifikatPenghargaan;
use App\Models\Karir;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        try {
            $beritas = Berita::latest()->get();
            $sertifikats = SertifikatPenghargaan::latest()->get();
            $faqs = Faq::all();
            $karirs = Karir::latest()->get();

            return view('admin.dashboard', compact(
                'beritas',
                'sertifikats',
                'faqs',
                'karirs'
            ));
        } catch (\Exception $e) {
            return view('admin.dashboard')->with('error', 'Terjadi kesalahan saat memuat data');
        }
    }
}
