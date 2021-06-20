<?php 

// --------------------------------------------SESSION-----------------------------------------------

	session_start();
	if(isset($_SESSION['name']) && $_SESSION['position'] == "1") {
	} else {
		header("location: index.php");
	}

	// connect db
	$db = mysqli_connect("localhost", "root", "", "LTWeb");

// ------------------------------------------SHOW ALL USER--------------------------------------------

	$sql = "SELECT * FROM speakers";

	$rs = mysqli_query($db, $sql);

	$totalSpeakers = mysqli_num_rows($rs);

	// ----------------------------------------------------------

	$sql = "SELECT * FROM speakers WHERE isChecked = 1";

	$rs = mysqli_query($db, $sql);

	$isSpeakers = mysqli_num_rows($rs);

	// ----------------------------------------------------------

	$sql = "SELECT * FROM tickets";

	$rs = mysqli_query($db, $sql);

	$totalTickets = mysqli_num_rows($rs);

	// ----------------------------------------------------------
	
	$sql = "SELECT * FROM tickets WHERE isChecked = 1";

	$rs = mysqli_query($db, $sql);

	$isCheckin = mysqli_num_rows($rs);

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
  <link rel="stylesheet" href="css/staff.css">

	<title>Staff home</title>
</head>
<body>

	<div class="container-fluid" style="background-color: black;">
		<?php include "staff_common.html" ?>
	
		<div class="col-sm-10" style="background-color: #eee">

			<div class="row container mb-4 mt-4 text-white">
				<div class="col-md-3 col-sm-6 col-xs-12" style="padding: 0 20px; ">
					<div class="row stat-box pt-3 pb-3 text-center" style="background: linear-gradient(90deg, rgba(255,148,105,1) 0%, rgba(255,196,163,1) 50%, rgba(255,236,222,1) 100%);">
							<div class="col-sm-6">
								<h1><?= $totalSpeakers ?></h1>
								<p>Diễn giả</p>
							</div>
							<div class="col-sm-6 d-flex align-items-center">
									<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-megaphone" viewBox="0 0 16 16">
									  <path d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0v-.214c-2.162-1.241-4.49-1.843-6.912-2.083l.405 2.712A1 1 0 0 1 5.51 15.1h-.548a1 1 0 0 1-.916-.599l-1.85-3.49a68.14 68.14 0 0 0-.202-.003A2.014 2.014 0 0 1 0 9V7a2.02 2.02 0 0 1 1.992-2.013 74.663 74.663 0 0 0 2.483-.075c3.043-.154 6.148-.849 8.525-2.199V2.5zm1 0v11a.5.5 0 0 0 1 0v-11a.5.5 0 0 0-1 0zm-1 1.35c-2.344 1.205-5.209 1.842-8 2.033v4.233c.18.01.359.022.537.036 2.568.189 5.093.744 7.463 1.993V3.85zm-9 6.215v-4.13a95.09 95.09 0 0 1-1.992.052A1.02 1.02 0 0 0 1 7v2c0 .55.448 1.002 1.006 1.009A60.49 60.49 0 0 1 4 10.065zm-.657.975 1.609 3.037.01.024h.548l-.002-.014-.443-2.966a68.019 68.019 0 0 0-1.722-.082z"/>
									</svg>
							</div>	
					</div>					
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12" style="padding: 0 20px;">
					<div class="row stat-box pt-3 pb-3 text-center" style="background: linear-gradient(90deg, rgba(20,195,0,1) 0%, rgba(132,228,114,1) 50%, rgba(198,255,188,1) 100%);">
							<div class="col-sm-6">
								<h1><?= $isSpeakers ?></h1>
								<p>Đã liên lạc</p>
							</div>
							<div class="col-sm-6 d-flex align-items-center">
								<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
								  <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
								</svg>
							</div>	

					</div>					
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12" style="padding: 0 20px;">
					<div class="row stat-box pt-3 pb-3 text-center" style="background: linear-gradient(90deg, rgba(255,98,98,1) 0%, rgba(255,143,143,1) 50%, rgba(255,245,245,1) 100%);">
							<div class="col-sm-6">
								<h1><?= $totalTickets ?></h1>
								<p>Vé đặt</p>
							</div>
							<div class="col-sm-6 d-flex align-items-center">
								<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
								  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
								</svg>	
							</div>		
										
					</div>					
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12" style="padding: 0 20px;">
					<div class="row stat-box pt-3 pb-3 text-center" style="background: linear-gradient(90deg, rgba(12,153,186,1) 0%, rgba(99,178,208,1) 50%, rgba(215,250,255,1) 100%);">
							<div class="col-sm-6">
								<h1><?= $isCheckin ?></h1>
								<p>Checkin</p>
							</div>
							<div class="col-sm-6 d-flex align-items-center">
								<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
								  <path d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z"/>
								</svg>
							</div>
									
					</div>					
				</div>
				
			</div>
		
		<div class="row mb-4">
			<div class="col-sm-6">
				<div id="curve_chart" style="width: 100%; height: 500px;"></div>				
			</div>
			<div class="col-sm-6">
				<div id="piechart_3d" style="width: 100%; height: 310px;"></div>
				<div class="table-data mt-4 pt-4 pb-3 pl-2 pr-2 text-center" style="background-color: white;">
					<table class="table table-bordered table-success table-striped">
					  <thead>
					    <tr>
					      <th scope="col">Diễn giả đăng ký</th>
					      <th scope="col">Đã kiểm tra</th>
					      <th scope="col">Vé đặt mua</th>
					      <th scope="col">Đã checkin</th>
					    </tr>
					  </thead>
					  <tbody>
					    <tr>
					      <td><?= $totalSpeakers ?></td>
					      <td><?= $isSpeakers ?></td>
					      <td><?= $totalTickets ?></td>
					      <td><?= $isCheckin ?></td>
					    </tr>
					  </tbody>
					</table>
				</div>
			</div>
		</div>
				
		</div>

		<!-- Biểu đồ cột -->
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	  <script type="text/javascript">
	    google.charts.load('current', {'packages':['corechart']});
	    google.charts.setOnLoadCallback(drawChart);

	    function drawChart() {
	      var data = google.visualization.arrayToDataTable([
	        ['WeekDays', 'Số lượt xem', 'Số lượt quan tâm'],
	        ['Thứ 2',  1400, 300],
	        ['Thứ 3',  2200, 450],
	        ['Thứ 4',  1800, 250],
	        ['Thứ 5',  2400, 1000],
	        ['Thứ 6',  2300, 660],
	        ['Thứ 7',  2500, 1700],
	        ['Chủ nhật',  1300, 200],
	      ]);

	      var options = {
	        title: 'Số lượng lượt xem theo tuần',
	        curveType: 'function',
	        legend: { position: 'bottom' }
	      };

	      var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

	      chart.draw(data, options);
	    }
	  </script>

	  <!-- Biểu đồ tròn -->
	  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Loại hình', 'Số lượng'],
          ['Diễn giả đăng ký',  <?= $totalSpeakers ?>],
          ['Đã kiểm tra',  			<?= $isSpeakers ?>],
          ['Vé đặt mua',  			<?= $totalTickets ?>],
          ['Đã checkin', 				<?= $isCheckin ?>],
        ]);

        var options = {
          title: 'Thống kê đăng ký',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
  </head>
	</div>
</body>
</html>