<?php 
class Usermodel extends CI_Model {

	var $title   = '';
	var $content = '';
	var $date    = '';
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
        //데이터베이스는 default로 사용 ($this->db->...)
	}

	//계정정보 select
	function get_pcms_account($id){
		if($id == ''){
			$sql = "select * from pcmsdb.pcms_account where 1 limit 1";
		}else{
			$sql = "select * from pcmsdb.pcms_account where id='".$id."'";
		}

		$query = $this->db->query($sql);

		$total = $query -> num_rows();
		if($total > 0){
			return $query->row();
		}else{
			return false;
		}
	}

	//계정정보 select,  로그인 시도
	function get_pcms_account_cdpw($cd, $pass){
		$pass = hash("SHA256", $pass);

		$sql = "select * from pcmsdb.pcms_account where cd = '".$cd."' and pass = '".$pass."' and visible = 1 limit 1";

//		echo $sql;

		$query = $this->db->query($sql);

		$result = $query->row();

//		print_r($result);
		return $result;
	}



	//계정정보 all
	function get_pcms_account_all(){
		$sql = "select * from pcmsdb.pcms_account where visible=1";
		$query = $this->db->query($sql);
		$total = $query -> num_rows();
		if($total > 0){
			return $query;
		}else{
			return false;
		}
	}

	function view_pcms_account($id){
		$sql = "select * from pcmsdb.pcms_account where id='".$id."'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}

    //계정정보 insert
	function insert_pcms_account($data){

		if($this->db->insert('pcms_account', $data)){
			return true;
			//print_r ($data);
		}else{
			return false;
		}
	}

    //계정정보 update
	function update_pcms_account($id, $data){
        
		$this->db->where('id', $id);
		$this->db->limit(1);

		if($this->db->update('pcms_account', $data)){
            return true;
		}else{
            return false;
		}
	}
}
?>