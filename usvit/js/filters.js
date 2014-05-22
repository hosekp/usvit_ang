'use strict';

/* Filters */

angular.module('usvit.filters', []).
  filter('f_categ',function(){
      return function(array){
          var result=[];
          angular.forEach(array,function(item){
//              if(item.categ===categ || categ==="all" && item.categ!=="home"){
//                  result.push(item);
//              }
          if(item.valid){
              result.push(item);
          }
          });
          return result;
      };
    })
    .filter('f_art',function(){
        return function(item,artID){
            return item.active===artID;
        };
    })
    .filter('sort_by_change',function(){
        return function(array){
            return array;
        };
    })
    .filter('filter_uca',function(){
        return function(array,uca){
            if(!uca){return array;}
            var ret=[];
            for(var i=0;i<array.length;i++){
                if(array[i].id===uca.id){continue;}
                ret.push(array[i]);
            }
            return array;
        };
    })
    .filter("sanitize",["$sce",function($sce){
        return function(html){
            return $sce.trustAsHtml(html);
        };
    }])

;
