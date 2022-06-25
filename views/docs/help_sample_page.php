<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta content="width=device-width,minimum-scale=1,maximum-scale=1" name="viewport">
    <title>기능 샘플 보기 :: intropage.net</title>
    <script type="text/javascript" src="/js/html5.js"></script>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/selectivizr.js"></script>
    <!--favicon-->
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon" />
    <link rel="icon" href="/img/favicon.ico" type="image/x-icon" />

    <link href='/css/bootstrap.min.css' rel='stylesheet' />

    <?
      if($now_page == "help_sample1"){
        $css_d = "/css/help/help_sample.css";
        $css_m = "/css/help/help_sample_m.css";
      }else if($now_page == "help_sample2"){
        $css_d = "/css/help/help_sample1.css";
        $css_m = "/css/help/help_sample1_m.css";
      } 
    ?>
<!--[if (gte IE 6)&(lte IE 8)]>
<script type="text/javascript" src="/js/selectivizr.js"></script>
<![endif]-->
<!--user code file-->
<!--[if lte IE 8]>
<link href="<?echo $css_d;?>" type="text/css" rel="stylesheet"/>
<![endif]-->
<link id= "css_basic" href="<?echo $css_d;?>" type="text/css" rel="stylesheet" media="screen and (min-width:600px)"/>
<link id= "css_basic_m"  href="<?echo $css_m;?>" type="text/css" rel="stylesheet" media="(max-width:599px)"/>

<!--modal창 관련 -->
<script type="text/javascript" src="/js/jquery.simplemodal.js"></script>
<script type="text/javascript">
    //jQuery 있는 상태
    window.onload=function(){
    };
    $(window).resize(function(){ 
      
       var top_h = $("#top_area").height()-10;
       $("#con_area").css("margin-top",top_h);
    });
    //스크롤 변화에 따라 상단위치 고정하기
    $(window).scroll(function(){ 
        var scr_now = $(document).scrollTop();
        //menu_left 존재유무에 따라 html type1, 2 인식 > type2일경우 실행동작과 type1일경우 실행동작을 구분하자.
        var check_menu_left = $("div").hasClass("menu_left");
        //현재 스크롤
        //alert(scr_now);

        if(scr_now >150){
            $('#top_con').hide();
            $('#menu_area').hide();
            $('#top_area').css('padding-top','0px');
            $('#top_area').css('padding-bottom','0px');
            $('#top_bt_line').hide();
            $('#top_sub_menu').show();

            //$('#top_logo').css('display','hidden');
            //s_div.style.visibility = "hidden";
        }else{
            $('#top_con').show();
            $('#top_area').css('padding-top','10px');
            $('#top_area').css('padding-bottom','10px');
            $('#menu_area').show();
            $('#top_bt_line').show();
            $('#top_sub_menu').hide();
        }
        
    });
    $(document).ready(function() {
       $('#top_sub_menu').hide();
       var top_h = $("#top_area").height()-10;
       $("#con_area").css("margin-top",top_h);

        //버튼 기능
        $('#design1').click(function(){
          alert('콘텐츠 개선은 내부 콘텐츠 영역의 디자인을 가독성 높게 디자인하여 드립니다.');
          $('#desing1_area').slideDown();
          $('#desing2_area').slideUp();
          $('#desing3_area').slideUp();
          scr_bt('bt1');
          $("#con_area").css("margin-top",top_h);
          //location.replace('/makepage/outline/');
        });

        $('#design2').click(function(){
          $('#desing1_area').slideUp();
          $('#desing2_area').slideDown();
          $('#desing3_area').slideUp();
          //alert('템플릿 디자인이 개선됩니다.');
          var css_url = $("#css_basic").attr("href");
          if(css_url==="/css/help_sample1.css"){
            $("#css_basic").attr("href","/css/help_sample.css");
            $("#css_basic_m").attr("href","/css/help_sample_m.css");
          }else{
            $("#container").hide();
            alert('템플릿 최적화는 선택한 템플릿을 기반으로 디자인을 최적화합니다.');
            $("#css_basic").attr("href","/css/help_sample1.css");
            $("#css_basic_m").attr("href","/css/help_sample1_m.css");
            $("#container").fadeIn("slow");
          }
          scr_bt();
          $("#con_area").css("margin-top",top_h);
          //location.replace('/makepage/outline/');
        });

        $('#design3').click(function(){
          $('#desing1_area').slideUp();
          $('#desing2_area').slideUp();
          $('#desing3_area').slideDown();
          var css_url = $("#css_basic").attr("href");
          if(css_url==="/css/help_sample2.css"){
            $("#css_basic").attr("href","/css/help_sample.css");
            $("#css_basic_m").attr("href","/css/help_sample_m.css");
          }else{
            //alert('신규 템플릿 제작을 요청할 경우, 클라이언트에 맞춰 템플릿을 새로 제작합니다.');
            $("#container").hide();
            $("#css_basic").attr("href","/css/help_sample2.css");
            $("#css_basic_m").attr("href","/css/help_sample2_m.css");
            $("#container").fadeIn("slow");
           // alert('신규 템플릿 제작을 요청할 경우, 클라이언트에 맞춰 템플릿을 새로 제작합니다.');
          }
          scr_bt();
          $("#con_area").css("margin-top",0);


          //location.replace('/makepage/outline/');
        });

        $('#code1').click(function(){
           alert('인터렉션은 내부 콘텐츠 영역의 콘텐츠에 동적인 움직임을 주어, 콘텐츠에 대한 집중력을 높여줍니다.');
          $('#code_img').hide();
          $('#code_ul').hide();
          $('#code1_area').show();
          $('#code2_area').slideUp();
          $('#code3_area').slideUp();

          $('#code_img').slideDown("slow").delay( 1000 ).fadeIn();
          $('#code_ul').slideDown().delay( 3000 );
          scr_bt('bt2');
          
          //location.replace('/makepage/outline/');
        });
        $('#code2').click(function(){
           alert('외부 모듈 연동은 유투브, 플리커 등 외부 채널의 연결이 필요할 때 요청할 수 있는 메뉴입니다.');
          $('#code1_area').slideUp();
          $('#code2_area').slideDown();
          $('#code3_area').slideUp();
          //location.replace('/makepage/outline/');
          
        });
        $('#code3').click(function(){
          $('#code1_area').slideUp();
          $('#code2_area').slideUp();
          $('#code3_area').slideDown();
          //location.replace('/makepage/outline/');
        });


    });
    //메뉴 구성
    function scr_bt(val){
        //상단부터 div까지의 높이값 구하기
        var num_w = 10;
        var div1 = $('#con_con1').offset().top-30;
        var div2 = $('#con_con2').offset().top+num_w;
        var div3 = $('#con_con3').offset().top+num_w;
        var div4 = $('#con_con4').offset().top+num_w;
        //alert(div2);

        if(val == 'bt1'){
            $('html, body').animate( {scrollTop:div1} );
        }else if(val == 'bt2'){
            $('html, body').animate( {scrollTop:div2} );
        }else if(val == 'bt3'){
            $('html, body').animate( {scrollTop:div3} );
        }else if(val == 'bt4'){
            $('html, body').animate( {scrollTop:div4} );
        }else{
            $('html, body').animate( {scrollTop:0} );
        }
    }
    function check_top(){

    }

</script>
<!--웹 폰트 로드할 동안 텍스트 표시 안되는 현상 방지 시작-->
<script type="text/javascript" src="/js/webfont.js"></script>
<script>
 WebFont.load({
  custom: {
   families: ['Nanum Gothic'],
   urls: ['/css/font.css']
  }
 });
  WebFont.load({
  custom: {
   families: ['Nanum Myeongjo'],
   urls: ['/css/font.css']
  }
 });
</script>
<!--웹 폰트 로드할 동안 텍스트 표시 안되는 현상 방지 끝-->
<!--google분석기 시작-->
    <script type="text/javascript" >
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-45987664-1', 'intropage.net');
      ga('send', 'pageview');

    </script>
<!-- google분석기 끝-->
</head>
<body>
<div id='right_top_shape'>
    <a href="http://<?=$config['intro_url'];?>/"><img src="/img/right_top_shape_1.png" class='logo_shape'></a>
</div>
<div id='bg_area' title=''>
</div>
<div id='container'>
    <!-- top Area Start -->
    <div id='top_area'>
        <div id='top_con'>
            <a href="#" target="_self"><img src="/img/top_logo.png" style="width: 200px;"></a>
            <h1>기능 샘플 페이지</h1>
            인트로페이지에서 제공 가능한 기능에 대한 샘플 페이지입니다.
        </div>
        <div id='menu_area'>
            <div id='menu_txt'>
                    <!--menu area-->
                    <a onclick="scr_bt('bt1');">디자인 개선</a>&nbsp;|&nbsp;
                    <a onclick="scr_bt('bt2');">기능 개선</a>&nbsp;|&nbsp;
                    <a onclick="scr_bt('bt3');">콘텐츠 개선</a>&nbsp;|&nbsp;
                    <a onclick="scr_bt('bt4');">온라인 생중계</a>
            </div>
        </div>
        <div id="top_bt_line">
        </div>
        <div id="top_sub_menu">
            <span id="bt_pf">
                <a onclick="scr_bt('bt1');">디자인 개선</a>&nbsp;|&nbsp;
                <a onclick="scr_bt('bt2');">기능 개선</a>&nbsp;|&nbsp;
                <a onclick="scr_bt('bt3');">콘텐츠 개선</a>&nbsp;|&nbsp;
                <a onclick="scr_bt('bt4');">온라인 생중계</a>
            </span>
        </div>
    </div>
    
    <!-- top Area finish -->
    <!-- Contents Area Start -->
    <div id='con_area'>
        <!--디자인 개선 -->
        <div id='con_con1' class='con_area_div'>
            <h3 id='con1_title' class='con_titles'>디자인 개선</h3>
            <div id='con1_txt'>
                안녕하세요. 인트로 페이지입니다.
                이 영역에서는 디자인 개선의 지원 항목에 대한 형태를 확인하실 수 있도록 구성하였습니다.<br/>
                디자인 개선 요청을 하시면, 콘텐츠 개선과 템플릿 최적화, 신규 템플릿 제작 중 선택적으로 요청하실 수 있습니다.<br/>
                아래의 버튼을 클릭하면, 각 기능 지원의 범위를 확인 하실 수 있습니다.<br/>
            </div>
             <div id="desing1_area" class="detail_area_style">
                <b>* 콘텐츠 개선은 내부 콘텐츠 영역의 디자인을 가독성 높게 디자인하여 드립니다.</b><br/>
                <img src='/img/guide/guide_img2.jpg'/><br/>
                안녕하세요. 인트로 페이지입니다.<br/>
                이 영역에서는 디자인 개선의 지원 항목에 대한 형태를 확인하실 수 있도록 구성하였습니다.<br/>
                디자인 개선은 다음과 같이 구성되어 있습니다.<br/>
                <ul style="margin-left: 10px;">
                    <li> 콘텐츠 개선</li>
                    <li> 템플릿 최적화</li>
                    <li> 신규 템플릿 제작</li>
                </ul>
            </div>
            <div id="desing2_area" class="detail_area_style">
                <b>* 템플릿 최적화는 선택한 템플릿을 기반으로 디자인을 최적화합니다.</b><br/>
                <img src='/img/guide/guide_img2.jpg'/>
            </div>
            <div id="desing3_area" class="detail_area_style">
                <b>* 신규 템플릿 제작을 요청할 경우, 클라이언트에 맞춰 템플릿을 새로 제작합니다.</b><br/>
                <img src='/img/guide/guide_img1.jpg'/><br/>
            </div>
            <div class="bt_area">
                <button id="design1" class="btn btn-primary" alt="콘텐츠 개선">콘텐츠 개선</button>
                <button id="design2" class="btn btn-primary" alt="콘텐츠 개선">템플릿 최적화</button>
                <button id="design3" class="btn btn-primary" alt="콘텐츠 개선">신규 템플릿 제작</button>
            </div>
        </div>
        <!-- 디자인 개선 끝 -->
        <!--기능 개선 -->
        <div id='con_con2' class='con_area_div'>
            <h3 id='con2_title' class='con_titles'>기능 개선</h3>
            <div id='con2_txt'>
                콘텐츠에 동적인 움직임을 줌으로써, 페이지 방문자로 하여금 콘텐츠 집중력을 높이거나,
                외부 채널을 사이트에 연동해 주는 것에 도움이 필요할 때 기능 개선 요청 메뉴를 통해 요청하실 수 있습니다.
            </div>
            <div id="code1_area" class="detail_area_style">
                <b>* 인터렉션은 내부 콘텐츠 영역의 콘텐츠에 동적인 움직임을 주어, 콘텐츠에 대한 집중력을 높여줍니다.</b><br/>
                <img id="code_img" src='/img/guide/guide_img1.jpg'/><br/>
                <div id="code_txt">
                    이 영역에서는 디자인 개선의 지원 항목에 대한 형태를 확인하실 수 있도록 구성하였습니다.<br/>
                    디자인 개선은 다음과 같이 구성되어 있습니다.<br/>
                </div>
                <ul id="code_ul"style="margin-left: 10px;">
                    <li> 콘텐츠 개선</li>
                    <li> 템플릿 최적화</li>
                    <li> 신규 템플릿 제작</li>
                </ul>
            </div>
            <div id="code2_area" class="detail_area_style">
                <b>* 외부 모듈 연동은 유투브, 플리커 등 외부 채널의 연결이 필요할 때 요청할 수 있는 메뉴입니다.</b><br/>
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/fPEOXusCGTw" frameborder="0" allowfullscreen></iframe>
            </div>
            <div id="code3_area" class="detail_area_style">
                <b>* 고급 기능 연동에서는 사용자가 필요로 하는 특수한 기능에 대한 개발 업무가 필요할 때 문의하실 수 있습니다.</b><br/>
            </div>
            <div class="bt_area">
                <button id="code1" class="btn btn-primary" alt="콘텐츠 개선">인터렉션</button>
                <button id="code2" class="btn btn-primary" alt="콘텐츠 개선">외부 모듈 연동</button>
                <button id="code3" class="btn btn-primary" alt="콘텐츠 개선">고급 기능 연동</button>
            </div>
        </div>
        <!-- 기능 개선 끝 -->
        <!--콘텐츠 개선 -->
        <div id='con_con3' class='con_area_div'>
            <h3 id='con3_title' class='con_titles'>콘텐츠 개선</h3>
            <div id='con3_txt'>
                인트로 페이지 콘텐츠 구성에 있어 보다 효율적인 스토리 텔링이 필요하신가요?<br/>
                웹페이지 구성에 생소하신 분들은 콘텐츠 개선을 요청하실 수 있습니다.
            </div>
        </div>
        <!-- 콘텐츠 개선 끝 -->
        <!--온라인 생중계 -->
        <div id='con_con4' class='con_area_div'>
            <h3 id='con4_title' class='con_titles'>온라인 생중계</h3>
            <div id='con4_txt'>
                오프라인에서의 행사, 컨퍼런스 등에 인트로 페이지를 활용하고 싶으신가요?<br/>
                온라인 생중계를 통해 기술 및 서비스 지원을 요청하실 수 있습니다.
            </div>
            <div class="bt_area">
                <a href = "/kova" target="_blank"><button id="live1" class="btn btn-primary" alt="콘텐츠 개선">샘플 사이트 보기</button></a>
            </div>
        </div>
        <!-- 디온라인 생중계 끝 -->
    </div>
    <!-- Bottom-->
    <div id='bottom'>
        <div id='bt_txt'>
            <a href="http://<?=$config['intro_url'];?>/">intropage.net</a> © &nbsp;2014<br/>
        </div>
    </div>
    <!-- Bottom 끝 -->
    <!-- Other Contents Area finish -->
</div>
</body>
</html>