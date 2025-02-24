<?php
/**
 * Created by PhpStorm.
 * User: MINO
 * Date: 2016-11-22
 * Time: 오후 4:02
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

                                    <label class="col-sm-2 control-label" for="max-length">네이버 시설 번호</label>
                                    <div class="col-sm-2">
                                        <input type="text" name="bizid" id="bizid"
                                               class="form-control"
                                               placeholder="시설 번호를 입력해주세요."
                                               data-placement="top">
                                    </div>
                                    <label class="col-sm-2 control-label" for="max-length">네이버 시설 이름</label>
                                    <div class="col-sm-2">
                                        <input type="text" name="bizname" id="bizname"
                                               class="form-control"
                                               placeholder="시설 이름을 입력해주세요."
                                               data-placement="top">
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" id="save_btn" class="btn btn-primary">등 록</button>
                                    </div>
                                </div>


                            </fieldset>
                            <div class="form-actions">
                                <div class="row">

                                </div>
                            </div>
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
                                    <th class="no-sort hidden-xs">번호</th>
                                    <th class="hidden-xs">네이버 시설 번호</th>
                                    <th class="hidden-xs">네이버 시설 이름</th>
                                    <th class="hidden-xs">등록일</th>
                                    <th class="hidden-xs"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?
                                foreach($query->result() as $row):
                                    ?>
                                    <tr> <!-- style="color: orange;" -->
                                        <td style="font-size:12px;"><?=$row->id?></td>
                                        <td style="font-size:12px;"><?=$row->bizid?></td>
                                        <td style="font-size:12px;"><?=$row->bizname?></td>
                                        <td style="font-size:12px;"><?=$row->regdate?></td>
                                        <td style="font-size:12px;">
	                                        <button type="button" class="btn btn-inverse btn-xs del_btn" delid="<?=$row->id?>">삭제</button>
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

    $(function(){

        $('#save_btn').click(function(){

            var bizid = $('#bizid').val();
            var bizname = $('#bizname').val();

            if(bizid == '' || bizid == null )
            {
                alert('시설 번호를 입력해 주세요.');
                $('#bizid').focus();
                return false;
            }

            if(bizname == '' || bizname == null )
            {
                alert('시설 이름을 입력해 주세요.');
                $('#bizname').focus();
                return false;
            }

            if(confirm(bizname+ " 시설을 등록 하시겠습니까?")){

                $.ajax({
                    url: "<?php echo site_url('sync/naver_bizcode_add'); ?>",
                    data: {
                        bizid:bizid , bizname:bizname
                    },
                    type:"POST",
                    success:function(msg)
                    {
                        if(msg == "ok"){
                            $(location).attr('href','/sync/naver_bizcode');
                        }else{
                            alert(msg);
                        }
                    }
                })
            }
        });

		$('.del_btn').click(function(){
            var delid = $(this).attr('delid');

            if(confirm("정말로 시설을 삭제 하시겠습니까?")){

                $.ajax({
                    url: "<?php echo site_url('sync/naver_bizcode_del'); ?>",
                    data: {delid: delid},
                    type:"POST",
                    success:function(msg)
                    {
//						alert(msg);
                        if(msg == "ok"){
                            location.reload();
                        }else{
                            alert('error error error error error');
                        }
                    }
                })
            }
        });

    });
</script>