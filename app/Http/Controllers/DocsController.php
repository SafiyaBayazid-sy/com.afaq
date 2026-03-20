<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class DocsController extends Controller
{
    /**
     * Show the API documentation hub page.
     */
    public function index(): View
    {
        $documents = collect($this->documents())
            ->map(function (array $document, string $key): array {
                $path = base_path($document['path']);
                $isText = in_array($document['format'], ['md', 'txt'], true);

                return [
                    ...$document,
                    'key' => $key,
                    'size' => file_exists($path) ? $this->humanFileSize(filesize($path)) : 'Unavailable',
                    'updated_at' => file_exists($path)
                        ? date('Y-m-d H:i', filemtime($path))
                        : 'Unavailable',
                    'view_url' => $isText ? route('docs.documents.show', $key) : null,
                    'download_url' => route('docs.documents.download', $key),
                ];
            })
            ->groupBy('section');

        return view('docs.index', [
            'interactiveDocs' => [
                [
                    'title' => 'Interactive API Reference',
                    'description' => 'Browse endpoints, schemas, auth requirements, and example requests in the generated Scramble UI.',
                    'url' => url('/docs/api'),
                    'label' => 'Open UI',
                ],
                [
                    'title' => 'OpenAPI JSON',
                    'description' => 'Use the generated machine-readable spec for codegen, integrations, or importing into tooling.',
                    'url' => url('/docs/api.json'),
                    'label' => 'Open JSON',
                ],
            ],
            'documents' => $documents,
        ]);
    }

    /**
     * Render a text-based docs file inside a readable browser page.
     */
    public function show(string $document): View
    {
        $meta = $this->documentOrFail($document);

        if (isset($meta['view']) && view()->exists($meta['view'])) {
            return view($meta['view'], [
                'document' => $meta,
            ]);
        }

        abort_unless(in_array($meta['format'], ['md', 'txt'], true), 404);

        $path = base_path($meta['path']);

        abort_unless(file_exists($path), 404);

        return view('docs.show', [
            'document' => $meta,
            'content' => file_get_contents($path),
        ]);
    }

    /**
     * Download a docs artifact from the docs directory.
     */
    public function download(string $document): Response
    {
        $meta = $this->documentOrFail($document);
        $path = base_path($meta['path']);

        abort_unless(file_exists($path), 404);

        return response()->download($path, basename($path));
    }

    /**
     * Return the allowed document definitions.
     *
     * @return array<string, array<string, string>>
     */
    protected function documents(): array
    {
        return [
            'quickstart' => [
                'title' => 'Mobile Team Quickstart',
                'description' => 'Start here for auth flow, base URLs, recommended first requests, and sample payloads.',
                'path' => 'docs/mobile-team-api-quickstart.md',
                'format' => 'md',
                'section' => 'Start Here',
            ],
            'pdf-contract' => [
                'title' => 'PDF Contract Notes',
                'description' => 'Tracks the endpoints requested in the PDF and the compatibility layer added to this project.',
                'path' => 'docs/pdf-api-contract.md',
                'format' => 'md',
                'section' => 'Start Here',
            ],
            'postman-collection' => [
                'title' => 'Postman Collection',
                'description' => 'Import the customer API requests into Postman with the curated collection file.',
                'path' => 'docs/postman-customer-api-collection.json',
                'format' => 'json',
                'section' => 'Downloads',
            ],
            'postman-environment' => [
                'title' => 'Postman Environment',
                'description' => 'Local variables for base URL, auth token, credentials, and sample IDs.',
                'path' => 'docs/postman-customer-api-environment.json',
                'format' => 'json',
                'section' => 'Downloads',
            ],
            'crm-features' => [
                'title' => 'CRM Features Guide',
                'description' => 'Product and operations guide covering dashboard KPIs, lead intake, inquiries, bookings, forms, campaigns, and notifications.',
                'path' => 'docs/crm-features-full-documentation.txt',
                'format' => 'txt',
                'section' => 'Reference Notes',
                'view' => 'docs.crm-features',
            ],
            'form-builder' => [
                'title' => 'Form Builder Notes',
                'description' => 'Feature notes for dynamic forms, submission flow, and downstream CRM integration.',
                'path' => 'docs/form-builder-feature-documentation.txt',
                'format' => 'txt',
                'section' => 'Reference Notes',
            ],
        ];
    }

    /**
     * Resolve a known document definition or abort.
     *
     * @return array<string, string>
     */
    protected function documentOrFail(string $document): array
    {
        $meta = Arr::get($this->documents(), $document);

        abort_if(! $meta, 404);

        return $meta;
    }

    protected function humanFileSize(int|false $bytes): string
    {
        if ($bytes === false) {
            return 'Unavailable';
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $size = (float) $bytes;
        $unit = 0;

        while ($size >= 1024 && $unit < count($units) - 1) {
            $size /= 1024;
            $unit++;
        }

        return number_format($size, $unit === 0 ? 0 : 1).' '.$units[$unit];
    }
}
