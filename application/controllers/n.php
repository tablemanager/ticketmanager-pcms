<?php 

class N extends CI_Controller {

	function __construct() {
		parent::__construct();

		$deny_ips = array( "115.90.135.229", "112.169.116.113" , "106.254.252.100","118.131.208.123", "112.169.119.175" ,"118.131.208.124" ,"118.131.208.125" ,"118.131.208.126" ,"14.39.252.223" ,"115.89.22.27","180.69.179.244");

		if(empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
			$ip= $_SERVER["REMOTE_ADDR"].",";
		} else {
			$ip= $_SERVER["HTTP_X_FORWARDED_FOR"];
		}

		$res = explode(",",$ip);

//        if (!in_array ($this->input->ip_address(), $deny_ips)) {
		if (!in_array ($res[0], $deny_ips)) {
			echo $ip."<br>";
			echo "permission error";
			exit;
		}

		$this->cms = $this->load->database('cms', TRUE);
        $this->cms2 = $this->load->database('cms2', TRUE);
		$this->pcms = $this->load->database('pcms', TRUE);
		$this->sparo = $this->load->database('sparo', TRUE);
		$this->sparo2 = $this->load->database('sparo2', TRUE);
		$this->rds = $this->load->database('rds', TRUE);
	} 
	
	function is_logged_in()
	{
		
/*		$is_logged_in = $this->session->userdata('is_logged_in');

		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			redirect('/sys/login');
			die();
		}*/
	}
    function test(){
        echo $_SERVER['REMOTE_ADDR']; 
		echo " - ";
    }
   
    function s_chk(){

        $id = $this->input->post('code');
        $pay_k = $this->input->post('gu');
        $pay_v = $this->input->post('mode');

        $sql = "UPDATE cmsdb.refund SET {$pay_k} = {$pay_v} WHERE id  = '{$id}' " ;
        if($this->rds->query($sql)){
            echo "ok";
        }else{
            echo "err";
        }


    }

    function s_p(){
        ini_set('memory_limit', '1G' );
        ini_set('upload_max_filesize', '400M');
        ini_set('post_max_size', '400M');
        ini_set('max_input_time', 10000);
        ini_set('max_execution_time', 10000);

//        $statearr= array(
//            "P" => "미통화",
//            "E" => "구매 확인불가",
//            "C" => "부재중(문자재발송)",
//            "D" => "미통화/부재중",
//            "B" => "재통화 예정",
//            "Z" => "컴플레인",
//            "R" => "통화완료",
//            "M" => "문자발송완료",
//            "T" => "입금확인중",
//            "S" => "입금확인완료",
//            "J" => "정상환불"
//        );

        $statearr= array(
			"P" => "미통화",
			"R" => "통화완료",
			"D" => "미통화/부재중",
			"C" => "고객통화 후 재통화 부재중",
			"B" => "재통화예정",
			"T" => "입금확인중",
			"U" => "무통장입금예정",
			"S" => "입금확인완료",
			"Z" => "컴플레인",
			"J" => "정상환불"
        );

//        $sql = "SELECT * FROM cmsdb.refund WHERE paygu in ( '신용카드간편결제', '포인트결제' ) and state IN ('T','S')" ;
        $sql = "SELECT * FROM cmsdb.refund WHERE state IN ('T','S')" ;

        $query = $this->rds->query($sql);
        if($query){

            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            $this->excel->getActiveSheet()->setTitle("EXCEL");

            $cnt = 1;

            foreach($query->result() as $row):
                $this->excel->getActiveSheet()->setCellValue('A'.$cnt, $row->id);
                $this->excel->getActiveSheet()->setCellValueExplicit('B'.$cnt, $row->cushp, PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValue('C'.$cnt, $row->price);
                $this->excel->getActiveSheet()->setCellValue('D'.$cnt, $row->paygu);
                $this->excel->getActiveSheet()->setCellValue('E'.$cnt, $statearr[$row->state]);
                $cnt++;
            endforeach;

            $filename= 'ORDEREXCEL.xls'; // 엑셀 파일 이름
            header('Content-Type: application/vnd.ms-excel'); //mime 타입
            header('Content-Disposition: attachment;filename="'.$filename.'"'); // 브라우저에서 받을 파일 이름
            header('Cache-Control: max-age=0'); //no cache

            // Excel5 포맷으로 저장 엑셀 2007 포맷으로 저장하고 싶은 경우 'Excel2007'로 변경합니다.
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
            // 서버에 파일을 쓰지 않고 바로 다운로드 받습니다.
            $objWriter->save('php://output');

        }
    }

    function s_a($mode = ""){
        ini_set('memory_limit', '1G' );
        ini_set('upload_max_filesize', '400M');
        ini_set('post_max_size', '400M');
        ini_set('max_input_time', 10000);
        ini_set('max_execution_time', 10000);

//        $statearr= array(
//            "P" => "미통화",
//            "E" => "구매 확인불가",
//            "C" => "부재중(문자재발송)",
//            "D" => "미통화/부재중",
//            "B" => "재통화 예정",
//            "Z" => "컴플레인",
//            "R" => "통화완료",
//            "M" => "문자발송완료",
//            "T" => "입금확인중",
//            "S" => "입금확인완료",
//            "J" => "정상환불"
//        );
		$statearr= array(
			"P" => "미통화",
			"R" => "통화완료",
			"D" => "미통화/부재중",
			"C" => "고객통화 후 재통화 부재중",
			"B" => "재통화예정",
			"T" => "입금확인중",
			"U" => "무통장입금예정",
			"S" => "입금확인완료",
			"Z" => "컴플레인",
			"J" => "정상환불"
		);

//        $sql = "SELECT * FROM cmsdb.refund WHERE 1" ;

		if ($mode == "ok"){
			$sql = "SELECT a.*, GROUP_CONCAT(b.orders , \"^^\") AS orders FROM refund a LEFT outer JOIN refund_order b ON a.cushp = b.cushp where a.state  = 'S'  GROUP BY a.cushp" ;
		} else {
			$sql = "SELECT a.*, GROUP_CONCAT(b.orders , \"^^\") AS orders FROM refund a LEFT outer JOIN refund_order b ON a.cushp = b.cushp  GROUP BY a.cushp" ;

		}



        $query = $this->rds->query($sql);
        if($query){

            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            $this->excel->getActiveSheet()->setTitle("EXCEL");

            $cnt = 1;

            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(180);

            foreach($query->result() as $row):
                $this->excel->getActiveSheet()->setCellValue('A'.$cnt, $row->id);
                $this->excel->getActiveSheet()->setCellValueExplicit('B'.$cnt, $row->cushp, PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValue('C'.$cnt, $row->price);
                $this->excel->getActiveSheet()->setCellValue('D'.$cnt, $row->paygu);
                $this->excel->getActiveSheet()->setCellValue('E'.$cnt, $statearr[$row->state]);
                $memo = str_replace("<br/>","\r\n",$row->memo);
                $this->excel->getActiveSheet()->setCellValue('F'.$cnt, $memo);


				$_temp_ary = explode("^^",$row->orders);
				$_is_date1 = false;
				$_is_date2 = false;
				$_date_str = "";
				for($ii = 0; $ii < count($_temp_ary);$ii++){
					if ($_temp_ary[$ii] == "20190804"){
						$_is_date1 = true;
					} else if ($_temp_ary[$ii] == "20190818"){
						$_is_date2 = true;
					}
				}

				if ($_is_date1 === true && $_is_date2 === true){
					$_date_str = "1차 , 2차";
				} else if ($_is_date1 === true && $_is_date2 === false){
					$_date_str = "1차";
				} else if ($_is_date1 === false && $_is_date2 === true){
					$_date_str = "2차";
				}

				$this->excel->getActiveSheet()->setCellValue('F'.$cnt,$_date_str);
				$this->excel->getActiveSheet()->getStyle('G'.$cnt)->getAlignment()->setWrapText(true);

                $cnt++;

            endforeach;


            $filename= 'ORDEREXCEL.xls'; // 엑셀 파일 이름
            header('Content-Type: application/vnd.ms-excel'); //mime 타입
            header('Content-Disposition: attachment;filename="'.$filename.'"'); // 브라우저에서 받을 파일 이름
            header('Cache-Control: max-age=0'); //no cache

            // Excel5 포맷으로 저장 엑셀 2007 포맷으로 저장하고 싶은 경우 'Excel2007'로 변경합니다.
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
            // 서버에 파일을 쓰지 않고 바로 다운로드 받습니다.
            $objWriter->save('php://output');

        }
    }
	
	function s($mode=""){
       // $this->output->enable_profiler(TRUE);

        $data['rds'] = $this->rds;
//        $data['statearr'] = array(
//            "P" => "미통화",
//            "E" => "구매 확인불가",
//            "C" => "부재중(문자재발송)",
//            "D" => "미통화/부재중",
//            "B" => "재통화 예정",
//            "Z" => "컴플레인",
//            "R" => "통화완료",
//            "M" => "문자발송완료",
//            "T" => "입금확인중",
//            "S" => "입금확인완료",
//            "J" => "정상환불"
//        );

		$data['statearr'] =  array(
			"P" => "미통화",
			"R" => "통화완료",
			"D" => "미통화/부재중",
			"C" => "고객통화 후 재통화 부재중",
			"B" => "재통화예정",
			"T" => "입금확인중",
			"U" => "무통장입금예정",
			"S" => "입금확인완료",

			"Z" => "컴플레인",
			"J" => "정상환불"
		);

        if($mode == "chk"){
            $sql = "SELECT * FROM cmsdb.refund WHERE chk  = 1 " ;
            $query = $this->rds->query($sql);
            $data['pag_links'] = "이슈발생주문:".$query->num_rows()."건";
        }else if($mode == "calls") {
			$sql = "SELECT * FROM cmsdb.refund WHERE calls  = 1 ";
			$query = $this->rds->query($sql);
			$data['pag_links'] = "관심고객:" . $query->num_rows() . "건";
		} else if ($mode == "oks"){
			$sql = "SELECT * FROM cmsdb.refund WHERE state  = 'S' ";
			$query = $this->rds->query($sql);
			$data['pag_links'] = "입금확인완료:" . $query->num_rows() . "건";
        }else if($mode != ""){
            $sql = "SELECT * FROM cmsdb.refund WHERE state  = '{$mode}' " ;
            $query = $this->rds->query($sql);
            $data['pag_links'] = "입금확인중:".$query->num_rows()."건";

        }else{
            $offset = $this->session->userdata('offset');
            if($offset == '' || $offset == null || $offset == 'demo'){
                $offset = 0;
            }
            $userhp = trim(str_replace("-", "", $this->input->post('userhp')));
            $cusnm = trim(str_replace("-", "", $this->input->post('cusnm')));

            if($cusnm !="" || $cusnm  != null){
                $hsql = "SELECT * FROM cmsdb.refund_order WHERE cusnm  like '%{$cusnm}%' " ;
                $hquery = $this->rds->query($hsql);
                foreach($hquery->result() as $hrow):
                    //echo $hrow->cushp;
                    $pc[] = "'".$hrow->cushp."'";
                endforeach;
                $hparr = implode ($pc,',');
                $sql = "SELECT * FROM cmsdb.refund WHERE cushp  in ({$hparr})" ;
                $query = $this->rds->query($sql);
                $data['pag_links'] = "";
            }else if($userhp !="" || $userhp  != null) {
				$sql = "SELECT * FROM cmsdb.refund WHERE cushp  like '%{$userhp}%' ";
				$data['pag_links'] = "";
				$query = $this->rds->query($sql);
            }else{
                $sql = "SELECT * FROM cmsdb.refund";
                $query = $this->rds->query($sql);
                $total_rows = $query->num_rows();
                $limit = 60;

                $this->load->library('pagination');
                $config['base_url'] = 'http://pcms.placem.co.kr/index.php/n/s_offset';
                $config['total_rows'] =  $total_rows;
                $config['per_page'] = $limit;
                $config['cur_page'] = $offset;
                $config['uri_segment'] = 3;

                $this->pagination->initialize($config);
                page_default_set($config);
                $this->pagination->initialize($config);
                $data['pag_links'] = $this->pagination->create_links();
                $sql .= " order by id asc limit $offset, $limit";
                $query = $this->rds->query($sql);
            }

        }
        $data['query'] = $query;

        $perqry = "SELECT SUM( IF ( state = 'T' or state = 'S' or state = 'O' or state = 'G', 1, 0 ) ) as pcnt
        ,count(*) as allcnt, 
        round(SUM( IF ( state = 'T' or state = 'S' or state = 'O' or state = 'G', 1, 0 ))*100/count(*)) as per,
        FORMAT(SUM( IF ( state = 'T' or state = 'S' or state = 'O' or state = 'G', 1, 0 ))*100/count(*),2) as per2
         FROM `refund` WHERE  paygu is not null";

/*
SELECT
SUM( IF ( state = 'T' or state = 'S' or state = 'O' or state = 'G', 1, 0 ) ) as pcnt,
count(*) as allcnt,
round(SUM( IF ( state = 'T' or state = 'S' or state = 'O' or state = 'G', 1, 0 ))*100/count(*)) as per,
FORMAT(SUM( IF ( state = 'T' or state = 'S' or state = 'O' or state = 'G', 1, 0 ))*100/count(*),2) as per2,

SUM( IF ( state = 'T' or state = 'S' or state = 'O' or state = 'G', price, 0 ) ) as psum,
sum(price) as allsum,
round(SUM( IF ( state = 'T' or state = 'S' or state = 'O' or state = 'G', price, 0 ) )*100/sum(price)) as persum,
FORMAT(SUM( IF ( state = 'T' or state = 'S' or state = 'O' or state = 'G', price, 0 ))*100/sum(price),2) as persum2

FROM `refund` WHERE  paygu is not null
* */

        $data['per']= $this->rds->query($perqry)->row();

		$data['title'] = '네이버 고객 명단';
		$data['contentview'] = '/n/s';
		$data['leftview'] = 'left';
		$data['topview'] = 'head';
		$data['bottomview'] = 'bottom';
		$this->load->view('/inc/k',$data);

	}



    function s_offset($offset = 0)
    {
        $data['offset'] = $offset;
        $this->session->set_userdata($data);
        $this->s();
    }

	function s_mode(){
        $id = $this->input->post('code');
        $gu = $this->input->post('gu');

//        $statearr = array(
//            "P" => "미통화",
//            "E" => "구매 확인불가",
//            "C" => "부재중(문자재발송)",
//            "D" => "미통화/부재중",
//            "B" => "재통화 예정",
//            "Z" => "컴플레인",
//            "R" => "통화완료",
//            "M" => "문자발송완료",
//            "T" => "입금확인중",
//            "S" => "입금확인완료",
//            "J" => "정상환불"
//        );

		$statearr= array(
			"P" => "미통화",
			"R" => "통화완료",
			"D" => "미통화/부재중",
			"C" => "고객통화 후 재통화 부재중",
			"B" => "재통화예정",
			"T" => "입금확인중",
			"U" => "무통장입금예정",
			"S" => "입금확인완료",
			"Z" => "컴플레인",
			"J" => "정상환불"
		);

        $sql = "SELECT * FROM cmsdb.refund WHERE id = {$id}";
        $logrow = $this->rds->query($sql)->row();
        $cip = $_SERVER['REMOTE_ADDR'];
        $log = $logrow->log.$cip."/state={$statearr[$gu]}/".date("Y-m-d H:i:s")."\n";

        $sql = "update cmsdb.refund set state = '{$gu}', log = '{$log}' where id = {$id} limit 1";
        echo $sql;
        if($this->rds->query($sql)){
            echo  "ok";
        }else{
            echo "err";
        }

    }
    function send_sms(){
        $hp = $this->input->post('hp');
        $text = $this->input->post('text');

        $apireq = "http://openapi.placem.co.kr/messages/send/sms";

        $msgarr = array(
            "dstAddr"=>$hp,
            "callBack"=>"15443913",
            "msgSubject"=>"",
            "msgText"=>$text,
            "orderNo"=>"SYSTEM Notice",
            "pinType"=>"",
            "pinNo"=>"",
            "extVal1"=>"",
            "extVal2"=>"",
            "extVal3"=>"",
            "extVal4"=>""
        );

        $msgjson = json_encode($msgarr);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$msgjson);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_URL, $apireq);

        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
//		$info['http_code'] ="200";
        echo $res = $info['http_code'];

        curl_close($ch);

    }



    function get_sms_type(){

        $type = $this->input->post('type');
        $tel = $this->input->post('tel');

		//			$sql = "SELECT * FROM cmsdb.refund_order WHERE cushp  = '{$tel}' " ;
		$sql = "SELECT  COUNT(*) as cnt , SUM(price) AS price , cusnm,  biznm FROM cmsdb.refund_order WHERE cushp  = '{$tel}' GROUP BY biznm " ;
		$query = $this->rds->query($sql);

		$_str = '';
		$_price = 0;
		$_cusnm = "";

		foreach($query->result() as $row):
			if (!empty($row->cusnm)){
				$_cusnm = $row->cusnm;
			}
			$_price = $_price + $row->price;
			$_str .= "".$row->biznm." : " .$row->cnt." 매\n";
		endforeach;


		if($type == "1"){

//			■ 구매 수량 : 대인 0인 / 소인 0인

            $text =
				$_cusnm."고객님!
유선으로 안내드린 천안상록아쿠아피아 이용권 금액 재결제 안내드립니다.
■ 이용시설 : 천안상록아쿠아피아

".$_str."
■ 총 결제금액 :  ".number_format($_price)."원
■ 결제방법 안내
카드결제는 아래 네이버 N예약 결제 링크를 통해 금액 옵션을 선택하여 총 결제금액에 맞춰 재구매 부탁드립니다.

https://booking.naver.com/booking/5/bizes/96823/items/3157608

무통장 입금
[신한은행] 140-008-793313 예금주 : (주)플레이스엠
* 구매자 성함과 입금자 성함이 동일해야 확인이 가능합니다.
번거로운 수고를 끼쳐드려 죄송합니다.
재결제를 완료해주시면 감사의 마음을 담아 아메리카노 쿠폰을 선물로 보내드릴 예정입니다.
바쁘시겠지만 재결제 꼭 부탁드립니다. 감사합니다.
앞으로 더 좋은 상품으로 보답하겠습니다.

★문의전화 : 0226267525
카톡문의 : https://pf.kakao.com/_JUThxl
상담시간 : 09:00~18:00 (점심시간 12:00 ~ 13:00)
";
        }else if($type == "2"){
                $text =
					$_cusnm."고객님! 
우선 바쁘신 가운데 재결제를 진행 해주셔서 진심으로 감사합니다.
고객님께서 구매해주신 금액이 요청드린 총 결제 금액과 일치하지 않아 다시 한번 추가 결제 안내드립니다. 번거로우시겠지만 꼭 부탁드리겠습니다.

■ 재결제 요청 및 입금 확인 내역
    결제 요청 총 금액 : ".number_format($_price)."원
    고객님께서 입금완료해주신 금액 :
■ 재결제 요청 내역
   추가 결제 요청 금액 :

번거로우시겠지만 아래 URL에 접속하셔서 추가 결제 부탁드리겠습니다. 
앞으로 더 좋은 상품으로 보답하겠습니다. 감사합니다.

https://booking.naver.com/booking/5/bizes/96823/items/3157608

★문의전화 : 0226267525
카톡문의 : https://pf.kakao.com/_JUThxl
상담시간 : 09:00~18:00 (점심시간 12:00 ~ 13:00)
";

        }else if($type == "3"){
            $text =
$_cusnm." 고객님!
고객님께서 이용하신 천안상록아쿠아피아 이용권이 착오로 인해 환불승인 되어 연락드렸습니다.
고객님께 불편을 끼쳐드려 죄송합니다.
이용하신 천안상록아쿠아피아 이용권 재결제 방법을 안내드리오니 아래 내용에 따라 재입금 부탁드립니다.

■ 이용시설 : 천안상록아쿠아피아
".$_str."

■ 총 결제금액 :  ".number_format($_price)."원

■ 결제방법 안내
카드결제는 아래 네이버 N예약 결제 링크를 통해 금액 옵션을 선택하여 총 결제금액에 맞춰 재구매 부탁드립니다.

https://booking.naver.com/booking/5/bizes/96823/items/3157608

* 구매자 성함과 입금자 성함이 동일해야 확인이 가능합니다.
번거로운 수고를 끼쳐드려 죄송합니다.
재결제를 완료해주시면 감사의 마음을 담아 아메리카노 쿠폰을 선물로 보내드릴 예정입니다.
바쁘시겠지만 재결제 꼭 부탁드립니다. 감사합니다.
앞으로 더 좋은 상품으로 보답하겠습니다.

★문의전화 : 0226267525
카톡문의 : https://pf.kakao.com/_JUThxl
상담시간 : 09:00~18:00 (점심시간 12:00 ~ 13:00)";
        }
        echo $text;
    }

    function s_memo(){
        $id = $this->input->post('code');
        $nmemo = $this->input->post('nmemo');

        $sql = "SELECT * FROM cmsdb.refund WHERE id = {$id}";
        $logrow = $this->rds->query($sql)->row();
        $cip = $_SERVER['REMOTE_ADDR'];
        $memo= $logrow->memo.$cip."(".date("Y-m-d H:i:s").") : {$nmemo}<br/>";

        $sql = "update cmsdb.refund set memo = '{$memo}' where id = {$id} limit 1";
        if($this->rds->query($sql)){
            echo  $memo;
        }else{
            echo "err";
        }
    }
	

    

	
} 


?>