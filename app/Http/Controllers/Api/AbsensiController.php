<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        return Absensi::where('user_id', $request->user()->id)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $today = Carbon::today()->toDateString();
        $absen = Absensi::firstOrCreate(
            ['user_id' => $request->user()->id, 'tanggal' => $today],
            ['jam_masuk' => Carbon::now(), 'latitude' => $request->latitude, 'longitude' => $request->longitude]
        );

        if ($absen->jam_masuk && !$absen->jam_pulang) {
            $absen->jam_pulang = Carbon::now();
            $absen->latitude = $request->latitude;
            $absen->longitude = $request->longitude;
            $absen->save();
        }

        return response()->json($absen);
    }
}
