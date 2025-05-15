<?php

namespace App\Exports;

use App\Models\Response;
use Maatwebsite\Excel\Concerns\FromCollection;

class ResponsesExport implements FromCollection
{
    public function collection()
    {
        return Response::with(['user', 'survey'])->get()->map(function ($response) {
            return [
                'ID' => $response->id,
                'User Name' => $response->user->name ?? 'N/A',
                'Survey Title' => $response->survey->title ?? 'N/A',
                'Submitted At' => $response->created_at->format('Y-m-d H:i:s'),
            ];
        });
    }
}