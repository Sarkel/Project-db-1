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

    $scope.login = function (){
    	$rootScope.isLogged = true;
    	$rootScope.user.login = $scope.currentUser.login + '@' + $scope.currentUser.domain;
    };

    $scope.showPwd = function () {

    };
  }]);
