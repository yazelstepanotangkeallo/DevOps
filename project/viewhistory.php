<!DOCTYPE html>
<html>
<head>
	<title>Data History</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
	<div class="container">
		<h1>Data History</h1>
		<button id="insertButton" class="btn btn-primary">Insert New Data</button>
		<div id="insertFormContainer"></div>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th class="text-center">id_class</th>
					<th class="text-center">id_attendance</th>
					<th class="text-center">email_student</th>
					<th class="text-center">name_subject</th>
					<th class="text-center">email_lecturer</th>
					<th class="text-center">student_lat</th>
					<th class="text-center">student_long</th>
					<th class="text-center">distance</th>
					<th class="text-center">time_take_attendance</th>
					<th class="text-center">status</th>
					<th class="text-center">note</th>
					<th class="text-center">created at</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$conn = mysqli_connect ('localhost', 'root', '12345', 'db_unklab');

			if (!$conn) {
				die ("Koneksi gagal: " . mysqli_connect_error());
			}

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			    // Handle insertion here
			    // ...
			}

			$sql = "SELECT * FROM tbl_attendance_history";
			$result = mysqli_query ($conn, $sql);

			if (mysqli_num_rows($result) > 0){
				while ($row = mysqli_fetch_assoc($result)){
					echo "<tr>";
					echo "<td>" . $row['id_class'] . "</td>";
					echo "<td>" . $row['id_attendance'] . "</td>";
					echo "<td>" . $row['email_student'] . "</td>";
					echo "<td>" . $row['name_subject'] . "</td>";
					echo "<td>" . $row['email_lecturer'] . "</td>";
					echo "<td>" . $row['student_lat'] . "</td>";
					echo "<td>" . $row['student_long'] . "</td>";
					echo "<td>" . $row['distance'] . "</td>";
					echo "<td>" . $row['time_take_attendance'] . "</td>";
					echo "<td>" . $row['status'] . "</td>";
					echo "<td>" . $row['note'] . "</td>";
					echo "<td>" . $row['created_at'] . "</td>";
					echo "</tr>";
				}
			} else{
				echo "<tr><td colspan='12'>Tidak ada data history.</td></tr>";
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
					<!-- Add input fields for insertion -->
					<input type="text" name="id_class" placeholder="ID Class" required><br>
					<input type="text" name="id_attendance" placeholder="ID Attendance" required><br>
					<input type="email" name="email_student" placeholder="Email Student" required><br>
					<input type="email" name="email_student" placeholder="Email Student" required><br>
					<button type="submit" class="btn btn-success">Submit</button>
				</form>
			`;
			$("#insertFormContainer").html(form);
		});

		$(document).on("submit", "#insertForm", function(event) {
			event.preventDefault();
			var formData = $(this).serialize();
			$.ajax({
				url: "insert_history.php", // Path to PHP script for insertion
				type: "POST",
				data: formData,
				success: function(response) {
					// Handle success or error response
					console.log(response);
				}
			});
		});
	});
	</script>
</body>
</html>
