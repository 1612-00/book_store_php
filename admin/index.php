	<?php 

// --------------------------------------------SESSION-----------------------------------------------

		session_start();

// ---------------------------------------------------------------------------------------------------

		// connect db
		$db = mysqli_connect("localhost", "root", "", "LTWeb");

// ----------------------------------------------LOGIN------------------------------------------------

		$usernameErr = $passwordErr = "";
		$username = $password = ""; 

		// Kiểm tra dữ liệu post lên
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			if(empty($_POST["username"])) {
				$usernameErr = "Thiếu tên đăng nhập.";
			}	else {
				$username = test_input($_POST["username"]);
			}

			if(empty($_POST["password"])) {
				$passwordErr = "Thiếu mật khẩu.";
			}	else {
				$password = test_input($_POST["password"]);
			}

			// nếu k để trống ô nào
			if($username !== "" && $password !== "") {

				$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

				$rs = mysqli_query($db, $sql);

				// nếu tìm được tài khoản hợp lệ trong db
				if(mysqli_num_rows($rs) > 0) {
					// chuyển thành array
					$row = $rs->fetch_assoc();

					// tạo session
					$_SESSION['name'] = $row['name'];
					$_SESSION['position'] = $row['position'];
					
					// đưa vào trang admin
					if($_SESSION['position'] == "2")
						header("location: User/showUser.php");
					if($_SESSION['position'] == "1")
						header("location: Staff/staff_home.php");
				} else {
		  		echo '<script type="text/javascript">alert("Sai ten dang nhap hoac mat khau!")</script>';
				}	
			}
			
		}

// ---------------------------------------------------------------------------------------------------

		// Lọc dữ liệu post
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
	<title>Đăng nhập</title>

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

		.login-form {
			margin-top: 30px;
			border: 1px solid black;
			border-radius: 10%;
			padding: 40px;
			background-color: rgba(255, 255, 255, 0.7);
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
		}

	</style>
</head>
<body>
	<div class="container">
		<h1 class="text-center mt-5">Đăng nhập</h1>
		<div class="row">
			<div class="col-lg-4 col-md-3 col-sm-2"></div>
			<div class="col-lg-4 col-md-6 col-sm-8 col-xs-12 login-form">
				
				<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

				  <div class="form-group">
				    <label for="username">Tên đăng nhập:</label>
				    <span class="error">*<?php echo $usernameErr;?></span>
				    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username ?>">
				  </div>

				  <div class="form-group">
				    <label for="password">Mật khẩu:</label>
				    <span class="error">*<?php echo $passwordErr;?></span>
				    <input type="password" class="form-control" id="password" name="password" value="<?php echo $password ?>">
				  </div>
				  
				  <button type="submit" class="btn btn-primary">Đăng nhập</button>
				  <a type="button" class="btn btn-success" href="sign_up.php">Đăng ký</a>
				</form>

			</div>			
		</div>
		
		
	</div>



</body>
</html>



