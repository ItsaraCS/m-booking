angular.module('mainApp')
.config(function($routeProvider){
	$routeProvider
		.when('/', {
			controller: 'mainController',
			templateUrl: 'templates/index.php'
		})
		.when('/instructions', {
			controller: 'instructionsController',
			templateUrl: 'templates/instructions.php'
		})
		.otherwise({
			redirectTo: '/'
		});
});