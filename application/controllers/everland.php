<?php 

class Everland extends CI_Controller { 

	function __construct() {
		parent::__construct();
		if (!(($this->uri->segment(3) == 'login') || ($this->uri->segment(3) == 'login_ok')))
			$this->is_logged_in();
	} 
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
	
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			redirect('/sys/login');
			die();
		}
	}

	function count($mode='')
    {
        $monthdate = date("Y-m-d",strtotime ("-3 months"));
        $this->bar = $this->load->database('bar', TRUE);
        $viewtable = false;
        
        $where = "";
        $total = 0;

        if ($mode == 'new')
        {
            $data['param'] = '^^^^^^^^^^^^^^^^^^^^';
            $this->session->set_userdata($data);
        }

        $param = $this->session->userdata('param');
        if($param != '' && $param != NULL){
        	$paramarr = explode('^',$param);
        	$searchtxt = $paramarr[0];
        	$sdate = $paramarr[1];
        	$edate = $paramarr[2];
        	$sdatepost = $paramarr[1];
        	$edatepost = $paramarr[2];
        }
        

        if($searchtxt != '' && $searchtxt != NULL){	
            $viewtable = true;

            $sql = "
			SELECT
			if(substr(gu,1,1) = 'P','플레이스엠',
				if(substr(gu,1,1) = 'W','위메프',
				if(substr(gu,1,1) = 'T','티몬',
				if(substr(gu,1,1) = 'C','쿠팡',
            	if(substr(gu,1,1) = 'N','네이버',gu)
			)))) ggu
			, sum(if(useyn ='Y',1,0)) use_cnt
			, sum(if(useyn ='N',1,0)) unuse_cnt
			, sum(if(useyn ='C',1,0)) cancel_cnt
			,count(gu) total
			FROM `barev_2014`
			WHERE no LIKE 'S".$searchtxt."%'
			AND syncresult is not null 
			";

            $date_arr = "";
            
            if($sdate != '' || $sdate != null){
	            $date_arr = explode("/",$sdate);
	            $sdate = $date_arr[2]."-".$date_arr[0]."-".$date_arr[1];
	            $sql .= " AND usedate > '$sdate 00:00:00' ";

            }
            if($edate != '' || $edate != null){
            	$date_arr = explode("/",$edate);
            	$edate = $date_arr[2]."-".$date_arr[0]."-".$date_arr[1];
            	$sql .= " AND usedate < '$edate 23:59:59' ";
            	
            }

             $sql .=" group by gu ";
            //echo $sql;
            
            $query = $this->bar->query($sql);
            $total = $query -> num_rows();
            $data['query'] = $query;

        }
        $data['sdate'] = $sdatepost;
        $data['edate'] = $edatepost;
        $data['total'] = $total;
        $data['searchtxt']=$searchtxt;
        $data['viewtable'] = $viewtable;
    	$data['title'] = '판매/사용 현황';
    	$data['contentview'] = '/everland/count';
    	$data['leftview'] = 'left';
    	$data['topview'] = 'head';
    	$data['bottomview'] = 'bottom';
    	$this->load->view('/inc/layout',$data);
    }

    function ev_ser()
    {
       	$this->searchtxt = trim($this->input->post('searchtxt')); //노출채널(채널검색해서 중복입력)
        $this->sdate = trim($this->input->post('sdate'));
        $this->edate = trim($this->input->post('edate'));
        $paramarr = array($this->searchtxt,$this->sdate,$this->edate);         
        $data['param'] = implode('^',$paramarr);
        $this->session->set_userdata($data);
        $this->count();
    }

    
	function get_curl($url,$ch) { 
	    $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)'; 
	    //$ch = curl_init (); 
	    curl_setopt ($ch, CURLOPT_URL,             $url); 
	    curl_setopt ($ch, CURLOPT_HEADER,          0); 
	    curl_setopt ($ch, CURLOPT_RETURNTRANSFER,  1); 
	    curl_setopt ($ch, CURLOPT_POST,            0); 
	    curl_setopt ($ch, CURLOPT_USERAGENT,       $agent); 
	    curl_setopt ($ch, CURLOPT_REFERER,         ""); 
	    curl_setopt ($ch, CURLOPT_TIMEOUT,         3); 
	
	    $buffer = curl_exec ($ch); 
	    $cinfo = curl_getinfo($ch); 
	    curl_close($ch); 
	
	    if ($cinfo['http_code'] != 200) 
	    { 
	        return ""; 
	    } 
	
	    return $buffer; 
	}

    function coupon()
    {
        $data['title'] = '에버랜드 쿠폰 조회';
        $data['contentview'] = '/everland/coupon';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }

    function coupon_search(){
        $this->load->model('cmsmodel');
        $this->load->model('nsparomodel');
        $this->load->model('chapimodel');
        $this->barcodetxt = $this->input->post('barcodetxt');

        $barcodearr =explode("\n",$this->barcodetxt);
        $resultMSG = "처리 결과";
        foreach($barcodearr as $bar){
            //$resultMSG .= $bar;
            if($bar) {
                $bar = trim($bar);
                $row = $this->nsparomodel->get_pcms_extcoupon($bar);
                if ($row) {
                    $resultMSG .= "\n{$bar}\t주문일자:{$row->date_order}\t사용유무:{$row->state_use}\t사용일자:{$row->date_use}\t취소일자:{$row->date_cancel}";
                } else {
                    $row = $this->chapimodel->get_cms_extcoupon($bar);
                    if ($row) {
                        $resultMSG .= "\n해외B2B {$bar}\t주문일자:{$row->date_order}\t사용유무:{$row->state_use}\t사용일자:{$row->date_use}\t취소일자:{$row->date_cancel}";
                    } else {
                        $resultMSG .= "\n" . $bar . "/조회불가";
                    }
                }
            }

        }
        echo $resultMSG;
    }

    function coupon_sync()
    {
        $data['title'] = '에버랜드 쿠폰 조회 (에버랜드 전산)';
        $data['contentview'] = '/everland/coupon_sync';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }

    function sticket()
    {
        $data['title'] = '에버랜드 쿠폰 조회 (에버랜드 전산)';
        $data['contentview'] = '/everland/sticket';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }

    function sticket_sync_everland()
    {
        $this->load->model('cmsmodel');
        $this->sparo2 = $this->load->database('sparo2', TRUE);
        $this->bar = $this->load->database('bar', TRUE);
        $this->chapi = $this->load->database('chapi', TRUE);

        $this->code = $this->input->post('code');


        $this->load->library('syncEverland');
        $searchRes = json_decode($this->synceverland->GetSync($this->code));    //쿠폰 상태 조회

        //echo "<legend>";
        if($searchRes->RCODE == 'S'){
            echo "<legend>에버랜드 조회성공 : {$this->code} 쿠폰상태 ->".$searchRes->RMSG."(".$searchRes->PIN_STATUS.")</legend>";
        }else{
            echo "<legend>에버랜드 조회실패 : {$this->code} </legend>";
        }

        switch ($searchRes->PIN_STATUS){
            //사용
            case 'UC':
            case 'UR':
                $sql = "update spadb.pcms_extcoupon set state_use = 'Y',date_use = now() WHERE couponno = '{$this->code}' and state_use != 'Y' limit 1";
                $this->sparo2->query($sql);

                $sql = "update pcmsdb.cms_extcoupon set state_use = 'Y',date_use = now() WHERE no_coupon = '{$this->code}' and state_use != 'Y' limit 1";
                $this->db->query($sql);

                $bsql = "update spadb.barev_2014 set useyn = 'Y',usedate = now() WHERE no = '{$this->code}' and useyn != 'Y' limit 1";
                $this->bar->query($bsql);

                $bbsql = "update cmsdb.cms_extcoupon set state_use = 'Y',date_use = now() WHERE no_coupon = '{$this->code}' and state_use != 'Y' limit 1";
                $this->chapi->query($bbsql);

                break;
            //구매취소

            case 'PC':

                $sql = "update spadb.pcms_extcoupon set state_use = 'C',date_cancel = now() WHERE couponno = '{$this->code}' and state_use != 'C' limit 1";
                $this->sparo2->query($sql);

                $sql = "update pcmsdb.cms_extcoupon set state_use = 'C',date_cancel = now()  WHERE no_coupon = '{$this->code}' and state_use != 'C' limit 1";
                $this->db->query($sql);

                $bsql = "update spadb.barev_2014 set useyn = 'C',canceldate = now() WHERE no = '{$this->code}' and useyn != 'C' limit 1";
                $this->bar->query($bsql);

                $bbsql = "update cmsdb.cms_extcoupon set state_use = 'C',date_cancel = now()  WHERE no_coupon = '{$this->code}' and state_use != 'C' limit 1";
                $this->chapi->query($bbsql);

                break;
            //미사용

            case 'PS':
            case 'CR':

                $sql = "update spadb.pcms_extcoupon set state_use = 'N' WHERE couponno = '{$this->code}' and state_use != 'N' limit 1";
                $this->sparo2->query($sql);

                $sql = "update pcmsdb.cms_extcoupon set state_use = 'N' WHERE no_coupon = '{$this->code}' and state_use != 'N' limit 1";
                $this->db->query($sql);

                $bsql = "update spadb.barev_2014 set useyn = 'N' WHERE no = '{$this->code}' and useyn != 'N' limit 1";
                $this->bar->query($bsql);

                $bbsql = "update cmsdb.cms_extcoupon set state_use = 'N' WHERE no_coupon = '{$this->code}' and state_use != 'N' limit 1";
                $this->chapi->query($bbsql);
                break;
        }
    }


    function coupon_sync_everland()
    {
        $this->load->model('cmsmodel');
        $this->bar = $this->load->database('bar', TRUE);
        $this->chapi = $this->load->database('chapi', TRUE);


        $this->code = $this->input->post('code');

        $row = $this->cmsmodel->get_cms_extcoupon($this->code);
        if ($row) {

            echo "<legend>";
            //echo $this->code." : 조회성공<br/>";
            echo "플레이스엠 조회 결과<br/>{$this->code} 주문일자:{$row->date_order}\t사용유무:{$row->state_use}\t사용일자:{$row->date_use}\t취소일자:{$row->date_cancel}";
            echo "</legend>";
            $url = "https://api.placem.co.kr/foreigner/ev.php?pc=CP&no=".$this->code;
            $xml = simplexml_load_file($url);

            if($xml->RCODE == 'S'){
                echo "<legend>에버랜드 조회성공 : 쿠폰상태 ->".$xml->RMSG."(".$rtn_msg=$xml->PIN_STATUS.")</legend>";
            }else{
                echo "<legend>에버랜드 조회실패</legend>";
            }

            switch ($rtn_msg=$xml->PIN_STATUS){
                //사용
                case 'UC':
                case 'UR':
                    $sql = "update spadb.pcms_extcoupon set state_use = 'Y',date_use = now() WHERE couponno = '{$this->code}' and state_use != 'Y' limit 1";
                    $this->sparo2->query($sql);

                    $sql = "update pcmsdb.cms_extcoupon set state_use = 'Y',date_use = now() WHERE no_coupon = '{$this->code}' and state_use != 'Y' limit 1";
                    $this->db->query($sql);

                    $bsql = "update spadb.barev_2014 set useyn = 'Y',usedate = now() WHERE no = '{$this->code}' and useyn != 'Y' limit 1";
                    $this->bar->query($bsql);

                    $bbsql = "update cmsdb.cms_extcoupon set state_use = 'Y',date_use = now() WHERE no_coupon = '{$this->code}' and state_use != 'Y' limit 1";
                    $this->chapi->query($bbsql);

                break;
                //구매취소

                case 'PC':

                    $sql = "update spadb.pcms_extcoupon set state_use = 'C',date_cancel = now() WHERE couponno = '{$this->code}' and state_use != 'C' limit 1";
                    $this->sparo2->query($sql);

                    $sql = "update pcmsdb.cms_extcoupon set state_use = 'C',date_cancel = now()  WHERE no_coupon = '{$this->code}' and state_use != 'C' limit 1";
                    $this->db->query($sql);

                    $bsql = "update spadb.barev_2014 set useyn = 'C',canceldate = now() WHERE no = '{$this->code}' and useyn != 'C' limit 1";
                    $this->bar->query($bsql);

                    $bbsql = "update cmsdb.cms_extcoupon set state_use = 'C',date_cancel = now()  WHERE no_coupon = '{$this->code}' and state_use != 'C' limit 1";
                    $this->chapi->query($bbsql);

                break;
                //미사용

                case 'PS':
                case 'CR':

                $sql = "update spadb.pcms_extcoupon set state_use = 'N' WHERE couponno = '{$this->code}' and state_use != 'N' limit 1";
                $this->sparo2->query($sql);

                $sql = "update pcmsdb.cms_extcoupon set state_use = 'N' WHERE no_coupon = '{$this->code}' and state_use != 'N' limit 1";
                    $this->db->query($sql);

                    $bsql = "update spadb.barev_2014 set useyn = 'N' WHERE no = '{$this->code}' and useyn != 'N' limit 1";
                    $this->bar->query($bsql);

                    $bbsql = "update cmsdb.cms_extcoupon set state_use = 'N' WHERE no_coupon = '{$this->code}' and state_use != 'N' limit 1";
                    $this->chapi->query($bbsql);
                break;
            }

            /*
             *  S|UC|사용완료
                S|PC|구매취소
                S|PS|구매완료
                S|UR|사용완료요청
                S|CR|반환
             */

            $row = $this->cmsmodel->get_cms_extcoupon($this->code);
            if ($row) {
                echo "<legend>에버랜드 -> 플레이스엠 처리결과<br/>";
                echo "{$this->code} 주문일자:{$row->date_order}\t사용유무:{$row->state_use}\t사용일자:{$row->date_use}\t취소일자:{$row->date_cancel}</legend>";
            }
        }else{
            echo $this->code." : 조회불가<br/>";
        }

    }
    
    

	
} 


?>