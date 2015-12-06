'use strict';

describe('Controller: LogowanieCtrl', function () {

  // load the controller's module
  beforeEach(module('Game'));

  var LogowanieCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    LogowanieCtrl = $controller('LogowanieCtrl', {
      $scope: scope
      // place here mocked dependencies
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(LogowanieCtrl.awesomeThings.length).toBe(3);
  });
});
