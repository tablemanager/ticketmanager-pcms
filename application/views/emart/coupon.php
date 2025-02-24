<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold">이마트 쿠폰 폐기</span></h3>
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
		                    <span class="fw-semi-bold">대량 조회 및 폐기  </span>
		                </div>
                        <form  role="form" id="fform" name="fform" class="form-horizontal" role="form" method="post" action="/order/ordser" >
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-4">
                                    	<textarea rows="4" class="form-control" name="barcodetxt" id="barcodetxt" placeholder="바코드 번호를 입력해주세요. 줄 바꿈으로 구분"></textarea>
                                    </div>
                                    <div class="col-sm-2">
	                                	<button type="button" id="bar_srh" class="btn btn-primary">조 회 </button>
	                            		<button type="button" id="bar_ccl" class="btn btn-inverse">폐 기</button>
                            		</div>
                                    <div class="col-sm-6">
	                                    <div class="alert alert-danger alert-sm">
						                    <pre id = "resultMSG">결과 메세지</pre>
						                </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                 </section>
              </div>
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
        url: "<?php echo site_url('order/or_use'); ?>",
        data: {code : code , usegu : use_state},
        type:"POST",
        success:function(msg)
        {
          $(location).attr('href',msg);
		    if (msg == "err"){
		    	alert("변경에 실패하였습니다.");
		    	$(location).attr('href','/order/ordchk');
		    }else if(msg == "ok"){
		    	$('#use_'+code).text(use_text);
		    	alert("변경되었습니다.");
		    	$(location).attr('href','/order/ordchk');
		    }
        }
        })
	}
}

	
$(function(){

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
			        url: "<?php echo site_url('order/order_modify_nm'); ?>",
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

	
	$("#bar_srh").click(function(){
		//alert("조회");
		var barcodetxt = $("#barcodetxt").val();
		if(barcodetxt == '' || barcodetxt == null){
			alert("바코드 번호를 입력해주세요.");
			return false;
		}else{
			$.ajax({
		        url: "<?php echo site_url('emart/barcode_search'); ?>",
		        data: {barcodetxt : barcodetxt},
		        type:"POST",
		        success:function(msg)
		        {
		        	$("#resultMSG").html(msg);
		        }
		    })
		}
		//alert(barcodetxt);
	});

	$("#bar_ccl").click(function(){
		var barcodetxt = $("#barcodetxt").val();
		if(barcodetxt == '' || barcodetxt == null){
			alert("바코드 번호를 입력해주세요.");
			return false;
		}else{
			$.ajax({
		        url: "<?php echo site_url('emart/barcode_cancel'); ?>",
		        data: {barcodetxt : barcodetxt},
		        type:"POST",
		        success:function(msg)
		        {
		        	$("#resultMSG").html(msg);
		        }
		    })
		}
		
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
			        url: "<?php echo site_url('order/order_modify_hp'); ?>",
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
			        url: "<?php echo site_url('order/order_modify_qty'); ?>",
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
	        url: "<?php echo site_url('order/order_state'); ?>",
	        data: {code : code, state:state},
	        type:"POST",
	        success:function(msg)
	        {
	        	var res = msg.split("|");    
			     if (res[0] == "err"){
			    	alert(res[1]);
			    	return false;
			    }else if(res[0] == "ok"){
			    	$(location).attr('href','/order/ordchk');
			    }
	        }
	        })
		}
	});	
	
	$('.order_decide').click(function(){
		//alert("정지버튼");
		var code = $(this).attr('code');
		if(confirm("이 주문을 확정 상태로 변경하시겠습니까?")){
	        $.ajax({
	        url: "<?php echo site_url('order/or_decide'); ?>",
	        data: {code : code},
	        type:"POST",
	        success:function(msg)
	        {

			    if (msg == "err"){
			    	alert("변경에 실패하였습니다.");
			    	$(location).attr('href','/order/ordchk');
			    }else if(msg == "ok"){
			    	alert("변경되었습니다.");
			    	$(location).attr('href','/order/ordchk');
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
		location.href('/order/ordchk/new');
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









