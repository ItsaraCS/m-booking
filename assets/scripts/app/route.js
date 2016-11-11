angular.module('mainApp')
.config(function($stateProvider, $urlRouterProvider, $locationProvider){
	$locationProvider.html5Mode(false);
    
	$urlRouterProvider.otherwise('/schedule_meeting_use');
	$stateProvider
		//--เมนู : รายการจองห้องประชุม
        .state('ปฏิทินการใช้ห้องประชุม', {
            url: '/schedule_meeting_use',
            controller: 'scheduleMeetingUseController',
            templateUrl: 'templates/schedule_meeting_use.php'
        })
        .state('จองห้องประชุม', {
            url: '/booking_add',
            controller: 'bookingController',
            templateUrl: 'templates/booking.php'
        })
        .state('ยกเลิกการจอง', {
            url: '/cancel_booking',
            controller: 'bookingController',
            templateUrl: 'templates/cancel_booking.php'
        })
        .state('ค้นหาข้อมูลการจอง', {
            url: '/search_booking',
            controller: 'searchBookingController',
            templateUrl: 'templates/search_booking.php'
        })
        .state('จัดการสถานะการจอง', {
            url: '/booking_status_manage',
            controller: 'bookingStatusManageController',
            templateUrl: 'templates/booking_status_manage.php'
        })
        
        //--เมนู : เกี่ยวกับห้องประชุม
        .state('รายละเอียดห้องประชุม', {
            url: '/meeting_detail',
            controller: 'meetingDetailController',
            templateUrl: 'templates/meeting_detail.php'
        })
        .state('รายงานการจอง', {
            url: '/report',
            controller: 'reportController',
            templateUrl: 'templates/report.php'
        })
        .state('คำแนะนำการใช้งานระบบ', {
            url: '/instructions',
            controller: 'instructionsController',
            templateUrl: 'templates/instructions.php'
        })

        //--เมนู : ผู้ใช้ระบบ
        .state('เข้าสู่ระบบ', {
            url: '/login',
            controller: 'mainController',
            templateUrl: 'templates/login.php'
        })
        .state('สมัครสมาชิก', {
            url: '/register',
            controller: 'userController',
            templateUrl: 'templates/register.php'
        })
        .state('ข้อมูลส่วนตัว', {
            url: '/userinfo',
            controller: 'userController',
            templateUrl: 'templates/userinfo.php'
        })
        .state('ตั้งค่าสิทธิ์การใช้งาน', {
            url: '/permission/?permissionPage?firstname?email',
            controller: 'userController',
            templateUrl: 'templates/permission.php'
        })
        
        //--เมนูการทำงาน
        .state('จัดการยกเลิกการจอง', {
            url: '/cancel_booking/:showStatus',
            controller: 'bookingController',
            templateUrl: 'templates/booking_show.php'
        })
        .state('ดูข้อมูลรายการจอง', {
            url: '/booking_show/:showStatus',
            controller: 'bookingController',
            templateUrl: 'templates/booking_show.php'
        })
        .state('เพิ่มรายการจอง', {
            url: '/booking_add',
            controller: 'bookingController',
            templateUrl: 'templates/booking.php'
        })
        .state('แก้ไขรายการจอง', {
            url: '/booking_edit',
            controller: 'bookingController',
            templateUrl: 'templates/booking.php'
        })
        .state('จัดการสถานะที่รอให้ดำเนินการ', {
            url: '/booking_show/:showStatus',
            controller: 'bookingController',
            templateUrl: 'templates/booking_show.php'
        })
        .state('จัดการตั้งค่าสิทธิ์การใช้งาน', {
            url: '/permission_manage/:userID',
            controller: 'userController',
            templateUrl: 'templates/permission_manage.php'
        });
});