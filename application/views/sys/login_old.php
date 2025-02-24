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
                                <input type="text" name="username" class="username form-control" id="exampleInputEmail1" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input name="userpasswd" class="userpasswd form-control" id="pswd" type="password" placeholder="Password">
                            </div>
                            <div class="clearfix">
                                <div class="btn-toolbar pull-right">
                                    <!-- <button type="button" class="btn btn-default btn-sm">Create an Account</button> -->
                                    <a id="loginsbm" class="btn btn-inverse btn-sm" href="#">Login</a>
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

$(function()
{
    $('#loginsbm').click(function(){
        var username = $('.username').val();
        var userpasswd = $('.userpasswd').val();
        //alert(username);
        $('#loginform').submit();
        

    });

    $('#pswd').keyup(function(e) 
    {
        if(e.keyCode == 13) 
        {
           //$('#loginform').submit(); 
           $('#loginsbm').click();
        }
    });

});
</script>

<!-- page specific libs -->
<!-- page specific js -->
</body>
</html>