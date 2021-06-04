<!DOCTYPE html>
<html ng-app="myApp">
    <head>
        <title>
            Online Judge Judge Server
        </title>
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
        <meta content="no-cache, no-store, must-revalidate" http-equiv="Cache-Control"/>
        <meta content="user-scalable=no, width=device-width" name="viewport"/>
        
        <link rel="icon" href="file/site_metarial/favicon.png" type="image/gif" sizes="16x16">
        <!-- CSS Javascript Libery -->
    
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.2/css/all.css'>
        <link href="https://fonts.googleapis.com/css?family=Exo 2" rel="stylesheet">
        <!-- JQuery Lib -->
        <script type="text/javascript" src="http://judge-server.coderoj.com/style/lib/jquery/jquery.min.js"></script>
        <!-- Bootstrap Lib -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="http://judge-server.coderoj.com/style/lib/bootstrap/css/bootstrap.min.css">
        <script type="text/javascript" src="http://judge-server.coderoj.com/style/lib/bootstrap/js/bootstrap.min.js"></script>

        <link rel="stylesheet" type="text/css" href="app/assets/css/sidebar.css">
        <link rel="stylesheet" type="text/css" href="app/assets/css/style.css">
        
        

        <!-- anguler script -->
        <script src="app/assets/angular/angular.min.js" type="text/javascript"></script>
        <script src="app/assets/angular/angular-route.js" type="text/javascript"></script>
        <script type="text/javascript" src="http://demo.webslesson.info/angularjs-php-pagination/dirPaginate.js"></script>
        <!-- app script -->
        <script type="text/javascript" src="https://ciphertrick.com/demo/search-sort-pagination/lib/dirPagination.js.pagespeed.jm.CbylmWdRCH.js"></script>
        <script src="app/app.js" type="text/javascript"></script>
        <script src="app/routes/web.js" type="text/javascript"></script>
        <script src="app/controller/controller.js" type="text/javascript"></script>
        <script src="app/controller/submission/submission_controller.js" type="text/javascript"></script>

    </head>
    <body>
        <!-- <header ng-include="'views/header.html'"></header> -->
        <div ng-include="'views/includes/sidebar.html'"></div>
        <div class="container-fluid container-body">
            <div id="loader" style="display: none">
                <div class="loader loader-bar-ping-pong is-active"></div>
            </div>

            <div ng-view=""></div>
        </div>
    </body>
</html>