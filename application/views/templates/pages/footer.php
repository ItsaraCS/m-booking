					</span>
				</div>
			</div>
		</div>
	</div>
	<!--jQuery JavaScript File-->
	<?php echo library_asset('jquery'); ?>
	<!--Bootstrap JavaScript File-->
	<?php echo library_asset('bootstrap', 'bootstrap.min.js'); ?>
	<!--AngularJS JavaScript File-->
	<?php echo library_asset('angularjs'); ?>
	<?php echo library_asset('angularjs', 'angular-route.min.js'); ?>
	<?php echo library_asset('angularjs', 'angular-ui-router.js'); ?>
	<?php echo library_asset('app'); ?>
	<!--FullCalendar File-->
	<?php echo library_asset('fullcalendar', 'lib/moment.min.js'); ?>
	<?php echo library_asset('fullcalendar'); ?>
	<?php echo library_asset('fullcalendar', 'locale/th.js'); ?>
	<!--Custom JavaScript File-->
	<?php echo file_asset('script.js'); ?>
</body>
</html>