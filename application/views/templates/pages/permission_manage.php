<div class="col-md-12 section-permission-manage" data-ng-show="entryUser.user_id">
	<div class="well well-sm well-default">
		<ol class="breadcrumb">
			<li>
				<a data-ui-sref="ตั้งค่าสิทธิ์การใช้งาน(previousParams)"><i class="fa fa-cog text-indent"></i> ตั้งค่าสิทธิ์การใช้งาน</a>
			</li>
			<li class="active">จัดการตั้งค่าสิทธิ์การใช้งาน</li>
		</ol>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-user text-indent"></i> จัดการตั้งค่าสิทธิ์การใช้งาน
		</div>
		<div class="panel-body margin-top">
			<!--Main content-->
			<div class="col-md-12">
				<table class="table table-striped table-bordered">
					<thead class="table-head-color">
						<th colspan="4">
							<i class="fa fa-user text-indent"></i> ข้อมูลผู้ใช้ระบบ
						</th>
					</thead>
					<tbody>
						<tr>
							<td class="col-md-2">
								<i class="fa fa-caret-right text-indent"></i> ชื่อ - นามสกุล
							</td>
							<td class="col-md-4">{{ entryUserData.firstname }} {{ entryUserData.lastname }}</td>
							<td class="col-md-2">
								<i class="fa fa-caret-right text-indent"></i> อีเมล์
							</td>
							<td class="col-md-4">{{ entryUserData.email }}</td>
						</tr>
						<tr>
							<td class="col-md-2">
								<i class="fa fa-caret-right text-indent"></i> หน่วยงาน
							</td>
							<td class="col-md-4">{{ entryUserData.department_name }}</td>
							<td class="col-md-2">
								<i class="fa fa-caret-right text-indent"></i> ตำแหน่ง
							</td>
							<td class="col-md-4">{{ entryUserData.position }}</td>
						</tr>
						<tr>
							<td class="col-md-2">
								<i class="fa fa-caret-right text-indent"></i> เบอร์โทรศัพท์
							</td>
							<td class="col-md-4">{{ entryUserData.phone }}</td>
							<td class="col-md-2">
								<i class="fa fa-caret-right text-indent"></i> เบอร์ติดต่อภายใน
							</td>
							<td class="col-md-4">{{ entryUserData.local_phone }}</td>
						</tr>
					</tbody>
				</table>
			</div>

			<form name="permissionManageForm" novalidate data-ng-if="entryUserPermissionData.length != 0">
				<div class="col-md-12 table-responsive">
					<table class="table table-striped table-bordered">
						<thead class="table-head-color">
							<th class="text-center">เมนูหลัก</th>
							<th class="text-center">เมนูย่อย</th>
							<th class="text-center">ตั้งค่าสิทธิ์การใช้งาน</th>
						</thead>
						<tbody>
							<tr>
								<td rowspan="6" class="col-md-3 active text-center vertical-center">รายงานการจองห้องประชุม</td>
							</tr>
							<tr data-ng-repeat="permissionItem in entryUserPermissionData | limitTo: 5">
								<td class="col-md-5 vertical-center">{{ permissionItem.menu_sub_name }}</td>
								<td class="col-md-4">
									<select class="form-control" required
										data-ng-model="entryUserPermissionData[$index].permission_status_id">
										<option value="" selected disabled>เลือกสิทธิ์การใช้งาน</option>
										<option data-ng-repeat="item in permissionStatusList"
											value="{{ item.permission_status_id }}">{{ item.permission_status_name }}</option>
									</select>
								</td>
							</tr>
							<tr></tr>
							<tr>
								<td rowspan="4" class="col-md-3 active text-center vertical-center">เกี่ยวกับห้องประชุม</td>
							</tr>
							<tr data-ng-repeat="permissionItem in entryUserPermissionData | limitTo: 8" data-ng-if="$index >= 5">
								<td class="col-md-5 vertical-center">{{ permissionItem.menu_sub_name }}</td>
								<td class="col-md-4">
									<select class="form-control" required
										data-ng-model="entryUserPermissionData[$index].permission_status_id">
										<option value="" selected disabled>เลือกสิทธิ์การใช้งาน</option>
										<option data-ng-repeat="item in permissionStatusList"
											value="{{ item.permission_status_id }}">{{ item.permission_status_name }}</option>
									</select>
								</td>
							</tr>
							<tr>
								<td rowspan="5" class="col-md-3 active text-center vertical-center">ผู้ใช้ระบบ</td>
							</tr>
							<tr data-ng-repeat="permissionItem in entryUserPermissionData | limitTo: all" data-ng-if="$index >= 8">
								<td class="col-md-5 vertical-center">{{ permissionItem.menu_sub_name }}</td>
								<td class="col-md-4">
									<select class="form-control" required
										data-ng-model="entryUserPermissionData[$index].permission_status_id">
										<option value="" selected disabled>เลือกสิทธิ์การใช้งาน</option>
										<option data-ng-repeat="item in permissionStatusList"
											value="{{ item.permission_status_id }}">{{ item.permission_status_name }}</option>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-md-12 form-group text-right no-margin-bottom">
					<span class="info permission-manage-info"></span>
					<button class="btn btn-warning" type="button" 
						data-ng-disabled="permissionManageForm.$invalid"
						data-ng-click="updateUserPermission()">
						<i class="fa fa-cog text-indent"></i> บันทึกการเปลี่ยนแปลง
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--Popup File-->
<?php
	$this->load->view('templates/popups/warning_popup');
?>