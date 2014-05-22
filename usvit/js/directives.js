'use strict';

/* Directives */


angular.module('usvit.directives', [])
    .directive('article', function() {
        return {
            restrict: 'A',
            template:   '<div ng-click="art_toggle(article)">'+
                            '<h2>{{article.title}}</h2>'+
                            '<div class="short_text animate-show" ng-hide="article.active">{{article.short}}</div>'+
                            '<div class="long_text animate-show" ng-show="article.active" ng-bind-html="article.long | sanitize"></div>'+
                        '</div>'
            ,
            link: function(scope, elem, attrs) {
                //alert(scope.action);
                //if(scope.action)
            }
        };
    })
    .directive('ucasmain', function() {
        return {
            restrict: 'A',
            templateUrl:"./partials/ucasmain.html",
            transclude: true,
            link: function(scope, elem, attrs) {}
        };
    })
    .directive('ucasright', function() {
        return {
            restrict: 'A',
            transclude: true,
            template:   '<div ng-click="uca_show(ucastnik)" class="{{ucastnik.frac}}">'+
                            '{{ucastnik.nick}}'+
                        '</div>'
            ,
            link: function(scope, elem, attrs) {}
        };
    })
    .directive('mybutton', function() {
        return {
            restrict: 'E',
            template: 
                    '<div ng-class="{filter_button:true,rounded:true,active:filter.active == true}" id="mybutton_{{filter.id}}" ng-click="cat_toggle(filter)">{{filter.title}}</div>'
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

