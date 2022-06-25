<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?$this->load->view('/include/head_info');?>

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

            //응원 메시지 작성하기
            $('#sworker_regist_start').click(function(){
                //alert('test');
                var visit_name = $('#visit_name').val();
                var visit_email = $('#visit_email').val();
                var visit_msg = $('#visit_msg').val();


                //alert(title+'-'+description+'-'+first_ez+'-'+co_authors);
                /**/
                if(sworker_file==''){
                    alert('사회복지사 증빙 문서를 업로드 해주세요.');
                }else if(sworker_phone==''){
                    alert('연락처 정보를 입력해주세요.');
                    $('#sworker_phone').focus();
                }else if(cate_info==''){
                    alert('활동 영역을 선택해주세요.');
                }else{
                    $.post('/new/main/input_visit_msg/',{
                             workplace: workplace,
                             sworker_file: sworker_file,
                             sworker_phone: sworker_phone,
                             sworker_descript: sworker_descript,
                             cate_info: cate_info,
                             interest_area: interest_area
                    },
                    function(data){
                         location.reload();
                            
                        
                    });
                }
                
            });

        });

        function contact_us_main(){
            var visit_name = $('#visit_name').val();
            var visit_email = $('#visit_email').val();
            var visit_phone = $('#visit_phone').val();
            var visit_msg = $('#visit_msg').val();

             $.post('/main/input_visit_msg/',{
                         visit_name: visit_name,
                         visit_email: visit_email,
                         visit_phone: visit_phone,
                         visit_msg: visit_msg
                },
                function(data){
                    if(data==1){
                        alert('문의글이 등록되었습니다. 확인 후 연락드리겠습니다. 감사합니다.');
                        location.reload();
                    }else{

                        alert('빠진 항목이 없는지 확인해주세요.');
                    }
                        
                    
                });
        }
        function show_contact_us(){
            var now_form = $('#mail_msg_form').css('display');
            if(now_form=="none"){
                $('#mail_msg_form').fadeIn();
                $('#bt_contact_us').hide();
            }else{
                $('#mail_msg_form').fadeOut();
                $('#bt_contact_us').hide();
            }
        }



    </script>
</head>
<body>
<!-- 상단 영역 공통 시작-->
<div id='top_area'>
    <div id='top_noti'>
        <div id='top_noti_con'>
            <div id='top_noti_con_txt'>
                <!-- noti_txt -->
                <?include_once $this->config->item('basic_url')."/include/inc_top_noti_txt.php";?>
            </div>
            <div id='top_menu_area'>
                <!-- sub_top area include -->
                <?include_once $this->config->item('basic_url')."/include/inc_top_menu_login.php";?>
            </div>
        </div>
    </div>
    <div id='top_con'>
        <?include_once $this->config->item('basic_url')."/include/inc_top_menu.php";?>
    </div>
</div>
<!-- 상단 영역 공통 끝 -->
<div id='container_main'>
    <div id='con'>
        <!-- 상단 메인 배너 -->
        <div id='main_slider'>
            <div id='main_slider_con'>
                <div id='slider_con_1'>
                    <h1 class='g_point_bold' style="line-height: 35px; margin-bottom: 30px;">
                        지원은 빠르게, 접수관리는 자동화로<br/>
                        지원사업 업무의 혁신을 경험하세요.
                    </h1>
                    Gwon은 공고사업별 전용 홈페이지를 제공합니다.<br/>
                    이메일로, 우편으로 서류를 접수 받으면서 불편한 점을 한방에 해결해드립니다.<br/>
                    참가자 모집, 접수, 심사부터 홍보까지 기존과는 다른 편리함을 제공합니다.
                    <br/><br/>
                     <a href="https://gwon.net/pilot" target="_blank">
                        <button type="button"  class="btn btn-info ">
                            사전체험 신청하기
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <!-- 상단 메인 배너 끝 -->
        <div class='main_con_area bg_color_white'>
            <div class='main_con_detail'>
                <h1 class='g_point_bold align_center' style="line-height: 35px; margin-bottom: 30px;">
                    공고사업 업무는 다양한 불편한 점에 존재했습니다.
                </h1>
                <div id='main_1_con_area'>
                    <div class='main_1_con'>
                        <img src="/img/main/main1_img1.jpg"/>
                        <h3 class='g_point_bold align_center'>이메일 접수의 불편함</h3>
                        이메일로 접수받으니까 접수확인이 어려워요.<br/>
                        접수완료 답신도 메일이나 문자로 일일이 보내줘야<br/>
                        안심이 되자나요?<br/>
                        서류도 일일이 다운 받아야 하고<br/>
                        엑셀로 목록화 해야 하는데<br/>
                        이메일 접수는 일도 많고 많이 불편하죠.
                    </div>
                    <div class='main_1_con'>
                        <img src="/img/main/main1_img2.jpg"/>
                        <h3 class='g_point_bold align_center'>게시판 홍보의 한계</h3>
                        전용홈페이지를 만들어서 홍보하고<br/>
                        모집하는 곳을 보면 부러워요.<br/>
                        저희는 예산이 부족해서 홈페이지를 만들지 못했는데<br/>
                        공고사업 전용 홈페이지가 있다면<br/>
                        공고사업의 홍보효과를<br/>
                        높일 수 있을 것 같아요.
                    </div>
                    <div class='main_1_con'>
                        <img src="/img/main/main1_img3.jpg"/>
                        <h3 class='g_point_bold align_center'>몇 명이 지원할지 알 수 없음</h3>
                        모집기간 동안 몇명이 모집이 될 지 알 수 없어서<br/>
                        초조하고 불안해요<br/>
                        모집이 안되다가 마지막날 몰리면<br/>
                        그날은 야근 당첨인데, 그렇게라도 많이 들어오면 좋죠.<br/>
                        관심가지고 있는 사람이 몇명인지만 알 수 있어도<br/>
                        모집인원을 가늠해 볼 수 있으면 좋을 것 같아요.
                    </div>
                </div>
            </div>
        </div>

        <div class='main_con_area bg_color_white'>
            <div class='main_con_detail'>
                <h1 class='g_point_bold align_center' style="line-height: 35px; margin-bottom: 30px;">
                    Gwon은 공고사업 효율화를 위해 탄생했습니다.
                </h1>
                <div class='align_center'>
                업무자동화로 업무 처리는 빨라지고, 온라인 전용 홈페이지로 홍보/심사는 쉬워지고,<br/>
                방문자 분석으로 지원자는 많아지는 공고사업 통합관리 솔루션입니다.
                </div>
                <div id='main_2_menu'>
                    <div id='main_2_menu1' onclick="main_con_slider(1);" class='main_2_menu_icon main_2_menu_on'>
                        전용 홈페이지 <img src="/img/main/main_bt_icon1.jpg"/>
                    </div>
                    <div id='main_2_menu2' onclick="main_con_slider(2);" class='main_2_menu_icon main_2_menu_off'>
                        All-in-One <img src="/img/main/main_bt_icon2.jpg"/>
                    </div>
                    <div id='main_2_menu3' onclick="main_con_slider(3);" class='main_2_menu_icon main_2_menu_off'>
                        인사이트 <img src="/img/main/main_bt_icon3.jpg"/>
                    </div>
                </div>
                <script>
                    function main_con_slider(con_num){
                        if(con_num==1){
                            $(".main_2_menu_icon").removeClass("main_2_menu_off");
                            $(".main_2_menu_icon").removeClass("main_2_menu_on");
                            $("#main_2_menu1").addClass("main_2_menu_on");
                            $("#main_2_con_img").attr("src","/img/main/main2_img1.jpg");
                        }else if(con_num==2){
                            $(".main_2_menu_icon").removeClass("main_2_menu_off");
                            $(".main_2_menu_icon").removeClass("main_2_menu_on");
                            $("#main_2_menu2").addClass("main_2_menu_on");
                            $("#main_2_con_img").attr("src","/img/main/main2_img2.jpg");
                            
                        }else if(con_num==3){
                            $(".main_2_menu_icon").removeClass("main_2_menu_off");
                            $(".main_2_menu_icon").removeClass("main_2_menu_on");
                            $("#main_2_menu3").addClass("main_2_menu_on");
                            $("#main_2_con_img").attr("src","/img/main/main2_img3.jpg");
                        }

                    }
                </script>
                <div id='main_2_con'>
                        <img src="/img/main/main2_img1.jpg" id="main_2_con_img"/>
                </div>
            </div>
        </div>

        <div class='main_con_area bg_color_mint'>
            <div class='main_con_detail'>
                <div id="main_3_left">
                    <h1>
                        <b>Gwon</b>을 이용하면<br/>
                        업무 시간을 효율적으로<br/>
                        줄일 수 있습니다.
                    </h1>
                    <img src="/img/main/main3_bt.jpg" id="main_2_con_img"/>
                </div>
                
                <div id="main_3_right">
                    <img src="/img/main/main3_img.jpg" id="main_2_con_img"/>
                </div>
    
            </div>
        </div>

        <div class='main_con_area bg_color_gray'>
            <div class='main_con_detail'>
                <h1 class='g_point_bold align_center' style="line-height: 35px; margin-bottom: 30px;">
                    Gwon 이용사례
                </h1>
                <div class='align_center'>
                앞서가는 기관들이 Gwon의 시범운영에 참여하고 있습니다.
                </div>
                <img src="/img/main/main_banners.jpg">
            </div>
        </div>

        <div class='main_con_area bg_color_mint_highlight'>
            <div class='main_con_detail align_center'>
                <h1 class='g_point_bold align_center' style="color: #fff; line-height: 35px; margin-bottom: 30px;">
                    부담없이 체험하고 결정하세요
                </h1>
                <div class='align_center' style="color: #fff; margin-bottom: 50px;">
                선정된 사전체험 기관은 모든 서비스를 무료로 제공합니다. 
                </div>
                <a href="https://gwon.net/pilot" target="_blank">
                    <img src="/img/main/bt_apply.gif" style="width: 300px;"/>
                </a>
            </div>
        </div>
        <div class='main_con_area bg_color_white'>
            <div id='con_main'>
                <!-- 왼쪽 콘텐츠 영역 시작 -->
                <!-- 오른쪽 콘텐츠 영역 시작 -->
                <div id='main_con_left'>
                    <!--이용 문의 영역-->
                    <div class='main_con_left_w con_outline'>
                       <h3 class='main_con_title' style='margin-bottom: 0px;'>
                            이용 문의
                        </h3>
                        <div style="width: 100%; line-height: 13px;" class='t_basic'>
                            Gwon 서비스는 현재 알파버전으로 운영중에 있습니다.<br/>
                            스마트한 지원사업 관리를 원하시는 기관의<br/>
                            문의를 환영합니다.
                        </div><br/>
                        <div id='mail_msg_form' class='main_mail_list' >
                            <div class='main_mail_con'>
                                <b>이름</b><br/>
                                <input id='visit_name' type="text" class="form-control" placeholder="Name">
                            </div>
                            <div class='main_mail_con'>
                                <b>이메일</b><br/>
                                <input id='visit_email' type="text" class="form-control" placeholder="E-mail">
                            </div>
                            <div class='main_mail_con'>
                                <b>연락처</b><br/>
                                <input id='visit_phone' type="text" class="form-control" placeholder="Phone number">
                            </div>
                            <div class='main_mail_con'>
                                <b>문의 내용</b><br/>
                                <textarea id='visit_msg' class="form-control" rows="3"></textarea>
                            </div>

                            <div class='main_mail_con'>
                                    <input type="checkbox" id="mail_agree" name="mail_agree" />
                                    <label for="mail_agree">개인정보 수집 및 활용에 동의합니다.</label>
                                    
                             </div>
                            <button type="button" onclick='contact_us_main();' class="btn btn-info btn-block">
                                이용 문의하기
                            </button>
                        </div>
                        <button type="button" id="bt_contact_us" onclick='show_contact_us();' class="btn btn-info btn-block">
                            이용 문의하기
                        </button>
                    </div>


                    <!--공지사항-->
                    <div class='main_con_left_w con_outline'>
                        <h3 class='main_con_title' style='margin-bottom: 0px;'>
                            공지 사항
                        </h3>
                        <!---->
                        <div class='main_mail_list'>
                            <?
                            if($notice!=''){
                            foreach($notice as $notice_item){?>
                            <div class='main_mail_con'>
                                <b>
                                    <a href="/board/gwon_board_detail/<?echo $notice_item->bo_id;?>">
                                        <?=$notice_item->bo_title;?>
                                    </a>
                                </b><br/>
                                <?
                                $noti_date = date("Y/m/d", strtotime($notice_item->bo_date));
                                echo $noti_date;
                                ?>
                            </div>
                            <?}
                            }else{
                                echo '공지사항이 없습니다.';
                            }?>
                        </div>

                    </div>
                </div>
                <div id='main_con_right'>
                    <!--새로 등록된 사연-->
                    <div class='main_con_right_w con_outline'>
                        <h3 class='main_con_title'>
                            새로운 지원사업
                            <a href='/main/campagin_list'>
                <span style='font-size: 12px;'>
                    더 보기
                </span>
                            </a>
                        </h3>

                        <?
                        if($campaign!=''){
                        foreach($campaign as $item){
                            if($item->admin_check==0){

                                $project_img = $item->project_img;
                                if($project_img!=''){
                                    $project_img = $project_img;
                                }else if($logo!=''){
                                    $project_img = $logo;
                                }else{
                                    $project_img = '/img/not_img.png';
                                    
                                }
                        ?>
                        <div class='campaign_con_list'>
                            <div class='campaign_con_txt_area'>
                                <div class='campaign_con_img_area' style='background:url("<?echo $project_img;?>") no-repeat center center; background-size:100px 100px; '></div>
                                <div class='campaign_con_txt_area_detail'>
                                    <a href="/<?=$item->domain;?>" target="_blank">
                                        <h3><?=$item->title;?></h3>
                                    </a>
                                    <?
                                    $start_date_ymd = date("Y/m/d H:i", strtotime($item->start_date.$item->start_time ));
                                    $end_date_ymd = date("Y/m/d H:i", strtotime($item->end_date.$item->end_time ));

                                    echo '<p style="margin-bottom: 5px; font-size: 12px;"><b>모집 기간 : </b>'.$start_date_ymd.'~';
                                    echo $end_date_ymd.'</p>';
                                    echo $item->summary;
                                    ?>
                                    <div class='tag_area'>
                                        <? foreach($item->tag as $tag){?>
                                            <span class="label label-default"><?=$tag->tg_title;?></span>
                                        <?}?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?}
                        }
                        }else{
                            echo 'Contents 가 없습니다.';
                        }?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
</div>
</body>
</html>