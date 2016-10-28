angular.module('mainApp')
.directive('activeMenu', function(){
	return {
		restrict: 'A',
		link: function(scope, element, attrs, constructor){
			var activeList = { 'background-color': '#CCCCCC' };
			var unActiveList = { 'background-color': '#E6E6E6' };
			var activeUnorderList = { 'background-color': '#F68002' };
			var unActiveUnorderList = { 'background-color': '#4CAF50' };

			element.bind('click', function(){
				$('#accordian').find('h3').css(unActiveUnorderList);
				$(element).parent('ul').closest('li').find('h3').css(activeUnorderList);
				$('#accordian').children('ul').find('li ul li').css(unActiveList);
				$(element).css(activeList);
			});
		}
	}
});