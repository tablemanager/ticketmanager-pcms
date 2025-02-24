<?php
class Pcmsmodel extends CI_Model {

	var $title   = '';
	var $content = '';
	var $date    = '';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function get_last_ten_entries()
	{
		$this->pcms = $this->load->database('pcms', TRUE);
		$query = $this->pcms->get('entries', 10);
		return $query->result();
	}

	function get_pcms_itemnm_bak($pcmsid = ''){
		$this->pcms = $this->load->database('pcms', TRUE);
		$resultmsg = "error";

		$this->pcmsitem_id = $pcmsid;
		if($this->pcmsitem_id == ''){
			$resultmsg = "PCMS 상품번호를 입력하세요.";
		}else if($this->pcmsitem_id != 0 && $this->pcmsitem_id != null){
			$sql = "select * from itemmts where id = '".$this->pcmsitem_id."' limit 1";
			$query = $this->pcms->query($sql);
			$total = $query -> num_rows();
			if($total < 1){
				$resultmsg = "조회할수 없는 번호입니다.";
			}else{
				$row = $query->row(); // row넘김
				$resultmsg = $row->nm;
			}
		}else{
			$resultmsg = "조회할수 없는 번호입니다.";
		}
		return $resultmsg;
	}

    function get_pcms_itemnm($pcmsid = ''){
        $this->cms = $this->load->database('cms', TRUE);
        $resultmsg = "error";

        $this->pcmsitem_id = $pcmsid;
        if($this->pcmsitem_id == ''){
            $resultmsg = "PCMS 상품번호를 입력하세요.";
        }else if($this->pcmsitem_id != 0 && $this->pcmsitem_id != null){
            $sql = "select * from CMS_ITEMS where item_id = '".$this->pcmsitem_id."' limit 1";
            $query = $this->cms->query($sql);
            $total = $query -> num_rows();
            if($total < 1){
                $resultmsg = "조회할수 없는 번호입니다.";
            }else{
                $row = $query->row(); // row넘김
                $resultmsg = $row->item_nm;
            }
        }else{
            $resultmsg = "조회할수 없는 번호입니다.";
        }
        return $resultmsg;
    }

	function get_pcms_order($pcmsid = ''){
		$this->pcms = $this->load->database('pcms', TRUE);

		if($pcmsid != 0 && $pcmsid != null){
			$sql = "select * from terp_placem.ordermts where id = '".$pcmsid."' limit 1";
			$query = $this->pcms->query($sql);
			return $query->row();
		}
	}

    function get_phoenix_items($item_id=0){
        $sql = "SELECT * FROM pcmsdb.phoenix_items WHERE item_id = '{$item_id}' and state = 'Y' and selldate >= CURDATE() ORDER BY id DESC limit 1";	//해당상품 아이디로 쿠폰이력 체크
        return $this->db->query($sql)->row();
    }

	function get_seed($ctype='',$chgu='',$sellno='',$pcmsitem_id=''){

		$seed = 1; //기본 시작값

		//지류권일 경우
		if($ctype == 'PM' && $pcmsitem_id != ''){ //지류권이면 추가 생성인지 먼저 체크(기존 생성 건)
			$addseed_sql = "SELECT * FROM cms_coupon WHERE ctype = '$ctype' and chgu = '$chgu' and items_id = '$pcmsitem_id' order by seed desc limit 1";	//해당상품 아이디로 쿠폰이력 체크
			$addseedQry = $this->db->query($addseed_sql);
			$addseedCnt = $addseedQry -> num_rows();
			if($addseedCnt > 0){	//조회 결과 있으면 추가 발급
				$addseed_row =$addseedQry->row();
				if($addseed_row->seed != "" && $addseed_row->seed != null){
					$seed = $addseed_row->seed;
					$schar = 'A';
					$start = true;
					while($start){
						$ccode = $chgu."P".$seed.$schar;
						$ccode_sql = "SELECT * FROM cms_coupon WHERE ccode = '$ccode'";	//해당상품 아이디로 쿠폰이력 체크
						$ccodeQry = $this->db->query($ccode_sql);
						$ccodeCnt = $ccodeQry -> num_rows();
						if($ccodeCnt == 0){
							//echo "신규";
							$start = false;
						}else{
							//echo "중복";
							++$schar;	//중복값 있으면 증가
						}
					}
					$seed = $seed.$schar;	//중복값 없으면 값 저장
				}//seed예외처리
			}else{//신규 발급
				$where = "chgu = '$chgu' and ctype = '$ctype' ";
				$getseed_sql = "SELECT seed FROM `cms_coupon` WHERE $where order by seed desc limit 1";
				$getseed_row = $this->db->query($getseed_sql)->row();
				if($getseed_row->seed != "" && $getseed_row->seed != null){
					$seed = $getseed_row->seed + 1;
				}
			}
		}else{
			$where = "chgu = '$chgu'";
			if($ctype == "FR" or $ctype == "HT"){
				$where .= "  and ctype in ('FR','HT') ";
			}else{
				$where .= "  and ctype = '$ctype' ";
			}
			//원마운트 핀 생성
			if($ctype == "OM" && $pcmsitem_id != null && $pcmsitem_id != ''){
				$where .= "and items_id = '$pcmsitem_id' ";
			}else if($sellno != null && $sellno != ''){
				$where .= "and sellno = '$sellno' ";
			}

            //블루캐니언 핀 생성
            if($ctype == "BG" && $pcmsitem_id != null && $pcmsitem_id != ''){
                $where .= "and items_id = '$pcmsitem_id' ";
            }else if($sellno != null && $sellno != ''){
                $where .= "and sellno = '$sellno' ";
            }

			$getseed_sql = "SELECT seed FROM `cms_coupon` WHERE $where order by seed desc limit 1";
            $queryResult = $this->db->query($getseed_sql);
            $getCnt = $queryResult-> num_rows();
            if($getCnt > 0){
                $getseed_row = $queryResult->row();
                if($getseed_row->seed != "" && $getseed_row->seed != null){
                    $seed = $getseed_row->seed + 1;
                }
            }
		}


		return $seed;
	}

	function get_seed_old($ctype='',$chgu='',$sellno='',$pcmsitem_id=''){
		$seed = 1; //기본 시작값
		$where = "chgu = '$chgu' and ctype = '$ctype' ";
		if($ctype == "OM" && $pcmsitem_id != null && $pcmsitem_id != ''){
			$where .= "and items_id = '$pcmsitem_id' ";
		}else if($sellno != null && $sellno != ''){
			$where .= "and sellno = '$sellno' ";
		}
		$getseed_sql = "SELECT seed FROM `cms_coupon` WHERE $where order by seed desc limit 1";
		$getseed_row = $this->db->query($getseed_sql)->row();
		if($getseed_row->seed != "" && $getseed_row->seed != null){
			$seed = $getseed_row->seed + 1;
		}
		return $seed;
	}

	function get_kit_sellcode(){
		$sellcode = 0;
		$getsellcode_sql = "SELECT sellcode FROM `kit_lms` WHERE id > 390 and sellcode like '201%' order by sellcode desc limit 1";
		$getsellcode_row = $this->db->query($getsellcode_sql)->row();
		if($getsellcode_row->sellcode != "" && $getsellcode_row->sellcode != null){
			$sellcode = $getsellcode_row->sellcode + 1;
		}
		return $sellcode;
	}

	function cms_coupon_add(
			$ctype='',$chgu='',$ccode='',$sellno='',$seed='',$pcmsitem_id='',$cnm='',$cunit='',$qty='',$use_sdate='',$use_edate='',$logtxt='', $syncorder='', $api='N'
	){
		//날짜형식 변경
		if($use_sdate!="" && $use_sdate != null){
			$date_arr = explode("/",$use_sdate);
			$use_sdate = $date_arr[2]."-".$date_arr[0]."-".$date_arr[1]." 00:00:00";
		}
		if($use_edate!="" && $use_edate != null){
			$date_arr = explode("/",$use_edate);
			$use_edate = $date_arr[2]."-".$date_arr[0]."-".$date_arr[1]." 23:59:59";
		}
		$regdate = date("Y-m-d H:i:s");
		/*
		echo 'ctype='.$ctype;
		echo 'chgu='.$chgu;
		echo 'sellno='.$sellno;
		echo 'seed='.$seed;
		echo 'ccode='.$ccode;
		echo 'pcmsitem_id='.$pcmsitem_id;
		echo 'cnm='.$cnm;
		echo 'regdate='.$regdate;
		echo 'use_sdate='.$use_sdate;
		echo 'use_edate='.$use_edate;
		echo 'cdesc='.$logtxt;
		*/
		$data = array(
				'ctype' =>$ctype,
				'chgu' =>$chgu,
				'ccode'=>$ccode,
				'sellno' =>$sellno,
				'seed' =>$seed,
				'items_id' =>$pcmsitem_id,
				'cnm' =>$cnm,
				'cunit' =>$cunit,
				'qty' =>$qty,
				'state' =>'R',
				'regdate' => $regdate,
				'use_sdate' =>$use_sdate,
				'use_edate' =>$use_edate,
				'cdesc' =>$logtxt,
				'syncorder'=>$syncorder,
				'api' =>$api
		);
		if($this->db->insert('cms_coupon', $data)){
			 echo "ok";
		}else{
			echo "err";
		}

	}


	function items_mall_add(
			$sellcode='',$sellopt='',$sellname='',$item_option='',$ch_id='',$ch_nm='',
			$datetimepicker1='',$sell_state='',$sellurl='',$mall_log=''
			){

        $data9 = array(
            'sellcode' => $sellcode,
            'sellopt' => $sellopt,
            'title' => $sellname,
            'pcmsitem_id' => $item_option,
            'ch_id' => $ch_id,
            'ch_nm' => $ch_nm,
            'useedate' => $datetimepicker1,
            'pcms_state' => $sell_state
        );

        if($this->sparo->insert('ebay_pcmsmts', $data9)){
            return "ok";
        }else{
            return "err";
        }

	}

	function sellinfo_useyn($id= '',$useyn= ''){
		$data = array(
				'useyn' => $useyn
		);
		$this->db->where('id', $id);
		if($this->db->update('items_mall', $data)){
			return "ok";
		}else{
			return "err";
		}

	}



}
?>
