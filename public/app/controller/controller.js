
app.controller("view_submission", function($scope, $http, $routeParams) {
    $http.get(api + "/submissions/" + $routeParams.token).then(function(response) {
        // console.log(response.data.verdict[0].id);
        $scope.submission = response.data;
    });
});
app.controller("verdicts", function($scope, $http) {
    $http.get(api + "/verdicts/").then(function(response) {
        //console.log(response.data);
        $scope.verdicts = response.data;
    });
});