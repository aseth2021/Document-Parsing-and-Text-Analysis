<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Keyword - Gold Miners Admin Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../../assets/img/icon.ico" type="image/x-icon"/>
	
	<!-- Fonts and icons -->
	<script src="../../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../assets/css/atlantis.min.css">
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../../assets/css/demo.css">
</head>
<?php
include('../functions.php');
?>
<body>
	<div class="wrapper sidebar_minimize">
	<?php topHeader('../../'); ?>
		<!-- Sidebar -->
		<?php sideNav("viewKeywords", "keyword"); ?>
		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Keywords</h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="#">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Keywords</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">View Keywords</a>
							</li>
						</ul>
					</div>
					<div class="row">
					<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Keyword Details</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>Keyword</th>
													<th>Uploads Frequency</th>
													<th>Match Frequency</th>
													<th>Searched Frequency</th>
													<th>View Chart</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>Keyword</th>
													<th>Uploads Frequency</th>
													<th>Match Frequency</th>
													<th>Searched Frequency</th>
													<th>View Chart</th>
												</tr>
											</tfoot>
											<tbody>
												<?php
												include('../inc/connection.php');
												
												$getd="select * from keywordlist";
												$run_getd=mysqli_query($con,$getd);
												while($row_getd=mysqli_fetch_array($run_getd))
												{
													$keyword=$row_getd['keyword'];
													$presentindocsno=$row_getd['presentindocsno'];
													$numberoftimesused=$row_getd['numberoftimesused'];
													$sql = "SELECT SUM(noo) FROM koid where keyword='$keyword' ";
													$result = mysqli_query($con,$sql);
													$row = mysqli_fetch_array($result); 
													$sum=$row['SUM(noo)']+0;											
																			
													echo "
														<tr>
															<form action='viewkchart.php' method='post'>
															<td>$keyword</td>
															<td>$presentindocsno</td>
															<td>$sum</td>
															<td>$numberoftimesused </td>
															<td>															
																<input type='hidden' name='keyword' value='$keyword'/>
																<button class='btn btn-success' type='submit' name='check'>View Chart</button>
															</td>	
															</form>															
														</tr>
													";
												}
												
												
												?>
												
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--   Core JS Files   -->
	<script src="../../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../../assets/js/core/popper.min.js"></script>
	<script src="../../assets/js/core/bootstrap.min.js"></script>
	<!-- jQuery UI -->
	<script src="../../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="../../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	
	<!-- jQuery Scrollbar -->
	<script src="../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<!-- Datatables -->
	<script src="../../assets/js/plugin/datatables/datatables.min.js"></script>
	<!-- Atlantis JS -->
	<script src="../../assets/js/atlantis.min.js"></script>
	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="../../assets/js/setting-demo2.js"></script>
	<script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});

			$('#multi-filter-select').DataTable( {
				"pageLength": 5,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});

			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

			$('#addRowButton').click(function() {
				$('#add-row').dataTable().fnAddData([
					$("#addName").val(),
					$("#addPosition").val(),
					$("#addOffice").val(),
					action
					]);
				$('#addRowModal').modal('hide');

			});
		});
	</script>
</body>
</html>