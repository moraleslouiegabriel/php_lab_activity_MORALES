<?php include 'dbcon.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Pure PHP MySQL App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>

    <div class='container py-5'>
        <h1 style="text-align: center;">User Management System</h1>
    </div>

    <div class="row g-4">
        <div class="card shadow-sm border-0 rounded-3 mx-5" style="max-width: 600px;">
            <div class="card-body p-3">
                <h4 class="card-title mb-4">Add New User</h4>
                <form method="post">
                    <div class="mb-3">
                        <p>Full Name</p>
                        <input type="text" name="name" class="form-control" placeholder="Enter Full Name" required>
                    </div>
                    <div class="mb-3">
                        <p>Email Address</p>
                        <input type="email" name="email" class="form-control" placeholder="Enter Email Address" required>
                    </div>
                    <button type="submit" name="submitbtn" class="btn btn-primary w-100">Submit</button>
                </form>
            </div>
        </div>

        <div class="card shadow-sm border-0 rounded-3 mx-5" style="max-width: 1100px;">
            <div class="card-body p-3">
                <h4 class="card-title mb-4">Registered Users</h4>
                <table class="table align-middle">
                    <thead>
                        <tr class="text-muted small border-bottom">
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Joined</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = $conn->query("SELECT * FROM users");

                            if ($query->num_rows > 0) {
                                while ($row = $query->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>".$row['id']."</td>";
                                    echo "<td>".$row['name']."</td>";
                                    echo "<td>".$row['email']."</td>";
                                    echo "<td>".date('Y-m-d', strtotime($row['created_at']))."</td>";
                                    echo "<td>
                                        <a href='edit.php?id=".$row['id']."' class='btn btn-success btn-sm'>Edit</a>
                                        <a href='delete.php?id=".$row['id']."' class='btn btn-sm btn-danger');'>Delete</a>
                                    </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>No data found</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

 	<?php
 		if (isset($_POST['submitbtn'])) {
 			$fname = $_POST['fname'];
 			$email = $_POST['email'];

 			$query = $conn->query("INSERT INTO users (name, email)VALUES('$fname', '$email')");

 			if ($query) {
 				echo "<script>
 								alert('Successfully Added');
 								window.location.href = 'index.php';
 							</script>";
 			}else{
 				echo "<script>
 								alert('Error!');
 								window.location.href = 'index.php';
 							</script>";
 			}
 		}
 	?>

</body>
</html>