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
                	<h1>메일링 가입 리스트</h1>
		<?
		 //메일링 리스트 관련
		 if(isset($mail_list)){
			 echo '<ol>';
			 foreach ($mail_list as $mail_list)
				{
					//print_r($p_user);
					echo '<li><b>'.$mail_list['email'].'</b>&nbsp;'.$mail_list['date'].'</li>';
				}
			 echo '</ol><br/>';
		 }else{
		 	echo '등록 내용이 없습니다.';
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