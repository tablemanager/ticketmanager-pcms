<?php
require_once("./lib/dbconn.conf.php");
mysql_query('set names utf8',$conn_cms);

#2번으로 복사할때 상품코드를 기준으로 복사함
#상품을 만들지 않았던 시설들이 복사가 안되었기 때문에
#수동으로 복사를 해줘야함
#업체 아이디는 수동으로 입력할 것.

exit;	//<- check!!!!

//PCMS상품 시설
$grmt_id = 361;	//업체 아이디 수동 입력 해야함. (PCMS에 정보 없음)
$jpmtsql = "select * from terp_placem.grmts where nm like '뽀로로%' order by id";
$jpmtres = mysql_query($jpmtsql,$conn_pcms);

while($jpmtrow = mysql_fetch_array($jpmtres)){

	// 시설 확인

	$jpsql = "select * from CMSDB.CMS_FACILITIES where fac_id = '$jpmtrow[id]' limit 1";
	$jpres = mysql_query($jpsql,$conn_cms);
	$jprow = mysql_fetch_array($jpres);

	//중복확인

	if($jpmtrow['visible'] == "1") $fuseyn ="Y";
		else $fuseyn ="N"; 
	
	if($jprow['fac_id'] == "" || $jprow['fac_id'] == null){
		echo $ccpsql2 = "insert CMSDB.CMS_FACILITIES set 
						fac_id = '$jpmtrow[id]',
						fac_nm = '$jpmtrow[nm]',
						fac_state = '$fuseyn',
						fac_cpid = '$grmt_id'"; // <- 시설아이디 추가함.
		mysql_query($ccpsql2,$conn_cms);
	}else{
		echo " inserted id jpmtrow={$jpmtrow['id']}\n";
	}
	

}



?>