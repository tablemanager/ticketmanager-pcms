<?php
/**
 * Created by PhpStorm.
 * User: MINO
 * Date: 2017-01-18
 * Time: 오후 2:25
 */
?>

<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold"><?php echo $title;?></span></h3>
        <div class="row">
            <div class="col-md-12">

                <section class="widget">
                    <div class="widget-body">
                        <fieldset>
                            <!--<div class="col-md-offset-4 col-md-4">-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="simple-big-select" style="text-align: right">
                                        시설 선택
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="faccode"
                                                id="faccode"
                                                class="selectpicker"
                                                data-style="btn-default"
                                                tabindex="-1" >
                                            <!-- <option value="0">선택</option> -->
                                            <option value=""> - 선택 - </option>
                                            <?php //
                                            foreach($plm_itemList  as $itemkey => $itemnm): ?>
                                                <option value="<?=$itemkey?>"><?=$itemnm?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div  class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length" style="text-align: right">상품코드</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="ITEM_CODE" id="ITEM_CODE"
                                               class="form-control"
                                               placeholder="상품코드 5자리를 입력해주세요."
                                               data-placement="top">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">

                                <div  class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length" style="text-align: right">상품명</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="nm" id="nm"
                                               class="form-control"
                                               placeholder="한국어 상품명을 입력해주세요."
                                               data-placement="top">
                                    </div>
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <input type="text" name="nm_english" id="nm_english"
                                               class="form-control"
                                               placeholder="영어 상품명을 입력해주세요."
                                               data-placement="top">
                                    </div>
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <input type="text" name="nm_china_simplified" id="nm_china_simplified"
                                               class="form-control"
                                               placeholder="중국어(간체) 상품명을 입력해주세요."
                                               data-placement="top">
                                    </div>
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <input type="text" name="nm_china_traditional" id="nm_china_traditional"
                                               class="form-control"
                                               placeholder="중국어(번체) 상품명을 입력해주세요."
                                               data-placement="top">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div  class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length" style="text-align: right">가격</label>
                                    <div class="col-sm-4">
                                        <input type="number" name="jung_price" id="jung_price"
                                               class="form-control"
                                               placeholder="정상가"
                                               data-placement="top">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="number" name="sell_price" id="sell_price"
                                               class="form-control"
                                               placeholder="판매가"
                                               data-placement="top">
                                    </div>
                                </div>

                                <div  class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length" style="text-align: right">사용기간</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="sdate" id="sdate"
                                               class="form-control datetimepicker3"
                                               placeholder="시작일"
                                               data-placement="top">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" name="edate" id="edate"
                                               class="form-control datetimepicker3"
                                               placeholder="종료일"
                                               data-placement="top">
                                    </div>
                                </div>

                                <div  class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length" style="text-align: right">얼럿창</label>
                                    <div class="col-sm-8">
	                                    <textarea rows="3" class="form-control textarea_value noticemsg" id="default-textarea" name="noticemsg"></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <?php //체크박스
                                foreach($chn->result() as $chnrow): ?>
                                <div class="checkbox checkbox-info checkbox-circle" style="display: inline-block; margin-right: 15px; margin-bottom: -2px">
                                    <input id="checkbox<?=$chnrow->id?>" type="checkbox" value="<?=$chnrow->id?>" class="checkChn">
                                    <label for="checkbox<?=$chnrow->id?>" style="font-size: 8pt">
                                        <?=$chnrow->cd."(".$chnrow->id.")"?>
                                    </label>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="col-md-offset-5 col-md-7" style="margin-top: 12px">
                                <button type="button" id="selectAll" class="btn btn-success">전체 선택</button>
                                <button type="button" id="cancel_btn" class="btn btn-inverse">선택 취소</button>
                                <button type="button" id="save_btn" class="btn btn-primary">등 록</button>
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
                            <table class="table table-striped table-lg mt-lg mb-0">
                                <thead class="no-bd">
									<div style="height:110px; background-color: #DED6D9">
										<br>
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-sm-4 control-label" for="simple-big-select" style="text-align: right"> 정렬 갯수 </label>
												<div class="col-sm-8">
													<form id="num_form" name="num_form" method="post" action="/b2b/plm_item_limit">
														<select style="width:70px" id="limit" name="limit" class="selectpicker">
															<option value="">- 선택 -</option>
															<option value="10" <?php echo ($limit == '10') ? 'selected' : ''; ?>>10개씩</option>
															<option value="20" <?php echo ($limit == '20') ? 'selected' : ''; ?>>20개씩</option>
															<option value="30" <?php echo ($limit == '30') ? 'selected' : ''; ?>>30개씩</option>
															<option value="50" <?php echo ($limit == '50') ? 'selected' : ''; ?>>50개씩</option>
															<option value="100" <?php echo ($limit == '100') ? 'selected' : ''; ?>>100개씩</option>
														</select>
													</form>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label" for="max-length"  style="text-align: right"> 상품명 </label>
												<div class="col-sm-8">
													<form id="nm_form" name="nm_form" method="post" action="/b2b/plm_item_searchnm">
														<input type="text" name="nm" id="nm"
															   class="form-control"
															   placeholder="상품명을 입력하세요"
															   data-placement="top" value="<?=$nm?>">
													</form>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-sm-4 control-label" for="simple-big-select" style="text-align: right"> 채널명 </label>
												<div class="col-sm-8">
												<form id="chnn_form" name="chnn_form" method="post" action="/b2b/chnn_sel">
													<select style="width:220px" id="chnn_sel" name="chnn_sel" class="select2 form-control">
														<option value="">- 채널 선택 -</option>
														<?php
															foreach($chn->result() as $chnrow): ?>
															<option value="<?=$chnrow->id?>" <?php echo ($chnn_sel == $chnrow->id) ? 'selected' : ''; ?>><?=$chnrow->cd?></option>
														<?php endforeach; ?>
													</select>
												</form>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label" for="simple-big-select" style="text-align: right"> 시설명 </label>
												<div class="col-sm-8">
													<form id="item_form" name="item_form" method="post" action="/b2b/item_sel">
														<select name="item_sel" id="item_sel" class="selectpicker" data-style="btn-default">
															
															<option value=""> - 시설 선택 - </option>
															<?php
															foreach($plm_itemList  as $itemkey => $itemnm): ?>
																<option value="<?=$itemkey?>" <?php echo ($item_sel == $itemkey) ? 'selected' : ''; ?>><?=$itemnm?></option>
															<?php endforeach; ?>
														</select>
													</form>
												</div>
											</div>
										</div>
									</div>

									
                                <tr>
                                    <th class="hidden-xs">상품번호</th>
                                    <th class="no-sort hidden-xs">채널명</th>
                                    <th class="hidden-xs">상품명
                                        <select name="s_faccode"
                                                id="s_faccode"
                                                class="selectpicker"
                                                data-style="btn-default"
                                                tabindex="-1" >
                                            <!-- <option value="0">선택</option> -->
                                            <option value=""> - 시설 선택 - </option>
                                            <?php
                                            foreach($plm_itemList  as $itemkey => $itemnm): ?>
                                                <option value="<?=$itemkey?>"><?=$itemnm?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </th>
                                    <th class="hidden-xs">상품코드</th>
                                    <th class="hidden-xs">판매가</th>
                                    <th class="hidden-xs">정상가</th>
                                    <th class="hidden-xs">판매시작일</th>
                                    <th class="hidden-xs">판매종료일</th>
                                    <th class="hidden-xs">사용/미사용</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?
                                foreach($query->result() as $row):
                                    ?>
                                    <tr> <!-- style="color: orange;" -->
                                        <td style="font-size:12px;"><?=$row->id?></td>
                                        <td style="font-size:12px;"><?=$row->cd?></td>
                                        <td style="font-size:12px;"><table>
                                                <tr><?=$plm_itemList[$row->faccode]?></tr>
                                                <tr>
                                                    <td style="font-size: x-small;"><b>한국어</b></td>
                                                    <td style="width: 85%"><input id="nmmode<?=$row->id?>" type="text" class="nmmode form-control"
                                                                                  code="<?=$row->id?>" flang="nm" maxlength="100" value="<?=$row->nm?>" oldvalue="<?=$row->nm?>" size="20" style="border:0; background-color: transparent;"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: x-small;"><b>영어</b></td>
                                                    <td><input id="nmmode_english<?=$row->id?>" type="text" class="nmmode form-control"
                                                               code="<?=$row->id?>" flang="nm_english" maxlength="100" value="<?=$row->nm_english?>" oldvalue="<?=$row->nm_english?>" size="20" style="border:0; background-color: transparent;"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: x-small;"><b>중국어(간체)</b></td>
                                                    <td><input id="nmmode_china_simplified<?=$row->id?>" type="text" class="nmmode form-control"
                                                               code="<?=$row->id?>" flang="nm_china_simplified" maxlength="100" value="<?=$row->nm_china_simplified?>" oldvalue="<?=$row->nm_china_simplified?>" size="20" style="border:0; background-color: transparent;"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: x-small;"><b>중국어(번체)</b></td>
                                                    <td><input id="nmmode_china_traditional<?=$row->id?>" type="text" class="nmmode form-control"
                                                               code="<?=$row->id?>" flang="nm_china_traditional" maxlength="100" value="<?=$row->nm_china_traditional?>" oldvalue="<?=$row->nm_china_traditional?>" size="20" style="border:0; background-color: transparent;"/>
                                                    </td>
                                                </tr>

                                            </table></td>
                                        <td style="font-size:12px;"><?=$row->ITEM_CODE?></td>
                                        <td style="font-size:12px;"><?=$row->sell_price?></td>
                                        <td style="font-size:12px;"><?=$row->jung_price?></td>
                                        <td style="font-size:12px;"><?=$row->sdate?></td>
                                        <td style="font-size:12px;"><?=$row->edate?></td>
                                        <td >
                                            <?php
                                            if($row->useyn == 'Y'){
                                                $uflg =  "사용";
                                            }else if($row->useyn == 'N'){
                                                $uflg =  "정지";
                                            }else{
                                                $uflg = $row->useyn;
                                            }
                                            ?>
                                            <a id="use_<?=$row->id?>" onclick="unusestate('<?=$row->id?>');" uflag ="<?=$uflg?>"><?=$uflg?></a>
                                            <br><br>
                                            <?php
                                            if($row->bank){$bflg="use";}else{$bflg="unuse";}?>
                                            <a class="ubtn bank <?=$bflg?>" id="bank_<?=$row->id?>" code="<?=$row->id?>" gu="bank">무통장</a>
                                            <?php
                                            if($row->card){$cflg="use";}else{$cflg="unuse";}?>
                                            <a class="ubtn card <?=$cflg?>" id="card_<?=$row->id?>" code="<?=$row->id?>" gu="card">카드</a>

                                            <?php
                                            if($row->after){$aflg="use";}else{$aflg="unuse";}?>
                                            <a class="ubtn after <?=$aflg?>" id="after_<?=$row->id?>" code="<?=$row->id?>" gu="after">후정산</a>

                                            <?php if($row->notice != null){?>

                                            <textarea id="notice<?=$row->id?>" class="noticemode" code="<?=$row->id?>"
                                                      style="width:700px; height:50px; border-radius:5px; background-color:transparent; margin-top: 10px"><?=$row->notice?></textarea>
                                            <?php } ?>
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

    function num_only(){
        //alert();
        if((event.keyCode<48) || (event.keyCode>57)){
            event.returnValue=false;
        }
    }

	$(function(){
		$("#limit").change(function(){
			$("#num_form").submit();
		});

		$("#chnn_sel").change(function(){
			$("#chnn_form").submit();
		});

		$("#item_sel").change(function(){
			$("#item_form").submit();
		});

		//상품명 검색
		$('#nm').keyup(function(e) 
		{
			if(e.keyCode == 13) 
			{
			   $('#nm_form').submit();
			}
		});
	});

    function unusestate(code){
        var use_text = $("#use_"+code).attr("uflag");
        var unuse_text = "";
        var flag = "";
        if(use_text == "사용"){
            unuse_text = "정지";
            flag = "N";
        }else if(use_text == "정지"){
            unuse_text = "사용";
            flag = "Y";
        }else{
            return false;
        }
        if(confirm(unuse_text+" 상태로 변경하시겠습니까?")){

            $.ajax({
                url: "<?php echo site_url('/b2b/b2b_item_use'); ?>",
                data: {code : code , use_state : flag},
                type:"POST",
                success:function(msg)
                {
                    //alert(msg);
                    if (msg == "err"){
                        alert("변경에 실패하였습니다.");
                    }else if(msg == "ok"){
                        $('#use_'+code).text(unuse_text);
                        $('#use_'+code).attr("uflag",unuse_text);
                    }

                }
            })

        }
    }

    $(function(){

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
                url: "<?php echo site_url('b2b/item_mode_pay'); ?>",
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

        $("#selectAll").click(function() {
            $(".checkChn").prop("checked", true);
        });


        $("#cancel_btn").click(function() {
            $(".checkChn").prop("checked", false);
        });


        $(".nmmode").click(function() {
            var code = $(this).attr('code');
            $(this).css('background-color','#F781F3');//transparent
            $(this).css('color','white');
        });

        $(".nmmode").keypress(function(e) {
            if (e.keyCode == 13){
                var code = $(this).attr('code');
                var flang = $(this).attr('flang');

                if(confirm("상품명을 변경 하시겠습니까?")){
                    $(this).css('background-color','transparent');
                    $(this).css('color','#F781F3');
                    var modtext = $(this).val();
                    $(this).blur();

                    $.ajax({
                        url: "<?php echo site_url('b2b/itemnm_mode'); ?>",
                        data: {code : code, flang : flang , modtext:modtext},
                        type:"POST",
                        success:function(msg)
                        {
                            //alert(msg);
                            //$("#bigo"+code).html(msg);
                        }
                    })
                }else{
                    $(this).css('background-color','transparent');
                    $(this).css('color','black');
                    $(this).val($(this).attr('oldvalue'));
                    $(this).blur();
                }

            }
        });


        $('#ITEM_CODE').keyup(function() {

            if($('#ITEM_CODE').val().length == 5 ){
                //alert($('#ITEM_CODE').val().length);
                $.ajax({
                    url: "<?php echo site_url('b2b/b2b_item_get'); ?>",
                    data: {
                        ITEM_CODE:$('#ITEM_CODE').val(),
                        faccode:$('#faccode').val()
                    },
                    type:"POST",
                    success:function(msg)
                    {
                        if(msg != 'err'){
                            //alert(msg);
                            var res = msg.split(";");
                            $('#nm').val(res[0]);
                            $('#jung_price').val(res[1]);
                            $('#sell_price').val(res[2]);
                            $('#sdate').val(res[3]);
                            $('#edate').val(res[4]);
                            $('#nm_english').val(res[5]);
                            $('#nm_china_simplified').val(res[6]);
                            $('#nm_china_traditional').val(res[7]);
                        }
                    }
                })
            }

            /*
            * 첫번째 : $('#ITEM_CODE').val() 의 값을 받는 함수를 하나 만들어서
            * 그 값을 그대로 json으로 변경해서 돌려받기
            *
            * 두번째 : $('#ITEM_CODE').val() 의 값을
            * SELECT ACCOUNT_ID FROM `B2B_ITEMS` WHERE faccode = '' and ITEM_CODE = ''
            * 사용해서 ACCOUNT_ID만 배열로 만들어 json으로 받기
            *
            * 세번째 받은 ACCOUNT_ID값을 체크박스 체크
            * */

            if($('#ITEM_CODE').val().length == 5 ) {
                $.ajax({
                    url: "<?php echo site_url('b2b/b2b_chn_get'); ?>",
                    data: {
                        ITEM_CODE: $('#ITEM_CODE').val(),
                        faccode: $('#faccode').val()
                    },
                    type: "POST",
                    dataType: "json", // 데이터타입을 json 으로 받아옴
                    success: function (data) {
                        // alert(JSON.stringify(data));
                        if(data.length > 0) {
                            $(".checkChn").prop("checked", false);
                            for (var chnchx in data) {
                                $('.checkbox input[value=' + data[chnchx] + ']').prop("checked", true);
                            }
                        }

                    }
                });
            }
        });


        $('#s_faccode').change(function(){
           var s_faccode = $(this).val();
            $(location).attr('href','/b2b/plm_item/'+s_faccode);
        });

        $('#save_btn').click(function(){

            if($('#faccode').val() == '' || $('#faccode').val() == null )
            {
                alert('시설을 선택해 주세요.');
                $('#faccode').focus();
                return false;
            }

            if($('#ITEM_CODE').val() == '' || $('#ITEM_CODE').val() == null || $('#ITEM_CODE').val().length != 5 )
            {
                alert('상품코드 5자리를 입력해주세요.');
                $('#ITEM_CODE').focus();
                return false;
            }

            if($('#nm').val() == '' || $('#nm').val() == null )
            {
                alert('상품명를 입력해주세요.');
                $('#nm').focus();
                return false;
            }

            if($('#jung_price').val() == '' || $('#jung_price').val() == null )
            {
                alert('정상가를 입력해 주세요.');
                $('#jung_price').focus();
                return false;
            }

            if($('#sell_price').val() == '' || $('#sell_price').val() == null )
            {
                alert('판매가를 입력해 주세요.');
                $('#sell_price').focus();
                return false;
            }

            if($('#sdate').val() == '' || $('#sdate').val() == null )
            {
                alert('사용 시작일을 입력해 주세요.');
                $('#sdate').focus();
                return false;
            }

            if($('#edate').val() == '' || $('#edate').val() == null )
            {
                alert('사용 종료일을 입력해 주세요.');
                $('#edate').focus();
                return false;
            }

            var A_ids = "";
            $('input[type=checkbox]').each(function () {
                if (this.checked) {
                    A_ids += $(this).val() + ";";
                }
            });
            if(A_ids == '' || A_ids == null )
            {
                alert('채널들을 선택해 주세요.');
                return false;
            }

            if(confirm("상품을 등록 하시겠습니까?")){

                $.ajax({
                    url: "<?php echo site_url('b2b/b2b_item_adds'); ?>",
                    data: {
                        A_ids:A_ids,
                        ITEM_CODE:$('#ITEM_CODE').val(),
                        nm:$('#nm').val(),
                        nm_english:$('#nm_english').val(),
                        nm_china_simplified:$('#nm_china_simplified').val(),
                        nm_china_traditional:$('#nm_china_traditional').val(),
                        jung_price:$('#jung_price').val(),
                        sell_price:$('#sell_price').val(),
                        sdate:$('#sdate').val(),
                        edate:$('#edate').val(),
                        faccode:$('#faccode').val(),
                        noticemsg:$('.noticemsg').val()
                    },
                    type:"POST",
                    success:function(msg)
                    {
                        //alert(msg);
                        if(msg == "ok"){
                            $(location).attr('href','/b2b/plm_item');
                        }else{
                            alert(msg);
                            $(location).attr('href','/b2b/plm_item_faccode/'+ $('#faccode').val());
                        }
                    }
                })
            }
        });

        $(".noticemode").on('change',function(){
            var code = $(this).attr('code');
            if(confirm("메모를 저장 하시겠습니까?")){
                var modtext = $(this).val();
                // alert(modtext+code);
                $.ajax({
                    url: "<?php echo site_url('b2b/b2b_modify_notice'); ?>",
                    data: {code : code, modtext:modtext},
                    type:"POST",
                    success:function(msg)
                    {
                       if(msg == 'err'){
                            alert('저장 실패');
                        }
                        //$("#notice"+code).val(msg);
                        // alert(msg);
                    }
                })
            }
        });
    });
</script>
