<?php
require_once("./lib/dbconn.conf.php");
mysql_query('set names utf8',$conn_cms);
//복사할 상품코드
$copycode = "
'7730'

";
//PCMS상품 테이블 조회
$itemsql = "select * from terp_placem.itemmts where id in ($copycode) order by id desc";
$itemres = mysql_query($itemsql,$conn_pcms);

while($itemrow = mysql_fetch_array($itemres)){

	if($itemrow['visible'] == "1") $useyn ="Y";
		else $useyn ="N"; 
	$itemid = $itemrow['id'];
	// 대리점 확인
 	$cpsql = "select * from CMSDB.CMS_COMPANY where com_id = '$itemrow[grmt_id]' and com_type='S' limit 1";
	$cpres = mysql_query($cpsql,$conn_cms);
	$cprow = mysql_fetch_array($cpres);
	
	//중복확인
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

	//중복확인
	if(!$jprow['fac_id']){
		$jptsql = "select * from terp_placem.grmts where id = '$itemrow[jpmt_id]' limit 1";
		$jptres = mysql_query($jptsql,$conn_pcms);
		$jptrow = mysql_fetch_array($jptres);	
			if($jptrow['visible'] == "1") $useyn ="Y";
				else $useyn ="N"; 

		$ccpsql2 = "insert CMSDB.CMS_FACILITIES set 
						fac_id = '$jptrow[id]',
						fac_nm = '$jptrow[nm]',
						fac_state = '$useyn',
						fac_cpid = '$cprow[id]'"; // <- 시설아이디 추가함.

		mysql_query($ccpsql2,$conn_cms);
	}

	
	//상품 입력

	$itemtsql = "select * from CMSDB.CMS_ITEMS where item_id = '$itemrow[id]' limit 1";
	$itemtres = mysql_query($itemtsql,$conn_cms);
	$itemtrow = mysql_fetch_array($itemtres);

	//중복확인
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
		//해당상품 가격정보조회
	$pricesql = "SELECT * FROM `pricemts` WHERE (`saledan` != 0 or `saledan2` != 0 or `gongdan` != 0 or `gongdan2` != 0 or `gongdan2` != 0 or `saipdan`  != 0 or `saipdan2` != 0)
		and itemmt_id = '$itemid'";
	$priceres = mysql_query($pricesql,$conn_pcms);

	while($pricerow = mysql_fetch_array($priceres)){

		$cmsPriceSql = "select * from CMSDB.CMS_PRICES where price_id = '$pricerow[id]' limit 1";
		$cmsPriceres = mysql_query($cmsPriceSql,$conn_cms);
		$cmsPricerow = mysql_fetch_array($cmsPriceres);

		//중복확인
		if(!$cmsPricerow['price_id']){

			echo $insertPriceSql = "insert CMSDB.CMS_PRICES set 
						price_id = '".$pricerow['id']."',
						price_itemid = '".$pricerow['itemmt_id']."',
						price_date = '".$pricerow['yy']."-".$pricerow['mm']."-".$pricerow['dd']."',
						price_normal = '".$pricerow['nordan']."',
						price_sale = '".$pricerow['saledan']."',
						price_in = '".$pricerow['saipdan']."',
						price_out = '".$pricerow['gongdan']."',
						price_qty = '".$pricerow['itemsu']."',
						price_regdate = '".$pricerow['Created_at']."',
						price_moddate = '".$pricerow['Updated_at']."',
						price_state = '".$pricerow['visible']."', 	 
						price_log = 'SYSTEM'";

			mysql_query($insertPriceSql,$conn_cms);

			echo $pricerow['id']."/".$pricerow['itemmt_id']."/".$pricerow['yy']."-".$pricerow['mm']."-".$pricerow['dd']."/".$pricerow['nordan']."/".$pricerow['saledan']."/".$pricerow['saipdan']."/".$pricerow['gongdan']."/".$pricerow['itemsu']."\n";
		}




	}
	



}



?>