<?php
/**
 * Created by PhpStorm.
 * User: MINO
 * Date: 2016-11-22
 * Time: 오후 4:46
 */
class Chapimodel extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        //해외 서버 DB 접속
        $this->chapi = $this->load->database('chapi', TRUE);
    }

    function get_last_ten_entries()
    {
        $this->chapi = $this->load->database('sparo2', TRUE);
        $query = $this->chapi->get('entries', 10);
        return $query->result();
    }


    function chk_B2B_ACCOUNT_duplicate_cd($cd = ''){
        $sql = "select * from cmsdb.B2B_ACCOUNT where cd = '{$cd}'";
        $query = $this->chapi->query($sql);
        $total = $query -> num_rows();
        if($total > 0){
            return false;
        }else{
            return true;
        }
    }


    function B2B_ACCOUNT_insert($cd = ''){

        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $data = array(
            'cd' => $cd,
            'pass' => $randomString,
            'company' => $cd,
            'tel' => '000-0000-0000',
            'email' => '@',
            'visible' => '1'
        );
        if($this->chapi->insert('B2B_ACCOUNT', $data)){
            return true;
        }else{
            return false;
        }

    }

    function B2B_ACCOUNT_mode_pass( $id, $pass){

        $data = array(
            'pass' => $pass
        );
        $this->chapi->where('id', $id);
        if($this->chapi->update('B2B_ACCOUNT', $data)){
            return "ok";
        }else{
            return "err";
        }
    }

    function B2B_ACCOUNT_mode_pay( $id, $pay_k, $pay_v){

        $data = array(
            $pay_k => $pay_v
        );
        $this->chapi->where('id', $id);
        if($this->chapi->update('B2B_ACCOUNT', $data)){
            return "ok";
        }else{
            return "err";
        }
    }

    function B2B_ITEMS_mode_pay( $id, $pay_k, $pay_v){

        $data = array(
            $pay_k => $pay_v
        );
        $this->chapi->where('id', $id);
        if($this->chapi->update('B2B_ITEMS', $data)){
            return "ok";
        }else{
            return "err";
        }
    }

    function B2B_ITEMS_update_nm($wherelang,$whereid,$setnm){

        $data = array(
            $wherelang => $setnm
        );
        $this->chapi->where('id', $whereid);
        if($this->chapi->update('B2B_ITEMS', $data)){
            return "ok";
        }else{
            return "err";
        }
    }

    function select_B2B_ITEMS_code($ITEM_CODE = 0,$faccode=''){
        $sql = "SELECT * FROM cmsdb.B2B_ITEMS where ITEM_CODE = '{$ITEM_CODE}' AND faccode = '{$faccode}' ORDER BY id desc limit 1";
        $query = $this->chapi->query($sql);
        $total = $query -> num_rows();
        if($total > 0){
            return $query->row(); // row넘김
        }else{
            return "0";
        }
    }

    function B2B_NOTICE_insert(
        $title,$title_english,$title_china_simplified,$title_china_traditional,
        $content,$content_english,$content_china_simplified,$content_china_traditional){
        $created = date("Y-m-d");
        $data = array(
            'created'=>$created,
            'title'=>$title,
            'title_english'=>$title_english,
            'title_china_simplified'=>$title_china_simplified,
            'title_china_traditional'=>$title_china_traditional,
            'content'=>$content,
            'content_english'=>$content_english,
            'content_china_simplified'=>$content_china_simplified,
            'content_china_traditional'=>$content_china_traditional
        );
        if($this->chapi->insert('B2B_NOTICE', $data)){
            return true;
        }else{
            return false;
        }
    }

    function B2B_ITEMS_insert($ACCOUNT_ID='',$ITEM_CODE='',$nm='',$jung_price='',$sell_price='',$sdate='',$edate='',$faccode='',$noticemsg='',$nm_english='',$nm_china_simplified='',$nm_china_traditional=''){
        $data = array(
            'nm' => 	$nm,
            'nm_english' => 	$nm_english,
            'nm_china_simplified' => 	$nm_china_simplified,
            'nm_china_traditional' => 	$nm_china_traditional,
            'ACCOUNT_ID' => $ACCOUNT_ID,
            'ITEM_CODE' => $ITEM_CODE,
            'sell_price' => $sell_price,
            'jung_price' => $jung_price,
            'qty' => 0,
            'useyn' => 'Y',
            'sdate' => 	$sdate,
            'edate' => $edate,
            'faccode' => $faccode
        );

        if($noticemsg != null && $noticemsg != "")$data['notice'] = $noticemsg;

        if($this->chapi->insert('B2B_ITEMS', $data)){
            return true;
        }else{
            return false;
        }
    }

    function B2B_ITEMS_insert_packgae($nm='',$ACCOUNT_ID=0,$PKG_CODE1=0,$PKG_CODE2=0,$jung_price=0,$sell_price=0,$sdate='',$edate='',$faccode='',$nm_english='',$nm_china_simplified='',$nm_china_traditional=''){
        $data = array(
            'nm' => 	$nm,
            'nm_english' => 	$nm_english,
            'nm_china_simplified' => 	$nm_china_simplified,
            'nm_china_traditional' => 	$nm_china_traditional,
            'ACCOUNT_ID' => $ACCOUNT_ID,
            'ITEM_CODE' => $ACCOUNT_ID,
            'PKG_CODE1' => $PKG_CODE1,
            'PKG_CODE2' => $PKG_CODE2,
            'sell_price' => $sell_price,
            'jung_price' => $jung_price,
            'qty' => 0,
            'useyn' => 'Y',
            'sdate' => 	$sdate,
            'edate' => $edate,
            'faccode' => $faccode
        );
        if($this->chapi->insert('B2B_ITEMS', $data)){
            return true;
        }else{
            return false;
        }
    }

    function b2b_notice_use($id,$visible){

        $data = array(
            'visible' => $visible
        );
        $this->chapi->where('id', $id);
        if($this->chapi->update('B2B_NOTICE', $data)){
            return "ok";
        }else{
            return "err";
        }
    }

    function b2b_item_use($id= '',$useyn= ''){
        $data = array(
            'useyn' => $useyn
        );
        $this->chapi->where('id', $id);
        if($this->chapi->update('B2B_ITEMS', $data)){
            return "ok";
        }else{
            return "err";
        }
    }

    function update_B2B_ORDERS_cancel($id = 0){
        $sql = "update cmsdb.B2B_ORDERS set STATE = 'C'  where id = {$id} and STATE != 'C' limit 1";
        return $this->chapi->query($sql);
    }

    function update_cms_extcoupon_cancel($no_coupon = 0){
        $sql = "update cmsdb.cms_extcoupon set syncfac_result = 'C'  where no_coupon = '{$no_coupon}' and syncfac_result != 'C' limit 1";
        return $this->chapi->query($sql);
    }

    function get_cms_extcoupon($no_coupon = 0){

        if($no_coupon !== 0 && $no_coupon !== null){
            $sql = "SELECT * FROM cmsdb.cms_extcoupon WHERE no_coupon = '{$no_coupon}' limit 1";
            $query = $this->chapi->query($sql);
            return $query->row();
        }
    }


    //이마트피자 gu (소셜)
    function bar_emartcode_get_gu($chn=''){
        $gu = 0;
        if($chn != '' && $chn != null)
            $getgu_sql = "SELECT * FROM spadb.bar_emartcode WHERE chn = '{$chn}' order by gu desc limit 1";
        $query = $this->chapi->query( $getgu_sql);
        $total = $query -> num_rows();
        if($total > 0){
            $row = $query->row();

            $num = preg_replace("/[^0-9]*/s", "", $row->gu);
            $num = $num+1;
            $gu = substr($chn, 0, 1);
            $gu = $gu.$num;

        }
        return $gu;
    }



    //


    //
    function get_bar_emart($sellcode='' , $gu=''){
        $sql = "select * from spadb.bar_emart where sellcode = '{$sellcode}' and gu = '{$gu}'";
        $query = $this->chapi->query($sql);
        $total = $query -> num_rows();
        if($total > 0){
            return $query;
        }else{
            return "0";
        }
    }

	function B2B_CODES_insert($sort='', $nation='', $ITEM_CODE='', $sdate='', $edate='') {
//echo "B2B_CODES_insert";
		$data = array(
			'sort' => $sort,
			'nation' => $nation,
			'ITEM_CODE' => $ITEM_CODE,
			'sdate' => $sdate,
			'edate' => $edate
		);

		if($this->chapi->insert('B2B_CODES', $data)){
			return true;
		}else{
			return false;
		}
		
	}

	//코드입력시 자동완성
	function get_code($ITEM_CODE='') {
		$sql = "SELECT * FROM B2B_CODES where ITEM_CODE = '{$ITEM_CODE}' ORDER BY id desc limit 1";
        $query = $this->chapi->query($sql);
        $total = $query -> num_rows();
        if($total > 0){
            return $query->row(); // row넘김
        }else{
            return "0";
        }
	}

	function code_use($id='', $useyn='') {
		$data = array(
            'useyn' => $useyn
        );
        $this->chapi->where('id', $id);
        if($this->chapi->update('B2B_CODES', $data)){
            return true;
        }else{
            return false;
        }
	}



}
?>