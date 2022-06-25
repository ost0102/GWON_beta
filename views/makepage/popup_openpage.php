<style type="text/css">
    #openpage_popup {
		position:absolute;
		/*float: left;*/
		left:0px;
		top: 0px; 
		z-index: 19;
		width: 100%;
		background: #34495e;
		padding-top: 20px;
		padding-bottom: 20px;
		text-align: center;
		color: #fff;
		display: none;
    }
    #openpage_popup img{
    	max-width: 300px;
    }
</style>
<script type="text/javascript">
function popup_close(){
	$('#openpage_popup').slideUp();
}	

$(document).ready(function() {
	//팝업 영역에도 적용
	$('#openpage_popup a').each(function() {
		if(!$(this).attr("onclick")){
		    var addr = $(this).attr("href");
			$(this).attr("onclick","check_linked('"+addr+"')");
		}
	});
});
</script>
<div id='openpage_popup'>
	<?
	//popup콘텐츠가 존재한다면, 출력해라.
	if(isset($pop_con)){
		echo $pop_con;
	}?><br/>
	<a onclick="popup_close();"><img src="/img/land/bt_close.png" style='width: 60px; margin-top: 20px;'></a>
</div>