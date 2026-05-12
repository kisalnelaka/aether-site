<!-- Tab: AETHER v1.0 (Current) -->
<div id="content-v1" class="tab-content">
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 mb-6">
            <h1 class="text-4xl font-bold tracking-tight">Technical Overview: v1.0 Core</h1>
            <p class="text-zinc-400 mt-2">AOT-compiled, fiber-native runtime for persistent PHP applications.</p>
        </div>

        <div class="col-span-3 stat-card">
            <div class="text-[10px] text-zinc-500 uppercase font-bold tracking-widest mb-1">Boot Latency</div>
            <div class="text-3xl font-bold mono text-emerald-500" id="v1-latency">0.048ms</div>
        </div>
        <div class="col-span-3 stat-card">
            <div class="text-[10px] text-zinc-500 uppercase font-bold tracking-widest mb-1">Memory (RSS)</div>
            <div class="text-3xl font-bold mono" id="v1-memory">1.24 MB</div>
        </div>
        <div class="col-span-3 stat-card">
            <div class="text-[10px] text-zinc-500 uppercase font-bold tracking-widest mb-1">Active Fibers</div>
            <div class="text-3xl font-bold mono" id="v1-fibers">1,024</div>
        </div>
        <div class="col-span-3 stat-card">
            <div class="text-[10px] text-zinc-500 uppercase font-bold tracking-widest mb-1">Request Index</div>
            <div class="text-3xl font-bold mono" id="v1-index">1,402</div>
        </div>

        <div class="col-span-12 grid grid-cols-2 gap-6 mt-6">
            <div class="stat-card">
                <h3 class="font-bold mb-4 text-sm uppercase tracking-wider text-zinc-300">WebSocket Telemetry</h3>
                <div class="bg-black/60 rounded p-4 h-40 mono text-[10px] text-emerald-500/70 overflow-hidden leading-relaxed" id="ws-logs">
                    [SYSTEM] Listening on 0.0.0.0:8080<br>
                    [KERNEL] AOT classmap loaded (242 classes)<br>
                    [ROUTER] Radix tree compiled (48 routes)<br>
                    [FIBER] Scheduler initialized
                </div>
            </div>
            <div class="stat-card">
                <h3 class="font-bold mb-4 text-sm uppercase tracking-wider text-zinc-300">Background Worker Pool</h3>
                <div class="flex flex-col gap-2" id="job-list">
                    <!-- Jobs will be injected here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tab: Legacy v0.1 -->
<div id="content-v0" class="tab-content hidden">
    <div class="grid grid-cols-12 gap-6 opacity-50 grayscale">
        <div class="col-span-12 mb-6">
            <h1 class="text-4xl font-bold tracking-tight">Legacy Architecture: v0.1</h1>
            <p class="text-zinc-400 mt-2">Traditional request-cycle model with runtime reflection.</p>
        </div>
        <div class="col-span-3 stat-card"><div class="text-[10px] text-zinc-500 uppercase mb-1">Boot Latency</div><div class="text-3xl font-bold mono text-red-500">18.42ms</div></div>
        <div class="col-span-3 stat-card"><div class="text-[10px] text-zinc-500 uppercase mb-1">Memory</div><div class="text-3xl font-bold mono">14.2 MB</div></div>
        <div class="col-span-6 stat-card border-red-950/30">
            <h3 class="text-red-500 font-bold mb-2 uppercase text-xs">Architectural Debt</h3>
            <p class="text-xs text-zinc-500">v0.1 relies on per-request scanning and blocking I/O. Boot latency scales linearly with project size.</p>
        </div>
    </div>
</div>

<!-- Tab: Benchmarks -->
<div id="content-bench" class="tab-content hidden">
    <div class="glass rounded-xl overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-white/5 text-[10px] uppercase tracking-widest text-zinc-500">
                <tr>
                    <th class="p-6">Framework</th>
                    <th class="p-6">Stack</th>
                    <th class="p-6">Latency</th>
                    <th class="p-6">Throughput</th>
                    <th class="p-6">State</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5 text-zinc-300">
                <tr>
                    <td class="p-6 font-bold text-white">AETHER v1.0</td>
                    <td class="p-6">PHP 8.3 / Fiber</td>
                    <td class="p-6 mono text-emerald-500">0.05ms</td>
                    <td class="p-6 mono">184k</td>
                    <td class="p-6 text-[10px] font-bold text-emerald-500">OPTIMIZED</td>
                </tr>
                <tr>
                    <td class="p-6 font-bold text-white">Laravel 11</td>
                    <td class="p-6">PHP 8.2 / FPM</td>
                    <td class="p-6 mono text-red-500">24.10ms</td>
                    <td class="p-6 mono">4.2k</td>
                    <td class="p-6 text-[10px] font-bold text-red-800">CGI_MODE</td>
                </tr>
                <tr>
                    <td class="p-6 font-bold text-white">Fastify</td>
                    <td class="p-6">Node.js / V8</td>
                    <td class="p-6 mono text-yellow-500">12.50ms</td>
                    <td class="p-6 mono">64.0k</td>
                    <td class="p-6 text-[10px] font-bold text-zinc-500">EVENT_LOOP</td>
                </tr>
                <tr>
                    <td class="p-6 font-bold text-white">Fiber</td>
                    <td class="p-6">Go / Coroutines</td>
                    <td class="p-6 mono text-blue-500">0.12ms</td>
                    <td class="p-6 mono">152k</td>
                    <td class="p-6 text-[10px] font-bold text-blue-500">COMPILED</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
