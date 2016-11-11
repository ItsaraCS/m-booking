<div class="col-md-12 section-detail-meeting" data-ng-show="statusMenu.menu6">
	<div class="well well-sm well-default">
		<p><i class="fa fa-eye text-indent"></i> รายละเอียดห้องประชุม</p>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading margin-bottom">
			<i class="fa fa-bars text-indent"></i> รายละเอียดห้องประชุม
		</div>
		<div class="panel-body" data-ng-repeat="item in meetingDetailData">
			<div class="col-md-12">
				<div class="panel panel-default no-margin-bottom">
					<div class="panel-body">
						<div class="col-md-4">
							<div class="thumbnail center-block no-margin-bottom">
								<img src="<?php echo image_asset('meeting.jpg'); ?>" class="img-responsive" style="width: 100%; height: 200px;">
							</div>
						</div>
						<div class="col-md-8">
							<div class="table-responsive">
								<table class="table table-striped table-bordered">
									<tbody>
										<tr>
											<td colspan="2" class="text-center">
												<i class="fa fa-home text-indent"></i>  {{ item.meeting_room_name }}
											</td>
										</tr>
										<tr>
											<td class="col-md-3 text-nowrap"><i class="fa fa-caret-right text-indent"></i> ชื่อห้องประชุม</td>
											<td class="cl-md-9">{{ item.meeting_room_name }}</td>
										</tr>
										<tr>
											<td class="col-md-3 text-nowrap"><i class="fa fa-caret-right text-indent"></i> จำนวนที่นั่ง</td>
											<td class="cl-md-9">{{ item.meeting_room_size }}</td>
										</tr>
										<tr>
											<td class="col-md-3 text-nowrap"><i class="fa fa-caret-right text-indent"></i> ที่ตั้ง</td>
											<td class="cl-md-9">{{ item.meeting_room_location }}</td>
										</tr>
										<tr>
											<td class="col-md-3 text-nowrap"><i class="fa fa-caret-right text-indent"></i> รายละเอียดเพิ่มเติม</td>
											<td class="cl-md-9">{{ item.meeting_room_detail }}</td>
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