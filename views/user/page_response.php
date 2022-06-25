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
		check_response_table();


        });

	//접수 정보 가져오기
	function check_response_table(){
	   var w_num = '<?echo $w_num;?>';
	   //alert(s_date);
	    //$('#graph_area').html('<div style="width:100%; text-align: center;"><img src="/img/loading.gif" style="width:50px;"></div>');
	    $('#res_table_area').html("<iframe id='res_iframe' class='grp_iframe' src='/mypage/show_response_table/"+w_num+"' width='100%' height='300px;' scrolling='auto' frameborder='0'></iframe>");

	}

    </script>
<!--data picker 관련 시작 -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<script src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script type="text/javascript"> 
	//data picker
	$(function() {
		$.datepicker.setDefaults( $.datepicker.regional[ "ko" ] );
		$( "#datepicker1" ).datepicker({dateFormat:"yy-mm-dd"});
	}); 

</script>
<!--data picker 관련 끝-->
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
			<? if(isset($response_total)){
			?>
			<div class='dash_con_area'>
				<div class='dash_con'>
					<a href='<?echo $this->config->item('base_url');?>/<? echo $domain;?>' target='_blank'>
						<img src='/img/icon/icon_link.png' class='icon_st'/>
						<?echo $this->config->item('base_url');?>/<? echo $domain;?>
					</a>
				</div>
				<div class='dash_con'>
					총 접수 양 : Total : <?echo $response_total;?>&nbsp;&nbsp;&nbsp;
					Today : <?echo $response_today;?>&nbsp;&nbsp;&nbsp;
					접수 완료 : <?echo $resp_finish_total;?>
				</div>
				<div class='dash_con'>
					<img src='/img/icon/icon_excel.png' class='img1' title='엑셀 다운로드' alt='엑셀 다운로드'/> 
					<a href='/mypage/ExcelExcute?div=exc1_ref&&p_co=<?echo $page_secur;?>' target='_blank' title='접수 서류'>
						접수 서류 다운로드
					</a>

										
				</div>
				<div id="res_table_area" class='dash_con'>
					<?
					/*호출영역
					echo '<table class="inno_table">';
					echo '<tr>';
					echo "<td>작성자</td>";
					foreach ($form_set_info as $form_info)
					{
						//print_r($form_info);
						$key = $form_info['key'];
						$item_id = $form_info['item_id'];
						$display_name = $form_info['display_name'];
						$field_type = $form_info['field_type'];

						echo "<td>".$display_name."</td>";
					}
					echo "<td>등록일</td>";
					echo '</tr>';
					?>
					<?
					echo '<tr>';
					foreach ($form_user_info as $fuser_info)
					{
						//print_r($form_info);
						$key = $fuser_info['key'];
						$item_id = $fuser_info['item_id'];
						$item_value = $fuser_info['item_value'];
						$id_secur = $fuser_info['id_secur'];
						$username = $fuser_info['username'];
						$user_id = $fuser_info['user_id'];
						$date = $fuser_info['date'];

						if($key ==1){
							echo "<td>".$username."</td>";
						}
						echo "<td>".$item_value."</td>";
					}
					echo "<td>".$date."</td>";
					echo '</tr>';
					echo '</table>';
					*/
					?>
				</div>
				<div class='dash_con'>
					* 나중에 날짜별 지원율, 방문자 수 막대그래프로 보이도록 변경 (한달 기준)
				</div>

				<div class='dash_con'>
					<table style='width: 100%'>
						<tr>
							<td style='width:50%; text-align:left;'><a href='javascript:history_back();'>back</a></td>
							<td style='text-align:right;'>
								<a href='/mypage/show_response_table/<?echo $w_num;?>?open_type=blank' target='_blank'>
								새창으로 작성 내용 보기</a>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<?
			}else{
				echo '프로젝트 참여정보가 없습니다.<br/>';
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