<?php 
class Cmsmodel extends CI_Model {

	var $title   = '';
	var $content = '';
	var $date    = '';
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
        $this->cms = $this->load->database('cms', TRUE);
	}
	 
	function get_last_ten_entries()
	{
		$query = $this->cms->get('entries', 10);
		return $query->result();
	}
	
	function get_CMS_COMPANY($com_id=''){
		$sql = "select * from CMSDB.CMS_COMPANY where com_id = '".$com_id."' limit 1";
		$query = $this->cms->query($sql);
		$total = $query -> num_rows();
		if($total > 0){
			return $query->row();
		}else{
			return "0";
		}
	}
	
	function get_CMS_FACILITIES($fac_id=''){
		$sql = "select * from CMSDB.CMS_FACILITIES where fac_id = '".$fac_id."' limit 1";
		$query = $this->cms->query($sql);
		$total = $query -> num_rows();
		if($total > 0){
			return $query->row();
		}else{
			return "0";
		}
	}
	
	function get_CMS_ITEMS($id=0){
		return $this->cms->get_where('CMS_ITEMS', array('item_id' => $id),1)->row();
	}

	function get_CMS_PRICES($price_itemid = 0, $price_date=''){
        $sql = "select * from CMSDB.CMS_PRICES where price_itemid = '{$price_itemid}' and price_date = '{$price_date}' limit 1";
        $query = $this->cms->query($sql);
        $total = $query -> num_rows();
        if($total > 0){
            return $query->row();
        }else{
            return "0";
        }
    }

    function get_CMS_RATE($rate_cpid=0,$rate_itemid=0){
        $sql = "select * from CMSDB.CMS_RATE where rate_cpid = '{$rate_cpid}' and rate_itemid = '{$rate_itemid}' limit 1";
        $query = $this->cms->query($sql);
        $total = $query -> num_rows();
        if($total > 0){
            return $query->row();
        }else{
            return "0";
        }
    }
	
	
	

	
	
	//업체명 중복체크
	function chk_cms_company_nm($compayname = ''){
		$resultmsg = "error";
			
		$this->compayname = $compayname;
		if($this->compayname == ''){
			return false;
		}else if($this->compayname != "0" && $this->compayname != null){
			$sql = "select * from CMS_COMPANY where com_nm = '".$this->compayname."' and com_state = 'Y' limit 1";
			$query = $this->cms->query($sql);
			$total = $query -> num_rows();
			if($total == 0){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	//PCMS 등록 안하게 되면 사용할것.
	function cms_input_company_bak($typepick='',$companyname=''){
		$data = array(
				'com_type' => $typepick,
				'com_nm' => $companyname,
				'com_state' => 'Y'
		);
		if($this->cms->insert('CMS_COMPANY', $data)){
			//$inItemId = $this->cms->insert_id();
			return true;
		}else{
			return false;
		}
	}
	//PCMS 등록 후 2번 업체테이블에 등록
	function cms_input_company($typepick='',$companyname=''){
		$inItemId = $this->pcms_input_company($companyname,$typepick);
		$data = array(
				'com_id' => $inItemId,
				'com_type' => $typepick,
				'com_nm' => $companyname,
				'com_state' => 'Y'
		);
		if($this->cms->insert('CMS_COMPANY', $data)){
			$this->oldsparo_input_company($companyname,$inItemId,$typepick);	//구스파로 업체등록
			$this->newsparo_input_company($companyname,$inItemId,$typepick);	//뉴스파로 업체등록
			return true;
		}else{
			return false;
		}
	}
	//PCMS 업체등록
	function pcms_input_company($companyname='',$typepick=''){
		$inTime = date("Y-m-d H:i:s");
		$mdate = date("Y-m-d");
		
		$typearr = array(
				"C"=> "판매채널",
				"S"=> "대리점"
		);
		$data = array(
				'Created_at' => $inTime,
				'Updated_at' => $inTime,
				'mdate' => $mdate,
				'nm' => $companyname,
				'visible' => '1',
				'gu' => $typearr[$typepick],
				'site' => 'CMS'
		);
		if($this->pcms->insert('grmts', $data)){
			return $this->pcms->insert_id();
		}else{
			return false;
		}
	}
	
	//구스파로 업체등록
	function oldsparo_input_company($companyname='',$inItemId='',$typepick=''){
	
		$inTime = date("Y-m-d H:i:s");
		$typearr = array(
				"C"=> "판매채널",
				"S"=> "대리점"
		);
		$data = array(
				'id' => $inItemId,
				'Created_at' => $inTime,
				'Updated_at' => $inTime,
				'nm' => $companyname,
				'userid' => 'CMS',
				'pass' => 'CMS',
				'gu' => $typearr[$typepick]
		);
	
		if($this->sparo->insert('grmts', $data)){
			return true;
		}else{
			return false;
		}
	}
	
	//뉴스파로 업체등록
	function newsparo_input_company($companyname='',$inItemId='',$typepick=''){
	
		$inTime = date("Y-m-d H:i:s");
		$mdate = date("Y-m-d");
		$typearr = array(
				"C"=> "판매채널",
				"S"=> "대리점"
		);
		$data = array(
				'id' => $inItemId,
				'created' => $inTime,
				'updated' => $inTime,
				'mdate' => $mdate,
				'nm' => $companyname,
				'gu' => $typearr[$typepick],
				'visible' => '활성',
				'site' => 'CMS'
		);
		if($this->sparo2->insert('grmts', $data)){
			return true;
		}else{
			return false;
		}
	}
	
	//CMS업체 사용,미사용
	function cms_use_company($id= '',$useyn= ''){
	
		$data = array(
				'com_state' => $useyn
		);
		$this->cms->where('com_id', $id);
		if($this->cms->update('CMS_COMPANY', $data)){
			$this->pcms_use_company($id,$useyn);
			$this->newsparo_use_company($id,$useyn);
			return "ok";
		}else{
			return "err";
		}
	}
	
	//PCMS 사용,미사용
	function pcms_use_company($id= '',$useyn= ''){
		$visible = "";
		if($useyn == "Y"){
			$visible = "1";
		}else{
			$visible = "2";
		}
		$data = array(
				'visible' => $visible
		);
	
		$this->pcms->where('id', $id);
		if($this->pcms->update('grmts', $data)){
			return "ok";
		}else{
			return "err";
		}
	}
	
	//뉴스파로 사용,미사용
	function newsparo_use_company($id= '',$useyn= ''){
	
		$visible = "";
		if($useyn == "Y"){
			$visible = "활성";
		}else{
			$visible = "비활성";
		}
		$data = array(
				'visible' => $visible
		);
	
		$this->sparo2->where('id', $id);
		if($this->sparo2->update('grmts', $data)){
			return "ok";
		}else{
			return "err";
		}
	}
	
	function cms_get_comid_for_facid($fac_select=''){
		$sql = "select * from CMS_FACILITIES where fac_id = '".$fac_select."' limit 1";
		$query = $this->cms->query($sql);
		$total = $query -> num_rows();
		if($total > 0){
			$row = $query->row(); 
			return $row->fac_cpid;
		}else{
			return "0";
		}
	}
	
	

	//시설명 중복체크
	function chk_cms_facilities_nm($facname = ''){
		
		//return $sql = "select * from `CMS_FACILITIES` where fac_nm = '".$facname."' limit 1";
		 if($facname != '' && $facname != null){
			$sql = "select * from `CMS_FACILITIES` where fac_nm = '".$facname."'  and fac_state = 'Y' limit 1";
			$query = $this->cms->query($sql);
			$total = $query -> num_rows();
			if($total > 0){
				return false;
			}else{
				return true;
			}
		}else{
			return false;
		} 
	}
	
	//시설아이디 중복체크
	function chk_cms_facilities_id($facid = ''){
	
		if($facid != '' && $facid != null){
			$sql = "select * from `CMS_FACILITIES` where fac_id = '".$facid."' limit 1";
			$query = $this->cms->query($sql);
			$total = $query->num_rows();
			if($total > 0){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	function cms_input_facilities_bak($company_select= '',$facname= ''){
		$inItemId = $this->pcms_input_facilities($company_select,$facname);
		$data = array(		
				'fac_id' => $inItemId,
				'fac_nm' => $facname,
				'fac_state' => 'Y',
				'fac_cpid' => $company_select
		);
		if($this->cms->insert('CMS_FACILITIES', $data)){
			$this->oldsparo_input_facilities($company_select,$facname,$inItemId);	//구스파로 시설등록
			$this->newsparo_input_facilities($company_select,$facname,$inItemId);	//뉴스파로 시설등록
			return true;
		}else{
			return false;
		}
	}

    function cms_input_facilities($company_select= '',$facname= ''){
        $data = array(
            'fac_nm' => $facname,
            'fac_state' => 'Y',
            'fac_cpid' => $company_select
        );
        if($this->cms->insert('CMS_FACILITIES', $data)){
            $inItemId = $this->cms->insert_id();
            $this->newsparo_input_facilities($company_select,$facname,$inItemId);	//뉴스파로 시설등록
            return true;
        }else{
            return false;
        }
    }
	
	//PCMS 시설등록
	function pcms_input_facilities($company_id='',$facname=''){
		$inTime = date("Y-m-d H:i:s");
		$mdate = date("Y-m-d");
		$data = array(
				'Created_at' => $inTime,
				'Updated_at' => $inTime,
				'mdate' => $mdate,
				'nm' => $facname,
				'visible' => '1',
				'gu' => '시설',
				'site' => 'CMS'
		);
		if($this->pcms->insert('grmts', $data)){
			return  $this->pcms->insert_id();
		}else{
			return false;
		}
	}
	
	//구스파로 시설등록 (시설명 없음)
	function oldsparo_input_facilities($company_id='',$facname='',$fac_id=''){
		$inTime = date("Y-m-d H:i:s");
	
		$data = array(
				'id' => $fac_id,
				'grmt_id' => $company_id,
				'Created_at' => $inTime,
				'Updated_at' => $inTime
		);
	
		if($this->sparo->insert('jpmts', $data)){
			return true;
		}else{
			return false;
		}
	}
	
	//뉴스파로 시설등록
	function newsparo_input_facilities($company_id='',$facname='',$fac_id=''){
	
		$inTime = date("Y-m-d H:i:s");
		$mdate = date("Y-m-d");
	
		$data = array(
				'id' => $fac_id,
				'created' => $inTime,
				'updated' => $inTime,
				'mdate' => $mdate,
				'grmt_id' => $company_id,
				'nm' => $facname,
				'gu' => 'J',
				'visible' => '활성',
				'site' => 'CMS'
		);
		if($this->sparo2->insert('jpmts', $data)){
			return true;
		}else{
			return false;
		}
	}
	
	function cms_use_facilities($id= '',$useyn= ''){
		//return "ok";
		$data = array(
    			'fac_state' => $useyn
    	);
		$this->cms->where('fac_id', $id);
		if($this->cms->update('CMS_FACILITIES', $data)){
			return "ok";
		}else{
			return "err";
		}
	}
	


	//상품등록 파라미터 체크
	function cms_input_items_param_chk($fac_select='',$itemname=''){
		//시설 입력값 체크
		if($fac_select == '0' || $fac_select == '' || $fac_select == null){
			return false;
		//상품명 체크
		}else if($itemname == '0' || $itemname == '' || $itemname == null){
			return false;
		//시설아이디체크
		}else if(!$this->chk_cms_facilities_id($fac_select)){
			return false;
		}else{
			return true;
		}
	}

	//상품등록
	function cms_input_items($fac_select='',$itemname='',$item_sdate='',$item_edate='',$item_cd=''){
	
		//날짜형식 변경
		if($item_sdate!="" && $item_sdate != null){
			$item_sdate = date("Y-m-d 00:00:00",strtotime ($item_sdate));
		}
		if($item_edate!="" && $item_edate != null){
			$item_edate = date("Y-m-d 23:59:59",strtotime ($item_edate));
		}

        $item_cpid = $this->cms_get_comid_for_facid($fac_select);
		//cmsdb 에 insert
        $data = array(
            'item_cd' => $item_cd,
            'item_nm' => $itemname,
            'item_sdate' => $item_sdate,
            'item_edate' => $item_edate,
            'item_state' => 'Y',
            'item_cpid' => $item_cpid,
            'item_facid' => $fac_select
        );

        if($this->cms->insert('CMS_ITEMS', $data)){
            $inItemId = $this->cms->insert_id(); //insertedId 를 가져와서
            // 나머지 DB에 insert
            $this->newsparo_input_items($itemname,$inItemId,$item_cpid,$fac_select);	//뉴스파로 상품등록
            $this->pcms_input_items($itemname,$inItemId,$item_cpid,$fac_select);		//PCMS 상품등록
            $this->oldsparo_input_items($itemname,$inItemId,$item_cpid,$fac_select);	//구스파로 상품등록

            return true;
        }else{
            return false;
        }
	}

    //상품등록
    function cms_input_items_bak($fac_select='',$itemname='',$item_sdate='',$item_edate='',$item_cd=''){

        //날짜형식 변경
        if($item_sdate!="" && $item_sdate != null){
            $item_sdate = date("Y-m-d 00:00:00",strtotime ($item_sdate));
        }
        if($item_edate!="" && $item_edate != null){
            $item_edate = date("Y-m-d 23:59:59",strtotime ($item_edate));
        }

        /*if($item_cpid == '0'){
            $item_cpid = $fac_select;
        }*/

        $item_cpid = $this->cms_get_comid_for_facid($fac_select);
        $inItemId = $this->pcms_input_items($itemname,$item_cpid,$fac_select);		//PCMS 상품등록
        $data = array(
            'item_id' => $inItemId,
            'item_cd' => $item_cd,
            'item_nm' => $itemname,
            'item_sdate' => $item_sdate,
            'item_edate' => $item_edate,
            'item_state' => 'Y',
            'item_cpid' => $item_cpid,
            'item_facid' => $fac_select
        );

        print_r($data);
        if($this->cms->insert('CMS_ITEMS', $data)){
            //$this->oldsparo_input_items($itemname,$inItemId,$item_cpid,$fac_select);	//구스파로 상품등록
            $this->newsparo_input_items($itemname,$inItemId,$item_cpid,$fac_select);	//뉴스파로 상품등록
            return true;
        }else{
            return false;
        }
    }




	//PCMS 상품등록
	function pcms_input_items($itemname='',$inItemId=0,$item_cpid='',$item_facid=''){
		
		$inTime = date("Y-m-d H:i:s");
		
		$FACILITIES_row = $this->get_CMS_FACILITIES($item_facid);
		$COMPANY_row = $this->get_CMS_COMPANY($item_cpid);
		$data = array(
		        'id' => $inItemId,
				'Created_at' => $inTime,
				'Updated_at' => $inTime,
				'visible' => '1',
				'gu' => '단품',
				'salegu' => '1',
				'pkggu' => '2',
				'nm' => $itemname,
				'item_gu' => $itemname,
				'grmt_id' => $item_cpid,
				'grnm'=>$COMPANY_row->com_nm,
				'jpmt_id' => $item_facid,
				'jpnm'=>$FACILITIES_row->fac_nm,
				'site' => 'CMS'
		);
		if($this->pcms->insert('itemmts', $data)){
			return  $this->pcms->insert_id();
		}else{
			return false;
		} 
	}
	//구스파로 상품등록
	function oldsparo_input_items($itemname='',$inItemId='',$item_cpid='',$item_facid=''){
	
		$inTime = date("Y-m-d H:i:s");
		$data = array(
				'id' => $inItemId,
				'Created_at' => $inTime,
				'Updated_at' => $inTime,
				'visible' => '1',
				'gunm' => '스파',
				'salegu' => '1',
				'item_gu' => $itemname,
				'grmt_id' => $item_cpid,
				'jpmt_id' => $item_facid
		);
	
		if($this->sparo->insert('itemmts', $data)){
			return true;
		}else{
			return false;
		}
	}
	
	//뉴스파로 상품등록
	function newsparo_input_items($itemname='',$inItemId='',$item_cpid='',$item_facid=''){
	
		$inTime = date("Y-m-d H:i:s");
		$mdate = date("Y-m-d");
		
		$item_cpnm = $this->get_CMS_COMPANY($item_cpid)->com_nm;	//업체명
		$item_facnm = $this->get_CMS_FACILITIES($item_facid)->fac_nm;	//시설명
	
		$item_cpid = $this->get_Nsparo_grmt_id($item_cpid,$item_facid);
		$item_facid = $this->get_Nsparo_jpmt_id($item_cpid,$item_facid);
		
		$data = array(
				'id' => $inItemId,
				'pcms_iid' => $inItemId,
				'created' => $inTime,
				'updated' => $inTime,
				'mdate' => $mdate,
				'gu' => 'J',
				'dangu' => '공통권',
				'visible' => '판매',
				'nm' => $itemname,
				'grmt_id' => $item_cpid,
				'grnm' => $item_cpnm,
				'jpmt_id' => $item_facid,
				'jpnm' => $item_facnm
		);
	
		if($this->sparo2->insert('itemmts', $data)){
			return true;
		}else{
			return false;
		}
	}
	
	function get_Nsparo_grmt_id($item_cpid=0,$item_facid=0){
		
		//1차 뉴스파로 시설 조회
		$grchk = "select * from spadb.jpmts where id = '{$item_facid}' and grmt_id ='{$item_cpid}'";
		$grqry = $this->sparo2->query($grchk);
		$grtotal = $grqry -> num_rows();
		if($grtotal < 1){
			//등록된 아이디가 없다.
			$citemsql = "select * from CMSDB.CMS_ITEMS where item_facid = '{$item_facid}' order by item_id";
			$citemqry = $this->cms->query($citemsql);
			//시설아이디로 루프 돌림
			$go = true;
			foreach($citemqry->result() as $citem):
				//시설의 상품아이디 GET
				if($go){
					$get_item_id=$citem->item_id;
					$rechk = "select * from spadb.itemmts where pcms_iid='{$get_item_id}' limit 1";
					$reqry = $this->sparo2->query($rechk);
					$retotal = $reqry -> num_rows();
					if($retotal > 0){
						
						$rerow = $reqry->row();
						
						$item_cpid = $rerow->grmt_id;
						$go = false;
						/* 
						//상품의 업체 아이디를 다시 조회
						$grchk2 = "select * from spadb.jpmts where id = '{$rerow->jpmt_id}' and grmt_id ='{$rerow->grmt_id}' limit 1";
						$grqry2 = $this->sparo2->query($grchk2);
						$grtotal = $grqry -> num_rows();
						
						//뉴스파로에 업체가 존재하면
						if($grtotal > 0){
							$item_cpid = $rerow->grmt_id;
							$go = false;
						} */
					}
				}
			endforeach;
		}
		return $item_cpid;
	}
	
	function get_Nsparo_jpmt_id($item_cpid=0,$item_facid=0){
	
		//1차 뉴스파로 시설 조회
		$grchk = "select * from spadb.jpmts where id = '{$item_facid}' and grmt_id ='{$item_cpid}'";
		$grqry = $this->sparo2->query($grchk);
		$grtotal = $grqry -> num_rows();
		if($grtotal < 1){
			//등록된 아이디가 없다.
			$citemsql = "select * from CMS_ITEMS where item_facid = '{$item_facid}' order by item_id";
			$citemqry = $this->cms->query($citemsql);
			//시설아이디로 루프 돌림
			$go = true;
			foreach($citemqry->result() as $citem):
			//시설의 상품아이디 GET
			if($go){
				$get_item_id=$citem->item_id;
				$rechk = "select * from spadb.itemmts where pcms_iid='{$get_item_id}' limit 1";
				$reqry = $this->sparo2->query($rechk);
				$retotal = $reqry -> num_rows();
				if($retotal > 0){
	
					$rerow = $reqry->row();
	
					$item_facid = $rerow->jpmt_id;
					$go = false;
				}
			}
			endforeach;
		}
		//return $item_cpid;
		return $item_facid;
	}
	
	
	//상품수정
	function cms_mode_items($item_select='',$item_sdate='',$item_edate='' ,$itemname='' ,$item_cd=''){
			
		//날짜형식 변경
		if($item_sdate!="" && $item_sdate != null){
			$item_sdate = date("Y-m-d 00:00:00",strtotime ($item_sdate));
		}
		if($item_edate!="" && $item_edate != null){
			$item_edate = date("Y-m-d 23:59:59",strtotime ($item_edate));
		}

		$modesql = "update CMS_ITEMS set 
        item_cd = '$item_cd',
		item_sdate = '$item_sdate',
		item_edate = '$item_edate',
		item_nm = '$itemname'
		where item_id = '$item_select' limit 1";

		if($this->cms->query($modesql)){
			return true;
		}else{
			return false;
		}
	}

	function cms_mode_coupon($item_select='' ,$itemname=''){

        $modesql = "update pcmsdb.cms_coupon set 
		cnm = '$itemname'
		where items_id = '$item_select' ";

        if($this->db->query($modesql)){
            return true;
        }else{
            return false;
        }
    }

    //PCMS 상품수정
    function pcms_mode_items($item_select='' ,$itemname=''){

        $modesql = "update itemmts set 
		nm = '$itemname'
		where id = '$item_select' limit 1";

        if($this->pcms->query($modesql)){
            return true;
        }else{
            return false;
        }
    }

    //구스파로 상품수정
    function oldsparo_mode_items($item_select='' ,$itemname=''){

        $modesql = "update itemmts set 
		item_gu = '$itemname'
		where id = '$item_select' limit 1";

        if($this->sparo->query($modesql)){
            return true;
        }else{
            return false;
        }
    }

    //뉴스파로 상품수정
    function newsparo_mode_items($item_select='' ,$itemname=''){

        $modesql = "update itemmts set 
		nm = '$itemname'
		where id = '$item_select' limit 1";

        if($this->sparo2->query($modesql)){
            return true;
        }else{
            return false;
        }
    }

	//CMS상품 사용,미사용
	function cms_use_items($id= '',$useyn= ''){	
		$data = array(
				'item_state' => $useyn
		);
		$this->cms->where('item_id', $id);
		if($this->cms->update('CMS_ITEMS', $data)){
			$this->pcms_use_items($id,$useyn);
			$this->oldsparo_use_items($id,$useyn);
			$this->newsparo_use_items($id,$useyn);
			return "ok";
		}else{
			return "err";
		}
	}
	
	function kit_lms_use($id= '',$useyn= ''){	
		$data = array(
				'useyn' => $useyn
		);
		$this->db->where('id', $id);
		if($this->db->update('kit_lms', $data)){
			return "ok";
		}else{
			return "err";
		}
	}
	
	//PCMS 사용,미사용
	function pcms_use_items($id= '',$useyn= ''){
	
		$visible = "";
		if($useyn == "Y"){
			$visible = "1";
		}else{
			$visible = "2";
		}
		$data = array(
				'visible' => $visible
		);
		
		$this->pcms->where('id', $id);
		if($this->pcms->update('itemmts', $data)){
			return "ok";
		}else{
			return "err";
		}
	}
	
	//구스파로 사용,미사용
	function oldsparo_use_items($id= '',$useyn= ''){
	
		$visible = "";
		if($useyn == "Y"){
			$visible = "1";
		}else{
			$visible = "2";
		}
		$data = array(
				'visible' => $visible
		);
	
		$this->sparo->where('id', $id);
		if($this->sparo->update('itemmts', $data)){
			return "ok";
		}else{
			return "err";
		}
	}
	
	//뉴스파로 사용,미사용
	function newsparo_use_items($id= '',$useyn= ''){
		$visible = "";
		if($useyn == "Y"){
			$visible = "판매";
		}else{
			$visible = "일시정지";
		}
		$data = array(
				'visible' => $visible
		);
	
		$this->sparo2->where('id', $id);
		if($this->sparo2->update('itemmts', $data)){
			return "ok";
		}else{
			return "err";
		}
	}
	
	function cms_del_price($item_select = '',$price_date = ''){
		$date_arr = explode("/",$price_date);
		$price_date = $date_arr[2]."-".$date_arr[0]."-".$date_arr[1];
			
		$delPriceSql = "update CMSDB.CMS_PRICES set
		price_state = 'N'
		where 1
		and price_itemid = '{$item_select}' 
		and price_date = '{$price_date}'
		";
		$this->cms->query($delPriceSql);
	}
	
	function cms_input_price(
			$item_select = '',$price_date = '',$normalPrice = '',$salePrice = '',
			$inPrice = '',$outPrice = '',$qty = ''){
		
		
		$price_date = date("Y-m-d",strtotime ($price_date));
		
		$price_yy = date("Y",strtotime ($price_date));
		$price_mm = date("m",strtotime ($price_date));
		$price_dd = date("d",strtotime ($price_date));
		
		$week = array("일", "월", "화", "수", "목", "금", "토");
		$s = $week[date("w",strtotime ($price_date))];
		
		$inTime = date("Y-m-d H:i:s");
		$damnm = $this->session->userdata('nm');
		$damcd = $this->session->userdata('cd');
		$price_log = $inTime.":".$damnm."(".$damcd.") 등록";
		
		$delPriceSql = "delete from CMSDB.CMS_PRICES 
		where 1
		and price_itemid = '{$item_select}'
		and price_date = '{$price_date}'
		";
		$this->cms->query($delPriceSql);

		$inPriceSql = "insert CMSDB.CMS_PRICES set 
				price_itemid = '{$item_select}',
				price_date = '{$price_date}',
				price_normal = '{$normalPrice}',
				price_sale = '{$salePrice}',
				price_in = '{$inPrice}',
				price_out = '{$outPrice}',
				price_qty = '{$qty}',
				price_regdate = '{$inTime}',
				price_moddate = '{$inTime}',
				price_log = '{$price_log}'
				";
		
		if($this->cms->query($inPriceSql)){
			
			$this->pcms = $this->load->database('pcms', TRUE);
			
			$delPriceSql2 = "delete from terp_placem.pricemts
			where 1
			and itemmt_id = '{$item_select}'
			and yy='{$price_yy}'
			and mm='{$price_mm}'
			and dd='{$price_dd}'
			";
			$this->pcms->query($delPriceSql2);
			$inPricePCMS = "insert terp_placem.pricemts set
			itemmt_id = '{$item_select}',
			yy='{$price_yy}',
			mm='{$price_mm}',
			dd='{$price_dd}',
			ww='{$s}',
			nordan = '{$normalPrice}',
			saledan = '{$salePrice}',
			saipdan = '{$inPrice}',
			gongdan = '{$outPrice}',
			itemsu = '{$qty}',
			Created_at = '{$inTime}',
			Updated_at = '{$inTime}',
			site = 'PM2'
			";		
			$this->pcms->query($inPricePCMS );
			return true;
		}else{
			return false;
		}
	}
	
	
	function cms_input_commission($item_select = '',$company_select = '',$rate = ''){
		
		//업체정보
		$comData = $this->get_CMS_COMPANY($company_select);
		$thistime = date("Y-m-d H:i:s");
		$damnm = $this->session->userdata('nm');
		$damid = $this->session->userdata('id');
		
		//2번 DB 삭제
		$delRateSql = "delete from CMSDB.CMS_RATE
		where 1
		and rate_itemid = '{$item_select}'
		and rate_cpid = '{$company_select}'
		limit 1
		";
		$this->cms->query($delRateSql);
	
		$inRateSql = "insert CMSDB.CMS_RATE set
		rate_regdate='{$thistime}',
		rate_moddate='{$thistime}',
		rate_cpid='{$company_select}',
		rate_cpnm='{$comData->com_nm}',
		rate_itemid='{$item_select}',
		rate_value='{$rate}',
		rate_accountid='{$damid}',
		rate_accountnm='{$damnm}'";
		
		if($this->cms->query($inRateSql)){
			$this->pcms = $this->load->database('pcms', TRUE);
			
			//14번 DB 삭제
			$delRatePCMS = "delete from terp_placem.divmts
			where 1
			and itemmt_id='{$item_select}' 
			and grmt_id='{$company_select}' 
			limit 1
			";
			$this->pcms->query($delRatePCMS);
		
			$inRatePCMS = "insert terp_placem.divmts set
			created_at='{$thistime}',
			updated_at='{$thistime}',
			grmt_id='{$company_select}',
			grnm='{$comData->com_nm}',
			itemmt_id='{$item_select}',
			itemnm='{$item_select}',
			rate='{$rate}',
			dammt_id='{$damid}',
			damnm='{$damnm}'";
			
			$this->pcms->query($inRatePCMS );
			
			return true;
		}else{
			return false;
		}
	}
	
	function cms_del_commission($item_select = '',$company_select = ''){
	
		//2번 DB 삭제
		$delRateSql = "delete from CMSDB.CMS_RATE
		where 1
		and rate_itemid = '{$item_select}'
		and rate_cpid = '{$company_select}'
		limit 1
		";
		;
	
		if($this->cms->query($delRateSql)){
			$this->pcms = $this->load->database('pcms', TRUE);
				
			//14번 DB 삭제
			$delRatePCMS = "delete from terp_placem.divmts
			where 1
			and itemmt_id='{$item_select}'
			and grmt_id='{$company_select}'
			limit 1
			";
			$this->pcms->query($delRatePCMS);
	
			return true;
		}else{
			return false;
		}
	}
	
	
		
	
	function kit_lms_pcmsid_check($pcmsitem_id){
		$this->db->where('pcms_id', $pcmsitem_id);
		$this->db->where('useyn', 'Y');
		$this->db->where('edate >', date("Y-m-d H:i:s"));
		$this->db->from('kit_lms');
		return $this->db->count_all_results();
	}

	function kit_lms_pcmsid_check_gp($pcmsitem_id, $gp){
		$this->db->where('pcms_id', $pcmsitem_id);
		$this->db->where('gp', $gp);
		$this->db->where('useyn', 'Y');
		$this->db->where('edate >', date("Y-m-d H:i:s"));
		$this->db->from('kit_lms');
		return $this->db->count_all_results();
	}

    function kit_lms_pcmsid_disable($pcmsitem_id){
        $sql = "UPDATE pcmsdb.kit_lms set useyn='N' WHERE pcms_id = '{$pcmsitem_id}'";
        $this->db->query($sql);
        return 0;
    }

	function kit_lms_pcmsid_disable_gp($pcmsitem_id, $gp){
        $sql = "UPDATE pcmsdb.kit_lms set useyn='N' WHERE pcms_id = '{$pcmsitem_id}' and gp = '{$gp}'";
        $this->db->query($sql);
        return 0;
    }
	
	function get_om_sellcode($pcmsitem_id = ''){
		$sellcode = 0;
		if($pcmsitem_id != '' && $pcmsitem_id != null)
		$getsellcode_sql = "SELECT * FROM item_fac WHERE faccode = 'OM' and pcms_id = '$pcmsitem_id' and chncode = 'P' and edate > NOW() order by id desc limit 1";
		$query = $this->db->query($getsellcode_sql);
		$total = $query -> num_rows();
		if($total > 0){
			$getsellcode_row = $query->row();
			if($getsellcode_row->itemcode != "" && $getsellcode_row->itemcode != null){
				$sellcode = $getsellcode_row->itemcode;
			}
		}
		return $sellcode;
	}
	
	function get_asan_itemcode($pcmsitem_id = ''){
		$sellcode = 0;
		if($pcmsitem_id != '' && $pcmsitem_id != null)
			$getsellcode_sql = "SELECT * FROM asan_items WHERE pcms_id = '$pcmsitem_id' and chncode = 'P' and state = 'Y' order by id desc limit 1";
		$query = $this->db->query($getsellcode_sql);
		$total = $query -> num_rows();
		if($total > 0){
			$getsellcode_row = $query->row();
			if($getsellcode_row->ITEMCODE != "" && $getsellcode_row->ITEMCODE != null){
				$sellcode = $getsellcode_row->ITEMCODE;
			}
		}
		return $sellcode;
	}
	
	
	
	function kit_lms_input($chnpick='',
    			$sellcode='',
    			$pcmsitem_id='',
    			$pcms_itemnm='',
    			$use_sdate='',
    			$use_edate='',
    			$textarea_value='',
				$manager = '',
				$thislogtxt='',
				$pcmsitem_id_arr='',
				$curl_headimg='',
				$pcmsitem_msgType=1
	){ 
		
		$month6 = date("Y-m-d 23:59:59",strtotime ("+5 months"));
		
		if($use_sdate!="" && $use_sdate != null){
			$use_sdate = date("Y-m-d 00:00:00",strtotime ($use_sdate));
		}
		if($use_edate!="" && $use_edate != null){
			$use_edate = date("Y-m-d 23:59:59",strtotime ($use_edate));
			if($use_edate > $month6)$use_edate = $month6;
		}
		
		$data = array(
				'gp' =>$chnpick,
				'sellcode' =>$sellcode,
				'itemnm' =>$pcms_itemnm,
				'pcms_id' =>$pcmsitem_id,
				'pcms_id_arr' =>$pcmsitem_id_arr,
				'chnm' =>'플레이스엠',
				'chcode' =>'PM',	
				'sdate' =>$use_sdate,
				'edate' =>$use_edate,
				'useyn' =>'Y',
				'regdate' =>date('Y-m-d H:i:s'),
				'mms_text' =>$textarea_value,
				'manager' =>$manager,
				'kit_log' =>$thislogtxt,
				'cbhead_img' => $curl_headimg,
				'msg_type'=> $pcmsitem_msgType
		);
		if($this->db->insert('kit_lms', $data)){
			return true;
		}else{
			return false;
		}
	}

    function chk_phoenix_items_duplicate($itemid = ''){
        $sql = "SELECT * FROM pcmsdb.phoenix_items where item_id = '{$itemid}' and selldate >= CURDATE() and state = 'Y'";
        $query = $this->db->query($sql);
        $total = $query -> num_rows();
        if($total > 0){
            return false;
        }else{
            return true;
        }
    }

    function phoenix_items_insert($selltype='KO',$item_id='',$ITEMNAME='',$amt='',$selldate='',$bgimg='',$synctype='',$prifix='',$typecd='',$seasoncd='',$tcode='',$typecode='',$man1='',$man2='',$man3='',$man4='',$man5='',$man6='',$msg){


        $data = array(
            'selltype' =>$selltype,
            'item_id' =>$item_id,
            'ITEMNAME' =>$ITEMNAME,
            'amt' =>$amt,
            'selldate' =>$selldate,
            'bgimg' =>$bgimg,
            'synctype' =>$synctype,
            'prifix' =>$prifix,
            'typecd' =>$typecd,
            'seasoncd' =>$seasoncd,
            'tcode' =>$tcode,
            'typecode' =>$typecode,
            'cnt1' =>$man1,
            'cnt2' =>$man2,
            'cnt3' =>$man3,
            'cnt4' =>$man4,
            'cnt5' =>$man5,
            'cnt6' =>$man6,
            'state'=>'Y',
            'msg'=>$msg
        );


        //print_r($data);

        if($this->db->insert('phoenix_items', $data)){
            return true;
        }else{
            echo "err";
            return false;
        }
    }

    function phoenix_items_use($id= '',$state= ''){
		$data = array(
				'state' => $state
		);
		$this->db->where('id', $id);
		if($this->db->update('phoenix_items', $data)){
			return "ok";
		}else{
    return "err";
}
}

    function chk_skiseason_items_duplicate($itemid = ''){
        $sql = "SELECT * FROM pcmsdb.phoenix_skiseason_items where item_id = '{$itemid}' and state = 'Y'";
        $query = $this->db->query($sql);
        $total = $query -> num_rows();
        if($total > 0){
            return false;
        }else{
            return true;
        }
    }

	function kit_bar_num_rows($pin=0){
		return $this->db->get_where('kit_bar', array('no' => $pin),1)->num_rows();
	}
	
	function kit_bar_input($sellcode='',$pcms_id='',$pin=''){
		if($sellcode != '' && $pcms_id !='' && $pin !='' && $this->kit_bar_num_rows($pin) < 1){
			
			$nowtime = date("Y-m-d H:i:s");
			$damnm = $this->session->userdata('nm');
			$damcd = $this->session->userdata('cd');
			$kitbar_log = $damnm."(".$damcd."):".$nowtime;
			
			$data = array(
					'sellcode' =>$sellcode,
					'gu' => $pcms_id,
					'no' =>$pin,
					'useyn' => 'N',
					'logtxt' => $kitbar_log
			);
			if($this->db->insert('kit_bar', $data)){
				return 1;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
		
	}
	
	
	function get_asan_order($pcmsid = ''){
		
		if($pcmsid != 0 && $pcmsid != null){
			$sql = "SELECT * FROM pcmsdb.asan_orders where PCMS_orderid = '".$pcmsid."' order by id desc limit 1";
			$query = $this->db->query($sql);
			return $query->row();
		}
	}

	function get_asan_coupon($ORDER_NO = ''){
		if($ORDER_NO != 0 && $ORDER_NO != null){
			$sql = "SELECT * FROM pcmsdb.asan_coupons where ORDER_NO = '".$ORDER_NO."'";
			return $this->db->query($sql);
		}
	}

    function get_cms_extcoupon($no_coupon = ''){

        if($no_coupon !== 0 && $no_coupon !== null){
           $sql = "SELECT * FROM pcmsdb.cms_extcoupon WHERE no_coupon LIKE '{$no_coupon}' limit 1";
            $query = $this->db->query($sql);
            return $query->row();
        }
    }


	
	
}
?>
