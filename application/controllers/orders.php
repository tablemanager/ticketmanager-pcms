<?php 

class Orders extends CI_Controller { 

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

   
    
	
	function search($mode = ''){

			$viewtable = false;
			$searchtxt = trim($this->input->post('searchtxt'));
			//검색이면 검색
		if($mode != "new"){
			if($searchtxt != "" && $searchtxt != null){
				$viewtable = true;
				$tablename = "msg_result_".date("Ym");
				$sql = "SELECT * FROM $tablename where dstaddr like '%$searchtxt'";
				$query = $this->sparoBGF->query($sql);
				//$total = $query -> num_rows();
				$data['query'] = $query;
			}
		}else{
			$searchtxt = "";
		}
		$data['title'] = '주문조회(베타)';
		$data['viewtable']=$viewtable;
		$data['searchtxt']=$searchtxt;
		$data['contentview'] = '/orders/search';
		$data['leftview'] = 'left';
		$data['topview'] = 'head';
		$data['bottomview'] = 'bottom';
		$this->load->view('/inc/layout',$data);
	}
    

	
} 


?>