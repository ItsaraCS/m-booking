angular.module('mainApp')
.factory('initService', function($location){
	var initService = {};

	initService.activeMenu = function(){
		var selectorMenu = '';
    	var selectorSubMenu = '';
    	var element = $('#accordian ul li');

    	function setActiveMenu(state){
    		//$('#accordian').children('ul').find('li').removeClass('active');
    		$('#accordian').find('h3').removeClass('activeMenu');
    		$('#accordian').children('ul').find('li ul li').removeClass('activeSubMenu');

    		selectorSubMenu = $(element).find('a[data-ui-sref="'+ state +'"]').parent('li');
    		selectorMenu = selectorSubMenu.closest('ul').parent('li').find('h3');
			selectorSubMenu.closest('ul').parent('li').addClass('active');
			selectorSubMenu.addClass('activeSubMenu');
			selectorMenu.addClass('activeMenu');
    	}

    	switch($location.path()){
    		case '/login': setActiveMenu('เข้าสู่ระบบ'); break;
    		case '/register': setActiveMenu('สมัครสมาชิกใหม่'); break;
    		case '/userinfo': setActiveMenu('ข้อมูลส่วนตัว'); break;
    		case '/logout': setActiveMenu('ออกจากระบบ'); break;
    		case '/main': setActiveMenu('หน้าแรก'); break;
    		case '/instructions': setActiveMenu('คำแนะการการใช้งานระบบ'); break;
    		case '/booking': setActiveMenu('จองห้องประชุม'); break;
    		case '/schedule_today': setActiveMenu('ตารางห้องประชุมวันนี้'); break;
    		case '/schedule_meeting_use': setActiveMenu('ปฏิทินการใช้ห้องประชุม'); break;
    		case '/search_booking': setActiveMenu('ค้นหาข้อมูลการจอง'); break;
    		case '/detail_meeting': setActiveMenu('รายละเอียดห้องประชุม'); break;
    		case '/statistic_by_meeting': setActiveMenu('สถิติแยกตามห้องประชุม'); break;
    		case '/statistic_by_department': setActiveMenu('สถิติแยกตามหน่วยงาน'); break;
    		default: setActiveMenu('หน้าแรก');
    	}
	}

	return initService;
})
.factory('dataService', function(){
    var dataService = {};

    dataService.getCurrentDate = function(){
        var now = new Date();
        var today = now.getFullYear() + '-';
        today += (now.getMonth() + 1) + '-';
        today += (now.getDate().toString().length < 2 ? ('0' + now.getDate()) : now.getDate());

        return today;
    }

    dataService.getCurrentDateTH = function(){
        var now = new Date();
        var day = now.getDay();
        var date = now.getDate();
        var month = now.getMonth();
        var year = (now.getFullYear() + 543);
        var dayNames= ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์']
        var monthNames = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];         
        var today = 'วัน ' + dayNames[day] + ' ที่ ' + date + ' ' + monthNames[month] + ' ' + year;

        return today;
    }

    return dataService;
});