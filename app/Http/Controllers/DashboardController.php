<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function mahasiswa($nrp)
    {
        $courses = [];

        if ($nrp === '5025241046') {
            $name = 'Mikail Ibrahim Hakim';
            $major = 'Informatics Engineering';
            $description = 'A tech savvy native that runs on pure adrenaline and caffeine and loves to tackle on complex problems with a resolute mind.';

            // Populate courses, sorted by semester ascending (as provided in data)
            $courses = [
                ['code' => 'EF234101', 'name' => 'Dasar Pemrograman', 'en_name' => 'Fundamental Programming', 'semester' => 1, 'credits' => 4],
                ['code' => 'EF234102', 'name' => 'Sistem Digital', 'en_name' => 'Digital System', 'semester' => 1, 'credits' => 3],
                ['code' => 'EF234103', 'name' => 'Aljabar Linier', 'en_name' => 'Linear Algebra', 'semester' => 1, 'credits' => 3],
                ['code' => 'EF234104', 'name' => 'Sistem Basis Data', 'en_name' => 'Database System', 'semester' => 1, 'credits' => 4],
                ['code' => 'SM234101', 'name' => 'Kalkulus 1', 'en_name' => 'Calculus 1', 'semester' => 1, 'credits' => 3],

                ['code' => 'EE234101', 'name' => 'Pengantar Teknologi Elektro dan Informatika Cerdas', 'en_name' => 'Introduction to Intelligence Electrical and Informatics', 'semester' => 2, 'credits' => 2],
                ['code' => 'EF234201', 'name' => 'Struktur Data', 'en_name' => 'Data Structure', 'semester' => 2, 'credits' => 4],
                ['code' => 'EF234202', 'name' => 'Sistem Operasi', 'en_name' => 'Operating System', 'semester' => 2, 'credits' => 4],
                ['code' => 'EF234203', 'name' => 'Organisasi Komputer', 'en_name' => 'Computer Organization', 'semester' => 2, 'credits' => 3],
                ['code' => 'EF234204', 'name' => 'Komputasi Numerik', 'en_name' => 'Numerical Computation', 'semester' => 2, 'credits' => 3],
                ['code' => 'SM234201', 'name' => 'Kalkulus 2', 'en_name' => 'Calculus 2', 'semester' => 2, 'credits' => 3],

                ['code' => 'EF234301', 'name' => 'Pemrograman Web', 'en_name' => 'Web Programming', 'semester' => 3, 'credits' => 3],
                ['code' => 'EF234302', 'name' => 'Pemrograman Berorientasi Objek', 'en_name' => 'Object Oriented Programming', 'semester' => 3, 'credits' => 3],
                ['code' => 'EF234303', 'name' => 'Jaringan Komputer', 'en_name' => 'Computer Network', 'semester' => 3, 'credits' => 4],
                ['code' => 'EF234304', 'name' => 'Teori Graf', 'en_name' => 'Graph Theory', 'semester' => 3, 'credits' => 3],
                ['code' => 'EF234305', 'name' => 'Matematika Diskrit', 'en_name' => 'Discrete Mathematics', 'semester' => 3, 'credits' => 3],
                ['code' => 'EF234307', 'name' => 'Konsep Pengembangan Perangkat Lunak', 'en_name' => 'Software Development Principles', 'semester' => 3, 'credits' => 2],
                ['code' => 'EK234201', 'name' => 'Konsep Kecerdasan Artifisial', 'en_name' => 'Artificial Intelligence Concepts', 'semester' => 3, 'credits' => 3],

                ['code' => 'EF234401', 'name' => 'Pemrograman Jaringan', 'en_name' => 'Network Programming', 'semester' => 4, 'credits' => 3],
                ['code' => 'EF234402', 'name' => 'Probabilitas dan Statistik', 'en_name' => 'Probabilistic and Statistic', 'semester' => 4, 'credits' => 3],
                ['code' => 'EF234403', 'name' => 'Otomata', 'en_name' => 'Automata', 'semester' => 4, 'credits' => 2],
                ['code' => 'EF234404', 'name' => 'Manajemen Basis Data', 'en_name' => 'Database Management', 'semester' => 4, 'credits' => 3],
                ['code' => 'EF234405', 'name' => 'Perancangan dan Analisis Algoritma', 'en_name' => 'Algorithm Design and Analysis', 'semester' => 4, 'credits' => 3],
                ['code' => 'EF234406', 'name' => 'Pembelajaran Mesin', 'en_name' => 'Machine Learning', 'semester' => 4, 'credits' => 3],
                ['code' => 'ER234301', 'name' => 'Perancangan Perangkat Lunak', 'en_name' => 'Software Design', 'semester' => 4, 'credits' => 3],

                ['code' => 'UG234901', 'name' => 'Agama Islam', 'en_name' => 'Islamic Studies', 'semester' => 6, 'credits' => 2],
                ['code' => 'UG234913', 'name' => 'Kewarganegaraan', 'en_name' => 'Civics', 'semester' => 6, 'credits' => 2],
            ];

        } else {
            $name = 'Student Record';
            $major = 'Undeclared / General';
            $description = 'Profile information is currently restricted or not yet populated in the academic system.';
        }

        return view('dashboard.mahasiswa', compact('nrp', 'name', 'major', 'description', 'courses'));
    }

    public function kalkulator($ip1, $ip2)
    {
        $sum = (float) $ip1 + (float) $ip2;
        $average = $sum / 2;

        return view('dashboard.kalkulator', compact('ip1', 'ip2', 'sum', 'average'));
    }
}
