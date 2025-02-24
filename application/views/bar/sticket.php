<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold">에버랜드 S티켓</span></h3>
        <div class="row">
            <div class="col-md-12">

                <section class="widget">
                    <div class="widget-body">
                        <form  role="form" id="insertform" name="insertform" class="form-horizontal" role="form" method="post" action="" >

							<fieldset>

								<div class="col-sm-7"><!--1번째-->

									<div class="form-group">
										<label class="col-sm-3 control-label" for="max-length">구분</label>
										<div class="col-sm-8">

											<div class="radio" style="display: inline-block; margin-right: 20px;">
												<input type="radio" name="gp" class="gp" id="radio_gp_EL" value="EL" checked="checked" >
												<label for="radio_gp_EL">
													에버랜드(EL)
												</label>
											</div>
											<div class="radio" style="display: inline-block; margin-right: 0px;">
												<input type="radio" name="gp" class="gp" id="radio_gp_CB" value="CB">
												<label for="radio_gp_CB">
													캐리비안베이(CB)
												</label>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label" for="simple-big-select">
											특판코드/업체코드
										</label>

										<div class="col-sm-4">
											<input type="text" name="code_s" id="code_s" class="form-control" maxlength="3" value="500">
										</div>


										<div class="col-sm-4">
											<input type="text" name="code_c" id="code_c" class="form-control" maxlength="2" value="06">
										</div>

									</div>


									<div class="form-group">
										<label class="col-sm-3 control-label" for="max-length">S티켓 상품코드(3자리)</label>
										<div class="col-sm-8">
											<input type="text" name="code_i" id="code_i" maxlength="3"
												   class="form-control"
												   placeholder="S티켓 상품코드(3자리)를 입력해주세요."
												   data-placement="top" data-original-title="You cannot write more than 3 characters."
												   OnKeyPress="num_only()">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label" for="max-length">PCMS 상품번호</label>
										<div class="col-sm-8">
											<input type="text" name="pcms_id" id="pcms_id" maxlength="5"
												   class="form-control"
												   placeholder="PCMS 상품번호를 입력해주세요."
												   data-placement="top" data-original-title="You cannot write more than 4 characters."
												   OnKeyPress="num_only()">
											<span class="help-block" id="pcmsitem_item"></span>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label" for="max-length">상품명</label>
										<div class="col-sm-8">
											<input id="itemnm" name="itemnm" type="text" class="form-control"/>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label" for="max-length">코드판매기간</label>
										<div class="col-sm-8">
											<input id="selldate" name="selldate" type="text" class="form-control datetimepicker3" maxlength="10" />
										</div>
									</div>


								</div><!--1번째-->

								<div class="col-sm-5"><!--2번째-->

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
										<div class="col-sm-9">
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

									<div class="form-group">
										<label class="col-sm-3 control-label" for="max-length">하단바 배경색상</label>
										<div class="col-sm-5">
											<div id="colorpicker" class="input-group colorpicker-element">
												<input type="text" id="colorpickeri"
													   name="barcolor" class="form-control barcolor">
												<span class="input-group-addon"><i style="background-color: rgb(153, 153, 153);"></i></span>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label" for="max-length">하단바 글자색상</label>
										<div class="col-sm-5">
											<input type="color" id="html5colorpicker" class="textcolor" name = "textcolor" value="#000000" style="width:100%; height: 30px">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label" for="max-length">하단바 텍스트</label>
										<div class="col-sm-5">
											<input type="text" name="bartext" id="bartext"
												   class="form-control bartext"
												   placeholder="텍스트를 입력해주세요."
												   data-placement="top">
										</div>
									</div>

<!--
									<div class="form-group" style="margin-top: -14px">
										<label class="col-sm-3 control-label" for="max-length">하단바2(선택)</label>
										<div class="col-sm-5">
											<input type="text" name="bartext2" id="bartext2"
												   class="form-control bartext2"
												   placeholder="텍스트를 입력해주세요."
												   data-placement="top">
										</div>
										<div class="col-sm-4">
											<div id="colorpicker" class="input-group colorpicker-element">
												<input type="text" id="colorpickeri"
													   name="barcolor2" class="form-control barcolor2">
												<span class="input-group-addon"><i style="background-color: rgb(153, 153, 153);"></i></span>
											</div>
										</div>
									</div>
-->

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
		            <div class="widget-body">
		            	<div class="table-responsive">
                            <table class="table table-striped table-lg mt-lg mb-0">
                                <thead class="no-bd">
                                <tr>
                                    <th>구분</th>
		                            <th class="no-sort hidden-xs">상품코드</th>
		                            <th class="hidden-xs">상품명</th>
									<th class="hidden-xs">판매기간</th>
		                            <th class="hidden-xs">문자내용</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?
foreach($query->result() as $row):

?>
		                        <tr>
		                            <td style="font-size:12px;">
										<?=$gpArr[$row->gp]?>
		                           </td>
		                            <td style="font-size:12px;"><?=$row->gp.$row->code_s.$row->code_c." + "?><span style="color: #990073; font-size: 16px; font-weight: bold"><?=$row->code_i?></span></td>
		                            <td style="font-size:12px;"><?=$row->itemnm."(".$row->pcms_id.")"?></td>
		                            <td style="font-size:12px;"><?=$row->edate?></td>
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
																	<img src="<?=$row->addimg?>" >
																</div>
															<?php }?>
														</div>

														<div class="modal-footer">
															<!--

															여기에 개발~~

															-->
                                                            <?php
                                                            $attributes = array('class' => 'form-horizontal', 'id' => 'fileform_'.$row->id , 'role' => 'form' );
                                                            echo form_open_multipart('/bar/sticket_addimg_ok/'.$row->id,$attributes);
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
                                                                <span class="help-block">이미지 가로폭은 ★ 315px ★로 만들어주세요</span>
                                                            </div>
                                                            </form>
                                                            <div class="col-md-3">
                                                                <button type="button" id="addimgSave<?=$row->id?>" class="addimgSave btn btn-primary" flag="<?=$row->id?>">추가 이미지 등록</button>
                                                            </div>
														</div>
														<?php  if(false){?>
														<div class="modal-footer">
															<?php
															$attributes = array('class' => 'form-horizontal', 'id' => 'fileform_'.$row->id , 'role' => 'form' );
															echo form_open_multipart('/bar/sticket_img_ok/'.$row->id,$attributes);
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
																<button type="button" id="imgSave<?=$row->id?>" class="imgSave btn btn-primary" flag="<?=$row->id?>">이미지 등록</button>
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

	$(".imgSave").click(function() {
		var flag = $(this).attr('flag');
		if(confirm("배경 이미지를 등록 하시겠습니까?")){
			$('#fileform_'+flag).submit();
		}
	});

	$(".addimgSave").click(function() {
		var flag = $(this).attr('flag');
		if(confirm("배경 이미지를 등록 하시겠습니까?")){
			$('#fileform_'+flag).submit();
		}
	});

	$("#pcms_id").keyup(function() {

		var pcms_id = $("#pcms_id").val();

		$.ajax({
	        url: "<?php echo site_url('sys/get_itemname'); ?>",
            data: {pcmsitem_id : pcms_id},
            type:"POST",
            success:function(msg)
            {
              //$(location).attr('href',msg);
              $( "#pcmsitem_item" ).text(msg);
            }
		})

	});

	$('.mmssave').click(function(){

		var flag = $(this).attr('flag');
		var mmstext = $('.mmstext_'+flag).val();

		if(confirm("문자를 변경하시겠습니까?")){
	        $.ajax({
	        url: "<?php echo site_url('bar/sticket_mms'); ?>",
	        data: {flag : flag , mmstext : mmstext},
	        type:"POST",
	        success:function(msg)
	        {
				//alert(msg);
				if(msg != "ok"){
					alert("저장에 실패했습니다.");
				}else{
					$(location).attr('href','/bar/sticket');
				}
	        }
	        })
		}
	});

	$('.mmstate').click(function(){
		var flag = $(this).attr('flag');

		if(confirm("판매를 중지하시겠습니까?")){
	        $.ajax({
	        url: "<?php echo site_url('bar/sticket_mms_stop'); ?>",
	        data: {flag : flag},
	        type:"POST",
	        success:function(msg)
	        {
				if(msg != "ok"){
					alert("설정에 실패했습니다.");
				}else{
					$(location).attr('href','/bar/sticket');
				}
	        }
	        })
		}
	});



	$('#cancel_btn').click(function(){
		$(location).attr('href','/bar/sticket');
	});

	$('#save_btn').click(function(){

		var gp = $(':radio[name="gp"]:checked').val();
		if(gp == '' || gp == null )
		{
			alert('구분을 선택해 주세요.');
			return false;
		}
		var code_s = $('#code_s');
		if( code_s.val() == '' || code_s.val() == null)
		{
			alert('특판코드를 입력해 주세요.');
			code_s.focus();
			return false;
		}

		var code_c = $('#code_c');
		if( code_c.val() == '' || code_c.val() == null)
		{
			alert('업체코드를 입력해 주세요.');
			code_c.focus();
			return false;
		}

		var code_i = $('#code_i');
		if( code_i.val() == '' || code_i.val() == null)
		{
			alert('S티켓 상품코드를 입력해 주세요.');
			code_i.focus();
			return false;
		}

		var pcms_id = $('#pcms_id');
		if( pcms_id.val() == '' || pcms_id.val() == null)
		{
			alert('PCMS 상품번호를 입력해 주세요.');
			pcms_id.focus();
			return false;
		}

		var itemnm = $('#itemnm');
		if( itemnm.val() == '' || itemnm.val() == null)
		{
			alert('상품명을 입력해 주세요.');
			itemnm.focus();
			return false;
		}

		var selldate = $('#selldate');
		if( selldate.val() == '' || selldate.val() == null)
		{
			alert('코드판매기간을 입력해 주세요.');
			selldate.focus();
			return false;
		}

		var selldate = $('#selldate');
		if( selldate.val() == '' || selldate.val() == null)
		{
			alert('코드판매기간을 입력해 주세요.');
			selldate.focus();
			return false;
		}

		var bartext = $('.bartext');
		if( bartext.val() == '' || bartext.val() == null)
		{
			alert('하단바 내용을 입력해 주세요.');
			bartext.focus();
			return false;
		}

		var barcolor = $('.barcolor');
		if( barcolor.val() == '' || barcolor.val() == null)
		{
			alert('하단바 배경 색상을 선택해 주세요.');
			barcolor1.focus();
			return false;
		}

		var textcolor = $('.textcolor');
		if( textcolor.val() == '' || textcolor.val() == null)
		{
			alert('하단바 텍스트 색상을 선택해 주세요.');
			barcolor1.focus();
			return false;
		}

		if(confirm("등록 하시겠습니까?")){
            $.ajax({
	        url: "<?php echo site_url('bar/sticket_add'); ?>",
            data: {gp : gp , code_s : code_s.val(), code_c : code_c.val(), code_i : code_i.val() ,pcms_id : pcms_id.val(),itemnm : itemnm.val(),selldate : selldate.val(), textarea_value : $('.textarea_value').val(), bartext : $('.bartext').val(), barcolor : $('.barcolor').val(), textcolor : $('.textcolor').val() },
            type:"POST",
            success:function(msg)
            {
                var res = msg.split('|');
                if(res[0] == "err"){
					alert(res[1]);
                }else{
                	$(location).attr('href','/bar/sticket');
                }
      		}
            })
		}
	});

});
</script>









