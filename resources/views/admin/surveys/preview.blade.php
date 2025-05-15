@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Survey Preview: {{ $survey->title }}</h3>

    @if($survey->description)
        <p><strong>Description:</strong> {{ $survey->description }}</p>
    @endif

    <form>
        @foreach($survey->questions as $index => $question)
            <div class="mb-4">
                <label class="fw-bold">
                    {{ $index + 1 }}. {{ $question->question_text }}
                </label>

                @if($question->type == 'text')
                    <input type="text" class="form-control" placeholder="Your answer..." disabled>
                
                @elseif($question->type == 'radio')
                    @foreach($question->options as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question_{{ $question->id }}" disabled>
                            <label class="form-check-label">{{ $option->option_text }}</label>
                        </div>
                    @endforeach

                @elseif($question->type == 'checkbox')
                    @foreach($question->options as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="question_{{ $question->id }}[]" disabled>
                            <label class="form-check-label">{{ $option->option_text }}</label>
                        </div>
                    @endforeach
                @endif
            </div>
        @endforeach
    </form>

    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('admin.surveys.index') }}" class="btn btn-secondary">Back to Surveys</a>
        <a href="{{ route('admin.surveys.edit', $survey->id) }}" class="btn btn-warning">Edit Survey</a>
    </div>
</div>
@endsection
