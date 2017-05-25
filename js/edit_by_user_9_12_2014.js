function myDisable (obj) {
		//alert(obj);
		//alert('Disable');
		obj.disabled = true;
		//this.disabled = true;
	}
	function o_input() {
	//	alert('o_input');
		var v1 = document.getElementsByTagName('input');//.disabled = false;
		var v2 = document.getElementsByTagName('select');//.disabled = false;
		var v3 = document.getElementsByTagName('textarea');//.disabled = false;
		//alert(v2.length);
		enableObj(v1);
		enableObj(v2);
		enableObj(v3);
	}
	
	function enableObj(obj) {
		//alert(obj.length);
		for(i=0; i<obj.length; i++) {
			obj[i].disabled = false;
			//alert('loop '+i);
		}
	}