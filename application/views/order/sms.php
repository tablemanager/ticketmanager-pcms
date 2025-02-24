<div class="content-wrap">
    <main id="content" class="content" role="main">
    	
        <h3 class="page-title"><span class="fw-semi-bold">전송문자조회</span></h3>
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
		                    <span class="fw-semi-bold">2017년 3월</span> 이후의 문자만 검색됩니다. (문자 서버 이전)
		                </div>
                        <form  role="form" id="fform" name="fform" class="form-horizontal" role="form" method="post" action="/order/sms" >
                        	<input type="hidden" name="YM" id="YM"  value="<?=$YM?>">
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
                                        <button type="button" id="or_srh_bf" class="btn btn-warning">이전달 검색</button>
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
            <div class="alert alert-info alert-sm">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                002번 서버 | 대기수량 <?=$qcnt2?> | 마지막 전송시간 <?=$brow2->SEND_TIME?><br/>
                130번 서버 | 대기수량 <?=$qcnt?> | 마지막 전송시간 <?=$brow->SEND_TIME?>
            </div>
           	<div class="row">
 <?php if($viewtable){?>  
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
							<table id="datatable-table" class="table table-striped table-hover">
                            <!--<table class="table table-striped table-lg mt-lg mb-0">-->
                                <thead class="no-bd">
                                <tr>
                                    <th>받는사람</th>
		                            <th class="no-sort hidden-xs">문자내용</th>
		                            <th class="hidden-xs">보낸시간</th>
		                            <th class="hidden-xs">받은시간</th>
		                            <th class="hidden-xs">결과</th>
		                            <th class="hidden-xs">통신사</th>
		                            <th class="hidden-xs">판매처</th>
		                            <?php if($this->session->userdata('cd') == "penfen" || $this->session->userdata('cd') == "jjlee"){ ?>
		                            <th class="hidden-xs">Source</th>
		                            <?php }?>
                                </tr>
                                </thead>
                                <tbody>
                                <?
foreach($query->RESULT() as $row):

?>

		                        <tr>
		                            
		                            <td style="font-size:12px;"><?=$row->DSTADDR?></td>
		                            <td style="font-size:12px;">
		                          
		                            	<button class="btn btn-gray" data-toggle="modal" data-target="#myModal<?=$row->MSEQ?>">
				                                               보기
				                        </button>
				                        <div class="modal fade" id="myModal<?=$row->MSEQ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
				                            <div class="modal-dialog">
				                                <div class="modal-content">
				                                    <div class="modal-header">
				                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                                        <h4 class="modal-title TEXT-align-center fw-bold mt" id="myModalLabel18"><?=$row->SEND_TIME?></h4>
				                                    </div>
				                                    <div class="modal-body bg-gray-lighter">
				                                        <form>
				                                            <div class="row">
				                                                <div class="col-md-12">
				                                                    <pre><?=$row->TEXT?></pre>
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
		                            <td style="font-size:12px;"><?=$row->REQUEST_TIME?></td>
		                            <td style="font-size:12px;"><?=$row->SEND_TIME?></td>
		                            <td style="font-size:12px;"><?=$resultcode[$row->RESULT]?></td>
		                            <td style="font-size:12px;"><?=$row->TELECOM?></td>
		                            <td style="font-size:12px;"><?=$row->OPT_ID?></td>
		                            <?php if($this->session->userdata('cd') == "penfen" || $this->session->userdata('cd') == "jjlee"){ ?>
		                            <td style="font-size:12px;"><?=$row->EXT_COL1?></td>
		                             <?php }?>
		                        </tr>
<?
endforeach;
?>

<?
foreach($query2->RESULT() as $row2):

?>

									<tr>

										<td style="font-size:12px;"><?=$row2->DSTADDR?></td>
										<td style="font-size:12px;">

											<button class="btn btn-gray" data-toggle="modal" data-target="#myModal<?=$row2->MSEQ?>">
												보기
											</button>
											<div class="modal fade" id="myModal<?=$row2->MSEQ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title TEXT-align-center fw-bold mt" id="myModalLabel18"><?=$row2->SEND_TIME?></h4>
														</div>
														<div class="modal-body bg-gray-lighter">
															<form>
																<div class="row">
																	<div class="col-md-12">
																		<pre><?=$row2->TEXT?></pre>
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
										<td style="font-size:12px;"><?=$row2->REQUEST_TIME?></td>
										<td style="font-size:12px;"><?=$row2->SEND_TIME?></td>
										<td style="font-size:12px;"><?=$resultcode[$row2->RESULT]?></td>
										<td style="font-size:12px;"><?=$row2->TELECOM?></td>
										<td style="font-size:12px;"><?=$row2->OPT_ID?></td>
										<?php if($this->session->userdata('cd') == "penfen" || $this->session->userdata('cd') == "jjlee"){ ?>
											<td style="font-size:12px;"><?=$row->EXT_COL1?></td>
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
            </div>
<? } ?>	            
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

<script type="TEXT/javascript">
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
	$('#or_srh_bf').click(function(){
		//alert('<?=$YM?>');
		var nYM = '<?php echo date("Ym",strtotime ("-1 months",  strtotime($YM."01")));?>';
		//alert(nYM);
		$('#YM').val(nYM);
		$('#or_srh').click();
	});
	$('#cancel_btn').click(function(){
		$(location).attr('href', '/order/sms/new');
		//alert();//location.href('/order/sms/new');
	});
});
</script>









