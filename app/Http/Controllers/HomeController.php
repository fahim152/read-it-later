<?php

namespace App\Http\Controllers;

use App\Pocket;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function index()
   {
        $pockets = Pocket::with('contents')->get();
        return view('pockets', compact('pockets'));
   }
}
