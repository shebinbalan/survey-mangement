@extends('layouts.userapp')

@section('content')
<div class="container py-5">
    <h3 class="text-center mb-5 font-weight-bold text-dark">Available Surveys</h3>
    <div class="row justify-content-center">
        @foreach($surveys as $survey)
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg border-0 rounded-lg hover-shadow">
                    <div class="card-body p-4">
                        <h5 class="card-title text-dark font-weight-bold">{{ $survey->title }}</h5>
                        <p class="card-text text-muted mb-4" style="line-height: 1.6;">Take this quick survey to share your thoughts and feedback. Your input is valuable to us!</p>
                      <a href="{{ route('user.surveys.question', ['id' => $survey->id, 'index' => 0]) }}"
   class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm transition-effect">
   Take Survey
</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
