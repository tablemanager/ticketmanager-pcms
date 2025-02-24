<?php 

class Order extends CI_Controller { 

	function __construct() {
		parent::__construct();
		if (!(($this->uri->segment(3) == 'login') || ($this->uri->segment(3) == 'login_ok')))
			$this->is_logged_in();
		$this->pcms = $this->load->database('pcms', TRUE);
		$this->sparo2 = $this->load->database('sparo2', TRUE);
		$this->bar = $this->load->database('bar', TRUE);
	    $this->sparoBGF = $this->load->database('sparoBGF', TRUE);
		$this->BGFSMS2 = $this->load->database('BGFSMS2', TRUE);
        $this->BGFSMS3 = $this->load->database('BGFSMS3', TRUE);
	} 
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
	
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
            $ipAdress  = $_SERVER['REMOTE_ADDR'];
            if($ipAdress != "115.68.42.130" && $ipAdress != "115.68.42.2"){
                redirect('/sys/login');
                die();
            }
		}
	}

	function ordchk($mode='')
    {
        $monthdate = date("Y-m-d",strtotime ("-3 months"));
        
        $viewtable = false;
        $searchtxt = '';
        $where = "";
        $total = 0;

        if ($mode == 'new')
        {
            $data['searchtxt'] = '';
            $this->session->set_userdata($data);
        }

        $searchtxt = $this->session->userdata('searchtxt');

        if($searchtxt != '' && $searchtxt != NULL){
        	$length= strlen( $searchtxt );
        	$monthdate = date("Y-m-d",strtotime ("-3 months"));
			$udate = date("Y-m-d");
        	if($length == 4 && is_numeric($searchtxt)){ //숫자네자리일때
        		$where.=" Replace(AES_DECRYPT(UNHEX(hp),'Wow1daY'), '-', '') like '%$searchtxt'"; //전화번호검색
        	}else{
        		$where.=" (usernm like '%$searchtxt%'"; //이름검색
        		$where.=" or barcode_no like '%$searchtxt%'"; //바코드번호
        		$where.=" or orderno like '%$searchtxt%')"; //주문번번호
        	}
        	
            //$where.=" or chnm like '%$searchtxt%'"; //판매채널
            //$where.=" or jpnm like '%$searchtxt%'"; //시설명
            //$where.=" or itemmt_id like '%$searchtxt%'"; //PCMS코드
            //$where.=" or giftcode_no like '%$searchtxt%'"; //상품코드번호
            //$where.=" or itemnm like '%$searchtxt%'"; //상품명
        	//$where.=" AND Created_at > '$monthdate'"; //3개월
			//$where.=" AND usedate >= '$udate'"; //이용일기준
			
			$where.=" AND (Created_at > '$monthdate' or usedate >= '$udate')"; //3개월
			
            $viewtable = true;

            $sql = "select id,Created_at,orderno,barcode_no,usernm,AES_DECRYPT(UNHEX(hp),'Wow1daY') dhp,usegu,if( usegu =1, '사용', '미사용' ) AS ifusegu, 
 jpmt_id,jpnm,itemmt_id,itemnm,chnm,ch_id,usedate,man1,man2,state,canceldate,bigo,dammemo,usegu_at from ordermts where $where order by id desc";
            $query = $this->pcms->query($sql);
            $total = $query -> num_rows();
            $data['query'] = $query;
            $data['dev'] = $sql;

        }
        
        
        $data['total'] = $total;
        $data['searchtxt']=$searchtxt;
        $data['viewtable'] = $viewtable;
    	$data['title'] = '주문 관리자';
    	$data['contentview'] = '/order/ordchk';
    	$data['leftview'] = 'left';
    	$data['topview'] = 'head';
    	$data['bottomview'] = 'bottom';
    	$this->load->view('/inc/layout',$data);
    }
    
    function orderN($mode='')
    {
    	$this->sparo2 = $this->load->database('sparo2', TRUE);
    	$monthdate = date("Y-m-d",strtotime ("-3 months"));
    
    	$viewtable = false;
    	$searchtxt = '';
    	$where = "";
    	$total = 0;
    
    	if ($mode == 'new')
    	{
    		$data['searchtxt'] = '';
    		$this->session->set_userdata($data);
    	}
    
    	$searchtxt = $this->session->userdata('searchtxt');
    
    	if($searchtxt != '' && $searchtxt != NULL){
    		$length= strlen( $searchtxt );
    		$monthdate = date("Y-m-d",strtotime ("-3 months"));
    		$udate = date("Y-m-d");
    		if($length == 4 && is_numeric($searchtxt)){ //숫자네자리일때
    			$where.=" Replace(AES_DECRYPT(UNHEX(hp),'Wow1daY'), '-', '') like '%$searchtxt'"; //전화번호검색
    		}else{
    			$where.=" (usernm like '%$searchtxt%'"; //이름검색
    			$where.=" or barcode_no like '%$searchtxt%'"; //바코드번호
    			$where.=" or orderno like '%$searchtxt%')"; //주문번번호
    		}
	
    		$where.=" AND (created > '$monthdate' or usedate >= '$udate')"; //3개월
    			
    		$viewtable = true;
    
    		$sql = "select id,created,orderno,barcode_no,usernm,AES_DECRYPT(UNHEX(hp),'Wow1daY') dhp,usegu,if( usegu =1, '사용', '미사용' ) AS ifusegu,
    		jpmt_id,jpnm,itemmt_id,itemnm,chnm,ch_id,usedate,man1,man2,state,canceldate,bigo,smsgu from ordermts where $where order by id desc";
    		$query = $this->sparo2->query($sql);
    		$total = $query -> num_rows();
    		$data['query'] = $query;
    		$data['dev'] = $sql;
    
    	}

        $smsid_array = array();
    	$smsbtnqry = "SELECT pcms_id FROM pcmsdb.kit_lms WHERE gp in ('PM','PM_SM','WD','WP','WP_SM','GRC','WPC','KZN','SIW','KBB') and useyn = 'Y' and edate >= now() group by pcms_id";
        $smsbtnchk = $this->db->query($smsbtnqry);

        foreach($smsbtnchk->result() as $smsbtnrow):
            $smsid_array[] = $smsbtnrow->pcms_id;
        endforeach;

        $smsbtnqry = "SELECT item_id FROM `phoenix_items` WHERE selldate >= now()";
        $smsbtnchk = $this->db->query($smsbtnqry);
        foreach($smsbtnchk->result() as $smsbtnrow):
            $smsid_array[] = $smsbtnrow->item_id;
        endforeach;


        $data['smsid_array'] = $smsid_array;

        //쿠폰 확인, 폐기을 사용 할것인가
        $data['syncJpmts'] = array(398,9);
    	$data['total'] = $total;
    	$data['searchtxt']=$searchtxt;
    	$data['viewtable'] = $viewtable;
    	$data['title'] = '주문 관리자';
    	$data['contentview'] = '/order/orderN';
    	$data['leftview'] = 'left';
    	$data['topview'] = 'head';
    	$data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }



    function orderN_dev($mode='')
    {
        $this->cms = $this->load->database('cms', TRUE);
        $this->sparo2 = $this->load->database('sparo2', TRUE);
        $this->bar = $this->load->database('bar', TRUE);
        $viewtable = false;
        $searchtxt = '';
        $where = "1";
        $total_rows = 0;

        if ($mode == 'new') {
            $data['selectdate'] = '';
            $data['sdate'] = date("Y-m-d",strtotime ("-1 months"));
            $data['edate'] = date("Y-m-d");
            $data['usernm'] = '';
            $data['userhp'] = '';
            $data['orderno'] = '';
            $data['barcodeno'] = '';
            $data['grnm'] = '';
            $data['jpnm'] = '';
            $data['itemnm'] = '';
            $data['chnm'] = '';
            $data['ch_orderno'] = '';
            $data['state'] = '';
            $data['usegu'] = '';
            $data['dammemo'] = '';
            $data['offset'] = 0;
            $this->session->set_userdata($data);
        }

        $selectdate = $this->session->userdata('selectdate');
        $sdate = $this->session->userdata('sdate');
        $edate = $this->session->userdata('edate');
        $usernm = $this->session->userdata('usernm');
        $userhp = $this->session->userdata('userhp');
        $orderno = $this->session->userdata('orderno');
        $barcodeno = $this->session->userdata('barcodeno');
        $grnm = $this->session->userdata('grnm');
        $jpnm = $this->session->userdata('jpnm');
        $itemnm = $this->session->userdata('itemnm');
        $chnm = $this->session->userdata('chnm');
        $ch_orderno = $this->session->userdata('ch_orderno');
        $state = $this->session->userdata('state');
        $usegu = $this->session->userdata('usegu');
        $dammemo = $this->session->userdata('dammemo');


        $offset = $this->session->userdata('offset');

        $data['selectdate'] = $this->session->userdata('selectdate');
        $data['sdate'] = $this->session->userdata('sdate');
        $data['edate'] = $this->session->userdata('edate');
        $data['usernm'] = $this->session->userdata('usernm');
        $data['userhp'] = $this->session->userdata('userhp');
        $data['orderno'] = $this->session->userdata('orderno');
        $data['barcodeno'] = $this->session->userdata('barcodeno');
        $data['grnm'] = $this->session->userdata('grnm');
        $data['jpnm'] = $this->session->userdata('jpnm');
        $data['itemnm'] = $this->session->userdata('itemnm');
        $data['chnm'] = $this->session->userdata('chnm');
        $data['ch_orderno'] = $this->session->userdata('ch_orderno');

        $data['state'] = $this->session->userdata('state');
        $data['usegu'] = $this->session->userdata('usegu');
        $data['dammemo'] = $this->session->userdata('dammemo');

        if ($selectdate != '' && $selectdate != NULL && $sdate != '' && $sdate != NULL && $edate != '' && $edate != NULL) {
            $where .= " AND {$selectdate} between '{$sdate}' and '{$edate}' ";
            $viewtable = true;
        }

        if ($usernm != '' && $usernm != NULL) {
            $where .= " AND usernm like '%$usernm%'"; //이름검색
            $viewtable = true;
        }

        if ($userhp != '' && $userhp != NULL) {
            $userhp = str_replace("-","",$userhp);
            $where .= " AND Replace(AES_DECRYPT(UNHEX(hp),'Wow1daY'), '-', '') like '%$userhp'"; //전화번호검색
            $viewtable = true;
        }

        if ($orderno != '' && $orderno != NULL) {
            $where .= "  AND orderno like '%$orderno%'"; //주문번번호
            $viewtable = true;
        }

        if ($barcodeno != '' && $barcodeno != NULL) {
            $where .= " AND barcode_no like '%$barcodeno%'"; //바코드번호
            $viewtable = true;
        }

        if ($grnm != '' && $grnm != NULL) {
            $where .= " AND grnm like '%$grnm%'"; //바코드번호
            $viewtable = true;
        }

        if ($jpnm != '' && $jpnm != NULL) {
            $where .= " AND jpnm like '%$jpnm%'"; //바코드번호
            $viewtable = true;
        }

        if ($itemnm != '' && $itemnm != NULL) {
            $where .= " AND  itemnm like '%$itemnm%'"; //바코드번호
            $viewtable = true;
        }

        if ($chnm != '' && $chnm != NULL) {
            $where .= " AND chnm = '$chnm'"; //판매채널
            $viewtable = true;
        }

        if ($ch_orderno != '' && $ch_orderno != NULL) {
            $where .= " AND ch_orderno like '%$ch_orderno%'"; //채널주문번호
            $viewtable = true;
        }

        if ($state != '' && $state != NULL) {
            $where .= " AND state = '$state'"; //주문상태
            $viewtable = true;
        }

        if ($usegu != '' && $usegu != NULL) {
            $where .= " AND usegu = '$usegu'"; //이용상태
            $viewtable = true;
        }

        if ($dammemo != '' && $dammemo != NULL) {
            $where .= " AND dammemo like '%$dammemo%'"; //담당자메모
            $viewtable = true;
        }

        if ($viewtable) {
            $sql = "select id,ch_orderno,created,resno,orderno,barcode_no,usernm,AES_DECRYPT(UNHEX(hp),'Wow1daY') dhp,usegu,if( usegu =1, '사용', '미사용' ) AS ifusegu,usegu_at,
                jpmt_id,jpnm,itemmt_id,itemnm,chnm,ch_id,usedate,man1,man2,state,canceldate,bigo,smsgu, dammemo from ordermts where $where ";
            $query = $this->sparo2->query($sql);
            $total_rows = $query->num_rows();
            $limit = 30;

            $this->load->library('pagination');
            $config['base_url'] = 'http://pcms.placem.co.kr/index.php/order/orderN_dev_offset';
            $config['total_rows'] =  $total_rows;
            $config['per_page'] = $limit;
            $config['cur_page'] = $offset;
            $config['uri_segment'] = 3;

            page_default_set($config);
            $this->pagination->initialize($config);
            $data['pag_links'] = $this->pagination->create_links();
            $sql .= " order by id desc limit $offset, $limit";
            $data['query'] = $this->sparo2->query($sql);
            $data['dev'] = $sql;
            $data['where'] = ase_encrypt($where);
        }

        $smsid_array = array();

        $data['smsid_array'] = $smsid_array;

        $csql="select com_id,com_nm from CMS_COMPANY where com_type = 'C' AND com_state = 'Y' order by com_nm";
        $data['cquery'] = $this->cms->query($csql);

        //$facselect = "SELECT jpmt_id,jpnm FROM `itemmts_list` where jpmt_id != 0 group by jpmt_id order by jpnm  ";
        //$data['faclist'] = $this->sparo2->query($facselect);
        
        //시설 정보도 2번으로 변경
        $csql="select fac_id as jpmt_id,fac_nm as jpnm from CMS_FACILITIES where 1 order by fac_nm";
        $data['faclist'] = $this->cms->query($csql);

        $itemselect = "SELECT item_id,item_nm FROM `CMS_ITEMS` where item_state = 'Y' and item_edate >= now() and item_id > 10000 order BY item_id DESC ";
        $data['itemlist'] = $this->cms->query($itemselect);

        $ip = $_SERVER["REMOTE_ADDR"];
        if ($ip == "118.131.208.122" or $ip == "118.131.208.123" or $ip == "118.131.208.124" or $ip == "118.131.208.125" or $ip == "118.131.208.126"
            or $this->session->userdata('cd') == 'penfen' or $this->session->userdata('cd') == 'jjlee' or $this->session->userdata('cd') == 'csi'
        ){
            $data['viewexcel'] = true;
        }else{
            $data['viewexcel'] = false;
        }

        //쿠폰 확인, 폐기을 사용 할것인가
        $data['syncJpmts'] = array(398,9,86);
        $data['total'] = $total_rows;
        $data['searchtxt']=$searchtxt;
        $data['viewtable'] = $viewtable;
        $data['title'] = '주문 관리자';
        $data['contentview'] = '/order/orderN_dev';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }


    function get_itemlist(){
        $this->cms = $this->load->database('cms', TRUE);
        $facid = $this->input->post('facid');

        $itemselect = "SELECT item_id,item_nm FROM `CMS_ITEMS` where item_facid = {$facid} and item_state = 'Y' and item_edate >= now() and item_id > 10000 order BY item_id DESC ";
        $data['itemlist'] = $this->cms->query($itemselect);
        $this->load->view('/order/itemlist',$data);
    }

    function upload_excel()
    {
        $this->cms = $this->load->database('cms', TRUE);
        $this->load->model('nsparomodel');

        $csql="select com_id,com_nm from CMS_COMPANY where com_type = 'C' AND com_state = 'Y' order by com_nm";
        $data['cquery'] = $this->cms->query($csql);

        //시설 정보도 2번으로 변경
        $csql="select fac_id as jpmt_id,fac_nm as jpnm from CMS_FACILITIES where 1 order by fac_nm";
        $data['faclist'] = $this->cms->query($csql);

        $itemselect = "SELECT item_id,item_nm FROM `CMS_ITEMS` where item_state = 'Y' and item_edate >= now() and item_id > 10000 order BY item_id DESC ";
        $data['itemlist'] = $this->cms->query($itemselect);

        $data['excellist'] = $this->nsparomodel->get_OrderExcel();
        $data['title'] = '주문 대량 등록(엑셀)';
        $data['contentview'] = '/order/upload_excel';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }
    function upload_excel_stop()
    {
        $this->code = $this->input->post('code');
        $this->sparo2->where('id' , $this->code);
        $this->sparo2->limit(1);
        if($this->sparo2->update('ordermts_excel',array('inputresult' => 'C'))){
            echo "ok";
        }else{
            echo "err";
        }
    }

    function orderExcelDown($id=''){
        $this->load->helper('download');
        $this->load->model('nsparomodel');
        if($id != '' && $id != null){
            $row = $this->nsparomodel->get_OrderExcel_id($id);
            if($row->filename != ''){
                $data = file_get_contents("/home/pcms.placem.co.kr/public_html/upload_excel/".$row->filename);
                force_download($row->filename, $data);
            }
        }else{
            $data = file_get_contents("/home/pcms.placem.co.kr/public_html/upload_excel/SAMPLE.xlsx");
            force_download("엑셀업로드양식.xlsx", $data);
        }
    }

    function insert_order_excel($mode='')
    {
        $this->load->model('cmsmodel');
        $this->load->model('nsparomodel');
        $dam = $this->session->userdata('cd');
        $damnm = $this->session->userdata('nm');
        $ip = $_SERVER["REMOTE_ADDR"];
        $state_select  = $this->input->post('state_select');
        $chn_select = $this->input->post('chn_select');
        $fac_select = $this->input->post('fac_select');
        $item_select = $this->input->post('item_select');
        $Nusedate = $this->input->post('Nusedate');

        $itemrow = $this->cmsmodel->get_CMS_ITEMS($item_select);
        $itemnm = $itemrow->item_nm; //itemnm //상품명

        $comrow = $this->cmsmodel->get_CMS_COMPANY($chn_select);
        if($comrow){
            $chnm = $comrow->com_nm; //판매채널이름
        }else{
            $chnm = ''; //판매채널이름
        }

        $facrow = $this->cmsmodel->get_CMS_FACILITIES($fac_select);
        if($facrow){
            $jpnm =  $facrow->fac_nm; //시설 이름
        }else{
            $jpnm =  ''; //시설 이름
        }

        $tmp_name1 = $_FILES["userfile"]["tmp_name"];
        if (!empty($tmp_name1))
        {
            $filename = date("YmdHis")."_".$dam."_".$chn_select."_".$item_select.".xlsx";
            $config['file_name'] = $filename;
            $config['upload_path'] = './upload_excel/';
            $config['allowed_types'] = 'xls|XLS|xlsx|XLSX';
            $config['overwrite'] = true;    //같은 이름의 파일이 이미 존재한다면 덮어쓸것
            $config['remove_spaces'] = true;    //TRUE로 설정하면 파일명에 공백이 있을경우 밑줄(_)로 변경
            $config['max_size']	= '2048000000';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload())
            {
                $data = array(
                    'jpmt_id' => $fac_select,
                    'jpnm' => $jpnm,
                    'itemmt_id' => $item_select,
                    'itemnm' => $itemnm,
                    'ch_id' => $chn_select,
                    'chnm' => $chnm,
                    'usedate' => $Nusedate,
                    'state' => $state_select,
                    'filename' => $filename,
                    'ip' => $ip,
                    'damnm' => $damnm."(".$dam.")"
                );

                if($this->nsparomodel->insertOrderExcel($data));
            }
            redirect('/order/upload_excel');
        }
    }


    function insert_order(){

        $this->load->model('cmsmodel');
        $this->load->model('nsparomodel');

        $created = date("Y-m-d H:i:s");
        $usernm = trim($this->input->post('Nusernm')); //고객 이름
        $posthp = preg_replace("/[^0-9]*/s", "", trim($this->input->post('Nhp')));
        $hp = ase_encrypt($posthp); // 휴대폰 번호
        $lasthp = substr($posthp , -4, 4);
        $ch_id = $this->input->post('chn_select'); // 판매채널 ( 2번DB )
        $chnm = $this->cmsmodel->get_CMS_COMPANY($ch_id)->com_nm;//채널이름

        $itemmt_id = $this->input->post('item_select'); // 상품선택 ( 2번DB )

        $Nbarcodeno= trim($this->input->post('Nbarcodeno'));
        $itemrow = $this->cmsmodel->get_CMS_ITEMS($itemmt_id);
        $itemnm = $itemrow->item_nm; //itemnm //상품명

        $comrow = $this->cmsmodel->get_CMS_COMPANY($itemrow->item_cpid);
        if($comrow){
            $grmt_id = $comrow->com_id;//대리점아이디
            $grnm = $comrow->com_nm; //대리점이름
        }else{
            $grmt_id = 0;//대리점아이디
            $grnm = ''; //대리점이름
        }

        $facrow = $this->cmsmodel->get_CMS_FACILITIES($itemrow->item_facid);
        if($facrow){
            $jpmt_id =  $facrow->fac_id; //시설 아이디
            $jpnm =  $facrow->fac_nm; //시설 이름
        }else{
            $jpmt_id =  0; //시설 아이디
            $jpnm =  ''; //시설 이름
        }

        $mdate = date("Y-m-d"); //접수일
        $usedate = $this->input->post('Nusedate'); // 이용일
        $ip = $_SERVER["REMOTE_ADDR"];
        $man1 = $this->input->post('Nman'); // 인원

        $pricerow = $this->cmsmodel->get_CMS_PRICES($itemmt_id,$usedate);

        if($pricerow){

            $dan1 = $pricerow->price_normal;//단가 (정상가)
            $amt = $pricerow->price_sale * $man1;//가격 (판매가 x 인원 )
            $accamt = $pricerow->price_sale * $man1; //결제액 (판매가 x 인원 ) : 이전에 쿠폰등의 이슈가 있어 필드가 하나 더 생겼다고 한다.
            $gongamt = $pricerow->price_out * $man1; //(공급가 그냥 입력)
            $gongdan1 = $pricerow->price_out * $man1; //공급가
            $saipamt = $pricerow->price_in * $man1; //(사입가)
            $saipdan1 = $pricerow->price_in * $man1; //사입가
            $jungamt = $pricerow->price_normal * $man1; //(정상가)
            $jungdan1 = $pricerow->price_normal * $man1; //(정상가)
            $saledan1 = $pricerow->price_sale * $man1; //판매가
        }else{
            $dan1 = 0;
            $amt = 0;
            $accamt = 0;
            $gongamt = 0;
            $gongdan1 = 0;
            $saipamt = 0;
            $saipdan1 = 0;
            $jungamt = 0;
            $jungdan1 = 0;
            $saledan1 = 0;
        }

        $raterow = $this->cmsmodel->get_CMS_RATE($ch_id,$itemmt_id);
        if($raterow){
            $ch_rate = $raterow->rate_value;
        }else{
            $ch_rate = 6;
        }
        $ch_pay = ($amt / 100) * ( 100 - $ch_rate );//수수료 ( 판매가에서 수수료율 제외 )

        $state = $this->input->post('state_select'); // 예약완료

        $ch_orderno = $this->input->post('Nchorderno'); // 판매채널 주문번호
        $dammemo = $this->input->post('Nmemo'); // 메모
        $dammt_id = $this->session->userdata('id'); //담당자 아이디
        $damnm = $this->session->userdata('nm');

        $usegu = '2';
        $site = 'PCMS2';

        // 주문번호 생성
        $orderno =  date("Ymd")."_PM2".$itemmt_id.date("His");

        $data = array(
            'updated' => $created,
            'created' => $created,
            'usernm' => $usernm,
            'hp' => $hp,
            'usernm2' => $usernm,
            'hp2' => $hp,
            'lasthp' => $lasthp,
            'ch_id' => $ch_id,
            'chnm' => $chnm,
            'itemmt_id' => $itemmt_id,
            'itemnm' => $itemnm,
            'grmt_id' => $grmt_id,
            'grnm' => $grnm,
            'jpmt_id' => $jpmt_id,
            'jpnm' =>  $jpnm,
            'mdate' => $mdate,
            'usedate' => $usedate,
            'ip' => $ip,
            'man1' => $man1,
            'dan1' => $dan1,
            'amt' => $amt,
            'orderno' => $orderno,
            'accamt' => $accamt,
            'gongamt' => $gongamt,
            'gongdan1' => $gongdan1,
            'saipamt' => $saipamt,
            'saipdan1' => $saipdan1,
            'jungamt' => $jungamt,
            'jungdan1' => $jungdan1,
            'saledan1' => $saledan1,
            'ch_rate' => $ch_rate,
            'ch_pay' => $ch_pay,
            'state' => $state,
            'ch_orderno' => $ch_orderno,
            'dammemo'=> $dammemo,
            'dammt_id' => $dammt_id,
            'damnm' => $damnm,
            'usegu' => $usegu,
            'barcode_no' =>$Nbarcodeno,
            'site' => $site
        );
        if($this->nsparomodel->insertOrdermts($data)){
            echo "ok|등록이 완료되었습니다.";
        }else{
            echo "err|등록 실패";
        }
        //print_r($data);
    }

    function exceldown($selectdate='',$sdate='',$edate='',$usernm='',$userhp='',$orderno='',$barcodeno='',$jpnm='',$itemnm='',$chnm='',$ch_orderno='',$state='',$usegu=''){

        /*ini_set('memory_limit', '400M' );
        ini_set('upload_max_filesize', '400M');
        ini_set('post_max_size', '400M');
        ini_set('max_input_time', 7200);
        ini_set('max_execution_time', 7200);*/

        ini_set('memory_limit', '2G' );
        ini_set('upload_max_filesize', '400M');
        ini_set('post_max_size', '400M');
        ini_set('max_input_time', 20000);
        ini_set('max_execution_time', 20000);


        $ip = $_SERVER["REMOTE_ADDR"];
        $damcd = $this->session->userdata('cd');
        if ($ip != "118.131.208.122"
            && $ip != "118.131.208.123"
            && $ip != "118.131.208.124"
            && $ip != "118.131.208.125"
            && $ip != "118.131.208.126"
            && $damcd != 'penfen'
            && $damcd != 'jjlee'
            && $damcd != 'jm5035'
        ){
            exit;
        }

        $this->cms2 = $this->load->database('cms2', TRUE);

        $where = "1";

        if ($selectdate != '' && $selectdate != NULL && $sdate != '' && $sdate != NULL && $edate != '' && $edate != NULL) {
            $selectdate = urldecode($selectdate);
            $where .= " AND {$selectdate} between '{$sdate}' and '{$edate}' ";
        }

        $usernm = trim(urldecode($usernm));
        if (trim($usernm) != '' && $usernm != NULL ) {
            $usernm = addslashes($usernm);
            $where .= " AND usernm like '%$usernm%'"; //이름검색
        }

        $userhp = trim(urldecode($userhp));
        if ($userhp != '' && $userhp != NULL) {
            $where .= " AND Replace(AES_DECRYPT(UNHEX(hp),'Wow1daY'), '-', '') like '%$userhp'"; //전화번호검색
        }
        $orderno = trim(urldecode($orderno));
        if ($orderno != '' && $orderno != NULL) {
            $where .= "  AND orderno like '%$orderno%'";
        }
        $barcodeno = trim(urldecode($barcodeno));
        if ($barcodeno != '' && $barcodeno != NULL) {
            $where .= " AND barcode_no like '%$barcodeno%'";
        }
        $jpnm = trim(urldecode($jpnm));
        if ($jpnm != '' && $jpnm != NULL) {
            $jpnm = addslashes($jpnm);
            $where .= " AND jpnm like '%$jpnm%'";
        }
        $itemnm = trim(urldecode($itemnm));
        if ($itemnm != '' && $itemnm != NULL) {
            $itemnm = addslashes($itemnm);
            $where .= " AND  itemnm like '%$itemnm%'";
        }

        $chnm = trim(urldecode($chnm));
        if ($chnm != '' && $chnm != NULL) {
            $chnm = addslashes($chnm);
            $where .= " AND chnm = '$chnm'"; //판매채널
        }

        $ch_orderno = trim(urldecode($ch_orderno));
        if ($ch_orderno != '' && $ch_orderno != NULL) {
            $ch_orderno = addslashes($ch_orderno);
            $where .= " AND ch_orderno like '%$ch_orderno%'"; //채널주문번호
        }

        $state = trim(urldecode($state));
        if ($state != '' && $state != NULL) {
            $state = addslashes($state);
            $where .= " AND state = '$state'"; //주문상태
        }

        $usegu = trim(urldecode($usegu));
        if ($usegu != '' && $usegu != NULL) {
            $usegu = addslashes($usegu);
            $where .= " AND usegu = '$usegu'"; //이용상태
        }


        $sql="SELECT  id ,
                orderno ,
                ch_orderno,
                barcode_no ,
                itemnm ,
                mdate ,
                usedate ,
                usegu,
                usegu_at ,
                canceldate,
                chnm ,
                usernm ,
                AES_DECRYPT(UNHEX(hp),'Wow1daY') as 'dhp',
                man1 ,
                man2 ,
                man3 ,
                jpnm ,
                ifnull(accamt, 0) 'amtt',
                ifnull(saipamt, 0) 'saipdan1t',
                state ,
                pgcaldate,
                paybackamt
        FROM olddb.orders
        WHERE  
        {$where}
        limit 50000
        ";


        $logtext = addslashes($where);
        $logsql = "insert pcmsdb.log_exceldown set qrystr = '{$logtext}',regdate = NOW(),ip='{$ip}',bigo='{$damcd}'";
        $this->db->query($logsql);


        $query = $this->cms2->query($sql);
        if($query){

            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //$this->excel->getActiveSheet()->setTitle($ITEM_NAME2);
            $this->excel->getActiveSheet()->setTitle("ORDEREXCEL");

            $cnt = 1;
            $this->excel->getActiveSheet()->setCellValue('A'.$cnt, "번호");
            $this->excel->getActiveSheet()->setCellValue('B'.$cnt, "주문번호");
            $this->excel->getActiveSheet()->setCellValue('C'.$cnt, "채널주문번호");
            $this->excel->getActiveSheet()->setCellValue('D'.$cnt, "바코드번호");
            $this->excel->getActiveSheet()->setCellValue('E'.$cnt, "상품명");
            $this->excel->getActiveSheet()->setCellValue('F'.$cnt, "접수일");
            $this->excel->getActiveSheet()->setCellValue('G'.$cnt, "이용기간");
            $this->excel->getActiveSheet()->setCellValue('H'.$cnt, "이용상태");
            $this->excel->getActiveSheet()->setCellValue('I'.$cnt, "이용시간");
            $this->excel->getActiveSheet()->setCellValue('J'.$cnt, "판매채널");
            $this->excel->getActiveSheet()->setCellValue('K'.$cnt, "고객명");
            $this->excel->getActiveSheet()->setCellValue('L'.$cnt, "휴대폰");
            $this->excel->getActiveSheet()->setCellValue('M'.$cnt, "인원1");
            $this->excel->getActiveSheet()->setCellValue('N'.$cnt, "인원2");
            $this->excel->getActiveSheet()->setCellValue('O'.$cnt, "인원3");
            $this->excel->getActiveSheet()->setCellValue('P'.$cnt, "시설명");
            $this->excel->getActiveSheet()->setCellValue('Q'.$cnt, "판매가");
            $this->excel->getActiveSheet()->setCellValue('R'.$cnt, "사입가");
            $this->excel->getActiveSheet()->setCellValue('S'.$cnt, "주문상태");
            $this->excel->getActiveSheet()->setCellValue('T'.$cnt, "입금일");
            $this->excel->getActiveSheet()->setCellValue('U'.$cnt, "입금액");
            $this->excel->getActiveSheet()->setCellValue('V'.$cnt, "취소시간");
            $cnt++;


            foreach($query->result() as $row):
                $this->excel->getActiveSheet()->setCellValue('A'.$cnt, $row->id);
                $this->excel->getActiveSheet()->setCellValue('B'.$cnt, $row->orderno);
                $this->excel->getActiveSheet()->setCellValue('C'.$cnt, $row->ch_orderno);
                $this->excel->getActiveSheet()->setCellValue('D'.$cnt, $row->barcode_no);
                $this->excel->getActiveSheet()->setCellValue('E'.$cnt, $row->itemnm);
                $this->excel->getActiveSheet()->setCellValue('F'.$cnt, $row->mdate);
                $this->excel->getActiveSheet()->setCellValue('G'.$cnt, $row->usedate);
                $this->excel->getActiveSheet()->setCellValue('H'.$cnt, $row->usegu);
                $this->excel->getActiveSheet()->setCellValue('I'.$cnt, $row->usegu_at);
                $this->excel->getActiveSheet()->setCellValue('J'.$cnt, $row->chnm);
                $this->excel->getActiveSheet()->setCellValue('K'.$cnt, $row->usernm);
                $this->excel->getActiveSheet()->setCellValue('L'.$cnt, $row->dhp);
                $this->excel->getActiveSheet()->setCellValue('M'.$cnt, $row->man1);
                $this->excel->getActiveSheet()->setCellValue('N'.$cnt, $row->man2);
                $this->excel->getActiveSheet()->setCellValue('O'.$cnt, $row->man3);
                $this->excel->getActiveSheet()->setCellValue('P'.$cnt, $row->jpnm);
                $this->excel->getActiveSheet()->setCellValue('Q'.$cnt, $row->amtt);
                $this->excel->getActiveSheet()->setCellValue('R'.$cnt, $row->saipdan1t);
                $this->excel->getActiveSheet()->setCellValue('S'.$cnt, $row->state);
                $this->excel->getActiveSheet()->setCellValue('T'.$cnt, $row->pgcaldate);
                $this->excel->getActiveSheet()->setCellValue('U'.$cnt, $row->paybackamt);
                $this->excel->getActiveSheet()->setCellValue('V'.$cnt, $row->canceldate);

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


    function exceldown_phoenix($months=''){

        ini_set('memory_limit', '1G' );
        ini_set('upload_max_filesize', '400M');
        ini_set('post_max_size', '400M');
        ini_set('max_input_time', 10000);
        ini_set('max_execution_time', 10000);

        $ip = $_SERVER["REMOTE_ADDR"];
        $damcd = $this->session->userdata('cd');
        if ($ip != "118.131.208.122"
            && $ip != "118.131.208.123"
            && $ip != "118.131.208.124"
            && $ip != "118.131.208.125"
            && $ip != "118.131.208.126"
            && $damcd != 'penfen'
            && $damcd != 'jjlee'
            && $damcd != 'jm5035'
        ){
            exit;
        }

        if($months==''){
            exit;
        }

        $sql = "SELECT 
                    Created_at , 
                    usegu_at,
                    if(state = 'Y','사용','미사용') usetxt,
                    chnm,
                    if(divs = 'SIN','단품','세트') gubun,
                    omname,
                    qty,
                    cnt1,
                    cnt2,
                    cnt3,
                    cnt4,
                    cnt5,
                    cnt6,
                    no,
                    usernm,
                    orderno,
                    hp
                FROM `bg_ordermts`
                WHERE usegu_at like '{$months}%'";

        $logtext = addslashes($sql);
        $logsql = "insert pcmsdb.log_exceldown set qrystr = '{$logtext}',regdate = NOW(),ip='{$ip}',bigo='{$damcd}'";
        $this->db->query($logsql);

        $query = $this->sparo2->query($sql);
        if($query){
            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //$this->excel->getActiveSheet()->setTitle($ITEM_NAME2);
            $this->excel->getActiveSheet()->setTitle("ORDEREXCEL");
            $cnt = 1;
            $this->excel->getActiveSheet()->setCellValue('A'.$cnt, "등록시간");
            $this->excel->getActiveSheet()->setCellValue('B'.$cnt, "사용시간");
            $this->excel->getActiveSheet()->setCellValue('C'.$cnt, "사용구분");
            $this->excel->getActiveSheet()->setCellValue('D'.$cnt, "판매채널");
            $this->excel->getActiveSheet()->setCellValue('E'.$cnt, "상품구분");
            $this->excel->getActiveSheet()->setCellValue('F'.$cnt, "주문명");
            $this->excel->getActiveSheet()->setCellValue('G'.$cnt, "수량");
            $this->excel->getActiveSheet()->setCellValue('H'.$cnt, "인원(남자대인)");
            $this->excel->getActiveSheet()->setCellValue('I'.$cnt, "인원(여자대인)");
            $this->excel->getActiveSheet()->setCellValue('J'.$cnt, "인원(남자소인)");
            $this->excel->getActiveSheet()->setCellValue('K'.$cnt, "인원(여자소인)");
            $this->excel->getActiveSheet()->setCellValue('L'.$cnt, "인원(남자대인소인)");
            $this->excel->getActiveSheet()->setCellValue('M'.$cnt, "인원(여자대인소인)");
            $this->excel->getActiveSheet()->setCellValue('N'.$cnt, "쿠폰번호");
            $this->excel->getActiveSheet()->setCellValue('O'.$cnt, "이용자명");
            $this->excel->getActiveSheet()->setCellValue('P'.$cnt, "플엠주문번호");
            $this->excel->getActiveSheet()->setCellValue('Q'.$cnt, "휴대폰번호");
            $cnt++;

            foreach($query->result() as $row):
                $this->excel->getActiveSheet()->setCellValue('A'.$cnt, $row->Created_at);
                $this->excel->getActiveSheet()->setCellValue('B'.$cnt, $row->usegu_at);
                $this->excel->getActiveSheet()->setCellValue('C'.$cnt, $row->usetxt);
                $this->excel->getActiveSheet()->setCellValue('D'.$cnt, $row->chnm);
                $this->excel->getActiveSheet()->setCellValue('E'.$cnt, $row->gubun);
                $this->excel->getActiveSheet()->setCellValue('F'.$cnt, $row->omname);
                $this->excel->getActiveSheet()->setCellValue('G'.$cnt, $row->qty);
                $this->excel->getActiveSheet()->setCellValue('H'.$cnt, $row->cnt1);
                $this->excel->getActiveSheet()->setCellValue('I'.$cnt, $row->cnt2);
                $this->excel->getActiveSheet()->setCellValue('J'.$cnt, $row->cnt3);
                $this->excel->getActiveSheet()->setCellValue('K'.$cnt, $row->cnt4);
                $this->excel->getActiveSheet()->setCellValue('L'.$cnt, $row->cnt5);
                $this->excel->getActiveSheet()->setCellValue('M'.$cnt, $row->cnt6);

                $this->excel->getActiveSheet()->setCellValueExplicit('N'.$cnt, $row->no,PHPExcel_Cell_DataType::TYPE_STRING);

                $this->excel->getActiveSheet()->setCellValue('O'.$cnt, $row->usernm);
                $this->excel->getActiveSheet()->setCellValue('P'.$cnt, $row->orderno);
                $this->excel->getActiveSheet()->setCellValue('Q'.$cnt, $row->hp);
                $cnt++;
            endforeach;

            $filename= 'phoenixEXCEL.xls'; // 엑셀 파일 이름
            header('Content-Type: application/vnd.ms-excel'); //mime 타입
            header('Content-Disposition: attachment;filename="'.$filename.'"'); // 브라우저에서 받을 파일 이름
            header('Cache-Control: max-age=0'); //no cache

            // Excel5 포맷으로 저장 엑셀 2007 포맷으로 저장하고 싶은 경우 'Excel2007'로 변경합니다.
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
            // 서버에 파일을 쓰지 않고 바로 다운로드 받습니다.
            $objWriter->save('php://output');

        }

    }
    
    function order_modify_nm(){
    	$this->sparo2 = $this->load->database('sparo2', TRUE);
    	$this->id = $this->input->post('code');
    	$this->nm = $this->input->post('modtext');
    	//echo $this->id."/".$this->hp;
    	 
    	$damnm = $this->session->userdata('nm');
    	 
    	//PCMS 수정
    	$pcmsrow = $this->pcms->query("select bigo,sync_sparo2 from ordermts where id=".$this->id." limit 1")->row();
    	$log = $pcmsrow->bigo."\n/".date("Y-m-d H:i:s")." ".$damnm."이름변경:".$this->nm;
    	$sql = "update ordermts set
    	usernm = '{$this->nm}',
    	bigo = '$log'
    	where id = {$this->id} limit 1";
    	$this->pcms->query($sql);
    	 
    	echo $log;
    	
    	//뉴스파로 수정
    	 if($pcmsrow->sync_sparo2 == 'Y'){
        	$sqls = "select * from ordermts where pcms_oid = '{$this->id}' limit 1 ";
        	$querys = $this->sparo2->query($sqls);
        	$rows = $querys->row(); // row넘김
        	$slog = $rows->bigo."\n/".date("Y-m-d H:i:s")." ".$damnm."이름변경:".$this->nm;
        	
        	$ssql = "update spadb.ordermts set
        	usernm = '{$this->nm}',
        	ordermts.bigo = '$slog'
        	where ordermts.pcms_oid = {$this->id} limit 1";
        	$this->sparo2->query($ssql);
        	

        } 
    }
    
   
    
    function order_modify_hp(){
    	$this->sparo2 = $this->load->database('sparo2', TRUE);
    	$this->id = $this->input->post('code');
    	$this->hp = $this->input->post('modtext');
    	$this->lasthp = substr( $this->hp,-4,4);
    	//echo $this->id."/".$this->hp;
    	
    	$damnm = $this->session->userdata('nm');
    	
    	//PCMS 수정
    	$pcmsrow = $this->pcms->query("select bigo,sync_sparo2 from ordermts where id=".$this->id." limit 1")->row();
    	$log = $pcmsrow->bigo."\n/".date("Y-m-d H:i:s")." ".$damnm."HP변경:".$this->hp;
    	//$log = $this->pcms->query("select bigo from ordermts where id=".$this->id." limit 1")->row()->bigo."\n/".date("Y-m-d H:i:s")." ".$damnm."HP변경:".$this->hp;
    	$sql = "update ordermts set
    	hp = hex(aes_encrypt( '{$this->hp}', 'Wow1daY' )) , 
    	bigo = '$log'
    	where id = {$this->id} limit 1";
    	$this->pcms->query($sql);
    	
    	echo $log;	
   		
    	//뉴스파로 수정
    	if($pcmsrow->sync_sparo2 == 'Y'){
    		$sqls = "select * from ordermts where pcms_oid = '{$this->id}' limit 1 ";	
    		$querys = $this->sparo2->query($sqls);
    		$rows = $querys->row(); // row넘김

    		$slog = $rows->bigo."\n/".date("Y-m-d H:i:s")." ".$damnm."HP변경:".$this->hp; 
    		$ssql = "update spadb.ordermts set
    		hp = hex(aes_encrypt( '".$this->hp."', 'Wow1daY' )),
    		ordermts.bigo = '$slog'
    		where ordermts.pcms_oid = {$this->id} limit 1";
    		$this->sparo2->query($ssql); 

    	}
    }
    
    function order_modify_qty(){
    	$this->sparo2 = $this->load->database('sparo2', TRUE);
    	$this->id = $this->input->post('code');
    	$this->man1 = $this->input->post('modtext');
    	//echo $this->id."/".$this->hp;
    	$damnm = $this->session->userdata('nm');
    	//PCMS 수정
    	$pcmsrow = $this->pcms->query("select bigo,sync_sparo2 from ordermts where id=".$this->id." limit 1")->row();
    	$log = $pcmsrow->bigo."\n/".date("Y-m-d H:i:s")." ".$damnm."수량변경:".$this->man1;
    	//$log = $this->pcms->query("select bigo from ordermts where id=".$this->id." limit 1")->row()->bigo."\n/".date("Y-m-d H:i:s")." ".$damnm."수량변경:".$this->man1;
    	$sql = "update ordermts set
    	man1 ='{$this->man1}', 
    	bigo = '$log'
    	where id = {$this->id} limit 1";
    	$this->pcms->query($sql);	
    	echo $log;	
    	
    	//뉴스파로 수정
    	if($pcmsrow->sync_sparo2 == 'Y'){
    		$sqls = "select * from ordermts where pcms_oid = '{$this->id}' limit 1 ";
    		$querys = $this->sparo2->query($sqls);
    		$rows = $querys->row(); // row넘김

    		$slog = $rows->bigo."\n/".date("Y-m-d H:i:s")." ".$damnm."수량변경:".$this->man1;
    				$ssql = "update spadb.ordermts set
    		man1 ='{$this->man1}', 
    	    		ordermts.bigo = '$slog'
    	    		where ordermts.pcms_oid = {$this->id} limit 1";
    	    		$this->sparo2->query($ssql);

    	}
    }

    function order_modify_memo(){
        $this->sparo2 = $this->load->database('sparo2', TRUE);
        $this->id = $this->input->post('code');
        $this->dammemo = $this->input->post('modtext');
        $damnm = $this->session->userdata('nm');

        //PCMS 수정
        $pcmsrow = $this->pcms->query("select bigo,sync_sparo2 from ordermts where id=".$this->id." limit 1")->row();
        $log = $pcmsrow->bigo."\n/".date("Y-m-d H:i:s")." ".$damnm."메모변경:".$this->dammemo;

        $sql = "update ordermts set
    	dammemo ='{$this->dammemo}', 
    	bigo = '$log'
    	where id = {$this->id} limit 1";
        if($this->pcms->query($sql)){
            echo "ok";
        }else{
            echo "err";
        }
        //echo $log;
        //뉴스파로 수정
        if($pcmsrow->sync_sparo2 == 'Y'){
            $sqls = "select * from ordermts where pcms_oid = '{$this->id}' limit 1 ";
            $querys = $this->sparo2->query($sqls);
            $rows = $querys->row(); // row넘김

            $slog = $rows->bigo."\n/".date("Y-m-d H:i:s")." ".$damnm."메모변경:".$this->dammemo;
            $ssql = "update spadb.ordermts set
    		        dammemo ='{$this->dammemo}', 
    	    		ordermts.bigo = '$slog'
    	    		where ordermts.pcms_oid = {$this->id} limit 1";
            $this->sparo2->query($ssql);

        }
    }

    function orderN_modify_memo(){
        $this->sparo2 = $this->load->database('sparo2', TRUE);
        $this->id = $this->input->post('code');
        $this->dammemo = $this->input->post('modtext');
        $damnm = $this->session->userdata('nm');

        //로그생성
        $sqls = "select * from ordermts where id = '{$this->id}' limit 1 ";
        $querys = $this->sparo2->query($sqls);
        $rows = $querys->row(); // row넘김

        $slog = $rows->bigo."\n/".date("Y-m-d H:i:s")." ".$damnm."메모변경:".$this->dammemo;
        $ssql = "update spadb.ordermts set
                dammemo ='{$this->dammemo}', 
                ordermts.bigo = '$slog'
                where ordermts.id = {$this->id} limit 1";
        $this->sparo2->query($ssql);

    }


    function orderN_modify_ch(){
        $this->sparo2 = $this->load->database('sparo2', TRUE);
        $this->id = $this->input->post('code');
        $modtext = $this->input->post('modtext');
        $modval = $this->input->post('modval');
        $damnm = $this->session->userdata('nm');

        //로그생성
        $sqls = "select * from ordermts where id = '{$this->id}' limit 1 ";
        $querys = $this->sparo2->query($sqls);
        $rows = $querys->row(); // row넘김


        $slog = $rows->bigo."\n/".date("Y-m-d H:i:s")." ".$damnm."채널변경:".$modtext;
        $ssql = "update spadb.ordermts set
                chnm ='$modtext', 
                ch_id ='$modval', 
                ordermts.bigo = '$slog'
                where ordermts.id = {$this->id} limit 1";
        $this->sparo2->query($ssql);

    }


    
    function orderN_modify_nm(){
    	$this->sparo2 = $this->load->database('sparo2', TRUE);
    	$this->id = $this->input->post('code');
    	$this->nm = $this->input->post('modtext');
    	//echo $this->id."/".$this->hp;
    
    	$damnm = $this->session->userdata('nm');
    	 
    	$sqls = "select * from ordermts where id = '{$this->id}' limit 1 ";
    	$querys = $this->sparo2->query($sqls);
    	$rows = $querys->row(); // row넘김

    	$slog = $rows->bigo."\n/".date("Y-m-d H:i:s")." ".$damnm."이름변경:".$this->nm;
    	 
    	$ssql = "update spadb.ordermts set
    	usernm = '{$this->nm}',
    	ordermts.bigo = '$slog'
    	where ordermts.id = {$this->id} limit 1";
    	$this->sparo2->query($ssql);

    	echo $slog;
    	 
    }

    function orderN_modify_dangu(){
        $this->sparo2 = $this->load->database('sparo2', TRUE);
        $this->id = $this->input->post('code');
        $this->dangu = $this->input->post('modtext');
        //echo $this->id."/".$this->hp;

        $damnm = $this->session->userdata('nm');

        $sqls = "select * from ordermts where id = '{$this->id}' limit 1 ";
        $querys = $this->sparo2->query($sqls);
        $rows = $querys->row(); // row넘김

        $slog = $rows->bigo."\n/".date("Y-m-d H:i:s")." ".$damnm."상품구분변경:".$this->dangu;

        $ssql = "update spadb.ordermts set
    	dangu = '{$this->dangu}',
    	ordermts.bigo = '$slog'
    	where ordermts.id = {$this->id} limit 1";
        $this->sparo2->query($ssql);

        echo $slog;

    }

    function orderN_modify_resno(){
        $this->sparo2 = $this->load->database('sparo2', TRUE);
        $this->id = $this->input->post('code');
        $this->resno = $this->input->post('modtext');
        //echo $this->id."/".$this->hp;

        $damnm = $this->session->userdata('nm');

        $sqls = "select * from ordermts where id = '{$this->id}' limit 1 ";
        $querys = $this->sparo2->query($sqls);
        $rows = $querys->row(); // row넘김

        $slog = $rows->bigo."\n/".date("Y-m-d H:i:s")." ".$damnm."예약번호변경:".$damnm;

        $ssql = "update spadb.ordermts set
    	resno = '{$this->resno}',
    	ordermts.bigo = '$slog'
    	where ordermts.id = {$this->id} limit 1";
        $this->sparo2->query($ssql);

        echo $slog;

    }
    
    function orderN_modify_usedate(){
    	$this->sparo2 = $this->load->database('sparo2', TRUE);
    	$this->id = $this->input->post('code');
    	$this->usedate = $this->input->post('modtext');
    	
    	$damnm = $this->session->userdata('nm');
    
    	$sqls = "select * from ordermts where id = '{$this->id}' limit 1 ";
    	$querys = $this->sparo2->query($sqls);
    	$rows = $querys->row(); // row넘김
    	
    	$slog = $rows->bigo."\n/".date("Y-m-d H:i:s")." ".$damnm."이용기간변경:".$this->usedate;
    	$ssql = "update spadb.ordermts set
    		usedate = '".$this->usedate."',
        	ordermts.bigo = '$slog'
        	where ordermts.id = {$this->id} limit 1";
    	$this->sparo2->query($ssql);

    	echo $slog;
    }
    
    function orderN_modify_hp(){
    	$this->sparo2 = $this->load->database('sparo2', TRUE);
    	$this->id = $this->input->post('code');
    	$this->hp = $this->input->post('modtext');
    	$this->lasthp = substr( $this->hp,-4,4);
    	//echo $this->id."/".$this->hp;
    
    	$damnm = $this->session->userdata('nm');
    
    	
    		$sqls = "select * from ordermts where id = '{$this->id}' limit 1 ";
    		$querys = $this->sparo2->query($sqls);
    		$rows = $querys->row(); // row넘김
    		$slog = $rows->bigo."\n/".date("Y-m-d H:i:s")." ".$damnm."HP변경:".$this->hp;
    		$ssql = "update spadb.ordermts set
    	hp = hex(aes_encrypt( '".$this->hp."', 'Wow1daY' )),
        	ordermts.bigo = '$slog'
        	where ordermts.id = {$this->id} limit 1";
    		$this->sparo2->query($ssql);

    		echo $slog;
    }
    
    function orderN_modify_qty(){
    	$this->sparo2 = $this->load->database('sparo2', TRUE);
    	$this->id = $this->input->post('code');
    	$this->man1 = $this->input->post('modtext');
    	//echo $this->id."/".$this->hp;
    	$damnm = $this->session->userdata('nm');

    	//뉴스파로 수정
    	$sqls = "select * from ordermts where id = '{$this->id}' limit 1 ";
    	$querys = $this->sparo2->query($sqls);
    	$rows = $querys->row(); // row넘김
    	$slog = $rows->bigo."\n/".date("Y-m-d H:i:s")." ".$damnm."수량변경:".$this->man1;
    	$ssql = "update spadb.ordermts set
    			man1 ='{$this->man1}',
    	ordermts.bigo = '$slog'
    	where ordermts.id = {$this->id} limit 1";
    	$this->sparo2->query($ssql);

    	echo $slog;
    	
    }

    function ordser()
    {
        $searchtxt = trim($this->input->post('searchtxt')); //노출채널(채널검색해서 중복입력)
        //$paramarr = array($searchtxt);                
        $data['searchtxt'] = $searchtxt;
        $this->session->set_userdata($data);
        $this->ordchk();
    }
    
    function ordserN()
    {
    	$searchtxt = trim($this->input->post('searchtxt')); //노출채널(채널검색해서 중복입력)
    	//$paramarr = array($searchtxt);
    	$data['searchtxt'] = $searchtxt;
    	$this->session->set_userdata($data);
    	$this->orderN();
    }

    function ordserN_dev()
    {

        $data['selectdate'] = trim($this->input->post('selectdate'));
        $data['sdate'] = trim($this->input->post('sdate'));
        $data['edate'] = trim($this->input->post('edate'));
        $data['usernm'] = trim($this->input->post('usernm'));
        $data['userhp'] = trim($this->input->post('userhp'));
        $data['orderno'] = trim($this->input->post('orderno'));
        $data['barcodeno'] = trim($this->input->post('barcodeno'));
        $data['grnm'] = trim($this->input->post('grnm'));
        $data['jpnm'] = trim($this->input->post('jpnm'));
        $data['itemnm'] = trim($this->input->post('itemnm'));
        $data['chnm'] = trim($this->input->post('chnm'));
        $data['ch_orderno'] = trim($this->input->post('ch_orderno'));
        $data['state'] = trim($this->input->post('state'));
        $data['usegu'] = trim($this->input->post('usegu'));
        $data['dammemo'] = trim($this->input->post('dammemo'));
        $data['offset'] = 0;

        $this->session->set_userdata($data);
        $this->orderN_dev();
    }

    function orderN_dev_offset($offset = 0)
    {

        $data['offset'] = $offset;
        $this->session->set_userdata($data);
        $this->orderN_dev();
    }

    function ajorder()
    {
    	
    	
        $this->id = $this->input->post('orid');
        $this->jpmt_id = $this->input->post('ojpid');
        $this->jpnm = $this->input->post('ojpnm');
        $this->barcode_no = $this->input->post('barcode');
        
        $msg = '';

        //398 휘닉스파크 블루캐니언
        //3332 휘닉스 스노우 리프트
        if($this->jpmt_id == 398 || $this->jpmt_id == 3332)
        {
            $msg = $this->phoenix_order_chk($this->barcode_no);
            echo $msg;
        }
        //2633 이마트피자
        else if($this->jpmt_id == 2633 || $this->jpmt_id == 86)
        {
        	$msg = $this->emart_order_chk($this->barcode_no);
        	echo $msg;
        	//echo $this->barcode_no;
        }
        //2615 원마운트 
        else if($this->jpmt_id == 2615 || $this->jpmt_id == 2644)
        {
            $msg = $this->onemount_order_chk($this->barcode_no);
            echo $msg;
        }
        //2615 아산스파비스
        //else if($this->jpmt_id == 316  || $this->jpmt_id == 2899)
        else if($this->jpmt_id == 9)
        {
        	$msg = $this->asan_order_chk($this->id);
        	echo $msg;
        	//echo $this->id;
        }
        //61 캐리비안베이
        //3336 에버랜드
        else if($this->jpmt_id == 61 || $this->jpmt_id == 3336)
        {
            $arrbarcode =explode(';',$this->barcode_no);
            foreach ($arrbarcode as $apincode):
                if($apincode!=""){
                    $msg = $this->everland_ticket_chk($apincode);
                    echo $msg."\n";
                }
            endforeach;
        }
        else
        {
        	if($msg == '' || $msg = null || !$msg){
            	echo "err|".$this->jpnm." 시설은 준비중입니다.";
        	}
        }
    }
    
    function ajdisuse()
    {
    	$this->id = $this->input->post('orid');
    	$this->jpmt_id = $this->input->post('ojpid');
    	$this->jpnm = $this->input->post('ojpnm');
    	$this->barcode_no = $this->input->post('barcode');
    	$msg = '';
    	//398 휘닉스파크 블루캐니언
        //3332 휘닉스 스노우 리프트
        if($this->jpmt_id == 398 || $this->jpmt_id == 3332)
    	{
    		$msg = $this->phoenix_disuse($this->barcode_no);
    		echo $msg;
    	}
    	//2615 원마운트
    	else if($this->jpmt_id == 2615 || $this->jpmt_id == 2644)
    	{
    		$msg = $this->onemount_disuse($this->barcode_no);
    		echo $msg;
    	}
    	//2633 이마트피자
        else if($this->jpmt_id == 2633 || $this->jpmt_id == 86)
    	{
    		$msg = $this->emart_disuse($this->barcode_no);
    		echo $msg;
    	}
    	//2615 아산스파비스
        //else if($this->jpmt_id == 316  || $this->jpmt_id == 2899)
        else if($this->jpmt_id == 9)
        {
    		$msg = $this->asan_disuse($this->id);
    		echo $msg;
        }
        //61 캐리비안베이
        //3336 에버랜드
        else if($this->jpmt_id == 61 || $this->jpmt_id == 3336)
        {
            $arrbarcode =explode(';',$this->barcode_no);
            foreach ($arrbarcode as $apincode):
                if($apincode!=""){
                    $msg = $this->everland_ticket_cancel($apincode);
                    echo $msg."\n";
                }
            endforeach;}
    	else
    	{
    		if($msg == '' || $msg = null || !$msg){
            	echo "err|".$this->jpnm." 시설은 준비중입니다.";
        	}
    	}
    }

    function or_use(){
        
        
        $this->id = $this->input->post('code');
        $this->usegu = $this->input->post('usegu');
        $usegu_at = date("Y-m-d H:i:s");
        
        $today = date("Y-m-d");
        $ip = $_SERVER['REMOTE_ADDR'] ;
        $oid = $this->input->post('code');
         
        $sqlg = "select * from ordermts where id = '$oid' limit 1 ";
        $rowg = $this->pcms->query($sqlg)->row();

        if($this->usegu == '1'){

            //소셜 리셋 테이블
            if ($oid != '')
            {

                switch($rowg->ch_id){
                    case '150':
                        $gu = 'C';
                        break;
                    case '142':
                        $gu = 'W';
                        break;
                    case '1395':
                    case '154':
                        $gu = 'T';
                        break;
                    default:
                        $gu = 'P';
                }
                $this->sparo2->query("insert spadb.log_tempuse set type='USE', no = '$oid',regdate='$usegu_at', ip = '$ip', usercd='0'");
            }
        }else if($this->usegu == '2'){
            $usegu_at = null;
            //소셜 리셋 테이블
            if ($oid != '')
            {
            	
            	switch($rowg->ch_id){
            		case '150':
            			$gu = 'C';
            			break;
            		case '142':
            			$gu = 'W';
            			break;
            		case '1395':
                    case '154':
            			$gu = 'T';
            			break;
            		default:
            			$gu = 'P';
            	}
            	$this->bar->query("insert bar_reset set gu='$gu', regdate=now() , no='".$rowg->barcode_no."',ip='$ip'");
            }
        }
        
        $data = array(
        		'usegu' => $this->usegu,
        		'usegu_at' => $usegu_at
        );
        $this->pcms->where('id', $this->id); 
        if($this->pcms->update('ordermts', $data)){
            echo "ok";
            //$this->sparo2->where('pcms_oid', $this->id);
           // $this->sparo2->update('ordermts', $data);
        }else{
        	echo "err";
        }
        
        if($rowg->sync_sparo2 == 'Y'){
        	
        	$data = array(
        			'usegu' => $this->usegu,
        			'usegu_at' => $usegu_at,
        			'ip' => $_SERVER['REMOTE_ADDR']
        	);
        	
        	$this->sparo2 = $this->load->database('sparo2', TRUE);
        	$sqls = "select * from ordermts where pcms_oid = '$oid' limit 1 ";
        	$querys = $this->sparo2->query($sqls);
        	$rows = $querys->row(); // row넘김
        	$this->sparo2->update('ordermts', $data,array('id' => $rows->id));

        }
    }

    function sms_resend(){
        $this->sparo2 = $this->load->database('sparo2', TRUE);
        $this->id = $this->input->post('orid');

        $this->load->model('nsparomodel');

        $this->result = $this->nsparomodel->smsgu($this->id,'S');
        if($this->result){
            echo "ok";
        }else{
            echo "err";
        }

    }
    
    function or_use_N(){
    
    	$this->sparo2 = $this->load->database('sparo2', TRUE); 	
    	$this->id = $this->input->post('code');
    	$this->usegu = $this->input->post('usegu');
    	$usegu_at = date("Y-m-d H:i:s");
    
    	$today = date("Y-m-d");
    	$ip = $_SERVER['REMOTE_ADDR'] ;
    	$oid = $this->input->post('code');
    	     	
    	$sqls = "select * from ordermts where id = '$oid' limit 1 ";
    	$querys = $this->sparo2->query($sqls);
    	$rows = $querys->row(); // row넘김

        if($this->usegu == '1'){

            $this->sparo2->query("insert spadb.log_tempuse set type='USE', no = '".$rows->id."',regdate='$usegu_at', ip = '$ip', usercd='0'");

        }else if($this->usegu == '2'){
    		$usegu_at = null;
    		//소셜 리셋 테이블
    		if ($oid != '')
    		{
    			 
    			switch($rows->ch_id){
    				case '150':
    					$gu = 'C';
    					break;
    				case '142':
    					$gu = 'W';
    					break;
    				case '1395':
                    case '154':
    					$gu = 'T';
    					break;
    				default:
    					$gu = 'P';
    			}
    			$this->bar->query("insert bar_reset set gu='$gu', regdate=now() , no='".$rows->barcode_no."',ip='$ip'");
    		}
    	}
    	$data = array(
    				'usegu' => $this->usegu,
    				'usegu_at' => $usegu_at,
    				'ip' => $_SERVER['REMOTE_ADDR']
    	);
    	$res1 = $this->sparo2->update('ordermts', $data,array('id' => $rows->id));

    	if($res1 ){
    		echo "ok";
    	}else{
    		echo "err";
    	}
    }

    function order_state(){    	// 사용된 주문이면 상태 변경할수 없음 , 뉴스파로에 사용된 주문이면 pcms에도 사용처리
    	$order_id = $this->input->post('code');
    	$pcms_state = $this->input->post('state');
    	$nsparo_state = $this->input->post('state');
    	if($pcms_state == "확정"){
    		$nsparo_state = "예약완료";
    	}

    	//사용여부 조회
    	$sql = "select * from spadb.ordermts where pcms_oid = '$order_id'";
    	$query = $this->sparo2->query($sql);
    	if ($query->num_rows() > 0)
    	{
    		$row = $query->row();
    		$Nusegu =  $row->usegu;	//뉴스파로 사용여부
    		if($Nusegu == '1'){ //조회한김에 사용이면  pcms 사용처리
    			$usepcmssql = "update terp_placem.ordermts set usegu = '1', usegu_at = '$row->usegu_at' where id = '$order_id' limit 1";
    			$this->pcms->query($usepcmssql);
    			if($pcms_state != "확정"){
    				echo "err|사용된 주문입니다.";
    			}
    		}
    	}else{
    		$Nusegu = '2';
    	}
    	$this->pcms->where('id', $order_id);  	
    	$pcmsorder = $this->pcms->get('ordermts');
    	$pcmsrow = $pcmsorder->row();
    	$Pusegu =  $pcmsrow->usegu;	//뉴스파로 사용여부
    	
    	if($Nusegu == '2' || $Pusegu == '2' || $pcms_state == "확정"){	//미사용이거나 확정으로 전화할때
    		$statepcmssql = "update terp_placem.ordermts set state = '$pcms_state' where id = '$order_id' limit 1";
    		$statesparosql = "update spadb.ordermts set state = '$nsparo_state',ip = '".$_SERVER['REMOTE_ADDR']."' where pcms_oid = '$order_id' limit 1";
    		if(!$this->pcms->query($statepcmssql) & !$this->sparo2->query($statesparosql)){
    			echo "err|변경실패";
    		}else{
    			echo "ok|저장완료";
    		}
    	}
    }
    
    function orderN_state(){    
    	$this->sparo2 = $this->load->database('sparo2', TRUE);
    	
    	$order_id = $this->input->post('code');
    	$nsparo_state = $this->input->post('state');
    	

    	//사용여부 조회
    	$sql = "select * from spadb.ordermts where id = '$order_id'";
    	$query = $this->sparo2->query($sql);
    	
    	if ($query->num_rows() > 0)
    	{
    		$row = $query->row();
    		$Nusegu =  $row->usegu;	//뉴스파로 사용여부
    		if($Nusegu == '1'){ 
    			echo "err|사용된 주문입니다.";
    		}else{

                $damnm = $this->session->userdata('nm');
                $slog = $row->bigo."\n/".date("Y-m-d H:i:s")." ".$damnm."주문상태변경:".$nsparo_state;
    			
    			$statesparosql = "update spadb.ordermts set state = '$nsparo_state',ip = '".$_SERVER['REMOTE_ADDR']."', bigo = '$slog'  where id = '$order_id' limit 1";
    			if( !$this->sparo2->query($statesparosql)){
    				echo "err|변경실패";
    			}else{
    				echo "ok|저장완료";
    			}
    		}
    	}else{
    		echo "err|변경실패";
    	}
    }
    
    function or_decide(){
    	$pcms_orderno = $this->input->post('code');
    	$pdata = array('state' => '확정');
    	$this->pcms->where('orderno', $pcms_orderno);
    	
    	$sdata = array('state' => '예약완료');
    	$this->sparo2->where('orderno', $pcms_orderno);
    	
    	if(!$this->pcms->update('ordermts', $pdata) & !$this->sparo2->update('ordermts', $sdata)){
    		echo "err";
    	}else{
    		echo "ok";
    	}
    }

    function onemount_order_chk($bcno = ''){
    	$resultmsg = "";
    	//$barbool = "err|";
    	$ch = curl_init(); 
    	//$arrbarcode =explode(';',$this->barcode_no);
    	
    	if($bcno != 0 && $bcno != null){
    		//$barbool = "ok|";
    		$url = "http://dev.sparo.co.kr/onemount/api_om_orderchk.php?barcode=".$bcno;
    		//$phmsg = file_get_contents($url);
    		$phmsg = $this->get_curl($url,$ch);
    		$omsg =explode(';',$phmsg);
    		if($omsg[0]=='Y'){
    			$resultmsg .= "판매코드\n";
    			if($omsg[1]=='Y'){
    				$resultmsg .= "사용됨\n";
    			}else{
    				$resultmsg .= "미사용\n";
    			}
    		}else{
    			$resultmsg .= "미확인 또는 폐기코드\n";
    		}
    		
    	}
    	//}//foreach
    	return $resultmsg;
    }

    function everland_ticket_chk($bcno = ''){
        $this->sparo2 = $this->load->database('sparo2', TRUE);
        $this->bar = $this->load->database('bar', TRUE);
        $this->chapi = $this->load->database('chapi', TRUE);

        $this->load->library('syncEverland');
        $searchRes = json_decode($this->synceverland->GetSync($bcno));

        switch ($searchRes->PIN_STATUS){
            //사용
            case 'UC':
            case 'UR':
                $sql = "update spadb.pcms_extcoupon set state_use = 'Y',date_use = now() WHERE couponno = '{$bcno}' and state_use != 'Y' limit 1";
                $this->sparo2->query($sql);

                $sql = "update pcmsdb.cms_extcoupon set state_use = 'Y',date_use = now() WHERE no_coupon = '{$bcno}' and state_use != 'Y' limit 1";
                $this->db->query($sql);

                $bsql = "update spadb.barev_2014 set useyn = 'Y',usedate = now() WHERE no = '{$bcno}' and useyn != 'Y' limit 1";
                $this->bar->query($bsql);

                $bbsql = "update cmsdb.cms_extcoupon set state_use = 'Y',date_use = now() WHERE no_coupon = '{$bcno}' and state_use != 'Y' limit 1";
                $this->chapi->query($bbsql);

                break;
            //구매취소

            case 'PC':

                $sql = "update spadb.pcms_extcoupon set state_use = 'C',date_cancel = now() WHERE couponno = '{$bcno}' and state_use != 'C' limit 1";
                $this->sparo2->query($sql);

                $sql = "update pcmsdb.cms_extcoupon set state_use = 'C',date_cancel = now()  WHERE no_coupon = '{$bcno}' and state_use != 'C' limit 1";
                $this->db->query($sql);

                $bsql = "update spadb.barev_2014 set useyn = 'C',canceldate = now() WHERE no = '{$bcno}' and useyn != 'C' limit 1";
                $this->bar->query($bsql);

                $bbsql = "update cmsdb.cms_extcoupon set state_use = 'C',date_cancel = now()  WHERE no_coupon = '{$bcno}' and state_use != 'C' limit 1";
                $this->chapi->query($bbsql);

                break;
            //미사용

            case 'PS':
            case 'CR':

                $sql = "update spadb.pcms_extcoupon set state_use = 'N' WHERE couponno = '{$bcno}' and state_use != 'N' limit 1";
                $this->sparo2->query($sql);

                $sql = "update pcmsdb.cms_extcoupon set state_use = 'N' WHERE no_coupon = '{$bcno}' and state_use != 'N' limit 1";
                $this->db->query($sql);

                $bsql = "update spadb.barev_2014 set useyn = 'N' WHERE no = '{$bcno}' and useyn != 'N' limit 1";
                $this->bar->query($bsql);

                $bbsql = "update cmsdb.cms_extcoupon set state_use = 'N' WHERE no_coupon = '{$bcno}' and state_use != 'N' limit 1";
                $this->chapi->query($bbsql);
                break;
        }

        return $bcno."=>".$searchRes->RMSG;
    }

    function everland_ticket_cancel($bcno = ''){
        $this->load->library('syncEverland');
        $searchRes = json_decode($this->synceverland->PatchSync($bcno));

        if($searchRes->RCODE == 'S'){

            $this->sparo2 = $this->load->database('sparo2', TRUE);
            $this->bar = $this->load->database('bar', TRUE);
            $this->chapi = $this->load->database('chapi', TRUE);

            $sql = "update spadb.pcms_extcoupon set state_use = 'C',date_cancel = now() WHERE couponno = '{$bcno}' and state_use != 'C' limit 1";
            $this->sparo2->query($sql);

            $sql = "update pcmsdb.cms_extcoupon set state_use = 'C',date_cancel = now()  WHERE no_coupon = '{$bcno}' and state_use != 'C' limit 1";
            $this->db->query($sql);

            $bsql = "update spadb.barev_2014 set useyn = 'C',canceldate = now() WHERE no = '{$bcno}' and useyn != 'C' limit 1";
            $this->bar->query($bsql);

            $bbsql = "update cmsdb.cms_extcoupon set state_use = 'C',date_cancel = now()  WHERE no_coupon = '{$bcno}' and state_use != 'C' limit 1";
            $this->chapi->query($bbsql);
        }

        return $bcno."=>".$searchRes->RMSG."(".$searchRes->RCODE.")";
	}
    
    function asan_order_chk($id = ''){
    	$this->load->model('pcmsmodel');
    	$this->load->model('cmsmodel');
    	$resultmsg = "";
    	$ch = curl_init();
    	if($id != 0 && $id != null){

    		$asanOrderRow = $this->cmsmodel->get_asan_order($id);
    		$ORDER_NO = $asanOrderRow->ORDER_NO;
    	
    		//echo $ORDER_NO;
    		if($ORDER_NO == '' || $ORDER_NO == null){
    			$resultmsg .= $ORDER_NO.": 조회불가주문\n";
    		}else{
    			 
    			$asanCoupon = $this->cmsmodel->get_asan_coupon($ORDER_NO);
    			$coupon_nos="";
    			foreach($asanCoupon->result() as $asanCouponrow):
    				$coupon_nos .=$asanCouponrow->COUPON_NO.",";
    			endforeach;
    			$coupon_nos = urlencode(substr($coupon_nos, 0, -1));
	    			
    			$site = "http://www.spavis.co.kr"; //테스트  http://spmonitor.spavis.co.kr
    			$url= $site."/social_interface/socif03.asp?CUST_ID=".$asanOrderRow->CUST_ID."&order_no=".$ORDER_NO."&coupon_no=".$coupon_nos;
    			//$url = $site."/social_interface/socif03.asp?CUST_ID=410660&order_no=".$orderno."&coupon_no=".$barcode_no;
    			//$resultmsg .= $url."\n";
    			
    			 $xml = simplexml_load_file($url);
    	
    			 $rtn_div=$xml->rtn_div;
    			 $rtn_msg=$xml->rtn_msg;
    	
    			 if($rtn_div == "F"){
	    			 $resultmsg .= "조회실패\n";
	    			 $resultmsg .= $rtn_msg."\n";
    			 }else if($rtn_div == "S"){
	    			 $resultmsg .= "조회성공\n";
	    			 $rtn_coupons=$xml->rtn_coupons;
	    			 
	    			 foreach ($rtn_coupons->rtn_coupon as $element) {
	    			 	$rtn_coupon_no = "";
	    			 	$rtn_status_div = "";
	    			 	$rtn_result_date = "";
	    			 	foreach($element->children() as $key => $val) {
	    			 		if("rtn_coupon_no" == $key) $rtn_coupon_no = $val;
	    			 		if("rtn_status_div" == $key) $rtn_status_div = $val;
	    			 		if("rtn_result_date" == $key) $rtn_result_date = $val;
	    			 	}
	    			 	//$resultmsg .= $rtn_coupon_no."\n";
	    			 	//$resultmsg .= $rtn_status_div."\n";
	    			 	//$resultmsg .= $rtn_result_date."\n";
	    			 	switch ($rtn_status_div){
	    			 		case "R":
	    			 			$resultmsg .= $rtn_coupon_no."=예약\n";
	    			 			break;
	    			 		case "N":
	    			 			$resultmsg .= $rtn_coupon_no."=미사용\n";
	    			 			break;
	    			 		case "I":
	    			 			$resultmsg .= $rtn_coupon_no."=사용\n";
	    			 			$resultmsg .= $rtn_result_date."\n";
	    			 			break;
	    			 		case "C":
	    			 			$resultmsg .= $rtn_coupon_no."=취소\n";
	    			 			$resultmsg .= $rtn_result_date."\n";
	    			 			break;
	    			 		default:
	    			 			$resultmsg .= $rtn_coupon_no."=조회실패\n";
	    			 			$resultmsg .= $rtn_div."=".$rtn_status_div."\n";
	    			 			break;
	    			 	}
	    			 }
	    		 }else{
	    			 $resultmsg .= "조회실패\n";
	    			 $resultmsg .= $rtn_div."\n";
    			 }	
    			
    		}
    	}
    	
    	
    	return $resultmsg;
    }
    
    function asan_disuse($id = ''){
    	$this->load->model('pcmsmodel');
    	$this->load->model('cmsmodel');
    	$resultmsg = "";
    	$url="";
    	$ch = curl_init();
    	if($id != 0 && $id != null){

    		$asanOrderRow = $this->cmsmodel->get_asan_order($id);
    		$ORDER_NO = $asanOrderRow->ORDER_NO;
    	
    		if($ORDER_NO == '' || $ORDER_NO == null){
    			$resultmsg .= $ORDER_NO.": 조회불가주문\n";
    		}else{
    			 
    			$asanCoupon = $this->cmsmodel->get_asan_coupon($ORDER_NO);
    			$coupon_nos="";
    			foreach($asanCoupon->result() as $asanCouponrow):
    				$coupon_nos .=$asanCouponrow->COUPON_NO.",";
    			endforeach;
    			$coupon_nos = urlencode(substr($coupon_nos, 0, -1));
	    			
    			$site = "http://www.spavis.co.kr"; //테스트  http://spmonitor.spavis.co.kr
    			$url= $site."/social_interface/socif04.asp?CUST_ID=".$asanOrderRow->CUST_ID."&order_no=".$ORDER_NO."&coupon_no=".$coupon_nos;

    			
    			 $xml = simplexml_load_file($url);
    	
    			 $rtn_div=$xml->rtn_div;
    			 $rtn_msg=$xml->rtn_msg;
    	
    			 if($rtn_div == "F"){
	    			 $resultmsg .= "쿠폰 폐기 실패\n";
	    			 $resultmsg .= $rtn_msg."\n";
    			 }else if($rtn_div == "S"){
	    			 $resultmsg .= "쿠폰 폐기 성공\n";
	    			 $rtn_coupons=$xml->rtn_coupons;
	    			 
	    			 foreach ($rtn_coupons->rtn_coupon as $element) {
	    			 	$rtn_coupon_no = "";
	    			 	$rtn_status_div = "";
	    			 	$rtn_result_date = "";
	    			 	foreach($element->children() as $key => $val) {
	    			 		if("rtn_coupon_no" == $key) $rtn_coupon_no = $val;
	    			 		if("rtn_status_div" == $key) $rtn_status_div = $val;
	    			 		if("rtn_result_date" == $key) $rtn_result_date = $val;
	    			 	}
	    			 	switch ($rtn_status_div){
	    			 		case "R":
	    			 			$resultmsg .= $rtn_coupon_no."=예약\n";
	    			 			break;
	    			 		case "N":
	    			 			$resultmsg .= $rtn_coupon_no."=미사용\n";
	    			 			break;
	    			 		case "I":
	    			 			$resultmsg .= $rtn_coupon_no."=사용\n";
	    			 			$resultmsg .= $rtn_result_date."\n";
	    			 			break;
	    			 		case "C":
	    			 			$resultmsg .= $rtn_coupon_no."=취소\n";
	    			 			$resultmsg .= $rtn_result_date."\n";
	    			 			break;
	    			 		default:
	    			 			$resultmsg .= $rtn_coupon_no."=조회실패\n";
	    			 			$resultmsg .= $rtn_div."=".$rtn_status_div."\n";
	    			 			break;
	    			 	}
	    			 }
	    		 }else{
	    			 $resultmsg .= "조회실패\n";
	    			 $resultmsg .= $rtn_div."\n";
    			 }	
    		}
    	}
    	
    	
    	return $resultmsg;
    }


    function onemount_disuse($bcno = ''){
    	$resultmsg = "";
    	//$barbool = "err|";
    	$ch = curl_init();
    	//$arrbarcode =explode(';',$this->barcode_no);
    	 
    	if($bcno != 0 && $bcno != null){
    		//$barbool = "ok|";
    		$url = "http://dev.sparo.co.kr/onemount/api_om_orderchk_cancel.php?barcode=".$bcno;
    		//$phmsg = file_get_contents($url);
    		$phmsg = $this->get_curl($url,$ch);
    		//$resultmsg = $phmsg;
    		
    		switch ($phmsg) {
    			case 'NO':
    				$resultmsg .= "조회불가 또는 폐기된 번호";
    				break;
    			case 'use':
    				$this->sparo2 = $this->load->database('sparo2', TRUE);
    				$data = array(
    						'state' => 'Y'
    				);
    				$this->sparo2->where('no', $bcno);
    				$result = $this->sparo2->update('om_ordermts', $data);
    				
    				$resultmsg .= "사용된 번호";
    				break;
    			case '1cancel':
    				$this->sparo2 = $this->load->database('sparo2', TRUE);
    				$data = array(
    						'state' => 'C',
    						'Canceled_at' => date("Y-m-d H:i:s")
    				);
    				$this->sparo2->where('no', $bcno);
    				$result = $this->sparo2->update('om_ordermts', $data);
    				
    				$resultmsg .= "취소완료";
    				break;
    			default:
    				$resultmsg .= "조회불가";
    			break;
    		}
    	}
    	//}//foreach
    	return $resultmsg;
    }
    
    function emart_order_chk($bcno = ''){
    	$this->sparo2 = $this->load->database('sparo2', TRUE);
    	$resultmsg = "";
    	$barbool = "err|";
    	//$arrbarcode =explode(';',$this->barcode_no);
    	if($bcno != 0 && $bcno != null){
    		
    		$arrbcno = explode(";",$bcno);
    		foreach($arrbcno as $no){
	    		$query = $this->sparo2->get_where('bar_emart', array('no' => $no),1);
	    		$row = $query->row();
	    		
	    		if ($query->num_rows() > 0)
	    		{
	    			foreach ($query->result() as $row)
	    			{
	    				if($row->useyn == "Y"){ 
	    					$resultmsg .= $no." : 사용된 번호입니다."; 
	    				}else if($row->useyn == "N"){
	    					$resultmsg .= $no." : 미사용 번호입니다.";
	    				}else if($row->useyn == "C"){
	    					$resultmsg .= $no." : 폐기된 번호입니다.";
	    				}
	    				$resultmsg .=  "\n";
	    			}
	    		}
    		}
    	}
    	return $resultmsg;
    }
    
    
    
    function emart_disuse($bcno = ''){
    	
    	$resultmsg = $this->emart_order_chk($bcno);
    	//사용이나 폐기상태이면 폐기불가.
    	if(strpos($resultmsg,"사용된") || strpos($resultmsg,"폐기")){
    		return $resultmsg;
    	}else if($bcno != 0 && $bcno != null){
    		$cancelmsg = "";
    		$arrbcno = explode(";",$bcno);
    		foreach($arrbcno as $no){
    			$query = $this->sparo2->get_where('bar_emart', array('no' => $no),1);
    			$row = $query->row();

    			if ($query->num_rows() > 0)
    			{
    				foreach ($query->result() as $row)
    				{
    					if($row->useyn == "N"){
    						if($this->session->userdata('cd')){
    							$charge = $this->session->userdata('cd');
    						}else{
    							$charge = "관리자";
    						}
    						$data = array(
    								'useyn' => 'C',
    								'canceldate' => date("Y-m-d H:i:s"),
    								'ip' => $_SERVER["REMOTE_ADDR"],
    								'charge' => $charge
    						);
    						$this->sparo2->where('no', $no);
    						$result = $this->sparo2->update('bar_emart', $data);
    						if ($result)
    						{
    							$cancelmsg .= $no." 폐기성공";
    						}
    						else
    						{
    							$cancelmsg .= $no." 폐기실패";
    						}	
    					}
    					$cancelmsg .= "\n";
    				}
    			}
    		}
    		return $cancelmsg;
    	} 
    }


    function everland_order_chk($no = ''){
        $resultmsg = "";
        //$barbool = "err|";

        $arrbarcode =explode(';',$no);

        foreach ($arrbarcode as $bcno) {
            $ch = curl_init();
            if($bcno != 0 && $bcno != null){
                $bcno = str_replace(";", "", $bcno);

                $url= "http://117.52.116.42/Interface/Ticket/ResQuery.aspx?barcode=".$bcno;
                $json = $this->get_curl($url,$ch);
                $arr = json_decode($json, true);
                $phmsg = $arr['msg'];

                switch ($phmsg) {
                    case 'DBOK00':
                        $resultmsg .= "정상 예매";
                        break;
                    case 'DBOK97':
                        $resultmsg .= "사용내역이 있습니다.";
                        break;
                    case 'DBOK98':
                        $resultmsg .= "모두 사용하였습니다.";
                        break;
                    case 'DBOK99':
                        $resultmsg .= "이미 취소되었습니다.";
                        break;
                    case 'DBER01':
                        $resultmsg .= "파라미터값 에러";
                        break;
                    case 'DBER02':
                        $resultmsg .= "구입내역이 없음";
                        break;
                    default:
                        $resultmsg .= "조회불가";
                        break;
                }

                //$phmsg = file_get_contents($url);
            }
            $resultmsg .= "\n";
        }//foreach
        return $resultmsg;
    }

    function phoenix_order_chk($no = ''){
        $resultmsg = "";
        //$barbool = "err|";

        $arrbarcode =explode(';',$no);

        foreach ($arrbarcode as $bcno) {
            $ch = curl_init();
            if($bcno != 0 && $bcno != null){
            	$bcno = str_replace(";", "", $bcno);
                //$barbool = "ok|";
                //$url = "http://www.phoenixresort.co.kr/interface/mobile_bookg_query.aspx?barcode=".$bcno;
                $orrow = $this->phoenix_get_order($bcno);
                $divs = $orrow->divs;
                if($divs == "SIN"){
                	$url= "http://117.52.116.42/Interface/Ticket/ResQuery.aspx?barcode=".$bcno;
                    //$url= "http://117.52.116.42/Interface/Ticket/SetQuerys.aspx?tcode={$orrow->typecd}&barcode={$bcno}";
                    //$resultmsg .= $url;
                	$json = $this->get_curl($url,$ch);
                	$arr = json_decode($json, true);
                	$phmsg = $arr['msg'];
                	
                	switch ($phmsg) {
                		case 'DBOK00':
                			$resultmsg .= "정상 예매";
                			break;

                        case 'DBOK97':
                            $resultmsg .= "사용내역이 있습니다.";
                            break;

                        case 'DBOK98':
                            $resultmsg .= "모두 사용하였습니다.";
                            break;

                		case 'DBOK99':
                			$resultmsg .= "이미 취소되었습니다.";
                			break;

                		case 'DBER01':
                			$resultmsg .= "파라미터 에러";
                			break;
                		case 'DBER02':
                			$resultmsg .= "구매내역 없음";
                			break;

                		default:
                			$resultmsg .= "조회불가";
                			break;
                	}
                }else{
                	$url= "http://117.52.116.42/Interface/Ticket/SetQuerys.aspx?tcode=".$orrow->tcode."&barcode=".$bcno; //3인세트권 권종코드

                	$json = $this->get_curl($url,$ch);
                	
                	$arr = json_decode($json, true);

                	$phmsg = $arr['msg'];
                	$baritem = $arr['items'][0];
                	
                	//print_r($arr);
                	switch ($phmsg) {
                		case 'DBOK00':
                			$resultmsg .= "사용 내역 존재 (".$baritem['ucnt']."/".$baritem['cnt'].")";
                			
                		break;
                		case 'DBOK01':
                			$resultmsg .= "미사용 (".$baritem['ucnt']."/".$baritem['cnt'].")";
                		break;
                		case 'DBOK99':
                			$resultmsg .= "취소완료";
                		break;
                		case 'DBER01':
                			$resultmsg .= "파라미터 에러(권종코드값 없음)";
                		break;
                		case 'DBER02':
                			$resultmsg .= "파라미터 에러(바코드값 없음)";
                		break;
                		case 'DBER03':
                			$resultmsg .= "결과값 없음";
                		break;
                		
                		default:
                			$resultmsg .= "조회불가";
                			break;
                	}
                }
                //$phmsg = file_get_contents($url);
            }
            $resultmsg .= "\n";
        }//foreach
        return $resultmsg;
    }

    function phoenix_order_chk_api($bcno = ''){
        $result = "E";

        $ch = curl_init();
        if($bcno != 0 && $bcno != null){
            $bcno = str_replace(";", "", $bcno);
            $orrow = $this->phoenix_get_order($bcno);
            $divs = $orrow->divs;
            if($divs == "SIN"){
                $url= "http://117.52.116.42/Interface/Ticket/ResQuery.aspx?barcode=".$bcno;
                $json = $this->get_curl($url,$ch);
                $result =$json;
            }else{
                $url= "http://117.52.116.42/Interface/Ticket/SetQuerys.aspx?tcode=".$orrow->tcode."&barcode=".$bcno; //3인세트권 권종코드
                $json = $this->get_curl($url,$ch);
                $result =$json;
            }
        }
        echo $result;
    }
    
    function phoenix_get_order($barcode){
    	$this->sparo2 = $this->load->database('sparo2', TRUE);
    	$getqry = "SELECT * FROM spadb.bg_ordermts WHERE no = '$barcode' order by id desc limit 1";
    	return $this->sparo2->query($getqry)->row(); // 쿼리불러옴
    }

    function phoenix_disuse_api($bcno = ''){

        $result = "E";
        $ch = curl_init();
        if($bcno != 0 && $bcno != null){
            $bcno = str_replace(";", "", $bcno);
            $orrow = $this->phoenix_get_order($bcno);
            $divs = $orrow->divs;

            if($divs == "SIN"){
                $url = "http://117.52.116.42/Interface/Ticket/ResCancel.aspx?barcode=".$bcno;

                //$url= "http://117.52.116.42/Interface/Ticket/SetCancel.aspx?barcode={$bcno}&hp={$orrow->hp}&orderdate={$orrow->saledate}&cnt={$orrow->qty}";

                $json = $this->get_curl($url,$ch);
                $result =$json;
            }else{

                $url= "http://117.52.116.42/Interface/Ticket/SetCancel.aspx?hp=".str_replace("-", "", $orrow->hp)."&orderdate=".$orrow->saledate."&cnt=".$orrow->qty."&barcode=".$bcno; //3인세트권 권종코드
                $json = $this->get_curl($url,$ch);
                $result =$json;
            }
        }
        echo $result;
    }
    
    function phoenix_disuse($no = ''){
    	$resultmsg = "";
        $arrbarcode =explode(';',$no);

        foreach ($arrbarcode as $bcno) {
            $ch = curl_init();
            if($bcno != 0 && $bcno != null){
                $bcno = str_replace(";", "", $bcno);
                $orrow = $this->phoenix_get_order($bcno);
                $divs = $orrow->divs;

                if($divs == "SIN"){
                    //$url = "http://www.phoenixresort.co.kr/interface/mobile_bookg_all_cancel.aspx?barcode=".$bcno;
                    $url = "http://117.52.116.42/Interface/Ticket/ResCancel.aspx?barcode=".$bcno;
                    //$url = "http://117.52.116.42/Interface/Ticket/SetCancel.aspx?barcode={$bcno}&hp={$orrow->hp}&orderdate={$orrow->saledate}&cnt={$orrow->qty}";

                    //$phmsg = file_get_contents($url);
                    //$phmsg = $this->get_curl($url,$ch);
                    $json = $this->get_curl($url,$ch);
                    $arr = json_decode($json, true);
                    $phmsg = $arr['msg'];
                    switch ($phmsg) {
                        case 'DBOK00':
                            $resultmsg .= "정상취소";
                            break;
                        case 'DBER01':
                            $resultmsg .= "파라미터값 에러";
                            break;
                        case 'DBER02':
                            $resultmsg .= "구입내역이 없음";
                            break;
                        case 'DBER03':
                            $resultmsg .= "사용내역이 있음";
                            break;
                        case 'DBER04':
                            $resultmsg .= "모두 사용 하였음";
                            break;
                        case 'DBER05':
                            $resultmsg .= "이미 취소 되었음";
                            break;

                        default:
                            $resultmsg .= "조회불가";
                            break;
                    }
                }else{

                    $url= "http://117.52.116.42/Interface/Ticket/SetCancel.aspx?hp=".str_replace("-", "", $orrow->hp)."&orderdate=".$orrow->saledate."&cnt=".$orrow->qty."&barcode=".$bcno; //3인세트권 권종코드
                    $json = $this->get_curl($url,$ch);
                    $arr = json_decode($json, true);
                    //print_r($arr);
                    $phmsg = $arr['msg'];
                    //print_r($arr);
                    switch ($phmsg) {
                        case 'DBOK00':
                            $resultmsg .= "정상처리";
                        break;
                        case 'DBER01':
                            $resultmsg .= "파라미터 에러";
                        break;
                        case 'DBER02':
                            $resultmsg .= "구매정보 없어 취소 불가";
                        break;
                        case 'DBER03':
                            $resultmsg .= "취소 가능수량 없어 취소 불가";
                            break;
                        case 'DBER04':
                            $resultmsg .= "이용실적이 있어 취소 불가";
                        break;
                        case 'DBER05':
                            $resultmsg .= "취소 요청 수량이 남은 수량보다 많아 취소 불가";
                        break;

                        default:
                            $resultmsg .= "조회불가";
                        break;
                    }
                }

            }
            $resultmsg .= "\n";
    	}//foreach
    	return $resultmsg;
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
	

	function sms($mode = ''){

			$viewtable = false;
			$searchtxt = trim($this->input->post('searchtxt'));
			$nYM = trim($this->input->post('YM'));
			$YM = date("Ym");
			if($nYM != '' && $nYM != null && $nYM != 'new'){
				$YM = $nYM;
				if($YM == "201603")$YM = "201604";
			}
			$data['YM'] = $YM;
			$tablename = "MSG_RESULT_".$YM;
			//$tablename = "MSG_RESULT_201602";
			$resultcode = array(
                '0' => '성공',
                '100' => '서버실패 (프로세스 프로세스 또는 시스템 에러 )',
                '101' => '일시적 용량 초과',
                '102' => '인증실패 - 패스워드 패스워드 틀림',
                '103' => '중지된 고객',
                '104' => '미등록 고객',
                '105' => '이미 연결 됨',
                '106' => '미지원 버젼',
                '107' => 'sms 발송 권한 없음',
                '108' => 'mms 발송 권한 없음',
                '109' => 'isms 발송 권한 없음',
                '110' => '네트웍 에러 발생',
                '111' => '바인드 되지 않음',
                '112' => '암호화 에러',
                '113' => '복호화 에러',
                '200' => '기대하지 않은 Head 또는 헤더필드의 부적절',
                '201' => 'Body 필드의 부적절',
                '202' => '규격 오류',
                '203' => '발/착신 번호 에러',
                '204' => '컨텐츠 크기 오류',
                '205' => '컨텐츠 크기 초과',
                '206' => '첨부파일 개수 오류',
                '207' => '지원하지 않는 컨텐츠 존재',
                '208' => '컨텐츠 관련 기타',
                '209' => '시리얼 넘버 오류 (크기 초과등 초과등 )',
                '210' => '잘못된 메시지 메시지 타입',
                '211' => '동보 전송수 초과',
                '212' => '초당 처리 건수 초과',
                '300' => '일발송량 초과',
                '301' => '월발송량 초과',
                '302' => '발송제한시간',
                '303' => '잔액 부족',
                '304' => '중복발송',
                '305' => '요청시간 오류 - pc client에서 사용',
                '306' => '전화번호 세칙 미준수 발신번호 사용',
                '307' => '사전 미등록 발신번호 사용',
                '308' => '발신번호 변작으로 등록된 발신번호 사용',
                '309' => '번호도용문자차단서비스에 가입된 발신번호 사용',
                '400' => '라우팅 정보 없음',
                '401' => '착신번호 스팸',
                '402' => '스팸 메시지',
                '403' => '메시지 크기 초과',
                '404' => '실시간 전송 실패',
                '405' => 'gw 자체 expired : 리포트 미수신',
                '406' => 'gw 자체 expired : 미전송',
                '407' => '첨부파일 관련 에러',
                '408' => '기타',
                '500' => '이통사 system failsystem fail',
                '501' => '이통사 착신번호 스팸',
                '502' => '이통사 스팸 메시지',
                '503' => '수신거부',
                '504' => '이통사 expired',
                '505' => '착신가입자 없음',
                '506' => '전원꺼짐',
                '507' => '음영지역',
                '508' => '단말 수신용량 초과',
                '509' => 'MMS 를 미 지원 단말',
                '510' => '미 지원 단말',
                '511' => '무응답 및 통화중',
                '512' => '번호이동',
                '513' => 'NPDB 에러',
                '514' => '이통사의 컨텐츠에러',
                '515' => '이통사 전화번호 세칙 미준수 발신번호 사용',
                '516' => '이통사 사전 미등록 발신번호 사용',
                '517' => '이통사 발신번호 변작으로 변작으로 등록된 발신번호 사용',
                '518' => '이통사 번호도용문자차단서비스에 가입된 발신번 호 사용',
                '519' => '이통사 기타'
			);
			$data['resultcode'] = $resultcode;
			//검색이면 검색
		if($mode != "new"){
			if($searchtxt != "" && $searchtxt != null){
				$viewtable = true;
				$sql = "SELECT * FROM $tablename where dstaddr like '%$searchtxt' order by mseq desc";
				//$query = $this->sparoBGF->query($sql);
                $query = $this->BGFSMS3->query($sql);

				//$total = $query -> num_rows();
				$data['query'] = $query;
				$query2 = $this->BGFSMS2->query($sql);
				$data['query2'] = $query2;
			}
		}else{
			$searchtxt = "";
		}
		$qsql = "SELECT * FROM msg_queue";
        $qsql2 = "SELECT * FROM MSG_QUEUE";

		//$qquery = $this->sparoBGF->query($qsql);
        $qquery = $this->BGFSMS3->query($qsql2);
		$data['qcnt'] = $qquery -> num_rows();	//미발송 문자갯수
		
		$qquery2 = $this->BGFSMS2->query($qsql);
		$data['qcnt2'] = $qquery2 -> num_rows();	//미발송 문자갯수
		
		$bsql = "SELECT SEND_TIME FROM $tablename where RESULT = '100' or RESULT = '0' order by MSEQ desc limit 1";

		//$bquery = $this->sparoBGF->query($bsql);
        $bquery = $this->BGFSMS3->query($bsql);
		$data['brow'] = $bquery->row();
		
		$bquery2 = $this->BGFSMS2->query($bsql);
		$data['brow2'] = $bquery2->row();
		
		$data['title'] = '발송문자조회';
		$data['viewtable']=$viewtable;
		$data['searchtxt']=$searchtxt;
		$data['contentview'] = '/order/sms';
		$data['leftview'] = 'left';
		$data['topview'] = 'head';
		$data['bottomview'] = 'bottom';
		$this->load->view('/inc/layout',$data);
	}
	
	
	function onemount()
	{
		$this->sparo2 = $this->load->database('sparo2', TRUE);
		//판매치널
		$data['checkall'] = $this->checkall = $this->input->post('checkall');
		$data['checkA'] = $this->checkA = $this->input->post('checkA');
		$data['checkG'] = $this->checkG = $this->input->post('checkG');
		$data['checkS'] = $this->checkS = $this->input->post('checkS');
		$data['checkC'] = $this->checkC = $this->input->post('checkC');
		$data['checkW'] = $this->checkW = $this->input->post('checkW');
		$data['checkT'] = $this->checkT = $this->input->post('checkT');
		

		//검색어
		$data['searchtxt'] = $this->searchtxt = $this->input->post('searchtxt');
		$data['barcodetxt'] = $this->barcodetxt = $this->input->post('barcodetxt');
		
		$where = " ";
		//$where .= "AND Created_at between '$this->use_sdate' and '$this->use_edate'";
		
		//채널검색
		if(!$this->checkA && !$this->checkG && !$this->checkS && !$this->checkC && !$this->checkW && !$this->checkT ){
			$viewchk = 0;
		}else{
			$viewchk = 1;
			if(!$this->checkall){
				$chntxt = "AND (chnm = ''";
				if($this->checkA){
					$chntxt .=  " or chnm = '옥션'";
				}
				if($this->checkG){
					$chntxt .=  " or chnm = 'G마켓'";
				}
				if($this->checkS){
					$chntxt .=  " or chnm = '11번가'";
				}
				if($this->checkC){
					$chntxt .=  " or chnm = '쿠팡'";
				}
				if($this->checkW){
					$chntxt .=  " or chnm = '위메프'";
				}
				if($this->checkT){
					$chntxt .=  " or chnm = '티켓몬스터'";
				}
				$chntxt .= ")";
				
				$where .= $chntxt;
			}	
		}
		
		if($this->searchtxt != '' && $this->searchtxt != NULL){
			$length= strlen( $this->searchtxt );
			
			if($length == 4 && is_numeric($this->searchtxt)){ //숫자네자리일때
				$where.=" AND hp like '%$this->searchtxt'"; //전화번호검색
			}else{
				//$where.=" AND no = '$this->searchtxt'"; //쿠폰 검색 분리
			}
		}
		
		if($this->barcodetxt != '' && $this->barcodetxt != NULL){
			$barcodearr =explode("\n",$this->barcodetxt);
			$pc = array();
			foreach($barcodearr as $bar){
				$bar = trim($bar);
				$pc[] = "'".$bar."'";
			}
			$coupons = implode ($pc,',');
			$where.=" AND no in ({$coupons})";
		}
		
		$where.=" AND use_edate > '".date("Ymd",strtotime ("-2 months"))."'";
		
		$sql = "SELECT *,if(state = 'Y','사용',if(state = 'N','미사용',if(state = 'C','<font color=red>취소</font>',state))) as states FROM `om_ordermts` WHERE $viewchk $where";
		
		//$sql .= " and usernm like '%테스트%'";
		$query = $this->sparo2->query($sql);
		$data['total'] = $query -> num_rows();
		$data['query'] = $query;

    	$data['title'] = '원마운트 주문관리';
	    $data['contentview'] = '/order/onemount';
	    $data['leftview'] = 'left';
	    $data['topview'] = 'head';
	    $data['bottomview'] = 'bottom';
	    $this->load->view('/inc/layout',$data);
	}

	function toast()
	{
    	$data['title'] = 'TOAST.KAKAO';
	    $data['contentview'] = '/order/toast';
	    $data['leftview'] = 'left';
	    $data['topview'] = 'head';
	    $data['bottomview'] = 'bottom';
	    $this->load->view('/inc/layout',$data);
	}
	
    function onemount_synccancel(){
    	$this->ids = $this->input->post('orid');
    	
    	$damnm = $this->session->userdata('nm');
    	$damcd = $this->session->userdata('cd');
    	$cip = $_SERVER['REMOTE_ADDR'];
    	$log = "{$damnm}({$damcd}) {$cip}/".date("Y-m-d H:i:s");
    	
    	
    	$this->sparo2 = $this->load->database('sparo2', TRUE);
    	
    	$qry = "update om_ordermts set  synccancel = 'R', log_cancel = '$log' where id IN ($this->ids)";
    	$this->sparo2->query($qry);
    	
    }

	
} 


?>