<div class="col-md-12 section-booking">
	<div class="well well-sm well-default">
		<p><i class="fa fa-plus-square text-indent"></i> จองห้องประชุม</p>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-bars text-indent"></i> เพิ่มรายการจองห้องประชุม
		</div>
		<div class="panel-body margin-top">
			<div class="col-md-6 form-group col-inline">
				<div class="input-group">
				  	<span class="input-group-addon">ห้องประชุม</span>
				  	<select class="form-control">
					    <option>เลือกห้องประชุม</option>
					    <option>1</option>
					    <option>2</option>
					    <option>3</option>
					</select>
				</div>
			</div>
			<div class="col-md-6 form-group col-inline">
				<div class="input-group">
				  	<span class="input-group-addon">ประเภทการประชุม</span>
				  	<select class="form-control">
					    <option>เลือกประเภทการประชุม</option>
					    <option>1</option>
					    <option>2</option>
					    <option>3</option>
					</select>
				</div>
			</div>
			<div class="col-md-6 form-group col-inline">
				<div class="input-group">
				  	<span class="input-group-addon">วันที่เริ่ม</span>
				  	<input type="text" class="form-control datepicker" placeholder="เลือกวันที่เริ่ม">
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
				  	<input type="text" class="form-control timepicker" placeholder="เลือกเวลาที่เริ่ม">
					<span class="input-group-btn">
			        	<button class="btn" type="button" id="timepicker-from-btn">
			        		<i class="glyphicon glyphicon-time"></i>
			        	</button>
			      	</span>
				</div>
			</div>
			<div class="col-md-6 form-group col-inline">
				<div class="input-group">
				  	<span class="input-group-addon">วันที่เสร็จสิ้น</span>
				  	<input type="text" class="form-control datepicker" placeholder="เลือกวันที่เสร็จสิ้น">
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
				  	<input type="text" class="form-control timepicker" placeholder="เลือกเวลาที่เสร็จสิ้น">
					<span class="input-group-btn">
			        	<button class="btn" type="button" id="timepicker-from-btn">
			        		<i class="glyphicon glyphicon-time"></i>
			        	</button>
			      	</span>
				</div>
			</div>
			<div class="col-md-9 form-group col-inline">
				<div class="input-group">
				  	<span class="input-group-addon input-group-addon-fluid">หัวข้อการประชุม</span>
				  	<input type="text" class="form-control" placeholder="กรอกหัวข้อการประชุม">
				</div>
			</div>
			<div class="col-md-3 form-group col-inline">
				<div class="input-group">
				  	<span class="input-group-addon">จำนวน</span>
				  	<input type="text" class="form-control" placeholder="กรอกจำนวน">
				</div>
			</div>
			<div class="col-md-9 form-group col-inline">
				<div class="input-group">
				  	<span class="input-group-addon input-group-addon-fluid">รายละเอียด</span>
				  	<textarea class="form-control" placeholder="กรอกรายละเอียด"></textarea>
				</div>
			</div>
			<div class="col-md-6 form-group col-inline">
				<div class="input-group">
				  	<span class="input-group-addon">หน่วยงานที่จอง</span>
				  	<select class="form-control">
					    <option>เลือกหน่วยงานที่จอง</option>
					    <option>1</option>
					    <option>2</option>
					    <option>3</option>
					</select>
				</div>
			</div>
			<div class="col-md-6 form-group col-inline">
				<div class="input-group">
				  	<span class="input-group-addon">รูปแบบการจัดโต๊ะ</span>
				  	<select class="form-control">
					    <option>เลือกรูปแบบการจัดโต๊ะ</option>
					    <option>1</option>
					    <option>2</option>
					    <option>3</option>
					</select>
				</div>
			</div>
			<div class="col-md-6 form-group col-inline">
				<div class="input-group">
				  	<span class="input-group-addon">สิ่งที่ต้องการ</span>
				  	<select class="form-control">
					    <option>เลือกสิ่งที่ต้องการ</option>
					    <option>1</option>
					    <option>2</option>
					    <option>3</option>
					</select>
				</div>
			</div>
			<div class="col-md-6 form-group col-inline">
				<div class="input-group">
				  	<span class="input-group-addon">ประเภทงบประมาณ</span>
				  	<select class="form-control">
					    <option>เลือกประเภทงบประมาณ</option>
					    <option>1</option>
					    <option>2</option>
					    <option>3</option>
					</select>
				</div>
			</div>
			<div class="col-md-12 form-group col-inline">
				
			</div>
			<div class="col-md-12 form-group text-right">
				<span class="info booking-info"></span>
				<button class="btn btn-confirm" type="button">
					<i class="fa fa-plus-square text-indent"></i> บันทึกการจอง
				</button>
				<button class="btn btn-cancel" type="button">
					<i class="fa fa-trash text-indent"></i> ล้างข้อมูล
				</button>
			</div>
		</div>
	</div>
</div>