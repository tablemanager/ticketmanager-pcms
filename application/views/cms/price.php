<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold"><?=$items->item_nm?></span></h3>
        					
        <div class="row">
            <div class="col-md-8">
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
                                    <label class="col-sm-3 control-label" for="max-length">이용일</label>
                                    <div class="col-sm-4"> 
	                                    <input id="price_date" type="text" class="form-control datetimepicker1" maxlength="10" />
	                                     <span class="help-block"><font color="red">기존에 등록된 날짜</font>의 가격을 입력하면 <font color="red">새로 입력한 가격</font>으로 대체됩니다.</span>
	                                </div>
	                                
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">가격</label>
                                    <div class="col-sm-2">
                                        <input type="text" name="normalPrice" id="normalPrice"
                                               class="form-control numInput"
                                               placeholder="정상가격"
                                               data-placement="top"
                                               >
                                    </div>
                                    
                                    <div class="col-sm-2">
                                        <input type="text" name="salePrice" id="salePrice"
                                               class="form-control numInput"
                                               placeholder="판매가격"
                                               data-placement="top"
                                               >
                                        
                                    </div>
                                    
                                    <div class="col-sm-2">
                                        <input type="text" name="outPrice" id="outPrice"
                                               class="form-control numInput"
                                               placeholder="공급가격"
                                               data-placement="top"
                                               >
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" name="inPrice" id="inPrice"
                                               class="form-control numInput"
                                               placeholder="사입가격"
                                               data-placement="top"
                                               >
                                    </div>
                                    
                                </div>
                                
                                
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">판매수량(재고)</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="qty" id="qty"
                                               class="form-control numInput"
                                               placeholder=""
                                               data-placement="top"
                                               >
                                        <!-- <span class="help-block" id="getItemName"></span> -->
                                    </div>
                                </div>

                            </fieldset>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-offset-5 col-sm-7">
                                        <button type="button" id="save_btn" class="btn btn-primary">등 록</button>
                                        <button type="button" id="cancel_btn" class="btn btn-inverse">뒤 로 (상품 설정)</button>&nbsp;&nbsp;
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                 </section>
              </div>
            
            
            
            <div class="col-md-4">
            	<section class="widget">
            		<div class="widget-body">
                        <?php 
                        $attributes = array('class' => 'form-horizontal', 'id' => 'fileform' , 'role' => 'form' );
                        echo form_open_multipart('/cms/price_add_excel',$attributes);   
                        ?>
                        	<input type="hidden" name="pcms_id" class="pcms_id" id="pcms_id" value="<?= $item_id ?>">
                        	<!-- <input id="userfile" name="userfile" type="file"> -->
                            <fieldset>
                            	 <div class="form-group">
	                                <div class="col-sm-offset-1 col-sm-10" style="margin-bottom: 20px; margin-top: 20px;">
	                                <blockquote class="blockquote-reverse">
	                                    <p>업로드할 가격들을 엑셀로 업로드 해주세요.</p>
	                                    <p>[<a href="/docs/가격 대량 등록.xlsx">엑셀 폼 다운</a>] [<a href="/docs/가격추가메뉴얼_20160912.pdf">메뉴얼 다운</a>]</p>
	                                    <footer>등록후 변경 내용을 확인해주세요.</footer>    
	                                </blockquote>
	                                </div>
                               </div> 
                                <div class="form-group" style="margin-top: 0px;">
                                    <!-- <div class="col-sm-offset-2 col-sm-3" style="margin-bottom: 10px;">
                                        <input type="number" id="normal-field" name="qty" class="form-control" placeholder="업로드 수량 입력(숫자)">
                                    </div> -->
                                    <div class="col-sm-offset-1 col-sm-10">
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
                                </div>
                                    <div class="col-sm-offset-4 col-sm-7" style="margin-bottom: 25px;margin-top: 5px;" >
                                        <button type="button" id="excel_btn" class="btn btn-warning">엑셀(excel) 업로드</button>
                                    </div>
                            </fieldset>
                            
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
		                        	<th>등록일<!--<button type="button" id="dnprice_btn" class="btn btn-inverse">다운로드</button>--></th>
		                            <th>상품코드</th>
		                            <th class="no-sort hidden-xs">상품명</th>   
		                            <th>이용일</th>
		                            <th>정상가</th>
		                            <th>판매가</th>
		                            
		                            <th>공급가</th>
		                            <th>사입가</th>
		                            <th>판매수량</th>
		                        </tr>
		                        </thead>
		                        <tbody class = "itemTable">
<?
foreach($query->result() as $row):
?>
								<tr class = "table_<?=$row->item_id?>">
		                            <td><?=$row->price_regdate?></td>
		                            <td><?=$row->price_itemid?></td>
		                            <td><?=$row->item_nm."<br/>(".$row->fac_nm.")"?></td>
		                            <td><?=$row->price_date?></td>
		                            <td><?=$row->price_normal?></td>
		                            <td><?=$row->price_sale?></td>
		                            
		                            <td><?=$row->price_out?></td>
		                            <td><?=$row->price_in?></td>
									<td><?=$row->price_qty?></td> 
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


	$(".numInput").keyup(function(){
		this.value = this.value.replace(/[^0-9\.]/g,'');
	});

	
	$('#excel_btn').click(function(){
		if(confirm("등록 하시겠습니까?")){
			$('#fileform').submit();
		}
	});
	$('#dnprice_btn').click(function(){
		if(confirm("가격을 다운 받으시겠습니까?")){
            $.ajax({
	        url: "<?php echo site_url('cms/dnprice'); ?>",
            data: {
            	id : $('#item_id').val()
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

		/* if($('#item_select').val() == '' || $('#item_select').val() == null )
		{
		  alert('상품명을 선택해 주세요.');
		  $('#item_select').focus();
		  return false;
		} */
		
		if($('#price_date').val() == '' || $('#price_date').val() == null)
		{
		  alert('이용일 입력해 주세요.');
		  $('#price_date').focus();
		  return false;
		}

		if($('#normalPrice').val() == '' || $('#normalPrice').val() == null)
		{
		  alert('정상가를 입력해 주세요.');
		  $('#normalPrice').focus();
		  return false;
		}

		if($('#salePrice').val() == '' || $('#salePrice').val() == null)
		{
		  alert('판매가를 입력해 주세요.');
		  $('#salePrice').focus();
		  return false;
		}

		if($('#inPrice').val() == '' || $('#inPrice').val() == null)
		{
		  alert('사입가를 입력해 주세요.');
		  $('#inPrice').focus();
		  return false;
		}

		if($('#outPrice').val() == '' || $('#outPrice').val() == null)
		{
		  alert('공급가를 입력해 주세요.');
		  $('#outPrice').focus();
		  return false;
		}

		if($('#qty').val() == '' || $('#qty').val() == null)
		{
		  alert('판매수량(재고)를 입력해 주세요.');
		  $('#qty').focus();
		  return false;
		}

		if(confirm("등록 하시겠습니까?")){

			
            $.ajax({
	        url: "<?php echo site_url('cms/price_add'); ?>",
            data: {
            	item_select : $('#item_id').val(),
            	price_date : $('#price_date').val(),
            	normalPrice : $('#normalPrice').val(),
            	salePrice : $('#salePrice').val(),
            	inPrice : $('#inPrice').val(),
            	outPrice : $('#outPrice').val(),
            	qty : $('#qty').val()
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









