<script type="text/javascript">
</script>
<?
$intro_url = $this->config->item('intro_url');
?>
<style type="text/css">
</style>
<!--signature 관련 시작 -->
<!--[if lt IE 9]><script src="/assets/signature_pad/assets/flashcanvas.js"></script><![endif]-->
<!--signature 관련 끝-->
<div id="con_txt_area" class="con_area_div">
    <h3 id="apply_bt_title" >지원 안내</h3>
    <?echo $apply_txt;?>
</div>
<div id="apply_bt_area" class="con_area_div">

    <?

        if($file_attachment!=''){
          $download_url= "/makepage/attach_download/".  my_simple_crypt($file_attachment);
    ?>
        <a href="<?echo $download_url;?>" target="_blank">
            <button id='bt_file_attachment' class='btn btn-inverse'>
                <!--첨부 파일 다운로드-->
                신청 서식 다운로드
            </button>
        </a>
    <?
        }
    ?>
    
    <br/><br/>
    <?/*echo date("Y년m월d일", strtotime( $start_date ));?>
    <?echo date("H시i분", strtotime( $start_time ));?>
    ~<br/>
    <?echo date("Y년m월d일", strtotime( $end_date ));?>
    <?echo date("H시i분", strtotime( $end_time ));*/?>
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
    ?>
    <a href="/apl/<?echo $domain;?>?page_num=1" target="_self" style='text-decoration: none;'>
        <button id='post_project_info' class='btn btn-default'>
            지원서 작성하기
        </button>
    </a>
    <?
    }else{
        if($today_ymd<$start_date_ymd || $today_ymd>$end_date_ymd){
    ?>
            모집 기간이 아닙니다.<br/>
            <?
            if($can_edit=='y'){
                echo '<br/><a href="/apl/'.$domain.'?page_num=1" target="_blank" style="color: #fff; background: #555;">지원 양식보기</a><br/>
                <span style="font-size: 9px;">(*본 링크는 관리자에게만 보여집니다.)</span><br/><br/>';
            }else{  
            }
        ?>
        <!--<button id='post_project_info' onClick='apply_soon();' class='btn btn-info'>
        -->
        <a href="/apl/<?echo $domain;?>" target="_self" style="text-decoration: none;">
            <button id='post_project_info' onClick='apply_soon();' class='btn btn-default'>
                모집 종료
            </button>
        </a>
        <?
        }else{
        ?>  
            <!--<button id='post_project_info' onClick='apply_soon();' class='btn btn-info'>-->
            <a href="/apl/<?echo $domain;?>" target="_self" style="text-decoration: none;">
            <button id='post_project_info' onClick='apply_soon();' class='btn btn-default'>
                모집 예정
            </button>
            </a>
        <?
        }
        ?>
    <?
    }
    ?>
    
     
 </div>
    
<!-- Other Contents Area start -->
<div id='other_info'>
    <?
        
        if(isset($contact)&& $contact !='0'&& $contact !=''){
            $contact_ex =explode(',' , $contact);
            echo '<h3 id="contact_info"><img src="/img/icon/icon_call.png" style="width: 15px; margin-right: 5px;" />문의하기</h3>';
            echo '<ul id="contact_info_ul">';

            foreach ($contact_ex as $contact_info) {
                //연락처가 메일인지, 웹사이트인지, 전화번호인지 파악하여 적절한 링크 추가하기

                $ex="/^[-_a-z0-9]+(\.[-_a-z0-9]+)*@[-a-z0-9]+(\.[-a-z0-9]+)+$/"; 
                
                $check_mail_type = preg_match($ex, $contact_info); 
                if($check_mail_type == 1){
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
    $intro_url = $this->config->item('intro_url');
    $title_enc = urlencode($title);
    //문자열 바꾸기
    $phrase  = $title;
    $origin_str = '\'';
    $change_str = '"';
    $title_replace = str_replace($origin_str, $change_str, $phrase);

?>
<SCRIPT TYPE='text/javascript'>

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

<!--signature 관련 시작 -->
<script src="/assets/signature_pad/jquery.signaturepad.js"></script>
  <script>
    $(document).ready(function() {
      //서명 영역 불러오기
      $('.sigPad').signaturePad({drawOnly:true});
      //기존 서명정보 불러오기 (있을 경우만)
      <?
      if(isset($signature)){
      ?>
        $('.sigPad').signaturePad({displayOnly:true}).regenerate(<?echo $signature;?>);
      <?
      }?>
    });
  </script>
  <script src="/assets/signature_pad/assets/json2.min.js"></script>
<!--signature 관련 끝-->