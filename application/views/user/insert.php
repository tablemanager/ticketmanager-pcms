<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

<div class="content-wrap">
    <!-- main page content. the place to put widgets in. usually consists of .row > .col-md-* > .widget.  -->
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold">회원 등록</span></h3>
        <div class="row">
            <div class="col-md-6">
                <section class="widget">
                    <header>
                        <div class="widget-controls">
                            <a href="#"><i class="glyphicon glyphicon-cog"></i></a>
                            <a href="#"><i class="fa fa-refresh"></i></a>
                            <a href="#" data-widgster="close"><i class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </header>
                    <div class="widget-body">
                        <form class="form-horizontal" role="form" action="/user/insert_ok" method="post">
                            <fieldset>
								<div class="form-group">
                                    <label for="normal-field" class="col-sm-4 control-label">이름</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="nm" id="normal-field" class="form-control" placeholder="">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="col-sm-4 control-label" for="prepended-input">아이디</label>
                                    <div class="col-sm-7">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input id="prepended-input" name="cd" class="form-control checkid" size="16" type="text" placeholder="Username">
                                        </div>
										<span class="help-block" id="userid_check"></span>
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="col-sm-4 control-label" for="password-field">비밀번호
										<span class="help-block">수정시에만 변경됩니다</span>
									</label>
                                    <div class="col-sm-7">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input type="password" name="pass" class="form-control" id="password-field" placeholder="Password">
                                        </div>
                                    </div>
                                </div>
								<div class="form-group">
									<label class="col-sm-4 control-label">권한</label>
									<div class="col-sm-7">
                                        <?php
                                        $optvis = array(
                                            ''  => '- 선택 -',
                                            'AD'   => '총관리자(AD)',
                                            'OP'   => '국내운영파드',
                                            'FR'   => '해외운영파드',
                                            'SS'   => '에버랜드담당자',
                                            'HNR'   => '행복한항해',
                                            'APAY'   => '어컴퍼니',
                                            'CS'   => 'CS센터',
                                            'AL'   => '아르바이트',
                                            'CRI'   => 'CRI',
                                            'BS'   => '뿌나시스템'
                                        );
                                        echo form_dropdown('rolegu', $optvis, "" , 'id="simple-select" style="width:200px" class="form-control selectpicker"');

                                        ?>
									</div>
                                </div>
                                <div class="form-group">
                                    <label for="normal-field" class="col-sm-4 control-label">회사명</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="company" id="normal-field" class="form-control" placeholder="">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label for="normal-field" class="col-sm-4 control-label">부서명</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="buseo" id="normal-field" class="form-control" placeholder="">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label for="normal-field" class="col-sm-4 control-label">팀명</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="teamnm" id="normal-field" class="form-control" placeholder="">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label for="normal-field" class="col-sm-4 control-label">직급</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="jikwi" id="normal-field" class="form-control" placeholder="">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label for="normal-field" class="col-sm-4 control-label">휴대폰</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="hp" id="normal-field" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-sm-offset-5 col-sm-7">
                                        <button type="submit" class="btn btn-primary">등록</button>
                                        <button type="button" class="btn btn-inverse" onclick="location.href='/index.php/user/account'">취소</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
		</div>
	</main>
</div>

<script>
$(function(){
	$(".checkid").keyup(function() {

		var checkid = $(".checkid").val();
		
		$.ajax({
			url: "<?php echo site_url('user/get_userid'); ?>",
			data: {checkid : checkid},
			type:"POST",
			success:function(msg)
			{
				//$(location).attr('href',msg);
				$( "#userid_check" ).text(msg);
				/*if(msg == "yes"){
					$("#checkid_msg").html("사용할 수 있는 아이디입니다.");
				}else{
					$("#checkid_msg").html("사용할 수 없는 아이디입니다.");
				}*/
			}
		})
	});
});
</script>