<?php
/**
 * Created by PhpStorm.
 * User: MINO
 * Date: 2016-11-22
 * Time: 오후 3:47
 */


class Sync extends CI_Controller {

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

    function naver_bizcode($offset=0){
        $this->cms2 = $this->load->database('cms2', TRUE);

        $sql = "SELECT * FROM apidb.api_bizcode  ORDER  BY  id desc";

        $query = $this->cms2->query($sql);


        $total_rows = $query -> num_rows();
        $limit = 20;

        $this->load->library('pagination');
        $config['base_url'] = 'http://pcms.placem.co.kr/index.php/sync/naver_bizcode/';
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

        $query = $this->cms2->query($sql);

        $data['query'] = $query;
        $data['title'] = '네이버 시설 연동 관리';

        $data['leftview'] = 'left';
        $data['contentview'] = '/sync/naver_bizcode';
        $this->load->view('/inc/layout',$data);
    }



    function naver_bizcode_add(){
        //$this->cms2 = $this->load->database('cms2', TRUE);
        $this->load->model('cms2model');
        $this->bizid =$this->input->post('bizid');
        $this->bizname =$this->input->post('bizname');

        //중복체크
        if($this->cms2model->chk_naver_bizcode_duplicate($this->bizid)){
            //echo $this->bizid." 사용 가능";
            if($this->cms2model->naver_bizcode_insert($this->bizid,$this->bizname)){
                echo "ok";
            }else{
                echo "등록실패";
            }
        }else{
            echo $this->bizid." : 이미 등록된 시설번호 입니다.";
        }
    }

	function naver_bizcode_del() {
        $this->cms2 = $this->load->database('cms2', TRUE);

		$id =$this->input->post('delid');

		$dsql = "SELECT * FROM apidb.api_bizcode WHERE id = '{$id}'";
		$drow = $this->cms2->query($dsql)->row();
        $del_encode = json_encode($drow);

		$gp = 'api_bizcode';
		$mode = 'D'; //지웠다
		$qrystr = $del_encode; //삭제한 데이터의 json인코딩 데이터
		$regdate = date("Y-m-d H:i:s");
        $damnm = $this->session->userdata('nm');
		$damcd = $this->session->userdata('cd');
		$ip = $_SERVER['REMOTE_ADDR'];
		
		$bigo = $damcd."\n/".date("Y-m-d H:i:s")." ".$damnm."주문상태변경:".$mode;

		$data = array(
			'gp' => $gp,
			'mode' => $mode,
			'qrystr' => $qrystr,
			'regdate' => $regdate,
			'bigo' => $bigo,
			'ip' => $ip
		);
		if($this->db->insert('log_apidb', $data)){
			if($this->cms2->delete('api_bizcode', array('id' => $id))){
				echo "ok";
			}
		}else{
			echo "errrrr";
		}
	}

    function naver_item($offset=0){
        $this->cms2 = $this->load->database('cms2', TRUE);

        $sql = "SELECT * FROM apidb.api_item  ORDER  BY  id desc";

        $query = $this->cms2->query($sql);


        $total_rows = $query -> num_rows();
        $limit = 20;

        $this->load->library('pagination');
        $config['base_url'] = 'http://pcms.placem.co.kr/index.php/sync/naver_item/';
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

        $query = $this->cms2->query($sql);

        $data['selltypes'] = array(''=>'일반', 'qrcode'=>'QR코드', 'barcode'=>'바코드');

        $data['query'] = $query;
        $data['title'] = '네이버 판매 연동 관리';

        $data['leftview'] = 'left';
        $data['contentview'] = '/sync/naver_item';
        $this->load->view('/inc/layout',$data);
    }

    function naver_item_add(){
        $this->load->model('cms2model');
        $itemid =$this->input->post('itemid');
        $itemnm =$this->input->post('itemnm');
        $selltype =$this->input->post('selltype');
        $sellcode =$this->input->post('sellcode');
        $sellseed =$this->input->post('sellseed');
        $expdate =$this->input->post('expdate');
        

        //중복체크
        if($this->cms2model->chk_naver_item_duplicate($itemid)){
            //echo $this->bizid." 사용 가능";
            if($this->cms2model->naver_item_insert($itemid,$itemnm, $selltype, $sellcode,$sellseed,$expdate)){
                echo "ok";
            }else{
                echo "등록실패";
            }
        }else{
            echo $itemid." : 이미 등록된 판매(딜) 입니다.";
        }
    }

	function naver_item_del() {
		$this->cms2 = $this->load->database('cms2', TRUE);

		$id =$this->input->post('delid');

		$selsql = "SELECT * FROM apidb.api_item WHERE id = '{$id}'";
		$selrow = $this->cms2->query($selsql)->row();
        $delitem_encode = json_encode($selrow);

		$gp = 'api_item';
		$mode = 'D'; //지웠다
		$qrystr = $delitem_encode; //삭제한 데이터의 json인코딩 데이터
		$regdate = date("Y-m-d H:i:s");
        $damnm = $this->session->userdata('nm');
		$damcd = $this->session->userdata('cd');
		$ip = $_SERVER['REMOTE_ADDR'];
		
		$bigo = $damcd."\n/".date("Y-m-d H:i:s")." ".$damnm." 삭제기록";

		$data = array(
			'gp' => $gp,
			'mode' => $mode,
			'qrystr' => $qrystr,
			'regdate' => $regdate,
			'bigo' => $bigo,
			'ip' => $ip
		);
		if($this->db->insert('log_apidb', $data)){
			if($this->cms2->delete('api_item', array('id' => $id))){
				echo "ok";
			}
		}else{
			echo "errrrr";
		}

	}

    function naver_item_date(){
        $this->cms2 = $this->load->database('cms2', TRUE);

        $id = $this->input->post('code');
        $date = $this->input->post('date');
        $what = $this->input->post('what');

        $expdate = date("Ymd",strtotime ($date));

        $selsql = "SELECT * FROM apidb.api_item WHERE id = '{$id}'";
        $selrow = $this->cms2->query($selsql)->row();
        $udate_encode = json_encode($selrow);

        $gp = 'api_item';
        $mode = 'U'; //수정했다
        $qrystr = $udate_encode; //수정한 이용일의 json인코딩 데이터
        $regdate = date("Y-m-d H:i:s");
        $damnm = $this->session->userdata('nm');
        $damcd = $this->session->userdata('cd');
        $ip = $_SERVER['REMOTE_ADDR'];

        $bigo = $damcd."\n/".date("Y-m-d H:i:s")." ".$damnm." 이용일수정";

        $logdata = array(
            'gp' => $gp,
            'mode' => $mode,
            'qrystr' => $qrystr,
            'regdate' => $regdate,
            'bigo' => $bigo,
            'ip' => $ip
        );
        $data = array(
            $what => $expdate
        );
        $this->cms2->where('id', $id);

//        print_r($data);

        if(!($this->cms2->update('api_item', $data) && $this->db->insert('log_apidb', $logdata))){
            echo "err";
        }else{
            echo "ok";
        }

    }

    function phoenix_items($offset=0){

        $sql = "SELECT * FROM pcmsdb.phoenix_items where state = 'Y' ORDER BY `phoenix_items`.`id` DESC";

        $query = $this->db->query($sql);


        $total_rows = $query -> num_rows();
        $limit = 20;

        $this->load->library('pagination');
        $config['base_url'] = 'http://pcms.placem.co.kr/index.php/sync/phoenix_items/';
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
        $data['title'] = '휘닉스파크 연동 & 문자 관리';

        $data['leftview'] = 'left';
        $data['contentview'] = '/sync/phoenix_items';
        $this->load->view('/inc/layout',$data);
    }

    function phoenix_items_add(){
        $this->load->model('cmsmodel');

        $selltype = trim($this->input->post('selltype'));
        $item_id = trim($this->input->post('item_id'));
        $ITEMNAME = trim($this->input->post('ITEMNAME'));
        $amt = trim($this->input->post('amt'));
        $selldate = trim($this->input->post('selldate'));
        $bgimg = trim($this->input->post('bgimg'));
        $synctype = trim($this->input->post('synctype'));
        $prifix = trim($this->input->post('prifix'));
        $typecd = trim($this->input->post('typecd'));
        $seasoncd = trim($this->input->post('seasoncd'));
        $tcode = trim($this->input->post('tcode'));
        $typecode = trim($this->input->post('typecode'));
        $man1 = trim($this->input->post('man1'));
        $man2 = trim($this->input->post('man2'));
        $man3 = trim($this->input->post('man3'));
        $man4 = trim($this->input->post('man4'));
        $man5 = trim($this->input->post('man5'));
        $man6 = trim($this->input->post('man6'));
        $msg = trim($this->input->post('msg'));

        if($synctype == 'SIN'){
            $tcode = '';
            $typecode = '';
        }else if($synctype == 'SET'){
            $typecd = '';
            $seasoncd = '';
            $man2 = 0;
            $man3 = 0;
            $man4 = 0;
            $man5 = 0;
            $man6 = 0;
        }

        //echo "$item_id , $ITEMNAME , $amt , $selldate , $bgimg , $synctype , $prifix , $typecd , $seasoncd , $tcode , $typecode , $man1 , $man2 , $man3 , $man4 , $man5 , $man6 ";

        //중복체크
        if($this->cmsmodel->chk_phoenix_items_duplicate($item_id)){
            if($this->cmsmodel->phoenix_items_insert($selltype,$item_id,$ITEMNAME,$amt,$selldate,$bgimg,$synctype,$prifix,$typecd,$seasoncd,$tcode,$typecode,$man1,$man2,$man3,$man4,$man5,$man6,$msg)){
                echo "ok";
            }else{
                echo "등록실패";
            }
        }else{
            echo $item_id." : 이미 등록된 판매(딜) 입니다.";
        }
    }

    function phoenix_items_use(){
        $this->load->model('cmsmodel');
        $this->id = $this->input->post('code');
        $this->state = $this->input->post('use_state');
        echo $this->cmsmodel->phoenix_items_use($this->id,$this->state);
    }

    function phoenix_items_mms(){
        $this->id = $this->input->post('flag');
        $this->msg = $this->input->post('mmstext');


        $data = array(
            'msg' => $this->msg,
        );

        $this->db->where('id', $this->id);
        if(!$this->db->update('phoenix_items', $data)){
            echo "err";
        }else{
            echo site_url('sync/phoenix_items');
        }
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