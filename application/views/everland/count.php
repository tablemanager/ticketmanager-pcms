<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold">Everland QR 판매/사용 현황 <? if($total != 0)echo $total."건";  ?></span></h3>
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
                    	
                        <form  role="form" id="fform" name="fform" class="form-horizontal" role="form" method="post" action="/everland/ev_ser" >
                            <div class="form-actions">
                                <div class="row">
                                	
                                    <div>
                                    	<label class="control-label col-sm-2" for="mask-date">
			                                        	이용일 검색
	                                    </label>
                                    	<div class="col-sm-2" style="margin-top:5px">
                                    		<input id="sdate" name="sdate" type="text" class="form-control datetimepicker1" value="<?=$sdate?>">
                                    		<span class="help-block">검색 시작 날짜</span>
                                    	</div>
                                    	<div class="col-sm-2" style="margin-top:5px">
                                    		<input id="edate" name="edate"type="text" class="form-control datetimepicker1" value="<?=$edate?>">
                                    		<span class="help-block">검색 끝 날짜 </span>
                                    	</div>
                                    
                                    	<div class="col-sm-4">
		                                    <input type="search" name="searchtxt" id="searchtxt" maxlength="20"
		                                           class="input-lg form-control"
		                                           placeholder="EV코드 5자리 입력"
		                                           data-placement="top"
		                                           value="<?=$searchtxt?>">
		                                </div>
		                                <div class="col-sm-2" style="margin-top:5px">
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
                                    <th>판매처</th>
		                            <th class="no-sort hidden-xs">사용</th>
		                            <th class="hidden-xs">미사용</th>
		                            <th class="hidden-xs">취소</th>
		                            <th class="hidden-xs">총수량</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?
$allUse = 0;
$allUnuse = 0;
$allCancel = 0;
$allSell = 0;                                
foreach($query->result() as $row):
$allUse += $row->use_cnt;
$allUnuse += $row->unuse_cnt;
$allCancel += $row->cancel_cnt;
$allSell += $row->total;
?>

		                        <tr>
		                            <td style="font-size:12px;"><?=$row->ggu?></td>
		                            <td style="font-size:12px;"><?=$row->use_cnt?></td>
		                            <td style="font-size:12px;"><?=$row->unuse_cnt?></td>
		                            <td style="font-size:12px;"><?=$row->cancel_cnt?></td>
		                            <td style="font-size:12px;"><?=$row->total?></td>
		                        </tr>
<?
endforeach;
?>		 
								<tr style="background-color:#FAF4C0;">
		                            <td style="font-size:14px; font-weight: bold;">총 합계</td>
		                            <td style="font-size:14px; font-weight: bold;"><?=$allUse?></td>
		                            <td style="font-size:14px; font-weight: bold;"><?=$allUnuse?></td>
		                            <td style="font-size:14px; font-weight: bold;"><?=$allCancel?></td>
		                            <td style="font-size:14px; font-weight: bold;"><?=$allSell?></td>
		                        </tr>
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

	
$(function(){

	$('#or_srh').click(function(){

		if($('#searchtxt').val() == '' || $('#searchtxt').val() == null)
		{
		  alert('에버랜드 코드를 입력해 주세요.');
		  $('#searchtxt').focus();
		  return false;
		}
		$('#fform').submit();
		
	});

	$('#cancel_btn').click(function(){
		location.href('/everland/count/new');
	});

});
</script>









