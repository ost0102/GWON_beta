
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
	<?
	$this->load->view('/include/inc_openpage_head');
	?>
</head>
<body>
<div id='bg_area' title='<? echo $project_img; ?>'>
</div>
<div id='container'>
	<!-- top Area Start -->
	<?
	$gwon_users=$this->session->userdata('gwon_users');
	$u_group=$this->session->userdata('u_group');
	?>
	<div id='gwon_login_area'>
		<div id='gwon_login_area_txt'>
			<?
			
			 if($gwon_users==""){
			?>
			이미 회원이신가요? 
			<a href = '/user/login_page?now_page=<?echo $domain;?>'>로그인</a>&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href = '/user/?now_page=<?echo $domain;?>'>회원가입</a>
			<?}else{?>
				<?if($u_group==1){?>
			     <a href = '/admin/main' target='_blank'>관리자</a>
				<?}?>
			     <a href = '/mypage' target='_blank'>마이 페이지</a>
			     <a href = '/user/logout/activate'>로그아웃</a>
			<?}?>
			<?
				$now_url = $_SERVER['REQUEST_URI'];
				if($now_url !='/user/login_page' && $now_url !='/user'){
					$newdata = array(
						'now_url_ss'  => $now_url
						 );

					$this->session->set_userdata($newdata);
				}
			?>
			
		</div>
	</div>
	<div id='top_area'>
		<div id='top_con'>
			<?$now_url = $_SERVER['REQUEST_URI'];
			$base_url = $this->config->item('base_url');

			
			if(isset($domain_url)){
				$now_call=$this->input->get('now_call');
				//이미 외부 도메인에서 iframe으로 호출한 거라면..
				if($now_call=='other_domain'){
					$site_domain = $base_url.'/'.$domain;

				}else{
					if($domain_url==''){
						//연결된 외부 도메인이 없을 경우 Gwon기본 도메인 사용
						$site_domain = $base_url.'/'.$domain;
					}else{
						$site_domain = 'http://'.$domain_url;
					}
				}
				
			}else{
				//domain_url정보가 없음. 그러면 그냥 기본 url로.. 잘못하면 iframe 수백개 생길수 있으니..
				$site_domain = $base_url.'/'.$domain;
			}
			?>

			<?if($logo!=''&&$top_img_url!="noshow"){
				echo '<a href="'.$site_domain.'" target="_self"><img src="'.$logo.'" id="logo_img" '.$top_img_url_txt.'></a>';
			}?>
			<?if($top_title!="noshow"){
			?>
			<h2 id='top_title' ><?echo $title;?></h2>
			<?}?>
			<?if($top_date!="noshow"){
			?>
			<span id='date_info' <?echo $top_date_txt;?>>
				<b>접수 기간</b>
				<?echo date("Y년m월d일", strtotime( $start_date ));?>
				<?echo date("H시i분", strtotime( $start_time ));?>
				~<br/>
				<?echo date("Y년m월d일", strtotime( $end_date ));?>
				<?echo date("H시i분", strtotime( $end_time ));?>
			</span>
			<?}?>
		</div>
	</div>
	<div id='menu_area'>
		<?
		$today_ymd = date("Ymd H:i");
		$start_date_ymd = date("Ymd H:i", strtotime( $start_date.$start_time ));
		$end_date_ymd = date("Ymd H:i", strtotime( $end_date.$end_time ));
		/*echo $start_date_ymd;
		echo '<br/>';
		echo $end_date_ymd;
		*/

		if($today_ymd>=$start_date_ymd&&$today_ymd<=$end_date_ymd){
			$check_apply = 'y';
		}else{
			$check_apply = 'n';
		}
		?>
		<div id='menu_txt'>
			<?
			/*if($div1_name!='')echo '<a onclick="scr_bt(\'menu1\')">'.$div1_name.'</a>&nbsp;';
			*/
			?>
			<a href="/<?echo $domain;?>">소개</a>&nbsp;|&nbsp;
			<a href="/board/noti_list?domain=<?echo $domain;?>">소식</a>
			<?
			if($check_apply =='y'){

				if($apply_txt==""){
					//지원안내 텍스트가 없다면..
					$apply_link = '/apl/'.$domain.'?page_num=1';
				}else{
					//지원안내 텍스트가 있다면..
					$apply_link = '/apl/'.$domain;
				}

			?>
			&nbsp;|&nbsp;
			<a href="<?echo $apply_link;?>" target="_self" style="text-decoration: none;">
			    <button id='post_project_info' class='btn btn-info'>
			        지원하기
			    </button>
			</a>
			<?
			}else{
				if($today_ymd<$start_date_ymd){
			?>
				&nbsp;|&nbsp;
				<!--<button id='post_project_info' onClick='apply_soon();' class='btn btn-info'>
				-->
				<a href="/apl/<?echo $domain;?>" target="_self" style="text-decoration: none;">
				<button id='post_project_info' class='btn btn-info'>
				    모집 예정
				</button>
				</a>
			<?
				}else{
			?>	
				&nbsp;|&nbsp;
				<!--<button id='post_project_info' onClick='apply_soon();' class='btn btn-info'>-->
				<a href="/apl/<?echo $domain;?>" target="_self" style="text-decoration: none;">
				<button id='post_project_info' class='btn btn-info'>
				    모집 종료
				</button>
				</a>
			<?
				}
			?>
			    
			<?
			}
			 ?>
			 &nbsp;|&nbsp;
			<a href="/apply/check_passer_result/<?echo $domain;?>">결과 조회</a>
			
		</div>
	</div>
	<!-- top Area finish -->
	<!-- Contents Area Start -->
	<div id='con_area'>
		<?
		if(!isset($inc_con_type)){
			$inc_con_type = 'main';
		}
		if($inc_con_type=='main'){
			$this->load->view('/include/inc_con_area');
		}else if($inc_con_type=='apply'){
			if(isset($page_num)&&$page_num==0){
				$this->load->view('/include/inc_con_area_form_intro');
			}else{
				$this->load->view('/include/inc_con_area_form');
			}
		}else if($inc_con_type=='apply_success'){
			$this->load->view('/include/inc_con_area_form_result');
		}else if($inc_con_type=='board_list'){
			$this->load->view('/board/openpage_board_list');
		}else if($inc_con_type=='board_regist'){
			$this->load->view('/board/openpage_board_regist');
		}else if($inc_con_type=='board_detail'){
			$this->load->view('/board/openpage_board_detail');
		}else if($inc_con_type=='check_result'){
			$this->load->view('/include/inc_check_passer');
		}
		?>
		<!-- Bottom-->
		<div id='bottom'>
			<div id='bt_txt'>
				<?
					$base_url = $this->config->item('base_url');
				?>
				<a href='<?echo $base_url;?>/<?echo $domain;?>'><?echo $title;?></a>
				<div style='width: 100%; padding-top: 10px; padding-bottom: 10px; text-align: center;'>
					이 사이트는 쉬워지는 지원사업 <a href="<?=$this->config->item('base_url');?>/" target='_blank'>Gwon</a>을 통해
					개발되었습니다.
				</div>
				
				<a href="<?=$this->config->item('base_url');?>/" target='_blank'>
				<?=$this->config->item('service_url');?></a> © &nbsp;2020<br/>
				<!--<span id="contact_area"><b>Contact : </b><?echo $contact;?></span> | 
				-->
				<span style="font-size: 10px;">
					Updated : <? echo $edit_time; ?>
				
					<?
					if(isset($edit_con)&&$edit_con==2){
						$can_edit = 'y';
					}else{
						$can_edit = 'n';
					}
					if($can_edit=='y'){
						echo '&nbsp;|&nbsp; <a href="/mypage/page_detail/'.$page_secur.'" target="_blank">관리 페이지 바로가기</a>';
					}?>
				</span>
				<!--
				<table>
					<tr>
						<td style='width: 100px;'>
							<?if($logo!='')echo '<img src="'.$logo.'" id="bottom_logo_img" style="max-width: 100px;" />';?>
						</td>
						<td style='text-align: left; padding-left: 25px;'>
							

						</td>
					</tr>
				</table>

				-->
				
			</div>
		</div>
		<!-- Bottom 끝 -->
		<!-- Other Contents Area finish -->
	</div>
<!--모달창 출력부분 시작-->
<div id="modal_content">
	 <div id="modal_txt">
		가상 팝업 내용 출력부분!
	</div>
	<div id='login_close'>
		<a onclick="modal_off();"><img src="/img/basic/bt_close.png"></a>
	</div>
</div>
<!--모달창 출력부분 끝 -->
<?
if(!isset($inc_con_type)){
	$inc_con_type = 'main';
}
if($inc_con_type=='main'){
?>
<script type="text/javascript">
	//10초후 팝업 체크하기
	setTimeout('check_popup()',1500);
</script>
<?
}
?>

<script type='text/javascript'>
	var agt = navigator.userAgent.toLowerCase();
	if (agt.indexOf("msie") != -1){
		//alert('익플');
		//'Internet Explorer'; 
		var trident = navigator.userAgent.match(/Trident\/(\d.\d)/i);
		//alert(trident);
		if(trident != null && trident[1] == "6.0"){
		//alert('IE10 입니다.');
		} else{
			alert('IE9 이하에서는 정확한 화면을 볼 수 없습니다. 구글 크롬을 설치한 후 이용해주세요.');
			popupOpen();
		}
	}else if (navigator.appName == 'Netscape' && navigator.userAgent.search('Trident') != -1) {
	  //alert('익플11');
	  //alert(agt);
	}

	function popupOpen(){
		var popUrl = "/page/goto_google_chrome/";	//팝업창에 출력될 페이지 URL
		var popOption = "width=500, height=400, resizable=no, scrollbars=no, status=no";    //팝업창 옵션(optoin)
		window.open(popUrl,"",popOption);
	} 
</script>


</body>
</html>