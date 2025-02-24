<main id="content" class="content" role="main" style="background: rgba(200, 200, 210, 0.25); !important;">
	<div class="row">


		<div class="col-md-6">
			<section class="widget">
				<div class="widget-body" >

					<form  role="form" id="fform" name="fform" class="form-horizontal" role="form" method="post" action="/c/s" >
						<fieldset>
							<div class="form-group">
								<div class="col-sm-5">
									<input type="text" name="cusnm" id="cusnm" maxlength="20"
										   class="form-control"
										   placeholder="이름"
										   data-placement="top"
										   value="">
									<span class="help-block">
											<code>이름</code>이나 <code>휴대폰</code> 둘중 하나만 검색해주세요.
									</span>
								</div>
								<div class="col-sm-5">
									<input type="text" name="userhp" id="userhp" maxlength="20"
										   class="form-control"
										   placeholder="휴대폰"
										   data-placement="top"
										   value="">

								</div>
								<div class="col-sm-2">
									<div>
										<button type="button" id="or_srh" class="btn btn-block btn-primary">검 색</button>
									</div>
								</div>

								<div class="col-md-2" style="display: none">
									<button type="button" id="cancel_btn" class="btn btn-block btn-danger">처음으로</button>
								</div>
							</div>
						</fieldset>
					</form>

				</div>
			</section>

		</div>

		<div class="col-md-6">
			<section class="widget">
				<div class="widget-body" >
					<h1 class="page-title" ></h1>
					<div class="progress progress-sm mt">
						<div class="progress-bar progress-bar-warning"></div>
					</div>
				</div>
			</section>
		</div>


		<div class="col-md-11" style="margin-top: 0px">
		<?php
		$ip = $_SERVER["REMOTE_ADDR"];
			if($pag_links != null){
				echo $pag_links;
			}
			?>
			<div class="paging_bootstrap">
				<ul class="pagination">
					<li><a href="http://pcms.placem.co.kr/index.php/c/s">처음으로</a></li>
					<li><a href="http://pcms.placem.co.kr/index.php/c/s/T">입금확인중</a></li>
					<li><a href="http://pcms.placem.co.kr/index.php/c/s/U">무통장 입금확인중</a></li>
					<li><a href="http://pcms.placem.co.kr/index.php/c/s/calls">통화불능 리스트</a></li>
					<li><a href="http://pcms.placem.co.kr/index.php/c/s/chk">이슈발생 주문리스트</a></li>
					<li><a href="http://pcms.placem.co.kr/index.php/c/s/oks">입금확인완료 주문리스트</a></li>
				</ul>
			</div>

		</div>
		<div class="col-md-1" style="margin-top: 0px">
			<button type="button" id="excel_btn" class="btn btn-block btn-success" >엑셀 다운</button>
			<button type="button" id="excel_btn_ok" class="btn btn-block btn-success" >엑셀 다운(확인완료)</button>
			<button type="button" id="excel_btn_all" class="btn btn-block btn-danger" >엑셀 다운(전체)</button>
		</div>




		<?
		foreach($query->result() as $row):

		?>

		<div class="col-md-6">
			<?php
			if($row->state == 'T'){
				$background_color= "lightcyan";
			}else if($row->state == 'S' || $row->state == 'O' || $row->state == 'G'){
				$background_color= "lemonchiffon";
			}else{
				$background_color= "white";
			}
			?>
			<section class="widget widget_section_<?=$row->id?>" style="background-color: <?=$background_color?>">

				<div class="widget-body" >

					<div class="table-responsive" style="margin-top: -40px">
						<table class="table table-striped table-lg mt-lg mb-0">
							<thead class="no-bd">

							<tr style="font-size: 20px">
								<th><?=$row->id?></th>
								<th><?php
									$cushp = preg_replace("/(0(?:2|[0-9]{2}))([0-9]+)([0-9]{4}$)/", "\\1-\\2-\\3", $row->cushp);
									?>
									<?=$cushp?>
								</th>
								<th colspan="3">
									<?=number_format($row->price)?>원 (<?=number_format($row->rprice)?>)
								</th>
								<th>
									<span style="font-size: 12px; color: red"><?php if($row->gift != 0){echo "기프티콘 {$row->gift}차 발송완료</br>";}?></span>
									<?
									echo form_dropdown('state'.$row->id, $statearr, $row->state , 'class="state"  code='.$row->id);
									?>

								</th>
							</tr>

							<tr style="background-color: white; !important;">
								<th class="no-sort hidden-xs">이름</th>
								<th class="hidden-xs">시설</th>
								<th class="hidden-xs">구매일</th>
								<th class="hidden-xs">이용일</th>
								<th class="hidden-xs">가격</th>
								<th class="hidden-xs">차수</th>

							</tr>
							</thead>
							<tbody>

							<?php
//							$show = "hide";
							$pay_type_arr = array("신용카드","실시간계좌이체","신용카드간편결제","포인트결제"); //and pay_type in ({$pay_type_arr_q})
							$pay_type_arr_q = implode ($pay_type_arr,"','");

							$sql = "SELECT * FROM cmsdb.refund_order_c where cushp = '{$row->cushp}' and pay_type in ('{$pay_type_arr_q}')";
							$sql = "SELECT * FROM cmsdb.refund_order_c where cushp = '{$row->cushp}' ";
							$qry = $rds->query($sql);
							foreach($qry->result() as $rw):

								?>
							<tr style="background-color: white; !important;">
								<td style="font-size:12px;"><?=$rw->cusnm?></td>
								<td style="font-size:12px;"><?=$rw->biznm?></td>
								<td style="font-size:12px;"><?=$rw->buydate?></td>
								<td style="font-size:12px;"><?=$rw->usedate?></td>
								<td style="font-size:12px;"><?=number_format($rw->price)?>원 </td>
								<td style="font-size:12px;">
                                    <?=($rw->orders == "20190804"?"1차":"2차")?>
                                </td>
							</tr>
							<?
								if (in_array($rw->pay_type, $pay_type_arr)) {
//									$show = "show";
								}
								$show = "show";
							endforeach;
?>
							<script>

								var show = '<?=$show?>';
								var sid = '<?=$row->id?>';
								var state = '<?=$row->state?>';
								if(show == "hide" ){ //|| state == "S"
									$('.widget_section_'+sid).hide();
								}
							</script>
							<tr >
								<td colspan="6" class="memo<?=$row->id?>" style="font-size: 11px; background-color: white; !important;">
								<?=$row->memo?>
								</td>
							</tr>
							<tr>
								<td colspan="5">
									<textarea rows="3" class="form-control textarea_value text<?=$row->id?>" id="default-textarea"></textarea>
								</td>
								<td >
									<button type="button" class="btn btn-primary memo_btn" code="<?=$row->id?>">메모 등록</button>
									<?php
									if($row->calls){$aflg="use";}else{$aflg="unuse";}?>
									<a class="ubtn chk <?=$aflg?>" id="chk_<?=$row->id?>" code="<?=$row->id?>" gu="calls">통화불능</a>
									<?php
									if($row->chk){$aflg="use";}else{$aflg="unuse";}?>
									<a class="ubtn chk <?=$aflg?>" id="chk_<?=$row->id?>" code="<?=$row->id?>" gu="chk">이슈발생주문</a>
								</td>
							</tr>
							<tr>
								<td colspan="5">
									<textarea rows="1" class="form-control textarea_value sms<?=$row->id?>" id="default-textarea" ></textarea>
								</td>
								<td >
									<button type="button" class="btn btn-warning sms_btn"   tp="1" tel="<?=$row->cushp?>"  code="<?=$row->id?>">문자1</button>
									<button type="button" class="btn btn-warning sms_btn" tp="2" tel="<?=$row->cushp?>" code="<?=$row->id?>">문자2</button>
									<button type="button" class="btn btn-warning sms_btn" tp="3" tel="<?=$row->cushp?>" code="<?=$row->id?>">문자3</button>
									<br/>
									<input type="tel" class="hp<?=$row->id?>" value="<?=$row->cushp?>" style="margin-top: 10px">
									<button type="button" class="btn btn-success sms_send" code="<?=$row->id?>">문자발송</button>
								</td>
							</tr>
							</tbody>


						</table>

					</div>
				</div>

			</section>

		</div>

			<?php
		endforeach;
		?>


	</div>

</main>

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

	$('#excel_btn').click(function(){

		var excelurl = '<?php echo site_url('c/s_p'); ?>';
		window.location.assign(excelurl);
	});


	$('#excel_btn_all').click(function(){

		var excelurl = '<?php echo site_url('c/s_a'); ?>';
		window.location.assign(excelurl);
	});
	$('#excel_btn_ok').click(function(){

		var excelurl = '<?php echo site_url('c/s_a/ok'); ?>';
		window.location.assign(excelurl);
	});

	$(".sms_send").click(function() {

		var ubtn = $(this);

		var code = ubtn.attr('code');
		var hp = $(".hp"+code).val();
		var text = $(".sms"+code).val();

		if(confirm(hp+"님에게 아래내용으로 문자를 보내시겠습니까?\r\n==============================\r\n"+text)){
			$.ajax({
				url: "<?php echo site_url('c/send_sms'); ?>",
				data: {hp : hp, text:text},
				type:"POST",
				success:function(msg)
				{
					if(msg == "200"){
						alert("전송완료");
						$(".sms"+code).val("");
						$(".sms"+code).css('height', '50px' );
					}else{
						alert(msg);
					}
				}
			})
		}
	});

	$(".sms_btn").click(function() {

		var ubtn = $(this);

		var code = ubtn.attr('code');
		var tp = ubtn.attr('tp');
		var tel = ubtn.attr('tel');
		var text = "text";

		$.ajax({
			url: "<?php echo site_url('c/get_sms_type'); ?>",
			data: {type : tp , tel : tel},
			type:"POST",
			success:function(msg)
			{
				$(".sms"+code).val(msg);
				$(".sms"+code).css('height', '500px' );
			}
		})


	});


	$(".ubtn").click(function() {

		var ubtn = $(this);

		var code = ubtn.attr('code');
		var gu = ubtn.attr('gu');

		if($(this).hasClass('use')){
			var mode = 0;
			var removeC = 'use';
			var addC = 'unuse';
		}else{
			var mode = 1;
			var removeC = 'unuse';
			var addC = 'use';
		}

		$.ajax({
			url: "<?php echo site_url('c/s_chk'); ?>",
			data: {code : code, gu:gu, mode:mode},
			type:"POST",
			success:function(msg)
			{
				if(msg == "ok"){
					ubtn.removeClass(removeC);
					ubtn.addClass(addC);
				}else{
					alert("변경 실패");
				}
			}
		})
	});

	$('#cancel_btn').click(function(){
		$(location).attr('href','/c/s');
	});

	$('#or_srh').click(function(){
		$('#fform').submit();
	});

	$('.state').change(function(){
		var eventV = $(this);
		var code = eventV.attr('code');
		var gu = eventV.val();

		//alert(code);
		//alert(gu);

		$.ajax({
			url: "<?php echo site_url('c/s_mode'); ?>",
			data: {code : code, gu : gu},
			type:"POST",
			success:function(msg)
			{
				if(msg != "err"){
					alert("변경 완료");
					eventV.find(":selected").css('color','red');
				}
			}
		})
	});

	$('.memo_btn').click(function(){
		var eventV = $(this);
		var code = eventV.attr('code');

		var nmemo = $('.text'+code).val();

		$.ajax({
			url: "<?php echo site_url('c/s_memo'); ?>",
			data: {code : code, nmemo : nmemo},
			type:"POST",
			success:function(msg)
			{
				if(msg != "err"){
					$('.memo'+code).html(msg);
					$('.text'+code).val('');
				}
			}
		})
	});



});
</script>









