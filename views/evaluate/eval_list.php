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
    <div id='workspace_top_noti'>
            <div id='top_noti_con_txt'>
                <!-- noti_txt -->
                <?include_once $this->config->item('basic_url')."/include/inc_top_noti_txt.php";?>
            </div>
            <div id='top_menu_area'>
                <!-- sub_top area include -->
                <?include_once $this->config->item('basic_url')."/include/inc_top_menu_login.php";?>
            </div>
    </div>
    <div id='workspace_top_con'>
        <?include_once $this->config->item('basic_url')."/include/inc_top_menu_workspace.php";?>
    </div>
</div>
<!-- 상단 영역 공통 끝 -->
<div id='dashboard_container'>
    <div id='workspace'>
        <!-- 왼쪽 콘텐츠 영역 시작 -->
        <div id='workspace_center' class='wkarea1'>
            <div id='wp_center_con'>
		<div id="con_main">
			<h1 class="dash_h1">Dashboard</h1>
			<div id="back_bt_area">
				<a href="/mypage" target='_self'>Back</a>
			</div>
			<!--Dashboard Menu-->
        			<?include_once $this->config->item('basic_url')."/include/inc_dashboard_menu.php";?>
			<!--응답 세부정보가 있으면 출력.. -->
			<? if(isset($eva_step_info)){
			?>
			<div class='dash_con_area'>
				<h3 style="text-align: center;">
					'<a href='<?echo $this->config->item('base_url');?>/<? echo $domain;?>' target='_blank'>
						<span style="font-size: 1.3em;">
							<? echo $title;?>
						</span>
					</a>' 평가 페이지
					
				</h3>
				<div id="res_table_area" class='dash_con'>
					<?
					if($eva_step_info!=''){
						echo '<table class="inno_table">';
						echo '<tr>';
						echo "<td>단계</td>";
						echo "<td>형식</td>";
						echo "<td>시작</td>";
						echo "<td>종료</td>";
						echo "<td>평가/선정</td>";

						echo "</tr>";
						foreach ($eva_step_info as $eva_step_infos)
						{
							$w_num = $eva_step_infos['w_num'];
							$step = $eva_step_infos['step'];
							$step_title = $eva_step_infos['step_title'];
							$field_type = $eva_step_infos['field_type'];
							$step_txt = $eva_step_infos['step_txt'];
							$step_attach = $eva_step_infos['step_attach'];
							$start_date = $eva_step_infos['start_date'];
							$end_date = $eva_step_infos['end_date'];
							$start_time = $eva_step_infos['start_time'];
							$end_time = $eva_step_infos['end_time'];
							$date = $eva_step_infos['date'];
							$field_type_txt = $eva_step_infos['field_type_txt'];
							$eva_access_info = $eva_step_infos['eva_access_info'];

							if($step!=0){
								echo '<tr>';
								echo '<td>'.$step_title.'</td>';
								echo '<td>'.$field_type_txt.'</td>';
								echo '<td>'.$start_date.' '.$start_time.'</td>';
								echo '<td>'.$end_date.' '.$end_time.'</td>';

								//평가위원일 경우
								if($eva_access_info=='y'){
									echo "<td>";
										echo "<a href='/evaluate/eval_detail/?w_num=".$w_num."&step=".$step."'>평가하기</a>";
									if(isset($project_admin)){
										echo "<br/><a href='/evaluate/eval_step_selecte/?w_num=".$w_num."&step=".$step."'>선정하기</a>";
									}
									echo "</td>";
								}else{
									//평가위원은 아닌데, 캠페인 팀원 일경우
									echo "<td>";
									if(isset($project_admin)){
										echo "<a href='/evaluate/eval_step_selecte/?w_num=".$w_num."&step=".$step."'>선정하기</a>";
									}
									echo "</td>";
								}
								echo "</tr>";
							}
						}
						echo '<tr>';
						echo '<th>최종 선정</th>';
						echo '<th>자체 선정</th>';
						echo '<th>-</th>';
						echo '<th>-</th>';
						echo "<th><a href='/evaluate/eval_step_selecte/?w_num=".$w_num."&step=0'>최종 선정</a></th>";
						echo '</tr>';

						echo "</table>";
						?>
						<?
					}else{
						echo '등록된 평가위원이 없습니다.';
					}
					?>
				</div>
			</div>
			<?
			}else{
				echo '평가 단계 설정 정보가 없습니다.<br/>';
			}?>
			
		</div>
		
	</div>

        </div>
    </div>
    <?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
</div>
<SCRIPT TYPE="text/javascript">
	function history_back(){
		history.back(-1);
	}
	//문의 내용 보기
	function mail_detail(m_id){
		//alert(m_id);
		$.post('/mypage/mail_con',{
			m_id: m_id
		},
		function(data){
			open_modal(data);
			$('#modal_txt').html(data);
			$('#login_close').show();
			//alert(data);
			 //window.open(linked_url,'','');
		}); 

	}
</SCRIPT>
</body>
</html>