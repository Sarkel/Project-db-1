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
    var url = $rootScope.url;
    this.send = function (message){
    	return $http({
    		url: url + '/messages',
    		method: 'POST',
    		data: message
    	});
    };

    this.getAll = function (){
    	return $http({
    		url: url + '/messages',
    		method: 'GET'
    	});
    };

    this.getDetail = function (id) {
    	return $http({
    		url: url + '/messages/id/' + id,
    		method: 'GET'
    	});
    };
  }]);
