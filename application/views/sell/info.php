<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold"><?php echo $title;?></span></h3>
        					
        <div class="row">
            <div class="col-md-12">
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
                                    <label class="col-sm-2 control-label" for="max-length">상품제목</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="sellname" id="sellname"
                                               class="form-control"
                                               placeholder="등록하실 판매상품의 제목을 입력해주세요."
                                               data-placement="top"
                                               >
                                        <!-- <span class="help-block" id="getSellName"></span> -->
                                    </div>
                                </div>
                                
                                <div class="form-group sellcode_group">

									<?php if(false){?>

	  								<!-- 지마켓,지구 1 -->
	  								<div class='sellcode1'>
	                                    <label class='col-sm-2 control-label' for='max-length'>채널 연동</label>
	                                    <div class='col-sm-4'>
		                                    <div class='input-group'>
		                                    	<!-- <span class="input-group-addon">지마켓</span> -->
		                                    	<div class="input-group-btn">
		                                    	<button class="btn btn-gray noEvent" tabindex="-1">G Market</button>
		                                    	</div>
		                                        <input type='text' name='G_sellcode1'
		                                        	id = "G_sellcode1"
	                                               class='form-control sellcode'
	                                               placeholder='판매코드 입력'
	                                               data-placement='top'
	                                            >
		                                    </div>
	                                    </div>
	                                    <div class='col-sm-6'>
	                                    	<input type='text' name='G_sellurl1'
	                                    			id='G_sellurl1'
	                                               class='form-control sellurl'
	                                               placeholder='지마켓 판매페이지 주소입력'
	                                               data-placement='top'
	                                        >
	                                    </div>

	  								</div>
	  								
	  								<!-- 지마켓,지구 2 -->
	  								<div class='sellcode1' >
	                                    <label class='col-sm-2 control-label' for='max-length'></label>
	                                    <div class='col-sm-4' style='margin-top: 5px'>
		                                    <div class='input-group'>
		                                    	<!-- <span class="input-group-addon">지마켓</span> -->
		                                    	<div class="input-group-btn">
		                                    	<button class="btn btn-gray noEvent" tabindex="-1">G9</button>
		                                    	</div>
		                                        <input type='text' name='G_sellcode2'
		                                        	id = "G_sellcode2"
	                                               class='form-control sellcode'
	                                               placeholder='판매코드 입력'
	                                               data-placement='top'
	                                            >
		                                    </div>
	                                    </div>
	                                    <div class='col-sm-6' style='margin-top: 5px'>

	                                    	<input type='text' name='G_sellurl2'
	                                    			id='G_sellurl2'
	                                               class='form-control sellurl'
	                                               placeholder='G9 판매페이지 주소'
	                                               data-placement='top'
	                                        >
	                                    </div>

	  								</div>	
	  								
	  								<!-- 옥션 -->
	  								<div class='sellcode1' >
	                                    <label class='col-sm-2 control-label' for='max-length'></label>
	                                    <div class='col-sm-4' style='margin-top: 5px'>
		                                    <div class='input-group'>
		                                    	<!-- <span class="input-group-addon">지마켓</span> -->
		                                    	<div class="input-group-btn">
		                                    	<button class="btn btn-gray noEvent" tabindex="-1">Auction</button>
		                                    	</div>
		                                        <input type='text' name='A_sellcode' id='A_sellcode'
	                                               class='form-control sellcode'
	                                               placeholder='판매코드 입력'
	                                               data-placement='top'
	                                            >
		                                    </div>
	                                    </div>
	                                    <div class='col-sm-6' style='margin-top: 5px'>

	                                    	<input type='text' name='A_sellurl' id='A_sellurl'
	                                               class='form-control sellurl'
	                                               placeholder='옥션 판매페이지 주소'
	                                               data-placement='top'
	                                        >
	                                    </div>

	  								</div>

									<div class='sellcode1' >
										<label class='col-sm-2 control-label' for='max-length'></label>
										<div class='col-sm-4' style='margin-top: 5px'>
											<div class='input-group'>

												<div class="input-group-btn">
													<button class="btn btn-gray noEvent" tabindex="-1">인터파크</button>
												</div>
												<input type='text' name='I_sellcode' id='I_sellcode'
													   class='form-control sellcode'
													   placeholder='판매코드 입력'
													   data-placement='top'
												>
											</div>
										</div>
										<div class='col-sm-6' style='margin-top: 5px'>

											<input type='text' name='I_sellurl' id='I_sellurl'
												   class='form-control sellurl'
												   placeholder='인터파크 판매페이지 주소'
												   data-placement='top'
											>
										</div>
										<div class='col-sm-2' style='margin-top: 5px'>

											<input type="hidden" name='I_sellcharge' id='I_sellcharge'
												   class='form-control sellcharge'
												   placeholder='인터파크 채널수수료'
												   data-placement='top'
												   value="0"
											>
										</div>
									</div>

									<?php }?>
	  								
	  								<div class='sellcode1' style="display: none">
	                                    <label class='col-sm-2 control-label' for='max-length'></label>
	                                    <div class='col-sm-4' style='margin-top: 5px'>
		                                    <div class='input-group'>
		                                    	<div class="input-group-btn">
		                                    	<button class="btn btn-gray noEvent" tabindex="-1">11st</button>
		                                    	</div>
		                                        <input type='text' name='S_sellcode' id='S_sellcode'
	                                               class='form-control sellcode'
	                                               placeholder='판매코드 입력'
	                                               data-placement='top'
	                                            >
		                                    </div>
	                                    </div>
	                                    <div class='col-sm-6' style='margin-top: 5px'>

	                                    	<input type='text' name='S_sellurl' id='S_sellurl'
	                                               class='form-control sellurl'
	                                               placeholder='11번가 판매페이지 주소'
	                                               data-placement='top'
	                                        >
	                                    </div>

	  								</div>

									<div class='sellcode1' >

	                                    <label class='col-sm-2 control-label' for='max-length'></label>

	                                    <div class='col-sm-4' style='margin-top: 5px'>
		                                    <div class='input-group'>
		                                    	<div class="input-group-btn">
		                                    	<button class="btn btn-gray noEvent" tabindex="-1">네이버</button>
		                                    	</div>
		                                        <input type='text' name='N_sellcode' id='N_sellcode'
	                                               class='form-control sellcode'
	                                               placeholder='판매코드 입력'
	                                               data-placement='top'
	                                            >
		                                    </div>
	                                    </div>
	                                    <div class='col-sm-6' style='margin-top: 5px'>

	                                    	<input type='text' name='N_sellurl' id='N_sellurl'
	                                               class='form-control sellurl'
	                                               placeholder='네이버 판매페이지 주소'
	                                               data-placement='top'
	                                        >

	                                    </div>
										<div class='col-sm-offset-2 col-sm-10' >
											<span class="help-block">네이버 외 채널은 <a href="http://pcms.placem.co.kr/index.php/sell/crowling">판매(크롤링)설정</a>에서 연동해주세요. </span>
										</div>


	  								</div>




	  								<?php if($coupangview){?>
	  								<div class='sellcode1' >
	                                    <label class='col-sm-2 control-label' for='max-length'></label>
	                                    <div class='col-sm-4' style='margin-top: 5px'>
		                                    <div class='input-group'>
		                                    	<!-- <span class="input-group-addon">지마켓</span> -->
		                                    	<div class="input-group-btn">
		                                    	<button class="btn btn-gray noEvent" tabindex="-1">Coupang</button>
		                                    	</div>
		                                        <input type='text' name='C_sellcode' id='C_sellcode'
	                                               class='form-control sellcode'
	                                               placeholder='판매코드 입력'
	                                               data-placement='top'
	                                            >
		                                    </div>
	                                    </div>
	                                    <div class='col-sm-4' style='margin-top: 5px'>

	                                    	<input type='text' name='C_sellurl' id='C_sellurl'
	                                               class='form-control sellurl'
	                                               placeholder='쿠팡 판매페이지 주소'
	                                               data-placement='top'
	                                        >
	                                    </div>
	                                    <div class='col-sm-2' style='margin-top: 5px'>
	                                    	
	                                    	<input type='text' name='C_sellcharge' id='C_sellcharge'
	                                               class='form-control sellcharge'
	                                               placeholder='쿠팡 채널수수료'
	                                               data-placement='top'
	                                               >
	                                    </div>
	  								</div>
	  								<?php }?>
	  								
	  								
	  														
                                </div>
                                <div class="itmecode_group">
                                <div class="form-group ">
                                	<input type="hidden" id="itemclass" value="1">
                                	
	                                <div class='itemrow1'>
	                                    <label class='col-sm-2 control-label' for='max-length'>상품코드 : 옵션 연동</label>
	                                    <div class='col-sm-3'>  
		                                        <input type='text' name='itemcode1'
	                                               class='form-control itemcode1'
	                                               placeholder='상품코드 입력'
	                                               data-placement='top'
	                                            >
	                                    </div>
	                                    <div class='col-sm-5'>
	                                    	<input type='text' name='itemopt1'
	                                               class='form-control itemopt1'
	                                               placeholder='판매옵션 입력 예) A01 에버랜드 자유이용권'
	                                               data-placement='top'
	                                               >
	                                    </div>
	                                    
	                                    <div class='col-sm-1'>
	                                    	<div class='input-group-btn'>            
		                                             <button type='button' class='btn btn-success addItemcode'><i class='fa fa-plus'></i></button>   
		                                     </div>
		                                </div>
	  								</div>							
                                </div>
                                </div>

                                <div class="form-group" style="margin-top: 20px">

                                    <div class="col-sm-offset-2 col-sm-4">
                                        <input id="sellsdate" type="text" class="form-control datetimepicker3" maxlength="10" />
                                        <span class="help-block">판매 시작일</span>
                                    </div>
                                    <div class="col-sm-4">
                                        <input id="selledate" type="text" class="form-control datetimepicker3" maxlength="10" />
                                        <span class="help-block">판매 종료일</span>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="max-length">이용일</label>
                                    <div class="col-sm-4">
                                    	<div class='input-group'>
                                    	<input id="datetimepicker1" type="text" class="form-control datetimepicker1" maxlength="10" />
		                                    	<div class='input-group-btn'>
	                                                    <select class='selectpicker sell_state'
	                                                            data-style='btn-danger'
	                                                            data-width='auto'>
	                                                    <option value='확정'>확정</option>
	                                                    <option value='완료'>완료</option>
	                                                    </select>
	                                                </div>
		                                        
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
              </div>
            </div>
           	<div class="row">
            <div class="col-md-12">
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
		                
		                <div class="mt">
		                    <table id="datatable-table" class="tblCustomers table table-striped table-hover sellcodetable">
		                    <!-- <table id = "tblCustomers" class="table table-striped table-lg mt-lg mb-0"> -->
		                        <thead>
		                        <tr>
		                            <th>번호</th>
		                            <th class="no-sort">상품명</th>
		                            <th class="no-sort hidden-xs">채널</th>
		                            <!-- <th class="no-sort">수수료</th> -->
		                            <th class="hidden-xs">판매코드</th>
		                            <th class="no-sort">이용일</th>
		                            <th class="no-sort">상태</th>
		                            <th class="no-sort">PCMS</th>
		                            <th class="no-sort">판매</th>
		                        </tr>
		                        </thead>
		                        <tbody>
		                        
<?
foreach($query->result() as $row):

if($row->useyn == 'Y'){
	$uflg =  "사용";
}else if($row->useyn == 'N'){
	$uflg =  "정지";
}else{
	$uflg = $row->useyn;
}
?>
								<tr class = "table_<?=$row->id?>">
		                            <td><?=$row->id?></td>
		                            <td class="hidden-xs"><?=$row->title?></td>
		                            <td><span class="fw-semi-bold"><?=$row->ch_nm?></span></td>
		                            <!--<td class="hidden-xs"><?=$row->commission?></td>  
		                            <td class="hidden-xs"><a onclick="goPOPUP('<?=$row->sell_url?>');"><?=$row->sellcode?></a></td>-->
		                            <td class="hidden-xs"><?=$row->sellcode?></td>
		                            <td class="hidden-xs"><?=$row->useedate?></td>
		                            <td class="hidden-xs"><?=$row->pcms_state?></td>
		                            
		                            
		                            <td class="hidden-xs">
		                            
		                            	<button class="btn btn-gray" data-toggle="modal" data-target="#myModal<?=$row->id?>">
				                                               보기
				                        </button>
				                        <div class="modal fade" id="myModal<?=$row->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
				                            <div class="modal-dialog">
				                                <div class="modal-content">
				                                    <div class="modal-header">
				                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                                        <h4 class="modal-title text-align-center fw-bold mt" id="myModalLabel18"><?=$row->title?></h4>
				                                    </div>
				                                    <div class="modal-body bg-gray-lighter">
				                                        <form>
				                                            <div class="row">
				                                                <div class="col-md-12">
				                                                	<?php 
				                                                	$pcmstext = $row->pcmsitem_id;     
				                                                	$pcmstext = str_replace(",", "\n", $pcmstext); // 줄바꿈
				                                                	$pcmstext = "옵션명:PCMS코드\n".$pcmstext;
				                                                	$pcmstext .= "\n\n연동옵션:".$row->sellopt;
				                                                	?>
				                                                    <pre><?=$pcmstext?></pre>
				                                                </div>
				                                            </div>
				                                        </form>
				                                    </div>
				                                    <div class="modal-footer">
				                                        <button type="button" class="btn btn-gray" data-dismiss="modal">Close</button>
				                                    </div>
				                                </div>
				                            </div>
				                        </div>
		                            
		                            
		                            
		                            
		                            </td>
		                            <td class="hidden-xs">		                                
		                            <div class="btn-group">
		                            <a id="use_<?=$row->id?>" onclick="unusestate('<?=$row->id?>');" uflag ="<?=$uflg?>"><?=$uflg?></a>                      
		                            
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
<script src="/vendor/holderjs/holder.js"></script>
<script src="/vendor/dropzone/downloads/dropzone.min.js"></script>
<script src="/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
<script src="/vendor/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js"></script>

<!-- page specific js -->
<script src="/js/form-elements.js"></script>
<script src="/js/tables-dynamic.js"></script>

<script type="text/javascript">

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
		//alert(unuse_text+flag);
  
        $.ajax({
        url: "<?php echo site_url('sell/info_use'); ?>",
        data: {code : code , use_state : flag},
        type:"POST",
        success:function(msg)
        {
            
            
		    if (msg == "err"){
		    	alert("변경에 실패하였습니다.");    	
		    }else if(msg == "ok"){
		    	
		    	$('#use_'+code).text(unuse_text);	 
		    	$('#use_'+code).attr("uflag",unuse_text);	
		    	alert("변경되었습니다.");   	
		    }else{
				alert(msg);
		    }
		    
		    
        }
        })
	}
}

function plusitem(){
	var itemclass = $('#itemclass').val();
	itemclass = ++itemclass;
	alert(itemclass);
	 $('#itemclass').val(itemclass);
	
}

function goPOPUP(url){
	  window.open(url);
}
	
$(function(){

	$(".noEvent").click(function(){
		return false;
	});	

	$("#companyname").keyup(function() {

		var companyname = $("#companyname").val();
		$.ajax({
	        url: "<?php echo site_url('sys/get_companyname'); ?>",
            data: {companyname : companyname},
            type:"POST",
            success:function(msg)
            {
              //$(location).attr('href',msg);
              $( "#getCompanyName" ).text(msg);
            }
		})
		
	});
	

	$('.addItemcode').click(function(){
		var itemclass = $('#itemclass').val();
		itemclass = ++itemclass;
		$.ajax({
	        url: "<?php echo site_url('sell/addItemcode'); ?>",
            data: {itemclass : itemclass},
            type:"POST",
            success:function(msg)
            {
                //alert(msg);
              $( ".itmecode_group").append(msg);
              $('#itemclass').val(itemclass);
            }
		})
	});
	
	$('.addSellcode').click(function(){
		
		var codeclass = $('#codeclass').val();
		//alert("얍스"+codeclass);
		codeclass = ++codeclass;
		$.ajax({
	        url: "<?php echo site_url('sell/addSellcode'); ?>",
            data: {codeclass : codeclass},
            type:"POST",
            success:function(msg)
            {
                //alert(msg);
              $( ".sellcode_group").append(msg);
              $('#codeclass').val(codeclass);
            }
		})
		
	});
	$('#save_btn').click(function(){
		
				
		if($('#sellname').val() == '' || $('#sellname').val() == null )
		{
		  alert('상품제목을 선택해 주세요.');
		  $('#sellname').focus();
		  return false;
		}

		var G_sellcode1 = $('#G_sellcode1').val();
		var G_sellurl1 =$('#G_sellurl1').val();

		var G_sellcode2 =$('#G_sellcode2').val();
		var G_sellurl2 =$('#G_sellurl2').val();

		var A_sellcode =$('#A_sellcode').val();
		var A_sellurl =$('#A_sellurl').val();

		var S_sellcode =$('#S_sellcode').val();
		var S_sellurl =$('#S_sellurl').val();

		var N_sellcode =$('#N_sellcode').val();
		var N_sellurl =$('#N_sellurl').val();

		var I_sellcode =$('#I_sellcode').val();
		var I_sellurl =$('#I_sellurl').val();

		var C_sellcode =$('#C_sellcode').val();
		var C_sellurl =$('#C_sellurl').val();

		if((G_sellcode1 == '' || G_sellcode1 == null) &&
			(G_sellcode2 == '' || G_sellcode2 == null) &&
			(A_sellcode == '' || A_sellcode == null) &&
			(S_sellcode == '' || S_sellcode == null) &&
			(N_sellcode == '' || N_sellcode == null) &&
			(I_sellcode == '' || I_sellcode == null) &&
			(C_sellcode == '' || C_sellcode == null) )
		{
			alert('상품코드를 입력해 주세요.');
			  $('#G_sellcode1').focus();
			  return false;
		}
		
		if(G_sellcode1 != '' && G_sellcode1 != null)
		{
			if(G_sellurl1 == '' || G_sellurl1 == null)
			{
				  alert('판매페이지 주소를 입력해 주세요.');
				  $('#G_sellurl1').focus();
				  return false;
			}
		}

		if(G_sellcode2 != '' && G_sellcode2 != null)
		{
			if(G_sellurl2 == '' || G_sellurl2 == null)
			{
				  alert('판매페이지 주소를 입력해 주세요.');
				  $('#G_sellurl2').focus();
				  return false;
			}
		}

		if(A_sellcode != '' && A_sellcode != null)
		{
			if(A_sellurl == '' || A_sellurl == null)
			{
				  alert('판매페이지 주소를 입력해 주세요.');
				  $('#A_sellurl').focus();
				  return false;
			}
		}

		if(S_sellcode != '' && S_sellcode != null)
		{
			if(S_sellurl == '' || S_sellurl == null)
			{
				  alert('판매페이지 주소를 입력해 주세요.');
				  $('#S_sellurl').focus();
				  return false;
			}
		}

		if(N_sellcode != '' && N_sellcode != null)
		{
			if(N_sellurl == '' || N_sellurl == null)
			{
				  alert('판매페이지 주소를 입력해 주세요.');
				  $('#N_sellurl').focus();
				  return false;
			}
		}

		if(I_sellcode != '' && I_sellcode != null)
		{
			if(I_sellurl == '' || I_sellurl == null)
			{
				alert('판매페이지 주소를 입력해 주세요.');
				$('#I_sellurl').focus();
				return false;
			}
		}

		if(C_sellcode != '' && C_sellcode != null)
		{
			if(C_sellurl == '' || C_sellurl == null)
			{
				  alert('판매페이지 주소를 입력해 주세요.');
				  $('#C_sellurl').focus();
				  return false;
			}
		}

		if($('.itemcode1').val() == '' || $('.itemcode1').val() == null)
		{
		  alert('상품코드를 입력해 주세요.');
		  $('.itemcode1').focus();
		  return false;
		}

        var sellsdate = $('#sellsdate');
        if(sellsdate.val() == '' || sellsdate.val() == null )
        {
            alert('판매 시작일을 입력해 주세요.');
            sellsdate.focus();
            return false;
        }
        var selledate = $('#selledate');
        if(selledate.val() == '' || selledate.val() == null )
        {
            alert('판매 종료일을 입력해 주세요.');
            selledate.focus();
            return false;
        }

		
		var itemclass = $('#itemclass').val();
		var datetimepicker1 = $('#datetimepicker1').val();
		var sell_state = $('.sell_state').val();
		var item_option = $('.itemopt1').val() + ":" + $('.itemcode1').val(); 
		for(var i = 2 ; i <= itemclass ; i++){
			if($('.itemcode'+i).val() != '' && $('.itemcode'+i).val() != null)
			{
				if($('.itemopt'+i).val() == '' || $('.itemopt'+i).val() == null)
				{
				  alert('판매옵션을 입력해 주세요.');
				  $('.itemopt'+i).focus();
				  return false;
				} else{
					item_option += "," + $('.itemopt'+i).val() + ":" + $('.itemcode'+i).val();
				}
			}
		}

		
		if(confirm("등록 하시겠습니까?")){

            $.ajax({
	        url: "<?php echo site_url('sell/info_add'); ?>",
            data: {
            	sellname : $('#sellname').val() , 

            	G_sellcode1 :G_sellcode1,
        		G_sellurl1 :G_sellurl1,
        		G_sellcode2 :G_sellcode2,
        		G_sellurl2 :G_sellurl2,
        		A_sellcode :A_sellcode,
        		A_sellurl :A_sellurl,
        		S_sellcode :S_sellcode,
        		S_sellurl :S_sellurl,
				N_sellcode :N_sellcode,
        		N_sellurl :N_sellurl,
				I_sellcode :I_sellcode,
				I_sellurl :I_sellurl,
				C_sellcode :C_sellcode,
        		C_sellurl :C_sellurl,
                sellsdate:sellsdate.val(),
                selledate:selledate.val(),
            	itemclass : itemclass,
            	datetimepicker1 : datetimepicker1,
            	item_option : item_option,
            	sell_state : sell_state
            	},
            type:"POST",
            success:function(msg)
            {
                //alert(msg);
                
              	var res = msg.split('|');              	
      		    if (res[0] == "err"){
      			  	alert(res[1]);
      		    }else{
      		    	alert(res[1]);
      		    	$(location).attr('href','/sell/info');
      		    }
      		    
            }
            })
		}
		
	});

	
});
</script>









