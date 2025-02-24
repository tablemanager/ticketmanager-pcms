<?php
/**
 * Created by PhpStorm.
 * User: SeoJiyun
 * Date: 2018-08-08
 * Time: 오후 2:48
 */
?>
<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold"><?=$title?></span></h3>
        <div class="row">
            <div class="col-md-12">
                <section class="widget">
                    <div class="widget-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-lg mt-lg mb-0">
                                <thead class="no-bd">
                                <tr>
                                    <th class="hidden-xs">주문번호</th>
                                    <th class="hidden-xs">주문자명 / 주문자연락처</th>
                                    <th class="hidden-xs">판매채널</th>
                                    <th class="hidden-xs">판매코드</th>
                                    <th class="hidden-xs">주문번호 / 쿠폰번호</th>
                                    <th class="hidden-xs">유효기간</th>
                                    <th class="hidden-xs">주문일자</th>
                                    <th class="hidden-xs">사용일자</th>
                                    <th class="hidden-xs">취소일자</th>
                                    <th class="hidden-xs">사용상태</th>
                                    <th class="hidden-xs">사용연동상태</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($query->result() as $row): ?>
                                    <tr>
                                        <td class="hidden-xs" style="font-size:12px;" name="order_id"><?=$row->order_id?></td>
                                        <td class="hidden-xs" style="font-size:12px;" name=""><?=$row->cus_nm?><br><?=$row->cus_hp?></td>
                                        <td class="hidden-xs" style="font-size:12px;" name="">
                                            <?php
                                            if($row->sync_ext2 == 'C'){
                                                echo "쿠팡";
                                            }else if($row->sync_ext2 == 'T'){
                                                echo "티몬";
                                            }else if($row->sync_ext2 == 'Y'){
                                                echo "위메프";
                                            }else if($row->sync_ext2 == 'N'){
                                                echo "네이버";
                                            }else if($row->sync_ext2 == 'P'){
                                                echo "플레이스엠";
                                            }else{
                                                echo $row->sync_ext2;
                                            }
                                            ?>
                                        </td>
                                        <td class="hidden-xs" style="font-size:12px;" name=""><?=$row->sellcode?></td>
                                        <td class="hidden-xs" style="font-size:12px;" name=""><?=$row->order_no?><br>( <?=$row->couponno?> )</td>
                                        <td class="hidden-xs" style="font-size:12px;" name=""><?=$row->expdate?></td>
                                        <td class="hidden-xs" style="font-size:12px;" name=""><?=$row->date_order?></td>
                                        <td class="hidden-xs" style="font-size:12px;" name=""><?=$row->date_use?></td>
                                        <td class="hidden-xs" style="font-size:12px;" name=""><?=$row->date_cancel?></td>
                                        <td class="hidden-xs" style="font-size:12px;" name="">
                                            <?php
                                            if($row->state_use == 'C'){
                                                echo "취소";
                                            }else if($row->state_use == 'Y'){
                                                echo "성공";
                                            }else if($row->state_use == 'N'){
                                                echo "미사용";
                                            }else{
                                                echo $row->state_use;
                                            }
                                            ?>
                                        </td>
                                        <td class="hidden-xs" style="font-size:12px;" name="">
                                            <?php
                                            if($row->syncuse_result == 'E'){
                                                echo "에러";
                                            }else if($row->syncuse_result == 'Y'){
                                                echo "성공";
                                            }else if($row->syncuse_result == 'N'){
                                                echo "미연동";
                                            }else{
                                                echo $row->syncuse_result;
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
</div>
