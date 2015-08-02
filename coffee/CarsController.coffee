CarListCtrl = ($scope, $http) ->
  $http.get("car/excel/").success (data) ->
    $scope.cars = data
    return

  $scope.orderProp = "date"

CarDetailCtrl = ($scope, $routeParams) ->
  $scope.carId = $routeParams.carId

angular
  .module('carsApp')
  .controller "CarListCtrl", ["$scope","$http",CarListCtrl]
  .controller "CarDetailCtrl", ["$scope","$routeParams",CarDetailCtrl]
