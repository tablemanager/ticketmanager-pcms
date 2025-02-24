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
                                    <label class="col-sm-3 control-label" for="simple-big-select">
                                        	
                                    </label>
                                    <div class="col-sm-9">
                                        <select name="typepick"
                                        		id="typepick"
                                        		class="selectpicker"
                                                data-style="btn-default btn-lg"
                                                tabindex="-1" >
                                            <option value="0">선택</option>
                                            <?php foreach($typearr as $typek => $typev){ ?>
                                            <option value="<?=$typek?>"><?=$typev?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            
                            	<div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">업체명</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="companyname" id="companyname"
                                               class="form-control"
                                               placeholder="등록하실 업체 이름을 입력해주세요."
                                               data-placement="top"
                                               >
                                        <span class="help-block" id="getCompanyName"></span>
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
		                    <table id="datatable-table" class="tblCustomers table table-striped table-hover">
		                    <!-- <table id = "tblCustomers" class="table table-striped table-lg mt-lg mb-0"> -->
		                        <thead>
		                        <tr>
		                            <th>업체코드</th>
		                            <th class="no-sort hidden-xs">업체명</th>
		                            <th class="hidden-xs">구분</th>
		                            <th class="no-sort">상태</th>
		                        </tr>
		                        </thead>
		                        <tbody>
		                        
<?
foreach($query->result() as $row):

if($row->com_state == 'Y'){
	$uflg =  "사용";
}else if($row->com_state == 'N'){
	$uflg =  "정지";
}else{
	$uflg = $row->com_state;
}

?>
								<tr class = "table_<?=$row->com_id?>">
		                            <td><?=$row->com_id?></td>
		                            <td><span class="fw-semi-bold"><?=$row->com_nm?></span></td>
		                            <td class="hidden-xs"><?=$typearr[$row->com_type]?></td>

		                            <td>
		                            
		                            
		                            <div class="btn-group">
		                            <a id="use_<?=$row->com_id?>" onclick="unusestate('<?=$row->com_id?>');" uflag ="<?=$uflg?>"><?=$uflg?></a>                      
		                            <!-- 
		                                <button class="btn btn-default" id="use_<?=$row->com_id?>" data-original-title="" title="">
		                                <?
if($row->com_state == 'Y'){
	echo "사용";
}else if($row->com_state == 'N'){
	echo "정지";
}else{
	echo $row->com_state;
}
		                            ?>
		                                </button>
		                                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" data-original-title="" title="">
		                                    <i class="fa fa-caret-down"></i>
		                                </button>
		                                <ul class="dropdown-menu">
		                                    <li><a class="visiblecode y_btn" code="<?=$row->com_id?>" state="Y" href="#">사용</a></li>
		                                    <li><a class="visiblecode n_btn" code="<?=$row->com_id?>" state="N" href="#">정지</a></li>
		                                </ul>
 -->
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
        url: "<?php echo site_url('cms/company_use'); ?>",
        data: {code : code , useyn : use_state},
        type:"POST",
        success:function(msg)
        {
          //$(location).attr('href',msg);
		    if (msg == "err"){
		    	alert("변경에 실패하였습니다.");
		    	//$(location).attr('href','/cms/company');
		    }else if(msg == "ok"){
		    	$('#use_'+code).text(use_text);	    	
		    	//alert("변경되었습니다.");
		    	//$(location).attr('href','/cms/company');
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
		//alert(unuse_text+flag);
  
        $.ajax({
        url: "<?php echo site_url('cms/company_use'); ?>",
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

	//$(".tblCustomers").dataTable();
	
    //$(document).on('click',".tblCustomers tr",function(){
    	//var code = $(this).find('.visiblecode').text();
        //alert($(this).find('td:first').text());
        //alert($(this).attr('code'));
        
        
        
        /*
    	$('.y_btn').click(function(){
    		//alert("사용버튼");
    		var code = $(this).attr('code');
    		//var code = $(this).find('.visiblecode').text();
    		alert(code + "Y");
    		//usestate(code,"Y");
    	});	

    	$('.n_btn').click(function(){
    		var code = $(this).attr('code');
    		alert(code + "N");
    	});	
    	*/
    	
    //});
	
	$('.y_btn').click(function(){
		var code = $(this).attr('code');
		usestate(code,"Y");
	});	

	$('.n_btn').click(function(){
		var code = $(this).attr('code');
		usestate(code,"N");
	});	

	
	$('#save_btn').click(function(){

		if($('#typepick').val() == '' || $('#typepick').val() == null )
		{
		  alert('업체타입을 선택해 주세요.');
		  $('#typepick').focus();
		  return false;
		}

		if($('#companyname').val() == '' || $('#companyname').val() == null)
		{
		  alert('업체 이름를 입력해 주세요.');
		  $('#companyname').focus();
		  return false;
		}
		
		/* if($('#password_field').val() == '' || $('#password_field').val() == null)
		{
		  alert('Password를 입력해 주세요.');
		  $('#password_field').focus();
		  return false;
		} */
		
		if(confirm("등록 하시겠습니까?")){
			var typepick = $('#typepick').val();
			var companyname = $('#companyname').val();
			//var password_field = $('#password_field').val();
			
            $.ajax({
	        url: "<?php echo site_url('cms/company_add'); ?>",
            data: {typepick : typepick , companyname : companyname },
            type:"POST",
            success:function(msg)
            {
                //alert(msg);  
              	var res = msg.split('|');              	
      		    if (res[0] == "err"){
      			  	alert(res[1]);
      		    }else{
      		    	alert(res[1]);
      		    	$(location).attr('href','/cms/company');
      		    }
      		    
            }
            })
		}
	});
});
</script>









