<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Query Result</title>
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
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#resultModal">
        View Result in Modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultModalLabel">Generated SQL Query Result</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Query:</strong> {{ $query }}</p>
                    <!-- Add other details as needed -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
