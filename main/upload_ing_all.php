<?
@session_start();
include "update_by.php";
 	$fpath = '../';
	require_once($fpath."includes/connect.php");
?>
<table>
        <?
        $xxx = explode("|",$_POST["s_id"]);
        $sql_img = "SELECT * FROM  ".TB_SDU_SECTOR_TRANSFER_IMG_TAB." WHERE EMP_ID='".$_SESSION["EMP_ID"]."' AND MAT_ID ='".$xxx[0]."' AND ID_PAGS = '".$xxx[1]."'";
        $sql_img_row = oci_parse($conn, $sql_img);
        oci_execute($sql_img_row);
        while(($img_row = oci_fetch_array($sql_img_row, OCI_BOTH))){ ?>
         <tr>
            <td width="500"><a href="#" onclick="window.open('files/<?=$xxx[2];?>/<?=$img_row["IMG_NAME"];?>','<?=$id?>','height=400,width=500,resizable=1,scrollbars=1')" style="cursor:pointer"><?= $img_row["IMG_NAME"]; ?></a></td>
            <td width="100">&nbsp;&nbsp;&nbsp;<img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" alt="Delete" onclick="del_img('<?=$img_row["IMG_ID"]?>','<?= $_POST["s_id"] ?>')"/></td>
        </tr>
        <? } ?>
        
</table>
