(function(){var t={4978:function(t,e,n){"use strict";var s=n(7195),o=n(3449),i=n.n(o),r=n(7127),a=function(){var t=this,e=t._self._c;return e("div",[e("beautiful-chat",{attrs:{participants:t.participants,onMessageWasSent:t.onMessageWasSent,messageList:t.messageList,newMessagesCount:t.newMessagesCount,isOpen:t.isChatOpen,close:t.closeChat,open:t.openChat,showTypingIndicator:t.showTypingIndicator,colors:t.colors,title:"SixAxis Support",disableUserListToggle:""},scopedSlots:t._u([{key:"user-avatar",fn:function({}){return[e("div")]}}])})],1)},u=[],c={data(){return{participants:[{id:"bot",name:"Support"}],messageList:[],newMessagesCount:0,isChatOpen:!1,showTypingIndicator:"",colors:{header:{bg:"#D32F2F",text:"#fff"},launcher:{bg:"#D32F2F"},messageList:{bg:"#fff"},sentMessage:{bg:"#F44336",text:"#fff"},receivedMessage:{bg:"#eaeaea",text:"#222222"},userInput:{bg:"#fff",text:"#212121"},userList:{bg:"#fff",text:"#212121"}}}},methods:{receiveMessage(t){t.length>0&&(this.newMessagesCount=this.isChatOpen?this.newMessagesCount:this.newMessagesCount+1,this.onMessageWasSent({author:"bot",type:"text",data:{text:t}}))},requireReply(t){this.showTypingIndicator="...",this.$http.post("chatbot/ask",{question:t.data.text}).then((t=>t.data.data)).then((t=>{const{answer:e}=t;this.receiveMessage(e)})).catch((t=>{console.log(t)})).finally((()=>{this.showTypingIndicator=""}))},onMessageWasSent(t){this.messageList=[...this.messageList,t],"me"==t.author&&this.requireReply(t)},openChat(){this.isChatOpen=!0,this.newMessagesCount=0},closeChat(){this.isChatOpen=!1}},mounted(){}},f=c,h=n(1001),l=(0,h.Z)(f,a,u,!1,null,"90f38ca0",null),p=l.exports;s["default"].use(i()),s["default"].config.productionTip=!1,s["default"].use(r.ZP);const g="http://127.0.0.1:9001";s["default"].http.options.root=g,document.getElementById("chatbot-widget")&&new s["default"]({render:t=>t(p)}).$mount("#chatbot-widget")},6608:function(){}},e={};function n(s){var o=e[s];if(void 0!==o)return o.exports;var i=e[s]={exports:{}};return t[s].call(i.exports,i,i.exports,n),i.exports}n.m=t,function(){var t=[];n.O=function(e,s,o,i){if(!s){var r=1/0;for(f=0;f<t.length;f++){s=t[f][0],o=t[f][1],i=t[f][2];for(var a=!0,u=0;u<s.length;u++)(!1&i||r>=i)&&Object.keys(n.O).every((function(t){return n.O[t](s[u])}))?s.splice(u--,1):(a=!1,i<r&&(r=i));if(a){t.splice(f--,1);var c=o();void 0!==c&&(e=c)}}return e}i=i||0;for(var f=t.length;f>0&&t[f-1][2]>i;f--)t[f]=t[f-1];t[f]=[s,o,i]}}(),function(){n.n=function(t){var e=t&&t.__esModule?function(){return t["default"]}:function(){return t};return n.d(e,{a:e}),e}}(),function(){n.d=function(t,e){for(var s in e)n.o(e,s)&&!n.o(t,s)&&Object.defineProperty(t,s,{enumerable:!0,get:e[s]})}}(),function(){n.g=function(){if("object"===typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(t){if("object"===typeof window)return window}}()}(),function(){n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)}}(),function(){n.r=function(t){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})}}(),function(){var t={143:0};n.O.j=function(e){return 0===t[e]};var e=function(e,s){var o,i,r=s[0],a=s[1],u=s[2],c=0;if(r.some((function(e){return 0!==t[e]}))){for(o in a)n.o(a,o)&&(n.m[o]=a[o]);if(u)var f=u(n)}for(e&&e(s);c<r.length;c++)i=r[c],n.o(t,i)&&t[i]&&t[i][0](),t[i]=0;return n.O(f)},s=self["webpackChunkvue_ui"]=self["webpackChunkvue_ui"]||[];s.forEach(e.bind(null,0)),s.push=e.bind(null,s.push.bind(s))}();var s=n.O(void 0,[998],(function(){return n(4978)}));s=n.O(s)})();
//# sourceMappingURL=app.js.map