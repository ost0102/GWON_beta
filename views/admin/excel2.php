<h1><?echo $title;?> 페이지 방문자 분석</h1>
<a href='<?echo $this->config->item('base_url');?>/<?echo $domain;?>'><?echo $this->config->item('base_url');?>/<?echo $domain;?></a><br/>
출력 날짜 : <? echo date("Y-m-d", mktime(0,0,0,date("m"), date("d"), date("Y")));?>
<h3>방문자 정보</h3>
<table border="1" align="center">
	<tbody>
		<tr>
			<th>Total</th>
			<th>Today</th>
		</tr>
		<tr>
			<td>
				<? echo $total; ?>
			</td>
			<td>
				<? echo $today; ?>
			</td>
		</tr>
	</tbody>
</table>
<?
if(isset($event_list)){
?>
<h3>등록된 이벤트</h3>
<table border="1" align="center">
	<tbody>
		<tr>
			<th>Date</th>
			<th>Event</th>
		</tr>
<?php
		foreach($event_list as $key=>$item):
			if($item['event_date'] !== ''){
				echo	"<tr>";
	            echo		"<td align='left'>".$item['event_date']."</td>";
	            echo		"<td align='left'>".$item['event_memo']."</td>";
	            echo	"</tr>";
			}
		endforeach;
?>
	</tbody>
</table>
<?
}
?>
<?
if(isset($date_list)){
?>
<h3>퍼블리싱 후, 최근 3개월간 날짜별 방문, 공유 횟수</h3>
<table border="1" align="center">
	<tbody>
		<tr>
			<th>Date</th>
			<th>Visited</th>
			<th>Shared</th>
		</tr>
		<?php
		foreach($date_list as $key=>$item):
			//print_r($date_list);
			if($item['count'] !== 0){
				echo	"<tr>";
	            echo		"<td align='left'>".$item['date']."</td>";
	            echo		"<td align='left'>".$item['count']."</td>";
	            echo		"<td align='left'>".$item['shared']."</td>";
	            echo	"</tr>";
			}
		endforeach;
		?>
	</tbody>
</table>
<?}?>
<?
if(isset($time_list)){
?>
<h3>시간대별 방문자 수 및 공유 횟수</h3>
<table border="1" align="center">
	<tbody>
		<tr>
			<th>Time</th>
			<th>Visited</th>
			<th>Shared</th>
		</tr>
<?php
		foreach($time_list as $key=>$item):
			if($item['date'] !== ''){
				echo	"<tr>";
	            echo		"<td align='left'>".$item['date']."</td>";
	            echo		"<td align='left'>".$item['count']."</td>";
	            echo		"<td align='left'>".$item['shared']."</td>";
	            echo	"</tr>";
			}
		endforeach;
?>
	</tbody>
</table>
<?
}
?>
-끝-