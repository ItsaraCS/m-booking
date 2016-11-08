<div class="col-md-12 section-register">
	<div class="well well-sm well-default">
		<p><i class="fa fa-refresh text-indent"></i> สมัครสมาชิก</p>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-refresh text-indent"></i> สมัครสมาชิก
		</div>
		<div class="panel-body margin-top">
			<!--Main content-->
			<form name="registerForm" novalidate>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
								<span class="input-group-addon">อีเมล์</span>
								<input type="email" class="form-control" placeholder="กรอกอีเมล์" required validate-type validate-unique
									data-unique-table="user" data-unique-field="email" data-label-error="นี้ถูกใช้งานแล้ว"
									name="email" data-ng-model="entryRegister.email">
							</div>
						</div>
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
								<span class="input-group-addon">รหัสผ่าน</span>
								<input type="password" class="form-control" placeholder="กรอกรหัสผ่าน" required
									name="password" data-ng-model="entryRegister.password">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
								<span class="input-group-addon">ชื่อ</span>
								<input type="text" class="form-control" placeholder="กรอกชื่อ" required
									name="firstname" data-ng-model="entryRegister.firstname">
							</div>
						</div>
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
								<span class="input-group-addon">นามสกุล</span>
								<input type="text" class="form-control" placeholder="กรอกนามสกุล" required
									name="lastname" data-ng-model="entryRegister.lastname">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
								<span class="input-group-addon">หน่วยงาน</span>
								<select class="form-control" required
									name="department_id" data-ng-model="entryRegister.department_id">
									<option value="" selected disabled>เลือกหน่วยงาน</option>
									<option data-ng-repeat="item in departmentList" 
										value="{{ item.department_id }}">{{ item.department_name }}</option>
								</select>
							</div>
						</div>
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
								<span class="input-group-addon">ตำแหน่ง</span>
								<input type="text" class="form-control" placeholder="กรอกตำแหน่ง"
									name="position" data-ng-model="entryRegister.position">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
								<span class="input-group-addon">เบอร์โทรศัพท์</span>
								<input type="text" class="form-control" placeholder="กรอกเบอร์โทรศัพท์" numbered
									name="phone" data-ng-model="entryRegister.phone">
							</div>
						</div>
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
								<span class="input-group-addon">เบอร์ติดต่อภายใน</span>
								<input type="text" class="form-control" placeholder="กรอกเบอร์ติดต่อภายใน" required numbered
									name="local_phone" data-ng-model="entryRegister.local_phone">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 form-group text-right no-margin-bottom">
					<button class="btn btn-confirm" type="button" 
						data-ng-disabled="registerForm.$invalid"
						data-ng-click="register()">
						<i class="fa fa-refresh text-indent"></i> สมัครสมาชิก
					</button>
					<button class="btn btn-cancel" type="button" 
						data-ng-click="resetEntry('entryRegister')">
						<i class="fa fa-trash text-indent"></i> ล้างข้อมูล
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