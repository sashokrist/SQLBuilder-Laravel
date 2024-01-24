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
    <form id="sqlForm" method="POST" action="{{ url('/sqlbuilder/build') }}">
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
        <button type="button" class="btn btn-primary" onclick="submitForm()">Build Query</button>
    </form>

    <div class="modal" id="resultModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">SQL Query Result</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Query:</strong> <span id="modalQuery"></span></p>
                    <p><strong>Table:</strong> <span id="modalTable"></span></p>
                    <p><strong>Fields:</strong> <span id="modalFields"></span></p>

                    <p><strong>Where Conditions:</strong>
                        <span id="modalWhereConditions"></span>
                    </p>

                    <p><strong>Limit Start:</strong> <span id="modalLimitStart"></span></p>
                    <p><strong>Limit Offset:</strong> <span id="modalLimitOffset"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        function submitForm() {
            $.ajax({
                type: 'POST',
                url: '{{ url("/sqlbuilder/build") }}',
                data: $('#sqlForm').serialize(),
                success: function (response) {
                    $('#modalQuery').text(response.query);
                    $('#modalTable').text(response.table);
                    $('#modalFields').text(Array.isArray(response.fields) ? response.fields.join(', ') : response.fields);

                    if (response.whereConditions.length > 0) {
                        let whereConditionsHtml = '';
                        response.whereConditions.forEach(condition => {
                            whereConditionsHtml += condition.field + ' ' + condition.operator + ' ' + condition.value + ';<br>';
                        });
                        $('#modalWhereConditions').html(whereConditionsHtml);
                    } else {
                        $('#modalWhereConditions').text('No where conditions.');
                    }

                    $('#modalLimitStart').text(response.limitStart);
                    $('#modalLimitOffset').text(response.limitOffset);

                    $('#resultModal').modal('show');
                },
                error: function (error) {
                    console.error(error);
                }
            });
        }

        $(document).ready(function () {
            $('#resultModal').on('hidden.bs.modal', resetForm);
            function resetForm() {
                $('#sqlForm')[0].reset();
            }
        });
    </script>
</div>
</body>
</html>
