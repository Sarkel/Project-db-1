'use strict';

/**
 * @ngdoc function
 * @name libraryApp.controller:ErrorCtrl
 * @description
 * # ErrorCtrl
 * Controller of the libraryApp
 */
angular.module('libraryApp')
  .controller('ErrorCtrl',['$rootScope', '$scope', 'ngDialog', '$window', '$location', function ($rootScope, $scope, ngDialog, $window, $location) {
    var listener = $scope.$on('errorEvent', function (event, result) {
    	$scope.dialogId = result.dialogId;
    });

    $scope.$on('$destroy', listener);

    $scope.close = function (){
    	ngDialog.close($scope.dialogId);
    	$location.path('/');
    	$window.location.reload();
    };
  }]);
