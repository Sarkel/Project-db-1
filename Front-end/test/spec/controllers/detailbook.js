'use strict';

describe('Controller: DetailbookCtrl', function () {

  // load the controller's module
  beforeEach(module('Game'));

  var DetailbookCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    DetailbookCtrl = $controller('DetailbookCtrl', {
      $scope: scope
      // place here mocked dependencies
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(DetailbookCtrl.awesomeThings.length).toBe(3);
  });
});
