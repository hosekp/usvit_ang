'use strict';

/* Controllers */

angular.module('usvit.controllers', [])
  .controller('MyCtrl1', [function() {

  }])
  .controller('MyCtrl2', [function() {

  }])
//  .controller("categ",["$scope",function($scope){
//      $scope.articles=window.data.home;
//  }]);
  .controller("categ",["$scope","$routeParams","$location",function($scope,$routeParams,$location){
        $scope.categ=$routeParams.categ;
        if($scope.categ==="all"){
            var arts=[];
            var categs=["important","noviny","forum"];
            for(var c in categs){
                arts=arts.concat(window.data[categs[c]]);
            }
            //console.log(arts);
        }else{
            var arts=window.data[$routeParams.categ];
        }
        if($routeParams.artID){
            for(var i in arts){
                var art=arts[i];
                //alert(art.id+"==="+$routeParams.artID);
                if(art.id===$routeParams.artID){
                    art.active=true;
                }else{
                    art.active=false;
                }
            }
            //$scope.articlesactive=$routeParams.artID;
        }else{
             for(var i in arts){
                var art=arts[i];
                art.active=false;
            }   
        }
        $scope.categ=$routeParams.categ;
        $scope.articles=arts;
        $scope.toggle=function(art){
            //art.active=!art.active;
            //$location.path("#/"+$routeParams.categ+"/"+art.id);
            if(art.active){
                window.location.href = "#/"+$routeParams.categ;
            }else{
                window.location.href = "#/"+$routeParams.categ+"/"+art.id;
            }
        };
    }])
    .controller("filters",["$scope","$routeParams","$location",function($scope,$routeParams,$location){
        $scope.categ=$routeParams.categ;
        $scope.artID=$routeParams.artID;
        $scope.filters=[
            {id:"all",title:"Vše"},
            {id:"important",title:"Důležité"},
            {id:"noviny",title:"Noviny"},
            {id:"forum",title:"Fórum"}
        ];
        for(var f in $scope.filters){
            var filter=$scope.filters[f];
            if(filter.id===$scope.categ){
                filter.active=true;
            }else{
                filter.active=false;
            }
        }
        $scope.toggle=function(fil){
            //art.active=!art.active;
            //$location.path("#/"+$routeParams.categ+"/"+art.id);
            //alert("toggle");
            if(fil.active){
                window.location.href = "#/all";
            }else{
                window.location.href = "#/"+fil.id;
            }
        };
        
    }]);
