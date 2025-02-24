<?php
class Phoenix extends CI_Controller
{
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

    function skiseason_item($offset=0){
        $sql = "SELECT * FROM pcmsdb.phoenix_skiseason_items where state = 'Y' ORDER BY id DESC";

        $query = $this->db->query($sql);


        $total_rows = $query -> num_rows();
        $limit = 20;

        $this->load->library('pagination');
        $config['base_url'] = 'http://pcms.placem.co.kr/index.php/phoenix/skiseason_item/';
        $config['total_rows'] =  $total_rows;
        $config['per_page'] = $limit;
        $config['cur_page'] = $offset;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        page_default_set($config);

        $this->pagination->initialize($config);
        $data['pag_links'] = $this->pagination->create_links();

        //$sql .= " order by id desc";
        if($offset == 'new' || $offset == '' || $offset == null || $offset == false){
            $offset = 0;
        }

        $sql .= " limit $offset, $limit";

        $query = $this->db->query($sql);

        $data['query'] = $query;

        $data['title'] = '휘닉스파크 시즌권';
        $data['leftview'] = 'left';
        $data['contentview'] = '/phoenix/skiseason_item';
        $this->load->view('/inc/layout',$data);
    }

    function skiseason_item_add(){
        $this->load->model('cmsmodel');

        $item_id = $this->input->post('item_id');
        $itemname = $this->input->post('itemname');
        $shopcd = $this->input->post('shopcd');
        $ticketcd = $this->input->post('ticketcd');
        $msg = $this->input->post('msg');

        $data = array(
          'item_id' => $item_id,
          'itemname' => $itemname,
          'shopcd' => $shopcd,
          'ticketcd' => $ticketcd,
          'msg' => $msg
        );


        if($this->cmsmodel->chk_skiseason_items_duplicate($item_id)) {
            if ($this->db->insert('phoenix_skiseason_items', $data)) {
                echo "ok";
            } else {
                echo "등록실패";
            }
        }else{
            echo $item_id." : 이미 등록된 판매(딜) 입니다.";
        }
    }

    function skiseason_item_use(){
        $id = $this->input->post('code');
        $state = $this->input->post('use_state');

        $data = array(
            'state' => $state
        );

        $this->db->where('id', $id);
        if($this->db->update('phoenix_skiseason_items', $data)){
            echo "ok";
        }else {
            echo "err";
        }
    }

    function pkg_make_query($data)
    {
        $where = " (sellToDate >= CURDATE() or useToDate >= CURDATE())";

        $pkgCd = $data['pkgCd'];
        $pkgNm = $data['pkgNm'];

        if ($pkgCd != '' && $pkgCd != NULL) {
            $where .= " AND pkgCd = '$pkgCd'"; //패키지코드 검색
        }

        if ($pkgNm != '' && $pkgNm != NULL) {
            $where .= " AND pkgNm like '%$pkgNm%'"; //패키지명 검색
        }

        return $where;
    }

    function phoenix_pkg($mode=''){
        if ($mode == 'new') {
            $data['pkgCd'] = '';
            $data['pkgNm'] = '';
            $data['limit'] = '';
            $data['offset'] = 0;

            $this->session->set_userdata($data);
        }

        if($this->session->userdata('offset') != '' && $this->session->userdata('offset') != null ){
            $offset= $this->session->userdata('offset');
        }else{
            $offset= 0;
        }

        $data['pkgCd'] = $this->session->userdata('pkgCd');
        $data['pkgNm'] = $this->session->userdata('pkgNm');
        $data['limit'] = $this->session->userdata('limit');

        $where = $this->pkg_make_query($data);

        $sql="SELECT * FROM spadb.phoenix_pkglist WHERE {$where}";

        $query = $this->sparo2->query($sql);

        $total_rows = $query -> num_rows();
        $limit = 20;

        $this->load->library('pagination');
        $config['base_url'] = 'http://pcms.placem.co.kr/index.php/phoenix/phoenix_pkg_offset/';
        $config['total_rows'] =  $total_rows;
        $config['per_page'] = $limit;
        $config['cur_page'] = $offset;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        page_default_set($config);
        $this->pagination->initialize($config);
        $data['pag_links'] = $this->pagination->create_links();

        $sql .= " limit $offset, $limit";

        $query = $this->sparo2->query($sql);

        $data['offset'] = $offset;
        $data['query'] = $query;
        $data['title'] = '휘닉스파크 패키지';
        $data['leftview'] = 'left';
        $data['contentview'] = '/phoenix/phoenix_pkg';
        $this->load->view('/inc/layout',$data);
    }

    function pkg_itemnm_update(){
        $this->load->model('pcmsmodel');
        $this->load->model('nsparomodel');

        $id = $this->input->post('code');
        $this->pcmsitem_id = $this->input->post('pcmsitem_id');
        $this->pcms_itemnm = $this->pcmsmodel->get_pcms_itemnm($this->pcmsitem_id);

        $data = array(
            'item_id' => $this->pcmsitem_id,
            'item_nm' => $this->pcms_itemnm
        );
        $this->sparo2->where('id', $id);

        if($this->nsparomodel->chk_phoenix_pkg_itemid($this->pcmsitem_id)) {
            if (!$this->sparo2->update('phoenix_pkglist', $data)) {
                echo "등록 실패";
            } else {
                echo "ok";
            }
        }else{
            echo $this->pcmsitem_id." : 이미 등록된 상품입니다.";
        }
    }

    function phoenix_pkg_ser(){
        $data['pkgCd'] = trim($this->input->post('pkgCd'));
        $data['pkgNm'] = trim($this->input->post('pkgNm'));
        $data['offset'] = 0;

        $this->session->set_userdata($data);

        $this->phoenix_pkg();
    }

    function phoenix_pkg_offset($offset = 0)
    {
        $data['offset'] = $offset;
        $this->session->set_userdata($data);
        $this->phoenix_pkg();
    }

    function phoenix_coupon($mode=''){
        if ($mode == 'new') {
            $data['orderno'] = '';
            $data['actlUserNm'] = '';
            $data['actlUserMpNo'] = '';
            $data['limit'] = '';
            $data['offset'] = 0;

            $this->session->set_userdata($data);
        }

        if($this->session->userdata('offset') != '' && $this->session->userdata('offset') != null ){
            $offset= $this->session->userdata('offset');
        }else{
            $offset= 0;
        }

        $data['orderno'] = $this->session->userdata('orderno');
        $data['actlUserNm'] = $this->session->userdata('actlUserNm');
        $data['actlUserMpNo'] = $this->session->userdata('actlUserMpNo');
        $data['limit'] = $this->session->userdata('limit');

        $where = $this->coupon_make_query($data);

        $sql="SELECT p.pkgCd, p.pkgNm, p.useFromDate, p.useToDate, 
                c.id, c.orderid, c.orderno, c.actlUserNm, c.actlUserMpNo, c.sellDate, c.asgnDate, c.useyn, c.sync, c.statusCode, c.status, 
                c.rprsSellNo, c.rprsBarCd, c.roomRprsRsrvNo, c.roomRsrvNo, c.roomStayNo, c.info_statusCode, c.info_status, c.midwkWkndDivCd 
                FROM phoenix_pkgcoupon c left join phoenix_pkglist p ON p.pkgCd=c.pkgCd WHERE {$where}";

        $query = $this->sparo2->query($sql);

        $total_rows = $query -> num_rows();
        $limit = 50;

        $this->load->library('pagination');
        $config['base_url'] = 'http://pcms.placem.co.kr/index.php/phoenix/phoenix_coupon_offset/';
        $config['total_rows'] =  $total_rows;
        $config['per_page'] = $limit;
        $config['cur_page'] = $offset;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        page_default_set($config);
        $this->pagination->initialize($config);
        $data['pag_links'] = $this->pagination->create_links();

        $sql .= " limit $offset, $limit";

        $query = $this->sparo2->query($sql);

        $data['offset'] = $offset;

        $data['query'] = $query;
        $data['title'] = '휘닉스파크 쿠폰';
        $data['leftview'] = 'left';
        $data['contentview'] = '/phoenix/phoenix_coupon';
        $this->load->view('/inc/layout',$data);
    }

    function coupon_make_query($data)
    {
        $where = "1";

        $orderno = $data['orderno'];
        $actlUserNm = $data['actlUserNm'];
        $actlUserMpNo = $data['actlUserMpNo'];

        if ($orderno != '' && $orderno != NULL) {
            $where .= " AND orderno = '$orderno'"; //주문번호 검색
        }

        if ($actlUserNm != '' && $actlUserNm != NULL) {
            $where .= " AND actlUserNm = '$actlUserNm'"; //이름 검색
        }

        if ($actlUserMpNo != '' && $actlUserMpNo != NULL) {
            $where .= " AND actlUserMpNo like '%$actlUserMpNo%'"; //휴대폰번호 검색
        }

        return $where;
    }


    function phoenix_coupon_ser(){
        $data['orderno'] = trim($this->input->post('orderno'));
        $data['actlUserNm'] = trim($this->input->post('actlUserNm'));
        $data['actlUserMpNo'] = trim($this->input->post('actlUserMpNo'));
        $data['offset'] = 0;

        $this->session->set_userdata($data);

        $this->phoenix_coupon();
    }

    function phoenix_coupon_offset($offset = 0)
    {
        $data['offset'] = $offset;
        $this->session->set_userdata($data);
        $this->phoenix_coupon();
    }

    function coupon_chk(){
        $rprsSellNo = $this->input->post('rprsSellNo');
        $getres = $this->curl_post_json_nonD('http://gateway.sparo.cc/phoenix/info/'.$rprsSellNo);
        echo $getres->status;
    }

    function coupon_disuse(){
        $rprsSellNo = $this->input->post('rprsSellNo');
        $getres = $this->curl_post_json_nonD('http://gateway.sparo.cc/phoenix/cancel/'.$rprsSellNo);
        echo $getres->status;

    }

    function curl_post_json_nonD($url){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
        )//'Content-Length: ' . strlen($data_string)
        );
        $result = curl_exec($ch);
        return json_decode($result);
    }
}