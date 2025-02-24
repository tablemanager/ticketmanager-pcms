<?php
header('Content-Type: text/html; charset=utf-8');
class Bar extends CI_Controller {

    private $p_sellcode = "";
    private $p_pcms_id = "";
    private $p_itemnm = "";

	function __construct() {
		parent::__construct();
		if (!(($this->uri->segment(3) == 'login') || ($this->uri->segment(3) == 'login_ok')))
			$this->is_logged_in();
		$this->cms = $this->load->database('cms', TRUE);
		$this->pcms = $this->load->database('pcms', TRUE);
		$this->sparo = $this->load->database('sparo', TRUE);
		$this->sparo2 = $this->load->database('sparo2', TRUE);

		$this->load->helper(array('form', 'url'));
	}

	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');


		if(!isset($is_logged_in) || $is_logged_in != true)
		{
            $ip = $_SERVER["REMOTE_ADDR"];
            $buseo = $this->session->userdata('buseo');
            if($buseo != "뿌리깊은나무"
                && $ip != "118.131.208.122"
                && $ip != "118.131.208.123"
                && $ip != "118.131.208.124"
                && $ip != "118.131.208.125"
                && $ip != "118.131.208.126"
                && $ip != "106.254.252.100" //개발망
                && $ip != "61.74.186.246"   // 20241127 tony 테이블메니저 VPN 허용
            ){
                //20240801 tony 비즈팀 VPN 장애로 접속제한 해제
                if(date("Ymd") == "20240801") return;

                redirect('/sys/login');
                die();
            }


		}
	}

	function selectchn(){
		$this->selectchn = $this->input->post('selectchn');
		//if($this->selectchn == "" || $this->selectchn == null || $this->selectchn == "0")$this->selectchn = "new";
		$data['selectchn'] = $this->selectchn;
		$this->session->set_userdata($data);
		echo "ok|저장되었습니다.2";
	}

    function kit_new($mode="")
    {
        if ($mode == 'new') {
            $data['offset'] = 0;
            $data['selectchn'] = "";
            $this->session->set_userdata($data);
        }

        $where = "";
        $data['limit'] = '';

        //$this->output->enable_profiler(TRUE);
        $monthdate = date("Y-m-d");

        //세션에 offset 있는지
        $data['offset'] = $this->session->userdata('offset');
        if($data['offset'] != "" && $data['offset'] != null){
            $offset= $data['offset'];
        }else{
            $offset= 0;
        }

        //세션에 선택한 채널 있는지
        $data['selectchn'] = $this->session->userdata('selectchn');
        if($data['selectchn'] != "" && $data['selectchn'] != null){
            $where .= " AND kit_lms.gp='{$data['selectchn']}' ";
        }

        if (!empty($this->p_itemnm)){
            $where .= " AND kit_lms.itemnm like'%{$this->p_itemnm}%' ";
        }
        if (!empty($this->p_pcms_id)){
            $where .= " AND kit_lms.pcms_id='{$this->p_pcms_id}' ";
        }
        if (!empty($this->p_sellcode)){
            $where .= " AND kit_lms.sellcode='{$this->p_sellcode}' ";
        }


        $sql = "select kit_lms.*
        from kit_lms
        where 1
        and kit_lms.useyn='Y'{$where}
        ";

        $sql .= "order by kit_lms.pcms_id desc";

//		echo $sql;

        //echo $sql.$mode ;
        $query = $this->db->query($sql);


        $total_rows = $query -> num_rows();
        $limit = 40;

        $this->load->library('pagination');
        $config['base_url'] = 'http://pcms.ticketmanager.ai/index.php/bar/kit_offset/';
        $config['total_rows'] =  $total_rows;
        $config['per_page'] = $limit;
        $config['cur_page'] = $offset;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        page_default_set($config);

        $this->pagination->initialize($config);
        $data['pag_links'] = $this->pagination->create_links();

        //if($offset == 'new' || $offset == 'bar_add'){
        if(is_numeric($offset)){
            $sql .= " limit $offset, $limit";
        }else{
            $sql .= " limit 0, $limit";
        }

        $query = $this->db->query($sql);



        $gpar = array(
            "WP3"=> "콜백 URL 문자(롯데,하이원,웅진등)",
            "PM"=> "지류티켓 문자",
            "NVR" => "네이버 콜백 문자(예외적 사용)",
            //"KM"=> "지류티켓 알림톡",
            //"PM_SM"=> "소셜 문자",
            //"PM_ARR"=> "뉴스파로 문자(다중등록)",
            //"KZN"=> "외부쿠폰(키자니아 등)",
            //"EXT"=> "외부쿠폰(주문정보)",
            //"WPC" =>  "웅진플레이도시"
        );

        $gparr = array(
            "PM"=> "지류티켓 문자",
            "KM"=> "지류티켓 알림톡",
            "PM_ARR"=> "뉴스파로 문자(다중등록)",
            "PM_SM"=> "소셜 문자",
            "WP3"=> "콜백 URL 문자(롯데,하이원,웅진등)",
            "NVR" => "네이버 콜백 문자(예외적 사용)",
            "KZN"=> "외부쿠폰(키자니아 등)",
            "EXT"=> "외부쿠폰(주문정보)",
            "WPC" =>  "웅진플레이도시",
            "SIW"=> "시원스쿨",
            "KBB"=> "교보문고",
            "RDB"=> "리디북스",
            "SFSM"=> "스타필드(스포츠몬스터)",
            "SFAF"=> "스타필드(아쿠아필드)",
            "SFAR"=> "스타필드(아쿠아필드 루프탑시네마)",
            "SSMS"=> "소셜주문발송",
            "GRC"=> "그린카"
        );

        if($this->session->userdata('cd') == 'penfen'){
            $gparr["KW"] =  "KW호스텔";
            $gparr["H1"] =  "하이원";
            $gparr["OM"] =  "원마운트";
            $gparr["ASAN"] =  "아산스파비스";
        }

        $data['gparr'] = $gparr;
        $data['gpar'] = $gpar;

        $bararr = array(
            "WD"=> "롯데월드",
            "WP"=> "롯데통합쿠폰",
            "KZN"=> "외부쿠폰(키자니아 등)",
            "KW"=> "KW호스텔",
            "GRC"=> "그린카",
            "SIW"=> "시원스쿨",
            "KBB"=> "교보문고",
            "RDB"=> "리디북스"
        );
        $data['bararr'] = $bararr;

        $data['lefeactive'] = "bar";
        $data['monthdate'] = $monthdate;
        $data['query'] = $query;
        $data['title'] = '통합 바코드 및 문자관리';


        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
//        $data['contentview'] = '/bar/kit';

        $data['contentview'] = '/bar/kit_new';

        $this->load->view('/inc/layout',$data);
    }

	function kit($mode="")
    {
		if ($mode == 'new') {
            $data['offset'] = 0;
            $data['selectchn'] = "";
            $this->session->set_userdata($data);
        }

		$where = "";
		$data['limit'] = '';

        //$this->output->enable_profiler(TRUE);
        $monthdate = date("Y-m-d");

		//세션에 offset 있는지
		$data['offset'] = $this->session->userdata('offset');
		if($data['offset'] != "" && $data['offset'] != null){
			$offset= $data['offset'];
		}else{
			$offset= 0;
		}

		//세션에 선택한 채널 있는지
		$data['selectchn'] = $this->session->userdata('selectchn');
		if($data['selectchn'] != "" && $data['selectchn'] != null){
           $where .= " AND kit_lms.gp='{$data['selectchn']}' ";
        }

		if (!empty($this->p_itemnm)){
            $where .= " AND kit_lms.itemnm like'%{$this->p_itemnm}%' ";
        }
		if (!empty($this->p_pcms_id)){
            $where .= " AND kit_lms.pcms_id='{$this->p_pcms_id}' ";
        }
		if (!empty($this->p_sellcode)){
            $where .= " AND kit_lms.sellcode='{$this->p_sellcode}' ";
        }


        $sql = "select kit_lms.*
        from kit_lms
        where 1
        and kit_lms.useyn='Y'{$where}
        ";

		$sql .= "order by kit_lms.pcms_id desc";

//		echo $sql;

        //echo $sql.$mode ;
        $query = $this->db->query($sql);


        $total_rows = $query -> num_rows();
        $limit = 40;

        $this->load->library('pagination');
        $config['base_url'] = 'http://pcms.ticketmanager.ai/index.php/bar/kit_offset/';
        $config['total_rows'] =  $total_rows;
        $config['per_page'] = $limit;
        $config['cur_page'] = $offset;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        page_default_set($config);

        $this->pagination->initialize($config);
        $data['pag_links'] = $this->pagination->create_links();

        //if($offset == 'new' || $offset == 'bar_add'){
        if(is_numeric($offset)){
            $sql .= " limit $offset, $limit";
        }else{
            $sql .= " limit 0, $limit";
        }

        $query = $this->db->query($sql);



                $gpar = array(
        		"WP3"=> "콜백 URL 문자",
        		"PM"=> "지류티켓 문자",
                    	"NVR" => "네이버 콜백 문자(예외적 사용)"
                 //   "KM"=> "지류티켓 알림톡",
        	//					"PM_SM"=> "소셜 문자",
        	//					"PM_ARR"=> "뉴스파로 문자(다중등록)",
                //    "KZN"=> "외부쿠폰(키자니아 등)",
                 //   "EXT"=> "외부쿠폰(주문정보)",
                 //   "WPC" =>  "웅진플레이도시"
                );

                $gparr = array(
        						"PM"=> "지류티켓 문자",
        						"KM"=> "지류티켓 알림톡",
                    "PM_ARR"=> "뉴스파로 문자(다중등록)",
                    "PM_SM"=> "소셜 문자",
                    "WP3"=> "콜백 URL 문자(롯데,하이원,웅진등)",
                    "NVR" => "네이버 콜백 문자(예외적 사용)",
                    "KZN"=> "외부쿠폰(키자니아 등)",
                    "EXT"=> "외부쿠폰(주문정보)",
                    "WPC" =>  "웅진플레이도시",
                    "SIW"=> "시원스쿨",
                    "KBB"=> "교보문고",
                    "RDB"=> "리디북스",
                    "SFSM"=> "스타필드(스포츠몬스터)",
                    "SFAF"=> "스타필드(아쿠아필드)",
                    "SFAR"=> "스타필드(아쿠아필드 루프탑시네마)",
                    "SSMS"=> "소셜주문발송",
                    "GRC"=> "그린카"
                );

        if($this->session->userdata('cd') == 'penfen'){
            $gparr["KW"] =  "KW호스텔";
            $gparr["H1"] =  "하이원";
            $gparr["OM"] =  "원마운트";
            $gparr["ASAN"] =  "아산스파비스";
        }

        $data['gparr'] = $gparr;
        $data['gpar'] = $gpar;

        $bararr = array(
        		"WD"=> "롯데월드",
        		"WP"=> "롯데통합쿠폰",
        		"KZN"=> "외부쿠폰(키자니아 등)",
        		"KW"=> "KW호스텔",
        		"GRC"=> "그린카",
        		"SIW"=> "시원스쿨",
                "KBB"=> "교보문고",
                "RDB"=> "리디북스"
        );
        $data['bararr'] = $bararr;

        $data['lefeactive'] = "bar";
        $data['monthdate'] = $monthdate;
        $data['query'] = $query;
    	$data['title'] = '통합 바코드 및 문자관리';


    	$data['leftview'] = 'left';
    	$data['topview'] = 'head';
    	$data['bottomview'] = 'bottom';
        $data['contentview'] = '/bar/kit';

//        $damip = $_SERVER["REMOTE_ADDR"];
//
//    	if ($damip == "106.254.252.100"){
//            $data['contentview'] = '/bar/kit_new';
//        }



    	$this->load->view('/inc/layout',$data);
    }

    function kit_mms()
    {

    	$this->id = $this->input->post('flag');
    	$this->mms_text = $this->input->post('mmstext');

    	$sql = "select kit_log from kit_lms
        		where id = '$this->id'";
    	$logrow = $this->db->query($sql)->row();


    	$damnm = $this->session->userdata('nm');
    	$damcd = $this->session->userdata('cd');
    	$this->kit_log = $logrow->kit_log."\n".date("Y-m-d H:i:s").":".$damnm."(".$damcd.") 문자수정";

    	$data = array(
    			'mms_text' => $this->mms_text,
    			'kit_log' => $this->kit_log
    	);

    	$this->db->where('id', $this->id);
    	if(!$this->db->update('kit_lms', $data)){
    		echo "err";
    	}else{
    		echo site_url('bar/kit');
    	}
    }


    function kit_temp_add()
    {
        $this->load->model('pcmsmodel');
        $this->load->model('cmsmodel');
        $this->chnpick = $this->input->post('chnpick');

        $_tremp = $this->input->post('pcmsitem_id');
        $_tremp_ary = explode(',', $_tremp);

        for ($i = 0; $i < count($_tremp_ary);$i++){
            if (!empty($_tremp_ary[$i])){
//                $this->pcmsitem_id = $this->input->post('pcmsitem_id');
                $this->pcmsitem_id = $_tremp_ary[$i];
//                $this->pcmsitem_id_arr = $this->input->post('pcmsitem_id_arr');
//                if($this->chnpick == 'PM_ARR'){	//
//                    $this->pcmsitem_id_arre = explode(',', $this->pcmsitem_id_arr);
//                    $this->pcmsitem_id = $this->pcmsitem_id_arre[0];
//                }
                if($this->chnpick == 'OM'){	//
                    $this->sellcode = $this->cmsmodel->get_om_sellcode($this->pcmsitem_id);
                }else if($this->chnpick == 'ASAN'){
                    $this->sellcode = $this->cmsmodel->get_asan_itemcode($this->pcmsitem_id);
                }else{
                    $this->sellcode = $this->pcmsmodel->get_kit_sellcode();
                }
                $this->pcms_itemnm = $this->pcmsmodel->get_pcms_itemnm($this->pcmsitem_id);
                $this->use_sdate = $this->input->post('use_sdate');
                $this->use_edate = $this->input->post('use_edate');
                $this->textarea_value = $this->input->post('textarea_value');
                $this->curl_headimg = $this->input->post('curl_headimg');
                //echo $this->chnpick."/".$this->sellcode."/".$this->pcmsitem_id."/".$this->pcms_itemnm."/".$this->use_sdate."/".$this->use_edate."/".$this->textarea_value;

                //$this->cmsmodel->kit_lms_pcmsid_disable($this->pcmsitem_id); //기존 코드 정지
                $this->cmsmodel->kit_lms_pcmsid_disable_gp($pcmsitem_id, $this->chnpick);

                //$pcms_usecnt = $this->cmsmodel->kit_lms_pcmsid_check($this->pcmsitem_id);
                $pcms_usecnt = $this->cmsmodel->kit_lms_pcmsid_check_gp($this->pcmsitem_id, $this->chnpick);

                $damnm = $this->session->userdata('nm');
                $manager = $this->session->userdata('cd');
                $this->logtxt = $damnm."(".$manager.") 등록";

                echo "{$this->chnpick},{$this->sellcode},{$this->pcmsitem_id},{$this->pcms_itemnm},{$this->use_sdate},{$this->use_edate},{$manager},{$this->logtxt},{$this->pcmsitem_id_arr}";

                if($pcms_usecnt > 0){
                    echo "err|사용중인 상품코드입니다.";
                }else if($this->chnpick == 'OM' && $this->sellcode == "0"){
                    echo "err|등록된 원마운트 코드가 없습니다. 개발팀에 문의해주세요.";
                }else if($this->chnpick == 'ASAN' && $this->sellcode == "0"){
                    echo "err|등록된 아산스파비스 코드가 없습니다. 개발팀에 문의해주세요.";
                }else{
                    if($this->cmsmodel->kit_lms_input(
                        $this->chnpick,
                        $this->sellcode,
                        $this->pcmsitem_id,
                        $this->pcms_itemnm,
                        $this->use_sdate,
                        $this->use_edate,
                        $this->textarea_value,
                        $manager,
                        $this->logtxt,
                        $this->pcmsitem_id_arr,
                        $this->curl_headimg)){
                        echo "ok|등록되었습니다.";
                    }else{
                        echo "err|등록실패.";
                    }
                }
            }
        }

    }

    function kit_add_new(){
        $this->load->model('pcmsmodel');
        $this->load->model('cmsmodel');
        $this->chnpick = $this->input->post('chnpick');
//        $this->pcmsitem_id = $this->input->post('pcmsitem_id');
        $_pcmsitem_id_ary = $this->input->post('pcmsitem_id');
        $this->pcmsitem_id_arr = $this->input->post('pcmsitem_id_arr');

        $pcmsitem_ary = explode(',', $_pcmsitem_id_ary);

        for ($i = 0; $i < count($pcmsitem_ary); $i++){

            if (!empty($pcmsitem_ary[$i])){
                $this->pcmsitem_id = $pcmsitem_ary[$i];

//            if($this->chnpick == 'PM_ARR'){	//
//                $this->pcmsitem_id_arre = explode(',', $this->pcmsitem_id_arr);
//                $this->pcmsitem_id = $this->pcmsitem_id_arre[0];
//            }
                if($this->chnpick == 'OM'){	//
                    $this->sellcode = $this->cmsmodel->get_om_sellcode($this->pcmsitem_id);
                }else if($this->chnpick == 'ASAN'){
                    $this->sellcode = $this->cmsmodel->get_asan_itemcode($this->pcmsitem_id);
                }else{
                    $this->sellcode = $this->pcmsmodel->get_kit_sellcode();
                }
                $this->pcms_itemnm = $this->pcmsmodel->get_pcms_itemnm($this->pcmsitem_id);
                $this->use_sdate = $this->input->post('use_sdate');
                $this->use_edate = $this->input->post('use_edate');
                $this->textarea_value = $this->input->post('textarea_value');
                $this->curl_headimg = $this->input->post('curl_headimg');
                //echo $this->chnpick."/".$this->sellcode."/".$this->pcmsitem_id."/".$this->pcms_itemnm."/".$this->use_sdate."/".$this->use_edate."/".$this->textarea_value;

                //$this->cmsmodel->kit_lms_pcmsid_disable($this->pcmsitem_id); //기존 코드 정지
                $this->cmsmodel->kit_lms_pcmsid_disable_gp($pcmsitem_id, $this->chnpick);
//            $this->cmsmodel->kit_lms_pcmsid_disable_gp($this->pcmsitem_id, $this->chnpick);

                //$pcms_usecnt = $this->cmsmodel->kit_lms_pcmsid_check($this->pcmsitem_id);
                $pcms_usecnt = $this->cmsmodel->kit_lms_pcmsid_check_gp($this->pcmsitem_id, $this->chnpick);

                $damnm = $this->session->userdata('nm');
                $manager = $this->session->userdata('cd');
                $this->logtxt = $damnm."(".$manager.") 등록";

                echo "{$this->chnpick},{$this->sellcode},{$this->pcmsitem_id},{$this->pcms_itemnm},{$this->use_sdate},{$this->use_edate},{$manager},{$this->logtxt},{$this->pcmsitem_id_arr}";

                if($pcms_usecnt > 0){
                    echo "err|사용중인 상품코드입니다.";
                }else if($this->chnpick == 'OM' && $this->sellcode == "0"){
                    echo "err|등록된 원마운트 코드가 없습니다. 개발팀에 문의해주세요.";
                }else if($this->chnpick == 'ASAN' && $this->sellcode == "0"){
                    echo "err|등록된 아산스파비스 코드가 없습니다. 개발팀에 문의해주세요.";
                }else{
                    if($this->cmsmodel->kit_lms_input(
                        $this->chnpick,
                        $this->sellcode,
                        $this->pcmsitem_id,
                        $this->pcms_itemnm,
                        $this->use_sdate,
                        $this->use_edate,
                        $this->textarea_value,
                        $manager,
                        $this->logtxt,
                        $this->pcmsitem_id_arr,
                        $this->curl_headimg)){
                        echo "ok|등록되었습니다.";
                    }else{
                        echo "err|등록실패.";
                    }
                }
            }


        }

    }

    function kit_add(){
    	$this->load->model('pcmsmodel');
    	$this->load->model('cmsmodel');
    	$this->chnpick = $this->input->post('chnpick');
	 $this->pcmsitem_msgType = $this->input->post('pcmsitem_msgType');
	$this->pcmsitem_id = $this->input->post('pcmsitem_id');
		$this->pcmsitem_id_arr = $this->input->post('pcmsitem_id_arr');
		if($this->chnpick == 'PM_ARR'){	//
            $this->pcmsitem_id_arre = explode(',', $this->pcmsitem_id_arr);
            $this->pcmsitem_id = $this->pcmsitem_id_arre[0];
        }
    	if($this->chnpick == 'OM'){	//
    		$this->sellcode = $this->cmsmodel->get_om_sellcode($this->pcmsitem_id);
    	}else if($this->chnpick == 'ASAN'){
    		$this->sellcode = $this->cmsmodel->get_asan_itemcode($this->pcmsitem_id);
    	}else{
    		$this->sellcode = $this->pcmsmodel->get_kit_sellcode();
    	}
    	$this->pcms_itemnm = $this->pcmsmodel->get_pcms_itemnm($this->pcmsitem_id);
    	$this->use_sdate = $this->input->post('use_sdate');
    	$this->use_edate = $this->input->post('use_edate');
    	$this->textarea_value = $this->input->post('textarea_value');
    	$this->curl_headimg = $this->input->post('curl_headimg');
    	//echo $this->chnpick."/".$this->sellcode."/".$this->pcmsitem_id."/".$this->pcms_itemnm."/".$this->use_sdate."/".$this->use_edate."/".$this->textarea_value;

        //$this->cmsmodel->kit_lms_pcmsid_disable($this->pcmsitem_id); //기존 코드 정지
		$this->cmsmodel->kit_lms_pcmsid_disable_gp($pcmsitem_id, $this->chnpick);

        //$pcms_usecnt = $this->cmsmodel->kit_lms_pcmsid_check($this->pcmsitem_id);
		$pcms_usecnt = $this->cmsmodel->kit_lms_pcmsid_check_gp($this->pcmsitem_id, $this->chnpick);

    	$damnm = $this->session->userdata('nm');
    	$manager = $this->session->userdata('cd');
    	$this->logtxt = $damnm."(".$manager.") 등록";

    	//echo "{$this->chnpick},{$this->sellcode},{$this->pcmsitem_id},{$this->pcms_itemnm},{$this->use_sdate},{$this->use_edate},{$manager},{$this->logtxt},{$this->pcmsitem_id_arr}";
	log_message('error', "{$this->chnpick},{$this->sellcode},{$this->pcmsitem_id},{$this->pcms_itemnm},{$this->use_sdate},{$this->use_edate},{$manager},{$this->logtxt}," . json_encode($this->pcmsitem_id_arr));

    	if($pcms_usecnt > 0){
    		echo "err|사용중인 상품코드입니다.";
    	}else if($this->chnpick == 'OM' && $this->sellcode == "0"){
    		echo "err|등록된 원마운트 코드가 없습니다. 개발팀에 문의해주세요.";
    	}else if($this->chnpick == 'ASAN' && $this->sellcode == "0"){
    		echo "err|등록된 아산스파비스 코드가 없습니다. 개발팀에 문의해주세요.";
    	}else{
    		if($this->cmsmodel->kit_lms_input(
    				$this->chnpick,
    				$this->sellcode,
    				$this->pcmsitem_id,
    				$this->pcms_itemnm,
    				$this->use_sdate,
    				$this->use_edate,
    				$this->textarea_value,
    				$manager,
    				$this->logtxt,
					$this->pcmsitem_id_arr,
					$this->curl_headimg,
					$this->pcmsitem_msgType			
		)
		){
    			echo "ok|등록되었습니다.";
    		}else{
    			echo "err|등록실패.";
    		}
    	}

    }

    function kit_use(){
    	$this->load->model('cmsmodel');
    	$this->id = $this->input->post('code');
    	$this->useyn = $this->input->post('use_state');
    	echo $this->cmsmodel->kit_lms_use($this->id,$this->useyn);
    }

	function kit_date_change() {
		$id = $this->input->post('code');
    	$date = $this->input->post('date');

		$data = array(
			'id' => $id,
			'edate' => $date." 23:59:59"
		);
    	$this->db->where('id', $id);

		if($this->db->update('kit_lms', $data)){
    		echo "ok";
    	}else{
    		echo "errrrrr";
    	}
	}

    function bar_add($id=''){

    	if($id == '' || $id == null){
    		$this->kit();
    	}
    	$bararr = array(
    			"WD"=> "롯데월드",
    			"WP"=> "롯데워터파크",
                "WP2"=> "롯데워터파크(다회권)",
    			"KZN"=> "키자니아",
    			"KW"=> "KW호스텔",
    			"GRC"=> "그린카",
    			"WPC"=> "웅진플레이도시",
        		"test"=> "개발중"
    	);
    	$data['bararr'] = $bararr;


    	$sql = "SELECT * FROM `kit_lms` WHERE id = '$id'  and kit_lms.useyn = 'Y' limit 1";
//    	$sql = "select kit_lms.*,
//        		count( kit_bar.id ) as codecnt from pcmsdb.kit_lms
//				LEFT JOIN pcmsdb.kit_bar on
//        		kit_lms.sellcode = kit_bar.sellcode and kit_lms.pcms_id = kit_bar.gu
//        		where 1
//        		and kit_lms.useyn = 'Y'
//    			and kit_lms.id = '$id'
//    			and kit_bar.orderid is null
//        		limit 1
//        ";//and kit_lms.edate > NOW()

        //조인으로 하면 너무 느려서 쿼리 둘로 쪼갬 2020-10-22 제임스

        $kitbar = $this->db->query($sql)->row();
        $count_sql = "SELECT COUNT(*) as codecnt FROM kit_bar  WHERE sellcode = '{$kitbar->sellcode}' AND gu = '{$kitbar->pcms_id}' AND orderid IS NULL";
        $kitbar_count = $this->db->query($count_sql)->row();
        $data['kitbar'] = $kitbar;
        $data['kitbar_count'] = $kitbar_count;

    	$data['lefeactive'] = "bar";
    	$data['title'] = '바코드 추가하기';
    	$data['contentview'] = '/bar/bar_add';
    	$data['leftview'] = 'left';
    	$data['topview'] = 'head';
    	$data['bottomview'] = 'bottom';
    	$this->load->view('/inc/layout',$data);
    }

    function bar_add_excel(){
    	$this->load->model('cmsmodel');
    	//echo "<script>alert('add file test');</script>";
    	$sellcode=$this->input->post("sellcode");
    	$pcms_id=$this->input->post("pcms_id");
    	$kitid=$this->input->post("kitid");

    	$this->load->library("PHPExcel");
    	$objPHPExcel = new PHPExcel();
    	//$objPHPExcel = PHPExcel_IOFactory::load('./uploads/xlsx.xlsx');
    	$file_name = $_FILES["userfile"]["tmp_name"];

    	$objPHPExcel = PHPExcel_IOFactory::load($file_name);
    	$sheetsCount = $objPHPExcel->getSheetCount();

    	/* 첫번째 쉬트만 읽기 */
    	$objPHPExcel->setActiveSheetIndex(0); //0 -> 첫번째 쉬트
    	$sheet = $objPHPExcel->getActiveSheet();
    	$highestRow = $sheet->getHighestRow();
    	$highestColumn = $sheet->getHighestColumn();

    	$count = 0;
    	//echo $sellcode.":".$pcms_id."\n";
    	/* 한줄읽기 */

    	for ($row = 1; $row <= $highestRow; $row++)
    	{
    	//$rowData가 한줄의 데이터를 셀별로 배열처리 됩니다.
    		$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
    		//print_r($rowData);
    		if($rowData[0][0] != "" && $rowData[0][0] != null){
                //echo $sellcode."/".$pcms_id."/".$rowData[0][0]."\n";
    			$ef = $this->cmsmodel->kit_bar_input($sellcode,$pcms_id,$rowData[0][0]);
    			$count += $ef;

    			//echo $rowData[0][0]."<br/>";
    		}
    	}
    	$this->bar_add($kitid);

    }

    function bar_add_result(){
    	$kitid = $this->input->post('kitid');
    	echo "<script>alert('$kitid');</script>";
    	$this->kit();
    }

    function search_list()
    {
        $this->p_sellcode = $this->input->post('sellcode');
        $this->p_pcms_id = $this->input->post('pcms_id');
        $this->p_itemnm = $this->input->post('itemnm');


        $data['offset'] = 0;
        $data['selectchn'] = "";
        $this->session->set_userdata($data);

        $this->kit();
    }


	function chn_sel() {
		$selectchn = $this->input->post('selectchn');
		$data = array(
			'selectchn' => $selectchn,
			'offset' => 0
		);

		$this->session->set_userdata($data);
		$this->kit();
	}

    function kit_offset($offset=0) {

        $data = array(
            'offset' => $offset
        );
        $this->session->set_userdata($data);
        $this->kit();
    }

    function sticket($mode='')
    {

        $gpArr = array(
            "EL"=> "에버랜드",
            "CB"=> "캐리비안베이"
        );
        $data['gpArr'] = $gpArr;

        $sql = "SELECT * FROM spadb.pcms_sticket WHERE code_visible='Y' and edate >= CURDATE()";

        $query = $this->sparo2->query($sql);
        $data['query'] = $query;
        $data['title'] = '에버랜드 S-ticket';
        $data['contentview'] = '/bar/sticket';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }

    function sticket_add(){

        $gp = $this->input->post('gp');
        $code_s = $this->input->post('code_s');
        $code_c = $this->input->post('code_c');
        $code_i = $this->input->post('code_i');
        $pcms_id = $this->input->post('pcms_id');
        $itemnm = $this->input->post('itemnm');
        $sdate = date("Y-m-d");
        $selldate = $this->input->post('selldate');
        $textarea_value = $this->input->post('textarea_value');

        $bartext = $this->input->post('bartext');
        $barcolor = $this->input->post('barcolor');
        $textcolor = $this->input->post('textcolor');
        //$bartext2 = $this->input->post('bartext2');
        //$barcolor2 = $this->input->post('barcolor2');

        $arr = array ('bartext'=>$bartext,'barcolor'=>$barcolor,'textcolor'=>$textcolor);
        $bar_option = json_encode($arr);


        $damnm = $this->session->userdata('nm');
        $manager = $this->session->userdata('cd');
        $logtxt = $damnm."(".$manager.") 등록";

        $datas = array(
            'code_visible' => 'N',
            'mms_visible' => 'N',
            'bar_log' => $damnm."(".$manager.") 사용해제:신규코드 등록"
        );

        $this->sparo2->where('pcms_id', $pcms_id);
        $this->sparo2->where('code_visible', 'Y');
        $this->sparo2->update('pcms_sticket', $datas);

        echo $logtxt;

        $data = array(
            'gp' => $gp,
            'code_s' => $code_s,
            'code_c' => $code_c,
            'code_i' => $code_i,
            'pcms_id' => $pcms_id,
            'itemnm' => $itemnm,
            'sdate' => $sdate,
            'edate' => $selldate,
            'code_visible' => 'Y',
            'mms_visible' => 'Y',
            'mms_text' => $textarea_value,
            'bar_option' => $bar_option,
            'bar_log' => $logtxt
        );

        if(!$this->sparo2->insert('pcms_sticket', $data)){
            echo "err";
        }else{
            $stid = $this->sparo2->insert_id();
            $now = date("Y-m-d H:m:s");

            $coupon_data = array(
                'ctype' => $gp,
                'chgu' => 'P',
                'ccode' => 'P'.$gp.$code_s.$code_c.$code_i."_".$stid,
                'sellno' => $code_c.$code_i,
                'seed'=>$stid,
                'items_id'=> $pcms_id,
                'cnm' => $itemnm,
                'state'=> 'S',
                'regdate'=> $now,
                'use_sdate'	 => $sdate." 00:00:00",
                'use_edate'	 => $selldate." 23:59:59",
                'cdesc'	=> $damnm."(".$manager.")"
            );
            $this->db->insert('cms_coupon', $coupon_data);
            echo "ok";
        }

    }

    function sticket_mms()
    {
        $id = $this->input->post('flag');
        $mms_text = $this->input->post('mmstext');

        $sql = "select bar_log from spadb.pcms_sticket where id = '{$id}'";
        $logrow = $this->sparo2->query($sql)->row();

        $damnm = $this->session->userdata('nm');
        $damcd = $this->session->userdata('cd');
        $damip = $_SERVER["REMOTE_ADDR"];
        $bar_log = $logrow->bar_log."\n".date("Y-m-d H:i:s").":".$damip.":".$damnm."(".$damcd.") 문자수정";

        $data = array(
            'mms_text' => $mms_text,
            'bar_log' => $bar_log
        );

        $this->sparo2->where('id', $id);

        if(!$this->sparo2->update('pcms_sticket', $data)){
            echo "err";
        }else{
            echo "ok";
        }
    }


    function sticket_mms_stop()
    {
        $id = $this->input->post('flag');

        $sql = "select bar_log from spadb.pcms_sticket where id = '{$id}'";
        $logrow = $this->sparo2->query($sql)->row();

        $damnm = $this->session->userdata('nm');
        $damcd = $this->session->userdata('cd');
        $damip = $_SERVER["REMOTE_ADDR"];
        $bar_log = $logrow->bar_log."\n".date("Y-m-d H:i:s").":".$damip.":".$damnm."(".$damcd.") 문자중지";

        $data = array(
            'code_visible' => 'N',
            'mms_visible' => 'N',
            'bar_log' => $bar_log
        );

        $this->sparo2->where('id', $id);

        if(!$this->sparo2->update('pcms_sticket', $data)){
            echo "err";
        }else{
            echo "ok";
        }
    }

    function sticket_img_ok($cid){

        $tmp_name1 = $_FILES["userfile"]["tmp_name"];
        if (!empty($tmp_name1))
        {
            $filename = $cid."_".date("Ymdhis").".png";
            $config['file_name'] = $filename;
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['overwrite'] = true;    //같은 이름의 파일이 이미 존재한다면 덮어쓸것
            $config['remove_spaces'] = true;    //RUE로 설정하면 파일명에 공백이 있을경우 밑줄(_)로 변경
            $config['max_size']	= '100';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload())
            {
                $ssql = "UPDATE spadb.pcms_sticket set qrbg='{$filename}' WHERE id = '{$cid}' limit 1";
                $this->sparo2->query($ssql);
            }
            redirect('/bar/sticket');
        }
    }

    //추가 이미지 등록
    function sticket_addimg_ok($cid){

        $tmp_name1 = $_FILES["userfile"]["tmp_name"];
        if (!empty($tmp_name1))
        {
            $filename = $cid."_".date("Ymdhis").".png";
            $config['file_name'] = $filename;
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['overwrite'] = true;    //같은 이름의 파일이 이미 존재한다면 덮어쓸것
            $config['remove_spaces'] = true;    //RUE로 설정하면 파일명에 공백이 있을경우 밑줄(_)로 변경
            $config['max_size']	= '100';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload())
            {
                $ssql = "UPDATE spadb.pcms_sticket SET addimg= 'http://pcms.placem.co.kr/uploads/{$filename}' WHERE id = '{$cid}' limit 1";
                $this->sparo2->query($ssql);
            }
            redirect('/bar/sticket');
        }
    }




    function everland($mode='')
    {

    	$this->bar = $this->load->database('bar', TRUE);
    	$monthdate = date("Y-m-d");
    	//barev_2014
    	//bar_item
    	$sql = "select  bar_item.*,
        		sum(
        		if(barev_2014.syncresult is null, 1, 0)
        		) as codecnt from bar_item
				LEFT JOIN barev_2014 on
        		bar_item.itemcode = barev_2014.gu
        		where 1 and bar_item.useyn='Y'
        		and (bar_item.edate >= '".date("Y-m-d")."' or bar_item.edate is null)
        		group by bar_item.id
        		order by bar_item.id desc
        ";

    	$query = $this->bar->query($sql);

    	$data['lefeactive'] = "bar";
    	$data['monthdate'] = $monthdate;
    	$data['query'] = $query;
    	$data['title'] = '에버랜드 바코드 및 문자관리';
    	$data['contentview'] = '/bar/everland';
    	$data['leftview'] = 'left';
    	$data['topview'] = 'head';
    	$data['bottomview'] = 'bottom';
    	$this->load->view('/inc/layout',$data);
    }

    function everland_img_ok($cid){
        $this->bar = $this->load->database('bar', TRUE);
        $tmp_name1 = $_FILES["userfile"]["tmp_name"];
        if (!empty($tmp_name1))
        {
            $filename = $cid."_".date("Ymdhis").".png";
            $config['file_name'] = $filename;
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['overwrite'] = true;    //같은 이름의 파일이 이미 존재한다면 덮어쓸것
            $config['remove_spaces'] = true;    //RUE로 설정하면 파일명에 공백이 있을경우 밑줄(_)로 변경
            $config['max_size']	= '100';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload())
            {
                $ssql = "UPDATE spadb.bar_item set qrbg='{$filename}' WHERE id = '{$cid}' limit 1";
                $this->bar->query($ssql);
            }
            redirect('/bar/everland');
        }
    }

    function everland_addimg_ok($cid){
        $this->bar = $this->load->database('bar', TRUE);
        $tmp_name1 = $_FILES["userfile"]["tmp_name"];
        if (!empty($tmp_name1))
        {
            $filename = $cid."_".date("Ymdhis").".png";
            $config['file_name'] = $filename;
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['overwrite'] = true;    //같은 이름의 파일이 이미 존재한다면 덮어쓸것
            $config['remove_spaces'] = true;    //RUE로 설정하면 파일명에 공백이 있을경우 밑줄(_)로 변경
            $config['max_size']	= '100';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload())
            {
                $ssql = "UPDATE spadb.bar_item set addimg='{$filename}' WHERE id = '{$cid}' limit 1";
                $this->bar->query($ssql);
            }
            redirect('/bar/everland');
        }
    }

    //addimg

    function everland_modify_code(){
    	$this->bar = $this->load->database('bar', TRUE);
    	$this->id = $this->input->post('code');
    	$this->code = $this->input->post('modtext');
    	//echo $this->id."/".$this->hp;

    	$damnm = $this->session->userdata('nm');

    	$slog = $this->bar->query("select bar_log from spadb.bar_item where id='".$this->id."' limit 1")->row()->bar_log."\n/".date("Y-m-d H:i:s")." ".$damnm."코드변경:".$this->code;
    	$ssql = "update spadb.bar_item set
    	itemcode = '{$this->code}',
    	bar_log = '$slog'
    	where id='".$this->id."' limit 1";
    	if($this->bar->query($ssql)){
    		echo "ok";
    	}else{
    		echo "err";
    	}
    }

    function ever_mms_add(){
    	$this->bar = $this->load->database('bar', TRUE);
    	$this->load->model('pcmsmodel');
    	$this->load->model('cmsmodel');
    	$this->select_gp = $this->input->post('select_gp');
    	$this->itemcode = $this->input->post('itemcode');
    	$this->pcmsitem_id = $this->input->post('pcmsitem_id');
    	$this->use_edate = date("Y-m-d",strtotime ($this->input->post('use_edate')));
    	$this->textarea_value = $this->input->post('textarea_value');
    	$this->pcms_itemnm = $this->pcmsmodel->get_pcms_itemnm($this->pcmsitem_id);
    	$damnm = $this->session->userdata('nm');
    	$manager = $this->session->userdata('cd');
    	$this->logtxt = $damnm."(".$manager.") 등록";

    	$datas = array(
    			'useyn' => 'N',
    			'bar_log' => $damnm."(".$manager.") 사용해제:신규코드 등록"
    	);

    	$this->bar->where('pcms_id', $this->pcmsitem_id);
    	$this->bar->where('useyn', 'Y');
    	$this->bar->update('bar_item', $datas);

    	$data = array(
    			'gp' => $this->select_gp,
    			'itemcode' => $this->itemcode,
    			'itemnm' => $this->pcms_itemnm,
    			'pcms_id' => $this->pcmsitem_id,
    			'edate' => $this->use_edate,
    			'useyn' => "Y",
    			'mms_text' => $this->textarea_value,
    			'bar_log' => $this->logtxt
    	);

    	if(!$this->bar->insert('bar_item', $data)){
    		echo "err";
    	}else{
    		echo "ok";
    	}


    }

    function ever_mms()
    {
    	$this->bar = $this->load->database('bar', TRUE);
    	$this->id = $this->input->post('flag');
    	$this->mms_text = $this->input->post('mmstext');

    	$sql = "select bar_log from bar_item
    	where id = '$this->id'";
    	$logrow = $this->bar->query($sql)->row();


    	$damnm = $this->session->userdata('nm');
    	$damcd = $this->session->userdata('cd');
    	$damip = $_SERVER["REMOTE_ADDR"];
    	$this->bar_log = $logrow->bar_log."\n".date("Y-m-d H:i:s").":".$damip.":".$damnm."(".$damcd.") 문자수정";

    			$data = array(
    					'mms_text' => $this->mms_text,
    					'bar_log' => $this->bar_log
    	);

    	$this->bar->where('id', $this->id);

    	if(!$this->bar->update('bar_item', $data)){
    		echo "err";
	    }else{
	   	 	echo site_url('bar/everland');
	    }
    }


    function ever_mms_stop()
    {
    	$this->bar = $this->load->database('bar', TRUE);
    	$this->id = $this->input->post('flag');

    	$sql = "select bar_log from bar_item
    	where id = '$this->id'";
    	$logrow = $this->bar->query($sql)->row();


    	$damnm = $this->session->userdata('nm');
    	$damcd = $this->session->userdata('cd');
    	$damip = $_SERVER["REMOTE_ADDR"];
    	$this->bar_log = $logrow->bar_log."\n".date("Y-m-d H:i:s").":".$damip.":".$damnm."(".$damcd.") 문자중지";

    	$data = array(
    			'useyn' => 'N',
    			'bar_log' => $this->bar_log
    	);

    	$this->bar->where('id', $this->id);

    	if(!$this->bar->update('bar_item', $data)){
    		echo "err";
    	}else{
    		echo site_url('bar/everland');
    	}
    }

    function directExcelDown($sellcode='',$item_id='')
    {
        if($sellcode==''){
            exit;
        }

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
            && $ip != "112.169.116.113"
            && $ip != "106.254.252.100"
            && $ip != "118.131.208.126"
            && $damcd != 'jjlee'
            && $ip != "61.74.186.246"   // 20241127 tony 테이블메니저 VPN 허용

        ){
            exit;
        }

        $sql = "SELECT * FROM pcmsdb.cms_extcoupon WHERE sellcode = '{$sellcode}'";

        //다운로드 로그
        $logtext = addslashes($sql);
        $logsql = "insert pcmsdb.log_exceldown set qrystr = '{$logtext}',regdate = NOW(),ip='{$ip}',bigo='{$damcd}'";
        $this->db->query($logsql);

        $query = $this->db->query($sql);
        if($query){
            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //$this->excel->getActiveSheet()->setTitle($ITEM_NAME2);
            $this->excel->getActiveSheet()->setTitle($sellcode);
            $cnt = 1;

            foreach($query->result() as $row):

                $this->excel->getActiveSheet()->setCellValueExplicit('A'.$cnt, $row->no_coupon,PHPExcel_Cell_DataType::TYPE_STRING);

                $cnt++;
            endforeach;

            $filename= $sellcode.'_'.$item_id.'_EXCEL.xls'; // 엑셀 파일 이름
            header('Content-Type: application/vnd.ms-excel'); //mime 타입
            header('Content-Disposition: attachment;filename="'.$filename.'"'); // 브라우저에서 받을 파일 이름
            header('Cache-Control: max-age=0'); //no cache

            // Excel5 포맷으로 저장 엑셀 2007 포맷으로 저장하고 싶은 경우 'Excel2007'로 변경합니다.
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
            // 서버에 파일을 쓰지 않고 바로 다운로드 받습니다.
            $objWriter->save('php://output');

        }
    }


    function makeExcelDown($sellcode='')
    {
        if($sellcode==''){
            exit;
        }

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
           && $ip != "106.254.252.100"
            && $damcd != 'jjlee'
            && $ip != "61.74.186.246"   // 20241127 tony 테이블메니저 VPN 허용

        ){
            exit;
        }

        $sql = "SELECT * FROM spadb.pcms_extcoupon WHERE sellcode = '{$sellcode}'";

        //다운로드 로그
        $logtext = addslashes($sql);
        $logsql = "insert pcmsdb.log_exceldown set qrystr = '{$logtext}',regdate = NOW(),ip='{$ip}',bigo='{$damcd}'";

        $query = $this->sparo2->query($sql);
        if($query){
            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            //$this->excel->getActiveSheet()->setTitle($ITEM_NAME2);
            $this->excel->getActiveSheet()->setTitle($sellcode);
            $cnt = 1;

            foreach($query->result() as $row):
                //$this->excel->getActiveSheet()->setCellValue('A'.$cnt, $row->couponno);
                $this->excel->getActiveSheet()->setCellValueExplicit('A'.$cnt, $row->couponno,PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValueExplicit('B'.$cnt, $row->opt_coupon,PHPExcel_Cell_DataType::TYPE_STRING);
                $cnt++;
            endforeach;

            $filename= $sellcode.'_EXCEL.xls'; // 엑셀 파일 이름
            header('Content-Type: application/vnd.ms-excel'); //mime 타입
            header('Content-Disposition: attachment;filename="'.$filename.'"'); // 브라우저에서 받을 파일 이름
            header('Cache-Control: max-age=0'); //no cache

            // Excel5 포맷으로 저장 엑셀 2007 포맷으로 저장하고 싶은 경우 'Excel2007'로 변경합니다.
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
            // 서버에 파일을 쓰지 않고 바로 다운로드 받습니다.
            $objWriter->save('php://output');
        }
    }
    function make($mode=''){
		if ($mode == 'new') {
            $data['bartype'] = '';
            $data['itemno'] = '';
            $data['chno'] = '';

            $data['limit'] = '';
            $data['offset'] = 0;

            $this->session->set_userdata($data);
        }



		$data['EL'] = $this->session->userdata('EL');
		$data['CB'] = $this->session->userdata('CB');
		$data['HT'] = $this->session->userdata('HT');
		$data['WP'] = $this->session->userdata('WP');
		$data['ML'] = $this->session->userdata('ML');
		$data['FV'] = $this->session->userdata('FV');
		$data['PM'] = $this->session->userdata('PM');
		$data['SJ'] = $this->session->userdata('SJ');
		$data['BG'] = $this->session->userdata('BG');
		$data['OW'] = $this->session->userdata('OW');
		$data['AQ'] = $this->session->userdata('AQ');
		$data['AP'] = $this->session->userdata('AP');
		$data['KZ'] = $this->session->userdata('KZ');
		$data['PC'] = $this->session->userdata('PC');
    $data['ES'] = $this->session->userdata('ES');
    $data['RL'] = $this->session->userdata('RL');
    $data['SP'] = $this->session->userdata('SP');
    $data['NC'] = $this->session->userdata('NC');
    $data['DS'] = $this->session->userdata('DS');
    $data['WS'] = $this->session->userdata('WS');
    $data['BS'] = $this->session->userdata('BS');
    $data['KG'] = $this->session->userdata('KG');
    $data['BE'] = $this->session->userdata('BE');
		$data['bartype'] = $this->session->userdata('bartype');
    $data['itemno'] = $this->session->userdata('itemno');
    $data['chno'] = $this->session->userdata('chno');
        // $data['api'] = $this->session->userdata('api'); // 쿠폰발급2 api column값 추가 - 21.11.11 jason

    	$ctypeArr = array(
    			""=> "바코드 타입",
    			"EL"=> "에버랜드(Sticket)",
          "CB"=> "캐리비안베이(Sticket)",
    			"HT"=> "에버랜드 해외 홈티켓",
          "WP"=> "롯데통합쿠폰(워터등)",
          "ML"=> "롯데통합쿠폰(다회권)",
          "WS"=> "웅진시즌",
          "FV"=> "민속촌",
    			"PM"=> "지류권",
          // "SJ"=> "삼정더파크",
          "KZ"=> "키자니아",
          "BG"=> "블루캐니언/휘닉스파크",
          "OW"=> "오월드",
           // "AQ"=> "아쿠아필드",
          "AP"=> "아쿠아플라넷",
				  "HW"=> "하이원워터",
        	"HL"=> "하이원리프트",
          // "HS"=> "하이원스키시즌권",
          "EC"=> "이랜드크루즈",
          "PS"=> "플레이도시",
          "ES"=> "PM내부쿠폰(숫자)",
          "PC"=> "파라다이스시티",
          "DM"=> "대명",
          "RL"=> "리솜리조트",
          "SP"=> "스포츠티켓(대전)",
          "NC"=> "키오스크(숫자)",
          "DS"=> "대전신세계과학관",
          "BS"=> "벨포레",
          "KG"=> "곤지암루지",
          "BE"=> "롯데B2E바우처"
    	);
	// if ($_SERVER["REMOTE_ADDR"] == "106.254.252.100") print_r($data);
    	/*
		"EV"=> "에버랜드QR",
		"OM"=> "원마운트",
    			"KW"=> "경주월드",
		"PL"=> "(개발TEST)지류권",

		"FR"=> "에버랜드 해외QR",
    	 * "EB"=> "이베이",
    	"AP"=> "에이페이"
    	 * */
    	$data['ctypeArr'] = $ctypeArr;


    	$chguArr = array(
    			""=> "사용 채널",
    			"P"=> "플레이스엠",
    			"T"=> "티몬",
    			"W"=> "위메프",
    			"N"=> "네이버",
    			"C"=> "쿠팡",
          "Y"=> "여기어때",
          "B"=> "B2B해외",
          "K"=> "클룩(KLOOK)",
          "R"=> "트립닷컴(CTRIP)",
          "X"=> "트래블플랜"
    	);//"S"=> "초콜릿",

    	$data['chguArr'] = $chguArr;

    	$stateArr = array(
    			"R"=> "생성요청",
    			"D"=> "생성중",
    			"S"=> "생성완료",
    			"H"=> "홈티켓"
    	);
    	$data['stateArr'] = $stateArr;

    	$adate = date("Y-m-d H:i:s",strtotime ("-7 days"));

		if($this->session->userdata('offset') != '' && $this->session->userdata('offset') != null){
			$offset= $this->session->userdata('offset');
		}else{
			$offset= 0;
		}
		//타입 세션 확인
		if($this->session->userdata('bartype') != '' && $this->session->userdata('bartype') != null){
			$bartype = $this->session->userdata('bartype');
		}else{
			$bartype="";
		}

		$_where = " use_edate > now()  ";
		$_is_where = false;
		//타입별 쿼리
		if($bartype != '' && $bartype != NULL) {
            $_where .= " and ctype='{$bartype}'";
            $_is_where = true;
            //기본값
        }
        if($this->session->userdata('itemno') != '' && $this->session->userdata('itemno') != null ){
            $itemno = $this->session->userdata('itemno');
            $_where .= " and  items_id='{$itemno}' ";
            $_is_where = true;
        }

        if($this->session->userdata('chno') != '' && $this->session->userdata('chno') != null ){
            $chno = $this->session->userdata('chno');
            $_where .= " and  chgu='{$chno}' ";
            $_is_where = true;
        }

        if ($_is_where === true) {
            $sql="select * from cms_coupon where ".$_where;
        } else {
            $sql="select * from cms_coupon where (ctype != 'FR' and use_edate > now() ) or  (ctype = 'FR' and regdate > '$adate')  or state != 'S' ";
        }

        $query = $this->db->query($sql);
        $total_rows = $query -> num_rows();
        $limit = 100;

        $this->load->library('pagination');
        $config['base_url'] = 'http://pcms.ticketmanager.ai/index.php/bar/make_offset/';
        $config['total_rows'] =  $total_rows;
        $config['per_page'] = $limit;
        $config['cur_page'] = $offset;
        $config['uri_segment'] = 3;

        page_default_set($config);

        $this->pagination->initialize($config);
        $data['pag_links'] = $this->pagination->create_links();

		$sql .= " order by id desc limit $offset, $limit";
//		echo $sql;
        $data['query'] = $this->db->query($sql);
    	$data['title'] = '바코드 생성 요청';
    	$data['contentview'] = '/bar/make';
    	$data['leftview'] = 'left';
    	$data['topview'] = 'head';
    	$data['bottomview'] = 'bottom';
    	$this->load->view('/inc/layout',$data);
    }

    function set_img($id){
        if($id == '' || $id == null){
            $this->make();
        }
        $ctypeArr = array(
            ""=> "바코드 타입",
            "EV"=> "에버랜드QR",
            "FR"=> "에버랜드 해외QR",
            "EL"=> "에버랜드(Sticket)",
            "CB"=> "캐리비안베이(Sticket)",
            "HT"=> "에버랜드 해외 홈티켓",
            "WP"=> "롯데통합쿠폰(워터등)",
            "ML"=> "롯데통합쿠폰(다회권)",
            "FV"=> "민속촌",
            "HO"=> "하이원리프트",
            "PM"=> "지류권",
            "WS"=> "웅진시즌권",
            "KW"=> "경주월드",
            "SJ"=> "삼정더파크",
            "OW"=> "오월드",
            "KZ"=> "키자니아",
            "RL"=> "리솜리조트",
            "ES"=> "PM내부쿠폰(숫자)",
            "DM"=> "대명",
            "NC"=> "키오스크숫자",
			         "SP"=> "스포츠티켓(대전)",
               "DS"=> "스포츠티켓(대전)",
               "BS"=> "벨포레",
               "KG"=> "곤지암루지",
               "BE"=> "롯데B2E바우처"
        );
        $data['ctypeArr'] = $ctypeArr;

        $sql = "select *
                from pcmsdb.cms_coupon
        		where 1
        		and id = '$id'
        		limit 1
        ";

        $cms_coupon = $this->db->query($sql)->row();
        $data['cms_coupon'] = $cms_coupon;

        $data['lefeactive'] = "bar";
        $data['title'] = 'QR 이미지 관리';
        $data['contentview'] = '/bar/set_img';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }

    function set_img_ok($cid,$ccode){
//17629/K06651_1
        $this->load->model('cmsmodel');
        $tmp_name1 = $_FILES["userfile"]["tmp_name"];
        if (!empty($tmp_name1))
        {
            $filename = $cid."_".$ccode.".png";
            $config['file_name'] = $filename;
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['overwrite'] = true;    //같은 이름의 파일이 이미 존재한다면 덮어쓸것
            $config['remove_spaces'] = true;    //RUE로 설정하면 파일명에 공백이 있을경우 밑줄(_)로 변경
            $config['max_size']	= '100';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());

                print_r( $error);
            }else{

                $ssql = "UPDATE pcmsdb.cms_coupon set makeqr = 'R',bgimg='{$filename}' WHERE id = '{$cid}'  limit 1";
                $this->db->query($ssql);
                redirect('/bar/set_img/' . $cid);
            }

/*
            if ($this->upload->do_upload())
            {
                $ssql = "UPDATE pcmsdb.cms_coupon set makeqr = 'R',bgimg='{$filename}' WHERE id = '{$cid}'  limit 1";
                $this->db->query($ssql);
            }
            redirect('/bar/set_img/'.$cid);*/
            //$this->set_img($cid);
        }
    }

    function make_add_ary(){
        $this->load->model('pcmsmodel');

        $this->ctype = $this->input->post('ctype');
//        $this->chgu = $this->input->post('chgu');
        $_chgu = $this->input->post('chgu');
        $this->sellno = trim($this->input->post('sellno'));
        $pcmsitem_id_ary = trim($this->input->post('pcmsitem_id'));
        $this->qty = trim($this->input->post('qty'));
        $this->faccode = trim($this->input->post('faccode'));
        $this->cnm  = trim($this->input->post('cnm'));
        $this->cunit  = trim($this->input->post('cunit'));
        $this->use_sdate = trim($this->input->post('use_sdate'));
        $this->use_edate = trim($this->input->post('use_edate'));
        $this->syncorder = trim($this->input->post('syncorder'));
        $this->api = trim($this->input->post('api'));
        $damnm = $this->session->userdata('nm');
        $damcd = $this->session->userdata('cd');
        $this->logtxt = $damnm."(".$damcd.")";

        //echo $this->pcmsitem_id."->".$this->sellno;

        for ($i = 0; $i < count($_chgu); $i++){
            if (!empty($_chgu[$i])){
                $pcmsitem_ary = explode(",",$pcmsitem_id_ary );

                for ($j = 0; $j < count($pcmsitem_ary); $j++){

                    if (!empty($pcmsitem_ary[$j])){
                        $this->pcmsitem_id = $pcmsitem_ary[$j];
                        $this->chgu = $_chgu[$i];

                        //블루캐니언이면 sellno = prifix
                        if($this->ctype == 'BG'){
                            $bgitem =  $this->pcmsmodel->get_phoenix_items($this->pcmsitem_id);
                            $this->sellno =$bgitem->prifix;
                        }

                        $this->seed = $this->pcmsmodel->get_seed($this->ctype,$this->chgu,$this->sellno,$this->pcmsitem_id);

                        $this->ccode = "";

                        switch ($this->ctype){
                            case "EV":	//에버랜드
                            case "FR":	//외국인
                            case "HT":	//홈티켓
                            case "HO":	//민속촌
                            case "HW":	//민속촌
                            case "HL":	//민속촌
                            case "WP":	//롯데워터파크

                            case "EL":	//에버랜드
                            case "CB":	//에버랜드
                                $this->ccode = $this->chgu.$this->sellno."_".$this->seed;
                                break;
                            case "PM":	//지류권

                                $this->ccode = $this->chgu."P".$this->seed;
                                $this->sellno = $this->ccode;
                                break;
                            case "OM":	//원마운트
                                $this->ccode = $this->sellno;
                                break;

                            case "KW":	//경주월드
                            case "FV":	//민속촌
                            case "WS":	//민속촌
                            case "BG":	//블루캐니언
                            case "AQ":	//아쿠아필드
                            case "AP":	//아쿠아플라넷
                            case "PS":	//플레이도시
                            case "OW":	//오월드
                            case "KZ":	//키자니아
                            case "PC":	//파라다이스시티
                            case "ES":	//파라다이스시티
                            case "RL":	//파라다이스시티
                            case "SP":	// 대전시티즌
                            case "NC":	// 대전시티즌
                            case "DS":	// 대전시티즌
                            case "BS":	// 벨포레
                            case "KG":	// 곤지암루지
                            case "BE":	// 롯데B2E
                                case "ML":	//롯데 다인권 콜백  
                                $this->ccode = $this->chgu."P".$this->pcmsitem_id."_".$this->seed;
                                break;
                        }


                        $sql_items = "select * from CMS_ITEMS where item_id = '".$this->pcmsitem_id."' limit 1";
                        $query = $this->cms->query($sql_items);
                        $total = $query -> num_rows();
                        if($total < 1){

                        }else{
                            $row = $query->row(); // row넘김
                            //item_nm 아이템이름을 다시 불러옴
                            $this->pcmsmodel->cms_coupon_add(
                                $this->ctype,$this->chgu,$this->ccode,$this->sellno,$this->seed,$this->pcmsitem_id,$row->item_nm,$this->cunit,$this->qty,$this->use_sdate,$this->use_edate,$this->logtxt,$this->syncorder,$this->api
                            );
                        }

                    }

                }

            }

        }

    }


    function make_add(){
    	$this->load->model('pcmsmodel');

    	$this->ctype = $this->input->post('ctype');
    	$this->chgu = $this->input->post('chgu');
    	$this->sellno = trim($this->input->post('sellno'));
    	$this->pcmsitem_id = trim($this->input->post('pcmsitem_id'));
    	$this->qty = trim($this->input->post('qty'));
    	$this->faccode = trim($this->input->post('faccode'));
    	$this->cnm  = trim($this->input->post('cnm'));
    	$this->cunit  = trim($this->input->post('cunit'));
    	$this->use_sdate = trim($this->input->post('use_sdate'));
    	$this->use_edate = trim($this->input->post('use_edate'));
        $this->syncorder = trim($this->input->post('syncorder'));
        $this->api = trim($this->input->post('api'));
    	$damnm = $this->session->userdata('nm');
    	$damcd = $this->session->userdata('cd');
    	$this->logtxt = $damnm."(".$damcd.")";

        //블루캐니언이면 sellno = prifix
        if($this->ctype == 'BG'){
            $bgitem =  $this->pcmsmodel->get_phoenix_items($this->pcmsitem_id);
            $this->sellno =$bgitem->prifix;
        }
        //echo $this->pcmsitem_id."->".$this->sellno;


    	$this->seed = $this->pcmsmodel->get_seed($this->ctype,$this->chgu,$this->sellno,$this->pcmsitem_id);

    	$this->ccode = "";

    	switch ($this->ctype){
    		case "EV":	//에버랜드
    		case "FR":	//외국인
    		case "HT":	//홈티켓
            case "HO":	//민속촌
            case "HW":	//민속촌
            case "HL":	//민속촌
            case "WP":	//롯데워터파크

    		case "EL":	//에버랜드
    		case "CB":	//에버랜드
    			$this->ccode = $this->chgu.$this->sellno."_".$this->seed;
    		break;
    		case "PM":	//지류권
        case "ML":	//롯데 다인권 콜백
    			$this->ccode = $this->chgu."P".$this->seed;
    			$this->sellno = $this->ccode;
    		break;
    		case "OM":	//원마운트
    			$this->ccode = $this->sellno;
    		break;

    		case "KW":	//경주월드
            case "FV":	//민속촌
            case "BG":	//블루캐니언
            case "AQ":	//아쿠아필드
            case "AP":	//아쿠아플라넷
            case "PS":	//플레이도시
            case "OW":	//오월드
            case "KZ":	//키자니아
            case "PC":	//파라다이스시티
            case "ES":	//파라다이스시티
            case "RL":	//파라다이스시티
            case "SP":	//파라다이스시티
            case "NC":	//파라다이스시티
            case "DS":	//과학관
            case "WS":	//과학관
            case "BS":	// 벨포레
            case "KG":	// 곤지암루지
            case "BE":	// 롯데 B2E
				$this->ccode = $this->chgu."P".$this->pcmsitem_id."_".$this->seed;
    		break;
    	}


    	$this->pcmsmodel->cms_coupon_add(
    			$this->ctype,$this->chgu,$this->ccode,$this->sellno,$this->seed,$this->pcmsitem_id,$this->cnm,$this->cunit,$this->qty,$this->use_sdate,$this->use_edate,$this->logtxt,$this->syncorder,$this->api
    	);

    }

    function make_del(){
    	$this->code = $this->input->post('code');
    	$this->db->delete('cms_coupon', array('id' => $this->code , 'state' => 'R'),1,0);
    	$resultrows = $this->db->affected_rows();
    	if($resultrows > 0){
    		echo "DBOK";
    	}else{
    		echo "err";
    	}
    }

    function excelDown($id=''){
    	$this->load->helper('download');
    	if($id != '' && $id != null){
    		$sql="select * from cms_coupon where id = $id limit 1";
    		$row = $this->db->query($sql)->row();
    		if($row->outFileName != ''){
    			$data = file_get_contents("/home/sys.placem.co.kr/order_script/coupon_output/".$row->outFileName); // Read the file's contents
    			$name = $row->chgu."_".$row->items_id."_".$row->ccode.".xls";
    			force_download($name, $data);
    		}
    	}
    }

    function imageDown($id=''){
    	ini_set('memory_limit',-1);
    	$this->load->library('zip');
    	$this->load->helper('download');

    	if($id != '' && $id != null){
    		$sql="select * from cms_coupon where id = $id limit 1";
    		$row = $this->db->query($sql)->row();
    		if($row->outFileName != ''){
    			$name = $row->chgu."_".$row->items_id."_".$row->ccode.'.zip';
    			$path = $row->imgURL."/";
    			$this->zip->read_dir($path, FALSE);
    			$this->zip->download($name);
    		}
    	}
    }

    function social(){

    	$data['contentview'] = '/bar/social';
    	$data['leftview'] = 'left';
    	$data['topview'] = 'head';
    	$data['bottomview'] = 'bottom';
    	$this->load->view('/inc/layout',$data);
    }

    function coupon($mode='')
    {
        $data['title'] = '통합바코드 사용처리';
        $data['contentview'] = '/bar/coupon';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }

    function  barcode_cancel(){
        $this->sparo2 = $this->load->database('sparo2', TRUE);
        $this->pcms = $this->load->database('pcms', TRUE);
        $resultMSG = "처리 결과";
        $this->barcodetxt = $this->input->post('barcodetxt');

        $barcodearr =explode("\n",$this->barcodetxt);
        foreach($barcodearr as $bar){
            $bar = trim($bar);
            if($bar != "" && $bar != null){
                //echo $bar;

                $sql = "SELECT *  FROM pcmsdb.kit_bar WHERE no ='$bar' order by id desc limit 1";
                $kitres = $this->db->query($sql);
                $kit_rows = $kitres -> num_rows();

                if($kit_rows == 0){
                    $resultMSG.= "\n".$bar."\t잘못된 쿠폰 번호";
                }else{
                    //$resultMSG.= "\n".$bar."\t제대로된 쿠폰 번호";
                    $kitrow = $kitres->row();
                    $nordersql = "select * from ordermts where pcms_oid = '{$kitrow->orderid}' limit 1";
                    $norderres = $this->sparo2->query($nordersql);
                    $norder_rows = $norderres -> num_rows();

                    $nordersql2 = "select * from ordermts where id = '{$kitrow->orderid}' limit 1";
                    $norderres2 = $this->sparo2->query($nordersql2);
                    $norder_rows2 = $norderres2 -> num_rows();

                    if($norder_rows == 0 && $norder_rows2 == 0){
                        $resultMSG.= "\n".$bar."\t뉴스파로 주문 누락";
                    }else{
                        $whereid = 'pcms_oid';
                        if($norder_rows == 0 ){
                            $norderres =$norderres2;
                            $whereid = 'id';
                        }
                        //$resultMSG.= "\n".$bar."\t뉴스파로 주문 안 누락";
                        $norderrow = $norderres->row();
                        if($norderrow->state == '취소'){
                            $resultMSG.= "\n".$bar."\t뉴스파로 취소주문 구입일:{$norderrow->created} / {$norderrow->usernm} / 주문상태:{$norderrow->state} / 담당자메모{$norderrow->dammemo}";
                        }else if ($norderrow->usegu == '1'){
                            $resultMSG.= "\n".$bar."\t뉴스파로 기사용주문 구입일:{$norderrow->created} / {$norderrow->usernm} / 사용시간:{$norderrow->usegu_at} / 주문상태:{$norderrow->state} / 담당자메모{$norderrow->dammemo}";
                        }else{
                            $resultMSG.= "\n".$bar."\t사용처리 완료 구입일:{$norderrow->created} / {$norderrow->usernm} / 담당자메모{$norderrow->dammemo}";
                            $usedate = date("Y-m-d H:i:s");
                            $updateqry2 = "update ordermts set usegu = '1',usegu_at = '$usedate'  where usegu != '1' and {$whereid} = '{$kitrow->orderid}'  limit 1";
                            $this->sparo2->query($updateqry2);
                            $updateconn="update pcmsdb.kit_bar set useyn = 'Y',usedate = '$usedate'  where useyn = 'N' and no ='$bar' limit 1";
                            $this->db->query($updateconn);
                            $updateqry2 = "update ordermts set usegu = '1',usegu_at = '$usedate'  where usegu != '1' and id = '{$kitrow->orderid}'  limit 1";
                            $this->pcms->query($updateqry2);
                        }
                    }
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

	//남은 바코드(외부핀) 갯수 현황
	function countck_c(){
		$id = $this->input->post('code');
		 $sql = "select kit_lms.*,
        if(
            kit_lms.gp = 'PM',0,
            sum(if(kit_bar.orderid is NULL ,1,0))
        ) as codecnt
        from kit_lms
        LEFT JOIN kit_bar on
        kit_lms.sellcode = kit_bar.sellcode and kit_lms.pcms_id = kit_bar.gu
        where 1
        and kit_lms.id='{$id}'
        group by kit_lms.id
       ";
        $query = $this->db->query($sql);
        $result = $query -> row();
        echo $result->codecnt;
	}

    // 20241002 tony [잔여핀수량핀] 잔여 핀 수량 확인요청건 https://placem.atlassian.net/browse/P2CCA-687
    // 지류권 잔여수량 갯수 반환
    function countck_pm(){
        $id = $this->input->post('code');
        $ccode = $this->input->post('ccode');

        $sql = "select count(*) as codecnt from pcms_extcoupon where sellcode = '$ccode' and order_no is null and order_id = 0";
        //echo $sql;exit;
        $res = $this->sparo2->query($sql);

        $row = $res->row();

        echo $row->codecnt;
    }

	function make_item()
    {
        $data['EL'] = trim($this->input->post('EL'));
        $data['CB'] = trim($this->input->post('CB'));
        $data['HT'] = trim($this->input->post('HT'));
        $data['WP'] = trim($this->input->post('WP'));
        $data['ML'] = trim($this->input->post('ML'));
        $data['FV'] = trim($this->input->post('FV'));
        $data['PM'] = trim($this->input->post('PM'));
        $data['SJ'] = trim($this->input->post('SJ'));
        $data['BG'] = trim($this->input->post('BG'));
        $data['OW'] = trim($this->input->post('OW'));
        $data['AQ'] = trim($this->input->post('AQ'));
        $data['AP'] = trim($this->input->post('AP'));
        $data['ES'] = trim($this->input->post('ES'));
        $data['RL'] = trim($this->input->post('RL'));
        $data['SP'] = trim($this->input->post('SP'));
        $data['NC'] = trim($this->input->post('NC'));
        $data['DS'] = trim($this->input->post('DS'));
        $data['WS'] = trim($this->input->post('WS'));
        $data['BS'] = trim($this->input->post('BS'));
        $data['KG'] = trim($this->input->post('KG'));
        $data['BE'] = trim($this->input->post('BE'));
        $data['itemno'] = $this->input->post('itemno');
        $data['bartype'] = $this->input->post('bartype');

        if (!empty($this->input->post('chno'))){
            $data['chno'] = $this->input->post('chno');
        }


        $data['offset'] = 0;

        $this->session->set_userdata($data);

        $this->make();
    }

	function make_ctype() {
		$data['EL'] = trim($this->input->post('EL'));
		$data['CB'] = trim($this->input->post('CB'));
		$data['HT'] = trim($this->input->post('HT'));
		$data['WP'] = trim($this->input->post('WP'));
		$data['ML'] = trim($this->input->post('ML'));
		$data['FV'] = trim($this->input->post('FV'));
		$data['PM'] = trim($this->input->post('PM'));
		$data['SJ'] = trim($this->input->post('SJ'));
		$data['BG'] = trim($this->input->post('BG'));
		$data['OW'] = trim($this->input->post('OW'));
		$data['AQ'] = trim($this->input->post('AQ'));
		$data['AP'] = trim($this->input->post('AP'));
	    $data['RL'] = trim($this->input->post('RL'));
	    $data['SP'] = trim($this->input->post('SP'));
    $data['NC'] = trim($this->input->post('NC'));
    $data['DS'] = trim($this->input->post('DS'));
    $data['WS'] = trim($this->input->post('WS'));
    $data['BS'] = trim($this->input->post('BS'));
    $data['KG'] = trim($this->input->post('KG'));
    $data['BE'] = trim($this->input->post('BE'));
		$data['bartype'] = $this->input->post('bartype');
        $data['offset'] = 0;
//        $data['item_no'] = "";

        $data['itemno'] = $this->input->post('itemno');


        if (!empty($this->input->post('chno'))){
            $data['chno'] = $this->input->post('chno');
        }



        $this->session->set_userdata($data);


		$this->make();
	}

	function make_offset($offset = 0)
    {
        $data['offset'] = $offset;
        $this->session->set_userdata($data);
        $this->make();
    }

}


?>
