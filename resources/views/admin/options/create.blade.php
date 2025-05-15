@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h3>Add Options to a Question</h3>

    <form action="{{ route('admin.options.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Select Question</label>
            <select name="question_id" class="form-control" required>
                <option value="">Select Question</option>
                @foreach($questions as $question)
                    <option value="{{ $question->id }}">{{ $question->question_text }} (Survey: {{ $question->survey->title }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Option Texts</label>
            <div id="optionFields">
                <input type="text" name="options[]" class="form-control mb-2" placeholder="Enter option text" required>
            </div>
            <button type="button" id="addOption" class="btn btn-secondary btn-sm">Add More</button>
        </div>

        <button type="submit" class="btn btn-success">Save Options</button>
    </form>
</div>

<script>
    document.getElementById('addOption').addEventListener('click', function() {
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'options[]';
        input.className = 'form-control mb-2';
        input.placeholder = 'Enter option text';
        document.getElementById('optionFields').appendChild(input);
    });
</script>
@endsection
