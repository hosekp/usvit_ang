'use strict';

/* Controllers */

angular.module('usvit.controllers', [])
  .controller("mainCtrl",["$scope","$routeParams","$PubSub",function($scope,$routeParams,$PubSub){
        $scope.isucastnici=false;
        $PubSub.publish("routing",$routeParams);
  }])
  .controller("mainUcaCtrl",["$scope","$routeParams","$PubSub",function($scope,$routeParams,$PubSub){
        $scope.isucastnici=true;
        $routeParams.categ="ucastnici";
        $PubSub.publish("routing",$routeParams);
  }])
  .controller("categ",["$scope","$PubSub","Art",function($scope,$PubSub,Art){
        var arts=Art.query();
        arts.$promise.then(function (arts) {
            $scope.articles=arts;
            window.data.articles=arts;
            render();
        });
        function render(){
            var arts=$scope.articles;
            angular.forEach(arts,function(art){
                art.valid=(art.categ===$scope.categ || ($scope.categ==="all" && art.categ!=="home"));
            });
            if($scope.artID){
                for(var i in arts){
                    var art=arts[i];
                    if(art.id===$scope.artID){
                        if(!art.long){
                            art.long=Art.detail({ID:art.id});
//                            Art.detail({ID:art.id}).$promise.then(function(long){
//                                art.long=long.long;
//                                art.active=true;
//                            });
                        }else{
                        }
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
        }
        function registering(routeParams){
            $scope.categ=routeParams.categ;
            $scope.artID=routeParams.artID;
            render();
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
            $scope.race=routeParams.race;
            if(!$scope.categ){return;}
            var artic=$scope.categ!=="ucastnici";
            
            $scope.artID=routeParams.artID;
            angular.forEach($scope.filters.art,function(art){
                art.valid=artic;
                art.active=art.id===$scope.categ;
            });
            angular.forEach($scope.filters.uca,function(uca){
                uca.valid=!artic;
                uca.active=uca.id===$scope.race;
            });
           
        }
        $scope.cat_toggle=function(fil){
            //art.active=!art.active;
            //$location.path("#/"+$routeParams.categ+"/"+art.id);
            //alert("toggle");
            var url="#/";
            if(!fil.art){
                url+="ucastnici";
                if(fil.active){
                    url+="/all";
                }else{
                    url+= "/"+fil.id;
                }
                if($scope.ucaID){
                    url+="/"+$scope.ucaID;
                }
            }else{
                if(fil.active){
                    url += "home";
                }else{
                    url += fil.id;
                }
                if($scope.artID){
                    url+="/"+$scope.artID;
                }
            }
            window.location.href=url;
        };
        //####### in-line ##########
        //$scope.filters=window.data.filters.art;
        $scope.filters=window.data.filters;
        $PubSub.register("routing",registering);
        var lastpub=$PubSub.last("routing");
        if(lastpub){
            registering(lastpub);
        }
        
        
    }])
    .controller("rightCtrl",["$scope","$PubSub",function($scope,$PubSub){
        function registering(routeParams){
            $scope.categ=routeParams.categ;
            $scope.artID=routeParams.ucaID;
            $scope.race=routeParams.race;
        }
        $scope.ucastnici=window.data.ucastnici;
        $PubSub.register("routing",registering);
        var lastpub=$PubSub.last("routing");
        if(lastpub){
            registering(lastpub);
        }
        $scope.uca_show=function(uca){
            var url="#/ucastnici/";
            url+=uca.frac;
            window.location.href = url+"/"+uca.id;
        };
        $scope.prihlasen=null;
        $scope.opened=false;
        $scope.login=function(lname,lpass){
            $scope.opened=false;
            //$scope.prihlasen=getUca(1);
            $PubSub.publish("login",getUca(12));
        };
        $scope.delogin=function(){
            $PubSub.publish("login",null);
        };
        $scope.alert=function(text){
            alert(text);
        };
        $PubSub.register("login",function(uca){
            $scope.prihlasen=uca;
        });
        var lastpub=$PubSub.last("login");
        if(lastpub){
            $scope.prihlasen=lastpub;
        }
        function getUca(id){
            var ucas=$scope.ucastnici;
            for(var i=0;i<ucas.length;i++){
                if(ucas[i].id===id){return ucas[i];}
            };
            return null;
        }
    }])
    .controller("ucasCtrl",["$scope","$PubSub",function($scope,$PubSub){
        function registering(routeParams){
            $scope.categ=routeParams.categ;
            $scope.ucaID=routeParams.ucaID;
            $scope.race=routeParams.race;
            angular.forEach($scope.ucastnici,function(uca){
                uca.active=""+uca.id===$scope.ucaID;
                if($scope.race==="all"||$scope.race===uca.frac){
                    uca.valid=true;
                }else{
                    uca.valid=false;
                }

            });
        }
        $scope.ucastnici=window.data.ucastnici;
        $PubSub.register("routing",registering);
        var lastpub=$PubSub.last("routing");
        if(lastpub){
            registering(lastpub);
        }
        $scope.uca_toggle=function(uca){
            var url="#/ucastnici/";
            if($scope.race){
                url+=$scope.race;
            }else{
                url+="all";
            }
            if(uca.active){
                //url += "#/ucastnici";
            }else{
                url += "/"+uca.id;
            }
            window.location.href=url;
        };
    }])
;
