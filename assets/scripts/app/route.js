angular.module('mainApp')
.config(function($stateProvider, $urlRouterProvider, $locationProvider){
	$locationProvider.html5Mode(false);

	$urlRouterProvider.otherwise('/main');
	$stateProvider
		.state('เข้าสู่ระบบ', {
            url: '/login',
            controller: 'userController',
            templateUrl: 'templates/index.php'
        })
        .state('สมัครสมาชิกใหม่', {
            url: '/register',
            controller: 'userController',
            templateUrl: 'templates/index.php'
        })
        .state('ออกจากระบบ', {
            url: '/logout',
            controller: 'userController',
            templateUrl: 'templates/index.php'
        })
        .state('หน้าแรก', {
            url: '/main',
            controller: 'mainController',
            templateUrl: 'templates/index.php'
        })
        .state('คำแนะการการใช้งานระบบ', {
            url: '/instructions',
            templateUrl: 'templates/instructions.php'
        })
        .state('จองห้องประชุม', {
            url: '/booking',
            controller: 'meetingBookingController',
            templateUrl: 'templates/instructions.php'
        })
        .state('ตารางห้องประชุมวันนี้', {
            url: '/schedule_today',
            controller: 'meetingBookingController',
            templateUrl: 'templates/schedule_today.php'
        })
        .state('ปฏิทินการใช้ห้องประชุม', {
            url: '/calendar_meeting_use',
            controller: 'meetingBookingController',
            templateUrl: 'templates/calendar_meeting_use.php'
        })
        .state('ค้นหาข้อมูลการจอง', {
            url: '/search_booking',
            controller: 'meetingBookingController',
            templateUrl: 'templates/search_booking.php'
        })
        .state('รายละเอียดห้องประชุม', {
            url: '/detail_meeting',
            controller: 'meetingBookingController',
            templateUrl: 'templates/detail_meeting.php'
        })
        .state('สถิติแยกตามห้องประชุม', {
            url: '/statistic_by_meeting',
            controller: 'meetingBookingController',
            templateUrl: 'templates/statistic_by_meeting.php'
        })
        .state('สถิติแยกตามหน่วยงาน', {
            url: '/statistic_by_department',
            controller: 'meetingBookingController',
            templateUrl: 'templates/statistic_by_department.php'
        });
});