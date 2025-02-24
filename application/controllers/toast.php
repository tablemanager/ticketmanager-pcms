<?php
/**
 * Created by PhpStorm.
 * User: SeoJiyun
 * Date: 2018-08-10
 * Time: 오후 1:32
 */

class Toast extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!(($this->uri->segment(3) == 'login') || ($this->uri->segment(3) == 'login_ok')))
            $this->is_logged_in();
        $this->pcms = $this->load->database('pcms', TRUE);
        $this->sparo2 = $this->load->database('sparo2', TRUE);
        $this->cms = $this->load->database('cms', TRUE);
    }

    function is_logged_in()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');

        if (!isset($is_logged_in) || $is_logged_in != true) {
            $ipAdress = $_SERVER['REMOTE_ADDR'];
            if ($ipAdress != "115.68.42.130" && $ipAdress != "115.68.42.2") {
                redirect('/sys/login');
                die();
            }
        }
    }

    function toast_sendlms($mode=''){

        if ($mode == 'new') {
            $data['offset'] = 0;
            $data['selectchn'] = "";
            $this->session->set_userdata($data);
        }

        $where = "";
        $data['limit'] = '';

        //세션에 offset 있는지
        $data['offset'] = $this->session->userdata('offset');
        if($data['offset'] != "" && $data['offset'] != null){
            $offset= $data['offset'];
        }else{
            $offset= 0;
        }

        //세션에 선택한 채널 있는지
        $data['selectchn'] = $this->session->userdata('selectchn');
        if($data['selectchn'] != "" && $data['selectchn'] != null){
            $where .= " AND toast_lms.gp='{$data['selectchn']}' ";
        }

        $sql = "select * from spadb.toast_lms where useyn = 'Y' and edate >= CURDATE(){$where}";
        $sql .= " order by id desc";
        $query = $this->sparo2->query($sql);

        $total_rows = $query -> num_rows();
        $limit = 20;

        $this->load->library('pagination');
        $config['base_url'] = 'http://pcms.placem.co.kr/index.php/toast/toast_offset/';
        $config['total_rows'] =  $total_rows;
        $config['per_page'] = $limit;
        $config['cur_page'] = $offset;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        page_default_set($config);

        $this->pagination->initialize($config);
        $data['pag_links'] = $this->pagination->create_links();

        if(is_numeric($offset)){
            $sql .= " limit $offset, $limit";
        }else{
            $sql .= " limit 0, $limit";
        }

        $query = $this->sparo2->query($sql);

        $gparr = array(
            "EXTCOUPON"=> "PLACEM 쿠폰",
            "NEXON"=> "넥슨",
            "PHOENIX"=> "휘닉스파크/블루캐니언"

        );

        $data['gpar'] = $gparr;

        $data['query'] = $query;
        $data['title'] = 'TOAST 문자 발송';
        $data['contentview'] = '/toast/toast_sendlms';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }

    function toast_insert(){
        $this->load->model('pcmsmodel');
        $this->load->model('nsparomodel');

        $chnpick = $this->input->post('chnpick');
        $this->pcmsitem_id = $this->input->post('pcms_id');
        $this->pcms_itemnm = $this->pcmsmodel->get_pcms_itemnm($this->pcmsitem_id);
        $sdate = $this->input->post('sdate');
        $sdate = date("Y-m-d", strtotime($sdate));
        $edate = $this->input->post('edate');
        $edate = date("Y-m-d", strtotime($edate));
        $textarea_value = $this->input->post('textarea_value');
        $kakao_info = $this->input->post('info');
        $sellcode = $this->nsparomodel->get_toast_sellcode();


        $damnm = $this->session->userdata('nm');
        $manager = $this->session->userdata('cd');
        $kit_log = $damnm."(".$manager.") 등록";


        $this->nsparomodel->toast_lms_pcmsid_disable($this->pcmsitem_id); //기존 코드 정지
        $pcms_usecnt = $this->nsparomodel->toast_lms_pcmsid_check($this->pcmsitem_id);

        if($pcms_usecnt > 0){
            echo "err|사용중인 상품코드입니다.";
        }else{
            if($kakao_info){
                $data = array(
                    'gp' => $chnpick,
                    'pcms_id' => $this->pcmsitem_id,
                    'itemnm' => $this->pcms_itemnm,
                    'sdate' => $sdate,
                    'edate' => $edate,
                    'mms_text' => $textarea_value,
                    'sellcode' => $sellcode,
                    'kit_log' => $kit_log,
                    'mms_info' => $kakao_info,
                    'kakaoyn' => "Y"
                );
            }else{
                $data = array(
                    'gp' => $chnpick,
                    'pcms_id' => $this->pcmsitem_id,
                    'itemnm' => $this->pcms_itemnm,
                    'sdate' => $sdate,
                    'edate' => $edate,
                    'mms_text' => $textarea_value,
                    'sellcode' => $sellcode,
                    'kit_log' => $kit_log,
                    'kakaoyn' => "N"
                );
            }

            if($this->sparo2->insert('toast_lms', $data)){
                echo "ok|등록되었습니다";
            }else{
                echo "err|실패하였습니다";
            }
        }

    }

    function toast_mms(){
        $this->id = $this->input->post('flag');
        $this->mms_text = $this->input->post('mmstext');
        $this->mms_info = $this->input->post('mmsinfo');

        $sql = "select kit_log from toast_lms 
        		where id = '$this->id'";
        $logrow = $this->sparo2->query($sql)->row();


        $damnm = $this->session->userdata('nm');
        $damcd = $this->session->userdata('cd');
        $this->kit_log = $logrow->kit_log."\n".date("Y-m-d H:i:s").":".$damnm."(".$damcd.") 문자수정";

        $data = array(
            'mms_text' => $this->mms_text,
            'mms_info' => $this->mms_info,
            'kit_log' => $this->kit_log
        );

        $this->sparo2->where('id', $this->id);
        if(!$this->sparo2->update('toast_lms', $data)){
            echo "err";
        }else{
            echo site_url('toast/toast_sendlms');
        }
    }

    function toast_use(){
        $id = $this->input->post('code');
        $useyn = $this->input->post('use_state');

        $data = array(
            'useyn' => $useyn
        );

        $this->sparo2->where('id', $id);
        if($this->sparo2->update('toast_lms', $data)){
            echo "ok";
        }else{
            echo "err";
        }
    }

    function toast_addimg_ok($cid){
        $tmp_name1 = $_FILES["userfile"]["tmp_name"];
        if (!empty($tmp_name1))
        {
            $filename = $cid."_".date("Ymdhis").".png";
            $config['file_name'] = $filename;
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['overwrite'] = true;    //같은 이름의 파일이 이미 존재한다면 덮어쓸것
            $config['remove_spaces'] = true;    //RUE로 설정하면 파일명에 공백이 있을경우 밑줄(_)로 변경
            $config['max_size']	= '100';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload())
            {
                $ssql = "UPDATE spadb.toast_lms SET add_img= 'http://pcms.placem.co.kr/uploads/{$filename}' WHERE id = '{$cid}' limit 1";
                $this->sparo2->query($ssql);
            }
            redirect('/toast/toast_sendlms');
        }
    }

    function toast_offset($offset=0) {
        $data = array(
            'offset' => $offset
        );
        $this->session->set_userdata($data);
        $this->toast_sendlms();
    }

    function chn_sel() {
        $selectchn = $this->input->post('selectchn');
        $data = array(
            'selectchn' => $selectchn,
            'offset' => 0
        );
        $this->session->set_userdata($data);
        $this->toast_sendlms();
    }

    function setmsg(){
        $sql = "select * from spadb.toast_lms where useyn = 'Y' and edate >= CURDATE() order by id desc";
        $query = $this->sparo2->query($sql);

        $gparr = array(
            "SPARO"=> "일반",
            "NEXON"=> "넥슨"
        );

        $data['gpar'] = $gparr;

        $data['query'] = $query;
        $data['title'] = '월화수목금퇼';
        $data['contentview'] = '/toast/setmsg';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }

    function setmsg_insert(){
        $this->load->model('pcmsmodel');
        $this->load->model('nsparomodel');

        $itemnm = $this->input->post('itemnm');
        $TYPE = $this->input->post('TYPE');
        $chnpick = $this->input->post('chnpick');
        $this->pcmsitem_id = $this->input->post('pcms_id');

//        $this->pcms_itemnm = $this->pcmsmodel->get_pcms_itemnm($this->pcmsitem_id);

        $sdate = $this->input->post('sdate');
        $edate = $this->input->post('edate');
        $textarea_value = $this->input->post('textarea_value');
        $sellcode = $this->nsparomodel->get_toast_sellcode();


        $damnm = $this->session->userdata('nm');
        $manager = $this->session->userdata('cd');
        $kit_log = $damnm."(".$manager.") 등록";


        $this->nsparomodel->toast_lms_pcmsid_disable($this->pcmsitem_id); //기존 코드 정지
        $pcms_usecnt = $this->nsparomodel->toast_lms_pcmsid_check($this->pcmsitem_id);

        if($pcms_usecnt > 0){
            echo "err|사용중인 상품코드입니다.";
        }else{
            $data = array(
                'itemnm' => $itemnm,
                'TYPE' => $TYPE,
                'gp' => $chnpick,
                'pcms_id' => $this->pcmsitem_id,
                'sdate' => $sdate,
                'edate' => $edate,
                'mms_text' => $textarea_value,
                'sellcode' => $sellcode,
                'kit_log' => $kit_log
            );

            print_r($data);

//            if($this->sparo2->insert('toast_lms', $data)){
//                echo "ok|등록되었습니다";
//            }else{
//                echo "err|실패하였습니다";
//            }
        }
    }

    function setmsg_addimg_ok($cid){
        $tmp_name1 = $_FILES["userfile"]["tmp_name"];
        if (!empty($tmp_name1))
        {
            $filename = $cid."_".date("Ymdhis").".png";
            $config['file_name'] = $filename;
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['overwrite'] = true;    //같은 이름의 파일이 이미 존재한다면 덮어쓸것
            $config['remove_spaces'] = true;    //RUE로 설정하면 파일명에 공백이 있을경우 밑줄(_)로 변경
            $config['max_size']	= '100';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload())
            {
                $ssql = "UPDATE spadb.toast_lms SET add_img= 'http://pcms.placem.co.kr/uploads/{$filename}' WHERE id = '{$cid}' limit 1";
                $this->sparo2->query($ssql);
            }
            redirect('/toast/setmsg');
        }
    }
}
?>