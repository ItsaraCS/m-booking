<div class="col-md-12 section-search-booking" data-ng-show="statusMenu.menu4">
	<div class="well well-sm well-default">
		<p><i class="fa fa-search text-indent"></i> ค้นหาข้อมูลการจอง</p>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-bars text-indent"></i> ค้นหาข้อมูลการจอง
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
							  		name="start_date" data-ng-model="entrySearchBooking.start_date">
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
							  		name="end_date" data-ng-model="entrySearchBooking.end_date">
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
							  		name="booking_status_id" data-ng-model="entrySearchBooking.booking_status_id">
							  		<option value="" selected disabled>เลือกสถานะ</option>
								    <option data-ng-repeat="item in bookingStatusList"
								    	value="{{ item.booking_status_id }}">{{ item.booking_status_name }}</option>
								    <option value="">ทุกสถานะ</option>
								</select>
							</div>
						</div>
						<div class="col-md-6 form-group col-inline">
							<div class="input-group">
							  	<span class="input-group-addon">ห้องประชุม</span>
							  	<select class="form-control next-focus"
							  		name="meeting_room_id" data-ng-model="entrySearchBooking.meeting_room_id">
							  		<option value="" selected disabled>เลือกห้องประชุม</option>
								    <option data-ng-repeat="item in meetingRoomList"
								    	value="{{ item.meeting_room_id }}">{{ item.meeting_room_name }}</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 form-group text-right">
					<span class="info booking-info"></span>
					<button class="btn btn-search next-focus" type="button" 
						data-ng-disabled="searchBookingForm.$invalid"
						data-ng-click="searchBooking()">
						<i class="fa fa-search text-indent"></i> ค้นหา
					</button>
					<a class="btn btn-success next-focus" 
						data-ng-show="entryUser.user_id != ''"
						data-ui-sref="เพิ่มรายการจอง">
						<i class="fa fa-plus-square text-indent"></i> เพิ่มรายการจอง
					</a>
				</div>
			</form>
			
			<!--Sub content-->
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
								<tr data-ng-repeat="item in bookingData">
									<td class="col-md-2 vertical-center">
										<div class="status status-{{ item.booking_status_code }}">{{ item.booking_status_name }}</div>
									</td>
									<td class="col-md-4 vertical-center">{{ item.date_used }}</td>
									<td class="col-md-4 vertical-center">{{ item.meeting_room_name }}</td>
									<td class="col-md-2 vertical-center text-center">
										<a class="btn btn-sm btn-confirm" title="ดูข้อมูล" 
											data-ui-sref="ดูข้อมูลรายการจอง({ 
									    		'showStatus': 'showSearchBooking', 
									    		'bookingID': '{{ item.booking_id }}'
								    		})">
											<i class="glyphicon glyphicon-eye-open"></i>
										</a>
										<a class="btn btn-sm btn-warning" title="แก้ไข"
											data-ui-sref="แก้ไขรายการจอง({ 
									    		'bookingID': '{{ item.booking_id }}',
									    		'userID': '{{ item.user_id }}'
								    		})"
								    		data-ng-show="(entryUser.user_id == item.user_id && 
												userPermission[3].perm_status == 'R/W' && 
												(item.booking_status_id == '2' || item.booking_status_id == '4')) || 
												userPermission[3].perm_status == 'ADMIN'">
											<i class="glyphicon glyphicon-edit"></i>
										</a>
										<button class="btn btn-sm btn-cancel" type="button" title="ลบ"
											data-ng-show="(entryUser.user_id == item.user_id && 
												userPermission[3].perm_status == 'R/W' && 
												(item.booking_status_id == '3' || item.booking_status_id == '5')) || 
												userPermission[3].perm_status == 'ADMIN'"
											data-ng-click="deleteBooking(item.booking_id)">
											<i class="glyphicon glyphicon-trash"></i>
										</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-12" data-ng-if="searchBookingData.length">
					<nav class="text-right">
					  	<ul class="pagination margin-top no-margin-bottom">
						    <li active-pagination value="prev">
						      	<a data-ng-click="getBookingDataPerPage(1)" aria-label="Previous">
						        	<span aria-hidden="true">&laquo;</span>
						      	</a>
						    </li>
							<li data-ng-repeat="item in totalPageList" active-pagination value="{{ item.searchBookingPage }}" 
								data-ng-class="item.searchBookingPage == searchBookingPage ? 'active' : ''">
						    	<a data-ui-sref="ค้นหาข้อมูลการจอง({ 
							    		'searchBookingPage': '{{ item.searchBookingPage }}', 
							    		'startDate': '{{ item.startDate }}', 
							    		'endDate': '{{ item.endDate }}', 
							    		'bookingStatusID': '{{ item.bookingStatusID }}', 
							    		'meetingRoomID': '{{ item.meetingRoomID }}' 
						    		})">
						    		{{ item.searchBookingPage }}
						    	</a>
						    </li>
						    <li active-pagination value="next">
						      	<a data-ng-click="getBookingDataPerPage(totalPage)" aria-label="Next">
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