<?
//หากมีการเรียกไฟล์นี้โดยตรง
/*if (eregi("config.in.php",$PHP_SELF)) {
    Header("Location: ../init.php");
    die();
}*/
//error_reporting(E_ALL ^ E_NOTICE);

/*
define("DB_USERNAME","EPROFILE");//oracle username
define("DB_PASSWORD","EPROFILE");// oracle password
define("DB_HOST","localhost/xe"); //ordacle host and global name
define("DB_CHARSET","AL32UTF8");//oracle character set AL32UTF8(UTF-8)
*/

define("DB_USERNAME","SDPERSON");//oracle username
define("DB_PASSWORD","PERSON");// oracle password
define("DB_HOST","10.202.1.112/RSDUE2M"); //ordacle host and global name
define("DB_CHARSET","AL32UTF8");//oracle character set AL32UTF8(UTF-8)

$conn = oci_connect(DB_USERNAME, DB_PASSWORD,DB_HOST,DB_CHARSET);

?>
