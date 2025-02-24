<?
if(true){
foreach($query->result() as $row):

if($row->item_state == 'Y'){
	$uflg =  "사용";
}else if($row->item_state == 'N'){
	$uflg =  "정지";
}else{
	$uflg = $row->item_state;
}

?>
								<tr class = "table_<?=$row->item_id?>">
		                            <td><?=$row->item_id?></td>
		                            <td><a href="/cms/items/<?=$row->item_facid?>/<?=$row->item_id?>" style="color: black;"><span class="fw-semi-bold"><?=$row->item_nm."(".$row->fac_nm.")"?></span></a></td>
									<td><?=$row->item_sdate?></td>
									<td><?=$row->item_edate?></td>
									<td>
									<a href="/cms/price/<?=$row->item_id?>">관리</a>  
									</td>
									<td>
									<a href="/cms/commission/<?=$row->item_id?>">관리</a>  
									</td>
		                            <td >
		                            <a id="use_<?=$row->item_id?>" onclick="unusestate('<?=$row->item_id?>');" uflag ="<?=$uflg?>"><?=$uflg?></a>                      
		                            </td>
		                        </tr>
<?
endforeach;
}
?> 