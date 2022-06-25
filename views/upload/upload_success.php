<html>
<head>
<title>Upload Form</title>
</head>
<?$this->load->view('/include/head_info');?>
<?
$p_num = $this->session->userdata('p_num'); 
$position = $this->session->userdata('position');
$class_num = $this->session->userdata('class_num');
$user_id = $this->session->userdata('ej_user');
?>
<script type="text/javascript" src="/js/jquery.js"></script>
<SCRIPT LANGUAGE="JAVASCRIPT">
	function send_info(data1,data2,data3) {
			//window.opener.document.regist.address1.value = zip1;
			var full_txt = "<a href='/uploads/"+data1+"' target='_blank'>data1</a><br/>file type :"+data2+"<br/>file path :"+data3;
			var full_txt2 = data1;
			//alert(full_txt);
			//alert(zip1);
			$(opener.document).find("#file_txt").html(full_txt);
			$(opener.document).find("#upload_file").val(full_txt2);
			
			
			//alert('업로드가 완료되었습니다.');
			//window.opener.document.regist.address2.focus();
			//parent.window.close();
		
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
</SCRIPT>
<meta name="viewport" content="width=320;" /> 
<meta name="viewport" content="width=divece-width, intial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>

<body>

<!--New code finish -->
<h1>New code</h1>
<a href= "<?php echo base_url().'uploads/' .$upload_data['file_name'] ?>" ><img style="float:left; padding: 20px;" width="80" src="<?php echo base_url().'uploads/' .$upload_data['file_name']/*or set to thumbnail image*/ ?>"/></a><?php echo '<br/>name: ' .$upload_data['file_name'] .'<br/>size: ' .$upload_data['file_size'] .' k' ?> <!-- <br/><a href="upload/delete <?php echo $upload_data['file_name']?>"  >DELETE</a>-->
<!--New code finish -->
<!--backup
<hr/>
<h1>old code</h1>
<h3>Your file was successfully uploaded!</h3>

<ul>
<?php foreach($upload_data as $item => $value):?>
<li><?php echo $item;?>: <?php echo $value;?></li>
<?
	if($item == 'file_name'){$file_name = $value;}
	if($item == 'file_type'){$file_type = $value;}
	if($item == 'file_path'){$file_path = $value;}
?>
<?php endforeach; ?>
</ul>
-->
<div style="width:100%; float: left;">
<hr/>
<p><b><?php echo anchor('/upload/up1', 'Upload Another File!'); ?></b></p>

<?
	//주소 한줄로 만들기
	//$data = "<a href='/uploads/".$file_name."' target='_blank'>".$file_name."</a><br/>file type : ".$file_type."<br/>file path :".$file_path;
	//$data = $file_name;
?>
<button onClick="load_file()"  class="bt_gr bt_w150 bt_h30">완료</button>
<!--<a href="javascript:send_info( '<?= $file_name ?>','<?= $file_type ?>','<?= $file_path ?>');">
Close</a>
<SCRIPT LANGUAGE="JAVASCRIPT">
	send_info( '<?= $file_name ?>','<?= $file_type ?>','<?= $file_path ?>');
</SCRIPT>
-->
</div>
</body>
</html>
