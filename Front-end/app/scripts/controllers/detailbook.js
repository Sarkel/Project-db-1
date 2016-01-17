'use strict';

/**
 * @ngdoc function
 * @name libraryApp.controller:DetailbookCtrl
 * @description
 * # DetailbookCtrl
 * Controller of the libraryApp
 */
angular.module('libraryApp')
  .controller('DetailbookCtrl',['$scope', '$rootScope', 'Books', '$location', '$routeParams', function ($scope, $rootScope, Books, $location, $routeParams) {
  	$scope.detailBook = {};
  	$scope.colapsedAuthors = true;
  	$scope.colapsedWyd = true;
    $scope.showComments = false;
  	$scope.selectAuthor = function (id){
  		$location.path('/authors/' + id);
  	};
  	$scope.selectWyd = function (id){
  		$location.path('/wyd/' + id);
  	};
  	$scope.borrowBook = function (book){
  		$rootScope.selectedToBorrow.push(book);
      $location.path('/');
  	};
  	var init = function (){
  		Books.getSelected($routeParams.id).then(function (result){
  			if(result.success){
  				$scope.detailBook = result.data[0];
  			} else {
  				console.log(result.msg);
          $rootScope.errorDialog(result.msg);
  			}
  		}, function (error){
  			console.log(error);
        $rootScope.errorDialog(error);
  		});
      $rootScope.watchSearch($scope);
  	};
  	init();
  }]);
