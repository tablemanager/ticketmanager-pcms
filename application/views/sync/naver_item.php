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

                                    <label class="col-sm-3 control-label" for="max-length">네이버 상품 번호</label>
                                    <div class="col-sm-2">
                                        <input type="text" name="itemid" id="itemid"
                                               class="form-control"
                                               placeholder="판매(딜) 번호를 입력해주세요."
                                               data-placement="top">
                                    </div>
                                    <label class="col-sm-2 control-label" for="max-length">네이버 상품 이름</label>
                                    <div class="col-sm-2">
                                        <input type="text" name="itemnm" id="itemnm"
                                               class="form-control itemnm"
                                               placeholder="판매(딜) 이름을 입력해주세요."
                                               data-placement="top">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">판매타입</label>
                                    <div class="col-sm-2">
                                        <select name="selltype"
                                                id="selltype"
                                                class="selectpicker"
                                                data-style="btn-default"
                                                tabindex="-1" >
                                            <option value="barcode">바코드</option>
                                            <option value="qrcode">QR코드</option>
                                                                                        
                                        </select>
                                    </div>

             <label class="col-sm-2 control-label" for="max-length">딜종료일</label>
                                    <div class="col-sm-2">
                                        <input type="text" name="expdate" id="expdate"
                                               class="form-control datetimepicker3"
                                               placeholder=""
                                               data-placement="top">
                                         <span class="help-block" >딜종료일을 반드시 입력해주세요. </span>                                 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">판매코드</label>
                                    <div class="col-sm-2">
                                         <select name="sellcode"
                                                id="sellcode"
                                                class="selectpicker"
                                                data-style="btn-default"
                                                tabindex="-1" >
                                            <option value="">플레이스엠</option>
                                            <option value="EL">에버랜드(Sticket)</option>
                                            <option value="CB">캐리비안베이(Sticket)</option>
                                            <option value="PC">웅진플레이도시</option>
                                            <option value="LW">롯데워터파크</option>
                                            <option value="LW2">롯데워터파크(다인권)</option>
                                            <option value="HW">하이원워터/스키</option>
                                            <option value="FV">한국민속촌</option>
                                                                                        
                                        </select>
                                        <span class="help-block" >일반 지류딜은 플레이스엠 선택 <br/>외부 핀사용 시스템팀과 협의.</span>
                                    </div>

                                    <label class="col-sm-2 control-label" for="max-length">시설코드</label>
                                    <div class="col-sm-2">
                                        <input type="text" name="sellseed" id="sellseed"
                                               class="form-control"
                                               placeholder=""
                                               data-placement="top">
                                        <span class="help-block" >시설코드는 반드시 개발팀에 문의해주세요. <br/>에버랜드 QR상품은 '5자리숫자'</span>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">&nbsp;</label>
                                    <div class="col-sm-2">
                                      &nbsp;
                                    </div>

                                    <label class="col-sm-2 control-label" for="max-length">&nbsp;</label>
                                    <div class="col-sm-2">
   <button type="button" id="save_btn" class="btn btn-primary">등 록</button>
                                    </div>
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
                                    <th class="no-sort hidden-xs">번호</th>
                                    <th class="hidden-xs">네이버 상품 번호</th>
                                    <th class="hidden-xs">네이버 상품 이름</th>
                                    <th class="hidden-xs">판매타입</th>
                                    <th class="hidden-xs">판매코드</th>
                                    <th class="hidden-xs">시설코드</th>
                                    <th class="hidden-xs">등록일</th>
                                    <th class="hidden-xs">딜종료일</th>
                                    <th class="hidden-xs"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?
                                foreach($query->result() as $row):
                                    ?>
                                    <tr> <!-- style="color: orange;" -->
                                        <td style="font-size:12px;"><?=$row->id?></td>
                                        <td style="font-size:12px;"><?=$row->itemid?></td>
                                        <td style="font-size:12px;"><?=$row->itemnm?></td>
                                        <td style="font-size:12px;"><?=$selltypes[$row->selltype]?></td>
                                        <td style="font-size:12px;"><?=$row->sellcode?></td>
                                        <td style="font-size:12px;"><?=$row->sellseed?></td>
                                        <td style="font-size:12px;"><?=$row->regdate?></td>
                                        <td style="font-size:12px;">
                                            <input id="datemode<?=$row->id?>" type="text" class="datemode form-control datetimepicker3"
                                                   code="<?=$row->id?>" what = "expdate" maxlength="10" value="<?php
                                            if($row->expdate)echo date("Y-m-d",strtotime ($row->expdate));
                                            ?>" style="border:0; background-color: transparent;"/>
                                        </td>
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

            var itemid = $('#itemid').val();
            var itemnm = $('#itemnm').val();
            var selltype = $('#selltype').val();
            var sellcode = $('#sellcode').val();
            var sellseed = $('#sellseed').val();
            var expdate = $('#expdate').val();

            if(itemid == '' || itemid == null )
            {
                alert('판매(딜) 번호를 입력해 주세요.');
                $('#itemid').focus();
                return false;
            }

            if(itemnm == '' || itemnm == null )
            {
                alert('판매(딜) 이름을 입력해 주세요.');
                $('#itemnm').focus();
                return false;
            }

            if(confirm(itemnm+ " 판매(딜)을 등록 하시겠습니까?")){

                $.ajax({
                    url: "<?php echo site_url('sync/naver_item_add'); ?>",
                    data: {
                        itemid:itemid , itemnm:itemnm , selltype:selltype , sellcode:sellcode, sellseed:sellseed, expdate:expdate 
                    },
                    type:"POST",
                    success:function(msg)
                    {
                        if(msg == "ok"){
                            $(location).attr('href','/sync/naver_item');
                        }else{
                            alert(msg);
                        }
                    }
                })
            }
        });

		$('.del_btn').click(function(){
			var delid = $(this).attr('delid');

			if(confirm("판매(딜)을 삭제 하시겠습니까?")){

				$.ajax({
					url: "<?php echo site_url('sync/naver_item_del'); ?>",
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

        $(".datemode").change(function() {
            var code = $(this).attr('code');
            var what = $(this).attr('what');
            var date = $(this).val();

            if(confirm("이용일을 변경 하시겠습니까?")){
                $.ajax({
                    url: "<?php echo site_url('sync/naver_item_date'); ?>",
                    data: {code:code, date:date , what:what},
                    type:"POST",
                    success:function(msg)
                    {
                        // alert(msg);
                        if(msg == "err"){
                            alert("error");
                        }
                    }
                })
            }
        });
    });
</script>