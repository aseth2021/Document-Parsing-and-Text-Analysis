<?php

date_default_timezone_set('Asia/Kolkata');

//Add databse page
include('inc/connection.php');

$today=date("Y-m-d"); 
	$node_arr = array();

	//to get total doc details
	$sql = "SELECT COUNT(id) FROM docs where filetype = 'docx' or filetype = 'doc'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result); 
	$doc=$row['COUNT(id)']+0;
	
	//to get total pdf details
	$sql = "SELECT COUNT(id) FROM docs where filetype = 'pdf'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result); 
	$pdf=$row['COUNT(id)']+0;
	
	//to get total text details
	$sql = "SELECT COUNT(id) FROM docs where  filetype = 'txt'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result); 
	$txt=$row['COUNT(id)']+0;

	
	$node_arr[] = array("doc" => $doc, "pdf" => $pdf, "txt" => $txt);
	//echo json_encode($node_arr);
	$sum=$doc+$pdf+$txt;
	$doc=round(($doc/$sum)*100);
	$pdf=round(($pdf/$sum)*100);
	$txt=round(($txt/$sum)*100);
	$all="$doc , $pdf , $txt";
	
	$sql = "SELECT COUNT(id) FROM docs";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result); 
	$tdocsum=$row['COUNT(id)']+0;
	
	$sql = "SELECT COUNT(id) FROM docs where dateofuploading='$today'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result); 
	$docsum=$row['COUNT(id)']+0;
	
	$sql = "SELECT COUNT(id) FROM keywordlog where datechecked='$today'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result); 
	$keytoday=$row['COUNT(id)']+0;
	
	$sql = "SELECT COUNT(id) FROM keywordlog";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result); 
	$tkey=$row['COUNT(id)']+0;
	
	$sql = "SELECT COUNT(noo) FROM koid where logtime='$today' ";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result); 
	$kf=$row['COUNT(noo)']+0;
	
	$sql = "SELECT COUNT(noo) FROM koid ";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result); 
	$tkf=$row['COUNT(noo)']+0;

	$kadate=date('l', strtotime('-0 day',strtotime($today)));
	$sql = "SELECT SUM(presentindocsno) FROM keywordlog where datechecked='$today' ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result); 
	$kadoc=$row['SUM(presentindocsno)']+0;
	
	$kadate1=date('l', strtotime('-1 day',strtotime($today)));
	$tooneday=date('Y-m-d', strtotime('-1 day',strtotime($today))); 
	$sql = "SELECT SUM(presentindocsno) FROM keywordlog where datechecked='$tooneday' ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result); 
	$kadoc1=$row['SUM(presentindocsno)']+0;
	
	$kadate2=date('l', strtotime('-2 day',strtotime($today)));
	$totwoday=date('Y-m-d', strtotime('-2 day',strtotime($today))); 
	$sql = "SELECT SUM(presentindocsno) FROM keywordlog where datechecked='$totwoday' ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result); 
	$kadoc2=$row['SUM(presentindocsno)']+0;
	
	$kadate3=date('l', strtotime('-3 day',strtotime($today)));
	$tothreeday=date('Y-m-d', strtotime('-3 day',strtotime($today))); 
	$sql = "SELECT SUM(presentindocsno) FROM keywordlog where datechecked='$tothreeday' ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result); 
	$kadoc3=$row['SUM(presentindocsno)']+0;
	
	$kadate4=date('l', strtotime('-4 day',strtotime($today)));
	$tofourday=date('Y-m-d', strtotime('-4 day',strtotime($today))); 
	$sql = "SELECT SUM(presentindocsno) FROM keywordlog where datechecked='$tofourday' ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result); 
	$kadoc4=$row['SUM(presentindocsno)']+0;
	
	$kadate5=date('l', strtotime('-5 day',strtotime($today)));
	$tofiveday=date('Y-m-d', strtotime('-5 day',strtotime($today))); 
	$sql = "SELECT SUM(presentindocsno) FROM keywordlog where datechecked='$tofiveday' ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result); 
	$kadoc5=$row['SUM(presentindocsno)']+0;
	
	$kadate6=date('l', strtotime('-6 day',strtotime($today)));
	$tosixday=date('Y-m-d', strtotime('-6 day',strtotime($today))); 
	$sql = "SELECT SUM(presentindocsno) FROM keywordlog where datechecked='$tosixday' ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result); 
	$kadoc6=$row['SUM(presentindocsno)']+0;
	
	
	$sql = "SELECT COUNT(id) FROM docs where dateofuploading='$today'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result); 
	$ftdoc=$row['COUNT(id)']+0;
	
	$sql = "SELECT COUNT(id) FROM docs where dateofuploading='$tooneday'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result); 
	$ftdoc1=$row['COUNT(id)']+0;
	
	$sql = "SELECT COUNT(id) FROM docs where dateofuploading='$totwoday'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result); 
	$ftdoc2=$row['COUNT(id)']+0;
	
	$sql = "SELECT COUNT(id) FROM docs where dateofuploading='$tothreeday'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result); 
	$ftdoc3=$row['COUNT(id)']+0;
	
	$sql = "SELECT COUNT(id) FROM docs where dateofuploading='$tofourday'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result); 
	$ftdoc4=$row['COUNT(id)']+0;
	
	$sql = "SELECT COUNT(id) FROM docs where dateofuploading='$tofiveday'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result); 
	$ftdoc5=$row['COUNT(id)']+0;
	
	$sql = "SELECT COUNT(id) FROM docs where dateofuploading='$tosixday'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result); 
	$ftdoc6=$row['COUNT(id)']+0;
	
	$t5sk="";	
	$t5skv="";	
	$gett5s="select keyword, numberoftimesused from keywordlist ORDER BY numberoftimesused DESC limit 5";
	$run_gett5s=mysqli_query($con,$gett5s);
	while($row_gett5s=mysqli_fetch_array($run_gett5s))
	{
		$keyword=$row_gett5s['keyword'];
		$numberoftimesused=$row_gett5s['numberoftimesused'];
		if($t5sk==""){ $t5sk="'$keyword'";}
		else {$t5sk="$t5sk,'$keyword'";}
		if($t5skv==""){ $t5skv="'$numberoftimesused'";}
		else {$t5skv="$t5skv,'$numberoftimesused'";}
		
	}
	$t5ko="";	
	$t5kov="";
	$gettko="select keyword, presentindocsno from keywordlist ORDER BY presentindocsno DESC limit 5";
	$run_gettko=mysqli_query($con,$gettko);
	while($row_gettko=mysqli_fetch_array($run_gettko))
	{
		$keyword=$row_gettko['keyword'];
		$presentindocsno=$row_gettko['presentindocsno'];
		if($t5ko==""){ $t5ko="\"$keyword\"";}
		else {$t5ko="$t5ko,\"$keyword\"";}
		if($t5kov==""){ $t5kov="$presentindocsno";}
		else {$t5kov="$t5kov,$presentindocsno";}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Gold Miners - Admin Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../assets/img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">
</head>
<?php
include('functions.php');
?>
<body>
	<div class="wrapper">
	<?php topHeader('../'); ?>
		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<ul class="nav nav-primary">
						<li class="nav-item active">
							<a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="dashboard">
								<ul class="nav nav-collapse">
									<li>
										<a href="../demo1/index.php">
											<span class="sub-item">Dashboard</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Components</h4>
						</li>
					
						<li class="nav-item">
							<a data-toggle="collapse" href="#forms">
								<i class="fas  fa-file"></i>
								<p>File</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="forms">
								<ul class="nav nav-collapse">
									<li>
										<a href="forms/fileUpload.php">
											<span class="sub-item">File Upload</span>
										</a>
									</li>
									<li>
										<a href="forms/viewFiles.php">
											<span class="sub-item">View Files</span>
										</a>
									</li>
								</ul>
							</div>
						</li>

						<li class='nav-item'>
							<a data-toggle='collapse' href='#keyword'>
								<i class='fas fa-key'></i>
								<p>Keywords</p>
								<span class='caret'></span>
							</a>
							<div class='collapse' id='keyword'>
								<ul class='nav nav-collapse'>
									<li>
										<a href='keyword/searchKeywords.php'>
											<span class='sub-item'>Keyword Search</span>
										</a>
									</li>
									<li>
										<a href='keyword/viewKeywords.php'>
											<span class='sub-item'>View Keywords </span>
										</a>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Dashboard</h2>
								<h5 class="text-white op-7 mb-2">Gold Miners Admin Dashboard</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row mt--2">
						<div class="col-md-6">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">Overall statistics</div>
									<div class="card-category">Daily information about statistics in system</div>
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-1"></div>
											<h6 class="fw-bold mt-3 mb-0">File Uploads</h6>
										</div>
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-2"></div>
											<h6 class="fw-bold mt-3 mb-0">Keyword Searches</h6>
										</div>
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-3"></div>
											<h6 class="fw-bold mt-3 mb-0">Keywords Found</h6>
										</div>
									</div>
									<br>
									<hr>
									<br>
									<p class="text-muted"><b>File Uploads</b> denotes number of files uploaded today</p>
									
									<p class="text-muted"><b>Keyword Searches</b> denotes number of keyword searches today</p>
									
									<p class="text-muted"><b>Keywords Found</b> denotes number of occurances of keywords today</p>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card full-height">
								<div class="card-body">
								<div class="card-header">
									<div class="card-title">Uploads by File Type</div>
								</div>
								<div class="card-body">
									<div class="chart-container">
										<canvas id="pieChart" style="width: 50%; height: 50%"></canvas>
									</div>
								</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Last 7 days Keyword Search Analysis</div>
								</div>
								<div class="card-body">
									<div class="chart-container">
										<canvas id="lineChart"></canvas>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="card">
							<div class="card-header">
									<div class="card-title">Last 7 days Upload Analysis</div>
								</div>
								<div class="card-body">
									<div class="chart-container">
										<canvas id="barChart1"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Top 5 Searches</div>
								</div>
								<div class="card-body">
									<div class="chart-container">
										<canvas id="doughnutChart" style="width: 50%; height: 50%"></canvas>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
							<div class="card-header">
									<div class="card-title">Top 5 Keyword Occurances</div>
								</div>
								<div class="card-body">
									<div class="chart-container">
										<canvas id="barChart"></canvas>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="card">
								<div class="card-body">
									<div class="card-title fw-mediumbold">Most Popular Uploads</div>
									<div class="card-list">
									
										<?php
											$getd="select docid, SUM(noo) from koid GROUP BY docid ORDER BY SUM(noo) DESC LIMIT 5";
											$run_getd=mysqli_query($con,$getd);
											while($row_getd=mysqli_fetch_array($run_getd))
											{
												$docid=$row_getd['docid'];
												$sumnoo=$row_getd['SUM(noo)'];
												$getdd="select * from docs where id='$docid'";
												$run_getdd=mysqli_query($con,$getdd);
												while($row_getdd=mysqli_fetch_array($run_getdd))
												{
													$initialfilename=$row_getdd['initialfilename'];
													$uploadedfilename=$row_getdd['uploadedfilename'];
													
													echo "
													<div class='item-list'>
														<div class='info-user ml-3'>
															<div class='username'><a href='../uploads/$uploadedfilename' target='_blank'>$initialfilename</a></div>
														</div>
														<button class='btn btn-icon btn-primary btn-round btn-xs'>
															$sumnoo
														</button>
													</div>
													";
												}
											}
										
										?>
										
										
										
									</div>
								</div>
							</div>
						</div>
						<!--<div class="col-md-3">
							<div class="card card-primary bg-primary-gradient">
								<div class="card-body">
									<h4 class="mt-3 b-b1 pb-2 mb-4 fw-bold">Active user right now</h4>
									<h1 class="mb-4 fw-bold">17</h1>
									<h4 class="mt-3 b-b1 pb-2 mb-5 fw-bold">Page view per minutes</h4>
									<div id="activeUsersChart"></div>
									<h4 class="mt-5 pb-3 mb-0 fw-bold">Top active pages</h4>
									<ul class="list-unstyled">
										<li class="d-flex justify-content-between pb-1 pt-1"><small>/product/readypro/index.html</small> <span>7</span></li>
										<li class="d-flex justify-content-between pb-1 pt-1"><small>/product/atlantis/demo.html</small> <span>10</span></li>
									</ul>
								</div>
							</div>
						</div>-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--   Core JS Files   -->
	<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../assets/js/core/popper.min.js"></script>
	<script src="../assets/js/core/bootstrap.min.js"></script>

	<!-- jQuery UI -->
	<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


	<!-- Chart JS -->
	<script src="../assets/js/plugin/chart.js/chart.min.js"></script>

	<!-- jQuery Sparkline -->
	<script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

	<!-- Chart Circle -->
	<script src="../assets/js/plugin/chart-circle/circles.min.js"></script>

	<!-- Datatables -->
	<script src="../assets/js/plugin/datatables/datatables.min.js"></script>

	<!-- Bootstrap Notify -->
	<script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

	<!-- jQuery Vector Maps -->
	<script src="../assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
	<script src="../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

	<!-- Sweet Alert -->
	<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

	<!-- Atlantis JS -->
	<script src="../assets/js/atlantis.min.js"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="../assets/js/setting-demo.js"></script>
	<script src="../assets/js/demo.js"></script>
	<script>
	var doughnutChart = document.getElementById('doughnutChart').getContext('2d');
		
			var myDoughnutChart = new Chart(doughnutChart, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [<?php echo $t5skv;?>],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3','#28a745','#6f42c1']
				}],

				labels: [<?php echo $t5sk;?>]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});
		var lineChart = document.getElementById('lineChart').getContext('2d');
		
		var myLineChart = new Chart(lineChart, {
			type: 'line',
			data: {
				labels: [<?php echo "\"$kadate6\",\"$kadate5\",\"$kadate4\",\"$kadate3\",\"$kadate2\",\"$kadate1\",\"$kadate\""; ?>],
				datasets: [{
					label: "Keywords",
					borderColor: "#1d7af3",
					pointBorderColor: "#FFF",
					pointBackgroundColor: "#1d7af3",
					pointBorderWidth: 2,
					pointHoverRadius: 4,
					pointHoverBorderWidth: 1,
					pointRadius: 4,
					backgroundColor: 'transparent',
					fill: true,
					borderWidth: 2,
					data: [<?php echo "$kadoc6 ,$kadoc5 ,$kadoc4 ,$kadoc3 ,$kadoc2 ,$kadoc1 ,$kadoc";?>]
				}]
			},
			options : {
				responsive: true, 
				maintainAspectRatio: false,
				legend: {
					position: 'bottom',
					labels : {
						padding: 10,
						fontColor: '#1d7af3',
					}
				},
				tooltips: {
					bodySpacing: 4,
					mode:"nearest",
					intersect: 0,
					position:"nearest",
					xPadding:10,
					yPadding:10,
					caretPadding:10
				},
				layout:{
					padding:{left:15,right:15,top:15,bottom:15}
				}
			}
		});

		Circles.create({
			id:'circles-1',
			radius:45,
			value:<?php echo $docsum;?>,
			maxValue:<?php echo $tdocsum;?>,
			width:7,
			text: <?php echo $docsum;?>,
			colors:['#f1f1f1', '#FF9E27'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-2',
			radius:45,
			value:<?php echo $keytoday;?>,
			maxValue:<?php echo $tkey;?>,
			width:7,
			text: <?php echo $keytoday;?>,
			colors:['#f1f1f1', '#2BB930'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-3',
			radius:45,
			value:<?php echo $kf;?>,
			maxValue:<?php echo $tkf;?>,
			width:7,
			text: <?php echo $kf;?>,
			colors:['#f1f1f1', '#F25961'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})
		
		var barChart = document.getElementById('barChart').getContext('2d');
		var barChart1 = document.getElementById('barChart1').getContext('2d');
		var pieChart = document.getElementById('pieChart').getContext('2d');

		var myPieChart = new Chart(pieChart, {
			type: 'pie',
			data: {
				datasets: [{
					data: [<?php echo $all; ?>],
					backgroundColor :["#1d7af3","#f3545d","#fdaf4b"],
					borderWidth: 0
				}],
				labels: ['DOC', 'PDF', 'TxT'] 
			},
			options : {
				responsive: true, 
				maintainAspectRatio: false,
				legend: {
					position : 'bottom',
					labels : {
						fontColor: 'rgb(154, 154, 154)',
						fontSize: 11,
						usePointStyle : true,
						padding: 20
					}
				},
				pieceLabel: {
					render: 'percentage',
					fontColor: 'white',
					fontSize: 14,
				},
				tooltips: false,
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		})

		var myBarChart = new Chart(barChart, {
			type: 'bar',
			data: {
				labels: [<?php echo $t5ko; ?>],
				datasets : [{
					label: "Keyword Occurances",
					backgroundColor: 'rgb(23, 125, 255)',
					borderColor: 'rgb(23, 125, 255)',
					data: [<?php echo $t5kov;?>],
				}],
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				},
			}
		});
		var myBarChart1 = new Chart(barChart1, {
			type: 'bar',
			data: {
				labels: [<?php echo "\"$kadate6\",\"$kadate5\",\"$kadate4\",\"$kadate3\",\"$kadate2\",\"$kadate1\",\"$kadate\""; ?>],
				datasets : [{
					label: "File Uploads",
					backgroundColor: 'rgb(23, 125, 255)',
					borderColor: 'rgb(23, 125, 255)',
					data: [<?php echo "$ftdoc6 ,$ftdoc5 ,$ftdoc4 ,$ftdoc3 ,$ftdoc2 ,$ftdoc1 ,$ftdoc";?>],
				}],
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				},
			}
		});


		
	</script>
</body>
</html>