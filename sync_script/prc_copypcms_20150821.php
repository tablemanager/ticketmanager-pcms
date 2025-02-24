<?php
require_once("./lib/dbconn.conf.php");
mysql_query('set names utf8',$conn_cms);

$itemsql = "select * from terp_placem.itemmts order by id desc";
$itemres = mysql_query($itemsql,$conn_pcms);

while($itemrow = mysql_fetch_array($itemres)){

	if($itemrow['visible'] == "1") $useyn ="Y";
		else $useyn ="N"; 
	

	// 대리점 확인
 	$cpsql = "select * from CMSDB.CMS_COMPANY where com_id = '$itemrow[grmt_id]' and com_type='S' limit 1";
	$cpres = mysql_query($cpsql,$conn_cms);
	$cprow = mysql_fetch_array($cpres);

	if(!$cprow['com_id']){

		$cptsql = "select * from terp_placem.grmts where id = '$itemrow[grmt_id]' limit 1";
		$cptres = mysql_query($cptsql,$conn_pcms);		
		$cprow = mysql_fetch_array($cptres);

		switch($cprow['gu']){
			case '판매채널':
				$cptype = "C";
			break;
			case '시설':
				$cptype = "F";
			break;
			case '대리점':
				$cptype = "S";
			break;
		}

		if($cprow['visible'] == "1") $useyn ="Y";
			else $useyn ="N"; 

		$ccpsql = "insert CMSDB.CMS_COMPANY set 
						com_id = '$cprow[id]',
						com_nm = '$cprow[nm]',
						com_type = '$cptype',
						com_state = '$useyn'";	
		echo mysql_query($ccpsql,$conn_cms);
	
	}


	// 시설 확인

	$jpsql = "select * from CMSDB.CMS_FACILITIES where fac_id = '$itemrow[jpmt_id]' limit 1";
	$jpres = mysql_query($jpsql,$conn_cms);
	$jprow = mysql_fetch_array($jpres);

	if(!$jprow['fac_id']){
		$jptsql = "select * from terp_placem.grmts where id = '$itemrow[jpmt_id]' limit 1";
		$jptres = mysql_query($jptsql,$conn_pcms);
		$jptrow = mysql_fetch_array($jptres);	
			if($jptrow['visible'] == "1") $useyn ="Y";
				else $useyn ="N"; 

		$ccpsql2 = "insert CMSDB.CMS_FACILITIES set 
						fac_id = '$jptrow[id]',
						fac_nm = '$jptrow[nm]',
						fac_state = '$useyn'";

		mysql_query($ccpsql2,$conn_cms);
	}

	
	//상품 입력

	$itemtsql = "select * from CMSDB.CMS_ITEMS where item_id = '$itemrow[id]' limit 1";
	$itemtres = mysql_query($itemtsql,$conn_cms);
	$itemtrow = mysql_fetch_array($itemtres);

	if(!$itemtrow['item_id']){

		$itemsql2 = "insert CMSDB.CMS_ITEMS set 
						item_id = '$itemrow[id]',
						item_nm = '$itemrow[nm]',
						item_state = '$useyn',
						item_cpid = '$itemrow[grmt_id]',
						item_facid = '$itemrow[jpmt_id]'";
		mysql_query($itemsql2,$conn_cms);

		echo "$itemrow[id] $itemrow[nm]  / $itemrow[grmt_id] - $itemrow[jpmt_id] \n";
	}

	// 가격 입력,업데이트

}



?>