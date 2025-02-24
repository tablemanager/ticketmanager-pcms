<?
foreach($query->result() as $row):
?>
								<tr class = "table_<?=$row->item_id?>">
		                            <td><?=$row->price_regdate?></td>
		                            <td><?=$row->price_itemid?></td>
		                            <td><?=$row->item_nm."<br/>(".$row->fac_nm.")"?></td>
		                            <td><?=$row->price_date?></td>
		                            <td><?=$row->price_normal?></td>
		                            <td><?=$row->price_sale?></td>
		                            <td><?=$row->price_in?></td>
		                            <td><?=$row->price_out?></td>
									<td><?=$row->price_qty?></td> 
		                        </tr>
<?
endforeach;

?> 