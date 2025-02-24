<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold"><?php echo $title;?></span></h3>
        					
        <div class="row">
            <div class="col-md-12">
            	<section class="widget">
                    <div class="widget-body">
                        <form  role="form" id="insertform" name="insertform" class="form-horizontal" role="form" method="post" action="" >
                            <fieldset>
								<legend>
									채널 정보
								</legend>
								<div class="form-group" ><!--col-sm-offset-2-->
									<label class="col-sm-2 control-label" for="max-length">채널 선택</label>
									<div class="col-sm-10">
									<?php
									foreach($chn as $id => $name): ?>
										<div class="radio" style="display: inline-block; margin-right: 80px;">
											<input type="radio" name="checkChn" class="checkChn" id="radio<?=$id?>" value="<?=$id?>">
											<label for="radio<?=$id?>">
												<?=$name."(".$id.")"?>
											</label>
										</div>
									<?php endforeach; ?>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label" for="max-length">채널 아이디</label>
									<div class="col-sm-4">
										<input type="text" name="ch_cd" id="ch_cd"
											   class="form-control"
											   placeholder="크롤링 / 연동 채널 계정을 입력해 주세요."
											   data-placement="top"
										>
									</div>
									<div class="col-sm-4">
										<input type="text" name="ch_pass" id="ch_pass"
											   class="form-control"
											   placeholder="크롤링 / 연동 채널 비밀번호을 입력해 주세요."
											   data-placement="top"
										>
									</div>
								</div>
							</fieldset>

							<fieldset style="margin-top: 20px">

								<legend>
									판매 정보
								</legend>

								<div class="form-group">

									<div class="col-sm-offset-2 col-sm-4">
										<input type="text" name="sellcode" id="sellcode"
											   class="form-control"
											   placeholder=""
											   data-placement="top"
										>
										<span class="help-block">판매(딜) 코드</span>
									</div>
									<div class="col-sm-4">
										<input type="text" name="selltitle" id="selltitle"
											   class="form-control"
											   placeholder=""
											   data-placement="top"
										>
										<span class="help-block">판매(딜) 이름</span>
									</div>
								</div>

								<div class="form-group"  style="margin-top: -20px">

									<div class="col-sm-offset-2 col-sm-8">
										<input type="text" name="sellurl" id="sellurl"
											   class="form-control"
											   placeholder=""
											   data-placement="top"
										>
										<span class="help-block">판매(딜) 주소(URL)</span>
									</div>
								</div>

								<div class="form-group" style="margin-top: -20px">

									<div class="col-sm-offset-2 col-sm-4">
										<input id="sellsdate" type="text" class="form-control datetimepicker3" maxlength="10" />
										<span class="help-block">판매 시작일</span>
									</div>
									<div class="col-sm-4">
										<input id="selledate" type="text" class="form-control datetimepicker3" maxlength="10" />
										<span class="help-block">판매 종료일</span>
									</div>
								</div>
							</fieldset>

							<fieldset style="margin-top: 0px">

								<legend>
									크롤링 / 연동 정보
								</legend>
								
								<div class="form-group" style="margin-top: 0px">

									<div class="col-sm-offset-2 col-sm-8">

										<div class="radio" style="display:none; margin-right: 40px;" id="radio_update"><!--: inline-block;-->
											<input type="radio" name="sync_type" class="sync_type" id="sync_type_U" value="U">
											<label for="sync_type_U">
												주문 정보 수정 (이용일, 휴대폰번호)
											</label>
										</div>

										<div class="radio" style="display: none;  margin-right: 40px;" id="radio_insert">
											<input type="radio" name="sync_type" class="sync_type" id="sync_type_I" value="I">
											<label for="sync_type_I">
												주문 등록
											</label>
										</div>

										<span class="help-block">예) 이용일 수정은 '주문수정'을 사용</span>
									</div>
								</div>


                                <div class="itmecode_group" style="display: none">

									<div class="form-group">
										<label class="col-sm-2 control-label" for="max-length">이용일</label>
										<div class="col-sm-5">
											<div class='input-group'>
												<input id="usedate" type="text" class="form-control datetimepicker3" maxlength="10" />

												<div class='input-group-btn'>
													<select class='selectpicker sync_state'
															data-style='btn-danger'
															data-width='auto'>
														<option value='예약완료'>예약완료</option>
														<option value='완료'>완료</option>
													</select>
												</div>

											</div>
											<span class="help-block">이용일을 비워두면 크롤링/연동된 옵션의 날짜가 등록됩니다.</span>
										</div>

									</div>

									<div class="form-group ">
										<input type="hidden" id="itemclass" value="1">

										<div class='itemrow1'>
											<label class='col-sm-2 control-label' for='max-length'>상품코드 : 옵션 연동</label>
											<div class='col-sm-3'>
													<input type='text' name='itemcode1'
													   class='form-control itemcode1'
													   placeholder='상품코드 입력'
													   data-placement='top'
													>
											</div>
											<div class='col-sm-5'>
												<input type='text' name='itemopt1'
													   class='form-control itemopt1'
													   placeholder='판매옵션 입력 예) A01 에버랜드 자유이용권'
													   data-placement='top'
													   >
											</div>

											<div class='col-sm-1'>
												<div class='input-group-btn'>
														 <button type='button' class='btn btn-success addItemcode'><i class='fa fa-plus'></i></button>
												 </div>
											</div>
										</div>
									</div>



                                </div>

								<div class="form-group" style="margin-top: 40px">
									<div class="col-sm-offset-2 col-sm-8">
										<button type="button" id="save_btn" class="btn btn-info btn-block">등 록</button>
									</div>
								</div>

                            </fieldset>

                        </form>
                    </div>
                 </section>
              </div>
            </div>
           	<div class="row">
            <div class="col-md-12">
            	<section class="widget">
		            <div class="widget-body">
		                
		                <div class="mt">
		                    <table id="datatable-table" class="tblCustomers table table-striped table-hover sellcodetable">
		                    <!-- <table id = "tblCustomers" class="table table-striped table-lg mt-lg mb-0"> -->
		                        <thead>
		                        <tr>
		                            <th>번호</th>
		                            <th class="no-sort">채널</th>
		                            <th class="no-sort">아이디</th>
									<th class="no-sort">비밀번호</th>
									<th class="no-sort">판매(딜)코드</th>
									<th class="no-sort">판매(딜)이름</th>
									<th class="no-sort">판매기간</th>
									<th class="no-sort">크롤링/연동 정보</th>
									<th class="no-sort">상태</th>
		                        </tr>
		                        </thead>
		                        <tbody>
								<?
								foreach($query->result() as $row):
									?>
								<tr class = "table_<?=$row->id?>">
		                            <td><?=$row->id?></td>
		                            <td class="hidden-xs"><?=$row->ch_nm?></td>
		                            <td><span class="fw-semi-bold"><?=$row->ch_cd?></span></td>
									<td><span class="fw-semi-bold"><?=$row->ch_pass?></span></td>
									<td class="hidden-xs"><?=$row->sellcode?></td>
		                            <td class="hidden-xs"><a onclick="goPOPUP('<?=$row->sellurl?>');"><?=$row->selltitle?></a></td>
									<td class="hidden-xs"><?=$row->sellsdate."~".$row->selledate?></td>
		                            <td class="hidden-xs">

										<?php if($row->sync_type == "I"){?>
											<button class="btn btn-gray" data-toggle="modal" data-target="#myModal<?=$row->id?>">
												<?=$row->sellopt?>
											</button>
											<div class="modal fade" id="myModal<?=$row->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title text-align-center fw-bold mt" id="myModalLabel18"><?=$row->selltitle?></h4>
														</div>
														<div class="modal-body bg-gray-lighter">
															<form>
																<div class="row">
																	<div class="col-md-12">
																		<?php
																		$pcmstext = $row->item_option;
																		$pcmstext = str_replace(",", "\n", $pcmstext); // 줄바꿈
																		$pcmstext = "옵션명:PCMS코드\n".$pcmstext;
																		$pcmstext .= "\n이용일:".$row->usedate;
																		$pcmstext .= "\n연동옵션:".$row->sellopt;

																		?>
																		<pre><?=$pcmstext?></pre>
																	</div>
																</div>
															</form>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-gray" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div>
										<?php }
										?>

		                            </td>
		                            <td class="hidden-xs">		                                
		                            <div class="btn-group">
		                            <a id="use_<?=$row->id?>" onclick="unusestate('<?=$row->id?>');" uflag ="<?=$row->useyn?>"><?=$useyn_str[$row->useyn]?></a>
		                            
		                            </div>
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

function unusestate(code){
	var use_text = $("#use_"+code).attr("uflag");
	var unuse_text = "";
	var flag = "";
	if(use_text == "Y"){
		unuse_text = "정지";
		flag = "N";
	}else if(use_text == "N"){
		unuse_text = "사용";
		flag = "Y";
	}else{
		return false;
	}
	if(confirm(unuse_text+" 상태로 변경하시겠습니까?")){
		//alert(unuse_text+flag);
  
        $.ajax({
        url: "<?php echo site_url('sell/crowling_use'); ?>",
        data: {code : code , use_state : flag},
        type:"POST",
        success:function(msg)
		{
		    if (msg == "err"){
		    	alert("변경에 실패하였습니다.");    	
		    }else if(msg == "ok"){
		    	
		    	$('#use_'+code).text(unuse_text);	 
		    	$('#use_'+code).attr("uflag",flag);
		    	alert("변경되었습니다.");   	
		    }else{
				alert(msg);
		    }
		    
		    
        }
        })
	}
}

function goPOPUP(url){
	  window.open(url);
}

$(function(){
	//
	$(document).ready(function() {

	});
	$(".sync_type").change(function(){
		var sync_type  = $(this).val();
		if(sync_type == 'I'){
			$(".itmecode_group").slideDown();
		}else{
			$(".itmecode_group").slideUp();
		}
	});

	$('.addItemcode').click(function(){
		var itemclass = $('#itemclass').val();
		itemclass = ++itemclass;
		$.ajax({
	        url: "<?php echo site_url('sell/addItemcode'); ?>",
            data: {itemclass : itemclass},
            type:"POST",
            success:function(msg)
            {
                //alert(msg);
              $( ".itmecode_group").append(msg);
              $('#itemclass').val(itemclass);
            }
		})
	});

    $(".checkChn").change(function(){

        $("#sync_type_U").removeAttr("checked");
        $("#sync_type_I").removeAttr("checked");
        $(".itmecode_group").slideUp();

        var checkChn  = $(this).val();
        if(checkChn == '142' || checkChn == '154' || checkChn == '150'){
            $("#radio_insert").slideDown();
            $("#radio_update").slideDown();
        }else if(checkChn == '128' || checkChn == '129' || checkChn == '141' || checkChn == '352'){
            $("#radio_insert").slideDown();
            $("#radio_update").slideUp();
        }else{
            $("#radio_insert").slideUp();
            $("#radio_update").slideDown();
        }
    });



	$('#save_btn').click(function(){

		var checkChn = $(':radio[name="checkChn"]:checked').val();
		if(checkChn == '' || checkChn == null )
		{
			alert('채널을 선택해 주세요.');
			return false;
		}
		var ch_cd = $('#ch_cd');
		if(ch_cd.val() == '' || ch_cd.val() == null )
		{
			alert('크롤링/연동 채널 계정을 입력해 주세요.');
			ch_cd.focus();
			return false;
		}

		var ch_pass = $('#ch_pass');
		if(ch_pass.val() == '' || ch_pass.val() == null )
		{
			alert('크롤링/연동 채널 비밀번호를 입력해 주세요.');
			ch_pass.focus();
			return false;
		}

		var sellcode = $('#sellcode');
		if(sellcode.val() == '' || sellcode.val() == null )
		{
			alert('판매(딜) 코드를 입력해 주세요.');
			sellcode.focus();
			return false;
		}
		var selltitle = $('#selltitle');
		if(selltitle.val() == '' || selltitle.val() == null )
		{
			alert('판매(딜) 이름을 입력해 주세요.');
			selltitle.focus();
			return false;
		}
		var sellurl = $('#sellurl');
		if(sellurl.val() == '' || sellurl.val() == null )
		{
			alert('판매(딜) 주소(URL)를 입력해 주세요.');
			sellurl.focus();
			return false;
		}
		var sellsdate = $('#sellsdate');
		if(sellsdate.val() == '' || sellsdate.val() == null )
		{
			alert('판매 시작일을 입력해 주세요.');
			sellsdate.focus();
			return false;
		}
		var selledate = $('#selledate');
		if(selledate.val() == '' || selledate.val() == null )
		{
			alert('판매 종료일을 입력해 주세요.');
			selledate.focus();
			return false;
		}

		var sync_type = $(':radio[name="sync_type"]:checked').val();
		if(sync_type == '' || sync_type == null )
		{
			alert('크롤링/연동 유형을 선택해 주세요.');
			return false;
		}

		//등록 크롤링/연동일때
		var itemclass = "";
		var usedate = "";
		var sync_state = "";
		var item_option = "";

		if(sync_type == "I"){
			itemclass = $('#itemclass').val();
			usedate = $('#usedate').val();
			sync_state = $('.sync_state').val();
            if( $('.itemopt1').val().search(",") > 0 || $('.itemopt1').val().search(":") > 0 ){
                alert('판매옵션에 , 또는 : 를 넣을 수 없습니다');
                $('.itemopt1').focus();
                return false;
            }
			item_option = $('.itemopt1').val() + ":" + $('.itemcode1').val();
			for(var i = 2 ; i <= itemclass ; i++){
				if($('.itemcode'+i).val() != '' && $('.itemcode'+i).val() != null)
				{
					if($('.itemopt'+i).val() == '' || $('.itemopt'+i).val() == null)
					{
						alert('판매옵션을 입력해 주세요.');
						$('.itemopt'+i).focus();
						return false;
					} else if(
					    $('.itemopt'+i).val().search(",") > 0 || $('.itemopt'+i).val().search(":") > 0
                    ){
                        alert('판매옵션에 , 또는 : 를 넣을 수 없습니다');
                        $('.itemopt'+i).focus();
                        return false;
                    } else{
						item_option += "," + $('.itemopt'+i).val() + ":" + $('.itemcode'+i).val();
					}
				}
			}
		}
		

		if(confirm("등록 하시겠습니까?")){

            $.ajax({
	        url: "<?php echo site_url('sell/crowling_add'); ?>",
            data: {
				checkChn:checkChn,
				ch_cd:ch_cd.val(),
				ch_pass:ch_pass.val(),
				sellcode:sellcode.val(),
				selltitle:selltitle.val(),
				sellurl:sellurl.val(),
				sellsdate:sellsdate.val(),
				selledate:selledate.val(),
				sync_type:sync_type,
            	itemclass : itemclass,
				usedate : usedate,
            	item_option : item_option,
            	sync_state : sync_state
            	},
            type:"POST",
            success:function(msg)
            {
                //alert(msg);
              	var res = msg.split('|');
      		    if (res[0] == "err"){
      			  	alert(res[1]);
      		    }else{
      		    	alert(res[1]);
      		    	$(location).attr('href','/sell/crowling');
      		    }
            }
            })
		}
		
	});

	
});
</script>









