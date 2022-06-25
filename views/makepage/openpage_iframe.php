
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
	<?
	$this->load->view('/include/inc_openpage_head');
	?>
	<style>
		html,body {
			height:100%;
			overflow: hidden;
		}
	</style>
	<script type="text/javascript"> 
	//<![CDATA[
	function calcHeight(){
		 var win_h = $(window).height();
		 $('#the_iframe').height(win_h);
		 //alert(win_h);

		 //document.getElementById('the_iframe').scrolling = "no";
		 $('#the_iframe').css('overflow','hidden');
	}
	$(window).resize(function(){ 
		calcHeight();
	});
	//
	</script>
</head>
<body>
<iframe src="<?echo $this->config->item('base_url');?>/<?echo $domain;?>?now_call=other_domain" id="the_iframe" onload="calcHeight();"  frameborder="0" scrolling="auto" style="overflow-x:hidden; overflow:auto; width:100%; height:100%;"></iframe>


<script type='text/javascript'>

	//10초후 팝업 체크하기
	//setTimeout('check_popup()',1500);
</script>


</body>
</html>