<?php 

// --------------------------------------------SESSION-----------------------------------------------
	session_start();
	if(isset($_SESSION['name']) && $_SESSION['position'] == "1") {
	} else {
		header("location: http://localhost/book_store_web/admin/index.php");
	}

// ---------------------------------------------------------------------------------------------------

	// connect db
	$db = mysqli_connect("localhost", "root", "", "LTWeb");

// -----------------------------------------------GET DATA-------------------------------------------
	// Lấy dữ liệu user từ db theo id
	$id = $_GET["id"];

	$sql = "SELECT * FROM speakers WHERE id = '".$id."'";

	$rs = mysqli_query($db, $sql);

	// chuyển dữ liệu query được thành mảng key => values
	$speaker = $rs->fetch_assoc();

	if(array_key_exists('button', $_POST)) {
		$sqlUpdate = "UPDATE speakers SET isChecked = 1 WHERE id='".$id."'";

		if(mysqli_query($db, $sqlUpdate)) {
			header("location: http://localhost/book_store_web/admin/Staff/showSpeaker.php");
		} else {
			echo "Cap nhat that bai!";
		}
	}
	

// ----------------------------------------------END GET DATA-----------------------------------------

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<title>Chi tiết</title>

	<style type="text/css">
		
		form {
			border: 1px solid #888;
			padding: 40px;
			margin-bottom: 20px;
		}

	</style>

</head>
<body>
	<div class="container-fluid" style="background-color: black;">
		<?php include "staff_common.html" ?>

		<div class="col-sm-10" style="background-color: #eee">

			<h3 class="text-center mt-3 mb-3">Thông tin chi tiết người đăng ký</h3>
			<hr>
			<div class="row mb-5">
				<div class="col-sm-4">
					<img src="<?php echo $speaker["avatar"] ?>" alt="avatar" width="400px" height="400px">
				</div>
				<div class="col-sm-8 pl-5">

					<h1 style="color: #005a8d;"><?php echo $speaker["name"] ?></h1>

					<div class="speaker-dob row">
						<div class="col-sm-4">
							<h4><strong>Ngày sinh:</strong></h4>
						</div>
						<div class="col-sm-4">
							<span><b><?php echo $speaker["dob"] ?></b></span>	
						</div>						
					</div>

					<div class="speaker-nationality row">
						<div class="col-sm-4">
							<h4><strong>Quốc tịch:</strong></h4>
						</div>
						<div class="col-sm-4">
							<span><b><?php echo $speaker["nationality"] ?></b></span>	
						</div>						
					</div>

					<div class="speaker-phone row">
						<div class="col-sm-4">
							<h4><strong>Số điện thoại:</strong></h4>
						</div>
						<div class="col-sm-4">
							<span><b><?php echo $speaker["phone"] ?></b></span>	
						</div>						
					</div>

					<div class="speaker-email row">
						<div class="col-sm-4">
							<h4><strong>Email:</strong></h4>
						</div>
						<div class="col-sm-4">
							<span><b><?php echo $speaker["email"] ?></b></span>	
						</div>						
					</div>

					<div class="speaker-theme row">
						<div class="col-sm-4">
							<h4><strong>Chủ đề đăng ký:</strong></h4>
						</div>
						<div class="col-sm-4">
							<span><b><?php echo $speaker["theme"] ?></b></span>	
						</div>						
					</div>

					<div class="speaker-description row">
						<div class="col-sm-4">
							<h4><strong>Mô tả thêm:</strong></h4>
							<span> &nbsp; &nbsp; <?php echo $speaker["description"] ?> </span>	
						</div>						
					</div>

					<form method="POST" style="border: 0; padding: 0;">
						<input type="submit" id="btn<?= $speaker["id"] ?>" class="btn btn-outline-info m-4" name="button" value="Đã liên lạc"/>
					</form>
				</div>
			</div>

		</div>
	</div>
	
	<script type="text/javascript">
		if(<?php echo $speaker["isChecked"] ?> == 1) {
			document.getElementById("btn<?= $speaker["id"] ?>").style.display = "none";
		}
	</script>

</body>
</html>
