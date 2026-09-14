@extends('layouts.app')

@section('title', 'Agent Interface')

@section('content')
<div class="max-w-4xl mx-auto bg-gray-900 rounded-xl shadow-2xl overflow-hidden border border-gray-700">
    <div class="bg-black px-6 py-4 border-b border-gray-800 flex items-center space-x-2">
        <div class="w-3 h-3 rounded-full bg-red-500"></div>
        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
        <div class="w-3 h-3 rounded-full bg-green-500"></div>
        <span class="ml-4 text-gray-400 text-sm font-mono tracking-widest">AGENT TERMINAL</span>
    </div>
    <div class="p-8 text-green-400 font-mono">
        @if($isSecurityHarness)
            <h2 class="text-3xl font-bold text-white mb-4">Security AI Agent Harness</h2>
            <p class="mb-2">> Initializing general purpose security agent...</p>
            <p class="mb-2">> Integrating multiple MCPs and skills...</p>
            <p class="mb-6">> Connecting to orchestrator / board review...</p>

            <div class="bg-gray-800/50 border border-gray-700 p-4 rounded-lg text-gray-300 text-sm leading-relaxed mb-6 font-sans">
                <strong class="text-white block mb-1">Architecture Overview:</strong>
                A Security Agentic Harness built using an ecosystem of specialized MCPs (Collection, Analysis, Knowledge, and Validation) orchestrated via an Investigation Graph. It achieves multi-MCP evidence triangulation by routing conflicting hypotheses through progressive investigation rounds, ultimately synthesizing adversarial evidence to reduce uncertainty and produce high-confidence assessments.
            </div>

            <p class="text-blue-400 mt-6 font-bold">> STATUS: ONLINE AND READY FOR COMPLEX TASKS.</p>
        @else
            <h2 class="text-3xl font-bold text-white mb-4">General Assistant Agent</h2>
            <p class="mb-2">> Mode: Standard Assistant</p>
            <p class="text-yellow-400 mt-6">> STATUS: STANDBY.</p>
        @endif
    </div>
</div>
@endsection
