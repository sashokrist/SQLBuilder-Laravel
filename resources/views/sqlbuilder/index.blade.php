<!-- resources/views/sqlbuilder/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Builder</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>SQL Builder</h1>
    <form method="POST" action="{{ url('/sqlbuilder/build') }}">
        @csrf
        <div class="form-group">
            <label for="table">Table Name:</label>
            <input type="text" name="table" id="table" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fields">Fields (comma-separated):</label>
            <input type="text" name="fields" id="fields" class="form-control" required>
        </div>
        <!-- Where Conditions -->
        <div class="form-group">
            <label>Where Condition 1:</label>
            <input type="text" name="where[field][]" class="form-control" placeholder="Field">
            <input type="text" name="where[value][]" class="form-control" placeholder="Value">
            <input type="text" name="where[operator][]" class="form-control" placeholder="Operator">
        </div>
        <div class="form-group">
            <label>Where Condition 2:</label>
            <input type="text" name="where[field][]" class="form-control" placeholder="Field">
            <input type="text" name="where[value][]" class="form-control" placeholder="Value">
            <input type="text" name="where[operator][]" class="form-control" placeholder="Operator">
        </div>
        <div class="form-group">
            <label for="limit_start">Limit Start:</label>
            <input type="number" name="limit_start" id="limit_start" class="form-control">
        </div>
        <div class="form-group">
            <label for="limit_offset">Limit Offset:</label>
            <input type="number" name="limit_offset" id="limit_offset" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Build Query</button>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
