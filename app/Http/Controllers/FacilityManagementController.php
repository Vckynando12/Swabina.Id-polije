<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CarouselFM;
use App\Models\GambarFM;
use App\Models\TextFM;
class FacilityManagementController extends Controller
{
    public function index()
    {
        $carousels = CarouselFM::all();
        $gambarFM = GambarFM::first();
        $texts = TextFM::all();
        return view('facilitymanagement', compact('carousels','gambarFM','texts'));
    }
}
