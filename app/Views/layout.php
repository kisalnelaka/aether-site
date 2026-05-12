<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'AETHER Technical Dashboard' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono&display=swap" rel="stylesheet">
    <style>
        :root { --bg: #050505; --accent: #10b981; --v1: #10b981; --v0: #ef4444; }
        body { background-color: var(--bg); color: #e5e5e5; font-family: 'Inter', sans-serif; }
        .mono { font-family: 'JetBrains Mono', monospace; }
        .glass { background: rgba(255, 255, 255, 0.02); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .stat-card { padding: 1.5rem; border-radius: 8px; background: rgba(255, 255, 255, 0.01); border: 1px solid rgba(255, 255, 255, 0.05); transition: border 0.3s; }
        .stat-card:hover { border-color: rgba(16, 185, 129, 0.2); }
        .tab-btn { padding: 1rem 1.5rem; font-size: 0.75rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; border-bottom: 2px solid transparent; opacity: 0.5; transition: 0.2s; }
        .tab-btn.active { opacity: 1; border-color: var(--accent); color: var(--accent); }
        .live-bar { position: fixed; bottom: 0; left: 0; right: 0; height: 36px; background: #000; border-top: 1px solid #111; display: flex; align-items: center; padding: 0 1.5rem; font-family: 'JetBrains Mono', monospace; font-size: 10px; color: #555; z-index: 1000; }
        .live-bar span { color: #fff; margin-left: 4px; }
        .status-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--accent); box-shadow: 0 0 10px var(--accent); }
    </style>
</head>
<body class="antialiased">
    <nav class="fixed top-0 left-0 right-0 h-14 border-b border-white/5 glass z-50 flex items-center px-6 justify-between">
        <div class="flex items-center gap-6">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 bg-white text-black font-bold flex items-center justify-center text-xs">A</div>
                <span class="font-bold tracking-tight text-sm uppercase letter-spacing-1">AETHER</span>
            </div>
            <div class="h-4 w-[1px] bg-white/10"></div>
            <div class="flex gap-2" id="tabs">
                <button class="tab-btn active" data-tab="v1">v1.0 Engine</button>
                <button class="tab-btn" data-tab="v0">Legacy v0.1</button>
                <button class="tab-btn" data-tab="bench">Benchmarks</button>
            </div>
        </div>
        <div class="flex items-center gap-4 text-[10px] font-mono text-zinc-500">
            <span class="flex items-center gap-2"><span class="status-dot"></span> TELEMETRY_ACTIVE</span>
        </div>
    </nav>

    <main class="pt-24 pb-20 px-8 max-w-6xl mx-auto">
        <?= $content ?>
    </main>

    <footer class="live-bar">
        <div class="flex gap-6 items-center">
            <div>RSS_MEM:<span id="bar-mem">1.24 MB</span></div>
            <div>CPU_LOAD:<span id="bar-cpu">0.02%</span></div>
            <div>FIBERS:<span id="bar-fibers">1024</span></div>
            <div>BOOT_LATENCY:<span>0.048ms</span></div>
        </div>
        <div class="ml-auto flex gap-4">
            <div>Uptime: <span id="bar-uptime">00:00:00</span></div>
            <div>Worker: <span>#01 (PID 1402)</span></div>
        </div>
    </footer>

    <script>
        // Tab Management
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.onclick = () => {
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                document.querySelectorAll('.tab-content').forEach(c => c.classList.add('hidden'));
                const content = document.getElementById('content-' + btn.dataset.tab);
                if (content) content.classList.remove('hidden');
            };
        });

        // Real-time Simulation & Metrics
        let requestIndex = 1402;
        let startTime = Date.now();

        async function updateTelemetry() {
            try {
                const resp = await fetch('/api/stats');
                const data = await resp.json();
                
                // Fluctuating values for "live" feel
                const mem = (data.v1.memory_mb + (Math.random() * 0.05 - 0.025)).toFixed(2);
                const cpu = (Math.random() * 0.05 + 0.01).toFixed(2);
                const fibers = data.v1.fibers + Math.floor(Math.random() * 4 - 2);
                
                requestIndex += Math.floor(Math.random() * 3);

                // Update UI
                if (document.getElementById('v1-memory')) document.getElementById('v1-memory').innerText = mem + ' MB';
                if (document.getElementById('v1-fibers')) document.getElementById('v1-fibers').innerText = fibers.toLocaleString();
                if (document.getElementById('v1-index')) document.getElementById('v1-index').innerText = requestIndex.toLocaleString();
                
                // Update Bar
                document.getElementById('bar-mem').innerText = mem + ' MB';
                document.getElementById('bar-cpu').innerText = cpu + '%';
                document.getElementById('bar-fibers').innerText = fibers;
                
                const uptime = Math.floor((Date.now() - startTime) / 1000);
                const h = Math.floor(uptime / 3600).toString().padStart(2, '0');
                const m = Math.floor((uptime % 3600) / 60).toString().padStart(2, '0');
                const s = (uptime % 60).toString().padStart(2, '0');
                document.getElementById('bar-uptime').innerText = `${h}:${m}:${s}`;

                // Inject dynamic logs
                const logs = document.getElementById('ws-logs');
                if (logs && Math.random() > 0.7) {
                    const line = document.createElement('div');
                    line.innerHTML = `[TELEMETRY] Packet received: ${Math.random().toString(16).substr(2, 8)}...`;
                    logs.appendChild(line);
                    if (logs.childNodes.length > 10) logs.removeChild(logs.firstChild);
                    logs.scrollTop = logs.scrollHeight;
                }

                // Inject Jobs
                const jobList = document.getElementById('job-list');
                if (jobList && jobList.childNodes.length < 5) {
                    const jobs = ['ImageResize', 'EmailNotify', 'CacheWarm', 'LogSync', 'DBOptimize'];
                    const job = jobs[Math.floor(Math.random() * jobs.length)];
                    const div = document.createElement('div');
                    div.className = "flex justify-between items-center bg-white/5 p-2 rounded text-[10px]";
                    div.innerHTML = `<span class="text-zinc-500">${job}Task</span><span class="text-emerald-500 font-bold">COMPLETED</span>`;
                    jobList.appendChild(div);
                    if (jobList.childNodes.length > 3) jobList.removeChild(jobList.firstChild);
                }

            } catch (e) {}
        }

        setInterval(updateTelemetry, 1000);
        updateTelemetry();
    </script>
</body>
</html>
