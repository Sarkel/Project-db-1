'use strict';

describe('Service: dialogTemplates', function () {

  // load the service's module
  beforeEach(module('Game'));

  // instantiate service
  var dialogTemplates;
  beforeEach(inject(function (_dialogTemplates_) {
    dialogTemplates = _dialogTemplates_;
  }));

  it('should do something', function () {
    expect(!!dialogTemplates).toBe(true);
  });

});
