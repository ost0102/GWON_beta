<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<?$this->load->view('/include/head_info');?>
	<!--link href="css/screen_origin.css" type="text/css" rel="stylesheet" media="screen,projection" /-->
	<script type="text/javascript">
	//jQuery 있는 상태
	window.onload=function(){
	    //$('#sc2_2').hide();
	    $(window).scroll(function(){
	        var scr_now = $(document).scrollTop();
	        //현재 스크롤
	        //alert(scr_now);
	    });
	};
	$(document).ready(function() {

	});

	</script>

	<style>
	</style>
</head>
<body>
<!-- 상단 영역 공통 시작-->
<div id='top_area'>
    <div id='top_noti'>
        <div id='top_noti_con'>
            <div id='top_noti_con_txt'>
                <!-- noti_txt -->
                <?include_once $this->config->item('basic_url')."/include/inc_top_noti_txt.php";?>
            </div>
            <div id='top_menu_area'>
                <!-- sub_top area include -->
                <?include_once $this->config->item('basic_url')."/include/inc_top_menu_login.php";?>
            </div>
        </div>
    </div>
    <div id='top_con'>
        <?include_once $this->config->item('basic_url')."/include/inc_top_menu.php";?>
    </div>
</div>
<!-- 상단 영역 공통 끝 -->
<div id='container'>
    <div id='con'>
        <div id='con_main'>
            <!-- 왼쪽 콘텐츠 영역 시작 -->
            <!-- 오른쪽 콘텐츠 영역 시작 -->
            <div id='main_con_left'>
                <!--게시판 메뉴-->
                <div class='main_con_left_w con_outline'>
                    <?include_once $this->config->item('basic_url')."/include/admin_menu.php";?>
                </div>
            </div>
            <div id='main_con_right'>
                <div class='main_con_right_w con_outline'>
                	<?
		 //관리자 계정 관련 정보 출력
		 if(isset($admin_user)){
			 echo '<h1>관리자 리스트</h1><ol>';
			 foreach ($admin_user as $a_user)
				{
					//print_r($p_user);
					echo '<li><b>'.$a_user['name'].'&nbsp;</b>
					('.$a_user['email'].')&nbsp;
					회원그룹 변경하기
					[
					<a href="/admin/cancel_admin_user/'.$a_user['id'].'" target="_self">일반 사용자</a>]
					</li>';
				}
			 echo '</ol><br/>';
		 }
		?>
		<?
		 //일반 사용자 리스트 출력하기
		 if(isset($user_info)){
			 if($not_result=='y'){
			 	echo "<div style='background: #efefef;; padding: 10px; text-align: center;'>
				 	<a href='/admin/user_list/'>전체</a>
				 	&nbsp;|&nbsp;
				 	<a href='/admin/user_list/0'>일반사용자</a>
				 	&nbsp;|&nbsp;
				 	<a href='/admin/user_list/2'>시범운영기관</a>
				 	</div>";
				 echo '<br/>출력된 값이 없습니다.';
			 }else{

			 	echo "<div style='background: #efefef;; padding: 10px; text-align: center;'>
				 	<a href='/admin/user_list/'>전체</a>
				 	&nbsp;|&nbsp;
				 	<a href='/admin/user_list/0'>일반사용자</a>
				 	&nbsp;|&nbsp;
				 	<a href='/admin/user_list/2'>시범운영기관</a>
				 	</div>";

			 	if($now_u_group=='0'){
				 	echo '<h1>일반 사용자 리스트</h1>';
				 	echo '<ol>';
					 foreach ($user_info as $user_info)
						{
							//print_r($p_user);
							echo '<li><b>'.$user_info['name'].'</b>&nbsp;
								회원그룹 변경하기
								[<a href="/admin/set_admin_user/'.$user_info['id'].'" target="_self">
								관리자</a>
					 			&nbsp;|&nbsp;
								<a href="/admin/set_tester_user/'.$user_info['id'].'" target="_self">
								시범운영기관</a>
								]
								<br/>
								('.$user_info['email'].', ['.$user_info['created'].'])
								</li>';
						}
					 echo '</ol><br/>';
				 }else if($now_u_group=='2'){
				 	echo '<h1>시범운영기관 리스트</h1>';
				 	echo '<ol>';
					 foreach ($user_info as $user_info)
						{
							//print_r($p_user);
							echo '<li><b>'.$user_info['name'].'</b>&nbsp;
								회원그룹 변경하기
								[<a href="/admin/set_admin_user/'.$user_info['id'].'" target="_self">
								관리자</a>
					 			&nbsp;|&nbsp;
								<a href="/admin/set_basic_user/'.$user_info['id'].'" target="_self">
								일반 사용자</a>
								]
								<br/>
								('.$user_info['email'].', ['.$user_info['created'].'])
								</li>';
						}
					 echo '</ol><br/>';
				 }else{
				 	echo '<h1>전체 사용자 리스트(관리자 제외)</h1>';
				 	echo '<ol>';
					 foreach ($user_info as $user_info)
						{
							//print_r($p_user);
							echo '<li><b>'.$user_info['name'].'</b>&nbsp;
								회원그룹 변경하기
								[<a href="/admin/set_admin_user/'.$user_info['id'].'" target="_self">
								관리자</a>
					 			&nbsp;|&nbsp;
								<a href="/admin/set_tester_user/'.$user_info['id'].'" target="_self">
								시범운영기관</a>
								]
								<br/>
								('.$user_info['email'].', ['.$user_info['created'].'])
								</li>';
						}
					 echo '</ol><br/>';
				 }
				 
			 }
		 }
		?>
                </div>
            </div>
        </div>

    </div>
    <?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
    <SCRIPT TYPE="text/javascript">
	function help_list(list_type){
		var list_type = list_type;
		$('#help_list_area').html('<div style="text-align:center; padding-top: 20px;"><img src="/img/loading.gif" style="width:50px;"><br/>loading</div>');
		$.post("/admin/show_charge_list_section",{
			list_type: list_type
		},
	   function(data){
		 //alert(data);
		 $('#help_list_area').html(data);
	   }); 
		
	}
</SCRIPT>
</div>
</body>
</html>