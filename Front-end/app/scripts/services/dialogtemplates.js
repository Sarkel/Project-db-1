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
    '<input type="text" class="form-control" ng-model="editUser.typ" placeholder="Typ" ng-show="isAdmin && userId != \'me\'">' +
    '<label ng-show="isAdmin && userId != \'me\'">Aktywny: </label><input type="checkbox" ng-model="editUser.typ"/ ng-show="isAdmin && userId != \'me\'">' +
  '</div>' +
  '<div>' +
        '<input type="text" class="form-control" ng-model="editAdres.ulica" placeholder="Ulica"/>' +
    '<input type="text" class="form-control" ng-model="editAdres.numerDomu" placeholder="Numer domu"/>' +
    '<input type="text" class="form-control" ng-model="editAdres.numerMieszkania" placeholder="Numer mieszkania"/>' +
    '<input type="button" class="btn btn-default" value="Edytuj adres" ng-click="openEditAdresDialog()" ng-hide="true"/>' +
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

    var _addCommentDialog = function (){
      var addCommentDialogTemplate = 
      '<div>' +
        '<textarea rows="4" ng-modal="content" maxlength="255" autofocus/>' +
        '<input type="submit" value="Save" class="btn btn-default" ng-click="save()"/>' +
        '<input type="button" value="Close" class="btn btn-default" ng-click="close()"/>' +
      '</div>';

      return addCommentDialogTemplate;
    };

    // Public API here
    return {
      contactDialog: _contactDialog,
      mapDialog: _mapDialog,
      editUserDialog: _editUserDialog,
      editAdresDialog: _editAdresDialog,
      addCommentDialog: _addCommentDialog
    };
  });
