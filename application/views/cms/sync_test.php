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
                                        	채널 선택
                                    </label>
                                    <div class="col-sm-3">
                                        <select name="chnpick"
                                        		id="chnpick"
                                        		class="selectpicker"
                                                data-style="btn-default btn-lg"
                                                tabindex="-1" >
                                            <option value="0">선택</option>
                                            <?php foreach($chnarr as $chnk => $chnv){ ?>
                                            <option value="<?=$chnk?>"><?=$chnv?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4" style="margin-top:5px">
                                        <input type="text" name="admin_cd" id="admin_cd"
                                               class="form-control"
                                               placeholder="어드민 계정 입력(*위메프 필수)"
                                               data-placement="top"
                                        >
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
                                        <span class="help-block" id="pcmsitem_item"></span>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">쿠폰코드</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="coupon_id" id="coupon_id" maxlength="10"
                                               class="form-control"
                                               placeholder="쿠폰코드를 입력해주세요.(개발팀에 문의)"
                                               data-placement="top" disabled="disabled">
                                    </div>
                                </div>
                                
                                
								<!-- 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">상품명</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="pcmsitem_nm" id="pcmsitem_nm" maxlength="20"
                                               class="form-control"
                                               placeholder="상품명을 입력해주세요"
                                               data-placement="top">
                                    </div>
                                </div>
                                 -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">이용일</label>
                                    <div class="col-sm-7"> 
	                                    <input id="datetimepicker1" type="text" class="form-control datetimepicker1" maxlength="10" />
	                                </div>
                                </div>
 <!--
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="password_field">Password</label>
                                    <div class="col-sm-7">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input type="password" class="form-control" id="password_field" name="password_field" placeholder="Password">
                                        </div>
                                    </div>
                                </div>
   -->  
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
                                    <th>
                                    <select name="selectchn"
                                        		id="selectchn"
                                        		class="selectpicker"
                                                data-style="btn-default">
                                            <option value="0">채널</option>
                                            <option value="all">전체</option>
                                            <?php foreach($chnall as $chnallk => $chnallv){ ?>
                                            <option value="<?=$chnallk?>"><?=$chnallv?></option>
                                            <?php } ?>
                                        </select>
                                    </th>
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
		                            <td><?=$chnall[$row->channel]?><?php if($row->admin_account != null && $row->admin_account != ""){echo "(".$row->admin_account.")";}?></td>
		                            <td><span class="fw-semi-bold"><?=$row->pcmsitem_id?>
		                            <?php 
		                            if($row->gu!='' && $row->gu != null){
		                            	echo "(".$row->gu.")";
		                            }
		                            ?>
		                            </span></td>
		                            <td class="hidden-xs"><?=$row->nm?></td>
		                            <td class="hidden-xs">
		                            <?php 
		                            if($this->session->userdata('cd') == $row->admin_account || "penfen" == $this->session->userdata('cd') ){
		                            	$date_arr = explode("-",$row->usedate);
		                            	$date_arr = $date_arr[1]."/".$date_arr[2]."/".$date_arr[0];
		                            ?>
	                                    <input id="datemode<?=$row->id?>" type="text" class="datemode form-control datetimepicker1" code="<?=$row->id?>" maxlength="10" value="<?=$date_arr?>" size="10"/>
		                            <?php 
		                            }else{
										echo $row->usedate;
		                            }
		                            ?>
	                                
		                            
		                            </td>
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
        url: "<?php echo site_url('cms/cms_use'); ?>",
        data: {code : code , useyn : use_state},
        type:"POST",
        success:function(msg)
        {
          $(location).attr('href',msg);
		    if (msg == "err"){
		    	alert("변경에 실패하였습니다.");
		    	$(location).attr('href','/cms/sync');
		    }else if(msg == "ok"){
		    	$('#use_'+code).text(use_text);
		    	alert("변경되었습니다.");
		    	$(location).attr('href','/cms/sync');
		    }
        }
        })
	}
}
	
$(function(){

	
	$('#selectchn').change(function(){
		var selectchn = $('#selectchn').val();
		$.ajax({
	        url: "<?php echo site_url('cms/selectchn'); ?>",
            data: {selectchn : selectchn},
            type:"POST",
            success:function(msg)
            {
              $(location).attr('href',msg);
              	var res = msg.split('|');
              	//alert(res[1]);
      		    if (res[0] == "err"){
      			  	//alert(res[1]);
      			  	$(location).attr('href','/cms/sync');
      		    }else{
      		    	//alert(res[1]);
      		    	//location.reload();
      		    	$(location).attr('href','/cms/sync');
                    //$(location).attr('href',msg);
      		    }
            }
         })
	});	
	
	$('#chnpick').change(function(){
		var chnn = $('#chnpick').val();
		 
		var user = "<?php echo $this->session->userdata('cd');?>";
		if(user== "penfen" || user == "jjlee"){
			 if(chnn == "SKP" || chnn == "TMON" || chnn == "WEMP" || chnn == "CPNG" || chnn == "SKT" || chnn == "LEQ"){
				 //$('#coupon_id').removeAttr("disabled");
			}else{
				$('#coupon_id').val("");
				//$('#coupon_id').attr("disabled", "disabled");
			}
			// $('#coupon_id').val(chnn);
		}

	});

	$(".datemode").change(function() {
		var code = $(this).attr('code');
		var date = $(this).val();

		$.ajax({
	        url: "<?php echo site_url('cms/items_ext_date'); ?>",
            data: {code : code, date : date},
            type:"POST",
            success:function(msg)
            {
                if(msg == "err"){
                	alert("error");
                }
            }
		})
	});

	$("#pcmsitem_id").keyup(function() {

		var pcmsitem_id = $("#pcmsitem_id").val();
		var chnpick = $("#chnpick").val();
		
		$.ajax({
	        url: "<?php echo site_url('sys/get_itemname'); ?>",
            data: {pcmsitem_id : pcmsitem_id},
            type:"POST",
            success:function(msg)
            {
              //$(location).attr('href',msg);
              $( "#pcmsitem_item" ).text(msg);
            }
		})
		
		$.ajax({
	        url: "<?php echo site_url('sys/get_itemcode'); ?>",
            data: {pcmsitem_id : pcmsitem_id, chnpick : chnpick},
            type:"POST",
            success:function(msg)
            {
              if(msg != "ERROR" && msg != "" && msg != null){

            	  $( "#coupon_id" ).val(msg);
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

		if($('#chnpick').val() == '' || $('#chnpick').val() == null )
		{
		  alert('채널을 선택해 주세요.');
		  $('#chnpick').focus();
		  return false;
		}

		if($('#chnpick').val() == 'WEMP')
		{
			if($('#admin_cd').val() == '' || $('#admin_cd').val() == null )
			{
			  alert('어드민 계정을 입력해 주세요.');
			  $('#admin_cd').focus();
			  return false;
			}
		}


		if($('#pcmsitem_id').val() == '' || $('#pcmsitem_id').val() == null)
		{
		  alert('PCMS 상품번호를 입력해 주세요.');
		  $('#pcmsitem_id').focus();
		  return false;
		}
		/*
		if($('#pcmsitem_nm').val() == '' || $('#pcmsitem_nm').val() == null)
		{
		  alert('상품명을 입력해 주세요.');
		  $('#pcmsitem_nm').focus();
		  return false;
		}
		*/
		if($('#datetimepicker1').val() == '' || $('#datetimepicker1').val() == null)
		{
		  alert('이용일을 입력해 주세요.');
		  $('#datetimepicker1').focus();
		  return false;
		}

		
		/* if($('#password_field').val() == '' || $('#password_field').val() == null)
		{
		  alert('Password를 입력해 주세요.');
		  $('#password_field').focus();
		  return false;
		} */
		
		if(confirm("등록 하시겠습니까?")){
			var chnpick = $('#chnpick').val();
			var pcmsitem_id = $('#pcmsitem_id').val();
			//var pcmsitem_nm = $('#pcmsitem_nm').val();
			var datetimepicker1 = $('#datetimepicker1').val();
			//var password_field = $('#password_field').val();
			var coupon_id = $('#coupon_id').val();
			var admin_cd = $('#admin_cd').val();
			
            $.ajax({
	        url: "<?php echo site_url('cms/cms_pcms'); ?>",
            data: {chnpick : chnpick , pcmsitem_id : pcmsitem_id , datetimepicker1 : datetimepicker1 , coupon_id : coupon_id, admin_cd : admin_cd},
            type:"POST",
            success:function(msg)
            {
              $(location).attr('href',msg);
              	var res = msg.split('|');
              	//alert(res[1]);
              	
      		    if (res[0] == "err"){
      			  	alert(res[1]);
      			  	$(location).attr('href','/cms/sync');
      		    }else{
      		    	alert(res[1]);
      		    	//location.reload();
      		    	$(location).attr('href','/cms/sync');
                    //$(location).attr('href',msg);
      		    }
            }
            })
		}
	});
});
</script>









