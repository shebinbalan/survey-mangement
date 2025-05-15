<!DOCTYPE html>
<html>
<head>
    <title>Survey Response</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Survey Response Report</h2>
    <p><strong>User:</strong> {{ $response->user->name }}</p>
    <p><strong>Survey:</strong> {{ $response->survey->title }}</p>
    <p><strong>Date:</strong> {{ $response->created_at->format('Y-m-d H:i:s') }}</p>

    <h4>Answers:</h4>
    <table>
        <thead>
            <tr>
                <th>Question</th>
                <th>Answer</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($response->answers as $answer)
                <tr>
                    <td>{{ $answer->question->text }}</td>
                    <td>{{ $answer->text }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
