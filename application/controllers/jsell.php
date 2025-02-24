<?php 

class jsell extends CI_Controller { 

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

    function crowling($mode = ''){

        $chn = array(
            '150'=>"쿠팡",
            '154'=>"티켓몬스터",
            '142'=>"위메프",
            '128'=>"11번가",
            '141'=>"옥션",
            '129'=>"G마켓(G9)",
            '352'=>"인터파크"
        );
        $data['chn'] = $chn;
        $sync_type_str = array(
            'I'=>"등록옵션보기",
            'U'=>"정보수정"
        );
        $data['sync_type_str'] = $sync_type_str;

        $useyn_str = array(
            'Y'=>"사용",
            'N'=>"정지"
        );
        $data['useyn_str'] = $useyn_str;



        $sql = "SELECT * FROM spadb.crowling_set WHERE useyn = 'Y' or selledate >= CURDATE() order by id desc ";
        $data['query'] = $this->sparo2->query($sql);

        $data['title'] = '판매 연동 설정';
        $data['contentview'] = '/sell/crowling';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }

    function crowling_add(){

        $this->load->model('nsparomodel');
        $this->load->model('cmsmodel');
        $input_data = array();

        $checkChn = trim($this->input->post('checkChn'));
        $COMPANY_row = $this->cmsmodel->get_CMS_COMPANY($checkChn);
        $input_data['ch_id'] = $COMPANY_row->com_id;
        $input_data['ch_nm'] = $COMPANY_row->com_nm;
        $input_data['ch_cd'] = trim($this->input->post('ch_cd'));
        $input_data['ch_pass'] = trim($this->input->post('ch_pass'));
        $input_data['sellcode'] = trim($this->input->post('sellcode'));
        $input_data['selltitle'] = trim($this->input->post('selltitle'));
        $input_data['sellurl'] = trim($this->input->post('sellurl'));
        $input_data['sellsdate'] = trim($this->input->post('sellsdate'));
        $input_data['selledate'] = trim($this->input->post('selledate'));
        $input_data['sync_type'] = trim($this->input->post('sync_type'));
        $itemclass = $this->input->post('itemclass');
        $input_data['usedate'] = trim($this->input->post('usedate'));
        $input_data['sync_state'] = trim($this->input->post('sync_state'));
        $item_option = $this->input->post('item_option');
        $input_data['item_option'] = $this->option_text($item_option); //특수문자 정리

        //코드사용체크

        $usecount = $this->nsparomodel->itemcode_useCount($input_data['sellcode']);

        if($usecount > 0){
            echo "err|상품코드 :".$input_data['sellcode']." 사용중입니다.";
        }else{
            //옵션만들기
            if($itemclass == "1"){
                $sellopt="A";
                $item_option_arr = explode(":",$item_option);
                $input_data['item_option'] = $item_option_arr[1];
            }else{
                $sellopt="AB";
            }

            if($input_data['usedate'] == "" || $input_data['usedate'] == null){
                $sellopt .= "D";
            }
            $input_data['sellopt'] = $sellopt;

            $input_data['dam'] = $this->session->userdata('nm');
            $input_data['logtxt'] = date("Y-m-d H:i:s").":".$this->session->userdata('nm')."(".$this->session->userdata('cd').")";
            $input_data['regdate'] = date("Y-m-d H:i:s");

            //한번에 등록
            if($this->nsparomodel->crowling_set_add($input_data)){
                $resulttxt = "{$input_data['sellcode']} 등록 성공";
                echo "ok|".$resulttxt;

                $this->load->model('sparomodel');
                $this->sparomodel->old_sellinfo_stop($input_data['sellcode']);

            }else{
                $resulttxt = "{$input_data['sellcode']} 등록 실패";
                echo "err|".$resulttxt;
            }
        }
    }

    //연동사용
    function crowling_use(){
        $this->load->model('nsparomodel');
        echo $this->nsparomodel->crowling_useyn($this->input->post('code'),$this->input->post('use_state'));
    }

   
    
	
	function info($mode = ''){
		
		$typearr = array(
            '387'=>"지마켓,지구",
            '2984'=>"네이버",
            '391'=>"옥션",
            '390'=>"11번가"
        );
            /* 128로 교체해야함.
             * '390'=>"11번가" PCMS코드
            '1395'=>"티켓몬스터",
            '2061'=>"쿠팡",
            '2135'=>"위메프"*/
    	$data['typearr'] = $typearr;
		
    	$coupangview = false;
		$where = " where useyn='Y'";
		if($mode == "all"){
			$where = " where 1=1";
		}else if($mode == "Y"){
			$where = " where useyn='Y'";
		}else if($mode == "N"){
			$where = " where useyn='N'";
		}else if($mode == "CP"){
			$coupangview = true;
		}
		
		$data['coupangview'] = $coupangview;
		
		$sql = "select * from ebay_pcmsmts $where order by id desc ";
		$data['query'] = $this->sparo->query($sql);
		//$sql = "select * from items_mall $where order by id desc ";
		//$data['query'] = $this->db->query($sql);

		$data['title'] = '판매연동';
		$data['contentview'] = '/sell/info';
		$data['leftview'] = 'left';
		$data['topview'] = 'head';
		$data['bottomview'] = 'bottom';
		$this->load->view('/inc/layout',$data);
	}
	
	function info_add(){
		
		$this->load->model('sparomodel');
		$this->load->model('pcmsmodel');
        $this->load->model('cmsmodel');
        $this->load->model('nsparomodel');
		$sellname = trim($this->input->post('sellname'));
				
		$G_sellcode1 = trim($this->input->post('G_sellcode1'));
		$G_sellurl1 = trim($this->input->post('G_sellurl1'));
		$G_sellcode2 = trim($this->input->post('G_sellcode2'));
		$G_sellurl2 = trim($this->input->post('G_sellurl2'));
		$A_sellcode = trim($this->input->post('A_sellcode'));
		$A_sellurl = trim($this->input->post('A_sellurl'));
		$S_sellcode = trim($this->input->post('S_sellcode'));
		$S_sellurl = trim($this->input->post('S_sellurl'));

		$N_sellcode = trim($this->input->post('N_sellcode'));
		$N_sellurl = trim($this->input->post('N_sellurl'));
        $I_sellcode = trim($this->input->post('I_sellcode'));
        $I_sellurl = trim($this->input->post('I_sellurl'));

		$C_sellcode = trim($this->input->post('C_sellcode'));
		$C_sellurl = trim($this->input->post('C_sellurl'));
		
		
		$itemclass = $this->input->post('itemclass');
		$datetimepicker1 = trim($this->input->post('datetimepicker1'));
		$sell_state = trim($this->input->post('sell_state'));
		$item_option = $this->input->post('item_option');	
		$item_option = $this->option_text($item_option); //특수문자 정리
		
		//코드사용체크
		//$usecount = $this->sparomodel->itemcode_useCount($sellcode);
		//echo "err|".$usecount;
		
		$sellcodechk = true;
		$sellcode_arr = array();
		$sellcode_i = 0;
		
		if($G_sellcode1 != '' && $G_sellcode1 != null && $sellcodechk){
			$usecount = $this->sparomodel->itemcode_useCount($G_sellcode1);
			if($usecount > 0){
				$sellcodechk = false;
				echo "err|상품코드 :".$G_sellcode1." 사용중입니다.";
			}else{
				$sellcode_arr[$sellcode_i++] = array("chid"=> "387", "ch_nm"=> "지마켓", "sellcode"=> $G_sellcode1 , "sellurl"=> $G_sellurl1 );
			}
		}
		if($G_sellcode2 != '' && $G_sellcode2 != null  && $sellcodechk){
			$usecount = $this->sparomodel->itemcode_useCount($G_sellcode2);
			if($usecount > 0){
				$sellcodechk = false;
				echo "err|상품코드 :".$G_sellcode2." 사용중입니다.";
			}else{
				$sellcode_arr[$sellcode_i++] = array("chid"=> "387" , "ch_nm"=> "지마켓", "sellcode"=> $G_sellcode2 , "sellurl"=> $G_sellurl2 );
			}
		}
		if($A_sellcode != '' && $A_sellcode != null  && $sellcodechk){
			$usecount = $this->sparomodel->itemcode_useCount($A_sellcode);
			if($usecount > 0){
				$sellcodechk = false;
				echo "err|상품코드 :".$A_sellcode." 사용중입니다.";
			}else{
				$sellcode_arr[$sellcode_i++] = array("chid"=> "391" , "ch_nm"=> "옥션", "sellcode"=> $A_sellcode , "sellurl"=> $A_sellurl );
			}
		}
		if($S_sellcode != '' && $S_sellcode != null && $sellcodechk){
			$usecount = $this->sparomodel->itemcode_useCount($S_sellcode);
			if($usecount > 0){
				$sellcodechk = false;
				echo "err|상품코드 :".$S_sellcode." 사용중입니다.";
			}else{
				$sellcode_arr[$sellcode_i++] = array("chid"=> "390" , "ch_nm"=> "11번가", "sellcode"=> $S_sellcode, "sellurl"=> $S_sellurl );
			}
		}

		if($N_sellcode != '' && $N_sellcode != null && $sellcodechk){
			$usecount = $this->sparomodel->itemcode_useCount($N_sellcode);
			if($usecount > 0){
				$sellcodechk = false;
				echo "err|상품코드 :".$N_sellcode." 사용중입니다.";
			}else{
				$sellcode_arr[$sellcode_i++] = array("chid"=> "2984" , "ch_nm"=> "네이버", "sellcode"=> $N_sellcode, "sellurl"=> $N_sellurl );
			}
		}

        if($I_sellcode != '' && $I_sellcode != null && $sellcodechk){
            $usecount = $this->sparomodel->itemcode_useCount($I_sellcode);
            if($usecount > 0){
                $sellcodechk = false;
                echo "err|상품코드 :".$N_sellcode." 사용중입니다.";
            }else{
                $sellcode_arr[$sellcode_i++] = array("chid"=> "352" , "ch_nm"=> "인터파크", "sellcode"=> $I_sellcode, "sellurl"=> $I_sellurl );
            }
        }

		if($C_sellcode != '' && $C_sellcode != null && $sellcodechk){
			$usecount = $this->sparomodel->itemcode_useCount($C_sellcode);
			if($usecount > 0){
				$sellcodechk = false;
				echo "err|상품코드 :".$C_sellcode." 사용중입니다.";
			}else{
				$sellcode_arr[$sellcode_i++] = array("chid"=> "2061" , "ch_nm"=> "쿠팡", "sellcode"=> $C_sellcode , "sellurl"=> $C_sellurl );
			}
		}
		
		if($sellcodechk){
			//옵션만들기
			$sellopt="";
			if($itemclass == "1"){
				$sellopt="A";
				$item_option_arr = explode(":",$item_option);
				$item_option = $item_option_arr[1];
			}else{
				$sellopt="AB";
			}
			if($datetimepicker1 != "" && $datetimepicker1 != null){
				$date_arr = explode("/",$datetimepicker1);
				$datetimepicker1 = $date_arr[2]."-".$date_arr[0]."-".$date_arr[1];
			}else{
				$sellopt .= "D";
			}
			
			$damnm = $this->session->userdata('nm');
			$damcd = $this->session->userdata('cd');
			$mall_log = date("Y-m-d H:i:s").":".$damnm."(".$damcd.")";

			//한번에 등록
			$resulttxt = "";
			 foreach($sellcode_arr as $sellary){
				$chid = $sellary['chid'];
				$ch_nm = $sellary['ch_nm'];
				$sellcode = $sellary['sellcode'];
				$sellurl = $sellary['sellurl'];
				$sellcharge = $sellary['sellcharge'];

				if($chid == '390'){
                    $chid_11st = '128';
                    $input_data = array();
                    $COMPANY_row = $this->cmsmodel->get_CMS_COMPANY($chid_11st);
                    $input_data['ch_id'] = $COMPANY_row->com_id;
                    $input_data['ch_nm'] = $COMPANY_row->com_nm;
                    $input_data['sellcode'] = trim($sellcode);
                    $input_data['selltitle'] = trim($sellname);
                    $input_data['sellurl'] = trim($sellurl);
                    $input_data['sellsdate'] = trim($this->input->post('sellsdate'));
                    $input_data['selledate'] = trim($this->input->post('selledate'));
                    $input_data['sync_type'] = "I";
                    $input_data['usedate'] = $datetimepicker1;
                    if($sell_state == "확정")$sell_state = "예약완료";
                    $input_data['sync_state'] = $sell_state;
                    $input_data['item_option'] = $this->option_text($item_option); //특수문자 정리
                    $input_data['sellopt'] = $sellopt;

                    $input_data['dam'] = $this->session->userdata('nm');
                    $input_data['logtxt'] = date("Y-m-d H:i:s").":".$this->session->userdata('nm')."(".$this->session->userdata('cd').")";
                    $input_data['regdate'] = date("Y-m-d H:i:s");

                    if($this->nsparomodel->crowling_set_add($input_data)){
                        $resulttxt .= "\n {$input_data['sellcode']} (신규서버) 등록 성공";
                    }else{
                        $resulttxt .= "\n {$input_data['sellcode']} (신규서버) 등록 실패";
                    }
                }else if($this->pcmsmodel->items_mall_add($sellcode,$sellopt,$sellname,$item_option,$chid,$ch_nm,$datetimepicker1,$sell_state,$sellurl,$mall_log)){
                    $resulttxt .= "\n $sellcode 등록 성공";
                }else{
                    $resulttxt .= "\n $sellcode 등록 실패";
                }
			}

			echo "ok|".$resulttxt; 
			
		}
			
	}

    function info_add_dev(){

        $this->load->model('nsparomodel');
        $this->load->model('cmsmodel');
        $this->load->model('sparomodel');
        $this->load->model('pcmsmodel');
        $sellname = trim($this->input->post('sellname'));

        $G_sellcode1 = trim($this->input->post('G_sellcode1'));
        $G_sellurl1 = trim($this->input->post('G_sellurl1'));
        $G_sellcode2 = trim($this->input->post('G_sellcode2'));
        $G_sellurl2 = trim($this->input->post('G_sellurl2'));
        $A_sellcode = trim($this->input->post('A_sellcode'));
        $A_sellurl = trim($this->input->post('A_sellurl'));
        $S_sellcode = trim($this->input->post('S_sellcode'));
        $S_sellurl = trim($this->input->post('S_sellurl'));

        $N_sellcode = trim($this->input->post('N_sellcode'));
        $N_sellurl = trim($this->input->post('N_sellurl'));
        $I_sellcode = trim($this->input->post('I_sellcode'));
        $I_sellurl = trim($this->input->post('I_sellurl'));

        $itemclass = $this->input->post('itemclass');
        $datetimepicker1 = trim($this->input->post('datetimepicker1'));
        $sell_state = trim($this->input->post('sell_state'));
        $item_option = $this->input->post('item_option');
        $item_option = $this->option_text($item_option); //특수문자 정리

        $sellcodechk = true;
        $sellcode_arr = array();
        $sellcode_i = 0;

        if($G_sellcode1 != '' && $G_sellcode1 != null && $sellcodechk){
            $usecount = $this->nsparomodel->itemcode_useCount($G_sellcode1);
            if($usecount > 0){
                $sellcodechk = false;
                echo "err|상품코드 :".$G_sellcode1." 사용중입니다.";
            }else{
                $sellcode_arr[$sellcode_i++] = array("chid"=> "387", "ch_nm"=> "지마켓", "sellcode"=> $G_sellcode1 , "sellurl"=> $G_sellurl1 );
            }
        }
        if($G_sellcode2 != '' && $G_sellcode2 != null  && $sellcodechk){
            $usecount = $this->nsparomodel->itemcode_useCount($G_sellcode2);
            if($usecount > 0){
                $sellcodechk = false;
                echo "err|상품코드 :".$G_sellcode2." 사용중입니다.";
            }else{
                $sellcode_arr[$sellcode_i++] = array("chid"=> "387" , "ch_nm"=> "지마켓", "sellcode"=> $G_sellcode2 , "sellurl"=> $G_sellurl2 );
            }
        }
        if($A_sellcode != '' && $A_sellcode != null  && $sellcodechk){
            $usecount = $this->nsparomodel->itemcode_useCount($A_sellcode);
            if($usecount > 0){
                $sellcodechk = false;
                echo "err|상품코드 :".$A_sellcode." 사용중입니다.";
            }else{
                $sellcode_arr[$sellcode_i++] = array("chid"=> "391" , "ch_nm"=> "옥션", "sellcode"=> $A_sellcode , "sellurl"=> $A_sellurl );
            }
        }
        if($S_sellcode != '' && $S_sellcode != null && $sellcodechk){
            $usecount = $this->nsparomodel->itemcode_useCount($S_sellcode);
            if($usecount > 0){
                $sellcodechk = false;
                echo "err|상품코드 :".$S_sellcode." 사용중입니다.";
            }else{
                $sellcode_arr[$sellcode_i++] = array("chid"=> "390" , "ch_nm"=> "11번가", "sellcode"=> $S_sellcode, "sellurl"=> $S_sellurl );
            }
        }

        if($N_sellcode != '' && $N_sellcode != null && $sellcodechk){
            $usecount = $this->nsparomodel->itemcode_useCount($N_sellcode);
            if($usecount > 0){
                $sellcodechk = false;
                echo "err|상품코드 :".$N_sellcode." 사용중입니다.";
            }else{
                $sellcode_arr[$sellcode_i++] = array("chid"=> "2984" , "ch_nm"=> "네이버", "sellcode"=> $N_sellcode, "sellurl"=> $N_sellurl );
            }
        }

        if($I_sellcode != '' && $I_sellcode != null && $sellcodechk){
            $usecount = $this->nsparomodel->itemcode_useCount($I_sellcode);
            if($usecount > 0){
                $sellcodechk = false;
                echo "err|상품코드 :".$N_sellcode." 사용중입니다.";
            }else{
                $sellcode_arr[$sellcode_i++] = array("chid"=> "352" , "ch_nm"=> "인터파크", "sellcode"=> $I_sellcode, "sellurl"=> $I_sellurl );
            }
        }

        if($sellcodechk){
            //옵션만들기
            if($itemclass == "1"){
                $sellopt="A";
                $item_option_arr = explode(":",$item_option);
                $item_option = $item_option_arr[1];
            }else{
                $sellopt="AB";
            }
            if($datetimepicker1 != "" && $datetimepicker1 != null){
                $date_arr = explode("/",$datetimepicker1);
                $datetimepicker1 = $date_arr[2]."-".$date_arr[0]."-".$date_arr[1];
            }else{
                $sellopt .= "D";
            }


            $damnm = $this->session->userdata('nm');
            $damcd = $this->session->userdata('cd');
            $mall_log = date("Y-m-d H:i:s").":".$damnm."(".$damcd.")";

            //한번에 등록
            $resulttxt = "";
            foreach($sellcode_arr as $sellary){

                $input_data = array();
                $COMPANY_row = $this->cmsmodel->get_CMS_COMPANY($sellary['chid']);
                $input_data['ch_id'] = $COMPANY_row->com_id;
                $input_data['ch_nm'] = $COMPANY_row->com_nm;

                $input_data['sellcode'] = trim($sellary['sellcode']);
                $input_data['selltitle'] = trim($sellname);
                $input_data['sellurl'] = trim($sellary['sellurl']);
                //$input_data['sellsdate'] = trim($this->input->post('sellsdate'));
                //$input_data['selledate'] = trim($this->input->post('selledate'));
                $input_data['sync_type'] = "I";
                $input_data['usedate'] = $datetimepicker1;
                $input_data['sync_state'] = $sell_state;
                $input_data['item_option'] = $this->option_text($item_option); //특수문자 정리
                $input_data['sellopt'] = $sellopt;

                $input_data['dam'] = $this->session->userdata('nm');
                $input_data['logtxt'] = date("Y-m-d H:i:s").":".$this->session->userdata('nm')."(".$this->session->userdata('cd').")";
                $input_data['regdate'] = date("Y-m-d H:i:s");

                //한번에 등록
                if($this->nsparomodel->crowling_set_add($input_data)){
                    $resulttxt = "{$input_data['sellcode']} 등록 성공";
                    echo "ok|".$resulttxt;
                }else{
                    $resulttxt = "{$input_data['sellcode']} 등록 실패";
                    echo "err|".$resulttxt;
                }


            }

            echo "ok|".$resulttxt;

        }

    }

	
	function addItemcode(){
		$itemclass = $this->input->post('itemclass');
		$data['itemclass'] = $itemclass;
		$this->load->view('/sell/addItem',$data);
	}
	
	//연동사용
	function info_use(){
		$this->load->model('sparomodel');	
		echo $this->sparomodel->sellinfo_useyn($this->input->post('code'),$this->input->post('use_state'));
		//$this->load->model('pcmsmodel');
		//echo $this->pcmsmodel->sellinfo_useyn($this->input->post('code'),$this->input->post('use_state'));
	}
	
	//특수문자제거
	function option_text($text = ''){
		$text = str_replace("+", "_",$text);
		$text = str_replace(" ", "",$text);
		//$text = str_replace(":", "",$text);
		$text = str_replace("/", "",$text);
		$text = str_replace("~", "",$text);
		$text = str_replace("(", "",$text);
		$text = str_replace(")", "",$text);
		$text = str_replace(">", "",$text);	
		return $text;
	}
	
	
	function addSellcode(){
		$codeclass = $this->input->post('codeclass');
		$text = "
		<div class='sellcode$codeclass' >
		<label class='col-sm-2 control-label' for='max-length'></label>
		<div class='col-sm-4' style='margin-top:5px'>
		<div class='input-group'>
		<div class='input-group-btn'>
		<select id='' class='selectpicker ch_id'
		data-style='btn-primary'
		data-width='auto'>
		<option value=''>판매 채널 선택</option>
		<option value='387'>지마켓,지구</option>
		<option value='391'>옥션</option>
		<option value='390'>11번가</option>
		<option value='1395'>티켓몬스터</option>
		<option value='2061'>쿠팡</option>
		<option value='2135'>위메프</option>
		</select>
		</div>
		<input type='text' name='sellcode'
		class='form-control sellcode'
		placeholder='상품코드 입력'
		data-placement='top'
		>
		</div>
		</div>
		<div class='col-sm-5' style='margin-top:5px'>
		<div class='input-group'>
		<input type='text' name='sellname'
		class='form-control sellurl'
		placeholder='판매페이지 주소입력'
		data-placement='top'
		>
		<div class='input-group-btn'>
		<button type='button' class='btn btn-success addSellcode'><i class='fa fa-plus'></i></button>
		</div>
		</div>
		</div>
		</div>";
		echo $text;
	}

	function fac_link($fac = ''){
        $data['faccode'] = array(
            "OM" => "원마운트",
            "ST" => "쏠티",
            "WPC" => "웅진플레이시티"	);

        $data['chncode'] = array(
            "T" => "티켓몬스터",
            "C" => "쿠팡",
            "W" => "위메프",
            "B" => "B2B해외",
            "P"=> "오픈마켓"	);

        $data['factype'] = array(
            "S" => "스노우파크(원마운트)",
            "W" => "워터파크(원마운트)",
            "A" => "대인(쏠티)",
            "C" => "소인(쏠티)"
        );
        $data['state'] = array(
            "Y" => "사용",
            "N" => "미사용"
        );

        if($fac == 'all' || $fac == ''){
            $sql="select * from pcmsdb.item_fac where state = 'Y' and edate >= CURDATE() order by id desc";
        }else{
            $sql="select * from pcmsdb.item_fac where faccode in ('$fac') and state = 'Y' and edate >= CURDATE() order by id desc";
        }

        $data['query'] = $this->db->query($sql);

        $data['title'] = '판매시설 연동';
        $data['contentview'] = '/sell/fac_link';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }
    
    function hanwha($chn = '')
    {
    	$data['chncode'] = array(
    	
    			"P"=> "오픈마켓"	);
    	
    	$data['state'] = array(
    			"Y" => "사용",
    			"N" => "정지"
    	);
    	
    	if($chn == 'all' || $chn == ''){
    		$sql="select * from pcmsdb.item_fac where faccode = 'HAN' and state = 'Y' order by id desc";
    	}else{
    		$sql="select * from pcmsdb.item_fac where chncode in ('$chn') and faccode = 'HAN' and state = 'Y' order by id desc";
    	}
    	$data['query'] = $this->db->query($sql);
    	
    	$data['title'] = '한화 코드 연동';
    	$data['contentview'] = '/sell/hanwha';
    	$data['leftview'] = 'left';
    	$data['topview'] = 'head';
    	$data['bottomview'] = 'bottom';
    	$this->load->view('/inc/layout',$data);
    }


    function playcity($chn = ''){

        $data['chncode'] = array(

            "P"=> "오픈마켓"	);
        /*
         *  "T" => "티켓몬스터",
            "C" => "쿠팡",
            "W" => "위메프",
            "B" => "B2B해외",
         */

        $data['state'] = array(
            "Y" => "사용",
            "N" => "정지"
        );

        if($chn == 'all' || $chn == ''){
            $sql="select * from pcmsdb.item_fac where faccode = 'WPC' and state = 'Y' order by id desc";
        }else{
            $sql="select * from pcmsdb.item_fac where chncode in ('$chn') and faccode = 'WPC' and state = 'Y' order by id desc";
        }
        $data['query'] = $this->db->query($sql);

        $data['title'] = '웅진플레이시티 코드 연동';
        $data['contentview'] = '/sell/playcity';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }
    
    function hanwha_add(){
    	$chncode = $this->input->post('chncode');
    	$itemcode = $this->input->post('itemcode');
    	$gdcode = $this->input->post('gdcode');
    	$price = $this->input->post('price');
    	$pcmsitem_id = $this->input->post('pcmsitem_id');
    	$pcmsitem_nm = $this->input->post('pcmsitem_nm');
    	$startDate = date("Ymd",strtotime ($this->input->post('startDate')));
    	$endDate = date("Ymd",strtotime ($this->input->post('endDate')));
    
    	$damnm = $this->session->userdata('nm');
    	$damcd = $this->session->userdata('cd');
    	$damip = $_SERVER["REMOTE_ADDR"];
    	$logtxt = date("Y-m-d H:i:s")."/".$damip.":".$damnm."(".$damcd.")";
    
    	//기존 상품 코드 비활성(중복방지)
    	$data1 = array(
    			'state' => "N",
    			'logtxt' => $this->logtxt." STATE=N"
    	);
    	$this->db->where('pcms_id', $this->pcmsitem_id);
    	$this->db->where('chncode', $this->chncode);
    	$this->db->update('item_fac', $data1);
    
    	//신규코드 등록
    	$data = array(
    			'faccode' => "HAN",
    			'chncode' => $chncode,
    			'nm' => $pcmsitem_nm,
    			'itemcode' => $itemcode,
    			'gdcode' => $gdcode,
    			'pcms_id' => $pcmsitem_id,
    			'price' => $price,
    			'state' => "Y",
    			'sdate' => $startDate,
    			'edate' => $endDate,
    			'logtxt' => $logtxt." INSERT"
    	);
    	if(!$this->db->insert('item_fac', $data)){
    		echo "err";
    	}else{
    		echo "ok";
    	}
    }
    

    function playcity_add(){
        $chncode = $this->input->post('chncode');
        $itemcode = $this->input->post('itemcode');
        $gdcode = $this->input->post('gdcode');
        $price = $this->input->post('price');
        $pcmsitem_id = $this->input->post('pcmsitem_id');
        $pcmsitem_nm = $this->input->post('pcmsitem_nm');
        $startDate = date("Ymd",strtotime ($this->input->post('startDate')));
        $endDate = date("Ymd",strtotime ($this->input->post('endDate')));

        $damnm = $this->session->userdata('nm');
        $damcd = $this->session->userdata('cd');
        $damip = $_SERVER["REMOTE_ADDR"];
        $logtxt = date("Y-m-d H:i:s")."/".$damip.":".$damnm."(".$damcd.")";

        //기존 상품 코드 비활성(중복방지)
        $data1 = array(
            'state' => "N",
            'logtxt' => $this->logtxt." STATE=N"
        );
        $this->db->where('pcms_id', $this->pcmsitem_id);
        $this->db->where('chncode', $this->chncode);
        $this->db->update('item_fac', $data1);

        //신규코드 등록
        $data = array(
            'faccode' => "WPC",
            'chncode' => $chncode,
            'nm' => $pcmsitem_nm,
            'itemcode' => $itemcode,
            'gdcode' => $gdcode,
            'pcms_id' => $pcmsitem_id,
            'price' => $price,
            'state' => "Y",
            'sdate' => $startDate,
            'edate' => $endDate,
            'logtxt' => $logtxt." INSERT"
        );
        if(!$this->db->insert('item_fac', $data)){
            echo "err";
        }else{
            echo "ok";
        }
    }
    

    function dukgu($chn = ''){

        $data['chncode'] = array(

            "P"=> "오픈마켓"	);
        /*
         *  "T" => "티켓몬스터",
            "C" => "쿠팡",
            "W" => "위메프",
            "B" => "B2B해외",
         */

        $data['state'] = array(
            "Y" => "사용",
            "N" => "정지"
        );

        $data['factype'] = array(
            "A" => "대인",
            "C" => "소인"
        );
        if($chn == 'all' || $chn == ''){
            $sql="select * from pcmsdb.item_fac where faccode = 'ST' and state = 'Y' order by id desc";
        }else{
            $sql="select * from pcmsdb.item_fac where chncode in ('$chn') and faccode = 'ST' and state = 'Y' order by id desc";
        }
        $data['query'] = $this->db->query($sql);

        $data['title'] = '덕구온천리조트(쏠티) 코드 연동';
        $data['contentview'] = '/sell/dukgu';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }

    function dukgu_add(){
        $chncode = $this->input->post('chncode');
        $itemcode = $this->input->post('itemcode');
        $factype = $this->input->post('factype');
        $price = $this->input->post('price');
        $pcmsitem_id = $this->input->post('pcmsitem_id');
        $pcmsitem_nm = $this->input->post('pcmsitem_nm');
        $startDate = date("Ymd",strtotime ($this->input->post('startDate')));
        $endDate = date("Ymd",strtotime ($this->input->post('endDate')));

        $damnm = $this->session->userdata('nm');
        $damcd = $this->session->userdata('cd');
        $damip = $_SERVER["REMOTE_ADDR"];
        $logtxt = date("Y-m-d H:i:s")."/".$damip.":".$damnm."(".$damcd.")";

        //기존 상품 코드 비활성(중복방지)
        $data1 = array(
            'state' => "N",
            'logtxt' => $this->logtxt." STATE=N"
        );
        $this->db->where('pcms_id', $this->pcmsitem_id);
        $this->db->where('chncode', $this->chncode);
        $this->db->update('item_fac', $data1);

        //신규코드 등록
        $data = array(
            'faccode' => "ST",
            'chncode' => $chncode,
            'nm' => $pcmsitem_nm,
            'itemcode' => $itemcode,
            'factype' => $factype,
            'pcms_id' => $pcmsitem_id,
            'price' => $price,
            'state' => "Y",
            'sdate' => $startDate,
            'edate' => $endDate,
            'logtxt' => $logtxt." INSERT"
        );
        if(!$this->db->insert('item_fac', $data)){
            echo "err";
        }else{
            echo "ok";
        }
    }

	
	function onemount($chn = ''){
		
		$data['chncode'] = array(
				"T" => "티켓몬스터",
				"C" => "쿠팡",
				"W" => "위메프",
                "B" => "B2B해외",
				"P"=> "오픈마켓"	);
		
		$data['factype'] = array(
				"S" => "스노우파크",
				"W" => "워터파크"
			);
		$data['state'] = array(
				"Y" => "사용",
				"N" => "미사용"
		);
		if($chn == 'all'){
			$sql="select * from pcmsdb.item_fac where faccode = 'OM' and state = 'Y' order by id desc";
		}else{
			$sql="select * from pcmsdb.item_fac where chncode in ('$chn') and faccode = 'OM' and state = 'Y' order by id desc";
		}
		$data['query'] = $this->db->query($sql);
		
		$data['title'] = '원마운트 코드 연동';
		$data['contentview'] = '/sell/onemount';
		$data['leftview'] = 'left';
		$data['topview'] = 'head';
		$data['bottomview'] = 'bottom';
		$this->load->view('/inc/layout',$data);
	}
	
	function onemount_add(){
		$this->chncode = $this->input->post('chncode');
		$this->factype = $this->input->post('factype');
		$this->itemcode = $this->input->post('itemcode');
		$this->pcmsitem_id = $this->input->post('pcmsitem_id');
		$this->pcmsitem_nm = $this->input->post('pcmsitem_nm');
		$this->startDate = date("Ymd",strtotime ($this->input->post('startDate')));
		$this->endDate = date("Ymd",strtotime ($this->input->post('endDate')));
		//echo $this->chncode."/".$this->factype."/".$this->itemcode."/".$this->pcmsitem_id."/".$this->pcmsitem_nm."/".$this->startDate ."/".$this->endDate;
		$damnm = $this->session->userdata('nm');
		$damcd = $this->session->userdata('cd');
		$damip = $_SERVER["REMOTE_ADDR"];
		$this->logtxt = date("Y-m-d H:i:s")."/".$damip.":".$damnm."(".$damcd.")";
		
		//기존 상품 코드 비활성(중복방지)
		$data1 = array(
				'state' => "N",
				'logtxt' => $this->logtxt." STATE=N"
		);
		$this->db->where('pcms_id', $this->pcmsitem_id);
		$this->db->where('chncode', $this->chncode);
		$this->db->update('item_fac', $data1);
		
		//신규코드 등록
		$data = array(
				'faccode' => "OM",
				'chncode' => $this->chncode,
				'nm' => $this->pcmsitem_nm,
				'itemtype' => "01",
				'factype' => $this->factype,
				'itemcode' => $this->itemcode,
				'pcms_id' => $this->pcmsitem_id,
				'state' => "Y",
				'sdate' => $this->startDate,
				'edate' => $this->endDate,
				'logtxt' => $this->logtxt." INSERT"
		);
		if(!$this->db->insert('item_fac', $data)){
			echo "err";
		}else{
			echo "ok";
		}
	}
	
	function onemount_date(){
		$this->id = $this->input->post('code');
		$this->date = $this->input->post('date');
		$this->mode = $this->input->post('mode');
		 
		$damnm = $this->session->userdata('nm');
		$damcd = $this->session->userdata('cd');
		$damip = $_SERVER["REMOTE_ADDR"];
		 
		$this->db->where('id', $this->id);
		$resrow = $this->db->get('item_fac')->row();
		 
		$this->logtxt = $resrow->logtxt."\n".date("Y-m-d H:i:s")."/".$damip.":".$damnm."(".$damcd.")".$this->date." ".$this->mode." UPDATE";
		
		$usedate = date("Ymd",strtotime ($this->date));

		$data = array(
				$this->mode => $usedate,
				'logtxt' => $this->logtxt
		);
		$this->db->where('id', $this->id);
		 
		if(!$this->db->update('item_fac', $data)){
			echo "err";
		}else{
			echo "ok";
		}
		
	}
	function onemount_use(){
		$this->id = $this->input->post('code');
		$this->useyn = $this->input->post('useyn');
		 
		$damnm = $this->session->userdata('nm');
		$damcd = $this->session->userdata('cd');
		$damip = $_SERVER["REMOTE_ADDR"];
	
		$this->db->where('id', $this->id);
		$resrow = $this->db->get('item_fac')->row();
	
		$this->logtxt = $resrow->logtxt."\n".date("Y-m-d H:i:s")."/".$damip.":".$damnm."(".$damcd.")".$this->useyn." STATE";
		 
		$data = array(
				'state' => $this->useyn,
				'logtxt' => $this->logtxt
		);
		 
		$this->db->where('id', $this->id);
		if(!$this->db->update('item_fac', $data)){
			echo "err";
		}else{
			echo "ok";
		}
	}
    

	
} 


?>