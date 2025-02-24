<div class="content-wrap">
    <main id="content" class="content" role="main">
        <div class="row">
        <!--  <div class="alert alert-success alert-sm">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <span class="fw-semi-bold"><?= $kitbar->itemnm ?> </span> 바코드를 추가하는 페이지 입니다.
		            </div>-->
            <div class="col-md-12">
            
            	<section class="widget">
                    <header>
                        <div class="widget-controls">
                            <a href="#"><i class="glyphicon glyphicon-cog"></i></a>
                            <a href="#"><i class="fa fa-refresh"></i></a>
                            <a href="#" data-widgster="close"><i class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </header>
                    <div class="widget-body">
                    	
                        <h3 style="text-align: center; margin-top: -2px; "><?= $kitbar->sellcode ?> : <span class="fw-semi-bold"> <?= $kitbar->pcms_id ?></span></h3>
                        <h3 style="text-align: center; margin-top: -4px; "><?= $bararr[$kitbar->gp] ?> : <span class="fw-semi-bold"><?= $kitbar->itemnm ?></span></h3>
                        <h5 style="margin-top: 30px; text-align: center;"><span class="fw-semi-bold">현재 바코드 수량</span></h5>
                        <span style="text-align: center; display:block; margin-top: -40px; font-size: 120pt; <?php if($kitbar_count->codecnt < 100){echo "color: #FFA7A7;";}else{echo "color:#B2CCFF;";} ?>"><span class="fw-semi-bold"><?= $kitbar_count->codecnt?></span></span>
                        <h5 style="text-align: center; margin-top: -15px; margin_bottom: 15px;"><?= date("Y-m-d",strtotime($kitbar->sdate)); ?> ~ <?= date("Y-m-d",strtotime($kitbar->edate)); ?></h5> 
                    
                    </div>
                </section> 
                
                <section class="widget">
                    <header>
                        <h5>
                            <strong>file uploads</strong>
                        </h5>
                        <div class="widget-controls">
                            <a class="bg-gray-transparent" href="#"><i class="glyphicon glyphicon-cog text-white"></i></a>
                            <a href="#"><i class="fa fa-refresh"></i></a>
                            <a href="#" data-widgster="close"><i class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </header>
                    <div class="widget-body">
                        <!-- <form id="fileform" class="form-horizontal" role="form" enctype="multipart/form-data" action="/bar/bar_add_file"> -->
                        <?php 
                        $attributes = array('class' => 'form-horizontal', 'id' => 'fileform' , 'role' => 'form' );
                        echo form_open_multipart('/bar/bar_add_excel',$attributes);   
                        ?>
                        	<input type="hidden" name="kitid" class="kitid" id="kitid" value="<?= $kitbar->id ?>">
                        	<input type="hidden" name="sellcode" class="sellcode" id="sellcode" value="<?= $kitbar->sellcode ?>">
                        	<input type="hidden" name="pcms_id" class="pcms_id" id="pcms_id" value="<?= $kitbar->pcms_id ?>">
                        	<!-- <input id="userfile" name="userfile" type="file"> -->
                            <fieldset>
                            	 <div class="form-group">
	                                <div class="col-sm-offset-2 col-sm-6" style="margin-bottom: 10px;">
	                                <blockquote class="blockquote-reverse">
	                                    <p>업로드할 바코드를 엑셀 파일로 저장해서 업로드 해주세요.</p>
	                                    <footer>엑셀 A열에 바코드만 작성해서 업로드 해주세요.</footer>
	                                    <footer>중복된 코드는 등록할 수 없습니다.</footer>
	                                    <footer>키자니아는 바우처번호/CVC 형식으로 저장해주세요. 예) 2800000000000/00M </footer> 
	                                    <footer>바코드 등록후 꼭 테스트해서 확인해주세요.</footer>     
	                                     <footer>[<a href="/docs/바코드추가메뉴얼_20160908.pdf">메뉴얼 다운</a>] </footer>                         
	                                </blockquote>
	                                </div>
                               </div> 
                                <div class="form-group" style="margin-top: -20px;">
                                    <!-- <div class="col-sm-offset-2 col-sm-3" style="margin-bottom: 10px;">
                                        <input type="number" id="normal-field" name="qty" class="form-control" placeholder="업로드 수량 입력(숫자)">
                                    </div> -->
                                    <div class="col-sm-offset-3 col-sm-5">
                                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                            <div class="form-control" data-trigger="fileinput">
                                                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                <span class="fileinput-filename"></span>
                                            </div>
                                            <span class="input-group-addon btn btn-default btn-file">
                                                <span class="fileinput-new">Select file</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input id="userfile" name="userfile" type="file">
                                            </span>
                                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-sm-offset-5 col-sm-7">
                                        <button type="button" id="save_btn" class="btn btn-primary">등 록</button>
                                        <button type="button" id="cancel_btn" class="btn btn-inverse">취 소</button>
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
<script src="/vendor/bootstrap-select/bootstrap-select.min.js"></script>
<script src="/vendor/jquery-autosize/jquery.autosize.min.js"></script>
<script src="/vendor/bootstrap3-wysihtml5/src/bootstrap3-wysihtml5.js"></script>
<script src="/vendor/switchery/dist/switchery.min.js"></script>

<script src="/vendor/moment/min/moment.min.js"></script>
<script src="/vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="/vendor/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="/vendor/jasny-bootstrap/js/inputmask.js"></script>
<script src="/vendor/jasny-bootstrap/js/fileinput.js"></script>
<script src="/vendor/holderjs/holder.js"></script>
<script src="/vendor/dropzone/downloads/dropzone.min.js"></script>
<script src="/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
<script src="/vendor/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js"></script>

<!-- page specific js -->
<script src="/js/form-elements.js"></script>

<script type="text/javascript">
$(function(){
	$('#cancel_btn').click(function(){
		$(location).attr('href','/bar/kit');
	});
	$('#save_btn').click(function(){
		if(confirm("등록 하시겠습니까?")){
			$('#fileform').submit();
		}
	});

});
</script>









