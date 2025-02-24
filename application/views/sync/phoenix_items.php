<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold"><?php echo $title;?></span></h3>
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
                            <form  role="form" id="insertform" name="insertform" class="form-horizontal" role="form" method="post" action="" >
                                <fieldset>

                                    <div class="col-sm-6"><!--1번째-->

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="max-length">구분</label>
                                            <div class="col-sm-8">

                                                <div class="radio" style="display: inline-block; margin-right: 20px;">
                                                    <input type="radio" name="selltype" class="selltype" id="radio_selltype_KO" value="KO" checked="checked" >
                                                    <label for="radio_selltype_KO">
                                                        국내
                                                    </label>
                                                </div>
                                                <div class="radio" style="display: inline-block; margin-right: 0px;">
                                                    <input type="radio" name="selltype" class="selltype" id="radio_selltype_FR" value="FR">
                                                    <label for="radio_selltype_FR">
                                                        해외
                                                    </label>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="max-length">PCMS 상품번호</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="item_id" id="item_id" maxlength="5"
                                                       class="form-control"
                                                       placeholder="PCMS 상품번호를 입력해주세요."
                                                       data-placement="top" data-original-title="You cannot write more than 4 characters."
                                                       OnKeyPress="num_only()">
                                                <span class="help-block" id="pcmsitem_item"></span>
                                            </div>
                                        </div>
    
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="max-length">상품명</label>
                                            <div class="col-sm-8">
                                                <input id="ITEMNAME" name="ITEMNAME" type="text" class="form-control"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="max-length">가격</label>
                                            <div class="col-sm-8">
                                                <input id="amt" name="amt" type="number" class="form-control" maxlength="10"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="max-length">유효기간</label>
                                            <div class="col-sm-8">
                                                <input id="selldate" name="selldate" type="text" class="form-control datetimepicker3" maxlength="10" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="simple-big-select">
                                                판매 구분
                                            </label>

                                            <div class="col-sm-4">
                                                <select name="bgimg"
                                                        id="bgimg"
                                                        class="selectpicker"
                                                        data-style="btn-default"
                                                        tabindex="-1" >
                                                    <option value="">선택</option>
                                                    <option value="bluecn.jpg">블루캐니언</option>
                                                    <option value="phonx.jpg">휘닉스파크</option>
                                                </select>
                                            </div>


                                            <div class="col-sm-4">
                                                <select name="synctype"
                                                        id="synctype"
                                                        class="selectpicker"
                                                        data-style="btn-default"
                                                        tabindex="-1" >
                                                    <option value="">선택</option>
                                                    <option value="SIN">단품</option>
                                                    <option value="SET">세트</option>
                                                </select>
                                            </div>

                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="max-length">PRIFIX</label>
                                            <div class="col-sm-8">
                                                <input id="prifix" name="prifix" type="number" class="form-control" maxlength="10" placeholder="6자리 숫자 (시스템 연동규약 참조)"/>
                                            </div>
                                        </div>

                                        <div class="SIN_input" style="display: none">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="max-length">권종코드(단품)</label>
                                                <div class="col-sm-8">
                                                    <input type="number" name="typecd" id="typecd" maxlength="5"
                                                           class="form-control"
                                                           placeholder="권종 정보를 입력해주세요. 2자리 숫자 (시스템 연동규약 참조)"
                                                           data-placement="top" data-original-title="You cannot write more than 4 characters."
                                                           OnKeyPress="num_only()">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="max-length">시즌코드(단품)</label>
                                                <div class="col-sm-8">
                                                    <input type="number" name="seasoncd" id="seasoncd" maxlength="5"
                                                           class="form-control"
                                                           placeholder="시즌 코드를 입력해주세요. 2자리 숫자 (시스템 연동규약 참조)"
                                                           data-placement="top" data-original-title="You cannot write more than 4 characters."
                                                           OnKeyPress="num_only()">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="SET_input" style="display: none">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="max-length">권종코드(세트)</label>
                                                <div class="col-sm-8">
                                                    <input type="number" name="tcode" id="tcode" maxlength="8"
                                                           class="form-control"
                                                           placeholder="권종코드(세트)를 입력해주세요. 8자리 숫자 (시스템 연동규약 참조)"
                                                           data-placement="top"
                                                           OnKeyPress="num_only()">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="max-length">KIND(시즌코드)</label>
                                                <div class="col-sm-8">
                                                    <input type="number" name="typecode" id="typecode" maxlength="5"
                                                           class="form-control"
                                                           placeholder="KIND : 시즌코드(세트)를 입력해주세요. 2자리 숫자 (시스템 연동규약 참조)"
                                                           data-placement="top" data-original-title="You cannot write more than 4 characters."
                                                           OnKeyPress="num_only()">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group  SET_input SIN_input" style="display: none">
                                            <label class="col-sm-3 control-label SIN_input" for="max-length">남자 인원</label>
                                            <label class="col-sm-3 control-label SET_input" for="max-length">세트권 인원</label>
                                            <div class="col-sm-3 SET_input SIN_input"  style="display: none">
                                                <input id="man1"name="man1"  type="number" class="form-control" maxlength="10" placeholder="남자대인"/>
                                            </div>

                                            <div class="col-sm-3 SIN_input"  style="display: none">
                                                <input id="man3"name="man3"  type="number" class="form-control" maxlength="10" placeholder="남자소인"/>
                                            </div>
                                            <div class="col-sm-3 SIN_input"  style="display: none">
                                                <input id="man5"name="man5"  type="number" class="form-control" maxlength="10" placeholder="남자 대인,소인"/>
                                            </div>
                                            <label class="col-sm-11 control-label SET_input" for="max-length">
                                                <span class="help-block">세트권의 경우 <code>남자 대인</code>에만 입력합니다. 예) 3매권은 남대 3인, 6매권은 남대 6인, 9매권은 남대 9인</span>
                                            </label>
                                            <label class="col-sm-3 control-label SIN_input" for="max-length" style="display: none">여자 인원</label>
                                            <div class="col-sm-3 SIN_input"  style="display: none">
                                                <input id="man2"name="man2"  type="number" class="form-control" maxlength="10" placeholder="여자대인"/>
                                            </div>
                                            <div class="col-sm-3 SIN_input"  style="display: none">
                                                <input id="man4"name="man4"  type="number" class="form-control" maxlength="10" placeholder="여자소인"/>
                                            </div>

                                            <div class="col-sm-3 SIN_input"  style="display: none">
                                                <input id="man6"name="man6"  type="number" class="form-control" maxlength="10" placeholder="여자 대인,소인"/>
                                            </div>
                                        </div>



                                    </div><!--1번째-->

                                    <div class="col-sm-6"><!--2번째-->


                                        
                                        <div class="form-group">

                                            <div class="col-sm-8">

                                                <textarea rows="17" class="form-control textarea_value" id="default-textarea">
▣상품명 : {title}
▣이름 :  {usernm} ({hp3})
▣교환장소 : 블루캐니언 매표소
▣이용권번호 : {orderno}
▣매수 : {man1} 매
▣유효기간 : ~2017년00월00일 주중/주말 中 1일
[유의사항]
-본 티켓은 ~2017년00월00일까지 구매한 옵션에맞게 사용가능합니다.
-본 티켓은 유효기간 2일 전까지 취소 및 환불이 가능하며 그 이후로는 불가능합니다.
-티켓 사용당일 매표소에서 티켓 교환 후 이용이 가능합니다.
-유효기간이 지난 티켓은 연장 및 취소가 불가능 합니다.
-온라인 재판매 목적으로 양도시 현장에서 티켓불출이 불가합니다.
-구매 상품에 대해 부분 수령, 부분 취소 불가능합니다.
-블루캐니언 운영시간 및 세부안내는 방문전 홈페이지를 참조바랍니다.
-쿠폰번호삭제 및 미수신경우 스파로 고객센터(1544-3913) 연락바랍니다.
                                                </textarea>
                                            </div>
                                            <label class="col-sm-3 control-label" for="max-length">
                                                문자 내용
                                                <span class="help-block">
                                                        상품명 <code>{title}</code>
                                                </span>
                                                <span class="help-block">
                                                        이용권번호 <code>{orderno}</code>
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

                                            </label>
                                        </div>




                                    </div><!--2번째-->

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


                <section class="widget">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-7">
                            <?php
                            $month_3 = date("Y-m",strtotime("-3 months"));
                            $month_2 = date("Y-m",strtotime("-2 months"));
                            $month_1 = date("Y-m",strtotime("-1 months"));
                            $month_0 = date("Y-m");
                            $m_3 = date("m",strtotime("-3 months"));
                            $m_2 = date("m",strtotime("-2 months"));
                            $m_1 = date("m",strtotime("-1 months"));
                            $m_0 = date("m");
                            ?>
                            <button type="button"
                                    id="excel_btn_3"
                                    class="btn btn-success excel_btn"
                                    code = "<?=$month_3?>";
                                    title="데이터가 많을수록 오래 걸립니다. 기다려주세요."><?=$m_3?>월 사용데이타(excel)</button>
                            <button type="button"
                                    id="excel_btn_2"
                                    class="btn btn-success excel_btn"
                                    code = "<?=$month_2?>";
                                    title="데이터가 많을수록 오래 걸립니다. 기다려주세요."><?=$m_2?>월 사용데이타(excel)</button>
                            <button type="button"
                                    id="excel_btn_2"
                                    class="btn btn-success excel_btn"
                                    code = "<?=$month_1?>";
                                    title="데이터가 많을수록 오래 걸립니다. 기다려주세요."><?=$m_1?>월 사용데이타(excel)</button>
                            <button type="button"
                                    id="excel_btn_2"
                                    class="btn btn-success excel_btn"
                                    code = "<?=$month_0?>";
                                    title="데이터가 많을수록 오래 걸립니다. 기다려주세요."><?=$m_0?>월 사용데이타(excel)</button>
                        </div>
                    </div>
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
                            <span class="fw-semi-bold">휘닉스파크 or 블루캐니언</span> 연동 페이지 입니다.
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-lg mt-lg mb-0">
                                <thead class="no-bd">
                                <tr>
                                    <th class="no-sort hidden-xs">번호</th>
                                    <th class="hidden-xs">상품코드</th>
                                    <th class="hidden-xs">상품명</th>
                                    <th class="hidden-xs">가격</th>
                                    <th class="hidden-xs">유효기한</th>
                                    <th class="hidden-xs">워터/스노우</th>
                                    <th class="hidden-xs">단품/세트</th>
                                    <th class="hidden-xs">권종코드</th>
                                    <th class="hidden-xs">시즌코드</th>
                                    <th class="hidden-xs">PRIFIX</th>
                                    <th class="hidden-xs">남대</th>
                                    <th class="hidden-xs">여대</th>
                                    <th class="hidden-xs">남소</th>
                                    <th class="hidden-xs">여소</th>
                                    <th class="hidden-xs">남대소</th>
                                    <th class="hidden-xs">여대소</th>
                                    <th class="hidden-xs">문자내용</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?
                                $synct = array('SIN'=>'단품','SET'=>'세트');
                                $ws = array('bluecn.jpg'=>'블루캐니언','phonx.jpg'=>'휘닉스파크');
                                foreach($query->result() as $row):
                                    ?>

                                    <tr>
                                        <td style="font-size:12px;"><?=$row->id?></td>
                                        <td style="font-size:12px;"><?=$row->item_id?></td>
                                        <td style="font-size:12px;"><?=$row->ITEMNAME?></td>
                                        <td style="font-size:12px;"><?=number_format($row->amt)?></td>
                                        <td style="font-size:12px;"><?=$row->selldate?></td>
                                        <td style="font-size:12px;"><?=$ws[$row->bgimg]?></td>
                                        <td style="font-size:12px;"><?=$synct[$row->synctype]?></td>

                                        <td style="font-size:12px;"><?php if($row->synctype=='SIN'){echo $row->typecd;}else{echo $row->tcode;}?></td>
                                        <td style="font-size:12px;"><?php if($row->synctype=='SIN'){echo $row->seasoncd;}else{echo $row->typecode;}?></td>

                                        <td style="font-size:12px;"><?=$row->prifix?></td>
                                        <td style="font-size:12px;"><?=$row->cnt1?></td>
                                        <td style="font-size:12px;"><?=$row->cnt2?></td>
                                        <td style="font-size:12px;"><?=$row->cnt3?></td>
                                        <td style="font-size:12px;"><?=$row->cnt4?></td>
                                        <td style="font-size:12px;"><?=$row->cnt5?></td>
                                        <td style="font-size:12px;"><?=$row->cnt6?></td>
                                        <td style="font-size:12px;">
                                            <button class="btn btn-gray" data-toggle="modal" data-target="#myModal<?=$row->id?>">
                                                보기/편집
                                            </button>
                                            <div class="modal fade" id="myModal<?=$row->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title text-align-center fw-bold mt" id="myModalLabel18"><?=$row->ITEMNAME?></h4>
                                                        </div>
                                                        <div class="modal-body bg-gray-lighter">
                                                            <form>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <textarea rows="30" class="form-control mmstext_<?=$row->id?>" id="default-textarea"><?=$row->msg?></textarea>
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
                                        <td >
                                            <?php
                                            if($row->state == 'Y'){
                                                $uflg =  "사용";
                                            }else if($row->state == 'N'){
                                                $uflg =  "정지";
                                            }else{
                                                $uflg = $row->state;
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
                url: "<?php echo site_url('/sync/phoenix_items_use'); ?>",
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



    $(function(){

        $('.excel_btn').click(function(){
            var excelurl = '<?php echo site_url('order/exceldown_phoenix'); ?>'+"/"+$(this).attr('code');
            window.location.assign(excelurl);
        });


        $("#item_id").keyup(function() {

            var item_id = $('#item_id').val();
            $.ajax({
                url: "<?php echo site_url('sys/get_itemname'); ?>",
                data: {pcmsitem_id : item_id},
                type:"POST",
                success:function(msg)
                {
                    //$(location).attr('href',msg);
                    $( "#pcmsitem_item" ).text(msg);
                }
            })
        });

        $('.mmssave').click(function(){

            var flag = $(this).attr('flag');
            var mmstext = $('.mmstext_'+flag).val();
            //alert(mmstext);
            if(confirm("문자를 변경하시겠습니까?")){
                $.ajax({
                    url: "<?php echo site_url('sync/phoenix_items_mms'); ?>",
                    data: {flag : flag , mmstext : mmstext},
                    type:"POST",
                    success:function(msg)
                    {
                        $(location).attr('href',msg);
                    }
                })
            }
        });

        $('#synctype').change(function () {
            var synctype = $(this).val();

            if(synctype == 'SIN'){
                $('.SET_input').slideUp();
                $('.SIN_input').slideDown();
            }else if(synctype == 'SET'){
                $('.SIN_input').slideUp();
                $('.SET_input').slideDown();
            }
        });


        $('#save_btn').click(function(){

            if($('#item_id').val() == '' || $('#item_id').val() == null )
            {
                alert('상품번호를 입력해 주세요.');
                $('#item_id').focus();
                return false;
            }
            if($('#ITEMNAME').val() == '' || $('#ITEMNAME').val() == null)
            {
                alert('상품명을 입력해 주세요.');
                $('#ITEMNAME').focus();
                return false;
            }
            if($('#amt').val() == '' || $('#amt').val() == null)
            {
                alert('가격을 입력해 주세요.');
                $('#amt').focus();
                return false;
            }
            if($('#selldate').val() == '' || $('#selldate').val() == null)
            {
                alert('유효기간을 입력해 주세요.');
                $('#selldate').focus();
                return false;
            }

            if($('#bgimg').val() == '' || $('#bgimg').val() == null || $('#synctype').val() == '' || $('#synctype').val() == null)
            {
                alert('판매 구분을 선택해 주세요.');
                return false;
            }

            if($('#prifix').val() == '' || $('#prifix').val() == null)
            {
                alert('prifix를 입력해 주세요.');
                $('#prifix').focus();
                return false;
            }

            //단품권
            if($('#synctype').val() == 'SIN'){

                if($('#typecd').val() == '' || $('#typecd').val() == null)
                {
                    alert('권종코드(단품)을 입력해 주세요.');
                    $('#typecd').focus();
                    return false;
                }

                if($('#seasoncd').val() == '' || $('#seasoncd').val() == null)
                {
                    alert('시즌코드(단품)을 입력해 주세요.');
                    $('#seasoncd').focus();
                    return false;
                }

                if($('#man1').val() == '' && $('#man2').val() == '' && $('#man3').val() == '' && $('#man4').val() == '' && $('#man5').val() == '' && $('#man6').val() == '' )
                {
                    alert('연동 인원을 입력해 주세요.');
                    $('#man1').focus();
                    return false;
                }


            }

            //세트권
            if($('#synctype').val() == 'SET'){
                if($('#tcode').val() == '' || $('#tcode').val() == null)
                {
                    alert('권종코드(세트)을 입력해 주세요.');
                    $('#tcode').focus();
                    return false;
                }

                if($('#typecode').val() == '' || $('#typecode').val() == null)
                {
                    alert('KIND(시즌코드)을 입력해 주세요.');
                    $('#typecode').focus();
                    return false;
                }

                if($('#man1').val() == '')
                {
                    alert('연동 인원을 입력해 주세요.');
                    $('#man1').focus();
                    return false;
                }
            }


            if(confirm("등록 하시겠습니까?")){

                var selltype = $(':radio[name="selltype"]:checked').val();
                if(selltype == '' || selltype == null )
                {
                    alert('구분(국내/해외)을 선택해 주세요.');
                    return false;
                }
                var item_id = $('#item_id').val();
                var ITEMNAME = $('#ITEMNAME').val();
                var amt = $('#amt').val();
                var selldate = $('#selldate').val();

                var bgimg = $('#bgimg').val();
                var synctype = $('#synctype').val();

                var prifix = $('#prifix').val();

                var typecd = $('#typecd').val();
                var seasoncd = $('#seasoncd').val();

                var tcode = $('#tcode').val();
                var typecode = $('#typecode').val();

                var man1 = $('#man1').val();
                var man2 = $('#man2').val();
                var man3 = $('#man3').val();
                var man4 = $('#man4').val();
                var man5 = $('#man5').val();
                var man6 = $('#man6').val();

                $.ajax({
                    url: "<?php echo site_url('sync/phoenix_items_add'); ?>",
                    data: {
                        selltype:selltype,
                        item_id:item_id,
                        ITEMNAME:ITEMNAME,
                        amt:amt,
                        selldate:selldate,
                        bgimg:bgimg,
                        synctype:synctype,
                        prifix:prifix,
                        typecd:typecd,
                        seasoncd:seasoncd,
                        tcode:tcode,
                        typecode:typecode,
                        man1:man1,
                        man2:man2,
                        man3:man3,
                        man4:man4,
                        man5:man5,
                        man6:man6,
                        msg:$('#default-textarea').val()
                    },
                    type:"POST",
                    success:function(msg)
                    {
                        //alert(msg);
                        if(msg == "ok"){
                         $(location).attr('href','/sync/phoenix_items');
                        }else{
                         alert(msg);
                        }
                    }
                })
            }

        });

    });
</script>









