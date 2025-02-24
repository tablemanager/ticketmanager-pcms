<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold"><?=$title?></span></h3>
        <div class="row">
			<?
			foreach($inforesult as $key => $info){

			?>
            <div class="col-md-6">

            	<section class="widget">
					<div class="alert alert-warning alert-sm">
						<span class="fw-semi-bold"><?=$key?></span>
					</div>
		            <div class="widget-body">
							<div class="table-responsive">
								<table class="table table-striped table-lg mt-lg mb-0">
									<thead class="no-bd">
									<tr>
										<th>시설</th>
										<th class="no-sort hidden-xs">판매채널</th>
										<th class="hidden-xs">사용 주문</th>
										<th class="hidden-xs">사용 인원</th>
										<th class="hidden-xs">연동확인</th>
										<th class="hidden-xs">확인자</th>
									</tr>
									</thead>

<?
	foreach($info->result() as $row){
		if($row->confirm){
			$bclass = "success";
			$c_log = $row->c_log;
		}else{
			$bclass = "default";
			$c_log = "";
		}
?>
									<tr>
										<td style="font-size:12px;"><?=$row->jpnm." (".$row->grnm.")"?></td>
										<td style="font-size:12px;"><?=$row->chnm?></td>
										<td style="font-size:12px;"><?=$row->order_cnt?></td>
										<td style="font-size:12px;"><?=$row->man1_cnt?></td>
										<td style="font-size:12px;">
											<button class="btn btn-<?=$bclass?> mb-xs use_order" code="<?=$row->id?>" gu="<?=$row->confirm?>" role="button">
												confirm
											</button>
										</td>
										<td style="font-size:12px;"><?php
											if($row->confirm){
												echo $row->c_log." (".$row->c_date.")";
											}
											?></td>
									</tr>
	<?
	}
	?>




								</table>
							</div>

		            </div>
				</div>
				<?
			}
			?>
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

	
$(function(){

	$('.use_order').click(function(){
		var eventV = $(this);
		var code = eventV.attr('code');
		var gu = eventV.attr('gu');

		if(gu == '0' ){
			var setGu = 1;
		}else{
			var setGu = 0;
		}

		$.ajax({
			url: "<?php echo site_url('stats/use_order_chk'); ?>",
			data: {code : code, gu : gu},
			type:"POST",
			success:function(msg)
			{
				if(msg != "err"){
					eventV.removeClass('btn-default');
					eventV.removeClass('btn-success');
					eventV.removeClass('btn-danger');
					eventV.addClass(msg);
					eventV.attr('gu',setGu);
					//eventV.append( msg);
				}
			}
		})


	});
});
</script>









