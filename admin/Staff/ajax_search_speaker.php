<?php 
	
	session_start();
	if(isset($_SESSION['name']) && $_SESSION['position'] == "1") {
	} else {
		header("location: http://localhost/book_store_web/admin/index.php");
	}

	$db = mysqli_connect("localhost", "root", "", "LTWeb");

	$input = $_POST['input'];

	$sql = "SELECT * FROM speakers WHERE theme LIKE '%".$input."%'";

	$rs = mysqli_query($db, $sql);

	$arr = [];

	// duyệt qua các dòng dữ liệu query được, chuyển thành mảng và push vào mảng kết quả $arr
	if($rs->num_rows > 0) {
		$i = 1;
		while($row = $rs->fetch_assoc()) {    	

?>
	
	<tr>
  	<th scope="row"><?php echo $i++ ?></th>
  	<td><img src="<?php echo $row["avatar"] ?>" alt="avatar" width="80px" height="80px"></td>
    <td><?php echo $row["name"] ?></td>
    <td><?php echo $row["nationality"] ?></td>
    <td><?php echo $row["theme"] ?></td>
     <td>
      	<svg id="isChecked<?= $row["id"] ?>" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16" style="color: green;">
				  <path d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z"/>
				</svg>
				<script type="text/javascript">
					var x = <?php echo $row["isChecked"] ?>;
					if(x == 0) {
						document.getElementById("isChecked<?= $row["id"] ?>").style.display = "none";
					}									
				</script>
      </td>	
    <td>
    	<a href="descSpeaker.php?id=<?php echo $row["id"] ?>" class="btn btn-outline-success">Chi tiết</a>
    </td>
  </tr>

<?php 
		}
	}
?>
