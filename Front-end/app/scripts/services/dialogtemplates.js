'use strict';

/**
 * @ngdoc service
 * @name libraryApp.dialogTemplates
 * @description
 * # dialogTemplates
 * Factory in the libraryApp.
 */
angular.module('libraryApp')
  .factory('dialogTemplates', function () {
    // Service logic
    // ...

    var _contactDialog  = function (){
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
      return contactDialogTemplate;
    };

    var _mapDialog = function (){
      var mapDialogTemplate = 'map template';
      return mapDialogTemplate;
    };

    // Public API here
    return {
      contactDialog: _contactDialog,
      mapDialog: _mapDialog
    };
  });
