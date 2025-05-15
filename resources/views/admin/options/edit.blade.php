@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h3>Edit Option</h3>

    <form action="{{ route('admin.options.update', $option->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Question</label>
            <select name="question_id" class="form-control" required>
                @foreach($questions as $question)
                    <option value="{{ $question->id }}" 
                        {{ $option->question_id == $question->id ? 'selected' : '' }}>
                        {{ $question->question_text }} (Survey: {{ $question->survey->title }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Option Text</label>
            <input type="text" name="option_text" class="form-control" value="{{ $option->option_text }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Option</button>
    </form>
</div>
@endsection
