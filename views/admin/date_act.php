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
		//Event 정보 가져오기 - /include/admin_date_act 와 연동
	        $('#datepicker1').change(function(){
	        	var s_date = $('#datepicker1').val();
	        	var s_date_sp = s_date.split( '-' );
	        	var s_date_f = s_date_sp[0] + s_date_sp[1] + s_date_sp[2];
	        	//alert(s_date_f);
	          	location.href = "/admin/page_count/"+s_date_f;
	        });

	        $('#datepicker2').change(function(){
	        	var s_date = $('#datepicker2').val();
	        	var s_date_sp = s_date.split( '-' );
	        	var s_date_f = s_date_sp[0] + s_date_sp[1] + s_date_sp[2];
	        	//alert(s_date_f);
	          	location.href = "/admin/page_log/"+s_date_f;
	        });
	        $('#datepicker3').change(function(){
	        	var s_date = $('#datepicker3').val();
	        	var s_date_sp = s_date.split( '-' );
	        	var s_date_f = s_date_sp[0] + s_date_sp[1] + s_date_sp[2];
	        	//alert(s_date_f);
	          	location.href = "/admin/page_ref/"+s_date_f;
	        });
	        $('#datepicker4').change(function(){
	        	var s_date = $('#datepicker4').val();
	        	var country_code = $('#country_code').val();
	        	var s_date_sp = s_date.split( '-' );
	        	var s_date_f = s_date_sp[0] + s_date_sp[1] + s_date_sp[2];
	        	//alert(s_date_f);
	          	location.href = "/admin/detail_country/"+country_code+'_'+s_date_f;
	        });
	        $('#datepicker5').change(function(){
	        	var s_date = $('#datepicker5').val();
	        	var country_code = $('#country_code1').val();
	        	var s_date_sp = s_date.split( '-' );
	        	var s_date_f = s_date_sp[0] + s_date_sp[1] + s_date_sp[2];
	        	//alert(s_date_f);
	          	location.href = "/admin/detail_country/"+country_code+'_'+s_date_f;
	        });
	        $('#datepicker6').change(function(){
	        	var s_date = $('#datepicker6').val();
	        	var city_code = $('#city_code').val();
	        	var s_date_sp = s_date.split( '-' );
	        	var s_date_f = s_date_sp[0] + s_date_sp[1] + s_date_sp[2];
	        	//alert(city_code);
	          	location.href = "/admin/detail_city/"+city_code+'_'+s_date_f;
	        });
	        $('#datepicker7').change(function(){
	        	var s_date = $('#datepicker7').val();
	        	var country_code = $('#country_code').val();
	        	var page_num = $('#page_num').val();
	        	var s_date_sp = s_date.split( '-' );
	        	var s_date_f = s_date_sp[0] + s_date_sp[1] + s_date_sp[2];
	        	//alert(city_code);
	          	location.href = "/admin/detail_geo_page/"+country_code+'_'+page_num+'_'+s_date_f;
	        });

	});

	</script>

	<style>
	#admin_ua_area{
		line-height: 40px;
	}
	</style>
	<!--data picker 관련 시작 -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
	<script src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	<!--data picker 관련 끝 -->
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
                	<?$this->load->view('/include/admin_date_act');?>
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