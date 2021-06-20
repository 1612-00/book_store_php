<?php 

	// connect db
	$db = mysqli_connect("localhost", "root", "", "LTWeb");

// ---------------------------------------------SIGN UP----------------------------------------------

	$nameErr = $usernameErr = $passwordErr = "";
	$name = $username = $password = ""; 

	// Kiểm tra dữ liệu post lên
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

		// nếu không để trống dòng nào
		if($name !== "" && $username !== "" && $password !== "") {

			$sql = "INSERT INTO users (name, username, password, position) VALUES ('$name', '$username', '$password', '1')";

			if(mysqli_query($db, $sql)) {
	  		echo '<script type="text/javascript">alert("Đăng ký thành công!")</script>';
			} else {
	  		echo '<script type="text/javascript">alert("Tạo tài khoản thất bại!")</script>';
			}	
		} 
	}

// ---------------------------------------------------------------------------------------------------

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
	<title>Đăng ký</title>

	<style type="text/css">		

		body {
			background-image: url(../image/snow.jpg);
			background-size: cover;
			background-position: center center;
			min-height: 90vh;
		}

		.error {
			color: red;
		}

		h1 {
			margin-top: 20px;
		}

		.sign-up-form {
			border: 1px solid black;
			border-radius: 5%;
			padding: 30px;
			margin-top: 20px;
			margin-bottom: 20px;
			background-color: rgba(255, 255, 255, 0.7);
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
		}

	</style>
</head>
<body>
	<div class="container">
		<h1 class="text-center">Đăng ký</h1>
		<div class="row">
			<div class="col-lg-3 col-md-2 col-sm-1"></div>
			<div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 sign-up-form">
				
				<p><span class="error">* Phần bắt buộc</span></p>
				<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

					<!-- Họ tên -->
					<div class="form-group">
				    <label for="name">Họ tên:</label>
				    <span class="error">*<?php echo $nameErr;?></span>
				    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>">
				    
				  </div>

				  <!-- Tên đăng nhập -->
				  <div class="form-group">
				    <label for="username">Tên đăng nhập:</label>
				    <span class="error">*<?php echo $usernameErr;?></span>
				    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username ?>">
				    
				  </div>


				  <!-- Mật khẩu -->
				  <div class="form-group">
				    <label for="password">Mật khẩu:</label>
				    <span class="error">*<?php echo $passwordErr;?></span>
				    <input type="password" class="form-control" id="password" name="password" value="<?php echo $password ?>">
				  </div>

				  <!-- Button đăng ký, về trang đăng nhập -->
				  <div class="form-group d-flex justify-content-between"> 
					  <button type="submit" class="btn btn-primary">Đăng ký</button>
					  <a type="button" class="btn btn-success" href="index.php">Về đăng nhập</a>
					</div>

				</form>
		

			</div>
		</div>		
		
	</div>

</body>
</html>



