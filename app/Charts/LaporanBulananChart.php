<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Laporan;

class LaporanBulananChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        // Ambil jumlah laporan tiap bulan
        $laporanPerBulan = Laporan::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', date('Y')) // hanya tahun ini
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        // Label bulan 1-12
        $namaBulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        // Inisialisasi array dengan 0 untuk bulan yang tidak ada data
        $dataChart = [];
        foreach (range(1, 12) as $i) {
            $dataChart[] = $laporanPerBulan->get($i, 0);
        }

        return $this->chart->setType('bar')
            ->setTitle('Laporan Banjir Tahun ' . date('Y'))
            ->setXAxis($namaBulan)
            ->setHeight(300)
            ->setDataset([
                [
                    'name' => 'Jumlah Laporan',
                    'data' => $dataChart
                ]
            ]);
    }
}
