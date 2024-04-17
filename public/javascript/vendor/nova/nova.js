var range,DOCUMENT_FRAGMENT_NODE=11;function morphAttrs(e,t){var n,o,r,i,a,l=t.attributes;if(t.nodeType!==DOCUMENT_FRAGMENT_NODE&&e.nodeType!==DOCUMENT_FRAGMENT_NODE){for(var s=l.length-1;s>=0;s--)o=(n=l[s]).name,r=n.namespaceURI,i=n.value,r?(o=n.localName||o,(a=e.getAttributeNS(r,o))!==i&&("xmlns"===n.prefix&&(o=n.name),e.setAttributeNS(r,o,i))):(a=e.getAttribute(o))!==i&&e.setAttribute(o,i);for(var u=e.attributes,d=u.length-1;d>=0;d--)o=(n=u[d]).name,(r=n.namespaceURI)?(o=n.localName||o,t.hasAttributeNS(r,o)||e.removeAttributeNS(r,o)):t.hasAttribute(o)||e.removeAttribute(o)}}var NS_XHTML="http://www.w3.org/1999/xhtml",doc="undefined"==typeof document?void 0:document,HAS_TEMPLATE_SUPPORT=!!doc&&"content"in doc.createElement("template"),HAS_RANGE_SUPPORT=!!doc&&doc.createRange&&"createContextualFragment"in doc.createRange();function createFragmentFromTemplate(e){var t=doc.createElement("template");return t.innerHTML=e,t.content.childNodes[0]}function createFragmentFromRange(e){return range||(range=doc.createRange()).selectNode(doc.body),range.createContextualFragment(e).childNodes[0]}function createFragmentFromWrap(e){var t=doc.createElement("body");return t.innerHTML=e,t.childNodes[0]}function toElement(e){return(e=e.trim(),HAS_TEMPLATE_SUPPORT)?createFragmentFromTemplate(e):HAS_RANGE_SUPPORT?createFragmentFromRange(e):createFragmentFromWrap(e)}function compareNodeNames(e,t){var n,o,r=e.nodeName,i=t.nodeName;return r===i||((n=r.charCodeAt(0),o=i.charCodeAt(0),n<=90&&o>=97)?r===i.toUpperCase():o<=90&&n>=97&&i===r.toUpperCase())}function createElementNS(e,t){return t&&t!==NS_XHTML?doc.createElementNS(t,e):doc.createElement(e)}function moveChildren(e,t){for(var n=e.firstChild;n;){var o=n.nextSibling;t.appendChild(n),n=o}return t}function syncBooleanAttrProp(e,t,n){e[n]!==t[n]&&(e[n]=t[n],e[n]?e.setAttribute(n,""):e.removeAttribute(n))}var specialElHandlers={OPTION:function(e,t){var n=e.parentNode;if(n){var o=n.nodeName.toUpperCase();"OPTGROUP"===o&&(o=(n=n.parentNode)&&n.nodeName.toUpperCase()),"SELECT"!==o||n.hasAttribute("multiple")||(e.hasAttribute("selected")&&!t.selected&&(e.setAttribute("selected","selected"),e.removeAttribute("selected")),n.selectedIndex=-1)}syncBooleanAttrProp(e,t,"selected")},INPUT:function(e,t){syncBooleanAttrProp(e,t,"checked"),syncBooleanAttrProp(e,t,"disabled"),e.value!==t.value&&(e.value=t.value),t.hasAttribute("value")||e.removeAttribute("value")},TEXTAREA:function(e,t){var n=t.value;e.value!==n&&(e.value=n);var o=e.firstChild;if(o){var r=o.nodeValue;if(r==n||!n&&r==e.placeholder)return;o.nodeValue=n}},SELECT:function(e,t){if(!t.hasAttribute("multiple")){for(var n,o,r=-1,i=0,a=e.firstChild;a;)if("OPTGROUP"===(o=a.nodeName&&a.nodeName.toUpperCase()))a=(n=a).firstChild;else{if("OPTION"===o){if(a.hasAttribute("selected")){r=i;break}i++}(a=a.nextSibling)||!n||(a=n.nextSibling,n=null)}e.selectedIndex=r}}},ELEMENT_NODE=1,DOCUMENT_FRAGMENT_NODE$1=11,TEXT_NODE=3,COMMENT_NODE=8;function noop(){}function defaultGetNodeKey(e){if(e)return e.getAttribute&&e.getAttribute("id")||e.id}function morphdomFactory(e){return function t(n,o,r){if(r||(r={}),"string"==typeof o){if("#document"===n.nodeName||"HTML"===n.nodeName||"BODY"===n.nodeName){var i=o;(o=doc.createElement("html")).innerHTML=i}else o=toElement(o)}else o.nodeType===DOCUMENT_FRAGMENT_NODE$1&&(o=o.firstElementChild);var a=r.getNodeKey||defaultGetNodeKey,l=r.onBeforeNodeAdded||noop,s=r.onNodeAdded||noop,u=r.onBeforeElUpdated||noop,d=r.onElUpdated||noop,c=r.onBeforeNodeDiscarded||noop,p=r.onNodeDiscarded||noop,m=r.onBeforeElChildrenUpdated||noop,h=r.skipFromChildren||noop,f=r.addChild||function(e,t){return e.appendChild(t)},E=!0===r.childrenOnly,g=Object.create(null),N=[];function v(e){N.push(e)}function y(e,t,n){!1!==c(e)&&(t&&t.removeChild(e),p(e),function e(t,n){if(t.nodeType===ELEMENT_NODE)for(var o=t.firstChild;o;){var r=void 0;n&&(r=a(o))?v(r):(p(o),o.firstChild&&e(o,n)),o=o.nextSibling}}(e,n))}function b(e){s(e);for(var t=e.firstChild;t;){var n=t.nextSibling,o=a(t);if(o){var r=g[o];r&&compareNodeNames(t,r)?(t.parentNode.replaceChild(r,t),T(r,t)):b(t)}else b(t);t=n}}function T(t,n,o){var r=a(n);if(r&&delete g[r],o||!1!==u(t,n)&&(e(t,n),d(t),!1!==m(t,n)))"TEXTAREA"!==t.nodeName?function e(t,n){var o,r,i,s,u,d=h(t,n),c=n.firstChild,p=t.firstChild;outer:for(;c;){for(s=c.nextSibling,o=a(c);!d&&p;){if(i=p.nextSibling,c.isSameNode&&c.isSameNode(p)){c=s,p=i;continue outer}r=a(p);var m=p.nodeType,E=void 0;if(m===c.nodeType&&(m===ELEMENT_NODE?(o?o!==r&&((u=g[o])?i===u?E=!1:(t.insertBefore(u,p),r?v(r):y(p,t,!0),r=a(p=u)):E=!1):r&&(E=!1),(E=!1!==E&&compareNodeNames(p,c))&&T(p,c)):(m===TEXT_NODE||m==COMMENT_NODE)&&(E=!0,p.nodeValue!==c.nodeValue&&(p.nodeValue=c.nodeValue))),E){c=s,p=i;continue outer}r?v(r):y(p,t,!0),p=i}if(o&&(u=g[o])&&compareNodeNames(u,c))d||f(t,u),T(u,c);else{var N=l(c);!1!==N&&(N&&(c=N),c.actualize&&(c=c.actualize(t.ownerDocument||doc)),f(t,c),b(c))}c=s,p=i}!function e(t,n,o){for(;n;){var r=n.nextSibling;(o=a(n))?v(o):y(n,t,!0),n=r}}(t,p,r);var $=specialElHandlers[t.nodeName];$&&$(t,n)}(t,n):specialElHandlers.TEXTAREA(t,n)}!function e(t){if(t.nodeType===ELEMENT_NODE||t.nodeType===DOCUMENT_FRAGMENT_NODE$1)for(var n=t.firstChild;n;){var o=a(n);o&&(g[o]=n),e(n),n=n.nextSibling}}(n);var $=n,A=$.nodeType,C=o.nodeType;if(!E){if(A===ELEMENT_NODE)C===ELEMENT_NODE?compareNodeNames(n,o)||(p(n),$=moveChildren(n,createElementNS(o.nodeName,o.namespaceURI))):$=o;else if(A===TEXT_NODE||A===COMMENT_NODE){if(C===A)return $.nodeValue!==o.nodeValue&&($.nodeValue=o.nodeValue),$;$=o}}if($===o)p(n);else{if(o.isSameNode&&o.isSameNode($))return;if(T($,o,E),N)for(var S=0,M=N.length;S<M;S++){var _=g[N[S]];_&&y(_,_.parentNode,!1)}}return!E&&$!==n&&n.parentNode&&($.actualize&&($=$.actualize(n.ownerDocument||doc)),n.parentNode.replaceChild($,n)),$}}var morphdom=morphdomFactory(morphAttrs);Date.prototype.format=formatDate;export class Application{constructor(){this._eventNames=["click","dblclick","mousedown","mouseup","mousemove","mouseenter","mouseleave","mouseover","mouseout","keydown","keypress","keyup","focus","blur","input","change","submit","scroll","error","resize","select","touchstart","touchmove","touchend","touchcancel","animationstart","animationend","animationiteration","transitionstart","transitionend","transitioncancel"],this._morphdomOptions={onBeforeElUpdated:(e,t)=>this._onBeforeElementUpdated(e,t)}}static launch(e){if(null!==this._instance)throw Error("Application has already been launched");let t=this._getInstance();t._initializeComponents([...new Set(e)]),t._initializeEvents()}static updateComponent(e){this._throwIfUninitialized(),e.shouldUpdate&&this._getInstance()._updateComponent(e)}static queryComponent(e,t=document.documentElement){var n;return this._throwIfUninitialized(),(null===(n=t.querySelector(e))||void 0===n?void 0:n.component)||null}static queryComponents(e,t=document.documentElement){this._throwIfUninitialized();let n=[];for(let o of Array.from(t.querySelectorAll(e))){let r=o.component;r&&n.push(r)}return n}static _getInstance(){var e;return null!==(e=this._instance)&&void 0!==e?e:this._instance=new Application}static _throwIfUninitialized(){if(null===this._instance)throw Error("Application has not been launched")}registerComponentEvents(e){for(let t of e.keys){let n=t.substring(2).toLowerCase();this._eventNames.includes(n)&&e.element.addEventListener(n,n=>e[t](n))}}_updateComponent(e){if(!e.initialized||!e.keys.includes("render"))return;let t=e.element.cloneNode(!1);for(let n of(morphdom(e.element,t,this._morphdomOptions),Array.from(e.element.parentElement.querySelectorAll("*"))))!0===n.dirty&&(n.dirty=!1,this._onElementUpdated(n))}_onBeforeElementUpdated(e,t){let n=e.component;return n&&n.initialized&&n.keys.includes("render")&&(t.innerHTML=n.render(),t.style.display="contents",t.setAttribute("data-uuid",n.uuid),n.onMorph(t),e.dirty=!0),!e.isEqualNode(t)}_onElementUpdated(e){let t=e.component;t&&t.appeared&&t.onUpdate()}_initializeComponents(e){for(let t of e)this._initializeComponent(t)}_initializeComponent(e){let t=this;class n extends HTMLElement{connectedCallback(){this.style.display="contents",this.component=new e.ctor(this),this.setAttribute("data-uuid",this.component.uuid);let n=this.component.onInit();if(n instanceof Promise){n.then(()=>t._initializeElement(this));return}t._initializeElement(this)}disconnectedCallback(){this.component.onDestroy()}}customElements.define(e.tag,n)}_initializeElement(e){e.component.initialized=!0,this._observeAttributes(e.component),this.registerComponentEvents(e.component),this._updateComponent(e.component),e.component.onAppear(),e.component.appeared=!0}_initializeEvents(){for(let e of this._eventNames)document.documentElement.addEventListener(e,e=>this._onEvent(e,e.target))}_onEvent(e,t){let n=t.closest("[data-event]");if(!n)return;let[o,r,i]=n.getAttribute("data-event").split(";");if(e.type!==r)return;let a=n.closest(`[data-uuid="${o}"]`).component;a[i](e),this._onEvent(e,n.parentElement)}_observeAttributes(e){if(!e.keys.includes("onAttributeChanged"))return;let t=new MutationObserver((t,n)=>{for(let o of t)"attributes"===o.type&&e.onAttributeChanged(o.attributeName,o.oldValue,e.element.getAttribute(o.attributeName))});t.observe(e.element,{attributes:!0,attributeOldValue:!0,subtree:!1})}}Application._instance=null;export class Component{constructor(e){this.uuid="10000000-1000-4000-8000-100000000000".replace(/[018]/g,e=>(+e^crypto.getRandomValues(new Uint8Array(1))[0]&15>>+e/4).toString(16)),this.element=e,this.initialized=!1,this.appeared=!1,this.subscribers=[],this.shouldUpdate=!0;let t=[],n=this;for(;n;){let o=Object.getPrototypeOf(n);o&&Object.getPrototypeOf(o)&&(t=t.concat(Object.getOwnPropertyNames(n))),n=o}this.keys=[...new Set(t)]}static define(e){return{tag:e,ctor:this}}render(){return""}update(e){if(e){let t=this.shouldUpdate;this.shouldUpdate=!1;let n=e();if(n instanceof Promise){n.then(()=>{this.shouldUpdate=t,Application.updateComponent(this)});return}this.shouldUpdate=t}Application.updateComponent(this)}on(e,t){return`data-event="${this.uuid};${e};${t}"`}queryComponent(e,t){return Application.queryComponent(e,t)}queryComponents(e,t){return Application.queryComponents(e,t)}onInit(){}onAppear(){}onUpdate(){}onDestroy(){}onMorph(e){}onAttributeChanged(e,t,n){}onClick(e){}onDblClick(e){}onMouseDown(e){}onMouseUp(e){}onMouseMove(e){}onMouseEnter(e){}onMouseLeave(e){}onMouseOver(e){}onMouseOut(e){}onKeyDown(e){}onKeyPress(e){}onKeyUp(e){}onFocus(e){}onBlur(e){}onInput(e){}onChange(e){}onSubmit(e){}onScroll(e){}onError(e){}onResize(e){}onSelect(e){}onTouchStart(e){}onTouchMove(e){}onTouchEnd(e){}onTouchCancel(e){}onAnimationStart(e){}onAnimationEnd(e){}onAnimationIteration(e){}onTransitionStart(e){}onTransitionEnd(e){}onTransitionCancel(e){}}export class Debounce{constructor(e,t){this._timeoutId=null,this._callback=(...n)=>{window.clearTimeout(this._timeoutId),this._timeoutId=window.setTimeout(()=>{e.apply(null,n)},t)}}call(...e){this._callback.apply(this,e)}}export function escape(e){return e.toString().replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/"/g,"&quot;").replace(/'/g,"&#039;")}export function Event(e){return function(t,n){let o=Symbol(n);Object.defineProperty(t,o,{writable:!0,enumerable:!1,configurable:!0});let r=function(){let t=this[o];return t.toString=()=>this.on(e,n),t},i=function(e){this[o]=e};Object.defineProperty(t,n,{get:r,set:i,enumerable:!0,configurable:!0})}}function formatDate(e){let t=this,n=["January","February","March","April","May","June","July","August","September","October","November","December"],o=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];return e.replace(/(d{1,4}|m{1,4}|y{2,4}|h{1,2}|H{1,2}|M{1,2}|s{1,2}|l|L|t{1,2}|T{1,2}'[^']*'|"[^"]*")/g,function(e){switch(e){case"d":return t.getDate().toString();case"dd":return t.getDate().toString().padStart(2,"0");case"ddd":return o[t.getDay()].slice(0,3);case"dddd":return o[t.getDay()];case"m":return(t.getMonth()+1).toString();case"mm":return String(t.getMonth()+1).padStart(2,"0");case"mmm":return n[t.getMonth()].slice(0,3);case"mmmm":return n[t.getMonth()];case"yy":return String(t.getFullYear()).slice(-2);case"yyyy":return t.getFullYear().toString();case"h":return(t.getHours()%12||12).toString();case"hh":return String(t.getHours()%12||12).padStart(2,"0");case"H":return t.getHours().toString();case"HH":return String(t.getHours()).padStart(2,"0");case"M":return t.getMinutes().toString();case"MM":return String(t.getMinutes()).padStart(2,"0");case"s":return t.getSeconds().toString();case"ss":return String(t.getSeconds()).padStart(2,"0");case"l":return String(t.getMilliseconds()).padStart(3,"0");case"L":return String(t.getMilliseconds()).padStart(3,"0").substring(0,2);case"t":return 12>t.getHours()?"a":"p";case"tt":return 12>t.getHours()?"am":"pm";case"T":return 12>t.getHours()?"A":"P";case"TT":return 12>t.getHours()?"AM":"PM";default:return e.slice(1,-1)}})}export var LocalStorage;!function(e){e.getItem=function e(t){let n=localStorage.getItem(t);if(!n)return null;let o=JSON.parse(n);return void 0!==o.expiry&&o.expiry<new Date().getTime()?(localStorage.removeItem(t),null):o.value},e.setItem=function e(t,n,o){let r={value:n,expiry:void 0!==o?new Date().getTime()+o:void 0};localStorage.setItem(t,JSON.stringify(r))}}(LocalStorage||(LocalStorage={}));export function State(e,t){let n=Symbol(t);Object.defineProperty(e,n,{writable:!0,enumerable:!1,configurable:!0});let o=function(){return this[n]},r=function(e){for(let[o,r]of(this[n]=e,this.update(),this.subscribers))o!==this&&r===t&&o.update()};Object.defineProperty(e,t,{get:o,set:r,enumerable:!0,configurable:!0})}