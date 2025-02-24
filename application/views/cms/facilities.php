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
                                    <label class="col-sm-3 control-label" for="company_select">업체명</label>
                                    <div class="col-sm-7">
                                        <select id="company_select"
                                                data-placeholder="채널을 선택하세요."
                                                class="select2 form-control"
                                                tabindex="-1"
                                                name="country">
                                            <option value=""></option>
<?
foreach($cquery->result() as $crow):
?>
                                            <option class="company_select_<?php echo $crow->com_id;?>" value="<?php echo $crow->com_id;?>"><?php echo $crow->com_nm."(".$crow->com_id.")";?></option>
<?
endforeach;
?>                                             
                                        </select>
                                    </div>
                                </div>
                            
                            	<div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">시설명</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="facname" id="facname"
                                               class="form-control"
                                               placeholder="등록하실 시설 이름을 입력해주세요."
                                               data-placement="top"
                                               >
                                        <span class="help-block" id="getFacName"></span>
                                    </div>
                                </div>
                                
                                
                            
                                <!-- <div class="form-group">
                                    <label class="col-sm-3 control-label" for="password_field">Password</label>
                                    <div class="col-sm-7">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input type="password" class="form-control" id="password_field" name="password_field" placeholder="Password">
                                        </div>
                                    </div>
                                </div> -->
   
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
		                    <!-- <table id="datatable-table" class="tblCustomers table table-striped table-hover"> -->
<!-- 		                    <table id = "tblCustomers" class="table table-striped table-lg mt-lg mb-0"> -->
		                    <table id="datatable-table" class="table table-striped table-hover">
		                        <thead>
		                        <tr>
		                            <th>시설코드</th>
		                            <th class="no-sort hidden-xs">시설명</th>   
		                            <th class="no-sort">상태</th>
		                        </tr>
		                        </thead>
		                        <tbody class = "facilitieTable">
		                        
<?

foreach($query->result() as $row):

if($row->fac_state == 'Y'){
	$uflg =  "사용";
}else if($row->fac_state == 'N'){
	$uflg =  "정지";
}else{
	$uflg = $row->fac_state;
}

?>
								<tr class = "table_<?=$row->fac_id?>">
		                            <td><?=$row->fac_id?></td>
		                            <td><span class="fw-semi-bold"><?=$row->fac_nm."        (".$row->com_nm." ".$row->com_id.")"?></span></td>

		                            <td >
		                            <a id="use_<?=$row->fac_id?>" onclick="unusestate('<?=$row->fac_id?>');" uflag ="<?=$uflg?>"><?=$uflg?></a>                      
		                            
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

<script src="/vendor/select2/select2.min.js"></script>

<!-- page specific js -->
<script src="/js/form-elements.js"></script>
<script src="/js/tables-dynamic.js"></script>

<script type="text/javascript">
function num_only(){
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
        url: "<?php echo site_url('cms/facilities_use'); ?>",
        data: {code : code , use_state : use_state},
        type:"POST",
        success:function(msg)
        {
            
			
		    if (msg == "err"){
		    	alert("변경에 실패하였습니다.");
		    	
		    }else if(msg == "ok"){
		    	$('#use_'+code).text(use_text);	    	
		    }
		    
        }
        })
	}
}

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
        url: "<?php echo site_url('cms/facilities_use'); ?>",
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

	
	$("#facname").keyup(function() {

		var facname = $("#facname").val();
		$.ajax({
	        url: "<?php echo site_url('sys/get_facilitiesname'); ?>",
            data: {facname : facname},
            type:"POST",
            success:function(msg)
            {
                //alert(msg);
              //$(location).attr('href',msg);
              $( "#getFacName" ).text(msg);
            }
		})
		
	});
	
	$('.y_btn').click(function(){
		var code = $(this).attr('code');
		usestate(code,"Y");
	});	

	$('.n_btn').click(function(){
		var code = $(this).attr('code');
		usestate(code,"N");
	});	

	
	$('#save_btn').click(function(){

		if($('#company_select').val() == '' || $('#company_select').val() == null )
		{
		  alert('업체명을 선택해 주세요.');
		  $('#company_select').focus();
		  return false;
		}

		if($('#facname').val() == '' || $('#facname').val() == null)
		{
		  alert('시설 이름를 입력해 주세요.');
		  $('#facname').focus();
		  return false;
		}
		
		if(confirm("등록 하시겠습니까?")){
			var company_select = $('#company_select').val();
			var facname = $('#facname').val();
			
            $.ajax({
	        url: "<?php echo site_url('cms/facilities_add'); ?>",
            data: {company_select : company_select , facname : facname },
            type:"POST",
            success:function(msg)
            {
              	var res = msg.split('|');              	
      		    if (res[0] == "err"){
      			  	alert(res[1]);
      		    }else{
      		    	alert(res[1]);
      		    	$(location).attr('href','/cms/facilities');
      		    }
            }
            })
		}
	});
});

$(document).ready(function(){
	//var company_select = '<?php echo $company_select;?>';
	//alert(company_select); 
	//$(".company_select_"+company_select).click();
	//if(company_select != "" && company_select != null){ $("#company_select").val(company_select);  }
});
</script>









