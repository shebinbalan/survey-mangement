<ul id="questions-list">
    @foreach ($survey->questions as $question)
        <li data-id="{{ $question->id }}">
            {{ $question->question_text }}
        </li>
    @endforeach
</ul>

<button id="saveOrder" class="btn btn-primary">Save Order</button>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    var el = document.getElementById('questions-list');
    var sortable = new Sortable(el, {
        onEnd: function (evt) {
            var order = [];
            el.querySelectorAll('li').forEach(function (item) {
                order.push(item.getAttribute('data-id'));
            });

            // Send the new order to the server via AJAX
            fetch("{{ route('admin.surveys.reorderQuestions', $survey->id) }}", {
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

    document.getElementById('saveOrder').addEventListener('click', function() {
        var order = [];
        el.querySelectorAll('li').forEach(function (item) {
            order.push(item.getAttribute('data-id'));
        });

        // Send the order via AJAX
        fetch("{{ route('admin.surveys.reorderQuestions', $survey->id) }}", {
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