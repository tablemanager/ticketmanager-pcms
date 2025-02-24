<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold">투인원 인증번호 관리</span></h3>

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
                    <div class="widget-body"> <!-- 상단 검색바 시작  -->
						<div style="">
							<div class="top_form">
								<form id="radiochk" method="post" action="/hnr/twoinone">
									<p>
										<input type="radio" id="woorino" name="tb" value="woorino" <?php if($tb == "woorino") echo "checked";?>>
										<label for="woorino">투인원</label>

										<input type="radio" id="culture" name="tb" value="woorinoCulture" <?php if($tb == "woorinoCulture") echo "checked";?>>
										<label for="culture">문화</label>

										<input type="radio" id="annuity" name="tb" value="woorinoAnnuity" <?php if($tb == "woorinoAnnuity") echo "checked";?>>
										<label for="annuity">연금</label>

										<input type="radio" id="allforme" name="tb" value="woorinoAllforme" <?php if($tb == "woorinoAllforme") echo "checked";?>>
										<label for="allforme">올포미</label>
									</p>
									<div align="center">
										<input type="text" class="form-control" name="no" value="<?=$no?>" placeholder="인증번호" style="text-align:center; width:50%; margin-top:10px;">
									</div>
								</form>

								<input type="button" class="button button1" value="검색" style="margin-top:10px;margin-bottom:20px;">
							</div>
						</div>
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
					<div class="widget-body"> <!-- 목록테이블 시작  -->
						<table class="table table-bordered">
						  <thead class="no-bd">
							<tr>
								<th class="hidden-xs">인증번호</th>
								<th class="hidden-xs">이름</th>
								<th class="hidden-xs">서비스기준일</th>
								<th class="hidden-xs">인증처리일</th>
								<th class="hidden-xs">사용유무</th>
								<th class="hidden-xs"><button type="button" class="btn2 btnone btn-xs">초기화</button></th>
							</thead>
							<tbody>
								<?php
								if(!$woolist){
								?>
								<tr>
									<td colspan="6">데이터가 존재하지 않습니다</td>
								</tr>
								<?php
								}else{
                                    foreach($woolist->result() as $woorow):
								?>
								<tr>
									<input type="hidden" name="id" value="<?=$woorow->id?>">
									<td name="no"><?=$woorow->no?></td>
									<td name="nm"><?=$woorow->nm?>(<?=$woorow->nick?>)</td>
									<td name="sdate"><?=$woorow->sdate?></td>
									<td name="mdate"><?=$woorow->mdate?></td>
									<td name="chk">
										<?php
											if($woorow->chk == '0'){
												echo "미사용";
											}else if($woorow->chk == '1'){
												echo "사용";
											}
										?>
									</td>
									<td><button type="button" class="btn button2 btn-xs" choid="<?=$woorow->id?>">초기화</button></td>
								</tr>
								<?php endforeach;
								}?>
								
							</tbody>
						</table>
					</div>
				</section>
            </div>
        </div>
    </main>
</div>

<link type="text/css" href="/css/twoinone.css" rel="stylesheet" />
<script src="vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/button.js"></script>

<script>
$(function(){
	//검색버튼
	$(".button").click(function() {
		$("#radiochk").submit();
	});

	//각 초기화버튼
	$(".btn").click(function() {
		var choid = $(this).attr('choid');
		var tb = $("input[type=radio][name=tb]:checked").val()

		 $.ajax({
			url: "<?php echo site_url('hnr/resetid'); ?>",
			data: {choid : choid, tb : tb},
			type:"POST",
			success:function(msg)
			{
				if(msg == 'ok'){
					alert("초기화되었습니다.");
					$(".button").click();
				}else{
					alert("초기화 실패");
				}
			}
		})
	});
});
</script>