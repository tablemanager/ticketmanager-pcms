<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold"><?php echo $title;?></span></h3>
        					
        <div class="row">
            
           	<div class="row">
            <div class="col-md-12">
            	<section class="widget">
		            
		            
		            <div class="widget-body">
		               <form  role="form" id="fform" name="fform" class="form-horizontal" role="form" method="post" action="/order/onemount" >
                            <!-- <div class="form-actions"> -->
                            
                            	<div class="row">
						            <div class="col-md-12">
						                <section class="widget">
						                    <div class="widget-body">
						                        <form role="form">
						                            <div class="row">
						                                <div class="col-md-4">
						                                    <fieldset>
						                                        <legend>
						                                            	판매 채널 선택
						                                        </legend>
						                                        <div class="col-sm-12">
						                                        <div class="checkbox">
						                                            <input id="checkall" type="checkbox" name = "checkall" <?php if($checkall)echo "checked";?>>
						                                            <label for="checkall">
						                                               	전체선택
						                                            </label>
						                                        </div>
						                                        </div>
						                                        <div class="col-sm-6">
						                                        <div class="checkbox">
						                                            <input id="checkA" type="checkbox" class = "chcbx" name = "checkA" <?php if($checkA)echo "checked";?>>
						                                            <label for="checkA">
						                                               	옥션
						                                            </label>
						                                        </div>
						                                        <div class="checkbox">
						                                            <input id="checkG" type="checkbox" class = "chcbx" name = "checkG" <?php if($checkG)echo "checked";?>>
						                                            <label for="checkG">
						                                               	지마켓
						                                            </label>
						                                        </div>
						                                        <div class="checkbox">
						                                            <input id="checkS" type="checkbox" class = "chcbx" name = "checkS" <?php if($checkS)echo "checked";?>>
						                                            <label for="checkS">
						                                               	11번가
						                                            </label>
						                                        </div>
						                                        </div>
						                                        <div class="col-sm-6">
						                                        <div class="checkbox">
						                                            <input id="checkC" type="checkbox" class = "chcbx" name = "checkC"  <?php if($checkC)echo "checked";?>>
						                                            <label for="checkC">
						                                               	쿠팡
						                                            </label>
						                                        </div>
						                                        <div class="checkbox">
						                                            <input id="checkW" type="checkbox" class = "chcbx" name = "checkW" <?php if($checkW)echo "checked";?>>
						                                            <label for="checkW">
						                                               	위메프
						                                            </label>
						                                        </div>
						                                        <div class="checkbox">
						                                            <input id="checkT" type="checkbox" class = "chcbx" name = "checkT" <?php if($checkT)echo "checked";?>>
						                                            <label for="checkT">
						                                               	티켓몬스터
						                                            </label>
						                                        </div>
						                                        </div>
						                                    </fieldset>
						                                </div>
						                                <div class="col-md-4">
						                                    <fieldset>
						                                        <legend>
						                                           	 검색 날짜 선택
						                                        </legend>
						                                        
						                                        <div class="row">
						                                        <div class="form-group">
						                                            <div class="col-sm-4">
						                                                <div class="radio radio-danger">
						                                                    <input type="radio" name="radioDate" id="radioUse" value="use" <?php if($radioDate == "use")echo "checked";?>>
						                                                    <label for="radioUse">
						                                                        	이용일
						                                                    </label>
						                                                </div>
						                                                
						                                            </div>
						                                            <div class="col-sm-4">
						                                                
						                                                <div class="radio radio-danger">
						                                                    <input type="radio" name="radioDate" id="radioBuy" value="buy" <?php if($radioDate == "buy")echo "checked";?>>
						                                                    <label for="radioBuy">
						                                                        	구입일
						                                                    </label>
						                                                </div>
						                                            </div>
						                                        </div>
						                                        <div class="form-group">
									                                    <label class="col-sm-2 control-label" for="max-length">시작일</label>
									                                    <div class="col-sm-8"> 
										                                    <input id="use_sdate" name="use_sdate" type="text" class="form-control datetimepicker1" maxlength="10" value= "<?=$use_sdate?>"/>
										                                </div>
								                                </div>
								                                <div class="form-group">
								                                    <label class="col-sm-2 control-label" for="max-length">종료일</label>
								                                    <div class="col-sm-8"> 
									                                    <input id="use_edate" name="use_edate" type="text" class="form-control datetimepicker1" maxlength="10" value= "<?=$use_edate?>"/>
									                                </div>
								                                </div>
						                                            
						                                            
						                                        </div>
						                                    </fieldset>
						                                </div>
						                                <div class="col-md-4">
						                                    <fieldset>
						                                        <legend>
						                                            	검색어 입력
						                                        </legend>
						                                        <p>
						                                           	<code>쿠폰번호</code> 및 고객 <code>휴대폰 뒷자리 (4자리)</code> 번호를 입력하세요.
						                                        </p>
						                                        <div class="form-group" style="margin-top:25px">
						                                        	<div class="col-sm-12">
							                                        	<input type="search" name="searchtxt" id="searchtxt" maxlength="20"
							                                           class="input-lg form-control"
							                                           placeholder=""
							                                           data-placement="top"
							                                           value="<?=$searchtxt?>">
						                                           </div>
						                                        </div>
						                                        <div class="col-sm-12">
						                                        <div  style="float: right;">
						                                        	<button type="button" id="om_srh" class="btn btn-primary">검 색</button>
						                                       	 	<button type="button" id="cancel_btn" class="btn btn-inverse">취 소</button>
						                                       	</div>
						                                        </div>
						                                </div>
						                                    </fieldset>
						                                </div>
						                                <div class="col-md-12">
							                                <legend>     	
							                                </legend>
						                            	</div>
						                            
						                        </form>
						                    </div>
						                </section>
						            </div>
						        </div>
                        </form> 
		                <div class="mt">
		                    <table id="datatable-table" class="tblCustomers table table-striped table-hover">
		                    <!-- <table id = "tblCustomers" class="table table-striped table-lg mt-lg mb-0"> -->
		                        <thead>
		                        <tr>
		                            <th>등록일</th>
		                            <th>판매채널</th>
		                            <th>상품코드</th>
		                            <th>주문번호</th>
		                            <th>바코드번호</th>
		                            <th>이름</th>
		                            <th>전화번호</th>
		                            <th>상품명</th>
		                            <th>인원</th>
		                            <th>이용기간</th>
		                            <th>원마운트연동</th>
		                            <th>문자발송</th>
		                            <!--  <th>이용내역</th>-->
		                        </tr>
		                        </thead>
		                        <tbody>
		                        
<?
foreach($query->result() as $row):
?>
								<tr class = "table_<?=$row->id?>"> 
		                            <td><?=$row->Created_at?></td>
		                            <td><?=$row->chnm?></td>
		                            <td><?=$row->om_id?></td>
		                            <td>
		                            <a href="#stay_here" class="conf" title="이용확인" barcode="<?=$row->no?>" orid="<?=$row->id?>">
		                            <?=$row->orderno?>
		                            </a>
		                            </td>
		                            <td>
		                            <a href="#stay_here" class="disuse" title="이용확인" barcode="<?=$row->no?>" orid="<?=$row->id?>">
		                            <?=$row->no?>
		                            </a></td>
		                            <td><?=$row->usernm?></td>
		                            <td><?=$row->hp?></td>
		                            <td><?=$row->menu_name?></td>
		                            <td><?=$row->qty?></td>
		                            <td><?=$row->use_sdate."~".$row->use_edate?></td>
		                            <td><?if($row->sync_omount == "Y")echo "성공"; else echo "실패";?></td>
		                            <td><?
		                            if($row->chnm != "쿠팡" && $row->chnm != "위메프" && $row->chnm != "티켓몬스터"){
		                            if($row->mms == "Y")echo "완료"; else echo "대기";}?></td>
		                            <!--  <td><?if($row->state == "Y")echo "사용"; else echo "미사용";?></td>-->
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

	
$(function(){

	$('.conf').click(function(){
		$.ajax({
        url: "<?php echo site_url('/order/ajorder'); ?>",
        data: {orid : $(this).attr('orid') , ojpid : '2615', ojpnm : '원마운트', barcode : $(this).attr('barcode')},
        type:"POST",
        success:function(msg)
        {
        	alert(msg);
        	return false;
        }
        })
	});

	$('.disuse').click(function(){
		if(confirm("쿠폰을 폐기하시겠습니까?")){
			$.ajax({
	        url: "<?php echo site_url('/order/ajdisuse'); ?>",
	        data: {orid : $(this).attr('orid') , ojpid : '2615', ojpnm : '원마운트', barcode : $(this).attr('barcode')},
	        type:"POST",
	        success:function(msg)
	        {
	        	alert(msg);
	        	return false;
	        }
	        })
		}

	});

	$("#checkall").click(function(){ 
		$(".chcbx").prop("checked", $(this).is(":checked"));
	 });

	$(".chcbx").click(function(){ 
		$("#checkall").prop("checked", $('input.chcbx:checked').length == 6);
	 });
	


	$('#om_srh').click(function(){

		

		 //if ($('#ID').is(":checked")){   }
 /*
 
		$('#checkall').is(":checked")
		$('#checkA').is(":checked")
		$('#checkG').is(":checked")
		$('#checkS').is(":checked") 
		$('#checkC').is(":checked")
		$('#checkW').is(":checked")
		$('#checkT').is(":checked")
*/
		if ($('input.chcbx:checked').length == 0){
			alert('채널을 선택해 주세요.');
			return false;
		}

 /*
		var chn = "''";
		if($('#checkall').is(":checked")){
			chn = "ALL";
		}else{
			if($('#checkA').is(":checked")){chn += ",'checkA'";	}
			if($('#checkG').is(":checked")){chn += ",'checkG'";	}
			if($('#checkS').is(":checked")){chn += ",'checkS'";	}
			if($('#checkC').is(":checked")){chn += ",'checkC'";	}
			if($('#checkW').is(":checked")){chn += ",'checkW'";	}
			if($('#checkT').is(":checked")){chn += ",'checkT'";	}
		}
*/
		$('#fform').submit();

	});
});
</script>