'use strict';

/**
 * @ngdoc service
 * @name libraryApp.Users
 * @description
 * # Users
 * Service in the libraryApp.
 */
angular.module('libraryApp')
  .service('Users',['$rootScope', '$http', function ($rootScope, $http) {
    var url = $rootScope.url;
    this.login = function (credentials){
    	return $http({
    		urlL: url + '/login',
    		method: 'POST',
    		data: credentials
    	});
    };

    this.logout = function (){
    	return $http({
    		urlL: url + '/logout',
    		method: 'GET',
    	});
    };

    this.getUserDetails = function (id){
    	return $http({
    		urlL: url + '/users/id/' + id,
    		method: 'GET'
    	});
    };

    this.getAllUsers = function (){
    	return $http({
    		urlL: url + '/users',
    		method: 'GET'
    	});
    };

    this.updateUser = function (user, address){
    	return $http({
    		url: url + '/users/update',
    		method: 'PUT',
    		data: {
    			user: user,
    			address: address
    		}
    	});
    };
  }]);
