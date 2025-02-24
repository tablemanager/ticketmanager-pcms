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
                <form  role="form" id="insertform" name="insertform" class="form-horizontal" role="form" method="post" action="" >
                    <fieldset>

                        <div class="col-sm-6"><!--1번째-->

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="max-length">플엠 상품번호</label>
                                <div class="col-sm-8">
                                    <input type="text" name="item_id" id="item_id" maxlength="5"
                                           class="form-control"
                                           placeholder="PCMS 상품번호를 입력해주세요."
                                           data-placement="top" data-original-title="You cannot write more than 4 characters.">
                                    <span class="help-block" id="pcmsitem_item"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="max-length">플엠 상품명</label>
                                <div class="col-sm-8">
                                    <input id="itemname" name="itemname" type="text" class="form-control"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="max-length">상점코드</label>
                                <div class="col-sm-8">
                                    <input id="shopcd" name="shopcd" type="number" class="form-control" placeholder="판매처 코드를 입력해주세요."/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="max-length">상품코드</label>
                                <div class="col-sm-8">
                                    <input id="ticketcd" name="ticketcd" type="text" class="form-control" placeholder="코드명을 입력해주세요."/>
                                </div>
                            </div>
                        </div><!--1번째-->

                        <div class="col-sm-6"><!--2번째-->
                            <div class="form-group">
                                <div class="col-sm-8">

                                                <textarea rows="17" class="form-control textarea_value" id="default-textarea">
▣상품명 : {title}
▣이름 :  {usernm} ({hp3})
▣교환장소 : 블루캐니언 매표소
▣이용권번호 : {orderno}
▣매수 : {man1} 매
▣유효기간 : ~2017년00월00일 주중/주말 中 1일
[유의사항]
-본 티켓은 ~2017년00월00일까지 구매한 옵션에맞게 사용가능합니다.
-본 티켓은 유효기간 2일 전까지 취소 및 환불이 가능하며 그 이후로는 불가능합니다.
-티켓 사용당일 매표소에서 티켓 교환 후 이용이 가능합니다.
-유효기간이 지난 티켓은 연장 및 취소가 불가능 합니다.
-온라인 재판매 목적으로 양도시 현장에서 티켓불출이 불가합니다.
-구매 상품에 대해 부분 수령, 부분 취소 불가능합니다.
-블루캐니언 운영시간 및 세부안내는 방문전 홈페이지를 참조바랍니다.
-쿠폰번호삭제 및 미수신경우 스파로 고객센터(1544-3913) 연락바랍니다.
                                                </textarea>
                                </div>
                                <label class="col-sm-3 control-label" for="max-length">
                                    문자 내용
                                    <span class="help-block">
                                                        상품명 <code>{title}</code>
                                                </span>
                                    <span class="help-block">
                                                        이용권번호 <code>{orderno}</code>
                                                </span>
                                    <span class="help-block">
                                                        인원(매수) <code>{man1}</code>
                                                </span>
                                    <span class="help-block">
                                                        이름 <code>{usernm}</code>
                                                </span>
                                    <span class="help-block">
                                                        휴대폰 뒷번호 <code>{hp3}</code>
                                                </span>

                                </label>
                            </div>
                        </div><!--2번째-->

                    </fieldset>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-sm-offset-5 col-sm-7">
                                <button type="button" id="save_btn" class="btn btn-primary">등 록</button>
                                <button type="button" id="cancel_btn" class="btn btn-inverse">취 소</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>

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
                    <table class="table table-striped table-lg mt-lg mb-0">
                        <thead class="no-bd">
                        <tr>
                            <th class="no-sort hidden-xs">번호</th>
                            <th class="hidden-xs">상품번호</th>
                            <th class="hidden-xs">상품명</th>
                            <th class="hidden-xs">상점코드</th>
                            <th class="hidden-xs">상품코드</th>
                            <th class="hidden-xs">문자내용</th>
                            <th class="hidden-xs">상태</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($query->result() as $row):
                            ?>

                            <tr>
                                <td style="font-size:12px;"><?=$row->id?></td>
                                <td style="font-size:12px;"><?=$row->item_id?></td>
                                <td style="font-size:12px;"><?=$row->itemname?></td>
                                <td style="font-size:12px;"><?=$row->shopcd?></td>
                                <td style="font-size:12px;"><?=$row->ticketcd?></td>
                                <td style="font-size:12px;">
                                    <button class="btn btn-gray" data-toggle="modal" data-target="#myModal<?=$row->id?>">
                                        보기/편집
                                    </button>
                                    <div class="modal fade" id="myModal<?=$row->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title text-align-center fw-bold mt" id="myModalLabel18"><?=$row->itemname?></h4>
                                                </div>
                                                <div class="modal-body bg-gray-lighter">
                                                    <form>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <textarea rows="30" class="form-control mmstext_<?=$row->id?>" id="default-textarea"><?=$row->msg?></textarea>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-gray" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-success mmssave" flag="<?=$row->id?>">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td >
                                    <?php
                                    if($row->state == 'Y'){
                                        $uflg =  "사용";
                                    }else if($row->state == 'N'){
                                        $uflg =  "정지";
                                    }else{
                                        $uflg = $row->state;
                                    }
                                    ?>
                                    <a id="use_<?=$row->id?>" onclick="unusestate('<?=$row->id?>');" uflag ="<?=$uflg?>"><?=$uflg?></a>
                                </td>

                            </tr>
                        <?php
                        endforeach;
                        ?>
                        </tbody>
                    </table>
                    <?= $pag_links; ?>
                </div>
            </div>
        </section>
    </div>
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
    function unusestate(code){
        var use_text = $("#use_"+code).attr("uflag");
        var unuse_text = "";
        var flag = "";
        if(use_text == "사용"){
            unuse_text = "정지";
            flag = "N";
        }else if(use_text == "정지"){
            unuse_text = "사용";
            flag = "Y";
        }else{
            return false;
        }
        if(confirm(unuse_text+" 상태로 변경하시겠습니까?")){

            $.ajax({
                url: "<?php echo site_url('/phoenix/skiseason_item_use'); ?>",
                data: {code : code , use_state : flag},
                type:"POST",
                success:function(msg)
                {
                    if (msg == "err"){
                        alert("변경에 실패하였습니다.");
                    }else if(msg == "ok"){
                        $('#use_'+code).text(unuse_text);
                        $('#use_'+code).attr("uflag",unuse_text);
                    }

                }
            })

        }
    }

    $(function() {

        $("#item_id").keyup(function () {
            var item_id = $('#item_id').val();
            $.ajax({
                url: "<?php echo site_url('sys/get_itemname'); ?>",
                data: {pcmsitem_id: item_id},
                type: "POST",
                success: function (msg) {
                    //$(location).attr('href',msg);
                    $("#pcmsitem_item").text(msg);
                }
            })
        });

        $('#save_btn').click(function(){

            if($('#item_id').val() == '' || $('#item_id').val() == null ){
                alert('상품번호를 입력해 주세요.');
                $('#item_id').focus();
                return false;
            }
            if($('#itemname').val() == '' || $('#itemname').val() == null){
                alert('상품명을 입력해 주세요.');
                $('#itemname').focus();
                return false;
            }
            if($('#shopcd').val() == '' || $('#shopcd').val() == null){
                alert('상점코드를 입력해 주세요.');
                $('#shopcd').focus();
                return false;
            }
            if($('#ticketcd').val() == '' || $('#ticketcd').val() == null){
                alert('상품코드를 입력해 주세요.');
                $('#ticketcd').focus();
                return false;
            }

            if(confirm("등록 하시겠습니까?")){

                var item_id = $('#item_id').val();
                var itemname = $('#itemname').val();
                var shopcd = $('#shopcd').val();
                var ticketcd = $('#ticketcd').val();
                var msg = $('#default-textarea').val();

                $.ajax({
                    url: "<?php echo site_url('phoenix/skiseason_item_add'); ?>",
                    data: {
                        item_id:item_id,
                        itemname:itemname,
                        shopcd:shopcd,
                        ticketcd:ticketcd,
                        msg:msg
                    },
                    type:"POST",
                    success:function(msg)
                    {
                        if(msg == "ok"){
                            $(location).attr('href','/phoenix/skiseason_item');
                        }else{
                            alert(msg);
                        }
                    }
                })
            }

        });


    });

</script>