@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h3>Options</h3>
    <a href="{{ route('admin.options.create') }}" class="btn btn-success mb-3">Add Option</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Option Text</th>
                <th>Question</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($options as $option)
            <tr>
                <td>{{ $option->option_text }}</td>
                <td>{{ $option->question->question_text }}</td>
                <td>
                    <a href="{{ route('admin.options.edit', $option->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.options.destroy', $option->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this option?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
