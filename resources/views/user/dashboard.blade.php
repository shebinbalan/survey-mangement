@extends('layouts.userapp')

@section('content')
<div class="container mt-4">
    <div class="row text-center">
        <div class="col-md-4">
            <div class="card border-success shadow">
                <div class="card-body">
                    <h5>Total Available Surveys</h5>
                    <h2 class="text-success">{{ $totalSurveys }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-primary shadow">
                <div class="card-body">
                    <h5>My Responses</h5>
                    <h2 class="text-primary">{{ $responseCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <a href="{{ route('user.surveys.index') }}" class="btn btn-outline-dark mt-4">View Available Surveys</a>
        </div>
    </div>

    <div class="mt-5">
        <h4>Recently Completed Surveys</h4>
        <ul class="list-group">
            @forelse ($responses as $response)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $response->survey->title }}
                    <span class="badge bg-secondary">{{ $response->created_at->format('d M Y, h:i A') }}</span>
                </li>
            @empty
                <li class="list-group-item">No responses yet.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
