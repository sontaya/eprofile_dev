var data_maste;
function createAjax() 
{
    var request = false;
        try {
            request = new ActiveXObject('Msxml2.XMLHTTP');
        }
        catch (err2) {
            try {
                request = new ActiveXObject('Microsoft.XMLHTTP');
            }
            catch (err3) {
		try {
			request = new XMLHttpRequest();
		}
		catch (err1) 
		{
			request = false;
		}
            }
        }
    return request;
}

function doajax(mydata){
	var ajax1=createAjax(); 
	ajax1.onreadystatechange=function(){
		if(ajax1.readyState==4 && ajax1.status==200){
			//alert(ajax1.responseText);
			autocomplete_maste_return(ajax1.responseText);
		}else{
			return false;
		}
	}
	ajax1.open("POST","./../master/autocomplete_maste.php",true);
	ajax1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
	ajax1.send("table=SDU_REF_EXPERT&find_data=0");
}

function autocomplete_maste(tb,fd){
	doajax();
	
}

function autocomplete_maste_return(data_return){
	alert(data_return);
	data_maste=data_return;
	return data_maste;
}
