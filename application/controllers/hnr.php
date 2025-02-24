<?php

/**
 * Created by Editplus
 * User: Cindy
 * Date: 2018-06-14
 * Time: 오전 9:30
 */

class Hnr extends CI_Controller
{

    function __construct() {
		parent::__construct();
		if (!(($this->uri->segment(3) == 'login') || ($this->uri->segment(3) == 'login_ok')))
			$this->is_logged_in();
		$this->sparo = $this->load->database('sparo', TRUE);
        $this->sparo2 = $this->load->database('sparo2', TRUE);

	} 
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
	
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
            $ipAdress  = $_SERVER['REMOTE_ADDR'];
            if($ipAdress != "115.68.42.130" && $ipAdress != "115.68.42.2"){
                redirect('/sys/login');
                die();
            }
		}
	}

	function twoinone() {
		$tb = $this->input->post('tb');
		$no = $this->input->post('no');

		if($tb!="" && $no!=""){
			$woosql="select id,no,nm,sdate,mdate,chk,nick from twoinone.{$tb} where no= '{$no}' limit 5";
			$data['woolist'] = $this->sparo->query($woosql);
		}else{
			$data['woolist'] = false;
		}

		$data['tb'] = $tb;
		$data['no'] = $no;

		$data['title'] = '투인원 인증번호 관리';
        $data['contentview'] = '/hnr/twoinone';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
	}

	function resetid() {
		$choid = $this->input->post('choid');
		$data['choid'] = $choid;
		$tb = $this->input->post('tb');
		$data['tb'] = $tb;

		$woosql="update twoinone.{$tb} set custmt_id=0, chk=0 where id = '{$choid}' limit 1";
		if($this->sparo->query($woosql)){
			echo "ok";
		}else{
			echo "err";
		}
	}

	function upload_excel() {
		$wsql = "select * from spadb.woori_excel where created > current_date() - interval 60 day order by id desc";
        $data['wquery'] = $this->sparo2->query($wsql);

		$data['title'] = '우리은행 고객데이터 업로드';
        $data['contentview'] = '/hnr/upload_excel';
        $data['leftview'] = 'left';
        $data['topview'] = 'head';
        $data['bottomview'] = 'bottom';
        $this->load->view('/inc/layout',$data);
	}

	function insert_order_excel() {
        $ip = $_SERVER["REMOTE_ADDR"];
		$dam = $this->session->userdata('cd');
        $damnm = $this->session->userdata('nm');
        $created = date("Y-m-d H:i:s");

		$woori_select = $this->input->post('woori_select');

		$tmp_name1 = $_FILES["userfile"]["tmp_name"];
        if (!empty($tmp_name1))
        {
            $filename = date("YmdHis")."_".$dam."_".$woori_select.".xlsx";
            $config['file_name'] = $filename;
            $config['upload_path'] = './upload_excel/';
            $config['allowed_types'] = 'xls|XLS|xlsx|XLSX';
            $config['overwrite'] = true;    //같은 이름의 파일이 이미 존재한다면 덮어쓸것
            $config['remove_spaces'] = true;    //TRUE로 설정하면 파일명에 공백이 있을경우 밑줄(_)로 변경
            $config['max_size']	= '2048000000';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload())
            {
                $data = array(
                    'created' => $created,
                    'gp' => $woori_select,
                    'filename' => $filename,
                    'ip' => $ip,
                    'damnm' => $damnm."(".$dam.")"
                );

                $this->sparo2->insert('woori_excel', $data);
            }
            redirect('/hnr/upload_excel');
        }

	}

	function orderExcelDown($id=''){
        $this->load->helper('download');
        if($id != '' && $id != null){
			$dsql = "select * from spadb.woori_excel where id = {$id} limit 1 ";
			$dquery = $this->sparo2->query($dsql);
			$row = $dquery -> row();

            if($row->filename != ''){
                $data = file_get_contents("/home/pcms.placem.co.kr/public_html/upload_excel/".$row->filename);
                force_download($row->filename, $data);
            }
        }else{
            $data = file_get_contents("/home/pcms.placem.co.kr/public_html/upload_excel/WOORISAMPLE.zip");
            force_download("우리은행엑셀업로드양식.zip", $data);
        }
    }

	function upload_excel_stop()
    {
        $this->code = $this->input->post('code');
        $this->sparo2->where('id' , $this->code);
        $this->sparo2->limit(1);
        if($this->sparo2->update('woori_excel',array('inputresult' => 'C'))){
            echo "ok";
        }else{
            echo "err";
        }
    }
}
?>