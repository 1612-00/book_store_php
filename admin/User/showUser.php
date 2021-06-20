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

// ------------------------------------------SHOW ALL USER--------------------------------------------

	$sql = "SELECT * FROM users";

	$rs = mysqli_query($db, $sql);

	$arr = [];

	// duyệt qua các dòng dữ liệu query được, chuyển thành mảng và push vào mảng kết quả $arr
	if($rs->num_rows > 0) {
		while($row = $rs->fetch_assoc()) {
			array_push($arr, $row);        
    }
	}

// ---------------------------------------------------------------------------------------------------
	
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
  <base href="http://localhost/book_store_web/admin/User/showUser.php">
	<title>Dashboard</title>
</head>
<body>

		<?php include "admin_common.html" ?>

	<div class="col-sm-10">

		<a href="http://localhost/book_store_web/admin/User/addUser.php" class="btn btn-outline-info mt-4 mb-4">Thêm mới</a>

		<div class="row">
			<div class="col-sm-4">
				<h3 class="mb-4">Danh sách tài khoản</h3>				
			</div>
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div class="container-fluid">
			    <form class="d-flex">
			      <input id="search_name" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
			      <button class="btn btn-outline-primary" type="submit">Search</button>
			    </form>
			  </div>	
			</div>
			

		</div>
		
		<table class="table">
		  <thead>
		    <tr>
		      <th scope="col">TT</th>
		      <th scope="col">Tên</th>
		      <th scope="col">Tên đăng nhập</th>
		      <th scope="col">Mật khẩu</th>
		      <th scope="col">Vị trí</th>
		      <th scope="col"></th>
		    </tr>
		  </thead>
		  <tbody id="listUser">
		  	<?php $i = 1 ?>
		  	<?php foreach ($arr as $value): ?>
		    <tr>
		    	<th scope="row"><?php echo $i++ ?></th>
		      <td><?php echo $value["name"] ?></td>
		      <td><?php echo $value["username"] ?></td>
		      <td><?php echo $value["password"] ?></td>
		      <td><?php echo $value["position"] ?></td>
		      <td>
		      	<a href="editUser.php?id=<?php echo $value["id"] ?>" class="btn btn-outline-success">Sửa</a>
		      	<a href="deleteUser.php?id=<?php echo $value["id"] ?>" class="btn btn-outline-danger">Xóa</a>
		      </td>
		    </tr>
		    <?php endforeach ?>

		  </tbody>
		</table>	
	</div>	

</body>
<script type="text/javascript">
	
	$(document).ready(function() {

		$("#search_name").keyup(function() {
			var input = $("#search_name").val();

			$.ajax({
				url: 'ajax_search_user.php',
				type: 'POST',
				data: {
					input: input
				}
			})
			.done(function(data) {
				console.log("success");
				
				$('#listUser').html(data);				

			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
			
		});
	});
</script>
</html>
