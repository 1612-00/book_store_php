<?php 
	
	session_start();
	if(isset($_SESSION['name']) && $_SESSION['position'] == "2") {
	} else {
		header("location: http://localhost/book_store_web/admin/index.php");
	}

	$db = mysqli_connect("localhost", "root", "", "LTWeb");

	$input = $_POST['input'];

	$sql = "SELECT * FROM users WHERE name LIKE '%".$input."%'";

	$rs = mysqli_query($db, $sql);

	$arr = [];

	// duyệt qua các dòng dữ liệu query được, chuyển thành mảng và push vào mảng kết quả $arr
	if($rs->num_rows > 0) {
		$i = 1;
		while($row = $rs->fetch_assoc()) {    	

?>
	
	<tr>
  	<th scope="row"><?php echo $i++ ?></th>
    <td><?php echo $row["name"] ?></td>
    <td><?php echo $row["username"] ?></td>
    <td><?php echo $row["password"] ?></td>
    <td><?php echo $row["position"] ?></td>
    <td>
    	<a href="editUser.php?id=<?php echo $row["id"] ?>" class="btn btn-outline-success">Sửa</a>
    	<a href="deleteUser.php?id=<?php echo $row["id"] ?>" class="btn btn-outline-danger">Xóa</a>
    </td>
  </tr>

<?php 
		}
	}
?>
