<div class="col-md-12 section-login">
	<div class="well well-sm well-default">
		<p><i class="fa fa-lock text-indent"></i> เข้าสู่ระบบ</p>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="col-md-6 col-center">
				<div class="panel panel-default no-margin-bottom">
					<div class="panel-heading text-center">
						<i class="fa fa-lock text-indent"></i> เข้าสู่ระบบ
					</div>
					<div class="panel-body">
						<!--Main content-->
						<form name="loginForm" novalidate>
							<div class="col-md-12">
								<div class="row">
									<div class="form-group col-inline">
										<div class="input-group">
											<span class="input-group-addon">อีเมล์</span>
											<input type="email" class="form-control" placeholder="กรอกอีเมล์" required validate-type
												name="email" data-ng-model="entryLogin.email">
										</div>
									</div>
									<div class="form-group col-inline">
										<div class="input-group">
											<span class="input-group-addon">รหัสผ่าน</span>
											<input type="text" class="form-control" placeholder="กรอกรหัสผ่าน" required
												name="password" data-ng-model="entryLogin.password">
										</div>
									</div>
								</div>
							</div>
							<div class="form-group text-right no-margin-bottom">
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
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--Popup File-->
<?php
	$this->load->view('templates/popups/warning_popup');
?>