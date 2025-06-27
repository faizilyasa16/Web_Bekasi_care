<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Berita;

class BeritaBulananChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $beritaPerBulan = Berita::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        $namaBulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        $data = [];
        foreach (range(1, 12) as $i) {
            $data[] = $beritaPerBulan->get($i, 0);
        }

        return $this->chart->setType('line')
            ->setHeight(250)
            ->setTitle('Jumlah Berita Banjir Tahun ' . date('Y'))
            ->setXAxis($namaBulan)
            ->setHeight(300)
            ->setDataset([
                [
                    'name' => 'Berita',
                    'data' => $data
                ]
            ]);
    }
}
