'use strict';

describe('Controller: DetailwydCtrl', function () {

  // load the controller's module
  beforeEach(module('Game'));

  var DetailwydCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    DetailwydCtrl = $controller('DetailwydCtrl', {
      $scope: scope
      // place here mocked dependencies
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(DetailwydCtrl.awesomeThings.length).toBe(3);
  });
});
