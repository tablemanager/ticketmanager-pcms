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

	function plm_item_limit() {
		$data['limit'] = $this->input->post('limit');
		$data['offset'] = 0;
		$this->session->set_userdata($data);
		$this->plm_item();
	}

	function plm_item_offset($offset = 0){
        $data['offset'] = $offset;
        $this->session->set_userdata($data);
        $this->plm_item();
    }

	function chnn_sel($offset=0) {
		$chnn_sel = $this->input->post('chnn_sel');
		$data = array(
			'chnn_sel' => $chnn_sel,
			'offset' => $offset
		);
		$this->session->set_userdata($data);
		$this->plm_item();
	}

	function item_sel($offset=0) {
		$item_sel = $this->input->post('item_sel');
		$data = array(
			'item_sel' => $item_sel,
			'offset' => $offset
		);

		$this->session->set_userdata($data);
		$this->plm_item();		
	}

	function plm_item_searchnm($offset=0) {
		$nm = $this->input->post('nm');
		$data = array(
			'nm' => $nm,
			'offset' => $offset
		);

		$this->session->set_userdata($data);
		$this->plm_item();	
		
	}

    function plm_item($mode="")
    {
        $this->chapi = $this->load->database('chapi', TRUE);

        if ($mode == 'new') {

            $data['offset'] = 0;
            $data['chnn_sel'] = "";
            $data['item_sel'] = "";
            $data['nm'] = "";
            $this->session->set_userdata($data);
        }

		$total_rows = 0;
		$where = " AND faccode != 'PK' ";
		$data['limit'] = '';

		$plm_itemList = array(
            "BB"=>"에버랜드",
            "ELB2B"=>"에버랜드(S티켓)",
            "CBB2B"=>"캐리비안베이(S티켓)",
            "BP"=>"페인터즈히어로",
            "NS"=>"N서울타워",
            "FV"=>"한국민속촌",
            "PB"=>"휘닉스파크 블루캐니언",
            "PC"=>"웅진플레이시티",
            "PF"=>"쁘띠프랑스",
            "MT"=>"모비텔레콤",
            "EC"=>"이랜드크루즈",
            "VR"=>"K-Star VR",
            "MA"=>"박물관은살아있다",
            "HB"=>"남산한복체험관",
            "TE"=>"트릭아이",
            "OZ"=>"별빛정원우주",
            "PA"=>"결제",
            "KZ"=>"키자니아",
            "MR"=>"미션레이스",
            "CA"=>"코엑스아쿠아리움"
        );//"VG"=>"반 고흐 인사이드",
        $data['plm_itemList'] = $plm_itemList;
		
		//상단 등록용 채널 리스트 LOAD
		$chnsql = "SELECT * FROM B2B_ACCOUNT where visible = '1' ";
        $data['chn'] = $this->chapi->query($chnsql);

		//세션에 limit 있는지
		$data['limit'] = $this->session->userdata('limit');
		if($data['limit'] != "" && $data['limit'] != null){
			$limit= $data['limit'];
		}else{
			$limit= "10";
		}

		//세션에 offset 있는지
		$data['offset'] = $this->session->userdata('offset');
		if($data['offset'] != "" && $data['offset'] != null){
			$offset= $data['offset'];
		}else{
			$offset= 0;
		}
		
		//세션에 선택한 채널,시설이 있는지
		$data['chnn_sel'] = $this->session->userdata('chnn_sel');
		$data['item_sel'] = $this->session->userdata('item_sel');
		$data['nm'] = $this->session->userdata('nm');

		if($data['chnn_sel'] != "" && $data['chnn_sel'] != null && $data['chnn_sel'] != "ALL"){
           $where .= " AND B2B_ACCOUNT.id='{$data['chnn_sel']}' ";
        }
		if($data['item_sel'] != "" && $data['item_sel'] != null && $data['item_sel'] != "ALL"){
           $where .= " AND B2B_ITEMS.faccode = '{$data['item_sel']}' ";
        }
		if($data['nm'] != "" && $data['nm'] != null){
           $where .= " AND B2B_ITEMS.nm like '%{$data['nm']}%' ";
        }

        $sql = "SELECT B2B_ACCOUNT.cd,B2B_ITEMS.* FROM B2B_ITEMS 
                LEFT OUTER JOIN B2B_ACCOUNT ON B2B_ACCOUNT.id = B2B_ITEMS.ACCOUNT_ID 
                where B2B_ITEMS.useyn = 'Y'{$where}";
       // echo $sql;

        $query = $this->chapi->query($sql);

        $total_rows = $query -> num_rows();

        $this->load->library('pagination');
        $config['base_url'] = 'http://pcms.placem.co.kr/index.php/b2b/plm_item_offset/';
        $config['total_rows'] =  $total_rows;
        $config['per_page'] = $limit;
        $config['cur_page'] = $offset;
        $config['uri_segment'] = 3;

        page_default_set($config);

        $this->pagination->initialize($config);
        $data['pag_links'] = $this->pagination->create_links();

        $sql .= " order by B2B_ITEMS.id desc";
        if($mode == 'new'){
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

    function b2b_chn_get(){
        $this->chapi = $this->load->database('chapi', TRUE);

        $ITEM_CODE =$this->input->post('ITEM_CODE');
        $faccode =$this->input->post('faccode');

        $cgsql="SELECT ACCOUNT_ID FROM `B2B_ITEMS` WHERE faccode = '{$faccode}' and ITEM_CODE = '{$ITEM_CODE}'";
        $cgres=$this->chapi->query($cgsql);
        $ACCOUNT_ID_arr = array();
        foreach($cgres->result() as $cgrow):
            $ACCOUNT_ID_arr[] = $cgrow->ACCOUNT_ID;
        endforeach;
        echo json_encode($ACCOUNT_ID_arr);
    }

    function b2b_modify_notice(){
        $this->chapi = $this->load->database('chapi', TRUE);
        $id = $this->input->post('code');
        $modtext = addslashes( $this->input->post('modtext'));

        $ssql = "update cmsdb.B2B_ITEMS set
                notice ='{$modtext}'
                where id = {$id} limit 1";
        if($this->chapi->query($ssql)){
            echo "ok";
        }else{
            echo "err";
        }

    }

    function b2b_get_itemlist(){
        $this->chapi = $this->load->database('chapi', TRUE);
        $chnid = $this->input->post('chnid');

        $itemselect = "SELECT * FROM cmsdb.B2B_ITEMS WHERE ACCOUNT_ID = '{$chnid}' and edate >= curdate() and useyn = 'Y'";
        $data['pitem'] = $this->chapi->query($itemselect);
        $this->load->view('/b2b/b2b_itemlist',$data);
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

	function evcode() {

		$this->chapi = $this->load->database('chapi', TRUE);

		$total_rows = 0;
		$where = "";

		//세션에 limit 있는지
		$data['limit'] = $this->session->userdata('limit');
		if($data['limit'] != "" && $data['limit'] != null){
			$limit= $data['limit'];
		}else{
			$limit= "10";
		}

		//세션에 offset 있는지
		$data['offset'] = $this->session->userdata('offset');
		if($data['offset'] != "" && $data['offset'] != null){
			$offset= $data['offset'];
		}else{
			$offset= 0;
		}

		//세션에 선택한 코드가 있는지
		$data['searchcode'] = $this->session->userdata('searchcode');

		$sql = "SELECT * FROM B2B_CODES";
//        echo $sql;
		if($data['searchcode'] != "" && $data['searchcode'] != null){
           $sql .= " where ITEM_CODE='{$data['searchcode']}' ";
        }

        $query = $this->chapi->query($sql);

        $total_rows = $query -> num_rows();

        $this->load->library('pagination');
        $config['base_url'] = 'http://pcms.placem.co.kr/index.php/b2b/evcode_offset/';
        $config['total_rows'] =  $total_rows;
        $config['per_page'] = $limit;
        $config['cur_page'] = $offset;
        $config['uri_segment'] = 3;

        page_default_set($config);

        $this->pagination->initialize($config);
        $data['pag_links'] = $this->pagination->create_links();

        $sql .= " order by id desc limit $offset, $limit";

//        echo $sql;

		$query = $this->chapi->query($sql);

        $data['offset'] = $offset;
		$data['query'] = $query;
		$data['title'] = '판매/사용 관리';
        $data['contentview'] = 'b2b/evcode';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
		
	}

	function evcode_insert() {

		$this->load->model('chapimodel');

		$sort = $this->input->post('sort');
		$nation = $this->input->post('nation');
		$ITEM_CODE = $this->input->post('ITEM_CODE');
		$sdate = $this->input->post('sdate');
		$edate = $this->input->post('edate');

		if($this->chapimodel->B2B_CODES_insert($sort,$nation,$ITEM_CODE,$sdate,$edate)){
            echo "ok";
        }else{
            echo "등록에 실패했습니다.";
        }
		
	}

	function evcode_exceldown($mode,$sdate,$edate){
        ini_set('memory_limit', '2G' );
        ini_set('upload_max_filesize', '400M');
        ini_set('post_max_size', '400M');
        ini_set('max_input_time', 20000);
        ini_set('max_execution_time', 20000);

        $ip = $_SERVER["REMOTE_ADDR"];
        $damcd = $this->session->userdata('cd');
        if ($ip != "118.131.208.122"
            && $ip != "118.131.208.123"
            && $ip != "118.131.208.124"
            && $ip != "118.131.208.125"
            && $ip != "118.131.208.126"
            && $damcd != 'penfen'
            && $damcd != 'jjlee'
        ){
            exit;
        }else{
            $this->chapi = $this->load->database('chapi', TRUE);

//            $this->load->model('chapimodel');

            if($mode == "sell"){
                $mode = "o.date_order";
                $stateqry = " and e.state_use != 'C'";
            }else if($mode == "use"){
                $mode = "e.date_use";
                $stateqry = " and e.state_use = 'Y'";
            }else{
                exit;
            }

            $begin = new DateTime($sdate);
            $end = new DateTime($edate);

            $keyindex = 8;
            $excelindex = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z",
                "AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ");
            $getDateARR = array();
            $sumQuery = "";
            for($i = $begin; $i <= $end; $i->modify('+1 day')){
                $getDate = $i->format("Y-m-d");
                $sumQuery .= ", SUM(IF({$mode} like '{$getDate}%',1,0)) as '".str_replace("-","",$getDate)."'";
                $getDateARR[$keyindex++] = str_replace("-","",$getDate);
            }

            $sql = "SELECT 
                        c.sort,
                        c.nation,
                        c.ITEM_CODE,
                        e.sellcode,
                        e.order_id,
                        e.order_itemcode,
                        e.cus_nm,
                        count(e.no_coupon) as ecnt
                        {$sumQuery}
                    FROM cms_extcoupon e 
                    LEFT OUTER JOIN B2B_CODES c 
                        ON c.ITEM_CODE = e.order_itemcode
                    LEFT OUTER JOIN B2B_ORDERS o 
                        ON o.id = e.order_id
                    where e.sync_ext1 in ('BB','ELB2B','CBB2B') 
                        and ({$mode} > '{$sdate} 00:00:00' and {$mode} < '{$edate} 23:59:59')
                        and c.sort is not null
                        and c.useyn = 'Y'
                        {$stateqry}
                    group by e.order_itemcode,
                        e.cus_nm";

            $query = $this->chapi->query($sql);
//echo $sql;exit;

            if($query){

                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                //$this->excel->getActiveSheet()->setTitle($ITEM_NAME2);
                $this->excel->getActiveSheet()->setTitle("ORDEREXCEL");
                $cnt = 1;
                $this->excel->getActiveSheet()->setCellValue('A'.$cnt, "권종");
                $this->excel->getActiveSheet()->setCellValue('B'.$cnt, "국가");
                $this->excel->getActiveSheet()->setCellValue('C'.$cnt, "상품코드");
                $this->excel->getActiveSheet()->setCellValue('D'.$cnt, "판매코드");
                $this->excel->getActiveSheet()->setCellValue('E'.$cnt, "주문순번");
                $this->excel->getActiveSheet()->setCellValue('F'.$cnt, "주문상품코드");
                $this->excel->getActiveSheet()->setCellValue('G'.$cnt, "구매자");
                $this->excel->getActiveSheet()->setCellValue('H'.$cnt, "총수량");

                foreach ($getDateARR as $getDatekey => $getDatevalue):
                    $this->excel->getActiveSheet()->setCellValue($excelindex[$getDatekey].$cnt, $getDatevalue);
                endforeach;
                $cnt++;
                foreach($query->result_array() as $row):
                    $this->excel->getActiveSheet()->setCellValue('A'.$cnt, $row['sort']);
                    $this->excel->getActiveSheet()->setCellValue('B'.$cnt, $row['nation']);
                    $this->excel->getActiveSheet()->setCellValue('C'.$cnt, $row['ITEM_CODE']);
                    $this->excel->getActiveSheet()->setCellValue('D'.$cnt, $row['sellcode']);
                    $this->excel->getActiveSheet()->setCellValue('E'.$cnt, $row['order_id']);
                    $this->excel->getActiveSheet()->setCellValue('F'.$cnt, $row['order_itemcode']);
                    $this->excel->getActiveSheet()->setCellValue('G'.$cnt, $row['cus_nm']);
                    $this->excel->getActiveSheet()->setCellValue('H'.$cnt, $row['ecnt']);

                    foreach ($getDateARR as $getDatekey => $getDatevalue):

                        $this->excel->getActiveSheet()->setCellValue($excelindex[$getDatekey].$cnt, $row[$getDatevalue]);
                    endforeach;
                    $cnt++;
                endforeach;

                $filename= 'ORDEREXCEL.xls'; // 엑셀 파일 이름
                header('Content-Type: application/vnd.ms-excel'); //mime 타입
                header('Content-Disposition: attachment;filename="'.$filename.'"'); // 브라우저에서 받을 파일 이름
                header('Cache-Control: max-age=0'); //no cache

                // Excel5 포맷으로 저장 엑셀 2007 포맷으로 저장하고 싶은 경우 'Excel2007'로 변경합니다.
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

                // 서버에 파일을 쓰지 않고 바로 다운로드 받습니다.
                $objWriter->save('php://output');

            }

        }

    }

	//코드입력시 자동입력
	function codesett() {
		$this->load->model('chapimodel');
        $this->ITEM_CODE =$this->input->post('ITEM_CODE');

        $coderow = $this->chapimodel->get_code($this->ITEM_CODE);
        if($coderow != '0' && $coderow != false){
            echo $coderow->sort.";".$coderow->sdate.";".$coderow->edate;
        }else{
            echo "err";
        }
	}

	function yesORno() {
		$this->load->model('chapimodel');

		$id = $this->input->post('code');
    	$useyn = $this->input->post('useyn');

		if($this->chapimodel->code_use($id,$useyn)){
			echo "ok";
		}else{
			echo "err";
		}
		
	}

	//코드검색
	function code_sel($offset=0) {
		$searchcode = $this->input->post('searchcode');
		$data = array(
			'searchcode' => $searchcode,
			'offset' => $offset
		);
		$this->session->set_userdata($data);
		$this->evcode();
	}

	function evcode_limit() {
		$data['limit'] = $this->input->post('limit');
		$data['offset'] = 0;
		$this->session->set_userdata($data);
		$this->evcode();
	}

	function evcode_offset($offset = 0) {
		$data['offset'] = $offset;
        $this->session->set_userdata($data);
        $this->evcode();
		
	}






}


?>