'use strict';

/**
 * @ngdoc function
 * @name libraryApp.controller:KoszykCtrl
 * @description
 * # KoszykCtrl
 * Controller of the libraryApp
 */
angular.module('libraryApp')
  .controller('KoszykCtrl',['$scope', '$rootScope', '$location', 'Books', function ($scope, $rootScope, $location, Books) {
    $scope.isEmpty = $rootScope.selectedToBorrow.length === 0 ? true : false;
    $scope.clearBasket = function (){
    	$rootScope.selectedToBorrow = [];
    	$location.path('/');
    };
    $scope.removeBook = function (id){
    	for(var i=0; i<$rootScope.selectedToBorrow.length; i++){
    		if($rootScope.selectedToBorrow[i].id === id) {
    			$rootScope.selectedToBorrow.slice(i, 1);
    			break;
    		}
    	}
    };

    $scope.borrow = function (){
        var userId = $rootScope.user.id;
        var bookIds = [];
        $rootScope.selectedToBorrow.forEach(function (value){
            bookIds.push(value.id);
        });
        Books.borrowBooks(userId, bookIds).then(function (result){
            if(result.success){
                $scope.clearBasket();
            } else {
                console.log(result.msg);
                $rootScope.errorDialog(result.msg);
            }
        }, function (err){
            console.log(err);
            $rootScope.errorDialog(err);
        });
    };
    $rootScope.watchSearch($scope);
  }]);
