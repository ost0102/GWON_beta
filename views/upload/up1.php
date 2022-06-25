<html>
<head>
<title>Image uploader</title>
<meta name="viewport" content="width=320;" /> 
<meta name="viewport" content="width=divece-width, intial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>
<?$this->load->view('/include/head_info');?>
</head>
<body>
	<div style='width:90%; text-align:center; margin-top: 20px; margin-left: auto; margin-right: auto;'>

		<?
		if($error!=''){
			echo '<script>alert("업로드에 실패했습니다. 파일 유형(gif|jpg|png|zip|hwp|doc|docx|pdf) 및 용량(95MB)을 확인해주세요.");
			location.href="/upload/up1/'.$position_val.'";
			</script>';

		}
		?>
		<h1>uploader</h1>
		파일선택 버튼을 누른 후<br/>
		등록을 원하시는 이미지를 선택하신 후 upload 버튼을 눌러주세요.<br/>
		(업로드 가능파일 형식 : gif|jpg|png|zip|hwp|doc|docx|pdf)<br/><br/>

        <form action="/upload/do_single_upload" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		<!--<? echo $upload_bg_img_state=$this->session->userdata('upload_bg_img_state'); ?><br/>
		<? echo $old_bgimg_url=$this->session->userdata('old_bgimg_url'); ?><br/>
		<? echo $position_val;?>
		-->
		<?
		//echo $w_num.'<br/>';
		//echo $item_id.'<br/>';
		if(isset($_GET['w_num'])){
			$w_num=$_GET['w_num'];
		?>
		<input type="hidden" name="w_num" value="<?php if(isset($w_num)){ echo $w_num;}?>" />
		<?
		}
		?>
		<?
		//echo $w_num.'<br/>';
		//echo $item_id.'<br/>';
		if(isset($_GET['p_num'])){
			$p_num=$_GET['p_num'];
		?>
		<input type="hidden" name="p_num" value="<?php if(isset($p_num)){ echo $p_num;}?>" />
		<?
		}
		?>
		<?
		//echo $w_num.'<br/>';
		//echo $item_id.'<br/>';
		if(isset($_GET['step'])){
			$step=$_GET['step'];
		?>
		<input type="hidden" name="step" value="<?php if(isset($step)){ echo $step;}?>" />
		<?
		}
		?>
		<?
		//echo $w_num.'<br/>';
		//echo $item_id.'<br/>';
		if(isset($_GET['bo_id'])){
			$bo_id=$_GET['bo_id'];
		?>
		<input type="hidden" name="bo_id" value="<?php if(isset($bo_id)){ echo $bo_id;}?>" />
		<?
		}
		?>	
		

		<?
		//echo $w_num.'<br/>';
		//echo $item_id.'<br/>';
		if(isset($_GET['item_id'])){
			$item_id=$_GET['item_id'];
		?>
		<input type="hidden" name="item_id" value="<?php if(isset($item_id)){ echo $item_id;}?>" />
		<?
		}
		?>	
		

		<input type="hidden" name="position_val" value="<?php if(isset($position_val)){ echo $position_val;}?>" />
		<input type="file" name="userfile"   /><!--multiple-->

		<hr style='margin-top:20px; margin-bottom: 20px;'/>
		<input type="submit" value="upload" class="btn btn-success"/>

		</form>
	</div>
</body>
</html>
