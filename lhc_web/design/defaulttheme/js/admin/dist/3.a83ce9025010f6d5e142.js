(window.webpackJsonpLHCReactAPPAdmin=window.webpackJsonpLHCReactAPPAdmin||[]).push([[3],{60:function(e,t,n){e.exports=n(61)()},61:function(e,t,n){"use strict";var a=n(62);function r(){}function i(){}i.resetWarningCache=r,e.exports=function(){function e(e,t,n,r,i,o){if(o!==a){var c=new Error("Calling PropTypes validators directly is not supported by the `prop-types` package. Use PropTypes.checkPropTypes() to call them. Read more at http://fb.me/use-check-prop-types");throw c.name="Invariant Violation",c}}function t(){return e}e.isRequired=e;var n={array:e,bool:e,func:e,number:e,object:e,string:e,symbol:e,any:e,arrayOf:t,element:e,elementType:e,instanceOf:t,node:e,objectOf:t,oneOf:t,oneOfType:t,shape:t,exact:t,checkPropTypes:i,resetWarningCache:r};return n.PropTypes=n,n}},62:function(e,t,n){"use strict";e.exports="SECRET_DO_NOT_PASS_THIS_OR_YOU_WILL_BE_FIRED"},63:function(e,t,n){"use strict";(function(e){n.d(t,"a",(function(){return r}));var a=function(){return"undefined"!=typeof window?window:e},r=function(){var e=a();return e&&e.tinymce?e.tinymce:null}}).call(this,n(64))},64:function(e,t){var n;n=function(){return this}();try{n=n||new Function("return this")()}catch(e){"object"==typeof window&&(n=window)}e.exports=n},66:function(e,t,n){"use strict";n.r(t);var a,r,i=n(14),o=n.n(i),c=n(2),l=n.n(c),s=n(0),m=n.n(s),u=n(15),d=n.n(u),p=n(68),f=n(16),h=n.n(f),v=m.a.memo((function(e){var t=e.children,n=Object(s.useState)(!1),a=o()(n,2),r=a[0],i=a[1];return m.a.createElement(m.a.Fragment,null,m.a.createElement("div",{className:"pb-2"},m.a.createElement("button",{onClick:function(){return i(!r)},className:"btn btn-sm btn-outline-secondary"},"...")),r&&t)})),b=n(60),g=function(){return(g=Object.assign||function(e){for(var t,n=1,a=arguments.length;n<a;n++)for(var r in t=arguments[n])Object.prototype.hasOwnProperty.call(t,r)&&(e[r]=t[r]);return e}).apply(this,arguments)},E={onActivate:b.func,onAddUndo:b.func,onBeforeAddUndo:b.func,onBeforeExecCommand:b.func,onBeforeGetContent:b.func,onBeforeRenderUI:b.func,onBeforeSetContent:b.func,onBeforePaste:b.func,onBlur:b.func,onChange:b.func,onClearUndos:b.func,onClick:b.func,onContextMenu:b.func,onCopy:b.func,onCut:b.func,onDblclick:b.func,onDeactivate:b.func,onDirty:b.func,onDrag:b.func,onDragDrop:b.func,onDragEnd:b.func,onDragGesture:b.func,onDragOver:b.func,onDrop:b.func,onExecCommand:b.func,onFocus:b.func,onFocusIn:b.func,onFocusOut:b.func,onGetContent:b.func,onHide:b.func,onInit:b.func,onKeyDown:b.func,onKeyPress:b.func,onKeyUp:b.func,onLoadContent:b.func,onMouseDown:b.func,onMouseEnter:b.func,onMouseLeave:b.func,onMouseMove:b.func,onMouseOut:b.func,onMouseOver:b.func,onMouseUp:b.func,onNodeChange:b.func,onObjectResizeStart:b.func,onObjectResized:b.func,onObjectSelected:b.func,onPaste:b.func,onPostProcess:b.func,onPostRender:b.func,onPreProcess:b.func,onProgressState:b.func,onRedo:b.func,onRemove:b.func,onReset:b.func,onSaveContent:b.func,onSelectionChange:b.func,onSetAttrib:b.func,onSetContent:b.func,onShow:b.func,onSubmit:b.func,onUndo:b.func,onVisualAid:b.func},y=g({apiKey:b.string,id:b.string,inline:b.bool,init:b.object,initialValue:b.string,onEditorChange:b.func,outputFormat:b.oneOf(["html","text"]),value:b.string,tagName:b.string,cloudChannel:b.string,plugins:b.oneOfType([b.string,b.array]),toolbar:b.oneOfType([b.string,b.array]),disabled:b.bool,textareaName:b.string,tinymceScriptSrc:b.string},E),_=function(e){return"function"==typeof e},N=function(e){return e in E},w=function(e,t,n){(function(e){return Object.keys(e).filter(N).filter((function(t){return _(e[t])})).map((function(t){return{handler:e[t],eventName:t.substring(2)}}))})(t).forEach((function(t){var a=n[t.eventName];_(a)&&e.off(t.eventName,a);var r=function(n){return t.handler(n,e)};n[t.eventName]=r,e.on(t.eventName,r)}))},C=0,O=function(e){var t=(new Date).getTime();return e+"_"+Math.floor(1e9*Math.random())+ ++C+String(t)},R=function(e){return void 0===e||""===e?[]:Array.isArray(e)?e:e.split(" ")},I=function(){return{listeners:[],scriptId:O("tiny-script"),scriptLoaded:!1}},k=(a=I(),{load:function(e,t,n){a.scriptLoaded?n():(a.listeners.push(n),e.getElementById(a.scriptId)||function(e,t,n,a){var r=t.createElement("script");r.referrerPolicy="origin",r.type="application/javascript",r.id=e,r.src=n;var i=function(){r.removeEventListener("load",i),a()};r.addEventListener("load",i),t.head&&t.head.appendChild(r)}(a.scriptId,e,t,(function(){a.listeners.forEach((function(e){return e()})),a.scriptLoaded=!0})))},reinitialize:function(){a=I()}}),j=n(63),S=(r=function(e,t){return(r=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(e,t){e.__proto__=t}||function(e,t){for(var n in t)t.hasOwnProperty(n)&&(e[n]=t[n])})(e,t)},function(e,t){function n(){this.constructor=e}r(e,t),e.prototype=null===t?Object.create(t):(n.prototype=t.prototype,new n)}),P=function(){return(P=Object.assign||function(e){for(var t,n=1,a=arguments.length;n<a;n++)for(var r in t=arguments[n])Object.prototype.hasOwnProperty.call(t,r)&&(e[r]=t[r]);return e}).apply(this,arguments)},A=function(e){function t(t){var n=e.call(this,t)||this;return n.handleEditorChange=function(e){var t=n.editor;if(t){var a=t.getContent({format:n.props.outputFormat});a!==n.currentContent&&(n.currentContent=a,_(n.props.onEditorChange)&&n.props.onEditorChange(n.currentContent,t))}},n.handleInit=function(e){var t=n.editor;t&&(t.setContent(n.getInitialValue()),_(n.props.onEditorChange)&&t.on("change keyup setcontent",n.handleEditorChange),_(n.props.onInit)&&n.props.onInit(e,t),w(t,n.props,n.boundHandlers))},n.initialise=function(){var e,t,a,r=P(P({},n.props.init),{target:n.elementRef.current,readonly:n.props.disabled,inline:n.inline,plugins:(e=n.props.init&&n.props.init.plugins,t=n.props.plugins,R(e).concat(R(t))),toolbar:n.props.toolbar||n.props.init&&n.props.init.toolbar,setup:function(e){n.editor=e,e.on("init",n.handleInit),n.props.init&&_(n.props.init.setup)&&n.props.init.setup(e)}});null!==(a=n.elementRef.current)&&"textarea"===a.tagName.toLowerCase()&&(n.elementRef.current.style.visibility=""),Object(j.a)().init(r)},n.id=n.props.id||O("tiny-react"),n.elementRef=s.createRef(),n.inline=n.props.inline?n.props.inline:n.props.init&&n.props.init.inline,n.boundHandlers={},n}return S(t,e),t.prototype.componentDidUpdate=function(e){this.editor&&this.editor.initialized&&(w(this.editor,this.props,this.boundHandlers),this.currentContent=this.currentContent||this.editor.getContent({format:this.props.outputFormat}),"string"==typeof this.props.value&&this.props.value!==e.value&&this.props.value!==this.currentContent&&this.editor.setContent(this.props.value),"boolean"==typeof this.props.disabled&&this.props.disabled!==e.disabled&&this.editor.setMode(this.props.disabled?"readonly":"design"))},t.prototype.componentDidMount=function(){null!==Object(j.a)()?this.initialise():this.elementRef.current&&this.elementRef.current.ownerDocument&&k.load(this.elementRef.current.ownerDocument,this.getScriptSrc(),this.initialise)},t.prototype.componentWillUnmount=function(){var e=this,t=this.editor;null!==Object(j.a)()&&t&&(t.off("init",this.handleInit),t.initialized&&(t.off("change keyup setcontent",this.handleEditorChange),Object.keys(this.boundHandlers).forEach((function(n){t.off(n,e.boundHandlers[n])})),this.boundHandlers={}),Object(j.a)().remove(t))},t.prototype.render=function(){return this.inline?this.renderInline():this.renderIframe()},t.prototype.renderInline=function(){var e=this.props.tagName,t=void 0===e?"div":e;return s.createElement(t,{ref:this.elementRef,id:this.id})},t.prototype.renderIframe=function(){return s.createElement("textarea",{ref:this.elementRef,style:{visibility:"hidden"},name:this.props.textareaName,id:this.id})},t.prototype.getScriptSrc=function(){if("string"==typeof this.props.tinymceScriptSrc)return this.props.tinymceScriptSrc;var e=this.props.cloudChannel;return"https://cdn.tiny.cloud/1/"+(this.props.apiKey?this.props.apiKey:"no-api-key")+"/tinymce/"+e+"/tinymce.min.js"},t.prototype.getInitialValue=function(){return"string"==typeof this.props.value?this.props.value:"string"==typeof this.props.initialValue?this.props.initialValue:""},t.propTypes=y,t.defaultProps={cloudChannel:"5"},t}(s.Component),x=m.a.memo((function(e){var t=Object(s.useState)(!1),n=o()(t,2),a=n[0],r=n[1],i=Object(s.useState)(null),c=o()(i,2),l=c[0],u=c[1],p=Object(s.useState)(null),f=o()(p,2),h=f[0],v=f[1],b=Object(s.useState)(null),g=o()(b,2),E=g[0],y=g[1],_=Object(s.useState)(!1),N=o()(_,2),w=N[0],C=N[1];return Object(s.useEffect)((function(){1==a&&0==w&&d.a.post(WWW_DIR_JAVASCRIPT+"mailconv/getreplydata/"+e.message.id).then((function(e){C(!0),v(e.data.intro),y(e.data.signature)}))}),[a]),m.a.createElement(m.a.Fragment,null,m.a.createElement("div",{className:"col-12 mt-2 pt-3 pb-2"},!a&&m.a.createElement("div",{className:"btn-group",role:"group","aria-label":"Mail actions"},m.a.createElement("button",{type:"button",className:"btn btn-sm btn-outline-secondary",onClick:function(){return r(!0)}},m.a.createElement("i",{className:"material-icons"},"reply"),"Reply"),m.a.createElement("button",{disabled:1==e.message.response_type,type:"button",className:"btn btn-sm btn-outline-secondary",onClick:function(){return e.noReplyRequired()}},m.a.createElement("i",{className:"material-icons"},"done"),"No reply required"),m.a.createElement("button",{type:"button",className:"btn btn-sm btn-outline-secondary"},m.a.createElement("i",{className:"material-icons"},"forward"),"Forward")),a&&w&&m.a.createElement("div",null,m.a.createElement(A,{tinymceScriptSrc:"/design/defaulttheme/js/tinymce/js/tinymce/tinymce.min.js",initialValue:"<p></p>"+h+"<blockquote>"+e.message.body_front+"</blockquote>"+E,onInit:function(){tinyMCE.get("reply-to-mce-"+e.message.id).focus()},id:"reply-to-mce-"+e.message.id,init:{height:250,automatic_uploads:!0,file_picker_types:"image",images_upload_url:"postAcceptor.php",file_picker_callback:function(e,t,n){var a=document.createElement("input");a.setAttribute("type","file"),a.setAttribute("accept","image/*"),a.onchange=function(){var t=this.files[0],n=new FileReader;n.onload=function(){var a="blobid"+(new Date).getTime(),r=tinymce.activeEditor.editorUpload.blobCache,i=n.result.split(",")[1],o=r.create(a,t,i);r.add(o),e(o.blobUri(),{title:t.name})},n.readAsDataURL(t)},a.click()},menubar:!1,plugins:["advlist autolink lists link image charmap print preview anchor image","searchreplace visualblocks code fullscreen","media table paste code help","print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen media template codesample table charmap hr pagebreak nonbreaking anchor toc advlist lists wordcount textpattern noneditable help pageembed charmap quickbars linkchecker emoticons advtable"],toolbar_mode:"wrap",toolbar:"undo redo | fontselect formatselect fontsizeselect | table | paste pastetext | subscript superscript | bold italic underline strikethrough | forecolor backcolor |                             alignleft aligncenter alignright alignjustify | insertfile image pageembed template link anchor codesample |                             bullist numlist outdent indent | removeformat permanentpen | charmap emoticons | fullscreen print preview | help"},onEditorChange:function(e,t){u(e)}}),m.a.createElement("div",{className:"float-right"},m.a.createElement("a",{className:"action-image",onClick:function(){return r(!1)}},m.a.createElement("i",{className:"material-icons"},"delete"))),m.a.createElement("div",{className:"btn-group mt-1",role:"group","aria-label":"Mail actions"},m.a.createElement("button",{type:"button",className:"btn btn-sm btn-outline-primary",onClick:function(){console.log(l)}},m.a.createElement("i",{className:"material-icons"},"send"),"Send")))))})),W=m.a.memo((function(e){var t=e.message,n=e.index,a=e.totalMessages,r=e.noReplyRequired,i=e.mode,c=e.addLabel,l=Object(s.useState)(!1),u=o()(l,2),d=u[0],p=u[1],b=Object(s.useState)(n+1==a),g=o()(b,2),E=g[0],y=g[1];Object(s.useEffect)((function(){}),[]);return m.a.createElement("div",{className:"row pb-2 mb-2 border-bottom"+(0==n&&"preview"!==i?" border-top pt-2":"")},m.a.createElement("div",{className:"col-7 action-image",onClick:function(){return y(!E)}},m.a.createElement("span",{title:"Expand message "+t.id},m.a.createElement("i",{className:"material-icons"},E?"expand_less":"expand_more")),m.a.createElement("b",null,t.from_name),m.a.createElement("small",null," <",t.from_address,"> "),m.a.createElement("small",{className:t.status&&1!=t.status?t.cls_time?"chat-closed":"chat-active":"chat-pending"},m.a.createElement("i",{className:"material-icons"},"mail_outline"),t.status&&1!=t.status?"Responded":"Pending response")),m.a.createElement("div",{className:"col-5 text-right text-muted"},m.a.createElement("small",{className:"pr-1"},t.subjects&&t.subjects.map((function(e,t){return m.a.createElement("span",{className:"badge badge-info mr-1"},e.name)})),m.a.createElement("i",{title:"Add/Remove label",onClick:function(){return c(t)},className:"material-icons action-image text-muted"},"label")," |"),m.a.createElement("small",{className:"pr-2"},t.udate_front," | ",t.udate_ago," ago."),"preview"!==i&&m.a.createElement("i",{className:"material-icons settings text-muted"},"reply"),m.a.createElement("i",{onClick:function(e){e.stopPropagation(),p(!d)},className:"material-icons settings text-muted"},d?"expand_less":"expand_more"),"preview"!==i&&m.a.createElement("div",{className:"dropdown float-right"},m.a.createElement("i",{className:"material-icons settings text-muted",id:"message-id-"+t.id,"data-toggle":"dropdown","aria-haspopup":"true","aria-expanded":"false"},"more_vert"),m.a.createElement("div",{className:"dropdown-menu","aria-labelledby":"message-id-"+t.id},m.a.createElement("a",{className:"dropdown-item",href:"#"},m.a.createElement("i",{className:"material-icons text-muted"},"reply"),"Reply"),m.a.createElement("a",{className:"dropdown-item",href:"#"},m.a.createElement("i",{className:"material-icons text-muted"},"forward"),"Forward"),m.a.createElement("a",{className:"dropdown-item",target:"_blank",href:WWW_DIR_JAVASCRIPT+"mailconv/mailprint/"+t.id},m.a.createElement("i",{className:"material-icons text-muted"},"print"),"Print"),m.a.createElement("a",{className:"dropdown-item",href:WWW_DIR_JAVASCRIPT+"mailconv/apimaildownload/"+t.id},m.a.createElement("i",{className:"material-icons text-muted"},"cloud_download"),"Download"),m.a.createElement("a",{className:"dropdown-item",href:"#",onClick:function(){return r(t)}},m.a.createElement("i",{className:"material-icons text-muted"},"done"),"No reply required")))),d&&m.a.createElement("div",{className:"col-12"},m.a.createElement("div",{className:"card"},m.a.createElement("div",{className:"card-body"},m.a.createElement("h6",{className:"card-subtitle mb-2 text-muted"},"Message information"),m.a.createElement("div",{className:"row"},m.a.createElement("div",{className:"col-6"},m.a.createElement("ul",{className:"fs13 mb-0 list-unstyled"},m.a.createElement("li",null,m.a.createElement("span",{className:"text-muted"},"from:")," ",m.a.createElement("b",null,t.from_name)," <",t.from_address,">"),m.a.createElement("li",null,m.a.createElement("span",{className:"text-muted"},"to:")," ",t.to_data_front),t.cc_data_front&&m.a.createElement("li",null,m.a.createElement("span",{className:"text-muted"},"cc:")," ",t.cc_data_front),t.bcc_data_front&&m.a.createElement("li",null,m.a.createElement("span",{className:"text-muted"},"bcc:")," ",t.bcc_data_front),m.a.createElement("li",null,m.a.createElement("span",{className:"text-muted"},"reply-to:")," ",t.reply_to_data_front),m.a.createElement("li",null,m.a.createElement("span",{className:"text-muted"},"mailed-by:")," ",t.from_host))),m.a.createElement("div",{className:"col-6"},m.a.createElement("ul",{className:"fs13 mb-0 list-unstyled"},t.accept_time_front&&m.a.createElement("li",null,"Accepted at: ",t.accept_time_front),t.plain_user_name&&m.a.createElement("li",null,"Accepted by: ",m.a.createElement("b",null,t.plain_user_name)),t.wait_time&&m.a.createElement("li",null,"Accept wait time: ",t.wait_time_pending),t.lr_time&&t.response_time&&m.a.createElement("li",null,"Response wait time: ",t.wait_time_response),t.lr_time&&m.a.createElement("li",null,"Response type: ",1==t.response_type?"No response required":2==t.response_type?"Our response message":"Responeded by e-mail"),t.interaction_time&&m.a.createElement("li",null,"Interaction time: ",t.interaction_time_duration),t.cls_time&&m.a.createElement("li",null,"Close time: ",t.cls_time_front))))))),E&&m.a.createElement("div",{className:"col-12 mail-message-body pt-2 pb-2"},h()(t.body_front,{replace:function(e){if(e.attribs){Object.assign({},e.attribs);if(e.attribs.class&&(e.attribs.className=e.attribs.class,delete e.attribs.class),e.name&&"blockquote"===e.name)return e.attribs.style&&(e.attribs.style=(t=e.attribs.style,n={},t.split(";").forEach((function(e){var t=e.split(":"),a=o()(t,2),r=a[0],i=a[1];if(r){var c=function(e){var t=e.split("-");return 1===t.length?t[0]:t[0]+t.slice(1).map((function(e){return e[0].toUpperCase()+e.slice(1)})).join("")}(r.trim());n[c]=i.trim()}})),n)),m.a.createElement("blockquote",e.attribs,m.a.createElement(v,null,Object(f.domToReact)(e.children)))}var t,n}}),t.attachments&&t.attachments.length>0&&m.a.createElement("div",{className:"pt-2"},t.attachments.map((function(e){return m.a.createElement("a",{className:"btn btn-sm btn-outline-info mr-1",href:e.download_url,title:e.description},e.name)})))),"preview"!==i&&n+1==a&&m.a.createElement(x,{message:t,noReplyRequired:function(){return r(t)}}))}));function D(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,a)}return n}function T(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?D(Object(n),!0).forEach((function(t){l()(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):D(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function M(e,t){switch(t.type){case"increment":return{count:e.count+1};case"decrement":return{count:e.count-1};case"update":return T({},e,{},t.value);case"update_message":var n=e.messages.findIndex((function(e){return e.id==t.message.id}));return e.messages[n]=t.message,t.conv&&(e.conv=t.conv),e=T({},e);case"update_messages":return t.messages.lmsop=e.lmsop||t.value.lmsop,(e=T({},e,{},t.value)).messages.push(t.messages),e;case"update_history":return e=T({},e,{},t.value),""!=t.history.msg&&e.messages.unshift(t.history),e;case"init":return{count:e.count-1};default:throw new Error("Unknown action!")}}t.default=function(e){Object(s.useRef)(null),Object(s.useRef)(null);var t=Object(s.useRef)(null),n=Object(s.useReducer)(M,{messages:[],operators:[],conv:null,loaded:!1,saving_remarks:!1,old_message_id:0,last_message:"",remarks:"",last_message_id:0,lmsop:0,lgsync:0}),a=o()(n,2),r=a[0],i=a[1],c=function(){d.a.post(WWW_DIR_JAVASCRIPT+"mailconv/loadmainconv/"+e.chatId+"/(mode)/"+(""!=e.mode?e.mode:"normal")).then((function(t){i({type:"update",value:{conv:t.data.conv,messages:t.data.messages,loaded:!0}}),"preview"!==e.mode&&function(e){if(localStorage)try{var t=[],n=localStorage.getItem("machat_id");null!==n&&""!==n&&(t=n.split(",")),-1===t.indexOf(e)&&(t.push(e),localStorage.setItem("machat_id",t.join(",")))}catch(e){}}(e.chatId)})).catch((function(e){}))},l=function(e){lhc.revealModal({url:WWW_DIR_JAVASCRIPT+e.url})};Object(s.useEffect)((function(){var t=setTimeout((function(){d.a.post(WWW_DIR_JAVASCRIPT+"mailconv/saveremarks/"+e.chatId,{data:r.remarks}).then((function(e){i({type:"update",value:{saving_remarks:!1}})}))}),500);return function(){return clearTimeout(t)}}),[r.remarks]);Object(s.useEffect)((function(){return c(),function(){!function(e){if(localStorage)try{var t=[],n=localStorage.getItem("machat_id");null!==n&&""!==n&&(t=n.split(",")),-1!==t.indexOf(e)&&t.splice(t.indexOf(e),1),localStorage.setItem("machat_id",t.join(","))}catch(e){}}(e.chatId)}}),[]),Object(s.useEffect)((function(){if(1==r.loaded)t.current}),[r.loaded]);var u=Object(p.a)("mail_chat");u.t,u.i18n;return 0==r.loaded?m.a.createElement("span",null,"..."):m.a.createElement(m.a.Fragment,null,m.a.createElement("div",{className:"row"},m.a.createElement("div",{className:"chat-main-left-column "+("preview"==e.mode?"col-12":"col-7")},"preview"!==e.mode&&m.a.createElement("h1",{className:"pb-2"},m.a.createElement("i",{className:"material-icons"},1==r.conv.start_type?"call_made":"call_received"),r.conv.subject),m.a.createElement("div",null,r.messages.map((function(t,n){return m.a.createElement(W,{mode:e.mode,key:"msg_mail_"+e.chatId+"_"+n+"_"+t.id,totalMessages:r.messages.length,index:n,message:t,noReplyRequired:function(e){return function(e){d.a.post(WWW_DIR_JAVASCRIPT+"mailconv/apinoreplyrequired/"+e.id).then((function(e){i({type:"update_message",message:e.data.message,conv:e.data.conv})})).catch((function(e){}))}(t)},addLabel:function(e){return function(e){lhc.revealModal({url:WWW_DIR_JAVASCRIPT+"mailconv/apilabelmessage/"+e.id,hidecallback:function(){d.a.get(WWW_DIR_JAVASCRIPT+"mailconv/apigetlabels/"+e.id).then((function(e){i({type:"update_message",message:e.data.message})})).catch((function(e){}))}})}(t)}})})))),m.a.createElement("div",{className:"chat-main-right-column "+("preview"==e.mode?"d-none":"col-5")},m.a.createElement("div",{role:"tabpanel"},m.a.createElement("ul",{className:"nav nav-pills",role:"tablist",ref:t},m.a.createElement("li",{role:"presentation",className:"nav-item"},m.a.createElement("a",{className:"nav-link active",href:"#mail-chat-info-"+e.chatId,"aria-controls":"#mail-chat-info-"+e.chatId,title:"Information",role:"tab","data-toggle":"tab"},m.a.createElement("i",{className:"material-icons mr-0"},"info_outline"))),m.a.createElement("li",{role:"presentation",className:"nav-item"},m.a.createElement("a",{className:"nav-link",href:"#mail-chat-remarks-"+e.chatId,"aria-controls":"#mail-chat-remarks-"+e.chatId,role:"tab","data-toggle":"tab",title:"Remarks"},m.a.createElement("i",{className:"material-icons mr-0"},"mode_edit")))),m.a.createElement("div",{className:"tab-content"},m.a.createElement("div",{role:"tabpanel",className:"tab-pane",id:"mail-chat-remarks-"+e.chatId},m.a.createElement("div",{className:"material-icons pb-1 text-success"+(r.saving_remarks?" text-warning":"")},"mode_edit"),m.a.createElement("div",null,r.conv&&m.a.createElement("textarea",{placeholder:"Enter your remarks here.",onKeyUp:function(e){return t=e.target.value,void i({type:"update",value:{saving_remarks:!0,remarks:t}});var t},class:"form-control mh150",defaultValue:r.conv.remarks}))),m.a.createElement("div",{role:"tabpanel",className:"tab-pane active",id:"mail-chat-info-"+e.chatId},m.a.createElement("div",{className:"pb-2"},m.a.createElement("a",{className:"btn btn-outline-secondary btn-sm",onClick:function(){return e=!1,r.messages.forEach((function(t){2!=t.status&&(e=!0)})),void((0==e||confirm("There is still unresponded messages, are you sure you want to close this conversation?"))&&d.a.post(WWW_DIR_JAVASCRIPT+"mailconv/apicloseconversation/"+r.conv.id).then((function(e){i({type:"update",value:{conv:e.data.conv,messages:e.data.messages}}),document.getElementById("chat-tab-link-mc"+r.conv.id)&&lhinst.removeDialogTabMail("mc"+r.conv.id,$("#tabs"),!0)})).catch((function(e){})));var e}},m.a.createElement("i",{className:"material-icons"},"close"),"Close")),r.conv&&m.a.createElement("table",{className:"table table-sm"},m.a.createElement("tr",null,m.a.createElement("td",{colSpan:"2"},m.a.createElement("i",{className:"material-icons action-image",onClick:function(){return l({url:"mailconv/mailhistory/"+e.chatId})}},"history"),m.a.createElement("a",{className:"material-icons action-image",onClick:function(){return l({url:"mailconv/transfermail/"+e.chatId})},title:"Transfer chat"},"supervisor_account"),m.a.createElement("a",{className:"text-dark material-icons",target:"_blank",href:WWW_DIR_JAVASCRIPT+"mailconv/mailprintcovnersation/"+e.chatId},"print"),m.a.createElement("a",{className:"material-icons mr-0",onClick:function(e){confirm("Are you sure?")&&d.a.post(WWW_DIR_JAVASCRIPT+"mailconv/apideleteconversation/"+r.conv.id).then((function(e){document.getElementById("chat-tab-link-mc"+r.conv.id)?lhinst.removeDialogTabMail("mc"+r.conv.id,$("#tabs"),!0):document.location=WWW_DIR_JAVASCRIPT+"mailconv/conversations"})).catch((function(e){}))},title:"Delete chat"},"delete"))),m.a.createElement("tr",null,m.a.createElement("td",null,"Sender"),m.a.createElement("td",null,r.conv.from_name," <",r.conv.from_address,">")),m.a.createElement("tr",null,m.a.createElement("td",null,"Status"),m.a.createElement("td",null,!r.conv.status&&m.a.createElement("span",null,m.a.createElement("i",{className:"material-icons chat-pending"},"mail_outline"),"Pending"),1==r.conv.status&&m.a.createElement("span",null,m.a.createElement("i",{className:"material-icons chat-active"},"mail_outline"),"Active"),2==r.conv.status&&m.a.createElement("span",null,m.a.createElement("i",{className:"material-icons chat-closed"},"mail_outline"),"Closed"))),m.a.createElement("tr",null,m.a.createElement("td",null,"Department"),m.a.createElement("td",null,r.conv.department_name)),m.a.createElement("tr",null,m.a.createElement("td",null,"Received"),m.a.createElement("td",null,r.conv.udate_front)),m.a.createElement("tr",null,m.a.createElement("td",null,"ID"),m.a.createElement("td",null,r.conv.id)),r.conv.accept_time&&m.a.createElement("tr",null,m.a.createElement("td",null,"Accepted at"),m.a.createElement("td",null,r.conv.accept_time_front," | Wait time ",r.conv.wait_time_pending)),r.conv.response_time&&m.a.createElement("tr",null,m.a.createElement("td",null,"Responded at"),m.a.createElement("td",null,r.conv.lr_time_front," | Wait time ",r.conv.wait_time_response)),r.conv.cls_time&&m.a.createElement("tr",null,m.a.createElement("td",null,"Closed at"),m.a.createElement("td",null,r.conv.cls_time_front)),r.conv.interaction_time&&m.a.createElement("tr",null,m.a.createElement("td",null,"Interaction time"),m.a.createElement("td",null,r.conv.interaction_time_duration)),r.conv.priority&&m.a.createElement("tr",null,m.a.createElement("td",null,"Priority"),m.a.createElement("td",null,r.conv.priority)),m.a.createElement("tr",null,m.a.createElement("td",null,"Chat owner"),m.a.createElement("td",null,r.conv.plain_user_name)))))))))}}}]);