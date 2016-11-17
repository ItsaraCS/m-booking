<div class="col-md-12 section-booking" data-ng-show="statusMenu.menu2">
	<div class="well well-sm well-default">
		<p data-ng-show="currentLocation == '/booking_add'">
			<i class="fa fa-plus-square text-indent"></i> จองห้องประชุม
		</p>
		<ol class="breadcrumb" data-ng-show="currentLocation == '/booking_edit/'">
			<li>
				<a data-ui-sref="ค้นหาข้อมูลการจอง(previousParams)"><i class="fa fa-search text-indent"></i> ค้นหาข้อมูลการจอง</a>
			</li>
			<li class="active">แก้ไขรายการจอง</li>
		</ol>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading" data-ng-show="currentLocation == '/booking_add'">
			<i class="fa fa-bars text-indent"></i> จองห้องประชุม
		</div>
		<div class="panel-heading" data-ng-show="currentLocation == '/booking_edit/'">
			<i class="fa fa-bars text-indent"></i> แก้ไขรายการจอง
		</div>
		<div class="panel-body margin-top">
			<!--Main content-->
			<form name="bookingForm" novalidate>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
							  	<span class="input-group-addon">ห้องประชุม</span>
							  	<select class="form-control next-focus" required
							  		name="meeting_room_id" data-ng-model="entryBooking.meeting_room_id">
							  		<option value="" selected disabled>เลือกห้องประชุม</option>
								    <option data-ng-repeat="item in meetingRoomList"
								    	value="{{ item.meeting_room_id }}">{{ item.meeting_room_name }}</option>
								</select>
							</div>
						</div>
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
							  	<span class="input-group-addon">ประเภทการประชุม</span>
							  	<select class="form-control next-focus" required
							  		name="meeting_type_id" data-ng-model="entryBooking.meeting_type_id">
								    <option value="" selected disabled>เลือกประเภทการประชุม</option>
								    <option data-ng-repeat="item in meetingTypeList"
								    	value="{{ item.meeting_type_id }}">{{ item.meeting_type_name }}</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
							  	<span class="input-group-addon">วันที่เริ่ม</span>
							  	<input type="text" class="form-control next-focus datepicker" placeholder="เลือกวันที่เริ่ม" required validate-start-date-time
							  		name="start_date" data-ng-model="entryBooking.start_date">
								<span class="input-group-btn">
						        	<button class="btn" type="button" id="datepicker-from-btn">
						        		<i class="fa fa-calendar"></i>
						        	</button>
						      	</span>
							</div>
						</div>
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
							  	<span class="input-group-addon">เวลาที่เริ่ม</span>
							  	<input type="text" class="form-control next-focus timepicker" placeholder="เลือกเวลาที่เริ่ม" required validate-start-date-time
							  		name="start_time" data-ng-model="entryBooking.start_time">
								<span class="input-group-btn">
						        	<button class="btn" type="button" id="timepicker-from-btn">
						        		<i class="glyphicon glyphicon-time"></i>
						        	</button>
						      	</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
							  	<span class="input-group-addon">วันที่เสร็จสิ้น</span>
							  	<input type="text" class="form-control next-focus datepicker" placeholder="เลือกวันที่เสร็จสิ้น" required validate-end-date-time
							  		name="end_date" data-ng-model="entryBooking.end_date">
								<span class="input-group-btn">
						        	<button class="btn" type="button" id="datepicker-to-btn">
						        		<i class="fa fa-calendar"></i>
						        	</button>
						      	</span>
							</div>
						</div>
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
							  	<span class="input-group-addon">เวลาที่เสร็จสิ้น</span>
							  	<input type="text" class="form-control next-focus timepicker" placeholder="เลือกเวลาที่เสร็จสิ้น" required validate-end-date-time
							  		name="end_time" data-ng-model="entryBooking.end_time">
								<span class="input-group-btn">
						        	<button class="btn" type="button" id="timepicker-from-btn">
						        		<i class="glyphicon glyphicon-time"></i>
						        	</button>
						      	</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-8 form-group col-inline">
							<div class="input-group">
							  	<span class="input-group-addon input-group-addon-fluid">หัวข้อการประชุม</span>
							  	<input type="text" class="form-control next-focus" placeholder="กรอกหัวข้อการประชุม" required
							  		name="meeting_topic" data-ng-model="entryBooking.meeting_topic">
							</div>
						</div>
						<div class="col-md-4 form-group col-inline">
							<div class="input-group">
							  	<span class="input-group-addon">จำนวน</span>
							  	<input type="text" class="form-control next-focus" placeholder="กรอกจำนวนผู้เข้าประชุม" required numbered
							  		name="meeting_number" data-ng-model="entryBooking.meeting_number">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12 form-group col-inline">
							<div class="input-group">
							  	<span class="input-group-addon input-group-addon-fluid">รายละเอียด</span>
							  	<textarea class="form-control next-focus" placeholder="กรอกรายละเอียด"
							  		name="meeting_detail" data-ng-model="entryBooking.meeting_detail">
							  	</textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
							  	<span class="input-group-addon">หน่วยงานที่จอง</span>
							  	<select class="form-control next-focus" required
							  		name="department_id" data-ng-model="entryBooking.department_id">
								    <option value="" selected disabled>เลือกหน่วยงานที่จอง</option>
								    <option data-ng-repeat="item in departmentList"
								    	value="{{ item.department_id }}">{{ item.department_name }}</option>
								</select>
							</div>
						</div>
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
							  	<span class="input-group-addon">รูปแบบการจัดโต๊ะ</span>
							  	<select class="form-control next-focus"
							  		name="meeting_table_type_id" data-ng-model="entryBooking.meeting_table_type_id">
								    <option value="" selected disabled>เลือกรูปแบบการจัดโต๊ะ</option>
								    <option data-ng-repeat="item in meetingTableTypeList"
								    	value="{{ item.meeting_table_type_id }}">{{ item.meeting_table_type_name }}</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
							  	<span class="input-group-addon">สิ่งที่ต้องการ</span>
							  	<select class="form-control next-focus"
							  		name="meeting_required_id" data-ng-model="entryBooking.meeting_required_id">
								    <option value="" selected disabled>เลือกสิ่งที่ต้องการ</option>
								    <option data-ng-repeat="item in meetingRequiredList"
								    	value="{{ item.meeting_required_id }}">{{ item.meeting_required_name }}</option>
								</select>
							</div>
						</div>
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
							  	<span class="input-group-addon">ประเภทงบประมาณ</span>
							  	<select class="form-control next-focus" required
							  		name="budget_type_id" data-ng-model="entryBooking.budget_type_id">
								    <option value="" selected disabled>เลือกประเภทงบประมาณ</option>
								    <option data-ng-repeat="item in budgetTypeList"
								    	value="{{ item.budget_type_id }}">{{ item.budget_type_name }}</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12 form-group col-inline no-margin-bottom">
							<div class="panel-group-addon">
								<div class="panel panel-default">
									<div class="panel-body">
										<div class="row">
											<div class="panel-group-addon-left">อุปกรณ์ที่ใช้</div>
											<div class="panel-group-addon-right">
												<div class="col-md-12">
													<div class="col-md-4" data-ng-repeat="item in equipmentList">
														<div class="checkbox">
														  	<label>
														  		<input type="checkbox" class="next-focus" name="entryBookingEquipment" 
														  			data-ng-checked="item.equipment_id == entryBooking.entryBookingEquipment.data[$index].equipment_id"
														  			data-ng-true-value="{{ item.equipment_id }}"
														  			data-ng-false-value="0"
														  			data-ng-model="entryBooking.entryBookingEquipment.data[$index].equipment_id">
														  			{{ item.equipment_name }}
														  	</label>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 form-group text-right no-margin-bottom">
					<button class="btn btn-success next-focus" type="button"
						data-ng-show="currentLocation == '/booking_add' && (userPermission[1].perm_status == 'R/W' || userPermission[1].perm_status == 'ADMIN')"
						data-ng-disabled="bookingForm.$invalid"
						data-ng-click="insertBooking()">
						<i class="fa fa-plus-square text-indent"></i> บันทึกการจอง
					</button>
					<button class="btn btn-warning next-focus" type="button"
						data-ng-show="(currentLocation == '/booking_edit/' && entryUser.user_id == stateParams.user_id && userPermission[1].perm_status == 'R/W') || 
							(currentLocation == '/booking_edit/' && userPermission[1].perm_status == 'ADMIN')"
						data-ng-disabled="bookingForm.$invalid"
						data-ng-click="updateBooking()">
						<i class="fa fa-pencil-square-o text-indent"></i> แก้ไขการจอง
					</button>
					<button class="btn btn-cancel next-focus" type="button" 
						data-ng-click="resetEntry('entryBooking')">
						<i class="fa fa-trash text-indent"></i> ล้างข้อมูล
					</button>
				</div>
			</form>
		</div>
	</div>
</div>