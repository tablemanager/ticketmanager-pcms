<?php
/**
 * Created by PhpStorm.
 * User: MINO
 * Date: 2017-06-15
 * Time: 오전 11:30
 */
?>
<option value="">상품을 선택하세요.</option>
<?
foreach($itemlist->result() as $itemlistrow):
    ?>
    <option class="item_select_<?php echo $itemlistrow->item_id;?>" value="<?php echo $itemlistrow->item_id;?>"><?php echo $itemlistrow->item_nm."  (".$itemlistrow->item_id.")";?></option>
    <?
endforeach;
?>