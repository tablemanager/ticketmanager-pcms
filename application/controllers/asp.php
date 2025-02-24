<?php
/**
 * Created by PhpStorm.
 * User: BBUNA_SYSTEM
 * Date: 2019-01-23
 * Time: 오후 1:17
 */

class Asp extends CI_Controller{

    function __construct() {
        parent::__construct();
        /* if (!(($this->uri->segment(3) == 'login') || ($this->uri->segment(3) == 'login_ok')))
            $this->is_logged_in(); */
        $this->load->model('usermodel');
    }

    //로그인
    function auth($cd,$path1,$path2,$path3="")
    {
        $query = $this->db->query("select * from pcms_account where cd = '$cd' and visible = '1' limit 1");
        $row = $query->row();
        //로그인 성공
        if($row){
            $data = array(
                'id'           => $row->id,
                'cd'           => $this->input->post('username'),
                'nm'           => $row->nm,
                'jikwi'        => $row->jikwi,
                'gu'           => $row->gu,
                'login'        => date("Y-m-d H:i:s",time()),
                'lastlogin'    => $row->lastlogin,
                'created'      => $row->created,
                'updated'      => $row->updated,
                'rolegu'       => $row->rolegu,
                'company'      => $row->company,
                'role'         => $row->gu,
                'logincnt'     => $row->logincnt,
                'buseo'        => $row->buseo,
                'is_logged_in' => true,
            );
            //세션 등록
            $this->session->set_userdata($data);
            redirect($path1."/".$path2."/".$path3, 'refresh');
        }

    }

}
