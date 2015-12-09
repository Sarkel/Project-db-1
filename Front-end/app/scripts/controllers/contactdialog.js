'use strict';

/**
 * @ngdoc function
 * @name libraryApp.controller:ContactdialogCtrl
 * @description
 * # ContactdialogCtrl
 * Controller of the libraryApp
 */
angular.module('libraryApp')
  .controller('ContactdialogCtrl',['$scope', 'ngDialog', function ($scope, ngDialog) {
    
    var listener = $scope.$on('contactDialogEvent', function (event, result) {
    	$scope.dialogId = result.dialogId;
    });

    $scope.$on('$destroy', listener);

    $scope.msg = {
    	email: '',
    	topic: '',
    	content: ''
    };

    $scope.close = function (){
    	$scope.msg = {
	    	email: '',
	    	topic: '',
	    	content: ''
	    };
    	ngDialog.close($scope.dialogId);
    };

    $scope.submit = function (){
    	console.log($scope.msg);
    };
  }]);
