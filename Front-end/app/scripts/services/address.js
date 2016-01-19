'use strict';

/**
 * @ngdoc service
 * @name libraryApp.Address
 * @description
 * # Address
 * Service in the libraryApp.
 */
angular.module('libraryApp')
  .service('Address', ['$rootScope', '$http', function ($rootScope, $http) {
    var url = $rootScope.url;

    this.searchAdress = function (searchParam){
    	return $http({
    		url: url + 'adress/search/' + searchParam,
    		method: 'GET'
    	});
    };
  }]);
