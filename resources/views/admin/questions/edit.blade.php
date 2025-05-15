@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h3>Edit Question</h3>
<ul id="options-list">
    @foreach ($question->options as $option)
        <li data-id="{{ $option->id }}">
            {{ $option->option_text }}
        </li>
    @endforeach
</ul>

<button id="saveOptionOrder" class="btn btn-primary">Save Order</button>
    <form action="{{ route('admin.questions.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Survey</label>
            <select name="survey_id" class="form-control" required>
                <option value="">Select Survey</option>
                @foreach($surveys as $survey)
                    <option value="{{ $survey->id }}"
                        {{ old('survey_id', $question->survey_id) == $survey->id ? 'selected' : '' }}>
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
            <input type="text" name="question_text" class="form-control"
                value="{{ old('question_text', $question->question_text) }}" required>
        </div>

        <div class="mb-3">
            <label>Answer Type</label>
            <select name="type" class="form-control" required>
                <option value="text" {{ $question->type == 'text' ? 'selected' : '' }}>Text</option>
                <option value="radio" {{ $question->type == 'radio' ? 'selected' : '' }}>Radio</option>
                <option value="checkbox" {{ $question->type == 'checkbox' ? 'selected' : '' }}>Checkbox</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Question</button>
    </form>
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var el = document.getElementById('options-list');
    var sortable = new Sortable(el, {
        onEnd: function (evt) {
            var order = [];
            el.querySelectorAll('li').forEach(function (item) {
                order.push(item.getAttribute('data-id'));
            });

            // Send the new order to the server via AJAX
            fetch("{{ route('admin.options.reorderOptions', $question->id) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ order: order }),
            }).then(response => response.json())
              .then(data => alert(data.message));
        }
    });

    document.getElementById('saveOptionOrder').addEventListener('click', function() {
        var order = [];
        el.querySelectorAll('li').forEach(function (item) {
            order.push(item.getAttribute('data-id'));
        });

        // Send the order via AJAX
        fetch("{{ route('admin.options.reorderOptions', $question->id) }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ order: order }),
        }).then(response => response.json())
          .then(data => alert(data.message));
    });
});

</script>