@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h3>Reorder Questions for: {{ $survey->title }}</h3>

    <ul id="sortable" class="list-group">
        @foreach($survey->questions->sortBy('order') as $question)
            <li class="list-group-item" data-id="{{ $question->id }}">
                {{ $question->question_text }}
            </li>
        @endforeach
    </ul>

    <button id="saveOrder" class="btn btn-success mt-3">Save Order</button>
    <a href="{{ route('admin.surveys.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
    $(function () {
        $("#sortable").sortable();
        $("#sortable").disableSelection();

        $('#saveOrder').click(function () {
            let order = [];
            $('#sortable li').each(function () {
                order.push($(this).data('id'));
            });

            $.ajax({
                url: '{{ route("admin.surveys.reorderQuestions", $survey->id) }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    order: order
                },
                success: function (res) {
                    alert('Question order updated!');
                }
            });
        });
    });
</script>
@endsection
