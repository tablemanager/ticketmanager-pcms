<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2017-04-13
 * Time: 오후 4:06
 */
?>

<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold"><?php echo $title;?></span></h3>
        <div class="row">
            <div class="col-md-12">

                <?php if($this->session->userdata('cd') == "penfen"){
                    //echo $sql;

                }?>


                <section class="widget">
                    <header>
                        <!-- <h4>Table <span class="fw-semi-bold">Styles</span></h4> -->
                        <div class="widget-controls">
                            <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a>
                            <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a>
                            <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </header>
                    <div class="widget-body">
                        <form  role="form" id="insertform" name="insertform" class="form-horizontal" role="form" method="post" action="" >
                            <fieldset>

                                <div  class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length">패키지명</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="nm" id="nm"
                                               class="form-control"
                                               placeholder="한국어 패키지 이름을 입력해주세요."
                                               data-placement="top">
                                    </div>
                                    <div class="col-sm-offset-4 col-sm-4">
                                        <input type="text" name="nm_english" id="nm_english"
                                               class="form-control"
                                               placeholder="영어 패키지 이름을 입력해주세요."
                                               data-placement="top">
                                    </div>
                                    <div class="col-sm-offset-4 col-sm-4">
                                        <input type="text" name="nm_china_simplified" id="nm_china_simplified"
                                               class="form-control"
                                               placeholder="중국어(간체) 패키지 이름을 입력해주세요."
                                               data-placement="top">
                                    </div>
                                    <div class="col-sm-offset-4 col-sm-4">
                                        <input type="text" name="nm_china_traditional" id="nm_china_traditional"
                                               class="form-control"
                                               placeholder="중국어(번체) 패키지 이름을 입력해주세요."
                                               data-placement="top">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="simple-big-select">
                                        채널 선택
                                    </label>
                                    <div class="col-sm-4">
                                        <select name="A_ID"
                                                id="A_ID"
                                                class="selectpicker"
                                                data-style="btn-default"
                                                tabindex="-1" >
                                            <!-- <option value="0">선택</option> -->
                                            <option value=""> - 선택 - </option>
                                            <?php //
                                            foreach($chn->result() as $chnrow): ?>
                                                <option value="<?=$chnrow->id?>"><?=$chnrow->cd."(".$chnrow->id.")"?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="simple-big-select">
                                        상품 선택
                                    </label>
                                    <div class="col-sm-2">
                                        <select name="PKG_CODE1"
                                                id="PKG_CODE1"
                                                class="select1 form-control"
                                                data-style="btn-default"
                                                tabindex="-1" >
                                            <!-- <option value="0">선택</option> -->
                                            <option value=""> - 첫번째 상품 - </option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <select name="PKG_CODE2"
                                                id="PKG_CODE2"
                                                class="select1 form-control"
                                                data-style="btn-default"
                                                tabindex="-1" >
                                            <!-- <option value="0">선택</option> -->
                                            <option value=""> - 두번째 상품- </option>
                                        </select>
                                    </div>
                                </div>


                                <div  class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length">가격</label>
                                    <div class="col-sm-2">
                                        <input type="number" name="jung_price" id="jung_price"
                                               class="form-control"
                                               placeholder="정상가"
                                               data-placement="top">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="number" name="sell_price" id="sell_price"
                                               class="form-control"
                                               placeholder="판매가"
                                               data-placement="top">
                                    </div>
                                </div>

                                <div  class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length">사용기간</label>
                                    <div class="col-sm-2">
                                        <input type="text" name="sdate" id="sdate"
                                               class="form-control datetimepicker3"
                                               placeholder="시작일"
                                               data-placement="top">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" name="edate" id="edate"
                                               class="form-control datetimepicker3"
                                               placeholder="종료일"
                                               data-placement="top">
                                    </div>
                                </div>


                                <div class="col-sm-offset-5 col-sm-7">
                                    <button type="button" id="save_btn" class="btn btn-primary">등 록</button>
                                    <button type="button" id="cancel_btn" class="btn btn-inverse">취 소</button>
                                </div>


                            </fieldset>

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
                                    <th class="hidden-xs">상품번호</th>
                                    <th class="no-sort hidden-xs">시설명</th>
                                    <th class="hidden-xs">상품명</th>
                                    <th class="hidden-xs">패키지 상품</th>
                                    <th class="hidden-xs">판매가</th>
                                    <th class="hidden-xs">정상가</th>
                                    <th class="hidden-xs">판매시작일</th>
                                    <th class="hidden-xs">판매종료일</th>
                                    <th class="hidden-xs">사용/미사용</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?
                                foreach($query->result() as $row):
                                    ?>
                                    <tr> <!-- style="color: orange;" -->
                                        <td style="font-size:12px;"><?=$row->id?></td>
                                        <td style="font-size:12px;"><?=$row->cd?></td>
                                        <td style="font-size:12px; width: 35%" ><table style="width: 100%">
                                                <tr>
                                                    <td style="font-size: x-small;"><b>한국어</b></td>
                                                    <td style="width: 85%"><input id="nmmode<?=$row->id?>" type="text" class="nmmode form-control"
                                                                                  code="<?=$row->id?>" flang="nm" maxlength="100" value="<?=$row->nm?>" oldvalue="<?=$row->nm?>" size="20" style="border:0; background-color: transparent;"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: x-small;"><b>영어</b></td>
                                                    <td><input id="nmmode_english<?=$row->id?>" type="text" class="nmmode form-control"
                                                               code="<?=$row->id?>" flang="nm_english" maxlength="100" value="<?=$row->nm_english?>" oldvalue="<?=$row->nm_english?>" size="20" style="border:0; background-color: transparent;"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: x-small;"><b>중국어(간체)</b></td>
                                                    <td><input id="nmmode_china_simplified<?=$row->id?>" type="text" class="nmmode form-control"
                                                               code="<?=$row->id?>" flang="nm_china_simplified" maxlength="100" value="<?=$row->nm_china_simplified?>" oldvalue="<?=$row->nm_china_simplified?>" size="20" style="border:0; background-color: transparent;"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: x-small;"><b>중국어(번체)</b></td>
                                                    <td><input id="nmmode_china_traditional<?=$row->id?>" type="text" class="nmmode form-control"
                                                               code="<?=$row->id?>" flang="nm_china_traditional" maxlength="100" value="<?=$row->nm_china_traditional?>" oldvalue="<?=$row->nm_china_traditional?>" size="20" style="border:0; background-color: transparent;"/>
                                                    </td>
                                                </tr>

                                            </table></td>
                                        <td style="font-size:12px;">첫번째 상품 <br/><?=$row->bi2nm." [".$row->bi2ITEM_CODE."]" ?><br/><br/>
                                            두번째 상품<br/><?=$row->bi3nm." [".$row->bi3ITEM_CODE."]" ?></td>
                                        <td style="font-size:12px;"><?=$row->sell_price?></td>
                                        <td style="font-size:12px;"><?=$row->jung_price?></td>
                                        <td style="font-size:12px;"><?=$row->sdate?></td>
                                        <td style="font-size:12px;"><?=$row->edate?></td>
                                        <td >
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
                                            <br><br>
                                            <?php
                                            if($row->bank){$bflg="use";}else{$bflg="unuse";}?>
                                            <a class="ubtn bank <?=$bflg?>" id="bank_<?=$row->id?>" code="<?=$row->id?>" gu="bank">무통장</a>
                                            <?php
                                            if($row->card){$cflg="use";}else{$cflg="unuse";}?>
                                            <a class="ubtn card <?=$cflg?>" id="card_<?=$row->id?>" code="<?=$row->id?>" gu="card">카드</a>

                                            <?php
                                            if($row->after){$aflg="use";}else{$aflg="unuse";}?>
                                            <a class="ubtn after <?=$aflg?>" id="after_<?=$row->id?>" code="<?=$row->id?>" gu="after">후정산</a>
                                        </td>
                                    </tr>
                                    <?
                                endforeach;
                                ?>
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
                url: "<?php echo site_url('/b2b/b2b_item_use'); ?>",
                data: {code : code , use_state : flag},
                type:"POST",
                success:function(msg)
                {
                    //alert(msg);
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

    $(function(){
        $(".ubtn").click(function() {

            var ubtn = $(this);

            var code = ubtn.attr('code');
            var gu = ubtn.attr('gu');

            if($(this).hasClass('use')){
                var mode = 0;
                var removeC = 'use';
                var addC = 'unuse';
            }else{
                var mode = 1;
                var removeC = 'unuse';
                var addC = 'use';
            }

            $.ajax({
                url: "<?php echo site_url('b2b/item_mode_pay'); ?>",
                data: {code : code, gu:gu, mode:mode},
                type:"POST",
                success:function(msg)
                {
                    if(msg == "ok"){
                        ubtn.removeClass(removeC);
                        ubtn.addClass(addC);
                    }else{
                        alert("변경 실패");
                    }
                }
            })
        });

        $(".nmmode").click(function() {
            var code = $(this).attr('code');
            $(this).css('background-color','#F781F3');//transparent
            $(this).css('color','white');
        });

        $(".nmmode").keypress(function(e) {
            if (e.keyCode == 13){
                var code = $(this).attr('code');
                var flang = $(this).attr('flang');

                if(confirm("상품명을 변경 하시겠습니까?")){
                    $(this).css('background-color','transparent');
                    $(this).css('color','#F781F3');
                    var modtext = $(this).val();
                    $(this).blur();

                    $.ajax({
                        url: "<?php echo site_url('b2b/itemnm_mode'); ?>",
                        data: {code : code, flang : flang , modtext:modtext},
                        type:"POST",
                        success:function(msg)
                        {
                            //alert(msg);
                            //$("#bigo"+code).html(msg);
                        }
                    })
                }else{
                    $(this).css('background-color','transparent');
                    $(this).css('color','black');
                    $(this).val($(this).attr('oldvalue'));
                    $(this).blur();
                }

            }
        });

        $('#save_btn').click(function(){

            if($('#nm').val() == '' || $('#nm').val() == null )
            {
                alert('패키지명을 입력해주세요.');
                $('#nm').focus();
                return false;
            }

            if($('#A_ID').val() == '' || $('#A_ID').val() == null )
            {
                alert('시설을 선택해 주세요.');
                $('#A_ID').focus();
                return false;
            }

            if($('#PKG_CODE1 option:selected').val() == '' || $('#PKG_CODE1 option:selected').val() == null )
            {
                alert('첫번째 상품을 선택해 주세요.');
                $('#PKG_CODE1').focus();
                return false;
            }

            if($('#PKG_CODE2 option:selected').val() == '' || $('#PKG_CODE2 option:selected').val() == null )
            {
                alert('두번째 상품을 선택해 주세요.');
                $('#PKG_CODE2').focus();
                return false;
            }


            if($('#jung_price').val() == '' || $('#jung_price').val() == null )
            {
                alert('정상가를 입력해 주세요.');
                $('#jung_price').focus();
                return false;
            }

            if($('#sell_price').val() == '' || $('#sell_price').val() == null )
            {
                alert('판매가를 입력해 주세요.');
                $('#sell_price').focus();
                return false;
            }

            if($('#sdate').val() == '' || $('#sdate').val() == null )
            {
                alert('사용 시작일을 입력해 주세요.');
                $('#sdate').focus();
                return false;
            }

            if($('#edate').val() == '' || $('#edate').val() == null )
            {
                alert('사용 종료일을 입력해 주세요.');
                $('#edate').focus();
                return false;
            }

            if(confirm("상품을 등록 하시겠습니까?")){

                $.ajax({
                    url: "<?php echo site_url('b2b/b2b_package_add'); ?>",
                    data: {
                        nm:$('#nm').val(),
                        nm_english:$('#nm_english').val(),
                        nm_china_simplified:$('#nm_china_simplified').val(),
                        nm_china_traditional:$('#nm_china_traditional').val(),
                        A_ID:$('#A_ID').val(),
                        PKG_CODE1:$('#PKG_CODE1 option:selected').val(),
                        PKG_CODE2:$('#PKG_CODE2 option:selected').val(),
                        jung_price:$('#jung_price').val(),
                        sell_price:$('#sell_price').val(),
                        sdate:$('#sdate').val(),
                        edate:$('#edate').val()
                    },
                    type:"POST",
                    success:function(msg)
                    {
                        if(msg == "ok"){
                            $(location).attr('href','/b2b/package_item');
                        }else{
                            alert(msg);
                        }
                    }
                })
            }
        });

        $("#A_ID").change(function(){
            var chnid = $(this).val();

            $.ajax({
                url: "<?php echo site_url('b2b/b2b_get_itemlist'); ?>",
                data: {chnid : chnid},
                type:"POST",
                success:function(msg)
                {
                    $("#PKG_CODE1").html(msg);
                    $("#PKG_CODE2").html(msg);
                }
            })

        });
    });
</script>