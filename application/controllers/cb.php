<?php 

class Cb extends CI_Controller { 

	function __construct() {
		parent::__construct();

	} 
	
	function index($no='0'){

//	 	$this->db = $this->load->database('cms', TRUE);

		$ip = $_SERVER['REMOTE_ADDR'];
		if ($ip == '118.131.208.124') $this->output->enable_profiler(TRUE); //디버깅용 

		$clens=strlen($no);
		
		switch($clens){
			case '8':
				// 티켓몬스터 
				$ch_id = "T";
			break;
			case '15':
				// 플레이스엠(오픈마켓)
				$ch_id = "P";
			break;
			default:
				echo "고객센터로 문의바랍니다.";
				exit;
			break;
			
		}
			$sql = "SELECT * FROM CMSDB.CMS_ECOUPON_".$ch_id." where curl_id ='$no' limit 1";
			$row = $this->db->query($sql)->row();

			$qrimg = "./img/".$no.".jpg";
			$itemid = $row->order_itemcode;
			$curl_id = $row->curl_id;
			$imgurl = "";

			$bnsql = "select * from pcmsdb.kit_lms where pcms_id = '$itemid' and sellcode like '".$ch_id."%' limit 1";
			$bnrow = $this->db->query($bnsql)->row();
			
			$sync_data = $bnrow->mms_text;
			$msg = nl2br($sync_data);

				// HTML 생성
			$chtml ="<!DOCTYPE html><html lang='ko'><head><meta charset='utf-8' /><meta name='viewport' content='user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width' /><meta name='apple-mobile-web-app-capable' content='no' /><meta name='apple-mobile-web-app-status-bar-style' content='black-translucent' /><meta name='robots' content='noindex,nofollow' /><meta name='googlebot' content='noindex' /><title>{title}</title></HEAD><center><span id='times'></span><table border = 0 width=400><tr><td align=center><img src = '{qrimg}'></td></tr><tr><td>{contents}</td></tr></table><script>function times() {  now = new Date();  year = now.getFullYear(); month = now.getMonth()+1; date = now.getDate(); hour = now.getHours(); min = now.getMinutes();      sec = now.getSeconds(); document.getElementById('times').innerHTML = year+'/'+month+'/'+date+' '+hour+':'+min+':'+ sec;      }  window.onload = function(){ setInterval(function(){ times(); }, 1000); }; </script>";

//			$qrimg = "./img/".$cfile.".jpg";
			$chtml = str_replace("{title}",$bnrow->itemnm,$chtml); // 타이틀
			$chtml = str_replace("{qrimg}", $qrimg ,$chtml); // 바코드, QR 이미지 
			$chtml = str_replace("{contents}", $msg,$chtml); // 문자 내용
			$data = $chtml;
		
			iconv("UTF-8","EUC-KR",$chtml);

			switch($row->state_use){
				case 'Y':
				break;
				case 'C':
					$imgurl = "http://sparo.kr/e/high1_cancel.jpg";
				break;
				default:
					$imgurl = "http://sparo.kr/e/".$itemid."/img/".$no.".jpg";
			}

			$data = str_replace($qrimg, $imgurl,$data); 


			echo $data;

	}

} //CI_Controller


?>