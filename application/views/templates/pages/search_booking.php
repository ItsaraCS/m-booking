<div class="col-md-12 section-search-booking">
	<div class="well well-sm well-default">
		<p><i class="fa fa-search text-indent"></i> ค้นหาข้อมูลการจอง</p>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-bars text-indent"></i> ค้นหาข้อมูลการจองห้องประชุม
		</div>
		<div class="panel-body margin-top">
			<div class="col-md-6 form-group col-block">
				<div class="input-group">
				  	<span class="input-group-addon">ห้องประชุม</span>
				  	<select class="form-control">
					    <option>เลือกห้องประชุม</option>
					    <option>2</option>
					    <option>3</option>
					    <option>4</option>
					</select>
				</div>
			</div>
			<div class="col-md-6 form-group col-block">
				<div class="input-group">
				  	<span class="input-group-addon">สถานะ</span>
				  	<select class="form-control">
					    <option>เลือกสถานะ</option>
					    <option>รออนุมัติ</option>
					    <option>อนุมัติ</option>
					    <option>ไม่อนุมัติ</option>
					    <option>ยกเลิกการจอง</option>
					</select>
				</div>
			</div>
			<div class="col-md-6 form-group col-block">
				<div class="input-group">
				  	<span class="input-group-addon">จากวันที่</span>
				  	<input type="text" class="form-control datepicker" placeholder="เลือกวันที่">
					<span class="input-group-btn">
			        	<button class="btn" type="button" id="datepicker-from-btn">
			        		<i class="fa fa-calendar"></i>
			        	</button>
			      	</span>
				</div>
			</div>
			<div class="col-md-6 form-group col-block">
				<div class="input-group">
				  	<span class="input-group-addon">ถึงวันที่</span>
				  	<input type="text" class="form-control datepicker" placeholder="เลือกวันที่">
					<span class="input-group-btn">
			        	<button class="btn" type="button" id="datepicker-to-btn">
			        		<i class="fa fa-calendar"></i>
			        	</button>
			      	</span>
				</div>
			</div>
			<div class="col-md-6 form-group">
				<button class="btn btn-search" type="button">
	        		<i class="fa fa-search text-indent"></i> ค้นหา
	        	</button>
			</div>

			<div class="col-md-12">
				<div class="panel-body" style="padding: 0;">
					<div class="panel panel-sub">
						<div class="panel-heading">
							<i class="fa fa-bars text-indent"></i>
							ห้องประชุมโมดิฟาย
						</div>
						<div class="panel-body">
							<div class="text-right">
								<button class="btn btn-print margin-bottom" type="button">
									<i class="fa fa-print text-indent"></i> พิมพ์ตารางการจอง
								</button>
							</div>
							<div class="table-responsive">
								<table class="table table-bordered table-striped no-margin-bottom">
									<thead class="table-head-color">
										<tr>
											<th class="text-center">เวลา</th>
											<th class="text-center">หัวข้อการประชุม</th>
											<th class="text-center">หน่วยงาน</th>
											<th class="text-center">จำนวน</th>
											<th class="text-center">ผู้จอง</th>
											<th class="text-center">สถานะ</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center" colspan="6">**ไม่พบรายการจอง</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>