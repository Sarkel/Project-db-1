'use strict';

/**
 * @ngdoc service
 * @name libraryApp.Books
 * @description
 * # Books
 * Service in the libraryApp.
 */
angular.module('libraryApp')
  .service('Books',['$http', '$rootScope', function ($http, $rootScope) {
    var url = $rootScope.url;
    this.getAll = function (){
    	return $http({
    		urlL: url + '/books',
    		method: 'GET'
    	});
    };

    this.getSelected = function (id) {
    	return $http({
    		urlL: url + '/books/id/' + id,
    		method: 'GET'
    	});
    };

    this.getSearchResults = function (serachParam){
      return $http({
        urlL: url + '/books/search/' + serachParam,
        method: 'GET'
      });
    };

    this.borrowBooks = function (userId, booksId){
      var today = new Date(Date.now()).toUTCString();
      return $http({
        url: url + '/books/borrow',
        method: 'POST',
        data: {
          uzytkownik: userId,
          ksiazka: booksId,
          dataWypozyczenia: today,
          dataOddania: ''
        }
      });
    };
  }]);
