<?
if ($this->session->userdata('cd') == 'penfen'){

}else{
	//exit;
}
?>
<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold"><?=$items->item_nm?></span></h3>
        					
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
                            <input type="hidden" id='item_id' name="item_id" value="<?=$item_id?>">

                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length">수수료</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="rate" id="rate"
                                               class="form-control numInput"
                                               placeholder=""
                                               data-placement="top"
                                               >
                                        <!-- <span class="help-block" id="getItemName"></span> -->
                                    </div>
                                </div>

								<div class="col-md-12">
									<?php //
									foreach($cquery->result() as $crow): ?>
										<div class="checkbox checkbox-info checkbox-circle" style="display: inline-block; margin-right: 15px; margin-bottom: -2px">
											<input id="checkbox<?=$crow->com_id?>" type="checkbox" value="<?=$crow->com_id?>" class="checkChn">
											<label for="checkbox<?=$crow->com_id?>" style="font-size: 8pt">
												<?=$crow->com_nm."(".$crow->com_id.")"?>
											</label>
										</div>
									<?php endforeach; ?>
								</div>

                            </fieldset>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-offset-4 col-sm-7">
										<button type="button" id="selectAll" class="btn btn-success">전체 선택</button>
										<button type="button" id="select_cancel" class="btn btn-success">선택 취소</button>
                                        <button type="button" id="save_btn" class="btn btn-primary">등 록</button>
                                        <button type="button" id="cancel_btn" class="btn btn-inverse">뒤 로 (상품 설정)</button>
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
		                    <!-- <table id="datatable-table" class="table table-striped table-hover"> -->
		                    <table id = "tblCustomers" class="table table-striped table-lg mt-lg mb-0">
		                        <thead>
		                        <tr>
		                        	<th>등록일</th>
		                            <th>상품코드</th>
		                            <th class="no-sort hidden-xs">상품명</th>   
		                            <th>채널</th>
		                            <th>수수료</th>
		                        </tr>
		                        </thead>
		                        <tbody class = "itemTable">
<?
foreach($query->result() as $row):
?>
								<tr class = "table_<?=$row->rate_id?>">
		                            <td><?=$row->rate_regdate?></td>
		                            <td><?=$row->rate_itemid?></td>
		                            <td><?=$row->item_nm."(".$row->fac_nm.")"?></td>
		                            <td><?=$row->rate_cpnm."(".$row->rate_cpid.")"?></td>
		                            <td><?=$row->rate_value?></td>
		                            <td><a href="#" class="deleteRATE" rate_itemid="<?=$row->rate_itemid?>" rate_cpid="<?=$row->rate_cpid?>">삭제</a>  </td>
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

<script src="/vendor/select2/select2.min.js"></script>

<!-- page specific js -->
<script src="/js/form-elements.js"></script>
<script src="/js/tables-dynamic.js"></script>


<script type="text/javascript">
	
$(function(){

	$(".numInput").keyup(function(){
		this.value = this.value.replace(/[^0-9\.]/g,'');
	});

	$("#selectAll").click(function() {
		$(".checkChn").prop("checked", true);
	});


	$("#select_cancel").click(function() {
		$(".checkChn").prop("checked", false);
	});

	
	$('.deleteRATE').click(function(){
		var rate_itemid = $(this).attr('rate_itemid');
		var rate_cpid = $(this).attr('rate_cpid');

		if(confirm("삭제 하시겠습니까?")){
            $.ajax({
	        url: "<?php echo site_url('cms/commission_del'); ?>",
            data: {
            	rate_itemid : rate_itemid,
            	rate_cpid : rate_cpid
            	 },
            type:"POST",
            success:function(msg)
            {
              	var res = msg.split('|');              	
      		    if (res[0] == "err"){
      			  	alert(res[1]);
      		    }else{
      		    	alert(res[1]);
      		    	location.reload();
      		    }
            }
            })
		}
		
	});
	$('#save_btn').click(function(){

		/*if($('#company_select').val() == '' || $('#company_select').val() == null )
		{
		  alert('채널을 선택해 주세요.');
		  $('#company_select').focus();
		  return false;
		}*/

		var A_ids = "";
		$('input[type=checkbox]').each(function () {
			if (this.checked) {
				A_ids += $(this).val() + ";";
			}
		});
		if(A_ids == '' || A_ids == null )
		{
			alert('채널들을 선택해 주세요.');
			return false;
		}


		if($('#rate').val() == '' || $('#rate').val() == null)
		{
		  alert('수수료를 입력해 주세요.');
		  $('#rate').focus();
		  return false;
		}

		if(confirm("등록 하시겠습니까?")){

			var itemid = '<?=$items->item_id?>';
            $.ajax({
	        url: "<?php echo site_url('cms/commission_add'); ?>",
            data: {
            	itemid : itemid,
            	//company_select : $('#company_select').val(),
				A_ids:A_ids,
            	rate : $('#rate').val()
            	 },
            type:"POST",
            success:function(msg)
            {
              	var res = msg.split('|');              	
      		    if (res[0] == "err"){
      			  	alert(res[1]);
      		    }else{
      		    	alert(res[1]);
      		    	location.reload();
      		    }
            }
            })
		}
	});
	$('#cancel_btn').click(function(){
		//$(location).attr('href','/cms/items/<?=$items->item_facid?>/<?=$items->item_id?>');
		$(location).attr('href','/cms/items/<?=$items->item_facid?>');  
	});
});

$(document).ready(function(){

});
</script>









