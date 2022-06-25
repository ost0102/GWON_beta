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
<div id='container'>
    <div id='con'>
        <div id='con_main'>
            <!-- 상단 메인 배너 -->
            <div id='main_slider'>
                <div id='main_slider_con'>
                    <div id='slider_con_1'>
                        <h1 class='g_point_color g_point_bold' style="line-height: 35px;">
                            <span style="font-size: 10px; line-height: 12px;">
                                쉬워지는 지원사업 
                            </span><br/>
                            비대면 지원사업 통합솔루션 Gwon
                        </h1>
                        아직도 이메일로, 우편으로 서류접수를 받고 있나요?<br/>
                        참가자 접수부터 심사, 선정 발표까지의 전 과정에서 기존과는 다른 편리함을 경험하세요!
                        <br/><br/>
                        <div class="main_slider_sub_con_area">
                            <div class="main_slider_sub_con">
                                <h3 class='main_con_title' >
                                    다양한 입력 항목 지원
                                </h3>
                                지원사업의 입력항목을 한줄입력칸부터 업로드까지<br/>
                                필요한 만큼 직접 추가할 수 있습니다.
                            </div>
                            <div class="main_slider_sub_con">
                                <h3 class='main_con_title' >
                                    모집 전용 홈페이지 제공
                                </h3>
                                지원에서는 각 모집공고별로 전용 홈페이지를 제공합니다.<br/>
                                모집 공고 포스터에 이제 접수 이메일 주소말고,<br/>
                                접수 홈페이지 주소를 넣으세요!<br/>
                                반응형 웹으로 컴퓨터는 물론 스마트폰에서도 보기 편한<br/>
                                홈페이지를 활용하세요!
                            </div>
                        </div>
                        <div class="main_slider_sub_con_area">
                            <div class="main_slider_sub_con">
                                <h3 class='main_con_title' >
                                    필요한 기능 마음껏 활용하세요!
                                </h3>
                                접수 기간 동안에만 신청서를 작성할 수 있는 것은 기본!<br/>
                                공지 게시판, Dashboard, 합격자 조회 등 모집 사이트에 <br/>
                                필요한 기능들을 계속해서 추가하고 있습니다.<br/>
                                필요한 기능이 있으신가요? 언제든 제안해주세요!<br/>
                                <a href="mailto:help@treeple.net">help@treeple.net</a>
                            </div>
                            <div class="main_slider_sub_con">
                                <h3 class='main_con_title' >
                                    접수 서류 취합은 빠르고, 간편하게!
                                </h3>
                                우편접수나 이메일로 접수된 서류 목록을 엑셀로 정리하는 데 <br/>
                                많은 시간을 쓰고 계시지 않으셨나요?<br/>
                                지원 서비스를 이용하시면, 서류 접수 내용도 자동으로 정리되어 <br/>
                                다운로드 받으실 수 있어요!
                            </div>
                        </div>
                        <div class="main_slider_sub_con_area">
                            <div class="main_slider_sub_con">
                                <h3 class='main_con_title' >
                                    심사 과정도 간편하게!
                                </h3>
                                심사위원용 자료를 만들어 이메일로 전달하고,<br/>
                                다시 취합하고 합산하는 일련의 과정, 불편하진 않으셨나요?<br/>
                                심사위원도 사업담당자도 편리하게 이젠 인터넷에서 해결하세요!

                            </div>
                            <div class="main_slider_sub_con">
                                <h3 class='main_con_title' >
                                    실시간 insight 정보로 스마트하게!
                                </h3>
                                우리 지원사업에 관심있는 사람들은 어떤 특징을 가지고 있을까요?<br/>
                                접수 내용을 분석하여 지원,모집 사업별 특징을 한눈에 확인할 수 있는
                                기능을  제공합니다. 
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- 상단 메인 배너 끝 -->
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
    <?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
</div>
</body>
</html>