"use strict";(self.webpackChunkLHCReactAPP=self.webpackChunkLHCReactAPP||[]).push([[14],{5014:function(e,t,a){a.r(t);var l=a(3029),s=a(2901),n=a(6822),i=a(3954),r=a(5361),o=a(4467),c=a(6540),m=a(1083),d=a(6524);function u(){try{var e=!Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){})))}catch(e){}return(u=function(){return!!e})()}var h=function(e){function t(e){var a,s,r,m;return(0,l.A)(this,t),s=this,r=t,m=[e],r=(0,i.A)(r),a=(0,n.A)(s,u()?Reflect.construct(r,m||[],(0,i.A)(s).constructor):r.apply(s,m)),(0,o.A)(a,"state",{mail:null,success:"",errors:null,sending:!1}),(0,o.A)(a,"dismissModal",(function(){a.props.toggle()})),a.sendMail=a.sendMail.bind(a),a.emailRef=c.createRef(),a}return(0,r.A)(t,e),(0,s.A)(t,[{key:"sendMail",value:function(e){var t=this;this.setState({sending:!0}),m.A.post(window.lhcChat.base_url+"widgetrestapi/sendmailsettings/"+this.props.chatId+"/"+this.props.chatHash+"/(action)/send",JSON.stringify({email:this.state.mail}),{headers:{"Content-Type":"application/x-www-form-urlencoded"}}).then((function(e){0==e.data.error?t.props.toggle():(t.setState({sending:!1}),t.setState({errors:e.data.result}))})),e&&e.preventDefault()}},{key:"componentDidMount",value:function(){var e=this;m.A.get(window.lhcChat.base_url+"widgetrestapi/sendmailsettings/"+this.props.chatId+"/"+this.props.chatHash).then((function(t){e.setState({mail:t.data}),e.emailRef.current&&e.emailRef.current.focus()})).catch((function(e){console.log(e)}))}},{key:"render",value:function(){var e=this,t=this.props.t;return c.createElement(c.Fragment,null,null!==this.state.mail&&c.createElement(c.Fragment,null,c.createElement("div",{className:"fade modal-backdrop show"}),c.createElement("div",{role:"dialog",id:"dialog-content","aria-modal":"true",className:"fade modal show d-block mail-send-modal",tabIndex:"-1"},c.createElement("div",{className:"modal-dialog modal-lg"},c.createElement("div",{className:"modal-content"},c.createElement("div",{className:"modal-header"}," ",c.createElement("h4",{className:"modal-title",id:"myModalLabel"},c.createElement("span",{className:"material-icons"},""),t("button.mail")),c.createElement("button",{type:"button",className:"btn-close float-end","data-bs-dismiss":"modal",onClick:this.dismissModal,"aria-label":"Close"})),c.createElement("div",{className:"modal-body"},c.createElement("div",{className:"row"},c.createElement("div",{className:"col-12"},this.state.errors&&c.createElement("div",{className:"mb-0",dangerouslySetInnerHTML:{__html:this.state.errors}}),c.createElement("div",{className:"mb-0"},c.createElement("form",{onSubmit:this.sendMail},c.createElement("p",{className:"mail-explain"},t("button.email_explain")),c.createElement("div",{className:"form-group"},c.createElement("label",{className:"text-muted"},t("button.email")),c.createElement("input",{className:"form-control form-group form-control-sm",ref:this.emailRef,required:"required",type:"email",defaultValue:this.state.mail,onChange:function(t){return e.setState({mail:t.target.value})},placeholder:t("chat.enter_email"),title:t("chat.enter_email")})),c.createElement("div",{className:"row"},c.createElement("div",{className:"col-5"},c.createElement("button",{type:"submit",disabled:this.state.sending||""==this.state.mail,className:"btn btn-primary w-100 btn-sm"},t("button.send"))),c.createElement("div",{className:"col-2"}),c.createElement("div",{className:"col-5"},c.createElement("button",{type:"button",className:"btn text-muted btn-link btn-sm w-100",onClick:this.dismissModal},t("button.cancel"))))))))))))))}}])}(c.PureComponent);t.default=(0,d.C)()(h)}}]);
//# sourceMappingURL=14.29311e7cb90a78401a2e.js.map