<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'AETHER' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&family=JetBrains+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="background-blobs">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>
    
    <nav class="navbar">
        <div class="container">
            <a href="/" class="logo">AETHER</a>
            <div class="nav-links">
                <a href="#features">Features</a>
                <a href="#performance">Performance</a>
                <a href="https://github.com/kisalnelaka/aether" target="_blank" class="btn-primary">GitHub</a>
            </div>
        </div>
    </nav>

    <main>
        <?= $content ?>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?= date('Y') ?> AETHER Framework. Built for speed.</p>
        </div>
    </footer>

    <?php if (isset($perf)): ?>
    <div class="perf-bar">
        <div class="container">
            <span class="perf-item">⚡ <b><?= number_format($perf['time_ms'], 3) ?>ms</b> response</span>
            <span class="perf-item">🧠 <b><?= number_format($perf['memory_kb'], 0) ?>KB</b> memory</span>
            <span class="perf-item">📦 <b><?= $perf['files_loaded'] ?></b> files</span>
            <span class="perf-tag <?= $perf['persistent'] ? 'active' : '' ?>">
                PERSISTENT MODE: <?= $perf['persistent'] ? 'ON' : 'OFF' ?> 
                <?php if ($perf['persistent']): ?>(Req #<?= $perf['request_id'] ?>)<?php endif; ?>
            </span>
        </div>
    </div>
    <?php endif; ?>

    <script src="/js/main.js"></script>
</body>
</html>
