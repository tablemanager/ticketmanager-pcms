<?php
class Nsparomodel extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        //뉴스파로 DB
        $this->sparo2 = $this->load->database('sparo2', TRUE);
    }

    function get_last_ten_entries()
    {
        $this->sparo2 = $this->load->database('sparo2', TRUE);
        $query = $this->sparo2->get('entries', 10);
        return $query->result();
    }

    //이마트피자 gu (소셜)
    function bar_emartcode_get_gu($chn=''){
        $gu = 0;
        if($chn != '' && $chn != null)
            $getgu_sql = "SELECT * FROM spadb.bar_emartcode WHERE chn = '{$chn}' order by gu desc limit 1";
        $query = $this->sparo2->query( $getgu_sql);
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

    //이마트피자 코드 입력
    function bar_emartcode_insert(
            $sellcode = '' ,$gu = '' , $pcmsid ='' , $chn ='' , $sort ='' ,$qty='', $selldate ='' ,
            $bigo ='' , $lineup ='' , $add_img = '' , $mms_text ='' , $mms_state ='' , $useyn ='' , $logtxt =''){
        $selldate = date("Y-m-d 23:59:59",strtotime ($selldate));
        $created = date("Y-m-d H:i:s");

        $data = array(
            'created' => $created,
            'sellcode' => $sellcode,
            'gu' => $gu,
            'pcmsid' => $pcmsid,
            'chn' => $chn,
            'sort' => $sort,
            'qty' => $qty,
            'selldate' => $selldate,
            'bigo' => $bigo,
            'lineup' => $lineup,
            'add_img' => $add_img,
            'mms_text' => $mms_text,
            'mms_state' => $mms_state,
            'useyn' => $useyn,
            'logtxt' => $logtxt

        );
        if($this->sparo2->insert('bar_emartcode', $data)){
            return true;
        }else{
            return false;
        }

    }

    //
    function get_bar_emartcode($id = 0){
        $sql = "select * from spadb.bar_emartcode where id = '".$id."' limit 1";
        $query = $this->sparo2->query($sql);
        $total = $query -> num_rows();
        if($total > 0){
            return $query->row();
        }else{
            return "0";
        }
    }

    function get_nexonCoupon_id($id = 0){
        $sql = "select * from spadb.nexon_coupons where id = '{$id}' limit 1";
        $query = $this->sparo2->query($sql);
        $total = $query -> num_rows();
        if($total > 0){
            return $query->row();
        }else{
            return false;
        }
    }

    function updateNexonCouponCancelResult($id,$state,$apires){
        if($id && $apires){
/*
CancelResultCode	int(11)			예	NULL	취소 결과코드 (0-성공)
CancelResultMessage	varchar(100)	utf8mb4_general_ci		예	NULL	취소 결과 성공이 아닐 경우 오류 사유
CancelApprovalNo	int(11)			예	NULL	취소 승인번호
CancelApprovalDateTime	datetime			예	NULL	취소 승인 날짜
  */
            $sql = "update spadb.nexon_coupons set 
                 state = '{$state}',
                 CancelResultCode = '{$apires->ResultCode}',
                 CancelResultMessage = '{$apires->ResultMessage}',
                 CancelApprovalNo = '{$apires->ApprovalNo}',
                 CancelApprovalDateTime = '{$apires->ApprovalDateTime}'
                 where id='{$id}' limit 1";
            $query = $this->sparo2->query($sql);
            return $query;
        }else{
            return false;
        }
    }

    function get_pcms_extcoupon($couponno = ''){

        if($couponno !== 0 && $couponno !== null){
            $sql = "SELECT * FROM spadb.pcms_extcoupon WHERE couponno LIKE '{$couponno}' limit 1";
            $query = $this->sparo2->query($sql);
            return $query->row();
        }
    }

    //
    function get_bar_emart($sellcode='' , $gu=''){
        $sql = "select * from spadb.bar_emart where sellcode = '{$sellcode}' and gu = '{$gu}'";
        $query = $this->sparo2->query($sql);
        $total = $query -> num_rows();
        if($total > 0){
            return $query;
        }else{
            return "0";
        }
    }

    function get_bar_emart_use($sellcode='' , $gu=''){
        $sql = "select * from spadb.bar_emart where sellcode = '{$sellcode}' and gu = '{$gu}' and useyn = 'Y'";
        $sql = "select bar_emart.*,cmsusers.nm  from spadb.bar_emart left join cmsusers on bar_emart.enc_no = cmsusers.cd where bar_emart.sellcode = '{$sellcode}' and bar_emart.gu = '{$gu}' and useyn = 'Y'";

        $query = $this->sparo2->query($sql);
        $total = $query -> num_rows();
        return $query;
        /*if($total > 0){
            return $query;
        }else{
            return "0";
        }*/
    }

    function smsgu($id,$smsgu){
        if($id && $smsgu){
            $sql = "update spadb.ordermts set smsgu = '{$smsgu}' where id = '{$id}' limit 1";
            $query = $this->sparo2->query($sql);
            return $query;
        }else{
            return false;
        }
    }

    function insertOrdermts($array){
        return $this->sparo2->insert('ordermts', $array);
    }

    function insertOrderExcel($array){
        return $this->sparo2->insert('ordermts_excel', $array);
    }

    function get_OrderExcel(){
        $sql = "select * from spadb.ordermts_excel where created > current_date() - interval 60 day ";
        $query = $this->sparo2->query($sql);
        $total = $query -> num_rows();
        if($total > 0){
            return $query;
        }else{
            return false;
        }
    }

    function get_OrderExcel_id($id){
        $sql = "select * from spadb.ordermts_excel where id = {$id} limit 1 ";
        $query = $this->sparo2->query($sql);
        $total = $query -> num_rows();
        if($total > 0){
            return $query->row();
        }else{
            return "0";
        }
    }

    function itemcode_useCount($sellcode){
        $sql = "select * from spadb.crowling_set where sellcode = '{$sellcode}' and useyn = 'Y'  limit 1";
        $query = $this->sparo2->query($sql);
        return $query -> num_rows();
    }

    function crowling_set_add($input_data){

        return $this->sparo2->insert('crowling_set', $input_data);
    }

    function crowling_useyn($id= '',$useyn= ''){
        $data = array(
            'useyn' => $useyn
        );
        $this->sparo2->where('id', $id);
        if($this->sparo2->update('crowling_set', $data)){
            return "ok";
        }else{
            return "err";
        }

    }

    function get_toast_sellcode(){
        $sellcode = 0;
        $getsellcode_sql = "SELECT sellcode FROM spadb.toast_lms WHERE 1 order by sellcode desc limit 1";
        $getsellcode_row = $this->sparo2->query($getsellcode_sql)->row();
        if($getsellcode_row->sellcode != "" && $getsellcode_row->sellcode != null){
            $sellcode = $getsellcode_row->sellcode + 1;
        }
        return $sellcode;
    }

    function toast_lms_pcmsid_disable($pcmsitem_id){
        $sql = "UPDATE spadb.toast_lms set useyn='N' WHERE pcms_id = '{$pcmsitem_id}'";
        $this->sparo2->query($sql);
        return 0;
    }

    function toast_lms_pcmsid_check($pcmsitem_id){
        $this->sparo2->where('pcms_id', $pcmsitem_id);
        $this->sparo2->where('useyn', 'Y');
        $this->sparo2->where('edate >', date("Y-m-d H:i:s"));
        $this->sparo2->from('toast_lms');
        return $this->sparo2->count_all_results();
    }

    function chk_phoenix_pkg_itemid($itemid = ''){
        $sql = "SELECT * FROM spadb.phoenix_pkglist where item_id = '{$itemid}'";
        $query = $this->sparo2->query($sql);
        $total = $query -> num_rows();
        if($total > 0){
            return false;
        }else{
            return true;
        }
    }

}
?>