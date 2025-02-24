<?php
define("__CASTLE_PHP_VERSION_BASE_DIR__", "/home/sys.placem.co.kr/public_html/csp");
include_once(__CASTLE_PHP_VERSION_BASE_DIR__ . "/castle_referee.php");
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

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <br>
        <div>
            <img src="../../img/phoenix_logo.png" class="img-responsive center-block" width="20%">
        </div>

        <section class="widget">
            <header>
                <div class="widget-controls">
                    <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a>
                    <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>
                </div>
            </header>
            <div class="widget-body" > <!-- 상단 검색바 시작  -->
                <div class="" align="center" style="color: red;">
                    <span>※ 본인이 구입하실 권종을 아래에서 선택 후 조회하세요.</span>
                </div>
                <hr/>
<!--                <div class="radio" align="center">-->
<!--                    <input type="radio" name="radio1" id="radio1" value="option1" checked="">-->
<!--                    <label for="radio1"> MAD / 휘닉스매니아 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>-->
<!--                    <input type="radio" name="radio1" id="radio2" value="option2">-->
<!--                    <label for="radio2"> 휘닉스꿈나무 </label>-->
<!--                </div>-->
                <form  role="form" id="fform" name="fform" class="form-horizontal" role="form" method="post">
                    <input type="hidden" name="YM" id="YM"  value="">
                    <div class="form-actions bg-warning-light">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label">휘닉스평창 사이버 회원아이디</label>
                                    <div class="col-sm-6">
                                        <input type="search" name="searchid" id="searchid" maxlength="20"
                                               class="input-md form-control"
                                               data-placement="top" style="width: 60%;"
                                               value="">
                                    </div>
                                </div>
                                <div style="margin-top:5px" align="center">
                                    <button type="button" id="btnokchk" class="btn btn-warning btn-sm">구매가능 대상확인</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <br>
                <div align="center">
                    <span>휘닉스평창 사이버회원 아이디를 잊으셨나요?</span>&nbsp;&nbsp;
                    <a href="https://www.phoenixpark.co.kr/Site/Passport/FindCyberInfo" target="_blank">
                        <button type="button" id="" class="btn btn-info btn-xs">휘닉스평창ID조회</button>
                    </a>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="" align="center" style="font-size: large;">
                                <span>[조회결과]</span>
                            </div><br/>
                            <div class="" align="center" style="font-size: medium;color:blue;">
                                <a class="notice"><span class="f14" id="spanMsg"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <img src="../../img/phoenix_bottom.jpg" class="img-responsive center-block" width="100%">
                </div>
            </div>
        </section>
    </div>
</div>


</body>
</html>



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

<script type="text/javascript">
$(document).ready(function() {
    $('#searchid').keydown(function(key)
    {
        if (key.keyCode == 13) {
            $('#btnokchk').click();
        }

    });

    $('#btnokchk').css({cursor: "hand"});
    $("#btnokchk").click(function () {
        var searchid = $('#searchid').val();

        /*입력된 아이디를 ajax로 컨트롤러에 전달 해서 메세지 출력.
        * 아이디 출력 확인 후
        * 컨트롤러에서 작업.
        *
        * 컨트롤러에서는 curl 사용 해서 휘닉스 파크에 내용 전달.*/

        if (searchid == "" || searchid.length < 1) alert("ID가 입력되지 않았습니다. 아이디를 입력해 주십시오.");

        $.ajax({
            url: "<?php echo site_url('ext/phoenix_id_chk'); ?>",
            data: {searchid : searchid},
            type:"POST",
            success:function(msg)
            {
                $('#spanMsg').html(msg);
            }
        });
    });

});
</script>
