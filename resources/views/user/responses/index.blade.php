@extends('layouts.admin.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-dark">All Survey Responses</h3>

   

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
                        <!-- PDF Export Button - Using matching route name -->
                        <a href="{{ route('responses.export.pdf', $response->id) }}" class="btn btn-sm btn-danger">
                            <i class="fas fa-file-pdf"></i> PDF
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection