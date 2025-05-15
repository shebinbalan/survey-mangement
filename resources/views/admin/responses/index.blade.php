@extends('layouts.admin.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-dark">All Survey Responses</h3>

    <!-- Export All Responses to Excel Button -->
    <div class="mb-3 text-end">
        <a href="{{ route('admin.responses.export.excel') }}" class="btn btn-success">
            <i class="fas fa-file-excel"></i> Export All to Excel
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Survey</th>
                <th>Export</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($responses as $response)
                <tr>
                    <td>{{ $response->id }}</td>
                    <td>{{ $response->user->name }}</td>
                    <td>{{ $response->survey->title }}</td>
                    <td>
                        <a href="{{ route('admin.responses.export.pdf', $response->id) }}" class="btn btn-sm btn-danger">
                            <i class="fas fa-file-pdf"></i> PDF
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
