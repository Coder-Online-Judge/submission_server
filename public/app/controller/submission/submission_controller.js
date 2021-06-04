app.controller("submissions", function($scope, $interval, $route, $rootScope, $http, $routeParams, $location) {
    $scope.currentPage = !$routeParams.page ? 1 : $routeParams.page;
    $scope.loadingData = false;
    $scope.submissions = [];
    $scope.pagination = [];
    $scope.load = function() {
        $http.get(api + "/submissions?page=" + $scope.currentPage).then(function(response) {
            if (!angular.equals(response.data.data, $scope.submissions)) {
                $scope.submissions = response.data.data;
                $scope.pagination = response.data;
                $scope.totalPages = new Array($scope.pagination.last_page);
            }
            //$scope.start();
        });
    }
    $scope.load();
    $scope.selectPage = function(page) {
        $scope.currentPage = page;
        $location.path('/submissions/' + $scope.currentPage, false);
        $scope.load();
    };
    var original = $location.path;
    $location.path = function(path, reload) {
        if (reload === false) {
            var lastRoute = $route.current;
            var un = $rootScope.$on('$locationChangeSuccess', function() {
                $route.current = lastRoute;
                un();
            });
        }
        return original.apply($location, [path]);
    };
    $scope.callAtInterval = function() {
         $scope.load();
    }
    var promise;
    $scope.start = function() {
        $scope.stop();
        promise = $interval($scope.callAtInterval, 1000);
    };
    $scope.stop = function() {
        $interval.cancel(promise);
    };
    $scope.$on('$destroy', function() {
        $scope.stop();
    });
    $scope.start();
});
