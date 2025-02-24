<?php
/**
 * Created by PhpStorm.
 * User: SeoJiyun
 * Date: 2018-07-25
 * Time: 오후 7:55
 */
?>

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
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">PCMS 상품코드</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="item_id" id="item_id" maxlength="5"
                                               class="form-control"
                                               placeholder="PCMS 상품코드를 입력해주세요."
                                               data-placement="top" data-original-title="You cannot write more than 4 characters."
                                               OnKeyPress="num_only()">
                                        <span class="help-block" id="item_nm"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">넥슨 상품코드</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="ContractDetailNo" id="ContractDetailNo" maxlength="10"
                                               class="form-control"
                                               placeholder="넥슨 상품코드를 입력하세요"
                                               data-placement="top"  OnKeyPress="num_only()" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">판매일</label>
                                    <div class="col-sm-3">
                                        <input id="sell_sdate" name="sell_sdate" type="text" class="form-control datetimepicker3" maxlength="10" />
                                        <span class="help-block">시작일</span>

                                    </div>
                                    <div class="col-sm-3">
                                        <input id="sell_edate" name="sell_edate" type="text" class="form-control datetimepicker3" maxlength="10" />
                                        <span class="help-block">종료일</span>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-offset-5 col-sm-6">
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
                        <div class="widget-controls">
                            <a data-widgster="expand" title="Expand" href="#" style="display: none;"><i class="glyphicon glyphicon-chevron-up"></i></a>
                            <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a>
                            <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </header>
                    <div class="widget-body">
                        <div class="mt">
                            <div id="datatable-table_wrapper" class="dataTables_wrapper form-inline no-footer">
                                <div class="row">
                                    <div class="col-md-6 hidden-xs">
                                        <div class="dataTables_length" id="datatable-table_length">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="datatable-table_filter" class="pull-right">
                                        </div>
                                    </div>
                                </div>
                                <table id="datatable-table" class="table table-striped table-hover dataTable no-footer" role="grid" aria-describedby="datatable-table_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Id: activate to sort column ascending" style="width: 90px;">Id</th>
                                            <th class="no-sort hidden-xs sorting_disabled" rowspan="1" colspan="1" aria-label="Info" style="width: 170px;">넥슨 상품코드</th>
                                            <th class="hidden-xs sorting" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Description: activate to sort column ascending" style="width: 364px;">플레이스엠 상품번호</th>
                                            <th class="hidden-xs sorting" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Description: activate to sort column ascending" style="width: 280px;">플레이스엠 상품명</th>
                                            <th class="hidden-xs sorting" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 325px;">판매시작일</th>
                                            <th class="hidden-xs sorting" tabindex="0" aria-controls="datatable-table" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 325px;">판매종료일</th>
                                            <th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Status" style="width: 134px;">사용유무</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($query->result() as $row): ?>
                                        <tr role="row">
                                            <td class="hidden-xs"><?=$row->id?></td>
                                            <td class="hidden-xs"><?=$row->ContractDetailNo?></td>
                                            <td class="hidden-xs"><?=$row->item_id?></td>
                                            <td class="hidden-xs"><?=$row->item_nm?></td>
                                            <td class="hidden-xs"><?=$row->sell_sdate?></td>
                                            <td class="hidden-xs"><?=$row->sell_edate?></td>
                                            <td class="hidden-xs">
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
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="dataTables_info" id="datatable-table_info" role="status" aria-live="polite">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="dataTables_paginate paging_bootstrap" id="datatable-table_paginate">
                                            <ul class="pagination no-margin">
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
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

<script>
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
            //alert(unuse_text+flag);

            $.ajax({
                url: "<?php echo site_url('nexon/unuse_item'); ?>",
                data: {code : code , use_state : flag},
                type:"POST",
                success:function(msg)
                {
                    if (msg == "err"){
                        alert("변경에 실패하였습니다.");
                    }else if(msg == "ok"){

                        $('#use_'+code).text(unuse_text);
                        $('#use_'+code).attr("uflag",unuse_text);
                        alert("변경되었습니다.");
                    }else{
                        alert(msg);
                    }
                }
            })
        }
    }

    $(function () {
        $('#save_btn').click(function(){
            var item_id = $('#item_id').val();
            var item_nm = $('#item_nm').text();
            var ContractDetailNo = $('#ContractDetailNo').val();
            var sell_sdate = $('#sell_sdate').val();
            var sell_edate = $('#sell_edate').val();


            if(item_id == '' || item_id == null)
            {
                alert('PCMS 상품코드를 입력해 주세요.');
                $('#item_id').focus();
                return false;
            }

            if(ContractDetailNo == '' || ContractDetailNo == null)
            {
                alert('넥슨 상품코드를 입력해 주세요.');
                $('#ContractDetailNo').focus();
                return false;
            }

            if(sell_sdate == '' || sell_sdate == null)
            {
                alert('판매 시작일을 입력해 주세요.');
                $('#sell_sdate').focus();
                return false;
            }

            if(sell_edate == '' || sell_edate == null)
            {
                alert('판매 종료일을 입력해 주세요.');
                $('#sell_edate').focus();
                return false;
            }

            if(confirm("등록 하시겠습니까?")){

                $.ajax({
                    url: "<?php echo site_url('nexon/insert_item'); ?>",
                    data: {ContractDetailNo:ContractDetailNo, item_id:item_id, item_nm:item_nm, sell_sdate:sell_sdate, sell_edate:sell_edate},
                    type:"POST",
                    success:function(msg)
                    {
                        // alert(msg);

                        var res = msg.split('|');
                        if (res[0] == "err"){
                            alert(res[1]);
                        }else{
                            alert(res[1]);
                            $(location).attr('href','/nexon/item');
                        }

                    }
                })
            }

        });

        $("#item_id").keyup(function() {

            var item_id = $("#item_id").val();

            $.ajax({
                url: "<?php echo site_url('sys/nexon_get_itemname'); ?>",
                data: {item_id : item_id},
                type:"POST",
                success:function(msg)
                {
                    // $(location).attr('href',msg);
                    $( "#item_nm" ).text(msg);
                }
            })
            //$( "#pcmsitem_item" ).text(pcmsitem_id);
        });

        $("#cancel_btn").click(function () {
            $(location).attr('href','/nexon/item');
        });

    })
</script>