CarListCtrl = ($scope, $http, $localStorage, $sessionStorage,$timeout) ->
  $scope.cars = $localStorage['car/excel']
  $scope.orderProp = "date"

CarDetailCtrl = ($scope, $routeParams) ->
  $scope.carId = $routeParams.carId

angular
  .module('carsApp')
  .controller "CarListCtrl", ["$scope","$http","$localStorage","$sessionStorage","$timeout",CarListCtrl]
  .controller "CarDetailCtrl", ["$scope","$routeParams",CarDetailCtrl]
