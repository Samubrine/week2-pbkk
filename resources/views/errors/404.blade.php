@extends('layouts.app')

@section('title', 'Page Not Found')

@section('content')
<div class="flex flex-col items-center justify-center py-20 text-center">
    <h1 class="text-6xl font-bold text-gray-800 mb-4">404</h1>
    <h2 class="text-2xl text-gray-600 mb-8">Halaman Tidak Ditemukan</h2>
    <p class="text-gray-500 mb-8">The academic portal you are looking for does not exist or has been moved.</p>
    <a href="{{ route('home') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Return Home</a>
</div>
@endsection
