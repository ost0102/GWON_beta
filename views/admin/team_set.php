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

	function check_update_page(){
		var update_page = $('#update_page').html();
		$.get("/openpage/admin_update_check",function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			$('#update_page').html(data);
		});
	}
	</script>

	<style>
		#now_gwon_title_txt{
			font-size: 20px;	
			font-weight: bold;
			padding: 15px;
		}
		.team_mate_title, .team_mate_state{
			display: none;
		}
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
		<h1>캠페인별 팀원 설정</h1>
		<div id="help_list_area">
			<div id="page_search_area">
				<span class='t_basic'>
					<b>팀원 정보를 변경하고자 하는 페이지 타이틀을 입력해주세요.</b>
				</span>
				<script type="text/javascript">
					//멤버 추가하기
					function check_gwon_title_result(w_num,title){
						$('#now_gwon_title_txt').html('사이트 제목 : '+title);
						$('#now_gwon_title').val(w_num);
						$('#team_mate_add').slideDown();

						check_teammate();
					}
				</script>
				<?$this->load->view('/include/search_gwon');?>
				<div id='now_gwon_title_txt'>
				</div>
				<input type='hidden' name='now_gwon_title' id='now_gwon_title' readonly/>
				<div id="team_mate_add">
					<span class='t_basic'><b>추가하고자 하는 팀원의 email주소를 입력해주세요.</b></span>
					<script type="text/javascript">
						//멤버 추가하기
						function add_authors(u_id,name){
							var w_num = $('#now_gwon_title').val();
							var page_user = "'"+w_num+'_'+u_id+"'";
							//alert(page_user);
							add_project_mate(w_num+'_'+u_id);
							//DB에 멤버 정보 입력하고, 쿼리때려서 공동 저자 리스트 가져오기
							//시리즈 생성 버튼 눌러야 공동 저자 정보 출력되도록 변경.멤버 테이블에 번호 저장하는 쿼리 날리기기
						}

						function add_project_mate (at_val){
							//alert(at_val);
							$.get("/team/add_project_mate/"+at_val,function(data,status){
								//alert("Data: " + data + "\nStatus: " + status);
								if(data == '등록이 완료되었습니다.'){
									$('#co_authors_query_result').html(data);
									check_teammate();
								}else{
									open_modal(data);
									fadeout_modal();
									$('#co_authors_query_result').html('');
							 		$('#co_authors').val('');
								}
								//$('#search_result_team_mate').html(data);
								//$('#search_result_team_mate').show();
								//사용자 정보를 받은 후, 프로젝트 팀원으로 등록하는 기능 개발하기
						   });
						}


						//팀원정보 리로드
						function check_teammate(){
							//alert(at_val);
							//var w_num = <?if (isset($w_num)){echo $w_num;}?>;
							var w_num = $('#now_gwon_title').val();
							
							$.get("/team/check_teammate/"+w_num,function(data,status){
								//alert("Data: " + data + "\nStatus: " + status);
								$('#team_mate_title').slideDown();
								$('#team_mate_state').slideDown();
								$('#team_mate_state').html(data);
						   });
						}

						//팀메이트 삭제하기
						function del_project_mate(at_val){
							$.get("/team/del_project_mate/"+at_val,function(data,status){
								//alert("Data: " + data + "\nStatus: " + status);
								if(data == '삭제되었습니다'){
									$('#search_result_team_mate').html(data);
									check_teammate();
								}else{
									open_modal(data);
									fadeout_modal();
									check_teammate();
								}
								//$('#search_result_team_mate').html(data);
								//$('#search_result_team_mate').show();
								//사용자 정보를 받은 후, 프로젝트 팀원으로 등록하는 기능 개발하기
						   });
						}

					</script>
					<?$this->load->view('/include/search_mail');?>
				</div>
				<h3 id='team_mate_title'>현재 팀원</h3>
				<div id ='team_mate_state'>
				</div>
			</div>
		</div>

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