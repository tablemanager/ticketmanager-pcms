<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold">뉴스파로 주문 관리 <? if($total != 0)echo $total."건";  ?></span></h3>
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
                    <div class="widget-body"> <!-- 상단 검색바 시작  -->
                    	<div class="alert alert-success alert-sm">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                    <span class="fw-semi-bold">3개월</span>내의 주문만 검색됩니다.
		                </div>
<?php                 
if ($this->session->userdata('cd') == 'penfen' && $viewtable){
	//echo $ip;
?>
						<div class="alert alert-danger alert-sm">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                    <span class="fw-semi-bold"><?if($viewtable)echo $dev;?></span>
		                </div>

<?php 
}
?>	                
		                
                        <form  role="form" id="fform" name="fform" class="form-horizontal" role="form" method="post" action="/order/ordserN" >
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-offset-3 col-sm-7">
                                    	<div class="col-sm-8">
		                                    <input type="search" name="searchtxt" id="searchtxt" maxlength="20"
		                                           class="input-lg form-control"
		                                           placeholder="주문번호,바코드,이름,전화번호(뒷자리4)"
		                                           data-placement="top"
		                                           value="<?=$searchtxt?>">
		                                </div>
		                                <div style="margin-top:5px">
                                        <button type="button" id="or_srh" class="btn btn-primary">검 색</button>
                                        <button type="button" id="cancel_btn" class="btn btn-inverse">취 소</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                 </section>
              </div>
            </div>
            <span id="testcode"></span>
           	<div class="row">
            <div class="col-md-12">
 <?php if($viewtable){?>              
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
		                    <span class="fw-semi-bold">Info:</span> 주문번호에 마우스를 가져가면 <span class="fw-semi-bold">바코드번호</span>를 볼수 있습니다.
		                </div>
		            	<div class="table-responsive">
                            <table class="table table-striped table-lg mt-lg mb-0">
                                <thead class="no-bd">
								<tr>
									<td colspan="31" style="border-top:1px solid rgba(0, 0, 0, 0); border-bottom:1px solid rgba(0, 0, 0, 0); background-color: rgba(221, 221, 214, 0.93)"></td>
								</tr>
                                <tr>
                                    <th>등록일</th>
		                            <th class="no-sort hidden-xs">주문번호</th>
		                            <th class="hidden-xs">이름</th>
		                            <th class="hidden-xs">판매처</th>
		                            <th class="hidden-xs">시설</th>
		                            <th class="hidden-xs">사용</th>
		                            <th>쿠폰관리</th>
								</tr>
								<tr>
									<th>이용기간</th>
									<th class="no-sort hidden-xs">바코드</th>
									<th class="hidden-xs">HP</th>
									<th class="hidden-xs">구매수량</th>
									<th class="hidden-xs">상품명</th>
									<th class="hidden-xs">예약</th>
									<th>SMS</th>
								</tr>
                                </thead>
                                <tbody>
                                <?

foreach($query->result() as $row):
?>

	<tr>
		<td colspan="31" style="border-top:1px solid rgba(0, 0, 0, 0); border-bottom:1px solid rgba(0, 0, 0, 0); background-color: rgba(221, 221, 214, 0.93)"></td>
	</tr>
		                        <tr style="background-color: rgba(0, 0, 0, 0)">
		                            <td style="font-size:12px;"><?=$row->created?></td>
									<td>
											<?=$row->orderno?>
									</td>
									<td class="hidden-xs" style="font-size:12px;"><?//$row->usernm?>
										<input id="nmmode<?=$row->id?>" type="text" class="nmmode form-control"
											   code="<?=$row->id?>" maxlength="15" value="<?=$row->usernm?>" oldvalue="<?=$row->usernm?>" size="15" style="border:0; background-color: transparent;"/>
									</td>
									<td class="hidden-xs" style="font-size:12px;"><?=$row->chnm?></td>

									<td class="hidden-xs" style="font-size:12px;"><?=$row->jpnm?></td>

									<td class="hidden-xs" style="font-size:12px;">

										<div class="btn-group">
											<button class="btn btn-default" id="use_<?=$row->id?>" data-original-title="" title="">
												<?
												if($row->usegu == '1'){
													echo "사용";
												}else if($row->usegu == '2'){
													echo "미사용";
												}else{
													echo $row->usegu;
												}
												?>
											</button>
											<button class="btn btn-default dropdown-toggle" data-toggle="dropdown" data-original-title="" title="">
												<i class="fa fa-caret-down"></i>
											</button>
											<ul class="dropdown-menu">
												<li><a class="y_btn" code="<?=$row->id?>" href="#">사용</a></li>
												<!-- <li class="divider"></li> -->
												<li><a class="n_btn" code="<?=$row->id?>" href="#">미사용</a></li>
											</ul>
										</div>


									</td>
									<td>
									<?php
										if(in_array($row->jpmt_id,$syncJpmts)) {
									?>
											<a href="#" class="conf btn btn-default" data-toggle="tooltip"
											   data-placement="top"
											   title="이용확인" barcode="<?= $row->barcode_no ?>"
											   ojpid="<?= $row->jpmt_id ?>" ojpnm="<?= $row->jpnm ?>"
											   orid="<?= $row->id ?>">
												이용확인
											</a>

											<a href="#" class="disuse btn btn-default" data-toggle="tooltip"
											   data-placement="top"
											   title="쿠폰폐기" barcode="<?=$row->barcode_no?>" ojpid="<?=$row->jpmt_id?>"
											   ojpnm="<?=$row->jpnm?>"orid="<?=$row->id?>">
												쿠폰폐기
											</a>
									<?php
										}else{
											//echo $row->jpmt_id;
										}
									?>

									</td>

								</tr>
								<tr  style="background-color: rgba(0, 0, 0, 0)">
		                            <td class="hidden-xs" style="font-size:12px;">
		                            	<input id="udatemode<?=$row->id?>" type="text" class="udatemode form-control" 
		                                    code="<?=$row->id?>" maxlength="15" value="<?=$row->usedate?>" oldvalue="<?=$row->usedate?>" size="15" style="border:0; background-color: transparent;"/>
		                            </td>
									<td class="hidden-xs">
										<?php
										$bartext = str_replace(";","</br>",$row->barcode_no);
										echo $bartext;
										?>
									</td>
									<td class="hidden-xs" style="font-size:12px;"><?//$row->dhp?>
										<input id="hpmode<?=$row->id?>" type="text" class="hpmode form-control"
											   code="<?=$row->id?>" maxlength="15" value="<?=$row->dhp?>" oldvalue="<?=$row->dhp?>" size="30" style="border:0; background-color: transparent;"/>
									</td>
									<td class="hidden-xs" style="font-size:12px;"><?//$row->man1?>
										<input id="qtymode<?=$row->id?>" type="text" class="qtymode form-control"
											   code="<?=$row->id?>" maxlength="15" value="<?=$row->man1?>" oldvalue="<?=$row->man1?>" size="10" style="border:0; background-color: transparent;"/>
									</td>
									<td class="hidden-xs">
										<span style="font-size:12px;" data-toggle="tooltip" data-placement="right" title="PCMS:<?=$row->itemmt_id?>"><?=$row->itemnm?></span>
									</td>
									<td class="hidden-xs" style="font-size:12px;">

										<!-- 새로운 버튼 제작 (사용된 주문이면 표시안함)-->
										<div class="btn-group">
											<button class="btn btn-default" id="state_<?=$row->id?>" data-original-title="" title="">
												<? echo $row->state; ?>
											</button>
											<button class="btn btn-default dropdown-toggle" data-toggle="dropdown" data-original-title="" title="">
												<i class="fa fa-caret-down"></i>
											</button>
											<ul class="dropdown-menu">
												<li><a class="decide_btn" code="<?=$row->id?>" state="예약완료" href="#">예약완료</a></li>
												<li><a class="decide_btn" code="<?=$row->id?>" state="완료" href="#">완료</a></li>
												<li class="divider"></li>
												<li><a class="decide_btn" code="<?=$row->id?>" state="취소" href="#">취소</a></li>
											</ul>
										</div>
									</td>
									<td>
										<?php
										//문자 재발송 버튼을 표시할것인가

										if(true) {
											?>
											<a href="#" class="sendsms btn btn-default" data-toggle="tooltip" data-placement="top"
											   title="문자 재발송 하기" orid="<?= $row->id ?>">문자전송</a>
											<?php
										}
										?>
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
<? } ?>			        
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

function usestate(code,use_state){
	var use_text = "";
	if(use_state == "1"){
		use_text = "사용";
	}else if(use_state == "2"){
		use_text = "미사용";
	}else{
		return false;
	}
	if(confirm(use_text+" 상태로 변경하시겠습니까?")){
        $.ajax({
        url: "<?php echo site_url('order/or_use_N'); ?>",
        data: {code : code , usegu : use_state},
        type:"POST",
        success:function(msg)
        {
            //alert(msg);
		    if (msg == "err"){
		    	alert("변경에 실패하였습니다.");
		    	$(location).attr('href','/order/orderN');
		    }else if(msg == "ok"){
		    	$('#use_'+code).text(use_text);
		    	alert("변경되었습니다.");
		    	//$(location).attr('href','/order/orderN');
		    }
        }
        })
	}
}

	
$(function(){



	$(".sendsms").click(function() {

		var orid = $(this).attr('orid');
		//alert(orid);
		if(confirm("문자 재발송 하시겠습니까?")){
			//alert("<?php echo site_url('order/sms_resend'); ?>");
			$.ajax({
				url: "<?php echo site_url('order/sms_resend'); ?>",
				data: {orid : orid},
				type:"POST",
				success:function(msg)
				{
					//alert(msg);
					if (msg == "err"){
						alert("재발송 실패.");
					}else if(msg == "ok"){
						alert("재발송 요청 되었습니다.");
						//$(location).attr('href','/order/orderN');
					}
				}
			})
		}
	});
	
	$(".nmmode").click(function() {
		var code = $(this).attr('code');
		$("#nmmode"+code).css('background-color','#F781F3');//transparent
		$("#nmmode"+code).css('color','white');
		 //$(this).css('border','1px;');
	});

	$(".nmmode").keypress(function(e) { 
	    if (e.keyCode == 13){
	    	var code = $(this).attr('code');
	    	if(confirm("이름을 변경 하시겠습니까?")){	 
		        $("#nmmode"+code).css('background-color','transparent');
		        $("#nmmode"+code).css('color','#F781F3');
		        var modtext = $("#nmmode"+code).val();
		        $("#nmmode"+code).blur();

		        $.ajax({
			        url: "<?php echo site_url('order/orderN_modify_nm'); ?>",
			        data: {code : code, modtext:modtext},
			        type:"POST",
			        success:function(msg)
			        {
				        $("#bigo"+code).html(msg);
			        }
			    })
	    	}else{
	    		$("#nmmode"+code).css('background-color','transparent');
		        $("#nmmode"+code).css('color','black');
		        $("#nmmode"+code).val($(this).attr('oldvalue'));
		        $("#nmmode"+code).blur();
	    	}
	    }    
	});


	

	$(".udatemode").click(function() {
		var code = $(this).attr('code');
		$("#udatemode"+code).css('background-color','#F781F3');//transparent
		$("#udatemode"+code).css('color','white');
		 //$(this).css('border','1px;');
	});

	$(".udatemode").keypress(function(e) { 
	    if (e.keyCode == 13){
	    	var code = $(this).attr('code');
	    	if(confirm("이용기간을 변경 하시겠습니까?")){	 
		        $("#udatemode"+code).css('background-color','transparent');
		        $("#udatemode"+code).css('color','#F781F3');
		        var modtext = $("#udatemode"+code).val();
		        $("#udatemode"+code).blur();

		        $.ajax({
			        url: "<?php echo site_url('order/orderN_modify_usedate'); ?>",
			        data: {code : code, modtext:modtext},
			        type:"POST",
			        success:function(msg)
			        {
				        $("#bigo"+code).html(msg);
			        }
			    })
			    
	    	}else{
	    		$("#udatemode"+code).css('background-color','transparent');
		        $("#udatemode"+code).css('color','black');
		        $("#udatemode"+code).val($(this).attr('oldvalue'));
		        $("#udatemode"+code).blur();
	    	}
	    }    
	});
	
	
	$(".hpmode").click(function() {
		var code = $(this).attr('code');
		$("#hpmode"+code).css('background-color','#F781F3');//transparent
		$("#hpmode"+code).css('color','white');
		 //$(this).css('border','1px;');
	});

	$(".hpmode").keypress(function(e) { 
	    if (e.keyCode == 13){
	    	var code = $(this).attr('code');
	    	if(confirm("휴대폰 번호를 변경 하시겠습니까?")){	 
		        $("#hpmode"+code).css('background-color','transparent');
		        $("#hpmode"+code).css('color','#F781F3');
		        var modtext = $("#hpmode"+code).val();
		        $("#hpmode"+code).blur();

		        $.ajax({
			        url: "<?php echo site_url('order/orderN_modify_hp'); ?>",
			        data: {code : code, modtext:modtext},
			        type:"POST",
			        success:function(msg)
			        {
				        $("#bigo"+code).html(msg);
			        }
			    })
			    
	    	}else{
	    		$("#hpmode"+code).css('background-color','transparent');
		        $("#hpmode"+code).css('color','black');
		        $("#hpmode"+code).val($(this).attr('oldvalue'));
		        $("#hpmode"+code).blur();
	    	}
	    }    
	});

	$(".qtymode").click(function() {
		var code = $(this).attr('code');
		$("#qtymode"+code).css('background-color','#F781F3');//transparent
		$("#qtymode"+code).css('color','white');
		 //$(this).css('border','1px;');
	});

	$(".qtymode").keypress(function(e) { 
	    if (e.keyCode == 13){
	    	var code = $(this).attr('code');
	    	if(confirm("수량을 변경 하시겠습니까?")){	 
		        $("#qtymode"+code).css('background-color','transparent');
		        $("#qtymode"+code).css('color','#F781F3');
		        var modtext = $("#qtymode"+code).val();
		        $("#qtymode"+code).blur();

		        $.ajax({
			        url: "<?php echo site_url('order/orderN_modify_qty'); ?>",
			        data: {code : code, modtext:modtext},
			        type:"POST",
			        success:function(msg)
			        {
				        $("#bigo"+code).html(msg);
			        }
			    })
			    
	    	}else{
	    		$("#qtymode"+code).css('background-color','transparent');
		        $("#qtymode"+code).css('color','black');
		        $("#qtymode"+code).val($(this).attr('oldvalue'));
		        $("#qtymode"+code).blur();
	    	}
	    }    
	});

	$('.y_btn').click(function(){
		//alert("사용버튼");
		var code = $(this).attr('code');
		usestate(code,"1");
	});	

	$('.n_btn').click(function(){
		//alert("정지버튼");
		var code = $(this).attr('code');
		usestate(code,"2");
	});	

	$('.decide_btn').click(function(){
		//alert("정지버튼");
		var code = $(this).attr('code');
		var state = $(this).attr('state');
		if(confirm("이 주문을 "+state+"상태로 변경하시겠습니까?")){
	        $.ajax({
	        url: "<?php echo site_url('order/orderN_state'); ?>",
	        data: {code : code, state:state},
	        type:"POST",
	        success:function(msg)
	        {
	        	var res = msg.split("|");    
			     if (res[0] == "err"){
			    	alert(res[1]);
			    	return false;
			    }else if(res[0] == "ok"){
			    	$(location).attr('href','/order/orderN');
			    }
	        }
	        })
		}
	});	
	

	$('#or_srh').click(function(){

		if($('#searchtxt').val() == '' || $('#searchtxt').val() == null)
		{
		  alert('검색어를 입력해 주세요.');
		  $('#searchtxt').focus();
		  return false;
		}
		$('#fform').submit();
		
	});

	$('#cancel_btn').click(function(){
		$(location).attr('href','/order/orderN/new');
	});

	$('.conf').click(function(){
		$.ajax({
        url: "<?php echo site_url('/order/ajorder'); ?>",
        data: {orid : $(this).attr('orid') , ojpid : $(this).attr('ojpid'), ojpnm : $(this).attr('ojpnm'), barcode : $(this).attr('barcode')},
        type:"POST",
        success:function(msg)
        {
        	//var res = msg.split("|"); 
        	//alert(res[1]);
        	alert(msg);
        	$('#testcode').text(msg);
        }
        })
	});

	$('.disuse').click(function(){
		if(confirm($(this).attr('ojpnm')+"의 쿠폰을 폐기하시겠습니까?")){
			$.ajax({
	        url: "<?php echo site_url('/order/ajdisuse'); ?>",
	        data: {orid : $(this).attr('orid') , ojpid : $(this).attr('ojpid'), ojpnm : $(this).attr('ojpnm'), barcode : $(this).attr('barcode')},
	        type:"POST",
	        success:function(msg)
	        {
	        	//var res = msg.split("|"); 
	        	//alert(res[1]);
	        	alert(msg);
	        	$('#testcode').text(msg);
	        }
	        })
		}
	});
});
</script>









