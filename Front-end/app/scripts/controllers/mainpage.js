'use strict';

/**
 * @ngdoc function
 * @name libraryApp.controller:MainpageCtrl
 * @description
 * # MainpageCtrl
 * Controller of the libraryApp
 */
angular.module('libraryApp')
  .controller('MainpageCtrl', ['$rootScope', '$scope', '$location', 'Books', function ($rootScope, $scope, $location, Books) {
  	$scope.books = [];
  	
  	$scope.selectBook = function (id){
  		$location.path('/books/' + id);
  	};

    var listener = $scope.$on('searchResults', function (event, result){
      $scope.books = result;
    });

    $scope.$on('$destroy', listener);

  	var init = function (){
  		Books.getAll()
  		.then(function (result){
  			if(result.success){
  				$scope.books = result.data;
  			} else {
  				console.log(result.msg);
          $rootScope.errorDialog(result.msg);
  			}
  		}, function (err) {
  			console.log(err);
        $rootScope.errorDialog(err);
  		});
      $rootScope.watchSearch($scope);
  	};
  	init();
  }]);
