<div class="content-wrap">
    <main id="content" class="content" role="main">
        <div class="row">

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
                    	
                        <h3 style="text-align: center; margin-top: -2px; "><?=$cms_coupon->ccode ?> : <span class="fw-semi-bold"> <?= $cms_coupon->items_id ?></span></h3>
                        <h3 style="text-align: center; margin-top: -4px; "><?= $ctypeArr[$cms_coupon->ctype] ?> : <span class="fw-semi-bold"><?= $cms_coupon->cnm ?></span></h3>
                        <h3 style="text-align: center; margin-top: -4px; margin_bottom: 15px;"><?= date("Y-m-d",strtotime($cms_coupon->use_sdate)); ?> ~ <?= date("Y-m-d",strtotime($cms_coupon->use_edate)); ?></h3>
                    
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
                        <?php
                        $attributes = array('class' => 'form-horizontal', 'id' => 'fileform' , 'role' => 'form' );
                        echo form_open_multipart('/bar/set_img_ok/'.$cms_coupon->id.'/'.$cms_coupon->ccode,$attributes);
                        ?>

                            <fieldset>
                            	 <div class="form-group">



	                                <div class="col-sm-offset-5 col-sm-5 " style="margin-bottom: 10px;">
                                        <?php if($cms_coupon->bgimg != null){?>
                                        <img src="/uploads/<?=$cms_coupon->bgimg?>">
                                        <?php }else{?>
	                                    <p>배경 이미지를 업로드 해주세요.</p>
                                        <?php } ?>
	                                </div>
                                 </div>
                                 <div class="form-group" style="margin-top: -20px;">

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
		$(location).attr('href','/bar/make');
	});
	$('#save_btn').click(function(){
		if(confirm("이미지 생성까지는 1시간정도 소요될 수 있습니다. \r\n등록 하시겠습니까?")){
			$('#fileform').submit();
		}
	});

});
</script>









