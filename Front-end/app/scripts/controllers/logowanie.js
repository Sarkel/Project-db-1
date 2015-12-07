'use strict';

/**
 * @ngdoc function
 * @name libraryApp.controller:LogowanieCtrl
 * @description
 * # LogowanieCtrl
 * Controller of the libraryApp
 */
angular.module('libraryApp')
  .controller('LogowanieCtrl', ['$scope', '$rootScope', function ($scope, $rootScope) {
    $scope.currentUser = {
    	login: '',
    	domain: '',
    	password: ''
    };
    $rootScope.user = {};
    $scope.login = function (){
    	$rootScope.isLogged = true;
    	$rootScope.user.login = $scope.currentUser.login + '@' + $scope.currentUser.domain;
    	$rootScope.user = {
    		test1: 'test1',
    		test2: 'test2',
    		test3: 'test3',
    		test4: 'test4'
    	};
    };
  }]);
