<?php

/**
 * Created by Editplus
 * User: Cindy
 * Date: 2017-12-01
 * Time: 오후 1:00
 */

class User extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!(($this->uri->segment(3) == 'login') || ($this->uri->segment(3) == 'login_ok')))
            $this->is_logged_in();
        $this->load->model('usermodel');
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

    function account(){

        $query = $this->usermodel->get_pcms_account_all();

        $data['query'] = $query;
        $data['title'] = '회원 관리';
        $data['contentview'] = 'user/account';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }

	function insert(){
		
		$data['title'] = '회원 등록';
        $data['contentview'] = 'user/insert';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
	}

	function insert_ok(){
		$nm = $this->input->post('nm');
		$cd = $this->input->post('cd');
		$pass = $this->input->post('pass');
		$pass = hash("SHA256", $pass);
		$rolegu = $this->input->post('rolegu');
		$company = $this->input->post('company');
		$buseo = $this->input->post('buseo');
		$teamnm = $this->input->post('teamnm');
		$jikwi = $this->input->post('jikwi');
		$hp = $this->input->post('hp');

		if($nm!=''&&$nm!=null && $cd!=''&&$cd!=null && $pass!=''&&$pass!=null &&
			$rolegu!=''&&$rolegu!=null && $company!=''&&$company!=null && $buseo!=''&&$buseo!=null &&
			$teamnm!=''&&$teamnm!=null && $jikwi!=''&&$jikwi!=null && $hp!=''&&$hp!=null){

			$data = array(
				'nm' => $nm,
				'cd' => $cd,
				'pass' => $pass,
				'rolegu' => $rolegu,
				'company' => $company,
				'buseo' => $buseo,
				'teamnm' => $teamnm,
				'jikwi' => $jikwi,
				'hp' => $hp,
				'visible' => '1'
			);

			if($this->usermodel->insert_pcms_account($data)){
				$this->account();
			}else{
				echo "fail";
			}
		}else{
			echo "<script> alert('parameter fail'); </script>";
			//redirect('/user/insert');
		}

	}


	function update($id){
		
		if($id != '' && $id != null){
			$data['views'] =$this->usermodel->get_pcms_account($id);
		}
		
		$data['title'] = '회원 수정';
        $data['contentview'] = 'user/update';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
	}

	function update_ok($id){
		$id = $this->input->post('id');
		$nm = $this->input->post('nm');
		$cd = $this->input->post('cd');
		$pass = $this->input->post('pass');
		//$pass = hash("SHA256", $pass);
		$rolegu = $this->input->post('rolegu');
		$company = $this->input->post('company');
		$buseo = $this->input->post('buseo');
		$teamnm = $this->input->post('teamnm');
		$jikwi = $this->input->post('jikwi');
		$hp = $this->input->post('hp');

		$data = array(
			'nm' => $nm,
			'cd' => $cd,
			'rolegu' => $rolegu,
			'company' => $company,
			'buseo' => $buseo,
			'teamnm' => $teamnm,
			'jikwi' => $jikwi,
			'hp' => $hp,
			'visible' => '1'
		);

		if($pass != '' && $pass != null){
			$data['pass'] = hash("SHA256", $pass);
		} 

		if($this->usermodel->update_pcms_account($id, $data)){
			echo "<script> alert('수정성공');</script>";
			$this->account();
		}else{
			echo "<script> alert('실패'); </script>";
		}
	}

	 function get_userid(){

		$checkid = $this->input->post('checkid');

		if($checkid == ''){
			echo "아이디를 입력하세요.";
		}else if($checkid != '' && $checkid != null){
			$sql = "select id from pcmsdb.pcms_account where cd = '".$checkid."' limit 1";
			$query = $this->db->query($sql);
			$result = $query -> num_rows;
			if($result > 0){
				echo "이미 사용중인 아이디입니다.";
			}else{
				echo  "사용가능한 아이디입니다.";
			}
		}else{
			echo "사용할 수 없는 아이디입니다.";
		}
		
	}

	function stop(){
		$stopid = $this->input->post('stopid');

		$data = array(
			'visible' => '0'
		);

		$this->db->where('id', $stopid);
		$this->db->limit(1);


		if($this->db->update('pcms_account', $data)){
            echo "true";
		}else{
			echo "false";
		}
	}
}