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
                            
                            	<!--<div class="form-group">
                                    <label class="col-sm-3 control-label" for="simple-big-select">
                                        	채널 선택
                                    </label>
                                    <div class="col-sm-3">
                                        <select name="chncode"
                                        		id="chncode"
                                        		class="selectpicker"
                                                data-style="btn-default btn-lg"
                                                tabindex="-1" >

                                            <?php /*foreach($chncode as $chnk => $chnv){ */?>
                                            <option value="<?/*=$chnk*/?>"><?/*=$chnv*/?></option>
                                            <?php /*} */?>
                                        </select>
                                    </div>
                                </div>-->
                                <input name="chncode" id="chncode" type="hidden" value="P" >
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">웅진 상품코드</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="itemcode" id="itemcode" maxlength="10"
                                               class="form-control"
                                               placeholder="권종코드 (예:3030302192)"
                                               data-placement="top">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">웅진 업장코드</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="gdcode" id="gdcode" maxlength="10"
                                               class="form-control"
                                               placeholder="업장코드 (예:2020, 3010)"
                                               data-placement="top">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">PCMS 상품번호</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="pcmsitem_id" id="pcmsitem_id" maxlength="5"
                                               class="form-control"
                                               placeholder="PCMS 상품번호를 입력해주세요."
                                               data-placement="top" data-original-title="You cannot write more than 4 characters."
                                               OnKeyPress="num_only()">
                                        <!-- <span class="help-block" id="pcmsitem_item"></span> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">상품명</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="pcmsitem_nm" id="pcmsitem_nm" maxlength="20"
                                               class="form-control"
                                               placeholder="상품명을 입력해주세요"
                                               data-placement="top">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">가격</label>
                                    <div class="col-sm-7">
                                        <input type="number" name="price" id="price" maxlength="10"
                                               class="form-control"
                                               placeholder="가격을 입력해 주세요."
                                               data-placement="top">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">이용시작일</label>
                                    <div class="col-sm-7"> 
	                                    <input id="startDate" type="text" class="form-control datetimepicker3" maxlength="10" />
	                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">이용종료일</label>
                                    <div class="col-sm-7"> 
	                                    <input id="endDate" type="text" class="form-control datetimepicker3" maxlength="10" />
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
		            	<div class="table-responsive">
                            <table id = "tblCustomers" class="table table-striped table-lg mt-lg mb-0">
                                <thead class="no-bd">
                                <tr>
                                    <!--<th>

                                    <select name="selectchn"
                                        		id="selectchn"
                                        		class="selectpicker"
                                                data-style="btn-default">
                                            <option value="0">채널</option>
                                            <option value="all">전체</option>
                                            <?php /*foreach($chncode as $chnk => $chnv){ */?>
                                            <option value="<?/*=$chnk*/?>"><?/*=$chnv*/?></option>
                                            <?php /*} */?>
                                        </select>
                                    </th>-->
		                            <th class="no-sort hidden-xs">상품번호</th>
		                            <th class="hidden-xs">권종코드</th>
                                    <th class="hidden-xs">업장코드</th>
		                            <th class="hidden-xs">상품명</th>
		                            <th class="hidden-xs">가격</th>
		                            <th class="hidden-xs">이용시작일</th>
		                            <th class="hidden-xs">이용종료일</th>
		                            <th class="hidden-xs">사용여부</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?
foreach($query->result() as $row):

?>

		                        <tr>
		                            <!--<td><?/*=$chncode[$row->chncode]*/?></td>-->
		                            <td><?=$row->pcms_id?></td>
		                            <td><?=$row->itemcode?></td>
                                    <td><?=$row->gdcode?></td>
		                            <td><?=$row->nm?></td>
		                            <td><?=number_format($row->price)."원"?></td>
		                            <td>
		                            	<input id="datemode<?=$row->id?>" type="text" class="datemode form-control datetimepicker3"
		                                    code="<?=$row->id?>" mode = "sdate" maxlength="10" value="<?=date("Y-m-d",strtotime ($row->sdate))?>" size="10" style="border:0; background-color: transparent;"/>
		                            </td>
		                            <td>
		                            	<input id="datemode<?=$row->id?>" type="text" class="datemode form-control datetimepicker3"
		                                    code="<?=$row->id?>" mode = "edate" maxlength="10" value="<?=date("Y-m-d",strtotime ($row->edate))?>" size="10" style="border:0; background-color: transparent;"/>
		                            </td>
		                            <td class="hidden-xs">
                                        <div class="btn-group">
                                            <button class="btn btn-default" id="use_<?=$row->id?>" data-original-title="" title="">
                                                <?=$state[$row->state]?>
                                            </button>
                                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" data-original-title="" title="">
                                                <i class="fa fa-caret-down"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="y_btn" code="<?=$row->id?>" href="#">사용</a></li>
                                                <li><a class="n_btn" code="<?=$row->id?>" href="#">정지</a></li>
                                            </ul>
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
function num_only(){
	//alert();
	if((event.keyCode<48) || (event.keyCode>57)){
    	event.returnValue=false;
  	}
}

function usestate(code,use_state){
	var use_text = "";
	if(use_state == "Y"){
		use_text = "사용";
	}else if(use_state == "N"){
		use_text = "정지";
	}else{
		return false;
	}
	if(confirm(use_text+" 상태로 변경하시겠습니까?")){
        $.ajax({
        url: "<?php echo site_url('sell/onemount_use'); ?>",
        data: {code : code , useyn : use_state},
        type:"POST",
        success:function(msg)
        {
		    if (msg == "err"){
		    	alert("변경에 실패하였습니다.");
		    	$(location).attr('href','/sell/onemount');
		    }else if(msg == "ok"){
		    	$('#use_'+code).text(use_text);
		    	alert("변경되었습니다.");
		    	//$(location).attr('href','/sell/onemount');
		    }
        }
        })
	}
}
	
$(function(){

	
	$('#selectchn').change(function(){
		var selectchn = $('#selectchn').val();
		$(location).attr('href','/sell/playcity/'+selectchn);
	});	

	$(".datemode").change(function() {
		var code = $(this).attr('code');
		var mode = $(this).attr('mode');
		var date = $(this).val();
		if(confirm("이용일을 변경 하시겠습니까?")){	
			$.ajax({
		        url: "<?php echo site_url('sell/onemount_date'); ?>",
	            data: {code : code, date : date , mode : mode},
	            type:"POST",
	            success:function(msg)
	            {
	                if(msg == "err"){
	                	alert("error");
	                }
	            }
			})
		}
	});

	$("#pcmsitem_id").keyup(function() {

		var pcmsitem_id = $("#pcmsitem_id").val();
		var chncode = $("#chncode").val();
		
		$.ajax({
	        url: "<?php echo site_url('sys/get_itemname'); ?>",
            data: {pcmsitem_id : pcmsitem_id},
            type:"POST",
            success:function(msg)
            {
              //$(location).attr('href',msg);
              //$( "#pcmsitem_item" ).text(msg);
              if(msg != "조회할수 없는 번호입니다."){
              	$( "#pcmsitem_nm" ).val(msg);
              }
              
            }
		})
		//$( "#pcmsitem_item" ).text(pcmsitem_id);
	});

	
	
	
	$('.y_btn').click(function(){
		//alert("사용버튼");
		var code = $(this).attr('code');
		usestate(code,"Y");
	});	

	$('.n_btn').click(function(){
		//alert("정지버튼");
		var code = $(this).attr('code');
		usestate(code,"N");
	});	

	
	$('#save_btn').click(function(){

		if($('#chncode').val() == '' || $('#chncode').val() == null  || $('#chncode').val() == '0' )
		{
		  alert('채널을 선택해 주세요.');
		  $('#chncode').focus();
		  return false;
		}

		if($('#itemcode').val() == '' || $('#itemcode').val() == null)
		{
		  alert('권종 코드를 입력해 주세요.');
		  $('#itemcode').focus();
		  return false;
		}
        if($('#gdcode').val() == '' || $('#gdcode').val() == null)
        {
            alert('업장 코드를 입력해 주세요.');
            $('#gdcode').focus();
            return false;
        }
		if($('#pcmsitem_id').val() == '' || $('#pcmsitem_id').val() == null)
		{
		  alert('PCMS 상품번호를 입력해 주세요.');
		  $('#pcmsitem_id').focus();
		  return false;
		}
		
		if($('#pcmsitem_nm').val() == '' || $('#pcmsitem_nm').val() == null)
		{
		  alert('상품명을 입력해 주세요.');
		  $('#pcmsitem_nm').focus();
		  return false;
		}
        if($('#price').val() == '' || $('#price').val() == null)
        {
            alert('가격을 입력해 주세요.');
            $('#price').focus();
            return false;
        }
		
		if($('#startDate').val() == '' || $('#startDate').val() == null)
		{
		  alert('이용시작일을 입력해 주세요.');
		  $('#startDate').focus();
		  return false;
		}
		if($('#endDate').val() == '' || $('#endDate').val() == null)
		{
		  alert('이용종료일을 입력해 주세요.');
		  $('#endDate').focus();
		  return false;
		}
		
		if(confirm("등록 하시겠습니까?")){
			var chncode = $('#chncode').val();
			var itemcode = $('#itemcode').val();
            var gdcode = $('#gdcode').val();
			var pcmsitem_id = $('#pcmsitem_id').val();
			var pcmsitem_nm = $('#pcmsitem_nm').val();
            var price = $('#price').val();
			var startDate = $('#startDate').val();
			var endDate = $('#endDate').val();

						
            $.ajax({
	        url: "<?php echo site_url('sell/playcity_add'); ?>",
            data: {chncode:chncode,
    			itemcode:itemcode,
                gdcode:gdcode,
                price:price,
    			pcmsitem_id:pcmsitem_id,
    			pcmsitem_nm:pcmsitem_nm,
    			startDate:startDate,
    			endDate:endDate},
            type:"POST",
            success:function(msg)
            {
                //alert(msg);
      		    if (msg == "err"){
      			  	alert("등록 실패");
      		    }
      		   $(location).attr('href','/sell/playcity/'+chncode);
      		    
            }
            })
		}
	});
});
</script>









