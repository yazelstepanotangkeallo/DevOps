<!DOCTYPE html>
<html>
<head>
	<title>Data classes</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
	<div class="container">
		<h1>Data classes</h1>
		<button id="insertButton" class="btn btn-primary">Insert New Data</button>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th class="text-center">id_class</th>
					<th class="text-center">email_lecturer</th>
					<!-- ... (kolom lainnya) ... -->
					<th class="text-center">status_class</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					$id_class = $_POST["id_class"];
					$email_lecturer = $_POST["email_lecturer"];
					// Ambil data lainnya sesuai dengan form

					$conn = mysqli_connect('localhost', 'root', '12345', 'db_unklab');
					if (!$conn) {
						die("Koneksi gagal: " . mysqli_connect_error());
					}

					$id_class = mysqli_real_escape_string($conn, $id_class);
					$email_lecturer = mysqli_real_escape_string($conn, $email_lecturer);
					// Sanitasi data lainnya sesuai dengan form

					$sql = "INSERT INTO tbl_classes (id_class, email_lecturer, ...) VALUES ('$id_class', '$email_lecturer', ...)";
					if (mysqli_query($conn, $sql)) {
						echo "Data berhasil ditambahkan!";
					} else {
						echo "Error: " . mysqli_error($conn);
					}

					mysqli_close($conn);
				} else {
					$conn = mysqli_connect('localhost', 'root', '12345', 'db_unklab');
					if (!$conn) {
						die("Koneksi gagal: " . mysqli_connect_error());
					}

					$sql = "SELECT * FROM tbl_classes";
					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) > 0) {
						while ($row = mysqli_fetch_assoc($result)) {
							echo "<tr>";
							echo "<td>" . $row['id_class'] . "</td>";
							echo "<td>" . $row['email_lecturer'] . "</td>";
							echo "<td>" . $row['status_class'] . "</td>";
							echo "</tr>";
						}
					} else {
						echo "<tr><td colspan='6'>Tidak ada data classes</td></tr>";
					}

					mysqli_close($conn);
				}
				?>
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="insertFormModal" tabindex="-1" aria-labelledby="insertFormModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="insertFormModalLabel">Insert New Data</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="insertForm" method="post">
					<div class="modal-body">
						<!-- Isi form insert di sini -->
						<!-- Contoh: <input type="text" name="id_class" id="id_class"> -->
						<!-- ... (input lainnya) ... -->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Insert Data</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
	$(document).ready(function() {
		$("#insertButton").click(function() {
			$("#insertFormModal").modal("show");
		});

		$("#insertForm").submit(function(e) {
			e.preventDefault();
			insertData();
		});

		function insertData() {
			$.ajax({
				url: "viewclasses.php",
				type: "POST",
				data: $("#insertForm").serialize(),
				success: function(response) {
					alert(response);
					$("#insertFormModal").modal("hide");
					location.reload();
				},
				error: function(xhr, status, error) {
					alert("Error: " + error);
				}
			});
		}
	});
	</script>
</body>
</html>
