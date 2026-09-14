<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function mahasiswa($nrp)
    {
        if ($nrp === '5025241046') {
            $name = 'Mikail Ibrahim Hakim';
            $major = 'Informatics Engineering';
            $description = 'A tech savvy native that runs on pure adrenaline and caffeine and loves to tackle on complex problems with a resolute mind.';
        } else {
            $name = 'Student Record';
            $major = 'Undeclared / General';
            $description = 'Profile information is currently restricted or not yet populated in the academic system.';
        }

        return view('dashboard.mahasiswa', compact('nrp', 'name', 'major', 'description'));
    }

    public function kalkulator($ip1, $ip2)
    {
        $sum = (float) $ip1 + (float) $ip2;
        $average = $sum / 2;

        return view('dashboard.kalkulator', compact('ip1', 'ip2', 'sum', 'average'));
    }
}
