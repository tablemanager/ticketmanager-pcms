<?php
/**
 * Created by PhpStorm.
 * User: MINO
 * Date: 2017-01-26
 * Time: 오후 2:53
 */
?>

<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold"><?=$title?></span></h3>
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
                            <span class="fw-semi-bold">에버랜드 전산에 QR상태값을 조회할 수 있습니다.<br/>
                                사용 및 사용취소(반환)연동이 누락난 쿠폰의 상태 값을 확인 할 수 있습니다.<br/>
                                조회 된 내용은 플레이스엠 전산에도 바로 적용됩니다.</span>
                        </div>


                        <form  role="form" id="fform" name="fform" class="form-horizontal" role="form" method="post" action="everland/coupon_sync_everland" >
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-offset-3 col-sm-7">
                                        <div class="col-sm-8">
                                            <input type="search" name="searchtxt" id="searchtxt" maxlength="12"
                                                   class="input-lg form-control"
                                                   placeholder="QR코드를 12자리를 입력해 주세요"
                                                   data-placement="top"
                                                   value="">
                                        </div>
                                        <div style="margin-top:5px">
                                            <button type="button" id="coupon_srh" class="btn btn-primary">에버랜드 전산 조회하기</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
        <span id="testcode"></span>
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
                        <div class="widget-body">

                            <div class="table-responsive">
                                <span class="fw-semi-bold">처리결과:</span>
                            </div>
                            <div class="table-responsive syncresult">

                            </div>
                        </div>
                    </section>

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

    $(function(){



        $(".memomode").on('change',function(){

            if(confirm("메모를 저장 하시겠습니까?")){
                var code = $(this).attr('code');
                //alert(code);
                var modtext = $(this).val();
                //alert(modtext);
                $.ajax({
                    url: "<?php echo site_url('order/order_modify_memo'); ?>",
                    data: {code : code, modtext:modtext},
                    type:"POST",
                    success:function(msg)
                    {
                        if(msg == 'err'){
                            alert('저장 실패	');
                        }
                        //$("#bigo"+code).html(msg);
                    }
                })

            }

        });

        $('#coupon_srh').click(function(){

            if($('#searchtxt').val() == '' || $('#searchtxt').val() == null)
            {
                alert('QR코드를 입력해 주세요.');
                $('#searchtxt').focus();
                return false;
            }

            if($('#searchtxt').val().length != 12)
            {
                alert('QR코드 12자리를 입력해 주세요.');
                $('#searchtxt').focus();
                return false;
            }

            if(confirm($('#searchtxt').val()+"을 조회 하시겠습니까?")){
                var code = $('#searchtxt').val();

                $.ajax({
                    url: "<?php echo site_url('everland/coupon_sync_everland'); ?>",
                    data: {code : code},
                    type:"POST",
                    success:function(msg)
                    {
                        $(".syncresult").html(msg);
                    }
                })


            }

        });

    });
</script>










