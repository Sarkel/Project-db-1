'use strict';

describe('Controller: KoszykCtrl', function () {

  // load the controller's module
  beforeEach(module('Game'));

  var KoszykCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    KoszykCtrl = $controller('KoszykCtrl', {
      $scope: scope
      // place here mocked dependencies
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(KoszykCtrl.awesomeThings.length).toBe(3);
  });
});
