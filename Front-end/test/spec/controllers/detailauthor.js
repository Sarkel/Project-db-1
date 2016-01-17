'use strict';

describe('Controller: DetailauthorCtrl', function () {

  // load the controller's module
  beforeEach(module('Game'));

  var DetailauthorCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    DetailauthorCtrl = $controller('DetailauthorCtrl', {
      $scope: scope
      // place here mocked dependencies
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(DetailauthorCtrl.awesomeThings.length).toBe(3);
  });
});
