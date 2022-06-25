<script type="text/javascript">
//폼 값 저장하기
        function save_form(){
                //alert('test');
                var w_num = $('#w_num').val();


                //alert(w_num);
               if(w_num==""){
                   alert("페이지 인식코드를 확인할 수 없습니다.");
               }else{
                   $("#form_set").submit();
                /*
                    $.post('/makepage/save_form_set/',{
                            dn_bank_recipt: dn_bank_recipt,
                            dn_id: dn_id

                        },
                        function(data){

                            $("#form_set").submit();
                        });
                */


                }
            }
</script>
<?
        if(isset($edit_con)&&$edit_con==2){
            $can_edit = 'y';
        }else{
            $can_edit = 'n';
        }
    $now_state = $_SERVER['REQUEST_URI'];
    if(strpos($now_state,'select_design') !== false || strpos($now_state,'mobile_view') !== false){
        $can_edit = 'n';
    }
    $base_url = $this->config->item('base_url');
?>
<style type="text/css">
</style>
<!--
<div id="top_summary" class="con_area_div">
    <h3 id="top_summary_title" >요약</h3>
    <?echo nl2br($summary);?>
</div>
-->
<div id="main_con_board" class="con_area_div" style="text-align: center; margin-bottom: 10px;">
    <h3>새 소식</h3>
    <table class='inno_table'>
        <tr>
        <th>
                제목
            </th>
            <th width='100px;'>
                작성일
            </th>
        </tr>
    
    <?
    if(isset($list)&&$list!=''){
    foreach($list as $item){?>
        <tr class='inno_table_last_tr'>
            <td>
                <a href='<?echo $link_board_detail;?><?=$item->bo_id;?>?domain=<?=$domain;?>'><?=$item->bo_title;?></a>
            </td>
            <td>
                <?
                echo date('Y-m-d', strtotime($item->bo_date));
                ?>
            </td>
        </tr>
        
    
    <?}
    }else{

        echo "
             <tr class='inno_table_last_tr'>
            <td>
                해당하는 내용을 찾을 수 없습니다.
            </td>
            <td>
            </td>
        </tr>
        ";
    }?>

    </table>
    <br/>
    <?
    if($can_edit =='y'){
    ?>
    <div style='width:100%; text-align: right;'>
        <a href='<?echo $link_board_write;?>'>
        <button class='btn btn-default'>
            글쓰기
        </button>
        </a>
    </div>
    <?}?>
 </div>
<div id="main_apply_bt_area" class="con_area_div">
    <h3 id="apply_bt_title" >사업 소개</h3>
    <?echo $con_txt;?>
</div>

<div id="apply_bt_area" class="con_area_div">
    <h3 id="apply_bt_title" >접수 기간</h3>
    <span id="apply_bt_date">
    <?echo date("Y년m월d일", strtotime( $start_date ));?>
    <?echo date("H시i분", strtotime( $start_time ));?>
    ~<br/>
    <?echo date("Y년m월d일", strtotime( $end_date ));?>
    <?echo date("H시i분", strtotime( $end_time ));?><br/><br/>
    </span>
    <?
    $today_ymd = date("Ymd H:i");
    $start_date_ymd = date("Ymd H:i", strtotime( $start_date.$start_time ));
    $end_date_ymd = date("Ymd H:i", strtotime( $end_date.$end_time ));
    if($today_ymd>$start_date_ymd&&$today_ymd<$end_date_ymd){
        $check_apply = 'y';
    }else{
        $check_apply = 'n';
    }
    ?>
    <?
        if(isset($edit_con)&&$edit_con==2){
            $can_edit = 'y';
        }else{
            $can_edit = 'n';
        }
    ?>
    <?
    if($check_apply =='y'){
        if($apply_txt==""){
            //지원안내 텍스트가 없다면..
            $apply_link = '/apl/'.$domain.'?page_num=1';
        }else{
            //지원안내 텍스트가 있다면..
            $apply_link = '/apl/'.$domain;
        }
    ?>
    <a href="<?echo $apply_link;?>" target="_self" style='text-decoration: none;'>
        <button id='post_project_info' class='btn btn-info'>
            지원하기
        </button>
    </a>
    <?
    }else{
    ?>
        모집 기간이 아닙니다.<br/>
    <?
        if($can_edit=='y'){
            echo '<br/><a href="/apl/'.$domain.'" target="_self">지원 양식보기</a><br/><span style="font-size: 9px;">(*본 링크는 관리자에게만 보여집니다.)</span><br/><br/>';
        }else{  
        }
    }
    ?>
    <?

        if($file_attachment!=''){
          $download_url= "/makepage/attach_download/".  my_simple_crypt($file_attachment);
    ?>
        <a href="<?echo $download_url;?>" target="_blank">
            <button id='bt_file_attachment' class='btn btn-inverse'>
                신청 서식 다운로드
            </button>
        </a>
    <?
        }
    ?>
     
 </div>
<input id='w_num' name='w_num' type='hidden' value='<?if(isset($w_num)) echo $w_num;?>'/>
<input type="hidden" name="domain" value="<?echo $domain;?>"/>

<!-- Other Contents Area start -->
<div id='other_info'>
    <?
        if(isset($origin_project)&& $origin_project !=''){
          echo '<h3 id="origin_project"><img src="/img/icon/icon_home.png" style="width: 15px;" />
                        <a href="'.$origin_project.'" target="_blank">'.$origin_project.'</a></h3>';
               }
    ?>
    <?
        if(isset($contact)&& $contact !='0'&& $contact !=''){
                                $contact_ex =explode(',' , $contact);
                                echo '<h3 id="contact_info"><img src="/img/icon/icon_call.png" style="width: 15px; margin-right: 5px;" />문의하기</h3>';
                                echo '<ul id="contact_info_ul">';

                                foreach ($contact_ex as $contact_info) {
                                    //연락처가 메일인지, 웹사이트인지, 전화번호인지 파악하여 적절한 링크 추가하기
                                    //공백제거
                                    $contact_info= preg_replace("/\s+/", "", $contact_info);

                                    $check_mail_type=preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i",$contact_info);
                                    if($check_mail_type==true){
                                        //메일 형태임
                                        echo '<li>메일 : <a href="javascript:post_mail_mail_addr(\''.$contact_info.'\');">'.$contact_info.'</a></li>';
                                    }else if(strpos($contact_info, 'www') !== false || strpos($contact_info, 'http://') !== false || strpos($contact_info, 'https://') !== false) {  
                                        //url 형태  
                                        echo '<li>홈페이지 : <a href="//'.$contact_info.'" target="_blank"> '.$contact_info.'</a></li>';
                                    }else{
                                        //위 두개에 해당안된다면.. 아마도 전화번호?
                                        echo '<li>'.$contact_info.'</li>';
                                    }
                                    # code...
                                }
                                echo '</ul>';

            
        }

    ?>
    <!--실제 팀원 정보 출력부분-->
    <?
         /*
    if(isset($team_member&&$team_member!=''){
        echo '<br/><h3 id="member_title">담당자</h3>';
        echo '<div id="team_mate_state" class="con_div">
                    <!--팀원정보 출력 부분, ajax로 호출-->
                </div>';
    }
        */
    ?>
    <?
    if(isset($team_info)&&$team_info!=''){
        echo '<h3 id="team_title">관련 기관</h3>';
        echo '<div id="team_state" class="con_div">
                <!--팀원정보 출력 부분, ajax로 호출-->
            </div>';
    }
    ?>
    <?
        if($linked_url!=''){
            echo '<h3 id="links_title">관련 정보</h3>';
            echo '<div id="preview_area">';
            echo '<div id="ytplayer" style="display: none; padding-bottom: 15px;"></div>';
            echo '<iframe id="vmplayer" src="" width="100%" height="390" frameborder="0" style="display: none;"></iframe>';
            echo '</div>';
            echo '<div id="links_state" class="con_div"><ul id="links_con">';
            foreach ($linked_url as $linked_url1)
            {
                $link_title = $linked_url1['link_title'];
                $link_url = $linked_url1['link_url'];
                //$link_txt = '<span class="link_title">'.$linked_url['link_txt'].'</span>';
                $link_txt = $linked_url1['link_txt'];
                $in_out = $linked_url1['in_out'];

                //관련정보 뷰리뷰 관련.
                $is_preview = false;
                $type_preview = '';
                $key_preview = '';
                if(strpos($link_url, 'facebook.com') !== false) {
                    $sns_type = '<img src="/img/icon/bt_fb.png" class="img1">';
                }else if(strpos($link_url, 'twitter.com') !== false) {
                    $sns_type = '<img src="/img/icon/bt_twt.png" class="img1">';
                }else if(strpos($link_url, 'youtu.be') !== false || strpos($link_url, 'youtube.com') !== false) {
                    $is_preview = true;
                    $type_preview = 'youtube';
                }else if(strpos($link_url, 'vimeo.com') !== false) {
                    $is_preview = true;
                    $type_preview = 'vimeo';
                }else{
                    $sns_type = '<img src="/img/icon/bt_link.png" class="img1">';
                }
                if ($is_preview) {
                    $url_info = parse_url($link_url);
                    $key_preview = '';
                    if ($type_preview == 'youtube') {
                        if(strpos($link_url, 'youtu.be/') !== false){
                            $key_ex = explode(".be/", $link_url);
                            $key_preview = $key_ex[1];
                            $img_preview = 'https://i1.ytimg.com/vi/'.$key_preview.'/default.jpg';
                        }else if(strpos($link_url, 'youtube.com') !== false){
                            //채널일 경우 에러 존재함. 채널일 경우는 노출안되도록 변경하기
                            if(strpos($link_url, 'channel') == false){
                                if(strpos($link_url, 'embed') == false){
                                    //임베드 코드가 붙어있지 않으면..
                                    foreach(explode("&", $url_info['query']) as $q)
                                    {
                                        list($key, $value) = explode("=", $q);
                                        if ($key == 'v') {
                                            $key_preview = $value;
                                        }
                                        
                                    }
                                }else{
                                    //print_r($url_info);
                                    //임베드 코드가 붙어있다면..
                                    $embed_val = explode("embed/", $url_info["path"]);
                                    $key_preview = $embed_val[1];
                                }

                                $img_preview = 'https://i1.ytimg.com/vi/'.$key_preview.'/default.jpg';
                            }
                        }
                        //$player_preview = '<iframe id="ytplayer-'.$key_preview.'" type="text/html" width="640" height="360" src="https://www.youtube.com/embed/'.$key_preview.'" frameborder="0"></iframe></li>';
                        //$player_preview = '<div id="ytplayer-'.$key_preview.'"></div></li>';
                    }else if ($type_preview == 'vimeo') {
                        $path_parts = pathinfo(rtrim($url_info['path'], '/'));
                        $key_preview = $path_parts['filename'];
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_URL, "https://vimeo.com/api/v2/video/".$key_preview.".json");
                        curl_setopt($ch, CURLOPT_HEADER, 0);
                        $responce = json_decode(curl_exec($ch), true);
                        if (!empty($responce)) {
                            $res_obj = array_pop($responce);
                            $img_preview = $res_obj['thumbnail_small'];
                        } else {
                            $key_preview = '';
                        }
                    }

                    if (empty($key_preview)) {
                        $sns_type = '<img src="/img/icon/bt_youtube.png" class="img1">';
                        echo '<li>'.$sns_type;
                        echo '<b><a href="'.$link_url.'" onclick="check_linked(\''.$link_url.'\')" target="_blank" title="'.$link_txt.'">'.$link_title.'</a></b></li>';
                    } else {
                        $sns_type = '<a onclick="check_preview(\''.$key_preview.'\', \''.$type_preview.'\'); check_linked(\''.$link_url.'\');"  title="'.$link_txt.'"><div id="thumb-'.$key_preview.'" style="background: url(\''.$img_preview.'\'); width:100px; height:75px; text-align: left; line-height: 75px;"><img src="/img/icon/icon_done.png" id="play-'.$key_preview.'" style="display: none;" /></div></a>';
                        echo '<li><table><tr><td>'.$sns_type.'</td>';
                        echo '<td style="padding-left: 10px;"><b><a onclick="check_preview(\''.$key_preview.'\', \''.$type_preview.'\');check_linked(\''.$link_url.'\');" target="_blank" title="'.$link_txt.'">'.$link_title.'</a></b></td></tr></table></li>';
                    }
                } else {
                    echo '<li>'.$sns_type;
                    echo '<b><a href="'.$link_url.'"onclick="check_linked(\''.$link_url.'\')" target="_blank" title="'.$link_txt.'">'.$link_title.'</a></b></li>';
                }
            }
            echo '</ul></div>';
        }
    ?>
    <style type="text/css">
        /*페이지 고정영역 템플릿에 따라 스타일 변경 안되도록...*/
        #share_zone img, #view_mode img{
            width: 15px;
        }
    </style>
    <?
        if(!isset($t_pub)){
    ?>
            <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
            <div id='gwon_service_zone' style='margin-top: 10px; '>
        <div id='share_zone'>
            <?
            $now_state = $_SERVER['REQUEST_URI'];
            if(strpos($now_state,'select_design') !== false || strpos($now_state,'mobile_view') !== false){
            //select_design일때는 일단 맵정보 띄우지 말기
            echo 'Design 선택 단계에서는 페이지 공유 기능이 출력되지 않습니다.';   
            }else{
            ?>
            <div id='recommend'>
                <?
                if(!isset($check_recommend)){
                    $check_recommend=2;
                }
                if($check_recommend==1){
                                            $rec_img_url = '/img/icon/icon_recommend.png';
                                            $rec_txt = '저장완료';
                }else{
                                            $rec_img_url = '/img/icon/icon_recommend_not.png';
                                            $rec_txt = '저장하기';
                }
                ?>
                                        <img id="rec_img" src ='<?echo $rec_img_url;?>' style='margin-right: 5px;'>
                                        Bookmark 
                <a href='javascript:recommend_page();' >
                                            <span id='rec_txt'><?echo $rec_txt;?></span>
                                        </a>

            </div>

                            <div id='sns_area'>
                                <?/*<script type="text/javascript" src="/js/kakao.link.js"></script>*/?>
                                <b>공유하기</b>
                                <a onclick='up_fb();'><img src='/img/bt_fb.png' class='img2'/></a>
                                <a onclick='up_twt();'><img src='/img/bt_twt.png' class='img2'/></a>
                                <a onclick='up_kakao();'><img src='/img/bt_kakao.png' class='img2'/></a>
                            </div>
            <?
            }
            ?>
        <!-- 지역정보 들어가기-->
        <!--담기 & SNS 링크 아이콘으로.. 그럼 기록도 됨 -->
        </div>
    </div>
    <?
    }else{
    ?>
    <div id='gwon_service_zone'>
        <h3 style='margin-top: 20px;'>임시 활성화 보기에서는 view mode  설정, 소셜 미디어 공유 등의 기능은 제공되지 않습니다.</h3>
    </div>
    <?
    }
    ?>
    <!--kakao Story 링크 공유용-->
    <div id='page_descript' style='display:none;'><?echo $summary;?>'</div>
</div>
<?
    $user=$this->session->userdata('gwon_users');
    $now_url = '/'.$domain;
    $REQUEST_URI = $_SERVER['REQUEST_URI'];

    if($REQUEST_URI==''){
        $now_url = $now_url;
    }else{
        $now_url = $REQUEST_URI;
    }
    $base_url = $this->config->item('base_url');
    $title_enc = urlencode($title);
    //문자열 바꾸기
    $phrase  = $title;
    $origin_str = '\'';
    $change_str = '"';
    $title_replace = str_replace($origin_str, $change_str, $phrase);

            if(isset($domain_url)){
                if($domain_url==''){
                    //연결된 외부 도메인이 없을 경우 Gwon기본 도메인 사용
                    $site_domain = $base_url.'/'.$domain;
                }else{
                    $site_domain = 'http://'.$domain_url;
                }

            }else{
                //domain_url정보가 없음. 그러면 그냥 기본 url로.. 잘못하면 iframe 수백개 생길수 있으니..
                $site_domain = $base_url.'/'.$domain;
            }

?>
<script src="https://www.youtube.com/iframe_api"></script>
<script src="//f.vimeocdn.com/js/froogaloop2.min.js"></script>
<SCRIPT TYPE='text/javascript'>
        Kakao.init('40cbf03d23540c79e45e971799b7ef04');
        //페이지 추천하기
        function recommend_page(){
            /*
            개발 순서
            1. 페이지값과 접근 사용자 ID를 받고, 기존 공유 여부를 체크한다.
            2. 사이트 방문자가 로그인 안했을 때는 로그인 하라는 알림 창을 띄운다.
            3. 접근 사용자가 로그인 했을 경우에는, 공유하기를 기록한다.
            4. 공유했던 정보의 경우 공유를 취소한다.
            
            */
            var p_num = '<?if(isset($p_num)){echo $p_num;}?>';
            var now_user = '<?if(isset($user)){echo $user;}?>';
            var check_recommend = '<?if(isset($check_recommend)){echo $check_recommend;}?>';
            if(now_user==''){
                alert('로그인 후 이용하실 수 있습니다.');
                var now_url = '<?echo $now_url;?>';
                $.post('/user/sub_login',{
                    now_url: now_url
                },
               function(data){
                 //alert(data);
                open_modal(data);
                $('#modal_txt').html(data);
               }); 
                //alert('로그인해주세요.로그인 패널 추가하기');
            }else{
               $.post('/openpage/do_recommend',{
                    p_num: p_num,
                    now_user: now_user,
                    check_recommend: check_recommend
                },
               function(data){
                 //alert(data);
                 if(data == 1){
                    //alert(data);
                    open_modal('저장이 완료되었습니다.');
                    fadeout_modal();
                    $('#rec_txt').html('저장완료');
                    $('#rec_img').attr('src','/img/icon/icon_recommend.png');
                 }else{
                    open_modal('저장이 취소되었습니다.');
                    fadeout_modal();
                    $('#rec_txt').html('저장하기');
                    $('#rec_img').attr('src','/img/icon/icon_recommend_not.png');
                 }
               }); 

            }
        }

        //update to twt
        function up_twt(){
            var title = '<?echo $title_enc;?>';
            var now_url = '<?echo $now_url;?>';
            var p_num = '<?if(isset($p_num)){echo $p_num;}?>';
            var now_user = '<?if(isset($user)){echo $user;}?>';
             $.post('/openpage/up_sns',{
                    p_num: p_num,
                    now_user: now_user,
                    sns_type : 'twt'
                },
               function(data){
                 //alert(now_user);
                 /*if(data == '페이지 추천하였습니다.'){
                    $('#rec_img').attr('src','/img/icon/icon_recommend.png');
                 }else{
                    $('#rec_img').attr('src','/img/icon/icon_recommend_not.png');
                 }*/
               }); 
            window.open('https://twitter.com/intent/tweet?text='+title+' by Gwon <?=$site_domain;?>','','width=535, height=420');
        }
        function up_fb(){
            var title = '<?echo $title_enc;?>';
            var now_url = '<?echo $now_url;?>';
            var p_num = '<?if(isset($p_num)){echo $p_num;}?>';
            var now_user = '<?if(isset($user)){echo $user;}?>';
             $.post('/openpage/up_sns',{
                    p_num: p_num,
                    now_user: now_user,
                    sns_type : 'fb'
                },
               function(data){
                // alert(data);
                 /*if(data == '페이지 추천하였습니다.'){
                    $('#rec_img').attr('src','/img/icon/icon_recommend.png');
                 }else{
                    $('#rec_img').attr('src','/img/icon/icon_recommend_not.png');
                 }*/
               }); 
            var url_str = 'https://www.facebook.com/dialog/feed?app_id=285372929316494&display=popup&caption='+title+'&link=<?=$base_url;?>'+now_url+'&redirect_uri=<?=$base_url;?>/makepage/fb_clse/'+now_url;
            window.open(url_str,'','width=535, height=420');
        }

        function up_kakao(){
                var con_title = '<?echo $title_replace;?>';
                var con_script = $('#page_descript').text();
                var now_url = '<?=$base_url;?>'+'<?echo $now_url;?>';
                var p_num = '<?if(isset($p_num)){echo $p_num;}?>';
                var now_user = '<?if(isset($user)){echo $user;}?>';
                var con_img = '<?=$base_url;?>'+'<? echo $project_img; ?>';
                var con_img_check = con_img.indexOf('.net//');
                if(con_img_check > -1){
                    var con_img = '<?=$base_url;?>'+'<? echo $project_img; ?>';
                }  
                 /*
                */
                $.post('/openpage/up_sns',{
                    p_num: p_num,
                    now_user: now_user,
                    sns_type : 'kakao'
                },
                function(data){
                    //카카오톡 링크 보내기
                   //<![CDATA[
                    // // 카카오링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.

                    Kakao.Link.sendDefault({
                        objectType: 'feed',
                        content: {
                        title: con_title+':::Gwon',
                        description: con_script,
                        imageUrl: con_img,
                          link: {
                          mobileWebUrl: now_url,
                          webUrl: now_url
                          }
                        },
                        buttons: [
                          {
                            title: '웹으로 보기',
                            link: {
                            mobileWebUrl: now_url,
                            webUrl: now_url
                            }
                          }
                        ]
                      });
                  //]]>
                });
         }


    function check_linked(linked_url){
        //alert(linked_url);
        //링크 카운트 하기
        var w_num = '<?if(isset($w_num)){echo $w_num;}?>';
        var linked_url = linked_url;
        $.post('/openpage/check_link_url',{
            w_num: w_num,
            linked_url: linked_url
        },
        function(data){
            //alert(data);
             //window.open(linked_url,'','');
        }); 
        

    }

    //user_id를 알 수 있는 상황에서 user_id로 이메일 팝업 열기
    function post_mail(admin_user){
        //링크 카운트 하기
        var p_num = '<?if(isset($p_num)){echo $p_num;}?>';
        var admin_user = admin_user;
        //alert(admin_user);
        
        $.post('/openpage/send_mail_form',{
            p_num: p_num,
            admin_user: admin_user
        },
        function(data){
            open_modal(data);
            $('#modal_txt').html(data);
            //alert(data);
             //window.open(linked_url,'','');
        }); 
    }

    //이메일 주소만 아는 상황에서 이메일 팝업 열기
    function post_mail_mail_addr(mail_addr){
        //링크 카운트 하기
        var p_num = '<?if(isset($p_num)){echo $p_num;}?>';
        var mail_addr = mail_addr;
        //alert(admin_user);
        
        $.post('/openpage/send_mail_form_with_addr',{
            p_num: p_num,
            mail_addr: mail_addr
        },
        function(data){
            open_modal(data);
            $('#modal_txt').html(data);
            //alert(data);
             //window.open(linked_url,'','');
        }); 
    }
    //콘텐츠 수정 모달창 열기
    function edit_con(con_num){
        var p_num = '<?if(isset($p_num)){echo $p_num;}?>';
        var can_edit = '<?if(isset($can_edit)){echo $can_edit;}?>';
        
        $.post('/openpage/show_edit_modal/',{
            con_num: con_num,
            p_num: p_num,
            can_edit: can_edit
        },
        function(data){
            //open_modal();
            //$('#modal_txt').html(data);
            $("#right_top_shape").after(data);
            $('#openpage_con_edit').slideDown();
            $( window ).scrollTop(0);
            //alert(data);
             //window.open(linked_url,'','');
        }); 
    }


</SCRIPT>