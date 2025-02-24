<div class="content-wrap" style="width: 90%; margin-left: 10%">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold">남은 바코드 갯수 현황</span></h3>
        <div class="row">
            <div class="col-md-12">
           	 	<div class="alert alert-success alert-sm">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <span class="fw-semi-bold">에버랜드</span> 상품 바코드
                </div>



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
                                    <label class="col-sm-3 control-label" for="max-length">구 분</label>
                                    <div class="col-sm-8">
                                        <select id="select_gp" class="selectpicker">
                                            <option value="">- 선 택 -</option>
                                            <option value="EL">에버랜드</option>
                                            <option value="CB">캐리비안 베이</option>
                                            <option value="EV">일반 QR</option>
                                        </select>
                                    </div>
                                </div>

                            	<div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">상품코드</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="itemcode" id="itemcode" maxlength="10"
                                               class="form-control"
                                               placeholder="발송할 에버랜드 상품코드를 입력해주세요."
                                               data-placement="top">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">PCMS 코드</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="pcmsitem_id" id="pcmsitem_id" maxlength="5"
                                               class="form-control"
                                               placeholder="PCMS 상품번호를 입력해주세요."
                                               data-placement="top" data-original-title="You cannot write more than 4 characters."
                                               OnKeyPress="num_only()">
                                        <span class="help-block" id="pcmsitem_item"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">사용종료일</label>
                                    <div class="col-sm-8">
	                                    <input id="use_edate" name="use_edate" type="text" class="form-control datetimepicker1" maxlength="10" />
	                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">
                                    		문자 내용
	                                    <span class="help-block">
	                                           	쿠폰번호 <code>{orderno}</code>
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
                                    <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea_value" id="default-textarea" name="mmstext">
▣상품명 :
▣쿠폰번호 : {orderno}
▣매수: {man1}매
▣이름 : {usernm} ({hp3})
▣유효기간 :
▣취소기간 :
[유의사항]

플레이스엠 콜센터 : 1544-3913
에버랜드 콜센터 : 031-320-5000
										</textarea>
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

		            	<div class="alert alert-info alert-sm">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                    <span class="fw-semi-bold">Info:</span> <span class="fw-semi-bold">사용기한 </span>이 남은 상품만 볼수 있습니다.
		                    	<br/>이곳에 있는 코드는 일부 코드이며 문자가 나가지 않는 상품이나 소셜코드등은 표시하지 않습니다.
		                </div>

		            	<div class="table-responsive">
                            <table class="table table-striped table-lg mt-lg mb-0">
                                <thead class="no-bd">
                                <tr>
                                    <th>상품코드</th>
		                            <th class="no-sort hidden-xs">PCMS코드</th>
		                            <th class="hidden-xs">상품명</th>
		                            <th class="hidden-xs">사용기한</th>
		                            <th class="hidden-xs">바코드수량</th>
		                            <th class="hidden-xs">문자내용</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?
foreach($query->result() as $row):

?>

		                        <tr>

		                            <td style="font-size:12px;">
		                            <input id="codemode<?=$row->id?>" type="text" class="codemode form-control"
		                                    code="<?=$row->id?>" maxlength="15" value="<?=$row->itemcode?>" oldvalue="<?=$row->itemcode?>" size="15" style="border:0; background-color: transparent;"/>
		                           </td><!-- "06".preg_replace("/[^0-9]*/s", "", $row->itemcode) -->
		                            <td style="font-size:12px;"><?=$row->pcms_id?></td>
		                            <td style="font-size:12px;"><?=$row->itemnm?></td>
		                            <td style="font-size:12px;"><?=$row->edate?></td>
		                            <td style="font-size:12px;">
                                        <?php
                                        $scode = array("EL","CB");
                                        if(in_array($row->gp,$scode)){
                                            echo "<a id='countck{$row->itemcode}' class='countck' name='countck' code='{$row->itemcode}'>S티켓 잔여수량 확인</a>";
                                        }else{
                                            echo $row->codecnt;
                                        }?>
                                    </td>
		                            <td style="font-size:12px;">
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
				                                                    <textarea rows="20" class="form-control mmstext_<?=$row->id?>" id="default-textarea"><?=$row->mms_text?></textarea>
				                                                </div>
				                                            </div>
				                                        </form>


				                                    </div>
				                                    <div class="modal-footer">
				                                        <button type="button" class="btn btn-gray" data-dismiss="modal">Close</button>
				                                        <button type="button" class="btn btn-success mmssave" flag="<?=$row->id?>">Save changes</button>
				                                        <button type="button" class="btn btn-danger mmstate" flag="<?=$row->id?>">비활성</button>
				                                    </div>
													<div class="modal-body bg-gray-lighter">
														<div class="row">
															<?php if($row->qrbg){?>
																<div class="col-md-offset-4 col-md-4">
																	<img src="/uploads/<?=$row->qrbg?>" width="100%">
																</div>
															<?php }?>
															<?php if($row->addimg){?>
																<div class="col-md-4">
																	<img src="/uploads/<?=$row->addimg?>" >
																</div>
															<?php }?>


														</div>
														<?php  if($this->session->userdata('cd') == 'penfen' || true){?>
														<div class="modal-footer">
															<?php
															$attributes = array('class' => 'form-horizontal', 'id' => 'fileform_'.$row->id , 'role' => 'form' );
															echo form_open_multipart('/bar/everland_img_ok/'.$row->id,$attributes);
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
															</form>
															<div class="col-md-3">
																<button type="button" id="imgSave<?=$row->id?>" class="imgSave btn btn-primary" flag="<?=$row->id?>">배경 이미지 등록</button>
															</div>
                                                            <!-- addimg -->
                                                            <?php
                                                            $attributes = array('class' => 'form-horizontal', 'id' => 'addfileform_'.$row->id , 'role' => 'form' );
                                                            echo form_open_multipart('/bar/everland_addimg_ok/'.$row->id,$attributes);
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
                                                            </form>
                                                            <div class="col-md-3">
                                                                <button type="button" id="addimgSave<?=$row->id?>" class="addimgSave btn btn-primary" flag="<?=$row->id?>">추가 이미지 등록</button>
                                                            </div>
														</div>
														<?php }?>

													</div>
				                                </div>
				                            </div>
				                        </div>
				                    </td>


		                        </tr>
<?
endforeach;
?>
                                </tbody>
                            </table>
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
<script src="/vendor/jasny-bootstrap/js/fileinput.js"></script>
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


$(function(){

    $('.countck').click(function(){
        var code = $(this).attr('code');
        $.ajax({
            url: "<?php echo site_url('coupon/countck_sticket'); ?>",
            data: {code : code},
            type:"POST",
            success:function(msg)
            {
                $('#countck' + code).text(msg);
            }
        })
    });

	$(".imgSave").click(function() {
		var flag = $(this).attr('flag');
		if(confirm("배경 이미지를 등록 하시겠습니까?")){
			$('#fileform_'+flag).submit();
		}
	});

	$(".addimgSave").click(function() {
		var flag = $(this).attr('flag');
		if(confirm("추가 이미지를 등록 하시겠습니까?")){
			$('#addfileform_'+flag).submit();
		}
	});

	$("#pcmsitem_id").keyup(function() {

		var pcmsitem_id = $("#pcmsitem_id").val();
		var chnpick = $("#chnpick").val();

		$.ajax({
	        url: "<?php echo site_url('sys/get_itemname'); ?>",
            data: {pcmsitem_id : pcmsitem_id},
            type:"POST",
            success:function(msg)
            {
              //$(location).attr('href',msg);
              $( "#pcmsitem_item" ).text(msg);
            }
		})

		$.ajax({
	        url: "<?php echo site_url('sys/get_itemcode'); ?>",
            data: {pcmsitem_id : pcmsitem_id, chnpick : chnpick},
            type:"POST",
            success:function(msg)
            {
              if(msg != "ERROR" && msg != "" && msg != null){

            	  $( "#coupon_id" ).val(msg);
              }
            }
		})

		//$( "#pcmsitem_item" ).text(pcmsitem_id);
	});


	$(".codemode").click(function() {
		var code = $(this).attr('code');
		$("#codemode"+code).css('background-color','#F781F3');//transparent
		$("#codemode"+code).css('color','white');
		 //$(this).css('border','1px;');
	});

	$(".codemode").keypress(function(e) {
	    if (e.keyCode == 13){
	    	var code = $(this).attr('code');
	    	if(confirm("발송 코드을 변경 하시겠습니까?")){
		        $("#codemode"+code).css('background-color','transparent');
		        $("#codemode"+code).css('color','#F781F3');
		        var modtext = $("#codemode"+code).val();
		        $("#codemode"+code).blur();

		        $.ajax({
			        url: "<?php echo site_url('bar/everland_modify_code'); ?>",
			        data: {code : code, modtext:modtext},
			        type:"POST",
			        success:function(msg)
			        {
				        if(msg == 'err'){
							alert("변경실패");
				        }else{
							alert("변경 되었습니다.");
				        }
			        }
			    })

	    	}else{
	    		$("#codemode"+code).css('background-color','transparent');
		        $("#codemode"+code).css('color','black');
		        $("#codemode"+code).val($(this).attr('oldvalue'));
		        $("#codemode"+code).blur();
	    	}
	    }
	});



	$('.mmssave').click(function(){

		var flag = $(this).attr('flag');
		var mmstext = $('.mmstext_'+flag).val();

		if(confirm("문자를 변경하시겠습니까?")){
	        $.ajax({
	        url: "<?php echo site_url('bar/ever_mms'); ?>",
	        data: {flag : flag , mmstext : mmstext},
	        type:"POST",
	        success:function(msg)
	        {
	          $(location).attr('href',msg);
	        }
	        })
		}

	});



	$('.mmstate').click(function(){
		var flag = $(this).attr('flag');

		if(confirm("문자를 중지하시겠습니까?")){
	        $.ajax({
	        url: "<?php echo site_url('bar/ever_mms_stop'); ?>",
	        data: {flag : flag},
	        type:"POST",
	        success:function(msg)
	        {
	          $(location).attr('href',msg);
	        }
	        })
		}

	});

	$('#or_srh').click(function(){

		if($('#searchtxt').val() == '' || $('#searchtxt').val() == null)
		{
		  alert('에버랜드 코드를 입력해 주세요.');
		  $('#searchtxt').focus();
		  return false;
		}
		$('#fform').submit();

	});

	$('#cancel_btn').click(function(){
		$(location).attr('href','/bar/everland');
		//location.href();
	});

	$('#save_btn').click(function(){

		if($('#select_gp').val() == '' || $('#select_gp').val() == null)
		{
		  alert('구분을 선택해 주세요.');
		  $('#select_gp').focus();
		  return false;
		}
		if($('#itemcode').val() == '' || $('#itemcode').val() == null)
		{
		  alert('발송할 상품 코드를 입력해 주세요.');
		  $('#itemcode').focus();
		  return false;
		}
		if($('#pcmsitem_id').val() == '' || $('#pcmsitem_id').val() == null)
		{
		  alert('PCMS 상품번호를 입력해 주세요.');
		  $('#pcmsitem_id').focus();
		  return false;
		}
		if($('#use_edate').val() == '' || $('#use_edate').val() == null)
		{
		  alert('사용종료일을 입력해 주세요.');
		  $('#use_edate').focus();
		  return false;
		}

		if(confirm("등록 하시겠습니까?")){
			var select_gp = $('#select_gp').val();
			var itemcode = $('#itemcode').val();
			var pcmsitem_id = $('#pcmsitem_id').val();
			var use_edate = $('#use_edate').val();
			var textarea_value = $('.textarea_value').val();

            $.ajax({
	        url: "<?php echo site_url('bar/ever_mms_add'); ?>",
            data: {select_gp : select_gp , itemcode : itemcode , pcmsitem_id : pcmsitem_id , use_edate : use_edate, textarea_value : textarea_value},
            type:"POST",
            success:function(msg)
            {
                // alert(msg);
                var res = msg.split('|');
                if(res[0] == "err"){
					alert(res[1]);
                }else{
                	//alert(msg);
                	$(location).attr('href','/bar/everland');
                }
      		}
            })
		}
	});

});
</script>









