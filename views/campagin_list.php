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
                    }else{
                        echo 'Contents 가 없습니다.';
                    }?>
                    <div style='width: 100%; text-align: center;' class="col-md-12">
                        <?=$pagination;?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
</div>
</body>
</html>