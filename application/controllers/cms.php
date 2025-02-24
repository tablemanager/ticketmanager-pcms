<?php 

class Cms extends CI_Controller { 

function __construct() {
		parent::__construct();
		if (!(($this->uri->segment(3) == 'login') || ($this->uri->segment(3) == 'login_ok')))
			$this->is_logged_in();
			$this->cms = $this->load->database('cms', TRUE);
			$this->pcms = $this->load->database('pcms', TRUE);
			$this->sparo = $this->load->database('sparo', TRUE);
			$this->sparo2 = $this->load->database('sparo2', TRUE);
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

	function sync($mode='')
    {
    	$chnarr = array(
    			"TMON" => "티켓몬스터",
    			"CPNG" => "쿠팡",
    			"WEMP" => "위메프(구연동)",
    			"WMP" => "위메프(신규연동)",
    			"GS"=> "GS이샵",
    			"CJ"=> "CJ",
    			"LTIM"=> "롯데아이몰",
    			"LTM"=> "롯데닷컴",
    			"HML"=> "현대몰",
    			"AKM"=> "AK몰",
    			"STN"=> "세일투나잇",
    			"APAY"=> "에이페이",
    			"TSD"=> "티켓수다",
    			"LEQ"=> "레져큐(가자고)",
    			"HLP" => "힐팩",
    			"SGM" => "신세계몰(이마트)",
    			"WAUG" => "와그",
    			"HTK" => "홈티켓",
    			"AJM" => "홈엔쇼핑(AJ몰)",
                "FPS"  => "펀패스",
                "MRT"  => "마이리얼트립",
                "SOT"  => "서울여행",
                "FNR"  => "홈페이지RMS",
                "WHG"  => "웨어고",
                "ETBS"  => "이제너두",
                "AON"  => "아트온",
                "WITH"  => "여기어때",
                "EDUP"  => "에듀팡",
                "BRM"  => "보리보리몰",
                "HYW"  => "한유망",
                "KLUK"=> "삼성물산 꾸럭",
                "WJTB"=> "웅진싱크빅",
                "SMTX"=> "스마틱스",
                "WPSM"=> "위메프(스마틱스)"

        );


    	//관리자 권한 채널 추가

		$chnall = $chnarr;

		if($this->session->userdata('cd') == "penfen" || $this->session->userdata('cd') == "jjlee"){
    		//$chnarr["LEQ"] = "레져큐(가자고)";

            $chnall["MCL"] = "미카엘개발";
            $chnall["SKT"] = "SK초콜릿";
    		$chnall["SKP"] = "시럽";
            $chnall["BBZ"] = "비블로즈";
            $chnall["CUZ"] = "쿠즐";
            $chnall["DTR"] = "다투어";
            $chnall["SSC"] = "삼성카드";
            $chnall["VPC"] = "브이피";

    	}
    	
    	if($this->session->userdata('cd') == "penfen" || $this->session->userdata('cd') == "jjlee"){
    		$chnarr = $chnall;
    	}
    	
    	//채널 권한별 쿼리
    	$ingu = "AND channel in (";
    	foreach($chnall as $chnk => $chnv){
    	     $ingu .= "'".$chnk."',";
    	} 
    	$ingu .= "'1') ";
    	
    	$data['chnarr'] = $chnarr;
		$data['chnall'] = $chnall;
    	
    	//채널별 보기를 만들어야겠다.
    	//$this->db = $this->load->database('default', TRUE);
    	if($mode == 'new'){
    		$data['searchchn'] = '';
    		$this->session->set_userdata($data);
    	}
    	$searchchn = $this->session->userdata('searchchn');
    	
    	if($mode != 'new' && $mode != '' && $mode != null){
    		$searchchn = $mode;
    	}
    	//채널값을 굽자.
    	$where = " AND useyn = 'Y' ";
    	//if($searchchn != '' && $searchchn != null && $searchchn != "all"){
    		$where .= "AND channel = '$searchchn'";
    	//}
		
    	//양이 많아 등록한 본인 데이터만 불러오기(속도개선?)
    	if($this->session->userdata('cd') != "penfen" && $this->session->userdata('cd') != "jjlee"){
    		//$where .= "AND dam = '".$this->session->userdata('cd')."'";
    	}
    	    	
    	//$sql="select * from items_ext where usedate > '".date("Y-m-d")."' $ingu $where order by id desc";
		$sql="select * from items_ext where 1 $ingu $where order by id desc";
    	$data['query'] = $this->db->query($sql);
    	$data['title'] = '판매채널 상품 설정';
    	$data['contentview'] = '/cms/sync';
    	/* if($mode == 'test'){
    		$data['contentview'] = '/cms/sync_test';
    	} */
    	$data['leftview'] = 'left';
    	$data['topview'] = 'head';
    	$data['bottomview'] = 'bottom';
    	$this->load->view('/inc/layout',$data);
    }

	
    function dnprice(){
    	//$this->id = $this->input->post('id');

		//$sql="select * from items_ext where 1 $ingu $where order by id desc";
    	//$res = $this->db->query($sql);
	}

    function selectchn(){
    	$this->selectchn = $this->input->post('selectchn');
    	//if($this->selectchn == "" || $this->selectchn == null || $this->selectchn == "0")$this->selectchn = "new";
    	$data['searchchn'] = $this->selectchn;
    	$this->session->set_userdata($data);
    	echo "ok|저장되었습니다.";
    }
    
    function cms_pcms() {
    	$this->load->model('pcmsmodel');
    	
    	
    	$this->chnpick = $this->input->post('chnpick');
    	$this->pcmsitem_id = $this->input->post('pcmsitem_id');
    	$this->datetimepicker1 = $this->input->post('datetimepicker1');
    	//$this->password_field = $this->input->post('password_field');   	
        //$this->pcmsitem_nm = $this->input->post('pcmsitem_nm'); 
        $this->coupon_id = $this->input->post('coupon_id');
        $this->admin_cd = $this->input->post('admin_cd');
        $this->chitem_id = $this->input->post('chitem_id');
        $this->pcmsitem_nm = $this->pcmsmodel->get_pcms_itemnm($this->pcmsitem_id);
        
        //echo "err|".$this->chnpick;
    	if(!$this->chnpick){
    		echo "err|채널을 선택해주세요.";
    	}else if(!$this->pcmsitem_id){
    		echo "err|PCMS코드를 입력해주세요.";
    	}else if(!$this->datetimepicker1){
            echo "err|이용일 입력해주세요.";
        //}else if(!$this->password_field){
    	//	echo "err|Password를 입력해주세요.";
    	//}else if($this->password_field != 'pcms1015'){
    	//	echo "err|인증에러";
    	}else{
    		//pcms코드 사용여부
    		$sql="select * from items_ext where channel = '$this->chnpick' and pcmsitem_id = '$this->pcmsitem_id' and gu = '$this->coupon_id' and useyn = 'Y'";
    		if($query = $this->db->query($sql)){
    			if($query->num_rows() > 0){
    				echo "err|사용중인 PCMS코드입니다.";
    			}else{  //이제 입력한다.
    				$date_arr = split("/",$this->datetimepicker1);
    				$this->datetimepicker1_str = $date_arr[2]."-".$date_arr[0]."-".$date_arr[1];
    				$damnm = $this->session->userdata('nm');
    				$damcd = $this->session->userdata('cd');
    				$damip = $_SERVER["REMOTE_ADDR"];
    				$this->logtxt = date("Y-m-d H:i:s")."/".$damip.":".$damnm."(".$damcd.") INPUT";
    				$data = array(
    						'channel' => $this->chnpick,
    						'pcmsitem_id' => $this->pcmsitem_id,
                            'nm' => $this->pcmsitem_nm,
    						'usedate' => $this->datetimepicker1_str,
    						'gu' => $this->coupon_id,
    						'useyn' => 'Y',
    						'logtxt' => $this->logtxt,
							'chitem_id' => $this->chitem_id,
    						'admin_account' =>  $this->admin_cd,
    						'dam' =>  $damcd
    				);
    				if($this->db->insert('items_ext', $data)){
    					echo "ok|저장되었습니다.";
    				}else{
    					echo "err|시스템에러";
    				}	
    			}
    			
    		}else{
    			echo "err|시스템에러";
    		}
    	}
    }
    
    function cms_use(){
    	$this->id = $this->input->post('code');
    	$this->useyn = $this->input->post('useyn');
    	
    	$damnm = $this->session->userdata('nm');
    	$damcd = $this->session->userdata('cd');
    	$damip = $_SERVER["REMOTE_ADDR"];
    	 
    	$this->db->where('id', $this->id);
    	$resrow = $this->db->get('items_ext')->row();
    	 
    	$this->logtxt = $resrow->logtxt."\n".date("Y-m-d H:i:s")."/".$damip.":".$damnm."(".$damcd.")".$this->useyn." STATE";
    	
    	$data = array(
    			'useyn' => $this->useyn,
    			'logtxt' => $this->logtxt
    	);
    	
    	$this->db->where('id', $this->id);
    	if(!$this->db->update('items_ext', $data)){
    		echo "err";
    	}else{
    		echo "ok";
    	}
    }
    
    function items_ext_date(){
    	$this->id = $this->input->post('code');
    	$this->date = $this->input->post('date');
    	
    	$damnm = $this->session->userdata('nm');
    	$damcd = $this->session->userdata('cd');
    	$damip = $_SERVER["REMOTE_ADDR"];
    	
    	$this->db->where('id', $this->id);
    	$resrow = $this->db->get('items_ext')->row();
    	
    	$this->logtxt = $resrow->logtxt."\n".date("Y-m-d H:i:s")."/".$damip.":".$damnm."(".$damcd.")".$this->date." UPDATE";

    	$date_arr = explode("/",$this->date);
    	$usedate = $date_arr[2]."-".$date_arr[0]."-".$date_arr[1];
    	$data = array(
    			'usedate' => $usedate,
    			'logtxt' => $this->logtxt
    	);
    	 
    	$this->db->where('id', $this->id);
    	
    	if(!$this->db->update('items_ext', $data)){
    		echo "err";
    	}else{
    		echo "ok";
    	}
    }
    
    function workRequest(){
    	
    	$data['title'] = '이베이&11번가 연동 의뢰';
    	$data['contentview'] = '/cms/workRequest';
    	$data['leftview'] = 'left';
    	$data['topview'] = 'head';
    	$data['bottomview'] = 'bottom';
    	$this->load->view('/inc/layout',$data);
    }
    
    //업체
    function company()
    {
    	
    	//채널값을 굽자.
    	
    	$typearr = array(
    			"C"=> "판매채널",
    			"S"=> "대리점"
    	);
    	$data['typearr'] = $typearr;
    	//$sql="select * from CMS_COMPANY where com_state = 'Y' order by com_id desc";
    	$sql="select * from CMS_COMPANY where 1 order by com_id desc";
    	$data['query'] = $this->cms->query($sql);
    	$data['title'] = 'PCMS 업체 관리';
    	$data['contentview'] = '/cms/company';
    	$data['leftview'] = 'left';
    	$data['topview'] = 'head';
    	$data['bottomview'] = 'bottom';
    	$this->load->view('/inc/layout',$data);
    }
    
    //업체사용상태
    function company_use(){
    	$this->load->model('cmsmodel');
    	$this->id = $this->input->post('code');
    	$this->useyn = $this->input->post('use_state');
    	echo $this->cmsmodel->cms_use_company($this->id,$this->useyn);
    }
    
    //업체추가
    function company_add(){
    	$this->load->model('cmsmodel');
	 
    	$this->typepick = $this->input->post('typepick');
    	$this->companyname = $this->input->post('companyname');
    	
    	if($this->cmsmodel->chk_cms_company_nm($this->companyname)){
    		if($this->typepick == '0' || $this->typepick == '' || $this->typepick == null){
    			echo "err|업체 타입을 선택해주세요.";
    		}else if($this->companyname == '0' || $this->companyname == '' || $this->companyname == null){
    			echo "err|업체 이름을 입력해주세요.";
    		}else{
    			if($this->cmsmodel->cms_input_company($this->typepick,$this->companyname)){
    				echo "ok|저장되었습니다.";
    			}else{
    				echo "err|시스템에러";
    			}
    		}
    	}else{
    		echo "err|업체명이 잘못됐습니다.";
    	}
    }
    
    //시설 페이지
    function facilities($company_select = '')
    {
    	
    	$data['company_select'] = "";
    	$typearr = array(
    			"C"=> "판매채널",
    			"S"=> "대리점",
    			"F"=> "시설"
    	);
    	$data['typearr'] = $typearr;
    	
    	$csql="select com_id,com_nm from CMS_COMPANY where com_state = 'Y' order by com_nm";
    	
    	$data['cquery'] = $this->cms->query($csql);
 	
    	//$sql="select * from CMS_FACILITIES where fac_state = 'Y' order by fac_id desc";
    	$sql="select * from CMS_FACILITIES where 1 order by fac_id desc";
    	$sql="select * from CMS_FACILITIES
    	LEFT OUTER JOIN CMS_COMPANY on CMS_FACILITIES.fac_cpid = CMS_COMPANY.com_id
    	where 1 order by fac_id desc";
    	     	
    	$data['query'] = $this->cms->query($sql);
    	$data['title'] = 'PCMS 시설 관리';
    	$data['contentview'] = '/cms/facilities';
    	$data['leftview'] = 'left';
    	$data['topview'] = 'head';
    	$data['bottomview'] = 'bottom';
    	$this->load->view('/inc/layout',$data);
    }
    
    //시설 추가
    function facilities_add(){
    	
    	$this->load->model('cmsmodel');
    
    	$this->company_select = $this->input->post('company_select');
    	$this->facname = $this->input->post('facname');

    	 if($this->cmsmodel->chk_cms_facilities_nm($this->facname)){

    		if($this->company_select == '0' || $this->company_select == '' || $this->company_select == null){
    			echo "err|업체를 선택해주세요.";
    		}else if($this->cmsmodel->cms_input_facilities($this->company_select,$this->facname)){
    			echo "ok|저장되었습니다.";
    		}else{
    			echo "err|시스템에러";
    		}
    	}else{
    		echo "err|시설명이 잘못됐습니다.";
    	} 
    }
    
    //시설사용상태
    function facilities_use(){
    	$this->load->model('cmsmodel');
    	$this->id = $this->input->post('code');
    	$this->useyn = $this->input->post('use_state');
    	echo $this->cmsmodel->cms_use_facilities($this->id,$this->useyn);

    }
    
    //부트스트랩에서는 사용불가..
    function get_facilitieTable(){
    	//$this->company_select = $this->input->post('company_select');
    	$this->company_select = 1677;

    	$sql="select * from CMS_FACILITIES where fac_state = 'Y' AND fac_cpid = '".$this->company_select."' order by fac_id desc";
    	$query = $this->cms->query($sql);   	
    	$tableText = "";	 
    	 foreach ($query->result() as $row)
    	 {
    	 $tableText .= 
    	 "<tr class = 'table_<?=$row->fac_id?>'>
    	 <td><?=$row->fac_id?></td>
    	 <td><span class='fw-semi-bold'><?=$row->fac_nm?></span></td>
    	 <td>
    	 <div class='btn-group'>
    	 <button class='btn btn-default' id='use_<?=$row->fac_id?>' data-original-title='' title=''>";
    	 
    	 if($row->fac_state == 'Y'){
    	 	$tableText .=  '사용';
    	 }else if($row->fac_state == 'N'){
    	 	$tableText .=  '정지';
    	 }else{
    	 	$tableText .=  $row->fac_state;
    	 }
    	 $tableText .=
    	 "</button>
    	 <button class='btn btn-default dropdown-toggle' data-toggle='dropdown' data-original-title='' title=''>
    	 <i class='fa fa-caret-down'></i>
    	 </button>
    	 <ul class='dropdown-menu'>
    	 <li><a class='visiblecode y_btn' code='<?=$row->fac_id?>' state='Y' href='#'>사용</a></li>
    	 <li><a class='visiblecode n_btn' code='<?=$row->fac_id?>' state='N' href='#'>정지</a></li>
    	 </ul>	
    	 </div>
    	 </td>
    	 </tr>"; 
    	 }
	   	echo $tableText;
    	//echo $this->company_select;
    }
    
    
    
    //상품 페이지
    function items($facid = '0',$itemid = '0')
    {
    	$data['sitem'] = false;
    	if($facid == '0'){
	    	//$csql="select fac_id,fac_nm from CMS_FACILITIES where fac_state = 'Y' and fac_cpid != '0'order by fac_nm";
	    	//$csql="select fac_id,fac_nm from CMS_FACILITIES where  fac_cpid != '0' order by fac_nm";
	    	$csql="select fac_id,fac_nm from CMS_FACILITIES where 1 order by fac_nm";
	    	$data['cquery'] = $this->cms->query($csql);
	    	$data['mode'] = "new";
	    	
    	}else{
    		//$csql="select fac_id,fac_nm from CMS_FACILITIES where fac_state = 'Y' and fac_id = '$facid' order by fac_nm";
    		$csql="select fac_id,fac_nm from CMS_FACILITIES where fac_id = '$facid' order by fac_nm";
    		$data['cquery'] = $this->cms->query($csql);
    		$data['mode'] = "do";
    		if($itemid != '0'){
    			$itemselect = "SELECT * FROM `CMS_ITEMS` where item_id = '{$itemid}' limit 1";
    			$data['sitem'] = $this->cms->query($itemselect)->row();
    		}
    	}

    	$data['facid'] = $facid;
    	$data['title'] = 'PCMS 상품 관리';
    	$data['contentview'] = '/cms/items';
    	$data['leftview'] = 'left';
    	$data['topview'] = 'head';
    	$data['bottomview'] = 'bottom';
    	$this->load->view('/inc/layout',$data);
    }
    
    function item_load(){
    	$this->fac_id = $this->input->post('fac_id');
    	$sql=
    	"select * from CMS_ITEMS
		LEFT OUTER JOIN CMS_FACILITIES
		ON CMS_ITEMS.item_facid = CMS_FACILITIES.fac_id
		where item_state = 'Y' and CMS_ITEMS.item_facid = '{$this->fac_id}'
		order by item_id desc";
    	
    	$sql=
    	"select * from CMS_ITEMS
    	LEFT OUTER JOIN CMS_FACILITIES
    	ON CMS_ITEMS.item_facid = CMS_FACILITIES.fac_id
    	where item_state = 'Y' and CMS_ITEMS.item_facid = '{$this->fac_id}'
    	order by item_id desc";
    	 
    	$data['query'] = $this->cms->query($sql);
    	$this->load->view('/cms/item_load',$data);
    	
    }
    
    function item_add(){
    	$this->load->model('cmsmodel');
    	$this->fac_select = $this->input->post('fac_select');
    	$this->itemname = $this->input->post('itemname');
    	$this->item_sdate = $this->input->post('item_sdate');
    	$this->item_edate = $this->input->post('item_edate');
        $this->item_cd = $this->input->post('item_cd');

    	if($this->cmsmodel->cms_input_items_param_chk($this->fac_select,$this->itemname)){	
    		if($this->cmsmodel->cms_input_items($this->fac_select,$this->itemname,$this->item_sdate,$this->item_edate,$this->item_cd)){
    			echo "ok|저장되었습니다.";
    		}else{
    			echo "err|시스템에러";
    		}
    	}else{
    		echo "err|입력값이 올바르지 않습니다.";
    	}
    }
    
    function item_mode(){
    	$this->load->model('cmsmodel');
    	$this->item_select = $this->input->post('item_select');
    	$this->item_sdate = $this->input->post('item_sdate');
    	$this->item_edate = $this->input->post('item_edate');
        $this->new_itemname = $this->input->post('new_itemname');
        $this->item_cd = $this->input->post('item_cd');

        if($this->cmsmodel->cms_mode_items($this->item_select,$this->item_sdate,$this->item_edate,  $this->new_itemname,$this->item_cd)){
            $this->cmsmodel->pcms_mode_items($this->item_select ,$this->new_itemname);
            $this->cmsmodel->oldsparo_mode_items($this->item_select ,$this->new_itemname);
            $this->cmsmodel->newsparo_mode_items($this->item_select ,$this->new_itemname);
            $this->cmsmodel->cms_mode_coupon($this->item_select ,$this->new_itemname);

            echo "ok|저장되었습니다.";
        }else{
            echo "err|시스템에러";
        }

    }

    function newsparo_input_items($itemname='',$inItemId='',$item_cpid='',$item_facid=''){
        //http://pcms.placem.co.kr/index.php/cms/newsparo_input_items/After12/11350/0/484
        $this->load->model('cmsmodel');
        echo "$itemname $inItemId $item_cpid $item_facid";
        if($itemname!='' && $inItemId !='' && $item_cpid != '' && $item_facid !=''){
            if($this->cmsmodel->newsparo_input_items($itemname,$inItemId,$item_cpid,$item_facid)){
                echo "ok";
            }else{
                echo "err";
            }
        }else{
            echo " OBJ err";
        }

    }
    
    
    
    //시설사용상태
    function item_use(){
    	$this->load->model('cmsmodel');
    	$this->id = $this->input->post('code');
    	$this->useyn = $this->input->post('use_state');
    	echo $this->cmsmodel->cms_use_items($this->id,$this->useyn);
    }
        
    function price_add_excel(){
    	$this->load->model('cmsmodel');
    	$pcms_id=$this->input->post("pcms_id");
    	 
    	$this->load->library("PHPExcel");
    	$objPHPExcel = new PHPExcel();
    	//$objPHPExcel = PHPExcel_IOFactory::load('./uploads/xlsx.xlsx');
    	$file_name = $_FILES["userfile"]["tmp_name"];
    	
    	if(!$file_name){
    		redirect("/cms/price/".$pcms_id);
    	}
    	
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
    	/* $rowData가 한줄의 데이터를 셀별로 배열처리 됩니다. */
    		$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
    		//print_r($rowData);
    		if($rowData[0][0] != "" && $rowData[0][0] != null && is_numeric($rowData[0][0])){
    			//echo $rowData[0][0]."\t".$rowData[0][1]."\t".$rowData[0][2]."\t".$rowData[0][3]."\t".$rowData[0][4]."\t".$rowData[0][5]."\t".$rowData[0][6]."<br/>";
    			$date = PHPExcel_Style_NumberFormat::toFormattedString($rowData[0][1], PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);
    			 
	    		$this->cmsmodel->cms_input_price(
	    				$rowData[0][0],
	    				$date,
	    				$rowData[0][2],
	    				$rowData[0][3],
	    				$rowData[0][5],
	    				$rowData[0][4],
	    				$rowData[0][6]);
    		}
    	}
    	redirect("/cms/price/".$pcms_id);
    }
    
    function price($item_id='0')
    {
    	/*
    	 $isql="select * from CMS_ITEMS
    		LEFT OUTER JOIN CMS_FACILITIES
    		ON CMS_ITEMS.item_facid = CMS_FACILITIES.fac_id
    		where item_state = 'Y'
    		AND (item_edate > now() or item_edate = '0000-00-00 00:00:00')";
    		$data['iquery'] = $this->cms->query($isql);
    		*/
    	//$sql="select * from CMS_ITEMS where item_state = 'Y' order by item_id desc";
    	$this->load->model('cmsmodel');
    	$data['item_id'] = $item_id;
    	$data['items'] = $this->cmsmodel->get_CMS_ITEMS($item_id);
    	$sql=
    	"select * from CMS_PRICES
    	LEFT OUTER JOIN CMS_ITEMS
    	ON CMS_PRICES.price_itemid = CMS_ITEMS.item_id
    	LEFT OUTER JOIN CMS_FACILITIES
    	ON CMS_ITEMS.item_facid = CMS_FACILITIES.fac_id
    	where price_date >= '".date("Y-m-d",strtotime ("-6 months"))."' and CMS_PRICES.price_itemid = {$item_id}
    	AND price_state = 'Y'";
    	 
    	$data['query'] = $this->cms->query($sql);
    	 
    	$data['title'] = '상품 가격 등록/관리';
    	$data['contentview'] = '/cms/price';
    	$data['leftview'] = 'left';
    	$data['topview'] = 'head';
    	$data['bottomview'] = 'bottom';
    	$this->load->view('/inc/layout',$data);
    }
    
    function price_load(){
    	$this->item_id = $this->input->post('item_id');
    	$sql=
    	"select * from CMS_PRICES
		LEFT OUTER JOIN CMS_ITEMS
		ON CMS_PRICES.price_itemid = CMS_ITEMS.item_id
		LEFT OUTER JOIN CMS_FACILITIES
		ON CMS_ITEMS.item_facid = CMS_FACILITIES.fac_id
		where price_date >= NOW() and CMS_PRICES.price_itemid = {$this->item_id}
    			AND price_state = 'Y'";
    	 
    	$data['query'] = $this->cms->query($sql);
    	$this->load->view('/cms/price_load',$data);
    	 
    }
    
    function price_add(){
    	$this->load->model('cmsmodel');  
    	
    	if($this->cmsmodel->cms_input_price(
		    	$this->input->post('item_select'),
		    	$this->input->post('price_date'),
		    	$this->input->post('normalPrice'),
		    	$this->input->post('salePrice'),
		    	$this->input->post('inPrice'),
		    	$this->input->post('outPrice'),
		    	$this->input->post('qty'))){
    		echo "ok|저장되었습니다.";
   		}else{
    		echo "err|시스템에러";
    	}
    }
    

    //수수료관리 페이지
    function commission($item_id='0')
    {
    	$csql="select com_id,com_nm from CMS_COMPANY where `com_type` LIKE 'C' and com_state = 'Y' order by com_nm";
    	$data['cquery'] = $this->cms->query($csql);
    	
    	$this->load->model('cmsmodel');
    	$data['item_id'] = $item_id;
    	$data['items'] = $this->cmsmodel->get_CMS_ITEMS($item_id);
    	   	
    	$sql="SELECT * FROM CMSDB.CMS_RATE 
    	LEFT OUTER JOIN CMSDB.CMS_ITEMS
    	ON CMS_RATE.rate_itemid = CMS_ITEMS.item_id
    	LEFT OUTER JOIN CMS_FACILITIES
		ON CMS_ITEMS.item_facid = CMS_FACILITIES.fac_id
    	WHERE rate_itemid = {$item_id}";
    	
    	$data['query'] = $this->cms->query($sql);
    
    	$data['title'] = '상품 채널별 수수료 등록/관리';
    	$data['contentview'] = '/cms/commission';
    	$data['leftview'] = 'left';
    	$data['topview'] = 'head';
    	$data['bottomview'] = 'bottom';
    	$this->load->view('/inc/layout',$data);
    }
    
    //수수료관리 페이지
    function commission_add()
    {
        $this->load->model('cmsmodel');

        $A_ids = $this->input->post('A_ids');
        $chn_IDs = explode(";", $A_ids);

        $result = true;
        foreach ($chn_IDs as $chn_ID) {
            if($chn_ID != 0 && $chn_ID != null && $chn_ID != "")
            if ($this->cmsmodel->cms_input_commission(
                $this->input->post('itemid'),
                $chn_ID,
                $this->input->post('rate'))
            ) {

            } else {
                $result = false;
            }
        }
        if($result){
            echo "ok|저장되었습니다.";
        }else{
            echo "err|시스템에러";
        }
    }
    
    //수수료관리 페이지
    function commission_del()
    {
    	$this->load->model('cmsmodel');
    	 
    	if($this->cmsmodel->cms_del_commission(
    			$this->input->post('rate_itemid'),
    			$this->input->post('rate_cpid'))){
    		echo "ok|삭제되었습니다.";
    	}else{
    		echo "err|시스템에러";
    	}
    }
/*     
    //가격등록 페이지
    function price_old($item_id='0')
    {
    	$this->load->model('cmsmodel');
    	$data['item_id'] = $item_id;
    	$data['items'] = $this->cmsmodel->get_CMS_ITEMS($item_id);
    	$sql=
    	"select * from CMS_PRICES
    	LEFT OUTER JOIN CMS_ITEMS
    	ON CMS_PRICES.price_itemid = CMS_ITEMS.item_id
    	LEFT OUTER JOIN CMS_FACILITIES
    	ON CMS_ITEMS.item_facid = CMS_FACILITIES.fac_id
    	where price_date >= '".date("Y-m-d")."' and CMS_PRICES.price_itemid = {$item_id}
    	AND price_state = 'Y'";
    	 
    	$data['query'] = $this->cms->query($sql);
    	 
    	$data['title'] = '상품 가격 등록/관리';
    	$data['contentview'] = '/cms/price';
    	$data['leftview'] = 'left';
    	$data['topview'] = 'head';
    	$data['bottomview'] = 'bottom';
    	$this->load->view('/inc/layout',$data);
    } */
	
    
} //CI_Controller


?>