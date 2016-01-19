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

  	$scope.isColapsedAuthors = false;

  	$scope.isColapsedWyd = false;

    $scope.isShown = false;

    $scope.colapsedAuthors = function (){
      $scope.isColapsedAuthors = !$scope.isColapsedAuthors;
      $scope.isColapsedWyd = false;
      $scope.isShown = false;
    };

    $scope.colapsedWyd = function (){
      $scope.isColapsedWyd = !$scope.isColapsedWyd;
      $scope.isShown = false;
      $scope.isColapsedAuthors = false;
    };

    $scope.showComments = function (){
      $scope.isShown = !$scope.isShown;
      $scope.isColapsedAuthors = false;
      $scope.isColapsedWyd = false;
    };

  	$scope.selectAuthor = function (){
  	//	$location.path('/authors/' + id);
  	};

  	$scope.selectWyd = function (){
  	//	$location.path('/wyd/' + id);
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
        $rootScope.errorDialog('Coś poszło nie tak.');
  		});
      $rootScope.watchSearch($scope);
  	};

  	init();
  }]);
