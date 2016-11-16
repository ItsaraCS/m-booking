angular.module('mainApp')
.factory('initService', function($rootScope, $location, $stateParams, connectDBService){
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

    initService.activeMenu = function(){
        function setActiveMenu(state, menuIdx){
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
            case '/booking_add': setActiveMenu('จองห้องประชุม', 1); break;
            case '/cancel_booking/': setActiveMenu('ยกเลิกการจอง'); break;
            case '/search_booking/': setActiveMenu('ค้นหาข้อมูลการจอง'); break;
            case '/booking_status_manage/': setActiveMenu('จัดการสถานะการจอง'); break;
            case '/meeting_detail': setActiveMenu('รายละเอียดห้องประชุม'); break;
            case '/instructions': setActiveMenu('คำแนะนำการใช้งานระบบ'); break;
            case '/login': setActiveMenu('เข้าสู่ระบบ'); break;
            case '/register': setActiveMenu('สมัครสมาชิก'); break;
            case '/userinfo': setActiveMenu('ข้อมูลส่วนตัว'); break;
    		case '/permission/': setActiveMenu('ตั้งค่าสิทธิ์การใช้งาน'); break;

            //--Menu for working
            case '/booking_show/showScheduleMeetingUse': setActiveMenu('ปฏิทินการใช้ห้องประชุม'); break; //--ปฏิทินการใช้ห้องประชุม
            case '/booking_show/showCancelBooking': setActiveMenu('ยกเลิกการจอง'); break; //--ยกเลิกการจอง
            case '/booking_show/showSearchBooking': setActiveMenu('ค้นหาข้อมูลการจอง'); break; //--ค้นหาข้อมูลการจอง
            case '/booking_show/showManageStatusBooking': setActiveMenu('จัดการสถานะการจอง'); break; //--จัดการสถานะการจอง
            case '/booking_edit/': setActiveMenu('ค้นหาข้อมูลการจอง'); break; //--แก้ไขรายการจอง
            case '/cancel_booking/cancel': setActiveMenu('ยกเลิกการจอง'); break; //--จัดการยกเลิกการจอง
            case '/booking_status_manage/waitapprove': setActiveMenu('จัดการสถานะการจอง'); break; //--จัดการสถานะที่รอให้ดำเนินการ
            case '/booking_status_manage/waitcancel': setActiveMenu('จัดการสถานะการจอง'); break; //--จัดการสถานะที่รอให้ดำเนินการ
            case '/permission_manage/'+ $stateParams['userID']: setActiveMenu('ตั้งค่าสิทธิ์การใช้งาน'); break; //--จัดการตั้งค่าสิทธิ์การใช้งาน
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

    dataService.filterObjUsed = function(obj, filterKey){
        var newObj = {};

        $.each(obj, function(key, value){
            if($.inArray(key, filterKey) != -1)
                newObj[key] = value;
        });

        return newObj;
    }

    dataService.filterObjNoUsed = function(obj, filterKey){
        var newObj = {};

        $.each(obj, function(key, value){
            if($.inArray(key, filterKey) == -1)
                newObj[key] = value;
        });

        return newObj;
    }

    dataService.filterArrUsed = function(array, filterKey){
        var newObj = {};
        var newArr = [];

        $.each(array, function(index, item){
            newObj = {};
            $.each(item, function(key, value){
                if($.inArray(key, filterKey) != -1)
                    newObj[key] = value;
            });
            newArr.push(newObj);
        });

        return newArr;
    }

    dataService.filterArrNoUsed = function(array, filterKey){
        var newObj = {};
        var newArr = [];

        $.each(array, function(index, item){
            newObj = {};
            $.each(item, function(key, value){
                if($.inArray(key, filterKey) == -1)
                    newObj[key] = value;
            });
            newArr.push(newObj);
        });

        return newArr;
    }

    dataService.getDataObjChange = function(originData, updateData, primaryKey){
        var dataObjChange = {};

        $.each(originData, function(keyOrigin, valOrigin){
            $.each(updateData, function(keyUpdate, valUpdate){
                if(keyOrigin == keyUpdate){
                    if(valOrigin != valUpdate){
                        if(primaryKey != '' && primaryKey != undefined)
                            dataObjChange['condition'] = primaryKey +" = '"+ updateData[primaryKey] +"'";

                        dataObjChange[keyUpdate] = valUpdate;
                    }
                }
            });
        });

        return dataObjChange;
    }

    dataService.getDataArrChange = function(originData, updateData, primaryKey){
        var dataArrChange = [];
        var dataObjChange = {};

        $.each(originData, function(originIndex, originItem){
            dataObjChange = {};

            $.each(originItem, function(keyOrigin, valOrigin){
                $.each(updateData[originIndex], function(keyUpdate, valUpdate){
                    if(keyOrigin == keyUpdate){
                        if(valOrigin != valUpdate){
                            if(primaryKey != '' && primaryKey != undefined)
                                dataObjChange['condition'] = primaryKey +" = '"+ updateData[originIndex][primaryKey] +"'";

                            dataObjChange[keyUpdate] = valUpdate;
                        }
                    }
                });
            });
            
            if(!$.isEmptyObject(dataObjChange))
                dataArrChange.push(dataObjChange);
        });

        return dataArrChange;
    }

    dataService.detectDataArrChange = function(originData, updateData, detectKey, primaryKey){
        var dataArrChange = {
            'insertData': [],
            'deleteData': []
        };

        $.each(originData, function(originIndex, originItem){
            $.each(originItem, function(keyOrigin, valOrigin){
                if(keyOrigin == detectKey){
                    $.each(updateData[originIndex], function(keyUpdate, valUpdate){
                        if(keyUpdate == detectKey){
                            if(valOrigin != valUpdate){
                                if(valUpdate != 0)
                                    dataArrChange['insertData'].push(updateData[originIndex]);
                                else{
                                    updateData[originIndex]['condition'] = primaryKey +" = '"+ updateData[originIndex][primaryKey] +"'";
                                    dataArrChange['deleteData'].push(updateData[originIndex]);
                                }
                            }
                        }
                    });
                }
            });
        });

        if((dataArrChange['insertData'].length != 0) || (dataArrChange['deleteData'].length != 0))
            return dataArrChange;
        else
            return {}
    }

    dataService.getDateFormateForDB = function(dateOrigin){
        if(dateOrigin != '' && dateOrigin != undefined){
            var dateFormateForDB = '';

            dateOrigin = dateOrigin.split('/');
            dateFormateForDB = (Number(dateOrigin[2]) - 543) +'-'+ dateOrigin[1] +'-'+ dateOrigin[0];

            return dateFormateForDB;
        }

        var now = new Date();
        var today = now.getFullYear() + '-';
        today += (now.getMonth() + 1) + '-';
        today += (now.getDate().toString().length < 2 ? ('0' + now.getDate()) : now.getDate());

        return today;
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