<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold">소셜 쿠폰 대체발권</span> [<a href="/docs/CMS_쿠폰대체발생_20160811.pdf">메뉴얼 다운</a>]</h3>
        					
        <div class="row">
            <div class="col-md-12">
            	<section class="widget">
                    <header>
		                <!-- <h4>Table <span class="fw-semi-bold">Styles</span></h4> -->
		                <div class="widget-controls">
	
		                </div>
		            </header>
                    <div class="widget-body">
                        <form  role="form" id="insertform" name="insertform" class="form-horizontal" role="form" method="post" action="" >
                            <fieldset>
                        
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">쿠폰 구분코드</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="sellcode" id="sellcode" maxlength="10"
                                               class="form-control"
                                               placeholder="쿠폰코드를 입력해 주세요." >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">발행수</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="barcnt" id="barcnt" maxlength="10"
                                               class="form-control"
                                               placeholder="발행수를 입력해 주세요." >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">고객명</label>
                                    <div class="col-sm-7">
										<input type="text" name="barnm" id="barnm" maxlength="15"
                                               class="form-control"
                                               placeholder="고객명을 입력해 주세요." >
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="max-length">전화번호</label>
                                    <div class="col-sm-7"> 
										<input type="text" name="barhp" id="barhp" maxlength="20"
                                               class="form-control"
                                               placeholder="휴대번호를 입력해 주세요." >
	                                </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="password_field">Password</label>
                                    <div class="col-sm-7">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input type="password" class="form-control" id="barpass" name="barpass" placeholder="Password">
                                        </div>
                                    </div>
                                </div>
   
                            </fieldset>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-offset-5 col-sm-7">
                                        <!--<button type="button" id="save_btn" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">등 록</button>-->
                                        <button type="button" id="save_btn" class="btn btn-primary" >등 록</button>
                                        <button type="button" id="cancel_btn" class="btn btn-inverse">취 소</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                 </section>

                <div id='div_acc' class="widget-body">

                </div>
                </section>
              </div>
            </div>
                 
        </div>
    </main>
</div>
  		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                  <div  id='div_acc_old' class="modal-body">

				  </div>
              </div>
            </div>
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

	$('#save_btn').click(function() {
        var sellcode = $('#sellcode').val();
        var barnm = $('#barnm').val();
        var barcnt = $('#barcnt').val();
        var barhp = $('#barhp').val();
        var barpass = $('#barpass').val();

        if (sellcode != "" && sellcode != null
            && barnm != "" && barnm != null
            && barcnt != "" && barcnt != null
            && barhp != "" && barhp != null
            && barpass != "" && barpass != null
        ) {
            if (confirm("QR생성에는 1분정도 소요될수 있습니다.\r\n잠시 기다려 주세요.")) {
                $.ajax({
                    type: "POST",
                    url: '/index.php/coupon/setCoupon_menual',
                    data: {sellcode: sellcode, barnm: barnm, barhp: barhp, barpass: barpass, barcnt: barcnt},
                    success: function (args) {
                        $("#div_acc").html(args);
                    },
                    error: function (e) {
                        $("#div_acc").html(e.responseText);
                    }
                });
            }
        }

	});
});
</script>









