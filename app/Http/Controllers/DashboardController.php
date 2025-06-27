<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Forum;
use App\Charts\LaporanBulananChart;
use App\Charts\BeritaBulananChart;
use App\Models\LaporanStatusHistory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(LaporanBulananChart $chart, BeritaBulananChart $beritaChart)
    {
        $totalLaporan = Laporan::count();
        $totalPengguna = User::where('role', 'user')->count();
        $totalBerita = Berita::count();
        $totalForum = Forum::count();

        return view('admin.dashboard', [
            'totalLaporan' => $totalLaporan,
            'totalPengguna' => $totalPengguna,
            'totalBerita' => $totalBerita,
            'totalForum' => $totalForum,
            'chart' => $chart->build(),
            'beritaChart' => $beritaChart->build()
        ]);
    }

    public function users()
    {
        $users = User::all();
        return view('admin.user', compact('users'));
    }
    public function laporan()
    {
        $laporans = Laporan::with(['user', 'latestStatus'])->get();
        return view('admin.laporan', compact('laporans'));
    }


    public function berita()
    {
        $beritas = Berita::all();
        return view('admin.berita', compact('beritas'));
    }
    public function forum()
    {
        $forums = Forum::all();
        return view('admin.forum', compact('forums'));
    }
}
