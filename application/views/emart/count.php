<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold">이마트 차수별 사용 현황(실시간)</span></h3>
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
		            <div class="widget-body">
   						
		            	<div class="table-responsive">
                            <table class="table table-striped table-lg mt-lg mb-0">
                                <thead class="no-bd">
                                <tr>
                                    <th>판매차수</th>
		                            <th class="no-sort hidden-xs">분류</th>
		                            <th class="hidden-xs">판매채널</th>
		                            <th class="hidden-xs">PCMS</th>
		                            <th class="hidden-xs">판매기간</th>
		                            <th class="hidden-xs">사용수량</th>
		                            <th class="hidden-xs">미사용수량</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?
foreach($query->result() as $row):

?>

		                        <tr>
		                            <td style="font-size:12px;"><?=$row->aaa?>차</td>
		                            <td style="font-size:12px;"><?=$row->bbb?></td>
		                            <td style="font-size:12px;"><?=$row->ccc?></td>
		                            <td style="font-size:12px;"><?=$row->ddd?></td>
		                            <td style="font-size:12px;"><?=$row->eee?></td>
		                            <td style="font-size:12px;"><?=$row->fff?></td>
		                            <td style="font-size:12px;"><?=$row->hhh?></td>
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









