<?php

/**
 * Created by PhpStorm.
 * User: MINO
 * Date: 2017-04-28
 * Time: 오후 3:05
 */

class Ext extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function memberCheck1819(){
        $this->load->view('/ext/memberCheck1819');
    }

    function phoenix_id_chk(){
        $id = $this->input->post('searchid');

        $resultmsg = "";
        //$barbool = "err|";
        $ch = curl_init();
        $url= "http://117.52.116.42/Interface/Ski/ManiaSearch.aspx?id=".$id;
        $json = $this->get_curl($url,$ch);
        $arr = json_decode($json, true);
        /*
        * result	결과	정상 : True, 실패 : False
        msg	내용	하단 코드설명 참조
        check	아이핀인증	Y : 실명인증완료, N : 실명미인증
        cnt	구매횟수
        */
        $phmsg = $arr['msg'];

        switch ($phmsg) {
            case 'DBOK00':
                $resultmsg .= "고객님은 Mad For 시즌권 대상자 입니다.";
                break;

            case 'DBOK01':
                $resultmsg .= "고객님은 Mania 시즌권 대상자 입니다.";
                break;

            case 'DBER01':
                $resultmsg .= "존재 하지 않는 아이디 입니다.";
                break;

            case 'DBER02':
                $resultmsg .= "고객님의 구매 내역은 없습니다";
                break;

            default:
                $resultmsg .= "조회 불가";
                break;
        }

        echo $resultmsg;
    }

    function get_curl($url,$ch) {
        $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)';
        //$ch = curl_init ();
        curl_setopt ($ch, CURLOPT_URL,             $url);
        curl_setopt ($ch, CURLOPT_HEADER,          0);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER,  1);
        curl_setopt ($ch, CURLOPT_POST,            0);
        curl_setopt ($ch, CURLOPT_USERAGENT,       $agent);
        curl_setopt ($ch, CURLOPT_REFERER,         "");
        curl_setopt ($ch, CURLOPT_TIMEOUT,         3);

        $buffer = curl_exec ($ch);
        $cinfo = curl_getinfo($ch);
        curl_close($ch);

        if ($cinfo['http_code'] != 200)
        {
            return "";
        }

        return $buffer;
    }


}