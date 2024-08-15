<!DOCTYPE html>
<html>
<head>
    <title>Employee Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Employee Form</h1>
        <form id="employeeForm" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" class="form-control" id="age" name="age" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="salary">Salary</label>
                <input type="number" step="0.01" class="form-control" id="salary" name="salary" required>
            </div>
            <div class="form-group">
                <label for="designation">Designation</label>
                <input type="text" class="form-control" id="designation" name="designation" required>
            </div>
            <div class="form-group">
                <label for="job_location">Job Location</label>
                <input type="text" class="form-control" id="job_location" name="job_location" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <h2>Upload Excel File</h2>
        <form id="importForm" method="POST" enctype="multipart/form-data">
            <input type="file" name="file" required>
            <button type="submit" class="btn btn-primary">Import</button>
        </form>

        <h2>Employee Table</h2>
        <div id="employeeTable">
            <?php $this->load->view('employee_table', ['employees' => $employees]); ?>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#employeeForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: '<?= site_url('employee/submit') ?>',
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.html) {
                            $('#employeeTable').html(response.html);
                            $('#employeeForm')[0].reset(); // Reset form fields
                        }
                    },
                    error: function() {
                        alert('An error occurred while submitting the form.');
                    }
                });
            });

            $('#importForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: '<?= site_url('employee/import') ?>',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.html) {
                            $('#employeeTable').html(response.html);
                        } else if (response.error) {
                            alert(response.error);
                        }
                    },
                    error: function() {
                        alert('An error occurred while importing the file.');
                    }
                });
            });
        });
    </script>
</body>
</html>
