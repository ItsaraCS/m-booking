angular.module('mainApp')
.config(function($stateProvider, $urlRouterProvider, $locationProvider){
	$locationProvider.html5Mode(false);

	$urlRouterProvider.otherwise('/main');
	$stateProvider
		.state('เข้าสู่ระบบ', {
            url: '/login',
            controller: 'userController',
            templateUrl: 'templates/login.php'
        })
        .state('สมัครสมาชิกใหม่', {
            url: '/register',
            controller: 'userController',
            templateUrl: 'templates/register.php'
        })
        .state('ข้อมูลส่วนตัว', {
            url: '/userinfo',
            controller: 'userController',
            templateUrl: 'templates/userinfo.php'
        })
        .state('ออกจากระบบ', {
            url: '/logout',
            controller: 'userController'
        })
        .state('หน้าแรก', {
            url: '/main',
            controller: 'scheduleMeetingUseController',
            templateUrl: 'templates/schedule_meeting_use.php'
        })
        .state('คำแนะการการใช้งานระบบ', {
            url: '/instructions',
            controller: 'mainController',
            templateUrl: 'templates/instructions.php'
        })
        .state('จองห้องประชุม', {
            url: '/booking',
            controller: 'bookingController',
            templateUrl: 'templates/booking.php'
        })
        .state('ตารางห้องประชุมวันนี้', {
            url: '/schedule_today',
            controller: 'scheduleTodayController',
            templateUrl: 'templates/schedule_today.php'
        })
        .state('ปฏิทินการใช้ห้องประชุม', {
            url: '/schedule_meeting_use',
            controller: 'scheduleMeetingUseController',
            templateUrl: 'templates/schedule_meeting_use.php'
        })
        .state('ค้นหาข้อมูลการจอง', {
            url: '/search_booking',
            controller: 'searchBookingController',
            templateUrl: 'templates/search_booking.php'
        })
        .state('รายละเอียดห้องประชุม', {
            url: '/detail_meeting',
            controller: 'detailMeetingController',
            templateUrl: 'templates/detail_meeting.php'
        })
        .state('สถิติแยกตามห้องประชุม', {
            url: '/statistic_by_meeting',
            controller: 'detailMeetingController',
            templateUrl: 'templates/statistic_by_meeting.php'
        })
        .state('สถิติแยกตามหน่วยงาน', {
            url: '/statistic_by_department',
            controller: 'detailMeetingController',
            templateUrl: 'templates/statistic_by_department.php'
        });
});