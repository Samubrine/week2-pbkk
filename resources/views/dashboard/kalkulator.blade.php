@extends('layouts.app')

@section('title', 'Kalkulator Portofolio Akademis')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mt-10">
    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
        <span class="mr-2">📊</span> Kalkulator Portofolio Akademis
    </h2>

    <div class="grid grid-cols-2 gap-6 mb-8">
        <div class="border rounded-xl p-4 text-center bg-gray-50">
            <p class="text-sm text-gray-500 mb-1">Semester 1 (IP1)</p>
            <p class="text-2xl font-bold text-blue-600">{{ number_format((float)$ip1, 2) }}</p>
        </div>
        <div class="border rounded-xl p-4 text-center bg-gray-50">
            <p class="text-sm text-gray-500 mb-1">Semester 2 (IP2)</p>
            <p class="text-2xl font-bold text-blue-600">{{ number_format((float)$ip2, 2) }}</p>
        </div>
    </div>

    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl p-6 text-white text-center">
        <div class="grid grid-cols-2 divide-x divide-white/20">
            <div>
                <p class="text-blue-100 text-sm mb-1 uppercase tracking-wider font-semibold">Total Nilai</p>
                <p class="text-3xl font-bold">{{ number_format($sum, 2) }}</p>
            </div>
            <div>
                <p class="text-blue-100 text-sm mb-1 uppercase tracking-wider font-semibold">Rata-Rata IPK</p>
                <p class="text-3xl font-bold">{{ number_format($average, 2) }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
