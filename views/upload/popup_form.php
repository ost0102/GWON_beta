<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?$this->load->view('/include/head_info');?>
<?
$p_num = $this->session->userdata('p_num'); 
$position = $this->session->userdata('position');
$class_num = $this->session->userdata('class_num');
$user_id = $this->session->userdata('ej_user');
?>
<!--모바일 테스트 -->
<!--블랙베리 접근 시 모바일 페이지 이동/별도지정필요 -->
<script type=”text/javascript”>
var deviceBB = “blackberry”;
//Initialize our user agent string to lower case.
var uagent = navigator.userAgent.toLowerCase();
var cssFile = “mobile.css”;
//**************************
// Detects if the current browser is a BlackBerry of some sort.
if (uagent.search(deviceBB) > -1) {
//document.getElementById(’blackb’).href = ‘mobile.css’; // this doesn’t work
window.location = ‘/mobile/’;
//document.write(’<link href=”‘+cssFile+’” type=”text/css” rel=”stylesheet”>); //this doesn’t work either
}
</script>
<!--접속환경에 따른 페이지 이동 -->
<script language="JavaScript">
var mobileKeyWords = new Array('iPhone', 'iPod', 'BlackBerry', 'Android', 'Windows CE', 'LG', 'MOT', 'SAMSUNG', 'SonyEricsson');
for (var word in mobileKeyWords){
    if (navigator.userAgent.match(mobileKeyWords[word]) != null){
        document.location.href = '/upload/up1';
        break;
    }
}
</script>
<!-- 페이지 자동이동 / ver6 -->
<script>
  function goDesk() 
 {
    //페이지 이동 없음document.location.href = '/upload/up1';
 }
  setTimeout("goDesk()",1000);     
</script>
<!--모바일 테스트 끝 -->
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
	function load_file(){
		//현재 주소
		//var now_url = '<?echo $_SERVER['REQUEST_URI']; ?>';
		//보내기
		var p_num = '<?echo $p_num?>';
		var position = '<?echo $position?>';
		var class_num = '<?echo $class_num?>';
		var user_id = '<?echo $user_id?>';

		//선택한 메뉴 이름 가져오기
		//$now_ft = $('#foodtxt').text();
		//alert($now_ft);

		//음식 배열 변수화 시키기
		 var sel_fd = document.createElement("form");
		sel_fd.setAttribute("method","post");
		sel_fd.setAttribute("target","_self");
		sel_fd.setAttribute("action","/upload/check_file");
		document.body.appendChild(sel_fd);

		//전달할 변수 배열화 하기
		var i = new Array();
		i[0] = document.createElement("input");
		i[0].setAttribute("type","hidden");
		i[0].setAttribute("name","p_num");
		i[0].setAttribute("value",p_num);
		i[1] = document.createElement("input");
		i[1].setAttribute("type","hidden");
		i[1].setAttribute("name","position");
		i[1].setAttribute("value",position);
		i[2] = document.createElement("input");
		i[2].setAttribute("type","hidden");
		i[2].setAttribute("name","class_num");
		i[2].setAttribute("value",class_num);
		i[3] = document.createElement("input");
		i[3].setAttribute("type","hidden");
		i[3].setAttribute("name","user_id");
		i[3].setAttribute("value",user_id);

		//변수 보내기
		sel_fd.appendChild(i[0]);
		sel_fd.appendChild(i[1]);
		sel_fd.appendChild(i[2]);
		sel_fd.appendChild(i[3]);
		sel_fd.submit();
	}
</script>
</head>
<body>
	<div id=upload_img>
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
		 echo '</ul><br/>';
	 }
	?>
	<div>
	<!--img upload용 iframe 삽입하기 -->
	<div id=data_area style="width: 95%; height: 100px;">
		 <iframe src="/upload/" width='100%' height='100%' scrolling="no" marginwidth='0' marginheight='0' frameborder='no'  id="data_frame" name="data_frame"></iframe>
		 <script>
			//iframe 높이조정
			//초기 변수값 설정
			var header1 = '170';
			//2초마다 반복실행
			setInterval(fra_height_s,2000);
			function fra_height_s(){
				var header2 = $('#data_frame').contents().find(".container").height();
				if(header1 != header2){
					//alert('unmatching');
					fra_height();
					header1 = header2;
				}else{
					//alert('matching');
				}
			}
			//iframe resize
			function fra_height(){
				//alert(container);
				//alert(ifr);
				//var container = $('body').height();
				var data_height = $('#data_frame').contents().find(".container").height();
				//alert(header);
				//var userset = $('#userset').height();
				$('#data_area').animate({height:data_height},100);
				//alert($('#contents').height());	
			}
			 //iframe 높이조정 끝
		 </script>
	 </div>
	 <div style="text-align: center; width:90%; margin: 5px; padding: 10px; border: 1px solid #cdcdcd; background-color: #efefef;">
		<b>파일 업로드를 완료 한 후, 완료 버튼을 누르세요</b><br/><br/>
		<button onClick="load_file()"  class="bt_gr bt_w150 bt_h30">완료</button>
	 </div>
</body>
</html>