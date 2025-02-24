<?php
/*
if($this->session->userdata('cd') != 'penfen') {
    echo '<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold">점검중입니다.</span></h3></main></div>';
    exit;
}
*/
?>

<div class="content-wrap" style="width: 90%; margin-left: 10%">
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
                                    <label class="col-sm-3 control-label" for="type_select">분 류</label>
                                    <div class="col-sm-3">
                                        <select name="ctype"
                                        		id="ctype"
                                        		class="selectpicker"
                                                data-style="btn-default btn-md"
                                                tabindex="-1" >

<?
foreach($ctypeArr as $ctypek => $ctypev):
?>
                                            <option value="<?=$ctypek?>"><?=$ctypev?></option>
<?
endforeach;
?>
                                        </select>
                                    </div>

                                    <div class="col-sm-3">
                                        <select name="chgu[]"
                                        		id="chgu"
                                                multiple
                                        		class="selectpicker"
                                                data-style="btn-default btn-md"
                                                tabindex="-1" >

<?
foreach($chguArr as $chguk => $chguv):
?>
                                            <option value="<?=$chguk?>"><?=$chguv?></option>
<?
endforeach;
?>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" name="grnm" id="grnm" maxlength="15"
                                               class="form-control"
                                               placeholder="판매업체명"
                                               data-placement="top"
                                               style="display:none"
                                               >
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">쿠폰코드</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="sellno" id="sellno" maxlength="15"
                                               class="form-control"
                                               placeholder="ex) 에버랜드:06111, 해외:50001, 원마운트:7501111111"
                                               data-placement="top" data-original-title="You cannot write more than 4 characters."
                                                disabled="disabled"><!--OnKeyPress="num_only()"-->

                                        <span class="help-block" id="sellno_txt"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">PCMS 상품번호</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="pcmsitem_id" id="pcmsitem_id"
                                               class="form-control"
                                               placeholder="PCMS 상품번호를 입력해주세요."
                                               data-placement="top"
                                              >
<!--                                        <input type="text" name="pcmsitem_id" id="pcmsitem_id" maxlength="5"-->
<!--                                               class="form-control"-->
<!--                                               placeholder="PCMS 상품번호를 입력해주세요."-->
<!--                                               data-placement="top" data-original-title="You cannot write more than 4 characters."-->
<!--                                               OnKeyPress="num_only()">-->
                                        <span class="help-block" id="pcmsitem_item"></span>
                                        <input type="hidden" id= "cnm" name="cnm"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">수량</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="qty" id="qty" maxlength="5"
                                               class="form-control"
                                               placeholder="생성 수량을 입력하세요.(AI 자동등록시 0 입력)"
                                               data-placement="top" data-original-title="You cannot write more than 4 characters."
                                               OnKeyPress="num_only()">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">사용시작일</label>
                                    <div class="col-sm-7">
	                                    <input id="use_sdate" type="text" class="form-control datetimepicker1" maxlength="10" value= "<?php echo date('m/d/Y');?>"/>
	                                </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">사용종료일</label>
                                    <div class="col-sm-7">
	                                    <input id="use_edate" type="text" class="form-control datetimepicker1" maxlength="10" />
	                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">AI예측 재고관리</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="mkcode" id="mkcode" maxlength="5" class="form-control" placeholder="사용 Y / 미사용 N">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">시설코드(선택)</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="faccode" id="faccode" maxlength="5"
                                               class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">발권단위수량</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="cunit" id="cunit" maxlength="4"
                                               class="form-control" value="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">쿠폰발급</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="syncorder" id="syncorder" maxlength="1"
                                               class="form-control" value="" placeholder="주문등록시 쿠폰자동 생성시(오픈마켓 형태만 사용!) -> P ">
                                                * 외부 쿠폰발급 채널(소셜,네이버,씨트립등)시 중복 발권됨!! 사용금지
                                    </div>
                                </div>
								<!-- 쿠폰발급2 api column값 추가 - 21.11.11 jason -->
								<div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">쿠폰발급2</label>
                                    <div class="col-sm-3">
                                        <select name="api"
                                        		id="api"
                                        		class="selectpicker"
                                                data-style="btn-default btn-md"
                                                tabindex="-1" >
                                            <option value="N">N (기본값)</option>
											<option value="S">S (선택)</option>
                                        </select>
                                    </div>
                                </div>

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


                        <input type="text" name="pcms_no" id="pcms_no" placeholder="상품코드" value="<?=$itemno?>" >
                        <select name="ch_no"
                                id="ch_no"
                                class="selectpicker"
                                data-style="btn-default btn-md"
                                tabindex="-1" >
                            <option value="">전체</option>
                            <option value="T" <?php echo ($chno == 'T') ? 'selected' : ''; ?>>티몬</option>
                            <option value="W" <?php echo ($chno == 'W') ? 'selected' : ''; ?>>위메프</option>
                            <option value="N" <?php echo ($chno == 'N') ? 'selected' : ''; ?>>네이버</option>
                            <option value="C" <?php echo ($chno == 'C') ? 'selected' : ''; ?>>쿠팡</option>
                            <option value="Y" <?php echo ($chno == 'Y') ? 'selected' : ''; ?>>여기어때</option>
                            <option value="B" <?php echo ($chno == 'B') ? 'selected' : ''; ?>>B2B해외</option>
                            <option value="K" <?php echo ($chno == 'K') ? 'selected' : ''; ?>>클룩(KLOOK)</option>
                            <option value="R" <?php echo ($chno == 'R') ? 'selected' : ''; ?>>트립닷컴(CTRIP)</option>
                            <option value="X" <?php echo ($chno == 'X') ? 'selected' : ''; ?>>트래블플랜</option>
                        </select>

                        <button type="button" class="btn btn-xs btn-info" id="search_btn"><i class="icofont icofont-rotation"></i> 검색</button>

		                <div class="mt">
		                    <!-- <table id="datatable-table" class="tblCustomers table table-striped table-hover"> -->
<!-- 		                    <table id = "tblCustomers" class="table table-striped table-lg mt-lg mb-0"> -->
		                   <!--  <table id="datatable-table" class="table table-striped table-hover"> -->
		                    <table id="tblCustomers" class="table table-striped table-hover">
		                        <thead>
		                        <tr>
		                            <!-- <th>번호</th> -->
		                            <th class='no-sort'>
										<form id="bar_align" name="bar_align" method="post" action="/bar/make_ctype">
											<select name="bartype" id="bartype" class="selectpicker" data-style="btn-default btn-md" tabindex="-1">
											<!-- <select name="bartype" id="bartype" class="selectpicker" data-style="btn-default btn-md" tabindex="-1"> -->
												<option value="">바코드타입</option>
												<option value="EL" <?php echo ($bartype == 'EL') ? 'selected' : ''; ?>>에버랜드(STICKET)</option>
												<option value="CB" <?php echo ($bartype == 'CB') ? 'selected' : ''; ?>>캐리비안베이(STICKET)</option>
												<option value="HT" <?php echo ($bartype == 'HT') ? 'selected' : ''; ?>>에버랜드 해외 홈티켓</option>
												<option value="WP" <?php echo ($bartype == 'WP') ? 'selected' : ''; ?>>롯데통합쿠폰</option>
                                                <option value="WS" <?php echo ($bartype == 'WS') ? 'selected' : ''; ?>>웅진시즌권</option>
												<option value="ML" <?php echo ($bartype == 'ML') ? 'selected' : ''; ?>>롯데다인권콜백</option>
												<option value="FV" <?php echo ($bartype == 'FV') ? 'selected' : ''; ?>>민속촌</option>
												<option value="PM" <?php echo ($bartype == 'PM') ? 'selected' : ''; ?>>지류권</option>
												<option value="SJ" <?php echo ($bartype == 'SJ') ? 'selected' : ''; ?>>삼정더파크</option>
												<option value="BG" <?php echo ($bartype == 'BG') ? 'selected' : ''; ?>>블루캐니언/휘닉스파크</option>
											    <option value="AQ" <?php echo ($bartype == 'AQ') ? 'selected' : ''; ?>>아쿠아필드</option>
                                                <option value="ES" <?php echo ($bartype == 'ES') ? 'selected' : ''; ?>>엘리시안시즌권</option>
                                                <option value="PC" <?php echo ($bartype == 'PC') ? 'selected' : ''; ?>>파라다이스시티</option>
                                                <option value="HW" <?php echo ($bartype == 'HW') ? 'selected' : ''; ?>>하이원 워터</option>
                                                <option value="HL" <?php echo ($bartype == 'HL') ? 'selected' : ''; ?>>하이원 리프트</option>
                                                <option value="HS" <?php echo ($bartype == 'HS') ? 'selected' : ''; ?>>하이원스키시즌권</option>
                                                <option value="PS" <?php echo ($bartype == 'PS') ? 'selected' : ''; ?>>플레이도시</option>
                                                <option value="OW" <?php echo ($bartype == 'OW') ? 'selected' : ''; ?>>오월드</option>
                                                <option value="KZ" <?php echo ($bartype == 'KZ') ? 'selected' : ''; ?>>키자니아</option>
                                                <option value="RL" <?php echo ($bartype == 'RL') ? 'selected' : ''; ?>>리솜리조트</option>
                                                <option value="NC" <?php echo ($bartype == 'NC') ? 'selected' : ''; ?>>키오스크</option>
                                                <option value="DS" <?php echo ($bartype == 'DS') ? 'selected' : ''; ?>>대전신세계과학관</option>
                                                <option value="BS" <?php echo ($bartype == 'BS') ? 'selected' : ''; ?>>벨포레</option>
                                                <option value="KG" <?php echo ($bartype == 'KG') ? 'selected' : ''; ?>>곤지암루지</option>
                                                <option value="BE" <?php echo ($bartype == 'BE') ? 'selected' : ''; ?>>롯데B2E바우처</option>
											</select>
                                            <input type="hidden" name="itemno" id="itemno">
                                            <input type="hidden" name="chno" id="chno">
										</form>
									</th>
		                            <th class='no-sort'>사용채널</th>
		                            <th class='no-sort'>판매코드</th>
		                            <th class='no-sort'>PCMS번호</th>
		                            <th class='no-sort'>상품명</th>
		                            <th class='no-sort'>수량</th>
		                            <th class='no-sort'>발권단위수량</th>
		                            <th class='no-sort'>등록일</th>
		                            <th class='no-sort'>사용종료일</th>
		                            <th class='no-sort'>옵션</th>
		                            <th class='no-sort'>상태</th>
		                        </tr>
		                        </thead>
		                        <tbody class = "itemTable">

<?
if(true){
foreach($query->result() as $row):
	// print_r($row);
?>
								<tr class = "table_<?=$row->id?>">
		                            <!--  <td><?=$row->id?></td>-->
		                            <td><span class="fw-semi-bold"><?=$ctypeArr[$row->ctype]?></span></td>
		                            <!-- <td ><?=$chguArr[$row->chgu]?></td> -->
		                            <td align=center><?php
echo $chguArr[$row->chgu];
// Ctrip 중계서버(64번)에 쿠폰을 복사해야 한다.
// 판매채널이 트립닷컴(씨트립,Ctrip)이면서,  쿠폰 생성 주체가 시설인 경우
// 만들어진 쿠폰을 씨트립 중계서버로 복사해야 주문처리가 정상적으로 이루어진다.
if ($row->chgu == "R")
{
    echo '<span style="font-size:12px;" data-toggle="tooltip" data-placement="top" title="사용채널이 \'트립닷컴\'이면서 쿠폰 생성 주체가 시설인경우, 생성된 쿠폰을 씨트립 중계서버로 복사 [완료]되어야 판매 가능합니다.">';
    echo "<br><center>중계서버복사<br>[".(($row->api == 'Y')?"<span style='color:block;font-weight:bold'>완료":"<span style='color:red;font-weight:bold'>미완료")."</span>]</center>";
    echo '</span>';
}
					  ?>
</td>
		                            <td ><?=$row->ccode."<br/>(".$row->sellno.")"?><?php echo empty($row->syncorder)?"":", 쿠폰발급[$row->syncorder]";?></td>
		                            <td ><?=$row->items_id?></td>
		                            <td ><?=$row->cnm?></td>
<?php
// 20241002 tony [잔여핀수량핀] 잔여 핀 수량 확인요청건 https://placem.atlassian.net/browse/P2CCA-687
// 지류권일때만 잔여수량 확인
if($row->ctype == "PM"){
                                    //echo site_url("/bar/countck_pm/{$row->ccode}/{$row->code}");
                                    echo "<td ><a id='countck{$row->id}' class='countck' name='countck' code='{$row->id}' ccode='{$row->ccode}'>수량확인</a>/{$row->qty}</td>";
}else{
?>
		                            <td ><?=$row->qty?></td>
<?php
}
?>
		                            <td ><?=$row->cunit?></td>
		                            <td ><?=$row->regdate?></td>
		                            <td ><?=$row->use_edate?></td>
		                            <td ><a href='#' onclick="showform('/<?=$row->ctype?>/<?=$row->ccode?>/')" >*</a></td>
		                            <td >


									<?php
									//새 쿠폰 DB 엑셀 다운로드
									if($row->state == "S" && ($row->ctype == 'OW' or $row->ctype == 'NC' or $row->ctype == 'EL' or $row->ctype == 'CB' or $row->ctype == 'ES' or $row->ctype == 'PL' or $row->ctype == 'WS'
                  or $row->ctype == 'HW' or $row->ctype == 'RL' or $row->ctype == 'ML' or $row->ctype == 'PC' or $row->ctype == 'PS' or $row->ctype == 'OW' or $row->ctype == 'DS'
		  // 2022.03.4 tony 벨포레용 쿠폰번호(핀) 엑셀 다운로드
                  or $row->ctype == 'BS' /*블랙스톤 벨포레*/
                  or $row->ctype == 'KG' /*곤지암 루지*/   or $row->ctype == 'BE' /*B2E*/ 
)){
									?>
										<button type="button"
												id="makeExcelDown"
												class="btn btn-success makeExcelDown"
												code = "<?=$row->ccode?>";
												title="엑셀다운로드."><?=$row->ccode?></button>

		                            <?php }else if($row->outFileName != ''){?>
		                            <a id="use_<?=$row->id?>" onclick="directExcelDown('<?=$row->ccode?>','<?=$row->items_id?>');" >
		                            <?php }?>
		                            <?=(isset($stateArr[$row->state])?$stateArr[$row->state]:"")?>
		                            <?php if($row->outFileName != ''){?>
		                            </a>
		                            <?php }?>

		                            <?php
		                            if($row->state == "R"){
		                            ?>
		                            	<br>
		                            	<a class="codedel" code="<?=$row->id?>" href="#" style="color: red;">Delete</a>
		                            <?php
		                            }
		                            ?>




                                    <?php
                                    if($row->ctype == 'EV' || $row->ctype == 'FV' ||   $row->chgu == 'W' ||   $row->chgu == 'K'){?>
                                        </br>
                                        <a href='/bar/set_img/<?=$row->id?>'>이미지 생성요청</a>
                                    <?php }?>

                                    <?php if($row->imgURL != ''){?>
                                        </br>
                                        <a id="use_<?=$row->id?>" onclick="imagedown('<?=$row->id?>');" style="color: green;">이미지 다운로드</a>

                                    <?php }?>




		                            </td>
		                        </tr>
<?
endforeach;
}
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
function num_only(){
	//alert();
	if((event.keyCode<48) || (event.keyCode>57)){
    	event.returnValue=false;
  	}
}

function exceldown(id){
	//downloadURI("data:,HelloWorld!", "helloWorld.txt");
	window.location.assign('<?php echo site_url('bar/excelDown'); ?>'+"/"+id);
}
function directExcelDown(code,itemid){
    //downloadURI("data:,HelloWorld!", "helloWorld.txt");
    window.location.assign('<?php echo site_url('bar/directExcelDown'); ?>'+"/"+code+"/"+itemid);
}


function imagedown(id){
	window.location.assign('<?php echo site_url('bar/imageDown'); ?>'+"/"+id);
}


$(function(){

    $("#search_btn").click( function (){
        $("#itemno").val($('#pcms_no').val());
        $("#chno").val(  $("#ch_no option:selected").val());

        $('#bar_align').attr('action','/bar/make_item');
        $('#bar_align').submit();
    });

	$('.makeExcelDown').click(function(){
		//alert($(this).attr('code'));
		var excelurl = '<?php echo site_url('bar/makeExcelDown'); ?>'+"/"+$(this).attr('code');
		window.location.assign(excelurl);
	});

	$("#ctype").change(function() {

		$('#qty').val(0);

		if( $('#ctype').val() != "EV"  && $('#ctype').val() != "FR" && $('#ctype').val() != "HT"  && $('#ctype').val() != "WS" && $('#ctype').val() != "WP" && $('#ctype').val() != "ML" && $('#ctype').val() != "HL"  && $('#ctype').val() != "HW"  && $('#ctype').val() != "CB"  && $('#ctype').val() != "EL"){
			$('#sellno').val("");
			$('#sellno').attr("disabled", "disabled");
		}else{
			$('#sellno').removeAttr("disabled");
		}
		if($('#ctype').val() == "FR" || $('#ctype').val() == "HT"){
			$('#grnm').show(500);
		}else{
			$('#grnm').hide(500);
		}

        if($('#ctype').val() == "OM" && $('#chgu').val() == 'B'){
            $('#grnm').show(500);
        }else{
            $('#grnm').hide(500);
        }

		if($('#ctype').val() == "HT" ){
			$("#pcmsitem_id").attr("disabled", "disabled");
		}else{
			$('#pcmsitem_id').removeAttr("disabled");
		}
	});

	$("#chgu").change(function() {

        if($('#ctype').val() == "OM" && $('#chgu').val() == 'B'){
            $('#grnm').show(500);
        }else{
            $('#grnm').hide(500);
        }

		/*if($('#ctype').val() == 'PM' && $('#chgu').val() == 'P' )
		{
		  alert('플레이스엠 지류권은 만들수 없습니다.');
		  $('#chgu').val("");
		  $('#chgu').focus();
		  return false;
		}
		if($('#ctype').val() == 'PM' && $('#chgu').val() == 'C' )
		{
			alert('쿠팡 지류권은 만들수 없습니다.\n연동 -> 판매 연동 설정 메뉴에서 \n오픈마켓과 동일하게 진행해주세요.');
			$('#chgu').val("");
			return false;
		}*/
		if($('#chgu').val() == 'N'){
            alert('네이버 쿠폰은 이곳에서 만들 수 없습니다.');
//			$('#chgu').val("");
//			$("#chgu").val("").prop("selected", true);
//			$("#chgu option:eq(0)").prop("selected", true);

			return false;
        }
	});

	//바코드수량제한
	$("#qty").keyup(function() {
		var qty = $("#qty").val();

		if($('#ctype').val() == ""){
			$('#qty').val("0");
		}if($('#ctype').val() == "AQ"){
			if($('#qty').val() > 5000){
				$('#qty').val("20000");
			}
		}if($('#ctype').val() == "EL" || $('#ctype').val() == "CB" || $('#ctype').val() == "HT" || $('#ctype').val() == "WP"){
			if($('#qty').val() > 15000){
				$('#qty').val("15000");
			}
		}if($('#ctype').val() == "FV"){
			if($('#qty').val() > 5000){
				$('#qty').val("10000");
			}
		}if($('#ctype').val() == "PM"){
			if($('#qty').val() > 5000){
				$('#qty').val("5000");
			}
		}if($('#ctype').val() == "SJ"){
			if($('#qty').val() > 2000){
				$('#qty').val("2000");
			}
		}if($('#ctype').val() == "BG" || $('#ctype').val() == "PF"){
			if($('#qty').val() > 5000){
				$('#qty').val("5000");
			}
		}
	});

	$("#sellno").keyup(function() {
        var ctype = $('#ctype').val();

        var eventcd = $("#sellno").val();

        if (ctype == "WP" || ctype == "ML"){
            $.ajax({
                url: "<?php echo site_url('lotte/ajax_eventlist'); ?>",
                data: {eventcd : eventcd},
                type:"POST",
                dataType: "json",
                success:function(msg)
                {
                    $("#use_sdate").val(msg.stt_date);
                    $("#use_edate").val(msg.end_date);
                    $("#sellno_txt").text(msg.eventnm);
                    $("#qty").val(msg.qty);
                    console.log(msg);
                }
            })
        }

    });

	$("#pcmsitem_id").keyup(function() {

		var pcmsitem_id = $("#pcmsitem_id").val();


		$.ajax({
	        url: "<?php echo site_url('sys/get_itemname_ary'); ?>",
            data: {pcmsitem_id : pcmsitem_id},
            type:"POST",
            success:function(msg)
            {
              $( "#pcmsitem_item" ).text(msg);
              if(msg == "조회할수 없는 번호입니다.")msg = null;
              $( "#cnm" ).val(msg);

            }
		})
	});

	$('.codedel').click(function(){
		var code = $(this).attr('code');
		if(confirm("삭제 하시겠습니까?")){
			 $.ajax({
		        url: "<?php echo site_url('bar/make_del'); ?>",
	            data: {code:code},
	            type:"POST",
	            success:function(msg)
	            {
	      		    if (msg == "err"){
	      			  	alert("삭제 실패");
	      			  	return false;
	      		    }else{
	      		    	$(location).attr('href','/bar/make');
	      		    }
	            }
	        })
		}

	});

	$('#save_btn').click(function(){

		if($('#ctype').val() == '' || $('#ctype').val() == null )
		{
		  alert('바코드 타입을 선택해 주세요.');
		  $('#ctype').focus();
		  return false;
		}

		if($('#chgu').val() == '' || $('#chgu').val() == null )
		{
		  alert('사용 채널을 선택해 주세요.');
		  $('#chgu').focus();
		  return false;
		}

		if($('#chgu').val() == 'N'){
			alert('네이버 쿠폰은 이곳에서 만들 수 없습니다.');
			$('#chgu').focus();
			return false;
		}

		if($('#ctype').val() == 'PM' && $('#chgu').val() == 'C' )
		{
			//alert('쿠팡 지류권은 만들수 없습니다.\n연동 -> 판매 연동 설정 메뉴에서 \n오픈마켓과 동일하게 진행해주세요.');
			//$('#chgu').val("");
			//return false;
		}

		if($('#ctype').val() == 'PM' && $('#chgu').val() == 'P' )
		{
		 // alert('플레이스엠 지류권은 만들수 없습니다.');
		  //$('#chgu').val("");
		  //$('#chgu').focus();
		  //return false;
		}

		if( ($('#ctype').val() == "EV" || $('#ctype').val() == "FR" || $('#ctype').val() == "OM")
				&& ( $('#sellno').val() == '' || $('#sellno').val() == null ))
		{
			alert('쿠폰코드를 입력해 주세요.');
			  $('#sellno').focus();
			  return false;
		}


		if($('#qty').val() == '' || $('#qty').val() == null)
		{
		  alert('바코드 수량을 입력해 주세요.');
		  $('#qty').focus();
		  return false;
		}

		if($('#qty').val() > 15000 )
		{
		  alert('최대 생성 수량을 넘었습니다.');
		  $('#qty').focus();
		  return false;
		}


		//홈티켓은 pcms 코드 예외
		if($('#ctype').val() != 'HT'){
			if($('#pcmsitem_id').val() == '' || $('#pcmsitem_id').val() == null)
			{
				alert('PCMS 상품 코드를 입력해 주세요.');
				$('#pcmsitem_id').focus();
				return false;
			}

			if($('#cnm').val() == '' || $('#cnm').val() == null)
			{
			  alert('잘못된 PCMS 상품 코드!');
			  $('#pcmsitem_id').focus();
			  return false;
			}
		}

		if($('#use_sdate').val() == '' || $('#use_sdate').val() == null)
		{
		  alert('사용시작일 입력해 주세요.');
		  $('#use_sdate').focus();
		  return false;
		}

		if($('#use_edate').val() == '' || $('#use_edate').val() == null)
		{
		  alert('사용종료일을 입력해 주세요.');
		  $('#use_edate').focus();
		  return false;
		}


		if(confirm("등록 하시겠습니까?")){

			var ctype = $('#ctype').val();
			var chgu = $('#chgu').val();
			var sellno = $('#sellno').val();
			var pcmsitem_id = $('#pcmsitem_id').val();
			var cnm = $('#cnm').val();
			var use_sdate = $('#use_sdate').val();
			var use_edate = $('#use_edate').val();
			var qty = $('#qty').val();
			var mkcode = $('#mkcode').val();
			var cunit = $('#cunit').val();
			var syncorder = $('#syncorder').val();
			var api = $('#api').val();
			if(ctype == "FR" && $('#grnm').val() != ""){
				cnm = $('#grnm').val();
			}
			if(ctype == "HT" && $('#grnm').val() != ""){
				cnm = $('#grnm').val();
			}
            if(ctype == "OM" && $('#grnm').val() != ""){
                cnm = $('#grnm').val();
            }
			//alert(ctype + " / " + chgu + " / " + sellno + " / " + pcmsitem_id + " / " + cnm + " / " + use_sdate + " / " + use_edate);
            $.ajax({
	        url: "<?php echo site_url('bar/make_add_ary'); ?>",
            data: {ctype:ctype,chgu:chgu,sellno:sellno,pcmsitem_id:pcmsitem_id,cnm:cnm,qty:qty,use_sdate:use_sdate,use_edate:use_edate,mkcode:mkcode,cunit:cunit,syncorder:syncorder,api:api},
            type:"POST",
            success:function(msg)
            {
                //alert(msg);
      		    if (msg == "err"){
      			  	alert("등록 실패");
      			  	return false;
      		    }else{
      		    	$(location).attr('href','/bar/make');
      		    }
            }
            })

		}

	});

	$("#bartype").change(function() {
        $("#itemno").val($('#pcms_no').val());
        $("#chno").val(  $("#ch_no option:selected").val());
		// $('#bar_align').submit();
	});

    $('.countck').click(function(){
        var countck = $('.countck').html();
        var code = $(this).attr('code');
        var ccode = $(this).attr('ccode');

        $.ajax({
            url: "<?php echo site_url('bar/countck_pm'); ?>",
            data: {ccode : ccode, code : code},
            type:"POST",
            success:function(msg)
            {
//                alert(msg);
                $('#countck' + code).text(msg);

                
            }
        })

    });
});

function showform(facid){
    window.open('https://gateway.ticketmanager.ai/internal/formbuild' + facid, 'windows', 'width=520,height=800,scrollbars=yes');
}
</script>
