<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: text/html; charset=utf-8');

class Home extends CI_Controller
{
    function __construct() {
        parent::__construct();
        if (!(($this->uri->segment(3) == 'login') || ($this->uri->segment(3) == 'login_ok')))
            $this->is_logged_in();
        $this->cms2 = $this->load->database('cms2', TRUE);
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

    function main (){

        //판매채널 사용연동 실패 확인
        $totalsql = "select count(order_id) as totalrefund from spadb.pcms_extcoupon where `expdate` >= CURDATE() and `syncuse_msg` = '0008'";
        $data['totalrefund'] = $this->sparo2->query($totalsql)->row()->totalrefund;

        $ysql="SELECT * FROM olddb.orders_amt WHERE 1 order by date desc limit 1";
        $data['oamt'] = $this->cms2->query($ysql)->row();

        $sql="SELECT * FROM olddb.order_chart WHERE 1 order by id desc limit 1";
        $chart = $this->cms2->query($sql)->row();

        $data['chart'] = $chart;
        $data['tryAmt'] = 80000000000;

        //판매금액 비교
        $data['chart1'] = $chart->chart1;

        //2018년 판매금액, 사용금액
        $data['chart2'] = $chart->chart2;

        //주별 판매,사용금액
        $chart3 = array();
        $chart3[] = array("week" => "1주차", "lastsale" => '23.5', "thissale" => '18.1', "thisuse" => '20');
        $data['chart3'] = json_encode($chart3);

        //시설별 매출 현황
        $data['chart4'] = $chart->chart4;

        //채널별 매출 현황
        $data['chart5'] = $chart->chart5;

        $data['contentview'] = '/home/main';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }
}

?>
