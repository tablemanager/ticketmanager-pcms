<?php 

class Naver extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $ipAdress = $_SERVER['REMOTE_ADDR'];
        if ($ipAdress != "115.68.42.130" && $ipAdress != "115.68.42.2" && $ipAdress != "118.131.208.124") {
            die();
        }
        $this->sparo2 = $this->load->database('sparo2', TRUE);
    }


    function phoenix_order_chk_api($bcno = '')
    {
        $result = "E";

        $ch = curl_init();
        if ($bcno != 0 && $bcno != null) {
            $bcno = str_replace(";", "", $bcno);
            $orrow = $this->phoenix_get_order($bcno);
            $divs = $orrow->divs;
            if ($divs == "SIN") {
                $url = "http://117.52.116.42/Interface/Ticket/ResQuery.aspx?barcode=" . $bcno;
                $json = $this->get_curl($url, $ch);
                $result = $json;
            } else {
                $url = "http://117.52.116.42/Interface/Ticket/SetQuerys.aspx?tcode=" . $orrow->tcode . "&barcode=" . $bcno; //3인세트권 권종코드
                $json = $this->get_curl($url, $ch);
                $result = $json;
            }
        }
        echo $result;
    }

    function phoenix_get_order($barcode)
    {
        $this->sparo2 = $this->load->database('sparo2', TRUE);
        $getqry = "SELECT * FROM spadb.bg_ordermts WHERE no = '$barcode' order by id desc limit 1";
        return $this->sparo2->query($getqry)->row(); // 쿼리불러옴
    }

    function phoenix_disuse_api($bcno = '')
    {

        $result = "E";
        $ch = curl_init();
        if ($bcno != 0 && $bcno != null) {
            $bcno = str_replace(";", "", $bcno);
            $orrow = $this->phoenix_get_order($bcno);
            $divs = $orrow->divs;

            if ($divs == "SIN") {
                $url = "http://117.52.116.42/Interface/Ticket/ResCancel.aspx?barcode=" . $bcno;
                $json = $this->get_curl($url, $ch);
                $result = $json;
            } else {

                $url = "http://117.52.116.42/Interface/Ticket/SetCancel.aspx?hp=" . str_replace("-", "", $orrow->hp) . "&orderdate=" . $orrow->saledate . "&cnt=" . $orrow->qty . "&barcode=" . $bcno; //3인세트권 권종코드
                $json = $this->get_curl($url, $ch);
                $result = $json;
            }
        }
        echo $result;
    }

    function get_curl($url, $ch)
    {
        $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)';
        //$ch = curl_init ();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_REFERER, "");
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);

        $buffer = curl_exec($ch);
        $cinfo = curl_getinfo($ch);
        curl_close($ch);

        if ($cinfo['http_code'] != 200) {
            return "";
        }
        return $buffer;
    }

}


?>