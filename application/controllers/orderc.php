<?php 

class Orderc extends CI_Controller {

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
		$this->cms = $this->load->database('cms', TRUE);
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

	function make_query($data){
		$where = "1";

		$selectdate = $data['selectdate'];
        $sdate = $data['sdate'];
        $edate = $data['edate'];
        $usedate = $data['usedate'];
        $usernm = $data['usernm'];
        $userhp = $data['userhp'];
        $orderno = $data['orderno'];
        $barcodeno = $data['barcodeno'];
        $grnm = $data['grnm'];
        $jpnm = $data['jpnm'];
        $jpmt_id = $data['jpmt_id'];
        $itemnm = $data['itemnm'];
        $itemmt_id = $data['itemmt_id'];
        $chnm = $data['chnm'];
        $ch_orderno = $data['ch_orderno'];
        $state = $data['state'];
        $usegu = $data['usegu'];
        $dammemo = $data['dammemo'];

        if ($selectdate != '' && $selectdate != NULL && $sdate != '' && $sdate != NULL && $edate != '' && $edate != NULL) {
            //$where .= " AND {$selectdate} between '{$sdate}' and '{$edate}' ";

            if($sdate != '' && $sdate != NULL){
                $sdate = date("Y-m-d",strtotime($sdate));
                //$where .= " AND EXTRACT(YEAR_MONTH FROM {$selectdate}) >= '{$sdate}' ";
                $where .= " AND {$selectdate} >= '{$sdate}' ";
            }
            if($edate != '' && $edate != NULL){
                $edate = date("Y-m-d",strtotime($edate));
                if($selectdate=='canceldate' || $selectdate=='usegu_at'){
                    $plusedate = date("Y-m-d",strtotime ("+1 days", strtotime($edate)));
                    $where .= " AND {$selectdate} <= '{$plusedate}' ";
                }else{
                    $where .= " AND {$selectdate} <= '{$edate}' ";
                }

                //$where .= " AND EXTRACT(YEAR_MONTH FROM {$selectdate}) <= '{$edate}' ";canceldate usegu_at
            }
        }

        if ($usernm != '' && $usernm != NULL) {
            $where .= " AND usernm like '%$usernm%'"; //이름검색
        }

        if ($userhp != '' && $userhp != NULL) {
            $userhp = str_replace("-","",$userhp);
            $where .= " AND Replace(AES_DECRYPT(UNHEX(hp),'Wow1daY'), '-', '') like '%$userhp'"; //전화번호검색
        }

        if ($orderno != '' && $orderno != NULL) {
            $where .= "  AND orderno = '$orderno'"; //주문번번호
        }

        if ($barcodeno != '' && $barcodeno != NULL) {
            $where .= " AND barcode_no like '%$barcodeno%'"; //바코드번호
        }

        if ($grnm != '' && $grnm != NULL) {
            $where .= " AND grnm like '%$grnm%'"; //바코드번호
        }

        if ($jpmt_id != '' && $jpmt_id != NULL) {
            $where .= " AND jpmt_id = '$jpmt_id'"; //시설
        }

        if ($itemmt_id != '' && $itemmt_id != NULL) {
            $where .= " AND  itemmt_id = '$itemmt_id'"; //상품
        }

        if ($chnm != '' && $chnm != NULL) {
            $where .= " AND chnm = '$chnm'"; //판매채널
        }

        if ($ch_orderno != '' && $ch_orderno != NULL) {
            $where .= " AND ch_orderno = '$ch_orderno'"; //채널주문번호
        }

        if ($state != '' && $state != NULL) {
            $where .= " AND state = '$state'"; //주문상태
        }

        if ($usegu != '' && $usegu != NULL) {
            $where .= " AND usegu = '$usegu'"; //이용상태
        }

        if ($dammemo != '' && $dammemo != NULL) {
            $where .= " AND dammemo like '%$dammemo%'"; //담당자메모
        }

		return $where;
	}

    function olist($mode='')
    {
//		$this->output->enable_profiler(TRUE);
     
        $viewtable = false;
        $searchtxt = '';
        
        $total_rows = 0;
		$man1_rows = 0;

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
        $data['jpmt_id'] = '';
        $data['itemnm'] = '';
        $data['itemmt_id'] = '';
        $data['chnm'] = '';
        $data['ch_orderno'] = '';
        $data['state'] = '';
        $data['usegu'] = '';
        $data['dammemo'] = '';
        $data['align'] = '';
        $data['limit'] = '';
        $data['offset'] = 0;
        $this->session->set_userdata($data);
    }



		//세션에 limit 있는지 
		if($this->session->userdata('limit') != "" && $this->session->userdata('limit') != null){
			$limit= $this->session->userdata('limit');
		}else{
			$limit= "10";
		}

		if($this->session->userdata('offset') != '' && $this->session->userdata('offset') != null){
			$offset= $this->session->userdata('offset');
		}else{
			$offset= 0;
		}

		if($this->session->userdata('align') != '' && $this->session->userdata('align') != null){
			$align = $this->session->userdata('align');
		}else{
			$align="";
		}

        $data['selectdate'] = $this->session->userdata('selectdate');
        $data['sdate'] = $this->session->userdata('sdate');
        $data['edate'] = $this->session->userdata('edate');
        $data['usedate'] = $this->session->userdata('usedate');
        $data['usernm'] = $this->session->userdata('usernm');
        $data['userhp'] = $this->session->userdata('userhp');
        $data['orderno'] = $this->session->userdata('orderno');
        $data['barcodeno'] = $this->session->userdata('barcodeno');
        $data['grnm'] = $this->session->userdata('grnm');
        $data['jpnm'] = $this->session->userdata('jpnm');
        $data['jpmt_id'] = $this->session->userdata('jpmt_id');
        $data['itemnm'] = $this->session->userdata('itemnm');
        $data['itemmt_id'] = $this->session->userdata('itemmt_id');
        $data['chnm'] = $this->session->userdata('chnm');
        $data['ch_orderno'] = $this->session->userdata('ch_orderno');

        $data['state'] = $this->session->userdata('state');
        $data['usegu'] = $this->session->userdata('usegu');
        $data['dammemo'] = $this->session->userdata('dammemo');
        $data['align'] = $this->session->userdata('align');
        $data['limit'] = $this->session->userdata('limit');

        $where = $this->make_query($data);
		if($where != "1") $viewtable = true;

        if ($viewtable) {

			$totalsql = "select count(id) as total_rows, sum(man1) as man1_rows, sum(accamt) as sumaccamt, SUM( IF ( usegu != 1, 0, accamt ) ) as sumuseamt from ordermts where {$where}";
            $totalquery = $this->sparo2->query($totalsql);
			$total_order_man1 = $totalquery->row();
			$total_rows = $total_order_man1->total_rows;
			$man1_rows = $total_order_man1->man1_rows;
            $data['sumaccamt'] = $total_order_man1->sumaccamt;
            $data['sumuseamt'] = $total_order_man1->sumuseamt;
			
			 $sql = "select id,ch_orderno,created,resno,orderno,barcode_no,usernm,AES_DECRYPT(UNHEX(hp),'Wow1daY') dhp,usegu,if( usegu =1, '사용', '미사용' ) AS ifusegu,usegu_at,
                jpmt_id,jpnm,itemmt_id,itemnm,chnm,ch_id,usedate,man1,man2,state,canceldate,bigo,smsgu, dammemo,accamt,dangu from ordermts where {$where}";
			 $data['dev'] = $sql;
			//if $offset이 숫자가 아니면 0

            $this->load->library('pagination');
            $config['base_url'] = 'http://pcms.placem.co.kr/index.php/orderc/olist_offset';
            $config['total_rows'] =  $total_rows;
            $config['man1_rows'] =  $man1_rows;
            $config['per_page'] = $limit;
            $config['cur_page'] = $offset;
            $config['uri_segment'] = 3;

            page_default_set($config);
            $this->pagination->initialize($config);
            $data['pag_links'] = $this->pagination->create_links();


			if($align != '' && $align != NULL && $align == 'usegu_at'){
				$sql .= " order by usegu_at desc limit $offset, $limit";
			}else if($align != '' && $align != NULL && $align == 'usernm'){
				$sql .= " order by usernm asc limit $offset, $limit";
			}else if($align != '' && $align != NULL && $align == 'canceldate'){
				$sql .= " order by canceldate desc limit $offset, $limit";
			}else if($align != '' && $align != NULL && $align == 'ch_id'){
				$sql .= " order by ch_id desc limit $offset, $limit";
			}else{
				$sql .= " order by id desc limit $offset, $limit";
			}

//			echo $sql;

            $data['query'] = $this->sparo2->query($sql);
            $data['dev'] = $sql;
            $data['where'] = ase_encrypt($where);
        }


        $smsid_array = array();

        $data['smsid_array'] = $smsid_array;

		//엑셀 테이블
		$damcd = $this->session->userdata('cd');
		$exceltable=true;

		if($exceltable){
            $esql="select created,damnm,state,bigo,filename  from spadb.ordermts_excel_down where created > DATE_SUB(NOW(),INTERVAL 96 hour) and damcd = '{$damcd}' order by created desc";
            if($this->session->userdata('cd') == 'penfen'){
                $esql="select created,damnm,state,bigo,filename  from spadb.ordermts_excel_down where created > DATE_SUB(NOW(),INTERVAL 96 hour)  order by created desc";
            }
            $data['equery'] = $this->sparo2->query($esql);
            $estate = array(
                "C"=> "취소",
                "R"=> "요청",
                "S"=> "완료",
                "E"=> "실패"
            );
            $data['estate'] = $estate;
		}

        $csql="select com_id,com_nm from CMS_COMPANY where com_type = 'C' AND com_state = 'Y' order by com_nm";
        $data['cquery'] = $this->cms->query($csql);
        
        //시설 정보 2번
        $csql="select fac_id as jpmt_id,fac_nm as jpnm from CMSDB.CMS_FACILITIES where 1 order by fac_nm";
        $data['faclist'] = $this->cms->query($csql);

        $itemselect = "SELECT item_id,item_nm FROM `CMS_ITEMS` where item_state = 'Y' and item_edate >= date_add(now(), interval -1 month) and item_id > 10000 order BY item_id DESC ";
        $data['itemlist'] = $this->cms->query($itemselect);

		//상품선택시 이용일
		$dateselect = "SELECT * FROM `CMS_PRICES` where price_state = 'Y' and price_date >= curdate() order by price_date ASC";
		$data['datelist'] = $this->cms->query($dateselect);

        $ip = $_SERVER["REMOTE_ADDR"];
        if ($this->session->userdata('buseo') == "뿌리깊은나무" &&  $this->session->userdata('rolegu') != "AL" &&
            ($ip == "118.131.208.122" or $ip == "118.131.208.123" or $ip == "118.131.208.124" or $ip == "118.131.208.125" or $ip == "118.131.208.126" or $ip == "106.254.252.100"
            or $this->session->userdata('cd') == 'penfen' or $this->session->userdata('cd') == 'jjlee' or $this->session->userdata('cd') == 'cindy' )
        ){
            $data['viewexcel'] = true;
        }else{
            $data['viewexcel'] = false;
        }

        //쿠폰 확인, 폐기을 사용 할것인가
        $data['syncJpmts'] = array(9,86,61,3336,3332); // array(398,9,86,61,3336,3332);
        $data['total'] = $total_rows;
        $data['tman1'] = $man1_rows;
        $data['searchtxt']=$searchtxt;
        $data['viewtable'] = $viewtable;
        $data['exceltable'] = $exceltable;
        $data['title'] = '주문 관리자';
//        if ($ip == "106.254.252.100"){
//            $data['contentview'] = '/orderc/olist_test';
//        } else {
            $data['contentview'] = '/orderc/olist';
//        }

        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }

	function excelDown($filename=''){

        ini_set('memory_limit',-1);
        $this->load->library('zip');
        $this->load->helper('download');
        if($filename != ''){
            $name = iconv("UTF-8","EUC-KR",$filename).'zip';
            $path = "/home/sys.placem.co.kr/sync_script/export/{$filename}/";
            $this->zip->read_dir($path, FALSE);
            $this->zip->download($name);

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
        $usedate = $this->input->post('date_select'); // 이용일
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

    function olist_ser()
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
    $data['jpmt_id'] = trim($this->input->post('jpmt_id'));
    $data['itemnm'] = trim($this->input->post('itemnm'));
    $data['itemmt_id'] = trim($this->input->post('itemmt_id'));
    $data['chnm'] = trim($this->input->post('chnm'));
    $data['ch_orderno'] = trim($this->input->post('ch_orderno'));
    $data['state'] = trim($this->input->post('state'));
    $data['usegu'] = trim($this->input->post('usegu'));
    $data['dammemo'] = trim($this->input->post('dammemo'));
    $data['offset'] = 0;

    $this->session->set_userdata($data);

    #if엑셀 다운이면 $this->excel_que(); 를 호출

    $this->olist();

}
	
	function excel_que()
    {
        $data['selectdate'] = $this->input->post('selectdate');
        $data['sdate'] = $this->input->post('sdate');
        $data['edate'] = $this->input->post('edate');
        $data['usedate'] = $this->input->post('usedate');
        $data['usernm'] = $this->input->post('usernm');
        $data['userhp'] = $this->input->post('userhp');
        $data['orderno'] = $this->input->post('orderno');
        $data['barcodeno'] = $this->input->post('barcodeno');
        $data['grnm'] = $this->input->post('grnm');
        $data['jpmt_id'] = $this->input->post('jpmt_id');
        $data['jpnm'] = $this->input->post('jpnm');
        $data['itemmt_id'] = $this->input->post('itemmt_id');
        $data['itemnm'] = $this->input->post('itemnm');
        $data['ch_id'] = $this->input->post('ch_id');
        $data['chnm'] = $this->input->post('chnm');
        $data['ch_orderno'] = $this->input->post('ch_orderno');
        $data['state'] = $this->input->post('state');
        $data['usegu'] = $this->input->post('usegu');
        $data['dammemo'] = $this->input->post('dammemo');

        $where = $this->make_query($data);
		/*
		$where 을 암호화 해서 insert 하기
		$ip = $_SERVER["REMOTE_ADDR"];
		$this->session->userdata('cd'); 접속한 사람 아이디
		$this->session->userdata('nm'); 접속한 사람 이름
		*/
		
		echo $where;
		$where = ase_encrypt($where);// 단방향 암호화

		$ip = $_SERVER["REMOTE_ADDR"];
		$cd = $this->session->userdata('cd');
		$nm = $this->session->userdata('nm');
		
		$esql="insert spadb.ordermts_excel_down set ip = '{$ip}',damcd = '{$cd}',damnm='{$nm}',search_condition='{$where}',state='R'";

		$this->sparo2->query($esql);

//		echo $esql;
        
    }

	function olist_limit($limit = "10", $offset=0){
		$data['limit'] = $this->input->post('limit');
		$data['offset'] = $offset;
		$this->session->set_userdata($data);
		$this->olist();
	}

    function olist_offset($offset = 0)
    {
        $data['offset'] = $offset;
        $this->session->set_userdata($data);
        $this->olist();
    }

	function olist_align($offset=0) 
	{
		$data['align'] = $this->input->post('align');
		$data['offset'] = $offset;
		$this->session->set_userdata($data);

		$this->olist();

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

	function get_usedate(){
        $this->cms = $this->load->database('cms', TRUE);
        $itemid = $this->input->post('itemid');

        $dateselect = "SELECT * FROM `CMS_PRICES` where price_itemid = '{$itemid}' and price_state = 'Y' and price_date >= curdate() order by price_date ASC";
        $data['datelist'] = $this->cms->query($dateselect);
        $this->load->view('/orderc/datelist',$data);

    }

    function toast(){
        $data['contentview'] = '/orderc/toast';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }

    function highone(){
        $data['contentview'] = '/orderc/highone';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }
	
} 

?>