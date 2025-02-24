<?php
require_once("./lib/dbconn.conf.php");
mysql_query('set names utf8',$conn_cms);

//PCMS 수수료 테이블 조회
$divsql = "select * from terp_placem.divmts where 1 order by id";
$divres = mysql_query($divsql,$conn_pcms);

while($divrow = mysql_fetch_array($divres)){

	// 중복 확인
	$cpsql = "select * from CMSDB.CMS_RATE where rate_id = '$divrow[id]' limit 1";
	$cpres = mysql_query($cpsql,$conn_cms);
	$cpcnt = mysql_num_rows ( $cpres );
//	$cprow = mysql_fetch_array($cpres);

	//중복확인
	if($cpcnt == 0){

		if($divrow['id'] != "" && $divrow['id'] != null){

			$ratesql = "insert CMSDB.CMS_RATE set 
							rate_id = '{$divrow['id']}',
							rate_regdate = '{$divrow['created_at']}',
							rate_moddate = '{$divrow['updated_at']}',
							rate_cpid = '{$divrow['grmt_id']}',
							rate_cpnm = '{$divrow['grnm']}',
							rate_itemid = '{$divrow['itemmt_id']}',
							rate_value = '{$divrow['rate']}'";

			mysql_query($ratesql,$conn_cms);
			echo "{$divrow['id']} {$divrow['grmt_id']} {$divrow['grnm']} {$divrow['itemmt_id']} {$divrow['rate']}\n";
		}else{
			echo $itemid."err divrow={$divrow[id]}\n";
		}

	}
	


}



?>