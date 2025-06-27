<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\LaporanStatusHistory;
class LaporanController extends Controller
{
    public function laporan_page()
    {
        return view('user.lapor');
    }


    public function riwayat()
    {
        $laporans = Laporan::with('latestStatus')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.profile.riwayat-laporan', compact('laporans'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lokasi' => 'required|string|max:255',
            'keluhan' => 'required|string',
            'kebutuhan' => 'nullable|string',
            'urgensi' => 'required|in:sangat-tinggi,tinggi,normal,rendah,sangat-rendah',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        // Handle file foto jika ada
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('laporan', 'public');
        }

        $validated['user_id'] = auth()->id(); // Ambil ID user yang login

        Laporan::create($validated);

        return redirect()->back()->with('success', 'Laporan berhasil dikirim.');
    }

public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:terima_laporan,verifikasi_laporan,penanganan_tindakan,hasil_tindakan',
        'deskripsi' => 'required|string',
        'bukti' => 'nullable|image|max:2048',
    ]);

    $laporan = Laporan::findOrFail($id);

    $buktiPath = null;
    if ($request->hasFile('bukti')) {
        $buktiPath = $request->file('bukti')->store('bukti-tindakan', 'public');
    }

    LaporanStatusHistory::create([
        'laporan_id' => $laporan->id,
        'user_id' => $laporan->user_id,
        'status' => $request->status,
        'deskripsi' => $request->deskripsi,
        'bukti' => $buktiPath,
    ]);

    return redirect()->back()->with('success', 'Status laporan berhasil diperbarui.');
}


public function delete($id)
{
    $laporan = Laporan::findOrFail($id);
    $laporan->delete();
    return redirect()->back()->with('success', 'Laporan berhasil dihapus.');
}
}
