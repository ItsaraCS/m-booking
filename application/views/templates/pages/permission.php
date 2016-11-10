<div class="col-md-12 section-permission" data-ng-show="entryUser.user_id">
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
						<table class="table table-striped table-bordered no-margin-bottom">
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
										<a class="btn btn-sm btn-permission" title="จัดการตั้งค่าสิทธิ์การใช้งาน" 
											href="#/permission_manage/{{ item.user_id }}">
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
				<div class="col-md-12" data-ng-if="searchUserData.length">
					<nav class="text-right">
					  	<ul class="pagination margin-top no-margin-bottom">
						    <li active-pagination value="prev">
						      	<a data-ng-click="getUserDataPerPage(1)" aria-label="Previous">
						        	<span aria-hidden="true">&laquo;</span>
						      	</a>
						    </li>
							<li data-ng-repeat="item in totalPageList" active-pagination value="{{ item.permissionPage }}" 
								data-ng-class="item.permissionPage == permissionPage ? 'active' : ''">
						    	<a data-ui-sref="ตั้งค่าสิทธิ์การใช้งาน({ 
						    		'permissionPage': '{{ item.permissionPage }}', 
						    		'firstname': '{{ item.firstname }}', 
						    		'email': '{{ item.email }}' })">
						    		{{ item.permissionPage }}
						    	</a>
						    </li>
						    <li active-pagination value="next">
						      	<a data-ng-click="getUserDataPerPage(totalPage)" aria-label="Next">
						        	<span aria-hidden="true">&raquo;</span>
						      	</a>
						    </li>
					  	</ul>
					</nav>
				</div>
			</form>
		</div>
	</div>
</div>
<!--Popup File-->
<?php
	$this->load->view('templates/popups/warning_popup');
?>