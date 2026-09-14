@extends('layouts.app')

@section('title', 'Profil Mahasiswa')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mt-10">
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 h-32"></div>
    <div class="px-8 py-6 relative">
        <div class="w-24 h-24 bg-white rounded-full border-4 border-white shadow-md absolute -top-12 flex items-center justify-center text-4xl text-gray-300">
            👤
        </div>
        <div class="mt-14">
            <h2 class="text-3xl font-bold text-gray-900">{{ $name }}</h2>
            <p class="text-blue-600 font-medium mt-1">{{ $major }}</p>

            <p class="text-gray-600 mt-4 leading-relaxed bg-gray-50 p-4 rounded-lg italic">
                "{{ $description }}"
            </p>

            <div class="grid grid-cols-2 gap-4 mt-6">
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                    <p class="text-sm text-gray-500 font-semibold">NRP</p>
                    <p class="text-lg text-gray-900 font-mono mt-1">{{ $nrp }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                    <p class="text-sm text-gray-500 font-semibold">Status</p>
                    <p class="text-lg text-green-600 font-medium mt-1 flex items-center">
                        <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span> Active
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
