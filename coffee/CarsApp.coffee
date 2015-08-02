angular
  .module('carsApp', ['ngRoute'])
  .config [
    '$routeProvider'
    ($routeProvider) ->
      $routeProvider.when("/car",
        templateUrl: "wp-content/themes/min/car-list.html"
        controller: "CarListCtrl"
      ).when("/car/:carName",
        templateUrl: "wp-content/themes/min/car-detail.html"
        controller: "CarDetailCtrl"
      ).otherwise redirectTo: "/car"
  ]
  .config [
    '$httpProvider'
    ($httpProvider) ->
      $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest'
  ]
