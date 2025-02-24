<?

?>
<!DOCTYPE html>
<html>
<head>
    <title>placem</title>
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

	$this->load->view("/$contentview.php");
?>

</body>
</html>
