<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Salary</th>
            <th>Designation</th>
            <th>Job Location</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($employees as $employee): ?>
        <tr>
            <td><?= $employee['name'] ?></td>
            <td><?= $employee['email'] ?></td>
            <td><?= $employee['age'] ?></td>
            <td><?= $employee['phone'] ?></td>
            <td><?= $employee['gender'] ?></td>
            <td><?= $employee['salary'] ?></td>
            <td><?= $employee['designation'] ?></td>
            <td><?= $employee['job_location'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
