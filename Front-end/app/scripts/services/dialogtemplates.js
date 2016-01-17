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

    var _editUserDialog = function (){
      var editUserDialogTemplate = 
        '<div>' +
        '<input type="text" class="form-control" ng-model="editUser.email" placeholder="E-mail"/>' +
    '<input type="text" class="form-control" ng-model="editUser.nazwisko" placeholder="Nazwisko"/>' +
    '<input type="text" class="form-control" ng-model="editUser.imie" placeholder="Imię"/>' +
    '<input type="text" class="form-control" ng-model="editUser.komorka" placeholder="Telefon komórkowy"/>' +
    '<input type="text" class="form-control" ng-model="editUser.stacjonarny" placeholder="Telefon stacjonarny"/>' +
  '</div>' +
  '<div>' +
        '<input type="text" class="form-control" ng-model="editAdres.ulica" placeholder="Ulica"/>' +
    '<input type="text" class="form-control" ng-model="editAdres.numerDomu" placeholder="Numer domu"/>' +
    '<input type="text" class="form-control" ng-model="editAdres.numerMieszkania" placeholder="Numer mieszkania"/>' +
    '<input type="button" class="btn btn-default" value="Edytuj adres" ng-click="openEditAdresDialog()"/>' +
    '</div>' +
    '<input type="button" value="Update" ng-click="update()" class="btn btn-default"/>' +
    '<input type="button" value="Zamknij" ng-click="close(userDialogId)" class="btn btn-default" />';

      return editUserDialogTemplate;
    };

    var _editAdresDialog = function (){
      var editAdressDialogTemplate = 
        '<div>' +
          '<input type="text" placeholder="Szukaj adresu" ng-model="searchAddress" class="form-control/>' +
          '<input type="button"/>' +
          '<table class="table" ng-hide="addresses.length === 0">' +
              '<thead>' +
                  '<tr>' +
                      '<td>Kod pocztowy</td>' +
                      '<td>Miejscowosc</td>' +
                      '<td>Kraj</td>' +
                  '</tr>' +
              '</thead>' +
              '<tr ng-reapeat="address in addresses" ng-click="selectAddress(address.id)">' +
                  '<td>{{address.kodPocztowy}}</td>' +
                  '<td>{{address.miejscowosc}}</td>' +
                  '<td>{{address.kraj}}</td>' +
              '</tr>' +
          '</table>' +
      '</div>';

    return editAdressDialogTemplate;
    };

    // Public API here
    return {
      contactDialog: _contactDialog,
      mapDialog: _mapDialog,
      editUserDialog: _editUserDialog,
      editAdresDialog: _editAdresDialog
    };
  });
