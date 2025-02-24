<?php 

class Lotte extends CI_Controller { 

function __construct() {
		parent::__construct();
		if (!(($this->uri->segment(3) == 'login') || ($this->uri->segment(3) == 'login_ok')))
			$this->is_logged_in();
        $this->cms2 = $this->load->database('cms2', TRUE);
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

    function make_query($data)
    {
        $where = "1";

        $eventcd = $data['eventcd'];
        $sellcode = $data['sellcode'];
        $eventnm = $data['eventnm'];
        $eventdesc = $data['eventdesc'];
        $selectdate = $data['selectdate'];
        $startdate = $data['startdate'];
        $startdate = date("Ymd", strtotime($startdate));
        $enddate = $data['enddate'];
        $enddate = date("Ymd", strtotime($enddate));
//        $regdate = $data['regdate'];

        if ($eventcd != '' && $eventcd != NULL) {
            $where .= " AND eventcd = '$eventcd'";
        }

        if ($sellcode != '' && $sellcode != NULL) {
            $where .= " AND sellcode = '$sellcode'";
        }

        if ($eventnm != '' && $eventnm != NULL) {
            $where .= " AND eventnm like '%$eventnm%'";
        }

        if ($eventdesc != '' && $eventdesc != NULL) {
            $where .= " AND eventdesc like '%$eventdesc%'";
        }

        if ($selectdate != '' && $selectdate != NULL && $startdate != '' && $startdate != NULL) {
            $where .= " AND {$selectdate} >= '$startdate' ";
        }

        if ($selectdate != '' && $selectdate != NULL && $enddate != '' && $enddate != NULL) {
            $where .= " AND {$selectdate} <= '$enddate' ";
        }

        return $where;

    }

    function make_offset($offset = 0)
    {
        $data['offset'] = $offset;
        $this->session->set_userdata($data);
        $this->eventlist();
    }

    function ajax_eventlist()
    {
        $data['eventcd'] = trim($this->input->post('eventcd'));

        $sql = "SELECT * FROM apidb.lotte_event WHERE eventcd = '{$data['eventcd']}'";
        $query = $this->cms2->query($sql);

        $total = $query -> num_rows();
        if($total < 1){

        }else {
            $row = $query->row(); // row넘김
            $_year_stt = substr($row->sdate , 0 , 4);
            $_month_stt = substr($row->sdate , 4 , 2);
            $_day_stt = substr($row->sdate , 6 , 2);
            $_stt = $_month_stt."/".$_day_stt."/".$_year_stt;
            $_result['stt_date'] = $_stt;

            $_year_end = substr($row->edate , 0 , 4);
            $_month_end = substr($row->edate , 4 , 2);
            $_day_end = substr($row->edate , 6 , 2);
            $_end = $_month_end."/".$_day_end."/".$_year_end;

            $_result['end_date'] = $_end;
            $_result['eventnm'] = $row->eventnm;
            $_result['qty'] = $row->qty;

            echo json_encode($_result);
        }


    }


    function eventlist($mode='')
    {
        if ($mode == 'new') {
            $data['eventcd'] = '';
            $data['sellcode'] = '';
            $data['eventnm'] = '';
            $data['eventdesc'] = '';
            $data['selectdate'] = '';
            $data['startdate'] = '';
            $data['enddate'] = '';
            $data['regdate'] = '';
            $data['limit'] = '';
            $data['offset'] = 0;
            $this->session->set_userdata($data);
        }

        $data['eventcd'] = $this->session->userdata('eventcd');
        $data['sellcode'] = $this->session->userdata('sellcode');
        $data['eventnm'] = $this->session->userdata('eventnm');
        $data['eventdesc'] = $this->session->userdata('eventdesc');
        $data['selectdate'] = $this->session->userdata('selectdate');
        $data['startdate'] = $this->session->userdata('startdate');
        $data['enddate'] = $this->session->userdata('enddate');

        //세션에 offset 있는지
        $data['offset'] = $this->session->userdata('offset');
        if($data['offset'] != "" && $data['offset'] != null){
            $offset= $data['offset'];
        }else{
            $offset= 0;
        }

        $where = $this->make_query($data);

        $sql = "SELECT * FROM apidb.lotte_event WHERE {$where}";
        $sql .= " order by eventsync desc , edate desc";

        $query = $this->cms2->query($sql);


        $total_rows = $query -> num_rows();
        $limit = 20;

        $this->load->library('pagination');
        $config['base_url'] = 'http://pcms.placem.co.kr/index.php/lotte/make_offset/';
        $config['total_rows'] =  $total_rows;
        $config['per_page'] = $limit;
        $config['cur_page'] = $offset;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        page_default_set($config);

        $this->pagination->initialize($config);
        $data['pag_links'] = $this->pagination->create_links();

        $sql .= " limit $offset, $limit";

        $query = $this->cms2->query($sql);

        $data['query'] = $query;
    	$data['title'] = '롯데 행사코드 리스트';
    	$data['contentview'] = '/lotte/eventlist';
    	$data['leftview'] = 'left';
    	$data['topview'] = 'head';
    	$data['bottomview'] = 'bottom';
    	$this->load->view('/inc/layout',$data);
    }

    function eventlist_ser(){
        $data['eventcd'] = trim($this->input->post('eventcd'));
        $data['sellcode'] = trim($this->input->post('sellcode'));
        $data['eventnm'] = trim($this->input->post('eventnm'));
        $data['eventdesc'] = trim($this->input->post('eventdesc'));
        $data['selectdate'] = trim($this->input->post('selectdate'));
        $data['startdate'] = trim($this->input->post('startdate'));
        $data['enddate'] = trim($this->input->post('enddate'));
        $data['regdate'] = trim($this->input->post('regdate'));
        $data['offset'] = 0;

        $this->session->set_userdata($data);

        $this->eventlist();
    }

    function eventlist_confirm(){
        $confid = $this->input->post('confid');

        echo $confid;
    }


} 


?>