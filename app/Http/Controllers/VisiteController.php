<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visite;

class VisiteController extends Controller
{
       public function dates()
    {
        $datesVisites = Visite::select('date')->distinct()->orderBy('date', 'desc')->get();
        return view('visite.dates', compact('datesVisites'));
    }
        
}
