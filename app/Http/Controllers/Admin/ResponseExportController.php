<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ResponsesExport;
use Barryvdh\DomPDF\Facade\Pdf;

class ResponseExportController extends Controller
{
    public function index()
    {
        $responses = Response::with('user', 'survey')->latest()->get();
        return view('admin.responses.index', compact('responses'));
    }

    public function exportExcel()
    {
        return Excel::download(new ResponsesExport, 'responses.xlsx');
    }

    public function exportPdf($id)
    {
        $response = Response::with(['user', 'survey', 'answers.question'])->findOrFail($id);
        $pdf = PDF::loadView('admin.responses.export.pdf', compact('response'));
        return $pdf->download('response_' . $response->id . '.pdf');
    }
}
