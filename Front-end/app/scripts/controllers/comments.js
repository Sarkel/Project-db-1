'use strict';

/**
 * @ngdoc function
 * @name libraryApp.controller:CommentsCtrl
 * @description
 * # CommentsCtrl
 * Controller of the libraryApp
 */
angular.module('libraryApp')
  .controller('CommentsCtrl', ['$rootScope', '$scope', 'Comments', '$location', '$routeParams',  function ($rootScope, $scope, Comments, $location, $routeParams) {
    $scope.selectBook = function (bookId){
    	$location.path('/books/' + bookId);
    };

    $scope.comments = [];

    var init = function (){
    	var res = null;
    	if($location.path().indexOf('/users/') !== -1){
    		res = Comments.getAllCommentsByUser($rootScope.user.id);
    	} else if($location.path().indexOf('/books/') !== -1){
    		res = Comments.getAllCommentsByUser($routeParams.id);
    	} else {
    		return;
    	}
    	
    	res.then(function (result){
    		if(result.success){
    			$scope.comments = result.data;
    		} else {
    			console.log(result.msg);
    		}
    	}, function (err){
    		console.log(err);
    	});
    };

    init();
  }]);
