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
			<div id='main_con_left' style='margin-top: 0px;'>
				<!--마이페이지메뉴-->
				<div class='main_con_left_w con_outline menu_mypage'>
					<?include_once $this->config->item('basic_url')."/include/inc_mypage_sub_menu.php";?>
				</div>
			</div>
			<!-- 오른쪽 콘텐츠 영역 시작 -->
			<div id='main_con_right' style='margin-top: 0px;'>
				<!--새로 등록된 사연-->
				<div class='main_con_right_w con_outline'>
					<h3 class='main_con_title'>
						지원 신청 관리
					</h3>
					<div class='mypage_con_list'>
			                         <? 
			                        //print_r($user_apply_info);
			                        if(isset($user_bookmark_info)&&$user_bookmark_info!=''){
			                            foreach ($user_bookmark_info as $my_bookmark_info)
			                            {
			                                $page_secur = $my_bookmark_info['page_secur'];
			                                $title = $my_bookmark_info['title'];
			                                $domain = $my_bookmark_info['domain'];
			                                $date = $my_bookmark_info['date'];
			                                ?>
			                                <!--item 영역-->
			                                <div class='mypage_item'>
			                                	<a href='<?echo $this->config->item('base_url')."/".$domain;?>' target='_blank'>
								<h3 class='main_con_title' style='margin-bottom: 0px;'>
								<?echo $title;?>
								</h3>
							</a>
							<div class='work_item_link_area'>
								<?
								echo "<div class='work_item_con2'>
								        <a href='".$this->config->item('base_url')."/".$domain."' target='_blank'>
								        ".$this->config->item('base_url')."/".$domain."</a>
								    </div>";

								echo "<div class='work_item_con2'>";
								echo '<b>신청일 : </b>'.$date;
								echo "</div>";
								?>
								<div class='work_item_con2'>
									<a href='/apl/<?echo $domain;?>' target='_self'>
									    <span style='font-size: 12px;'>
									        내용 보기
									    </span>
									</a>
								</div>
							</div>
			                                </div>
			                                <?			                                
			                            }
			                        }else{
			                            echo '저장한 지원사업 정보가 없습니다.';
			                        }?>
					</div>

				</div>
			</div>

		</div>

		
	</div>
	<?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
	
</div>
</body>
</html>