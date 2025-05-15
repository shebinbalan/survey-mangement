@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h3>My Surveys</h3>
    <a href="{{ route('admin.surveys.create') }}" class="btn btn-primary mb-3">Create New Survey</a>
    <ul class="list-group">
        @foreach ($surveys as $survey)
            <li class="list-group-item d-flex justify-content-between">
                <div>{{ $survey->title }}</div>
                <div>
                    <a href="{{ route('admin.surveys.edit', $survey) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.surveys.destroy', $survey) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                  <a href="{{ route('admin.surveys.preview', $survey->id) }}" class="btn btn-sm btn-info">
    <i class="fas fa-eye"></i> Preview
</a>
<a href="{{ route('admin.surveys.responses', $survey->id) }}" class="btn btn-sm btn-info">View Responses</a>
<a href="{{ route('admin.surveys.reorderPage', $survey->id) }}" class="btn btn-secondary">
    <i class="fas fa-sort"></i> Reorder Questions
</a>

                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection
