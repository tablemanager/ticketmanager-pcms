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
                                    <label class="col-sm-3 control-label" for="fac_select">시설명</label>
                                    <div class="col-sm-7">
                                    
                                    <?php if($mode == "new"){?>
                                        <select id="fac_select"
                                                data-placeholder="시설명을 선택하세요."
                                                class="select2 form-control"
                                                tabindex="-1"
                                                name="country">
                                            <option value=""></option>
<?
foreach($cquery->result() as $crow):
?>
                                            <option class="fac_select_<?php echo $crow->fac_id;?>" value="<?php echo $crow->fac_id;?>"><?php echo $crow->fac_nm."(".$crow->fac_id.")";?></option>
<?
endforeach;
?>                                             
                                        </select>
<?php }else{
	$crow = $cquery->row();
?>  
										<input type="hidden" id="fac_select" value="<?php echo $crow->fac_id;?>">
										<h5><?php echo $crow->fac_nm;?></h5>
<?php }?>  
                                    </div>
                                </div>
                            
                            	<div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">상품명</label>
                                    <div class="col-sm-7">
                                    <?php if(!$sitem){?>
                                        <input type="text" name="itemname" id="itemname"
                                               class="form-control"
                                               placeholder="등록하실 상품 이름을 입력해주세요."
                                               data-placement="top"
                                               >
                                      <?php }else{?>
                                      		<input type="hidden" id="item_select" value="<?php echo $sitem->item_id;?>">
										<!--	<h5><?php /*echo $sitem->item_nm;*/?></h5>-->
										<input type="text" name="new_itemname" id="new_itemname"
											   class="form-control"
											   placeholder="등록하실 상품 이름을 입력해주세요."
											   data-placement="top"
											   value="<?php echo $sitem->item_nm;?>"
										>
                                      <?php }?>
                                        <!-- <span class="help-block" id="getItemName"></span> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">판매시작일</label>
                                    <div class="col-sm-7"> 
	                                    <input id="item_sdate" type="text" class="form-control datetimepicker1" maxlength="10" 
	                                    value= "<?php if(!$sitem){echo date('m/d/Y');}else{echo date('m/d/Y',strtotime($sitem->item_sdate));}?>"/>
	                                </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">판매종료일</label>
                                    <div class="col-sm-7"> 
	                                    <input id="item_edate" type="text" class="form-control datetimepicker1" maxlength="10" 
	                                    value= "<?php if($sitem){echo date('m/d/Y',strtotime($sitem->item_edate));}?>"/>
	                                </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">외부코드</label>
                                    <div class="col-sm-7">
                                        <input id="item_cd" type="text" class="form-control" maxlength="10"
                                               value= "<?php if($sitem){echo $sitem->item_cd;}?>"/>
                                    </div>
                                </div>

                            </fieldset>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-offset-5 col-sm-7">
                                       <?php if(!$sitem){?>
                                        <button type="button" id="save_btn" class="btn btn-primary">등 록</button>
                                      <?php }else{?>
                                      	<button type="button" id="mode_btn" class="btn btn-primary">수 정</button>
                                      <?php }?>
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
		                    <!-- <table id="datatable-table" class="tblCustomers table table-striped table-hover"> -->
 		                    <table id = "tblCustomers" class="table table-striped table-lg mt-lg mb-0">
		                    <!-- <table id="datatable-table" class="table table-striped table-hover"> -->
		                        <thead>
		                        <tr>
		                            <th>상품코드</th>
		                            <th class="no-sort hidden-xs">상품명</th>   
		                            <th>판매시작</th>
		                            <th>판매종료</th>
		                            <th>가격</th>
		                            <th>수수료</th>
		                            <th class="no-sort">상태</th>
		                        </tr>
		                        </thead>
		                        <tbody class = "itemTable">
		                        

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

<script src="/vendor/select2/select2.min.js"></script>

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
        $.ajax({
        url: "<?php echo site_url('cms/item_use'); ?>",
        data: {code : code , use_state : flag},
        type:"POST",
        success:function(msg)
        {
		    if (msg == "err"){
		    	alert("변경에 실패하였습니다.");    	
		    }else if(msg == "ok"){
		    	$('#use_'+code).text(unuse_text);	 
		    	$('#use_'+code).attr("uflag",unuse_text);		
		    }
		    
        }
        })
	}
}
	
$(function(){



	$('#fac_select').change(function(){
		var fac_id = $(this).val();
		//alert(fac_id);
		$.ajax({
	        url: "<?php echo site_url('cms/item_load'); ?>",
            data: {fac_id : fac_id  },
            type:"POST",
            success:function(msg)
            {
                $('.itemTable').html(msg);
            }
         })
	});
	
	$('#save_btn').click(function(){

		if($('#fac_select').val() == '' || $('#fac_select').val() == null )
		{
		  alert('시설명을 선택해 주세요.');
		  $('#fac_select').focus();
		  return false;
		}
		
		if($('#itemname').val() == '' || $('#itemname').val() == null)
		{
		  alert('상품 이름를 입력해 주세요.');
		  $('#itemname').focus();
		  return false;
		}

		if($('#item_sdate').val() == '' || $('#item_sdate').val() == null)
		{
		  alert('판매시작일 입력해 주세요.');
		  $('#item_sdate').focus();
		  return false;
		}

		if($('#item_edate').val() == '' || $('#item_edate').val() == null)
		{
		  alert('판매종료일을 입력해 주세요.');
		  $('#item_edate').focus();
		  return false;
		}
		
		if(confirm("등록 하시겠습니까?")){
			var fac_select = $('#fac_select').val();
			var itemname = $('#itemname').val();
			var item_sdate = $('#item_sdate').val();
			var item_edate = $('#item_edate').val();
            var item_cd = $('#item_cd').val();

			//alert(fac_select + itemname + item_sdate + item_edate);

            $.ajax({
	        url: "<?php echo site_url('cms/item_add'); ?>",
            data: {fac_select : fac_select , itemname : itemname , item_sdate : item_sdate, item_edate : item_edate , item_cd:item_cd},
            type:"POST",
            success:function(msg)
            {
              	var res = msg.split('|');              	
      		    if (res[0] == "err"){
      			  	alert(res[1]);
      		    }else{
      		    	alert(res[1]);
      		    	$(location).attr('href','/cms/items/'+fac_select);
      		    }
            }
            })
		}
	});

	
	$('#mode_btn').click(function(){
		
		if($('#item_sdate').val() == '' || $('#item_sdate').val() == null)
		{
		  alert('판매시작일 입력해 주세요.');
		  $('#item_sdate').focus();
		  return false;
		}

		if($('#item_edate').val() == '' || $('#item_edate').val() == null)
		{
		  alert('판매종료일을 입력해 주세요.');
		  $('#item_edate').focus();
		  return false;
		}
		
		if(confirm("수정 하시겠습니까?")){
			var item_select = $('#item_select').val();
			var new_itemname = $('#new_itemname').val();
			var item_sdate = $('#item_sdate').val();
			var item_edate = $('#item_edate').val();
            var item_cd = $('#item_cd').val();

			//alert(fac_select + itemname + item_sdate + item_edate);

            $.ajax({
	        url: "<?php echo site_url('cms/item_mode'); ?>",
            data: {item_select : item_select , item_sdate : item_sdate, item_edate : item_edate, new_itemname:new_itemname, item_cd:item_cd },
            type:"POST",
            success:function(msg)
            {
              	var res = msg.split('|');              	
      		    if (res[0] == "err"){
      			  	alert(res[1]);
      		    }else{
      		    	alert(res[1]);
      		    	//$(location).attr('href','/cms/items/'+fac_select);
      		    	location.reload();
      		    }
            }
            })
		}
	});
	
	$('#cancel_btn').click(function(){
		$(location).attr('href','/cms/items');
	});
});

$(document).ready(function(){
	var facid = '<?=$facid ?>';
	if(facid != '0'){
		//$("#fac_select").val(facid).attr("selected", "selected");
		//$("#selectBox").val(facid);
		//
		/* $("#selectBox").selectpicker();
		$("#selectBox").val(facid);
		$("#selectBox").selectpicker('refresh'); */
		
		$.ajax({
	        url: "<?php echo site_url('cms/item_load'); ?>",
            data: {fac_id : facid  },
            type:"POST",
            success:function(msg)
            {
                $('.itemTable').html(msg);
            }
         })
	}
});
</script>









