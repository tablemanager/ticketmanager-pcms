<?php 

class Pcms extends CI_Controller { 

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

	function items()
    {
    	$chnarr = array(
    			"SKP" => "시럽",
    			"HML"=> "현대몰",
    			"AKM"=> "AK몰",
    			"STN"=> "세일투나잇",
    			"APAY"=> "에이페이",
    			"TSD"=> "티켓수다",
    			"LTM"=> "롯데닷컴",
    			"CUZ"=> "쿠즐"
    	);
    	$data['chnarr'] = $chnarr;
    	
    	
    	//$this->db = $this->load->database('default', TRUE);
    	$sql="select * from items_ext where useyn = 'Y' order by id desc";
    	$data['query'] = $this->db->query($sql);
    	$data['dam_div'] = 'Placem';
    	$data['dam_name'] = '현민우';
    	$data['title'] = 'cms PCMS 연동 관리자';
    	$data['contentview'] = '/cms/items';
    	$data['leftview'] = 'left';
    	$data['topview'] = 'head';
    	$data['bottomview'] = 'bottom';
    	$this->load->view('/inc/layout',$data);
    }
    
    function cms_pcms() {
    	$this->chnpick = $this->input->post('chnpick');
    	$this->pcmsitem_id = $this->input->post('pcmsitem_id');
    	$this->datetimepicker1 = $this->input->post('datetimepicker1');
    	$this->password_field = $this->input->post('password_field');
        $this->pcmsitem_nm = $this->input->post('pcmsitem_nm');
    	
        //echo "err|".$this->chnpick;
    	if(!$this->chnpick){
    		echo "err|채널을 선택해주세요.";
    	}else if(!$this->pcmsitem_id){
    		echo "err|PCMS코드를 입력해주세요.";
    	}else if(!$this->pcmsitem_nm){
    		echo "err|상품명을 입력해주세요.";
    	}else if(!$this->datetimepicker1){
            echo "err|이용일 입력해주세요.";
        }else if(!$this->password_field){
    		echo "err|Password를 입력해주세요.";
    	}else if($this->password_field != 'pcms1015'){
    		echo "err|인증에러";
    	}else{
    		//pcms코드 사용여부
    		$sql="select * from items_ext where channel = '$this->chnpick' and pcmsitem_id = '$this->pcmsitem_id' and useyn = 'Y'";
    		if($query = $this->db->query($sql)){
    			if($query->num_rows() > 0){
    				echo "err|사용중인 PCMS코드입니다.";
    			}else{  //이제 입력한다.
    				$date_arr = split("/",$this->datetimepicker1);
    				$this->datetimepicker1_str = $date_arr[2]."-".$date_arr[0]."-".$date_arr[1];
    				$data = array(
    						'channel' => $this->chnpick,
    						'pcmsitem_id' => $this->pcmsitem_id,
                            'nm' => $this->pcmsitem_nm,
    						'usedate' => $this->datetimepicker1_str,
    						'useyn' => 'Y'
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
    	
    	$data = array(
    			'useyn' => $this->useyn
    	);
    	
    	$this->db->where('id', $this->id);
    	if(!$this->db->update('items_ext', $data)){
    		echo "err";
    	}else{
    		echo "ok";
    	}
    }

	
} 


?>