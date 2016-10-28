<!DOCTYPE html>
<html lang="en" data-ng-app="mainApp">
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="title" content="ระบบจองห้องประชุมออนไลน์ (m-Booking)">
	<title>ระบบจองห้องประชุมออนไลน์ (m-Booking)</title>
	<!--Bootstrap CSS File-->
	<?php echo library_asset('bootstrap', 'bootstrap.css'); ?>
	<!--FontAwesome CSS File-->
	<?php echo library_asset('fontawesome'); ?>
	<!--Custom CSS File-->
	<link href="<?php echo image_asset('logo.png'); ?>" rel="shortcut icon" type="image/x-icon">
	<?php echo file_asset('style.css'); ?>
	<?php echo file_asset('accordian.css'); ?>
</head>
<body>
	<div class="container-fluid">
		<div class="row header">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-9">
						<div class="row">
							<div class="col-md-1 header-logo">
								<div class="thumbnail no-margin-bottom center-block">
									<img src="<?php echo image_asset('logo.png'); ?>" class="img-responsive">
								</div>
							</div>
							<div class="col-md-11 header-title">
								<div class="row">
									<p class="no-margin-bottom">
										ระบบจองห้องประชุมออนไลน์ (m-Booking)
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3 header-userlogin">
						<div class="row text-right">
							<p class="no-margin-bottom">
								<i class="fa fa-user text-indent"></i> เข้าสู่ระบบโดย<i class="text-indent"></i>
								<i class="fa fa-angle-double-right text-indent"></i> Admin
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="row header-line"></div>
			</div>
		</div>
		<div class="row content">
			<div class="col-md-2 aside">
				<div class="row">
					<div id="accordian">
					  	<ul>
					  		<li>
					      		<h3><span class="fa fa-user-circle"></span>สมาชิก</h3>
						      	<ul>
							        <li active-menu><a href="#/"><i class="fa fa-lock text-indent"></i> เข้าสู่ระบบ</a></li>
							        <li active-menu><a href="#/"><i class="fa fa-user text-indent"></i> สมัครสมาชิกใหม่</a></li>
							        <li active-menu><a href="#/"><i class="fa fa-power-off text-indent"></i> ออกจากระบบ</a></li>
						      	</ul>
					    	</li>
					    	<li class="active">
					      		<h3><span class="fa fa-address-book"></span>รายการจองห้องประชุม</h3>
					      		<ul>
							        <li active-menu><a href="#/"><i class="fa fa-file-text text-indent"></i> หน้าแรก</a></li>
							        <li active-menu><a href="#/instructions"><i class="fa fa-question-circle text-indent"></i> คำแนะการการใช้งานระบบ</a></li>
							        <li active-menu><a href="#/"><i class="fa fa-plus-square text-indent"></i> จองห้องประชุม</a></li>
							        <li active-menu><a href="#/"><i class="fa fa-desktop text-indent"></i> ตารางใช้ห้องประชุมวันนี้</a></li>
							        <li active-menu><a href="#/"><i class="fa fa-calendar text-indent"></i> ปฏิทินการใช้ห้องประชุม</a></li>
							        <li active-menu><a href="#/"><i class="fa fa-search text-indent"></i> ค้นหาข้อมูลการจอง/พิมพ์</a></li>
					      		</ul>
					    	</li>
					    	<li>
					      		<h3><span class="fa fa-book"></span>เกี่ยวกับห้องประชุม</h3>
						      	<ul>
							        <li active-menu><a href="#/"><i class="fa fa-book text-indent"></i> รายละเอียดห้องประชุม</a></li>
							        <li active-menu><a href="#/"><i class="fa fa-bar-chart text-indent"></i> สถิติ แยกตามห้องประชุม</a></li>
							        <li active-menu><a href="#/"><i class="fa fa-bar-chart text-indent"></i> สถิติ แยกตามหน่วยงาน</a></li>
						      	</ul>
					    	</li>
					  	</ul>
					</div>
				</div>
			</div>
			<div class="col-md-2 aside-resize">
				<div class="row">
					<nav class="navbar navbar-default">
						<div class="container-fluid">
							<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
								data-target="#menu-resize">
						        <span class="sr-only">Toggle navigation</span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						 	</button>
					    </div>
					    <div class="collapse navbar-collapse" id="menu-resize">
					      	<ul class="nav navbar-nav">
					        	<li class="active dropdown">
									<a href="" class="dropdown-toggle" data-toggle="dropdown">
										<i class="fa fa-user-circle text-indent"></i> สมาชิก <span class="caret"></span>
									</a>
									<ul class="dropdown-menu">
										<li><a href="#/"><i class="fa fa-lock text-indent"></i> เข้าสู่ระบบ</a></li>
										<li><a href="#/"><i class="fa fa-user text-indent"></i> สมัครสมาชิกใหม่</a></li>
										<li><a href="#/"><i class="fa fa-power-off text-indent"></i> ออกจากระบบ</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a href="" class="dropdown-toggle" data-toggle="dropdown">
										<i class="fa fa-address-book text-indent"></i> รายการจองห้องประชุม <span class="caret"></span>
									</a>
									<ul class="dropdown-menu">
										<li><a href="#/"><i class="fa fa-file-text text-indent"></i> หน้าแรก</a></li>
								        <li><a href="#/instructions"><i class="fa fa-question-circle text-indent"></i> คำแนะการการใช้งานระบบ</a></li>
								        <li><a href="#/"><i class="fa fa-plus-square text-indent"></i> จองห้องประชุม</a></li>
								        <li><a href="#/"><i class="fa fa-desktop text-indent"></i> ตารางใช้ห้องประชุมวันนี้</a></li>
								        <li><a href="#/"><i class="fa fa-calendar text-indent"></i> ปฏิทินการใช้ห้องประชุม</a></li>
								        <li><a href="#/"><i class="fa fa-search text-indent"></i> ค้นหาข้อมูลการจอง/พิมพ์</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a href="" class="dropdown-toggle" data-toggle="dropdown">
										<i class="fa fa-book text-indent"></i> เกี่ยวกับห้องประชุม <span class="caret"></span>
									</a>
									<ul class="dropdown-menu">
										<li><a href="#/"><i class="fa fa-book text-indent"></i> รายละเอียดห้องประชุม</a></li>
							        	<li><a href="#/"><i class="fa fa-bar-chart text-indent"></i> สถิติ แยกตามห้องประชุม</a></li>
							        	<li><a href="#/"><i class="fa fa-bar-chart text-indent"></i> สถิติ แยกตามหน่วยงาน</a></li>
									</ul>
								</li>
					      	</ul>
						</div>
					</nav>
				</div>
			</div>
			<div class="col-md-10 section">
				<div class="row">
					<span data-ng-view>