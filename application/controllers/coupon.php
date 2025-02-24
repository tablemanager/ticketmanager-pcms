<?php 

class Coupon extends CI_Controller { 

function __construct() {
		parent::__construct();
		if (!(($this->uri->segment(3) == 'login') || ($this->uri->segment(3) == 'login_ok')))
			$this->is_logged_in();
        $this->sparo2 = $this->load->database('sparo2', TRUE);
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

    //남은 바코드(Sticket) 갯수 현황
    function countck_sticket(){
        $code = $this->input->post('code');
        $sql = "SELECT COUNT(couponno) as cnt FROM `pcms_extcoupon` WHERE sellcode = '{$code}' and syncfac_result = 'N'";
        $query = $this->sparo2->query($sql);
        $result = $query -> row();
        echo $result->cnt;
    }

	function regCoupon()
    {

    	$data['dam_div'] = 'Placem';
    	$data['dam_name'] = '현민우';
    	$data['title'] = 'cms 관리자';
    	$data['contentview'] = '/coupon/regcoupon';
    	$data['leftview'] = 'left';
    	$data['topview'] = 'head';
    	$data['bottomview'] = 'bottom';
    	$this->load->view('/inc/layout',$data);
    }
    
	function setCoupon_menual()
    {

        $this->sparo2 = $this->load->database('sparo2', TRUE);
		
		$sellcode = $this->input->post('sellcode');
		$barnm = $this->input->post('barnm');
		$barcnt = $this->input->post('barcnt');
		$barhp = $this->input->post('barhp');
		$barpass = $this->input->post('barpass');

        //$barcode = "S06372164880";
        //echo "<br/>{$barcode}<br/><img src='/uploads/S06372164880.png' alt='QRCode Image'>";

		if ($barpass == "system1015"){

			if(!$barcnt) $barcnt = 0;

			$orderno ="temp".$sellcode.mktime();
			$orderid ="";


			$uqry ="UPDATE spadb.pcms_extcoupon SET
								  order_no='$orderno',
								  order_id='$orderid',
								  cus_nm='$barnm',
								  cus_hp='$barhp',
								  syncfac_result ='R',
								  mms_state  ='Y',
								  sync_ext1 = 'P',
								  sync_ext2 = 'P',
								  date_order=now()
						where 1
								  and sellcode = '$sellcode'
								  and order_no is NULL
								  and order_id = 0
								  and syncfac_result = 'N'
								  limit $barcnt";
			 if($this->sparo2->query($uqry)){
				 
				$barsql = "SELECT couponno FROM spadb.pcms_extcoupon WHERE order_no = '$orderno'";
				foreach ($this->sparo2->query($barsql)->result() as $row){

                    $barcode = $row->couponno;
                    $this->load->library('ciqrcode');
                    $qr_image= $barcode.'.png';
                    $params['data'] = $barcode;
                    $params['level'] = 'H';
                    $params['size'] = 8;
                    $params['savename'] =FCPATH."uploads/".$qr_image;
                    if($this->ciqrcode->generate($params))
                    {
                        //$data['img_url']=$qr_image;
                        echo "<div class='col-sm-3'><img src='/uploads/{$qr_image}' alt='{$barcode}'><br/>{$barcode}<br/><br/></div>";
                    }
				}
				 
			 }else{
				 echo "발권실패";
			 }
		}else{
			echo "인증오류";
		}


    }	
} 


?>