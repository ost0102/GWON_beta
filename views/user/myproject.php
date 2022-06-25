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
						지원 사업 관리
					</h3>
					<div class='mypage_con_list'>
                     <? 
                    //print_r($my_project);
                    if(isset($my_project)){
                        foreach ($my_project as $my_project_info)
                        {

                            $p_num = $my_project_info['p_num'];
                            $page_secur = $my_project_info['page_secur'];
                            $title = $my_project_info['title'];
                            $summary = $my_project_info['summary'];
                            $logo = $my_project_info['logo'];
                            $project_img = $my_project_info['project_img'];
                            $domain = $my_project_info['domain'];
                            $start_date = $my_project_info['start_date'];
                            $end_date = $my_project_info['end_date'];
                            $start_time = $my_project_info['start_time'];
                            $end_time = $my_project_info['end_time'];
                            $visited_today = $my_project_info['visited_today'];
                            $visited_total = $my_project_info['visited_total'];
                            $tp_state = $my_project_info['tp_state'];
                            $state = $my_project_info['state'];
                            $sub_content = strip_tags($summary);
                            $sub_content = iconv_substr($sub_content, 0, 100, "utf-8").'...';

                            $start_date_ymd = date("Y/m/d H:i", strtotime($start_date.$start_time ));
                            $end_date_ymd = date("Y/m/d H:i", strtotime($end_date.$end_time ));


                            ?>
                            <!--item 영역-->
                            <div class='mypage_item'>
                            	<a href='<?echo $this->config->item('base_url')."/".$domain;?>' target='_blank'>
								<h3 class='main_con_title' style='margin-bottom: 0px; '>
								<?echo $title;?>
								</h3>
								</a>
								<!--
								<span><?echo $summary;?></span>
								-->

								<?  
								if($tp_state=='1'){
								echo '<b><a href="/tpub/page/'.$page_secur.'" target="_blank" >
								임시 활성화 사용 중</a></b>';
								echo '<br/>공개된 페이지일 경우 수정 후 미 반영된 정보가 있을 수 있습니다. 임시활성화 기능은 페이지 활성화 단계에서 변경 가능합니다.';
								echo "</div>";
								}
								
								?>
								<div class='work_item_link_area'>
									<?
									//활성화된 정보의 경우 URL 및 기타 보기 메뉴 출력
									if($state!='0'){
									echo "<div class='work_item_con2'>";
									echo '<b>모집 기간 : </b><br/>'.$start_date_ymd.'~';
									echo $end_date_ymd.'<br/>';
									echo "</div>";
									echo "<div class='work_item_con2'>
									        <a href='".$this->config->item('base_url')."/".$domain."' target='_blank'>
									        ".$this->config->item('base_url')."/".$domain."</a>
									    </div>";
									?>
									<?
									}else{
										echo "해당 Gwon 페이지는 비활성화 되었습니다.";
									}
									?>
									<div class='work_item_con2'>
									<a href='/makepage/outline/<?echo $page_secur;?>' target='_self'>
									    <span style='font-size: 12px;'>
									        수정하기
									    </span>
									</a>
									</div>


									<div class='work_item_con2'>
									<a href='/mypage/page_detail/<?echo $page_secur;?>' target='_self'>
									    <span style='font-size: 12px;'>
									        DashBoard
									    </span>
									</a>
									</div>

								</div>

                            </div>
                            <?			                                
                        }
                    }else{
                        echo '생성한 지원사업 정보가 없습니다.';
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