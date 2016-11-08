<div class="col-md-12 section-permission">
	<div class="well well-sm well-default">
		<p><i class="fa fa-cog text-indent"></i> ตั้งค่าสิทธิ์การใช้งาน</p>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-bars text-indent"></i> ตั้งค่าสิทธิ์การใช้งาน
		</div>
		<div class="panel-body margin-top">
			<!--Main content-->
			<form name="searchUserForm" novalidate>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
							  	<span class="input-group-addon">ชื่อ</span>
							  	<input type="text" class="form-control"
							  		name="firstname" data-ng-model="entrySearchUser.firstname">
							</div>
						</div>
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
							  	<span class="input-group-addon">อีเมล์</span>
							  	<input type="email" class="form-control" validate-type
							  		name="email" data-ng-model="entrySearchUser.email">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 form-group text-right">
					<button class="btn btn-search" type="button" 
						data-ng-disabled="searchUserForm.$invalid"
						data-ng-click="searchUser()">
		        		<i class="fa fa-search text-indent"></i> ค้นหา
		        	</button>
				</div>
			</form>

			<!--Sub content-->
			<form name="userForm" novalidate>
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead class="table-head-color">
								<th class="text-center text-nowrap">ชื่อ - นามสกุล</th>
								<th class="text-center text-nowrap">อีเมล์</th>
								<th class="text-center text-nowrap">หน่วยงาน</th>
								<th class="text-center text-nowrap">ดำเนินการ</th>
							</thead>
							<tbody>
								<tr data-ng-repeat="item in userData">
									<td class="col-md-3 vertical-center">{{ item.firstname }} {{ item.lastname }}</td>
									<td class="col-md-4 vertical-center">{{ item.email }}</td>
									<td class="col-md-3 vertical-center">{{ item.department_name }}</td>
									<td class="col-md-2 vertical-center text-center">
										<a class="btn btn-sm btn-permission" title="จัดการตั้งค่าสิทธิ์การใช้งาน" data-ui-sref="จัดการตั้งค่าสิทธิ์การใช้งาน">
											<i class="glyphicon glyphicon-cog"></i>
										</a>
										<button class="btn btn-sm btn-cancel" type="button" title="ลบ">
											<i class="glyphicon glyphicon-trash"></i>
										</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!--Popup File-->
<?php
	$this->load->view('templates/popups/warning_popup');
?>