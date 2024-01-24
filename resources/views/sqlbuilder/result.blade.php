<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Query Result</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Generated SQL Query</h1>
    <p><strong>Query:</strong> {{ $query }}</p>
    <p>Table: {{ $table }}</p>
    <p>Fields: {{ is_array($fields) ? implode(', ', $fields) : $fields }}</p>
    <p>SQL Query: {{ $query }}</p>

    <p><strong>Where Conditions:</strong>
        @if(!empty($whereConditions))
            @foreach($whereConditions as $condition)
                {{ $condition['field'] }} {{ $condition['operator'] }} {{ $condition['value'] }};
            @endforeach
        @else
            No where conditions.
        @endif
    </p>
    <p><strong>Limit Start:</strong> {{ $limitStart }}</p>
    <p><strong>Limit Offset:</strong> {{ $limitOffset }}</p>
    <a href="{{ url('/sqlbuilder') }}" class="btn btn-primary">Back to Builder</a>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
