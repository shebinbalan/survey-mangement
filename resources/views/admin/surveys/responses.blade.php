@extends('layouts.admin.app')

@section('content')

<style>
    h2 {
        font-size: 2rem;
        border-bottom: 2px solid #dee2e6;
        padding-bottom: 10px;
    }

    .list-group-item {
        transition: background 0.3s ease;
    }

    .list-group-item:hover {
        background-color: #f8f9fa;
    }

    .shadow-sm {
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08) !important;
    }
</style>
<div class="container py-5">
    <div class="mb-4 text-center">
        <h2 class="fw-bold text-dark">{{ $survey->title }}</h2>
        <p class="text-muted">Total Responses: <span class="badge bg-success">{{ $survey->responses->count() }}</span></p>
    </div>

    <hr class="mb-5">

    @foreach ($summary as $item)
        <div class="mb-5">
            <h5 class="fw-semibold text-primary mb-3">{{ $item['question'] }}</h5>

            @if ($item['type'] === 'text')
                <div class="row row-cols-1 row-cols-md-2 g-3">
                    @foreach ($item['answers'] as $textAnswer)
                        <div class="col">
                            <div class="p-3 border rounded shadow-sm bg-light">
                                <i class="fas fa-comment-dots text-info me-2"></i> {{ $textAnswer }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <ul class="list-group list-group-flush">
                    @foreach ($item['answers'] as $option => $count)
                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-sm mb-2 rounded">
                            <span><i class="fas fa-circle text-secondary me-2"></i>{{ $option }}</span>
                            <span class="badge rounded-pill bg-primary fs-6">{{ $count }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endforeach
</div>
@endsection
