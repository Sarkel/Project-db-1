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
      .when('/books/:id', {
        templateUrl: 'views/detailBook.html',
        controller: 'DetailbookCtrl'
      })
      .when('/authors/:id', {
        templateUrl: 'views/detailAuthod.html',
        controller: 'DetailauthorCtrl'
      })
      .when('/wyd/:id', {
        templateUrl: 'views/detailWyd.html',
        controller: 'DetailwydCtrl'
      })
      .when('/users', {
        templateUrl: 'views/detailUser.html',
        controller: 'UsersCtrl'
      })
      .when('/users/:id', {
        templateUrl: 'views/detailUser.html',
        controller: 'DetailuserCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
  })
  .run(['$rootScope', 'appSettings', 'ngDialog', '$location', 'dialogTemplates', 'Books', function ($rootScope, appSettings, ngDialog, $location, dialogTemplates, Books){
    $rootScope.isAdmin = false;
    
    $rootScope.isLibrarian = false;

    $rootScope.search = '';

    $rootScope.cookiesConfirmed = false;

    $rootScope.url = 'app.php';

    $rootScope.selectedToBorrow = [];

    $rootScope.user = {};
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

    $rootScope.openEditUserDialog = function (){
      dialog({
        template: dialogTemplates.editUserDialog(),
        controller: 'DetailuserCtrl',
        event: 'editUser'
      });
    };

    $rootScope.openEditAdresDialog = function (){
      dialog({
        template: dialogTemplates.editAdresDialog(),
        controller: 'DetailuserCtrl',
        event: 'editAdres'
      });
    };

    $rootScope.errorDialog = function(msg){
      dialog({
        template: '<div class="alert alert-danger">' + msg + '</div><input type="button" value="Zamknij" class="btn btn-danger" ng-click="close()"/>',
        controller: 'ErrorCtrl',
        event: 'errorEvent'
      });
    };

    $rootScope.watchSearch = function (scope){
      scope.$watch('search', function (newValue, oldValue){
        if(newValue !== oldValue) {
          Books.getSearchResults(newValue).then(function (result){
            if(result.success){
              $rootScope.$broadcast('searchResults', result.data);
              $location.path('/');
            } else {
              console.log(result.msg);
              $rootScope.errorDialog(result.msg);
            }
          }, function (err){
            console.log(err);
            $rootScope.errorDialog(err);
          });
        }
        
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

    $rootScope.subscriber = {
      email: ''
    };

    $rootScope.subscribe = function (){
      console.log($rootScope.subscriber.email);
      $rootScope.subscriber.email = '';
    };

    init();
  }]);
