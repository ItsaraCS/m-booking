<div class="col-md-12 section-login">
	<div class="well well-sm well-default">
		<p><i class="fa fa-lock text-indent"></i> เข้าสู่ระบบ</p>
	</div>
	<div class="panel panel-default">
		<div class="panel-body margin-top">
			<div class="col-md-6 col-center">
				<div class="panel panel-default">
					<div class="panel-heading text-center">
						<i class="fa fa-lock text-indent"></i> เข้าสู่ระบบ
					</div>
					<div class="panel-body">
						<div class="col-md-12">
							<form name="loginForm" novalidate="">
								<div class="row col-block">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">อีเมล์</span>
											<input type="text" class="form-control" placeholder="กรอกอีเมล์" required
												data-ng-model="entryLogin.email">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">รหัสผ่าน</span>
											<input type="text" class="form-control" placeholder="กรอกรหัสผ่าน" required
												data-ng-model="entryLogin.password">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="text-right">
										<span class="info login-info"></span>
										<button class="btn btn-confirm" type="button"
											data-ng-disabled="loginForm.$invalid"
											data-ng-click="login()">
											<i class="fa fa-key text-indent"></i> เข้าสู่ระบบ
										</button>
										<button class="btn btn-cancel" type="button"
											data-ng-click="resetEntry('entryLogin')">
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