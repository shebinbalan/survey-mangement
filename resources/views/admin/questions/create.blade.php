@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h3>Add Question</h3>

    <form action="{{ route('admin.questions.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Survey</label>
            <select name="survey_id" class="form-control" required>
                <option value="">Select Survey</option>
                @foreach($surveys as $survey)
                    <option value="{{ $survey->id }}" {{ old('survey_id') == $survey->id ? 'selected' : '' }}>
                        {{ $survey->title }}
                    </option>
                @endforeach
            </select>
        </div>
       <div class="mb-3">
            <label>Time Limit (in seconds)</label>
            <input type="number" name="time_limit" class="form-control" value="{{ old('time_limit', $survey->time_limit ?? '') }}">
        </div>
        <div class="mb-3">
            <label>Question Text</label>
            <input type="text" name="question_text" class="form-control" value="{{ old('question_text') }}" required>
        </div>

        <div class="mb-3">
            <label>Answer Type</label>
            <select name="type" class="form-control" required>
                <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>Text</option>
                <option value="radio" {{ old('type') == 'radio' ? 'selected' : '' }}>Radio</option>
                <option value="checkbox" {{ old('type') == 'checkbox' ? 'selected' : '' }}>Checkbox</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection
