lhcAppControllers.controller("BotRestAPIParameters",["$scope","$http","$location","$rootScope","$log","$window",function(t,e,s,a,i,o){this.parameters=[],this.host="",this.ecache="",this.log_audit="",this.log_system="";var r=this;this.addParameter=function(){r.parameters.push({method:"GET",authorization:"",api_key_location:"header",query:[],header:[],conditions:[],postparams:[],userparams:[],output:[],id:"temp"+(new Date).getTime()})},this.addParam=function(t){t.push({key:"",value:"",id:"temp"+(new Date).getTime()})},this.deleteParam=function(t,e){t.splice(t.indexOf(e),1)},this.deleteParameter=function(t){r.parameters.splice(r.parameters.indexOf(t),1)},this.getJSON=function(){return JSON.stringify({host:r.host,log_audit:r.log_audit,log_system:this.log_system,ecache:r.ecache,parameters:r.parameters})},this.initParams=function(){this.parameters=o.rest_api_parameters,this.parameters.forEach((function(t){void 0===t.conditions&&(t.conditions=[])})),this.host=o.botRestAPIHost,this.ecache=o.botRestAPIECache,this.log_audit=o.botRestAPIAuditLog,this.log_system=o.botRestAPISystemLog}}]);
//# sourceMappingURL=aab810d35fbe9611616dfed61a7ef53a.js.map
