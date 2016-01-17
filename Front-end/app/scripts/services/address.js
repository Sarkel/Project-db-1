'use strict';

/**
 * @ngdoc service
 * @name libraryApp.Address
 * @description
 * # Address
 * Service in the libraryApp.
 */
angular.module('libraryApp')
  .service('Address', ['$rootScope', '$http', '$q', function ($rootScope, $http, $q) {
    var url = $rootScope.url;

    this.searchAdress = function (searchParam){
    	/*return $http({
    		url: url + 'adress/search/' + searchParam,
    		method: 'GET'
    	});*/
  		var deferred = $q.defer();
		deferred.resolve({
			success: true,
			msg: url,
			data: [
				{
					id: 1,
					kodPocztowy: 'test@test.com',
					miejscowosc: 'ADMIN',
					kraj: 'test'
				},{
					id: 1,
					kodPocztowy: 'test@test.com',
					miejscowosc: 'ADMIN',
					kraj: 'test'
				}
			]
		});
		return deferred.promise;
    };
  }]);
