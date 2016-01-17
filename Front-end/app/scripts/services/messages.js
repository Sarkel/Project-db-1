'use strict';

/**
 * @ngdoc service
 * @name libraryApp.Messages
 * @description
 * # Messages
 * Service in the libraryApp.
 */
angular.module('libraryApp')
  .service('Messages', ['$rootScope', '$http', '$q', function ($rootScope, $http, $q) {
    var url = $rootScope.url;
    this.send = function (message){
    	/*return $http({
    		url: url + '/messages',
    		method: 'POST',
    		data: message
    	});*/
  var deferred = $q.defer();
  	deferred.resolve({
  		success: true,
  		msg: url,
  		data: [
  			{
  				id: 1,
  				adresat: {
  					id: 1,
  					imie: 'test',
  					nazwisko: 'test'
  				},
  				odbiorca: {
  					id: 2,
  					imie: 'test',
  					nazwisko: 'test'
  				},
  				data: '24-12-2017',
  				tekst: 'test'
  			},
  			{
  				id: 2,
  				adresat: {
  					id: 1,
  					imie: 'test',
  					nazwisko: 'test'
  				},
  				odbiorca: {
  					id: 2,
  					imie: 'test',
  					nazwisko: 'test'
  				},
  				data: '24-12-2017',
  				tekst: 'test'
  			}
  		]
  	});
  	return deferred.promise;
    };

    this.getAll = function (){
    	return $http({
    		url: url + '/messages',
    		method: 'GET'
    	});
    };

    this.getDetail = function (id) {
    	/*return $http({
    		url: url + '/messages/id/' + id,
    		method: 'GET'
    	});*/
  var deferred = $q.defer();
  	deferred.resolve({
  		success: true,
  		msg: url,
  		data: {
  				id: id,
  				adresat: {
  					id: 1,
  					imie: 'test',
  					nazwisko: 'test'
  				},
  				odbiorca: {
  					id: 2,
  					imie: 'test',
  					nazwisko: 'test'
  				},
  				data: '24-12-2017',
  				tekst: 'test'
  			}
  		
  	});
  	return deferred.promise;
    };
  }]);
