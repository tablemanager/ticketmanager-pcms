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
                    <div class="widget-body">

                        <div class="table-responsive">
                            <table class="table table-striped table-lg mt-lg mb-0">
                                <thead class="no-bd">
                                <tr>

                                    <th class="hidden-xs">등록일</th>
                                    <th class="hidden-xs">한국어</th>
                                    <th class="hidden-xs">영어</th>
                                    <th class="hidden-xs">중국어(간체)</th>
                                    <th class="hidden-xs">중국어(번체)</th>
                                    <th class="hidden-xs">상태</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?
                                foreach($query->result() as $row):
                                    ?>
                                    <tr> <!-- style="color: orange;" -->
                                        <td style="font-size:12px;"><?=$row->created?></td>
                                        <td style="font-size:12px;"><b style="font-size:14px; color: #0050ef"><?=$row->title?></b><br/><?=$row->content?></td>
                                        <td style="font-size:12px;"><b style="font-size:14px; color: #0050ef"><?=$row->title_english?></b><br/><?=$row->content_english?></td>
                                        <td style="font-size:12px;"><b style="font-size:14px; color: #0050ef"><?=$row->title_china_simplified?></b><br/><?=$row->content_china_simplified?></td>
                                        <td style="font-size:12px;"><b style="font-size:14px; color: #0050ef"><?=$row->title_china_traditional?></b><br/><?=$row->content_china_traditional?></td>
                                        <td >
                                            <?php
                                            if($row->visible == 1){
                                                $uflg =  "사용";
                                            }else{
                                                $uflg =  "정지";
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-sm-12" for="max-length">한국어</label>
                                        <div class="col-sm-12">
                                            <input type="text" name="title" id="title"
                                                   class="form-control"
                                                   data-placement="top">
                                        </div>
                                        <div class="col-sm-12">
                                            <textarea rows="4" class="form-control textarea_value" id="content_korean" name="content_korean"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-sm-12" for="max-length">영어</label>
                                        <div class="col-sm-12">
                                            <input type="text" name="title_english" id="title_english"
                                                   class="form-control"
                                                   data-placement="top">
                                        </div>
                                        <div class="col-sm-12">
                                            <textarea rows="4" class="form-control textarea_value"  id="content_english" name="content_english"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-sm-12" for="max-length">중국어(간체)</label>
                                        <div class="col-sm-12">
                                            <input type="text" name="title_china_simplified" id="title_china_simplified"
                                                   class="form-control"
                                                   data-placement="top">
                                        </div>
                                        <div class="col-sm-12">
                                            <textarea rows="4" class="form-control textarea_value" id="content_china_simplified" name="content_china_simplified"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-sm-12" for="max-length">중국어(번체)</label>
                                        <div class="col-sm-12">
                                            <input type="text" name="title_china_traditional" id="title_china_traditional"
                                                   class="form-control"
                                                   data-placement="top">
                                        </div>
                                        <div class="col-sm-12">
                                            <textarea rows="4" class="form-control textarea_value" id="content_china_traditional" name="content_china_traditional"></textarea>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="button" id="save_btn" class="btn btn-block btn-primary">등 록</button>
                                </div>


                            </fieldset>

                        </form>
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

    function unusestate(code){
        var use_text = $("#use_"+code).attr("uflag");
        var unuse_text = "";
        var flag = "";
        if(use_text == "사용"){
            unuse_text = "정지";
            flag = 2;
        }else if(use_text == "정지"){
            unuse_text = "사용";
            flag = 1;
        }else{
            return false;
        }
        if(confirm(unuse_text+" 상태로 변경하시겠습니까?")){

            $.ajax({
                url: "<?php echo site_url('/b2b/notice_use'); ?>",
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

        $('#save_btn').click(function(){

            var title = $('#title').val();
            var content_korean = $('#content_korean').val();
            var title_english = $('#title_english').val();
            var content_english = $('#content_english').val();
            var title_china_simplified = $('#title_china_simplified').val();
            var content_china_simplified = $('#content_china_simplified').val();
            var title_china_traditional = $('#title_china_traditional').val();
            var content_china_traditional = $('#content_china_traditional').val();

            alert(title+title_english+title_china_simplified+title_china_traditional+content_korean+content_english+content_china_simplified+content_china_traditional);


            if(title == '' || title == null
                || title_english == '' || title_english == null
                || title_china_simplified == '' || title_china_simplified == null
                || title_china_traditional == '' || title_china_traditional == null
                || content_korean == '' || content_korean == null
                || content_english == '' || content_english == null
                || content_china_simplified == '' || content_china_simplified == null
                || content_china_traditional == '' || content_china_traditional == null)
            {
                alert('내용을 모두 입력해 주세요.');
                return false;
            }

            if(confirm("새로운 공지를 등록 하시겠습니까?")){

                $.ajax({
                    url: "<?php echo site_url('b2b/notice_add'); ?>",
                    data: {
                        title :title,
                        title_english :title_english,
                        title_china_simplified :title_china_simplified,
                        title_china_traditional :title_china_traditional,
                        content_korean :content_korean,
                        content_english :content_english ,
                        content_china_simplified :content_china_simplified,
                        content_china_traditional :content_china_traditional
                    },
                    type:"POST",
                    success:function(msg)
                    {
                        if(msg == "ok"){
                            $(location).attr('href','/b2b/notice/');
                        }else{
                            alert(msg);
                        }
                    }
                })
            }
        });
    });
</script>