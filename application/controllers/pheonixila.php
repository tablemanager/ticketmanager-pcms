<?php
ini_set('memory_limit', '-1');

$s = phoenix_coupon('excel');
echo '11';

class pheonixila extends CI_Controller
{
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

    function phoenix_coupon($mode=''){
        if ($mode == 'new') {
            $data['orderno'] = '';
            $data['ch_orderno'] = '';
            $data['actlUserNm'] = '';
            $data['actlUserMpNo'] = '';
            $data['useyn'] = '';
            $data['pkgCd'] = '';
            $data['prchrNm'] = '';
            $data['rprsSellNo'] = '';
            $data['rprsBarCd'] = '';
            $data['regDt_start'] = '2020-11-01';
            $data['regDt_end'] = date('Y-m-d');
            $data['limit'] = '';
            $data['offset'] = 0;

            $this->session->set_userdata($data);
        }

        if($this->session->userdata('offset') != '' && $this->session->userdata('offset') != null ){
            $offset= $this->session->userdata('offset');
        }else{
            $offset= 0;
        }

        $data['orderno'] = $this->session->userdata('orderno');
        $data['ch_orderno'] = $this->session->userdata('ch_orderno');
        $data['actlUserNm'] = $this->session->userdata('actlUserNm');
        $data['actlUserMpNo'] = $this->session->userdata('actlUserMpNo');
        $data['useyn'] = $this->session->userdata('useyn');
        $data['pkgCd'] = $this->session->userdata('pkgCd');
        $data['prchrNm'] = $this->session->userdata('prchrNm');
        $data['rprsSellNo'] = $this->session->userdata('rprsSellNo');
        $data['rprsBarCd'] = $this->session->userdata('rprsBarCd');
        $data['regDt_start'] = $this->session->userdata('regDt_start');
        $data['regDt_end'] = $this->session->userdata('regDt_end');
        $data['limit'] = $this->session->userdata('limit');

        $where = $this->coupon_make_query($data);

        // 조건 없으면 2020년 11월 데이터부터
        if ($where == "1") {
            $where = $where . " and c.reg_date > '2020-11-01 00:00:00'";
        }

        //2019-12-20 GROUP BY c.id  추가 중복 데이터 가져오는 문제
        $limit = 50;
        if ($mode == 'excel') {
            $limit = 999999;
        }

        $sql = "SELECT
                SQL_CALC_FOUND_ROWS c.id, c.orderid, c.orderno, c.ch_orderno, c.actlUserNm, c.actlUserMpNo, c.sellDate, c.asgnDate, c.useyn, c.sync, c.statusCode, c.status,
                c.rprsSellNo, c.rprsBarCd, c.roomRprsRsrvNo, c.roomRsrvNo, c.roomStayNo, c.info_statusCode, c.info_status, c.midwkWkndDivCd, c.pkglist_id, c.reg_date
                FROM phoenix_pkgcoupon c WHERE {$where} ";
        $sql .= " ORDER BY c.id DESC limit $offset, $limit";
        $query = $this->sparo2->query($sql);
        $sql_total = "SELECT FOUND_ROWS() as totalCnt;";
        $query_total = $this->sparo2->query($sql_total);
        $cnt_tmp = $query_total->row();
        $total_rows = (int) $cnt_tmp->totalCnt;

        echo "alert(".print_r($query).")";

        $list = [];
        $list_pkg = [];
        foreach ($query->result() as $row) {
            $list_pkg[] = $row->pkglist_id;
            $list[] = $row;
        }
        $list_pkg = array_unique($list_pkg);

        $pkg_info = [];
        if (count($list_pkg) > 0) {
            $sql = "SELECT id, pkgCd, pkgNm, useFromDate, useToDate FROM phoenix_pkglist WHERE id IN ('" . implode("','", $list_pkg) . "');";
            $query = $this->sparo2->query($sql);
            foreach ($query->result() as $row) {
                $pkg_info[$row->id] = $row;
            }
        }

        if ($mode == 'excel') {
            $this->load->library('excel');
            $this->excel->setActiveSheetIndex(0);
            $this->excel->getActiveSheet()->setTitle('phoenix');
            $cnt = 1;

            $this->excel->getActiveSheet()->setCellValueExplicit('A'.$cnt,'패키지코드'." ",PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValueExplicit('B'.$cnt,'패키지명'." ",PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValueExplicit('C'.$cnt,'사용시작일자'." ",PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValueExplicit('D'.$cnt,'사용종료일자'." ",PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValueExplicit('E'.$cnt,'주문아이디'." ",PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValueExplicit('F'.$cnt,'주문번호'." ",PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValueExplicit('G'.$cnt,'이름'." ",PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValueExplicit('H'.$cnt,'휴대폰번호'." ",PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValueExplicit('I'.$cnt,'판매일자'." ",PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValueExplicit('J'.$cnt,'사용상태'." ",PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValueExplicit('K'.$cnt,'사용일자'." ",PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValueExplicit('L'.$cnt,'등록결과코드'." ",PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValueExplicit('M'.$cnt,'등록결과메세지'." ",PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValueExplicit('N'.$cnt,'대표판매번호'." ",PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValueExplicit('O'.$cnt,'대표쿠폰번호'." ",PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValueExplicit('P'.$cnt,'객실대표예약번호'." ",PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValueExplicit('Q'.$cnt,'객실예약번호'." ",PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValueExplicit('R'.$cnt,'투숙순번'." ",PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValueExplicit('S'.$cnt,'상태코드'." ",PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValueExplicit('T'.$cnt,'상태메세지'." ",PHPExcel_Cell_DataType::TYPE_STRING);
            $this->excel->getActiveSheet()->setCellValueExplicit('U'.$cnt,'주중주말코드'." ",PHPExcel_Cell_DataType::TYPE_STRING);

            foreach ($list as $row) {
                $cnt++;

                $this->excel->getActiveSheet()->setCellValueExplicit('A'.$cnt, isset($pkg_info[$row->pkglist_id]->pkgCd) ? $pkg_info[$row->pkglist_id]->pkgCd : '', PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValueExplicit('B'.$cnt, isset($pkg_info[$row->pkglist_id]->pkgNm) ? $pkg_info[$row->pkglist_id]->pkgNm : '', PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValueExplicit('C'.$cnt, isset($pkg_info[$row->pkglist_id]->useFromDate) ? $pkg_info[$row->pkglist_id]->useFromDate : '', PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValueExplicit('D'.$cnt, isset($pkg_info[$row->pkglist_id]->useToDate) ? $pkg_info[$row->pkglist_id]->useToDate : '', PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValueExplicit('E'.$cnt, $row->orderid, PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValueExplicit('F'.$cnt, $row->orderno, PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValueExplicit('G'.$cnt, $row->actlUserNm, PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValueExplicit('H'.$cnt, $row->actlUserMpNo, PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValueExplicit('I'.$cnt, $row->sellDate, PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValueExplicit('J'.$cnt, $row->useyn, PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValueExplicit('K'.$cnt, $row->asgnDate, PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValueExplicit('L'.$cnt, $row->statusCode, PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValueExplicit('M'.$cnt, $row->status, PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValueExplicit('N'.$cnt, $row->rprsSellNo, PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValueExplicit('O'.$cnt, $row->rprsBarCd, PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValueExplicit('P'.$cnt, $row->roomRprsRsrvNo, PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValueExplicit('Q'.$cnt, $row->roomRsrvNo, PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValueExplicit('R'.$cnt, $row->roomStayNo, PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValueExplicit('S'.$cnt, $row->info_statusCode, PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValueExplicit('T'.$cnt, $row->info_status, PHPExcel_Cell_DataType::TYPE_STRING);
                $this->excel->getActiveSheet()->setCellValueExplicit('U'.$cnt, $row->midwkWkndDivCd, PHPExcel_Cell_DataType::TYPE_STRING);
            }

            $_date = date('Y-m-d');
            $filename='phoenix_'.$_date.'.xls'; // 엑셀 파일 이름

            header('Content-Type: application/vnd.ms-excel'); //mime 타입
            header('Content-Disposition: attachment;filename="'.$filename.'"'); // 브라우저에서 받을 파일 이름
            header('Cache-Control: max-age=0'); //no cache

            // Excel5 포맷으로 저장 엑셀 2007 포맷으로 저장하고 싶은 경우 'Excel2007'로 변경합니다.
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
            // 서버에 파일을 쓰지 않고 바로 다운로드 받습니다.
            $objWriter->save('php://output');
        } else {
            $this->load->library('pagination');
            $config['base_url'] = '/index.php/phoenix/phoenix_coupon_offset/';
            $config['total_rows'] =  $total_rows;
            $config['per_page'] = $limit;
            $config['cur_page'] = $offset;
            $config['uri_segment'] = 3;

            $this->pagination->initialize($config);

            page_default_set($config);
            $this->pagination->initialize($config);
            $data['pag_links'] = $this->pagination->create_links();

            $data['offset'] = $offset;
            $data['list'] = $list;
            $data['pkg_info'] = $pkg_info;
            // $data['query'] = $query;
            $data['title'] = '휘닉스파크 쿠폰';
            $data['leftview'] = 'left';
            $data['contentview'] = '/phoenix/phoenix_coupon';
            $this->load->view('/inc/layout',$data);
        }
    }
