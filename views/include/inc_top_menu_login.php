<?
$gwon_users=$this->session->userdata('gwon_users');
$u_group=$this->session->userdata('u_group');

$kakaoLoginUrl = $this->config->item('kakaoLoginUrl');
$kakaoLoginUrl2 = $this->config->item('kakaoLoginUrl2');
$kakaoLoginUrl3 = $this->config->item('kakaoLoginUrl3');

 if($gwon_users==""){
     
?>
이미 회원이신가요? 
<a href = '/user/login_page'>로그인</a>&nbsp;&nbsp;|&nbsp;&nbsp;

<a href = '<?=$kakaoLoginUrl2;?>'>카카오톡 회원가입</a>&nbsp;|&nbsp;
<a href = '/user/'>회원가입</a>
<?}else{?>
	<?if($u_group==1){?>
     <a href = '/admin/main' target='_blank'>관리자</a>
	<?}?>
     <a href = '/mypage'>마이 페이지</a>
     <a href = '/user/logout'>로그아웃</a>
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