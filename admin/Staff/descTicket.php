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

	$sql = "SELECT * FROM tickets WHERE id = '".$id."'";

	$rs = mysqli_query($db, $sql);

	// chuyển dữ liệu query được thành mảng key => values
	$ticket = $rs->fetch_assoc();

	if(array_key_exists('button', $_POST)) {
		$sqlUpdate = "UPDATE tickets SET isChecked = 1 WHERE id='".$id."'";

		if(mysqli_query($db, $sqlUpdate)) {
			header("location: http://localhost/book_store_web/admin/Staff/showTicket.php");
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

			<h3 class="text-center mt-3 mb-3">Thông tin chi tiết đăng ký mua vé</h3>
			<hr>
			<div class="row mb-5">
				
				<div class="col-sm-8 pl-5">

					<h1 class="mb-5 mt-5" style="color: #005a8d;"><?php echo $ticket["name"] ?></h1>

					<div class="speaker-dob row mt-2 mb-2">
						<div class="col-sm-4">
							<h4><strong>Địa chỉ:</strong></h4>
						</div>
						<div class="col-sm-4">
							<span><b><?php echo $ticket["address"] ?></b></span>	
						</div>						
					</div>

					<div class="speaker-nationality row mt-2 mb-2">
						<div class="col-sm-4">
							<h4><strong>Điện thoại:</strong></h4>
						</div>
						<div class="col-sm-4">
							<span><b><?php echo $ticket["tel"] ?></b></span>	
						</div>						
					</div>

					<div class="speaker-phone row mt-2 mb-2">
						<div class="col-sm-4">
							<h4><strong>Email:</strong></h4>
						</div>
						<div class="col-sm-4">
							<span><b><?php echo $ticket["email"] ?></b></span>	
						</div>						
					</div>

					<div class="speaker-email row mt-2 mb-2">
						<div class="col-sm-4">
							<h4><strong>Loại vé:</strong></h4>
						</div>
						<div class="col-sm-4">
							<span><b><?php echo $ticket["type"] ?></b></span>	
						</div>						
					</div>

					<div class="speaker-theme row mt-2 mb-2">
						<div class="col-sm-4">
							<h4><strong>Ghi chú:</strong></h4>
						</div>
						<div class="col-sm-4">
							<span><b><?php echo $ticket["note"] ?></b></span>	
						</div>						
					</div>

					<form method="POST" style="border: 0; padding: 0;">
						<input type="submit" id="btn<?= $ticket["id"] ?>" class="btn btn-outline-info m-4" name="button" value="Đã checkin"/>
					</form>
				</div>
			</div>

				
		</div>	
	</div>
	

</body>
</html>
