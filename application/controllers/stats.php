<?php 

class Stats extends CI_Controller {

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

   
    
	
	function use_order(){

        $inforesult = array();

        $smonth = date("Y-m",strtotime ("-2 months"));
        $emonth = date("Y-m");
        $nowDate = date("Y-m-d");

        while ($smonth <= $emonth ){

            $q_edate = date("Y-m-d",strtotime('last day of '.$emonth, time()));	//추출 종료일
            $q_firstdate = $emonth."-01";
            $q_sdate = $emonth."-26";

            while($q_firstdate <= $q_sdate){

                if($nowDate < $q_sdate){
                    $q_sdate = date("Y-m-d", strtotime("-5 days", strtotime($q_sdate)));
                    $q_edate = date("Y-m-d", strtotime("+4 days", strtotime($q_sdate)));
                    continue;
                }
                //echo "{$q_sdate} ~ {$q_edate}<br/>";

                $sql = "SELECT * FROM pcmsdb.stats_use_order where sdate = '{$q_sdate}' and type = 'nsparo' and ch_id not in (128,129,141) ";
                $sql = "SELECT * FROM pcmsdb.stats_use_order where sdate = '{$q_sdate}' and type = 'nsparo' ";
                $query = $this->db->query($sql);
                $qcnt = $query->num_rows();
                if ($qcnt > 0) {
                    $inforesult[$q_sdate."~".$q_edate] = $query;
                }

                $q_sdate = date("Y-m-d", strtotime("-5 days", strtotime($q_sdate)));
                $q_edate = date("Y-m-d", strtotime("+4 days", strtotime($q_sdate)));

            }//day while

            $emonth = date("Y-m",strtotime ("-1 months",  strtotime($emonth)));

        }//month while

        $data['inforesult'] = $inforesult;
		$data['title'] = '사용처리 확인 페이지';
		$data['contentview'] = '/stats/use_order';
		$data['leftview'] = 'left';
		$data['topview'] = 'head';
		$data['bottomview'] = 'bottom';
		$this->load->view('/inc/layout',$data);

	}

	function use_order_chk(){
        $id = $this->input->post('code');
        $gu = $this->input->post('gu');

        if($gu == 1){
            $gu = 0;
            $addClass = 'btn-danger';

        }else{
            $gu = 1;
            $addClass = 'btn-success';

        }

        $damnm = $this->session->userdata('nm');
        $damcd = $this->session->userdata('cd');
        $cip = $_SERVER['REMOTE_ADDR'];
        $clog = "{$damnm}({$damcd})"; //$clog = "{$damnm}({$damcd}) {$cip}/".date("Y-m-d H:i:s");

        $sql = "update pcmsdb.stats_use_order set confirm = {$gu}, c_log = '{$clog}',c_date=NOW() where id = {$id} limit 1";
        if($this->db->query($sql)){
            echo  $addClass;
        }else{
            echo "err";
        }

    }
	

    

	
} 


?>