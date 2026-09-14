@extends('layouts.app')

@section('title', 'Profil Mahasiswa')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <!-- Profile Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 h-32"></div>
        <div class="px-8 py-6 relative">
            <div class="w-24 h-24 bg-white rounded-full border-4 border-white shadow-md absolute -top-12 flex items-center justify-center text-4xl text-gray-300">
                👤
            </div>
            <div class="mt-14">
                <h2 class="text-3xl font-bold text-gray-900">{{ $name }}</h2>
                <p class="text-blue-600 font-medium mt-1">{{ $major }}</p>

                <p class="text-gray-600 mt-4 leading-relaxed bg-gray-50 p-4 rounded-lg border-l-4 border-blue-500 italic">
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

    <!-- Academic History Table -->
    @if(isset($courses) && count($courses) > 0)
    <div class="mt-10 mb-20">
        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
            <span class="mr-2">📚</span> Histori Mata Kuliah
        </h3>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Semester</th>
                            <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Kode</th>
                            <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                            <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">SKS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($courses as $course)
                        <tr class="hover:bg-blue-50/50 transition duration-150 group">
                            <td class="py-4 px-6 whitespace-nowrap">
                                <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                    Sem {{ $course['semester'] }}
                                </span>
                            </td>
                            <td class="py-4 px-6 font-mono text-sm text-gray-500 group-hover:text-blue-600 transition-colors whitespace-nowrap">
                                {{ $course['code'] }}
                            </td>
                            <td class="py-4 px-6">
                                <p class="font-semibold text-gray-900">{{ $course['name'] }}</p>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $course['en_name'] }}</p>
                            </td>
                            <td class="py-4 px-6 text-center font-bold text-gray-700">
                                {{ $course['credits'] }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Summary Footer -->
            <div class="bg-gray-50 border-t border-gray-200 px-6 py-4 flex justify-between items-center text-sm">
                <span class="text-gray-500">Total Mata Kuliah: <strong class="text-gray-900">{{ count($courses) }}</strong></span>
                <span class="text-gray-500">Total SKS: <strong class="text-gray-900">{{ collect($courses)->sum('credits') }}</strong></span>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
