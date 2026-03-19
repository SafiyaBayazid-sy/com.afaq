<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $document['title'] }} | AFAQ Docs</title>
    <style>
        :root {
            --bg: #151d1b;
            --panel: #1b2522;
            --text: #edf3f1;
            --muted: #b6c6c0;
            --line: #32423d;
            --accent: #7ad0bb;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background:
                radial-gradient(circle at top right, rgba(122, 208, 187, 0.14), transparent 30%),
                var(--bg);
            color: var(--text);
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        a { color: inherit; text-decoration: none; }

        .page {
            max-width: 1100px;
            margin: 0 auto;
            padding: 32px 20px 48px;
        }

        .topbar {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 14px;
            align-items: center;
            margin-bottom: 24px;
        }

        .topbar h1 {
            margin: 0;
            font-size: clamp(1.7rem, 3vw, 2.4rem);
        }

        .topbar p {
            margin: 6px 0 0;
            color: var(--muted);
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .button {
            padding: 11px 15px;
            border-radius: 12px;
            border: 1px solid var(--line);
            background: var(--panel);
            font-weight: 600;
        }

        .button.primary {
            border-color: var(--accent);
            color: var(--accent);
        }

        .viewer {
            border: 1px solid var(--line);
            background: rgba(27, 37, 34, 0.9);
            border-radius: 22px;
            padding: 24px;
            overflow: auto;
        }

        pre {
            margin: 0;
            white-space: pre-wrap;
            word-break: break-word;
            line-height: 1.65;
            font-size: 14px;
            font-family: Consolas, Monaco, "Courier New", monospace;
            color: #eef6f3;
        }
    </style>
</head>
<body>
    <main class="page">
        <div class="topbar">
            <div>
                <h1>{{ $document['title'] }}</h1>
                <p>{{ $document['description'] }}</p>
            </div>
            <div class="actions">
                <a class="button" href="{{ route('docs.index') }}">Docs Home</a>
                <a class="button primary" href="{{ route('docs.documents.download', request()->route('document')) }}">Download File</a>
            </div>
        </div>

        <section class="viewer">
            <pre>{{ $content }}</pre>
        </section>
    </main>
</body>
</html>
