<?
//Dashboard-Event 정보 출력하기
//print_r($linked_info);
echo '<ul style="margin-top: 10px;"">';
foreach ($event_list as $event_info)
{
	$event_date = $event_info['event_date'];
	$event_memo = $event_info['event_memo'];
	echo '<li><b><a href="javascript:check_graph(\''.$event_date.'\',\'week\')">'.$event_date.'</a>
	</b>&nbsp;'.$event_memo.'&nbsp;[<a href="javascript:edit_event(\''.$event_date.'\')">edit</a>]</li>';
}
echo '</ul>';
?>
<div style='width: 100%; text-align: center;' class="col-md-12">
    <?
    for($num=1;$num<=$last_page;$num++){
    	echo '<a href="javascript:check_event_list('.$num.');">'.$num.'</a>&nbsp;';
    }
    ?>
</div>