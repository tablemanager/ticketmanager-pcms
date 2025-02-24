<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold"><?=$title?></span></h3>
        <div class="row">

            <div class="col-md-4">
                <section class="widget">
                    <div class="widget-body">
                        <?php
                        $attributes = array('class' => 'form-horizontal', 'id' => 'fileform' , 'role' => 'form' );
                        echo form_open_multipart('/hnr/insert_order_excel',$attributes);
                        ?>
                            <div class="row">
                                <div class="form-group">

                                    <label class="col-sm-3 control-label" for="woori_select" style="margin-top: 10px">구분</label>
                                    <div class="col-sm-8" >
                                        <select id="woori_select"
                                                class="select1 form-control"
                                                tabindex="-1"
                                                name="woori_select"
                                                style="margin-top: 10px">
                                            <option value="">- 선택 -</option>
                                            <option value="efree_insert">이프리 상시</option>
                                            <option value="efree_update">이프리 선택</option>
                                            <option value="woorino">투인원</option>
                                            <option value="woorinoAnnuity">투인원 연금</option>
                                            <option value="woorinoCulture">투인원 문화</option>
                                            <option value="woorinoAllforme">투인원 올포미</option>
                                        </select>
                                    </div>

                                    <label class="col-sm-3 control-label" for="woori_select" style="margin-top: 10px">엑셀파일</label>

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
                                        <button type="button" id="sambtn" class="btn sambtn">샘플 파일 다운로드</button>
                                    </div>

                                    <div class="col-sm-5" style="margin-top: 10px">
                                        <button type="button" id="savbtn" class="btn savbtn">등 록</button>
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
                            <table class="table stripetable table-lg mt-lg mb-0">
                                <thead class="no-bd">
                                <tr>
                                    <th class="hidden-xs">상태</th>
                                    <th>등록</th>
                                    <th class="hidden-xs">EXCEL</th>
                                    <th class="hidden-xs">구분</th>
									<th class="hidden-xs">비고</th>

                                </tr>
                                </thead>
                                <tbody>
									<?php
										if($wquery != false){
										foreach ($wquery->result() as $wexcel):
									?>
									<tr>
                                        <td><?php
                                            if($wexcel->inputresult == "N"){
                                                echo '입력 대기<br/><a class="codedel" code="'.$wexcel->id.'" href="#" style="color: red;">Cancel</a>';
                                            }else if($wexcel->inputresult == "Y"){
                                                echo "입력 완료";
                                            }else if($wexcel->inputresult == "E"){
                                                echo $wexcel->bigo;
                                            }else if($wexcel->inputresult == "C"){
                                                echo "입력 취소";
                                            }
                                            ?>
                                        </td>
                                        <td><?=$wexcel->damnm?><br/><?=$wexcel->created?></td>
                                        <td><div class="icon-list-item col-md-3 col-sm-4"><a onclick="exceldown('<?=$wexcel->id?>');"><i class="fa fa-file-excel-o"></i></a></div></td>
                                        <td><?php
                                            if($wexcel->gp == "efree_insert"){
                                                echo "이프리 상시";
                                            }else if($wexcel->gp == "efree_update"){
                                                echo "이프리 선택";
                                            }else if($wexcel->gp == "woorino"){
                                                echo "투인원";
                                            }else if($wexcel->gp == "woorinoAnnuity"){
                                                echo "투인원 연금";
                                            }else if($wexcel->gp == "woorinoCulture"){
                                                echo "투인원 문화";
                                            }else if($wexcel->gp == "woorinoAllforme"){
                                                echo "투인원 올포미";
                                            }
                                            ?></td>
										<td><?=$wexcel->bigo?></td>
                                    </tr>
									<?php
										endforeach; }
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

<link type="text/css" href="/css/twoinoneExcel.css" rel="stylesheet" />

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
        window.location.assign('<?php echo site_url('hnr/orderExcelDown'); ?>'+"/"+id);
    }
    $(function(){

        $('.codedel').click(function(){
            var code = $(this).attr('code');

            if(confirm("등록을 취소 하시겠습니까?")){
                $.ajax({
                    url: "<?php echo site_url('hnr/upload_excel_stop'); ?>",
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

        
        $('#savbtn').click(function(){

            var woori_select = $('#woori_select').val();
            if(woori_select){
                if(confirm("주문 등록에는 1일정도 소요됩니다.\r\n익일 결과를 확인해주세요.\r\n주문을 등록 하시겠습니까?")){
                    $('#fileform').submit();
                }
            }
        });

        $('#sambtn').click(function(){
            exceldown("");
        });
    });
</script>