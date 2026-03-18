<?php

namespace App\Services;

use Closure;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TableCsvExporter
{
    public function stream(
        Builder $query,
        string $fileName,
        array $headings,
        Closure $mapRecord,
        int $chunkSize = 200,
    ): StreamedResponse {
        return response()->streamDownload(function () use ($chunkSize, $fileName, $headings, $mapRecord, $query): void {
            $handle = fopen('php://output', 'wb');

            if ($handle === false) {
                abort(500, "Unable to create export file [{$fileName}].");
            }

            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, $headings);

            foreach ((clone $query)->lazy($chunkSize) as $record) {
                fputcsv($handle, $this->normalizeRow($mapRecord($record)));
            }

            fclose($handle);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    protected function normalizeRow(array $row): array
    {
        return array_map($this->normalizeValue(...), $row);
    }

    protected function normalizeValue(mixed $value): string | int | float
    {
        if ($value === null) {
            return '';
        }

        if (is_bool($value)) {
            return $value ? 'Yes' : 'No';
        }

        if ($value instanceof DateTimeInterface) {
            return $value->format('Y-m-d H:i:s');
        }

        if (is_array($value) || is_object($value)) {
            return json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?: '';
        }

        return (string) $value;
    }
}
