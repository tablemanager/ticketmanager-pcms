<?php
/**
 * Created by PhpStorm.
 * User: SeoJiyun
 * Date: 2018-08-08
 * Time: 오후 2:43
 */

class Refund extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!(($this->uri->segment(3) == 'login') || ($this->uri->segment(3) == 'login_ok')))
            $this->is_logged_in();
        $this->cms = $this->load->database('cms', TRUE);
        $this->pcms = $this->load->database('pcms', TRUE);
        $this->sparo = $this->load->database('sparo', TRUE);
        $this->sparo2 = $this->load->database('sparo2', TRUE);

        $this->load->helper(array('form', 'url'));
    }

    function is_logged_in()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');

        if (!isset($is_logged_in) || $is_logged_in != true) {
            redirect('/sys/login');
            die();
        }
    }
    
    function refundlist(){
        $sql="SELECT * FROM `pcms_extcoupon` WHERE `expdate` >= CURDATE() and `syncuse_msg` = '0008'";
        $query = $this->sparo2->query($sql);

        $data['query'] = $query;
        $data['title'] = '환불대기 리스트';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $data['contentview'] = '/refund/refundlist';
        $this->load->view('/inc/layout',$data);
    }
}
?>