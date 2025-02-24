<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold">주문조회(베타)</span></h3>
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
		                    <span class="fw-semi-bold">1. 공지사항 어쩌고 저쩌고
		                </div>
                        <form  role="form" id="fform" name="fform" class="form-horizontal" role="form" method="post" action="/order/sms" >
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-offset-3 col-sm-7">
                                    	<div class="col-sm-8">
		                                    <input type="search" name="searchtxt" id="searchtxt" maxlength="20"
		                                           class="input-lg form-control"
		                                           placeholder="전화번호(뒷자리4)"
		                                           data-placement="top"
		                                           value="<?=$searchtxt?>">
		                                </div>
		                                <div style="margin-top:5px">
                                        <button type="button" id="or_srh" class="btn btn-primary">검 색</button>
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
                                    <th>보낸사람</th>
		                            <th class="no-sort hidden-xs">받는사람</th>
		                            <th class="hidden-xs">문자내용</th>
		                            <th class="hidden-xs">보낸시간</th>
		                            <th class="hidden-xs">받은시간</th>
		                            <th class="hidden-xs">통신사</th>
		                            <th class="hidden-xs">판매처</th>
		                            <?php if($this->session->userdata('cd') == "penfen" || $this->session->userdata('cd') == "jjlee"){ ?>
		                            <th class="hidden-xs">Source</th>
		                            <?php }?>
                                </tr>
                                </thead>
                                <tbody>
                                <?
foreach($query->result() as $row):

?>

		                        <tr>
		                            <td style="font-size:12px;"><?=$row->callback?></td>
		                            <td style="font-size:12px;"><?=$row->dstaddr?></td>
		                            <td style="font-size:12px;">
		                          
		                            	<button class="btn btn-gray" data-toggle="modal" data-target="#myModal<?=$row->mseq?>">
				                                               보기
				                        </button>
				                        <div class="modal fade" id="myModal<?=$row->mseq?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
				                            <div class="modal-dialog">
				                                <div class="modal-content">
				                                    <div class="modal-header">
				                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                                        <h4 class="modal-title text-align-center fw-bold mt" id="myModalLabel18"><?=$row->send_time?></h4>
				                                    </div>
				                                    <div class="modal-body bg-gray-lighter">
				                                        <form>
				                                            <div class="row">
				                                                <div class="col-md-12">
				                                                    <pre><?=$row->text?></pre>
				                                                </div>
				                                            </div>
				                                        </form>
				                                    </div>
				                                    <div class="modal-footer">
				                                        <button type="button" class="btn btn-gray" data-dismiss="modal">Close</button>
				                                    </div>
				                                </div>
				                            </div>
				                        </div>
		                            </td>
		                            <td style="font-size:12px;"><?=$row->request_time?></td>
		                            <td style="font-size:12px;"><?=$row->send_time?></td>
		                            <td style="font-size:12px;"><?=$row->telecom?></td>
		                            <td style="font-size:12px;"><?=$row->opt_id?></td>
		                            <?php if($this->session->userdata('cd') == "penfen" || $this->session->userdata('cd') == "jjlee"){ ?>
		                            <td style="font-size:12px;"><?=$row->ext_col1?></td>
		                             <?php }?>
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
	
$(function(){
	$('#or_srh').click(function(){

		if($('#searchtxt').val() == '' || $('#searchtxt').val() == null)
		{
		  alert('전화번호(뒷자리4)를 입력해 주세요.');
		  $('#searchtxt').focus();
		  return false;
		}
		$('#fform').submit();
	});
	$('#cancel_btn').click(function(){
		location.href('/order/sms/new');
	});
});
</script>









