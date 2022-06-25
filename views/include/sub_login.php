<link href='/css/bootstrap.min.css' rel='stylesheet' />
<style>
	#modal_content{
		display:none;
		margin:50 auto;
		padding-left: 10px;
		width:280px;
		height:300px;
		/*background:#fff;*/
		background:#ffffff;
		filter:alpha(opacity=85);
		opacity: 0.85; 
		-moz-opacity:0.85
	}
	#modal_txt{
		float:left;
		font-size: 15px;
		font-weight: bold;
		width: 100%;
		margin-top: 10px;
		margin-bottom: 40px;
		height: 180px;
		text-align: center;

	}
	.cate_div{
		float: left; 
		margin-right: 20px; 
		margin-bottom: 5px; 
		padding: 10px; 
		background-color: #cdcdcd; 
		cursor: pointer;
	}
	#login_close{
		clear: both;
		height: 30px;
		margin-top: 10px;
		margin-bottom: 10px;
		width: 100%;
		text-align: center;
	}
	#con_html{
		float:left; 
		width: 90%;
		padding-left: 5%;
		padding-right: 5%;
		text-align:center;
	}
</style>
<!--로그인 div 영역 -->
<div id='login_sub'>
	<?
	 $user=$this->session->userdata('username');
	 $email=$this->session->userdata('email');
	 $gwon_users=$this->session->userdata('gwon_users');
	 $now_url=$_POST["now_url"];
	 if(!isset($now_url)){
		 $now_url = $_SERVER['REQUEST_URI'];
	}
	//facebook login시 현재 페이지 정보 세션화 처리하기
	$newdata = array(
		'now_url'  => $now_url);
	$this->session->set_userdata($newdata); 
	
	if(!$gwon_users){
	?>
	<h3 style="margin-bottom: 10px;">로그인</h3>
	<form id="form1" name="login" method="post" action="/user/login">
		<input id="email" name="email" class="email01" type="text" style="width: 80%;" onfocus="this.className='focus_area'" onblur="if (this.value.length==0) {this.className='email01';}else {this.className='focus_area';}" style="width:95%"/>
		<input id="password" name="password" class="password" type="password" style="width: 80%;" onfocus="this.className='focus_area'" onblur="if (this.value.length==0) {this.className='password';}else {this.className='focus_area';}" style="width:95%"/>
		<?
		$now_url_ss=$this->session->userdata('now_url_ss');
		$now_campaign_domain=$this->session->userdata('now_campaign_domain');
		if($now_campaign_domain!=''){
			$now_url = '/'.$now_campaign_domain;
		}else{
			$now_url = $now_url_ss;
		}
		?>
		<input type="hidden" name="now_url" style="width: 100%" value=<?echo $now_url;?>>
		<button type="submit" class='btn btn-primary'>
			<img src='/img/icon/icon_login_w.png' alt='login' style='width:15px; margin-right: 10px;' />
			로그인
		</button>
		<p style='font-size: 11px; font-weight: normal; font-family: "돋음"; margin-top:10px; margin-bottom: 10px;'>
			<a href='/user/find_password' target='_self'>비밀번호 찾기</a>
			&nbsp;|&nbsp;
			<a href='/user' target='_self'>회원가입</a>
		</p>
	</form>
	<?
	}else{
	$username=$this->session->userdata('username');
	$email=$this->session->userdata('email');
	$user_photo=$this->session->userdata('user_photo');
	?>
	<div style="clear: both; width: 100%;">
		<?echo '<b>'.$username.'</b>&nbsp;&nbsp;&nbsp;<a href="/user/edit_profile" target="_self">Edit profile</a><br/>';
		echo '<a href="#" onClick="logout();" >Logout</a><br/>';?>
	</div>
	<? } ?>
</div>
<script>
function logout() {
	location.href="/user/logout";	
}
</script>
<!-- 로그인 영역 끝 -->