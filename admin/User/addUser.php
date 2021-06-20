<?php 

// --------------------------------------------SESSION-----------------------------------------------
	session_start();
	if(isset($_SESSION['name']) && $_SESSION['position'] == "2") {
	} else {
		header("location: http://localhost/book_store_web/admin/index.php");
	}

// ---------------------------------------------------------------------------------------------------

	// connect db
	$db = mysqli_connect("localhost", "root", "", "LTWeb");

// ------------------------------------------------UPDATE DATA---------------------------------------- 

	$nameErr = $usernameErr = $passwordErr = $positionErr = "";
	$name = $username = $password = $position = "";

	// Kiểm tra dữ liệu được gửi lên
	if($_SERVER["REQUEST_METHOD"] == "POST") {

		// Kiểm tra họ và tên
		if(empty($_POST["name"])) {
			$nameErr = "Thiếu họ tên.";
		}	else {
			$name = test_input($_POST["name"]);
		}

		// Kiểm tra tên đăng nhập
		if(empty($_POST["username"])) {
			$usernameErr = "Thiếu tên đăng nhập.";
		}	else {
			$username = test_input($_POST["username"]);
		}

		// Kiểm tra mật khẩu
		if(empty($_POST["password"])) {
			$passwordErr = "Thiếu mật khẩu.";
		}	else {
			$password = test_input($_POST["password"]);
		}

		// Kiểm tra chức vụ
		if(empty($_POST["position"])) {
			$positionErr = "Chọn chức vụ.";
		}	else {
			$position = test_input($_POST["position"]);
		}

		// nếu không để trống dòng nào
		if($name !== "" && $username !== "" && $password !== "" && $position !== "") {

			$sql = "INSERT INTO users (name, username, password, position) VALUES ('$name', '$username', '$password', '$position')";

			if(mysqli_query($db, $sql)) {
	  		echo '<script type="text/javascript">alert("Thêm người dùng thành công!")</script>';
			} else {
	  		echo '<script type="text/javascript">alert("Thêm người dùng thất bại!")</script>';
			}	
		} 
	}

// ----------------------------------------------------------------------------------------------------

		// lọc dữ liệu post
		function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}
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

	<title>Sửa</title>

	<style type="text/css">
		
		form {
			border: 1px solid #888;
			padding: 40px;
			margin-bottom: 20px;
		}

		.error {
			color: red;
		}

	</style>

</head>
<body>

		<?php include "admin_common.html" ?>

	<div class="col-sm-10">

		<h3 class="text-center mt-3 mb-3">Thêm người dùng</h3>
		
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				
				<form method="POST" action="http://localhost/book_store_web/admin/User/addUser.php">

					<!-- Họ tên -->
					<div class="form-group">
				    <label for="name">Họ tên:</label>
				    <span class="error">*<?php echo $nameErr;?></span>
				    <input type="text" class="form-control" id="name" name="name">
				    
				  </div>

				  <!-- Tên đăng nhập -->
				  <div class="form-group">
				    <label for="username">Tên đăng nhập:</label>
				    <span class="error">*<?php echo $usernameErr;?></span>
				    <input type="text" class="form-control" id="username" name="username">
				    
				  </div>


				  <!-- Mật khẩu -->
				  <div class="form-group">
				    <label for="password">Mật khẩu:</label>
				    <span class="error">*<?php echo $passwordErr;?></span>
				    <input type="password" class="form-control" id="password" name="password">
				  </div>

				  <!-- position -->
				  <fieldset class="form-group row">

				      <div class="form-check ml-5">
				        <input class="form-check-input" type="radio" name="position" id="level1" value="1"> 
				        <label class="form-check-label" for="level1">
				          Nhân viên
				        </label>
				      </div>

				      <div class="form-check ml-5">
				        <input class="form-check-input" type="radio" name="position" id="level2" value="2">  
				        <label class="form-check-label" for="level2">
				          Quản lý
				        </label>
				      </div>		     

				      <span class="error ml-3">*<?php echo $positionErr;?></span>
				  </fieldset>

				  <!-- Button cập nhật -->
				  <div class="form-group text-center"> 
					  <button type="submit" class="btn btn-primary">Thêm</button>
					</div>

				</form>		

			</div>
		</div>
		

	</div>	

</body>
</html>
