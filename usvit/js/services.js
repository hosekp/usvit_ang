'use strict';



angular.module("usvit.services",['ngResource'])

.factory('Uca', ['$resource',
    function($resource){
        return $resource('./php/download.php', {categ:"uca"}, {
        //get:{method:'GET',params:{}},
        query: {method:'GET', params:{type:"query"}, isArray:true},
        list: {method:'GET', params:{type:"list"}, isArray:true},
        detail:{method:'GET', params:{type:"detail"}}
    });
}])
.factory('Art', ['$resource',
    function($resource){
        return $resource('./php/download.php', {categ:"art"}, {
        //get:{method:'GET',params:{}},
        query: {method:'GET', params:{type:"query"}, isArray:true},
        detail:{method:'GET', params:{type:"detail"}}
    });
}])

.service('$PubSub', function() {
  var subscribers = {};
  var lastPublished = {};
  this.register = function(topic, callback) {
    var callbacks = subscribers[topic];
    if(!callbacks) {
      callbacks = [];
      subscribers[topic] = callbacks;
    }
    callbacks.push(callback);
  },
  this.last = function(topic){
      //if(lastPublished[topic]){
          return lastPublished[topic];
      //}
  };
  this.publish = function(topic, message) {
    lastPublished[topic]=message;
    var callbacks = subscribers[topic];
    angular.forEach(callbacks, function(callback) {
      callback(message);
    });
  };
})
//.service('$sanitHTML',["$sce",function($sce) {
//    
//}])
;