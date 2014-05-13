'use strict';

/* Directives */


angular.module('usvit.directives', [])
    .directive('article', function() {
        return {
            restrict: 'A',
            template:   '<div ng-click="art_toggle(article)">'+
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
                    '<div ng-class="{filter_button:true,rounded:true,filter_button_active:filter.active == true}" id="mybutton_{{filter.id}}" ng-click="cat_toggle(filter)">{{filter.title}}</div>'
                    //'<div ng-class="filter_button rounded {{filter.active?\'filter_button_active\':\'\'}}" id="mybutton_{{filter.id}}" ng-click="toggle(filter)">{{filter.title}}</div>'
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
