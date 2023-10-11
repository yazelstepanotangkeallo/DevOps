<!DOCTYPE html>
<html>
<head>
	<title>Data Mahasiswa</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
	$(document).ready(function() {
		// Event handler for the "Insert New Data" button
		$("#insertButton").click(function() {
			var regNumber = prompt("Enter Registration Number:");
			var fullName = prompt("Enter Full Name:");
			var nimNumber = prompt("Enter NIM Number:");
			var email = prompt("Enter Email:");

			if (regNumber && fullName && nimNumber && email) {
				$.ajax({
					type: "POST",
					url: "viewstudents.php",
					data: {
						action: "insert",
						reg_number: regNumber,
						fullname: fullName,
						nim_number: nimNumber,
						email: email
					},
					success: function(response) {
						location.reload(); // Refresh the page to see the updated data
					}
				});
			}
		});
	});
	</script>
</head>
<body>
	<div class="container">
		<h1>Data Mahasiswa</h1>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th class="text-center">Registration Number</th>
					<th class="text-center">NIM Number</th>
					<th class="text-center">Email</th>
					<th class="text-center">Full Name</th>
					<th class="text-center">Created At</th>
					<th class="text-center">Updated At</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$conn = mysqli_connect('localhost', 'root', '12345', 'db_unklab');

				if (!$conn) {
					die("Koneksi gagal: " . mysqli_connect_error());
				}

				// Handle data insertion
				if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "insert") {
					$regNumber = $_POST['reg_number'];
					$fullName = $_POST['fullname'];
					$nimNumber = $_POST['nim_number'];
					$email = $_POST['email'];

					$insertSql = "INSERT INTO tbl_students (reg_number, fullname, nim_number, email, created_at, updated_at) 
					              VALUES ('$regNumber', '$fullName', '$nimNumber', '$email', NOW(), NOW())";

					if (mysqli_query($conn, $insertSql)) {
						echo "Data berhasil diinsert!";
					} else {
						echo "Error: " . $insertSql . "<br>" . mysqli_error($conn);
					}
				}

				$sql = "SELECT * FROM tbl_students";
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo "<td>" . $row['reg_number'] . "</td>";
						echo "<td>" . $row['nim_number'] . "</td>";
						echo "<td>" . $row['email'] . "</td>";
						echo "<td>" . $row['fullname'] . "</td>";
						echo "<td>" . $row['created_at'] . "</td>";
						echo "<td>" . $row['updated_at'] . "</td>";
						echo "</tr>";
					}
				} else {
					echo "<tr><td colspan='6'>Tidak ada data mahasiswa.</td></tr>";
				}

				mysqli_close($conn);
				?>
			</tbody>
		</table>
		<button id="insertButton" class="btn btn-primary">Insert New Data</button>
	</div>
</body>
</html>
