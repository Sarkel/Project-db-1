'use strict';

/**
 * @ngdoc function
 * @name libraryApp.controller:DetailuserCtrl
 * @description
 * # DetailuserCtrl
 * Controller of the libraryApp
 */
angular.module('libraryApp')
  .controller('DetailuserCtrl',['$rootScope', '$scope', '$location', '$routeParams', 'Users', 'Address', 'ngDialog', function ($rootScope, $scope, $location, $routeParams, Users, Address, ngDialog) {
    if(!$rootScope.isLogged){
		$location.path('/logowanie');
	}

    $scope.userId = $routeParams.id;
    var listenerUser = $scope.$on('contactDialogEvent', function (event, result) {
        $scope.userDialogId = result.dialogId;
    });

    var listenerAdres = $scope.$on('contactDialogEvent', function (event, result) {
        $scope.adresDialogId = result.dialogId;
    });

    $scope.selectAddress = function (id){
        $scope.editUser.kodPocztowy = id;
        $scope.close($scope.adresDialogId);
        $scope.searchAddress = '';
        $scope.addresses = [];
    };

    $scope.isShown = false;
    
    $scope.showComments = function (){
      $scope.isShown = !$scope.isShown;
    };

    $scope.update = function (){
        Users.updateUser($scope.editUser, $scope.editAdres).then(function (result){
            if(result.success){
               $scope.close($scope.userDialogId);
               $scope.editUser = {};
               $scope.editAdres = {};
            } else {
                console.log(result.msg);
            }
        }, function (err){
            console.log(err);
            $rootScope.errorDialog('Coś poszło nie tak.');
        });
    };

    $scope.searchAddress = '';

    $scope.addresses = [];

    $scope.$watch('searchAddress', function (newValue){
        Address.searchAdress(newValue).then(function (result){
            if(result.success){
                $scope.addresses = result.data;
            } else {
                console.log(result.msg);
                $rootScope.errorDialog(result.msg);
            }
        }, function (err){
            console.log(err);
            $rootScope.errorDialog('Coś poszło nie tak.');
        });
        console.log($scope.addresses);
    });
    $scope.$on('$destroy', listenerUser);
    $scope.$on('$destroy', listenerAdres);

    $scope.editUser = {};

    $scope.editAdres = {};

    $scope.currectUser = {};

    $scope.update = function(){

    };

    $scope.close = function (id){
        ngDialog.close(id);
    };

    $scope.options = function (isAdmin) {
    	if(isAdmin){
    		$location.path('/options/admin');
    	} else {
    		$location.path('/options/bibliotekarz');
    	}
    };
    
    $scope.logout = function (){
        Users.logout().then(function (result){
            if(result.success){
                $rootScope.isLogged = false;
                $rootScope.user = {};
                $location.path('/logowanie');
                console.log(result.msg);
            } else {
                console.log(result.msg);
                $rootScope.errorDialog(result.msg);
            }
        }, function (err){
            console.log(err);
            $rootScope.errorDialog('Coś poszło nie tak.');
        });
    };
    
    var init = function (){
    	var userId = null;
    	if($routeParams.id === 'me') {
    		userId = $rootScope.user.id;
    	} else {
    		userId = $routeParams.id;
    	}
    	Users.getUserDetails(userId).then(function (result){
    		if(result.success){
    			$scope.currectUser = result.data;
    		} else {
    			console.log(result.msg);
                $rootScope.errorDialog(result.msg);
    		}
    	}, function (err){
    		console.log(err);
            $rootScope.errorDialog('Coś poszło nie tak.');
    	});
        $rootScope.watchSearch($scope);
    };
    init();
  }]);
