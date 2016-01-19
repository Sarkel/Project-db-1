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
    var url = 'App/api.php';
    this.getAll = function (){
    	return $http.get(url + '/books');
    };

    this.getSelected = function (id) {
    	return $http.get(url + '/books/id/' + id);
    };

    this.getSearchResults = function (serachParam){
      return $http.get(url + '/books/search/' + serachParam);
    };

    this.borrowBooks = function (userId, booksId){
      var today = new Date(Date.now()).toUTCString();
      return $http.post(url + '/books/borrow', {
          uzytkownik: userId,
          ksiazka: booksId,
          dataWypozyczenia: today,
          dataOddania: ''
        });
    };
  }]);
