'use strict';

/**
 * @ngdoc service
 * @name libraryApp.Comments
 * @description
 * # Comments
 * Service in the libraryApp.
 */
angular.module('libraryApp')
  .service('Comments', ['$rootScope', '$http', function ($rootScope, $http) {
    var url = 'App/api.php';

    this.createComment = function (comment){
    	return $http.post(url + '/comments', comment);
    };

    this.getAllCommentsByBook = function (bookId) {
    	return $http.get(url + '/comments/book/id/' + bookId);
    };

    this.getAllCommentsByUser = function (userId) {
    	return $http.get(url + '/comments/user/id/' + userId);
    };
  }]);
