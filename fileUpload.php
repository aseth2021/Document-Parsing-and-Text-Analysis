<?php
include_once '../inc/docx.php';
include_once '../inc/PdfParser.php';
include('../inc/connection.php');


if (isset($_POST['fsubmit'])) 
{
    $target_dir = '../uploads/';
    $glob = glob('../uploads/*.*');
    $glob = sprintf('%02d', count($glob) + 1);
	// $files = reArrayFiles($_FILES['offer-main']);
    $details = [];
   
	$fileToUpload = $_FILES['fileToUpload'];
	//To get the initial file name 
	$initialfilename=$fileToUpload['name'];
	
	$do = 'offer-main-form';
	$uploadOk = 1;
	$imageFileType = pathinfo($fileToUpload['name'], PATHINFO_EXTENSION);
	
	//To get the file type 
	$filetype=$imageFileType;
	
	
	$target_file = $target_dir.$glob.'-'.$fileToUpload['name'];
	
	//To get the final file name 
	$finalfilename=$glob.'-'.$fileToUpload['name'];
	
	//Converted text
	$convertedtext="";
	

	//$check = getimagesize($fileToUpload['tmp_name']);
	if ($fileToUpload['size'] > 500000) 
	{
		$msg = 'Sorry, your file is too large.';
		$uploadOk = 0;
	}
	// Allow certain file formats
	if ($imageFileType != 'docx' && $imageFileType != 'doc' && $imageFileType != 'xlsx' && $imageFileType != 'pptx' && $imageFileType != 'pdf' && $imageFileType != 'txt') 
	{
		$msg = 'Sorry, invalid file type.';
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) 
	{
		// $msg = "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
	} 
	else 
	{
		if (move_uploaded_file($fileToUpload['tmp_name'], $target_file)) 
		{
			$msg = 'The Resume has been uploaded.';

			if ($imageFileType == 'pdf') 
			{
				$pdfObj = new PdfParser();
				$resumeText = $pdfObj->parseFile($target_file);
				// $resumeText = $pdfObj->getText();
			} 
			else if ($imageFileType == 'txt') 
			{
				$resumeText = file_get_contents($target_file);
			}
					
			else 
			{
				$docObj = new DocxConversion($target_file);
				$resumeText = $docObj->convertToText();
			}
			$fileInfo = explode(PHP_EOL, $resumeText);
			$records = [];
			foreach ($fileInfo as $row) 
			{
				$parts = preg_split('/(?<=[.?!])\s+(?=[a-z])/i', $row);
				foreach ($parts as $part) 
				{
					if ($part == '') 
					{
						continue;
					}
					$part = strtolower($part);
					$part = str_replace( array( '\'', '"',',' , ';', '<','+', '>' ), ' ', $part);
					$part = str_replace(' ', '-', $part); // Replaces all spaces with hyphens.
					$part = preg_replace('/[^A-Za-z0-9\-]/', '', $part);
					$part = str_replace('-', ' ', $part);
					$convertedtext=$convertedtext.$part;
				}
			}
			//echo $convertedtext;
			$doe=date('Y-m-d');
			//to check if such entry exists or not
			$checkd="select id from docs where convertedtext='$convertedtext'";
			$run_checkd=mysqli_query($con,$checkd);
			if(mysqli_num_rows($run_checkd)==0)
			{
				//To insert data into the database
				$insertd="insert into docs(initialfilename,uploadedfilename,dateofuploading,filetype,convertedtext)
				values('$initialfilename','$finalfilename','$doe','$filetype','$convertedtext')";
				$run_insertd=mysqli_query($con,$insertd);
				if($run_insertd)
				{
					
					$getd="select id from docs where uploadedfilename='$finalfilename'";
					$run_getd=mysqli_query($con,$getd);
					$row_getd=mysqli_fetch_array($run_getd);
					$docid=$row_getd['id'];
					//To traverse through keywordlist table 
					$getk="select * from keywordlist";
					$run_getk=mysqli_query($con,$getk);
					while($row_getk=mysqli_fetch_array($run_getk))
					{
						$count=0;
						$sk=$row_getk['keyword'];
						$doccount=$row_getk['presentindocsno'];
						//To check the number of occurance of keyword in convertedtext
						$count=substr_count($convertedtext,$sk);
						if($count!=0)
						{
							//insert the count in koid table
							$insertc="insert into koid(keyword,docid,noo)
							values('$sk','$docid','$count')";
							$run_insertc=mysqli_query($con,$insertc);
							$doccount=$doccount+1;
							$uptable="update keywordlist set presentindocsno='$doccount' where
							keyword='$sk'";
							$run_uptable=mysqli_query($con,$uptable);
						}
					}
					echo '<script type="text/javascript">';
					echo 'alert("Document Inserted");';
					echo '</script>';
				}
			}
			else
			{
				echo '<script type="text/javascript">';
				echo 'alert("Document Already Exists");';
				echo '</script>';
			}
		} 
		else 
		{
			$msg = 'Sorry, there was an error uploading your file.';
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>File - Gold Miners Admin Dashboard</title>
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
		<?php sideNav("upload","file"); ?>
		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">File</h4>
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
								<a href="#">File</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">File Upload</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">File Upload</div>
								</div>
								<form method="post" enctype="multipart/form-data">
								<div class="card-body">
									<div class="row">
										<div class="col-md-6 col-lg-4">
											<div class="form-group">
												<label for="exampleFormControlFile1">Upload a file</label>
												<input type="file" class="form-control-file" id="exampleFormControlFile1" name='fileToUpload'>
											</div>
									</div>
								</div>
								<div class="card-action">
									<button class="btn btn-success" type='submit' name="fsubmit">Upload File</button>
									<!--<button class="btn btn-danger">Cancel</button>-->
								</div>
								</form>
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
	<!-- Atlantis JS -->
	<script src="../../assets/js/atlantis.min.js"></script>
	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="../../assets/js/setting-demo2.js"></script>
	
</body>
</html>