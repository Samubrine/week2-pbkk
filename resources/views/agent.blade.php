@extends('layouts.app')

@section('title', 'Agent Interface')

@section('content')
<div class="max-w-5xl mx-auto bg-gray-900 rounded-xl shadow-2xl overflow-hidden border border-gray-700">
    <div class="bg-black px-6 py-4 border-b border-gray-800 flex items-center space-x-2 sticky top-0 z-10">
        <div class="w-3 h-3 rounded-full bg-red-500"></div>
        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
        <div class="w-3 h-3 rounded-full bg-green-500"></div>
        <span class="ml-4 text-gray-400 text-sm font-mono tracking-widest">AGENT TERMINAL</span>
    </div>
    <div class="p-8">
        @if($isSecurityHarness)
            <div class="mb-8 border-b border-gray-800 pb-8">
                <h2 class="text-3xl font-bold text-white mb-2 font-mono">Security AI Agent Harness</h2>
                <p class="text-green-400 font-mono text-sm">> STATUS: ONLINE. MULTI-MCP ORCHESTRATION ACTIVE.</p>
            </div>

            <div class="text-gray-300 space-y-6 font-sans leading-relaxed">
                <p>
                    Yes — and I think that actually makes the architecture <strong class="text-white">more interesting</strong>.
                </p>
                <p>
                    What you're describing is essentially <strong class="text-white">multi-MCP investigation / evidence triangulation</strong>: instead of having one MCP/tool answer a problem, the agent can send the <em>same investigation question</em> to multiple specialized MCPs, then compare and synthesize their results.
                </p>
                <p>For example:</p>

                <pre class="bg-black border border-gray-800 p-6 rounded-lg text-green-400 font-mono text-sm overflow-x-auto shadow-inner leading-normal">
                    Problem
                       │
                       ▼
               ┌──────────────┐
               │ Agent Planner│
               └───────┬──────┘
                       │
             ┌─────────┼─────────┐
             ▼         ▼         ▼
          MCP #1     MCP #2     MCP #3
         Network      Logs       Vuln DB
         Analysis    Analysis    Analysis
             │         │         │
             ▼         ▼         ▼
          Result A   Result B   Result C
             │         │         │
             └─────────┼─────────┘
                       ▼
                ┌──────────────┐
                │  Correlator  │
                └───────┬──────┘
                        ▼
                ┌──────────────┐
                │ Final Agent  │
                │  Assessment  │
                └──────────────┘</pre>

                <h3 class="text-2xl font-bold text-blue-400 mt-12 mb-4">The important part: don't just "ask all MCPs"</h3>
                <p>I'd make the agent treat each MCP as an <strong class="text-white">investigation perspective</strong>.</p>
                <p>For example, suppose the problem is:</p>
                <blockquote class="border-l-4 border-blue-500 pl-4 italic text-gray-400 bg-gray-800/50 py-2 rounded-r">
                    <strong class="text-white">"Find the likely entry point of this attack."</strong>
                </blockquote>

                <p>The harness could delegate:</p>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse mt-2 mb-4">
                        <thead>
                            <tr class="bg-gray-800 text-gray-200">
                                <th class="p-3 border border-gray-700">MCP</th>
                                <th class="p-3 border border-gray-700">Perspective</th>
                                <th class="p-3 border border-gray-700">Result</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            <tr>
                                <td class="p-3 border border-gray-700 font-mono text-blue-300">Network MCP</td>
                                <td class="p-3 border border-gray-700">Network connections / exposed services</td>
                                <td class="p-3 border border-gray-700">Port 8080 suspicious</td>
                            </tr>
                            <tr class="bg-gray-800/30">
                                <td class="p-3 border border-gray-700 font-mono text-blue-300">Log MCP</td>
                                <td class="p-3 border border-gray-700">Authentication & application logs</td>
                                <td class="p-3 border border-gray-700">Repeated requests to `/upload`</td>
                            </tr>
                            <tr>
                                <td class="p-3 border border-gray-700 font-mono text-blue-300">PCAP MCP</td>
                                <td class="p-3 border border-gray-700">Packet-level behavior</td>
                                <td class="p-3 border border-gray-700">Large POST request</td>
                            </tr>
                            <tr class="bg-gray-800/30">
                                <td class="p-3 border border-gray-700 font-mono text-blue-300">Threat Intel MCP</td>
                                <td class="p-3 border border-gray-700">Known indicators</td>
                                <td class="p-3 border border-gray-700">Source IP associated with previous attacks</td>
                            </tr>
                            <tr>
                                <td class="p-3 border border-gray-700 font-mono text-blue-300">Vulnerability MCP</td>
                                <td class="p-3 border border-gray-700">Service weaknesses</td>
                                <td class="p-3 border border-gray-700">Application version has known vulnerability</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <p>Individually, none necessarily proves the attack entry point.</p>
                <p>But together:</p>

                <pre class="bg-black border border-gray-800 p-6 rounded-lg text-yellow-400 font-mono text-sm overflow-x-auto shadow-inner leading-normal">
Port 8080 exposed
       ↓
Application running vulnerable version
       ↓
POST /upload
       ↓
Abnormally large request
       ↓
Suspicious source IP
       ↓
Server process spawned afterward
       ↓
        ★ Likely Entry Point</pre>

                <p>That's much more powerful.</p>

                <hr class="border-gray-700 my-10">

                <h1 class="text-3xl font-bold text-white mb-6">I'd actually introduce an "Investigation Graph"</h1>
                <p>This fits extremely well with the architecture we discussed.</p>
                <p>Instead of thinking: <code class="bg-gray-800 px-2 py-1 rounded text-red-400 font-mono">MCP → answer</code></p>
                <p>think: <code class="bg-gray-800 px-2 py-1 rounded text-green-400 font-mono">MCP → evidence → hypothesis → more investigation → evidence → conclusion</code></p>

                <p>For example:</p>

                <pre class="bg-black border border-gray-800 p-6 rounded-lg text-green-400 font-mono text-sm overflow-x-auto shadow-inner leading-normal">
                   ┌───────────────┐
                   │ Attack Entry  │
                   │   Point ?     │
                   └───────┬───────┘
                           │
             ┌─────────────┼─────────────┐
             ▼             ▼             ▼
        Network         Application    Threat Intel
          MCP              MCP             MCP
             │              │              │
             ▼              ▼              ▼
        Port 8080       /upload POST     IP known
             │              │              │
             └──────────────┼──────────────┘
                            ▼
                     ┌──────────────┐
                     │ Correlation  │
                     └──────┬───────┘
                            ▼
                     New Hypothesis
                            │
                            ▼
                    Ask another MCP</pre>

                <p>This means <strong class="text-white">the output of one MCP can influence what the agent asks another MCP</strong>.</p>
                <p>That's the part that makes it genuinely agentic.</p>

                <hr class="border-gray-700 my-10">

                <h1 class="text-3xl font-bold text-white mb-6">You could have MCP "roles"</h1>
                <p>Rather than MCPs being arbitrary tool collections, the harness could classify them.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div class="bg-gray-800/50 p-6 rounded-lg border border-gray-700">
                        <h3 class="text-lg font-bold text-blue-400 mb-3 border-b border-gray-700 pb-2">Collection MCPs</h3>
                        <p class="text-sm text-gray-400 mb-3">Gather raw information.</p>
                        <ul class="font-mono text-sm text-green-400 space-y-1">
                            <li>> Network Scanner</li>
                            <li>> Filesystem</li>
                            <li>> PCAP</li>
                            <li>> Logs</li>
                            <li>> Cloud</li>
                        </ul>
                    </div>

                    <div class="bg-gray-800/50 p-6 rounded-lg border border-gray-700">
                        <h3 class="text-lg font-bold text-purple-400 mb-3 border-b border-gray-700 pb-2">Analysis MCPs</h3>
                        <p class="text-sm text-gray-400 mb-3">Interpret information.</p>
                        <ul class="font-mono text-sm text-green-400 space-y-1">
                            <li>> Log Analyzer</li>
                            <li>> Network Analyzer</li>
                            <li>> Malware Analyzer</li>
                            <li>> Configuration Analyzer</li>
                        </ul>
                    </div>

                    <div class="bg-gray-800/50 p-6 rounded-lg border border-gray-700">
                        <h3 class="text-lg font-bold text-yellow-400 mb-3 border-b border-gray-700 pb-2">Knowledge MCPs</h3>
                        <p class="text-sm text-gray-400 mb-3">Provide external knowledge.</p>
                        <ul class="font-mono text-sm text-green-400 space-y-1">
                            <li>> CVE database</li>
                            <li>> Threat intelligence</li>
                            <li>> MITRE ATT&CK</li>
                            <li>> Documentation</li>
                            <li>> Asset inventory</li>
                        </ul>
                    </div>

                    <div class="bg-gray-800/50 p-6 rounded-lg border border-gray-700">
                        <h3 class="text-lg font-bold text-red-400 mb-3 border-b border-gray-700 pb-2">Validation MCPs</h3>
                        <p class="text-sm text-gray-400 mb-3">Challenge or verify a hypothesis.</p>
                        <ul class="font-mono text-sm text-green-400 space-y-1">
                            <li>> Service validator</li>
                            <li>> Configuration checker</li>
                            <li>> Evidence correlator</li>
                        </ul>
                    </div>
                </div>

                <p class="mt-4">Then the agent can construct an investigation dynamically.</p>

                <hr class="border-gray-700 my-10">

                <h1 class="text-3xl font-bold text-white mb-6">Even better: MCP disagreement becomes useful</h1>
                <p>Suppose:</p>

                <div class="bg-black border border-gray-800 p-6 rounded-lg font-mono text-sm space-y-4 shadow-inner">
                    <div>
                        <span class="text-blue-400">Network MCP:</span><br>
                        <span class="text-gray-300">"Port 22 is the likely entry point."</span>
                    </div>
                    <div>
                        <span class="text-blue-400">Log MCP:</span><br>
                        <span class="text-gray-300">"No evidence of successful SSH authentication."</span>
                    </div>
                    <div>
                        <span class="text-blue-400">Threat Intel MCP:</span><br>
                        <span class="text-gray-300">"Source IP has historically targeted HTTP."</span>
                    </div>
                    <div>
                        <span class="text-blue-400">Application MCP:</span><br>
                        <span class="text-gray-300">"Suspicious request occurred on port 8080."</span>
                    </div>
                </div>

                <p>The agent shouldn't simply average these results.</p>
                <p>It should recognize:</p>
                <blockquote class="border-l-4 border-red-500 pl-4 italic text-gray-300 bg-red-900/20 py-2 rounded-r">
                    <strong class="text-red-400">There is conflicting evidence.</strong>
                </blockquote>

                <p>Then investigate further.</p>

                <pre class="bg-black border border-gray-800 p-6 rounded-lg text-green-400 font-mono text-sm overflow-x-auto shadow-inner leading-normal">
                 Conflict
                    │
          ┌─────────┴─────────┐
          ▼                   ▼
      SSH hypothesis      HTTP hypothesis
          │                   │
          ▼                   ▼
      More evidence       More evidence
          │                   │
          └─────────┬─────────┘
                    ▼
                Resolution</pre>

                <p>This gives your system something resembling an <strong class="text-white">adversarial research process</strong>.</p>
                <ul class="list-disc pl-6 space-y-2 text-gray-400">
                    <li>One MCP produces a hypothesis.</li>
                    <li>Another MCP challenges it.</li>
                    <li>Another provides supporting evidence.</li>
                </ul>
                <p>The agent determines which explanation is best supported.</p>

                <hr class="border-gray-700 my-10">

                <h1 class="text-3xl font-bold text-white mb-6">This changes your architecture slightly</h1>
                <p>I'd add a <strong class="text-white">Multi-Agent/Multi-MCP Orchestrator</strong>:</p>

                <pre class="bg-black border border-gray-800 p-6 rounded-lg text-purple-400 font-mono text-sm overflow-x-auto shadow-inner leading-normal">
                         USER
                           │
                           ▼
                         SKILL
                           │
                           ▼
                    CONTEXT RESOLVER
                           │
                           ▼
                       PLANNER
                           │
                           ▼
              ┌────────────────────────┐
              │ Investigation Strategy │
              └───────────┬────────────┘
                          │
          ┌───────────────┼───────────────┐
          ▼               ▼               ▼
       MCP #1           MCP #2           MCP #3
      Network            Logs            Intel
          │               │               │
          └───────────────┼───────────────┘
                          ▼
                 ┌────────────────┐
                 │ Evidence Store │
                 └───────┬────────┘
                         ▼
                 ┌────────────────┐
                 │   Correlator   │
                 └───────┬────────┘
                         ▼
                    ┌──────────┐
                    │  Agent   │
                    └────┬─────┘
                         │
                ┌────────┴────────┐
                │                 │
             Enough?            Conflict?
                │                 │
               YES                ▼
                │          Investigate again
                ▼
              REPORT</pre>

                <hr class="border-gray-700 my-10">

                <h2 class="text-2xl font-bold text-blue-400 mb-6">And there's a really cool extension</h2>
                <p>You don't necessarily have to execute all MCPs simultaneously.</p>
                <p>The agent could use <strong class="text-white">progressive investigation</strong>:</p>

                <div class="space-y-6 mt-6">
                    <div class="bg-gray-800/40 p-5 rounded border border-gray-700 border-l-4 border-l-blue-500">
                        <h4 class="font-bold text-white mb-2">Round 1 — Broad</h4>
                        <p class="font-mono text-sm text-gray-400">Network MCP<br>Log MCP<br>Asset MCP</p>
                    </div>

                    <div class="flex justify-center text-gray-500">↓</div>

                    <div class="bg-gray-800/40 p-5 rounded border border-gray-700 border-l-4 border-l-purple-500">
                        <h4 class="font-bold text-white mb-2">Round 2 — Narrow</h4>
                        <p class="text-sm text-gray-400 mb-2">Based on their results:</p>
                        <p class="font-mono text-sm text-gray-400">HTTP Analyzer<br>CVE MCP<br>PCAP MCP</p>
                    </div>

                    <div class="flex justify-center text-gray-500">↓</div>

                    <div class="bg-gray-800/40 p-5 rounded border border-gray-700 border-l-4 border-l-yellow-500">
                        <h4 class="font-bold text-white mb-2">Round 3 — Validate</h4>
                        <p class="font-mono text-sm text-gray-400">Configuration MCP<br>Evidence Correlator<br>Threat Intel MCP</p>
                    </div>

                    <div class="flex justify-center text-gray-500">↓</div>

                    <div class="bg-gray-800/40 p-5 rounded border border-gray-700 border-l-4 border-l-green-500">
                        <h4 class="font-bold text-white mb-2">Final</h4>
                        <ul class="font-mono text-sm text-green-400 list-none space-y-1">
                            <li>+ Evidence-backed conclusion</li>
                            <li>+ confidence</li>
                            <li>+ supporting evidence</li>
                            <li>+ contradictory evidence</li>
                            <li>+ unresolved questions</li>
                        </ul>
                    </div>
                </div>

                <div class="mt-12 bg-blue-900/20 border border-blue-800 p-8 rounded-xl text-center">
                    <p class="text-lg text-gray-300 mb-4">That gives you a very compelling concept for your project:</p>
                    <blockquote class="text-xl font-medium text-white italic">
                        "The harness doesn't simply call multiple MCPs. It orchestrates independent investigation perspectives and iteratively correlates their evidence to reduce uncertainty."
                    </blockquote>
                </div>
                <p class="mt-6 text-gray-400 text-center">
                    I'd actually consider making <strong>this</strong> one of the defining features of your project. It differentiates your architecture from a typical "LLM + MCP" application, because MCP becomes an <strong>ecosystem of investigative capabilities</strong>, while the harness provides the reasoning, orchestration, evidence correlation, and iteration layer.
                </p>
            </div>
        @else
            <div class="text-green-400 font-mono">
                <h2 class="text-3xl font-bold text-white mb-4">General Assistant Agent</h2>
                <p class="mb-2">> Mode: Standard Assistant</p>
                <p class="text-yellow-400 mt-6">> STATUS: STANDBY.</p>
            </div>
        @endif
    </div>
</div>
@endsection
