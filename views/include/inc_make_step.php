<style>
	#con_area{
		margin-bottom: 20px;
	}
	
</style>
<script type="text/javascript">
//콘텐츠 입력단계 버튼
function bt_con_detail1(p_sec){
	var url1 = '/makepage/menu_detail/';
	var url2 = '#!2';
	var url_full = url1+p_sec;
	//alert(url_full);
	location.href = url_full+'#!2';
	window.location.reload();
}
function bt_con_detail2(p_sec){
	var url1 = '/makepage/con_detail/';
	var url2 = '#!3';
	var url_full = url1+p_sec;
	location.href = url_full+'#!3';
	window.location.reload();
}
function not_yet(){
	alert('기본 정보를 저장한 후 다른 항목들을 설정할 수 있습니다.');
}
</script>
<?
	if(!isset($write_title)){
		$write_title = '0000-00-00';
	}
	if(!isset($add_code)){
		$add_code='0000-00-00';
	}
	if(!isset($add_member)){
		$add_member='0000-00-00';
	}
?>

<div id='make_step'>
	<div id='make_step_txt'>
		<!-- 현재 버전 메뉴 출력 시작 -->
		<?if(isset($page_secur)){?>
			<?
				$now_state = $_SERVER['REQUEST_URI'];
				if(strpos($now_state,'outline') !== false){
			?>
					<a href='/makepage/outline/<?if(isset($page_secur)) echo $page_secur;?>' target='_self'><img src='/img/icon/step1_over.gif' class='step_bt' title='개요'>개요</a>

			<?
				}else{
			?>
					<a href='/makepage/outline/<?if(isset($page_secur)) echo $page_secur;?>' target='_self'><img src='/img/icon/step1.png' class='step_bt' title='개요'>개요</a>
			<?
				}
			?>
		<?}else{?>
			<a href='javascript:not_yet();'><img src='/img/icon/step1_over.gif'  class='step_bt' title='개요'>개요</a>
		<?}?>
		<?if(isset($page_secur)){?>			
			<?
				$now_state = $_SERVER['REQUEST_URI'];
				if(strpos($now_state,'con_detail') !== false || strpos($now_state,'apply_intro') !== false || strpos($now_state,'form_set') !== false){
			?>
				<a href='javascript:bt_con_detail1("<?if(isset($page_secur)) echo $page_secur;?>");' target='_self'><img src='/img/icon/step2_over.gif' class='step_bt' title='콘텐츠'>콘텐츠</a>

			<?
				}else{
			?>
					<a href='/makepage/con_detail/<?if(isset($page_secur)) echo $page_secur;?>#!2' target='_self'><img src='/img/icon/step2.png' class='step_bt' title='콘텐츠'>콘텐츠</a>
			<?
				}
			?>
		<?}else{?>
			<a href='javascript:not_yet();'><img src='/img/icon/step2.png' class='step_bt' title='콘텐츠'>콘텐츠</a>
		<?}?>
		<?if(isset($page_secur)){?>
			<?
				$now_state = $_SERVER['REQUEST_URI'];
				if(strpos($now_state,'select_design') !== false){
			?>
				<a href='/makepage/select_design/<?if(isset($page_secur)) echo $page_secur;?>#!2' target='_self'><img src='/img/icon/step3_over.gif' class='step_bt bt_design' title='디자인'>디자인</a>

			<?
				}else{
			?>
					<a href='/makepage/select_design/<?if(isset($page_secur)) echo $page_secur;?>#!2' target='_self'><img src='/img/icon/step3.png' class='step_bt bt_design' title='디자인'>디자인</a>
			<?
				}
			?>
		<?}else{?>
			<a href='javascript:not_yet();'><img src='/img/icon/step3.png' class='step_bt' title='디자인'>디자인</a>
		<?}?>
		<?if(isset($page_secur) && $add_member!=''){?>

			<?
				$now_state = $_SERVER['REQUEST_URI'];
				if(strpos($now_state,'add_other') !== false){
			?>
				<a href='/makepage/add_other/<?if(isset($page_secur)) echo $page_secur;?>#!2' target='_self'><img src='/img/icon/step4_over.gif' class='step_bt' title='활성화'>활성화</a>

			<?
				}else{
			?>
					<a href='/makepage/add_other/<?if(isset($page_secur)) echo $page_secur;?>#!2' target='_self'><img src='/img/icon/step4.png' class='step_bt' title='활성화'>활성화</a>
			<?
				}
			?>
		<?}else{?>
			<a href='javascript:not_yet();'><img src='/img/icon/step4.png' class='step_bt' title='활성화'>활성화</a>
		<?}?>
		<!-- 현재 버전 메뉴 출력 끝 -->
	</div>
</div>