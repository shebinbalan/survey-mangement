@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h3>All Questions</h3>
    <a href="{{ route('admin.questions.create') }}" class="btn btn-primary mb-3">Add Question</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Survey</th>
                <th>Question</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $question)
            <tr>
                <td>{{ $question->survey->title }}</td>
                <td>{{ $question->question_text }}</td>
                <td>
                    <a href="{{ route('admin.questions.edit', $question->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
