<?php
/**
 * Created by PhpStorm.
 * User: SeoJiyun
 * Date: 2018-07-30
 * Time: 오전 10:01
 */
?>

<div class="content-wrap" style="margin-left: 10%">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold"><?php echo $title;?></span></h3>

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
                        <form  role="form" id="fform" name="fform" class="form-horizontal" role="form" method="post" action="/nexon/coupon_ser">

                            <fieldset>
                                <div  class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length">주문번호</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="order_no" id="order_no" value="<?=$order_no?>"
                                               class="form-control"
                                               placeholder="주문번호"
                                               data-placement="top">
                                    </div>
                                </div>
                                <div  class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length">고객이름</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="Cus_nm" id="Cus_nm" value="<?=$Cus_nm?>"
                                               class="form-control"
                                               placeholder="고객이름"
                                               data-placement="top">
                                    </div>
                                </div>
                                <div  class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length">고객휴대폰</label>
                                    <div class="col-sm-4">
                                        <input type="number" name="Cus_hp" id="Cus_hp" value="<?=$Cus_hp?>"
                                               class="form-control"
                                               placeholder="고객휴대폰"
                                               data-placement="top">
                                    </div>
                                </div>

                                <div class="col-sm-offset-5 col-sm-7">
                                    <button type="button" id="search_btn" class="btn btn-primary">검 색</button>
                                    <button type="button" id="cancel_btn" class="btn btn-inverse">취 소</button>
                                </div>


                            </fieldset>

                        </form>
                    </div>
                </section>
            </div>
        </div>

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
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>번호</th>
                                        <th>주문번호</th>
                                        <th>주문아이디</th>
                                        <th>고객이름</th>
                                        <th>고객휴대폰</th>
                                        <th>상세계약번호</th>
                                        <th>주문날짜</th>
                                        <th>쿠폰코드</th>
                                        <th>쿠폰만료일</th>
                                        <th>쿠폰상태</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($cquery->result() as $crow): ?>
                                    <?php if($crow->state == "C"){?>
                                 <tr style="background-color: #FFD8D8">
                                    <?php }else{?>
                                <tr>
                                    <?php }?>
                                    <td><?=$crow->id?></td>
                                    <td><?=$crow->order_no?></td>
                                    <td><?=$crow->order_id?></td>
                                    <td><?=$crow->Cus_nm?></td>
                                    <td><?=$crow->Cus_hp?></td>
                                    <td><?=$crow->ContractDetailNo?></td>
                                    <td><?=$crow->OrderDateTime?></td>
                                    <td><?=$crow->couponno?></td>
                                    <td><?=$crow->ExpireDate?></td>
                                    <td>
                                        <?php
                                        if($crow->state == "Y"){
                                            echo "사용";
                                        }else if($crow->state == "N"){
                                            echo "미확인";?>
                                            <button type="button" class="btn btn-gray btn-xs unuse_btn" unuseid="<?=$crow->id?>">폐기</button>
                                        <?php }else if($crow->state == "C"){
                                            echo "취소";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php echo $pag_links; ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>

    </main>
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

<script src="/vendor/select2/select2.min.js"></script>

<!-- page specific js -->
<script src="/js/form-elements.js"></script>
<script src="/js/tables-dynamic.js"></script>

<script type="text/javascript">

$(function() {

    $('#search_btn').click(function () {
        $('#fform').submit();
    });

    $('#cancel_btn').click(function () {
        $(location).attr('href', '/nexon/coupon/new');
    });

    $('.unuse_btn').click(function () {

        if(confirm("쿠폰을 폐기 하시겠습니까?")){
            var couponid = $(this).attr('unuseid');
            $.ajax({
                url: "<?php echo site_url('nexon/couponCancel'); ?>",
                data: {couponid : couponid},
                type:"POST",
                success:function(msg)
                {
                    var result = msg.split(";");
                    alert(result[1]);
                    if(result[0] == "OK"){
                        var offset = '<?=$offset?>';
                        $(location).attr('href', '/nexon/coupon_offset/'+offset);
                    }

                }
            })
        }
    });




});

</script>