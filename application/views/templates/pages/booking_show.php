<div class="col-md-12 section-booking-show" data-ng-show="statusMenu.menu3 || statusMenu.menu4 || statusMenu.menu5">
	<div class="well well-sm well-default">
		<ol class="breadcrumb" data-ng-show="stateParams.showStatus == 'showCancelBooking'">
			<li>
				<a data-ui-sref="ยกเลิกการจอง(previousParams)"><i class="fa fa-ban text-indent"></i> ยกเลิกการจอง</a>
			</li>
			<li class="active">รายละเอียดการจอง</li>
		</ol>
		<ol class="breadcrumb" data-ng-show="stateParams.showStatus == 'showSearchBooking'">
			<li>
				<a data-ui-sref="ค้นหาข้อมูลการจอง(previousParams)"><i class="fa fa-search text-indent"></i> ค้นหาข้อมูลการจอง</a>
			</li>
			<li class="active">รายละเอียดการจอง</li>
		</ol>
		<ol class="breadcrumb" data-ng-show="stateParams.showStatus == 'showManageStatusBooking'">
			<li>
				<a data-ui-sref="จัดการสถานะการจอง(previousParams)"><i class="fa fa-toggle-on text-indent"></i> จัดการสถานะการจอง</a>
			</li>
			<li class="active">รายละเอียดการจอง</li>
		</ol>
		<ol class="breadcrumb" data-ng-show="stateParams.showStatus == 'cancel'">
			<li>
				<a data-ui-sref="ยกเลิกการจอง(previousParams)"><i class="fa fa-ban text-indent"></i> ยกเลิกการจอง</a>
			</li>
			<li class="active">รายการจองที่อนุมัติแล้ว</li>
		</ol>
		<ol class="breadcrumb" data-ng-show="stateParams.showStatus == 'waitapprove'">
			<li>
				<a data-ui-sref="จัดการสถานะการจอง(previousParams)"><i class="fa fa-toggle-on text-indent"></i> จัดการสถานะการจอง</a>
			</li>
			<li class="active">รายการจองรออนุมัติ</li>
		</ol>
		<ol class="breadcrumb" data-ng-show="stateParams.showStatus == 'waitcancel'">
			<li>
				<a data-ui-sref="จัดการสถานะการจอง(previousParams)"><i class="fa fa-toggle-on text-indent"></i> จัดการสถานะการจอง</a>
			</li>
			<li class="active">รายการจองรอยกเลิก</li>
		</ol>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-bars text-indent"></i> รายละเอียดการจอง
		</div>
		<div class="panel-body margin-top">
			<!--Main content-->
			<div class="col-md-12">
				<div class="col-md-3">
					<div class="thumbnail center-block">
						<img src="<?php echo image_asset('meeting.jpg'); ?>" class="img-responsive" style="width: 100%; height: 150px;">
					</div>
				</div>
				<div class="col-md-9">
					<p class="no-margin-bottom" style="font-size: 20px;"><b>{{ bookingDetailData.meeting_room_name }}</b></p><br>
					<p class="no-margin-bottom"><b>สถานะ</b>&nbsp;&nbsp;
						<i class="fa fa-caret-right text-indent"></i> {{ bookingDetailData.booking_status_name }}
					</p><br>
					<p class="no-margin-bottom"><b>วันที่ใช้</b>&nbsp;&nbsp;
						<i class="fa fa-caret-right text-indent"></i> {{ bookingDetailData.start_datetime }}
					</p><br>
					<p class="no-margin-bottom"><b>ถึงวันที่</b>&nbsp;&nbsp;
						<i class="fa fa-caret-right text-indent"></i> {{ bookingDetailData.end_datetime }}
					</p>
				</div>
				<div class="col-md-12">
					<table class="table table-striped table-bordered">
						<tbody>
							<tr>
								<td class="col-md-2" colspan="1">
									<i class="fa fa-caret-right text-indent"></i> หัวข้อการประชุม
								</td>
								<td class="col-md-10" colspan="3">{{ bookingDetailData.meeting_topic }}</td>
							</tr>
							<tr>
								<td class="col-md-2">
									<i class="fa fa-caret-right text-indent"></i> ประเภทการประชุม
								</td>
								<td class="col-md-4">{{ bookingDetailData.meeting_type_name }}</td>
								<td class="col-md-2">
									<i class="fa fa-caret-right text-indent"></i> จำนวนผู้เข้าร่วม
								</td>
								<td class="col-md-4">{{ bookingDetailData.meeting_number }}</td>
							</tr>
							<tr>
								<td class="col-md-2" colspan="1">
									<i class="fa fa-caret-right text-indent"></i> รายละเอียด
								</td>
								<td class="col-md-10" colspan="3">{{ bookingDetailData.meeting_detail }}</td>
							</tr>
							<tr>
								<td class="col-md-2">
									<i class="fa fa-caret-right text-indent"></i> หน่วยงานที่จอง
								</td>
								<td class="col-md-4">{{ bookingDetailData.department_name }}</td>
								<td class="col-md-2">
									<i class="fa fa-caret-right text-indent"></i> ผู้จอง
								</td>
								<td class="col-md-4">{{ bookingDetailData.booking_user }}</td>
							</tr>
							<tr>
								<td class="col-md-2">
									<i class="fa fa-caret-right text-indent"></i> รูปแบบการจัดโต๊ะ
								</td>
								<td class="col-md-4">{{ bookingDetailData.meeting_table_type_name }}</td>
								<td class="col-md-2">
									<i class="fa fa-caret-right text-indent"></i> ประเภทงบประมาณ
								</td>
								<td class="col-md-4">{{ bookingDetailData.budget_type_name }}</td>
							</tr>
							<tr>
								<td class="col-md-2" colspan="1">
									<i class="fa fa-caret-right text-indent"></i> สิ่งที่ต้องการ
								</td>
								<td class="col-md-10" colspan="3">{{ bookingDetailData.meeting_required_name }}</td>
							</tr>
							<tr>
								<td class="col-md-2" colspan="1">
									<i class="fa fa-caret-right text-indent"></i> อุปกรณ์ที่ใช้
								</td>
								<td class="col-md-10" colspan="3">{{ bookingDetailData.equipment_name }}</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-md-12 text-right" 
					data-ng-show="stateParams.showStatus == 'cancel' && ((entryUser.user_id == bookingDetailData.user_id && userPermission[2].perm_status == 'R/W') || userPermission[2].perm_status == 'ADMIN')">
					<button class="btn btn-danger" type="button"
						data-ng-click="cancelBooking(bookingDetailData.booking_id)">
						<i class="fa fa-ban text-indent"></i> ยกเลิกรายการจอง
					</button>
				</div>
				<div class="col-md-12 text-right" 
					data-ng-show="stateParams.showStatus == 'waitapprove' && userPermission[4].perm_status == 'ADMIN'">
					<button class="btn btn-search" type="button"
						data-ng-click="approveBooking(bookingDetailData.booking_id)">
						<i class="fa fa-check text-indent"></i> ยืนยันการอนุมัติการจอง
					</button>
					<button class="btn btn-cancel" type="button"
						data-ng-click="notApproveBooking(bookingDetailData.booking_id)">
						<i class="fa fa-remove text-indent"></i> ไม่อนุมัติ
					</button>
				</div>
				<div class="col-md-12 text-right" 
					data-ng-show="stateParams.showStatus == 'waitcancel' && userPermission[4].perm_status == 'ADMIN'">
					<button class="btn btn-search" type="button"
						data-ng-click="approveCancelBooking(bookingDetailData.booking_id)">
						<i class="fa fa-check text-indent"></i> ยืนยันการยกเลิกการจอง
					</button>
					<button class="btn btn-cancel" type="button"
						data-ng-click="notApproveBooking(bookingDetailData.booking_id)">
						<i class="fa fa-remove text-indent"></i> ไม่อนุมัติ
					</button>
				</div>
			</div>
		</div>
	</div>
</div>