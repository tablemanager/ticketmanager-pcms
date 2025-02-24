<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold"><?php echo $title; ?></span></h3>
        <div class="row">
            <div class="col-md-12">
                <section class="widget">
                    <header>
                        <div class="widget-controls">
                            <a data-widgster="expand" title="Expand" href="#"><i
                                        class="glyphicon glyphicon-chevron-up"></i></a>
                            <a data-widgster="collapse" title="Collapse" href="#"><i
                                        class="glyphicon glyphicon-chevron-down"></i></a>
                            <a data-widgster="close" title="Close" href="#"><i
                                        class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </header>
                    <div class="widget-body">
                        <form role="form" id="fform" name="fform" class="form-horizontal" role="form" method="post"
                              action="/phoenix/phoenix_pkg_ser">

                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length">패키지코드</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="pkgCd" id="pkgCd" value="<?= $pkgCd ?>"
                                               class="form-control"
                                               placeholder="패키지코드"
                                               data-placement="top">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length">패키지명</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="pkgNm" id="pkgNm" value="<?= $pkgNm ?>"
                                               class="form-control"
                                               placeholder="패키지명"
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
                            <a data-widgster="expand" title="Expand" href="#"><i
                                        class="glyphicon glyphicon-chevron-up"></i></a>
                            <a data-widgster="collapse" title="Collapse" href="#"><i
                                        class="glyphicon glyphicon-chevron-down"></i></a>
                            <a data-widgster="close" title="Close" href="#"><i
                                        class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </header>
                    <div class="widget-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-lg mt-lg mb-0">
                                <thead class="no-bd">
                                <tr style="font-size: x-small;">
                                    <th class="hidden-xs">번호</th>
                                    <th class="hidden-xs">플레이스엠 상품코드</th>
                                    <th class="hidden-xs">플레이스엠 상품명</th>
                                    <th class="hidden-xs">패키지코드</th>
                                    <th class="hidden-xs">패키지명</th>
                                    <th class="hidden-xs">사업장코드</th>
                                    <th class="hidden-xs">최소인원수</th>
                                    <th class="hidden-xs">최대인원수</th>
                                    <th class="hidden-xs">판매시작일자</th>
                                    <th class="hidden-xs">판매종료일자</th>
                                    <th class="hidden-xs">사용시작일자</th>
                                    <th class="hidden-xs">사용종료일자</th>
                                    <th class="hidden-xs">사용일수</th>
                                    <th class="hidden-xs">일자지정여부</th>
                                    <th class="hidden-xs">콘도분류여부</th>
                                    <th class="hidden-xs">호텔분류여부</th>
                                    <th class="hidden-xs">유스호스텔분류여부</th>
                                    <th class="hidden-xs">휘닉스파크 골프장 분류여부</th>
                                    <th class="hidden-xs">퍼블릭 골프장 분류여부</th>
                                    <th class="hidden-xs">시즌권 분류여부</th>
                                    <th class="hidden-xs">리프트권 분류여부</th>
                                    <th class="hidden-xs">눈썰매 분류여부</th>
                                    <th class="hidden-xs">연간이용권 분류여부</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($query->result() as $row):
                                    ?>
                                    <tr style="font-size: small;">
                                        <td><?= $row->id ?></td>
                                        <td>
                                            <input type="text" name="pcms_id" id="pcms_id<?= $row->id ?>"
                                                   class="form-control pcms_id" code="<?= $row->id ?>"
                                                   value="<?= $row->item_id ?>" style="width: 70%">
                                            <span class="help-block pcmsitem_item" id="pcmsitem_item<?= $row->id ?>"
                                                  code="<?= $row->id ?>"></span>
                                        </td>
                                        <td><?= $row->item_nm ?></td>
                                        <td><?= $row->pkgCd ?></td>
                                        <td><?= $row->pkgNm ?></td>
                                        <td><?= $row->bsuCd ?></td>
                                        <td><?= $row->minGcnt ?></td>
                                        <td><?= $row->maxGcnt ?></td>
                                        <td><?= $row->sellFromDate ?></td>
                                        <td><?= $row->sellToDate ?></td>
                                        <td><?= $row->useFromDate ?></td>
                                        <td><?= $row->useToDate ?></td>
                                        <td><?= $row->useDays ?></td>
                                        <td><?= $row->dateAsgnYn ?></td>
                                        <td><?= $row->conClassYn ?></td>
                                        <td><?= $row->htClassYn ?></td>
                                        <td><?= $row->yhostClassYn ?></td>
                                        <td><?= $row->phpkGolfClassYn ?></td>
                                        <td><?= $row->publicGolfClassYn ?></td>
                                        <td><?= $row->sstkClassYn ?></td>
                                        <td><?= $row->lifttkClassYn ?></td>
                                        <td><?= $row->snowSledClassYn ?></td>
                                        <td><?= $row->fyerVchrClassYn ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="15">
                                            <button data-toggle="modal" data-target="#midwkWkndList<?= $row->id ?>"
                                                    class="btn btn-default">
                                                주중주말리스트
                                            </button>
                                            <div class="modal fade" id="midwkWkndList<?= $row->id ?>" tabindex="-1"
                                                 role="dialog" aria-labelledby="midwkWkndListLabel18"
                                                 aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-hidden="true">&times;
                                                            </button>
                                                            <h4 class="modal-title text-align-center fw-bold mt"
                                                                id="midwkWkndListLabel18">주중주말리스트 정보</h4>
                                                        </div>
                                                        <div class="modal-body bg-gray-lighter">

                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <?php
                                                                    $midwkWkndList = json_decode($row->midwkWkndList);
                                                                    foreach ($midwkWkndList as $midwkWknd) {
                                                                        ?>
                                                                        <div class="col-sm-12">
                                                                            <span>일자 : <?=$midwkWknd->date?> / 주중주말코드 : <?=$midwkWknd->midwkWkndDivCd?> / 주중주말명 : <?=$midwkWknd->midwkWkndDivNm?> / 제외 일자여부 : <?=$midwkWknd->excpDateYn?></span>
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-gray ordclose"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <button data-toggle="modal" data-target="#stdList<?= $row->id ?>"
                                                    class="btn btn-default">
                                                상품기준정보
                                            </button>
                                            <div class="modal fade" id="stdList<?= $row->id ?>" tabindex="-1"
                                                 role="dialog" aria-labelledby="stdListLabel18"
                                                 aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-hidden="true">&times;
                                                            </button>
                                                            <h4 class="modal-title text-align-center fw-bold mt"
                                                                id="stdListLabel18">상품기준정보</h4>
                                                        </div>
                                                        <div class="modal-body bg-gray-lighter">

                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <?php
                                                                    $stdList = json_decode($row->stdList);
                                                                    foreach ($stdList as $std) {
                                                                        ?>
                                                                        <div class="col-sm-12">
                                                                            <span>주중주말코드 : <?=$std->midwkWkndDivCd ?> / 기준인원수 : <?=$std->stdGcnt ?> / 판매금액 : <?=$std->sellAmt ?></span>
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-gray ordclose"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <button data-toggle="modal" data-target="#stdGoodtList<?= $row->id ?>"
                                                    class="btn btn-default">
                                                기준상품리스트
                                            </button>
                                            <div class="modal fade" id="stdGoodtList<?= $row->id ?>" tabindex="-1"
                                                 role="dialog" aria-labelledby="stdGoodtListLabel18"
                                                 aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-hidden="true">&times;
                                                            </button>
                                                            <h4 class="modal-title text-align-center fw-bold mt"
                                                                id="stdGoodtListLabel18">기준상품리스트</h4>
                                                        </div>
                                                        <div class="modal-body bg-gray-lighter">

                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">

                                                                        <table class="table table-striped table-lg mt-lg mb-0">
                                                                            <tbody>

                                                                    <?php
                                                                    $stdGoodtList = json_decode($row->stdGoodtList);
                                                                    foreach ($stdGoodtList as $stdGoodt) {
                                                                        ?>

                                                                                <tr>
                                                                                    <td>
                                                                                        주중주말코드 : <?=$stdGoodt->midwkWkndDivCd ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        기준인원수 : <?=$stdGoodt->stdGcnt ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        영업장코드: <?=$stdGoodt->outletCd ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        메뉴코드: <?=$stdGoodt->menuCd ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        메뉴명: <?=$stdGoodt->menuNm ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        메뉴유형코드: <?=$stdGoodt->menuTypeCd ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        메뉴유형명: <?=$stdGoodt->menuTypeNm ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        사용수량: <?=$stdGoodt->useQty ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        분활출력여부: <?=$stdGoodt->indvPrtYn ?>
                                                                                    </td>
                                                                                </tr>

                                                                    <?php
                                                                    }
                                                                    ?>
                                                                            </tbody>
                                                                        </table>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-gray ordclose"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>




                                        </td>





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
    $(function () {

        $('.pcms_id').keyup(function () {
            var code = $(this).attr('code');
            var pcmsitem_id = $("#pcms_id" + code).val();

            $.ajax({
                url: "<?php echo site_url('sys/get_itemname'); ?>",
                data: {pcmsitem_id: pcmsitem_id},
                type: "POST",
                success: function (msg) {
                    $("#pcmsitem_item" + code).text(msg);
                }
            })
        });

        $('.pcms_id').keypress(function (e) {
            var code = $(this).attr('code');
            var pcmsitem_id = $("#pcms_id" + code).val();

            if (e.keyCode == 13) {
                if (confirm("연동하시겠습니까?")) {

                    $.ajax({
                        url: "<?php echo site_url('phoenix/pkg_itemnm_update'); ?>",
                        data: {code: code, pcmsitem_id: pcmsitem_id},
                        type: "POST",
                        success: function (msg) {
                            // alert(msg);

                            if (msg == "ok") {
                                alert("등록되었습니다.");
                            } else {
                                alert(msg);
                            }
                        }
                    })

                } else {
                    return false;
                }
            }
        });

        $('#search_btn').click(function () {
            $('#fform').submit();
        });

        $('#cancel_btn').click(function () {
            $(location).attr('href', '/phoenix/phoenix_pkg/new');
        });


    });
</script>