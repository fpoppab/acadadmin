<?php $this->load->view("layout/meta"); ?>

<body data-bs-theme="<?php echo $this->session->userdata("userTheme"); ?>">
	<!-- <script src="./tabler/js/demo-theme.min.js?1684106062"></script> -->
	<div class="page">
		<!-- Navbar -->
		<header class="navbar navbar-expand-md d-print-none">
			<div class="container-xl">
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
					aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
					<a href="<?php echo site_url("/"); ?>">
						<img src="<?php echo base_url(); ?>/resource/icon.png" width="150" alt="Tabler"
							class="navbar-brand-image">
					</a>
				</h1>
				<div class="navbar-nav flex-row order-md-last">


					<?php $this->load->view("layout/headerLayout/edyearsemester"); ?>

					<a href="<?php echo site_url("set_theme/dark"); ?>" class="nav-link px-0 hide-theme-dark"
						title="Enable dark mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
						<i class="ti ti-moon"></i>
					</a>

					<a href="<?php echo site_url("set_theme/light"); ?>" class="nav-link px-0 hide-theme-light"
						title="Enable light mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
						<i class="ti ti-sun"></i>
					</a>
					<?php // $this->load->view("layout/headerLayout/notification"); ?>

					<div class="nav-item dropdown">
						<a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
							aria-label="Open user menu">
							<?php //echo '<img src="data:image/png;base64,'..'"/>';?>
							<?php //echo $this->session->userdata("userImage") ?>
							<span class="avatar avatar-sm"
								style="background-image: url('<?php echo $this->session->userdata("userImage") ?>');"></span>
							<div class="d-none d-xl-block ps-2">
								<div>
									<?php echo $this->session->userdata("userName") ?>
								</div>
								<div class="mt-1 small text-muted">
									<?php echo $this->session->userdata("userType") ?>
								</div>
							</div>
						</a>
						<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
							<a href="<?php echo site_url("activity"); ?>" id="menu-status"
								class="dropdown-item">Activity</a>
							<a href="<?php echo site_url("profile"); ?>" id="menu-profile"
								class="dropdown-item">Profile</a>
							<div class="dropdown-divider"></div>
							<a href="#" id="menu-logout" class="dropdown-item text-red">Logout</a>
						</div>
					</div>
				</div>
			</div>
		</header>
		<header class="navbar-expand-md">
			<div class="collapse navbar-collapse" id="navbar-menu">
				<div class="navbar">
					<div class="container-xl">
						<ul class="navbar-nav">
							<li class="nav-item active">
								<a class="nav-link" href="<?php echo site_url("/"); ?>">
									<span class="nav-link-icon d-md-none d-lg-inline-block">
										<i class="ti ti-home"></i>
									</span>
									<span class="nav-link-title">
										Home
									</span>
								</a>
							</li>

							<?php $this->load->view("layout/headerLayout/adminMenu"); ?>
						</ul>
					</div>
				</div>
			</div>
		</header>
		<div class="page-wrapper">