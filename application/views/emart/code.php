<?php
/**
 * Created by PhpStorm.
 * User: MINO
 * Date: 2016-11-11
 * Time: 오후 3:14
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

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">차수</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="bigo" id="bigo"
                                               class="form-control"
                                               placeholder="이마트피자 판매 차수를 입력해주세요."
                                               data-placement="top">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="simple-big-select">
                                        채널 선택
                                    </label>
                                    <div class="col-sm-4">
                                        <select name="chnpick"
                                                id="chnpick"
                                                class="selectpicker"
                                                data-style="btn-default btn-lg"
                                                tabindex="-1" >
                                            <!-- <option value="0">선택</option> -->
                                            <?php
                                            foreach($chnarr as $chnk => $chnv){ ?>
                                                <option value="<?=$chnk?>"><?=$chnv?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">상품명</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="sort" id="sort"
                                               class="form-control"
                                               placeholder="상품명을 입력해주세요."
                                               data-placement="top">
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">수량</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="qty" id="qty" maxlength="5"
                                               class="form-control"
                                               placeholder="생성 수량을 입력하세요."
                                               data-placement="top"
                                               OnKeyPress="num_only()">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">쿠폰유효기한</label>
                                    <div class="col-sm-3">
                                        <input id="selldate" type="text" class="form-control datetimepicker3" maxlength="10" />
                                    </div>
                                </div>

                                <div class="openCHN" style="display: none">

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="max-length">상품번호</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="pcmsid" id="pcmsid" maxlength="5"
                                                   class="form-control"
                                                   placeholder="PCMS 상품번호를 입력해주세요."
                                                   data-placement="top" data-original-title="You cannot write more than 4 characters."
                                                   OnKeyPress="num_only()">
                                            <span class="help-block" id="pcmsitem_item"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="max-length">문자 발송</label>
                                        <div class="col-sm-3">
                                            <div class="checkbox-inline checkbox-ios">
                                                <label for="checkbox-ios1">
                                                    <input type="checkbox" id="checkbox-ios1" class="chksms" data-toggle="toggle">
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group smsForm"  style="display: none">
                                        <label class="col-sm-3 control-label" for="max-length">
                                            문자 내용
                                            <span class="help-block">
                                                       상품명 <code>{title}</code>
                                            </span>
                                            <span class="help-block">
                                                    쿠폰번호 <code>{no}</code>
                                            </span>
                                        </label>
                                        <div class="col-sm-5">
                                            <span class="help-block">큐보이 안내 링크와 문자내용사이에 한줄 띄어주세요.</span>
                                            <textarea rows="10" class="form-control textarea_value smsTXT" id="default-textarea">
ㅁ 지금 구매한 이용권 바로 보관하기(안드로이드폰 전용) http://goo.gl/HcZ9Qm

상품 : {title}
쿠폰번호 : {no}
유효기간 : 까지
취소기간 : 까지
스파로 고객센터 안내: ☎ 1544-3913
                                            </textarea>

                                        </div>
                                    </div>

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
                                    <th class="no-sort hidden-xs">차수</th>
                                    <th class="hidden-xs">판매채널</th>
                                    <th class="hidden-xs">상품코드</th>
                                    <th class="hidden-xs">상품명</th>
                                    <th class="hidden-xs">유효기한</th>
                                    <th class="hidden-xs">문자내용</th>
                                    <th class="hidden-xs">엑셀다운</th>
                                    <th class="hidden-xs">사용핀</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?
                                foreach($query->result() as $row):
                                ?>
                                    <tr> <!-- style="color: orange;" -->
                                        <td style="font-size:12px;"><?=$row->bigo?>차</td>
                                        <td style="font-size:12px;"><?php
                                            if(array_key_exists($row->chn,$chnarr)){
                                                echo $chnarr[$row->chn];
                                            } else{
                                                echo $row->chn;
                                            }
                                            ?></td>
                                        <td style="font-size:12px;"><?=$row->pcmsid?></td>
                                        <td style="font-size:12px;"><?=$row->sort?></td>
                                        <td style="font-size:12px;"><?=$row->selldate?></td>

                                        <td style="font-size:12px;">

                                            <?php if($row->mms_state == 'Y'){?>
                                            <button class="btn btn-gray" data-toggle="modal" data-target="#myModal<?=$row->id?>">
                                                보기/편집
                                            </button>
                                            <div class="modal fade" id="myModal<?=$row->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title text-align-center fw-bold mt" id="myModalLabel18"><?=$row->sort?></h4>
                                                        </div>
                                                        <div class="modal-body bg-gray-lighter">
                                                            <form>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <textarea rows="20" class="form-control mmstext_<?=$row->id?>" id="default-textarea"><?=$row->mms_text?></textarea>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-gray" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-success mmssave" flag="<?=$row->id?>">Save changes</button>
                                                            <button type="button" class="btn btn-danger mmsstop" flag="<?=$row->id?>">Stop</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php }?>
                                        </td>
                                        <td>
                                            <?php if($row->state == 'S' && ($row->chn == 'TMON' || $row->chn == 'CPNG' || $row->chn == 'WEMP')){?>
                                                    <i class="fa fa-file-excel-o" onclick="exceldown('<?=$row->id?>');" class="hand" style="cursor: hand"></i>
                                            <?php }?>
                                        </td>
                                        <td>
                                            <?php if($row->state == 'S' && ($row->chn == 'TMON' || $row->chn == 'CPNG' || $row->chn == 'WEMP' || $row->chn == '티몬')){?>
                                                <i class="fa fa-file-excel-o" onclick="exceldown_use('<?=$row->id?>');" class="hand" style="cursor: hand"></i>
                                            <?php }?>
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

    function exceldown(id){
        //downloadURI("data:,HelloWorld!", "helloWorld.txt");
        window.location.assign('<?php echo site_url('emart/code_excel'); ?>'+"/"+id);
    }
    function exceldown_use(id){
        //downloadURI("data:,HelloWorld!", "helloWorld.txt");
        window.location.assign('<?php echo site_url('emart/code_excel_use'); ?>'+"/"+id);
    }

    function num_only(){
        //alert();
        if((event.keyCode<48) || (event.keyCode>57)){
            event.returnValue=false;
        }
    }


    $(function(){

        $('#chnpick').change(function(){
            var chnpick = $('#chnpick').val();
            if(chnpick == 'AUCT' || chnpick == 'GMKT' || chnpick == '11ST' || chnpick == 'OPEN'){
                $('.openCHN').slideDown();
            }else{
                $('.openCHN').slideUp();
            }
        });

        $('.chksms').change(function(){

            if($(this).prop('checked')){
                $('.smsForm').slideDown();
            }else{
                $('.smsForm').slideUp();
            }
        });


        $("#pcmsid").keyup(function() {

            var pcmsid = $("#pcmsid").val();

            $.ajax({
                url: "<?php echo site_url('sys/get_itemname'); ?>",
                data: {pcmsitem_id : pcmsid},
                type:"POST",
                success:function(msg)
                {
                    $( "#pcmsitem_item" ).text(msg);
                }
            })
        });

        $('.mmssave').click(function(){

            var flag = $(this).attr('flag');
            var mmstext = $('.mmstext_'+flag).val();

            if(confirm("문자를 변경하시겠습니까?")){
                $.ajax({
                    url: "<?php echo site_url('emart/mms_save'); ?>",
                    data: {flag : flag , mmstext : mmstext},
                    type:"POST",
                    success:function(msg)
                    {
                        if(msg == "err"){
                            alert("문자 변경 실패");
                        }else{
                            $(location).attr('href','/emart/code/');
                        }
                    }
                })
            }
        });

        $('.mmsstop').click(function(){

            var flag = $(this).attr('flag');

            if(confirm("문자를 정지하시겠습니까?")){
                $.ajax({
                    url: "<?php echo site_url('emart/mms_stop'); ?>",
                    data: {flag : flag},
                    type:"POST",
                    success:function(msg)
                    {
                        if(msg == "err"){
                            alert("문자 정지 실패");
                        }else{
                            $(location).attr('href','/emart/code/');
                        }
                    }
                })
            }
        });

        $('#cancel_btn').click(function(){
            $(location).attr('href','/emart/code');
            //alert();
        });

        $('#save_btn').click(function(){



            if($('#bigo').val() == '' || $('#bigo').val() == null )
            {
                alert('차수를 입력해 주세요.');
                $('#bigo').focus();
                return false;
            }

            if($('#chnpick').val() == '' || $('#chnpick').val() == null ) {
                alert('채널을 선택해 주세요.');
                $('#chnpick').focus();
                return false;
            }else if($('#chnpick').val() == 'AUCT' || $('#chnpick').val() == 'GMKT' || $('#chnpick').val() == '11ST' || $('#chnpick').val() == 'OPEN' ){
                if($('#pcmsid').val() == '' || $('#pcmsid').val() == null )
                {
                    alert('상품번호를 입력해 주세요.');
                    $('#pcmsid').focus();
                    return false;
                }
            }

            if($('#sort').val() == '' || $('#sort').val() == null )
            {
                alert('상품명을 입력해 주세요.');
                $('#sort').focus();
                return false;
            }

            if($('#qty').val() == '' || $('#qty').val() == null)
            {
                alert('쿠폰 수량을 입력해 주세요.');
                $('#qty').focus();
                return false;
            }

            if($('#qty').val() > 10000 )
            {
                alert('최대 생성 수량을 넘었습니다.');
                $('#qty').focus();
                return false;
            }

            if($('#selldate').val() == '' || $('#selldate').val() == null )
            {
                alert('쿠폰유효기간을 입력해 주세요.');
                $('#selldate').focus();
                return false;
            }
            
            


            if(confirm("등록 하시겠습니까?")){
                var bigo = $('#bigo').val();
                var chnpick = $('#chnpick').val();
                var sort = $('#sort').val();
                var selldate = $('#selldate').val();
                var pcmsid = $('#pcmsid').val();
                var chksms = $('.chksms').prop('checked');
                var smsTXT = $('.smsTXT').val();
                var qty = $('#qty').val();



                $.ajax({
                    url: "<?php echo site_url('emart/code_add'); ?>",
                    data: {
                        bigo:bigo,
                        chnpick:chnpick,
                        sort:sort,
                        selldate:selldate,
                        pcmsid:pcmsid,
                        chksms:chksms,
                        smsTXT:smsTXT,
                        qty:qty
                            },
                    type:"POST",
                    success:function(msg)
                    {
                        //alert(msg);

                        if(msg == "err"){
                            alert("등록실패");
                        }else{
                            $(location).attr('href','/emart/code/');
                        }

                    }
                })
            }

        });



    });
</script>