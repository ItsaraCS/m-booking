<div class="col-md-12 section-register">
	<div class="well well-sm well-default">
		<p><i class="fa fa-refresh text-indent"></i> สมัครสมาชิกใหม่</p>
	</div>
	<div class="panel panel-default">
		<div class="panel-body margin-top">
			<div class="col-md-10 col-center">
				<div class="panel panel-default">
					<div class="panel-heading text-center">
						<i class="fa fa-refresh text-indent"></i> สมัครสมาชิกใหม่
					</div>
					<div class="panel-body">
						<div class="col-md-12">
							<form name="registerForm" novalidate="">
								<div class="row col-block">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">อีเมล์</span>
											<input type="text" class="form-control" placeholder="กรอกอีเมล์" required
												data-ng-model="entryRegister.email">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">รหัสผ่าน</span>
											<input type="password" class="form-control" placeholder="กรอกรหัสผ่าน" required
												data-ng-model="entryRegister.password">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">ชื่อ</span>
											<input type="text" class="form-control" placeholder="กรอกชื่อ" required
												data-ng-model="entryRegister.firstname">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">นามสกุล</span>
											<input type="text" class="form-control" placeholder="กรอกนามสกุล" required
												data-ng-model="entryRegister.lastname">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">หน่วยงาน</span>
											<select class="form-control" required
												data-ng-model="entryRegister.department">
												<option value="" selected disabled>เลือกหน่วยงาน</option>
												<option data-ng-repeat="item in departmentList" 
													value="{{ item.department_id }}">{{ item.department_name }}</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">ตำแหน่ง</span>
											<input type="text" class="form-control" placeholder="กรอกตำแหน่ง"
												data-ng-model="entryRegister.position">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">เบอร์โทรศัพท์ (มือถือ)</span>
											<input type="text" class="form-control" placeholder="กรอกเบอร์โทรศัพท์(มือถือ)"
												data-ng-model="entryRegister.phone">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">เบอร์ติดต่อภายใน</span>
											<input type="text" class="form-control" placeholder="กรอกเบอร์ติดต่อภายใน" required
												data-ng-model="entryRegister.local_phone">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="text-right">
										<span class="info register-info"></span>
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
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>