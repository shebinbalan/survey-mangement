@extends('layouts.userapp')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>{{ $survey->title }}</h4>
        </div>

        <div class="progress mb-3">
            <div class="progress-bar" style="width: {{ $progress }}%;" role="progressbar">
                {{ $progress }}%
            </div>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('user.surveys.answer', [$survey->id, $currentQuestion->id]) }}">
                @csrf
                <div class="mb-4">
                    <label class="form-label"><strong>{{ $currentQuestion->question_text }}</strong></label>

                    @if($currentQuestion->type == 'text')
                        <input type="text" name="answer" class="form-control" required>
                    @elseif($currentQuestion->type == 'radio')
                        @foreach($currentQuestion->options as $option)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer" value="{{ $option->option_text }}" required>
                                <label class="form-check-label">{{ $option->option_text }}</label>
                            </div>
                        @endforeach
                    @elseif($currentQuestion->type == 'checkbox')
                        @foreach($currentQuestion->options as $option)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="answer[]" value="{{ $option->option_text }}">
                                <label class="form-check-label">{{ $option->option_text }}</label>
                            </div>
                        @endforeach
                    @endif
                </div>

                <button type="submit" class="btn btn-success">Next</button>
            </form>
        </div>
    </div>
</div>
@endsection