<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold">롯데 행사 리스트</span></h3>

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
                        <form  role="form" id="fform" name="fform" class="form-horizontal" role="form" method="post" action="/lotte/eventlist_ser">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-striped table-lg mt-lg mb-0">
                                        <thead class="no-bd">
                                            <br>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label" for="simple-big-select" style="text-align: right"> 행사코드 </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="eventcd" id="eventcd"
                                                               class="form-control"
                                                               placeholder="행사코드를 입력하세요"
                                                               data-placement="top" value="<?=$eventcd?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label" for="max-length"  style="text-align: right"> 쿠폰코드 </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="sellcode" id="sellcode"
                                                               class="form-control"
                                                               placeholder="쿠폰코드를 입력하세요"
                                                               data-placement="top" value="<?=$sellcode?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label" for="simple-big-select" style="text-align: right"> 행사명 </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="eventnm" id="eventnm"
                                                               class="form-control"
                                                               placeholder="행사명을 입력하세요"
                                                               data-placement="top" value="<?=$eventnm?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label" for="simple-big-select" style="text-align: right"> 행사내용 </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="eventdesc" id="eventdesc"
                                                               class="form-control"
                                                               placeholder="행사내용을 입력하세요"
                                                               data-placement="top" value="<?=$eventdesc?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label" for="simple-big-select" style="text-align: right"> 날짜 </label>
                                                        <div class="col-sm-8">
                                                            <select name="selectdate" id="selectdate" class="selectpicker">
                                                                <option name="" value="">선택하세요</option>
                                                                <option name="sdate" value="sdate" <?php echo ($selectdate == 'sdate') ? 'selected' : ''; ?>>시작일</option>
                                                                <option name="edate" value="edate" <?php echo ($selectdate == 'edate') ? 'selected' : ''; ?>>종료일</option>
                                                            </select>
                                                        </div>
                                                    <label class="col-sm-4 control-label" for="simple-big-select" style="text-align: right"></label>
                                                        <div class="col-sm-4">
                                                            <input type="date" name="startdate" id="startdate" maxlength="20"
                                                                   class="form-control"
                                                                   data-placement="top"
                                                                   style="margin-top: 5px"
                                                                   value="<?=$startdate?>">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="date" name="enddate" id="enddate" maxlength="20"
                                                                   class="form-control"
                                                                   data-placement="top"
                                                                   style="margin-top: 5px"
                                                                   value="<?=$enddate?>">
                                                        </div>
                                                </div>
                                            </div>
                                        </thead>
                                    </table>
                                </div>

                                <div class="col-sm-offset-4 col-sm-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div style="margin-top:5px">
                                                <button type="button" id="or_srh" class="btn btn-block btn-danger">검 색</button>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div style="margin-top:5px">
                                                <button type="button" id="cancel_btn" class="btn btn-block btn-inverse">취 소</button>
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
   						
		            	<div class="table-responsive">
                            <table class="table table-striped table-lg mt-lg mb-0">
                                <thead class="no-bd">
                                <tr>
                                    <th>행사코드</th>
		                            <th class="no-sort hidden-xs">행사명</th>
		                            <th class="hidden-xs">상세</th>
		                            <th class="hidden-xs">시작일</th>
		                            <th class="hidden-xs">종료일</th>
		                            <th class="hidden-xs">사용수량</th>
		                            <th class="hidden-xs">쿠폰코드</th>
                                    <th class="hidden-xs"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
foreach($query->result() as $row):

?>

		                        <tr>
		                            <td style="font-size:12px;"><?=$row->eventcd?></td>
		                            <td style="font-size:12px;"><?=$row->eventnm?></td>
		                            <td style="font-size:12px;"><?=$row->eventdesc?></td>
		                            <td style="font-size:12px;"><?=$row->sdate?></td>
		                            <td style="font-size:12px;"><?=$row->edate?></td>
		                            <td style="font-size:12px;"><?=$row->qty?></td>
		                            <td style="font-size:12px;"><?=$row->sellcode?></td>
                                    <td style="font-size:12px;">
                                        <?php
                                        if($row->eventsync == "Y"){
                                            echo "컨펌완료";
                                        }else{
                                            echo "<button type=\"button\" class=\"btn btn-info btn-xs conf_btn\" confid=\"$row->eventcd\">컨펌</button>";
                                        }
                                        ?>

                                    </td>
                                </tr>
<?php
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

	$('#or_srh').click(function(){
		$('#fform').submit();
	});

	$('#cancel_btn').click(function(){
        $(location).attr('href','/lotte/eventlist/new');
    });

    $('.conf_btn').click(function(){
        var confid = $(this).attr('confid');

        if(confirm("쿠폰 생성을 모두 확인(컨펌) 하셨습니까?")){
            alert("기능 준비중 입니다.");
            return false;

            $.ajax({
                url: "<?php echo site_url('lotte/eventlist_confirm'); ?>",
                data: {confid: confid},
                type:"POST",
                success:function(msg)
                {
						alert(msg);
//                     if(msg == "ok"){
//                         location.reload();
//                     }else{
//                         alert('merong');
//                     }
                }
            })
        }
    });

});
</script>









