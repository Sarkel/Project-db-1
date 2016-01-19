'use strict';

/**
 * @ngdoc function
 * @name libraryApp.controller:OptionsCtrl
 * @description
 * # OptionsCtrl
 * Controller of the libraryApp
 */
angular.module('libraryApp')
  .controller('OptionsCtrl', ['$scope', '$rootScope', '$routeParams', '$location', 'Users', function ($scope, $rootScope, $routeParams, $location, Users) {
    $scope.userType = $routeParams.type === 'admin' ? true : false;
    console.log($scope.userType);
    $scope.users = [];

    $scope.searchResult = '';

    $scope.select = function (id){
    	$location.path(/users/ + id);
    };

    var init = function (){
    	Users.getAllUsers().then(function (result){
    		if(result.success){
    			$scope.users = result.data;
    		} else {
    			console.log(result.msg);
    			$rootScope.errorDialog(result.msg);
    		}
    	}, function (err){
    		console.log(err);
    		$rootScope.errorDialog('Coś poszło nie tak.');
    	});
    	$rootScope.watchSearch($scope);
    };
    init();
  }]);
