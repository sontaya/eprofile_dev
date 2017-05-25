// JavaScript Document
function create_ajax() {
  try { return new XMLHttpRequest(); } catch(e) {}
  try { return new ActiveXObject("Msxml2.XMLHTTP"); } catch(e) {}
  try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} 
  alert("XMLHttpRequest not supported");
  return null;
}

function ajaxGetData(url,data,typeResponse,wait,callback,id,type){
	var ajax = create_ajax();
	var ran = "?ran="+Math.random()+"&";
	url += ran;
	url += data;
	if(ajax){
		if(wait != ""){
				var targetWait = document.getElementById(wait);
				targetWait.innerHTML = "<img src='../images/indicator_medium.gif' align='absmiddle' />";
			}
		ajax.open("GET", url);
		ajax.onreadystatechange = responseGet;
		ajax.send(null);
	}
	function responseGet(){
		
		if(ajax.readyState == 4 && ajax.status == 200){
			if(wait != ""){
				var targetWait = document.getElementById(wait);
				targetWait.innerHTML = "";
			}
				if(typeResponse == "text"){
					callback(ajax.responseText,id,type);
				}else if(typeResponse == "xml"){
					callback(ajax.responseXML);
				}
			
			delete ajax;
			ajax = null;
		}
	}
}

function ajaxPostData(url,data,typeResponse,wait,callback,id,type){
	var ajax = create_ajax();
	var ran = "?ran="+Math.random()+"&";
	url += ran;
	url += data;
	if(ajax){
		if(wait != ""){
				var targetWait = document.getElementById(wait);
				targetWait.innerHTML = "<img src='../images/indicator_medium.gif' align='absmiddle' />";
			}
			
		ajax.open("POST", url);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		
		//ajax.onreadystatechange = responsePost;
		ajax.onreadystatechange = function(){
			if(ajax.readyState == 4 && ajax.status == 200){
				if(wait != ""){
					var targetWait = document.getElementById(wait);
					targetWait.innerHTML = "";
				}//alert(ajax.responseText+'\n'+id+'\n'+type);
					if(typeResponse == "text"){
						//alert(ajax.responseText+'\n'+id+'\n'+type);
						callback(ajax.responseText,id,type);	
					}else if(typeResponse == "xml"){
						callback(ajax.responseXML);
					}
				delete ajax;
				ajax = null;
			}
		};
		ajax.send(data);
	}
	function responsePost(){
		if(ajax.readyState == 4 && ajax.status == 200){
			if(wait != ""){
				var targetWait = document.getElementById(wait);
				targetWait.innerHTML = "";
			}//alert(ajax.responseText+'\n'+id+'\n'+type);
				if(typeResponse == "text"){
					//alert(ajax.responseText+'\n'+id+'\n'+type);
					callback(ajax.responseText,id,type);
				}else if(typeResponse == "xml"){
					callback(ajax.responseXML);
				}
			delete ajax;
			ajax = null;
		}
	}
}

