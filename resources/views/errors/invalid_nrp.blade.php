@extends('layouts.app')

@section('title', 'Invalid NRP')

@section('content')
<div class="flex flex-col items-center justify-center py-20 text-center">
    <div class="w-24 h-24 bg-red-100 text-red-600 rounded-full flex items-center justify-center text-4xl mb-6 shadow-sm">
        ⚠️
    </div>
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Format NRP Tidak Valid</h1>
    <p class="text-xl text-red-500 font-medium mb-8">NRP can only be 10 digit.</p>
    <p class="text-gray-500 mb-8 max-w-md">Pastikan Anda memasukkan Nomor Registrasi Pokok (NRP) yang terdiri dari tepat 10 angka tanpa karakter lain.</p>
    <a href="{{ route('home') }}" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition shadow-sm">Kembali ke Beranda</a>
</div>
@endsection
