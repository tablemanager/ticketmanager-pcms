<?php
/**
 * Created by PhpStorm.
 * User: MINO
 * Date: 2016-11-22
 * Time: 오후 4:02
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
                                    <label class="col-sm-3 control-label" for="max-length">시설명</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="aname" id="aname"
                                               class="form-control"
                                               placeholder="시설 이름을 입력해주세요."
                                               data-placement="top">
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="button" id="save_btn" class="btn btn-primary">등 록</button>
                                    </div>
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
                                    <th class="no-sort hidden-xs">번호</th>
                                    <th class="hidden-xs">관리자아이디</th>
                                    <th class="hidden-xs">비밀번호</th>
                                    <th class="hidden-xs">회사명</th>
                                    <th class="hidden-xs">로그인시간</th>
                                    <th class="hidden-xs">접속아이피</th>
                                    <th class="hidden-xs" style="text-align: center">결제권한</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?
                                foreach($query->result() as $row):
                                    ?>
                                    <tr> <!-- style="color: orange;" -->
                                        <td style="font-size:12px;"><?=$row->id?></td>
                                        <td style="font-size:12px;"><?=$row->cd?></td>
                                        <td style="font-size:12px;">
                                            <input id="pwmode<?=$row->id?>" type="text" class="pwmode form-control"
                                                   code="<?=$row->id?>" maxlength="15" value="<?=$row->pass?>" oldvalue="<?=$row->pass?>" size="20" style="border:0; background-color: transparent;"/>
                                        </td>

                                        <td style="font-size:12px;"><?=$row->company?></td>
                                        <td style="font-size:12px;"><?=$row->lastlogin?></td>
                                        <td style="font-size:12px;"><?=$row->logip?></td>
                                        <td style="font-size:12px; text-align: center">

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

    $(function(){


        $(".ubtn").click(function() {

            var ubtn = $(this);

            var code = ubtn.attr('code');
            var gu = ubtn.attr('gu');
            //alert(code);alert(gu);

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
                url: "<?php echo site_url('b2b/account_mode_pay'); ?>",
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

        $(".pwmode").click(function() {
            var code = $(this).attr('code');
            $("#pwmode"+code).css('background-color','#F781F3');//transparent
            $("#pwmode"+code).css('color','white');
            //$(this).css('border','1px;');
        });

        $(".pwmode").keypress(function(e) {
            if (e.keyCode == 13){
                var code = $(this).attr('code');
                if(confirm("비밀번호를 변경 하시겠습니까?")){
                    $("#pwmode"+code).css('background-color','transparent');
                    $("#pwmode"+code).css('color','#F781F3');
                    var modtext = $("#pwmode"+code).val();
                    $("#pwmode"+code).blur();

                    $.ajax({
                        url: "<?php echo site_url('b2b/account_mode'); ?>",
                        data: {code : code, modtext:modtext},
                        type:"POST",
                        success:function(msg)
                        {
                            //alert(msg);
                            //$("#bigo"+code).html(msg);
                        }
                    })
                }else{
                    $("#pwmode"+code).css('background-color','transparent');
                    $("#pwmode"+code).css('color','black');
                    $("#pwmode"+code).val($(this).attr('oldvalue'));
                    $("#pwmode"+code).blur();
                }
            }
        });

        $('#save_btn').click(function(){

            var aname = $('#aname').val();

            if($('#aname').val() == '' || $('#aname').val() == null )
            {
                alert('시설이름을 입력해 주세요.');
                $('#aname').focus();
                return false;
            }

            if(confirm(aname+ " 시설 계정을 등록 하시겠습니까?")){

                $.ajax({
                    url: "<?php echo site_url('b2b/account_add'); ?>",
                    data: {
                        aname:aname
                    },
                    type:"POST",
                    success:function(msg)
                    {
                        if(msg == "ok"){
                            $(location).attr('href','/b2b/account/');
                        }else{
                            alert(msg);
                        }
                    }
                })
            }
        });
    });
</script>