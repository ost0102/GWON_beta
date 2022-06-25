<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>프린트 테스트</title>
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


	    });

	</script>
</head>
<body>
<?
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('My Title');
$pdf->SetHeaderMargin(30);
$pdf->SetTopMargin(20);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true);
$pdf->SetAuthor('Author');
$pdf->SetDisplayMode('real', 'default');

$pdf->AddPage();

$pdf->Write(5, 'Some sample text');
$pdf->Output('My-File-Name.pdf', 'I');
?>
</body>
</html>