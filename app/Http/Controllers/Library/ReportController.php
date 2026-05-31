<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Exports\Library\BooksExport;
use App\Services\Library\ReportService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    protected ReportService $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index()
    {
        return view('library.reports.index');
    }

    public function generate(Request $request, string $type)
    {
        $data = match ($type) {
            'books' => $this->reportService->booksReport($request),
            'issues' => $this->reportService->issuesReport($request),
            'returns' => $this->reportService->returnsReport($request),
            'overdue' => $this->reportService->overdueReport($request),
            'fines' => $this->reportService->finesReport($request),
            'members' => $this->reportService->membersReport($request),
            'popular-books' => $this->reportService->popularBooksReport($request),
            'category-wise' => $this->reportService->categoryWiseReport($request),
            default => abort(404, 'Unknown report type.'),
        };

        return view("library.reports.{$type}", $data);
    }

    public function export(Request $request, string $type, string $format)
    {
        $data = match ($type) {
            'books' => $this->reportService->booksReport($request),
            'issues' => $this->reportService->issuesReport($request),
            'returns' => $this->reportService->returnsReport($request),
            'overdue' => $this->reportService->overdueReport($request),
            'fines' => $this->reportService->finesReport($request),
            'members' => $this->reportService->membersReport($request),
            'popular-books' => $this->reportService->popularBooksReport($request),
            'category-wise' => $this->reportService->categoryWiseReport($request),
            default => abort(404, 'Unknown report type.'),
        };

        $filename = "library_{$type}_report_" . now()->format('Y-m-d');

        return match ($format) {
            'pdf' => $this->exportPdf($type, $data, $filename),
            'excel' => $this->exportExcel($type, $data, $filename),
            'csv' => $this->exportCsv($type, $data, $filename),
            default => abort(404, 'Unknown export format.'),
        };
    }

    protected function exportPdf(string $type, array $data, string $filename)
    {
        $pdf = Pdf::loadView("library.reports.pdf.{$type}", $data)
            ->setPaper('a4', 'landscape');

        return $pdf->download("{$filename}.pdf");
    }

    protected function exportExcel(string $type, array $data, string $filename)
    {
        $exportClass = match ($type) {
            'books' => new BooksExport(),
            default => new BooksExport(), // Fallback; specific exports can be added later
        };

        return Excel::download($exportClass, "{$filename}.xlsx");
    }

    protected function exportCsv(string $type, array $data, string $filename)
    {
        $items = $data['items'] ?? $data[array_key_first($data)] ?? collect();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}.csv\"",
        ];

        $callback = function () use ($items) {
            $file = fopen('php://output', 'w');

            if ($items->isNotEmpty()) {
                $first = $items->first();
                if (is_array($first)) {
                    fputcsv($file, array_keys($first));
                } elseif (is_object($first)) {
                    fputcsv($file, array_keys($first->toArray()));
                }
            }

            foreach ($items as $item) {
                $row = is_array($item) ? $item : $item->toArray();
                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
