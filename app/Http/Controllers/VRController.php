<?php

namespace App\Http\Controllers;

use App\Models\Location360;
use App\Models\JadwalOp;
use App\Models\UserQuery;

class VRController extends Controller
{
    public function index()
    {
        // Ambil semua panorama
        $locations = Location360::latest()->get();

        // Ambil jadwal operasional
        $jadwals = JadwalOp::latest()->get();

        // Ambil riwayat AI assistant
        $queries = UserQuery::latest()->get();

        return view('vr.index', compact(
            'locations',
            'jadwals',
            'queries'
        ));
    }

    public function show($id)
    {
        $location = Location360::findOrFail($id);

        return view('vr.show', compact('location'));
    }
}