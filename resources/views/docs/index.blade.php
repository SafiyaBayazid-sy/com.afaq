<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AFAQ API Docs</title>
    <style>
        :root {
            --bg: #f3efe7;
            --panel: #fffdf8;
            --text: #14231f;
            --muted: #5d6f69;
            --line: #d9d2c3;
            --accent: #1f6b5d;
            --accent-soft: #d8ece7;
            --shadow: 0 20px 40px rgba(20, 35, 31, 0.08);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(31, 107, 93, 0.12), transparent 30%),
                linear-gradient(180deg, #f7f3eb 0%, var(--bg) 100%);
        }

        a { color: inherit; text-decoration: none; }

        .page {
            max-width: 1180px;
            margin: 0 auto;
            padding: 48px 24px 64px;
        }

        .hero {
            display: grid;
            gap: 20px;
            grid-template-columns: 2fr 1fr;
            margin-bottom: 36px;
        }

        .hero-card,
        .panel {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 24px;
            box-shadow: var(--shadow);
        }

        .hero-card {
            padding: 32px;
        }

        .eyebrow {
            display: inline-flex;
            padding: 8px 12px;
            border-radius: 999px;
            background: var(--accent-soft);
            color: var(--accent);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        h1 {
            margin: 18px 0 12px;
            font-size: clamp(2rem, 4vw, 3.6rem);
            line-height: 1.05;
        }

        .hero p,
        .card p,
        .meta,
        .panel p {
            color: var(--muted);
            line-height: 1.6;
        }

        .quick-links {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 24px;
        }

        .button,
        .link-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 16px;
            border-radius: 14px;
            border: 1px solid var(--line);
            background: #ffffff;
            font-weight: 600;
        }

        .button.primary {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }

        .stats {
            padding: 24px;
            display: grid;
            gap: 16px;
            align-content: start;
        }

        .stat {
            padding: 16px;
            border-radius: 18px;
            background: #f8f5ef;
            border: 1px solid var(--line);
        }

        .stat strong {
            display: block;
            font-size: 1.6rem;
            margin-bottom: 6px;
        }

        .section {
            margin-top: 36px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: end;
            margin-bottom: 16px;
        }

        .section-header h2 {
            margin: 0;
            font-size: 1.5rem;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 16px;
        }

        .card {
            padding: 22px;
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 22px;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .card h3 {
            margin: 0;
            font-size: 1.05rem;
        }

        .meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            font-size: 0.92rem;
        }

        .card-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: auto;
        }

        .footer-note {
            margin-top: 36px;
            padding: 20px 22px;
        }

        code {
            padding: 2px 8px;
            border-radius: 999px;
            background: #f0ece4;
            font-family: Consolas, Monaco, monospace;
            font-size: 0.92em;
        }

        @media (max-width: 900px) {
            .hero {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <section class="hero">
            <article class="hero-card">
                <span class="eyebrow">AFAQ Docs Hub</span>
                <h1>Everything for the API in one place.</h1>
                <p>
                    Use the interactive reference for endpoint details, then jump into the quickstart,
                    PDF contract notes, or downloadable Postman files without digging through the repository.
                </p>
                <div class="quick-links">
                    <a class="button primary" href="{{ url('/docs/api') }}">Open Interactive Docs</a>
                    <a class="button" href="{{ url('/docs/api.json') }}">Open OpenAPI JSON</a>
                    <a class="button" href="{{ route('docs.documents.show', 'quickstart') }}">Read Quickstart</a>
                </div>
            </article>

            <aside class="hero-card stats">
                <div class="stat">
                    <strong>2</strong>
                    <span>API surfaces documented: <code>/api</code> and <code>/api/v1</code></span>
                </div>
                <div class="stat">
                    <strong>6</strong>
                    <span>Supporting artifacts linked from this page</span>
                </div>
                <div class="stat">
                    <strong>1</strong>
                    <span>Single starting point at <code>/docs</code></span>
                </div>
            </aside>
        </section>

        <section class="section">
            <div class="section-header">
                <div>
                    <h2>Interactive Reference</h2>
                    <p>Generated documentation and machine-readable artifacts.</p>
                </div>
            </div>
            <div class="grid">
                @foreach ($interactiveDocs as $item)
                    <article class="card">
                        <h3>{{ $item['title'] }}</h3>
                        <p>{{ $item['description'] }}</p>
                        <div class="card-actions">
                            <a class="link-pill" href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        @foreach ($documents as $section => $items)
            <section class="section">
                <div class="section-header">
                    <div>
                        <h2>{{ $section }}</h2>
                        <p>
                            @if ($section === 'Start Here')
                                The fastest path for onboarding and contract validation.
                            @elseif ($section === 'Downloads')
                                Files you can import directly into tooling.
                            @else
                                Longer-form implementation notes and supporting references.
                            @endif
                        </p>
                    </div>
                </div>

                <div class="grid">
                    @foreach ($items as $item)
                        <article class="card">
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['description'] }}</p>
                            <div class="meta">
                                <span>Format: <code>{{ strtoupper($item['format']) }}</code></span>
                                <span>Size: {{ $item['size'] }}</span>
                                <span>Updated: {{ $item['updated_at'] }}</span>
                            </div>
                            <div class="card-actions">
                                @if ($item['view_url'])
                                    <a class="link-pill" href="{{ $item['view_url'] }}">Open</a>
                                @endif
                                <a class="link-pill" href="{{ $item['download_url'] }}">Download</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endforeach

        <section class="panel footer-note">
            <p>
                When the backend changes, regenerate the spec with <code>composer docs:api</code>.
                This page groups the generated spec and the hand-written companion documents so the docs stay easier to scan.
            </p>
        </section>
    </main>
</body>
</html>
