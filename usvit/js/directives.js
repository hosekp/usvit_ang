'use strict';

/* Directives */


angular.module('usvit.directives', [])
    .directive('article', function() {
        return {
            restrict: 'A',
            template:   '<div ng-click="toggle(article)">'+
                            '<h2>{{article.title}}</h2>'+
                            '<div class="short_text animate-show" ng-hide="article.active">{{article.short}}</div>'+
                            '<div class="long_text animate-show" ng-show="article.active">{{article.long}}</div>'+
                        '</div>'
            ,
            link: function(scope, elem, attrs) {
                //alert(scope.action);
                //if(scope.action)
            }
        };
    })
    .directive('mybutton', function() {
        return {
            restrict: 'E',
            template: 
                    '<div class="filter_button rounded" id="mybutton_{{filter.id}}" ng-click="toggle(filter)">{{filter.title}}</div>'
            ,
            link:function (scope, element, attr) {
                //console.log(attr);
                //console.log('innerHTML is ' + element.html());
                //var uls = element[0].parentElement.children[0].children;
                //console.log(uls);
//                scope.$watch('update', function (newValue) {
//                    console.log('innerHTML is... ' + element.innerHTML);
//                });

            }
        };
    });
/*
'<div ng-click="toggle(article)">'+
                            '<h2>{{article.title}}</h2>'+
                            '<div class="short_text" ng-if="!article.active">{{article.short}}</div>'+
                            '<div class="long_text" ng-if="article.active">{{article.long}}</div>'+
                        '</div>'














*/
