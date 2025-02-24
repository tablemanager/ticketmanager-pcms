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
                                
                                <div  class="form-group">
                                    <label class="col-sm-4 control-label" for="max-length">쿠폰조회</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="ITEM_CODE" id="ITEM_CODE"
                                               class="form-control"
                                               placeholder="에버랜드(캐리비안베이) 바코드를 입력해주세요."
                                               data-placement="top">
                                    </div>
                                </div>

                                <div class="col-sm-offset-5 col-sm-7">
                                    <button type="button" id="save_btn" class="btn btn-primary">검 색</button>
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
                                    <th class="hidden-xs">상품코드</th>
                                    <th class="hidden-xs">쿠폰번호</th>
                                    <th class="hidden-xs">주문자명</th>
                                    <th class="hidden-xs">연동상태</th>
                                    <th class="hidden-xs">쿠폰상태</th>
                                    <th class="hidden-xs"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?
                                foreach($query->result() as $row):
                                    ?>
                                    <tr> <!-- style="color: orange;" -->
                                        <td style="font-size:12px;"><?=$row->id?></td>
                                        <td style="font-size:12px;"><?=$row->order_itemcode." [".$row->sellcode."]"?></td>
                                        <td style="font-size:12px;"><?=$row->no_coupon?></td>
                                        <td style="font-size:12px;"><?=$row->cus_nm?></td>
                                        <td style="font-size:12px;"><?=$syncArr[$row->syncfac_result]?></td>
                                        <td style="font-size:12px;"><?=$stateArr[$row->state_use]?></td>
                                        <td style="font-size:12px;">
                                            <?php
                                            if($row->state_use == 'N'){
                                                echo '<button type="button" id="" class="btn btn-danger cancel_coupon" code="'.$row->no_coupon.'">폐기</button>';
                                            }if($row->state_use == 'C' && $row->date_cancel != null){
                                                echo '취소시간:'.$row->date_cancel;
                                            }if($row->state_use == 'Y' && $row->date_use != null){
                                                echo '사용시간:'.$row->date_use;
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?
                                endforeach;
                                ?>
                                </tbody>
                            </table>
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

        $('.cancel_coupon').click(function () {
            var code = $(this).attr('code');
            //alert(code);
            if(confirm("폐기 처리에는 최대 30분 정도 소요됩니다. 쿠폰을 폐기하겠습니까?")){
                $.ajax({
                    url: "<?php echo site_url('b2b/everland_coupon_cancel'); ?>",
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

            $(location).attr('href','/b2b/everland_coupon_search/'+$('#ITEM_CODE').val());

        });
    });
</script>