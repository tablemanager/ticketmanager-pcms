<?php 
class Smsmodel extends CI_Model {

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
        $this->BGFSMS2 = $this->load->database('BGFSMS2', TRUE);
	}

    function smsmsg($hp,$msg='',$subject=''){

        // 20230221 tony https://placem.atlassian.net/browse/PM2201AF-284 [젬텍]과학기술정보통신부 고시개정에 따른 젬텍 연동규격 변경 관련 요청
        $data = array(
            //'msg_type'=>'1',
            'msg_type'=>'S',
            'dstaddr' => $hp,
            'callback' => '02-2156-3080',
            'subject' =>$subject,
            'stat' =>'0',
            'text' =>$msg,
            'request_time' => date("Y-m-d H:i:s",time()),
            'opt_id ' => 'PCMS2',
            'ext_col1 ' => $_SERVER['SCRIPT_FILENAME']
        );
        if($this->BGFSMS2->insert('msg_queue', $data)){
            return true;
        }else{
            return false;
        }
    }
}
?>
