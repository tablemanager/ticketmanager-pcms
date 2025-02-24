<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold"><?=$title?></span></h3>
        <div class="row">

            <div class="col-md-4">
                <section class="widget">
                    <div class="widget-body">
                        <?php
                        $attributes = array('class' => 'form-horizontal', 'id' => 'fileform' , 'role' => 'form' );
                        echo form_open_multipart('/order/insert_order_excel',$attributes);
                        ?>
                            <div class="row">
                                <div class="form-group">

                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">처리 상태</label>
                                    <div class="col-sm-8" >
                                        <select id="state_select"
                                                class="select1 form-control"
                                                tabindex="-1"
                                                name="state_select"
                                                style="margin-top: 10px">
                                            <option value="예약완료">예약완료</option>
                                            <option value="접수">접수</option>
                                            <option value="완료">완료</option>
                                            <option value="대기">대기</option>
                                            <option value="취소">취소</option>
                                        </select>
                                    </div>

                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">판매 채널</label>
                                    <div class="col-sm-8">
                                        <select id="chn_select"
                                                data-placeholder="판매채널을 선택하세요."
                                                class="select1 form-control"
                                                tabindex="-1"
                                                name="chn_select"
                                                style="margin-top: 10px">
                                            <option value="">판매채널을 선택하세요.</option>
                                            <?
                                            foreach($cquery->result() as $crow):
                                                ?>
                                                <option class="chn_select_<?php echo $crow->com_id;?>" value="<?php echo $crow->com_id;?>"><?php echo $crow->com_nm."  (".$crow->com_id.")";?></option>
                                                <?
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>


                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">시설 선택</label>
                                    <div class="col-sm-8">
                                        <select id="fac_select"
                                                data-placeholder="시설명을 선택하세요."
                                                class="select1 form-control"
                                                style="margin-top: 10px"
                                                tabindex="-1"
                                                name="fac_select">
                                            <option value="">시설을 선택하세요.</option>
                                            <?
                                            foreach($faclist->result() as $faclistrow):
                                                ?>
                                                <option class="item_select_<?php echo $faclistrow->jpmt_id;?>" value="<?php echo $faclistrow->jpmt_id;?>"><?php echo $faclistrow->jpnm."  (".$faclistrow->jpmt_id.")";?></option>
                                                <?
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>



                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">상품 선택</label>
                                    <div class="col-sm-8">
                                        <select id="item_select"
                                                data-placeholder="상품명을 선택하세요."
                                                class="select1 form-control"
                                                style="margin-top: 10px"
                                                tabindex="-1"
                                                name="item_select">
                                            <option value="">상품을 선택하세요.</option>
                                            <?
                                            foreach($itemlist->result() as $itemlistrow):
                                                ?>
                                                <option class="item_select_<?php echo $itemlistrow->item_id;?>" value="<?php echo $itemlistrow->item_id;?>"><?php echo $itemlistrow->item_nm."  (".$itemlistrow->item_id.")";?></option>
                                                <?
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>

                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">이용일</label>
                                    <div class="col-sm-8">
                                        <input type="date" name="Nusedate" id="Nusedate" maxlength="20"
                                               class="form-control"
                                               style="margin-top: 10px"
                                               data-placement="top"
                                               style="margin-top: 10px"
                                        >
                                    </div>


                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">엑셀파일</label>

                                    <div class="col-sm-8" style="margin-top: 10px">
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
                                    <div class="col-sm-offset-1 col-sm-5" style="margin-top: 10px">
                                        <button type="button" id="sampleDown" class="btn btn-success btn-block">업로드 양식 다운받기</button>
                                    </div>

                                    <div class="col-sm-5" style="margin-top: 10px">
                                        <button type="button" id="save_btn" class="btn btn-primary btn-block">등 록</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </section>
            </div>

            <div class="col-md-8">

                <section class="widget">

                        <div class="table-responsive">
                            <table class="table table-striped table-lg mt-lg mb-0">
                                <thead class="no-bd">
                                <tr>
                                    <th class="hidden-xs">상태</th>
                                    <th>등록</th>
                                    <th class="hidden-xs">EXCEL</th>
                                    <th>주문 상태</th>
                                    <th class="no-sort hidden-xs">판매채널</th>
                                    <th class="hidden-xs">시설</th>
                                    <th class="hidden-xs">상품</th>
                                    <th class="hidden-xs">이용일</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($excellist !== false){
                                foreach ($excellist->result() as $excel):
                                ?>
                                    <tr>
                                        <td><?php
                                            if($excel->inputresult == "N"){
                                                echo '주문 입력 요청중<br/><a class="codedel" code="'.$excel->id.'" href="#" style="color: red;">Cancel</a>';
                                            }else if($excel->inputresult == "Y"){
                                                echo "주문 입력 완료"."<br/>\n"."(".$excel->bigo.")";
                                            }else if($excel->inputresult == "E"){
                                                echo $excel->bigo." (등록 실패)";
                                            }else if($excel->inputresult == "C"){
                                                echo "주문 입력 취소";
                                            }
                                            ?>
                                        </td>
                                        <td><?=$excel->damnm?><br/><?=$excel->created?></td>
                                        <td><div class="icon-list-item col-md-3 col-sm-4"><a onclick="exceldown('<?=$excel->id?>');"><i class="fa fa-file-excel-o"></i></a></div></td>
                                        <td><?=$excel->state?></td>
                                        <td><?=$excel->chnm?></td>
                                        <td><?=$excel->jpnm?></td>
                                        <td><?=$excel->itemnm?></td>
                                        <td><?=$excel->usedate?></td>
                                    </tr>

                                <?php
                                endforeach;
                                }
                                ?>

                                </tbody>
                            </table>

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

<script type="text/javascript">
    function exceldown(id){
        window.location.assign('<?php echo site_url('order/orderExcelDown'); ?>'+"/"+id);
    }
    $(function(){

        $('.codedel').click(function(){
            var code = $(this).attr('code');

            if(confirm("등록을 취소 하시겠습니까?")){
                $.ajax({
                    url: "<?php echo site_url('order/upload_excel_stop'); ?>",
                    data: {code:code},
                    type:"POST",
                    success:function(msg)
                    {
                        if (msg == "err"){
                            alert("삭제 실패");
                            return false;
                        }else{
                            location.reload();
                        }
                    }
                })
            }

        });

        $("#fac_select").change(function(){
            var facid = $(this).val();

            $.ajax({
                url: "<?php echo site_url('order/get_itemlist'); ?>",
                data: {facid : facid},
                type:"POST",
                success:function(msg)
                {
                    $("#item_select").html(msg);
                }
            })

        });
        $('#save_btn').click(function(){
            if(confirm("주문 등록에는 5분정도 소요됩니다.\r\n등록후 반드시 결과를 확인해주세요.\r\n주문을 등록 하시겠습니까?")){
                $('#fileform').submit();
            }
        });

        $('#sampleDown').click(function(){
            exceldown("");
        });
    });
</script>