<?php
/**
 * Created by Editplus
 * User: Cindy
 * Date: 2017-12-01
 * Time: 오후 1:00
 */
?>

<div class="content-wrap">
    <!-- main page content. the place to put widgets in. usually consists of .row > .col-md-* > .widget.  -->
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold">사용자관리</span></h3>
        <div class="row">
            <div class="col-md-12">
                <section class="widget">
                    <header>
                        <div class="widget-controls">
                            <a href="#"><i class="glyphicon glyphicon-cog"></i></a>
                            <a data-widgster="close" href="#"><i class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </header>
                    <div class="widget-body">
                        <table class="table table-bordered table-lg mt-lg mb-0">
                            <thead>
                            <tr>
								<th class="text-align-center">이름</th>
                                <th class="text-align-center">아이디</th>
                                <th class="text-align-center">권한</th>
                                <th class="text-align-center">회사명</th>
                                <th class="text-align-center">부서명</th>
                                <th class="text-align-center">팀명</th>
                                <th class="text-align-center">직급</th>
                                <th class="text-align-center">휴대폰</th>
                                <th></th>
								<!--class="text-align-center"-->
                            </tr>
                            </thead>
							<?php
								foreach($query->result() as $rs){
							?>
                            <tbody>
                            <tr>
                                <td class="text-align-center"><?=$rs->nm?></td>
								<td class="text-align-center"><?=$rs->cd?></td>
								<td class="text-align-center"><?=$rs->rolegu?></td>
								<td class="text-align-center"><?=$rs->company?></td>
								<td class="text-align-center"><?=$rs->buseo?></td>
								<td class="text-align-center"><?=$rs->teamnm?></td>
								<td class="text-align-center"><?=$rs->jikwi?></td>
								<td class="text-align-center"><?=$rs->hp?></td>
								<td class="text-align-center">
									<button userid="<?=$rs->id?>" class="btn btn-warning btn-sm btnupdate">수정</button>
									<button stopid="<?=$rs->id?>" class="btn btn-inverse btn-sm btnstop">정지</button>
								</td>
                            </tr>
                            </tbody>
							<?php
								}
							?>
                        </table>
						<br>
						<div>
							<button id="btnreg" class="btn btn-primary pull-right">등록</button>
						</div>
						<br>
                    </div>
                </section>
            </div>
        </div>
    </main>
</div>

<script>
 $(function(){
	$('.btnupdate').click(function(){  
		var userid = $(this).attr('userid');
		//alert(userid);
		$(location).attr('href',"<?php echo site_url('/user/update'); ?>/" + userid);

    });

	$('.btnstop').click(function(){
		var stopid = $(this).attr('stopid');
		//alert(stopid);
		if(confirm("정지하시겠습니까?")){

			$.ajax({
				url: "<?php echo site_url('user/stop'); ?>",
				data: {stopid: stopid},
				type:"POST",
			    success:function(msg)
			    {
				    //alert(msg);
					if(msg == "true"){
						location.reload();
					}else{
						alert('error error error error error');
					}
		        }
	        })
		}
   });

	$('#btnreg').click(function(){  
	      location.replace('/index.php/user/insert');
    });
 });
</script>