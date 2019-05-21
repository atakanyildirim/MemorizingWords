<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

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