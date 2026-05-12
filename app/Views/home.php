<section class="hero">
    <div class="container">
        <h1 class="fade-in"><?= $title ?></h1>
        <p class="lead fade-in delay-1"><?= $subtitle ?></p>
        <div class="hero-actions fade-in delay-2">
            <a href="#features" class="btn-outline">Explore Features</a>
            <code>php aether-cli.php serve</code>
        </div>
    </div>
</section>

<section id="features" class="features">
    <div class="container">
        <div class="section-header">
            <h2>Why AETHER?</h2>
            <p>Because the web is too slow and your framework is too fat.</p>
        </div>
        <div class="feature-grid">
            <div class="feature-card">
                <div class="icon">🚀</div>
                <h3>0ms Boot Time</h3>
                <p>Boots once, stays in memory. Zero overhead for subsequent requests.</p>
            </div>
            <div class="feature-card">
                <div class="icon">🧩</div>
                <h3>No Bloat</h3>
                <p>Under 180KB core. Exactly zero external dependencies. No Composer needed.</p>
            </div>
            <div class="feature-card">
                <div class="icon">⚡</div>
                <h3>Radix Routing</h3>
                <p>O(K) lookup time. No slow regex matching. Just pure efficiency.</p>
            </div>
            <div class="feature-card">
                <div class="icon">🧵</div>
                <h3>Native Fibers</h3>
                <p>Non-blocking I/O built directly into the core. Asynchronous power without the complexity.</p>
            </div>
        </div>
    </div>
</section>

<section id="performance" class="performance">
    <div class="container">
        <div class="glass-panel">
            <div class="performance-stats">
                <div class="stat">
                    <span class="value">~0ms</span>
                    <span class="label">Response Time</span>
                </div>
                <div class="stat">
                    <span class="value">180KB</span>
                    <span class="label">Core Size</span>
                </div>
                <div class="stat">
                    <span class="value">0</span>
                    <span class="label">Dependencies</span>
                </div>
            </div>
            <div class="performance-text">
                <h2>Engineered for the Elite.</h2>
                <p>AETHER is not for everyone. It's for developers who care about every cycle, every byte, and every millisecond. If you want to build a monolith with 300 packages, go use Laravel. If you want raw speed, you're home.</p>
            </div>
        </div>
    </div>
</section>
