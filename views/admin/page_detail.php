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
		check_teammate();
		check_team();
		check_graph(1);
		mail_send_list(1);
		check_new_event();
		check_event_list(1);
		query_all();

		//Event 정보 가져오기
	        $('#datepicker2').change(function(){
	          check_event();
	        });
	        //이벤트 추가영역에 버튼 기본 설정 닫기로
	        $('#bt_event_hide').hide();

	        //Device Graph
		var val_desktop = '<?echo $val_desktop;?>';
		var val_win = '<?echo $val_win;?>';
		var val_mac = '<?echo $val_mac;?>';
		var val_bot = '<?echo $val_bot;?>';
		var val_not_set = '<?echo $val_not_set;?>';
		var win_per = parseInt(val_win/val_desktop*100);
		var mac_per = parseInt(val_mac/val_desktop*100);
		var bot_per = parseInt(val_bot/val_desktop*100);
		var not_set_per = parseInt(val_not_set/val_desktop*100);
		//alert(win_per);
		$('#desktop_win').css('width',win_per+'%');
		$('#desktop_win').attr('title','window : '+win_per+'%');
		$('#desktop_mac').css('width',mac_per+'%');
		$('#desktop_win').attr('title','Macintosh : '+win_per+'%');
		$('#desktop_bot').css('width',bot_per+'%');
		$('#desktop_win').attr('title','Bot : '+win_per+'%');
		$('#desktop_graph').attr('title','Not set : '+not_set_per+'%');

		//mobile graph
		var val_mob = '<?echo $val_mobile;?>';
		var val_and = '<?echo $val_android;?>';
		var val_iphone = '<?echo $val_iphone;?>';
		var val_ipod = '<?echo $val_ipod;?>';
		var val_ipad = '<?echo $val_ipad;?>';
		var and_per = parseInt(val_and/val_mob*100);
		var iphone_per = parseInt(val_iphone/val_mob*100);
		var ipod_per = parseInt(val_ipod/val_mob*100);
		var ipad_per = parseInt(val_ipad/val_mob*100);
		//alert(win_per);
		$('#mobile_and').css('width',and_per+'%');
		$('#mobile_and').attr('title','Android : '+and_per+'%');
		$('#mobile_iphone').css('width',iphone_per+'%');
		$('#mobile_iphone').attr('title','iphone : '+iphone_per+'%');
		$('#mobile_ipod').css('width',ipod_per+'%');
		$('#mobile_ipod').attr('title','ipod : '+ipod_per+'%');
		$('#mobile_graph').attr('title','ipad : '+ipad_per+'%');

		//하단 유입경로 분석에서 날짜 인풋박스 선택했을 경우
		$('#datepicker_visitor').change(function(){
			var s_date = $('#datepicker_visitor').val();
			$('#datepicker1').val(s_date);
			$('#graph_date_search').slideDown();
			search_date_graph("day");
			query_visitor();
			query_country();
			query_read();
			
		});
	});

	//유입 경로 분석
	function query_all(state_value){
		query_visitor('all');
		query_country('all');
		query_read('all');
	}
	function query_read(state_value){
		if(state_value !== 'all'){
			var s_date = $('#datepicker_visitor').val();
		}else{
			s_date = 'all';
		}

		var page_num = $('#page_num').val();
	    	var s_date_sp = s_date.split( '-' );
	    	var s_date_f = s_date_sp[0] + s_date_sp[1] + s_date_sp[2];
	    	//alert(city_code);
	    	$.get("/mypage/read_con/"+page_num+'_'+s_date,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			//alert(data);
			$('#read_table_area').html(data);
		});
	}

	function mail_send_list(page_num){
		var p_num = '<?echo $p_num;?>';
	    	$.post('/mypage/show_mail_list',{
			p_num: p_num,
			page_num: page_num
		},
		function(data){
			//alert(data);
			$('#mail_send_con_list').html(data);
			$('#mail_send_con_list').show();
		});
	}
	
	//유입 경로 분석
	function query_visitor(state_value){
		if(state_value !== 'all'){
			var s_date = $('#datepicker_visitor').val();
		}else{
			s_date = 'all';
		}
	    	var page_num = $('#page_num').val();
	    	var s_date_sp = s_date.split( '-' );
	    	var s_date_f = s_date_sp[0] + s_date_sp[1] + s_date_sp[2];
	    	//alert(city_code);
	    	$.get("/mypage/show_detail_refere/"+page_num+'_'+s_date,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			//alert(data);
			$('#ref_table_area').html(data);
		});
	}
	//유입 경로 분석
	function query_country(state_value){
		if(state_value !== 'all'){
			var s_date = $('#datepicker_visitor').val();
		}else{
			s_date = 'all';
		}
	    	var page_num = $('#page_num').val();
	    	var s_date_sp = s_date.split( '-' );
	    	var s_date_f = s_date_sp[0] + s_date_sp[1] + s_date_sp[2];
	    	//alert(city_code);
	    	$.get("/mypage/show_detail_country/"+page_num+'_'+s_date,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			//alert(data);
			$('#country_table_area').html(data);
		});
	}

	//유입 경로 분석
	function query_city(state_value){
	    	//alert(city_code);
	    	$.get("/mypage/show_detail_city/"+state_value,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			//alert(data);
			
			$('#city_info').show();
			$('#city_info_area').html(data);
			$('html,body').animate({scrollTop:$('#city_info_area').offset().top}, 500);
		});
	}

	//팀원정보 리로드
	function check_teammate(){
		//alert(at_val);
		var w_num = '<?echow_nump_num;?>';
		$.get("/team/check_teammate/"+w_num+"_mypage",function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			$('#team_mate_state').show();
			$('#team_mate_state').html(data);
			$('#team_mate_state').css('size','12px');
			$('#team_mate_state').css('line-height','15px');
	   });
	}
	//팀정보 리로드
	function check_team(){
		var w_num = '<?echo $w_num;?>';
		$.get("/team/check_team/"+w_num,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			$('#team_state').html(data);
			$('#team_state').show();
	   });
	}
	//graph 정보 가져오기
	function check_graph(at_val,s_date){
	   var graph_type = at_val;
	   var p_num = '<?echo $p_num;?>';
	   var s_date = s_date;
	   //alert(s_date);
	    //$('#graph_area').html('<div style="width:100%; text-align: center;"><img src="/img/loading.gif" style="width:50px;"></div>');
	    $('#graph_area').html("<iframe id='grp_iframe' class='grp_iframe' src='/mypage/show_graph/"+p_num+"_"+graph_type+"_"+s_date+"' width='100%' scrolling='no' frameborder='0'></iframe>");

	    //하단 일별 분석 영역도 변경 내용이 반영되도록 변경 하기.
	    var date_value = at_val;
	    if(date_value !='' && date_value !=1 && date_value!=2){
	    	$('#datepicker_visitor').val(date_value);
	    	//alert(date_value);
			query_visitor();
			query_country();
			query_read();
	    }
	    //var date_value = $('#s_date').val();

	}
	//이벤트 수정하기 - edit 버튼 눌렀을 경우
	function edit_event(s_date){
	   var p_num = '<?echo $p_num;?>';
	   var s_date = s_date;
	   var event_date = $('#datepicker2').val(s_date);
	   //alert(s_date);
		$('#event_form').show();
		$('#bt_event_add').hide();
		$('#bt_event_del').hide();
		$('#bt_event_hide').show();
		check_event();
	}
	//방문자 유입 많은 날 중 기록안된 날 있는지 체크하기
	function check_new_event(){
		//alert(at_val);
		var p_num = '<?echo $p_num;?>';
		$.get("/mypage/check_new_event/"+p_num,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			//alert(data);
			if(data=='update'){
				check_event_list(1);
			}
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
		    $( "#datepicker2" ).datepicker({dateFormat:"yy-mm-dd"});
		    $( "#datepicker_visitor" ).datepicker({dateFormat:"yy-mm-dd"});
		}); 

		function show_date_search(){
			window.now_search_div_graph = $('#graph_date_search').css('display');
			if(now_search_div_graph=='none'){
				$('#graph_date_search').slideDown();
			}else{
				$('#graph_date_search').slideUp();
			}

		}
		function search_date_graph(date_val){
			if(date_val == 'weekly_first'){
				//weekly면 검색일로부터 한달검색
				var date = '<? echo $first_publish_time;?>';
				date_str = date.split(" ");
				//alert(date_str[0]);
				//check_graph(now_date,'week');
				$('#datepicker1').val(date_str[0]);
			}
			window.now_date = $('#datepicker1').val();
			
			//alert(now_date);
			if(!now_date){
				alert('검색일을 입력해주세요!');
			}else{
				if(date_val == 'weekly' || date_val == 'weekly_first'){
					//weekly면 검색일로부터 한달검색
					check_graph(now_date,'week');
				}else{
					//특정일 검색 시작
					check_graph(now_date,'day');
				}
			}
			
			
		}

		//이벤트 등록하기
		function add_event(save_date){
			if(!save_date){
				//이벤트 등록창 열기
				$('#event_form').show();
				$('#bt_event_add').hide();
				$('#bt_event_del').hide();
				$('#bt_event_hide').show();
				check_event();
			}else if(save_date==3){
				//이벤트 등록창 열기
				$('#event_form').hide();
				$('#bt_event_add').show();
				$('#bt_event_del').hide();
				$('#bt_event_hide').hide();
			}else{
				//글 저장시..
				var event_date = $('#datepicker2').val();
				var event_memo = $('#event_memo').val();
				var p_num = '<?echo $p_num;?>';
				//alert(event_date);
				//alert(event_memo);
				if(event_date!=='' && event_memo!==''){
					$.post('/mypage/add_page_event',{
						p_num: p_num,
						event_date: event_date,
						event_memo: event_memo,
						event_state: save_date
					},
					function(data){
						open_modal(data);
						$('#modal_txt').html(data);
						$('#login_close').show();
						//alert(data);
						 //window.open(linked_url,'','');
						//작성 내용 지우고 창 닫기
						$('#event_form').hide();
						$('#bt_event_add').show();
						$('#bt_event_hide').hide();
						check_event_list(1);
					});
				}else{
					alert('이벤트 내용이 입력되어 있지 않습니다.');
				} 
			}
		}
		//event 기존 등록 값 존재여부 체크
		function check_event(){
			var p_num = '<?echo $p_num;?>';
			var event_date = $('#datepicker2').val();
			$.post('/mypage/check_event',{
				p_num: p_num,
				event_date: event_date
			},
			function(data){
				if(data!==''){
					$('#event_memo').val(data);
					$('#bt_event_del').show();
				}else{
					$('#event_memo').val('');
					$('#bt_event_del').hide();
				}
			});
		}
		//event 기존 등록 값 존재여부 체크
		function check_event_list(page_num){
			var p_num = '<?echo $p_num;?>';
			$.post('/mypage/check_event_list',{
				p_num: p_num,
				page_num: page_num
			},
			function(data){
				if(data!==''){
					$('#event_list').html(data);
					$('#event_list').show();
				}else{
					$('#event_list').html(data);
					$('#event_list').hide();
				}
			});
		}

		//목표달성그래프 관련 함수들
		function add_goal_graph(g_id){
			$('#g_id_value').val(g_id);
			$('#goal_graph_form').slideDown();
			$('#goal_graph_list').slideUp();
		}
		function goal_graph_list(g_id){
			$.get("/mypage/goal_graph_list/"+g_id,function(data,status){
				//alert("Data: " + data + "\nStatus: " + status);
				$('#goal_graph_list').html(data);
				$('#goal_graph_form').slideUp();
				$('#goal_graph_list').slideDown();
				//$('#linked_url').show();
		   });

		}
	</script>
	<!--data picker 관련 끝-->

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
                	<h1 class="dash_h1">Dashboard</h1>
			<div id="back_bt_area">
				<a href="/admin/page_count" target='_self'>Back</a>
			</div>
			
			<!--Dashboard Menu-->
        			<?include_once $this->config->item('basic_url')."/include/inc_dashboard_menu.php";?>
			<!--팀 세부정보가 있으면 출력.. -->
			<? if(isset($p_num)){
				//print_r($row);
				if($state=='0'){
					$state_txt = '&nbsp;<img src="/img/icon/icon_sandglass.png" class="icon_st">';
				}else{
					$state_txt = '';
				}

				if($project_img!=''){
					$project_img = $project_img;
				}else{
					$project_img = $logo;
				}

				$icon  =array('stop','tint','lemon','medkit','money','female','pencil','comments-alt','lightbulb','sun','file','file');
				$i=0;
				?>
				
				<div class='dash_con_area'>
					<table width='100%' style='margin-bottom: 15px;'>
						<tr>
							<td valign='top' style='width: 110px;'>
								<div class='circular' style='background:url("<?echo $project_img;?>") #cdcdcd no-repeat center center; width: 90px; height:90px; background-size:100px 100px;'>
							</td>
							<td valign='top'>
								<h3 style='margin-bottom: 10px;'><?echo $title.$state_txt;?></h3>
								<span style='font-size: 14px;'><?echo $summary;?><br/>
								<span style=' color: #cdcdcd;'>[생성일 : <?echo $date;?>]</span>
								
							</td>
						</tr>
					</table>
					<!--graph 출력! -->
					<div class='dash_con'>
						<a href='<?echo $this->config->item('base_url');?>/<? echo $domain;?>' target='_blank'>
							<img src='/img/icon/icon_link.png' class='icon_st'/>
							<?echo $this->config->item('base_url');?>/<? echo $domain;?>
						</a>
					</div>
					<div class='dash_con'>
						최종 업데이트 : <?echo $edit_time;?>&nbsp;
						생성자 <?echo $edit_u_name;?>
					</div>
					<div class='dash_con'>
						Total : <?echo $visited_total;?>&nbsp;&nbsp;&nbsp;Today : <?echo $visited_today;?>
					</div>
					<div class='dash_con'>
						<img src ='/img/icon/icon_recommend.png' class='img1' title='Bookmark' alt='Bookmark '> <?echo $like_total;?>&nbsp;
						<img src='/img/bt_fb.png' class='img2' title='facebook' alt='facebook'/> <?echo $like_fb;?>&nbsp;
						<img src='/img/bt_twt.png' class='img2' title='twitter' alt='twitter'/> <?echo $like_twt;?>&nbsp;
						<img src='/img/bt_kakao.png' class='img2' title='kakao talk' alt='kakao talk' /> <?echo $like_kakao;?>
					</div>
					<div class='dash_con'>
						<img src='/img/icon/icon_excel.png' class='img1' title='엑셀 다운로드' alt='엑셀 다운로드'/> 
						<a href='/admin/ExcelExcute?div=exc1_ref&&p_co=<?echo $page_secur;?>' target='_blank' title='방문자 정보'>유입 정보 다운로드</a>
						&nbsp;&nbsp;&nbsp;
						<a href='/admin/ExcelExcute?div=exc2_days&&p_co=<?echo $page_secur;?>' target='_blank' title='방문자 정보'>방문 횟수 다운로드</a>
					</div>

					<div class='dash_con'>
						<img src ='/img/icon/icon_pt.png' class='img1' alt='Desktop' title='Desktop'/> <?echo $val_desktop;?>&nbsp;
						<img src='/img/icon/icon_win.png' class='img2' alt='window' title='window'/> <?echo $val_win;?>&nbsp;
						<img src='/img/icon/icon_mac.png' class='img2' alt='macintosh' title='macintosh'/> <?echo $val_mac;?>&nbsp;
						<img src='/img/icon/icon_bot.png' class='img2' alt='bot' title='bot'/> <?echo $val_bot;?>&nbsp;
						<img src='/img/icon/icon_guide.png' class='img2' alt='Not set' title='Not set'/> <?echo $val_not_set;?>
						<?if($val_desktop!==0){?>
						<div id='desktop_graph' style='width:100%; height:10px; margin-top:10px; background: #cbcbcb;'>
							<div id='desktop_win' style='float:left; width:0%; height:10px; background: #81b900;'></div>
							<div id='desktop_mac' style='float:left; width:0%; height:10px; background: #4ab6b6;'></div>
							<div id='desktop_bot' style='float:left; width:0%; height:10px; background: #fdb83f;'></div>
						</div>
						<?}?>
					</div>
					<div class='dash_con'>
						<img src='/img/icon/icon_mobile.png' class='img1' alt='Mobile' title='Mobile'/> <?echo $val_mobile;?>&nbsp;
						<img src='/img/icon/icon_android.png' class='img2' alt='Android' title='Android'/> <?echo $val_android;?>&nbsp;
						<img src='/img/icon/icon_iphone.png' style='width:8px;' class='img2' alt='iphone' title='iphone'/> <?echo $val_iphone;?>&nbsp;
						<img src='/img/icon/icon_ipod.png' style='width:8px;' class='img2' alt='ipod' title='ipod'/> <?echo $val_ipod;?>&nbsp;
						<img src='/img/icon/icon_ipad.png' class='img2' alt='ipad' title='ipad'/> <?echo $val_ipad;?>
						<?if($val_mobile!==0){?>
						<div id='mobile_graph' style='width:100%; height:10px; margin-top:10px; background: #eec16c;'>
							<div id='mobile_and' style='float:left; width:0%; height:10px; background: #81b900;'></div>
							<div id='mobile_iphone' style='float:left; width:0%; height:10px; background: #ed3f70;'></div>
							<div id='mobile_ipod' style='float:left; width:0%; height:10px; background: #ea7a28;'></div>
						</div>
						<?}?>
					</div>
					<div id='graph_bt' class='dash_con' style='text-align: center; padding-bottom: 0px;'>
						<b>보기 : </b>
						<a href='javascript:check_graph("1");'>최근 한달</a> | 
						<a href='javascript:check_graph("2");'>시간대별</a> | 
						<a href='javascript:show_date_search();'>세부</a>
						<div id='graph_date_search'>
							<input  type="text" id="datepicker1" style="width: 150px; margin-top:10px;"/>
							<button class='btn btn-inverse' onclick='search_date_graph("day");'>
								<img src='/img/icon/icon_search_w.png' style='width:16px; margin-right: 5px;' valign='middle'>검색
							</button>
							<button class='btn btn-inverse' onclick='search_date_graph("weekly");'>~부터 한달</button>
							<button class='btn btn-inverse' onclick='search_date_graph("weekly_first");'>최초 생성일부터 한달</button><br/>
						</div>
					</div>
					<div id='graph_area'>
					</div>
					<!--주요 이벤트 영역-->

					<div class='dash_con'>
						<b>주요 이벤트</b>&nbsp;&nbsp;
						<button id='bt_event_add' class='btn btn-inverse' onclick='add_event();'>추가 / 수정</button>
						<button id='bt_event_hide' class='btn btn-warning' onclick='add_event(3);'>닫기</button><br/>
						<div id='event_form' style=''>
							<input  type="text" id="datepicker2" value="<? echo date("Y-m-d");?>" placeholder="날짜를 선택하세요." style="width: 100px; margin-bottom: 5px;"/><br/>
							<textarea id="event_memo" style="width: 100%;" placeholder="날짜에 해당하는 이벤트/이슈 내용을 입력하세요." /></textarea>
							<table width='100%'>
								<tr>
									<td width='50%'>
										<button class='btn btn-inverse' onclick='add_event(1);'>등록</button>
									</td>
									<td width='50%' style='text-align: right;'>
										<a id='bt_event_del'  href='javascript:add_event(2);'>삭제</a>
									</td>
								</tr>
							</table>
						</div>
						<div id='event_list' >
						</div>
					</div>
					<?if(isset($total_mail)&&$total_mail!=0){?>
					<div class='dash_con'>
						<h3>사용자 문의 : <?echo $total_mail; ?></h3>
						<div id="mail_send_con_list">
							<!--문의 정보 있을 경우 가져오기 -->
						</div>
					</div>
					<?}?>
					<?if(isset($team_member)){?>
					<div class='dash_con'>
						<h3 >Member</h3>
						<div id="team_mate_state">
							<!--팀원정보 출력 부분, ajax로 호출-->
						</div>
					</div>
					<?}?>
					<?if(isset($team_info)){?>
					<div class='dash_con'>
						<h3 >Team info</h3>
						<div id="team_state">
							<!--팀원정보 출력 부분, ajax로 호출-->
						</div>
					</div>
					<?}?>
					<?if(isset($like_user)){?>
					<div class='dash_con'>
						<h3 title="사이트 업데이트 소식을 전달합니다.">Bookmark</h3>
						<div id="pan_state" style="display: block;">
							<!--팀원정보 출력 부분, ajax로 호출-->
							<?
							echo '<ul>';
							foreach ($like_user as $like_users)
							{
								$user_id = $like_users['user_id'];
								$username = $like_users['username'];
								$email = $like_users['email'];
								$photo = $like_users['photo'];
								$u_secur = do_hash($user_id);

								echo "<li style='list-style:none; width: 100%; float: left; padding-top: 10px; padding-bottom: 10px; float: left;'>
								<table style='width:100%'>
								<tr><td style='width: 70px;'>
								<img src='".$photo."' style='width:50px; padding-right: 10px;' align='left'></td><td style='width:10px;'></td><td><b>
									<a href='/@".$u_secur."' target='_self'>".$username."</a></b><br/>".$email."<br/>
									</td></tr></table></li>";
							}
							echo '</ul>';
							?>
						</div>
					</div>
					<?}?>
					<?if(isset($linked_url)){?>
					<div class='dash_con'>
						<h3>관련 링크</h3>
						<div id="pan_state" style="display: block;">
							<!--팀원정보 출력 부분, ajax로 호출-->
							<?
							echo '<ul>';
							foreach ($linked_url as $linked_url)
							{
								$link_title = $linked_url['link_title'];
								$link_url = $linked_url['link_url'];
								$link_txt = $linked_url['link_txt'];
								$in_out = $linked_url['in_out'];
								$count = $linked_url['count'];

								if(strpos($link_url, 'facebook.com') !== false) {  
									$sns_type = '<img src="/img/icon/bt_fb.png" style="margin-right: 5px; width: 15px;">';
								}else if(strpos($link_url, 'twitter.com') !== false) {  
									$sns_type = '<img src="/img/icon/bt_twt.png" style="margin-right: 5px; width: 15px;">';
								}else if(strpos($link_url, 'youtu.be') !== false || strpos($link_url, 'youtube.com') !== false) {  
									$sns_type = '<img src="/img/icon/bt_youtube.png" style="margin-right: 5px; width: 15px;">';
								}else{
									$sns_type = '<img src="/img/icon/bt_link.png" style="margin-right: 5px; width: 15px;">';
								}
								echo '<li>'.$sns_type;
								echo '<b><a href="'.$link_url.'" target="_blank" title="'.$link_txt.'">'.$link_title.'</a></b>&nbsp;&nbsp;click : '.$count.'</li>';
							}
							echo '</ul>';
							?>
						</div>
					</div>
					<?}?>

					<?if(isset($linked_url2)){?>
					<div class='dash_con'>
						<h3>관련 정보-비활성화 정보</h3>
						<div id="pan_state" style="display: block;">
							<!--팀원정보 출력 부분, ajax로 호출-->
							<?
							echo '<ul>';
							foreach ($linked_url2 as $linked_url2)
							{
								$link_title = $linked_url2['link_title'];
								$link_url = $linked_url2['link_url'];
								$link_txt = $linked_url2['link_txt'];
								$in_out = $linked_url2['in_out'];
								$count = $linked_url2['count'];

								
								if(strpos($link_url, 'facebook.com') !== false) {  
									$sns_type = '<img src="/img/icon/bt_fb.png" style="margin-right: 5px; width: 15px;">';
								}else if(strpos($link_url, 'twitter.com') !== false) {  
									$sns_type = '<img src="/img/icon/bt_twt.png" style="margin-right: 5px; width: 15px;">';
								}else if(strpos($link_url, 'youtu.be') !== false || strpos($link_url, 'youtube.com') !== false) {  
									$sns_type = '<img src="/img/icon/bt_youtube.png" style="margin-right: 5px; width: 15px;">';
								}else{
									$sns_type = '<img src="/img/icon/bt_link.png" style="margin-right: 5px; width: 15px;">';
								}
								echo '<li>'.$sns_type;
								echo '<b><a href="'.$link_url.'" target="_blank" title="'.$link_txt.'">'.$link_title.'</a></b>&nbsp;&nbsp;click : '.$count.'</li>';
							}
							echo '</ul>';
							?>
						</div>
					</div>
					<?}?>
					<div class='dash_con'>
						<h3>일별 분석</h3>
						<input  type="text" id="datepicker_visitor" style="width: 150px; margin-top:10px;" value="<?echo date('Y년 '.'m월 '.'d일 ');?>"/>
						<input  type="hidden" id="page_num" style="width: 150px; margin-top:10px;" value="<?echo $p_num;?>"/>
						<a href='javascript:query_all();'>전체 보기</a><br/>
						<h3>유입 경로 분석</h3>
						<div id='ref_table_area'>
							<div style='width:100%; text-align: center;'><img src='/img/loading.gif' style='width:40px;'></div>
						</div>
						<span style='font-size: 11px; color: #cdcdcd;'>인스타그램 등 보안 프로토콜(https)를 사용하는 사이트의 경우 같은 보안 프로토콜 형태의 주소를 통해 공유해주셔야 정확한 유입경로를 분석 할 수 있습니다.
						( <b>https://instagram.com/<? echo $domain;?></b> )  </span>
					</div>
					<div class='dash_con'>
						<h3>콘텐츠 확인 여부</h3>
						<div id='read_table_area'>
							<div style='width:100%; text-align: center;'><img src='/img/loading.gif' style='width:40px;'></div>
						</div>
					</div>
					<div class='dash_con'>
						<h3>유입 경로 분석 - 국가 정보</h3>
						<div id='country_table_area'>
							<div style='width:100%; text-align: center;'><img src='/img/loading.gif' style='width:40px;'></div>
						</div>
					</div>
					<div id="city_info" class='dash_con' style="display: none;">
						<h3>세부 도시 정보</h3>
						<div id='city_info_area'>
						</div>
					</div>
					<div class='dash_con'>
						<div id='page_deactivate' style='float: left; width: 100%; padding-top: 10px; padding-bottom: 10px; padding-left: 3%;  '>
							<a href='/makepage/deactivate_page/<?echo $page_secur;?>' target='_self'>
								<img src='/img/icon/icon_x.png' style='margin-right: 5px; width: 15px;'/>페이지 비활성화
							</a>
						</div>
					</div>
					<div class='dash_con'>
						<table style='width: 100%'>
							<tr>
								<td style='width:50%; text-align:left;'><a href="/admin/page_count" target='_self'>back</a></td>
								<td style='text-align:right;'><a href='/makepage/add_other/<?echo $page_secur;?>' target='_self'>Edit info</a></td>
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
<SCRIPT TYPE="text/javascript">
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
</div>
</body>
</html>