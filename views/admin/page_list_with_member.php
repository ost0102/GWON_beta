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
                	<h1>페이지별 팀원 정보 </h1>
		<?
		 if(isset($gwon_info)){

		echo '<table class="admin_table" border="1">
			<tr> 
			<th>w_num</th>
			<th>페이지 제목 </th>
			<th>상태</th>
			<th>팀원</th>
			</tr>';

			foreach ($gwon_info as $gwon_info)
			{
				$num = $gwon_info['num'];
				$w_num = $gwon_info['w_num'];
				$page_secur = $gwon_info['page_secur'];
				$domain = $gwon_info['domain'];
				$title = $gwon_info['title'];
				$member = $gwon_info['member'];
				$state = $gwon_info['state'];

				echo '<tr>';
				echo '<td>';
				echo $w_num;
				echo '</td>';
				echo '<td style="width: 40%;">';

				if($state==1){
					echo '<a href="http://'.$this->config->item('intro_url').'/'.$domain.'" target="_blank">';
					echo $title;
					echo '</a>';
				}else{
					echo $title;
				}
				echo '</td>';

				echo '<td style="width: 10%;">';

				if($state==1){
					echo '활성화';
				}else{
					echo '제작중';
				}
				echo '</td>';





				echo '<td>';
				echo '<ul style="text-align: left;">';
				foreach ($member as $member)
				{
					$user_id = $member['user_id'];
					$position = $member['position'];
					$id_secur = $member['id_secur'];
					$username = $member['username'];
					$email = $member['email'];

					echo '<li>';
					echo '<a href="http://'.$this->config->item('intro_url').'/@'.$id_secur.'" target="_blank">';
					echo $username;
					echo '</a>&nbsp;';
					echo $email;

					echo '</li>';
				};
				echo '</ul>';
				echo '</td>';

				echo '</tr>';
			}
		}


		echo '</table>';


		?>
		<div style='width: 100%; text-align: center;' class="col-md-12">
		<?=$pagination;?>
		</div>
                </div>
            </div>
        </div>

    </div>
    <?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
</div>
</body>
</html>