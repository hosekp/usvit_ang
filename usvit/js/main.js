'use strict';


// Declare app level module which depends on filters, and services
angular.module('usvit', [
    'ngRoute',
    'ngResource',
    'usvit.controllers',
    'usvit.directives',
    'usvit.services'
]).
    config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider) {
        $routeProvider
        .when('/view1', {templateUrl: 'partials/partial1.html', controller: 'MyCtrl1'})
        .when('/view2', {templateUrl: 'partials/partial2.html', controller: 'MyCtrl2'})
        .when("/:categ",{templateUrl: 'partials/articles.html',controller:"categ"})
        .when("/:categ/:artID",{templateUrl: 'partials/articles.html',controller:"categ",slide:true})
//        .when("/ucast/:fraction",{action:"ucast.none"})
//        .when("/ucast/:fraction/:ucasID",{action:"ucast.ucas"})
//        .when("/ucast/new",{action:"ucast.new"})
//        .when("/ucast/update",{action:"ucast.update"})
        .otherwise({redirectTo: '/home'});
}]);

window.data={
    home:[
        {   
            id:"art1",
            title:"Článek 1",
            short:"povídání o psech",
            long:"fosdh jkgnsdjk n gbjkas ndbkjs"
        },
        {   
            id:"art2",
            title:"Článek 2",
            short:"povídání o kočkách",
            long:"fosdh jkgnsdjk n gbjkas ndbkjs"
        }
    ],
    important:[
        {   
            id:"art1",
            title:"Článek 1",
            short:"povídání o psech",
            long:"fosdh jkgnsdjk n gbjkas ndbkjs"
        }
    ],
    noviny:[
        {   
            id:"art2",
            title:"Článek 2",
            short:"povídání o kočkách",
            long:"fosdh jkgnsdjk n gbjkas ndbkjs"
        },
        {   
            id:"art3",
            title:"Článek 3",
            short:"povídání o plazechh",
            long:"fosdh jkgnsdjk n gbjkas ndbkjs"
        }
    ],
    forum:[
        
    ]
};
