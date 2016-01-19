'use strict';

/**
 * @ngdoc function
 * @name libraryApp.controller:CommentsCtrl
 * @description
 * # CommentsCtrl
 * Controller of the libraryApp
 */
angular.module('libraryApp')
  .controller('CommentsCtrl', ['$rootScope', '$scope', 'Comments', '$location', '$routeParams', 'ngDialog',  function ($rootScope, $scope, Comments, $location, $routeParams, ngDialog) {
    $scope.selectBook = function (bookId){
    	$location.path('/books/' + bookId);
    };

    var listener = $scope.$on('addComment', function (event, result) {
        $scope.dialogId = result.dialogId;
    });

    $scope.$on('$destroy', listener);

    $scope.comments = [];

    $scope.content = '';

    $scope.save = function (){
        Comments.createComment({
            uzytkownik: $rootScope.user.id,
            data: Date.now(),
            tekst: $scope.content,
            ksiazka: $routeParams.id
        }).then(function (result){
            if(result.success){
                $scope.content = '';
                $scope.close($scope.dialogId);
            } else {
                console.log(result.msg);
                $rootScope.errorDialog('Coś poszło nie tak.');
            }
        }, function (err){
            console.log(err);
            $rootScope.errorDialog('Coś poszło nie tak.');
        });
    };

    $scope.close = function (){
        ngDialog.close($scope.dialogId);
    };

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
                $rootScope.errorDialog('Coś poszło nie tak.');
    		}
    	}, function (err){
    		console.log(err);
            $rootScope.errorDialog('Coś poszło nie tak.');
    	});

    };

    init();
  }]);
