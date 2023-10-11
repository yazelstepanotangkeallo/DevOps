<!DOCTYPE html>
<html>
<head>
	<title>Data Attendance</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
	<div class="container">
		<h1>Data Attendance</h1>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th class="text-center">id_attendance</th>
					<th class="text-center">title_short</th>
					<th class="text-center">date_attendance</th>
					<th class="text-center">time_attendance</th>
					<th class="text-center">id_class</th>
					<th class="text-center">name_subject</th>
					<th class="text-center">email_lecturer</th>
					<th class="text-center">room_latitude</th>
					<th class="text-center">room_longitude</th>
					<th class="text-center">max_radius</th>
					<th class="text-center">created at</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$conn = mysqli_connect('localhost', 'root', '12345', 'db_unklab');

				if (!$conn) {
					die("Koneksi gagal: " . mysqli_connect_error());
				}

				if ($_SERVER['REQUEST_METHOD'] === 'POST') {
					// Menyimpan data baru jika ada permintaan POST
					$id_class = $_POST['id_class'];
					$id_attendance = $_POST['id_attendance'];
					$email_student = $_POST['email_student'];
					$name_subject = $_POST['name_subject'];
					$email_lecturer = $_POST['email_lecturer'];
					$student_lat = $_POST['student_lat'];
					$student_long = $_POST['student_long'];
					$distance = $_POST['distance'];
					$time_take_attendance = $_POST['time_take_attendance'];
					$status = $_POST['status'];
					$note = $_POST['note'];
					$created_at = $_POST['created_at'];

					$sql = "INSERT INTO tbl_attendance_list (id_class, id_attendance, email_student, name_subject, email_lecturer, student_lat, student_long, distance, time_take_attendance, status, note, created_at) VALUES ('$id_class', '$id_attendance', '$email_student', '$name_subject', '$email_lecturer', '$student_lat', '$student_long', '$distance', '$time_take_attendance', '$status', '$note', '$created_at')";

					if (mysqli_query($conn, $sql)) {
						echo "Data berhasil disimpan.";
					} else {
						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}
				}

				// Menampilkan data dari database
				$sql = "SELECT * FROM tbl_attendance_list";
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo "<td>" . $row['id_attendance'] . "</td>";
						echo "<td>" . $row['title_short'] . "</td>";
						echo "<td>" . $row['date_attendance'] . "</td>";
						echo "<td>" . $row['time_attendance'] . "</td>";
						echo "<td>" . $row['id_class'] . "</td>";
						echo "<td>" . $row['name_subject'] . "</td>";
						echo "<td>" . $row['email_lecturer'] . "</td>";
						echo "<td>" . $row['name_lecturer'] . "</td>";
						echo "<td>" . $row['room_latitude'] . "</td>";
						echo "<td>" . $row['room_longitude'] . "</td>";
						echo "<td>" . $row['max_radius'] . "</td>";
						echo "<td>" . $row['created_at'] . "</td>";

						echo "</tr>";
					}
				} else {
					echo "<tr><td colspan='6'>Tidak ada data Attendance.</td></tr>";
				}

				mysqli_close($conn);
				?>
			</tbody>
		</table>

		<!-- Tombol "Insert New Data" dengan jQuery -->
		<button id="insertDataButton" class="btn btn-primary">Insert New Data</button>

		<!-- Form untuk memasukkan data baru (awalnya tersembunyi) -->
		<div id="newDataFormContainer" style="display: none;">
			<h2>Insert New Data</h2>
			<form method="POST">
				<input type="text" name="id_class" placeholder="ID Class"><br>
				<input type="text" name="id_attendance" placeholder="ID Attendance"><br>
				<input type="text" name="email_student" placeholder="Email Student"><br>
				<input type="text" name="name_subject" placeholder="Name Subject"><br>
				<input type="text" name="email_lecturer" placeholder="Email Lecturer"><br>
				<input type="text" name="student_lat" placeholder="Student Latitude"><br>
				<input type="text" name="student_long" placeholder="Student Longitude"><br>
				<input type="text" name="distance" placeholder="Distance"><br>
				<input type="text" name="time_take_attendance" placeholder="Time Take Attendance"><br>
				<input type="text" name="status" placeholder="Status"><br>
				<input type="text" name="note" placeholder="Note"><br>
				<input type="text" name="created_at" placeholder="Created At"><br>
				<input type="submit" value="Submit">
			</form>
		</div>

		<script>
			// Menangani klik tombol "Insert New Data" dengan jQuery
			$("#insertDataButton").click(function() {
				// Tampilkan atau sembunyikan formulir
				$("#newDataFormContainer").toggle();
			});
		</script>
	</div>
</body>
</html>
