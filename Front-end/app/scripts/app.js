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
  .run(['$rootScope', 'appSettings', 'ngDialog', function ($rootScope, appSettings, ngDialog){
    
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

    $rootScope.openDialog = function (){
      var dialogId = ngDialog.open({
        template: contactDialogTemplate,
        plain: true,
        controller: 'ContactdialogCtrl'
      });
      $rootScope.$broadcast('contactDialogEvent', {
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

    var contactDialogTemplate = 
    '<div>' +
      '<div class="input-group contact-dialog-inputs">' +
        '<input type="email" placeholder="E-mail" class="form-control" ng-model="msg.email"/>' +
        '<input type="text" placeholder="Temat" class="form-control" ng-model="msg.topic"/>' +
        '<textarea placeholder="Wiadomość" class="form-control" rows="5" ng-model="msg.content"/>' +
      '</div>' +
      '<div class="contact-dialog-buttons">' +
        '<div class="btn btn-success submit-button" ng-click="submit()" ng-disabled="!(msg.content && msg.topic && msg.email)">Wyślij</div>' +
        '<div class="btn btn-danger cancel-button" ng-click="close()">Anuluj</div>' +
      '</div>' +
    '</div>';

  }]);
