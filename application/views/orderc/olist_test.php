<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold">뉴스파로 주문 관리 <?php if($total != 0)echo $total."건, ";?>&nbsp;<?php if($tman1 != 0)echo $tman1."매";?> </span></h3>
        <?php
        if($this->session->userdata('cd') == 'cindy')echo $dev;
        ?>
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
                        <form  role="form" id="fform" name="fform" class="form-horizontal" role="form" method="post" action="/orderc/olist_ser">
                            <div class="row">
                                <div class="col-md-3">
                                    <fieldset>
                                        <legend>
                                            날짜 검색
                                        </legend>

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <select name="selectdate" id="selectdate" class="selectpicker">
                                                    <option name="mdate" value="mdate" <?php echo ($selectdate == 'mdate') ? 'selected' : ''; ?>>접수일</option>
                                                    <option name="usedate" value="usedate" <?php echo ($selectdate == 'usedate') ? 'selected' : ''; ?>>이용기간</option>
                                                    <option name="canceldate" value="canceldate" <?php echo ($selectdate == 'canceldate') ? 'selected' : ''; ?>>취소처리일</option>
                                                    <option name="usegu_at" value="usegu_at" <?php echo ($selectdate == 'usegu_at') ? 'selected' : ''; ?>>이용처리일</option>
                                                </select>
                                            </div>


                                            <div class="col-sm-6">
                                                <input type="date" name="sdate" id="sdate" maxlength="20"
                                                       class="form-control"
                                                       data-placement="top"
                                                       style="margin-top: 5px"
                                                       value="<?=$sdate?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="date" name="edate" id="edate" maxlength="20"
                                                       class="form-control"
                                                       data-placement="top"
                                                       style="margin-top: 5px"
                                                       value="<?=$edate?>">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-md-3">
                                    <fieldset>
                                        <legend>
                                            고객정보 검색
                                        </legend>

                                        <div class="form-group">
                                            <div class="col-sm-4">
                                                <input type="text" name="usernm" id="usernm" maxlength="20"
                                                       class="form-control"
                                                       placeholder="이름"
                                                       data-placement="top"
                                                       value="<?=$usernm?>">
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" name="userhp" id="userhp" maxlength="20"
                                                       class="form-control"
                                                       placeholder="휴대폰"
                                                       data-placement="top"
                                                       value="<?=$userhp?>">
                                            </div>

                                            <div class="col-sm-6">
                                                <input type="text" name="orderno" id="orderno" maxlength="30"
                                                       class="form-control"
                                                       placeholder="주문번호"
                                                       data-placement="top"
                                                       style="margin-top: 5px"
                                                       value="<?=$orderno?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="barcodeno" id="barcodeno" maxlength="30"
                                                       class="form-control"
                                                       placeholder="바코드"
                                                       data-placement="top"
                                                       style="margin-top: 5px"
                                                       value="<?=$barcodeno?>">
                                            </div>

                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-md-6">

                                    <fieldset>
                                        <legend>
                                            주문정보 검색
                                        </legend>


                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <select id="chnm"
                                                        data-placeholder="판매채널을 선택하세요."
                                                        class="select2 form-control"
                                                        tabindex="-1"
                                                        name="chnm"
                                                        style="margin-top: 0px">
                                                    <option value="">판매채널</option>
                                                    <?
                                                    foreach($cquery->result() as $crow):
                                                        ?>
                                                        <option class="chnm_<?php echo $crow->com_id;?>" value="<?php echo $crow->com_nm;?>" <?php echo ($chnm == $crow->com_nm) ? 'selected' : ''; ?>><?php echo $crow->com_nm."  (".$crow->com_id.")";?></option>
                                                    <?
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" name="ch_orderno" id="ch_orderno" maxlength="20"
                                                       class="form-control"
                                                       placeholder="채널 주문번호"
                                                       data-placement="top"
                                                       value="<?=$ch_orderno?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <select id="jpmt_id"
                                                        data-placeholder="시설을 선택하세요."
                                                        class="select2 form-control"
                                                        tabindex="-1"
                                                        name="jpmt_id"
                                                        style="margin-top: 0px">
                                                    <option value="">시설명</option>
                                                    <?
                                                    foreach($faclist->result() as $faclistrow):
                                                        ?>
                                                        <option class="fac_select_<?php echo $faclistrow->jpmt_id;?>" value="<?php echo $faclistrow->jpmt_id;?>" <?php echo ($jpmt_id == $faclistrow->jpmt_id) ? 'selected' : ''; ?>><?php echo $faclistrow->jpnm."  (".$faclistrow->jpmt_id.")";?></option>
                                                    <?
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-sm-3">
                                                <select id="itemmt_id"
                                                        data-placeholder="상품을 선택하세요."
                                                        class="select2 form-control"
                                                        style="margin-top: 0px"
                                                        tabindex="-1"
                                                        name="itemmt_id">
                                                    <option value="">상품명</option>
                                                    <?
                                                    foreach($itemlist->result() as $itemlistrow):
                                                        ?>
                                                        <option class="itemmt_id_<?php echo $itemlistrow->item_id;?>" value="<?php echo $itemlistrow->item_id;?>" <?php echo ($itemmt_id == $itemlistrow->item_id) ? 'selected' : ''; ?>><?php echo $itemlistrow->item_nm."  (".$itemlistrow->item_id.")";?></option>
                                                    <?
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-sm-3">
                                                <select id="state"
                                                        data-placeholder="주문상태를 선택하세요."
                                                        class="select1 form-control"
                                                        tabindex="-1"
                                                        name="state"
                                                        style="margin-top: 5px">
                                                    <option value="">주문상태</option>
                                                    <option value="예약완료" <?php echo ($state == '예약완료') ? 'selected' : ''; ?>>예약완료</option>
                                                    <option value="접수" <?php echo ($state == '접수') ? 'selected' : ''; ?>>접수</option>
                                                    <option value="완료" <?php echo ($state == '완료') ? 'selected' : ''; ?>>완료</option>
                                                    <option value="대기" <?php echo ($state == '대기') ? 'selected' : ''; ?>>대기</option>
                                                    <option value="취소접수" <?php echo ($state == '취소접수') ? 'selected' : ''; ?>>취소접수</option>
                                                    <option value="취소" <?php echo ($state == '취소') ? 'selected' : ''; ?>>취소</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-3">
                                                <select id="usegu"
                                                        data-placeholder="이용상태를 선택하세요."
                                                        class="select1 form-control"
                                                        tabindex="-1"
                                                        name="usegu"
                                                        style="margin-top: 5px">
                                                    <option value="">이용상태</option>
                                                    <option value="1">사용</option>
                                                    <option value="2">미사용</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-6">
                                                <input type="text" name="dammemo" id="dammemo" maxlength="20"
                                                       class="form-control"
                                                       placeholder="메모내용 검색"
                                                       data-placement="top"
                                                       style="margin-top: 5px"
                                                       value="<?=$dammemo?>">
                                            </div>
                                        </div>
                                    </fieldset>

                                </div>

                                <div class="col-sm-offset-4 col-sm-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div style="margin-top:5px">
                                                <button type="button" id="or_srh" class="btn btn-block btn-primary">검 색</button>
                                            </div>
                                        </div>
                                        <?php
                                        if(true){
                                            ?>
                                            <div class="col-md-3">
                                                <div style="margin-top:5px">
                                                    <button type="button" class="btn btn-block btn-inverse" data-toggle="modal" data-target="#myModal_N_order">주문 등록</button>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <div class="col-md-2">
                                            <div style="margin-top:5px">
                                                <button type="button" id="cancel_btn" class="btn btn-block btn-danger">취 소</button>
                                            </div>
                                        </div>
                                        <?php
                                        if($viewexcel) {
                                            ?>
                                            <div class="col-md-3">
                                                <div style="margin-top:5px">
                                                    <button type="button" id="excel_btn" name="excel_btn"
                                                            class="btn btn-block btn-success" data-toggle="tooltip"
                                                            data-placement="bottom"
                                                            title="엑셀당 5만, 최대 50만건까지 다운 받을 수 있습니다. 검색되지 않는 오래된 데이터도 다운 받을수 있습니다.">
                                                        엑셀 다운
                                                    </button>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <div class="modal fade" id="myModal_N_order" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title text-align-center fw-bold mt" id="myModalLabel18">주문 등록</h4>
                                                    </div>
                                                    <div class="modal-body bg-gray-lighter">

                                                        <div class="row">
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label" for="company_select">고객 이름</label>
                                                                <div class="col-sm-7">
                                                                    <input type="text" name="Nusernm" id="Nusernm" maxlength="20"
                                                                           class="form-control"
                                                                           data-placement="top"
                                                                    >
                                                                </div>

                                                                <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">휴대폰 번호</label>
                                                                <div class="col-sm-7">
                                                                    <input type="tel" name="Nhp" id="Nhp" maxlength="20"
                                                                           class="form-control"
                                                                           data-placement="top"
                                                                           style="margin-top: 10px"
                                                                    >
                                                                </div>

                                                                <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">처리 상태</label>
                                                                <div class="col-sm-7" >
                                                                    <select id="state_select"
                                                                            class="select1 form-control"
                                                                            tabindex="-1"
                                                                            name="state_select"
                                                                            style="margin-top: 10px">
                                                                        <option value="예약완료">예약완료</option>
                                                                        <option value="접수">접수</option>
                                                                        <option value="완료">완료</option>
                                                                        <option value="대기">대기</option>
                                                                        <option value="취소접수">취소접수</option>
                                                                        <option value="취소">취소</option>
                                                                    </select>
                                                                </div>

                                                                <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">판매 채널</label>
                                                                <div class="col-sm-7">
                                                                    <select id="chn_select"
                                                                            data-placeholder="판매채널을 선택하세요."
                                                                            class="select2 form-control"
                                                                            tabindex="-1"
                                                                            name="chn_select"
                                                                            style="margin-top: 10px">
                                                                        <option value="">판매채널을 선택하세요.</option>
                                                                        <?
                                                                        foreach($cquery->result() as $crow):
                                                                            ?>
                                                                            <option class="chn_select_<?php echo $crow->com_id;?>" value="<?php echo $crow->com_id;?>"><?php echo $crow->com_nm."  (".$crow->com_id.")";?></option>
                                                                        <?
                                                                        endforeach;
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">시설 선택</label>
                                                                <div class="col-sm-7">
                                                                    <select id="fac_select"
                                                                            data-placeholder="시설명을 선택하세요."
                                                                            class="select2 form-control"
                                                                            style="margin-top: 10px"
                                                                            tabindex="-1"
                                                                            name="fac_select">
                                                                        <option value="">시설을 선택하세요.</option>
                                                                        <?
                                                                        foreach($faclist->result() as $faclistrow):
                                                                            ?>
                                                                            <option class="fac_select_<?php echo $faclistrow->jpmt_id;?>" value="<?php echo $faclistrow->jpmt_id;?>"><?php echo $faclistrow->jpnm."  (".$faclistrow->jpmt_id.")";?></option>
                                                                        <?
                                                                        endforeach;
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">상품 선택</label>
                                                                <div class="col-sm-7">
                                                                    <select id="item_select"
                                                                            data-placeholder="상품명을 선택하세요."
                                                                            class="select1 form-control"
                                                                            style="margin-top: 10px"
                                                                            tabindex="-1"
                                                                            name="item_select">
                                                                        <option value="">상품을 선택하세요.</option>
                                                                        <?
                                                                        foreach($itemlist->result() as $itemlistrow):
                                                                            ?>
                                                                            <option class="item_select_<?php echo $itemlistrow->item_id;?>" value="<?php echo $itemlistrow->item_id;?>"><?php echo $itemlistrow->item_nm."  (".$itemlistrow->item_id.")";?></option>
                                                                        <?
                                                                        endforeach;
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">이용일</label>
                                                                <div class="col-sm-7">
                                                                    <select id="date_select"
                                                                            data-placeholder="이용일을 선택하세요."
                                                                            class="select1 form-control"
                                                                            style="margin-top: 10px"
                                                                            tabindex="-1"
                                                                            name="date_select">
                                                                        <option value="">이용일을 선택하세요.</option>
                                                                        <?
                                                                        foreach($datelist->result() as $datelistrow):
                                                                            ?>
                                                                            <option class="date_select_<?php echo $datelistrow->price_id;?>" value="<?php echo $datelistrow->price_date;?>"><?php echo $datelistrow->price_date;?></option>
                                                                        <?
                                                                        endforeach;
                                                                        ?>
                                                                    </select>

                                                                </div>

                                                                <label class="col-sm-3 control-label" for="company_select">인원</label>
                                                                <div class="col-sm-7">
                                                                    <input type="number" name="Nman" id="Nman" maxlength="20"
                                                                           class="form-control"
                                                                           style="margin-top: 10px"
                                                                           data-placement="top"
                                                                    >
                                                                </div>

                                                                <label class="col-sm-3 control-label" for="company_select">판매채널 주문번호</label>
                                                                <div class="col-sm-7">
                                                                    <input type="text" name="Nchorderno" id="Nchorderno" maxlength="20"
                                                                           class="form-control"
                                                                           style="margin-top: 10px"
                                                                           data-placement="top"
                                                                    >
                                                                </div>

                                                                <label class="col-sm-3 control-label" for="company_select">쿠폰번호</label>
                                                                <div class="col-sm-7">
                                                                    <input type="text" name="Nbarcodeno" id="Nbarcodeno" maxlength="20"
                                                                           class="form-control"
                                                                           style="margin-top: 10px"
                                                                           data-placement="top"
                                                                    >
                                                                </div>

                                                                <label class="col-sm-3 control-label" for="company_select">메모</label>
                                                                <div class="col-sm-7">
                                                                    <textarea rows="4" class="form-control textarea_value" id="Nmemo"  name="Nmemo" style="margin-top: 10px"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-gray ordclose" data-dismiss="modal">닫기</button>
                                                        <button type="button" class="btn btn-success" id="ordinsert">주문 등록</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>


        <!-- 여기가 목록입니다람쥐~ -->

        <span id="testcode"></span>
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
                                <!--<span class="fw-semi-bold">Info: </span> 주문번호를 클릭하면 <span class="fw-semi-bold">상세페이지</span>를 볼 수 있습니다.<br/>-->
                                <span class="fw-semi-bold">판매</span> : <?php if($sumaccamt != 0)echo number_format($sumaccamt)."원 ";?> / <span class="fw-semi-bold">사용</span> : <?php if($sumuseamt != 0)echo number_format($sumuseamt)."원 ";?>
                            </div>
                            <div class="col-md-1" style="font-weight:bold"> 정렬방식 선택</div>
                            <div class="col-md-1">
                                <form id="align_form" name="align_form" method="post" action="/orderc/olist_align">
                                    <select style="width:120px" id="align" name="align">
                                        <option value="">- 선택 -</option>
                                        <option value="usegu_at" <?php echo ($align == 'usegu_at') ? 'selected' : ''; ?>>사용처리일자순</option>
                                        <option value="usernm" <?php echo ($align == 'usernm') ? 'selected' : ''; ?>>고객성명순</option>
                                        <option value="canceldate" <?php echo ($align == 'canceldate') ? 'selected' : ''; ?>>취소처리일자순</option>
                                        <option value="ch_id" <?php echo ($align == 'ch_id') ? 'selected' : ''; ?>>채널번호순</option>
                                    </select>
                                </form>
                            </div>
                            <div class="col-md-1">
                                <form id="num_form" name="num_form" method="post" action="/orderc/olist_limit">
                                    <select style="width:70px" id="limit" name="limit">
                                        <option value="">- 선택 -</option>
                                        <option value="10" <?php echo ($limit == '10') ? 'selected' : ''; ?>>10개씩</option>
                                        <option value="20" <?php echo ($limit == '20') ? 'selected' : ''; ?>>20개씩</option>
                                        <option value="30" <?php echo ($limit == '30') ? 'selected' : ''; ?>>30개씩</option>
                                        <option value="50" <?php echo ($limit == '50') ? 'selected' : ''; ?>>50개씩</option>
                                        <option value="100" <?php echo ($limit == '100') ? 'selected' : ''; ?>>100개씩</option>
                                    </select>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-lg mt-lg mb-0">
                                    <thead class="no-bd">
                                    <tr>
                                        <th class="hidden-xs">등록일 / 이용기간</th>
                                        <th class="hidden-xs">이름 / HP</th>
                                        <th class="no-sort hidden-xs">바코드</th>
                                        <th class="hidden-xs">판매처</th>
                                        <th class="hidden-xs">상품명(시설)</th>
                                        <th class="hidden-xs">구매수량</th>
                                        <th style="text-align: center">메모</th>
                                        <th class="hidden-xs">예약</th>
                                        <th class="hidden-xs">사용</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?
                                    foreach($query->result() as $row):
                                        ?>
                                        <?php if($row->usegu=="2"){?>
                                        <tr style="background-color: rgba(0, 0, 0, 0)" onmouseover="this.style.background='#f2f2f2'" onMouseOut="this.style.backgroundColor=''">
                                    <?php }if($row->usegu=="1"){?>
                                        <tr style="background-color: #D4F4FA">
                                    <?php }if($row->state == "취소"){?>
                                        <tr style="background-color: #FFD8D8">
                                    <?php }?>
                                        <td class="usedate<?=$row->id?> hidden-xs" style="font-size:12px;" name="usedate"><?=$row->created?><br><?=$row->usedate?>
                                        </td>
                                        <td class="nm<?=$row->id?> hidden-xs" style="font-size:12px;" name="nm"><?=$row->usernm?><br><?=$row->dhp?>
                                        </td>
                                        <td class="hidden-xs">
                                            <button data-toggle="modal" data-target="#myModal<?=$row->id?>" class="btn btn-default">
                                                <?php
                                                $bartext = str_replace(";","</br>",$row->barcode_no);
                                                $ordomit = mb_strimwidth($row->orderno, '0', '20', '...', 'utf-8');
                                                echo $bartext."<br/>(".$ordomit.")";
                                                ?>
                                            </button>
                                        </td>
                                        <td class="hidden-xs" style="font-size:12px;"><?=$row->chnm."(".$row->ch_id.")<br>".$row->ch_orderno?></td>
                                        <td class="hidden-xs">
                                                <span style="font-size:12px;" data-toggle="tooltip" data-placement="right" title="PCMS:<?=$row->itemmt_id?>">
													<?=$row->itemnm?><br>(<?=$row->jpnm?>)</span>
                                            <?php if($row->bigo != "" && $row->bigo != null){?>
                                                <span class="glyphicon glyphicon-eye-open" style="font-size:12px;" data-toggle="tooltip" data-placement="right" title="<?=$row->bigo?>"></span>
                                            <?php }?>
                                        </td>
                                        <td class="man<?=$row->id?> hidden-xs" style="font-size:12px;" name="man"><?=$row->man1?><br/>(<?php echo number_format($row->accamt); ?>원)
                                        </td>
                                        <td  class="hidden-xs"  style="font-size:10px;">
                                            <textarea id="bigo<?=$row->id?>" class="memomode" code="<?=$row->id?>" style="width: 150px; height: 50px;  border: 0px; background-color: transparent;"><?=$row->dammemo?></textarea>
                                        </td>
                                        <td class="hidden-xs" style="font-size:12px;">

                                            <!-- 새로운 버튼 제작 (사용된 주문이면 표시안함)-->
                                            <div class="btn-group">

                                                <?php
                                                if($row->state == "취소"){
                                                    $statebtnStyle = "danger";
                                                }else{
                                                    $statebtnStyle = "default";
                                                }
                                                ?>

                                                <button class="state_<?=$row->id?> btn btn-<?=$statebtnStyle?>" id="state_<?=$row->id?>" data-original-title="" title="">
                                                    <? echo $row->state; ?>
                                                </button>
                                                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" data-original-title="" title="">
                                                    <i class="fa fa-caret-down"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="decide_btn" code="<?=$row->id?>" state="예약완료" >예약완료</a></li>
                                                    <li><a class="decide_btn" code="<?=$row->id?>" state="접수" >접수</a></li>
                                                    <li><a class="decide_btn" code="<?=$row->id?>" state="완료" >완료</a></li>
                                                    <li><a class="decide_btn" code="<?=$row->id?>" state="대기" >대기</a></li>
                                                    <li class="divider"></li>
                                                    <li><a class="decide_btn" code="<?=$row->id?>" state="취소접수" >취소접수</a></li>
                                                    <li><a class="decide_btn" code="<?=$row->id?>" state="취소" >취소</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td class="usegu<?=$row->id?> hidden-xs" style="font-size:12px;" name="usegu">
                                            <div class="btn-group">
                                                <button class="use_<?=$row->id?> btn btn-default" id="use_<?=$row->id?>" data-original-title="" title="">
                                                    <?
                                                    if($row->usegu == '1'){
                                                        echo "사용 ";
                                                    }else if($row->usegu == '2'){
                                                        echo "미사용";
                                                    }else{
                                                        echo $row->usegu;
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

                                        <!-- Modal -->
                                        <td style="font-size:12px;">
                                            <div class="modal fade" id="myModal<?=$row->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title text-align-center fw-bold mt" id="myModalLabel18">상세페이지~~</h4>
                                                        </div>
                                                        <div class="modal-body bg-gray-lighter">

                                                            <div class="row">
                                                                <div class="form-group">

                                                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">주문순번</label>
                                                                    <div class="col-sm-7">
                                                                        <input type="text" name="id" id="id" maxlength="20"
                                                                               class="form-control" data-placement="top" style="border:0; background-color: transparent;" readonly="readonly" value="<?=$row->id?>">
                                                                    </div>

                                                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">등록일</label>
                                                                    <div class="col-sm-7">
                                                                        <input type="text" name="created" id="created" maxlength="20"
                                                                               class="form-control" data-placement="top" style="border:0; background-color: transparent;" readonly="readonly" value="<?=$row->created?>">
                                                                    </div>


                                                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">주문번호</label>
                                                                    <div class="col-sm-7">
																		 <textarea name="orderno" id="orderno" class="form-control"
                                                                                   data-placement="top" style="border:0; background-color: transparent; font-size:9pt;" readonly="readonly"><?=$row->orderno?></textarea>
                                                                    </div>

                                                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">채널주문번호</label>
                                                                    <div class="col-sm-7">
																		 <textarea name="ch_orderno" id="ch_orderno" class="form-control"
                                                                                   data-placement="top" style="border:0; background-color: transparent; font-size:9pt; margin-top: 5px;" readonly="readonly"><?=$row->ch_orderno?></textarea>
                                                                    </div>


                                                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">이름</label>
                                                                    <div class="col-sm-7">
                                                                        <input type="text" id="nmmode<?=$row->id?>" maxlength="20" code="<?=$row->id?>"
                                                                               class="nmmode form-control" data-placement="top" style="margin-top: 10px" value="<?=$row->usernm?>">
                                                                    </div>

                                                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">판매처</label>
                                                                    <div class="col-sm-7">

                                                                        <select id="detail_chm<?=$row->id?>"
                                                                                class="detail_chm form-control"
                                                                                tabindex="-1"
                                                                                code="<?=$row->id?>"
                                                                                style="margin-top: 0px">
                                                                            <?
                                                                            foreach($cquery->result() as $crow):
                                                                                ?>
                                                                                <option class="chnm_<?php echo $crow->com_id;?>" value="<?php echo $crow->com_id;?>" <?php echo ($row->chnm == $crow->com_nm) ? 'selected' : ''; ?>><?php echo $crow->com_nm;?></option>
                                                                            <?
                                                                            endforeach;
                                                                            ?>
                                                                        </select>
                                                                        <input type="text" name="chnm" id="chnm" maxlength="20"
                                                                               class="form-control" data-placement="top" style="border:0; background-color: transparent;" readonly="readonly" value="<?=$row->chnm?>">
                                                                    </div>

                                                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">시설</label>
                                                                    <div class="col-sm-7">
                                                                        <input type="text" name="jpnm" id="jpnm" maxlength="20"
                                                                               class="form-control" data-placement="top" style="border:0; background-color: transparent;" readonly="readonly" value="<?=$row->jpnm?>">
                                                                    </div>

                                                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">사용</label>
                                                                    <div class="col-sm-7">
                                                                        <div class="btn-group" style="margin-top: 10px">
                                                                            <button class="use_<?=$row->id?> btn btn-default" id="use_<?=$row->id?>" data-original-title="" title="">
                                                                                <?
                                                                                if($row->usegu == '1'){
                                                                                    echo "사용 ";
                                                                                }else if($row->usegu == '2'){
                                                                                    echo "미사용";
                                                                                }else{
                                                                                    echo $row->usegu;
                                                                                }
                                                                                ?>
                                                                            </button>
                                                                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" data-original-title="" title="">
                                                                                <i class="fa fa-caret-down"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu">
                                                                                <li><a class="y_btn" code="<?=$row->id?>">사용</a></li>
                                                                                <!-- <li class="divider"></li> -->
                                                                                <li><a class="n_btn" code="<?=$row->id?>">미사용</a></li>
                                                                            </ul>
                                                                        </div>
                                                                        <?php
                                                                        if($row->usegu == '1'){
                                                                            echo $row->usegu_at;
                                                                        }
                                                                        ?>
                                                                    </div>

                                                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">쿠폰관리</label>
                                                                    <div class="col-sm-7" style="margin-top: 10px">
                                                                        <?php
                                                                        if(in_array($row->jpmt_id,$syncJpmts)) {
                                                                            ?>
                                                                            <a class="conf btn btn-default" data-toggle="tooltip"
                                                                               data-placement="top"
                                                                               title="이용확인" barcode="<?= $row->barcode_no ?>"
                                                                               ojpid="<?= $row->jpmt_id ?>" ojpnm="<?= $row->jpnm ?>"
                                                                               orid="<?= $row->id ?>">
                                                                                이용확인
                                                                            </a>

                                                                            <a class="disuse btn btn-default" data-toggle="tooltip"
                                                                               data-placement="top"
                                                                               title="쿠폰폐기" barcode="<?=$row->barcode_no?>" ojpid="<?=$row->jpmt_id?>"
                                                                               ojpnm="<?=$row->jpnm?>"orid="<?=$row->id?>">
                                                                                쿠폰폐기
                                                                            </a>
                                                                            <?php
                                                                        }else{
                                                                            //echo $row->jpmt_id;
                                                                            echo "<br/>";
                                                                        }
                                                                        ?>
                                                                        <input type="text"maxlength="50" class="form-control"
                                                                               style="border:0; background-color: transparent; height:0px" readonly="readonly">
                                                                    </div>

                                                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">메모</label>
                                                                    <div class="col-sm-7">
                                                                        <textarea rows="3" class="memomode form-control textarea_value" id="memomode<?=$row->id?>" name="dammemo" code="<?=$row->id?>"
                                                                                  style="margin-top: 10px"><?=$row->dammemo?></textarea>
                                                                    </div>

                                                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">이용기간</label>
                                                                    <div class="col-sm-7">
                                                                        <div>
                                                                            <input type="date" id="udatemode<?=$row->id?>" maxlength="20" code="<?=$row->id?>"
                                                                                   class="udatemode form-control" data-placement="top" style="margin-top: 10px" value="<?=$row->usedate?>">
                                                                        </div>
                                                                    </div>

                                                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">바코드</label>
                                                                    <div class="col-sm-7" style="margin-top: 10px">

                                                                        <?php
                                                                        if($row->barcode_no){
                                                                            $bartext = str_replace(";","</br>",$row->barcode_no);
                                                                            echo $bartext;
                                                                        }else{
                                                                            echo "<br/>";
                                                                        }
                                                                        ?>
                                                                        <input type="text" name="barcode_no" id="barcode_no" maxlength="50" class="form-control"
                                                                               style="border:0; background-color: transparent; height:0px" readonly="readonly">

                                                                    </div>

                                                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">HP</label>
                                                                    <div class="col-sm-7">
                                                                        <input type="tel" name="dhp" id="hpmode<?=$row->id?>" maxlength="20" code="<?=$row->id?>"
                                                                               class="hpmode form-control" data-placement="top" style="margin-top: 10px" value="<?=$row->dhp?>">
                                                                    </div>

                                                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">구매수량</label>
                                                                    <div class="col-sm-7">
                                                                        <input type="text" name="man1" id="qtymode<?=$row->id?>" maxlength="20" code="<?=$row->id?>"
                                                                               class="qtymode form-control" data-placement="top" style="margin-top: 10px" value="<?=$row->man1?>">
                                                                    </div>

                                                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">결제액</label>
                                                                    <div class="col-sm-7">
                                                                        <input type="text" name="accamt" id="accamt" class="form-control" data-placement="top"
                                                                               style="border:0; background-color:transparent; font-size:9pt; margin-top:10px;" readonly="readonly" value="<?=number_format($row->accamt)?>원">
                                                                    </div>

                                                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">상품명</label>
                                                                    <div class="col-sm-7">
																		 <textarea name="itemnm" id="itemnm" maxlength="20" class="form-control"
                                                                                   data-placement="top" style="border:0; background-color: transparent; font-size:9pt;" readonly="readonly"><?=$row->itemnm?></textarea>
                                                                    </div>

                                                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">상품구분</label>
                                                                    <div class="col-sm-7">
                                                                        <input id="dangumode<?=$row->id?>" type="text" class="dangumode form-control"
                                                                               code="<?=$row->id?>" maxlength="10" value="<?=$row->dangu?>" oldvalue="<?=$row->dangu?>" size="10"
                                                                               style="margin-top: 10px">
                                                                        <br/>
                                                                    </div>


                                                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">처리 상태</label>
                                                                    <div class="col-sm-7">
                                                                        <div class="btn-group">

                                                                            <?php
                                                                            if($row->state == "취소"){
                                                                                $statebtnStyle = "danger";
                                                                            }else{
                                                                                $statebtnStyle = "default";
                                                                            }
                                                                            ?>

                                                                            <button class="state_<?=$row->id?> btn btn-<?=$statebtnStyle?>" id="state_<?=$row->id?>" data-original-title="" title="">
                                                                                <? echo $row->state; ?>
                                                                            </button>
                                                                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" data-original-title="" title="">
                                                                                <i class="fa fa-caret-down"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu">
                                                                                <li><a class="decide_btn" code="<?=$row->id?>" state="예약완료">예약완료</a></li>
                                                                                <li><a class="decide_btn" code="<?=$row->id?>" state="접수" >접수</a></li>
                                                                                <li><a class="decide_btn" code="<?=$row->id?>" state="완료" >완료</a></li>
                                                                                <li><a class="decide_btn" code="<?=$row->id?>" state="대기" >대기</a></li>
                                                                                <li class="divider"></li>
                                                                                <li><a class="decide_btn" code="<?=$row->id?>" state="취소접수" >취소접수</a></li>
                                                                                <li><a class="decide_btn" code="<?=$row->id?>" state="취소" >취소</a></li>

                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">SMS</label>
                                                                    <div class="col-sm-7">
                                                                        <a class="sendsms btn btn-default" data-toggle="tooltip" data-placement="top" style="margin-top: 10px"
                                                                           title="QR상품(에버랜드,민속촌)도 재발송 가능합니다." orid="<?= $row->id ?>">문자전송</a>
                                                                    </div>

                                                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">시설 예약번호</label>
                                                                    <div class="col-sm-7">
                                                                        <input id="resnomode<?=$row->id?>" type="text" class="resnomode form-control"
                                                                               code="<?=$row->id?>" maxlength="20" value="<?=$row->resno?>" oldvalue="<?=$row->resno?>" size="30"
                                                                               style="margin-top: 10px">
                                                                        <br/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-gray ordclose" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
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
                <?php } ?>
            </div>

        </div>


        <!-- 엑셀다운로드시 생기는 테이블 -->
        <div class="row">
            <div class="col-md-12">
                <?php if($equery->num_rows > 0){?>
                    <section class="widget">
                        <header>
                            <div class="widget-controls">
                                <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a>
                                <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a>
                                <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>
                            </div>
                        </header>
                        <div class="widget-body">

                            <div class="alert alert-danger alert-sm">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                파일 생성에는 <span class="fw-semi-bold">한시간</span> 정도 소요됩니다.

                            </div>
                            <div class="excel-table">
                                <table class="table table-striped table-lg mt-lg mb-0">
                                    <thead class="no-bd">
                                    <tr>
                                        <th class="hidden-xs">요청시간</th>
                                        <th class="hidden-xs">담당자</th>
                                        <th class="hidden-xs">상태</th>
                                        <th class="hidden-xs">비고</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach($equery->result() as $row): ?>
                                        <?php if($row->state == "E"){ ?>
                                            <tr class="danger">
                                        <?php }else{ ?>
                                            <tr>
                                        <?php }?>
                                        <td class="created hidden-xs" style="font-size:12px;" name="created"><?=$row->created?></td>
                                        <td class="damnm hidden-xs" style="font-size:12px;" name="damnm"><?=$row->damnm?></td>
                                        <td class="state hidden-xs" style="font-size:12px;" name="state"><?=$estate[$row->state]?></td>
                                        <td class="bigo hidden-xs" style="font-size:12px;" name="bigo"><?=$row->bigo?></td>
                                        <td>
                                        <?php if($row->state == "S"){ ?>
                                        <div class="icon-list-item col-md-3 col-sm-4"><a onclick="exceldown('<?=$row->filename?>');"><i class="fa fa-file-excel-o"></i></a></div></td>
                                    <?php }if($row->state == "R"){ ?>
                                            <div class="icon-list-item col-md-3 col-sm-4"><a><i class="fa fa-spinner"></i></a></div></td>
                                        <?php }?>

                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </section>
                <?php }?>
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
        if((event.keyCode<48) || (event.keyCode>57)){
            event.returnValue=false;
        }
    }

    function exceldown(filename){
        window.location.assign('<?php echo site_url('orderc/excelDown'); ?>'+"/"+filename);
    }

    $(function(){
        $("#limit").change(function(){
            $("#num_form").submit();
        });
    });

    $(function(){
        $("#align").change(function(){
            $("#align_form").submit();
        });
    });

    function usestate(code,use_state){
        var use_text = "";
        if(use_state == "1"){
            use_text = "사용";
        }else if(use_state == "2"){
            use_text = "미사용";
        }else{
            return false;
        }
        if(confirm(use_text+" 상태로 변경하시겠습니까?")){
            $.ajax({
                url: "<?php echo site_url('order/or_use_N'); ?>",
                data: {code : code , usegu : use_state},
                type:"POST",
                success:function(msg)
                {
                    if (msg == "err"){
                        alert("변경에 실패하였습니다.");
                        $(location).attr('href','/orderc/olist');
                    }else if(msg == "ok"){
                        $('.use_'+code).text(use_text);
                        alert("변경되었습니다.");
                    }
                }
            })
        }
    }

    $(function(){

        $("#fac_select").change(function(){
            var facid = $(this).val();

            $.ajax({
                url: "<?php echo site_url('order/get_itemlist'); ?>",
                data: {facid : facid},
                type:"POST",
                success:function(msg)
                {
                    $("#item_select").html(msg);
                }
            })

        });

        $(".detail_chm").change(function () {
            var code = $(this).attr('code');

            if(confirm("채널 변경을 하시겠습니까?")){

                var modtext = $('option:selected',this).text();
                var modval = $(this).val();
                alert(modval);
                alert(modtext);
                $.ajax({
                    url: "<?php echo site_url('order/orderN_modify_ch'); ?>",
                    data: {code : code, modtext:modtext ,modval:modval},
                    type:"POST",
                    success:function(msg)
                    {
                        if(msg == 'err'){
                            alert('저장 실패	');
                        } else {
                            alert(msg);
                        }
                        //$("#bigo"+code).html(msg);
                    }
                })
            }
        });

        $("#item_select").change(function(){
            var itemid = $(this).val();

            $.ajax({
                url: "<?php echo site_url('orderc/get_usedate'); ?>",
                data: {itemid : itemid},
                type:"POST",
                success:function(msg)
                {
                    $("#date_select").html(msg);
                }
            })

        });



        $(".sendsms").click(function() {

            var orid = $(this).attr('orid');
            if(confirm("문자 재발송 하시겠습니까?")){
                $.ajax({
                    url: "<?php echo site_url('order/sms_resend'); ?>",
                    data: {orid : orid},
                    type:"POST",
                    success:function(msg)
                    {
                        //alert(msg);
                        if (msg == "err"){
                            alert("재발송 실패.");
                        }else if(msg == "ok"){
                            alert("재발송 요청 되었습니다.");
                        }
                    }
                })
            }
        });

        $(".nmmode").click(function() {
            var code = $(this).attr('code');
            $("#nmmode"+code).css('background-color','#8c8c8c');//transparent
            $("#nmmode"+code).css('color','white');
        });

        $(".nmmode").on('change',function() {
            var code = $(this).attr('code');
            if(confirm("이름을 변경 하시겠습니까?")){
                $("#nmmode"+code).css('background-color','transparent');
                $("#nmmode"+code).css('color','#8c8c8c');
                var modtext = $("#nmmode"+code).val();
                $("#nmmode"+code).blur();

                $.ajax({
                    url: "<?php echo site_url('order/orderN_modify_nm'); ?>",
                    data: {code : code, modtext:modtext},
                    type:"POST",
                    success:function(msg)
                    {
                        $("#bigo"+code).html(msg);
                        $(".nm"+code).html(modtext);
                    }
                })
            }else{
                $("#nmmode"+code).css('background-color','transparent');
                $("#nmmode"+code).css('color','black');
                $("#nmmode"+code).val($(this).attr('oldvalue'));
                $("#nmmode"+code).blur();
            }
        });

        $(".dangumode").click(function() {
            var code = $(this).attr('code');
            $("#dangumode"+code).css('background-color','#8c8c8c');//transparent
            $("#dangumode"+code).css('color','white');
            //$(this).css('border','1px;');
        });

        $(".dangumode").on('change',function() {
            var code = $(this).attr('code');
            if(confirm("상품 구분을 변경 하시겠습니까?")){
                $("#dangumode"+code).css('background-color','transparent');
                $("#dangumode"+code).css('color','#8c8c8c');
                var modtext = $("#dangumode"+code).val();
                $("#dangumode"+code).blur();

                $.ajax({
                    url: "<?php echo site_url('order/orderN_modify_dangu'); ?>",
                    data: {code : code, modtext:modtext},
                    type:"POST",
                    success:function(msg)
                    {
                        $("#bigo"+code).html(msg);
                    }
                })
            }else{
                $("#dangumode"+code).css('background-color','transparent');
                $("#dangumode"+code).css('color','black');
                $("#dangumode"+code).val($(this).attr('oldvalue'));
                $("#dangumode"+code).blur();
            }

        });

        $(".resnomode").click(function() {
            var code = $(this).attr('code');
            $("#resnomode"+code).css('background-color','#8c8c8c');//transparent
            $("#resnomode"+code).css('color','white');
            //$(this).css('border','1px;');
        });

        $(".resnomode").on('change',function() {
            var code = $(this).attr('code');
            if(confirm("시설 예약번호를 변경 하시겠습니까?")){
                $("#resnomode"+code).css('background-color','transparent');
                $("#resnomode"+code).css('color','#8c8c8c');
                var modtext = $("#resnomode"+code).val();
                $("#resnomode"+code).blur();

                $.ajax({
                    url: "<?php echo site_url('order/orderN_modify_resno'); ?>",
                    data: {code : code, modtext:modtext},
                    type:"POST",
                    success:function(msg)
                    {
                        $("#bigo"+code).html(msg);
                    }
                })
            }else{
                $("#resnomode"+code).css('background-color','transparent');
                $("#resnomode"+code).css('color','black');
                $("#resnomode"+code).val($(this).attr('oldvalue'));
                $("#resnomode"+code).blur();
            }

        });




        $(".udatemode").click(function() {
            var code = $(this).attr('code');
            $("#udatemode"+code).css('background-color','#8c8c8c');//transparent
            $("#udatemode"+code).css('color','white');
        });

        $(".udatemode").on('change',function() {
            var code = $(this).attr('code');
            if(confirm("이용기간을 변경 하시겠습니까?")){
                $("#udatemode"+code).css('background-color','transparent');
                $("#udatemode"+code).css('color','#8c8c8c');
                var modtext = $("#udatemode"+code).val();
                $("#udatemode"+code).blur();

                $.ajax({
                    url: "<?php echo site_url('order/orderN_modify_usedate'); ?>",
                    data: {code : code, modtext:modtext},
                    type:"POST",
                    success:function(msg)
                    {
                        $("#bigo"+code).html(msg);
                    }
                })

            }else{
                $("#udatemode"+code).css('background-color','transparent');
                $("#udatemode"+code).css('color','black');
                $("#udatemode"+code).val($(this).attr('oldvalue'));
                $("#udatemode"+code).blur();
            }
        });


        $(".hpmode").click(function() {
            var code = $(this).attr('code');
            $("#hpmode"+code).css('background-color','#8c8c8c');//transparent
            $("#hpmode"+code).css('color','white');
        });

        $(".hpmode").on('change',function() {
            var code = $(this).attr('code');
            if(confirm("휴대폰 번호를 변경 하시겠습니까?")){
                $("#hpmode"+code).css('background-color','transparent');
                $("#hpmode"+code).css('color','#8c8c8c');
                var modtext = $("#hpmode"+code).val();
                $("#hpmode"+code).blur();

                $.ajax({
                    url: "<?php echo site_url('order/orderN_modify_hp'); ?>",
                    data: {code : code, modtext:modtext},
                    type:"POST",
                    success:function(msg)
                    {
                        $("#bigo"+code).html(msg);
                        $(".hp"+code).html(modtext);
                    }
                })

            }else{
                $("#hpmode"+code).css('background-color','transparent');
                $("#hpmode"+code).css('color','black');
                $("#hpmode"+code).val($(this).attr('oldvalue'));
                $("#hpmode"+code).blur();
            }
        });

        $(".qtymode").click(function() {
            var code = $(this).attr('code');
            $("#qtymode"+code).css('background-color','#8c8c8c');//transparent
            $("#qtymode"+code).css('color','white');
        });

        $(".qtymode").on('change',function() {
            var code = $(this).attr('code');
            if(confirm("수량을 변경 하시겠습니까?")){
                $("#qtymode"+code).css('background-color','transparent');
                $("#qtymode"+code).css('color','#8c8c8c');
                var modtext = $("#qtymode"+code).val();
                $("#qtymode"+code).blur();

                $.ajax({
                    url: "<?php echo site_url('order/orderN_modify_qty'); ?>",
                    data: {code : code, modtext:modtext},
                    type:"POST",
                    success:function(msg)
                    {
                        $("#bigo"+code).html(msg);
                        $(".man"+code).html(modtext);
                    }
                })

            }else{
                $("#qtymode"+code).css('background-color','transparent');
                $("#qtymode"+code).css('color','black');
                $("#qtymode"+code).val($(this).attr('oldvalue'));
                $("#qtymode"+code).blur();
            }

        });

        $(".memomode").click(function() {
            var code = $(this).attr('code');
            $("#memomode"+code).css('background-color','#8c8c8c');//transparent
            $("#memomode"+code).css('color','white');
        });

        $(".memomode").on('change',function(){
            var code = $(this).attr('code');
            if(confirm("메모를 저장 하시겠습니까?")){
                $("#memomode"+code).css('background-color','transparent');
                $("#memomode"+code).css('color','#8c8c8c');
                var modtext = $(this).val();
                $("#memomode"+code).blur();

                $.ajax({
                    url: "<?php echo site_url('order/orderN_modify_memo'); ?>",
                    data: {code : code, modtext:modtext},
                    type:"POST",
                    success:function(msg)
                    {
                        if(msg == 'err'){
                            alert('저장 실패	');
                        }
                        //$("#bigo"+code).html(msg);
                    }
                })
            }else{
                $("#memomode"+code).css('background-color','transparent');
                $("#memomode"+code).css('color','black');
                $("#memomode"+code).val($(this).attr('oldvalue'));
                $("#memomode"+code).blur();
            }
        });

        $('.y_btn').click(function(){
            //alert("사용버튼");
            var code = $(this).attr('code');
            usestate(code,"1");
        });

        $('.n_btn').click(function(){
            //alert("미사용버튼");
            var code = $(this).attr('code');
            usestate(code,"2");
        });

        $('.decide_btn').click(function(){
            //alert("정지버튼");
            var code = $(this).attr('code');
            var state = $(this).attr('state');
            if(confirm("이 주문을 "+state+"상태로 변경하시겠습니까?")){
                $.ajax({
                    url: "<?php echo site_url('order/orderN_state'); ?>",
                    data: {code : code, state:state},
                    type:"POST",
                    success:function(msg)
                    {
                        var res = msg.split("|");
                        if (res[0] == "err"){
                            alert(res[1]);
                            return false;
                        }else if(res[0] == "ok"){

                            $('.state_'+code).text(state);
                        }
                    }
                })
            }
        });

        $('#ordinsert').click(function(){
            var Nusernm = $('#Nusernm').val(); //고객 이름
            var Nhp = $('#Nhp').val(); // 휴대폰 번호
            var state_select = $('#state_select').val(); // 예약완료
            var chn_select = $('#chn_select').val(); // 판매채널 ( 2번DB )
            var item_select = $('#item_select').val(); // 상품선택 ( 2번DB )
            var date_select = $('#date_select').val(); // 이용일 ( 2번DB )
            var Nman = $('#Nman').val(); // 인원
            var Nchorderno = $('#Nchorderno').val(); // 판매채널 주문번호
            var Nmemo = $('#Nmemo').val(); // 메모
            var Nbarcodeno = $('#Nbarcodeno').val(); // 쿠폰번호

            if(Nusernm == "" || Nusernm == null){
                alert("고객 이름을 입력해주세요.");
                $('#Nusernm').focus();
                return false;
            }

            if(Nhp == "" || Nhp == null){
                alert("휴대폰 번호를 입력해주세요.");
                $('#Nhp').focus();
                return false;
            }

            if(chn_select == "" || chn_select == null){
                alert("판매채널을 선택해주세요.");
                return false;
            }

            if(item_select == "" || item_select == null){
                alert("상품을 선택해주세요.");
                return false;
            }

            if(date_select == "" || date_select == null){
                alert("이용일을 선택해주세요.");
                return false;
            }

            if(Nman == "" || Nman == null){
                alert("인원을 입력해주세요.");
                $('#Nman').focus();
                return false;
            }

            $('#ordinsert').hide();

            $.ajax({
                url: "<?php echo site_url('/orderc/insert_order'); ?>",
                data: {Nusernm:Nusernm,Nhp:Nhp,state_select:state_select,chn_select:chn_select,item_select:item_select,date_select:date_select,Nman:Nman,Nchorderno:Nchorderno,Nmemo:Nmemo,Nbarcodeno:Nbarcodeno},
                type:"POST",
                success:function(msg)
                {
                    var res = msg.split("|");
                    alert(res[1]);
                    if(res[0] == 'ok'){
                        $(location).attr('href','/orderc/olist');
                    }
                }
            })
        });


        $('#or_srh').click(function(){
            $('#fform').submit();
        });

        $('#cancel_btn').click(function(){
            $(location).attr('href','/orderc/olist/new');
        });

        $('#excel_btn').click(function(){
            var selectdate = $('#selectdate').val();
            var sdate = $('#sdate').val();
            var edate = $('#edate').val();
            var usedate = $('#usedate').val();
            var usernm = $('#usernm').val();
            var userhp = $('#userhp').val();
            var orderno = $('#orderno').val();
            var barcodeno = $('#barcodeno').val();
            var grnm = $('#grnm').val();
            var jpmt_id = $('#jpmt_id').val();
            var jpnm = $('#jpnm').val();
            var itemmt_id = $('#itemmt_id').val();
            var itemnm = $('#itemnm').val();
            var ch_id = $('#ch_id').val();
            var chnm = $('#chnm').val();
            var ch_orderno = $('#ch_orderno').val();
            var state = $('#state').val();
            var usegu = $('#usegu').val();
            var dammemo = $('#dammemo').val();

            $('#excel_btn').hide();

            if(confirm("엑셀을 다운로드 하시겠습니까?")){
                $.ajax({
                    url: "<?php echo site_url('/orderc/excel_que'); ?>",
                    data:{selectdate:selectdate,sdate:sdate,edate:edate,usedate:usedate,usernm:usernm,userhp:userhp,orderno:orderno,barcodeno:barcodeno,grnm:grnm,
                        jpmt_id:jpmt_id,jpnm:jpnm,itemmt_id:itemmt_id,itemnm:itemnm,ch_id:ch_id,chnm:chnm,ch_orderno:ch_orderno,state:state,usegu:usegu,dammemo:dammemo},
                    type:"POST",
                    success:function(msg)
                    {
                        //                    alert(msg);
                        alert("엑셀 다운로드가 요청되었습니다");
                        $(location).attr('href','/orderc/olist');
                    }
                })
            }
        });

        $('.conf').click(function(){
            $.ajax({

                url: "<?php echo site_url('/order/ajorder'); ?>",
                data: {orid : $(this).attr('orid') , ojpid : $(this).attr('ojpid'), ojpnm : $(this).attr('ojpnm'), barcode : $(this).attr('barcode')},
                type:"POST",
                success:function(msg)
                {
                    alert(msg);
                    $('#testcode').text(msg);
                }
            })
        });

        $('.disuse').click(function(){
            if(confirm($(this).attr('ojpnm')+"의 쿠폰을 폐기하시겠습니까?")){
                $.ajax({
                    url: "<?php echo site_url('/order/ajdisuse'); ?>",
                    data: {orid : $(this).attr('orid') , ojpid : $(this).attr('ojpid'), ojpnm : $(this).attr('ojpnm'), barcode : $(this).attr('barcode')},
                    type:"POST",
                    success:function(msg)
                    {
                        alert(msg);
                        $('#testcode').text(msg);
                    }
                })
            }
        });
    });
</script>
