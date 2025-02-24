<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title">외부연동 - <span class="fw-semi-bold">CJ 오클락</span></h3>
        					
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
                                    <label class="col-sm-3 control-label" for="max-length">PCMS 상품번호</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="pcmsitem_id" id="pcmsitem_id" maxlength="5"
                                               class="form-control"
                                               placeholder="PCMS 상품번호를 입력해주세요."
                                               data-placement="top" data-original-title="You cannot write more than 4 characters."
                                               OnKeyPress="num_only()">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">상품명</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="pcmsitem_nm" id="pcmsitem_nm" maxlength="20"
                                               class="form-control"
                                               placeholder="상품명을 입력해주세요"
                                               data-placement="top" data-original-title="You cannot write more than 4 characters."
                                               OnKeyPress="num_only()">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">이용일</label>
                                    <div class="col-sm-7"> 
	                                    <input id="datetimepicker1" type="text" class="form-control datetimepicker1" maxlength="10" />
	                                </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="password_field">Password</label>
                                    <div class="col-sm-7">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input type="password" class="form-control" id="password_field" name="password_field" placeholder="Password">
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
<?php if(true){?>     	
		            	<div class="table-responsive">
                            <table class="table table-striped table-lg mt-lg mb-0">
                                <thead class="no-bd">
                                <tr>
                                    <th>Id</th>
		                            <th class="no-sort hidden-xs">PCMS 상품번호</th>
		                            <th class="hidden-xs">상품명</th>
		                            <th class="hidden-xs">이용일</th>
		                            <th class="hidden-xs">사용여부</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?
foreach($query->result() as $row):

?>

		                        <tr>
		                            <td><?=$row->id?></td>
		                            <td><span class="fw-semi-bold"><?=$row->pcmsitem_id?></span></td>
		                            <td class="hidden-xs"><?=$row->nm?></td>
		                            <td class="hidden-xs"><?=$row->usedate?></td>
		                            <td class="hidden-xs">
		                            
		                            
		                            <div class="btn-group">
		                                <button class="btn btn-default" id="use_<?=$row->id?>" data-original-title="" title="">
		                                <?
if($row->useyn == 'Y'){
	echo "사용";
}else if($row->useyn == 'N'){
	echo "정지";
}else{
	echo $row->useyn;
}
		                            ?>
		                                </button>
		                                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" data-original-title="" title="">
		                                    <i class="fa fa-caret-down"></i>
		                                </button>
		                                <ul class="dropdown-menu">
		                                    <li><a class="y_btn" code="<?=$row->id?>" href="#">사용</a></li>
		                                    <!-- <li class="divider"></li> -->
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
<?php }else{ ?>                     

		                <div class="mt">
		                    <table id="datatable-table" class="table table-striped table-hover">
		                        <thead>
		                        <tr>
		                            <th>Id</th>
		                            <th class="no-sort hidden-xs">PCMS 상품번호</th>
		                            <th class="hidden-xs">상품명</th>
		                            <th class="hidden-xs">이용일</th>
		                            <th class="hidden-xs">사용여부</th>
		                        </tr>
		                        </thead>
		                        <tbody>
		                        
<?
foreach($query->result() as $row):

?>

		                        <tr>
		                            <td><?=$row->id?></td>
		                            <td><span class="fw-semi-bold"><?=$row->pcmsitem_id?></span></td>
		                            <td class="hidden-xs"><?=$row->nm?></span></td>
		                            <td class="hidden-xs"><?=$row->usedate?></td>
		                            <td class="hidden-xs">               
<?
if($row->useyn == 'Y'){
	echo "<span class='label label-success'>사용</span>";
}else if($row->useyn == 'N'){
	echo "<span class='label label-danger'>정지</span>";
}else{
	echo $row->useyn;
}
		                            ?>	
		                            <!--                          
		                            <div class="btn-group">
		                                <button class="btn btn-default" id="use_<?=$row->id?>" data-original-title="" title="">
		                             <?
if($row->useyn == 'Y'){
	echo "사용";
}else if($row->useyn == 'N'){
	echo "정지";
}else{
	echo $row->useyn;
}
		                            ?>
		                                </button>
		                                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" data-original-title="" title="">
		                                    <i class="fa fa-caret-down"></i>
		                                </button>
		                                <ul class="dropdown-menu">
		                                    <li><a class="y_btn" code="<?=$row->id?>" href="#">사용</a></li>
		                                    
		                                    <li><a class="n_btn" code="<?=$row->id?>" href="#">정지</a></li>
		                                </ul>
		                            </div>
		                             -->
		                            </td>
		                        </tr>
<?
endforeach;
?>		                        
		                        
		                        </tbody>
		                    </table>
		                </div>
<? } ?>
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
        url: "<?php echo site_url('cj/cj_use'); ?>",
        data: {code : code , useyn : use_state},
        type:"POST",
        success:function(msg)
        {
          $(location).attr('href',msg);
		    if (msg == "err"){
		    	alert("변경에 실패하였습니다.");
		    	$(location).attr('href','/cj/cj_list');
		    }else if(msg == "ok"){
		    	$('#use_'+code).text(use_text);
		    	alert("변경되었습니다.");
		    	$(location).attr('href','/cj/cj_list');
		    }
        }
        })
	}
}
	
$(function(){

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

		if($('#datetimepicker1').val() == '' || $('#datetimepicker1').val() == null)
		{
		  alert('이용일을 입력해 주세요.');
		  $('#datetimepicker1').focus();
		  return false;
		}

		if($('#password_field').val() == '' || $('#password_field').val() == null)
		{
		  alert('Password를 입력해 주세요.');
		  $('#password_field').focus();
		  return false;
		}
		
		if(confirm("등록 하시겠습니까?")){
			var pcmsitem_id = $('#pcmsitem_id').val();
			var pcmsitem_nm = $('#pcmsitem_nm').val();
			var datetimepicker1 = $('#datetimepicker1').val();
			var password_field = $('#password_field').val();
			
            $.ajax({
	        url: "<?php echo site_url('cj/cj_pcms'); ?>",
            data: {pcmsitem_id : pcmsitem_id , datetimepicker1 : datetimepicker1 , password_field : password_field, pcmsitem_nm : pcmsitem_nm},
            type:"POST",
            success:function(msg)
            {
              $(location).attr('href',msg);
              	var res = msg.split('|');
              	//alert(res[1]);
              	
      		    if (res[0] == "err"){
      			  	alert(res[1]);
      			  	$(location).attr('href','/cj/cj_list');
      		    }else{
      		    	alert(res[1]);
      		    	//location.reload();
      		    	$(location).attr('href','/cj/cj_list');
                    //$(location).attr('href',msg);
      		    }
            }
            })
		}
	});
});
</script>









