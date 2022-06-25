<h1><?echo $title;?> 사용자 분석 정보</h1>
<a href='<?echo $this->config->item('base_url');?>/<?echo $domain;?>'><?echo $this->config->item('base_url');?>/<?echo $domain;?></a><br/>
출력 날짜 : <? echo date("Y-m-d", mktime(0,0,0,date("m"), date("d"), date("Y")));?>
<h3>사용자 디바이스 정보</h3>
<?
if(isset($read_device)){
	//page 접근 디바이스 체크
	//print_r($read_device);
	$val_win = 0;
	$val_mac = 0;
	$val_iphone = 0;
	$val_ipod = 0;
	$val_ipad = 0;
	$val_android = 0;
	$val_bot = 0;
	$val_other = 0;
	$val_desktop = 0;
	$val_mobile = 0;
	$val_not_set = 0;
	$search_arr = array('Window', 'Macintosh', 'iPhone', 'iPod', 'iPad', 'Android', 'bot', 'spider');
	$type_arr = array('Desktop', 'Mobile', 'Not set');

	foreach($read_device as $key=>$item):
		if($item['user_agent'] !== ''){
            $item['user_agent'];
            /*
            user_agent 정보를 어떻게 분기해서 보여줄까?
            1. Window, macintosh, iPhone, iPod, iPad,Android, bot 등 분기해서 보여주기
            2. 데스크탑, 모바일 확인하기
            */
            $check_other = 0;
            $check_win = strpos($item['user_agent'], $search_arr[0]); // 문자열 비교
            if($check_win !== false){
                $val_win++;
                $val_desktop++;
                $check_other++;
            }
            $check_win = strpos($item['user_agent'], $search_arr[1]); // 문자열 비교
            if($check_win !== false){
                $val_mac++;
                $val_desktop++;
                $check_other++;
            }
            $check_win = strpos($item['user_agent'], $search_arr[2]); // 문자열 비교
            if($check_win !== false){
                $val_iphone++;
                $val_mobile++;
                $check_other++;
            }
            $check_win = strpos($item['user_agent'], $search_arr[3]); // 문자열 비교
            if($check_win !== false){
                $val_ipod++;
                $val_mobile++;
                $check_other++;
            }
            $check_win = strpos($item['user_agent'], $search_arr[4]); // 문자열 비교
            if($check_win !== false){
                $val_ipad++;
                $val_mobile++;
                $check_other++;
            }
            $check_win = strpos($item['user_agent'], $search_arr[5]); // 문자열 비교
            if($check_win !== false){
                $val_android++;
                $val_mobile++;
                $check_other++;
            }
            $check_win = strpos($item['user_agent'], $search_arr[6]); // 문자열 비교
            if($check_win !== false){
                $val_bot++;
                $val_desktop++;
                $check_other++;
            }
            $check_win = strpos($item['user_agent'], $search_arr[7]); // 문자열 비교
            if($check_win !== false){
                $val_bot++;
                $val_desktop++;
                $check_other++;
            }
            //이외 값이면.. other로 주기
            if($check_other==0){
                $val_other++;
                $val_not_set++;
            }
		}
	endforeach;
	//전체 날짜 보기 관련 변수
    $val_desktop = $val_desktop+$val_not_set;
    $val_mobile = $val_mobile;
    $val_not_set = $val_not_set;
    $val_win = $val_win;
    $val_mac = $val_mac;
    $val_iphone = $val_iphone;
    $val_ipod = $val_ipod;
    $val_ipad = $val_ipad;
    $val_android = $val_android;
    $val_bot = $val_bot;
    $val_other = $val_other;
?>
<table border="1" align="center">
		<tr>
			<th>Desktop</th>
			<th>Window</th>
			<th>Macintosh</th>
			<th>bot</th>
			<th>not set</th>
		</tr>
		<tr>
			<td>
				<? echo $val_desktop; ?>
			</td>
			<td>
				<? echo $val_win; ?>
			</td>
			<td>
				<? echo $val_mac; ?>
			</td>
			<td>
				<? echo $val_bot; ?>
			</td>
			<td>
				<? echo $val_not_set; ?>
			</td>
		</tr>
</table>
<table border="1" align="center">
		<tr>
			<th>Mobile</th>
			<th>Android</th>
			<th>iphone</th>
			<th>ipod</th>
			<th>ipad</th>
		</tr>
		<tr>
			<td>
				<? echo $val_mobile; ?>
			</td>
			<td>
				<? echo $val_android; ?>
			</td>
			<td>
				<? echo $val_iphone; ?>
			</td>
			<td>
				<? echo $val_ipod; ?>
			</td>
			<td>
				<? echo $val_ipad; ?>
			</td>
		</tr>
</table>
<?
}
?>
<h3>소셜 미디어 공유 횟수</h3>
<table border="1" align="center">
		<tr>
			<th>intropage</th>
			<th>Facebook</th>
			<th>Twitter</th>
			<th>KaKao talk</th>
		</tr>
		<tr>
			<td>
				<?
				$sum = 0;
				if(isset($read_like) && $read_like !== ''){
					foreach($read_like as $key=>$item):
						if($item['count_like'] !== ''){
				            $sum = $sum+$item['count_like'];
						}
					endforeach;
				}
				echo $sum;
				?>
			</td>
			<td>
				<?
				$sum = 0;
				if(isset($read_fb) && $read_fb !== ''){
					foreach($read_fb as $key=>$item):
						if($item['count_fb'] !== ''){
				            $sum = $sum+$item['count_fb'];
						}
					endforeach;
				}
				echo $sum;
				?>
			</td>
			<td>
				<?
				$sum = 0;
				if(isset($read_twt) && $read_twt !== ''){
					foreach($read_twt as $key=>$item):
						if($item['count_twt'] !== ''){
				            $sum = $sum+$item['count_twt'];
						}
					endforeach;
				}
				echo $sum;
				?>
			</td>
			<td>
				<?
				$sum = 0;
				if(isset($read_kakao) && $read_kakao !== ''){
					foreach($read_kakao as $key=>$item):
						if($item['count_kakao'] !== ''){
				            $sum = $sum+$item['count_kakao'];
						}
					endforeach;
				}
				echo $sum;
				?>
			</td>
		</tr>
</table>

<?
if(isset($ref_lists)){
	echo '<h3>유입경로 분석</h3>';
	//print_r($ref_lists);
	
?>
<table border="1" align="center">
	<tr>
		<td>
			<? 
			echo '<b>내부 유입 : </b>'.$ref_in_site.'<br/>';
			?>
		</td>
	</tr>
	<tr>

		<td>
			<? 
			echo '<b>외부 유입 : </b>'.$ref_out_site;
			?>
		</td>
	</tr>
</table>
<table border="1" align="center">
		<tr>
			<th>Domain</th>
			<th>Count</th>
			<th>Date</th>
		</tr>
<?php
		foreach ($ref_lists as $item):

			$referer_domain = $item['referer_domain'];
			$date= date("Y-m-d",strtotime ($item['date']));
			if(strpos($item['referer_domain'], "?") !== false) { 
				$referer_domain_ex =explode('?',$item['referer_domain']);
				$referer_domain = $referer_domain_ex[0];
			}

			if($referer_domain == '0'){
				$referer_domain = '직접 유입';
			}

			echo	"<tr>";
            echo		"<td align='left'>".$referer_domain."</td>";
            echo		"<td align='left'>".$item['referer_count']."</td>";
            echo		"<td align='left'>".$date."</td>";
            echo	"</tr>";
		endforeach;
?>
</table>
<?

}
?>
<?
if(isset($read_lists)){
?>
<h3>콘텐츠 확인 여부</h3>
<table border="1" align="center">
		<tr>
			<th>확인 상태</th>
			<th>사용자 수</th>
		</tr>
<?php
		foreach($read_lists as $key=>$item):
			if($item['con_read'] !== ''){
				echo	"<tr>";
	            echo		"<td align='left'>".$item['con_read']."</td>";
	            echo		"<td align='left'>".$item['count_read']."</td>";
	            echo	"</tr>";
			}
		endforeach;
?>
</table>
<?
}
?>
<?
if(isset($read_country)){
?>
<h3>방문 국가정보</h3>
<table border="1" align="center">
		<tr>
			<th>국가명</th>
			<th>방문횟수</th>
		</tr>
<?php
		foreach($read_country as $key=>$item):
			if($item['country_name'] !== ''){
				echo	"<tr>";
	            echo		"<td align='left'>".$item['country_name']."</td>";
	            echo		"<td align='left'>".$item['count_country']."</td>";
	            echo	"</tr>";
			}
		endforeach;
?>
</table>
<?
}
?>
-끝-