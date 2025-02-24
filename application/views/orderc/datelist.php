<option value="">이용일을 선택하세요.</option>
<?
	foreach($datelist->result() as $datelistrow):
		?>
		<option class="date_select_<?php echo $datelistrow->price_id;?>" value="<?php echo $datelistrow->price_date;?>"><?php echo $datelistrow->price_date;?></option>
		<?
	endforeach;
	?>