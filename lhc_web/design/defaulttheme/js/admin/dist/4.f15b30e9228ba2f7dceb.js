(window.webpackJsonpLHCReactAPPAdmin=window.webpackJsonpLHCReactAPPAdmin||[]).push([[4],{63:function(e,t,a){"use strict";a.r(t);var n=a(14),c=a.n(n),s=a(2),r=a.n(s),l=a(0),i=a.n(l),o=a(15),m=a.n(o),u=a(48),d=a.n(u),h=i.a.memo((function(e){var t=e.message,a=e.index,n=!1;return d()(t.msg,{replace:function(e){if(e.attribs){var c=Object.assign({},e.attribs);if(e.attribs.class&&(e.attribs.className=e.attribs.class,-1!==e.attribs.className.indexOf("message-row")&&a>0&&(e.attribs.className+=" fade-in-fast",t.msop>0&&t.msop!=t.lmsop&&0==n&&(e.attribs.className+=" operator-changes",n=!0)),delete e.attribs.class),e.attribs.onclick&&delete e.attribs.onclick,e.name&&"img"===e.name)return i.a.createElement("img",e.attribs);if(e.name&&"a"===e.name&&c.onclick)return i.a.createElement("a",e.attribs,Object(u.domToReact)(e.children))}}})}));var p=a(4),b=a.n(p),g=a(5),f=a.n(g),v=new(function(){function e(){b()(this,e),this.eventEmitter=new EventEmitter,this.chatsSynchro=[],this.chatsSynchroMsg=[],this.timeoutSync=null,this.syncInProgress=!1,this.fetchStatus=!1}return f()(e,[{key:"setFetchStatus",value:function(e){this.fetchStatus=e}},{key:"sync",value:function(){var e=this;1!=this.syncInProgress&&(this.syncInProgress=!0,m.a.post(WWW_DIR_JAVASCRIPT+"groupchat/sync"+(1==this.fetchStatus?"/(opt)/status":""),this.chatsSynchroMsg).then((function(t){e.fetchStatus=!1;var a=[];t.data.result.forEach((function(t){a[t.chat_id]||(a[t.chat_id]={}),a[t.chat_id].msg=t;var n=e.chatsSynchro.indexOf(t.chat_id),c=e.chatsSynchroMsg[n].split(",");c[1]=t.message_id,e.chatsSynchroMsg[n]=c.join(",")})),t.data.result_status.forEach((function(t){a[t.chat_id]||(a[t.chat_id]={}),a[t.chat_id].status=t;var n=e.chatsSynchro.indexOf(t.chat_id),c=e.chatsSynchroMsg[n].split(",");c[2]=t.lgsync,e.chatsSynchroMsg[n]=c.join(",")})),a.forEach((function(t,a){e.eventEmitter.emitEvent("gchat_"+a,[t])})),e.syncInProgress=!1})))}},{key:"startSync",value:function(){var e=this;clearTimeout(this.timeoutSync),this.chatsSynchro.length>0&&(this.timeoutSync=setInterval((function(){e.sync()}),2500))}},{key:"addSubscriber",value:function(e,t){this.chatsSynchro.push(parseInt(e)),this.chatsSynchroMsg.push(e+",0,0"),this.eventEmitter.addListener("gchat_"+e,t),this.startSync()}},{key:"removeSubscriber",value:function(e,t){var a=this.chatsSynchro.indexOf(parseInt(e));-1!==a&&(this.chatsSynchro.splice(a,1),this.chatsSynchroMsg.splice(a,1),this.eventEmitter.removeListener("gchat_"+e,t),this.startSync())}}]),e}()),_=a(64);function y(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,n)}return a}function E(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?y(Object(a),!0).forEach((function(t){r()(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):y(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}function I(e,t){switch(t.type){case"increment":return{count:e.count+1};case"decrement":return{count:e.count-1};case"update":return E({},e,{},t.value);case"update_messages":return t.messages.lmsop=e.lmsop||t.value.lmsop,(e=E({},e,{},t.value)).messages.push(t.messages),e;case"update_history":return e=E({},e,{},t.value),""!=t.history.msg&&e.messages.unshift(t.history),e;case"init":return{count:e.count-1};default:throw new Error("Unknown action!")}}t.default=function(e){var t=Object(l.useRef)(null),n=Object(l.useRef)(null),s=Object(l.useRef)(null),r=Object(l.useRef)(null),o=Object(l.useReducer)(I,{messages:[],operators:[],supervistors:[],operators_invite:[],chat:{},has_more_messages:!1,old_message_id:0,last_message:"",error:"",last_message_id:0,lmsop:0,lgsync:0}),u=c()(o,2),d=u[0],p=u[1],b=function(e){angular.element("body").scope().startChatOperatorPublic(e.user_id)},g=function(e,t){var a,n=document.getElementById("chat-tab-link-"+e),c=!1;null!==n&&t>1&&!n.classList.contains("active")&&null!==(a=n.querySelector(".whatshot"))&&(a.classList.remove("d-none"),c=!0),0==c&&null!==(n=document.getElementById("private-chat-tab-link-"+e))&&t>1&&!n.classList.contains("active")&&null!==(a=n.querySelector(".whatshot"))&&a.classList.remove("d-none")};Object(l.useEffect)((function(){if(n.current.scrollTop=n.current.scrollHeight,e.chatPublicId)g(e.chatPublicId,d.messages.length);else{var t=document.getElementById("chat-tab-link-gc"+e.chatId);t&&d.messages.length>1&&!t.classList.contains("active")&&t.querySelector(".whatshot").classList.remove("d-none")}}),[d.messages.length]);var f=null,y=function(){clearTimeout(f),f=setTimeout((function(){m.a.get(WWW_DIR_JAVASCRIPT+"groupchat/searchoperator/"+e.chatId+"?"+(e.chatPublicId?"id="+e.chatPublicId+"&":"")+"q="+escape(r.current.value)).then((function(e){p({type:"update",value:{operators_invite:e.data}})}))}),200)},E=function(){p({type:"update",value:{operators_invite:[]}})};Object(l.useEffect)((function(){var c=function(e){if(e.msg&&p({type:"update_messages",messages:{msg:e.msg.content,msop:e.msg.msop},value:{last_message_id:e.msg.message_id,lmsop:e.msg.lmsop}}),e.status){var t={operators:e.status.operators,lgsync:e.status.lgsync};e.status.old_message_id&&(t.has_more_messages=e.status.has_more_messages,t.old_message_id=e.status.old_message_id),p({type:"update",value:t})}},r=function(t){l(e.chatPublicId,null,!0)};m.a.post(WWW_DIR_JAVASCRIPT+"groupchat/"+(e.chatPublicId?"loadpublichat":"loadgroupchat")+"/"+(e.chatPublicId||e.chatId)).then((function(t){if(e.chatPublicId){var n=document.createElement("div");n.innerHTML='<i class="whatshot blink-ani d-none text-warning material-icons">whatshot</i>',document.getElementById("chat-tab-link-"+e.chatPublicId).prepend(n.firstChild),document.getElementById("private-chat-tab-link-"+e.chatPublicId).addEventListener("click",r)}else!function(e){if(localStorage)try{var t=[],a=localStorage.getItem("gachat_id");null!==a&&""!==a&&(t=a.split(",")),-1===t.indexOf(e)&&(t.push(e),localStorage.setItem("gachat_id",t.join(",")))}catch(e){}}(e.chatId);var l=document.getElementById("private-chat-tab-link-"+e.chatPublicId);if((e.paramsStart&&e.paramsStart.unread||null!==l&&"true"==l.getAttribute("data-unread"))&&g(e.chatPublicId,2),e.chatId=String(t.data.chat.id),v.addSubscriber(e.chatId,c),v.sync(),!e.chatPublicId){var i=s.current,o=a(60),m=i.querySelectorAll('[data-toggle="tab"]');m.length>0&&Array.prototype.forEach.call(m,(function(e){new o.Tab(e)}))}p({type:"update",value:{chat:t.data.chat,supervisors:t.data.supervisors||[]}})})).catch((function(t){!e.chatPublicId&&lhinst.removeDialogTabGroup("gc"+e.chatId,$("#tabs"),!0),t.response&&t.response.data&&t.response.data.error&&p({type:"update",value:{error:t.response.data.error}})}));var l=function(a,c,s){if(e.chatPublicId&&a==e.chatPublicId||!e.chatPublicId&&a==e.chatId){var r,l;if(null!==n.current&&setTimeout((function(){null!==n.current&&((!e.chatPublicId||s)&&t.current.focus(),n.current.scrollHeight-(n.current.scrollTop+n.current.offsetHeight)<n.current.offsetHeight-50&&(n.current.scrollTop=n.current.scrollHeight))}),2),null!==(r=document.getElementById(e.chatPublicId?"chat-tab-link-"+e.chatPublicId:"chat-tab-link-gc"+e.chatId)))null===(l=r.querySelector(".whatshot"))||l.classList.contains("d-none")||(l.classList.add("d-none"),e.chatPublicId&&document.getElementById("private-chat-tab-link-"+e.chatPublicId).click());if(e.chatPublicId)if(null!==(r=document.getElementById("private-chat-tab-link-"+e.chatPublicId)))null===(l=r.querySelector(".whatshot"))||l.classList.contains("d-none")||l.classList.add("d-none")}};return ee.addListener(e.chatPublicId?"chatTabClicked":"groupChatTabClicked",l),!e.chatPublicId&&t.current.focus(),function(){!function(e){if(localStorage)try{var t=[],a=localStorage.getItem("gachat_id");null!==a&&""!==a&&(t=a.split(",")),-1!==t.indexOf(e)&&t.splice(t.indexOf(e),1),localStorage.setItem("gachat_id",t.join(","))}catch(e){}}(e.chatId),e.chatPublicId?ee.removeListener("chatTabClicked",l):ee.removeListener("groupChatTabClicked",l),v.removeSubscriber(e.chatId,c)}}),[]);var N=function(t){m.a.get(WWW_DIR_JAVASCRIPT+"groupchat/inviteoperator/"+e.chatId+"/"+t.id).then((function(e){v.setFetchStatus(!0),v.sync(),t.invited=!0,p({type:"update",value:{operators_invite:d.operators_invite}})}))},S=function(t){m.a.get(WWW_DIR_JAVASCRIPT+"groupchat/cancelinvite/"+e.chatId+"/"+t.id).then((function(e){v.setFetchStatus(!0),v.sync(),t.invited=!1,p({type:"update",value:{operators_invite:d.operators_invite}})}))},P=Object(_.a)("group_chat"),k=P.t;P.i18n;return""!=d.error?i.a.createElement(i.a.Fragment,null,i.a.createElement("div",{className:"row"},i.a.createElement("div",{className:"col-12"},i.a.createElement("div",{className:"alert alert-info",role:"alert"},d.error)))):i.a.createElement(i.a.Fragment,null,i.a.createElement("div",{className:"row"},e.chatPublicId&&2==d.chat.type&&i.a.createElement("div",{className:"col-12 pb-1 border-bottom"},d.operators.map((function(t,a){return i.a.createElement("button",{className:"btn btn-sm fs12 btn-outline-secondary mb-1 mr-1"},e.userId!=t.user_id&&i.a.createElement("i",{title:"Start chat with an operator directly",onClick:function(e){return b(t)},className:"material-icons action-image"},"chat")," ",d.chat.user_id==t.user_id&&i.a.createElement("i",{title:"Group owner",className:"material-icons"},"account_balance")," ",t.n_off_full,!t.jtime&&i.a.createElement("span",{className:"ml-1 badge badge-info fs11"},k("operator.pending_join"))," ",i.a.createElement("i",{className:"material-icons"},t.hide_online?"flash_off":"flash_on"),t.last_activity_ago)}))),i.a.createElement("div",{className:(e.chatPublicId?"col-12":"col-7")+" chat-main-left-column"},i.a.createElement("div",{className:"message-block"},d.has_more_messages&&i.a.createElement("a",{className:"load-prev-btn",title:"Load more...",onClick:function(t){m.a.get(WWW_DIR_JAVASCRIPT+"groupchat/loadpreviousmessages/"+e.chatId+"/"+d.old_message_id).then((function(e){p({type:"update_history",value:{has_more_messages:e.data.has_messages,old_message_id:e.data.message_id},history:{msg:e.data.result,msop:e.data.msop,lmsop:e.data.lmsop}})}))}},i.a.createElement("i",{className:"material-icons"},"")),i.a.createElement("div",{className:"msgBlock msgBlock-admin msgBlock-group-admin",ref:n},d.messages.map((function(t,a){return i.a.createElement(h,{key:"msg_"+e.chatId+"_"+a,index:a,message:t})})))),i.a.createElement("div",{className:"message-container-admin mt-2"},i.a.createElement("textarea",{ref:t,placeholder:k("message.enter_message"),onKeyDown:function(a){return function(a,n){if(13==a.keyCode)return m.a.post(WWW_DIR_JAVASCRIPT+"groupchat/addmessage/"+e.chatId,{msg:t.current.value}).then((function(e){-1!==e.data.result.indexOf("status")&&v.setFetchStatus(!0),v.sync()})),t.current.value="",a.preventDefault(),void a.stopPropagation()}(a)},className:"form-control form-control-sm form-group",rows:"2"}))),!e.chatPublicId&&i.a.createElement("div",{className:"chat-main-right-column col-5"},i.a.createElement("div",{role:"tabpanel"},i.a.createElement("ul",{className:"nav nav-pills",role:"tablist",ref:s},i.a.createElement("li",{role:"presentation",className:"nav-item"},i.a.createElement("a",{className:"nav-link active",href:"#group-chat-"+e.chatId,"aria-controls":"#group-chat-"+e.chatId,role:"tab","data-toggle":"tab",title:"Operators"},i.a.createElement("i",{className:"material-icons mr-0"},"face"))),i.a.createElement("li",{className:"nav-item",role:"presentation"},i.a.createElement("a",{className:"nav-link ",href:"#group-chat-info-"+e.chatId,"aria-controls":"#group-chat-info-"+e.chatId,title:"Information",role:"tab","data-toggle":"tab"},i.a.createElement("i",{className:"material-icons mr-0"},"info_outline")))),i.a.createElement("div",{className:"tab-content"},i.a.createElement("div",{role:"tabpanel",className:"tab-pane active",id:"group-chat-"+e.chatId},i.a.createElement("ul",{className:"list-group list-group-flush border-0 mw-100 mx275"},d.operators.map((function(t,a){return i.a.createElement("li",{className:"list-group-item pl-1 py-1"},e.userId!=t.user_id&&i.a.createElement("i",{title:"Start chat with an operator directly",onClick:function(e){return b(t)},className:"material-icons action-image"},"chat")," ",d.chat.user_id==t.user_id&&i.a.createElement("i",{title:"Group owner",className:"material-icons"},"account_balance")," ",t.n_off_full,i.a.createElement("span",{className:"float-right fs11"},!t.jtime&&i.a.createElement("span",{className:"badge badge-info fs11"},k("operator.pending_join"))," ",t.last_activity_ago," ",i.a.createElement("i",{className:"material-icons"},t.hide_online?"flash_off":"flash_on")))})))),i.a.createElement("div",{role:"tabpanel",className:"tab-pane",id:"group-chat-info-"+e.chatId},1==d.chat.type&&i.a.createElement("div",null,i.a.createElement("div",{className:"form-row"},i.a.createElement("div",{className:"col-9"},i.a.createElement("input",{ref:r,onKeyUp:y,type:"text",placeholder:k("operator.search_tip"),className:"form-control form-control-sm"})),i.a.createElement("div",{className:"col-3"},i.a.createElement("div",{className:"btn-group w-100",role:"group","aria-label":"Basic example"},i.a.createElement("button",{onClick:y,className:"btn d-block btn-secondary btn-sm"},i.a.createElement("span",{className:"material-icons"},"search")),i.a.createElement("button",{disabled:0==d.operators_invite.length,onClick:E,className:"btn d-block btn-secondary btn-sm"},i.a.createElement("span",{className:"material-icons"},"delete"))))),i.a.createElement("ul",{className:"m-0 p-0 mt-2 mx275"},d.operators_invite.map((function(e,t){return i.a.createElement("li",{className:"list-group-item p-2 fs13",title:e.id},e.name_official,!e.member&&!e.invited&&i.a.createElement("button",{className:"float-right btn btn-xs btn-secondary",onClick:function(t){return N(e)}},k("operator.invite")),!e.member&&e.invited&&i.a.createElement("button",{className:"float-right btn btn-xs btn-warning",onClick:function(t){return S(e)}},k("operator.cancel_invite")),e.member&&i.a.createElement("button",{disabled:"disabled",className:"float-right btn btn-xs btn-success"},k("operator.already_member")))}))),i.a.createElement("hr",null)),i.a.createElement("button",{className:"btn btn-xs btn-danger",title:k("operator.leave_group_tip"),onClick:function(t){m.a.get(WWW_DIR_JAVASCRIPT+"groupchat/leave/"+e.chatId).then((function(t){lhinst.removeDialogTabGroup("gc"+e.chatId,$("#tabs"),!0)}))}},k("operator.leave_group")))))),e.chatPublicId&&i.a.createElement("div",{className:"col-12"},i.a.createElement("div",{className:"pb-1"},e.chatPublicId&&2==d.chat.type&&d.supervisors.length>0&&d.supervisors.map((function(e,t){return i.a.createElement(i.a.Fragment,null,!e.member&&!e.invited&&i.a.createElement("button",{className:"btn btn-xs btn-secondary",onClick:function(t){return N(e)}},e.nick," | ",k("operator.invite")))}))),i.a.createElement("div",{className:"row"},i.a.createElement("div",{className:"col-9"},i.a.createElement("input",{ref:r,onKeyUp:y,type:"text",placeholder:k("operator.search_tip"),className:"form-control form-control-sm"})),i.a.createElement("div",{className:"col-3"},i.a.createElement("div",{className:"btn-group w-100",role:"group","aria-label":"Basic example"},i.a.createElement("button",{onClick:y,className:"btn d-block btn-secondary btn-sm"},i.a.createElement("span",{className:"material-icons"},"search")),i.a.createElement("button",{disabled:0==d.operators_invite.length,onClick:E,className:"btn d-block btn-secondary btn-sm"},i.a.createElement("span",{className:"material-icons"},"delete"))))),i.a.createElement("ul",{className:"m-0 p-0 mt-2 mx275"},d.operators_invite.map((function(e,t){return i.a.createElement("li",{className:"list-group-item p-2 fs13",title:e.id},e.name_official,!e.member&&!e.invited&&i.a.createElement("button",{className:"float-right btn btn-xs btn-secondary",onClick:function(t){return N(e)}},k("operator.invite")),!e.member&&e.invited&&i.a.createElement("button",{className:"float-right btn btn-xs btn-warning",onClick:function(t){return S(e)}},k("operator.cancel_invite")),e.member&&i.a.createElement("button",{disabled:"disabled",className:"float-right btn btn-xs btn-success"},k("operator.already_member")))}))))))}}}]);