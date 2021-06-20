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

// ------------------------------------------SHOW ALL USER--------------------------------------------

	$sql = "SELECT * FROM tickets";

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
  
	<title>Ticket</title>
</head>
<body>
	<div class="container-fluid" style="background-color: black;">
		<?php include "staff_common.html" ?>

		<div class="col-sm-10" style="background-color: #eee">

			<h3 class="mb-4 mt-4 text-center">Danh sách yêu cầu mua vé:</h3>

			<div class="container-fluid row">
				<div class="col-sm-7"></div>

				<div class="col-sm-5 mb-3">
					<form class="d-flex justify-content-between">
						<h5>Loại vé:</h5>

						<div class="d-flex">
							<input id="search_type" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
				      <button class="btn btn-outline-primary ml-2" type="submit">Search</button>	
						</div>
			      
			    </form>
				</div>
			    
			</div>

			<table class="table table-bordered">
			  <thead>
			    <tr>
			      <th scope="col">TT</th>
			      <th scope="col">Họ Tên</th>
			      <th scope="col">Địa chỉ</th>
			      <th scope="col">Email</th>		
			      <th scope="col">Loại vé</th>	
			      <th scope="col">Đã checkin</th>	
			      <th></th>      
			    </tr>
			  </thead>
			  <tbody id="listTicket">
			  	<?php $i = 1 ?>
			  	<?php foreach ($arr as $value): ?>
				    <tr>
				    	<th scope="row"><?php echo $i++ ?></th>
				      <td><?php echo $value["name"] ?></td>
				      <td><?php echo $value["address"] ?></td>
				      <td><?php echo $value["email"] ?></td>
				      <td><?php echo $value["type"] ?></td>
				      <td>
				      	<svg id="isChecked<?= $value["id"] ?>" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16" style="color: green;">
								  <path d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z"/>
								</svg>
								<script type="text/javascript">
									var x = <?php echo $value["isChecked"] ?>;
									if(x == 0) {
										document.getElementById("isChecked<?= $value["id"] ?>").style.display = "none";
									}									
								</script>
				      </td>	
				      <td>
				      	<a href="descTicket.php?id=<?php echo $value["id"] ?>" class="btn btn-outline-success">Chi tiết</a>
				      </td>
				    </tr>
			    <?php endforeach ?>

			  </tbody>
			</table>	
		</div>	
	</div>
	

</body>

<script type="text/javascript">
		
	$(document).ready(function() {
		
		$("#search_type").keyup(function() {
			var input = $("#search_type").val();

			$.ajax({
				url: 'ajax_search_type.php',
				type: 'POST',
				data: {
					input: input
				},
			})
			.done(function(data) {
				console.log("success");

				$('#listTicket').html(data);	

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
