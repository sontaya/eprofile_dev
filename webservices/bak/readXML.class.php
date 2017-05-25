<?
class readXML {
	
	var $xml;
	var $dataXML;
	
	function readXML(){
		$this->xml = new DOMDocument();
	}
	
	function loadXML($file){
		//print $file;
		$this->xml->load($file);
		$this->dataXML=$this->xml->getElementsByTagName("REC");
	}	
	
	function read(){
		foreach( $this->dataXML as $xml_data ){
			 $value[0]=$xml_data->getElementsByTagName("EMP_ID")->item(0)->nodeValue;
 			 $value[1]=$xml_data->getElementsByTagName("REC_ID")->item(0)->nodeValue;
			 print $value[0]."-".$value[1]."<br>";
		}
	}
}

//

$xml = new readXML();
$xml->loadXML("res_fnd.xml");
$xml->read();
?>