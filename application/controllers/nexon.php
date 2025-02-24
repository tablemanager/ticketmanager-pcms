<?php
/**
 * Created by PhpStorm.
 * User: SeoJiyun
 * Date: 2018-07-25
 * Time: 오후 7:51
 */
require_once 'sys.php';

class Nexon extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
       /* if (!(($this->uri->segment(3) == 'login') || ($this->uri->segment(3) == 'login_ok')))
            $this->is_logged_in();*/
        $this->sparo2 = $this->load->database('sparo2', TRUE);

    }

    function is_logged_in()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');

        if (!isset($is_logged_in) || $is_logged_in != true) {
            redirect('/sys/login');
            die();
        }
    }
    
    function item(){
        $sql = "select id,ContractDetailNo,item_id,item_nm,sell_sdate,sell_edate,state from nexon_items where state='Y'";
        $query = $this->sparo2->query($sql);

        $data['query'] = $query;
        $data['title'] = '넥슨 상품 연동 관리';
        $data['contentview'] = '/nexon/item';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }

    function insert_item(){
        $item_id = $this->input->post('item_id');
        $item_nm = $this->input->post('item_nm');
        $ContractDetailNo = $this->input->post('ContractDetailNo');
        $sell_sdate = $this->input->post('sell_sdate');
        $sell_edate = $this->input->post('sell_edate');

        $data = array(
            'item_id' => $item_id,
            'item_nm' => $item_nm,
            'ContractDetailNo' => $ContractDetailNo,
            'sell_sdate' => $sell_sdate,
            'sell_edate' => $sell_edate,
            'state' => 'Y'
        );

        if($this->sparo2->insert('nexon_items',$data)){
            echo "ok|등록이 완료되었습니다.";
        }else{
            echo "err|등록 실패";
        }
    }

    function unuse_item(){
        $id =$this->input->post('code');
        $state =$this->input->post('use_state');

        $unsql = "SELECT * FROM spadb.nexon_items WHERE id = '{$id}'";
        $unrow = $this->sparo2->query($unsql)->row();
//        $unuse_encode = json_encode($unrow);

//        $qrystr = $unuse_encode; //미사용한 데이터의 json인코딩 데이터
//        $regdate = date("Y-m-d H:i:s");
        $damnm = $this->session->userdata('nm');
        $damcd = $this->session->userdata('cd');
        $damip = $_SERVER['REMOTE_ADDR'];

        $log = $damcd."\n/".date("Y-m-d H:i:s")." ".$damnm."주문상태변경:";
        $log = $damcd."\n".date("Y-m-d H:i:s")."/".$damip.":".$damnm."(".$damcd.")"." STATE";

        $data = array(
            'log' => $log,
            'state' => $state
        );
        if($this->sparo2->update('nexon_items', $data, array('id' => $id))){
            echo "ok";
        }else{
            echo "errrrr";
        }
    }

    function coupon_make_query($data)
    {
        $where = "1";

        $order_no = $data['order_no'];
        $Cus_nm = $data['Cus_nm'];
        $Cus_hp = $data['Cus_hp'];

        if ($order_no != '' && $order_no != NULL) {
            $where .= " AND order_no = '$order_no'"; //주문번호 검색
        }

        if ($Cus_nm != '' && $Cus_nm != NULL) {
            $where .= " AND Cus_nm like '%$Cus_nm%'"; //고객이름 검색
        }

        if ($Cus_hp != '' && $Cus_hp != NULL) {
            $where .= " AND Cus_hp like '%$Cus_hp%'"; //고객휴대폰 검색
        }

        return $where;
    }

    function coupon($mode=''){

        if ($mode == 'new') {
            $data['order_no'] = '';
            $data['Cus_nm'] = '';
            $data['Cus_hp'] = '';
            $data['limit'] = '';
            $data['offset'] = 0;

            $this->session->set_userdata($data);
        }

        if($this->session->userdata('offset') != '' && $this->session->userdata('offset') != null ){
            $offset= $this->session->userdata('offset');
        }else{
            $offset= 0;
        }

        $data['order_no'] = $this->session->userdata('order_no');
        $data['Cus_nm'] = $this->session->userdata('Cus_nm');
        $data['Cus_hp'] = $this->session->userdata('Cus_hp');
        $data['limit'] = $this->session->userdata('limit');

        $where = $this->coupon_make_query($data);

        $csql="SELECT * FROM spadb.nexon_coupons where {$where}";
        $cquery = $this->sparo2->query($csql);

        $total_rows = $cquery -> num_rows();
        $limit = 20;

        $this->load->library('pagination');
        $config['base_url'] = 'http://pcms.placem.co.kr/index.php/nexon/coupon_offset/';
        $config['total_rows'] =  $total_rows;
        $config['per_page'] = $limit;
        $config['cur_page'] = $offset;
        $config['uri_segment'] = 3;

        page_default_set($config);
        $this->pagination->initialize($config);
        $data['pag_links'] = $this->pagination->create_links();

        $csql .= " order by id desc limit $offset, $limit";

        $cquery = $this->sparo2->query($csql);

        $data['offset'] = $offset;
        $data['cquery'] = $cquery;
        $data['title'] = '넥슨 쿠폰 조회/폐기';
        $data['contentview'] = '/nexon/coupon';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }

    function couponCancel(){
        $this->load->model('nsparomodel');

        $id =$this->input->post('couponid');
        $couponrow = $this->nsparomodel->get_nexonCoupon_id($id);
        if($couponrow){

            $this->load->library('nexonlib');
            $apires =  $this->nexonlib->cancelNexonCoupon($couponrow);
            if($apires->ResultCode == '0'){
                $this->nsparomodel->updateNexonCouponCancelResult($id,"C",$apires);
                echo "OK;쿠폰폐기 성공!\n{$apires->ResultMessage}\n쿠폰폐기 승인 시간 :{$apires->ApprovalDateTime}";
            }else{
                $this->nsparomodel->updateNexonCouponCancelResult($id,"N",$apires);
                echo "ERR;".$apires->ResultMessage."(".$apires->ResultCode.")";
            }
        }else{
            echo "ERR;쿠폰 정보 없음\n(시스템팀에 문의해주세요.)\n담당자 : 미카엘, 신디";
        }
    }

    function coupon_ser(){
        $data['order_no'] = trim($this->input->post('order_no'));
        $data['Cus_nm'] = trim($this->input->post('Cus_nm'));
        $data['Cus_hp'] = trim($this->input->post('Cus_hp'));
        $data['offset'] = 0;

        $this->session->set_userdata($data);

        $this->coupon();
    }

    function coupon_limit($limit = "10", $offset=0){
        $data['limit'] = $this->input->post('limit');
        $data['offset'] = $offset;
        $this->session->set_userdata($data);
        $this->coupon();
    }

    function coupon_offset($offset = 0)
    {
        $data['offset'] = $offset;
        $this->session->set_userdata($data);
        $this->coupon();
    }
}
?>