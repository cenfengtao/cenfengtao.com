var iDialog = (function(){
	var dialogHTML = '<header>\
						<dl>\
							<dd><label>{title}</label></dd>\
							<dd><span onclick="this.parentNode.parentNode.parentNode.parentNode.classList.remove(\'on\');">{close}</span></dd>\
						</dl>\
					</header>\
					<article class="dialogContent">{content}</article>\
					<footer></footer>';
	//
	var parent = {
		wrapper: null,
		cover: null,
		lastIndex:1000,
		list:null
	}
	var dialog = function(){
		this.options = {
			id: "dialogWindow_",
			classList: "",
			type:"",
			wrapper: "",
			title: "",
			close: "",
			content: "",
			cover:true,
			btns:[]
			//,
			// btns:[
			// 	{id:"", name:"è·?¨", fn:function(){}},
			// 	{id:"", name:"è???", fn:function(self){self.hide();}},
			// ]
		}
	}
	dialog.prototype = {
		init: function(){
			if(parent.list){return this;}else{
				parent.list = {};
			}
			var section = document.createElement("section");
			section.setAttribute("id", id="dialoger");
			section.setAttribute("ontouchmove", "event.preventDefault();");
			//
			var cover = document.createElement("div");
			cover.setAttribute("class", "dialogCover");
			section.appendChild(cover);
			//
			parent.container = section;
			parent.cover = cover;
			document.body.insertBefore(parent.container, document.body.childNodes[0]);
			return this;
		},
		open: function(options){
			this.init();
			this.options = dialog.merge(this.options, options||{});
			this.options.zIndex = parent.lastIndex+=100;
			this.options.id = "dialogWindow_"+this.options.zIndex;
			parent.list[this.options.id] = this;
			//
			this.options.wrapper = document.createElement("div");
			this.options.wrapper.setAttribute("data-type", this.options.type); 
			this.options.wrapper.setAttribute("id", this.options.id);
			this.options.wrapper.setAttribute("class", "dialogWindow on " + this.options.classList);
			this.options.wrapper.setAttribute("style", "z-index:"+this.options.zIndex);

			this.options.wrapper.innerHTML = iTemplate.makeList(dialogHTML, [this.options], function(k,v){});
			parent.container.insertBefore(this.options.wrapper, this.options.cover?parent.cover:null);
			//
			if(this.options.btns.length){
				var that = this;
				var btnBox = document.createElement("div");
					btnBox.setAttribute("class", "box");
					for(var j=0,cj; cj=this.options.btns[j]; j++){
						(function(cj){
							var btn = document.createElement('a');
							btn.setAttribute("href","javascript:;");
							btn.setAttribute("class", "dialogBtn");
							btn.innerHTML = cj.name;
							if(cj.fn){
								btn.onclick = function(){
									cj.fn.call(this, that);
								}
							}
							var div = document.createElement("div");
							div.appendChild(btn);
							btnBox.appendChild(div);
						})(cj);

					}
				this.options.wrapper.querySelectorAll("footer")[0].appendChild(btnBox);
			}
			return this;
		},
		show: function(){
			var cl = this.options.wrapper.classList;
			cl.add("on");
			return this;
		},
		hide: function(){
			var cl = this.options.wrapper.classList;
			cl.remove("on");
			return this;
		},
		die: function(){
			var that = this;
			this.hide();
			setTimeout(function(){
				delete parent.list[that.options.id];
				parent.container.removeChild(that.options.wrapper);
			}, 300);
			return this;
		}
	}

	//
	dialog.merge = function(orgObj, newObj, cover){
		for(var k in newObj){orgObj[k] = newObj[k];}
		return orgObj;
	}
	return dialog;
})();



/*第三方插件：html模板生成器*/
var iTemplate = (function(){
	var template = function(){};
	template.prototype = {
		makeList: function(tpl, json, fn){
			var res = [], $10 = [], reg = /{(.+?)}/g, json2 = {}, index = 0;
			for(var el in json){
				if(typeof fn === "function"){
					json2 = fn.call(this, el, json[el], index++)||{};
				}
				res.push(
					 tpl.replace(reg, function($1, $2){
					 	return ($2 in json2)? json2[$2]: (undefined === json[el][$2]? json[el]:json[el][$2]);
					})
				);
			}
			return res.join('');
		}
	}
	return new template();
})();