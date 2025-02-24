<?php
/**
 * Created by PhpStorm.
 * User: MINO
 * Date: 2017-01-05
 * Time: 오후 1:52
 */
?>

<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold">통합 바코드 사용처리</span></h3>
        <div class="row">
            <div class="col-md-12">
                <section class="widget">
                    <header>
                        <div class="widget-controls">
                            <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a>
                            <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a>
                            <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </header>
                    <div class="widget-body"> <!-- 상단 검색바 시작  -->
                        <div class="alert alert-success alert-sm">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <span class="fw-semi-bold"> 주문상태 확인 후 오늘 날짜로 '뉴스파로'에 사용처리 됩니다.  </span>
                        </div>
                        <form  role="form" id="fform" name="fform" class="form-horizontal" role="form" method="post" action="/order/ordser" >

                                <div class="row">
                                    <div class="col-sm-2">
                                        <textarea rows="25" class="form-control" name="barcodetxt" id="barcodetxt" placeholder="바코드 번호를 입력해주세요. 줄 바꿈으로 구분"></textarea>
                                        <button type="button" id="bar_ccl" class="btn btn-inverse" style="margin-top: 25px">사용 처리</button>
                                    </div>

                                    <div class="col-sm-10">
                                        <div class="alert alert-danger alert-sm">
                                            <pre id = "resultMSG" style="background-color: transparent; border: transparent">결과 메세지</pre>
                                        </div>
                                    </div>

                                </div>

                        </form>
                    </div>
                </section>
            </div>
        </div>
</div>
</main>
</div>
<div class="loader-wrap hiding hide">
    <i class="fa fa-circle-o-notch fa-spin-fast"></i>
</div>

<!-- page specific libs -->
<script src="/vendor/underscore/underscore-min.js"></script>
<script src="/vendor/backbone/backbone.js"></script>
<script src="/vendor/backbone.paginator/lib/backbone.paginator.min.js"></script>
<script src="/vendor/backgrid/lib/backgrid.js"></script>
<script src="/vendor/backgrid-paginator/backgrid-paginator.js"></script>
<script src="/vendor/datatables/media/js/jquery.dataTables.js"></script>
<script src="/vendor/bootstrap-select/bootstrap-select.min.js"></script>
<script src="/vendor/jquery-autosize/jquery.autosize.min.js"></script>
<script src="/vendor/bootstrap3-wysihtml5/src/bootstrap3-wysihtml5.js"></script>
<script src="/vendor/switchery/dist/switchery.min.js"></script>

<script src="/vendor/moment/min/moment.min.js"></script>
<script src="/vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="/vendor/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="/vendor/jasny-bootstrap/js/inputmask.js"></script>
<script src="/vendor/holderjs/holder.js"></script>
<script src="/vendor/dropzone/downloads/dropzone.min.js"></script>
<script src="/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
<script src="/vendor/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js"></script>

<!-- page specific js -->
<script src="/js/form-elements.js"></script>
<script src="/js/tables-dynamic.js"></script>

<script type="text/javascript">
    function num_only(){
        //alert();
        if((event.keyCode<48) || (event.keyCode>57)){
            event.returnValue=false;
        }
    }

    $(function(){

        $("#bar_ccl").click(function(){
            var barcodetxt = $("#barcodetxt").val();
            if(barcodetxt == '' || barcodetxt == null){
                alert("바코드 번호를 입력해주세요.");
                return false;
            }else{
                $.ajax({
                    url: "<?php echo site_url('bar/barcode_cancel'); ?>",
                    data: {barcodetxt : barcodetxt},
                    type:"POST",
                    success:function(msg)
                    {
                        $("#resultMSG").html(msg);
                    }
                })
            }

        });


    });
</script>
