
<?php

function topHeader($path) {
    echo "
    <div class='main-header'>
			<!-- Logo Header -->
			<div class='logo-header' data-background-color='blue'>		
				<a href='index.php' class='logo'>
					<img src="; echo $path; echo "assets/img/watermarklogo.svg alt='Watermark' class='navbar-brand'>
				</a>
				<button class='navbar-toggler sidenav-toggler ml-auto' type='button' data-toggle='collapse' data-target='collapse' aria-expanded='false' aria-label='Toggle navigation'>
					<span class='navbar-toggler-icon'>
						<i class='icon-menu'></i>
					</span>
				</button>
				<button class='topbar-toggler more'><i class='icon-options-vertical'></i></button>
				<div class='nav-toggle'>
					<button class='btn btn-toggle toggle-sidebar'>
						<i class='icon-menu'></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class='navbar navbar-header navbar-expand-lg' data-background-color='blue2'>
			</nav>
			<!-- End Navbar -->
		</div>
        ";
}


function sideNav($activeItem, $activeTab) {
	$activeItem = $activeItem;

	echo "
	<div class='sidebar sidebar-style-2'>			
			<div class='sidebar-wrapper scrollbar scrollbar-inner'>
				<div class='sidebar-content'>
					<ul class='nav nav-primary'>
						<li class='nav-item'>
							<a data-toggle='collapse' href='#dashboard' class='collapsed' aria-expanded='false'>
								<i class='fas fa-home'></i>
								<p>Dashboard</p>
								<span class='caret'></span>
							</a>
							<div class='collapse' id='dashboard'>
								<ul class='nav nav-collapse'>
									<li>
										<a href='../index.php'>
											<span class='sub-item'>Dashboard</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class='nav-section'>
							<span class='sidebar-mini-icon'>
								<i class='fa fa-ellipsis-h'></i>
							</span>
							<h4 class='text-section'>Components</h4>
						</li>
						
						<li class='nav-item "; echo ($activeTab=="file"?"active ": ""); echo" submenu'>
							<a data-toggle='collapse' href='#forms'>
								<i class='fas fa-file'></i>
								<p>File</p>
								<span class='caret'></span>
							</a>
							<div class='collapse show' id='forms'>
								<ul class='nav nav-collapse'>
									<li class='"; echo ($activeItem=="upload"?"active ": ""); echo"'>
										<a href='../forms/fileUpload.php'>
											<span class='sub-item'>File Upload</span>
										</a>
									</li>
									<li class='"; echo ($activeItem=="viewFiles"?"active ": ""); echo"'>
										<a href='../forms/viewFiles.php'>
											<span class='sub-item'>View Files</span>
										</a>
									</li>
								</ul>
							</div>
						</li>

						<li class='nav-item "; echo ($activeTab=="keyword"?"active ": ""); echo" submenu'>
							<a data-toggle='collapse' href='#keyword'>
								<i class='fas fa-key'></i>
								<p>Keywords</p>
								<span class='caret'></span>
							</a>
							<div class='collapse show' id='keyword'>
								<ul class='nav nav-collapse'>
									<li class='"; echo ($activeItem=="search"?"active ": ""); echo"'>
										<a href='../keyword/searchKeywords.php'>
											<span class='sub-item'>Keyword Search</span>
										</a>
									</li>
									<li class='"; echo ($activeItem=="viewKeywords"?"active ": ""); echo"'>
										<a href='../keyword/viewKeywords.php'>
											<span class='sub-item'>View Keyword</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	";
}

function footer() {
	echo "
	<footer className='footer'>
	<div className='copyright'>
	  © 2019 Watermark Insights, LLC. All rights reserved.
	</div>

	<div className='footernav'>
	  <ul className='nobullets'>
		<li>
		  <a
			className='footerlink'
			href='https://www.watermarkinsights.com/terms/'
			target='_blank'
		  >
			Terms & Conditions
		  </a>
		</li>
		<li>
		  <a
			className='footerlink'
			href='https://www.watermarkinsights.com/privacy-policy/'
			target='_blank'
		  >
			Privacy Policy
		  </a>
		</li>
		<li>
		  <a
			className='footerlink'
			href='https://www.watermarkinsights.com/accessibility/'
			target='_blank'
		  >
			Accessibility Policy
		  </a>
		</li>
	  </ul>
	</div>
  </footer>
  ";
}
?>
