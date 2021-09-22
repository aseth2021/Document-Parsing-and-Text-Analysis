<?php

include('../inc/connection.php');
$keyword="";
if(isset($_POST['check']))
{
	$sk=$_POST['searchkeyword'];
	$keyword=$sk;
	$sk = strtolower($sk);
	$doccount=0;
	//To check if such key exists in the keywordlist table
	$checkd="select numberoftimesused from keywordlist 
	where keyword='$sk'";
	$run_checkd=mysqli_query($con,$checkd);
	if(mysqli_num_rows($run_checkd)==0)
	{
		//insert the keyword in the keywordlist table
		$insertd="insert into keywordlist(keyword,numberoftimesused)
		values('$sk','1')";
		$run_insertd=mysqli_query($con,$insertd);
		// To traverse through docs table and get convertedtext
		$getd="select id,convertedtext from docs";
		$run_getd=mysqli_query($con,$getd);
		while($row_getd=mysqli_fetch_array($run_getd))
		{
			$count=0;
			$docid=$row_getd['id'];
			$convertedtext=$row_getd['convertedtext'];
			//To check the number of occurance of keyword in convertedtext
			$count=substr_count($convertedtext,$sk);
			if($count!=0)
			{
				//insert the count in koid table
				$insertc="insert into koid(keyword,docid,noo)
				values('$sk','$docid','$count')";
				$run_insertc=mysqli_query($con,$insertc);
				$doccount=$doccount+1;
			}
		}
		//update keywordlist table
		$uptable="update keywordlist set presentindocsno='$doccount' where
		keyword='$sk'";
		$run_uptable=mysqli_query($con,$uptable);
	}
	else
	{
		//update the numberoftimesused to +1
		$row_checkd=mysqli_fetch_array($run_checkd);
		$newnumberoftimesused=$row_checkd['numberoftimesused']+1;
		$updated="update keywordlist set 
		numberoftimesused='$newnumberoftimesused' where keyword='$sk'";
		$run_updated=mysqli_query($con,$updated);
		
		//get doccount
		$getdc="select COUNT(id) from koid where keyword='$sk'";
		$run_getdc=mysqli_query($con,$getdc);
		$row_getdc=mysqli_fetch_array($run_getdc);
		$doccount=$row_getdc['COUNT(id)'];
	}
	
	//insert search log
	$doe=date('Y-m-d');
	$insertd="insert into keywordlog(keyword,presentindocsno,datechecked)
	values('$sk','$doccount','$doe')";
	$run_insertd=mysqli_query($con,$insertd);
	
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Keywords - Gold Miners Admin Dashboard</title>
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
		<?php sideNav("search", "keyword"); ?>
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
								<a href="#">Search Keyword</a>
							</li>
						</ul>
					</div>
					<div class="row">
					<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Keyword Search Results</h4>
								</div>
								<form method='post'>	
                                <div class="card-body">
									<div class="row">
										<div class="col-md-6 col-lg-4">
                                        <div class="form-group">
												<div class="input-icon">
													<input type="text" class="form-control" placeholder="Search for..." name='searchkeyword' required />
													<span class="input-icon-addon">
														<i class="fa fa-search"></i>
													</span>
												</div>
											</div>
									</div>
								</div>
								<div class="card-action">
									<button class="btn btn-success" type='submit' name="check">Submit</button>
									<!--<button class="btn btn-danger">Cancel</button>-->
								</div>
								</form>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>SNo.</th>
													<th>File Name</th>
													<th>Keyword</th>
													<th>Frequency</th>
													<th>View/Download</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>SNo.</th>
													<th>File Name</th>
													<th>Keyword</th>
													<th>Frequency</th>
													<th>View/Download</th>
												</tr>
											</tfoot>
											<tbody>
												<?php
												$i=1;
												$getk="select * from koid where keyword='$keyword' ORDER BY noo DESC";
												$run_getk=mysqli_query($con,$getk);
												while($row_getk=mysqli_fetch_array($run_getk))
												{
													$docid=$row_getk['docid'];
													$noo=$row_getk['noo'];
													$getd="select * from docs where id='$docid'";
													$run_getd=mysqli_query($con,$getd);
													while($row_getd=mysqli_fetch_array($run_getd))
													{
														$initialfilename=$row_getd['initialfilename'];
														$uploadedfilename=$row_getd['uploadedfilename'];
														$dateofuploading=$row_getd['dateofuploading'];
														$filetype=$row_getd['filetype'];
														if(($filetype=='doc')||($filetype=='docx'))
														{
															$lastcolumn="<a href='../uploads/$uploadedfilename' target='_blank'>Download</a>";
														}
														else
														{
															$lastcolumn="<a href='../uploads/$uploadedfilename' target='_blank'>View</a>";
														}
														
								
														echo "
															<tr>
																<td>$i</td>
																<td>$initialfilename</td>
																<td>$keyword</td>
																<td>$noo</td>
																<td>$lastcolumn </td>															
															</tr>
														";
														$i=$i+1;
													}
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