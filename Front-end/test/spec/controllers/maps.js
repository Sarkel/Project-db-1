'use strict';

describe('Controller: MapsCtrl', function () {

  // load the controller's module
  beforeEach(module('Game'));

  var MapsCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    MapsCtrl = $controller('MapsCtrl', {
      $scope: scope
      // place here mocked dependencies
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(MapsCtrl.awesomeThings.length).toBe(3);
  });
});
