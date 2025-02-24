<?php 

class Sys extends CI_Controller { 

	function __construct() {
		parent::__construct();
		/* if (!(($this->uri->segment(3) == 'login') || ($this->uri->segment(3) == 'login_ok')))
			$this->is_logged_in(); */
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
	
	public function logout(){
	
		$this->session->sess_destroy();
		//$this->login();
		redirect('/sys/login');
	}

	function login()
    {
    	$this->load->view('/sys/login');
    }

    function login_ok()
    {
        $cd =  $this->input->post('username');
        $pass =  $this->input->post('userpasswd');
        $pass = hash("SHA256",$pass);
        $query = $this->db->query("select * from pcms_account where cd = '$cd' and pass=('$pass') and visible = '1' limit 1");  // old_password
        $row = $query->row();

        if($row){
            $logincnt = $row->logincnt+1;

            $row->id;
            
            $data = array(
                'id'           => $row->id,
                'cd'           => $this->input->post('username'),
                'nm'           => $row->nm,
            	'jikwi'        => $row->jikwi,
                'gu'           => $row->gu,
                'login'        => date("Y-m-d H:i:s",time()),
                'lastlogin'    => $row->lastlogin,
                'created'      => $row->created,
                'updated'      => $row->updated,
                'rolegu'       => $row->rolegu,
                'company'      => $row->company,
                'role'         => $row->gu,
                'logincnt'     => $logincnt,
                'is_logged_in' => true,
            );
            $this->session->set_userdata($data);

            // 최종 접속시간, 총 접속회수
            $admin_data = array(
                'login'     => date("Y-m-d H:i:s",time()),
                'lastlogin' => date("Y-m-d H:i:s",time()),
                'logincnt'  => $logincnt,
                'logip'     => $_SERVER['REMOTE_ADDR']
            );
            $this->db->where('id', $row->id);
            $this->db->update('pcms_account',$admin_data);

            $d_rolegu  = $this->session->userdata('role'); //관리자등급
            
            redirect('/order/orderN_dev/new', 'refresh');
        }
        else
        {
        	echo "<script>alert('login error..');</script>";
            redirect('/sys/login', 'refresh');
        } 
    }
    
    function cj_pcms() {
    	$this->pcmsitem_id = $this->input->post('pcmsitem_id');
    	$this->datetimepicker1 = $this->input->post('datetimepicker1');
    	$this->password_field = $this->input->post('password_field');
    	
    	if(!$this->pcmsitem_id){
    		echo "err|PCMS코드를 입력해주세요.";
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
    
    function get_itemname(){
    	$this->pcms = $this->load->database('pcms', TRUE);
    	
    	$this->pcmsitem_id = $this->input->post('pcmsitem_id');
    	if($this->pcmsitem_id == ''){
    		echo "PCMS 상품번호를 입력하세요.";
    	}else if($this->pcmsitem_id != 0 && $this->pcmsitem_id != null){
    		$sql = "select * from itemmts where id = '".$this->pcmsitem_id."' limit 1";
    		$query = $this->pcms->query($sql);
    		$total = $query -> num_rows();
    		if($total < 1){
    			echo "조회할수 없는 번호입니다.";
    		}else{
    			$row = $query->row(); // row넘김
    			echo $row->nm;
    		}	
    	}else{
    		echo "조회할수 없는 번호입니다.";
    	}
    	
    }
    
    function get_itemname2(){
    	$this->cms = $this->load->database('cms', TRUE);
    	$this->itemname = $this->input->post('itemname');
    
    	if($this->itemname == ''){
    		echo "";
    	}else if($this->itemname != "" && $this->itemname != null){
    		$sql = "select * from CMS_ITEMS where item_nm = '".$this->itemname."' and item_state = 'Y' limit 1";
    		$query = $this->cms->query($sql);
    		$total = $query -> num_rows();
    		if($total < 1){
    			echo "사용할수 있습니다.";
    		}else{
    			echo "이미 사용중 입니다.";
    		}
    	}else{
    		echo "";
    	}
    }
    
    function get_itemcode(){

    	$this->pcmsitem_id = $this->input->post('pcmsitem_id');
    	$this->chnpick = $this->input->post('chnpick');
    	$chgu=substr($this->chnpick,0,1);
    	if($this->pcmsitem_id == ''){
    		echo "ERROR";
    	}else if( $this->chnpick != "TMON" && $this->chnpick != "WEMP" && $this->chnpick != "CPNG" && $this->chnpick != "FNR" && $this->chnpick != "LEQ"){
    		echo "ERROR";
    	}else if($this->pcmsitem_id != 0 && $this->pcmsitem_id != null){
    		if($this->chnpick == "FNR"){ $chgu = "PF";}
    		if($this->chnpick == "LEQ"){ $chgu = "P";}
    		//$sql = "SELECT ccode FROM `cms_coupon` WHERE ccode like '".$chgu."%' AND items_id = '".$this->pcmsitem_id."' order by id desc limit 1";
    		#지류권만 코드 보이게 수정
    		//$sql = "SELECT ccode FROM `cms_coupon` WHERE (ctype = 'PM' or ctype = 'EV') and ccode like '".$chgu."%' AND items_id = '".$this->pcmsitem_id."' order by id desc limit 1";
    		//지류권 코드 제외
    		$sql = "SELECT ccode FROM `cms_coupon` WHERE (ctype = 'EV') and ccode like '".$chgu."%' AND items_id = '".$this->pcmsitem_id."' order by id desc limit 1";
    		$query = $this->db->query($sql);
    		$total = $query -> num_rows();
    		if($total < 1){
    			echo "ERROR";
    		}else{
    			$row = $query->row(); // row넘김
    			echo $row->ccode;
    		}
    	}else{
    		echo "ERROR";
    	}
    	 
    }

    function get_kit_mms_text(){

        $pcmsitem_id = $this->input->post('pcmsitem_id');
        if($pcmsitem_id == '' || $pcmsitem_id == null){
            echo "ERROR";
        }else{

            $sql = "SELECT * FROM pcmsdb.kit_lms WHERE pcms_id = '{$pcmsitem_id}' order by id desc limit 1";
            $query = $this->db->query($sql);
            $total = $query -> num_rows();
            if($total < 1){
                echo "ERROR";
            }else{
                $row = $query->row(); // row넘김
                echo $row->mms_text;
            }
        }
    }

    function get_last_price(){
        $pcmsitem_id = $this->input->post('pcmsitem_id');
        if($pcmsitem_id == '' || $pcmsitem_id == null){
            echo "ERROR";
        }else{
            $sql = "SELECT * FROM CMSDB.CMS_PRICES WHERE price_itemid = '{$pcmsitem_id}' order by price_id desc limit 1";
            $query = $this->db->query($sql);
            $total = $query -> num_rows();
            if($total < 1){
                echo "ERROR";
            }else{
                $row = $query->row(); // row넘김
                echo date("m/d/Y",strtotime($row->price_date));
            }
        }
    }
    
    function get_companyname(){
    	$this->cms = $this->load->database('cms', TRUE);
    	$this->companyname = $this->input->post('companyname');
    	
    	if($this->companyname == ''){
    		echo "";
    	}else if($this->companyname != "" && $this->companyname != null){
    		$sql = "select * from CMS_COMPANY where com_nm = '".$this->companyname."'  and com_state = 'Y' limit 1";
    		$query = $this->cms->query($sql);
    		$total = $query -> num_rows();
    		if($total < 1){
    			echo "사용할수 있습니다.";
    		}else{
    			echo "이미 사용중 입니다.";
    		}
    	}else{
    		echo "";
    	}
    	
    	
    }
    
    function get_facilitiesname(){
    	$this->cms = $this->load->database('cms', TRUE);
    	$this->facname = $this->input->post('facname');
    	 
    	if($this->facname == ''){
    		echo "";
    	}else if($this->facname != "" && $this->facname != null){
    		$sql = "select * from CMS_FACILITIES where fac_nm = '".$this->facname."'  and fac_state = 'Y' limit 1";
    		$query = $this->cms->query($sql);
    		$total = $query -> num_rows();
    		if($total < 1){
    			echo "사용할수 있습니다.";
    		}else{
    			echo "이미 사용중 입니다.";
    		}
    	}else{
    		echo "";
    	}
    }
    
    
	
} 


?>