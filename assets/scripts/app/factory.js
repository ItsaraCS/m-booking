angular.module('mainApp')
.factory('initService', function($location, connectDBService){
	var initService = {};

    initService.setResizePage = function(){
        var sizeInputGroupAddon = $('.section').find('.col-inline span.input-group-addon').outerWidth();
        var sizeInputGroupAddonFluid = $('.section').find('.col-inline .input-group-addon-fluid');
        $(sizeInputGroupAddonFluid).css({ 'width': sizeInputGroupAddon });

        var sizePanelGroupAddon = $('.section').find('.col-inline .panel-group-addon').outerWidth();
        var sizePanelGroupAddonLeft = $('.section').find('.col-inline .panel-group-addon-left');
        var sizePanelGroupAddonRight = $('.section').find('.col-inline .panel-group-addon-right');
        $(sizePanelGroupAddonLeft).css({ 'width': sizeInputGroupAddon });
        $(sizePanelGroupAddonRight).css({ 'width': (sizePanelGroupAddon - sizeInputGroupAddon) });

        var sizeInputGroupAddonSub = $('.section').find('.col-inline-sub span.input-group-addon').outerWidth();
        var sizeInputGroupAddonFluidSub = $('.section').find('.col-inline-sub .input-group-addon-fluid');
        $(sizeInputGroupAddonFluidSub).css({ 'width': sizeInputGroupAddonSub });

        var sizePanelGroupAddonSub = $('.section').find('.col-inline-sub .panel-group-addon').outerWidth();
        var sizePanelGroupAddonLeftSub = $('.section').find('.col-inline-sub .panel-group-addon-left');
        var sizePanelGroupAddonRightSub = $('.section').find('.col-inline-sub .panel-group-addon-right');
        $(sizePanelGroupAddonLeftSub).css({ 'width': sizeInputGroupAddonSub });
        $(sizePanelGroupAddonRightSub).css({ 'width': (sizePanelGroupAddonSub - sizeInputGroupAddonSub) });
    }

    initService.activeMenu = function(stateParams = {}){
        function setActiveMenu(state){
            var selectorMenu = '';
            var selectorSubMenu = '';
            var element ='';

            if($('.aside').is(':visible')){
                $('#accordian').find('h3').removeClass('activeMenu');
                $('#accordian').children('ul').find('li ul li').removeClass('activeSubMenu');

                element = $('#accordian ul li');
                selectorSubMenu = $(element).find('a[data-ui-sref="'+ state +'"]').parent('li');
                selectorMenu = selectorSubMenu.closest('ul').parent('li').find('h3');
                selectorSubMenu.closest('ul').parent('li').addClass('active');
                selectorSubMenu.addClass('activeSubMenu');
                selectorMenu.addClass('activeMenu');
            }else if($('.aside-resize').is(':visible')){
                $('#accordian-resize').find('li').removeClass('active');
                $('#accordian-resize').children('ul').find('li ul li').removeClass('active');

                element = $('#accordian-resize ul li');
                selectorSubMenu = $(element).find('a[data-ui-sref="'+ state +'"]').parent('li');
                selectorMenu = selectorSubMenu.closest('ul').parent('li').find('h3');
                selectorSubMenu.closest('ul').parent('li').addClass('active');
                selectorSubMenu.addClass('active');
                selectorMenu.addClass('active');
            }
    	}

    	switch($location.path()){
            //--Menu
            case '/schedule_meeting_use': setActiveMenu('ปฏิทินการใช้ห้องประชุม'); break;
            case '/booking_add': setActiveMenu('จองห้องประชุม'); break;
            case '/cancel_booking': setActiveMenu('ยกเลิกการจอง'); break;
            case '/search_booking': setActiveMenu('ค้นหาข้อมูลการจอง'); break;
            case '/booking_status_manage': setActiveMenu('จัดการสถานะการจอง'); break;
            case '/meeting_detail': setActiveMenu('รายละเอียดห้องประชุม'); break;
            case '/report': setActiveMenu('รายงานการจอง'); break;
            case '/instructions': setActiveMenu('คำแนะนำการใช้งานระบบ'); break;
            case '/login': setActiveMenu('เข้าสู่ระบบ'); break;
            case '/register': setActiveMenu('สมัครสมาชิก'); break;
            case '/userinfo': setActiveMenu('ข้อมูลส่วนตัว'); break;
    		case '/permission': setActiveMenu('ตั้งค่าสิทธิ์การใช้งาน'); break;

            //--Menu for working
            case '/cancel_booking/' + stateParams['waitStatus']: setActiveMenu('ยกเลิกการจอง'); break; //--จัดการยกเลิกการจอง
            case '/booking_show': setActiveMenu('ค้นหาข้อมูลการจอง'); break; //--ดูข้อมูลรายการจอง
            case '/booking_edit': setActiveMenu('จองห้องประชุม'); break; //--แก้ไขรายการจอง
            case '/booking_show/' + stateParams['waitStatus']: setActiveMenu('จัดการสถานะการจอง'); break; //--จัดการสถานะที่รอให้ดำเนินการ
            case '/permission_manage': setActiveMenu('ตั้งค่าสิทธิ์การใช้งาน'); break; //--จัดการตั้งค่าสิทธิ์การใช้งาน
            default: setActiveMenu('ปฏิทินการใช้ห้องประชุม');
    	}
	}

	return initService;
})
.factory("connectDBService", function($http){
    var connectDBService = {} ;

   //--Pass data for query to database
    connectDBService.query = function(ajaxUrl, param, func){
        var options = {
            method: "POST",
            url: ajaxUrl,
            cache: false
        };

        if(param != "" && param != undefined)
            options.data = JSON.stringify(param);

        var callbackFunc = $.Callbacks();
        callbackFunc.add(func);
        callbackFunc.fire();
            
        return $http(options);
    }

    connectDBService.queryUpload = function(ajaxUrl, param){
        var options = {
            type: "POST",
            url: ajaxUrl,
            processData: false,
            contentType: false,
            data: param
        };

        return $.ajax(options);
    }

    return connectDBService;
})
.factory('dataService', function(connectDBService){
    var dataService = {};

    dataService.getDropdownList = function(scope, dropdownUsedList){
        if(dropdownUsedList.length > 0){
            var ajaxUrl = 'dbservice_ctrl';
            var param = {
                'funcName': 'getDropdownList',
                'param': [
                    'meetingRoomList', 
                    'meetingTypeList', 
                    'meetingTableTypeList', 
                    'meetingRequiredList',
                    'departmentList', 
                    'budgetTypeList', 
                    'equipmentList', 
                    'bookingStatusList',
                    'permissionStatusList'
                ]
            };

            connectDBService.query(ajaxUrl, param).success(function(response){
                if(response != "" && response != undefined){
                    $.each(dropdownUsedList, function(key, value){
                        scope[value] = response[value];
                    });
                }
            });
        }
    }

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