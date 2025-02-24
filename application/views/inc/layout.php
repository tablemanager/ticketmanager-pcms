<?php
define("__CASTLE_PHP_VERSION_BASE_DIR__", "/home/sys.placem.co.kr/public_html/csp");
//include_once(__CASTLE_PHP_VERSION_BASE_DIR__ . "/castle_referee.php");
?>

<?
/*
$ip = $_SERVER["REMOTE_ADDR"];
if ($ip == "118.131.208.122" or $ip == "118.131.208.123" or $ip == "118.131.208.124" or $ip == "118.131.208.125" or $ip == "118.131.208.126"
		or $ip == "14.39.252.223" or $ip ==  "115.89.22.27" or $ip ==  "106.254.252.100"
	or $this->session->userdata('cd') == 'penfen' or $this->session->userdata('cd') == 'jjlee' or $this->session->userdata('cd') == 'choiji07'
		or $this->session->userdata('cd') == 'pyr87' or $this->session->userdata('cd') == 'jeunmee' or $this->session->userdata('cd') == 'v1771'
    or $this->session->userdata('cd') == 'jm5035' or $this->session->userdata('cd') == 'ehkim'
	){
	//echo $ip; or $this->session->userdata('cd') == 'dews0713' or $this->session->userdata('cd') == 'euna1211'
}else{
	exit;
}*/
$burl = $_SERVER['REQUEST_URI'];
if(strpos($burl, 'bar/') || strpos($burl, 'bar/everland') || strpos($burl, 'nexon/coupon' )  || strpos($burl, 'bar/make' ) ){

}else{
    redirect("http://mcca.sparo.cc/"); die();
}

$ip = $_SERVER["REMOTE_ADDR"];
$buseo = $this->session->userdata('buseo');
if($buseo != "뿌리깊은나무"
    && $ip != "118.131.208.122"
    && $ip != "118.131.208.123"
    && $ip != "118.131.208.124"
    && $ip != "118.131.208.125"
    && $ip != "118.131.208.126"
    && $ip != "14.39.252.223"
    && $ip != "115.89.22.27"    //콜센터
    && $ip != "115.89.22.28"    //콜센터
    && $ip != "106.254.252.100" //개발망
    && $ip != "112.216.122.243" //고객센터
    && $ip != "61.74.186.246"   // 20241127 tony 테이블메니저 VPN 허용
){
    //20240801 tony 비즈팀 VPN 장애로 접속제한 해제
    if(date("Ymd") != "20240801") 
    exit;
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>PCMS2.0</title>
    <link href="/css/application.min.css" rel="stylesheet">
    <link href="/css/michael.css" rel="stylesheet">
    <!-- as of IE9 cannot parse css files with more that 4K classes separating in two files -->
    <!--[if IE 9]>
        <link href="/css/application-ie9-part2.css" rel="stylesheet">
    <![endif]-->
    <link rel="shortcut icon" href="/img/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <script>
        /* yeah we need this empty stylesheet here. It's cool chrome & chromium fix
         chrome fix https://code.google.com/p/chromium/issues/detail?id=167083
         https://code.google.com/p/chromium/issues/detail?id=332189
         */
    </script>
</head>
<body>


<!-- common libraries. required for every page-->
<script src="/vendor/jquery/dist/jquery.min.js"></script>
<script src="/vendor/jquery-pjax/jquery.pjax.js"></script>
<script src="/vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/transition.js"></script>
<script src="/vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/collapse.js"></script>
<script src="/vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/dropdown.js"></script>
<script src="/vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/button.js"></script>
<script src="/vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/tooltip.js"></script>
<script src="/vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/alert.js"></script>
<script src="/vendor/jQuery-slimScroll/jquery.slimscroll.min.js"></script>
<script src="/vendor/widgster/widgster.js"></script>
<script src="/vendor/pace.js/pace.min.js"></script>
<script src="/vendor/jquery-touchswipe/jquery.touchSwipe.js"></script>

<!-- common app js -->
<script src="/js/settings.js"></script>
<script src="/js/app.js"></script>

<!-- page specific libs -->
<script src="/vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/popover.js"></script>
<script src="/vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/modal.js"></script>
<!-- page specific js -->
<script src="/js/ui-components.js"></script>

<?php

	//$this->load->view("/inc/leftview.php");

	//$this->load->view("/inc/topview.php");

	$this->load->view("/$contentview.php");
?>

</body>
</html>
