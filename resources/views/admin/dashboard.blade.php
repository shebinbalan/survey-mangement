@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">{{ $survey->title ?? 'Dashboard' }}</h2>

    <div class="row">
        <!-- Summary Boxes -->
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5>Total Responses</h5>
                    <p class="card-text">{{ $totalResponses }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5>Total Answers</h5>
                    <p class="card-text">{{ $totalAnswers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5>Pending</h5>
                    <p class="card-text">{{ $pendingResponses }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5>Cancelled</h5>
                    <p class="card-text">{{ $cancelledResponses }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    @foreach ($chartData as $questionText => $data)
        <div class="mb-5">
            <h5>{{ $questionText }}</h5>

            <canvas id="barChart{{ $loop->index }}" height="100"></canvas>
            <canvas id="pieChart{{ $loop->index }}" height="100"></canvas>
        </div>
    @endforeach
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        @foreach ($chartData as $questionText => $data)
            const labels{{ $loop->index }} = {!! json_encode(array_keys($data)) !!};
            const values{{ $loop->index }} = {!! json_encode(array_values($data)) !!};

            new Chart(document.getElementById("barChart{{ $loop->index }}"), {
                type: 'bar',
                data: {
                    labels: labels{{ $loop->index }},
                    datasets: [{
                        label: 'Responses',
                        data: values{{ $loop->index }},
                        backgroundColor: '#007bff'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: { display: true, text: 'Bar Chart' }
                    },
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });

            new Chart(document.getElementById("pieChart{{ $loop->index }}"), {
                type: 'pie',
                data: {
                    labels: labels{{ $loop->index }},
                    datasets: [{
                        data: values{{ $loop->index }},
                        backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: { display: true, text: 'Pie Chart' }
                    }
                }
            });
        @endforeach
    });
</script>
@endpush
