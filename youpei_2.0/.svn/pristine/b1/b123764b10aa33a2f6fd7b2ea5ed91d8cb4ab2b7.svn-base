/* jpeg_encoder_basic.js  for android jpeg压缩质量修复 */
function JPEGEncoder(a){function I(a){var c,i,j,k,l,m,n,o,p,b=[16,11,10,16,24,40,51,61,12,12,14,19,26,58,60,55,14,13,16,24,40,57,69,56,14,17,22,29,51,87,80,62,18,22,37,56,68,109,103,77,24,35,55,64,81,104,113,92,49,64,78,87,103,121,120,101,72,92,95,98,112,100,103,99];for(c=0;64>c;c++)i=d((b[c]*a+50)/100),1>i?i=1:i>255&&(i=255),e[z[c]]=i;for(j=[17,18,24,47,99,99,99,99,18,21,26,66,99,99,99,99,24,26,56,99,99,99,99,99,47,66,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99,99],k=0;64>k;k++)l=d((j[k]*a+50)/100),1>l?l=1:l>255&&(l=255),f[z[k]]=l;for(m=[1,1.387039845,1.306562965,1.175875602,1,.785694958,.5411961,.275899379],n=0,o=0;8>o;o++)for(p=0;8>p;p++)g[n]=1/(8*e[z[n]]*m[o]*m[p]),h[n]=1/(8*f[z[n]]*m[o]*m[p]),n++;}function J(a,b){var f,g,c=0,d=0,e=new Array;for(f=1;16>=f;f++){for(g=1;g<=a[f];g++)e[b[d]]=[],e[b[d]][0]=c,e[b[d]][1]=f,d++,c++;c*=2;}return e}function K(){i=J(A,B),j=J(E,F),k=J(C,D),l=J(G,H)}function L(){var c,d,e,a=1,b=2;for(c=1;15>=c;c++){for(d=a;b>d;d++)n[32767+d]=c,m[32767+d]=[],m[32767+d][1]=c,m[32767+d][0]=d;for(e=-(b-1);-a>=e;e++)n[32767+e]=c,m[32767+e]=[],m[32767+e][1]=c,m[32767+e][0]=b-1+e;a<<=1,b<<=1}}function M(){for(var a=0;256>a;a++)x[a]=19595*a,x[a+256>>0]=38470*a,x[a+512>>0]=7471*a+32768,x[a+768>>0]=-11059*a,x[a+1024>>0]=-21709*a,x[a+1280>>0]=32768*a+8421375,x[a+1536>>0]=-27439*a,x[a+1792>>0]=-5329*a}function N(a){for(var b=a[0],c=a[1]-1;c>=0;)b&1<<c&&(r|=1<<s),c--,s--,0>s&&(255==r?(O(255),O(0)):O(r),s=7,r=0)}function O(a){q.push(w[a])}function P(a){O(255&a>>8),O(255&a)}function Q(a,b){var c,d,e,f,g,h,i,j,l,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,$,_,k=0;const m=8,n=64;for(l=0;m>l;++l)c=a[k],d=a[k+1],e=a[k+2],f=a[k+3],g=a[k+4],h=a[k+5],i=a[k+6],j=a[k+7],p=c+j,q=c-j,r=d+i,s=d-i,t=e+h,u=e-h,v=f+g,w=f-g,x=p+v,y=p-v,z=r+t,A=r-t,a[k]=x+z,a[k+4]=x-z,B=.707106781*(A+y),a[k+2]=y+B,a[k+6]=y-B,x=w+u,z=u+s,A=s+q,C=.382683433*(x-A),D=.5411961*x+C,E=1.306562965*A+C,F=.707106781*z,G=q+F,H=q-F,a[k+5]=H+D,a[k+3]=H-D,a[k+1]=G+E,a[k+7]=G-E,k+=8;for(k=0,l=0;m>l;++l)c=a[k],d=a[k+8],e=a[k+16],f=a[k+24],g=a[k+32],h=a[k+40],i=a[k+48],j=a[k+56],I=c+j,J=c-j,K=d+i,L=d-i,M=e+h,N=e-h,O=f+g,P=f-g,Q=I+O,R=I-O,S=K+M,T=K-M,a[k]=Q+S,a[k+32]=Q-S,U=.707106781*(T+R),a[k+16]=R+U,a[k+48]=R-U,Q=P+N,S=N+L,T=L+J,V=.382683433*(Q-T),W=.5411961*Q+V,X=1.306562965*T+V,Y=.707106781*S,Z=J+Y,$=J-Y,a[k+40]=$+W,a[k+24]=$-W,a[k+8]=Z+X,a[k+56]=Z-X,k++;for(l=0;n>l;++l)_=a[l]*b[l],o[l]=_>0?0|_+.5:0|_-.5;return o}function R(){P(65504),P(16),O(74),O(70),O(73),O(70),O(0),O(1),O(1),O(0),P(1),P(1),O(0),O(0)}function S(a,b){P(65472),P(17),O(8),P(b),P(a),O(3),O(1),O(17),O(0),O(2),O(17),O(1),O(3),O(17),O(1)}function T(){var a,b;for(P(65499),P(132),O(0),a=0;64>a;a++)O(e[a]);for(O(1),b=0;64>b;b++)O(f[b])}function U(){var a,b,c,d,e,f,g,h;for(P(65476),P(418),O(0),a=0;16>a;a++)O(A[a+1]);for(b=0;11>=b;b++)O(B[b]);for(O(16),c=0;16>c;c++)O(C[c+1]);for(d=0;161>=d;d++)O(D[d]);for(O(1),e=0;16>e;e++)O(E[e+1]);for(f=0;11>=f;f++)O(F[f]);for(O(17),g=0;16>g;g++)O(G[g+1]);for(h=0;161>=h;h++)O(H[h])}function V(){P(65498),P(12),O(3),O(1),O(0),O(2),O(17),O(3),O(17),O(0),O(63),O(0)}function W(a,b,c,d,e){var h,l,o,q,r,s,t,u,v,w,f=e[0],g=e[240];const i=16,j=63,k=64;for(l=Q(a,b),o=0;k>o;++o)p[z[o]]=l[o];for(q=p[0]-c,c=p[0],0==q?N(d[0]):(h=32767+q,N(d[n[h]]),N(m[h])),r=63;r>0&&0==p[r];r--);if(0==r)return N(f),c;for(s=1;r>=s;){for(u=s;0==p[s]&&r>=s;++s);if(v=s-u,v>=i){for(t=v>>4,w=1;t>=w;++w)N(g);v=15&v}h=32767+p[s],N(e[(v<<4)+n[h]]),N(m[h]),s++}return r!=j&&N(f),c}function X(){var b,a=String.fromCharCode;for(b=0;256>b;b++)w[b]=a(b)}function Y(a){if(0>=a&&(a=1),a>100&&(a=100),y!=a){var b=0;b=50>a?Math.floor(5e3/a):Math.floor(200-2*a),I(b),y=a,console.log("Quality set to: "+a+"%")}}function Z(){var c,b=(new Date).getTime();a||(a=50),X(),K(),L(),M(),Y(a),c=(new Date).getTime()-b,console.log("Initialization "+c+"ms")}var d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H;Math.round,d=Math.floor,e=new Array(64),f=new Array(64),g=new Array(64),h=new Array(64),m=new Array(65535),n=new Array(65535),o=new Array(64),p=new Array(64),q=[],r=0,s=7,t=new Array(64),u=new Array(64),v=new Array(64),w=new Array(256),x=new Array(2048),z=[0,1,5,6,14,15,27,28,2,4,7,13,16,26,29,42,3,8,12,17,25,30,41,43,9,11,18,24,31,40,44,53,10,19,23,32,39,45,52,54,20,22,33,38,46,51,55,60,21,34,37,47,50,56,59,61,35,36,48,49,57,58,62,63],A=[0,0,1,5,1,1,1,1,1,1,0,0,0,0,0,0,0],B=[0,1,2,3,4,5,6,7,8,9,10,11],C=[0,0,2,1,3,3,2,4,3,5,5,4,4,0,0,1,125],D=[1,2,3,0,4,17,5,18,33,49,65,6,19,81,97,7,34,113,20,50,129,145,161,8,35,66,177,193,21,82,209,240,36,51,98,114,130,9,10,22,23,24,25,26,37,38,39,40,41,42,52,53,54,55,56,57,58,67,68,69,70,71,72,73,74,83,84,85,86,87,88,89,90,99,100,101,102,103,104,105,106,115,116,117,118,119,120,121,122,131,132,133,134,135,136,137,138,146,147,148,149,150,151,152,153,154,162,163,164,165,166,167,168,169,170,178,179,180,181,182,183,184,185,186,194,195,196,197,198,199,200,201,202,210,211,212,213,214,215,216,217,218,225,226,227,228,229,230,231,232,233,234,241,242,243,244,245,246,247,248,249,250],E=[0,0,3,1,1,1,1,1,1,1,1,1,0,0,0,0,0],F=[0,1,2,3,4,5,6,7,8,9,10,11],G=[0,0,2,1,2,4,4,3,4,7,5,4,4,0,1,2,119],H=[0,1,2,3,17,4,5,33,49,6,18,65,81,7,97,113,19,34,50,129,8,20,66,145,161,177,193,9,35,51,82,240,21,98,114,209,10,22,36,52,225,37,241,23,24,25,26,38,39,40,41,42,53,54,55,56,57,58,67,68,69,70,71,72,73,74,83,84,85,86,87,88,89,90,99,100,101,102,103,104,105,106,115,116,117,118,119,120,121,122,130,131,132,133,134,135,136,137,138,146,147,148,149,150,151,152,153,154,162,163,164,165,166,167,168,169,170,178,179,180,181,182,183,184,185,186,194,195,196,197,198,199,200,201,202,210,211,212,213,214,215,216,217,218,226,227,228,229,230,231,232,233,234,242,243,244,245,246,247,248,249,250],this.encode=function(a,b){var d,e,f,m,n,o,p,y,z,A,B,C,D,E,F,G,H,I,J,K,c=(new Date).getTime();for(b&&Y(b),q=new Array,r=0,s=7,P(65496),R(),T(),S(a.width,a.height),U(),V(),d=0,e=0,f=0,r=0,s=7,this.encode.displayName="_encode_",m=a.data,n=a.width,o=a.height,p=4*n,z=0;o>z;){for(y=0;p>y;){for(D=p*z+y,E=D,F=-1,G=0,H=0;64>H;H++)G=H>>3,F=4*(7&H),E=D+G*p+F,z+G>=o&&(E-=p*(z+1+G-o)),y+F>=p&&(E-=y+F-p+4),A=m[E++],B=m[E++],C=m[E++],t[H]=(x[A]+x[B+256>>0]+x[C+512>>0]>>16)-128,u[H]=(x[A+768>>0]+x[B+1024>>0]+x[C+1280>>0]>>16)-128,v[H]=(x[A+1280>>0]+x[B+1536>>0]+x[C+1792>>0]>>16)-128;d=W(t,g,d,i,k),e=W(u,h,e,j,l),f=W(v,h,f,j,l),y+=32}z+=8}return s>=0&&(I=[],I[1]=s+1,I[0]=(1<<s+1)-1,N(I)),P(65497),J="data:image/jpeg;base64,"+btoa(q.join("")),q=[],K=(new Date).getTime()-c,console.log("Encoding time: "+K+"ms"),J},Z()}function getImageDataFromImage(a){var d,b="string"==typeof a?document.getElementById(a):a,c=document.createElement("canvas");return c.width=b.width,c.height=b.height,d=c.getContext("2d"),d.drawImage(b,0,0),d.getImageData(0,0,c.width,c.height)}

/* megapix-image.js for IOS(iphone5+) drawImage画面扭曲修复  */
!function(){function a(a){var d,e,b=a.naturalWidth,c=a.naturalHeight;return b*c>1048576?(d=document.createElement("canvas"),d.width=d.height=1,e=d.getContext("2d"),e.drawImage(a,-b+1,0),0===e.getImageData(0,0,1,1).data[3]):!1}function b(a,b,c){var e,f,g,h,i,j,k,d=document.createElement("canvas");for(d.width=1,d.height=c,e=d.getContext("2d"),e.drawImage(a,0,0),f=e.getImageData(0,0,1,c).data,g=0,h=c,i=c;i>g;)j=f[4*(i-1)+3],0===j?h=i:g=i,i=h+g>>1;return k=i/c,0===k?1:k}function c(a,b,c){var e=document.createElement("canvas");return d(a,e,b,c),e.toDataURL("image/jpeg",b.quality||.8)}function d(c,d,f,g){var m,n,o,p,q,r,s,t,u,v,w,h=c.naturalWidth,i=c.naturalHeight,j=f.width,k=f.height,l=d.getContext("2d");for(l.save(),e(d,l,j,k,f.orientation),m=a(c),m&&(h/=2,i/=2),n=1024,o=document.createElement("canvas"),o.width=o.height=n,p=o.getContext("2d"),q=g?b(c,h,i):1,r=Math.ceil(n*j/h),s=Math.ceil(n*k/i/q),t=0,u=0;i>t;){for(v=0,w=0;h>v;)p.clearRect(0,0,n,n),p.drawImage(c,-v,-t),l.drawImage(o,0,0,n,n,w,u,r,s),v+=n,w+=r;t+=n,u+=s}l.restore(),o=p=null}function e(a,b,c,d,e){switch(e){case 5:case 6:case 7:case 8:a.width=d,a.height=c;break;default:a.width=c,a.height=d}switch(e){case 2:b.translate(c,0),b.scale(-1,1);break;case 3:b.translate(c,d),b.rotate(Math.PI);break;case 4:b.translate(0,d),b.scale(1,-1);break;case 5:b.rotate(.5*Math.PI),b.scale(1,-1);break;case 6:b.rotate(.5*Math.PI),b.translate(0,-d);break;case 7:b.rotate(.5*Math.PI),b.translate(c,-d),b.scale(-1,1);break;case 8:b.rotate(-.5*Math.PI),b.translate(-c,0)}}function f(a){var b,c,d;if(window.Blob&&a instanceof Blob){if(b=new Image,c=window.URL&&window.URL.createObjectURL?window.URL:window.webkitURL&&window.webkitURL.createObjectURL?window.webkitURL:null,!c)throw Error("No createObjectURL function found to create blob url");b.src=c.createObjectURL(a),this.blob=a,a=b}a.naturalWidth||a.naturalHeight||(d=this,a.onload=function(){var b,c,a=d.imageLoadListeners;if(a)for(d.imageLoadListeners=null,b=0,c=a.length;c>b;b++)a[b]()},this.imageLoadListeners=[]),this.srcImage=a}f.prototype.render=function(a,b){var e,f,g,h,i,j,k,l,m,n,o;if(this.imageLoadListeners)return e=this,this.imageLoadListeners.push(function(){e.render(a,b)}),void 0;b=b||{},f=this.srcImage.naturalWidth,g=this.srcImage.naturalHeight,h=b.width,i=b.height,j=b.maxWidth,k=b.maxHeight,l=!this.blob||"image/jpeg"===this.blob.type,h&&!i?i=g*h/f<<0:i&&!h?h=f*i/g<<0:(h=f,i=g),j&&h>j&&(h=j,i=g*h/f<<0),k&&i>k&&(i=k,h=f*i/g<<0),m={width:h,height:i};for(n in b)m[n]=b[n];o=a.tagName.toLowerCase(),"img"===o?a.src=c(this.srcImage,m,l):"canvas"===o&&d(this.srcImage,a,m,l),"function"==typeof this.onrender&&this.onrender(a)},"function"==typeof define&&define.amd?define([],function(){return f}):this.MegaPixImage=f}();

//jquery.scrollLoading.js by zhangxinxu,edited by sysutt
!function(a){a.fn.scrollLoading=function(b){var e,f,c={attr:"data-url",container:a(window),callback:a.noop},d=a.extend({},c,b||{});d.cache=[],a(this).each(function(){var b=this.nodeName.toLowerCase(),c=a(this).attr(d["attr"]),e=a(this).attr("data-kap-bg"),f={obj:a(this),tag:b,url:c,bg_url:e};d.cache.push(f)}),e=function(b){a.isFunction(d.callback)&&d.callback.call(b.get(0))},f=function(){var b=d.container.height();contop=a(window).get(0)===window?a(window).scrollTop():d.container.offset().top,a.each(d.cache,function(a,c){var i,j,d=c.obj,f=c.tag,g=c.url,h=c.bg_url;d&&(i=d.offset().top-contop,i+d.height(),(d.is(":visible")&&i>=0&&b>i||j>0&&b>=j)&&(g?"img"===f?e(d.attr("src",g)):d.load(g,{},function(){e(d)}):h?(d.css({"background-image":"url("+h+")","background-size":"cover"}),e(d)):e(d),c.obj=null))})},f(),d.container.bind("scroll",f)}}(jQuery);

//jquery.touchSwipe.js by Matt Bryson http://www.github.com/mattbryson
(function(a){if(typeof define==="function"&&define.amd&&define.amd.jQuery){define(["jquery"],a)}else{if(typeof module!=="undefined"&&module.exports){a(require("jquery"))}else{a(jQuery)}}}(function(f){var y="1.6.15",p="left",o="right",e="up",x="down",c="in",A="out",m="none",s="auto",l="swipe",t="pinch",B="tap",j="doubletap",b="longtap",z="hold",E="horizontal",u="vertical",i="all",r=10,g="start",k="move",h="end",q="cancel",a="ontouchstart" in window,v=window.navigator.msPointerEnabled&&!window.navigator.pointerEnabled&&!a,d=(window.navigator.pointerEnabled||window.navigator.msPointerEnabled)&&!a,C="TouchSwipe";var n={fingers:1,threshold:75,cancelThreshold:null,pinchThreshold:20,maxTimeThreshold:null,fingerReleaseThreshold:250,longTapThreshold:500,doubleTapThreshold:200,swipe:null,swipeLeft:null,swipeRight:null,swipeUp:null,swipeDown:null,swipeStatus:null,pinchIn:null,pinchOut:null,pinchStatus:null,click:null,tap:null,doubleTap:null,longTap:null,hold:null,triggerOnTouchEnd:true,triggerOnTouchLeave:false,allowPageScroll:"auto",fallbackToMouseEvents:true,excludedElements:"label, button, input, select, textarea, .noSwipe",preventDefaultEvents:true};f.fn.swipe=function(H){var G=f(this),F=G.data(C);if(F&&typeof H==="string"){if(F[H]){return F[H].apply(this,Array.prototype.slice.call(arguments,1))}else{f.error("Method "+H+" does not exist on jQuery.swipe")}}else{if(F&&typeof H==="object"){F.option.apply(this,arguments)}else{if(!F&&(typeof H==="object"||!H)){return w.apply(this,arguments)}}}return G};f.fn.swipe.version=y;f.fn.swipe.defaults=n;f.fn.swipe.phases={PHASE_START:g,PHASE_MOVE:k,PHASE_END:h,PHASE_CANCEL:q};f.fn.swipe.directions={LEFT:p,RIGHT:o,UP:e,DOWN:x,IN:c,OUT:A};f.fn.swipe.pageScroll={NONE:m,HORIZONTAL:E,VERTICAL:u,AUTO:s};f.fn.swipe.fingers={ONE:1,TWO:2,THREE:3,FOUR:4,FIVE:5,ALL:i};function w(F){if(F&&(F.allowPageScroll===undefined&&(F.swipe!==undefined||F.swipeStatus!==undefined))){F.allowPageScroll=m}if(F.click!==undefined&&F.tap===undefined){F.tap=F.click}if(!F){F={}}F=f.extend({},f.fn.swipe.defaults,F);return this.each(function(){var H=f(this);var G=H.data(C);if(!G){G=new D(this,F);H.data(C,G)}})}function D(a5,au){var au=f.extend({},au);var az=(a||d||!au.fallbackToMouseEvents),K=az?(d?(v?"MSPointerDown":"pointerdown"):"touchstart"):"mousedown",ax=az?(d?(v?"MSPointerMove":"pointermove"):"touchmove"):"mousemove",V=az?(d?(v?"MSPointerUp":"pointerup"):"touchend"):"mouseup",T=az?(d?"mouseleave":null):"mouseleave",aD=(d?(v?"MSPointerCancel":"pointercancel"):"touchcancel");var ag=0,aP=null,a2=null,ac=0,a1=0,aZ=0,H=1,ap=0,aJ=0,N=null;var aR=f(a5);var aa="start";var X=0;var aQ={};var U=0,a3=0,a6=0,ay=0,O=0;var aW=null,af=null;try{aR.bind(K,aN);aR.bind(aD,ba)}catch(aj){f.error("events not supported "+K+","+aD+" on jQuery.swipe")}this.enable=function(){aR.bind(K,aN);aR.bind(aD,ba);return aR};this.disable=function(){aK();return aR};this.destroy=function(){aK();aR.data(C,null);aR=null};this.option=function(bd,bc){if(typeof bd==="object"){au=f.extend(au,bd)}else{if(au[bd]!==undefined){if(bc===undefined){return au[bd]}else{au[bd]=bc}}else{if(!bd){return au}else{f.error("Option "+bd+" does not exist on jQuery.swipe.options")}}}return null};function aN(be){if(aB()){return}if(f(be.target).closest(au.excludedElements,aR).length>0){return}var bf=be.originalEvent?be.originalEvent:be;var bd,bg=bf.touches,bc=bg?bg[0]:bf;aa=g;if(bg){X=bg.length}else{if(au.preventDefaultEvents!==false){be.preventDefault()}}ag=0;aP=null;a2=null;aJ=null;ac=0;a1=0;aZ=0;H=1;ap=0;N=ab();S();ai(0,bc);if(!bg||(X===au.fingers||au.fingers===i)||aX()){U=ar();if(X==2){ai(1,bg[1]);a1=aZ=at(aQ[0].start,aQ[1].start)}if(au.swipeStatus||au.pinchStatus){bd=P(bf,aa)}}else{bd=false}if(bd===false){aa=q;P(bf,aa);return bd}else{if(au.hold){af=setTimeout(f.proxy(function(){aR.trigger("hold",[bf.target]);if(au.hold){bd=au.hold.call(aR,bf,bf.target)}},this),au.longTapThreshold)}an(true)}return null}function a4(bf){var bi=bf.originalEvent?bf.originalEvent:bf;if(aa===h||aa===q||al()){return}var be,bj=bi.touches,bd=bj?bj[0]:bi;var bg=aH(bd);a3=ar();if(bj){X=bj.length}if(au.hold){clearTimeout(af)}aa=k;if(X==2){if(a1==0){ai(1,bj[1]);a1=aZ=at(aQ[0].start,aQ[1].start)}else{aH(bj[1]);aZ=at(aQ[0].end,aQ[1].end);aJ=aq(aQ[0].end,aQ[1].end)}H=a8(a1,aZ);ap=Math.abs(a1-aZ)}if((X===au.fingers||au.fingers===i)||!bj||aX()){aP=aL(bg.start,bg.end);a2=aL(bg.last,bg.end);ak(bf,a2);ag=aS(bg.start,bg.end);ac=aM();aI(aP,ag);be=P(bi,aa);if(!au.triggerOnTouchEnd||au.triggerOnTouchLeave){var bc=true;if(au.triggerOnTouchLeave){var bh=aY(this);bc=F(bg.end,bh)}if(!au.triggerOnTouchEnd&&bc){aa=aC(k)}else{if(au.triggerOnTouchLeave&&!bc){aa=aC(h)}}if(aa==q||aa==h){P(bi,aa)}}}else{aa=q;P(bi,aa)}if(be===false){aa=q;P(bi,aa)}}function M(bc){var bd=bc.originalEvent?bc.originalEvent:bc,be=bd.touches;if(be){if(be.length&&!al()){G(bd);return true}else{if(be.length&&al()){return true}}}if(al()){X=ay}a3=ar();ac=aM();if(bb()||!am()){aa=q;P(bd,aa)}else{if(au.triggerOnTouchEnd||(au.triggerOnTouchEnd==false&&aa===k)){if(au.preventDefaultEvents!==false){bc.preventDefault()}aa=h;P(bd,aa)}else{if(!au.triggerOnTouchEnd&&a7()){aa=h;aF(bd,aa,B)}else{if(aa===k){aa=q;P(bd,aa)}}}}an(false);return null}function ba(){X=0;a3=0;U=0;a1=0;aZ=0;H=1;S();an(false)}function L(bc){var bd=bc.originalEvent?bc.originalEvent:bc;if(au.triggerOnTouchLeave){aa=aC(h);P(bd,aa)}}function aK(){aR.unbind(K,aN);aR.unbind(aD,ba);aR.unbind(ax,a4);aR.unbind(V,M);if(T){aR.unbind(T,L)}an(false)}function aC(bg){var bf=bg;var be=aA();var bd=am();var bc=bb();if(!be||bc){bf=q}else{if(bd&&bg==k&&(!au.triggerOnTouchEnd||au.triggerOnTouchLeave)){bf=h}else{if(!bd&&bg==h&&au.triggerOnTouchLeave){bf=q}}}return bf}function P(be,bc){var bd,bf=be.touches;if(J()||W()){bd=aF(be,bc,l)}if((Q()||aX())&&bd!==false){bd=aF(be,bc,t)}if(aG()&&bd!==false){bd=aF(be,bc,j)}else{if(ao()&&bd!==false){bd=aF(be,bc,b)}else{if(ah()&&bd!==false){bd=aF(be,bc,B)}}}if(bc===q){if(W()){bd=aF(be,bc,l)}if(aX()){bd=aF(be,bc,t)}ba(be)}if(bc===h){if(bf){if(!bf.length){ba(be)}}else{ba(be)}}return bd}function aF(bf,bc,be){var bd;if(be==l){aR.trigger("swipeStatus",[bc,aP||null,ag||0,ac||0,X,aQ,a2]);if(au.swipeStatus){bd=au.swipeStatus.call(aR,bf,bc,aP||null,ag||0,ac||0,X,aQ,a2);if(bd===false){return false}}if(bc==h&&aV()){clearTimeout(aW);clearTimeout(af);aR.trigger("swipe",[aP,ag,ac,X,aQ,a2]);if(au.swipe){bd=au.swipe.call(aR,bf,aP,ag,ac,X,aQ,a2);if(bd===false){return false}}switch(aP){case p:aR.trigger("swipeLeft",[aP,ag,ac,X,aQ,a2]);if(au.swipeLeft){bd=au.swipeLeft.call(aR,bf,aP,ag,ac,X,aQ,a2)}break;case o:aR.trigger("swipeRight",[aP,ag,ac,X,aQ,a2]);if(au.swipeRight){bd=au.swipeRight.call(aR,bf,aP,ag,ac,X,aQ,a2)}break;case e:aR.trigger("swipeUp",[aP,ag,ac,X,aQ,a2]);if(au.swipeUp){bd=au.swipeUp.call(aR,bf,aP,ag,ac,X,aQ,a2)}break;case x:aR.trigger("swipeDown",[aP,ag,ac,X,aQ,a2]);if(au.swipeDown){bd=au.swipeDown.call(aR,bf,aP,ag,ac,X,aQ,a2)}break}}}if(be==t){aR.trigger("pinchStatus",[bc,aJ||null,ap||0,ac||0,X,H,aQ]);if(au.pinchStatus){bd=au.pinchStatus.call(aR,bf,bc,aJ||null,ap||0,ac||0,X,H,aQ);if(bd===false){return false}}if(bc==h&&a9()){switch(aJ){case c:aR.trigger("pinchIn",[aJ||null,ap||0,ac||0,X,H,aQ]);if(au.pinchIn){bd=au.pinchIn.call(aR,bf,aJ||null,ap||0,ac||0,X,H,aQ)}break;case A:aR.trigger("pinchOut",[aJ||null,ap||0,ac||0,X,H,aQ]);if(au.pinchOut){bd=au.pinchOut.call(aR,bf,aJ||null,ap||0,ac||0,X,H,aQ)}break}}}if(be==B){if(bc===q||bc===h){clearTimeout(aW);clearTimeout(af);if(Z()&&!I()){O=ar();aW=setTimeout(f.proxy(function(){O=null;aR.trigger("tap",[bf.target]);if(au.tap){bd=au.tap.call(aR,bf,bf.target)}},this),au.doubleTapThreshold)}else{O=null;aR.trigger("tap",[bf.target]);if(au.tap){bd=au.tap.call(aR,bf,bf.target)}}}}else{if(be==j){if(bc===q||bc===h){clearTimeout(aW);clearTimeout(af);O=null;aR.trigger("doubletap",[bf.target]);if(au.doubleTap){bd=au.doubleTap.call(aR,bf,bf.target)}}}else{if(be==b){if(bc===q||bc===h){clearTimeout(aW);O=null;aR.trigger("longtap",[bf.target]);if(au.longTap){bd=au.longTap.call(aR,bf,bf.target)}}}}}return bd}function am(){var bc=true;if(au.threshold!==null){bc=ag>=au.threshold}return bc}function bb(){var bc=false;if(au.cancelThreshold!==null&&aP!==null){bc=(aT(aP)-ag)>=au.cancelThreshold}return bc}function ae(){if(au.pinchThreshold!==null){return ap>=au.pinchThreshold}return true}function aA(){var bc;if(au.maxTimeThreshold){if(ac>=au.maxTimeThreshold){bc=false}else{bc=true}}else{bc=true}return bc}function ak(bc,bd){if(au.preventDefaultEvents===false){return}if(au.allowPageScroll===m){bc.preventDefault()}else{var be=au.allowPageScroll===s;switch(bd){case p:if((au.swipeLeft&&be)||(!be&&au.allowPageScroll!=E)){bc.preventDefault()}break;case o:if((au.swipeRight&&be)||(!be&&au.allowPageScroll!=E)){bc.preventDefault()}break;case e:if((au.swipeUp&&be)||(!be&&au.allowPageScroll!=u)){bc.preventDefault()}break;case x:if((au.swipeDown&&be)||(!be&&au.allowPageScroll!=u)){bc.preventDefault()}break}}}function a9(){var bd=aO();var bc=Y();var be=ae();return bd&&bc&&be}function aX(){return !!(au.pinchStatus||au.pinchIn||au.pinchOut)}function Q(){return !!(a9()&&aX())}function aV(){var bf=aA();var bh=am();var be=aO();var bc=Y();var bd=bb();var bg=!bd&&bc&&be&&bh&&bf;return bg}function W(){return !!(au.swipe||au.swipeStatus||au.swipeLeft||au.swipeRight||au.swipeUp||au.swipeDown)}function J(){return !!(aV()&&W())}function aO(){return((X===au.fingers||au.fingers===i)||!a)}function Y(){return aQ[0].end.x!==0}function a7(){return !!(au.tap)}function Z(){return !!(au.doubleTap)}function aU(){return !!(au.longTap)}function R(){if(O==null){return false}var bc=ar();return(Z()&&((bc-O)<=au.doubleTapThreshold))}function I(){return R()}function aw(){return((X===1||!a)&&(isNaN(ag)||ag<au.threshold))}function a0(){return((ac>au.longTapThreshold)&&(ag<r))}function ah(){return !!(aw()&&a7())}function aG(){return !!(R()&&Z())}function ao(){return !!(a0()&&aU())}function G(bc){a6=ar();ay=bc.touches.length+1}function S(){a6=0;ay=0}function al(){var bc=false;if(a6){var bd=ar()-a6;if(bd<=au.fingerReleaseThreshold){bc=true}}return bc}function aB(){return !!(aR.data(C+"_intouch")===true)}function an(bc){if(!aR){return}if(bc===true){aR.bind(ax,a4);aR.bind(V,M);if(T){aR.bind(T,L)}}else{aR.unbind(ax,a4,false);aR.unbind(V,M,false);if(T){aR.unbind(T,L,false)}}aR.data(C+"_intouch",bc===true)}function ai(be,bc){var bd={start:{x:0,y:0},last:{x:0,y:0},end:{x:0,y:0}};bd.start.x=bd.last.x=bd.end.x=bc.pageX||bc.clientX;bd.start.y=bd.last.y=bd.end.y=bc.pageY||bc.clientY;aQ[be]=bd;return bd}function aH(bc){var be=bc.identifier!==undefined?bc.identifier:0;var bd=ad(be);if(bd===null){bd=ai(be,bc)}bd.last.x=bd.end.x;bd.last.y=bd.end.y;bd.end.x=bc.pageX||bc.clientX;bd.end.y=bc.pageY||bc.clientY;return bd}function ad(bc){return aQ[bc]||null}function aI(bc,bd){bd=Math.max(bd,aT(bc));N[bc].distance=bd}function aT(bc){if(N[bc]){return N[bc].distance}return undefined}function ab(){var bc={};bc[p]=av(p);bc[o]=av(o);bc[e]=av(e);bc[x]=av(x);return bc}function av(bc){return{direction:bc,distance:0}}function aM(){return a3-U}function at(bf,be){var bd=Math.abs(bf.x-be.x);var bc=Math.abs(bf.y-be.y);return Math.round(Math.sqrt(bd*bd+bc*bc))}function a8(bc,bd){var be=(bd/bc)*1;return be.toFixed(2)}function aq(){if(H<1){return A}else{return c}}function aS(bd,bc){return Math.round(Math.sqrt(Math.pow(bc.x-bd.x,2)+Math.pow(bc.y-bd.y,2)))}function aE(bf,bd){var bc=bf.x-bd.x;var bh=bd.y-bf.y;var be=Math.atan2(bh,bc);var bg=Math.round(be*180/Math.PI);if(bg<0){bg=360-Math.abs(bg)}return bg}function aL(bd,bc){var be=aE(bd,bc);if((be<=45)&&(be>=0)){return p}else{if((be<=360)&&(be>=315)){return p}else{if((be>=135)&&(be<=225)){return o}else{if((be>45)&&(be<135)){return x}else{return e}}}}}function ar(){var bc=new Date();return bc.getTime()}function aY(bc){bc=f(bc);var be=bc.offset();var bd={left:be.left,right:be.left+bc.outerWidth(),top:be.top,bottom:be.top+bc.outerHeight()};return bd}function F(bc,bd){return(bc.x>bd.left&&bc.x<bd.right&&bc.y>bd.top&&bc.y<bd.bottom)}}}));

// kap 1.6.7 by ghost
// kap 1.7.0 edited by sysutt
if(kap!=null)alert("kap error.");
var kap={
	events:"ontouchend" in document ? ["touchstart", "touchmove", "touchend", "click"] : ["mousedown", "mousemove", "mouseup", "click"],
	cw:$(window).width(),
	ch:$(window).height(),
    pageCounter:0
};

kap.mask=function(arg,zindex,lock){
	//arg:true | false | "clear" clear强制清除所有mask, zindex覆盖深度，默认为9000,lock是否锁定拖动
	if(arg=="clear"){
		kap.maskCount=0;
        $("[data-kap='_kap_mask']").removeClass("kap-mask-on");
        setTimeout(function(){
            $("[data-kap='_kap_mask']").remove();
        });
		$(".kap-page").removeClass("kap-mask-blur");
		return;
	}
	if(kap.maskCount==null)kap.maskCount=0;
	if(arg){
		kap.maskCount++;	
	}else{
		kap.maskCount--;
	}
	if(kap.maskCount>0){
		if($("[data-kap='_kap_mask']").length<1){
			var str='<div data-kap="_kap_mask" class="kap-mask"></div>';
			$("body").append(str);
            $("[data-kap='_kap_mask']").addClass("kap-mask-on");
			//$(".kap-page:visible").addClass("kap-mask-blur");
			$(".kap-wrap").addClass("kap-mask-blur");
            if(zindex!=null){
                $("[data-kap='_kap_mask']").css({
                   "z-index":zindex 
                });
            }
            if(lock){
                $("[data-kap='_kap_mask']").unbind().on(kap.events[0],function(e){
                    e.preventDefault();
                    return false;
                });
                $("[data-kap='_kap_mask']").on(kap.events[1],function(e){
                    e.preventDefault();
                    return false;
                });
                $("[data-kap='_kap_mask']").on(kap.events[2],function(e){
                    e.preventDefault();
                    return false;
                });
            }
		}
	}else{
		$("[data-kap='_kap_mask']").remove();
		$(".kap-wrap").removeClass("kap-mask-blur");
	}
}


kap.popBottom=function(arg){ //底部弹出
    
    if(!arg){
        if(kap._bottomWin){
            kap._bottomWin.closeWin();
        }else{
            return;
        }
    }else{
        if(kap._bottomWin){
            kap._bottomWin.empty();
        }
		var str='<div data-kap="kap-bottomwin" class="kap-bottomwin">'+
		'<div class="kap-hitarea"></div>'+
		'<div class="kap-win">'+
		'<div class="kap-content"></div>'+
		'</div>'+
		'</div>';
        $("body").append(str);
		var $t=$("[data-kap='kap-bottomwin']");
		$t.$win=$t.find(".kap-win");
        
        if(!arg.height){
            arg.height=200;
        }
        $t.$win.css({
           height:arg.height*2 
        });
        
		$t.$hit=$t.find(".kap-hitarea");
        
		//防止滚动
		$t.bind(kap.events[1],function(e){
			e.preventDefault();
			return false;
		});
        
        $t.find(".kap-content").html(arg.html);
        if(arg.blur){
            kap.mask(true);
           //$(".kap-page:visible").addClass("kap-mask-blur"); 
        }
        $t.$win.show();
        kap.css3trans($t.$win,"translateY(100%)");
        setTimeout(function(){
            kap.css3trans($t.$win,"translateY(0)","0.2s");
        },100);
        
		kap._bottomWin=$t;
		kap._bottomWin.closeWin=function(){
            kap.css3trans($t.$win,"translateY(100%)","0.2s");
            if(arg.onclose!=null){
                arg.onclose();
            }
            setTimeout(function(){
                if(arg.blur){
                    kap.mask(false);
                }
                //$(".kap-page:visible").removeClass("kap-mask-blur");
                kap._bottomWin.remove();
            },200);
		}
		
		return $t;
        
    }
}

kap.lock=function(text,blur){
	if(!text){
		if(kap._lockWin){
			kap._lockWin.closeWin();
		}else{
			return;
		}
	}else{
		if(kap._lockWin){
			kap._lockWin.empty();
		}
		var str='<div data-kap="kap-lockwin" class="kap-lockwin">'+
		'<div class="kap-hitarea"></div>'+
		'<div class="kap-win">'+
		'<div class="kap-content"></div>'+
		'</div>'+
		'</div>';
		$("body").append(str);
		var $t=$("[data-kap='kap-lockwin']");
		$t.$win=$t.find(".kap-win");
		$t.$hit=$t.find(".kap-hitarea");
		//防止滚动
		$t.bind(kap.events[1],function(e){
			e.preventDefault();
			return false;
		});
		$t.find(".kap-content").html(text);
        if(blur){
            kap.mask(true);
           //$(".kap-page:visible").addClass("kap-mask-blur"); 
        }
		$t.$win.show();
        kap.css3trans($t.$win,"translateY(100%)");
        setTimeout(function(){
            kap.css3trans($t.$win,"translateY(0)","0.2s");
        },100);
		kap._lockWin=$t;
		kap._lockWin.closeWin=function(){
            if(blur){
                kap.mask(false);
            }
            kap.css3trans($t.$win,"translateY(100%)","0.2s");
            setTimeout(function(){
                kap._lockWin.remove();
            },200);
		}
		
		return $t;
	}
}


kap.confirm=function(arg){
	kap.popup({
		myclass:"kap-alert",
		height:134,
		html:arg.html,
		cancel:{
			label:"取消"
		},
		submit:{
			label:"确定",
			callback:arg.submit
		}
	});
}
kap.alert=function(arg,callback){
	kap.popup({
		myclass:"kap-alert",
		height:134,
		html:arg,
		cancel:{
			label:"确定",
			callback:callback
		}
	});
}
kap.tip=function(arg,time){
	$(".kap-tip").remove();
	var html = '<div class="kap-tip"><span class="kap-text">'+arg+'</span></div>';
	$("body").append(html);
	$(".kap-tip").addClass("on");
	setTimeout(function(){
        $(".kap-tip").removeClass("on");
		$(".kap-tip").remove();
    },time);
}
kap.popup=function(arg){
	//arg  {width,height,btns[submit{callback,label},cancel,close],title,html,locked}
	if(!arg)return;
	if(!arg.popType)arg.popType="popwin";
	if(!arg.width){
		if($(".kap-page.kap-page-current")){
			arg.width=$(".kap-page.kap-page-current").width()-40;
		}else{
			arg.width=kap.cw-40;
		}
	}
	if(!arg.height)arg.height=200;
	if(!arg.myclass)arg.myclass="";
	if(!kap.nextId)kap.nextId=0;
	var str='<div data-kap="_kap_'+kap.nextId+'" class="kap-'+arg.popType+'">';
	str+='<div class="kap-hitarea"></div>';
	str+='<div class="kap-win">';
	if(arg.popType=="popwin"){
		str+='<div class="kap-title"></div>';
	}
	str+='<div class="kap-content"></div>';
	str+='<div class="kap-btn-wrap"><a href="javascript:void(0);" target="_self" class="kap-btn-submit"></a><a href="javascript:void(0);" target="_self" class="kap-btn-cancel"></a></div>';
	str+='</div></div>';
	kap.mask(true);
	$("body").append(str);
	
	var $t=$("[data-kap='_kap_"+kap.nextId+"']");
	$t.$hit=$t.find(".kap-hitarea");
	$t.$win=$t.find(".kap-win");
    kap.css3trans($t.$win,"scale(0,0)");
	setTimeout(function(){
        kap.css3trans($t.$win,"scale(1,1)","0.2s");
    },100);
    
	//标题
	if(arg.title!=null){
		$t.find(".kap-title").html(arg.title);
	}
	
	$t.$content=$t.find(".kap-content");
	if(arg.html!=null){
		$t.$content.html(arg.html);
	}
	
	$t.addClass(arg.myclass);
	$t.$win.css({
		width:arg.width,
		height:arg.height/16+"rem"
	});
	if(arg.popType=="popwin"){
		$t.$win.css({
			"margin-left":-arg.width/2,
			"margin-top":-arg.height/32+"rem"
		});
	}else{
		if(!arg.position){
			arg.position={left:0,top:0}
		}
		$t.$win.css({
			"left":arg.position.left,
			"top":arg.position.top
		});
	}
	
	//防止滚动
	$t.bind(kap.events[1],function(e){
		e.preventDefault();
		return;
	});
	
	//通用
	var _closeWin=function(){
        kap.css3trans($t.$win,"scale(0,0)","0.2s");
        setTimeout(function(){ 
            kap.mask(false);
            $t.remove(); 
        },200);
	}
	$t.closeWin=_closeWin;
	
	
	//cancel:{show,callback,label}
	$t.$btn_cancel=$t.find(".kap-btn-cancel");
	if(arg.cancel!=undefined){
		$t.$btn_cancel.show();
		if(!arg.cancel.label){
			$t.$btn_cancel.html("取消");
		}else{
			$t.$btn_cancel.html(arg.cancel.label);
		}
		if(!arg.cancel.callback){
			kap.bindTouch($t.$btn_cancel,function($this){
				_closeWin();
			});
		}else{
			kap.bindTouch($t.$btn_cancel,function(){
				arg.cancel.callback();
				_closeWin();
			});
		}
	}else{
		$t.$btn_cancel.hide();
	}
	//submit:{show,callback,label}
	$t.$btn_submit=$t.find(".kap-btn-submit");
	if(arg.submit!=undefined){
		$t.$btn_submit.show();
		if(!arg.submit.label){
			$t.$btn_submit.html("确定");
		}else{
			$t.$btn_submit.html(arg.submit.label);
		}
		if(!arg.submit.callback){
			kap.bindTouch($t.$btn_submit,function(){
				_closeWin();
			});
		}else{
			$t.submit=arg.submit.callback;
			if(!arg.submit.wait){
				kap.bindTouch($t.$btn_submit,function(){
					arg.submit.callback();
					_closeWin();
				});
			}else{
				kap.bindTouch($t.$btn_submit,function(){
					arg.submit.callback();
				});
			}
		}
	}else{
		$t.$btn_submit.hide();
	}
	if(arg.cancel || arg.submit){
		if(arg.cancel && arg.submit){
			$t.$btn_cancel.css("width","50%");
			$t.$btn_submit.css("width","50%");
		}
	}else{
		$t.find(".kap-btn-wrap").hide();
	}
	//close:true | {callback:fn}
	$t.$btn_close=$t.find(".kap-hitarea");
	if(arg.close!=undefined){
		if(!arg.close.callback){
			kap.bindTouch($t.$btn_close,function(){
				_closeWin();
			});
		}else{
			kap.bindTouch($t.$btn_close,function(){
				arg.close.callback();
				_closeWin();
			});
		}
	}else{
		$t.$btn_close.hide();
	}
	
	kap.nextId++;
	
	//当前窗口
	kap.current=$t;
	return $t;
}

kap.popSider=function(arg){ //侧面菜单
    //arg:{event:默认事件,width：菜单宽度,html:菜单内容,right:true|false 方向，默认为左，lock:是否锁定,style:inset| inset为内侧阴影, blur:是否模糊底层}
    if(!arg){
        //关闭侧栏
        if(kap._siderMenu){
            kap._siderMenu.closeWin();
        }else{
            return;
        }
    }else{
        //打开侧栏
        if(kap._siderMenu){
            kap._siderMenu.empty();
        }
        if(!arg.html)arg.html="";
		var str='<div data-kap="kap-sider" class="kap-sider'+(arg.right?' kap-sider-right':'')+'">'+
        '<div class="kap-hitarea'+(arg.style=="inset"?' kap-hitarea-inset':'')+'"></div>'+
		'<div class="kap-content'+(arg.style=="inset"?' kap-content-inset':'')+'">'+arg.html+'</div>'+
		'</div>';
		$("body").append(str);
		var $t=$("[data-kap='kap-sider']");
        $t.$content=$t.find(".kap-content");
        if(arg.right){
           $t.$content.css({
               "right":0,
               "left":"auto" 
           });
        }
        $t.$hit=$t.find(".kap-hitarea");
        
        var _pageHeight=$(".kap-page-current").outerHeight();
        $("body").css({
           height: _pageHeight
        });

        $("body").addClass("kap-body-sider");
        
        if(arg.blur){
            $(".kap-wrap").addClass("kap-mask-blur");
        }

        if(!arg.width){
            var _width="100px";
        }else{
            var _width=arg.width;
        }
        var $_view=$(".kap-top, .kap-bottom, .kap-page-current");
        
        $t.$content.css("width",_width);
        kap._siderMenu=$t;
        $t.closeWin=function(){
            $("body").removeClass("kap-body-sider");
            $("body").css("height","");
            if(arg.blur){
                $(".kap-wrap").removeClass("kap-mask-blur");
            }
            if(arg.onclose!=null){
                arg.onclose();
            }
            setTimeout(function(){
                kap._siderMenu.remove();
                kap._siderMenu=null;
            },200);
        }
        
        if(arg.lock){
            $t.$hit.bind(kap.events[0],function(e){
                e.preventDefault();
            });
        }else{
            $t.$hit.click($t.closeWin);
        }
        
        return $t;
        
    }
}


kap.aniTo=function($t,animation,callback){ //动画切换
	$t.addClass(animation);
	$t.show();
	$t.unbind("webkitAnimationEnd").bind("webkitAnimationEnd",function(){
		$t.removeClass(animation);
		if(callback!=null)callback();
	});
}
kap.css3trans=function($t,str,speed,method,callback){
	if(!speed)var speed="0";
	if(!method)var method="cubic-bezier(0, 0, 0.25, 1)";
	$t.css({
		"transition":"transform "+speed+" "+method,
		"-ms-transition":"-ms-transform "+speed+" "+method,
		"-webkit-transition":"-webkit-transform "+speed+" "+method,
		"transform":str,
		"-webkit-transform":str,
		"-ms-transform":str
	});
    if(callback!=null){
        var _timeout=parseFloat(speed,10)*1000;
        if(_timeout>0){
            setTimeout(callback,_timeout);
        }
    }
}
kap.bindTouch=function($t,callback){ //绑定点击事件，同时锁定移动操作
	$t.bind(kap.events[0],function(){
		$(this).addClass("kap-btn-on");
	});
	$t.bind(kap.events[1],function(e){
		e.preventDefault();
	});
	$t.bind(kap.events[3],function(){
		$(this).removeClass("kap-btn-on");
		callback($(this));
	});
}


kap.drawInput=function($t){
    //透明方式重绘 select、input.date等。
    if(!kap.nextId)kap.nextId=0;
    $t.each(function(){
        var $this=$(this);
        if(!$this.data("kap-input-wrap")){
            var _skin=$this.data("kap-skin");
            $this.wrap('<div data-kap="_kap_'+kap.nextId+'" class="kap-input"></div>');
            $this.data("kap-input-wrap",'_kap_'+kap.nextId);
            var $fake=$("[data-kap='_kap_"+kap.nextId+"']");
            $fake.addClass(_skin);
            $fake.css("position","relative");
			$this.css({
                opacity:0,
				position:"absolute",
                border:"none",
				left:0,
				top:0,
				width:"100%",
				height:"100%"
			});
			var $fake_value=$fake.append('<span data-icon-blue="'+($this.data("icon-blue")?$this.data("icon-blue"):"")+'" class="kap-input-value">请选择</span>').find(".kap-input-value");
            var _tag=$this[0].tagName;
            if(_tag=="SELECT"){
                if($this.find("option:selected").length>0){
                    $fake_value.html($this.find("option:selected").html());
                }else{
                    $fake_value.html($this.find("option:first").html());
                }
                $fake_value.data("value",$this.val());
                $this.change(function(){
                    $fake_value.data("value",$(this).val());
                    $fake_value.html($(this).find("option:selected").html());
                });
            }else if(_tag=="INPUT"){
                $fake_value.data("value",$this.val());
                if($(this).val()!=""){
                    $fake_value.html($(this).val());
                }
                $this.bind("input propertychange change blur",function(){
                    $fake_value.data("value",$(this).val());
                    $fake_value.html($(this).val());
                });
            }
			kap.nextId++;
        }
    });
}


kap.drawSelect=kap.drawInput; //兼容旧版 dom

kap.canvasLoader=function(arg){ //canvas压缩本地图片
	//target,width,height,onLoad,onLoadAll
    //返回：{width:w,height:h,base64:base64,canvas:canvas};
	var $t=arg.target;
	var cw=arg.width;
	var ch=arg.height;
	var type=arg.type?arg.type:"image/png";
	var quality=parseFloat(arg.quality?arg.quality:1,10);
	var result=[];
	$t.unbind().on('change',function(){
		if(this.files.length<1)return;
		kap.lock("图片处理中……");
		var _fileList=this.files;
		var _fileCounter=_fileList.length;
		for(var i=0;i<_fileList.length;i++){
			var file=_fileList[i];
			try{
				var URL=webkitURL;
			}catch(e){
				var URL=window.URL;
			}
			//var URL = URL || webkitURL;
			var _url=URL.createObjectURL(file);
			//本地图片
			var $img=new Image();
			$img.onload=function(){
				//比例
				var w=this.width,h=this.height;
				var s=w/h;
				
				if(!cw && ch>0){
					h=ch;
					w=h*s;
				}else if(!ch && cw>0){
					w=cw;
					h=w/s;
				}else if(!cw && !ch){
					w=kap.cw;
					h=w/s;
				}else{
					var cs=cw/ch;
					if(cs>s){
						h=ch;
						w=h*s;
					}else{
						w=cw;
						h=w/s;
					}
				}
				w=Math.round(w);
				h=Math.round(h);
				//生成canvas
				var canvas = document.createElement('canvas');
				$(canvas).attr({width:w,height:h});
				var ctx=canvas.getContext('2d');
				ctx.drawImage(this, 0, 0, this.width, this.height,0,0,w,h);
				//alert('原：'+this.width+","+this.height+" 后："+w+","+h);
				var base64=canvas.toDataURL(type,quality); //保存图片数据 
				
				var _output=function(direction){
					if(direction==6 || direction==8){
						var r={width:h,height:w,base64:base64,canvas:canvas};
					}else{
						var r={width:w,height:h,base64:base64,canvas:canvas};
					}
					result.push(r);
					if(arg.onLoad!=null)arg.onLoad(r);
					_fileCounter--;
					if(_fileCounter<1){
						kap.lock(false);
						if(arg.onLoadAll!=null)arg.onLoadAll(result);
					}
				}
				
                if(navigator.userAgent.match(/iphone/i) ) { // 修复IOS
					var pic=this;
					//修正方向
					var $pic=$(pic);
					$pic.exifLoad(function(){
						var ov=parseInt($pic.exif("Orientation"),10);
						var mpImg = new MegaPixImage(pic);
						mpImg.render(canvas, { maxWidth: w, maxHeight: h, quality: 1, orientation: ov });
						base64 = canvas.toDataURL('image/jpeg', quality || 0.8 );
						_output(ov);
					});
                }else if(navigator.userAgent.match(/Android/i) ) { // 修复android
                    var encoder = new JPEGEncoder();
                    base64 = encoder.encode(ctx.getImageData(0,0,w,h), quality * 100 || 80 );
					_output();
                }else{
					_output();
				}
				

			}
			$img.src=_url;
		}
    });
}
kap.viewScrollTo=function(pos){ //视图滚动
    $("body").animate({
        "scrollTop":pos
    },"fast");
}
kap._pageHistory=[];	//页面跳转历史,test
kap.init=function(){
	//重绘指定皮肤的select date
    kap.drawInput($("input[data-kap-skin],select[data-kap-skin]"));
    //如有默认页，加入历史
    if($(".kap-page-current").length==1){
        kap._pageHistory.push($(".kap-page-current"));
    }
    //为所有页面内容包裹
    if($(".kap-wrap").length<1){
        $("body").wrapInner('<div class="kap-wrap"></div>');
    }
}
kap.switchPage=function(page){
    var $page;
	if(page==-1){
		if(kap._pageHistory.length>1){
			kap._pageHistory.pop();
            $page=kap._pageHistory[kap._pageHistory.length-1];
		}else{
            $page=false;
        }
	}else{
        var _pageid=$(page).attr("id");
        if(!_pageid){
            _pageid="_kap_pageid_"+kap.pageCounter;
            kap.pageCounter++;
            $(page).attr("id",_pageid);
        }
        if(kap._pageHistory.length>1){
            if(_pageid!=kap._pageHistory[kap._pageHistory.length-2].attr("id")){
                var $page=$("#"+_pageid);
                kap._pageHistory.push($page);
            }else{
                var $page=$("#"+_pageid);
                kap._pageHistory.pop();
            }
        }else{
            var $page=$("#"+_pageid);
            kap._pageHistory.push($page);
        }
	}
    if($page!=false){
		$(".kap-page-current").each(function(){
			$(this).data("kap-scrolltop",$(window).scrollTop());
		});
		$(".kap-page").removeClass("kap-page-current");
		$page.addClass("kap-page-current");
		if($page.data("kap-scrolltop")){
			$(window).scrollTop($page.data("kap-scrolltop"));
		}else{
			$(window).scrollTop(0);
		}
    }
    return $page;
}
kap.bodyLoading=function(arg,txt){
	if(arg){
		$("body").addClass("kap-loading");
		if(txt!=null){
			$(".kap-loading-status").html(txt);
		}
		//$(".kap-page-current").addClass("kap-mask-blur");
	}else{
		$("body").removeClass("kap-loading");
		$(".kap-loading-status").html("");
		//$(".kap-page").removeClass("kap-mask-blur");
	}
}

//20160119 update
kap.listLoading=function(arg,target){
	if(arg){
		$(target).addClass("kap-list-loading");
		$(target).html("正在载入中...");
	}else{
		$(".item-more").html("点击载入更多").removeClass("kap-loading");
	}
}

//---------------------------------etc-------------------------
kap.setWxTitle=function(title){
    /*document.title=title;
    var $iframe=$('<iframe src=""></iframe>').on('load',function(){
        setTimeout(function(){
           $iframe.off('load').remove();
        },0)
    }).appendTo($('body'));*/
	
}
kap.shake=function(arg){
	//arg={threshold,timeout,counter:摇几下才触发,once:是否一次性}
	//摇一摇支持
	if (window.DeviceMotionEvent) {
		if(!arg.threshold)arg.threshold=15;// optional shake strength threshold
		if(!arg.timeout)arg.timeout=1000;//optional, determines the frequency of event generation
		if(!arg.callback)arg.callback=function(){};//optional
		if(!arg.counter)arg.counter=1;
		var counter=arg.counter;
		var shakeObj=this;
		var last_update = new Date().getTime();
		var x = y = z = last_x = last_y = last_z = 0;
		this.reset=function(){
			last_update = new Date();
			last_x = null;
			last_y = null;
			last_z = null;
		}
		this.start=function(){
			this.reset();
			window.addEventListener('devicemotion', deviceMotionHandler, false);
		}
		this.stop=function(){
			window.removeEventListener('devicemotion', deviceMotionHandler, false);
			this.reset();
		}
		function deviceMotionHandler(ev){
			var acceleration = ev.accelerationIncludingGravity;
			x = acceleration.x;
			y = acceleration.y;
			z = acceleration.z;
			deltaX = Math.abs(last_x - x);
			deltaY = Math.abs(last_y - y);
			deltaZ = Math.abs(last_z - z);
        	if (((deltaX > arg.threshold) && (deltaY > arg.threshold)) || ((deltaX > arg.threshold) && (deltaZ > arg.threshold)) || ((deltaY > arg.threshold) && (deltaZ > arg.threshold))) {
				curTime = new Date().getTime();
				var diffTime = curTime - last_update;
				if(diffTime>arg.timeout){
					counter--;
					if(counter<=0){
						arg.callback(shakeObj);
						counter=arg.counter;
						if(arg.once){
							shakeObj.stop();
						}
					}
					last_update = new Date().getTime();
				}
			}

		}
		this.start();
		return this;
	}else{
		return false;
	}
}

//计算距离
kap.distance=function(p0,p1){
	if(!p1){
		return 0;
	}else{
		return Math.sqrt((p0.x-p1.x)*(p0.x-p1.x)+(p0.y-p1.y)*(p0.y-p1.y));
	}
}

//计算触点位置
kap.pointerEventToXY=function(e,idx){ //idx为多点触摸时点的索引
	if(!idx)idx=0;
	var out = {x:0, y:0};
	if(e.type == 'touchstart' || e.type == 'touchmove' || e.type == 'touchend' || e.type == 'touchcancel'){
		var touch = e.originalEvent.touches[idx] || e.originalEvent.changedTouches[idx];
		if(!touch)return null;
		out.x = touch.pageX;
		out.y = touch.pageY;
	}else if(e.type == 'mousedown' || e.type == 'mouseup' || e.type == 'mousemove' || e.type == 'mouseover'|| e.type=='mouseout' || e.type=='mouseenter' || e.type=='mouseleave') {
		out.x = e.pageX;
		out.y = e.pageY;
	}
	return out;
};

//载入声音,播放为resultList["id"].play();
kap.loadSound=function($arg){
	//list:[{id,onload,onend,autoplay,loop}],onload(result),oncomplete(resultList)
	var list=[];
	var sNum=$arg.list.length;
	var sCounter=sNum;
    var allLoaded=false;
	//function myObj(){return this};
	for(var i=0;i<sNum;i++){
		data=$arg.list[i];
		var a=document.createElement('audio');
		a.dataObj={id:data.id,loaded:false,autoplay:data.autoplay,loop:data.loop,onload:data.onload,onend:data.onend,sound:a};
		a.addEventListener("canplay",function(){
            if(!this.dataObj.loaded){
                this.dataObj.loaded=true;
                sCounter--;
                if($arg.onload!=null){
                    $arg.onload(this.dataObj);
                }
            }
			//if(onload!=null)onload(this.dataObj);
			if(sCounter<=0 && !allLoaded){
                allLoaded=true;
				if($arg.oncomplete!=null){
					$arg.oncomplete(list);
				}
			}
			if(this.dataObj.autoplay){
				//console.log("autoplay");
				this.play();
			}
		});
		a.addEventListener("ended",function(){
			if(this.dataObj.onend!=null)this.dataObj.onend(this.dataObj);
			if(this.dataObj.loop){
				this.play();
			}
		});
		a.src=data.src;
		a.load();
		a.dataObj.play=function(){if(!this.loop){this.sound.currentTime=0;};this.sound.play();};
		a.dataObj.stop=function(){this.sound.pause();};
		list[data.id]=a.dataObj;
	}
	return list;
}

//延迟载入图片
kap.lazy=function(target){
    $(target).scrollLoading({
        attr:'data-kap-lazy'
    });
}

