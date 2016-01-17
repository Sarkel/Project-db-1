'use strict';

/**
 * @ngdoc service
 * @name libraryApp.Users
 * @description
 * # Users
 * Service in the libraryApp.
 */
angular.module('libraryApp')
  .service('Users',['$rootScope', '$http', '$q', function ($rootScope, $http, $q) {
    var url = $rootScope.url;
    this.login = function (credentials){
    	/*return $http({
    		urlL: url + '/login',
    		method: 'POST',
    		data: credentials
    	});*/
		var deferred = $q.defer();
		deferred.resolve({
			success: true,
			msg: url,
			data: {
				id: 1,
				email: 'test@test.com',
				typ: 'ADMIN',
				avatar: 'test'
			}
		});
		return deferred.promise;
    };

    this.logout = function (){
    	/*return $http({
    		urlL: url + '/logout',
    		method: 'GET',
    	});*/
  		var deferred = $q.defer();
		deferred.resolve({
			success: true,
			msg: url,
		});
		return deferred.promise;
    };

    this.getUserDetails = function (id){
    	/*return $http({
    		urlL: url + '/users/' + id,
    		method: 'GET'
    	});*/
  		var deferred = $q.defer();
		deferred.resolve({
			success: true,
			msg: url,
			data: {
				id: id,
				email: 'test@test.com',
				typ: 'ADMIN',
				avatar: 'test',
				nazwisko: 'test',
				imie: 'test',
				komorka: 12312313,
				ulica: 'test',
				numerDomu: 1,
				kodPocztowy: "42-350",
				miejscowosc: 'test',
				kraj: 'test',
				debet: 10
			}
		});
		return deferred.promise;
    };

    this.getAllUsers = function (){
    	/*return $http({
    		urlL: url + '/users,
    		method: 'GET'
    	});*/
		var deferred = $q.defer();
		deferred.resolve({
			success: true,
			msg: url,
			data: [
				{
					id: 1,
					email: 'test@test.com',
					typ: 'ADMIN',
					avatar: 'test',
					nazwisko: 'test',
					imie: 'test',
					aktive: true
				},{
					id: 1,
					email: 'test@test.com',
					typ: 'ADMIN',
					avatar: 'test',
					nazwisko: 'test',
					imie: 'test',
					aktive: true
				}
			]
		});
		return deferred.promise;
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
