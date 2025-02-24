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
	
	function cms_input_company($typepick='',$companyname=''){
		$data = array(
				'com_type' => $typepick,
				'com_nm' => $companyname,
				'com_state' => 'Y'
		);
		if($this->cms->insert('CMS_COMPANY', $data)){
			$inItemId = $this->cms->insert_id();
			$this->pcms_input_company($companyname,$inItemId,$typepick);		//PCMS 업체등록
			$this->oldsparo_input_company($companyname,$inItemId,$typepick);	//구스파로 업체등록
			$this->newsparo_input_company($companyname,$inItemId,$typepick);	//뉴스파로 업체등록
			return true;
		}else{
			return false;
		}

	}
	//PCMS 업체등록
	function pcms_input_company($companyname='',$inItemId='',$typepick=''){
	
	
		$inTime = date("Y-m-d H:i:s");
		$mdate = date("Y-m-d");
		
		$typearr = array(
				"C"=> "판매채널",
				"S"=> "대리점"
		);
		$data = array(
				'id' => $inItemId,
				'Created_at' => $inTime,
				'Updated_at' => $inTime,
				'mdate' => $mdate,
				'nm' => $companyname,
				'visible' => '1',
				'gu' => $typearr[$typepick],
				'site' => 'CMS'
		);
		
		if($this->pcms->insert('grmts', $data)){
			return true;
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
			//$this->oldsparo_use_company($id,$useyn); //구 스파로는 사용미사용이 없나보다.
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
	
	//구스파로 사용,미사용 사용안함.
	function oldsparo_use_company($id= '',$useyn= ''){
	
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
		if($this->sparo->update('grmts', $data)){
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
	
	function cms_input_facilities($company_select= '',$facname= ''){

		$data = array(		
				'fac_nm' => $facname,
				'fac_state' => 'Y',
				'fac_cpid' => $company_select
		);
		if($this->cms->insert('CMS_FACILITIES', $data)){
			$inItemId = $this->cms->insert_id();
			$this->pcms_input_facilities($company_select,$facname,$inItemId);		//PCMS 시설등록
			$this->oldsparo_input_facilities($company_select,$facname,$inItemId);	//구스파로 시설등록
			$this->newsparo_input_facilities($company_select,$facname,$inItemId);	//뉴스파로 시설등록
			return true;
		}else{
			return false;
		}
	}
	
	//PCMS 시설등록
	function pcms_input_facilities($company_id='',$facname='',$fac_id=''){
		
		$inTime = date("Y-m-d H:i:s");
		$mdate = date("Y-m-d");
	
		$data = array(
				'id' => $fac_id,
				'Created_at' => $inTime,
				'Updated_at' => $inTime,
				'mdate' => $mdate,
				'nm' => $facname,
				'visible' => '1',
				'gu' => '시설',
				'site' => 'CMS'
		);
	
		if($this->pcms->insert('grmts', $data)){
			return true;
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
	function cms_input_items($fac_select='',$itemname='',$item_sdate='',$item_edate=''){
	
		//날짜형식 변경
		if($item_sdate!="" && $item_sdate != null){
			$date_arr = split("/",$item_sdate);
			$item_sdate = $date_arr[2]."-".$date_arr[0]."-".$date_arr[1]." 00:00:00";
		}
		if($item_edate!="" && $item_edate != null){
			$date_arr = split("/",$item_edate);
			$item_edate = $date_arr[2]."-".$date_arr[0]."-".$date_arr[1]." 23:59:59";
		}
		
		$item_cpid = $this->cms_get_comid_for_facid($fac_select);
		$data = array(
				'item_nm' => $itemname,
				'item_sdate' => $item_sdate,
				'item_edate' => $item_edate,
				'item_state' => 'Y',
				'item_cpid' => $item_cpid,
				'item_facid' => $fac_select
		);
		if($this->cms->insert('CMS_ITEMS', $data)){
			$inItemId = $this->cms->insert_id();
			$this->pcms_input_items($itemname,$inItemId,$item_cpid,$fac_select);		//PCMS 상품등록
			$this->oldsparo_input_items($itemname,$inItemId,$item_cpid,$fac_select);	//구스파로 상품등록
			$this->newsparo_input_items($itemname,$inItemId,$item_cpid,$fac_select);	//뉴스파로 상품등록
			return true;
		}else{
			return false;
		}
	}
	//PCMS 상품등록
	function pcms_input_items($itemname='',$inItemId='',$item_cpid='',$item_facid=''){
		
		$inTime = date("Y-m-d H:i:s");
		
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
				'jpmt_id' => $item_facid,
				'site' => 'CMS'
		);

		if($this->pcms->insert('itemmts', $data)){
			return true;
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
				'jpmt_id' => $item_facid
		);
	
		if($this->sparo2->insert('itemmts', $data)){
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
	
	function cms_input_price(
			$item_select = '',$price_date = '',$normalPrice = '',$salePrice = '',
			$inPrice = '',$outPrice = '',$qty = ''){
		$date_arr = explode("/",$price_date);
		$price_date = $date_arr[2]."-".$date_arr[0]."-".$date_arr[1];
		
		$inTime = date("Y-m-d H:i:s");
		$damnm = $this->session->userdata('nm');
		$damcd = $this->session->userdata('cd');
		$price_log = $inTime.":".$damnm."(".$damcd.") 등록";
		
		$data = array(
				'price_itemid' => $item_select,
				'price_date' => $price_date,
				'price_normal' => $normalPrice,
				'price_sale' => $salePrice,
				'price_in' => $inPrice,
				'price_out' => $outPrice,
				'price_qty' => $qty,
				'price_regdate' => $inTime,
				'price_moddate' => $inTime,
				'price_log' => $price_log
		);
		if($this->cms->insert('CMS_PRICES', $data)){
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
				$thislogtxt=''){ 

		//날짜형식 변경
		if($use_sdate!="" && $use_sdate != null){
			$date_arr = explode("/",$use_sdate);
			$use_sdate = $date_arr[2]."-".$date_arr[0]."-".$date_arr[1]." 00:00:00";
		}
		if($use_edate!="" && $use_edate != null){
			$date_arr = explode("/",$use_edate);
			$use_edate = $date_arr[2]."-".$date_arr[0]."-".$date_arr[1]." 23:59:59";
		}
		$data = array(
				'gp' =>$chnpick,
				'sellcode' =>$sellcode,
				'itemnm' =>$pcms_itemnm,
				'pcms_id' =>$pcmsitem_id,
				'chnm' =>'플레이스엠',
				'chcode' =>'PM',	
				'sdate' =>$use_sdate,
				'edate' =>$use_edate,
				'useyn' =>'Y',
				'regdate' =>date('Y-m-d H:i:s'),
				'mms_text' =>$textarea_value,
				'manager' =>$manager,
				'kit_log' =>$thislogtxt
		);
		if($this->db->insert('kit_lms', $data)){
			return true;
		}else{
			return false;
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
	
	
}
?>