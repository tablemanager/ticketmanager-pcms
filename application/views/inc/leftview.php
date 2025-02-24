<?php 
$rolegu = $this->session->userdata('rolegu');
$buseo = $this->session->userdata('buseo');
$cd = $this->session->userdata('cd');

$show01 = false; //주문
$show02 = false; //연동
$show03 = false; //쿠폰
$show04 = false; //통계
$show05 = false; //설정
$show06 = false; //B2B
$show07 = false; //우리은행
$show08 = false; //플레이스엠->인턴용
$show09 = false; //주문(2)->CS용
$show10 = false; //문자

switch($rolegu){
	case 'CRI':
        $show01 = true;
        $show02 = true;
        $show03 = true;
        $show04 = true;
        $show05 = true;
        $show10 = true;
		$show07 = true;
		break;
	case 'AL':
		$show08 = true;
		break;
	case 'CS':
		$show09 = true;
		break;
	case 'FR':
		$show01 = true;
		$show02 = true;
		$show03 = true;
		$show04 = true;
		$show05 = true;
		$show06 = true;
		$show10 = true;
		break;
	case 'AD':
		$show01 = true;
		$show02 = true;
		$show03 = true;
		$show04 = true;
		$show05 = true;
		$show06 = true;
		$show07 = true;
		$show10 = true;
		//$show08 = true;
		break;
    case 'BS':
        $show01 = true;
        $show02 = true;
        $show03 = true;
        $show04 = true;
        $show05 = true;
        $show06 = true;
        $show07 = true;
        $show10 = true;
        break;
	default:
		$show01 = true;
		$show02 = true;
		$show03 = true;
		$show04 = true;
		$show05 = true;
		$show10 = true;
		break;
}

$depth01= false;
$depth01_1= false;
$depth01_2= false;
$depth01_3= false;
$depth01_4= false;
$depth01_5= false;
$depth01_6= false;
$depth01_7= false; #CS_nexon
$depth01_7_1= false;
$depth01_7_2= false;
$depth01_8= false; #CS TOAST
$depth01_9= false; #CS phoenix_coupon

if(strpos($contentview, '/orderc/olist') !== false){
	$depth01= true;
	$depth01_1= true;
}else if(strpos($contentview, '/order/sms') !== false){
	$depth01= true;
	$depth01_2= true;
}else if(strpos($contentview, '/coupon/regcoupon') !== false){
	$depth01= true;
	$depth01_3= true;
}else if(strpos($contentview, '/orderc/toast') !== false){
	$depth01= true;
	$depth01_4= true;
}else if(strpos($contentview, '/order/upload_excel') !== false){
	$depth01= true;
	$depth01_5= true;
}else if(strpos($contentview, '/orderc/highone') !== false){
	$depth01= true;
	$depth01_6= true;
}else if(strpos($contentview, '/csnexon/') !== false){ #CS_nexon
    $depth01= true;
    $depth01_7= true;
    if(strpos($contentview, '/nexon/item') !== false) $depth01_7_1= true;
    if(strpos($contentview, '/nexon/coupon') !== false) $depth01_7_2= true;
}else if(strpos($contentview, '/orderc/toast') !== false){
	$depth01= true;
	$depth01_8= true;
}else if(strpos($contentview, '/csphoenix/') !== false){ #CS phoenix_coupon
    $depth01= true;
    $depth01_9= true;
}


$depth02= false;
$depth02_1= false;
$depth02_2= false;
$depth02_3= false;
$depth02_4= false;
$depth02_4_1= false;
$depth02_4_2= false;
$depth02_4_3= false;
$depth02_4_4= false;
$depth02_5= false;
$depth02_5_1= false;
$depth02_5_2= false;
$depth02_6= false;
$depth02_7= false;
$depth02_8= false;
$depth02_9= false;
$depth02_9_1= false;
$depth02_9_2= false;
$depth02_10= false;

if(strpos($contentview, '/sell/info') !== false){
	$depth02= true;
	$depth02_1= true;
}else if(strpos($contentview, '/cms/sync') !== false){
	$depth02= true;
	$depth02_2= true;
}else if(strpos($contentview, '/sell/onemount') !== false){
	$depth02= true;
	$depth02_3= true;
}else if(strpos($contentview, '/phoenix/') !== false){
	$depth02= true;
	$depth02_4= true;
    if(strpos($contentview, '/phoenix/phoenix_pkg') !== false) $depth02_4_1= true;
    if(strpos($contentview, '/phoenix/phoenix_coupon') !== false) $depth02_4_2= true;
    if(strpos($contentview, '/phoenix/skiseason_item') !== false) $depth02_4_3= true;
    if(strpos($contentview, '/sync/phoenix_items') !== false) $depth02_4_4= true;
}else if(strpos($contentview, '/sync/naver') !== false){
	$depth02= true;
	$depth02_5= true;
	if(strpos($contentview, '/sync/naver_bizcode') !== false) $depth02_5_1= true;
	if(strpos($contentview, '/sync/naver_item') !== false) $depth02_5_2= true;
}else if(strpos($contentview, '/sell/playcity') !== false){
	$depth02= true;
	$depth02_6= true;
}else if(strpos($contentview, '/sell/dukgu') !== false){
	$depth02= true;
	$depth02_7= true;
}else if(strpos($contentview, '/sell/crowling') !== false){
    $depth02 = true;
    $depth02_8 = true;
}else if(strpos($contentview, '/nexon/') !== false){
    $depth02= true;
    $depth02_9= true;
    if(strpos($contentview, '/nexon/item') !== false) $depth02_9_1= true;
    if(strpos($contentview, '/nexon/coupon') !== false) $depth02_9_2= true;
}else if(strpos($contentview, '/sell/hanwha') !== false){
    $depth02= true;
    $depth02_10= true;
}

$depth03= false;
$depth03_1= false;
$depth03_2= false;
$depth03_3= false;
$depth03_4= false;
$depth03_5= false;
$depth03_6= false;
$depth03_7= false;
$depth03_8= false;

if(strpos($contentview, '/everland/coupon') !== false){
	$depth03= true;
	$depth03_1= true;
}else if(strpos($contentview, '/everland/sticket') !== false){
    $depth03= true;
    $depth03_2= true;
}else if(strpos($contentview, '/bar/coupon') !== false){
	$depth03= true;
	$depth03_3= true;
}else if(strpos($contentview, '/bar/make') !== false){
	$depth03= true;
	$depth03_4= true;
}else if(strpos($contentview, '/emart/code') !== false){
	$depth03= true;
	$depth03_5= true;
}else if(strpos($contentview, '/emart/coupon') !== false){
	$depth03= true;
	$depth03_6= true;
}else if(strpos($contentview, '/lotte/eventlist') !== false){
    $depth03= true;
    $depth03_7= true;
}else if(strpos($contentview, '/refund/refundlist') !== false){
	$depth03= true;
	$depth03_8= true;
}


$depth04= false;
$depth04_1= false;
$depth04_2= false;
$depth04_3= false;
$depth04_4= false;
if(strpos($contentview, '/everland/count') !== false){
	$depth04= true;
	$depth04_1= true;
}else if(strpos($contentview, '/emart/count') !== false){
	$depth04= true;
	$depth04_2= true;
}else if(strpos($contentview, '/stats/use_order') !== false){
	$depth04= true;
	$depth04_3= true;
}else if(strpos($contentview, '/elcb/count') !== false){
    $depth04= true;
    $depth04_4= true;
}


$depth05= false;
$depth05_1= false;
$depth05_2= false;
$depth05_3= false;
if(strpos($contentview, '/cms/company') !== false){
	$depth05= true;
	$depth05_1= true;
}else if(strpos($contentview, '/cms/facilities') !== false){
	$depth05= true;
	$depth05_2= true;
}else if(strpos($contentview, '/cms/items') !== false){
	$depth05= true;
	$depth05_3= true;
}

$depth06= false;
$depth06_1= false;
$depth06_2= false;
$depth06_2_1= false;
$depth06_3= false;
$depth06_3_1= false;
$depth06_3_2= false;
$depth06_4= false;
$depth06_5= false;
$depth06_6= false;
if(strpos($contentview, '/b2b/notice') !== false){
	$depth06= true;
	$depth06_1= true;
}else if(strpos($contentview, '/b2b/account') !== false){
	$depth06= true;
	$depth06_2= true;
	$depth06_2_1= true;
}else if(strpos($contentview, 'b2b/plm_item') !== false){
	$depth06= true;
	$depth06_3= true;
	$depth06_3_1= true;
}else if(strpos($contentview, 'b2b/package_item') !== false){
	$depth06= true;
	$depth06_3= true;
	$depth06_3_2= true;
}else if(strpos($contentview, 'b2b/everland_order') !== false){
	$depth06= true;
	$depth06_4= true;
}else if(strpos($contentview, 'b2b/everland_coupon_search') !== false){
	$depth06= true;
	$depth06_5= true;
}else if(strpos($contentview, 'b2b/evcode') !== false){
	$depth06= true;
	$depth06_6= true;
}

$depth07= false;
$depth07_1= false;
$depth07_2= false;
$depth07_3= false;
if(strpos($contentview, '/hnr/twoinone') !== false){
	$depth07= true;
	$depth07_1= true;
}else if(strpos($contentview, '/hnr/upload_excel') !== false){
	$depth07= true;
	$depth07_2= true;
}else if(strpos($contentview, '/order/sms') !== false){
    $depth07= true;
    $depth07_3= true;
}

$depth08= false;
$depth08_1= false;
$depth08_2= false;
$depth08_3= false;
$depth08_4= false;
$depth08_5= false;
$depth08_6= false;
$depth08_7= false;
$depth08_8= false;
$depth08_9= false;
$depth08_10= false;
if(strpos($contentview, '/orderc/olist') !== false){
    $depth08= true;
    $depth08_1= true;
}else if(strpos($contentview, '/order/sms') !== false){
    $depth08= true;
    $depth08_2= true;
}else if(strpos($contentview, '/everland/coupon') !== false){
    $depth08= true;
    $depth08_3= true;
}else if(strpos($contentview, '/everland/sticket') !== false){
    $depth08= true;
    $depth08_4= true;
}else if(strpos($contentview, '/emart/coupon') !== false){
    $depth08= true;
    $depth08_5= true;
}else if(strpos($contentview, '/orderc/toast') !== false){
    $depth08= true;
    $depth08_6= true;
}else if(strpos($contentview, '/orderc/highone') !== false){
    $depth08= true;
    $depth08_7= true;
}else if(strpos($contentview, '/nexon/coupon') !== false){
    $depth08= true;
    $depth08_8= true;
}else if(strpos($contentview, '/order/upload_excel') !== false){
    $depth08= true;
    $depth08_9= true;
}else if(strpos($contentview, '/phoenix/phoenix_coupon') !== false){
    $depth08= true;
    $depth08_10= true;
}


$depth10= false;
$depth10_1= false;
$depth10_2= false;
$depth10_3= false;
$depth10_4= false;
if(strpos($contentview, '/bar/sticket') !== false){
    $depth10= true;
    $depth10_1= true;
}else if(strpos($contentview, '/bar/everland') !== false){
    $depth10= true;
    $depth10_2= true;
}else if(strpos($contentview, '/bar/kit') !== false){
    $depth10= true;
    $depth10_3= true;
}else if(strpos($contentview, '/toast/toast_sendlms') !== false){
    $depth10= true;
    $depth10_4= true;
}

?>



<nav id="sidebar" class="sidebar" role="navigation">
    
    <div class="js-sidebar-content">
        <header class="logo hidden-xs">

            <?php if($buseo == '뿌리깊은나무' && $rolegu != 'AL'){?>
                <a href="<?php echo site_url('/home/main'); ?>">PCMS2.0</a>
            <?php }else if($buseo == '날마다'){?>
                <a href="<?php echo site_url('/hnr/twoinone'); ?>">PCMS2.0</a>
            <?php }else if($buseo == '행복한항해'){?>
                <a href="<?php echo site_url('/orderc/olist/new'); ?>">PCMS2.0</a>
            <?php }else{?>
                <a href="<?php echo site_url('/sys/login'); ?>">PCMS2.0</a>
            <?php }?>
        </header>

        <ul class="sidebar-nav">


		<?php if($show01){ ?>
			<li  <?php if($depth01)echo "class='active'"; ?>>
				<a href="#sidebar-forms" data-toggle="collapse" data-parent="#sidebar">
					<span class="icon">
						<i class="glyphicon glyphicon-align-right"></i>
					</span>
						주문
					<i class="toggle fa fa-angle-down"></i>
				</a>
				<ul id="sidebar-forms" class="collapse <?php if($depth01)echo "in"; ?>">

					<li <?php if($depth01_1)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/orderc/olist/new'); ?>')">주문조회</a></li>
					<?php if($rolegu != 'CS'){?>
						<li <?php if($depth01_5)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/order/upload_excel'); ?>')">주문 대량 등록(엑셀)</a></li>
					<? } ?>

					<li <?php if($depth01_2)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/order/sms/new'); ?>')">발송문자조회</a></li>
                    <li <?php if($depth01_4)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/orderc/toast'); ?>')">카카오/TOAST문자 조회</a></li>
                    <li <?php if($depth01_3)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/coupon/regcoupon'); ?>')">쿠폰대체발행</a></li>
                    <li <?php if($depth01_6)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/orderc/highone'); ?>')">하이원리조트 객실현황</a></li>
                </ul>
			</li>
		<?php }?>

		<?php if($show09){?>
			<li  <?php if($depth01)echo "class='active'"; ?>>
				<a href="#sidebar-forms" data-toggle="collapse" data-parent="#sidebar">
					<span class="icon">
						<i class="glyphicon glyphicon-align-right"></i>
					</span>
						주문
					<i class="toggle fa fa-angle-down"></i>
				</a>
				<ul id="sidebar-forms" class="collapse <?php if($depth01)echo "in"; ?>">  
					<li <?php if($depth01_1)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/orderc/olist/new'); ?>')">주문조회</a></li>   
					<li <?php if($depth01_2)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/order/sms/new'); ?>')">발송문자조회</a></li>
					<li <?php if($depth01_3)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/coupon/regcoupon'); ?>')">쿠폰대체발행</a></li>
                    <li <?php if($depth01_7)echo "class='active'"; ?>>
                        <a class="collapsed" href="#sidebar-sub-levels_nexon" data-toggle="collapse" data-parent="#sidebar-levels">
                            넥슨
                            <i class="toggle fa fa-angle-down"></i>
                        </a>
                        <ul id="sidebar-sub-levels_nexon" class="collapse <?php if($depth01_7)echo "in"; ?>">
                            <li <?php if($depth01_7_1)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/nexon/item'); ?>')">상품</a></li>
                            <li <?php if($depth01_7_2)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/nexon/coupon/new'); ?>')">쿠폰</a></li>
                        </ul>
                    </li>
                    <li <?php if($depth01_8)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/orderc/toast'); ?>')">카카오/TOAST문자 조회</a></li>
                    <li <?php if($depth01_9)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/phoenix/phoenix_coupon/new'); ?>')">휘닉스파크 쿠폰</a></li>
                </ul>
			</li>
		<?php } ?>
				
		<?php  if($show02){?>
			 <li <?php if($depth02)echo "class='active'"; ?>>
				 <a class="collapsed" href="#sidebar-sync" data-toggle="collapse" data-parent="#sidebar">
					 <span class="icon">
						<i class="fa fa-table"></i>
					 </span>
					 연동
					 <i class="toggle fa fa-angle-down"></i>
				 </a>
				 <ul id="sidebar-sync" class="collapse <?php if($depth02)echo "in"; ?>">
					 <li <?php if($depth02_1)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/sell/info'); ?>')">오픈마켓 판매</a></li>
					 <li <?php if($depth02_8)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/sell/crowling'); ?>')">판매 연동 설정</a></li>
					 <li <?php if($depth02_2)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/cms/sync/new'); ?>')">판매채널 상품 설정</a></li>
                     <li <?php if($depth02_4)echo "class='active'"; ?>>
                         <a class="collapsed" href="#sidebar-sub-levels_phoenix" data-toggle="collapse" data-parent="#sidebar-levels">
                             휘닉스파크
                             <i class="toggle fa fa-angle-down"></i>
                         </a>
                         <ul id="sidebar-sub-levels_phoenix" class="collapse <?php if($depth02_4)echo "in"; ?>">
                             <li <?php if($depth02_4_1)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/phoenix/phoenix_pkg/new'); ?>')">연동(신)</a></li>
                             <li <?php if($depth02_4_2)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/phoenix/phoenix_coupon/new'); ?>')">쿠폰</a></li>
                             <li <?php if($depth02_4_3)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/phoenix/skiseason_item'); ?>')">시즌권</a></li>
                             <li <?php if($depth02_4_4)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/sync/phoenix_items'); ?>')">연동(구)</a></li>
                         </ul>
                     </li>
					 <li <?php if($depth02_5)echo "class='active'"; ?>>
						 <a class="collapsed" href="#sidebar-sub-levels_naver" data-toggle="collapse" data-parent="#sidebar-levels">
							 네이버
							 <i class="toggle fa fa-angle-down"></i>
						 </a>
						 <ul id="sidebar-sub-levels_naver" class="collapse <?php if($depth02_5)echo "in"; ?>">
							 <li <?php if($depth02_5_1)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/sync/naver_bizcode'); ?>')">시설</a></li>
							 <li <?php if($depth02_5_2)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/sync/naver_item'); ?>')">판매(딜)</a></li>
						 </ul>
					 </li>
                     <li <?php if($depth02_9)echo "class='active'"; ?>>
                         <a class="collapsed" href="#sidebar-sub-levels_nexon" data-toggle="collapse" data-parent="#sidebar-levels">
                             넥슨
                             <i class="toggle fa fa-angle-down"></i>
                         </a>
                         <ul id="sidebar-sub-levels_nexon" class="collapse <?php if($depth02_9)echo "in"; ?>">
                             <li <?php if($depth02_9_1)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/nexon/item'); ?>')">상품</a></li>
                             <li <?php if($depth02_9_2)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/nexon/coupon/new'); ?>')">쿠폰</a></li>
                         </ul>
                     </li>
					 <li <?php if($depth02_6)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/sell/playcity'); ?>')">웅진플레이시티</a></li>
					 <li <?php if($depth02_7)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/sell/dukgu'); ?>')">덕구온천리조트(쏠티)</a></li>
					 <li <?php if($depth02_10)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/sell/hanwha'); ?>')">한화(테스트)</a></li>

				 </ul>
			 </li>
		<?php } ?>

        <?php if($show10){ ?>
            <li <?php if($depth10)echo "class='active'"; ?>>
                <a class="collapsed" href="#sidebar-en" data-toggle="collapse" data-parent="#sidebar">
            <span class="icon">
                <i class="fa fa-envelope"></i>
            </span>
                    문자
                    <i class="toggle fa fa-angle-down"></i>
                </a>
                <ul id="sidebar-en" class="collapse <?php if($depth10)echo "in"; ?>">
                    <li <?php if($depth10_1)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/bar/sticket'); ?>')">Sticket (오픈마켓)</a></li>
                    <li <?php if($depth10_2)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/bar/everland'); ?>')">에버랜드 바코드/문자</a></li>
                    <li <?php if($depth10_3)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/bar/kit/new'); ?>')">통합 바코드/문자</a></li>
                    <li <?php if($depth10_4)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/toast/toast_sendlms/new'); ?>')">TOAST 문자</a></li>
                </ul>
            </li>
        <?php }?>
    
		<?php  if($show03){?>
			<li  <?php if($depth03)echo "class='active'"; ?>>
				<a class="collapsed" href="#sidebar-maps" data-toggle="collapse" data-parent="#sidebar">
					<span class="icon">
						<i class="glyphicon glyphicon-map-marker"></i>
					</span>
						쿠폰
					<i class="toggle fa fa-angle-down"></i>
				</a>
				<ul id="sidebar-maps" class="collapse  <?php if($depth03)echo "in"; ?>">
					<li <?php if($depth03_8)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/refund/refundlist'); ?>')">환불대기 리스트</a></li>
					<li <?php if($depth03_1)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/everland/coupon'); ?>')">에버랜드 QR조회<br/>(플엠)</a></li>
					<li <?php if($depth03_2)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/everland/sticket'); ?>')">에버랜드 QR조회<br/>(에버랜드)</a></li>
					<li <?php if($depth03_3)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/bar/coupon'); ?>')">통합 바코드 사용처리</a></li>
					<li <?php if($depth03_4)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/bar/make/new'); ?>')">바코드 생성 요청</a></li>
                    <li <?php if($depth03_7)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/lotte/eventlist/new'); ?>')">롯데 행사 리스트</a></li>
                    <li <?php if($depth03_5)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/emart/code/'); ?>')">이마트 코드 및 문자관리</a></li>
					<li <?php if($depth03_6)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/emart/coupon'); ?>')">이마트피자 바코드 관리</a></li>
				</ul>
			</li>
		<?php } ?>
		
		<?php if($show04){?>
			<li  <?php if($depth04)echo "class='active'"; ?>>
				<a href="#sidebar-ui" data-toggle="collapse" data-parent="#sidebar">
					<span class="icon">
						<i class="glyphicon glyphicon-tree-conifer"></i>
					</span>
						통계
					<i class="toggle fa fa-angle-down"></i>
				</a>
				<ul id="sidebar-ui" class="collapse  <?php if($depth04)echo "in"; ?>">
					<li <?php if($depth04_1)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/everland/count/new'); ?>')">에버랜드</a></li>
					<li <?php if($depth04_4)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/elcb/count/new'); ?>')">에버랜드 Sticket</a></li>
					<li <?php if($depth04_2)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/emart/count'); ?>')">이마트</a></li>
					<li <?php if($depth04_3)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/stats/use_order'); ?>')">사용데이터</a></li>
				</ul>
			</li>
		<?php } ?>
    
		<?php if($show05){ ?>
			<li  <?php if($depth05)echo "class='active'"; ?>>
				<a class="collapsed" href="#sidebar-levels" data-toggle="collapse" data-parent="#sidebar">
					<span class="icon">
						<i class="fa fa-folder-open"></i>
					</span>
					설정
					<i class="toggle fa fa-angle-down"></i>
				</a>
				<ul id="sidebar-levels" class="collapse <?php if($depth05)echo "in"; ?>">
					<li <?php if($depth05_1)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/cms/company'); ?>')">업체 관리</a></li>
					<li <?php if($depth05_2)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/cms/facilities'); ?>')">시설 관리</a></li>
					<li <?php if($depth05_3)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/cms/items'); ?>')">상품 관리</a></li>
				</ul>
			</li>
		<?php }?>
		
		<?php if($show06){ ?>
			<li  <?php if($depth06)echo "class='active'"; ?>>
				<a class="collapsed" href="#sidebar-b2b" data-toggle="collapse" data-parent="#sidebar">
				<span class="icon">
					<i class="glyphicon glyphicon-th"></i>
				</span>
					B2B
					<i class="toggle fa fa-angle-down"></i>
				</a>
				<ul id="sidebar-b2b" class="collapse <?php if($depth06)echo "in"; ?>">
					<li <?php if($depth06_1)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/b2b/notice/'); ?>')">공지사항</a></li>
					<li>
						<a class="collapsed " href="#sidebar-sub-levels_account" data-toggle="collapse" data-parent="#sidebar-levels">
							시설
							<i class="toggle fa fa-angle-down"></i>
						</a>
						<ul id="sidebar-sub-levels_account" class="collapse  <?php if($depth06_2)echo "in"; ?>">
							<li <?php if($depth06_2_1)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/b2b/account'); ?>')">계정</a></li>
						</ul>

						<a class="collapsed" href="#sidebar-sub-levels_coupon" data-toggle="collapse" data-parent="#sidebar-levels">
							상품
							<i class="toggle fa fa-angle-down"></i>
						</a>
						<ul id="sidebar-sub-levels_coupon" class="collapse  <?php if($depth06_3)echo "in"; ?>">
							<li <?php if($depth06_3_1)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/b2b/plm_item/new'); ?>')">상품 관리</a></li>
							<li <?php if($depth06_3_2)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/b2b/package_item'); ?>')">패키지 관리</a></li>
						</ul>
					</li>
					<li <?php if($depth06_4)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/b2b/everland_order/0/0/0'); ?>')">주문</a></li>
					<li <?php if($depth06_5)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/b2b/everland_coupon_search'); ?>')">쿠폰</a></li>
					<li <?php if($depth06_6)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/b2b/evcode'); ?>')">판매/사용 관리</a></li>
				</ul>
			</li>
		<?php }?>


		<?php if($show07){?>
			<li <?php if($depth07)echo "class='active'"; ?>>
					<a href="#sidebar-cri" data-toggle="collapse" data-parent="#sidebar">
			<span class="icon">
				<i class="glyphicon glyphicon-align-right"></i>
			</span>
					투인원
					<i class="toggle fa fa-angle-down"></i>
				</a>
				<ul id="sidebar-cri" class="collapse <?php if($depth07)echo "in"; ?>">
					<li <?php if($depth07_1)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/hnr/twoinone'); ?>')">핀번호 초기화</a></li>
					<li <?php if($depth07_2)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/hnr/upload_excel'); ?>')">인증번호 업로드</a></li>
                    <li <?php if($depth07_3)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/order/sms/new'); ?>')">발송문자조회</a></li>
				</ul>
			</li>
		<?php }?>

		<?php if($show08){ ?>
			<li <?php if($depth08)echo "class='active'"; ?>>
				<a href="#sidebar-al" data-toggle="collapse" data-parent="#sidebar">
					<span class="icon">
						<i class="glyphicon glyphicon-align-right"></i>
					</span>
					플레이스엠
					<i class="toggle fa fa-angle-down"></i>
				</a>
				<ul id="sidebar-al" class="collapse <?php if($depth08)echo "in"; ?>">
					<li <?php if($depth08_1)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/orderc/olist/new'); ?>')">주문조회</a></li>
                    <?php if($cd == 'singmeblueblues'){?>
                        <li <?php if($depth08_9)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/order/upload_excel'); ?>')">주문 대량 등록(엑셀)</a></li>
                    <? } ?>
					<li <?php if($depth08_2)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/order/sms/new'); ?>')">발송문자조회</a></li>
                    <li <?php if($depth08_6)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/orderc/toast'); ?>')">TOAST문자</a></li>
                    <li <?php if($depth08_7)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/orderc/highone'); ?>')">하이원리조트 객실현황</a></li>
                    <li <?php if($depth08_3)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/everland/coupon'); ?>')">에버랜드 QR조회<br/>(플엠)</a></li>
					<li <?php if($depth08_4)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/everland/sticket'); ?>')">에버랜드 QR조회<br/>(에버랜드)</a></li>
					<li <?php if($depth08_5)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/emart/coupon'); ?>')">이마트피자 바코드 관리</a></li>
                    <li <?php if($depth08_8)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/nexon/coupon/new'); ?>')">넥슨 쿠폰</a></li>
                    <li <?php if($depth08_10)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/phoenix/phoenix_coupon/new'); ?>')">휘닉스파크 쿠폰</a></li>
                </ul>
			</li>
		<?php }?>


        </ul>
         
    </div>
</nav>
<script type="text/javascript">
    function SubmitFrm(lacationtxt){
        //alert(lacationtxt);
        window.location.href = lacationtxt;
    }
    function SubmitFrm_test(lacationtxt){
        alert("테스트중입니다.");
        //window.location.href = lacationtxt;
    }
</script>


