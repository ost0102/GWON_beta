<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?$this->load->view('/include/head_info');?>
<script type="text/javascript">
	//jQuery 있는 상태
	window.onload=function(){
		//$('#sc2_2').hide();		
	};
	$(document).ready(function() {
	});

	function regist() {
		location.href="/user/regist";	
	}
	function logout() {
		location.href="/user/logout";	
	}
</script>
</head>
<body>
	<div id=upload_img >
	<!--Upload img 확인하기 -->
	<?
	if(isset($u_data)){
		echo '<ul>';
		foreach ($u_data as $u_data)
		{
			//타입에 img가 포함되어 있다면, 이미지 형태로, 아니면 제목을 보여주기
			if(eregi('image',$u_data['type'])){
				echo '<li><a href="'.$u_data['file_url'].'" target="_blank"><img src="'.$u_data['file_url'].'" title="'.$u_data['file_name'].'" height="100px"></a> &nbsp;<a href="/upload/delete_img/'.$u_data['u_id'].'" target="_blank">삭제하기</a></li>';
			}else{
				echo '<li><a href="'.$u_data['file_url'].'" target="_blank">'.$u_data['file_name'].'</a>&nbsp;<a href="/upload/delete_img/'.$u_data['u_id'].'" target="_blank">삭제하기</a></li>';
			}
		}
		 echo '</ul>';
	 }
	?>
	</div>
	<script type="text/javascript">
	window.onload=function(){
		var con = $('#upload_img').html();
		//부모창으로 내용 보내기
		//alert(con);
		$(opener.document).find("#upload_img").html(con);
		parent.window.close();
	};
	
</script>
</body>
</html>