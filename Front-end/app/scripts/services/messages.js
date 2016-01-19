'use strict';

/**
 * @ngdoc service
 * @name libraryApp.Messages
 * @description
 * # Messages
 * Service in the libraryApp.
 */
angular.module('libraryApp')
  .service('Messages', ['$rootScope', '$http', function ($rootScope, $http) {
    var url = 'App/api.php';
    this.send = function (message){
    	return $http.post(url + '/messages', message);
    };

    this.getAll = function (){
    	return $http.get(url + '/messages');
    };

    this.getDetail = function (id) {
    	return $http.get(url + '/messages/id/' + id);
    };
  }]);
