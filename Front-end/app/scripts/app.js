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
    'ngTouch',
    'ngDialog'
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
      .when('/polityka-cookies', {
        templateUrl: 'views/polityka_cookies.html',
        controller: ''
      })
      .otherwise({
        redirectTo: '/'
      });
  })
  .run(['$rootScope', 'appSettings', 'ngDialog', 'dialogTemplates', function ($rootScope, appSettings, ngDialog, dialogTemplates){
    
    $rootScope.search = '';

    $rootScope.cookiesConfirmed = false;

    var init = function (){
      appSettings.getAppSettings().then(function (result){
        $rootScope.appSettings = result.data;
      },
      function (err){
        console.log(err);
      });
    };

    $rootScope.openPageInNewWindow = function (direction){
      window.open(direction);
    };

    $rootScope.openContactDialog = function (){
      dialog({
        template: dialogTemplates.contactDialog(),
        controller: 'ContactdialogCtrl',
        event: 'contactDialogEvent'
      });
    };

    $rootScope.openMapDialog = function (){
      dialog({
        template: dialogTemplates.mapDialog(),
        controller: 'MapsCtrl',
        event: 'mapDialogEvent'
      });
    };

    var dialog = function (properties){
      var dialogId = ngDialog.open({
        template: properties.template,
        plain: true,
        controller: properties.controller
      });
      $rootScope.$broadcast(properties.event, {
        dialogId: dialogId
      });
    };

    init();

    $rootScope.subscriber = {
      email: ''
    };

    $rootScope.subscribe = function (){
      console.log($rootScope.subscriber.email);
      $rootScope.subscriber.email = '';
    };

  }]);
