<style type="text/css">
	.tooltip-inner{
		word-break: break-all;
	}
</style>
<div class="col-md-12 section-schedule-meeting-use" data-ng-show="statusMenu.menu1">
	<div class="well well-sm well-default">
		<p>
			<i class="fa fa-calendar text-indent"></i> ปฏิทินการใช้ห้องประชุม
		</p>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="fa fa-bars text-indent"></i> ปฏิทินการใช้ห้องประชุม
		</div>
		<div class="panel-body margin-top">
			<div class="col-md-12 margin-bottom">
				<div id='calendar'></div>
			</div>
			<div class="col-md-12">
				<div class="well well-sm">
					<p style="margin-left: 10px; margin-bottom: 10px; font-size: 14px;"><i class="fa fa-info-circle text-indent"></i> หมายเหตุ</p>
		    		<p class="text-indent-p" style="font-size: 14px;">
						<i class="fa fa-angle-double-right text-indent"></i><span class="status-label status-label-approve"></span>&nbsp; หมายถึง &nbsp; มีรายการจองแล้วในวันนั้น และได้รับการอนุมัติการจองแล้วจากเจ้ากน้าที่
					</p>
		    		<p class="text-indent-p" style="font-size: 14px;">
						<i class="fa fa-angle-double-right text-indent"></i><span class="status-label status-label-waitapprove"></span>&nbsp; หมายถึง &nbsp; มีรายการจองแล้วในวันนั้น แต่อยู่ระหว่างการรอให้เจ้าหน้าที่อนุมัติการจอง
		    		</p>
		    		<p class="text-indent-p" style="font-size: 14px;">
						<i class="fa fa-angle-double-right text-indent"></i><span class="status-label status-label-cancel"></span>&nbsp; หมายถึง &nbsp; รายการจองที่ขอยกเลิก และได้รับการอนุมัติการยกเลิกแล้วจากเจ้าหน้าที่
					</p>
		    		<p class="text-indent-p" style="font-size: 14px;">
						<i class="fa fa-angle-double-right text-indent"></i><span class="status-label status-label-waitcancel"></span>&nbsp; หมายถึง &nbsp; รายการจองที่ขอยกเลิก แต่อยู่ระหว่างการรอให้เจ้าหน้าที่อนุมัติการยกเลิก
		    		</p>
		    		<p class="text-indent-p" style="font-size: 14px;">
						<i class="fa fa-angle-double-right text-indent"></i><span class="status-label status-label-notapprove"></span>&nbsp; หมายถึง &nbsp; รายการจองที่ไม่ได้รับการอนุมติจากเจ้าหน้าที่
		    		</p>
		    	</div>
			</div>
		</div>
	</div>
</div>