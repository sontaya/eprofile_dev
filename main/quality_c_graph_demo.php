<?
include('../graph/phpgraphlib.php');
include('../graph/phpgraphlib_pie.php');
require_once("../includes/config.inc.php");
	$num1_all = 50;
	$num2_all = 62;
	$num3_all = 77;
	$num4_all = 47;
	$num5_all = 51;
	$num6_all =  45;
	
/*	echo $t1 = ($num1_all/$total)*100; echo "<br />";
	echo $t2 = ($num2_all/$total)*100; echo "<br />";
	echo $t3 = ($num3_all/$total)*100; echo "<br />";
	echo $t4 = ($num4_all/$total)*100; echo "<br />";
	echo $t5 = ($num5_all/$total)*100; echo "<br />";
	echo $t6 = ($num6_all/$total)*100;*/
	
	 /*$t1 = ($num1_all/$total)*100; 
	 $t2 = ($num2_all/$total)*100; 
	 $t3 = ($num3_all/$total)*100; 
	 $t4 = ($num4_all/$total)*100; 
	 $t5 = ($num5_all/$total)*100; 
	 $t6 = ($num6_all/$total)*100;*/

$data['A'] = $num1_all;
$data['B'] = $num2_all;
$data['C'] = $num3_all;
$data['D'] = $num4_all;
$data['E'] = $num5_all;
$data['F'] = $num6_all;

$graph = new PHPGraphLib(500,350);
$graph->setXValuesHorizontal(true);
$graph->addData($data);
$graph->setDataValues(true); // ใส่ตัวเลขไว้บนแท่งกราฟ
$graph->setBarColor('purple');
$graph->setBackgroundColor("#fff");
$graph->createGraph();
	


?>