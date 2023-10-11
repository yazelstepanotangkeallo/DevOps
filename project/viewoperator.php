<!DOCTYPE html>
<html>
<head>
	<title>Data Operator</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
	<div class="container">
		<h1>Data Operator</h1>
		<button id="insertButton" class="btn btn-primary">Insert New Data</button>
		<div id="insertFormContainer"></div>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th class="text-center">nip</th>
					<th class="text-center">email</th>
					<th class="text-center">fullname</th>
					<th class="text-center">password</th>
					<th class="text-center">phone_number</th>
					<th class="text-center">role</th>
					<th class="text-center">created_at</th>
					<th class="text-center">updated_at</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$conn = mysqli_connect ('localhost', 'root', '12345', 'db_unklab');

			if (!$conn) {
				die ("Koneksi gagal: " . mysqli_connect_error());
			}

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			    $nip = $_POST['nip'];
			    $email = $_POST['email'];
			    $fullname = $_POST['fullname'];
			    $password = $_POST['password'];
			    $phone_number = $_POST['phone_number'];
			    $role = $_POST['role'];

			    $sql = "INSERT INTO tbl_operator (nip, email, fullname, password, phone_number, role)
			            VALUES ('$nip', '$email', '$fullname', '$password', '$phone_number', '$role')";

			    if (mysqli_query($conn, $sql)) {
			        echo "Data berhasil ditambahkan.";
			    } else {
			        echo "Error: " . mysqli_error($conn);
			    }
			}

			$sql = "SELECT * FROM tbl_operator";
			$result = mysqli_query ($conn, $sql);

			if (mysqli_num_rows($result) > 0){
				while ($row = mysqli_fetch_assoc($result)){
					echo "<tr>";
					echo "<td>" . $row['nip'] . "</td>";
					echo "<td>" . $row['email'] . "</td>";
					echo "<td>" . $row['fullname'] . "</td>";
					echo "<td>" . $row['password'] . "</td>";
					echo "<td>" . $row['phone_number'] . "</td>";
					echo "<td>" . $row['role'] . "</td>";
					echo "<td>" . $row['created_at'] . "</td>";
					echo "<td>" . $row['updated_at'] . "</td>";
					echo "</tr>";
				}
			} else {
				echo "<tr><td colspan='6'>Tidak ada data operator.</td></tr>";
			}

			mysqli_close($conn);
			?>
			</tbody>
		</table>
	</div>

	<script>
	$(document).ready(function() {
		$("#insertButton").click(function() {
			var form = `
				<form id="insertForm" method="post">
					<input type="text" name="nip" placeholder="NIP" required><br>
					<input type="email" name="email" placeholder="Email" required><br>
					<input type="text" name="fullname" placeholder="Full Name" required><br>
					<input type="password" name="password" placeholder="Password" required><br>
					<input type="text" name="phone_number" placeholder="Phone Number" required><br>
					<input type="text" name="role" placeholder="Role" required><br>
					<button type="submit" class="btn btn-success">Submit</button>
				</form>
			`;
			$("#insertFormContainer").html(form);
		});
	});
	</script>
</body>
</html>
