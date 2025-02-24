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
                                
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length">문자명</label>
                                    <div class="col-sm-5">
                                        <input type="text" name="itemnm" id="itemnm" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="simple-big-select">
                                        타입
                                    </label>
                                    <div class="col-sm-3">
                                        <select name="TYPE"
                                                id="TYPE"
                                                class="selectpicker"
                                                data-style="btn-default btn-md"
                                                tabindex="-1" >
                                             <option value="">선택</option>
                                             <option value="LMS">LMS</option>
                                             <option value="QR">QR</option>
                                             <option value="BARCODE">BARCODE</option>
                                        </select>
                                        <span class="help-block">쿠폰번호가 없으면 주문번호가 발송됩니다.</span>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="simple-big-select">시설</label>
                                    <div class="col-sm-3">
                                        <select name="chnpick"
                                                id="chnpick"
                                                class="selectpicker"
                                                data-style="btn-default btn-md"
                                                tabindex="-1" >
                                            <!--<option value="">선택</option>-->
                                            <?php
                                            foreach($gpar as $gpk => $gpv){ ?>
                                                <option value="<?=$gpk?>"><?=$gpv?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length">플레이스엠 상품번호</label>
                                    <div class="col-sm-5">
                                        <input type="text" name="pcms_id" id="pcms_id" class="form-control"
                                               placeholder="12345,12346,12347,12... 여러 상품코드를 입력할 수 있습니다." data-placement="top">
                                        <span class="help-block" id="pcmsitem_item"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length">발송 시작일</label>
                                    <div class="col-sm-2">
                                        <input type="text" id="sdate" class="form-control datetimepicker1" maxlength="10" value= "<?php echo date('Y-m-d');?>"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length">발송 종료일</label>
                                    <div class="col-sm-2">
                                        <input type="text" id="edate" class="form-control datetimepicker1" maxlength="10" value= "<?php echo date('Y-m-d');?>"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length">
                                        문자 내용
                                        <!-- <span class="help-block">
                                                   시설명 <code>{jpnm}</code>
                                        </span>
                                        <span class="help-block">
                                                   상품명 <code>{title}</code>
                                        </span> -->
                                        <span class="help-block">
	                                           	주문번호 <code>{orderno}</code>
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
                                        <span class="help-block">
	                                           	이용일자 <code>{usedate}</code>
	                                    </span>
                                    </label>
                                    <div class="col-sm-5">
	                                    <textarea rows="15" class="form-control textarea_value" id="default-textarea">
▣상품명 :
▣쿠폰번호 : {orderno}
▣매수: {man1}명
▣이름 : {usernm} ({hp3})
▣교환장소: OOO 매표소
※유의사항
▶본 권은 구매완료 후 O월 OO일까지만 취소.환불 가능합니다.
▶유효기간은 OOOO년 O월 OO일부터 OOOO년 O월OO일(기간 중 1일)까지입니다.
▶OOO은 연중 무휴입니다.
▶사용하고자 하시는 지점의 매표소를 방문하시어 모바일 티켓 확인 후 입장가능 합니다.
▶온라인 재판매 목적으로 양도시 현장에서 티켓불출이 불가합니다.
▶구매 상품에 대해 부분 수령은 불가하며, 일괄수령이 원칙입니다.
▶당일 구매 후 당일사용이 가능합니다.
▶쿠폰번호삭제 및 미수신경우 스파로 고객센터(1544-3913)로 연락바랍니다.
										</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length">첨부파일 이미지</label>
                                    <!-- addimg -->
                                    <?php
                                    $attributes = array('class' => 'form-horizontal', 'id' => 'addfileform', 'role' => 'form' );
                                    echo form_open_multipart('/toast/setmsg_addimg_ok',$attributes);
                                    ?>
                                    <div class="col-sm-5" >
                                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                            <div class="form-control" data-trigger="fileinput">
                                                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                <span class="fileinput-filename"></span>
                                            </div>
                                            <span class="input-group-addon btn btn-default btn-file">
                                                                            <span class="fileinput-new">Select file</span>
                                                                            <span class="fileinput-exists">Change</span>
                                                                            <input id="userfile" name="userfile" type="file">
                                                                        </span>
                                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                    <?php
                                        echo form_close();
                                    ?>
                                </div>
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
                                    <th>번호</th>
                                    <th>
                                        selectbox
                                    </th>
                                    <th class="no-sort hidden-xs">판매코드</th>
                                    <th class="hidden-xs">PCMS코드</th>
                                    <th class="hidden-xs">상품명</th>
                                    <th class="hidden-xs">유효기간</th>
                                    <th class="hidden-xs">문자내용</th>
                                    <th class="hidden-xs">상태</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($query->result() as $row):
                                ?>

                                <tr>
                                    <td><?=$row->id?></td>
                                    <td><?=$row->gp?></td>
                                    <td><?=$row->sellcode?></td>
                                    <td><?=$row->pcms_id?></td>
                                    <td><?=$row->itemnm?></td>
                                    <td>
                                        <input id="datechange<?=$row->id?>" type="text" class="datechange form-control datetimepicker3"
                                               code="<?=$row->id?>" maxlength="10" value="<?=$row->edate?>" size="10" style="border:0; background-color: transparent;"/>
                                    </td>
                                    <td>
                                        <button class="btn btn-gray" data-toggle="modal" data-target="#myModal<?=$row->id?>">
                                            보기/편집
                                        </button>
                                        <div class="modal fade" id="myModal<?=$row->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title text-align-center fw-bold mt" id="myModalLabel18"><?=$row->itemnm?></h4>
                                                    </div>
                                                    <div class="modal-body bg-gray-lighter">
                                                        <form>
                                                            <div class="row">
                                                                <div class="col-md-12" style="margin-top: 5px">
                                                                    <textarea rows="30" class="form-control mmstext_<?=$row->id?>" id="default-textarea"><?=$row->mms_text?></textarea>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-gray" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-success mmssave" flag="<?=$row->id?>">Save changes</button>
                                                    </div>
                                                    <div class="modal-body bg-gray-lighter">
                                                        <div class="row">
                                                            <?php if($row->add_img){?>
                                                                <div class="col-md-offset-4 col-md-4">
                                                                    <img src="<?=$row->add_img?>">
                                                                </div>
                                                            <?php }?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <!-- addimg -->
                                                            <?php
                                                            $attributes = array('class' => 'form-horizontal', 'id' => 'addfileform_'.$row->id , 'role' => 'form' );
                                                            echo form_open_multipart('/toast/setmsg_addimg_ok/'.$row->id,$attributes);
                                                            ?>
                                                            <div class="col-sm-offset-1 col-sm-8" >
                                                                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                                    <div class="form-control" data-trigger="fileinput">
                                                                        <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                                        <span class="fileinput-filename"></span>
                                                                    </div>
                                                                    <span class="input-group-addon btn btn-default btn-file">
                                                                            <span class="fileinput-new">Select file</span>
                                                                            <span class="fileinput-exists">Change</span>
                                                                            <input id="userfile" name="userfile" type="file">
                                                                        </span>
                                                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                                </div>
                                                            </div>
                                                            <?php
                                                                echo form_close();
                                                            ?>
                                                            <div class="col-md-3">
                                                                <button type="button" id="addimgSave<?=$row->id?>" class="addimgSave btn btn-primary" flag="<?=$row->id?>">추가 이미지 등록</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                        if($row->useyn == 'Y'){
                                            $uflg =  "사용";
                                        }else if($row->useyn == 'N'){
                                            $uflg =  "정지";
                                        }else{
                                            $uflg = $row->useyn;
                                        }
                                        ?>
                                        <a id="use_<?=$row->id?>" onclick="unusestate('<?=$row->id?>');" uflag ="<?=$uflg?>"><?=$uflg?></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
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
            url: "<?php echo site_url('/toast/toast_use'); ?>",
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
        // alert("개발중");

    }
}

$(function() {
    $('#pcms_id').keyup(function() {
        var pcmsitem_id = $("#pcms_id").val();
        var pcmsItemArr = pcmsitem_id.split(",");
        var pcmsId = pcmsItemArr[pcmsItemArr.length - 1].trim();

        $.ajax({
            url: "<?php echo site_url('sys/get_itemname'); ?>",
            data: {pcmsitem_id: pcmsId},
            type: "POST",
            success: function (msg) {
                //$(location).attr('href',msg);
                $("#pcmsitem_item").text(msg);
            }
        })
    });

    $('#cancel_btn').click(function(){
        $(location).attr('href','/toast/setmsg');
    });

    $('#save_btn').click(function() {
        var itemnm = $('#itemnm').val();
        var TYPE = $('#TYPE').val();
        var chnpick = $('#chnpick').val();
        var pcms_id = $('#pcms_id').val();
        var sdate = $('#sdate').val();
        var edate = $('#edate').val();
        var textarea_value = $('.textarea_value').val();

        if(itemnm == '' || itemnm == null ){
            alert('채널을 선택해 주세요.');
            $('#itemnm').focus();
            return false;
        }
        if(TYPE == '' || TYPE == null ){
            alert('타입을 선택해 주세요.');
            $('#TYPE').focus();
            return false;
        }
        if(chnpick == '' || chnpick == null ){
            alert('채널을 선택해 주세요.');
            $('#chnpick').focus();
            return false;
        }
        if (pcms_id == '' || pcms_id == null) {
            alert('PCMS 상품번호를 입력해 주세요.');
            $('#pcms_id').focus();
            return false;
        }
        if (sdate == '' || sdate == null) {
            alert('사용시작일을 입력해 주세요.');
            $('#sdate').focus();
            return false;
        }
        if (edate == '' || edate == null) {
            alert('사용종료일을 입력해 주세요.');
            $('#edate').focus();
            return false;
        }
        if (textarea_value == '' || textarea_value == null) {
            alert('문자내용을 입력해 주세요.');
            $('.textarea_value').focus();
            return false;
        }


        if (confirm("등록 하시겠습니까?")) {
            // $('#addfileform').submit();
            $.ajax({
                url: "<?php echo site_url('toast/setmsg_insert'); ?>",
                data: {itemnm:itemnm,TYPE:TYPE,chnpick:chnpick,pcms_id:pcms_id,sdate:sdate,edate:edate,textarea_value:textarea_value},
                type: "POST",
                success: function (msg) {
                    // alert(msg);

                    var res = msg.split('|');
                    if (res[0] == "err") {
                        alert(res[1]);
                    } else {
                        alert(msg);
                        // $('#addfileform').submit();
                        $(location).attr('href','/toast/setmsg');
                    }

                }
            })

        }
    });

    $(".addimgSave").click(function() {
        var flag = $(this).attr('flag');
        if(confirm("추가 이미지를 등록 하시겠습니까?")){
            $('#addfileform_'+flag).submit();
        }
    });
});
</script>