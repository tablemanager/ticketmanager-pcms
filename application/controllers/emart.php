<?php 

class Emart extends CI_Controller { 

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

	function code($offset=0){
        $this->sparo2 = $this->load->database('sparo2', TRUE);
        $chnarr = array(
            "" => "선택",
            "AUCT" => "옥션",
            "GMKT" => "지마켓",
            "11ST" => "11번가",
            "OPEN" => "종합몰",
            "TMON" => "티켓몬스터",
            "CPNG" => "쿠팡",
            "WEMP" => "위메프"
        );


        $getdate = date("Y-m-d",strtotime ("-1 months"));

        $sql = "SELECT * FROM spadb.bar_emartcode WHERE selldate >= '$getdate'";

        $query = $this->sparo2->query($sql);


        $total_rows = $query -> num_rows();
        $limit = 20;

        $this->load->library('pagination');
        $config['base_url'] = 'http://pcms.placem.co.kr/index.php/emart/code/';
        $config['total_rows'] =  $total_rows;
        $config['per_page'] = $limit;
        $config['cur_page'] = $offset;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        page_default_set($config);

        $this->pagination->initialize($config);
        $data['pag_links'] = $this->pagination->create_links();

        $sql .= " order by id desc";
        if($offset == 'new'){
            $sql .= " limit 0, $limit";
        }else{
            $sql .= " limit $offset, $limit";
        }

        $query = $this->sparo2->query($sql);

        $data['chnarr'] = $chnarr;
        $data['query'] = $query;
        $data['title'] = '이마트 코드 및 문자관리';

        $data['leftview'] = 'left';
        $data['contentview'] = '/emart/code';
        $this->load->view('/inc/layout',$data);
    }

    function code_add(){
        //$this->sparo2 = $this->load->database('sparo2', TRUE);
        $this->load->model('nsparomodel');

        $this->bigo =$this->input->post('bigo');
        $this->chnpick = $this->input->post('chnpick');
        $this->sort = $this->input->post('sort');
        $this->selldate = $this->input->post('selldate');
        $this->pcmsid = $this->input->post('pcmsid');
        $this->chksms = $this->input->post('chksms');
        $this->qty = $this->input->post('qty');
        $this->smsTXT = $this->input->post('smsTXT');
        if($this->chksms){
            if($this->chnpick == "TMON" || $this->chnpick == "CPNG" || $this->chnpick == "WEMP"  ){
                $this->chksms = 'N';
                $this->smsTXT = NULL;
            }else{
                $this->chksms = 'Y';
            }
        }else{
            $this->chksms = 'N';
            $this->smsTXT = NULL;
        }


        $damnm = $this->session->userdata('nm');
        $manager = $this->session->userdata('cd');
        $this->logtxt = $damnm."(".$manager.") 등록";


        if($this->chnpick == "TMON" || $this->chnpick == "CPNG" || $this->chnpick == "WEMP"  ){
            $this->gu = $this->nsparomodel->bar_emartcode_get_gu($this->chnpick);
        }else{
            $this->gu = "P".$this->pcmsid;
        }



        $this->sellcode = date("Ymd");

        //echo "{$this->bigo} {$this->sellcode} {$this->chnpick} {$this->gu} {$this->sort} {$this->selldate} {$this->pcmsid} {$this->chksms} {$this->chksms} {$this->smsTXT} {$this->logtxt}";

        if($this->nsparomodel->bar_emartcode_insert(
            $this->sellcode,
            $this->gu ,
            $this->pcmsid ,
            $this->chnpick ,
            $this->sort ,
            $this->qty,
            $this->selldate ,
            $this->bigo ,
            "1" ,
            NULL,
            $this->smsTXT,
            $this->chksms ,
            "Y" ,
            $this->logtxt)){
            echo "ok";
        }else{
            echo "err";
        }

    }

    function code_excel($id = ''){
        //echo $select."-".$oid;


        $this->load->model('nsparomodel');
        $code = $this->nsparomodel->get_bar_emartcode($id);    //코드(단일행)
        $coupon = $this->nsparomodel->get_bar_emart($code->sellcode , $code->gu );    //쿠폰(여러행)

        $sort = $this->get_search_string($code->sort);
        $chn = $this->get_search_string($code->chn);
        $bigo = $this->get_search_string($code->bigo);

        //$ITEM_NAME = iconv("UTF-8","EUC-KR",$BuyOrder->ACCOUNT_COMOANY)."_".iconv("UTF-8","EUC-KR",$ITEM_NAME3)."_".$select;
        $ITEM_NAME = $bigo."_".$chn."_".$sort;
        //echo $ITEM_NAME;

        if($coupon){

            $this->load->library('PHPExcel');
            $this->excel = new PHPExcel();
            $this->excel->setActiveSheetIndex(0);
            //$this->excel->getActiveSheet()->setTitle($ITEM_NAME2);
            $this->excel->getActiveSheet()->setTitle("code");

            $cnt = 1;
            foreach($coupon->result() as $row):
                $this->excel->getActiveSheet()->setCellValue('A'.$cnt,  (string)$row->no);
                //$this->excel->getActiveSheet()->setCellValue('A'.$cnt,  $cnt);
                $cnt++;
                $this->excel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
            endforeach;

            $filename= $ITEM_NAME.'.xls'; // 엑셀 파일 이름
            header('Content-Type: application/vnd.ms-excel'); //mime 타입
            header('Content-Disposition: attachment;filename="'.$filename.'"'); // 브라우저에서 받을 파일 이름
            header('Cache-Control: max-age=0'); //no cache

            // Excel5 포맷으로 저장 엑셀 2007 포맷으로 저장하고 싶은 경우 'Excel2007'로 변경합니다.
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
            // 서버에 파일을 쓰지 않고 바로 다운로드 받습니다.
            $objWriter->save('php://output');

        }

    }

    function code_excel_use($id = ''){
        //echo $select."-".$oid;


        $this->load->model('nsparomodel');
        $code = $this->nsparomodel->get_bar_emartcode($id);    //코드(단일행)
        $coupon = $this->nsparomodel->get_bar_emart_use($code->sellcode , $code->gu );    //쿠폰(여러행)

        $sort = $this->get_search_string($code->sort);
        $chn = $this->get_search_string($code->chn);
        $bigo = $this->get_search_string($code->bigo);

        //$ITEM_NAME = iconv("UTF-8","EUC-KR",$BuyOrder->ACCOUNT_COMOANY)."_".iconv("UTF-8","EUC-KR",$ITEM_NAME3)."_".$select;
        $ITEM_NAME = $bigo."_".$chn."_".$sort;
        //echo $ITEM_NAME;

        if($coupon){

            $this->load->library('PHPExcel');
            $this->excel = new PHPExcel();
            $this->excel->setActiveSheetIndex(0);
            //$this->excel->getActiveSheet()->setTitle($ITEM_NAME2);
            $this->excel->getActiveSheet()->setTitle("code");

            $cnt = 1;
            foreach($coupon->result() as $row): //
                $this->excel->getActiveSheet()->setCellValue('A'.$cnt,  (string)$row->no);
                $this->excel->getActiveSheet()->setCellValue('B'.$cnt,  (string)$row->nm);
                $this->excel->getActiveSheet()->setCellValue('C'.$cnt,  (string)$row->usedate);
                //$this->excel->getActiveSheet()->setCellValue('A'.$cnt,  $cnt);
                $cnt++;
                $this->excel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
            endforeach;

            $filename= $ITEM_NAME.'.xls'; // 엑셀 파일 이름
            header('Content-Type: application/vnd.ms-excel'); //mime 타입
            header('Content-Disposition: attachment;filename="'.$filename.'"'); // 브라우저에서 받을 파일 이름
            header('Cache-Control: max-age=0'); //no cache

            // Excel5 포맷으로 저장 엑셀 2007 포맷으로 저장하고 싶은 경우 'Excel2007'로 변경합니다.
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
            // 서버에 파일을 쓰지 않고 바로 다운로드 받습니다.
            $objWriter->save('php://output');

        }

    }

    function get_search_string($stx)
    {
        $stx_pattern = array();
        $stx_pattern[] = '#\.*/+#';
        $stx_pattern[] = '#\\\*#';
        $stx_pattern[] = '#\.{2,}#';
        $stx_pattern[] = '#[/\'\"%=*\#\(\)\|\+\-\&\!\$@~\{\}\[\]`;:\?\^\,]+#';

        $stx_replace = array();
        $stx_replace[] = '';
        $stx_replace[] = '';
        $stx_replace[] = '.';
        $stx_replace[] = '';

        $stx = preg_replace($stx_pattern, $stx_replace, $stx);

        return $stx;
    }

    function mms_save(){
        $this->sparo2 = $this->load->database('sparo2', TRUE);
        $this->id = $this->input->post('flag');
        $this->mms_text = $this->input->post('mmstext');

        $sql = "select logtxt from spadb.bar_emartcode 
        		where id = '$this->id'";
        $logrow = $this->sparo2->query($sql)->row();


        $damnm = $this->session->userdata('nm');
        $damcd = $this->session->userdata('cd');
        $this->logtxt = $logrow->logtxt."\n".date("Y-m-d H:i:s").":".$damnm."(".$damcd.") 문자수정";

        //echo $this->logtxt;

        $data = array(
            'mms_text' => $this->mms_text,
            'logtxt' => $this->logtxt
        );

        $this->sparo2->where('id', $this->id);
        if(!$this->sparo2->update('bar_emartcode', $data)){
            echo "err";
        }else{
            echo "ok";
        }

    }

    function mms_stop(){
        $this->sparo2 = $this->load->database('sparo2', TRUE);
        $this->id = $this->input->post('flag');

        $sql = "select logtxt from spadb.bar_emartcode 
        		where id = '$this->id'";
        $logrow = $this->sparo2->query($sql)->row();


        $damnm = $this->session->userdata('nm');
        $damcd = $this->session->userdata('cd');
        $this->logtxt = $logrow->logtxt."\n".date("Y-m-d H:i:s").":".$damnm."(".$damcd.") 문자정지";

        //echo $this->logtxt;

        $data = array(
            'mms_state' => 'N',
            'logtxt' => $this->logtxt
        );

        $this->sparo2->where('id', $this->id);
        if(!$this->sparo2->update('bar_emartcode', $data)){
            echo "err";
        }else{
            echo "ok";
        }
    }

	function count($mode='')
    {
    	$this->sparo2 = $this->load->database('sparo2', TRUE);
        $monthdate = date("Y-m-d");
        $onemonthdate = date("Y-m-d",strtotime ("-1 months"));
        
            $codesql= "SELECT * FROM `bar_emartcode` WHERE selldate > '$onemonthdate'";
            $codequery = $this->sparo2->query($codesql);
            if($codequery){
            	$gubigo = array();
            	foreach($codequery->result() as $coderow):
            		$gubigo[] = "'".$coderow->bigo."'";
            	endforeach;
            	$bigo = implode ($gubigo,',');
            }

        $sql = "SELECT bar_emartcode.bigo aaa,bar_emartcode.chn bbb,bar_emartcode.sort ccc,bar_emartcode.pcmsid ddd,bar_emartcode.selldate eee,count(bar_emart.no) fff
FROM bar_emart
LEFT OUTER JOIN
bar_emartcode ON (bar_emart.gu = bar_emartcode.gu and bar_emart.sellcode = bar_emartcode.sellcode )
where bar_emartcode.bigo in ($bigo)
AND bar_emart.useyn = 'Y'
AND bar_emart.usedate < '$monthdate'
GROUP BY bar_emartcode.id";
        
        $sql = "SELECT bar_emartcode.bigo aaa,bar_emartcode.chn bbb,bar_emartcode.sort ccc,bar_emartcode.pcmsid ddd,bar_emartcode.selldate eee,
        sum(if(bar_emart.useyn = 'Y',1,0)) fff,sum(if(bar_emart.useyn = 'N' and usernm is not null,1,0)) hhh
        FROM bar_emart
        LEFT OUTER JOIN
        bar_emartcode ON (bar_emart.gu = bar_emartcode.gu and bar_emart.sellcode = bar_emartcode.sellcode )
        where bar_emartcode.bigo in ($bigo) 
        GROUP BY bar_emartcode.id";
        
        $query = $this->sparo2->query($sql);
        $data['monthdate'] = $monthdate;
        $data['query'] = $query;
    	$data['title'] = '차수별 사용 현황';
    	$data['contentview'] = '/emart/count';
    	$data['leftview'] = 'left';
    	$data['topview'] = 'head';
    	$data['bottomview'] = 'bottom';
    	$this->load->view('/inc/layout',$data);
    }
    
    function coupon($mode='')
    {   
    	$data['title'] = '이마트 쿠폰 폐기';
    	$data['contentview'] = '/emart/coupon';
    	$data['leftview'] = 'left';
    	$data['topview'] = 'head';
    	$data['bottomview'] = 'bottom';
    	$this->load->view('/inc/layout',$data);
    }
    
    function barcode_search(){
    	$this->sparo2 = $this->load->database('sparo2', TRUE);
    	$resultMSG = "조회 결과";
    	$this->barcodetxt = $this->input->post('barcodetxt');
    	
    	$barcodearr =explode("\n",$this->barcodetxt);
    	foreach($barcodearr as $bar){
    		$bar = trim($bar);
    		if($bar != "" && $bar != null){
    			$query = "SELECT * FROM bar_emart WHERE no = '$bar' order by id desc limit 1";

                $query = "SELECT cmsusers.nm cmnm, bar_emart . * , bar_emartcode.selldate, bar_emartcode.sort
                        FROM bar_emart
                        LEFT JOIN cmsusers ON bar_emart.enc_no = cmsusers.cd
                        LEFT JOIN bar_emartcode ON bar_emart.gu = bar_emartcode.gu
                        and bar_emart.sellcode = bar_emartcode.sellcode
                        WHERE bar_emart.no =  '$bar'";

    			$row = $this->sparo2->query($query)->row(); // 쿼리불러옴
    			//print_r($row );
    			 $state = "";
    			if($row->useyn == "Y"){
    				$state = $row->usedate." 사용";
    			}else if($row->useyn == "N"){
    				$state = "미사용";
    			}else if($row->useyn == "C"){
    				$state = $row->canceldate." 취소";
    			}
    			$resultMSG.= "\n".$row->sort."\t".$bar."\t".$state."\t(".$row->cmnm.")\t".$row->usernm."\t".$row->hp;
    		}
    	}
    	echo $resultMSG;
    }
    
    function barcode_cancel(){
    	$this->sparo2 = $this->load->database('sparo2', TRUE);
    	$resultMSG = "폐기 결과";
    	$this->barcodetxt = $this->input->post('barcodetxt');
    	 
    	$barcodearr =explode("\n",$this->barcodetxt);
    	foreach($barcodearr as $bar){
    		$bar = trim($bar);
    		if($bar != "" && $bar != null){
    			$query = "SELECT * FROM bar_emart WHERE no = '$bar' order by id desc limit 1";
    			$row = $this->sparo2->query($query)->row(); // 쿼리불러옴
    			//print_r($row );
    			$state = "";
    			if($row->useyn == "Y"){
    				$state = $row->usedate." 사용";
    				$resultMSG.= "\n".$bar."\t".$state."\t".$row->usernm."\t".$row->hp;
    			}else if($row->useyn == "N"){
    				$state = "미사용";
    				$cancelquery="update bar_emart set useyn='C' where no ='$bar' and useyn='N' limit 1";
    				if($this->sparo2->query($cancelquery)){
    					$resultMSG.= "\n".$bar."\t".$state."\t".$row->usernm."\t".$row->hp."\t폐기성공";
    				}else{
    					$resultMSG.= "\n".$bar."\t".$state."\t".$row->usernm."\t".$row->hp."\t폐기실패";
    				}
    			}else if($row->useyn == "C"){
    				$state = $row->canceldate." 취소";
    				$resultMSG.= "\n".$bar."\t".$state."\t".$row->usernm."\t".$row->hp;
    			}
    			
    			 
    		}
    	}
    	echo $resultMSG;
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

    
    
    

	
} 


?>