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
		
	    setInterval(function() {
		   calcHeight();
		}, 1000);
	});
	function calcHeight(){
		 //find the height of the internal page
		 if(document.getElementById('eval_fome_iframe').contentWindow.document.body.scrollHeight){
		 	var the_height = document.getElementById('eval_fome_iframe').contentWindow.document.body.scrollHeight;

			 //change the height of the iframe
			 document.getElementById('eval_fome_iframe').height=the_height;

			 //document.getElementById('the_iframe').scrolling = "no";
			 document.getElementById('eval_fome_iframe').style.overflow = "hidden";
		 }
	}
		
</script>
<?
if(isset($step)){
?>
<div id="eval_con_area">
	<h3><?if(isset($step_title)) echo $step_title;?> : <?if(isset($field_type_txt)) echo $field_type_txt;?></h3>
	<?include_once $this->config->item('basic_url')."/include/inc_eval_menu.php";?>
	<?
	//include_once $this->config->item('basic_url')."/include/inc_responses_table.php";?>
	<div class='dash_con'>
		<iframe id="eval_fome_iframe" onload="calcHeight();" src="/evaluate/set_eval_form_iframe/?w_num=<?echo $w_num;?>&step=<?echo $step;?>" frameborder="0" scrolling="no" style="overflow-x:hidden; overflow:auto; width:100%; min-height: 400px;"></iframe>
          </div>	
</div>
<?
}else{
	echo '단계 설정 정보가 없습니다.<br/>';
}?>