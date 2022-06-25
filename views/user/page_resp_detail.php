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
		check_response_con('start');


        });
        //상세보기 영역 콘텐츠
        function check_response_con(u_id,type){
		if(!u_id){
			u_id = '';
		}
		var now_url = "/mypage/show_response_con/"+<?echo $w_num;?>+"?u_id="+u_id+"&type="+type;
		$.get(now_url,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			$('#resp_result_area').html(data);
		});

        }
        //상세보기 리스트 resp_table_area
        function check_response_list(con_type){
        		$('#resp_table_area').fadeOut();
		if(!con_type){
			con_type = '';
		}
		if(con_type=="reject"){
			$("#add_apply").hide();
			$("#bt_yet_list").hide();
		}else if(con_type=="yet"){
			$("#bt_yet_list").show();
			$("#add_apply").show();
		}else{
			$("#bt_yet_list").hide();
			$("#add_apply").show();
		}
		var now_url = "/mypage/show_response_list/"+<?echo $w_num;?>+"?con_type="+con_type;
		$.get(now_url,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			$('#resp_table_area').html(data);
			$('#resp_table_area').fadeIn();
		});

        }

         //접수자 추가
        function add_apply(){
		var now_url = "/mypage/add_apply_form/"+<?echo $w_num;?>;
		$.get(now_url,function(data,status){
			//alert(data);
			//alert("Data: " + data + "\nStatus: " + status);
			$('#resp_result_area').html(data);
		});

        }
        //작성중인 사용자 명단보기
        function show_yet_list(){
		var now_url = "/mypage/show_yet_list/"+<?echo $w_num;?>;
		$.get(now_url,function(data,status){
			//alert(data);
			//alert("Data: " + data + "\nStatus: " + status);
			$('#resp_result_area').html(data);
		});
        }

        //접수정보 배제
        function reject_apply(target_u_id){
		var w_num = "<?echo $w_num;?>";
		$.post('/apply/reject_apply_info',{
			w_num: w_num,
			target_u_id: target_u_id
		},
		function(data){
			open_modal(data);
			$('#modal_txt').html(data);
			$('#login_close').show();
			//check_response_list('reject');
			location.reload();
			//alert(data);
			 //window.open(linked_url,'','');
		}); 


        }
        //접수정보 복구
        function restore_apply(target_u_id){
		var w_num = "<?echo $w_num;?>";
		$.post('/apply/restore_apply_info',{
			w_num: w_num,
			target_u_id: target_u_id
		},
		function(data){
			open_modal(data);
			$('#modal_txt').html(data);
			$('#login_close').show();
			//check_response_list('all');
			location.reload();
			//alert(data);
			 //window.open(linked_url,'','');
		}); 


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
			<?
			if(isset($form_user_info)){
			?>
			<div class='dash_con_area'>
				<div class='dash_con'>
					<a href='<?echo $this->config->item('base_url');?>/<? echo $domain;?>' target='_blank'>
						<img src='/img/icon/icon_link.png' class='icon_st'/>
						<?echo $this->config->item('base_url');?>/<? echo $domain;?>
					</a>
				</div>
				<div class='dash_con'>
					접수완료 서류 다운로드&nbsp;:&nbsp;
					<a href='/mypage/ExcelExcute?div=exc1_ref&&p_co=<?echo $page_secur;?>' target='_blank' title='접수 서류'>
						<img src='/img/icon/icon_excel.png' class='img1' title='엑셀 다운로드' alt='엑셀 다운로드'/> 
						엑셀다운로드
					</a>
					&nbsp;|&nbsp;
					<a href='/mypage/show_response_table/<?echo $w_num;?>?open_type=blank' target='_blank'>
						새창으로 보기
					</a>
				</div>
				<div class='dash_con'>
					전체 지원자 정보 다운로드&nbsp;:&nbsp;
					<a href='/mypage/ExcelExcute_all?div=exc1_ref&&p_co=<?echo $page_secur;?>' target='_blank' title='접수 서류'>
						<img src='/img/icon/icon_excel.png' class='img1' title='엑셀 다운로드' alt='엑셀 다운로드'/> 
						엑셀다운로드
					</a>
					<br/>
					* 전체 지원자 정보는 작성중인 사용자를 포함합니다. 지원자 및 항목수에 따라 다운로드에 시간이 오래걸릴 수 있습니다.
				</div>
				<div class='dash_con'>
					총 접수 : <a href="javascript:check_response_list('all');">Total</a> : <?echo $response_total;?>&nbsp;
					Today : <?echo $response_today;?>&nbsp;&nbsp;&nbsp;
					<a href="javascript:check_response_list('done');">접수 완료</a> : <?echo $resp_finish_total;?>&nbsp;&nbsp;&nbsp;
					<a href="javascript:check_response_list('yet');">작성 중</a> : <?echo $resp_doing;?>&nbsp;&nbsp;&nbsp;
					<a href="javascript:check_response_list('reject');">접수 배제</a> : <?echo $reject_total;?>&nbsp;|&nbsp;
					<a href="/mypage/send_mail_remind/<? echo $page_secur;?>" target="_blank"><b>마감임박 안내메일발송</b><a/>
				</div>
				<div class='dash_con'>
					<div id="resp_list_area">
						<div id='resp_table_area'>
							<?
							include_once $this->config->item('basic_url')."/include/inc_responses_table.php";?>
						</div>
						<div class='dash_con'>
							<table style='width: 100%'>
								<tr>
									<td style='width:70%; text-align:left;'>
										<button id="bt_yet_list" onclick="show_yet_list();"class="btn btn-inverse" style="display: none;">
											명단보기
										</button>
									</td>
									<td style='text-align:right;'>
										<button id="add_apply" onclick="add_apply();"class="btn btn-inverse">
											접수정보 추가
										</button>
									</td>
								</tr>
							</table>
							
						</div>
					</div>

					<div id='resp_result_area'>
						
					</div>
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