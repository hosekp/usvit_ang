'use strict';


// Declare app level module which depends on filters, and services
angular.module('usvit', [
    'ngRoute',
    'ngResource',
    'usvit.controllers',
    'usvit.directives',
    'usvit.services',
    'usvit.filters'
]).
    config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider) {
        $routeProvider
        .when('/view1', {templateUrl: 'partials/partial1.html', controller: 'MyCtrl1'})
        .when('/view2', {templateUrl: 'partials/partial2.html', controller: 'MyCtrl2'})
        .when("/:categ",{templateUrl: 'partials/articles.html',controller:"mainCtrl"})
        .when("/:categ/:artID",{templateUrl: 'partials/articles.html',controller:"mainCtrl",slide:true})
//        .when("/ucast/:fraction",{action:"ucast.none"})
//        .when("/ucast/:fraction/:ucasID",{action:"ucast.ucas"})
//        .when("/ucast/new",{action:"ucast.new"})
//        .when("/ucast/update",{action:"ucast.update"})
        .otherwise({redirectTo: '/home'});
}]);

window.data=[
        {   
            id:"art1",
            title:"Co to je",
            short:"povídání o psech",
            long:"fosdh jkgnsdjk n gbjkas ndbkjs",
            categ:"home"
        },
        {   
            id:"art2",
            title:"Kde to je",
            short:"povídání o kočkách",
            long:"fosdh jkgnsdjk n gbjkas ndbkjs",
            categ:"home"
        },
        {   
            id:"art1",
            title:"Pravidla",
            short:"povídání o psech",
            long:"fosdh jkgnsdjk n gbjkas ndbkjs",
            categ:"important"
        },
        {   
            id:"art2",
            title:"Bubla nejede",
            short:"povídání o kočkách",
            long:"fosdh jkgnsdjk n gbjkas ndbkjs",
            categ:"noviny"
        },
        {   
            id:"art3",
            title:"Bubla se ožere",
            short:"povídání o plazechh",
            long:"fosdh jkgnsdjk n gbjkas ndbkjs",
            categ:"noviny"
        }
];
