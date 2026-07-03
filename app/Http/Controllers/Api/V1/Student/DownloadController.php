<?php

namespace App\Http\Controllers\Api\V1\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function index(Request $request)
    {
        $student = $request->user();

        // Stub — wire to your report card / document models
        $reportCards = [];
        $certificates = [];
        $documents = [];

        if (class_exists(\App\Models\ReportCard::class)) {
            $reportCards = \App\Models\ReportCard::where('student_id', $student->id)
                ->get()
                ->map(fn($rc) => [
                    'id' => $rc->id,
                    'title' => $rc->title ?? 'Report Card',
                    'date' => optional($rc->generated_at)->format('Y-m-d'),
                    'url' => $rc->url ?? null,
                ])->values();
        }

        if (class_exists(\App\Models\Certificate::class)) {
            $certificates = \App\Models\Certificate::where('student_id', $student->id)
                ->get()
                ->map(fn($c) => [
                    'id' => $c->id,
                    'title' => $c->title,
                    'date' => optional($c->issued_at)->format('Y-m-d'),
                    'url' => $c->url ?? null,
                ])->values();
        }

        return response()->json([
            'report_cards' => $reportCards,
            'certificates' => $certificates,
            'documents' => $documents,
        ]);
    }
}
