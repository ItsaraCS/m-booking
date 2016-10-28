angular.module('mainApp', ['ngRoute']);

angular.module('mainApp')
.controller('mainController', function($scope){
	console.log('This is Ctrl of page: mainController');
})
.controller('instructionsController', function($scope){
	console.log('This is Ctrl of page: instructionsController');
});