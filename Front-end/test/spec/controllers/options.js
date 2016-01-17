'use strict';

describe('Controller: OptionsCtrl', function () {

  // load the controller's module
  beforeEach(module('Game'));

  var OptionsCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    OptionsCtrl = $controller('OptionsCtrl', {
      $scope: scope
      // place here mocked dependencies
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(OptionsCtrl.awesomeThings.length).toBe(3);
  });
});
