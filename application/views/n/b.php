<?php
## 보광 연동 ##
//모바일 세트권 인터페이스
echo "111";
#$conn_sparo2 = mysql_connect('115.68.42.7','rubysoft','rubyonrails');
$conn_sparo2 = mysql_connect('52.78.138.84','cmsdb','wsoqb?^NRl#PJluzxa3');
mysql_select_db('spadb',$conn_sparo2);
mysql_query("set names euckr",$conn_sparo2);

$db2 = mysql_connect('115.68.42.14','rubysoft','rubyonrails');
mysql_select_db('terp_placem',$conn_pcms);

$conn_cms = mysql_connect('115.68.42.2','spadb','sspp@4712!');
mysql_select_db('pcmsdb',$conn_cms);
mysql_query('set names utf8',$conn_cms);


//블루캐니언 휘닉스파크 상품 로드
$lmsqry="SELECT * FROM pcmsdb.phoenix_items WHERE state = 'Y' and selldate >= DATE(NOW())";
mysql_query('set names utf8',$conn_cms);
$lmsres=mysql_query($lmsqry,$conn_cms);
$pc = array();

while($lmsrow = mysql_fetch_array($lmsres)){
    $pc[] = "'$lmsrow[item_id]'";
}

$bargu = implode ($pc,',');

echo $bargu;
#########################################################################################################################################
# smsgu = 'N' 이면 연동 시작, 재발송 안함
# '20170714_N1865180', '20170714_N1865181', '20170714_N1865182'
#########################################################################################################################################

$mdate = date("Y-m-d");
$tdate = date("Ymd");

$ordqry="SELECT *,AES_DECRYPT(UNHEX(hp),'Wow1daY') dhp  FROM `ordermts` WHERE itemmt_id in ($bargu) 
AND (smsgu is null or smsgu ='N' or smsgu ='0')
AND state = '예약완료'
AND usegu = '2' 
AND usedate >= DATE(NOW())
AND ch_id = 2984
limit 100";//order by 삭제

/*
$ordqry="SELECT *,AES_DECRYPT(UNHEX(hp),'Wow1daY') dhp  FROM `ordermts` WHERE itemmt_id in ($bargu)
AND orderno = '20170209_00006'
limit 100";//order by 삭제
*/

$ordres=mysql_query($ordqry,$conn_sparo2);
$i=1;
while($row = mysql_fetch_array($ordres)){

    echo $bsql="select id,no from bg_ordermts where ordermt_id = $row[id]";
    $bres=mysql_query($bsql,$conn_sparo2);
    $bcnt=mysql_num_rows($bres);

    if($bcnt > 0){
        #기존 주문 있을때 smsgu= 'Y' 업데이트 후 종료
        echo "\nFind ordermt_id {$row[id]}";
        echo "\nbarcode_no=".$brow['no'];

        echo $ordb = "update ordermts set smsgu = 'Y' where id = '{$row[id]}' limit 1";
        echo "\n";
        mysql_query($ordb,$conn_sparo2);

    }else{
        echo "\nstart ==============\n";
        $usedate = $row['usedate']; //이용일자	이용일 또는 만료일
        $item_id = $row['itemmt_id'];

        $itemqry="SELECT * FROM pcmsdb.phoenix_items WHERE state = 'Y' and selldate >= DATE(NOW()) and item_id = '{$item_id}'";
        $itemres=mysql_query($itemqry,$conn_cms);
        $itemrow = mysql_fetch_array($itemres);

        $synctype = $itemrow['synctype'];

        $omname = stripslashes(iconv("UTF-8","EUC-KR",$itemrow['ITEMNAME']));

        $prifixcode = $itemrow['prifix'];
        $typecd = $itemrow['typecd'];
        $seasoncd = $itemrow['seasoncd'];

        if($synctype == 'SET'){
            $qty = 1;
        }else{
            $qty = $row[man1];
        };

        $cnt1 = $itemrow['cnt1'] * $qty;
        $cnt2 = $itemrow['cnt2'] * $qty;
        $cnt3 = $itemrow['cnt3'] * $qty;
        $cnt4 = $itemrow['cnt4'] * $qty;
        $cnt5 = $itemrow['cnt5'] * $qty;
        $cnt6 = $itemrow['cnt6'] * $qty;
        $cnttot = $cnt1+ $cnt2+ $cnt3+ $cnt4+ $cnt5+$cnt6; //총구입수량
        $totamt =  $itemrow['amt'] * $qty;


        switch($synctype){

            case 'SIN' :
                // 난수 번호 생성
                /*
                $number = rand(2,99999);
                $pcode=str_pad($number, 5, "0", STR_PAD_LEFT);
                $barkey=$prifixcode.$pcode."0";
                */
                $barkey=$row['barcode_no'];

                $bsql="select id from bg_ordermts where no = '$barkey' limit 1";
                $bres=mysql_query($bsql,$conn_sparo2);
                $bcnt=mysql_num_rows($bres);

                if($bcnt>0){
                    echo "\nDuplicate Barcode = {$barkey}\n";
					continue; //있는 바코드면 여기까지
				}

                echo $isql="insert bg_ordermts set 
						Created_at=now(),
						chnm='$row[chnm]',
						jpmt_id='$jpmt_id',
						divs = '$synctype',
						typecd='$typecd',
						seasoncd='$seasoncd',
						om_id='$omcode',
						omname='$omname',
						qty='$row[man1]',
						usedate='$usedate',
						use_sdate='$usesdate',
						use_edate='$useedate',
						no='$barkey',
						totamt='$totamt',
						tcode='',
						cnttot='$cnttot',
						cnt1='$cnt1',
						cnt2='$cnt2',
						cnt3='$cnt3',
						cnt4='$cnt4',
						cnt5='$cnt5',
						cnt6='$cnt6',
						orderno='$row[orderno]',
						ordermt_id='$row[id]',
						usernm='$row[usernm]',
						hp='$row[dhp]',
						item_id = '$row[itemmt_id]',
						mms = 'Y',
						saledate='".date("YmdHis")."'";
                echo "\n";
                if(mysql_query($isql,$conn_sparo2)){

                    echo $ordb = "update ordermts set smsgu = 'Y' where id = '{$row[id]}' limit 1";
                    echo "\n";
                    mysql_query($ordb,$conn_sparo2);

                    echo " $seasoncd / $row[itemmt_id] / $row[man1] / $row[usernm]\n";
                }else{
                    echo "업데이트 실패\n";
                }
                break;
            case 'SET' :
                //세트권은 구매 수량만큼 주문을 넣습니다.
                //세트권 정보
                $typecode = $itemrow['typecode'];
                $tcode	= $itemrow['tcode'];
                $man1 = $row[man1];
                echo "man1=".$man1."\n";

                $barkey=$row['barcode_no'];

                $bsql="select id from bg_ordermts where no = '$barkey' limit 1";
                $bres=mysql_query($bsql,$conn_sparo2);
                $bcnt=mysql_num_rows($bres);

                if($bcnt>0){
                    echo "\nDuplicate Barcode = {$barkey}\n";
					continue; //있는 바코드면 여기까지
				}

                echo $isql="insert bg_ordermts set 
				Created_at=now(),
				chnm='$row[chnm]',
				divs = 'SET',
				omname='$omname',
				qty='$cnttot',
				usedate='$usedate',
				use_sdate='$usesdate',
				use_edate='$useedate',
				no='$barkey',
				totamt='$totamt',
				typecode ='$typecode',
				tcode='$tcode',
				cnttot='$cnttot',
				cnt1='$cnttot',
				orderno='$row[orderno]',
				ordermt_id='$row[id]',
				usernm='$row[usernm]',
				hp='$row[dhp]',
				item_id = '$row[itemmt_id]',
				mms = 'Y',
				saledate='".date("YmdHis")."'";
                echo "\n";

                $res = mysql_query($isql,$conn_sparo2);

                if($barkey != ""){
                    echo $ordb = "update ordermts set smsgu = 'Y' where id = '{$row[id]}' limit 1";
                    echo "\n";
                    mysql_query($ordb,$conn_sparo2);
                    echo " $seasoncd / $row[itemmt_id] / $row[man1] / $row[usernm] / $barkey \n";
                }else{
                    echo "업데이트 실패\n";
                }

                break;

        }
    }

}








?>
