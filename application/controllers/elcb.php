<?php
/**
 * Created by PhpStorm.
 * User: SeoJiyun
 * Date: 2018-07-11
 * Time: 오후 2:30
 */
?>
<?php

class Elcb extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!(($this->uri->segment(3) == 'login') || ($this->uri->segment(3) == 'login_ok')))
            $this->is_logged_in();
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

    function count($mode='')
    {
        $viewtable = false;
        $total = 0;

        if ($mode == 'new')
        {
            $data['param'] = '^^^^^^^^^^^^^^^^^^^^';
            $this->session->set_userdata($data);
        }

        $param = $this->session->userdata('param');
        if($param != '' && $param != NULL){
            $paramarr = explode('^',$param);
            $searchtxt = $paramarr[0];
            $sdate = $paramarr[1];
            $edate = $paramarr[2];
            $sdatepost = $paramarr[1];
            $edatepost = $paramarr[2];
        }


        if($searchtxt != '' && $searchtxt != NULL){
            $viewtable = true;

            $sql = "
			SELECT sellcode,
			if(substr(sellcode,1,1) = 'P','플레이스엠',
				if(substr(sellcode,1,1) = 'W','위메프',
				if(substr(sellcode,1,1) = 'T','티몬',
				if(substr(sellcode,1,1) = 'C','쿠팡',
            	if(substr(sellcode,1,1) = 'N','네이버',sellcode)
			)))) ggu
			, sum(if(state_use ='Y',1,0)) use_cnt
			, sum(if(state_use ='N',1,0)) unuse_cnt
			, sum(if(state_use ='C',1,0)) cancel_cnt
			,count(sellcode) total
			FROM `pcms_extcoupon`
			WHERE (couponno LIKE 'EL500{$searchtxt}%' or couponno LIKE 'CB500{$searchtxt}%')
			AND syncfac_result != 'N' 
			";

           if($sdate != '' || $sdate != null){
                $sdate = date("Y-m-d",strtotime($sdate));
                $sql .= " AND date_use > '$sdate 00:00:00' ";

            }
            if($edate != '' || $edate != null){
                $edate = date("Y-m-d",strtotime($edate));
                $sql .= " AND date_use < '$edate 23:59:59' ";
            }

            $sql .=" group by sellcode ";


            $query = $this->sparo2->query($sql);
            $total = $query -> num_rows();
            $data['query'] = $query;

        }
        $data['sdate'] = $sdatepost;
        $data['edate'] = $edatepost;
        $data['total'] = $total;
        $data['searchtxt']=$searchtxt;
        $data['viewtable'] = $viewtable;
        $data['title'] = '판매/사용 현황';
        $data['contentview'] = '/elcb/count';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }

    function ev_ser()
    {
        $this->searchtxt = trim($this->input->post('searchtxt')); //노출채널(채널검색해서 중복입력)
        $this->sdate = trim($this->input->post('sdate'));
        $this->edate = trim($this->input->post('edate'));
        $paramarr = array($this->searchtxt,$this->sdate,$this->edate);
        $data['param'] = implode('^',$paramarr);
        $this->session->set_userdata($data);
        $this->count();
    }

}


?>
