
// on desactive le blokage de resource from url


// Déclaration de l'application routeApp
var routeApp = angular.module('routeApp', [
    // Dépendances du "module"
    'ngRoute',
    'routeAppControllers'
    ]);
// Configuration du module principal : routeApp
routeApp.config(['$routeProvider',
    function($routeProvider) { 

        // Système de routage
        $routeProvider
        .when('/home', {
            templateUrl: 'partials/home.html',
            controller: 'homeCtrl'
        })
        .when('/artists', {
            templateUrl: 'partials/artists.html',
            controller: 'artistsCtrl'
        })
        .when('/artists/details/:id?', {
            templateUrl: 'partials/artists_details.html',
            controller: 'artists_detailsCtrl'
        })
        .when('/albums', {
            templateUrl: 'partials/albums.html',
            controller: 'albumsCtrl'
        })
        .when('/albums/details/:id?', {
            templateUrl: 'partials/albums_details.html',
            controller: 'albums_detailsCtrl'
        })
        .when('/tracks', {
            templateUrl: 'partials/tracks.html',
            controller: 'tracksCtrl'
        })
        .when('/genres', {
            templateUrl: 'partials/genre.html',
            controller: 'genreCtrl'
        })
        .when('/genres/id/:id?', {
            templateUrl: 'partials/genre_details.html',
            controller: 'genre_detailsCtrl'
        })
        .otherwise({
            redirectTo: '/home'
        });
    }
    ]);
// Définition des contrôleurs
var routeAppControllers = angular.module('routeAppControllers', []);

// Recup du chemin absolu
var getScriptURL = (function () {
   var scripts = document.getElementsByTagName('script');
   var index = scripts.length - 1;
   var myScript = scripts[index];
   return function () {
       return myScript.baseURI;
   };
})();

// decoupage de l'url
var webroot = getScriptURL().substr(0,getScriptURL().indexOf('angularMusic'));
var root = getScriptURL().substr(0, getScriptURL().indexOf('#'));


// Contrôleur de la page full artists
routeAppControllers.controller("artistsCtrl", function($scope, $http) {
  $http.get(webroot+'API/artists/').
  success(function(data, status) {
    $scope.base_url = getScriptURL();
    $scope.datas = data;
}).
  error(function(data, status) {
   console.log('error');
});
  // pagination
      $scope.curPage = 0;
      $scope.pageSize = 9;
      $scope.numberOfPages = function() 
      {
         return Math.ceil($scope.datas.length / $scope.pageSize);
     };
});

// Contrôleur de la page details artists par id
routeAppControllers.controller("artists_detailsCtrl", function($scope, $http) {
    var posId = getScriptURL().substr(getScriptURL().indexOf('details/'));
    var id = posId.substr(8);
    $http.get(webroot+'API/artists/details/'+id).
    success(function(data, status) {
        $scope.base_url = root;
        $scope.datas = data;
    }).
    error(function(data, status) {
        console.log('error');
    });
});

// Contrôleur de la page full album
routeAppControllers.controller("albumsCtrl", function($scope, $http) {
  $http.get(webroot+'API/albums/').
  success(function(data, status) {
     $scope.base_url = getScriptURL();
     $scope.datas = data;
 }).
  error(function(data, status) {
    console.log('error');
});
  // pagination
      $scope.curPage = 0;
      $scope.pageSize = 12;
      $scope.numberOfPages = function() 
      {
         return Math.ceil($scope.datas.length / $scope.pageSize);
     };
});

// rajoute un filtre pour les url des mp3 (pour quel ne soit pas bloqué par angularjs)
routeApp.filter('trusted', ['$sce', function ($sce) {
    return function(url) {
        return $sce.trustAsResourceUrl(url);
    };
}]);

// Contrôleur de la page details albums par id
routeAppControllers.controller("albums_detailsCtrl", function($scope, $http) {
    var posId = getScriptURL().substr(getScriptURL().indexOf('details/'));
    var id = posId.substr(8);
    $http.get(webroot+'API/albums/details/'+id).
    success(function(data, status) {
        $scope.datas = data;
    }).
    error(function(data, status) {
        console.log('error');
    });
});

// Contrôleur de la page home
routeAppControllers.controller("homeCtrl", function($scope, $http) {
    $http.get(webroot+'API/albums/random/').
    success(function(data, status) {
     $scope.base_url = root;
     $scope.datas = data;
 }).
    error(function(data, status) {
        console.log('error');
    });
    // pagination
      $scope.curPage = 0;
      $scope.pageSize = 8;
      $scope.numberOfPages = function() 
      {
         return Math.ceil($scope.datas.length / $scope.pageSize);
     };
});

// Contrôleur de la page full tracks
routeAppControllers.controller("tracksCtrl", function($scope, $http) {
  $http.get(webroot+'API/tracks/').
  success(function(data, status) {
     $scope.base_url = getScriptURL();
     $scope.datas = data;
 }).
  error(function(data, status) {
   console.log('error');
});
});

// Contrôleur de la page genre
routeAppControllers.controller("genreCtrl", function($scope, $http) {
  $http.get(webroot+'API/genres/').
  success(function(data, status) {
     $scope.base_url = getScriptURL();
     $scope.datas = data;
 }).
  error(function(data, status) {
   console.log('error');
});
});

// Contrôleur de la page details genre par id
routeAppControllers.controller("genre_detailsCtrl", function($scope, $http) {
    var posId = getScriptURL().substr(getScriptURL().indexOf('id/'));
    var id = posId.substr(3);
    $http.get(webroot+'API/genres/id/'+id).
    success(function(data, status) {
        $scope.base_url = root;
        $scope.datas = data;
    }).
    error(function(data, status) {
        console.log('error');
    });
});
// module pagination
angular.module('routeApp').filter('pagination', function()
{
 return function(input, start)
 {
  start = +start;
  return input.slice(start);
};
});
