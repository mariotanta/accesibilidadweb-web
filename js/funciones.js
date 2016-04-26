

var W3CDOM = (document.createElement && document.getElementsByTagName);

document.getElementsByClassName = function(className, container){
   var data = tags = [];
   var obj = document.getElementById("wrapper");
   var node = aux = null;
	var strClassName = className.replace(/\-/g, "\\-");
    var pattern = new RegExp("(^|\\s)" + strClassName + "(\\s|$)");
	if(container) node = (typeof(container) == "object") ? container : document.getElementById(container);
	else node = (obj) ? obj : document;
	aux = node.getElementsByTagName("*");
	tags = (document.all) ? node.all : aux;
   for(var i=0;i<tags.length;i++) { if(pattern.test(tags[i].className)) data.push(tags[i]);}
   return data;
}

var e = {
	addEvent : function(obj, evType, fn, useCapture){
		if (obj.addEventListener){
			obj.addEventListener(evType, fn, useCapture);
			return true;
		}else if (obj.attachEvent){
			var r = obj.attachEvent("on"+evType, fn);
			return r;
		}else {
			return false;
		}
	}
}

var behaviours = {
	externalLinks:function() { 
		 if (!document.getElementsByTagName) return; 
		 var anchors = document.getElementsByTagName("A"); 
		 for(var i = 0; i < anchors.length; i++){
			   if (anchors[i].getAttribute("href") && 
					anchors[i].getAttribute("rel") == "external") 
					anchors[i].target = "_blank"; 
		 }
	},
	resetInput:function(){
		var obj = document.getElementById("mail");
		obj.onfocus = function(){
			obj.value = "";
		}

	}
}

var curves = {	
	createGeneralCurves:function(){
		var obj = document.getElementById("formContact").getElementsByTagName("span")[1];	
		var cTLeft = cTRight = cBLeft = cBRight = null;
		cTLeft = curves.createElementsCurves("cTLeft");
		cTRight = curves.createElementsCurves("cTRight");
		cBLeft = curves.createElementsCurves("cBLeft");
		cBRight = curves.createElementsCurves("cBRight");
		obj.appendChild(cTLeft);
		obj.appendChild(cTRight);
		obj.appendChild(cBLeft);
		obj.appendChild(cBRight);
	},
	createElementsCurves:function(style){
		var element = document.createElement("div");
		element.className = style + " sp";
		element.appendChild(document.createTextNode(" "));
		return element;
	}


}

var formsValidations = {
	setMsgError:function(txt, form){
		var parentForm = form.parentNode;
		var msgError = document.getElementsByClassName("msgError", parentForm);
		var divElement = (msgError.length != 0) ? msgError[0] : document.createElement("div");		
		var ulElement = document.createElement("ul");
		var liElement = null;		
		var errors = txt.split("|");				
		divElement.className = "msgError"
		if(divElement.getElementsByTagName("ul").length != 0) divElement.removeChild(divElement.getElementsByTagName("ul")[0])
		for(var i = 0; i < errors.length - 1; i++){
			liElement = document.createElement("li");
			liElement.appendChild(document.createTextNode(errors[i]));
			ulElement.appendChild(liElement);
		}
		divElement.appendChild(ulElement);	
		divElement.tabIndex = -1;
		if(msgError.length == 0) parentForm.insertBefore(divElement,form);
		divElement.focus();
	},
	validaContactForm:function() { 
		var f = document.forms.formContact;		
		var errorTxt = "";
		if (f.nombre.value == "") errorTxt += "(!) El campo 'Tu nombre' es obligatorio|";
		if (f.mail.value == "") errorTxt += "(!) El campo 'Tu email' es obligatorio|";		
		if(f.mail.value != "" && !regularExpressions.isValidEmail(f.mail.value)) errorTxt += "(!) El formato del campo 'Tu email' no es correcto|";			
		if (!f.acepto.checked) errorTxt += "(!) Debes aceptar las condiciones legales|";		
		if(errorTxt != ""){	
			formsValidations.setMsgError(errorTxt, document.getElementById("formContact"));
			return false;
		}
	}
}

var regularExpressions = {	
	isValidEmail:function (str){
		var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		return (filter.test(str));
	},	
	esCadena:function(c) { return /^[0-9A-Za-z-\/???,'/\\t\n\r\s]+$/.test(c); }		
}


var load={
	existeId:function(cid){	
		if(document.getElementById(cid)) return true;		
		return false;
	},
	setEvents:function(){		
		behaviours.externalLinks();
		if(load.existeId("formContact")){
			document.getElementById("formContact").onsubmit = formsValidations.validaContactForm;					
			behaviours.resetInput();
			curves.createGeneralCurves();
		}

	}
}



if(W3CDOM) e.addEvent(window, "load", load.setEvents, false);


