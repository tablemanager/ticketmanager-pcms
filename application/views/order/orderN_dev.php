<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold">뉴스파로 주문 관리 <? if($total != 0)echo $total."건";  ?></span></h3>
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

                        <?php
                        if ($this->session->userdata('cd') == 'penfen' && $viewtable){
                            //echo $ip;
                            ?>
                            <div class="alert alert-danger alert-sm">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <span class="fw-semi-bold"><?if($viewtable)echo $where;?></span>
                            </div>

                            <?php
                        }
                        ?>

                        <form  role="form" id="fform" name="fform" class="form-horizontal" role="form" method="post" action="/order/ordserN_dev" >

                                <div class="row">
                                    <div class="col-md-3">
                                        <fieldset>
                                            <legend>
                                                날짜 검색
                                            </legend>

                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <select name="selectdate" id="selectdate" class="selectpicker" >
                                                        <option value="mdate">접수일</option>
                                                        <option value="usedate">이용기간</option>
                                                        <option value="canceldate">취소처리일</option>
                                                        <option value="usegu_at">이용처리일</option>
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
                                                                <option class="chnm_<?php echo $crow->com_id;?>" value="<?php echo $crow->com_nm;?>"><?php echo $crow->com_nm."  (".$crow->com_id.")";?></option>
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
                                                        <input type="text" name="jpnm" id="jpnm" maxlength="20"
                                                               class="form-control"
                                                               placeholder="시설명"
                                                               data-placement="top"
                                                               value="<?=$jpnm?>">
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <input type="text" name="itemnm" id="itemnm" maxlength="20"
                                                               class="form-control"
                                                               placeholder="상품명"
                                                               data-placement="top"
                                                               style="margin-top: 0px"
                                                               value="<?=$itemnm?>">
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <select id="state"
                                                                data-placeholder="주문상태를 선택하세요."
                                                                class="select1 form-control"
                                                                tabindex="-1"
                                                                name="state"
                                                                style="margin-top: 5px">
                                                            <option value="">주문상태</option>
                                                            <option value="예약완료">예약완료</option>
                                                            <option value="접수">접수</option>
                                                            <option value="완료">완료</option>
                                                            <option value="대기">대기</option>
                                                            <option value="취소접수">취소접수</option>
                                                            <option value="취소">취소</option>
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
                                            if($viewexcel){
                                            ?>
                                            <div class="col-md-3">
                                                <div style="margin-top:5px">
                                                    <button type="button" id="excel_btn" class="btn btn-block btn-success" data-toggle="tooltip" data-placement="bottom"
                                                            title="최대 50000건 까지 다운받을 수 있습니다. 데이터가 많을수록 오래 걸립니다. 기다려주세요.">엑셀 다운</button>
                                                </div>
                                            </div>
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
                                            if ($this->session->userdata('cd') == 'penfen' && $viewtable){

                                            ?>
                                                <div class="col-md-4">
                                                    <div style="margin-top:5px">
                                                        <button type="button" id="serach_excel_btn" class="btn btn-block btn-success">검색 결과 엑셀다운로드</button>
                                                    </div>
                                                </div>

                                                <?php
                                            }
                                            ?>

                                            <div class="modal fade" id="myModal_N_order" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
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
                                                                                class="select1 form-control"
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

                                                                    <?php
                                                                    if ($this->session->userdata('cd') == 'penfen' || true ){
                                                                        //echo $ip;
                                                                    ?>
                                                                    <label class="col-sm-3 control-label" for="company_select" style="margin-top: 10px">시설 선택</label>
                                                                    <div class="col-sm-7">
                                                                        <select id="fac_select"
                                                                                data-placeholder="시설명을 선택하세요."
                                                                                class="select1 form-control"
                                                                                style="margin-top: 10px"
                                                                                tabindex="-1"
                                                                                name="fac_select">
                                                                            <option value="">시설을 선택하세요.</option>
                                                                            <?
                                                                            foreach($faclist->result() as $faclistrow):
                                                                                ?>
                                                                                <option class="item_select_<?php echo $faclistrow->jpmt_id;?>" value="<?php echo $faclistrow->jpmt_id;?>"><?php echo $faclistrow->jpnm."  (".$faclistrow->jpmt_id.")";?></option>
                                                                                <?
                                                                            endforeach;
                                                                            ?>
                                                                        </select>
                                                                    </div>

                                                                    <?php
                                                                    }
                                                                    ?>

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
                                                                        <input type="date" name="Nusedate" id="Nusedate" maxlength="20"
                                                                               class="form-control"
                                                                               style="margin-top: 10px"
                                                                               data-placement="top"
                                                                               style="margin-top: 10px"
                                                                        >
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
                                <span class="fw-semi-bold">Info:</span> 주문번호에 마우스를 가져가면 <span class="fw-semi-bold">바코드번호</span>를 볼수 있습니다.
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-lg mt-lg mb-0">
                                    <thead class="no-bd">
                                    <tr>
                                        <td colspan="31" style="border-top:1px solid rgba(0, 0, 0, 0); border-bottom:1px solid rgba(0, 0, 0, 0); background-color: rgba(221, 221, 214, 0.93)"></td>
                                    </tr>
                                    <tr>
                                        <th>등록일</th>
                                        <th class="no-sort hidden-xs">주문번호</th>
                                        <th class="hidden-xs">이름</th>
                                        <th class="hidden-xs">판매처</th>
                                        <th class="hidden-xs">시설</th>
                                        <th class="hidden-xs">사용</th>
                                        <th>쿠폰관리</th>
                                        <th style="text-align: center">메모</th>
                                    </tr>
                                    <tr>
                                        <th>이용기간</th>
                                        <th class="no-sort hidden-xs">바코드</th>
                                        <th class="hidden-xs">HP</th>
                                        <th class="hidden-xs">구매수량</th>
                                        <th class="hidden-xs">상품명</th>
                                        <th class="hidden-xs">예약</th>
                                        <th>SMS</th>
                                        <th style="text-align: center">예약번호</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?

                                    foreach($query->result() as $row):
                                        ?>

                                        <tr>
                                            <td colspan="31" style="border-top:1px solid rgba(0, 0, 0, 0); border-bottom:1px solid rgba(0, 0, 0, 0); background-color: rgba(221, 221, 214, 0.93)"></td>
                                        </tr>
                                        <tr style="background-color: rgba(0, 0, 0, 0)">
                                            <td style="font-size:12px;"><?=$row->created?></td>
                                            <td>
                                                <?=$row->orderno?>
                                            </td>
                                            <td class="hidden-xs" style="font-size:12px;"><?//$row->usernm?>
                                                <input id="nmmode<?=$row->id?>" type="text" class="nmmode form-control"
                                                       code="<?=$row->id?>" maxlength="15" value="<?=$row->usernm?>" oldvalue="<?=$row->usernm?>" size="15" style="border:0; background-color: transparent;"/>
                                            </td>
                                            <td class="hidden-xs" style="font-size:12px;"><?=$row->chnm."(".$row->ch_id.")<br>".$row->ch_orderno?></td>

                                            <td class="hidden-xs" style="font-size:12px;"><?=$row->jpnm?></td>

                                            <td class="hidden-xs" style="font-size:12px;">

                                                <div class="btn-group">
                                                    <button class="btn btn-default" id="use_<?=$row->id?>" data-original-title="" title="">
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
                                                <?
                                                if($row->usegu == '1'){
                                                    echo $row->usegu_at;
                                                }
                                                ?>
                                            </td>
                                            <td>
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
                                                }
                                                ?>

                                            </td>

                                            <td  class="hidden-xs"  style="font-size:10px;">
                                                <textarea id="bigo<?=$row->id?>" class="memomode" code="<?=$row->id?>" style="width: 150px; height: 50px;  border: 0px; background-color: transparent;"><?=$row->dammemo?></textarea>
                                            </td>

                                        </tr>
                                        <tr  style="background-color: rgba(0, 0, 0, 0)">
                                            <td class="hidden-xs" style="font-size:12px;">
                                                <input id="udatemode<?=$row->id?>" type="text" class="udatemode form-control"
                                                       code="<?=$row->id?>" maxlength="15" value="<?=$row->usedate?>" oldvalue="<?=$row->usedate?>" size="15" style="border:0; background-color: transparent;"/>
                                            </td>
                                            <td class="hidden-xs">
                                                <?php
                                                $bartext = str_replace(";","</br>",$row->barcode_no);
                                                echo $bartext;
                                                ?>
                                            </td>
                                            <td class="hidden-xs" style="font-size:12px;"><?//$row->dhp?>
                                                <input id="hpmode<?=$row->id?>" type="text" class="hpmode form-control"
                                                       code="<?=$row->id?>" maxlength="15" value="<?=$row->dhp?>" oldvalue="<?=$row->dhp?>" size="30" style="border:0; background-color: transparent;"/>
                                            </td>
                                            <td class="hidden-xs" style="font-size:12px;"><?//$row->man1?>
                                                <input id="qtymode<?=$row->id?>" type="text" class="qtymode form-control"
                                                       code="<?=$row->id?>" maxlength="15" value="<?=$row->man1?>" oldvalue="<?=$row->man1?>" size="10" style="border:0; background-color: transparent;"/>
                                            </td>
                                            <td class="hidden-xs">
                                                <span style="font-size:12px;" data-toggle="tooltip" data-placement="right" title="PCMS:<?=$row->itemmt_id?>"><?=$row->itemnm?></span>
                                                <?php if($row->bigo != "" && $row->bigo != null){?>
                                                    <span class="glyphicon glyphicon-eye-open" style="font-size:12px;" data-toggle="tooltip" data-placement="right" title="<?=$row->bigo?>"></span>
                                                <?php }?>
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

                                                    <button class="btn btn-<?=$statebtnStyle?>" id="state_<?=$row->id?>" data-original-title="" title="">
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
                                            <td>

                                                    <a class="sendsms btn btn-default" data-toggle="tooltip" data-placement="top"
                                                       title="QR상품(에버랜드,민속촌)도 재발송 가능합니다." orid="<?= $row->id ?>">문자전송</a>

                                            </td>
                                            <td class="hidden-xs" style="font-size:12px;"><?//$row->dhp?>
                                                <input id="resnomode<?=$row->id?>" type="text" class="resnomode form-control"
                                                       code="<?=$row->id?>" maxlength="20" value="<?=$row->resno?>" oldvalue="<?=$row->resno?>" size="30" style="border:0; background-color: transparent;"/>
                                                <br/>

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
                    //alert(msg);
                    if (msg == "err"){
                        alert("변경에 실패하였습니다.");
                        $(location).attr('href','/order/orderN');
                    }else if(msg == "ok"){
                        $('#use_'+code).text(use_text);
                        alert("변경되었습니다.");
                        //$(location).attr('href','/order/orderN');
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



        $(".sendsms").click(function() {

            var orid = $(this).attr('orid');
            //alert(orid);
            if(confirm("문자 재발송 하시겠습니까?")){
                //alert("<?php echo site_url('order/sms_resend'); ?>");
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
                            //$(location).attr('href','/order/orderN');
                        }
                    }
                })
            }
        });

        $(".nmmode").click(function() {
            var code = $(this).attr('code');
            $("#nmmode"+code).css('background-color','#F781F3');//transparent
            $("#nmmode"+code).css('color','white');
            //$(this).css('border','1px;');
        });

        $(".nmmode").keypress(function(e) {
            if (e.keyCode == 13){
                var code = $(this).attr('code');
                if(confirm("이름을 변경 하시겠습니까?")){
                    $("#nmmode"+code).css('background-color','transparent');
                    $("#nmmode"+code).css('color','#F781F3');
                    var modtext = $("#nmmode"+code).val();
                    $("#nmmode"+code).blur();

                    $.ajax({
                        url: "<?php echo site_url('order/orderN_modify_nm'); ?>",
                        data: {code : code, modtext:modtext},
                        type:"POST",
                        success:function(msg)
                        {
                            $("#bigo"+code).html(msg);
                        }
                    })
                }else{
                    $("#nmmode"+code).css('background-color','transparent');
                    $("#nmmode"+code).css('color','black');
                    $("#nmmode"+code).val($(this).attr('oldvalue'));
                    $("#nmmode"+code).blur();
                }
            }
        });

        $(".resnomode").click(function() {
            var code = $(this).attr('code');
            $("#resnomode"+code).css('background-color','#F781F3');//transparent
            $("#resnomode"+code).css('color','white');
            //$(this).css('border','1px;');
        });

        $(".resnomode").keypress(function(e) {
            if (e.keyCode == 13){
                var code = $(this).attr('code');
                if(confirm("예약번호를 변경 하시겠습니까?")){
                    $("#resnomode"+code).css('background-color','transparent');
                    $("#resnomode"+code).css('color','#F781F3');
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
            }
        });




        $(".udatemode").click(function() {
            var code = $(this).attr('code');
            $("#udatemode"+code).css('background-color','#F781F3');//transparent
            $("#udatemode"+code).css('color','white');
            //$(this).css('border','1px;');
        });

        $(".udatemode").keypress(function(e) {
            if (e.keyCode == 13){
                var code = $(this).attr('code');
                if(confirm("이용기간을 변경 하시겠습니까?")){
                    $("#udatemode"+code).css('background-color','transparent');
                    $("#udatemode"+code).css('color','#F781F3');
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
            }
        });


        $(".hpmode").click(function() {
            var code = $(this).attr('code');
            $("#hpmode"+code).css('background-color','#F781F3');//transparent
            $("#hpmode"+code).css('color','white');
            //$(this).css('border','1px;');
        });

        $(".hpmode").keypress(function(e) {
            if (e.keyCode == 13){
                var code = $(this).attr('code');
                if(confirm("휴대폰 번호를 변경 하시겠습니까?")){
                    $("#hpmode"+code).css('background-color','transparent');
                    $("#hpmode"+code).css('color','#F781F3');
                    var modtext = $("#hpmode"+code).val();
                    $("#hpmode"+code).blur();

                    $.ajax({
                        url: "<?php echo site_url('order/orderN_modify_hp'); ?>",
                        data: {code : code, modtext:modtext},
                        type:"POST",
                        success:function(msg)
                        {
                            $("#bigo"+code).html(msg);
                        }
                    })

                }else{
                    $("#hpmode"+code).css('background-color','transparent');
                    $("#hpmode"+code).css('color','black');
                    $("#hpmode"+code).val($(this).attr('oldvalue'));
                    $("#hpmode"+code).blur();
                }
            }
        });

        $(".qtymode").click(function() {
            var code = $(this).attr('code');
            $("#qtymode"+code).css('background-color','#F781F3');//transparent
            $("#qtymode"+code).css('color','white');
            //$(this).css('border','1px;');
        });

        $(".qtymode").keypress(function(e) {
            if (e.keyCode == 13){
                var code = $(this).attr('code');
                if(confirm("수량을 변경 하시겠습니까?")){
                    $("#qtymode"+code).css('background-color','transparent');
                    $("#qtymode"+code).css('color','#F781F3');
                    var modtext = $("#qtymode"+code).val();
                    $("#qtymode"+code).blur();

                    $.ajax({
                        url: "<?php echo site_url('order/orderN_modify_qty'); ?>",
                        data: {code : code, modtext:modtext},
                        type:"POST",
                        success:function(msg)
                        {
                            $("#bigo"+code).html(msg);
                        }
                    })

                }else{
                    $("#qtymode"+code).css('background-color','transparent');
                    $("#qtymode"+code).css('color','black');
                    $("#qtymode"+code).val($(this).attr('oldvalue'));
                    $("#qtymode"+code).blur();
                }
            }
        });

        $(".memomode").on('change',function(){

            if(confirm("메모를 저장 하시겠습니까?")){
                var code = $(this).attr('code');
                //alert(code);
                var modtext = $(this).val();
                //alert(modtext);
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

            }
            //$("#memomode"+code).css('background-color','#F781F3');//transparent
            //$("#memomode"+code).css('color','white');
            //$(this).css('border','1px;');
        });

        $('.y_btn').click(function(){
            //alert("사용버튼");
            var code = $(this).attr('code');
            usestate(code,"1");
        });

        $('.n_btn').click(function(){
            //alert("정지버튼");
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

                            $('#state_'+code).text(state);
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
            var Nusedate = $('#Nusedate').val(); // 이용일
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

            if(Nusedate == "" || Nusedate == null){
                alert("이용일을 입력해주세요.");
                $('#Nusedate').focus();
                return false;
            }

            if(Nman == "" || Nman == null){
                alert("인원을 입력해주세요.");
                $('#Nman').focus();
                return false;
            }

            $.ajax({
                url: "<?php echo site_url('/order/insert_order'); ?>",
                data: {Nusernm:Nusernm,Nhp:Nhp,state_select:state_select,chn_select:chn_select,item_select:item_select,Nusedate:Nusedate,Nman:Nman,Nchorderno:Nchorderno,Nmemo:Nmemo,Nbarcodeno:Nbarcodeno},
                type:"POST",
                success:function(msg)
                {
                    var res = msg.split("|");
                    alert(res[1]);
                    if(res[0] == 'ok'){
                        $(location).attr('href','/order/orderN_dev');
                        /*$('#Nusernm').val(''); //고객 이름
                        $('#Nhp').val(''); // 휴대폰 번호
                        $('#Nusedate').val(''); // 이용일
                        $('#Nman').val(''); // 인원
                        $('#Nchorderno').val(''); // 판매채널 주문번호
                        $('#Nmemo').val(''); // 메모

                        $('.ordclose').click();*/
                    }
                    //$('#testcode').text(msg);
                }
            })
        });


        $('#or_srh').click(function(){

            /*if($('#searchtxt').val() == '' || $('#searchtxt').val() == null)
            {
                alert('검색어를 입력해 주세요.');
                $('#searchtxt').focus();
                return false;
            }*/
            $('#fform').submit();

        });

        $('#cancel_btn').click(function(){
            $(location).attr('href','/order/orderN_dev/new');
        });


        $('#excel_btn').click(function(){

            if(confirm("데이터가 많을수록 오~~래 걸립니다.\n최대5만건까지 다운받을수 있습니다.\n기다릴수 있으면 '확인'을 눌러주세요.")){
                var selectdate = $('#selectdate').val();
                var sdate = $('#sdate').val();
                var edate = $('#edate').val();
                var usernm = $('#usernm').val(); if(!usernm)usernm=' ';
                var userhp = $('#userhp').val(); if(!userhp)userhp=" ";
                var orderno = $('#orderno').val(); if(!orderno)orderno=" ";
                var barcodeno = $('#barcodeno').val(); if(!barcodeno)barcodeno=" ";
                //var grnm = $('#grnm').val();

                var jpnm = $('#jpnm').val(); if(!jpnm)jpnm=" ";
                var itemnm = $('#itemnm').val(); if(!itemnm)itemnm=" ";

                var chnm = $('#chnm').val(); if(!chnm)chnm=" ";
                var ch_orderno = $('#ch_orderno').val(); if(!ch_orderno)ch_orderno=" ";
                var state = $('#state').val(); if(!state)state=" ";
                var usegu = $('#usegu').val(); if(!usegu)usegu=" ";
                //var dammemo  = $('#dammemo ').val(); if(!dammemo )dammemo =" ";

                var excelurl = '<?php echo site_url('order/exceldown'); ?>'+"/"+selectdate+"/"+sdate+"/"+edate+"/"+usernm+"/"+userhp+"/"+orderno+"/"+barcodeno+"/"+jpnm+"/"+itemnm+"/"+chnm+"/"+ch_orderno+"/"+state+"/"+usegu;
                window.location.assign(excelurl);
            }
        });

        $('.conf').click(function(){
            $.ajax({

                url: "<?php echo site_url('/order/ajorder'); ?>",
                data: {orid : $(this).attr('orid') , ojpid : $(this).attr('ojpid'), ojpnm : $(this).attr('ojpnm'), barcode : $(this).attr('barcode')},
                type:"POST",
                success:function(msg)
                {
                    //var res = msg.split("|");
                    //alert(res[1]);
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
                        //var res = msg.split("|");
                        //alert(res[1]);
                        alert(msg);
                        $('#testcode').text(msg);
                    }
                })
            }
        });
    });
</script>