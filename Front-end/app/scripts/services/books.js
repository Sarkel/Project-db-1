'use strict';

/**
 * @ngdoc service
 * @name libraryApp.Books
 * @description
 * # Books
 * Service in the libraryApp.
 */
angular.module('libraryApp')
  .service('Books',['$http', '$q', '$rootScope', function ($http, $q, $rootScope) {
    var url = $rootScope.url;
    this.getAll = function (){
    	/*return $http({
    		urlL: url + '/books',
    		method: 'GET'
    	});*/
  	var deferred = $q.defer();
  	deferred.resolve({
  		success: true,
  		msg: url,
  		data: [
  			{
  				id: 1,
  				avatarUrl: 'test',
  				stars: 3,
  				tytul: 'test'
  			},
  			{
  				id: 1,
  				avatarUrl: 'test',
  				stars: 3,
  				tytul: 'test'
  			}
  		]
  	});
  	return deferred.promise;
    };

    this.getSelected = function (id) {
    	/*return $http({
    		urlL: url + '/books/' + id,
    		method: 'GET'
    	});*/
	  var deferred = $q.defer();
	  	deferred.resolve({
	  		success: true,
	  		msg: url,
	  		data: [
	  			{
	  				id: id,
	  				avatarUrl: 'test',
	  				stars: 3,
	  				tytul: 'test',
	  				isbn: 'testa',
	  				authors: [{
	  					id: 1,
	  					imie: 'test',
	  					nazwisko: 'test',
	  					kraj: 'test',
	  					nazwaPowiazania: 'test'
	  				},{
	  					id: 2,
	  					imie: 'test',
	  					nazwisko: 'test',
	  					kraj: 'test',
	  					nazwaPowiazania: 'test'
	  				}],
	  				book_wyd: {
	  					id: 1,
	  					nazwa: 'test',
	  					kraj: 'test'
	  				}
	  			}
	  		]
	  	});
	  	return deferred.promise;
    };

    this.getSearchResults = function (serachParam){
      /*return $http({
        urlL: url + '/books/search/' + serachParam,
        method: 'GET'
      });*/
      var deferred = $q.defer();
      deferred.resolve({
        success: true,
        msg: url,
        data: [
        {
          id: 1,
          avatarUrl: 'test',
          stars: 3,
          tytul: 'test'
        },
      ]
      });
      return deferred.promise;
    };

    this.borrowBooks = function (userId, booksId){
      return $http({
        url: url + '/books/borrow',
        method: 'POST',
        data: {
          user: userId,
          books: booksId
        }
      });
    };
  }]);
