<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
class HomeController extends Controller
{
    public function index()
    {
        $berita = Berita::latest()->take(4)->get(); // Ambil 4 berita terbaru
        return view('user.home', compact('berita'));
    }

    public function about()
    {
        return view('user.about');
    }
}
