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

            time_graph();
            check_update_page();
            setInterval(function() {
                time_graph();
                check_update_page();
            }, 600000); 

            $('#datepicker_main').change(function(){
                var s_date = $('#datepicker_main').val();
                var s_date_sp = s_date.split( '-' );
                var s_date_f = s_date_sp[0] + s_date_sp[1] + s_date_sp[2];
                //alert(s_date_f);
                location.href = "/admin/main/"+s_date_f;
            });
        });

        function time_graph(){
           window.now_date = '_'+$('#datepicker_main').val();
           if(now_date=='all'){
                now_date = '';
           }
            if ($("#grp_iframe").length > 0){
                //$('#graph_area').html("<iframe id='grp_iframe' class='grp_iframe' src='/mypage/show_graph/All_2_"+now_date+"' width='100%' scrolling='no' frameborder='0'></iframe>");
                $('#grp_iframe').attr('src','/mypage/show_graph/All_2'+now_date);
            //do something
            }else{
                $('#graph_area').html("<iframe id='grp_iframe' class='grp_iframe' src='/mypage/show_graph/All_2"+now_date+"' width='100%' scrolling='no' frameborder='0'></iframe>");
            }
        }
        function check_update_page(){
            var update_page = $('#update_page').html();
            var date = '<?if(isset($date)){echo $date;}?>';

            $.post("/openpage/admin_update_check",{
                date: date
                },
               function(data){
                 //alert(data);
                 //입력값 초기화하기
                $('#update_page').html(data);
            });
            
        }
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
            <!-- 오른쪽 콘텐츠 영역 시작 -->
            <div id='main_con_left'>
                <!--게시판 메뉴-->
                <div class='main_con_left_w con_outline'>
                    <?include_once $this->config->item('basic_url')."/include/admin_menu.php";?>
                </div>
            </div>
            <div id='main_con_right'>
                <div class='main_con_right_w con_outline'>
		<h1>현재 진행상태</h1>
		<b>총 사용자 수</b>&nbsp;&nbsp;<?echo $total_user;?>&nbsp;&nbsp;
		<b>총 팀수</b>&nbsp;&nbsp;<?echo $total_team;?>&nbsp;&nbsp;
		<b>활성화된 페이지 수</b>&nbsp;&nbsp;<?echo $total_made_project;?>&nbsp;&nbsp;
		<b>작성중인 페이지 수</b>&nbsp;&nbsp;<?echo $total_making_project;?><br/>
		<!--<b>기술 지원 신규 요청</b>&nbsp;&nbsp;<?echo $offer_count;?><br/><br/>-->
		<a href='/openpage/get_where_visit/all_1' target='_blank'>Geo 정보 미기록분 기록하기</a><br/><br/><hr/><br/>
		<!--Time Graph 출력 -->
		<div id='graph_area'>
		</div>
		<div id='update_page'>
		</div>
		<!--Time Graph 출력 끝 -->
		<!--data picker 관련 시작 -->
		<!--data picker 관련 시작 -->
		<link rel="stylesheet" href="//code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
		<script src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
		<!--data picker 관련 끝 -->
		<script type="text/javascript"> 
		//data picker
		$(function() {
			$.datepicker.setDefaults( $.datepicker.regional[ "ko" ] );
		          $( "#datepicker_main" ).datepicker({dateFormat:"yy-mm-dd"});
		});
		</script>
		<input  type="text" id="datepicker_main" style="width: 150px; margin-top:10px;" value="<?echo $date;?>"/>
		<a href='/admin/main/all' target='_self'>전체 보기</a>
		<br/>
		<!--data picker 관련 끝-->
		<?$this->load->view('/include/admin_date_act');?>

                </div>
            </div>
        </div>

    </div>
    <?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
</div>
</body>
</html>