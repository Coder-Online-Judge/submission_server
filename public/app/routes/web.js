app.config(function($routeProvider) {
    $routeProvider.when("/submissions", {
        templateUrl: "views/submissions.html",
        controller: "submissions"
    }).when("/submissions/:page", {
        templateUrl: "views/submissions.html",
        controller: "submissions"
    }).when("/submission/:token", {
        templateUrl: "views/view_submission.html",
        controller: "view_submission"
    }).when("/verdicts", {
        templateUrl: "views/verdicts.html",
        controller: "verdicts"
    }).otherwise({
       templateUrl: "views/submissions.html",
       controller: "submissions"
    });
});