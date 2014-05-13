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
