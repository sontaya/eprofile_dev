// JavaScript Document

	function IsAcceptKey(sText){
		var ValidChars = "0123456789";
		var IsKey = true;
		var Char;
		for (i = 0; i < sText.length && IsKey == true; i++) {
			Char = sText.charAt(i);
			if (ValidChars.indexOf(Char) == -1) {
				IsKey = false;
			}
		}
		return IsKey;
	}

  function initZone(targetID, selectedValue){

    var objTarget = "#" + targetID;

    $.ajax({
        url: 'json-obj-zone.php',
        type: 'post',
        data: "",
        dataType:'text',
        cache: false,
        success: function (ajaxResult) {
          var jsonProv = ajaxResult;
        
          var vals = $.parseJSON(jsonProv);

          var $objzones = $(objTarget);
          $objzones.empty();

          $objzones.append("<option value=''>--- กรุณาเลือก ---</option>");
          $.each(vals, function(index,value){

            $objzones.append("<option value='"+ value['zone_id'] +"'>" + "["+ value['zone_id'] +"] - "+ value['zone_name'] + "</option>");
            //prov += this['province_name'] + "<br>";
          });
          
        },
        complete: function(){
          setSelectValue(targetID,selectedValue);
        }
    });
  }


  function initProvince(targetID, selectedValue, z){
    var objTarget = "#" + targetID;

    var formData = {
      'z' : z,
    };

    $.ajax({
        url: 'json-obj-province.php',
        type: 'post',
        data: formData,
        dataType:'text',
        cache: false,
        success: function (ajaxResult) {
         
            var jsonProv = ajaxResult;
            var vals = $.parseJSON(jsonProv);

           
            var $objProvinces = $(objTarget);
            $objProvinces.empty();
            $objProvinces.append("<option value=''>--- กรุณาเลือก ---</option>");
            $.each(vals, function(index,value){
            $objProvinces.append("<option value='"+ value['province_id'] +"'>" + "["+ value['province_id'] +"] - "+ value['province_name'] + "</option>");
          
            });
        },
        complete: function(){
          setSelectValue(targetID,selectedValue);
        }
    });
  }

  function initDistrict(targetID, selectedValue, p){
    var objTarget = "#" + targetID;

    var formData = {
      'p' : p,
    };

    $.ajax({
        url: 'json-obj-district.php',
        type: 'post',
        data: formData,
        dataType:'text',
        cache: false,
        success: function (ajaxResult) {
          var jsonDistrict = ajaxResult;
          var prov = '';
          var vals = $.parseJSON(jsonDistrict);

          var $objDistricts = $(objTarget);
          $objDistricts.empty();

          $objDistricts.append("<option value=''>--- กรุณาเลือก ---</option>");
          $.each(vals, function(index,value){

            $objDistricts.append("<option value='"+ value['id_dis'] +"'>" + "["+ value['district_id'] +"] - "+ value['district_name'] + "</option>");
            
            
          });
      
        },
        complete: function(){
          setSelectValue(targetID,selectedValue);
        }
    });
  }

  function initTambon(targetID, selectedValue, id_dis){
    var objTarget = "#" + targetID;

    var formData = {
      'id_dis' : id_dis,
    };

    $.ajax({
        url: 'json-obj-tambon.php',
        type: 'post',
        data: formData,
        dataType:'text',
        cache: false,
        success: function (ajaxResult) {
          var jsonTambon = ajaxResult;
          var prov = '';
          var vals = $.parseJSON(jsonTambon);

          var $objTambons = $(objTarget);
          $objTambons.empty();

          $objTambons.append("<option value=''>--- กรุณาเลือก ---</option>");
          $.each(vals, function(index,value){

            $objTambons.append("<option value='"+ value['id_tam'] +"'>" + "["+ value['tambon_id'] +"] - "+ value['tambon_name'] + "</option>");
            
            
          });
      
        },
        complete: function(){
          setSelectValue(targetID,selectedValue);
        }
    });
  }
  function setSelectValue(targetID, selectedValue){
  
    var objTarget = "#" + targetID;
    $(objTarget).val(selectedValue);
  
  }