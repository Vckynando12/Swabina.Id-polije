<?php

namespace App\Http\Controllers;

use App\Models\Carouselteo;
use App\Models\Gambarteo;
use App\Models\Textteo;
use Illuminate\Http\Request;

class SwatourorganizerController extends Controller
{
    public function index()
    {
        $carousels = Carouselteo::all(); 
        $gambars = Gambarteo::all(); 
        $texts = Textteo::all(); 
        return view('swatour', compact('carousels', 'gambars', 'texts')); 
    }
}
