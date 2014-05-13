'use strict';

/* Controllers */

angular.module('usvit.controllers', [])
  .controller("mainCtrl",["$scope","$routeParams","$PubSub",function($scope,$routeParams,$PubSub){
        //$scope.isucastnici=($routeParams.categ==="ucastnici");
        $PubSub.publish("routing",$routeParams);
  }])
  .controller("categ",["$scope","$PubSub",function($scope,$PubSub){
        function registering(routeParams){
            $scope.categ=routeParams.categ;
            $scope.artID=routeParams.artID;
            var arts=window.data;
            angular.forEach(arts,function(art){
                art.valid=(art.categ===$scope.categ || ($scope.categ==="all" && art.categ!=="home"));
            });
            if($scope.artID){
                for(var i in arts){
                    var art=arts[i];
                    if(art.id===$scope.artID){
                        art.active=true;
                    }else{
                        art.active=false;
                    }
                }
            }else{
                 for(var i in arts){
                    var art=arts[i];
                    art.active=false;
                }   
            }
            $scope.articles=arts;
        }
        //window.categ=$routeParams.categ;
        $scope.art_toggle=function(art){
            //art.active=!art.active;
            //$location.path("#/"+$routeParams.categ+"/"+art.id);
            if(art.active){
                window.location.href = "#/"+$scope.categ;
            }else{
                window.location.href = "#/"+$scope.categ+"/"+art.id;
            }
        };
        //######## in-line ############
        $PubSub.register("routing",registering);
        var lastpub=$PubSub.last("routing");
        if(lastpub){
            registering(lastpub);
        }
    }])
    .controller("filtCtrl",["$scope","$PubSub",function($scope,$PubSub){
        $scope.filters=[
            {id:"all",title:"Vše"},
            {id:"important",title:"Důležité"},
            {id:"noviny",title:"Noviny"},
            {id:"forum",title:"Fórum"}
        ];
        
        
        /*for(var f in $scope.filters){
            var filter=$scope.filters[f];
            if(filter.id===$scope.categ){
                filter.active=true;
            }else{
                filter.active=false;
            }
        }*/
        function registering(routeParams){
            $scope.categ=routeParams.categ;
            $scope.artID=routeParams.artID;
            for(var f in $scope.filters){
                var filter=$scope.filters[f];
                if(filter.id===$scope.categ){
                    filter.active=true;
                }else{
                    filter.active=false;
                }
            }
        }
        $scope.cat_toggle=function(fil){
            //art.active=!art.active;
            //$location.path("#/"+$routeParams.categ+"/"+art.id);
            //alert("toggle");
            if(fil.active){
                window.location.href = "#/home";
            }else{
                window.location.href = "#/"+fil.id;
            }
        };
        //####### in-line ##########
        $PubSub.register("routing",registering);
        var lastpub=$PubSub.last("routing");
        if(lastpub){
            registering(lastpub);
        }
        
        
    }]);
