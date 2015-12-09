'use strict';

describe('Controller: ContactdialogCtrl', function () {

  // load the controller's module
  beforeEach(module('Game'));

  var ContactdialogCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    ContactdialogCtrl = $controller('ContactdialogCtrl', {
      $scope: scope
      // place here mocked dependencies
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(ContactdialogCtrl.awesomeThings.length).toBe(3);
  });
});
