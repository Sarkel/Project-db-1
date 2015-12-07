'use strict';

/**
 * @ngdoc overview
 * @name libraryApp
 * @description
 * # libraryApp
 *
 * Main module of the application.
 */
angular
  .module('libraryApp', [
    'ngAnimate',
    'ngAria',
    'ngCookies',
    'ngMessages',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch'
  ])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/mainPage.html',
        controller: 'MainpageCtrl'
      })
      .when('/logowanie', {
        templateUrl: 'views/logowanie.html',
        controller: 'LogowanieCtrl'
      })
      .when('/koszyk', {
        templateUrl: 'views/koszyk.html',
        controller: 'KoszykCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
  })
  .controller('globalSettingsCtrl', ['$rootScope', function($rootScope){
    $rootScope.search = '';
    $rootScope.cookiesConfirmed = false;
  }]);
