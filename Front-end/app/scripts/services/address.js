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
    var url = 'App/api.php';

    this.searchAdress = function (searchParam){
    	return $http.get(url + 'adress/search/' + searchParam);
    };
  }]);
