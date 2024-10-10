<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\GambarSS; 
use App\Models\SwasegarCarousel;
use App\Models\TextSS;
class SwasegarController extends Controller
{
    public function index()
    {
        $carousels = SwasegarCarousel::all();
        $gambarSS = GambarSS::first(); 
        $textss = TextSS::all();
        return view('swasegar', compact('carousels', 'gambarSS','textss')); 
    }   
}
