<div class="col-md-12 section-userinfo" data-ng-show="entryUser.user_id" data-ng-show="statusMenu.menu11">
	<div class="well well-sm well-default">
		<p><i class="fa fa-user text-indent"></i> ข้อมูลส่วนตัว</p>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-user text-indent"></i> ข้อมูลส่วนตัว
		</div>
		<div class="panel-body margin-top">
			<!--Main content-->
			<form name="userinfoForm" novalidate>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
								<span class="input-group-addon">อีเมล์</span>
								<input type="email" class="form-control next-focus" placeholder="กรอกอีเมล์" required validate-type validate-unique
									data-unique-table="user" data-unique-field="email" data-label-error="นี้ถูกใช้งานแล้ว"
									name="email" data-ng-model="entryUserinfo.email">
							</div>
						</div>
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
								<span class="input-group-addon">รหัสผ่าน</span>
								<input type="password" class="form-control next-focus" placeholder="กรอกรหัสผ่าน" required
									name="password" data-ng-model="entryUserinfo.password">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
								<span class="input-group-addon">ชื่อ</span>
								<input type="text" class="form-control next-focus" placeholder="กรอกชื่อ" required
									name="firstname" data-ng-model="entryUserinfo.firstname">
							</div>
						</div>
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
								<span class="input-group-addon">นามสกุล</span>
								<input type="text" class="form-control next-focus" placeholder="กรอกนามสกุล" required
									name="lastname" data-ng-model="entryUserinfo.lastname">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
								<span class="input-group-addon">หน่วยงาน</span>
								<select class="form-control next-focus" required
									name="department_id" data-ng-model="entryUserinfo.department_id">
									<option value="" selected disabled>เลือกหน่วยงาน</option>
									<option data-ng-repeat="item in departmentList" 
										value="{{ item.department_id }}">{{ item.department_name }}</option>
								</select>
							</div>
						</div>
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
								<span class="input-group-addon">ตำแหน่ง</span>
								<input type="text" class="form-control next-focus" placeholder="กรอกตำแหน่ง"
									name="position" data-ng-model="entryUserinfo.position">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
								<span class="input-group-addon">เบอร์โทรศัพท์</span>
								<input type="text" class="form-control next-focus" placeholder="กรอกเบอร์โทรศัพท์" numbered
									name="phone" data-ng-model="entryUserinfo.phone">
							</div>
						</div>
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
								<span class="input-group-addon">เบอร์ติดต่อภายใน</span>
								<input type="text" class="form-control next-focus" placeholder="กรอกเบอร์ติดต่อภายใน" required numbered
									name="local_phone" data-ng-model="entryUserinfo.local_phone">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 form-group text-right no-margin-bottom">
					<button class="btn btn-warning next-focus" type="button"
						data-ng-show="userPermission[10].perm_status == 'R/W' || userPermission[1].perm_status == 'ADMIN'"
						data-ng-disabled="userinfoForm.$invalid"
						data-ng-click="updateUserinfo()">
						<i class="fa fa-edit text-indent"></i> บันทึกการเปลี่ยนแปลง
					</button>
					<button class="btn btn-cancel next-focus" type="button" 
						data-ng-click="resetEntry('entryUserinfo')">
						<i class="fa fa-trash text-indent"></i> ล้างข้อมูล
					</button>
				</div>
			</form>
		</div>
	</div>
</div>