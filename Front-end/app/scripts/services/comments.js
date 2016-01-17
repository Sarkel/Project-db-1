'use strict';

/**
 * @ngdoc service
 * @name Game.Comments
 * @description
 * # Comments
 * Service in the Game.
 */
angular.module('Game')
  .service('Comments', ['$rootScope', '$http', '$q', function ($rootScope, $http, $q) {
    var url = $rootScope.url;

    this.createComment = function (comment){
    	return $http({
    		url: url + '/comments',
    		method: 'POST',
    		data: comment
    	});
    };

    this.getAllCommentsByBook = function (bookId) {
    	return $http({
    		url: url + '/comments/book/id/' + bookId,
    		method: 'GET'
    	});
    };

    this.getAllCommentsByUser = function (userId) {
    	return $http({
    		url: url + '/comments/user/id/' + userId,
    		method: 'GET'
    	});
    };
  }]);
