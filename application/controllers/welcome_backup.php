<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

    /**
     * 문자 발송 함수
     * $this->load->model('smsmodel');
     * $this->smsmodel->smsmsg("01090188284","PCMS2.0 LOGIN 인증번호 [12345]");
		
	 $this->load->model('usermodel');
	 $this->usermodel->get_pcms_account_cdpw($cd,$pw);
     */

    function __construct() {
        parent::__construct();
		$this->load->model('usermodel');
    }
    //개발 완료 후 전환
    public function index()
    {
	$this->load->view('/sys/login');
    }

    //로그인 페이지 개발
    function login()
    {
	$this->load->view('/welcome/login');
    }

	//로그아웃(세션초기화)
    public function logout(){
        $this->session->sess_destroy();
        redirect('/welcome/login');
    }

    //로그인 시도 : 관리자 권한 확인 및 휴대폰 인증번호 발송
    function try_login()
    {
        $cd =  $this->input->post('username');
        $pass =  $this->input->post('userpasswd');
		$result = $this->usermodel->get_pcms_account_cdpw($cd, $pass);

		$gu = $result->gu;
		$hp = $result->hp;

	
		if($gu == 'AD' || $gu == 'CS'){
			echo $gu;
		}else{
			if($hp == '' || $hp == null){
				echo "nonHp";
			}else if($hp != '' || $hp != null){

                $loginday = date("Y-m-d",strtotime($result->login));
                $today = date("Y-m-d");
                $logip = $result->logip;
                $ip = $_SERVER["REMOTE_ADDR"];

                if($loginday == $today && $logip == $ip){
                    echo "AUTH";
                }else{
                    $randNum = rand(10000,99999);
                    $this->load->model('smsmodel');
                    $this->smsmodel->smsmsg($hp,"PCMS2.0 LOGIN 인증번호 [{$randNum}]");
                    echo "nonAD|{$randNum}";
                }



			}
		}
    }

	//로그인
    function login_ok()
    {
        $cd =  $this->input->post('username');
        $pass =  $this->input->post('userpasswd');
		$pass = hash("SHA256", $pass);

		$query = $this->db->query("select * from pcms_account where cd = '$cd' and pass='$pass' and visible = '1' limit 1");
		
        $row = $query->row();
        //로그인 성공
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
            //세션 등록
            $this->session->set_userdata($data);

            // 최종 접속시간, 총 접속회수 업데이트
            $admin_data = array(
                'login'     => date("Y-m-d H:i:s",time()),
                'lastlogin' => date("Y-m-d H:i:s",time()),
                'logincnt'  => $logincnt,
                'logip'     => $_SERVER['REMOTE_ADDR']
            );
            $this->db->where('id', $row->id);
            $this->db->update('pcms_account',$admin_data);

            redirect('/order/orderN_dev/new', 'refresh'); //로그인 성공 첫 페이지
        }
        else
        {
            echo "<script>alert('login error..');</script>";
            redirect('/welcome/login', 'refresh');
        }
    }



}

?>
