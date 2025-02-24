<option value=""> - 상품 선택 - </option>
<?php //
foreach($pitem->result() as $pitemrow): ?>
    <option value="<?=$pitemrow->id?>"><?=$pitemrow->nm."({$pitemrow->id}/{$pitemrow->ITEM_CODE})"?></option>
<?php endforeach; ?>