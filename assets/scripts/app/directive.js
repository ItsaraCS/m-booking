angular.module('mainApp')
.directive('required', function($compile){
	return {
		restrict: 'A',
		require: 'ngModel',
		link: function(scope, element, attrs, ngModel){
			//--Add symbol '*' to element is required
			var requiredInfo = $(element).parent('.input-group').find('span:eq(0)');
			var requiredInfoContent = '<span style="font-size: 18px; color: #fe3d3d;"> *</span>';
			$(requiredInfo).append(requiredInfoContent);

			//--Add error content
			var selector = $(element).parent().parent();
			var label = ($(element).parent('.input-group').find('span:eq(0)').text()).replace(' *', '');
			var labelError = $(element).data('label-error') || 'ห้ามเว้นว่าง';
			var errorContent = '<span class="text-error" data-ng-show="';
			errorContent += ngModel.$$parentForm.$name +'.'+ attrs['name'] +'.$dirty && ';
			errorContent += ngModel.$$parentForm.$name +'.'+ attrs['name'] +'.$error.required">';
			errorContent += '<i class="fa fa-exclamation-circle"></i> '+ label +' '+ labelError;
			errorContent += '</span>';

			$(selector).append($compile(errorContent)(scope));

			element.bind('blur', function(){
				scope.$digest();
			});
		}
	}
})
.directive('validateType', function($compile){
	return {
		restrict: 'A',
      	require: 'ngModel',
		link: function(scope, element, attrs, ngModel){
			var selector = $(element).parent().parent();
			var label = ($(element).parent('.input-group').find('span:eq(0)').text()).replace(' *', '');
			var labelError = $(element).data('label-error') || 'ไม่ถูกต้อง';
			var errorContent = '<span class="text-error" data-ng-show="';
			errorContent += ngModel.$$parentForm.$name +'.'+ attrs['name'] +'.$dirty && ';
			errorContent += ngModel.$$parentForm.$name +'.'+ attrs['name'] +'.$error.' + attrs['type'] +'">';
			errorContent += '<i class="fa fa-exclamation-circle"></i> '+ label +' '+ labelError;
			errorContent += '</span>';

			$(selector).append($compile(errorContent)(scope));
		}
	}
})
.directive('validateUnique', function($compile, connectDBService){
	return {
		restrict: 'A',
		require: 'ngModel',
		link: function(scope, element, attrs, ngModel){
			var selector = $(element).parent().parent();
			var label = ($(element).parent('.input-group').find('span:eq(0)').text()).replace(' *', '');
			var labelError = $(element).data('label-error') || 'นี้ซ้ำ';
			var errorContent = '<span class="text-error" data-ng-show="';
			errorContent += ngModel.$$parentForm.$name +'.'+ attrs['name'] +'.$dirty && ';
			errorContent += ngModel.$$parentForm.$name +'.'+ attrs['name'] +'.$error.unique">';
			errorContent += '<i class="fa fa-exclamation-circle"></i> '+ label +' '+ labelError;
			errorContent += '</span>';

			$(selector).append($compile(errorContent)(scope));

			var ajaxUrl = 'dbservice_ctrl';
			var param = {
				'funcName': 'validateUnique',
				'param': {
					'tblName': element.data('unique-table') || '',
					'fieldName': element.data('unique-field') || ''
				}
			};

			element.bind('keydown keypress', function(){
				ngModel.$setValidity('unique', true);

				scope.$digest();
			});

			element.bind('blur', function(){
				if(ngModel.$modelValue != '' && ngModel.$modelValue != undefined){
					param['param']['param'] = element.val();

					connectDBService.query(ajaxUrl, param).success(function(response){
						if(response != '' && response != undefined){
							var uniqueStatus = $.parseJSON(response);
							
							ngModel.$setValidity('unique', true);

							if(uniqueStatus)
								ngModel.$setValidity('unique', false);
						}
					});
				}
			});
		}
	}
})
.directive('numbered', function($compile){
	return {
		restrict: 'A',
      	require: 'ngModel',
		link: function(scope, element, attrs, ngModel){
			var selector = $(element).parent().parent();
			var label = ($(element).parent('.input-group').find('span:eq(0)').text()).replace(' *', '');
			var labelError = $(element).data('label-error') || 'ต้องเป็นตัวเลขเท่านั้น';
			var errorContent = '<span class="text-error" data-ng-show="';
			errorContent += ngModel.$$parentForm.$name +'.'+ attrs['name'] +'.$dirty && ';
			errorContent += ngModel.$$parentForm.$name +'.'+ attrs['name'] +'.$error.numbered">';
			errorContent += '<i class="fa fa-exclamation-circle"></i> '+ label +' '+ labelError;
			errorContent += '</span>';

			$(selector).append($compile(errorContent)(scope));

			var ctrlDown = false; //--ctrl button on event button down
			var ctrlKey = '17'; //--ctrl button
			var cKey = '67'; //--c button
			var vKey = '86'; //--v button

			element.bind('keyup', function(e){
				if(e.keyCode == ctrlKey)
					ctrlDown = false;

				keyDownFunc(e);
				scope.$apply();
			});

			element.bind('keydown', function(e){
				if(e.keyCode == ctrlKey)
					ctrlDown = true;

				keyDownFunc(e);
				scope.$apply();
			});

			var keyDownFunc = function(e){
				if((ctrlDown && (e.keyCode == cKey)) || (ctrlDown && (e.keyCode == vKey))){
					ngModel.$setValidity('numbered', true);

					if(isNaN(element.val())){
						element.val('');
		            	ngModel.$dirty = true;
		            	ngModel.$setValidity('numbered', false);
					}
				}

				scope.$digest();
			}

			element.bind('keypress', function(e){
				if(e.keyCode != 8 && isNaN(String.fromCharCode(e.keyCode))){
		            e.preventDefault();
		            ngModel.$dirty = true;
		            ngModel.$setValidity('numbered', false);

		            if(attrs['required'])
		            	ngModel.$setValidity('required', true);
				}else
					ngModel.$setValidity('numbered', true);

				scope.$digest();
			});

			element.bind('blur', function(e){
				ngModel.$setValidity('numbered', true);
				
				if(attrs['required'] && element.val() == '')
		            ngModel.$setValidity('required', false);

				scope.$digest();
			});
		}
	}
})
.directive('validateStartDateTime', function($compile, dataService){
	return {
		restrict: 'A',
		require: 'ngModel',
		link: function(scope, element, attrs, ngModel){
			var selector = $(element).parent().parent();
			var label = ($(element).parent('.input-group').find('span:eq(0)').text()).replace(' *', '');
			var labelError = $(element).data('label-error') || 'ต้องไม่เกินวันที่เสร็จสิ้นประชุม';
			var errorContent = '<span class="text-error" data-ng-show="';
			errorContent += ngModel.$$parentForm.$name +'.'+ attrs['name'] +'.$dirty && ';
			errorContent += ngModel.$$parentForm.$name +'.'+ attrs['name'] +'.$error.startDateTime">';
			errorContent += '<i class="fa fa-exclamation-circle"></i> '+ label +' '+ labelError;
			errorContent += '</span>';

			$(selector).append($compile(errorContent)(scope));

			element.bind('blur', function(){
				var endDate = $(element).closest('form').find('input[name="end_date"]').val();
				var endTime = $(element).closest('form').find('input[name="end_time"]').val() || '00:00';
				
				if(endDate != '' && endDate != undefined){
					scope.$watchCollection('[entryBooking.start_date, entryBooking.start_time]', function(startDateTime){
						if(startDateTime[0] != '' && startDateTime[0] != undefined){
							newStartDateTime = new Date(dataService.getDateFormateForDB(startDateTime[0]) +' '+ (startDateTime[1] || '00:00'));
							newEndDateTime = new Date(dataService.getDateFormateForDB(endDate) +' '+ endTime);
							
							if(newStartDateTime > newEndDateTime)
								ngModel.$setValidity('startDateTime', false);
							else
								ngModel.$setValidity('startDateTime', true);
						}
					});
				}

				scope.$digest();
			});
		}
	}
})
.directive('validateEndDateTime', function($compile, dataService){
	return {
		restrict: 'A',
		require: 'ngModel',
		link: function(scope, element, attrs, ngModel){
			var selector = $(element).parent().parent();
			var label = ($(element).parent('.input-group').find('span:eq(0)').text()).replace(' *', '');
			var labelError = $(element).data('label-error') || 'ต้องไม่น้อยกว่าวันที่เริ่มประชุม';
			var errorContent = '<span class="text-error" data-ng-show="';
			errorContent += ngModel.$$parentForm.$name +'.'+ attrs['name'] +'.$dirty && ';
			errorContent += ngModel.$$parentForm.$name +'.'+ attrs['name'] +'.$error.endDateTime">';
			errorContent += '<i class="fa fa-exclamation-circle"></i> '+ label +' '+ labelError;
			errorContent += '</span>';

			$(selector).append($compile(errorContent)(scope));

			element.bind('blur', function(){
				var startDate = $(element).closest('form').find('input[name="start_date"]').val();
				var startTime = $(element).closest('form').find('input[name="start_time"]').val() || '00:00';
				
				if(startDate != '' && startDate != undefined){
					scope.$watchCollection('[entryBooking.end_date, entryBooking.end_time]', function(endDateTime){
						if(endDateTime[0] != '' && endDateTime[0] != undefined){
							newStartDateTime = new Date(dataService.getDateFormateForDB(startDate) +' '+ startTime);
							newEndDateTime = new Date(dataService.getDateFormateForDB(endDateTime[0]) +' '+ (endDateTime[1] || '23:59'));

							if(newEndDateTime < newStartDateTime)
								ngModel.$setValidity('endDateTime', false);
							else
								ngModel.$setValidity('endDateTime', true);
						}
					});
				}

				scope.$digest();
			});
		}
	}
})
.directive('activeMenu', function(){
	return {
		restrict: 'A',
		link: function(scope, element, attrs, ngModel){
			element.bind('click', function(){
				//--Set active menu
				$('#accordian').find('h3').removeClass('activeMenu');
				$(element).parent('ul').closest('li').find('h3').addClass('activeMenu');
				$('#accordian').children('ul').find('li ul li').removeClass('activeSubMenu');
				$(element).addClass('activeSubMenu');
			});
		}
	}
})
.directive('activePagination', function($stateParams){
	return {
		restrict: 'A',
		link: function(scope, element, attrs, ngModel){
			element.bind('click', function(){
				$(element).closest('ul').find('li').removeClass('disabled active');
				
				if(attrs.value == 1)
					$(element).addClass('active').prev().addClass('disabled');
				else if(attrs.value == scope.totalPage)
					$(element).addClass('active').next().addClass('disabled');
				else if(attrs.value == 'prev')
					$(element).addClass('disabled').next().addClass('active');
				else if(attrs.value == 'next')
					$(element).addClass('disabled').prev().addClass('active');
				else
					$(element).addClass('active');
			});
		}
	}
})
.directive('panelGroupCollapse', function(initService){
	return {
		restrict: 'A',
		link: function(scope, element, attrs, ngModel){
			var panelHeading = $(element).find('.panel-heading');
			var panelCollapse = $(element).find('.panel-collapse');
			var panelDirection = $(element).find('.panel-heading i.collapse');
			var ariaExpended;
			panelHeading.css({ 'cursor': 'pointer' });
			panelDirection.css({ 'float': 'right', 'padding-top': '3px' });

			$(document).on('click', panelHeading, function(){
				initService.setResizePage();
				ariaExpended = $(element).find(panelCollapse).attr('aria-expanded');

				if(ariaExpended == 'true')
					$(panelDirection).removeClass('fa-chevron-right').addClass('fa-chevron-down');
				else
					$(panelDirection).removeClass('fa-chevron-down').addClass('fa-chevron-right');
			});
		}
	}
});