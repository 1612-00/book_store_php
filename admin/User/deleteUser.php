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


// --------------------------------------------DELETE USER--------------------------------------------

	// Xóa user theo id
	$id = $_GET["id"];

	$sql = "DELETE FROM users WHERE id = '".$id."'";

	if(mysqli_query($db, $sql)) {
		header("location: http://localhost/book_store_web/admin/User/showUser.php");
	} else {
		echo "Xóa không thành công!";
	}

?>