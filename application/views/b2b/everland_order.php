<?php
/**
 * Created by PhpStorm.
 * User: MINO
 * Date: 2017-01-09
 * Time: 오후 4:28
 */
?>


<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold"><?php echo $title;?></span></h3>
        <div class="row">
            <div class="col-md-12">

                <?php if($this->session->userdata('cd') == "penfen"){
                    //echo $sql;

                }?>


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
                                    <label class="col-sm-4 control-label" for="simple-big-select">
                                        채널 선택
                                    </label>
                                    <div class="col-sm-4">
                                        <select name="A_ID"
                                                id="A_ID"
                                                class="selectpicker"
                                                data-style="btn-default"
                                                tabindex="-1" >
                                            <!-- <option value="0">선택</option> -->
                                            <option value=""> - 선택 - </option>
                                            <?php //
                                            foreach($chn->result() as $chnrow): ?>
                                                <option value="<?=$chnrow->id?>"><?=$chnrow->cd."(".$chnrow->id.")"?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div  class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length">상품코드</label>
                                    <div class="col-sm-4">
                                        <input type="number" name="ITEM_CODE" id="ITEM_CODE"
                                               class="form-control"
                                               placeholder="에버랜드(캐리비안베이) 상품코드 5자리를 입력해주세요."
                                               data-placement="top">
                                    </div>
                                </div>

                                <div class="col-sm-offset-5 col-sm-7">
                                    <button type="button" id="save_btn" class="btn btn-primary">검 색</button>
                                    <button type="button" id="cancel_btn" class="btn btn-inverse">취 소</button>
                                </div>


                            </fieldset>

                        </form>
                    </div>
                </section>

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
                                <tr>
                                    <th class="no-sort hidden-xs">주문아이디</th>
                                    <th class="hidden-xs">주문일</th>
                                    <th class="hidden-xs">업체명</th>
                                    <th class="hidden-xs">주문상태</th>
                                    <th class="hidden-xs">상품명</th>
                                    <th class="hidden-xs">상품코드</th>
                                    <th class="hidden-xs">결제정보</th>
                                    <th class="hidden-xs"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?
                                foreach($query->result() as $row):
                                    ?>
                                    <tr> <!-- style="color: orange;" -->
                                        <td style="font-size:12px;"><?=$row->id?></td>
                                        <td style="font-size:12px;"><?=$row->date_order?></td>
                                        <td style="font-size:12px;"><?=$row->ACCOUNT_COMOANY?></td>
                                        <td style="font-size:12px;"><?=$stateArr[$row->STATE]?></td>
                                        <td style="font-size:12px;"><?=$row->ITEM_NAME?></td>
                                        <td style="font-size:12px;"><a href="<?php echo site_url('b2b/everland_coupon')."/".$row->sellcode; ?>"><?=$row->ITEM_CODE." [".$row->sellcode."]"?></a></td>
                                        <td style="font-size:12px;"><?=$PayArr[$row->payment]?></td>
                                        <td style="font-size:12px;">
                                            <?php
                                            if($row->STATE == 'S'){
                                                echo '<button type="button" id="" class="btn btn-danger cancel_order" code="'.$row->id.'">취소</button>';
                                            }
                                            ?>
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

    $(function(){

        $('.cancel_order').click(function () {
            var code = $(this).attr('code');
            //alert(code);
            if(confirm("취소 처리에는 최대 30분 정도 소요됩니다. 주문을 취소하겠습니까?")){
                $.ajax({
                    url: "<?php echo site_url('b2b/everland_order_cancel'); ?>",
                    data: {
                        code:code
                    },
                    type:"POST",
                    success:function(msg)
                    {
                        if(msg == 'err') {
                            alert("취소 실패");
                        }else{
                            //alert(".");
                            location.reload();
                        }
                    }
                })
            }
        });

        $('#save_btn').click(function(){

            if($('#A_ID').val() == '' || $('#A_ID').val() == null )
            {
                alert('시설을 선택해 주세요.');
                $('#A_ID').focus();
                return false;
            }

            if($('#ITEM_CODE').val() == '' || $('#ITEM_CODE').val() == null || $('#ITEM_CODE').val().length != 5 )
            {
                alert('상품코드 5자리를 입력해주세요.');
                $('#ITEM_CODE').focus();
                return false;
            }


            $(location).attr('href','/b2b/everland_order/'+$('#A_ID').val()+'/'+$('#ITEM_CODE').val()+'/0');


        });
    });
</script>