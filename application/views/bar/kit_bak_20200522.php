<div class="content-wrap" style="width: 90%; margin-left: 10%">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold"><?php echo $title;?></span></h3>
        <div class="row">
            <div class="col-md-12">

                <?php if($this->session->userdata('cd') == "penfen"){
                    //echo $sql;

                }?>
                <!-- <div class="alert alert-success alert-sm">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <span class="fw-semi-bold">문자등록</span>
            </div> -->

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
                                    <label class="col-sm-3 control-label" for="simple-big-select">
                                        채널 선택
                                    </label>
                                    <div class="col-sm-3">
                                        <select name="chnpick"
                                                id="chnpick"
                                                class="selectpicker"
                                                data-style="btn-default btn-lg"
                                                tabindex="-1" >
                                            <!-- <option value="0">선택</option> -->
                                            <?php
                                            foreach($gpar as $gpk => $gpv){ ?>
                                                <option value="<?=$gpk?>"><?=$gpv?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">PCMS 상품번호</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="pcmsitem_id" id="pcmsitem_id" maxlength="5"
                                               class="form-control"
                                               placeholder="PCMS 상품번호를 입력해주세요."
                                               data-placement="top" data-original-title="You cannot write more than 4 characters."
                                               OnKeyPress="num_only()">
                                        <input type="text" name="pcmsitem_id_arr" id="pcmsitem_id_arr" class="form-control"
                                               placeholder="PCMS 상품번호를 입력해주세요. (11111,11112,11113)"
                                               data-placement="top" style="display:none;" >
                                        <span class="help-block" id="pcmsitem_item"></span>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">사용시작일</label>
                                    <div class="col-sm-8">
                                        <input id="use_sdate" type="text" class="form-control datetimepicker1" maxlength="10" value= "<?php echo date('m/d/Y');?>"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">사용종료일</label>
                                    <div class="col-sm-8">
                                        <input id="use_edate" type="text" class="form-control datetimepicker1" maxlength="10" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">시설이미지(콜백)</label>
                                    <div class="col-sm-8">
                                        <select id = "curl_headimg" name="curl_headimg">
                                            <option value="">없음</option>
                                            <option value="wp_headbar_open.jpg">롯데워터파크(오픈마켓)</option>
                                            <option value="wp_headbar_tmon.jpg">롯데워터파크(티몬)</option>
                                            <option value="wp_headbar_we.jpg">롯데워터파크(위메프)</option>
                                            <option value="wp_headbar_coupang.jpg">롯데워터파크(쿠팡)</option>
                                            <option value="bar_head_naver.jpg">롯데워터파크(네이버)</option>
                                            <option value="wp_headbar_open_lottekidspark.jpg">롯데키즈</option>
                                            <option value="wp_headbar_aqua.jpg">아쿠아필드</option>
                                            <option value="headbar_high1_ski_lift.jpg">하이원스키</option>
                                            <option value="head_high1water.jpg">하이원워터</option>
                                            <option value="wp_head_playdoci.jpg">웅진플레이도시</option>
                                            <option value="logo_ever.jpg">에버랜드</option>
                                            <option value="logo_ever.jpg">캐리비안베이</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">
                                        문자 내용
                                        <!-- <span class="help-block">
                                                   시설명 <code>{jpnm}</code>
                                        </span>
                                        <span class="help-block">
                                                   상품명 <code>{title}</code>
                                        </span> -->
                                        <span class="help-block">
	                                           	주문번호 <code>{orderno}</code>
	                                    </span>
                                        <span class="help-block">
	                                           	인원(매수) <code>{man1}</code>
	                                    </span>
                                        <span class="help-block">
	                                           	이름 <code>{usernm}</code>
	                                    </span>
                                        <span class="help-block">
	                                           	휴대폰 뒷번호 <code>{hp3}</code>
	                                    </span>
                                        <span class="help-block">
	                                           	이용일자 <code>{usedate}</code>
	                                    </span>
                                    </label>
                                    <div class="col-sm-8">
	                                    <textarea rows="15" class="form-control textarea_value" id="default-textarea" onKeyUp="javascript:fnChkByte(this,'1700')">
▣상품명 :
▣쿠폰번호 : {orderno}
▣매수: {man1}명
▣이름 : {usernm} ({hp3})
▣교환장소: OOO 매표소
※유의사항
▶본 권은 구매완료 후 O월 OO일까지만 취소.환불 가능합니다.
▶유효기간은 OOOO년 O월 OO일부터 OOOO년 O월OO일(기간 중 1일)까지입니다.
▶OOO은 연중 무휴입니다.
▶사용하고자 하시는 지점의 매표소를 방문하시어 모바일 티켓 확인 후 입장가능 합니다.
▶온라인 재판매 목적으로 양도시 현장에서 티켓불출이 불가합니다.
▶구매 상품에 대해 부분 수령은 불가하며, 일괄수령이 원칙입니다.
▶당일 구매 후 당일사용이 가능합니다.
▶쿠폰번호삭제 및 미수신경우 스파로 고객센타(1544-3913) 연락바랍니다.
										</textarea>
                                        <span id="byteInfo">0</span>/1700Byte
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
                <?php // } ?>
                <section class="widget">

                    <header>
                        <div class="widget-controls">
                            <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a>
                            <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a>
                            <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </header>

                    <div class="widget-body">
                        <div class="alert alert-success alert-sm">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <span class="fw-semi-bold">롯데월드, 롯데워터파크 등의 바코드를 발송하는</span> 상품의 페이지 입니다.(에버랜드,이마트 제외)
                        </div>
                        <div class="alert alert-info alert-sm">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <span class="fw-semi-bold">Info:</span> <span class="fw-semi-bold">사용기한 </span>이 남은 상품만 볼수 있습니다.
                        </div>
                        <div class="alert alert-info alert-sm">



                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-lg mt-lg mb-0">
                                <thead class="no-bd">
                                <tr>
                                    <th>정보검색</th>
                                    <td class="form-inline">
                                        <form id="search_form" name="search_form" method="post" action="/bar/search_list">
                                            <input type="text" class="form-control input-sm" name="sellcode" id="sellcode" placeholder="외부판매코드">
                                            <input type="text" class="form-control input-sm" name="pcms_id" id="pcms_id" placeholder="PCMS코드" >
                                            <input type="text" class="form-control input-sm" name="itemnm" id="itemnm" placeholder="아이템이름" >
                                            <button class="btn btn-xs btn-info" id="search_list" >검색</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <form id="chn_form" name="chn_form" method="post" action="/bar/chn_sel">
                                            <select name="selectchn"
                                                    id="selectchn"
                                                    class="selectpicker"
                                                    data-style="btn-default">
                                                <option value="0">선택</option>
                                                <?php
                                                foreach($gparr as $gpkk => $gpvv){ ?>
                                                    <option value="<?=$gpkk?>" <?php echo ($selectchn == $gpkk) ? 'selected' : ''; ?>><?=$gpvv?></option>
                                                <?php } ?>
                                            </select>
                                        </form>
                                    </th>
                                    <th class="no-sort hidden-xs">판매코드</th>
                                    <th class="hidden-xs">PCMS코드</th>
                                    <th class="hidden-xs">상품명</th>
                                    <th class="hidden-xs">사용기한</th>
                                    <?php
                                    if(array_search($this->session->userdata('selectchn'), $bararr)){
                                        ?>
                                        <th class="hidden-xs">바코드수량</th>
                                    <?php } ?>
                                    <th class="hidden-xs">문자내용</th>
                                    <th class="hidden-xs">옵션</th>
                                    <th class="hidden-xs">상태</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?
                                foreach($query->result() as $row):

                                    ?>

                                    <tr <?if($row->useyn == 'N'){echo "style='color: red;'";}else if($row->test == 'N'){echo "style='color:  #0e84b5;'";}?>> <!-- style="color: orange;" -->
                                        <td style="font-size:12px;" ><?  echo $gparr[$row->gp]; ?></td>
                                        <td style="font-size:12px;"><?=$row->sellcode?></td>
                                        <td style="font-size:12px;">

                                            <?php
                                            if(strpos($row->gp,'ARR')){
                                                echo $row->pcms_id_arr;
                                            }else{
                                                echo $row->pcms_id;
                                            }

                                            ?>
                                        </td>
                                        <td style="font-size:12px;"><?=$row->itemnm?></td>
                                        <td style="font-size:12px;">
                                            <?php
                                            $date_arr = date("Y-m-d", strtotime($row->edate));
                                            ?>
                                            <input id="datechange<?=$row->id?>" type="text" class="datechange form-control datetimepicker3"
                                                   code="<?=$row->id?>" maxlength="10" value="<?=$date_arr?>" size="10" style="border:0; background-color: transparent;"/>
                                        </td>

                                        <?php
                                        if(array_search($gparr[$row->gp], $bararr)){

                                        ?>
                                        <td style="font-size:12px;">

                                            <!-- 		                            	<a href='./countck_c/<?=$row->id?>' id='countck' class="countck" name='countck'>수량확인</a> -->
                                            <a id='countck<?=$row->id?>' class="countck" name='countck' code="<?=$row->id?>">수량확인</a>
                                            <br>

                                            <?php
                                            //$row->codecnt 제거
                                            echo "<a href='./bar_add/$row->id' data-toggle='tooltip' data-placement='right' title='바코드 추가'>"."바코드 추가"."</a></td>";
                                            }
                                            ?>
                                        <td style="font-size:12px;">
                                            <button class="btn btn-gray" data-toggle="modal" data-target="#myModal<?=$row->id?>">
                                                보기/편집
                                            </button>
                                            <div class="modal fade" id="myModal<?=$row->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title text-align-center fw-bold mt" id="myModalLabel18"><?=$row->itemnm?></h4>
                                                        </div>
                                                        <div class="modal-body bg-gray-lighter">
                                                            <form>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <textarea rows="30" class="form-control mmstext_<?=$row->id?>" id="default-textarea"><?=$row->mms_text?></textarea>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-gray" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-success mmssave" flag="<?=$row->id?>">Save changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><a href = "http://gateway.sparo.cc/internal/cpconfig/<?=$row->gp?>/<?=$row->pcms_id?>" target='_blink' >*</a></td>
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
                url: "<?php echo site_url('/bar/kit_use'); ?>",
                data: {code : code , use_state : flag},
                type:"POST",
                success:function(msg)
                {
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

    //Byte 수 체크
    function fnChkByte(obj, maxByte){
        var str = obj.value;
        var str_len = str.length;

        var rbyte = 0;
        var rlen = 0;
        var one_char = "";
        var str2 = "";

        for(var i=0; i<str_len; i++){
            one_char = str.charAt(i);
            if(escape(one_char).length > 4){
                rbyte += 2;                                         //한글2Byte
            }else{
                rbyte++;                                            //영문 등 나머지 1Byte
            }

            if(rbyte <= maxByte){
                rlen = i+1;                                          //return할 문자열 갯수
            }
        }

        if(rbyte > maxByte){
            alert("한글 "+(maxByte/2)+"자 / 영문 "+maxByte+"자를 초과 입력할 수 없습니다.");
            str2 = str.substr(0,rlen);                                  //문자열 자르기
            obj.value = str2;
            fnChkByte(obj, maxByte);
        }else{
            document.getElementById('byteInfo').innerText = rbyte;
        }
    }


    $(function(){

        //다중등록일때
        $("#chnpick").change(function(){
            var chnpick = $('#chnpick').val();

            if(chnpick == 'PM_ARR'){
                $("#pcmsitem_id").slideUp("slow");
                $("#pcmsitem_id_arr").slideDown("slow");
            }else{
                $("#pcmsitem_id_arr").slideUp("slow");
                $("#pcmsitem_id").slideDown("slow");
            }

        });

        $("#pcmsitem_id").keyup(function() {

            var pcmsitem_id = $("#pcmsitem_id").val();
            var chnpick = $("#chnpick").val();

            $.ajax({
                url: "<?php echo site_url('sys/get_itemname'); ?>",
                data: {pcmsitem_id : pcmsitem_id},
                type:"POST",
                success:function(msg)
                {
                    //$(location).attr('href',msg);
                    $( "#pcmsitem_item" ).text(msg);
                }
            })

            $.ajax({
                url: "<?php echo site_url('sys/get_kit_mms_text'); ?>",
                data: {pcmsitem_id : pcmsitem_id},
                type:"POST",
                success:function(msg)
                {
                    if(msg != "ERROR" && msg != "" && msg != null){

                        $( "#default-textarea" ).val(msg);
                    }
                }
            })

            $.ajax({
                url: "<?php echo site_url('sys/get_last_price'); ?>",
                data: {pcmsitem_id : pcmsitem_id},
                type:"POST",
                success:function(msg)
                {
                    if(msg != "ERROR" && msg != "" && msg != null){

                        $('#use_edate').val(msg);
                    }
                }
            })

            //$( "#pcmsitem_item" ).text(pcmsitem_id);
        });

        //다중등록시
        $("#pcmsitem_id_arr").keyup(function() {

            var pcmsitem_id_arr = $("#pcmsitem_id_arr").val();
            var chnpick = $("#chnpick").val();

            $.ajax({
                url: "<?php echo site_url('sys/get_arr_itemname'); ?>",
                data: {pcmsitem_id_arr : pcmsitem_id_arr},
                type:"POST",
                success:function(msg)
                {
                    //$(location).attr('href',msg);
                    $( "#pcmsitem_item" ).text(msg);
                }
            })
            //$( "#pcmsitem_item" ).text(pcmsitem_id);
        });

        $('.mmssave').click(function(){

            var flag = $(this).attr('flag');
            var mmstext = $('.mmstext_'+flag).val();
            //alert(mmstext);
            if(confirm("문자를 변경하시겠습니까?")){
                $.ajax({
                    url: "<?php echo site_url('bar/kit_mms'); ?>",
                    data: {flag : flag , mmstext : mmstext},
                    type:"POST",
                    success:function(msg)
                    {
                        //$(location).attr('href',msg);
                        alert("변경되었습니다.");
                    }
                })
            }
        });

        $('#cancel_btn').click(function(){
            $(location).attr('href','/bar/kit');
            //alert();
        });

        $('#save_btn').click(function(){

            if($('#chnpick').val() == '' || $('#chnpick').val() == null )
            {
                alert('채널을 선택해 주세요.');
                $('#chnpick').focus();
                return false;
            }
            if($('#pcmsitem_id').val() == '' || $('#pcmsitem_id').val() == null)
            {
                if($('#chnpick').val() != "PM_ARR"){
                    alert('PCMS 상품번호를 입력해 주세요.');
                    $('#pcmsitem_id').focus();
                    return false;
                }
            }
            if($('#use_sdate').val() == '' || $('#use_sdate').val() == null)
            {
                alert('사용시작일을 입력해 주세요.');
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
                var chnpick = $('#chnpick').val();
                var pcmsitem_id = $('#pcmsitem_id').val();
                var pcmsitem_id_arr = $('#pcmsitem_id_arr').val();
                var use_sdate = $('#use_sdate').val();
                var use_edate = $('#use_edate').val();
                var textarea_value = $('.textarea_value').val();
                var curl_headimg = $('#curl_headimg').val();

                $.ajax({
                    url: "<?php echo site_url('bar/kit_add'); ?>",
                    data: {chnpick : chnpick , pcmsitem_id : pcmsitem_id , use_sdate : use_sdate , use_edate : use_edate, textarea_value : textarea_value, pcmsitem_id_arr : pcmsitem_id_arr, curl_headimg : curl_headimg},
                    type:"POST",
                    success:function(msg)
                    {
                        //alert(msg);

                        var res = msg.split('|');
                        if(res[0] == "err"){
                            alert(res[1]);
                        }else{
                            //alert(msg);
                            $(location).attr('href','/bar/kit/'+chnpick);
                        }

                    }
                })

            }

        });


        $('.countck').click(function(){
            var countck = $('.countck').html();
            var code = $(this).attr('code');

            $.ajax({
                url: "<?php echo site_url('bar/countck_c'); ?>",
                data: {countck : countck, code : code},
                type:"POST",
                success:function(msg)
                {
//                alert(msg);
                    $('#countck' + code).text(msg);


                }
            })

        });

        $(".datechange").change(function() {
            var code = $(this).attr('code');
            var date = $(this).val();
            if(confirm("이용일을 변경 하시겠습니까?")){
                $.ajax({
                    url: "<?php echo site_url('bar/kit_date_change'); ?>",
                    data: {code : code, date : date},
                    type:"POST",
                    success:function(msg)
                    {
//					alert(msg);
                        if(msg == "ok"){
                            alert("변경되었습니다.");
                        }else{
                            alert("error");
                        }
                    }
                })
            }
        });

        $("#selectchn").change(function(){
            $("#chn_form").submit();
        });

        $("#search_list").click (function (){
            $("#search_form").submit();
        });




    });


</script>









