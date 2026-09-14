<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function mahasiswa($nrp)
    {
        if ($nrp !== '5025241046') {
            return response()->view('errors.404', [], 404);
        }

        return view('dashboard.mahasiswa', compact('nrp'));
    }

    public function kalkulator($ip1, $ip2)
    {
        $sum = (float) $ip1 + (float) $ip2;
        $average = $sum / 2;

        return view('dashboard.kalkulator', compact('ip1', 'ip2', 'sum', 'average'));
    }
}
