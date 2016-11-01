angular.module('mainApp')
.directive('activeMenu', function(){
	return {
		restrict: 'A',
		link: function(scope, element, attrs, constructor){
			element.bind('click', function(){
				$('#accordian').find('h3').removeClass('activeMenu');
				$(element).parent('ul').closest('li').find('h3').addClass('activeMenu');
				$('#accordian').children('ul').find('li ul li').removeClass('activeSubMenu');
				$(element).addClass('activeSubMenu');
			});
		}
	}
});