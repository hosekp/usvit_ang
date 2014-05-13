'use strict';



angular.module("usvit.services",[]).service('$PubSub', function() {
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
});