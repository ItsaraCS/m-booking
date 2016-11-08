<!DOCTYPE html>
<html lang="en" data-ng-app="mainApp">
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="title" content="ระบบจองห้องประชุมออนไลน์ EIAMHENG">
	<title>ระบบจองห้องประชุมออนไลน์ EIAMHENG</title>
	<!--<base href="<?php echo base_url(); ?>">-->
	<!--jQuery JavaScript File-->
	<?php echo library_asset('jquery'); ?>
	<!--Bootstrap CSS & JavaScript File-->
	<?php echo library_asset('bootstrap', 'bootstrap.css'); ?>
	<?php echo library_asset('bootstrap', 'bootstrap.min.js'); ?>
	<!--FontAwesome CSS File-->
	<?php echo library_asset('fontawesome'); ?>
	<!--AngularJS JavaScript File-->
	<?php echo library_asset('angularjs'); ?>
	<?php echo library_asset('angularjs', 'angular-route.min.js'); ?>
	<?php echo library_asset('angularjs', 'angular-ui-router.js'); ?>
	<?php echo library_asset('app'); ?>
	<!--FullCalendar File-->
	<?php echo library_asset('fullcalendar', 'lib/moment.min.js'); ?>
	<?php echo library_asset('fullcalendar'); ?>
	<?php echo library_asset('fullcalendar', 'locale/th.js'); ?>
	<!--Custom CSS File-->
	<link href="<?php echo image_asset('logo.png'); ?>" rel="shortcut icon" type="image/x-icon">
	<?php echo file_asset('style.css'); ?>
	<?php echo file_asset('accordian.css'); ?>
	<!--Custom JavaScript File-->
	<?php echo file_asset('script.js'); ?>
</head>
<body>
	<div class="container-fluid" data-ng-controller="mainController as mainCtrl">
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
										ระบบจองห้องประชุมออนไลน์ EIAMHENG
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3 header-userlogin" data-ng-show="entryUser.user_id">
						<div class="row text-right">
							<p class="no-margin-bottom">
								<i class="fa fa-user text-indent"></i> เข้าสู่ระบบโดย<i class="text-indent"></i>
								<i class="fa fa-angle-double-right text-indent"></i> {{ entryUser.firstname }}<i class="text-indent"></i>
							</p>
							<button class="btn btn-logout logout-btn" type="button" title="ออกจากระบบ"
								data-ng-click="logout()">
								<i class="fa fa-power-off"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="row header-line"></div>
			</div>
		</div>
		<div class="row content">
			<div class="col-md-3 col-lg-2 aside">
				<div class="row">
					<div id="accordian">
					  	<ul>
					    	<li class="active">
					      		<h3><span class="fa fa-address-book"></span>รายการจองห้องประชุม</h3>
					      		<ul>
							        <li active-menu>
							        	<a data-ui-sref="ปฏิทินการใช้ห้องประชุม" data-menu-index="0"><i class="fa fa-calendar text-indent"></i> ปฏิทินการใช้ห้องประชุม</a>
							        </li>
							        <li active-menu data-ng-show="entryUser.user_id">
							        	<a data-ui-sref="จองห้องประชุม" data-menu-index="1"><i class="fa fa-plus-square text-indent"></i> จองห้องประชุม</a>
							        </li>
							        <li active-menu data-ng-show="entryUser.user_id">
							        	<a data-ui-sref="ยกเลิกการจอง" data-menu-index="2"><i class="fa fa-ban text-indent"></i> ยกเลิกการจอง</a>
							        </li>
							        <li active-menu>
							        	<a data-ui-sref="ค้นหาข้อมูลการจอง" data-menu-index="3"><i class="fa fa-search text-indent"></i> ค้นหาข้อมูลการจอง</a>
							        </li>
							        <li active-menu data-ng-show="entryUser.user_id && (userPermissionData[4].perm_status == 'R/W')">
							        	<a data-ui-sref="จัดการสถานะการจอง" data-menu-index="4"><i class="fa fa-toggle-on text-indent"></i>จัดการสถานะการจอง</a>
							        </li>
					      		</ul>
					    	</li>
					    	<li>
					      		<h3><span class="fa fa-book"></span>เกี่ยวกับห้องประชุม</h3>
						      	<ul>
							        <li active-menu>
							        	<a data-ui-sref="รายละเอียดห้องประชุม" data-menu-index="5"><i class="fa fa-eye text-indent"></i> รายละเอียดห้องประชุม</a>
							        </li>
							        <li active-menu data-ng-show="entryUser.user_id">
							        	<a data-ui-sref="รายงานการจอง" data-menu-index="6"><i class="fa fa-bar-chart text-indent"></i> รายงานการจอง</a>
							        </li>
							        <li active-menu>
							        	<a data-ui-sref="คำแนะนำการใช้งานระบบ" data-menu-index="7"><i class="fa fa-question-circle text-indent"></i> คำแนะนำการใช้งานระบบ</a>
							        </li>
						      	</ul>
					    	</li>
					    	<li>
					      		<h3><span class="fa fa-user-circle"></span>ผู้ใช้ระบบ</h3>
						      	<ul>
							        <li active-menu data-ng-show="!entryUser.user_id">
							        	<a data-ui-sref="เข้าสู่ระบบ" data-menu-index="8"><i class="fa fa-lock text-indent"></i> เข้าสู่ระบบ</a>
							        </li>
							        <li active-menu data-ng-show="!entryUser.user_id">
							        	<a data-ui-sref="สมัครสมาชิก" data-menu-index="9"><i class="fa fa-refresh text-indent"></i> สมัครสมาชิก</a>
							        </li>
							        <li active-menu data-ng-show="entryUser.user_id">
							        	<a data-ui-sref="ข้อมูลส่วนตัว" data-menu-index="10"><i class="fa fa-user text-indent"></i> ข้อมูลส่วนตัว</a>
							        </li>
							        <li active-menu data-ng-show="entryUser.user_id && (userPermissionData[4].perm_status == 'R/W')">
							        	<a data-ui-sref="ตั้งค่าสิทธิ์การใช้งาน" data-menu-index="11"><i class="fa fa-cog text-indent"></i> ตั้งค่าสิทธิ์การใช้งาน</a>
							        </li>
						      	</ul>
					    	</li>
					  	</ul>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-lg-2 aside-resize">
				<div class="row">
					<nav class="navbar navbar-default">
						<div class="container-fluid">
							<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
								data-target="#accordian-resize">
						        <span class="sr-only">Toggle navigation</span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						 	</button>
					    </div>
					    <div class="collapse navbar-collapse" id="accordian-resize">
					      	<ul class="nav navbar-nav">
					        	<li class="active dropdown">
									<a href="" class="dropdown-toggle" data-toggle="dropdown">
										<i class="fa fa-address-book text-indent"></i> รายการจองห้องประชุม <span class="caret"></span>
									</a>
									<ul class="dropdown-menu">
										<li>
								        	<a data-ui-sref="ปฏิทินการใช้ห้องประชุม" data-menu-index="0"><i class="fa fa-calendar text-indent"></i> ปฏิทินการใช้ห้องประชุม</a>
								        </li>
								        <li data-ng-show="entryUser.user_id">
								        	<a data-ui-sref="จองห้องประชุม" data-menu-index="1"><i class="fa fa-plus-square text-indent"></i> จองห้องประชุม</a>
								        </li>
								        <li active-menu data-ng-show="entryUser.user_id">
								        	<a data-ui-sref="ยกเลิกการจอง" data-menu-index="2"><i class="fa fa-ban text-indent"></i> ยกเลิกการจอง</a>
								        </li>
								        <li>
								        	<a data-ui-sref="ค้นหาข้อมูลการจอง" data-menu-index="3"><i class="fa fa-search text-indent"></i> ค้นหาข้อมูลการจอง</a>
								        </li>
								        <li data-ng-show="entryUser.user_id && (userPermissionData[4].perm_status == 'R/W')">
								        	<a data-ui-sref="จัดการสถานะการจอง" data-menu-index="4"><i class="fa fa-toggle-on text-indent"></i>จัดการสถานะการจอง</a>
								        </li>
									</ul>
								</li>
								<li class="dropdown">
									<a href="" class="dropdown-toggle" data-toggle="dropdown">
										<i class="fa fa-book text-indent"></i> เกี่ยวกับห้องประชุม <span class="caret"></span>
									</a>
									<ul class="dropdown-menu">
										<li>
								        	<a data-ui-sref="รายละเอียดห้องประชุม" data-menu-index="5"><i class="fa fa-eye text-indent"></i> รายละเอียดห้องประชุม</a>
								        </li>
								        <li data-ng-show="entryUser.user_id">
								        	<a data-ui-sref="รายงานการจอง" data-menu-index="6"><i class="fa fa-bar-chart text-indent"></i> รายงานการจอง</a>
								        </li>
								        <li>
								        	<a data-ui-sref="คำแนะนำการใช้งานระบบ" data-menu-index="7"><i class="fa fa-question-circle text-indent"></i> คำแนะนำการใช้งานระบบ</a>
								        </li>
									</ul>
								</li>
								<li class="dropdown">
									<a href="" class="dropdown-toggle" data-toggle="dropdown">
										<i class="fa fa-user-circle text-indent"></i> ผู้ใช้ระบบ <span class="caret"></span>
									</a>
									<ul class="dropdown-menu">
										<li data-ng-show="!entryUser.user_id">
								        	<a data-ui-sref="เข้าสู่ระบบ" data-menu-index="8"><i class="fa fa-lock text-indent"></i> เข้าสู่ระบบ</a>
								        </li>
								        <li data-ng-show="!entryUser.user_id">
								        	<a data-ui-sref="สมัครสมาชิก" data-menu-index="9"><i class="fa fa-refresh text-indent"></i> สมัครสมาชิก</a>
								        </li>
								        <li data-ng-show="entryUser.user_id">
								        	<a data-ui-sref="ข้อมูลส่วนตัว" data-menu-index="10"><i class="fa fa-user text-indent"></i> ข้อมูลส่วนตัว</a>
								        </li>
								        <li data-ng-show="entryUser.user_id && (userPermissionData[4].perm_status == 'R/W')">
								        	<a data-ui-sref="ตั้งค่าสิทธิ์การใช้งาน" data-menu-index="11"><i class="fa fa-cog text-indent"></i> ตั้งค่าสิทธิ์การใช้งาน</a>
								        </li>
									</ul>
								</li>
					      	</ul>
						</div>
					</nav>
				</div>
			</div>
			<div class="col-md-9 col-lg-10 section">
				<div class="row">
					<span data-ui-view>