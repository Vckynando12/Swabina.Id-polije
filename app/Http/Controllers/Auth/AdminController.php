<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Faq;
use App\Models\SertifikatPenghargaan;
use App\models\karir;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $beritas = Berita::all();
        $sertifikats = SertifikatPenghargaan::all();
        $faq = faq::all();
        $karirs = karir::all();
        return view('admin.dashboard', compact('beritas', 'sertifikats','faq','karirs'));
    }
}
