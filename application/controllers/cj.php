<?php 

class Cj extends CI_Controller { 

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

	function cj_list()
    {
    	//$this->db = $this->load->database('default', TRUE);
    	$sql="select * from items_cj where useyn = 'Y' order by id desc";
    	$data['query'] = $this->db->query($sql);
    	$data['dam_div'] = 'Placem';
    	$data['dam_name'] = '현민우';
    	$data['title'] = 'CJ PCMS 연동 관리자';
    	$data['contentview'] = '/cj/cj_list';
    	$data['leftview'] = 'left';
    	$data['topview'] = 'head';
    	$data['bottomview'] = 'bottom';
    	$this->load->view('/inc/layout',$data);
    }
    
    function cj_pcms() {
    	$this->pcmsitem_id = $this->input->post('pcmsitem_id');
    	$this->datetimepicker1 = $this->input->post('datetimepicker1');
    	$this->password_field = $this->input->post('password_field');
        $this->pcmsitem_nm = $this->input->post('pcmsitem_nm');
    	
    	if(!$this->pcmsitem_id){
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
    		$sql="select * from items_cj where pcmsitem_id = '$this->pcmsitem_id' and useyn = 'Y'";
    		if($query = $this->db->query($sql)){
    			if($query->num_rows() > 0){
    				echo "err|사용중인 PCMS코드입니다.";
    			}else{  //이제 입력한다.
    				$date_arr = split("/",$this->datetimepicker1);
    				$this->datetimepicker1_str = $date_arr[2]."-".$date_arr[0]."-".$date_arr[1];
    				$data = array(
    						'pcmsitem_id' => $this->pcmsitem_id,
                            'nm' => $this->pcmsitem_nm,
    						'usedate' => $this->datetimepicker1_str,
    						'useyn' => 'Y'
    				);
    				if($this->db->insert('items_cj', $data)){
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
    
    function cj_use(){
    	$this->id = $this->input->post('code');
    	$this->useyn = $this->input->post('useyn');
    	
    	$data = array(
    			'useyn' => $this->useyn
    	);
    	
    	$this->db->where('id', $this->id);
    	if(!$this->db->update('items_cj', $data)){
    		echo "err";
    	}else{
    		echo "ok";
    	}
    }

	
} 


?>