'use strict';

/**
 * @ngdoc function
 * @name libraryApp.controller:MapsCtrl
 * @description
 * # MapsCtrl
 * Controller of the libraryApp
 */
angular.module('libraryApp')
  .controller('MapsCtrl', ['$scope', 'ngDialog',function ($scope, ngDialog) {
    var listener = $scope.$on('mapDialogEvent', function (event, result) {
    	$scope.dialogId = result.dialogId;
    });

    $scope.$on('$destroy', listener);
  }]);
