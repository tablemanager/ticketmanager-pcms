<?php
/**
 * Created by 
 * User: Cindy
 * Date: 2018-04-04
 */
?>

<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold"><?php echo $title;?></span></h3>
        <div class="row">
            <div class="col-md-8">

                <section class="widget">
                    <div class="widget-body">
                        <form  role="form" id="insertform" name="insertform" class="form-horizontal" role="form" method="post" action="">

                        <fieldset>
                            <div class="row">
								<div class="col-sm-12">
									<div  class="form-group">
										<label class="col-sm-4 control-label" for="max-length" style="text-align: right">코  드</label>
										<div class="col-sm-4">
											<form id="code_form" name="code_form" method="post" action="/b2b/codesett">
												<input type="text" name="ITEM_CODE" id="ITEM_CODE"
													   class="form-control"
													   placeholder="코드를 입력해주세요."
													   data-placement="top">
											</form>
											<input type="hidden" id="codechk" name="codechk">
										</div>
									</div>
								</div>

								<div class="col-sm-12">
	                                <div class="form-group">
										<label class="col-sm-4 control-label" for="company_select" style="text-align: right">구  분</label>
										<div class="col-sm-4" >
											<select id="sort"
													class="select1 form-control"
													tabindex="-1"
													name="sort">
												<option value="">- 선택 -</option>
												<option value="EL">에버랜드</option>
												<option value="CB">캐리비안베이</option>
											</select>
										</div>
									</div>
								</div>

								<div class="col-sm-12">
									<div  class="form-group">
										<label class="col-sm-4 control-label" for="max-length" style="text-align: right">국  가</label>
										<div class="col-sm-4">
											<input type="text" name="nation" id="nation"
												   class="form-control"
												   placeholder="국가를 입력해주세요."
												   data-placement="top">
										</div>
									</div>
								</div>

								<div class="col-sm-12">
									<div class="form-group">

										<label class="col-sm-4 control-label" for="max-length" style="text-align: right">유효기간</label>

										<div class="col-sm-2">
											<input type="date" name="sdate" id="sdate" maxlength="20"
												   class="form-control"
												   data-placement="top"
												   value="">
										</div>
										<div class="col-sm-2">
											<input type="date" name="edate" id="edate" maxlength="20"
												   class="form-control"
												   data-placement="top"
												   value="">
										</div>

									</div>
								</div>

								<div class="col-sm-12">

									<div class="col-sm-offset-5 col-sm-4" >
										<button class="button_base b01_simple_rollover" id="insert_btn" style="width: 100%">등 록</button>
									</div>
								</div>
							</div>
                        </fieldset>

						</form>
                    </div>
                </section>
            </div>

			<div class="col-md-4">
                <section class="widget">
                    <div class="widget-body">
						<fieldset>
                            <div class="row">
								<div class="col-sm-12">
									<div class="form-group" style="margin-top: 73px">
										<label class="col-sm-2 control-label" for="max-length" style="text-align: right; margin-top: 5px">기간</label>
										<div class="col-sm-5">
											<input type="date" name="excelsdate" id="excelsdate" maxlength="20"
												   class="form-control"
												   data-placement="top"
												   value="">
										</div>

										<div class="col-sm-5">
											<input type="date" name="exceledate" id="exceledate" maxlength="20"
												   class="form-control"
												   data-placement="top"
												   value="">
										</div>
									</div>
								</div>

								<div class="col-sm-12" style="margin-top: 20px; margin-bottom: 74px">
									<div class="col-sm-offset-2 col-sm-5">
										<button class="btn btn-default btn-lg btn-block exceldown" code="sell">판매 정보 다운로드</button>
									</div>
                                    <div class="col-sm-5">
                                        <button class="btn btn-primary btn-lg btn-block exceldown" code="use">사용 정보 다운로드</button>
                                    </div>
								</div>
							</div>
						</fieldset>
					</div>
				</section>
			</div>

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
                            <table class="table table-hover table-lg mt-lg mb-0">
                                <thead class="no-bd">
									<div style="height:40px; background-color: #ECF3F5">
										<div class="col-md-1">
											<form id="num_form" name="num_form" method="post" action="/b2b/evcode_limit" style="margin-top: 5px">
												<select style="height:27px; width:80px;" id="limit" name="limit">
													<option value="">- 선택 -</option>
													<option value="10" <?php echo ($limit == '10') ? 'selected' : ''; ?>>10개씩</option>
													<option value="20" <?php echo ($limit == '20') ? 'selected' : ''; ?>>20개씩</option>
													<option value="30" <?php echo ($limit == '30') ? 'selected' : ''; ?>>30개씩</option>
													<option value="50" <?php echo ($limit == '50') ? 'selected' : ''; ?>>50개씩</option>
													<option value="100" <?php echo ($limit == '100') ? 'selected' : ''; ?>>100개씩</option>
												</select>
											</form>
										</div>

										<form id="csearch" name="csearch" method="post" action="/b2b/code_sel">
											<input type="text" style="width:70px" id="searchcode" name="searchcode" maxlength="5" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" 
											onkeyPress="if((event.keyCode<48) || (event.keyCode>57)) event.returnValue=false;" value="<?=$searchcode?>" placeholder=" 코드검색">
										</form>
										
										<button type="button" id="reset_btn" name="reset_btn" class="button button5"><i class="glyphicon glyphicon-remove"></i></button>
									</div>
									
									<tr>
										<th class="hidden-xs">코드</th>
										<th class="hidden-xs">구분</th>
										<th class="hidden-xs">국가분류</th>
										<th class="hidden-xs">유효기간 시작일</th>
										<th class="hidden-xs">유효기간 종료일</th>
										<th class="hidden-xs">사용/미사용</th>
									</tr>
								</thead>
								<tbody>
								<?
								foreach($query->result() as $row):
								?>
									<tr>
									<td class="hidden-xs" style="font-size:12px;"><?=$row->ITEM_CODE?></td>
									<td class="hidden-xs" style="font-size:12px; display:none"><?=$row->id?></td>
									<td class="hidden-xs" style="font-size:12px;"><?php if($row->sort=='EL'){echo "에버랜드";}else if($row->sort=='CB'){echo "캐리비안베이";}?></td>
									<td class="hidden-xs" style="font-size:12px;"><?=$row->nation?></td>
									<td class="hidden-xs" style="font-size:12px;"><?=$row->sdate?></td>
									<td class="hidden-xs" style="font-size:12px;"><?=$row->edate?></td>
									<td class="useyn<?=$row->id?> hidden-xs" style="font-size:12px;" name="useyn">
										<div class="btn-group">
											<button class="use_<?=$row->id?> btn btn-default" id="use_<?=$row->id?>" data-original-title="" title="">
												<?
												if($row->useyn == 'Y'){
													echo "사용 ";
												}else if($row->useyn == 'N'){
													echo "미사용";
												}else{
													echo $row->useyn;
												}
												?>
											</button>
											<button class="btn btn-default dropdown-toggle" data-toggle="dropdown" data-original-title="" title="">
												<i class="fa fa-caret-down"></i>
											</button>
											<ul class="dropdown-menu">
												<li><a class="y_btn" code="<?=$row->id?>">사용</a></li>
												<li><a class="n_btn" code="<?=$row->id?>">미사용</a></li>
											</ul>
										</div>
									</td>
									</tr>
								<?
									endforeach;
								?>
								</tbody>
							</table>
							<?php echo $pag_links; ?>
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

<script src="/vendor/select2/select2.min.js"></script>

<!-- page specific js -->
<script src="/js/form-elements.js"></script>
<script src="/js/tables-dynamic.js"></script>

<script type="text/javascript">
</script>

<style>
.button_base {
    margin: 0;
    border: 0;
    font-size: 13px;
    position: relative;
    top: 50%;
    left: 2%;
    margin-top: -25px;
    margin-left: -100px;
    width: 323px;
    height: 40px;
    text-align: center;
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-user-select: none;
    cursor: default;
}

.button_base1 {
    margin: 0;
    border: 0;
    font-size: 13px;
    position: relative;
    top: 50%;
    left: -57%;
    margin-top: 20px;
    margin-bottom: 60px;
    margin-left: -100px;
    width: 170px;
    height: 40px;
    text-align: center;
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-user-select: none;
    cursor: default;
}

.b01_simple_rollover {
    color: #ffffff;
/*    border: #000000 solid 1px;*/
    padding: 10px;
    background-color: #809EA9;
}

.b01_simple_rollover:hover {
    color: #ffffff;
    background-color: #000000;
}

.button {
    background-color: #809EA9;
    border: none;
    color: white;
    padding: 2px 8px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
}

.button5:hover {
    background-color: #555555;
    color: white;
}

.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
  background-color: #ECF3F5;
}
</style>

<script type="text/javascript">

	function usestate(code,useyn){
        var use_text = "";
        if(useyn == "Y"){
            use_text = "사용";
        }else if(useyn == "N"){
            use_text = "미사용";
        }else{
            return false;
        }
        if(confirm(use_text+" 상태로 변경하시겠습니까?")){
            $.ajax({
                url: "<?php echo site_url('/b2b/yesORno'); ?>",
                data: {code : code , useyn : useyn},
                type:"POST",
                success:function(msg)
                {
                    if (msg == "err"){
                        alert("변경에 실패하였습니다.");
                        $(location).attr('href','/b2b/evcode');
                    }else if(msg == "ok"){
                        $('.use_'+code).text(use_text);
                        alert("변경되었습니다.");
                  }
                }
            })
		
		}
	}

	$(function(){



        $('.exceldown').click(function(){
            var code = $(this).attr('code');
            var excelsdate = $('#excelsdate');


            if(excelsdate.val() == '' || excelsdate.val() == null )
            {
                alert('다운로드 시작일을 입력해 주세요.');
                excelsdate.focus();
                return false;
            }
            var exceledate = $('#exceledate');
            if(exceledate.val() == '' || exceledate.val() == null )
            {
                alert('다운로드 종료일을 입력해 주세요.');
                exceledate.focus();
                return false;
            }

            if(confirm(excelsdate.val()+"~"+exceledate.val()+"다운로드 하시겠습니까?")){

                var excelurl = '<?php echo site_url('b2b/evcode_exceldown'); ?>'+"/"+code+"/"+excelsdate.val()+"/"+exceledate.val();
                window.location.assign(excelurl);
                //window.location.assign(excelurl);
            }


        });
		$('#insert_btn').click(function(){

            var ITEM_CODE = $('#ITEM_CODE').val();
            var sort = $('#sort').val();
            var nation = $('#nation').val();
            var sdate = $('#sdate').val();
            var edate = $('#edate').val();

			if($('#ITEM_CODE').val() == '' || $('#ITEM_CODE').val() == null )
            {
                alert('코드를 입력해 주세요.');
                $('#ITEM_CODE').focus();
                return false;
            }
            if($('#sort').val() == '' || $('#sort').val() == null )
            {
                alert('구분을 선택해 주세요.');
                $('#sort').focus();
                return false;
            }
            if($('#nation').val() == '' || $('#nation').val() == null )
            {
                alert('국가를 입력해 주세요.');
                $('#nation').focus();
                return false;
            }
            if($('#sdate').val() == '' || $('#sdate').val() == null )
            {
                alert('유효기간 시작일을 입력해 주세요.');
                $('#sdate').focus();
                return false;
            }
            if($('#edate').val() == '' || $('#edate').val() == null )
            {
                alert('유효기간 종료일을 입력해 주세요.');
                $('#edate').focus();
                return false;
            }

            if(confirm("등록 하시겠습니까?")){

                $.ajax({
                    url: "<?php echo site_url('b2b/evcode_insert'); ?>",
                    data: {
                        sort:sort,
                        nation:nation,
                        ITEM_CODE:ITEM_CODE,
                        sdate:sdate,
                        edate:edate
                    },
                    type:"POST",
                    success:function(msg)
                    {
//							alert(msg);
                        if(msg == "ok"){
                            $(location).attr('href','/b2b/evcode');
                        }else{
                            alert(msg);
                        }
                    }
                })
            }

        });

		$('#ITEM_CODE').keyup(function(e){

			$(this).val($(this).val().replace(/[^0-9]/g,""));

			var ITEM_CODE = $(this).val();

			if(ITEM_CODE.length == 5){
				$.ajax({
                    url: "<?php echo site_url('b2b/codesett'); ?>",
                    data: {
                        ITEM_CODE:ITEM_CODE
                    },
                    type:"POST",
                    success:function(msg)
                    {
						if(msg != 'err'){
                            //alert(msg);
                            var res = msg.split(";");
                            $('#sort').val(res[0]);
                            $('#sdate').val(res[1]);
                            $('#edate').val(res[2]);
                        }
                    }
                })
			}
		});


		$("#limit").change(function(){
			$("#num_form").submit();
		});

		$('#searchcode').keyup(function(e){
			if(e.keyCode == 13) 
			{
			   $('#csearch').submit();
			}
		});

		$('#reset_btn').click(function(){
            document.forms['csearch'].elements['searchcode'].value = "";

			$('#csearch').submit();
        });

		$('.y_btn').click(function(){
            var code = $(this).attr('code');
            usestate(code,"Y");
        });

        $('.n_btn').click(function(){
            var code = $(this).attr('code');
            usestate(code,"N");
        });

	});

	



		

</script>