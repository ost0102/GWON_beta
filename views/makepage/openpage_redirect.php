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
	//
	</script>
</head>
<body>

<script type='text/javascript'>
	location.href = '<?echo $this->config->item('base_url');?>/<?echo $domain;?>';
	//10초후 팝업 체크하기
	//setTimeout('check_popup()',1500);
</script>


</body>
</html>