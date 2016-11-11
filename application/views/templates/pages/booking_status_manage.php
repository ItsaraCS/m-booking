<div class="col-md-12 section-booking-status-manage" data-ng-show="statusMenu.menu5">
	<div class="well well-sm well-default">
		<p><i class="fa fa-toggle-on text-indent"></i> จัดการสถานะการจอง</p>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-bars text-indent"></i> จัดการสถานะการจอง
		</div>
		<div class="panel-body margin-top">
			<!--Main content-->
			<form name="searchBookingForm" novalidate>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
							  	<span class="input-group-addon">วันที่เริ่ม</span>
							  	<input type="text" class="form-control next-focus datepicker" placeholder="เลือกวันที่เริ่ม"
							  		data-ng-model="entrySearchBooking.start_date">
								<span class="input-group-btn">
						        	<button class="btn" type="button" id="datepicker-from-btn">
						        		<i class="fa fa-calendar"></i>
						        	</button>
						      	</span>
							</div>
						</div>
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
							  	<span class="input-group-addon">วันที่เสร็จสิ้น</span>
							  	<input type="text" class="form-control next-focus datepicker" placeholder="เลือกวันที่เสร็จสิ้น"
							  		data-ng-model="entrySearchBooking.end_date">
								<span class="input-group-btn">
						        	<button class="btn" type="button" id="datepicker-to-btn">
						        		<i class="fa fa-calendar"></i>
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
							  	<span class="input-group-addon">สถานะ</span>
							  	<select class="form-control next-focus"
							  		data-ng-model="entrySearchBooking.booking_status_id">
							  		<option value="" selected disabled>เลือกสถานะ</option>
								    <option data-ng-repeat="item in bookingStatusList"
								    	value="{{ item.booking_status_id }}">{{ item.booking_status_name }}</option>
								</select>
							</div>
						</div>
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
							  	<span class="input-group-addon">ห้องประชุม</span>
							  	<select class="form-control next-focus"
							  		data-ng-model="entrySearchBooking.meeting_room_id">
							  		<option value="" selected disabled>เลือกห้องประชุม</option>
								    <option data-ng-repeat="item in meetingRoomList"
								    	value="{{ item.meeting_room_id }}">{{ item.meeting_room_name }}</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 form-group text-right no-margin-bottom">
					<span class="info booking-info"></span>
					<button class="btn btn-search next-focus" type="button" 
						data-ng-disabled="searchBookingForm.$invalid"
						data-ng-click="searchBooking()">
						<i class="fa fa-search text-indent"></i> ค้นหา
					</button>
				</div>
			</form>
			
			<!--Sub content-->
			<div class="col-md-12">
				<div class="label-warning">
					<i class="fa fa-exclamation-circle text-indent"></i> แสดงเฉพาะรายการที่รออนุมัติ และรอยกเลิกเท่านั้น
				</div>
			</div>
			<form name="bookingForm" novalidate>
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead class="table-head-color">
								<th class="text-center text-nowrap">สถานะ</th>
								<th class="text-center text-nowrap">วันที่ใช้ห้อง</th>
								<th class="text-center text-nowrap">ห้องประชุม</th>
								<th class="text-center text-nowrap">ดำเนินการ</th>
							</thead>
							<tbody>
								<!--<tr data-ng-repeat="item in bookingDetailData">-->
								<tr>
									<td class="col-md-2 vertical-center">
										<div class="status status-waitapprove">รออนุมัติ</div>
									</td>
									<td class="col-md-4 vertical-center">
										จาก 01-11-59 (08:00) ถีง 01-11-59 (16:00)
									</td>
									<td class="col-md-4 vertical-center">ห้องประชุม</td>
									<td class="col-md-2 vertical-center text-center">
										<a class="btn btn-sm btn-confirm" title="ดูข้อมูล" href="#/booking_show/showManageStatusBooking">
											<i class="glyphicon glyphicon-eye-open"></i>
										</a>
										<a class="btn btn-sm btn-success" title="จัดการสถานะ" href="#/booking_show/waitapprove">
											<i class="glyphicon glyphicon-check"></i>
										</a>
										<button class="btn btn-sm btn-cancel" type="button" title="ลบ">
											<i class="glyphicon glyphicon-trash"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td class="col-md-2 vertical-center">
										<div class="status status-waitcancel">รอยกเลิก</div>
									</td>
									<td class="col-md-4 vertical-center vertical-center">
										จาก 01-11-59 (08:00) ถีง 01-11-59 (16:00)
									</td>
									<td class="col-md-4 vertical-center">ห้องประชุม</td>
									<td class="col-md-2 vertical-center text-center">
										<a class="btn btn-sm btn-confirm" title="ดูข้อมูล" href="#/booking_show/showManageStatusBooking">
											<i class="glyphicon glyphicon-eye-open"></i>
										</a>
										<a class="btn btn-sm btn-success" title="จัดการสถานะ" href="#/booking_show/waitcancel">
											<i class="glyphicon glyphicon-check"></i>
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