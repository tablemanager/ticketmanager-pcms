<?php
class Cms2model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        //130번 DB 접속
        $this->cms2 = $this->load->database('cms2', TRUE);
}

    function get_last_ten_entries()
    {
        $query = $this->cms2->get('entries', 10);
        return $query->result();
    }

    function chk_naver_bizcode_duplicate($bizid = ''){
        $sql = "SELECT * FROM apidb.api_bizcode where bizid = '{$bizid}'";
        $query = $this->cms2->query($sql);
        $total = $query -> num_rows();
        if($total > 0){
            return false;
        }else{
            return true;
        }
    }

    function chk_naver_item_duplicate($itemid = ''){
        $sql = "SELECT * FROM apidb.api_item where itemid = '{$itemid}'";
        $query = $this->cms2->query($sql);
        $total = $query -> num_rows();
        if($total > 0){
            return false;
        }else{
            return true;
        }
    }

    function naver_bizcode_insert($bizid = '',$bizname = ''){

        $regdate = date("Y-m-d H:i:s");
        $data = array(
            'bizid' => $bizid,
            'bizname' => $bizname,
            'regdate' => $regdate
        );
        if($this->cms2->insert('api_bizcode', $data)){
            return true;
        }else{
            return false;
        }
    }

    function naver_item_insert($itemid = '',$itemnm = '' , $selltype = '', $sellcode = '', $sellseed='',$expdate=''){

        $regdate = date("Y-m-d H:i:s");
        $data = array(
            'itemid' => $itemid,
            'itemnm' => $itemnm,
            'selltype' => $selltype,
            'sellcode' => $sellcode,
            'sellseed' => $sellseed,
            'regdate' => $regdate,
            'expdate'=> $expdate
        );
        if($this->cms2->insert('api_item', $data)){
            return true;
        }else{
            return false;
        }
    }


}
?>