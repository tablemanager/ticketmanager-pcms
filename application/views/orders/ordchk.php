<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold">주문 관리 <? if($total != 0)echo $total."건";  ?></span></h3>
        <div class="row">
            <div class="col-md-12">
            	<section class="widget">
                    <header>
		                <div class="widget-controls">
		                    <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a>
		                    <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a>
		                    <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>
		                </div>
		            </header>
                    <div class="widget-body"> <!-- 상단 검색바 시작  -->
                    	<div class="alert alert-success alert-sm">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                    <span class="fw-semi-bold">이용기간</span>내의 주문만 검색됩니다.
		                </div>
                        <form  role="form" id="fform" name="fform" class="form-horizontal" role="form" method="post" action="/order/ordser" >
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-offset-3 col-sm-7">
                                    	<div class="col-sm-8">
		                                    <input type="search" name="searchtxt" id="searchtxt" maxlength="20"
		                                           class="input-lg form-control"
		                                           placeholder="주문번호,바코드,이름,전화번호(뒷자리4)"
		                                           data-placement="top"
		                                           value="<?=$searchtxt?>">
		                                </div>
		                                <div style="margin-top:5px">
                                        <button type="button" id="or_srh" class="btn btn-primary">검 색</button>
                                        <button type="button" id="cancel_btn" class="btn btn-inverse">취 소</button>
                                        </div>
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
 <?php if($viewtable){?>              
            	<section class="widget">
		            <header>
		                <div class="widget-controls">
		                    <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a>
		                    <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a>
		                    <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>
		                </div>
		            </header>  
		            <div class="widget-body">
   						<div class="alert alert-info alert-sm">
		                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                    <span class="fw-semi-bold">Info:</span> 주문번호에 마우스를 가져가면 <span class="fw-semi-bold">바코드번호</span>를 볼수 있습니다.
		                </div>
		            	<div class="table-responsive">
                            <table class="table table-striped table-lg mt-lg mb-0">
                                <thead class="no-bd">
                                <tr>
                                    <th>등록일</th>
		                            <th class="no-sort hidden-xs">주문번호</th>
		                            <th class="hidden-xs">바코드</th>
		                            <th class="hidden-xs">이름</th>
		                            <th class="hidden-xs">HP</th>
		                            <!-- <th class="hidden-xs">업체</th> -->
		                            <th class="hidden-xs">시설</th>
		                            <!-- <th class="hidden-xs">PCMS코드</th> -->
		                            <th class="hidden-xs">상품명</th>
		                            <th class="hidden-xs">판매처</th>
		                            <th class="hidden-xs">사용</th>
		                            <!-- <th class="hidden-xs">이용일</th> -->
		                            <!-- <th class="hidden-xs">대인</th>
		                            <th class="hidden-xs">소인</th> -->
		                            <th class="hidden-xs">예약</th>
		                            <th class="hidden-xs">취소일</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?
foreach($query->result() as $row):

?>

		                        <tr>
		                            <td style="font-size:12px;"><?=$row->Created_at?></td>
		                            <td>
		                            <!-- 
			                            <a href="#" class="conf btn btn-default" data-toggle="tooltip" data-placement="right"
			                               title="<?=$row->barcode_no.' / 대인:'.$row->man1.' / 소인:'.$row->man2?>" barcode="<?=$row->barcode_no?>" ojpid="<?=$row->jpmt_id?>" ojpnm="<?=$row->jpnm?>"orid="<?=$row->id?>"><?=$row->orderno?>
			                            </a>
			                        -->
			                        <?php 
			                        //버튼을 표시할것인가
			                        	$btnshow = false;
			                        if($row->jpmt_id == "398" || $row->jpmt_id == "2633" || $row->jpmt_id == "2615"){
			                        	$btnshow = true;
			                        ?>
			                            <a href="#" class="conf btn btn-default" data-toggle="tooltip" data-placement="top"
			                               title="이용확인" barcode="<?=$row->barcode_no?>" ojpid="<?=$row->jpmt_id?>" ojpnm="<?=$row->jpnm?>"orid="<?=$row->id?>">
			                        <?php }?>
			                            <?=$row->orderno?>
			                        <?php if($btnshow)echo "</a>";?>
		                            </td>
		                            <td class="hidden-xs">
		                            <?php
		                            $bartext = str_replace(";","</br>",$row->barcode_no);
		                            if($btnshow){
		                            ?>
		                            	<a href="#" class="disuse btn btn-default" data-toggle="tooltip" data-placement="top"
		                            			title="쿠폰폐기" barcode="<?=$row->barcode_no?>" ojpid="<?=$row->jpmt_id?>" ojpnm="<?=$row->jpnm?>"orid="<?=$row->id?>">
		                            <?php 
		                            }
		                            	echo $bartext;
		                           if($btnshow)echo "</a>";
		                            ?></td>
		                            <td class="hidden-xs" style="font-size:12px;"><?=$row->usernm?></td>
		                            <td class="hidden-xs" style="font-size:12px;"><?=$row->dhp?></td>
		                            <!-- <td class="hidden-xs"><?=$row->grnm?></td> -->
		                            <td class="hidden-xs" style="font-size:12px;"><?=$row->jpnm?></td>
		                            <!-- <td class="hidden-xs"><?=$row->itemmt_id?></td> -->
		                            <td class="hidden-xs">
			                            <span style="font-size:12px;" data-toggle="tooltip" data-placement="right" title="PCMS:<?=$row->itemmt_id?>"><?=$row->itemnm?></span>
		                            </td>
		                            <td class="hidden-xs" style="font-size:12px;"><?=$row->chnm?></td>
		                            <td class="hidden-xs" style="font-size:12px;">

									<div class="btn-group">
		                                <button class="btn btn-default" id="use_<?=$row->id?>" data-original-title="" title="">
		                                <?
if($row->usegu == '1'){
	echo "사용";
}else if($row->usegu == '2'){
	echo "미사용";
}else{
	echo $row->usegu;
}
		                            ?>
		                                </button>
		                                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" data-original-title="" title="">
		                                    <i class="fa fa-caret-down"></i>
		                                </button>
		                                <ul class="dropdown-menu">
		                                    <li><a class="y_btn" code="<?=$row->id?>" href="#">사용</a></li>
		                                    <!-- <li class="divider"></li> -->
		                                    <li><a class="n_btn" code="<?=$row->id?>" href="#">미사용</a></li>
		                                </ul>
		                            </div>


		                            </td>
		                            <!-- <td class="hidden-xs" style="font-size:12px;"><?=$row->usedate?></td> -->
		                            <!-- <td class="hidden-xs"><?=$row->man1?></td>
		                            <td class="hidden-xs"><?=$row->man2?></td> -->
		                            <td class="hidden-xs" style="font-size:12px;"><?=$row->state?></td>
		                            <td class="hidden-xs" style="font-size:12px;">
		                            <? if($row->state == "취소"){
		                            	echo $row->canceldate;
		                            }else{
		                            	if($row->jpmt_id == "398"){
		                            ?>
		                            	<div class="btn-toolbar">
                                            <button class="btn btn-sm btn-danger pull-right" type="button">취소</button>
                                        </div>
                                    <? 
		                            	}
		                            } ?>
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
<? } ?>			        
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
	if(use_state == "1"){
		use_text = "사용";
	}else if(use_state == "2"){
		use_text = "미사용";
	}else{
		return false;
	}
	if(confirm(use_text+" 상태로 변경하시겠습니까?")){
        $.ajax({
        url: "<?php echo site_url('order/or_use'); ?>",
        data: {code : code , usegu : use_state},
        type:"POST",
        success:function(msg)
        {
          $(location).attr('href',msg);
		    if (msg == "err"){
		    	alert("변경에 실패하였습니다.");
		    	$(location).attr('href','/order/ordchk');
		    }else if(msg == "ok"){
		    	$('#use_'+code).text(use_text);
		    	alert("변경되었습니다.");
		    	$(location).attr('href','/order/ordchk');
		    }
        }
        })
	}
}
	
$(function(){

	$('.y_btn').click(function(){
		//alert("사용버튼");
		var code = $(this).attr('code');
		usestate(code,"1");
	});	

	$('.n_btn').click(function(){
		//alert("정지버튼");
		var code = $(this).attr('code');
		usestate(code,"2");
	});	

	$('#or_srh').click(function(){

		if($('#searchtxt').val() == '' || $('#searchtxt').val() == null)
		{
		  alert('검색어를 입력해 주세요.');
		  $('#searchtxt').focus();
		  return false;
		}
		$('#fform').submit();
		
	});

	$('#cancel_btn').click(function(){
		location.href('/order/ordchk/new');
	});

	$('.conf').click(function(){
		$.ajax({
        url: "<?php echo site_url('/order/ajorder'); ?>",
        data: {orid : $(this).attr('orid') , ojpid : $(this).attr('ojpid'), ojpnm : $(this).attr('ojpnm'), barcode : $(this).attr('barcode')},
        type:"POST",
        success:function(msg)
        {
        	//var res = msg.split("|"); 
        	//alert(res[1]);
        	alert(msg);
        }
        })

	});

	$('.disuse').click(function(){
		if(confirm($(this).attr('ojpnm')+"의 쿠폰을 폐기하시겠습니까?")){
			$.ajax({
	        url: "<?php echo site_url('/order/ajdisuse'); ?>",
	        data: {orid : $(this).attr('orid') , ojpid : $(this).attr('ojpid'), ojpnm : $(this).attr('ojpnm'), barcode : $(this).attr('barcode')},
	        type:"POST",
	        success:function(msg)
	        {
	        	//var res = msg.split("|"); 
	        	//alert(res[1]);
	        	alert(msg);
	        }
	        })
		}

	});
});
</script>









