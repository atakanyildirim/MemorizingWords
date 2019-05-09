<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Anasayfa görünümü yükler.
     *
     * @return view
     */
    public function Index()
    {
        return view('home');
    }
    
}