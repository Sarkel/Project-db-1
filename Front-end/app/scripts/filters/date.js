'use strict';

/**
 * @ngdoc filter
 * @name libraryApp.filter:date
 * @function
 * @description
 * # date
 * Filter in the libraryApp.
 */
angular.module('libraryApp')
  .filter('date', function () {
    return function (input) {
      return new Date(input).toUTCString();
    };
  });
