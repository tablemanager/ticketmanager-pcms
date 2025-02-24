<?php
/**
 * Created by PhpStorm.
 * User: MINO
 * Date: 2016-11-22
 * Time: 오후 3:47
 */


class B2b extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!(($this->uri->segment(3) == 'login') || ($this->uri->segment(3) == 'login_ok')))
            $this->is_logged_in();
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

    function notice($offset=0){
        $this->chapi = $this->load->database('chapi', TRUE);


        $sql = "SELECT * FROM B2B_NOTICE where 1 ORDER  BY  id desc";

        $query = $this->chapi->query($sql);


        $total_rows = $query -> num_rows();
        $limit = 20;

        $this->load->library('pagination');
        $config['base_url'] = 'http://pcms.placem.co.kr/index.php/b2b/notice/';
        $config['total_rows'] =  $total_rows;
        $config['per_page'] = $limit;
        $config['cur_page'] = $offset;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        page_default_set($config);

        $this->pagination->initialize($config);
        $data['pag_links'] = $this->pagination->create_links();

        //$sql .= " order by id desc";
        if($offset == 'new'){
            $sql .= " limit 0, $limit";
        }else{
            $sql .= " limit $offset, $limit";
        }

        $query = $this->chapi->query($sql);

        $data['query'] = $query;
        $data['title'] = 'B2B 공지사항';

        $data['leftview'] = 'left';
        $data['contentview'] = '/b2b/notice';
        $this->load->view('/inc/layout',$data);
    }

    function notice_add(){
        //$this->chapi = $this->load->database('chapi', TRUE);
        $this->load->model('chapimodel');
        $this->cd =$this->input->post('aname');

        $title =$this->input->post('title');
        $title_english =$this->input->post('title_english');
        $title_china_simplified =$this->input->post('title_china_simplified');
        $title_china_traditional =$this->input->post('title_china_traditional');
        $content =$this->input->post('content_korean');
        $content_english =$this->input->post('content_english');
        $content_china_simplified =$this->input->post('content_china_simplified');
        $content_china_traditional =$this->input->post('content_china_traditional');

        if($this->chapimodel->B2B_NOTICE_insert(
            $title,$title_english,$title_china_simplified,$title_china_traditional,
            $content,$content_english,$content_china_simplified,$content_china_traditional)){
            echo "ok";
        }else{
            echo "등록실패";
        }

    }



    function notice_use(){
        $this->load->model('chapimodel');
        $this->id = $this->input->post('code');
        $this->visible = $this->input->post('use_state');
        echo $this->chapimodel->b2b_notice_use($this->id,$this->visible);
    }

    function account($offset=0){
        $this->chapi = $this->load->database('chapi', TRUE);


        $sql = "SELECT * FROM B2B_ACCOUNT where visible = '1'  ORDER  BY  company";

        $query = $this->chapi->query($sql);


        $total_rows = $query -> num_rows();
        $limit = 20;

        $this->load->library('pagination');
        $config['base_url'] = 'http://pcms.placem.co.kr/index.php/b2b/account/';
        $config['total_rows'] =  $total_rows;
        $config['per_page'] = $limit;
        $config['cur_page'] = $offset;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        page_default_set($config);

        $this->pagination->initialize($config);
        $data['pag_links'] = $this->pagination->create_links();

        //$sql .= " order by id desc";
        if($offset == 'new'){
            $sql .= " limit 0, $limit";
        }else{
            $sql .= " limit $offset, $limit";
        }

        $query = $this->chapi->query($sql);

        $data['query'] = $query;
        $data['title'] = 'B2B 시설 계정 관리';

        $data['leftview'] = 'left';
        $data['contentview'] = '/b2b/account';
        $this->load->view('/inc/layout',$data);
    }



    function account_add(){
        //$this->chapi = $this->load->database('chapi', TRUE);
        $this->load->model('chapimodel');
        $this->cd =$this->input->post('aname');
        //계정 중복체크
        if($this->chapimodel->chk_B2B_ACCOUNT_duplicate_cd($this->cd)){
            //echo $this->cd." 사용 가능";
            if($this->chapimodel->B2B_ACCOUNT_insert($this->cd)){
                echo "ok";
            }else{
                echo "등록실패";
            }
        }else{
            echo $this->cd." : 사용중인 계정입니다.";
        }
    }

    function account_mode(){
        $this->load->model('chapimodel');
        $id = $this->input->post('code');
        $pass = $this->input->post('modtext');
        $this->chapimodel->B2B_ACCOUNT_mode_pass( $id, $pass);
        //echo $slog;
    }

    function account_mode_pay(){
        $this->load->model('chapimodel');
        $id = $this->input->post('code');
        $pay_k = $this->input->post('gu');
        $pay_v = $this->input->post('mode');

        $result = $this->chapimodel->B2B_ACCOUNT_mode_pay( $id, $pay_k, $pay_v);
        echo $result;
    }

    function item_mode_pay(){
        $this->load->model('chapimodel');
        $id = $this->input->post('code');
        $pay_k = $this->input->post('gu');
        $pay_v = $this->input->post('mode');

        $result = $this->chapimodel->B2B_ITEMS_mode_pay( $id, $pay_k, $pay_v);
        echo $result;
    }

    function everland_item($offset=0)
    {
        $this->chapi = $this->load->database('chapi', TRUE);


        $chnsql = "SELECT * FROM B2B_ACCOUNT where visible = '1' ";
        $data['chn'] = $this->chapi->query($chnsql);

        $sql = "SELECT B2B_ACCOUNT.cd,B2B_ITEMS.* FROM B2B_ITEMS LEFT OUTER JOIN B2B_ACCOUNT ON B2B_ACCOUNT.id = B2B_ITEMS.ACCOUNT_ID where B2B_ITEMS.useyn = 'Y' AND B2B_ITEMS.faccode = 'BB'";
        $query = $this->chapi->query($sql);


        $total_rows = $query -> num_rows();
        $limit = 20;

        $this->load->library('pagination');
        $config['base_url'] = 'http://pcms.placem.co.kr/index.php/b2b/everland_item/';
        $config['total_rows'] =  $total_rows;
        $config['per_page'] = $limit;
        $config['cur_page'] = $offset;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        page_default_set($config);

        $this->pagination->initialize($config);
        $data['pag_links'] = $this->pagination->create_links();

        $sql .= " order by B2B_ITEMS.id desc";
        if($offset == 'new'){
            $sql .= " limit 0, $limit";
        }else{
            $sql .= " limit $offset, $limit";
        }

        $query = $this->chapi->query($sql);

        $data['query'] = $query;
        $data['title'] = '에버랜드 상품 관리';
        $data['contentview'] = 'b2b/everland_item';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }

    function paintershero_item($offset=0)
    {
        $this->chapi = $this->load->database('chapi', TRUE);


        $chnsql = "SELECT * FROM B2B_ACCOUNT where visible = '1' ";
        $data['chn'] = $this->chapi->query($chnsql);

        $sql = "SELECT B2B_ACCOUNT.cd,B2B_ITEMS.* FROM B2B_ITEMS LEFT OUTER JOIN B2B_ACCOUNT ON B2B_ACCOUNT.id = B2B_ITEMS.ACCOUNT_ID where B2B_ITEMS.useyn = 'Y' AND B2B_ITEMS.faccode = 'BP'";
        //$sql = "SELECT B2B_ACCOUNT.cd,B2B_ITEMS.* FROM B2B_ITEMS LEFT OUTER JOIN B2B_ACCOUNT ON B2B_ACCOUNT.id = B2B_ITEMS.ACCOUNT_ID where B2B_ITEMS.faccode = 'BP'";
        $query = $this->chapi->query($sql);


        $total_rows = $query -> num_rows();
        $limit = 20;

        $this->load->library('pagination');
        $config['base_url'] = 'http://pcms.placem.co.kr/index.php/b2b/paintershero_item/';
        $config['total_rows'] =  $total_rows;
        $config['per_page'] = $limit;
        $config['cur_page'] = $offset;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        page_default_set($config);

        $this->pagination->initialize($config);
        $data['pag_links'] = $this->pagination->create_links();

        $sql .= " order by B2B_ITEMS.id desc";
        if($offset == 'new'){
            $sql .= " limit 0, $limit";
        }else{
            $sql .= " limit $offset, $limit";
        }

        $query = $this->chapi->query($sql);

        $data['query'] = $query;
        $data['title'] = '페인터즈히어로 해외 상품 관리';
        $data['contentview'] = 'b2b/paintershero_item';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }

    function plm_item_faccode($s_faccode = ""){
        $data['s_faccode'] = $s_faccode;
        $this->session->set_userdata($data);
        $this->plm_item();
    }

    function plm_item_offeset($offeset = 0){
        $data['offeset'] = $offeset;
        $this->session->set_userdata($data);
        $this->plm_item();
    }

    function plm_item($s_faccode="ALL",$offset=0)
    {
        $this->chapi = $this->load->database('chapi', TRUE);

        $plm_itemList = array(

            "BB"=>"에버랜드(외국인)",
            "BP"=>"페인터즈히어로",
            "NS"=>"N서울타워",
            "FV"=>"한국민속촌",
            "PB"=>"휘닉스파크 블루캐니언",
            "PC"=>"웅진플레이시티",
            "PF"=>"쁘띠프랑스",
            "MT"=>"모비텔레콤"
        );//"VG"=>"반 고흐 인사이드",
        $data['plm_itemList'] = $plm_itemList;

        $chnsql = "SELECT * FROM B2B_ACCOUNT where visible = '1' ";
        $data['chn'] = $this->chapi->query($chnsql);

        //$s_faccode = $this->session->userdata('s_faccode');

        if($s_faccode != "" && $s_faccode != null && $s_faccode != "ALL"){
            $where_faccode = " AND B2B_ITEMS.faccode in ('".$s_faccode."')";
        }else{
            $where_faccode = "";
        }

        $sql = "SELECT B2B_ACCOUNT.cd,B2B_ITEMS.* FROM B2B_ITEMS 
                LEFT OUTER JOIN B2B_ACCOUNT ON B2B_ACCOUNT.id = B2B_ITEMS.ACCOUNT_ID 
                where B2B_ITEMS.useyn = 'Y'{$where_faccode}";
        $query = $this->chapi->query($sql);


        $total_rows = $query -> num_rows();
        $limit = 20;

        $this->load->library('pagination');
        $config['base_url'] = 'http://pcms.placem.co.kr/index.php/b2b/plm_item/'.$s_faccode."/";
        $config['total_rows'] =  $total_rows;
        $config['per_page'] = $limit;
        $config['cur_page'] = $offset;
        $config['uri_segment'] = 3;

        page_default_set($config);

        $this->pagination->initialize($config);
        $data['pag_links'] = $this->pagination->create_links();

        $sql .= " order by B2B_ITEMS.id desc";
        if($offset == 'new'){
            $sql .= " limit 0, $limit";
        }else{
            $sql .= " limit $offset, $limit";
        }
        //echo $sql;
        $query = $this->chapi->query($sql);
        $data['query'] = $query;
        $data['title'] = '플레이스엠 해외 상품 관리';
        $data['contentview'] = 'b2b/plm_item';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }

    function package_item($offset=0)
    {
        $this->chapi = $this->load->database('chapi', TRUE);


        $chnsql = "SELECT * FROM B2B_ACCOUNT where visible = '1' ";
        $data['chn'] = $this->chapi->query($chnsql);

        $pitemsql = "SELECT * FROM `B2B_ITEMS` WHERE edate >= CURDATE() and useyn = 'Y'";
        $data['pitem'] = $this->chapi->query($pitemsql);

        $sql = "
SELECT 
B2B_ACCOUNT.cd,bi1.* , 
bi2.nm as bi2nm , bi2.ITEM_CODE as bi2ITEM_CODE , 
bi3.nm as bi3nm , bi3.ITEM_CODE as bi3ITEM_CODE 
FROM 
B2B_ITEMS bi1

LEFT OUTER JOIN B2B_ACCOUNT 
ON B2B_ACCOUNT.id = bi1.ACCOUNT_ID 

LEFT OUTER JOIN B2B_ITEMS bi2
ON bi1.PKG_CODE1 = bi2.id 

LEFT OUTER JOIN B2B_ITEMS bi3
ON bi1.PKG_CODE2 = bi3.id 

where 
bi1.useyn = 'Y' AND bi1.faccode = 'PK'";
        $query = $this->chapi->query($sql);


        $total_rows = $query -> num_rows();
        $limit = 20;

        $this->load->library('pagination');
        $config['base_url'] = 'http://pcms.placem.co.kr/index.php/b2b/package_item/';
        $config['total_rows'] =  $total_rows;
        $config['per_page'] = $limit;
        $config['cur_page'] = $offset;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        page_default_set($config);

        $this->pagination->initialize($config);
        $data['pag_links'] = $this->pagination->create_links();

        $sql .= " order by bi1.id desc";
        if($offset == 'new'){
            $sql .= " limit 0, $limit";
        }else{
            $sql .= " limit $offset, $limit";
        }

        $query = $this->chapi->query($sql);

        $data['query'] = $query;
        $data['title'] = '패키지 상품 관리';
        $data['contentview'] = 'b2b/package_item';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }

    function itemnm_mode(){
        $this->load->model('chapimodel');
        $wherelang =$this->input->post('flang');
        $whereid =$this->input->post('code');
        $setnm =$this->input->post('modtext');

        //echo "$wherelang,$whereid,$setnm";
        if($this->chapimodel->B2B_ITEMS_update_nm($wherelang,$whereid,$setnm)){
            echo "ok";
        }else{
            echo "등록에 실패했습니다.";
        }


    }

    function b2b_item_add(){

        $this->load->model('chapimodel');
        $this->ACCOUNT_ID =$this->input->post('A_ID');
        $this->ITEM_CODE =$this->input->post('ITEM_CODE');
        $this->nm =$this->input->post('nm');
        $this->nm_english =$this->input->post('nm_english');
        $this->nm_china_simplified =$this->input->post('nm_china_simplified');
        $this->nm_china_traditional =$this->input->post('nm_china_traditional');
        $this->jung_price =$this->input->post('jung_price');
        $this->sell_price =$this->input->post('sell_price');
        $this->sdate =$this->input->post('sdate');
        $this->edate =$this->input->post('edate');
        $this->faccode =$this->input->post('faccode');

        if($this->chapimodel->B2B_ITEMS_insert($this->ACCOUNT_ID,$this->ITEM_CODE,$this->nm,$this->jung_price,$this->sell_price,$this->sdate,$this->edate,$this->faccode,
            $this->nm_english,$this->nm_china_simplified,$this->nm_china_traditional)){
            echo "ok";
        }else{
            echo "등록에 실패했습니다.";
        }
    }

    function b2b_item_adds(){

        $this->load->model('chapimodel');
        $A_ids =$this->input->post('A_ids');
        $ITEM_CODE =$this->input->post('ITEM_CODE');
        $nm =$this->input->post('nm');
        $nm_english =$this->input->post('nm_english');
        $nm_china_simplified =$this->input->post('nm_china_simplified');
        $nm_china_traditional =$this->input->post('nm_china_traditional');
        $jung_price =$this->input->post('jung_price');
        $sell_price =$this->input->post('sell_price');
        $sdate =$this->input->post('sdate');
        $edate =$this->input->post('edate');
        $faccode =$this->input->post('faccode');
        $noticemsg =$this->input->post('noticemsg');
        $noticemsg = trim($noticemsg);

        $data['s_faccode'] = $faccode;
        $this->session->set_userdata($data);

        $ACCOUNT_IDs = explode(";",$A_ids);

        $result = true;
        foreach ($ACCOUNT_IDs as $ACCOUNT_ID){
            if($ACCOUNT_ID != "" && $ACCOUNT_ID != null){
                if($this->chapimodel->B2B_ITEMS_insert($ACCOUNT_ID,$ITEM_CODE,$nm,$jung_price,$sell_price,$sdate,$edate,$faccode,$noticemsg,
                    $nm_english,$nm_china_simplified,$nm_china_traditional)){
                }else{
                    $result = false;
                }
            }
        }
        if($result){
            echo "ok";
        }else{
            echo "등록에 실패했습니다.";
        }

    }

    function b2b_package_add(){


        $this->load->model('chapimodel');

        $nm =$this->input->post('nm');
        $nm_english =$this->input->post('nm_english');
        $nm_china_simplified =$this->input->post('nm_china_simplified');
        $nm_china_traditional =$this->input->post('nm_china_traditional');
        $ACCOUNT_ID =$this->input->post('A_ID');
        $PKG_CODE1 =$this->input->post('PKG_CODE1');
        $PKG_CODE2 =$this->input->post('PKG_CODE2');
        $jung_price =$this->input->post('jung_price');
        $sell_price =$this->input->post('sell_price');
        $sdate =$this->input->post('sdate');
        $edate =$this->input->post('edate');
        $faccode = "PK";

        if($this->chapimodel->B2B_ITEMS_insert_packgae($nm,$ACCOUNT_ID,$PKG_CODE1,$PKG_CODE2,$jung_price,$sell_price,$sdate,$edate,$faccode,$nm_english,$nm_china_simplified,$nm_china_traditional)){
            echo "ok";
        }else{
            echo "등록에 실패했습니다.";
        }
    }

    function b2b_item_use(){
        $this->load->model('chapimodel');
        $this->id = $this->input->post('code');
        $this->useyn = $this->input->post('use_state');
        echo $this->chapimodel->b2b_item_use($this->id,$this->useyn);
    }

    function b2b_item_get(){
        $this->load->model('chapimodel');
        $this->ITEM_CODE =$this->input->post('ITEM_CODE');
        $this->faccode =$this->input->post('faccode');

        $itemrow = $this->chapimodel->select_B2B_ITEMS_code($this->ITEM_CODE,$this->faccode);
        if($itemrow != '0' && $itemrow != false){
            echo $itemrow->nm.";".$itemrow->jung_price.";".$itemrow->sell_price.";".$itemrow->sdate.";".$itemrow->edate.";".$itemrow->nm_english.";".$itemrow->nm_china_simplified.";".$itemrow->nm_china_traditional;
        }else{
            echo "err";
        }
    }

    function everland_coupon($sellcode=0 , $offset=0)
    {
        //$ACCOUNT_ID =$this->input->post('ACCOUNT_ID');
        //$ITEM_CODE=$this->input->post('ITEM_CODE');

        $this->chapi = $this->load->database('chapi', TRUE);
        $this->load->model('chapimodel');
        $syncArr = array(
            "R"=> "발권진행중",
            "C"=> "폐기진행중",
            "E"=> "에러",
            "S"=> "정상"
        );
        $data['syncArr'] =$syncArr;

        $stateArr = array(
            "Y"=> "사용",
            "N"=> "미사용",
            "C"=> "취소",
            "E"=> "에러"
        );
        $data['stateArr'] =$stateArr;

        $sql = "SELECT * FROM cms_extcoupon where sellcode = '{$sellcode}'";
        $query = $this->chapi->query($sql);

        $total_rows = $query -> num_rows();
        $limit = 50;


        if($offset === "Y") {
            $limit = $total_rows;
            $offset = 0;
            $sql .= " and state_use = 'Y' ";

        }

        $this->load->library('pagination');
        $config['base_url'] = 'http://pcms.placem.co.kr/index.php/b2b/everland_coupon/';
        $config['total_rows'] =  $total_rows;
        $config['per_page'] = $limit;
        $config['cur_page'] = $offset;
        $config['uri_segment'] = 3;

        $config['base_url'] = $config['base_url'].'/'.$sellcode;
        $config['uri_segment'] = $config['uri_segment'] + 1;

        $this->pagination->initialize($config);

        page_default_set($config);

        $this->pagination->initialize($config);
        $data['pag_links'] = $this->pagination->create_links();

        $sql .= " order by id desc";
        if($offset == 'new'){
            $sql .= " limit 0, $limit";
        }else{
            $sql .= " limit $offset, $limit";
        }

        $query = $this->chapi->query($sql);

        $data['sellcode'] = $sellcode;
        $data['sql'] = $sql;
        $data['offset'] = $offset;
        $data['query'] = $query;
        $data['title'] = '에버랜드 쿠폰 관리';
        $data['contentview'] = 'b2b/everland_coupon';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }

    function everland_coupon_search($nocoupon=0)
    {
        //$ACCOUNT_ID =$this->input->post('ACCOUNT_ID');
        //$ITEM_CODE=$this->input->post('ITEM_CODE');

        $this->chapi = $this->load->database('chapi', TRUE);
        $this->load->model('chapimodel');
        $syncArr = array(
            "R"=> "발권진행중",
            "C"=> "폐기진행중",
            "E"=> "에러",
            "S"=> "정상"
        );
        $data['syncArr'] =$syncArr;

        $stateArr = array(
            "Y"=> "사용",
            "N"=> "미사용",
            "C"=> "취소"
        );
        $data['stateArr'] =$stateArr;

        $sql = "SELECT * FROM cms_extcoupon where no_coupon = '{$nocoupon}'";
        $query = $this->chapi->query($sql);

        $data['sql'] = $sql;
        $data['query'] = $query;
        $data['title'] = '에버랜드 쿠폰 관리';
        $data['contentview'] = 'b2b/everland_coupon_search';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }

    function everland_order_cancel(){
        $this->load->model('chapimodel');
        $this->code =$this->input->post('code');

        if($this->chapimodel->update_B2B_ORDERS_cancel($this->code)){
            echo "ok";
        }else{
            echo "err";
        }
    }



    function everland_coupon_cancel(){
        $this->load->model('chapimodel');
        $this->code =$this->input->post('code');

        if($this->chapimodel->update_cms_extcoupon_cancel($this->code)){
            echo "ok";
        }else{
            echo "err";
        }
    }

    function everland_order($ACCOUNT_ID=0 , $ITEM_CODE=0, $offset=0)
    {
        //$ACCOUNT_ID =$this->input->post('ACCOUNT_ID');
        //$ITEM_CODE=$this->input->post('ITEM_CODE');

        $this->chapi = $this->load->database('chapi', TRUE);
        $this->load->model('chapimodel');
        $stateArr = array(
            "P"=> "결제대기",
            "R"=> "결제완료",
            "C"=> "취소요청",
            "D"=> "생성중",
            "I"=> "생성중",
            "S"=> "생성완료",
            "CC"=> "취소완료",
            "CE"=> "취소실패",
            "E"=> "비활성"
        );
        $data['stateArr'] =$stateArr;
        //active 회색, success 녹색, info 파랑, warning 노랑, danger 빨강
        $TrClassArr = array(
            "P"=> "",
            "R"=> "success",
            "C"=> "danger",
            "CC"=> "danger",
            "CE"=> "danger",
            "D"=> "warning",
            "I"=> "warning",
            "S"=> "info"
        );
        $data['TrClassArr'] =$TrClassArr;
        $PayArr = array(
            "card"=> "(카드)",
            "bank"=> "(무통장입금)",
            "after"=> "(후정산)",
            "reissue"=> "(재발급)"
        );
        $data['PayArr'] =$PayArr;


        $chnsql = "SELECT * FROM B2B_ACCOUNT where visible = '1' ORDER  BY  company";
        $data['chn'] = $this->chapi->query($chnsql);

        $sql = "SELECT * FROM B2B_ORDERS where STATE != 'E'";
        if($ACCOUNT_ID !=0 && $ITEM_CODE !=0) $sql .= " and ACCOUNT_ID = {$ACCOUNT_ID} and ITEM_CODE = {$ITEM_CODE}";

        $query = $this->chapi->query($sql);

        $total_rows = $query -> num_rows();
        $limit = 20;

        $this->load->library('pagination');
        $config['base_url'] = 'http://pcms.placem.co.kr/index.php/b2b/everland_order/';
        $config['total_rows'] =  $total_rows;
        $config['per_page'] = $limit;
        $config['cur_page'] = $offset;
        $config['uri_segment'] = 3;

        $config['base_url'] = $config['base_url'].'/'.$ACCOUNT_ID;
        $config['uri_segment'] = $config['uri_segment'] + 1;
        $config['base_url'] = $config['base_url'].'/'.$ITEM_CODE;
        $config['uri_segment'] = $config['uri_segment'] + 1;

        $this->pagination->initialize($config);

        page_default_set($config);

        $this->pagination->initialize($config);
        $data['pag_links'] = $this->pagination->create_links();

        $sql .= " order by id desc";
        if($offset == 'new'){
            $sql .= " limit 0, $limit";
        }else{
            $sql .= " limit $offset, $limit";
        }

        $query = $this->chapi->query($sql);


        $data['offset'] = $offset;
        $data['query'] = $query;
        $data['title'] = '에버랜드 주문 관리';
        $data['contentview'] = 'b2b/everland_order';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
    }



    function get_search_string($stx)
    {
        $stx_pattern = array();
        $stx_pattern[] = '#\.*/+#';
        $stx_pattern[] = '#\\\*#';
        $stx_pattern[] = '#\.{2,}#';
        $stx_pattern[] = '#[/\'\"%=*\#\(\)\|\+\-\&\!\$@~\{\}\[\]`;:\?\^\,]+#';

        $stx_replace = array();
        $stx_replace[] = '';
        $stx_replace[] = '';
        $stx_replace[] = '.';
        $stx_replace[] = '';

        $stx = preg_replace($stx_pattern, $stx_replace, $stx);

        return $stx;
    }

    function get_curl($url,$ch) {
        $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)';
        //$ch = curl_init ();
        curl_setopt ($ch, CURLOPT_URL,             $url);
        curl_setopt ($ch, CURLOPT_HEADER,          0);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER,  1);
        curl_setopt ($ch, CURLOPT_POST,            0);
        curl_setopt ($ch, CURLOPT_USERAGENT,       $agent);
        curl_setopt ($ch, CURLOPT_REFERER,         "");
        curl_setopt ($ch, CURLOPT_TIMEOUT,         3);

        $buffer = curl_exec ($ch);
        $cinfo = curl_getinfo($ch);
        curl_close($ch);

        if ($cinfo['http_code'] != 200)
        {
            return "";
        }

        return $buffer;
    }






}


?>