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
    var url = 'App/api.php';
    this.login = function (credentials){
    	return $http.post(url + '/login', credentials);
    };

    this.logout = function (){
    	return $http.get(url + '/logout');
    };

    this.getUserDetails = function (id){
    	return $http.get(url + '/users/id/' + id);
    };

    this.getAllUsers = function (){
    	return $http.get(url + '/users');
    };

    this.updateUser = function (user, address){
    	return $http.put(url + '/users/update', {
                user: user,
                address: address
            });
    };
  }]);
