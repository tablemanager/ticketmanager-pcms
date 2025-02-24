<?php 
$rolegu = $this->session->userdata('rolegu');
$buseo = $this->session->userdata('buseo');
?>



<nav id="sidebar" class="sidebar" role="navigation">
    
    <div class="js-sidebar-content">
        <header class="logo hidden-xs">
            <a href="<?php echo site_url('/sys/login'); ?>">PCMS2.0</a>
        </header>

        <ul class="sidebar-nav">


<?php  if($rolegu == 'AL'){ // 인턴용?>
    <li class="active">
        <a href="#sidebar-forms" data-toggle="collapse" data-parent="#sidebar">
            <span class="icon">
                <i class="glyphicon glyphicon-align-right"></i>
            </span>
            플레이스엠
            <i class="toggle fa fa-angle-down"></i>
        </a>
        <ul id="sidebar-forms" class="collapse in">
            <li><a href="#" onclick="SubmitFrm('<?php echo site_url('/order/orderN_dev/new'); ?>')">주문조회</a></li>
            <li><a href="#" onclick="SubmitFrm('<?php echo site_url('/order/sms/new'); ?>')">발송문자조회</a></li>
            <li><a href="#" onclick="SubmitFrm('<?php echo site_url('/everland/coupon'); ?>')">에버랜드 QR조회<br/>(플엠)</a></li>
            <li><a href="#" onclick="SubmitFrm('<?php echo site_url('/everland/sticket'); ?>')">에버랜드 QR조회<br/>(에버랜드)</a></li>
            <li><a href="#" onclick="SubmitFrm('<?php echo site_url('/emart/coupon'); ?>')">이마트피자 바코드 관리</a></li>
        </ul>
    </li>

<?php  }else if($rolegu == 'NMD'){ // 날마다

    $depth01= false;
    $depth01_1= false;
    $depth01_2= false;
    if(strpos($contentview, '/hnr/twoinone') !== false){
        $depth01= true;
        $depth01_1= true;
    }else if(strpos($contentview, '/hnr/upload_excel') !== false){
        $depth01= true;
        $depth01_2= true;
    }

    ?>

    <li class="active">
            <a href="#sidebar-forms" data-toggle="collapse" data-parent="#sidebar">
    <span class="icon">
        <i class="glyphicon glyphicon-align-right"></i>
    </span>
            투인원
            <i class="toggle fa fa-angle-down"></i>
        </a>
        <ul id="sidebar-forms" class="collapse in">
            <li <?php if($depth01_1)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/hnr/twoinone'); ?>')">핀번호 초기화</a></li>
            <li <?php if($depth01_2)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/hnr/upload_excel'); ?>')">인증번호 업로드</a></li>
        </ul>
    </li>

<?php   }else{

            $depth01= false;
            $depth01_1= false;
            $depth01_2= false;
            $depth01_3= false;
            $depth01_4= false;
            $depth01_5= false;
            if(strpos($contentview, '/orderc/olist') !== false){
                $depth01= true;
                $depth01_1= true;
            }else if(strpos($contentview, '/order/sms') !== false){
                $depth01= true;
                $depth01_2= true;
            }else if(strpos($contentview, '/coupon/regcoupon') !== false){
                $depth01= true;
                $depth01_3= true;
            }else if(strpos($contentview, '/order/onemount') !== false){
                $depth01= true;
                $depth01_4= true;
            }else if(strpos($contentview, '/order/upload_excel') !== false){
                $depth01= true;
                $depth01_5= true;
            }
    ?>
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
                        <li <?php if($depth01_3)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/coupon/regcoupon'); ?>')">쿠폰대체발행</a></li>
                        <li <?php if($depth01_4)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/order/onemount'); ?>')">원마운트조회</a></li>
                    </ul>
                </li>
            
                <?php
                $depth02= false;
                $depth02_1= false;
                $depth02_2= false;
                $depth02_3= false;
                $depth02_4= false;
                $depth02_5= false;
                $depth02_5_1= false;
                $depth02_5_2= false;
                $depth02_6= false;
                $depth02_7= false;
                $depth02_8= false;
    
    
    
        if(strpos($contentview, '/sell/info') !== false){
                    $depth02= true;
                    $depth02_1= true;
                }else if(strpos($contentview, '/cms/sync') !== false){
                    $depth02= true;
                    $depth02_2= true;
                }else if(strpos($contentview, '/sell/onemount') !== false){
                    $depth02= true;
                    $depth02_3= true;
                }else if(strpos($contentview, '/sync/phoenix_items') !== false){
                    $depth02= true;
                    $depth02_4= true;
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
                    $depth02= true;
                    $depth02_8= true;
                }
    
                if($rolegu != 'CS'){?>
    
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
                         <li <?php if($depth02_3)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/sell/onemount'); ?>')">원마운트 코드</a></li>
                         <li <?php if($depth02_4)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/sync/phoenix_items'); ?>')">휘닉스파크</a></li>
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
                         <li <?php if($depth02_6)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/sell/playcity'); ?>')">웅진플레이시티</a></li>
                         <li <?php if($depth02_7)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/sell/dukgu'); ?>')">덕구온천리조트(쏠티)</a></li>
    
                     </ul>
                 </li>
    
                    <?php
                    $depth03= false;
                    $depth03_1= false;
                    $depth03_2= false;
                    $depth03_3= false;
                    $depth03_4= false;
                    $depth03_5= false;
                    $depth03_6= false;
                    $depth03_7= false;
                    $depth03_8= false;
                    $depth03_9= false;
                    if(strpos($contentview, '/bar/everland') !== false){
                        $depth03= true;
                        $depth03_1= true;
                    }else if(strpos($contentview, '/bar/sticket') !== false){
                        $depth03= true;
                        $depth03_9= true;
                    }else if(strpos($contentview, '/everland/sticket') !== false){
                        $depth03= true;
                        $depth03_3= true;
                    }else if(strpos($contentview, '/everland/coupon') !== false){
                        $depth03= true;
                        $depth03_2= true;
                    }else if(strpos($contentview, '/bar/kit') !== false){
                        $depth03= true;
                        $depth03_4= true;
                    }else if(strpos($contentview, '/bar/coupon') !== false){
                        $depth03= true;
                        $depth03_5= true;
                    }else if(strpos($contentview, '/bar/make') !== false){
                        $depth03= true;
                        $depth03_6= true;
                    }else if(strpos($contentview, '/emart/code') !== false){
                        $depth03= true;
                        $depth03_7= true;
                    }else if(strpos($contentview, '/emart/coupon') !== false){
                        $depth03= true;
                        $depth03_8= true;
                    }
                    ?>
                <li  <?php if($depth03)echo "class='active'"; ?>>
                    <a class="collapsed" href="#sidebar-maps" data-toggle="collapse" data-parent="#sidebar">
                        <span class="icon">
                            <i class="glyphicon glyphicon-map-marker"></i>
                        </span>
                            쿠폰
                        <i class="toggle fa fa-angle-down"></i>
                    </a>
                    <ul id="sidebar-maps" class="collapse  <?php if($depth03)echo "in"; ?>">
                        <li <?php if($depth03_9)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/bar/sticket'); ?>')">Sticket (오픈마켓)</a></li>
                        <li <?php if($depth03_1)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/bar/everland'); ?>')">에버랜드 바코드/문자</a></li>
                        <li <?php if($depth03_2)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/everland/coupon'); ?>')">에버랜드 QR조회<br/>(플엠)</a></li>
                        <li <?php if($depth03_3)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/everland/sticket'); ?>')">에버랜드 QR조회<br/>(에버랜드)</a></li>
                        <li <?php if($depth03_4)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/bar/kit/new'); ?>')">통합 바코드/문자</a></li>
                        <li <?php if($depth03_5)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/bar/coupon'); ?>')">통합 바코드 사용처리</a></li>
                        <li <?php if($depth03_6)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/bar/make/new'); ?>')">바코드 생성 요청</a></li>
                        <li <?php if($depth03_7)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/emart/code/'); ?>')">이마트 코드 및 문자관리</a></li>
                        <li <?php if($depth03_8)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/emart/coupon'); ?>')">이마트피자 바코드 관리</a></li>
                    </ul>
                </li>
    
    
    
    
                    <?php
                    $depth04= false;
                    $depth04_1= false;
                    $depth04_2= false;
                    $depth04_3= false;
                    if(strpos($contentview, '/everland/count') !== false){
                        $depth04= true;
                        $depth04_1= true;
                    }else if(strpos($contentview, '/emart/count') !== false){
                        $depth04= true;
                        $depth04_2= true;
                    }else if(strpos($contentview, '/stats/use_order') !== false){
                        $depth04= true;
                        $depth04_3= true;
                    }
                    ?>
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
                        <li <?php if($depth04_2)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/emart/count'); ?>')">이마트</a></li>
                        <li <?php if($depth04_3)echo "class='active'"; ?>><a href="#" onclick="SubmitFrm('<?php echo site_url('/stats/use_order'); ?>')">사용데이터</a></li>
                    </ul>
                </li>
    
    
                    <?php
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
                    ?>
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
    
                <?php  if($rolegu == 'AD' || $rolegu == 'FR'){?>
    
    
                <?php
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
    
                ?>
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


<?php  }?>
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


