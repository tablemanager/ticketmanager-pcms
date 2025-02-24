<div class="content-wrap">
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
                        <form  role="form" id="fform" name="fform" class="form-horizontal" role="form" method="post" action="/phoenix/phoenix_coupon_ser">

                            <fieldset>
                                <div  class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length">주문번호</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="orderno" id="orderno" value="<?=$orderno?>"
                                               class="form-control"
                                               placeholder="주문번호"
                                               data-placement="top">
                                    </div>
                                </div>
                                <div  class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length">이름</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="actlUserNm" id="actlUserNm" value="<?=$actlUserNm?>"
                                               class="form-control"
                                               placeholder="사용자명"
                                               data-placement="top">
                                    </div>
                                </div>
                                <div  class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length">휴대폰번호</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="actlUserMpNo" id="actlUserMpNo" value="<?=$actlUserMpNo?>"
                                               class="form-control"
                                               placeholder="사용자 휴대폰번호"
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
                            <table class="table table-lg mt-lg mb-0">
                                <thead class="no-bd">
                                <tr style="font-size: x-small;">
                                    <th class="hidden-xs">패키지코드</th>
                                    <th class="hidden-xs">패키지명</th>
                                    <th class="hidden-xs">사용시작일자</th>
                                    <th class="hidden-xs">사용종료일자</th>
                                    <th class="hidden-xs">주문아이디</th>
                                    <th class="hidden-xs">주문번호</th>
                                    <th class="hidden-xs">이름</th>
                                    <th class="hidden-xs">휴대폰번호</th>
                                    <th class="hidden-xs">판매일자</th>
                                    <th class="hidden-xs">지정일자(사용일자)</th>
                                    <th class="hidden-xs">사용상태</th>
                                    <th class="hidden-xs">등록결과코드</th>
                                    <th class="hidden-xs">등록결과메세지</th>
                                    <th class="hidden-xs">대표판매번호</th>
                                    <th class="hidden-xs">대표쿠폰번호</th>
                                    <th class="hidden-xs">객실대표예약번호</th>
                                    <th class="hidden-xs">객실예약번호</th>
                                    <th class="hidden-xs">투숙순번</th>
                                    <th class="hidden-xs">상태코드</th>
                                    <th class="hidden-xs">상태메세지</th>
                                    <th class="hidden-xs">주중주말코드</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($query->result() as $row):
                                ?>
                                <?php if($row->useyn=="C"){?>
                                    <tr style="background-color: #FFD8D8">
                                <?php }if($row->useyn=="Y"){?>
                                    <tr style="background-color: #D4F4FA">
                                <?php }if($row->useyn!="C" && $row->useyn!="Y"){?>
                                    <tr style="font-size: small; background-color: rgba(0, 0, 0, 0)" onmouseover="this.style.background='#f2f2f2'" onMouseOut="this.style.backgroundColor=''">
                                <?php }?>
                                    <td><?=$row->pkgCd?></td>
                                    <td><?=$row->pkgNm?></td>
                                    <td><?=$row->useFromDate?></td>
                                    <td><?=$row->useToDate?></td>
                                    <td><?=$row->orderid?></td>
                                    <td><?=$row->orderno?></td>
                                    <td><?=$row->actlUserNm?></td>
                                    <td><?=$row->actlUserMpNo?></td>
                                    <td><?=$row->sellDate?></td>
                                    <td><?=$row->asgnDate?></td>
                                    <td><?=$row->useyn?></td>
                                    <td><?=$row->statusCode?></td>
                                    <td><?=$row->status?></td>
                                    <td><?=$row->rprsSellNo?></td>
                                    <td>
                                        <?=$row->rprsBarCd?><br>
                                    <?php if($row->useyn=="C" || $row->useyn=="Y"){?>
                                        <button type="button" id="chk_btn<?=$row->id?>" class="btn btn-success btn-xs chk_btn" code="<?=$row->id?>" sno="<?=$row->rprsSellNo?>">조회</button>
                                    <?php }else{?>
                                        <button type="button" id="chk_btn<?=$row->id?>" class="btn btn-success btn-xs chk_btn" code="<?=$row->id?>" sno="<?=$row->rprsSellNo?>">조회</button>
                                        <button type="button" id="disuse_btn<?=$row->id?>" class="btn btn-warning btn-xs disuse_btn" code="<?=$row->id?>" sno="<?=$row->rprsSellNo?>">폐기</button>
                                    <?php }?>
                                    </td>
                                    <td><?=$row->roomRprsRsrvNo?></td>
                                    <td><?=$row->roomRsrvNo?></td>
                                    <td><?=$row->roomStayNo?></td>
                                    <td><?=$row->info_statusCode?></td>
                                    <td><?=$row->info_status?></td>
                                    <td><?=$row->midwkWkndDivCd?></td>
                                </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?= $pag_links; ?>
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
<script src="/vendor/jasny-bootstrap/js/fileinput.js"></script>
<script src="/vendor/holderjs/holder.js"></script>
<script src="/vendor/dropzone/downloads/dropzone.min.js"></script>
<script src="/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
<script src="/vendor/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js"></script>

<!-- page specific js -->
<script src="/js/form-elements.js"></script>
<script src="/js/tables-dynamic.js"></script>

<script>
$(function() {

    $('.chk_btn').click(function () {
        var sno = $(this).attr('sno');

        $.ajax({
            url: "<?php echo site_url('phoenix/coupon_chk'); ?>",
            data: {rprsSellNo:sno},
            type: "POST",
            success: function (msg) {
                alert(msg);
            }
        })
    });

    $('.disuse_btn').click(function () {
        var sno = $(this).attr('sno');

        $.ajax({
            url: "<?php echo site_url('phoenix/coupon_disuse'); ?>",
            data: {rprsSellNo:sno},
            type: "POST",
            success: function (msg) {
                alert(msg);
            }
        })
    });

    $('#search_btn').click(function () {
        $('#fform').submit();
    });

    $('#cancel_btn').click(function () {
        $(location).attr('href', '/phoenix/phoenix_coupon/new');
    });
});
</script>