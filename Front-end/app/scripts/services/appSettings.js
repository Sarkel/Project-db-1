'use strict';

/**
 * @ngdoc service
 * @name libraryApp.settings
 * @description
 * # settings
 * Factory in the libraryApp.
 */
angular.module('libraryApp')
  .factory('appSettings',['$http', function ($http) {
    // Service logic

    var _getAppSettings = function (){
      return $http.get('mocks/appSettings.json');
    };

    // Public API here
    return {
      getAppSettings: _getAppSettings
    };
  }]);
