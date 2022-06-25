<meta name="naver-site-verification" content="6eabb8f7698737cc7b0ce995ea5ee2ab58710ad1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<meta content='width=device-width,minimum-scale=1,maximum-scale=1' name='viewport' />
<title>모든 지원은 Gwon에서! </title>
<meta name="description" content="지원사업, 공모사업의 신청 접수부터 평가까지, 업무에 스마트함을 더하세요!" />
<meta name="keywords" content="지원, 지원사업, Gwon" />
<meta property="og:url" content="<? echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ?>" />
<meta property="og:title" content="Gwon" />
<meta property="og:description" content="지원사업, 공모사업의 신청 접수부터 평가까지, 업무에 스마트함을 더하세요!" />
<meta property="og:image" content="http://gwon.net/img/top_logo.jpg" />

<?
if(!isset($_SERVER["HTTPS"])) { 
  header('Location: https://'.$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']);
}
?>


<script type='text/javascript' src='/js/html5.js'></script>
<script type='text/javascript' src='/js/jquery.js'></script>

<script type='text/javascript' src='/js/selectivizr.js'></script>
<!-- script 모음 ! -->
<script type='text/javascript' src='/js/view_common.js'></script>
<script type='text/javascript' src='/js/gwon_js.js'></script>

<!-- dataPicker 모음 ! -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<script src="//code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script type='text/javascript' src='/assets/js/jquery.ui.sortable.js'></script>


<!-- design 관련 ! -->
<link rel="stylesheet" href="/css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/css/font.css" type="text/css"/>
<link rel="stylesheet" href="/assets/css/site.min.css" type="text/css" media="screen" />

<!--awesome-bootstrap/체크박스, 셀렉트박스관련 ! -->
<link rel="stylesheet" href="/css/awesome-bootstrap/bootstrap.css"/>
<link rel="stylesheet" href="/css/awesome-bootstrap/font-awesome.css"/>
<link rel="stylesheet" href="/css/awesome-bootstrap/build.css"/>


<!-- For progressively larger displays 미디어 쿼리-->
<link href='/css/screen_gwon.css<?echo '?ver='.date("Ymd_H_i_s");?>' type='text/css' rel='stylesheet' media='screen and (min-width:600px)'/>
<link href='/css/screen_gwon_m.css<?echo '?ver='.date("Ymd_H_i_s");?>' type='text/css' rel='stylesheet' media='screen and (max-width:599px)'/>

<!--favicon-->
<link rel='shortcut icon' href='/img/favicon.ico' type='image/x-icon' />
<link rel='icon' href='/img/favicon.ico' type='image/x-icon' />

<?$now_url = $_SERVER['REQUEST_URI'];
 $newdata = array(
    'now_url'  => $now_url);
$this->session->set_userdata($newdata);
//echo $this->session->userdata('now_url');
?>

<!--봇 접근 차단페이지 삽입코드 시작-->
<?
//차단페이지 리스트 확인 : http://easymenu.kr/robots.txt
//Disallow: /admin, /mypage, /makepage/add_template, /makepage/outline, /makepage/con_detail, /makepage/select_design, /makepage/add_other
if(strpos($now_url,'admin') !== false || strpos($now_url,'mypage') !== false || strpos($now_url,'makepage/add_template') !== false 
  || strpos($now_url,'makepage/outline') !== false || strpos($now_url,'makepage/con_detail') !== false || strpos($now_url,'makepage/select_design') !== false 
  || strpos($now_url,'new/event/event_info_edit') !== false){
?>
<meta name="robots" content="noindex" />
<?
}
?>
<!--봇 접근 차단페이지 삽입코드 끝 -->

<!--google분석기 시작-->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-45987664-6"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-45987664-6');
</script>

<!-- google분석기 끝-->
<!--카카오톡 공유하기 기능 시작-->
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<SCRIPT TYPE='text/javascript'>
      Kakao.init('40cbf03d23540c79e45e971799b7ef04');
</SCRIPT>
<!--카카오톡 공유하기 기능 끝-->


<script type='text/javascript'>
$(document).ready(function() {
  //modal 관련
   $('#m_close').click(function(){
    $.modal.close();
    modal_state ='off';
   });
   modal_state ='off';

   //너비 조정
   var now_h = $(document).height()-300;
   $('#container').css('min-height',now_h);
});
$(window).resize(function(){ 
   var now_h = $(document).height()-300;
   $('#container').css('min-height',now_h);
  });

//스크롤에 따라 왼쪽 메뉴 영역 크기 변경하기
$(window).scroll(function() {
    var scr_now = $(window).scrollLeft();
    var win_h = $(window).height();
    var doc_h = $(document).height();
    var left_menu_h = $('#left_menu_txt').height();
    var win_w = $(window).width();
    //스크롤 변화에 따라 상단위치 고정하기
    var scr_now = $(document).scrollTop();
    
    //가로모드인지 체크
    if(win_w<=799){
       //모바일
       if(scr_now>80){
        //스크롤이 내려가고 있으니 상단 메뉴 영역 작게 만들기
        //alert(scr_now);
        $('#top_logo_img').css('max-height','30px');
        $("#top_main_menu").css('margin-top','5px');
        $("#top_main_menu").css('margin-bottom','5px');
        $("#workspace_top_noti").hide();
      }else{
        //원상복귀
        $('#top_logo_img').css('max-height','55px');
        $("#top_main_menu").css('margin-top','10px');
        $("#top_main_menu").css('margin-bottom','10px');
        $("#workspace_top_noti").show();
        //$("#top_logo").show();
      }
    }else{
      //세로모드
      if(scr_now>80){
        //스크롤이 내려가고 있으니 상단 메뉴 영역 작게 만들기
        //alert(scr_now);
        $('#top_logo_img').css('max-height','45px');
        $('#top_logo').css('padding-bottom','0px');
        $('#top_main_menu').css('margin-top','0px');
        $('#top_main_menu').css('margin-bottom','0px');
        $("#workspace_top_noti").hide();
      }else{
        //원상복귀
        $('#top_logo_img').css('max-height','55px');
        $('#top_logo').css('padding-bottom','10px');
        $('#top_main_menu').css('margin-top','10px');
        $('#top_main_menu').css('margin-bottom','10px');
        $("#workspace_top_noti").show();
      }
      
    }
});
</script>
