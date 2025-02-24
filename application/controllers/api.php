<?php

/**
 * Created by PhpStorm.
 * User: MINO
 * Date: 2017-04-28
 * Time: 오후 3:05
 */

class Api extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

    }

    function main(){
        //echo "main";
//        $json = $this->input->post('data');
//        $json = stripslashes($json);
//        $json = json_decode($json);
//        print_r($json);

        $input_data = json_decode(trim(file_get_contents('php://input')), true);
        //print_r($input_data);

        $arr = array("param4"=>1,
            "param5"=>"2",
            "param6"=>"text123"
        );

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('foo' => 'bar')));


        //header('Content-Type: application/json');
        //echo json_encode( $arr );
    }

    function insert_order(){

        $this->load->model('cmsmodel');
        $this->load->model('nsparomodel');

        $input_data = json_decode(trim(file_get_contents('php://input')), true);

        $created = date("Y-m-d H:i:s");
        $usernm = trim($this->input->post('Nusernm')); //고객 이름
        $posthp = preg_replace("/[^0-9]*/s", "", trim($this->input->post('Nhp')));
        $hp = ase_encrypt($posthp); // 휴대폰 번호
        $lasthp = substr($posthp , -4, 4);
        $ch_id = $this->input->post('chn_select'); // 판매채널 ( 2번DB )
        $chnm = $this->cmsmodel->get_CMS_COMPANY($ch_id)->com_nm;//채널이름

        $itemmt_id = $this->input->post('item_select'); // 상품선택 ( 2번DB )
        $itemrow = $this->cmsmodel->get_CMS_ITEMS($itemmt_id);
        $itemnm = $itemrow->item_nm; //itemnm //상품명

        $comrow = $this->cmsmodel->get_CMS_COMPANY($itemrow->item_cpid);
        if($comrow){
            $grmt_id = $comrow->com_id;//대리점아이디
            $grnm = $comrow->com_nm; //대리점이름
        }else{
            $grmt_id = 0;//대리점아이디
            $grnm = ''; //대리점이름
        }

        $facrow = $this->cmsmodel->get_CMS_FACILITIES($itemrow->item_facid);
        if($facrow){
            $jpmt_id =  $facrow->fac_id; //시설 아이디
            $jpnm =  $facrow->fac_nm; //시설 이름
        }else{
            $jpmt_id =  0; //시설 아이디
            $jpnm =  ''; //시설 이름
        }

        $mdate = date("Y-m-d"); //접수일
        $usedate = $this->input->post('Nusedate'); // 이용일
        $ip = $_SERVER["REMOTE_ADDR"];
        $man1 = $this->input->post('Nman'); // 인원

        $pricerow = $this->cmsmodel->get_CMS_PRICES($itemmt_id,$usedate);

        if($pricerow){

            $dan1 = $pricerow->price_normal;//단가 (정상가)
            $amt = $pricerow->price_sale * $man1;//가격 (판매가 x 인원 )
            $accamt = $pricerow->price_sale * $man1; //결제액 (판매가 x 인원 ) : 이전에 쿠폰등의 이슈가 있어 필드가 하나 더 생겼다고 한다.
            $gongamt = $pricerow->price_out * $man1; //(공급가 그냥 입력)
            $gongdan1 = $pricerow->price_out * $man1; //공급가
            $saipamt = $pricerow->price_in * $man1; //(사입가)
            $saipdan1 = $pricerow->price_in * $man1; //사입가
            $jungamt = $pricerow->price_normal * $man1; //(정상가)
            $jungdan1 = $pricerow->price_normal * $man1; //(정상가)
            $saledan1 = $pricerow->price_sale * $man1; //판매가
        }else{
            $dan1 = 0;
            $amt = 0;
            $accamt = 0;
            $gongamt = 0;
            $gongdan1 = 0;
            $saipamt = 0;
            $saipdan1 = 0;
            $jungamt = 0;
            $jungdan1 = 0;
            $saledan1 = 0;
        }

        $raterow = $this->cmsmodel->get_CMS_RATE($ch_id,$itemmt_id);
        if($raterow){
            $ch_rate = $raterow->rate_value;
        }else{
            $ch_rate = 6;
        }
        $ch_pay = ($amt / 100) * ( 100 - $ch_rate );//수수료 ( 판매가에서 수수료율 제외 )

        $state = $this->input->post('state_select'); // 예약완료

        $ch_orderno = $this->input->post('Nchorderno'); // 판매채널 주문번호
        $dammemo = $this->input->post('Nmemo'); // 메모
        $dammt_id = $this->session->userdata('id'); //담당자 아이디
        $damnm = $this->session->userdata('nm');

        $usegu = '2';
        $site = 'PCMS2';

        // 주문번호 생성
        $orderno =  date("Ymd")."_PM2".$itemmt_id.date("His");

        $data = array(
            'updated' => $created,
            'created' => $created,
            'usernm' => $usernm,
            'hp' => $hp,
            'usernm2' => $usernm,
            'hp2' => $hp,
            'lasthp' => $lasthp,
            'ch_id' => $ch_id,
            'chnm' => $chnm,
            'itemmt_id' => $itemmt_id,
            'itemnm' => $itemnm,
            'grmt_id' => $grmt_id,
            'grnm' => $grnm,
            'jpmt_id' => $jpmt_id,
            'jpnm' =>  $jpnm,
            'mdate' => $mdate,
            'usedate' => $usedate,
            'ip' => $ip,
            'man1' => $man1,
            'dan1' => $dan1,
            'amt' => $amt,
            'orderno' => $orderno,
            'accamt' => $accamt,
            'gongamt' => $gongamt,
            'gongdan1' => $gongdan1,
            'saipamt' => $saipamt,
            'saipdan1' => $saipdan1,
            'jungamt' => $jungamt,
            'jungdan1' => $jungdan1,
            'saledan1' => $saledan1,
            'ch_rate' => $ch_rate,
            'ch_pay' => $ch_pay,
            'state' => $state,
            'ch_orderno' => $ch_orderno,
            'dammemo'=> $dammemo,
            'dammt_id' => $dammt_id,
            'damnm' => $damnm,
            'usegu' => $usegu,
            'site' => $site
        );
        if($this->nsparomodel->insertOrdermts($data)){
            echo "ok|등록이 완료되었습니다.";
        }else{
            echo "err|등록 실패";
        }
        //print_r($data);
    }

}