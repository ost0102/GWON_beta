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
            var doc_h = $(document).height();
            var win_h = $(window).height();
            $('#workspace_container').height(doc_h-250);

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

        function write_giveup(){
            if( $('#mail_msg_form').css('display')=='block'){
                //alert('저장');

                var visit_name = $('#visit_name').val();
                var visit_email = $('#visit_email').val();
                var visit_msg = $('#visit_msg').val();

                 $.post('/new/main/input_visit_msg/',{
                             visit_name: visit_name,
                             visit_email: visit_email,
                             visit_msg: visit_msg
                    },
                    function(data){
                        if(data==1){
                            alert('응원메시지가 입력되었습니다. 감사합니다.');
                            location.reload();
                        }else{

                            alert('빠진 항목이 없는지 확인해주세요.');
                        }
                            
                        
                    });


            }else{

                $('#mail_msg_list').hide();
                $('#mail_msg_form').slideDown();
            }
        }

    </script>
</head>
<body>
<!-- 상단 영역 공통 시작-->
<div id='top_area'>
    <div id='workspace_top_noti'>
            <div id='top_noti_con_txt'>
                <!-- noti_txt -->
                <?include_once $this->config->item('basic_url')."/include/inc_top_noti_txt.php";?>
            </div>
            <div id='top_menu_area'>
                <!-- sub_top area include -->
                <?include_once $this->config->item('basic_url')."/include/inc_top_menu_login.php";?>
            </div>
    </div>
    <div id='workspace_top_con'>
        <?include_once $this->config->item('basic_url')."/include/inc_top_menu.php";?>
    </div>
</div>
<!-- 상단 영역 공통 끝 -->
<div id='workspace_container'>
    <div id='workspace'>
        <!-- 왼쪽 콘텐츠 영역 시작 -->
        <div id='workspace_left' class='ws_left'>
            <!--공지사항-->
            <div id='workspace_left_con'>
                <h3 class='main_con_title'>
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
        <!-- 오른쪽 콘텐츠 영역 시작 -->
        <div id='workspace_right'>
    <div id='workspace_right_con'>
        <!--item 영역-->
        <a href='/makepage/outline'>
        <div class='new_item work_item'>
            <h3>New Gwon</h3>
            새로운 폼 만들기
        </div>
        </a>
        <? if(isset($my_project)){
            //print_r($linked_info);
            foreach ($my_project as $my_project)
            {
                                    //print_r($row);
                                    //class_no가 없을 경우 최근 값을 가져와라
                                    $cate_id = $my_project['cate_id'];
                                    $title = $my_project['title'];
                                    $summary = $my_project['summary'];
                                    $logo = $my_project['logo'];
                                    $date = $my_project['date'];
                                    $domain = $my_project['domain'];
                                    $p_num = $my_project['p_num'];
                                    $page_secur = $my_project['page_secur'];
                                    $state = $my_project['state'];
                                    $tp_state = $my_project['tp_state'];
                                    $project_img = $my_project['project_img'];
                                    $start_date = $my_project['start_date'];
                                    $end_date = $my_project['end_date'];
                                    $start_time = $my_project['start_time'];
                                    $end_time = $my_project['end_time'];

                                     $start_date_ymd = date("Y/m/d H:i", strtotime($start_date.$start_time ));
                                     $end_date_ymd = date("Y/m/d H:i", strtotime($end_date.$end_time ));

                                   

                if($project_img!=''){
                    $project_img = $project_img;
                }else if($logo!=''){
                    $project_img = $logo;
                }else{
                    $project_img = '/img/not_img.png';
                }

                $icon  =array('stop','tint','lemon','medkit','money','female','pencil','comments-alt','lightbulb','sun','file','file');
                $i=0;
        ?>
            <!--item 영역-->
            <div class='work_item con_outline'>
                <h3 class='main_con_title'>
                    <?echo $title;?>
                </h3>
                                        <?  
                                        if($state=='0'){
                                            echo '<br/><b>페이지 비활성화 중입니다.</b>';
                                            echo '<br/>페이지를 하려면 <a href="/makepage/add_other/'.$page_secur.'">활성화단계</a>에서 생성하기 버튼을 클릭해주세요.';
                                        }
                                        //활성화된 정보의 경우 URL 및 기타 보기 메뉴 출력
                                        ?>
                                            <!--
                <span><?echo $summary;?></span>
                                            -->

                                        <?  
                                        if($tp_state=='1'){
                                            echo '<br/><b><a href="/tpub/page/'.$page_secur.'" target="_blank" >
                                            임시 활성화 사용 중</a></b>';
                                            echo '<br/>공개된 페이지일 경우 수정 후 미 반영된 정보가 있을 수 있습니다. 임시활성화 기능은 페이지 활성화 단계에서 변경 가능합니다.';
                                        }
                                        //활성화된 정보의 경우 URL 및 기타 보기 메뉴 출력
                                        ?>
                                        <div class='work_item_link_area'>
                                        <?
                                            echo "<div class='work_item_con2'>";
                                            echo '<b>모집 기간 : </b><br/>'.$start_date_ymd.'~<br/>';
                                            echo $end_date_ymd.'<br/>';
                                            echo "</div>";

                                            if($state==1){
                                            echo "<div class='work_item_con2'>
                                                    <a href='".$this->config->item('base_url')."/".$domain."' target='_blank'><b>
                                                    ".$this->config->item('service_url')."/".$domain."</b></a>
                                                </div>";
                                            }
                                        ?>

                                        <div class='work_item_con2'>
                                            <a href='/makepage/outline/<?echo $page_secur;?>' target='_self'>
                                                <span style='font-size: 12px;'>
                                                    수정하기
                                                </span>
                                            </a>
                                        </div>

                                        
                                        <div class='work_item_con2'>
                                            <a href='/mypage/page_detail/<?echo $page_secur;?>' target='_self'>
                                                <span style='font-size: 12px;'>
                                                    DashBoard
                                                </span>
                                            </a>
                                        </div>

                                        </div>
            </div>

            <?
            }
        }else{
            echo '페이지 생성정보가 없습니다.<br/>';
        }?>
        
        <!--item 영역 끝-->
    </div>

        </div>
    </div>
    <?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
</div>
</body>
</html>