<script type="text/javascript">
function apply_success(){
    //alert('test');
    var domain = '<?echo $domain?>';
    location.href='/'+domain;
}

function goto_edit(){
    //alert('test');
    var domain = '<?echo $domain?>';
    location.href='/apl/'+domain+'?page_num=1';
}
</script>
<?
$intro_url = $this->config->item('intro_url');
?>
<style type="text/css">

</style>
<div class='con_area_div' style='text-align: center;'>
  <h1 class='con_titles'>
    접수 완료
  </h1>
  <br/>
  접수가 정상적으로 완료되었습니다.
</div>
<div class='con_area_div' style='text-align: center; border: 1px solid #cdcdcd; height: 300px; overflow-y: auto;'>
  <h1 class='con_titles'>
    접수 내용
  </h1>
  <?
    //div는 10개까지지만.. graph 출력위치가 11까지라서 11로..
    if(isset($form_set_info)){
          //print_r($form_set_info);
          //echo '<br/>';
           //input type 비교를 위해 배열로 구성
          $input_type_array = array('text', 'textarea', 'page_branch', 'radio','select','checkbox','upload','date','agree');
          foreach ($form_set_info as $form_set_infos)
            {
            //print_r($form_set_infos);
            //echo '<br/>';
            $w_num = $form_set_infos['w_num'];
            $key = $form_set_infos['key'];
            $item_id = $form_set_infos['item_id'];
            $display_name = $form_set_infos['display_name'];
            $field_type = $form_set_infos['field_type'];
            $options = $form_set_infos['options'];
            $use = $form_set_infos['use'];
            $memo = $form_set_infos['memo'];
            $date = $form_set_infos['date'];
            $item_value = $form_set_infos['item_value'];

            $options_preg = preg_replace('/\r\n|\r|\n/','#PH#',$options);
            $config_option = explode('#PH#', $options_preg);
            ?>
            <!--설문 콘텐츠 출력 시작-->
            <div id='con_con<?echo $key;?>' class='con_area_div'>
                <h5 id='con<?echo $key;?>_title' class='con_titles'><?echo $display_name;?></h5>
                <div id='con<?echo $key;?>_txt'>
                   <!--본문 내용 출력
                   key : <?echo $key;?><br/>
                   item_id : <?echo $item_id;?><br/>
                   field_type : <?echo $field_type;?><br/>
                   options : <?echo $options;?><br/>
                   use : <?echo $use;?><br/>
                   memo : <?echo $memo;?><br/>
                   item_value : <?echo $item_value;?><br/>-->
                   
                   <input type="hidden" name="display_name[]" value="<?echo $display_name;?>"/>
                   <input type="hidden" name="key[]" value="<?echo $key;?>"/>
                   <input type="hidden" name="item_id[]" value="<?echo $item_id;?>"/>

                   <?
                   //기본 input type인지 체크, 아닌 경우 추가로 텍스트 출력 등 값을 받지 않는 항목으로 구성될 수 있도록..
                   if(in_array($field_type, $input_type_array)) {
                        if($field_type=="page_branch"){
                   ?>
                        <input type='hidden' name="item_value[]"  id="<?=$item_id;?>" value="" />
                        <?if(isset($memo)&&$memo!=''){
                           ?>
                          <div style='width: 100%; float: left; padding-top: 0px;'>
                            <?echo $memo;?>
                          </div>
                          <?
                          }?>
                        <?
                        }else if($field_type=="text"){
                         ?>
                                <input type='text' name="item_value[]"  id="<?=$item_id;?>" value="<?=$item_value;?>" readonly tabindex='<?echo $key;?>' <?if($use==1){echo 'required';}?>/>
                                <?if(isset($memo)&&$memo!=''){
                                 ?>
                                <div class='t_basic' style='width: 100%; float: left; padding-top: 0px;'>
                                  <?echo $memo;?>
                                </div>
                                <?
                                }?>
                        <?
                         }else if($field_type=="textarea"){
                        ?>
                                 <textarea name="item_value[]"  id="<?=$item_id;?>"  cols="10" rows="5"  readonly tabindex='<?echo $key;?>' <?if($use==1){echo 'required';}?>><?=$item_value;?></textarea>
                                 <?if(isset($memo)&&$memo!=''){
                                 ?>
                                <div class='t_basic' style='width: 100%; float: left; padding-top: 0px;'>
                                  <?echo $memo;?>
                                </div>
                                <?
                                }?>
                        <?
                        }else if($field_type=="radio"){
                        ?>
                            <? 
                                $i=1;
                                foreach($config_option as $options_item){
                                    if($options_item==$item_value){
                                        $check_checked = 'checked';
                                    }else{
                                        $check_checked = '';
                                    }
                              ?>
                               <input type="radio" name="item_value[]"  id="<?=$item_id.'_'.$i;?>" onclick="return(false);" value="<?=$options_item;?>" <?if($use==1){echo 'required';}?><?echo $check_checked;?> tabindex='<?echo $key;?>'/><label for='<?=$item_id.'_'.$i;?>'><?=$options_item;?></label> 
                               <br/>
                             <?
                                $i++;
                              }?>
                              <?if(isset($memo)&&$memo!=''){
                               ?>
                              <div class='t_basic' style='width: 100%; float: left; padding-top: 0px;'>
                                <?echo $memo;?>
                              </div>
                              <?
                              }?>
                        <?
                        }else if($field_type=="select"){
                        ?>
                            <select name="item_value[]" id="<?=$item_id;?>" <?if($use==1){echo 'required';}?> tabindex='<?echo $key;?>' onFocus='this.initialSelect = this.selectedIndex;' readonly onChange='this.selectedIndex = this.initialSelect;' style='width: 100%;'>
                                <option value="">선택해주세요 </option>
                            <? 
                                $i=1;
                                foreach($config_option as $options_item){
                                  if($options_item==$item_value){
                                    $check_checked = 'selected';
                                  }else{
                                    $check_checked = '';
                                  }
                              ?>
                               <option value="<?=$options_item;?>" <?echo $check_checked;?> ><?=$options_item;?></option>
                             <?
                                $i++;
                              }?>
                             </select>
                             <?if(isset($memo)&&$memo!=''){
                               ?>
                              <div class='t_basic' style='width: 100%; float: left; padding-top: 0px;'>
                                <?echo $memo;?>
                              </div>
                              <?
                              }?>
                        <?
                        }else if($field_type=="checkbox"){
                        ?>
                            <? 
                                $i=1;
                                foreach($config_option as $options_item){
                                    if($options_item==$item_value){
                                        $check_checked = 'checked';
                                    }else{
                                        $check_checked = '';
                                    }
                              ?>
                              <input type="checkbox" id="<?=$item_id.'_'.$i;?>" class="<?=$item_id;?>" onclick="return(false);" readonly <?if($use==1){echo 'required';}?> onclick='check_box_state("<?=$item_id;?>","<?=$item_id.'_'.$i;?>","<?=$options_item;?>");' name="checkbox_con" value="<?=$options_item;?>" tabindex='<?echo $key;?>' <?echo $check_checked;?>/><label for='<?=$item_id.'_'.$i;?>'><?=$options_item;?></label> 
                              <br/>
                             <?
                                $i++;
                              }?>
                              <input type="hidden" id="<?=$item_id.'_result';?>" name="item_value[]" value="<?=$item_value;?>" />
                              <?
                                if($item_value!=''){
                                ?>
                                <script>
                                //체크했던 정보 가져오기
                                 var id_item_result = '#'+'<?echo $item_id;?>'+'_result';
                                 var class_item_id = '.'+'<?echo $item_id;?>';

                                 var check_box_class = '.'+'<?echo $item_id;?>';
                                 var now_result = $(id_item_result).val();
                                 var now_result_split = now_result.split('#PH#');

                                 $(class_item_id).each(function() {
                                    now_value_txt = $(this).attr('value');
                                    now_checkbox_id= $(this).attr('id');

                                    if($.inArray(now_value_txt, now_result_split) != -1){
                                        $("input:checkbox[id='"+now_checkbox_id+"']").prop('checked', true);

                                    }
                                  });

                                </script>
                                <?
                                }
                              ?>
                               <?if(isset($memo)&&$memo!=''){
                               ?>
                              <div class='t_basic' style='width: 100%; float: left; padding-top: 0px;'>
                                <?echo $memo;?>
                              </div>
                              <?
                              }?>

                        <?
                        }else if($field_type=="upload"){
                        ?>
                            <input id='<?=$item_id;?>' name="item_value[]"  type='text' placeholder='업로드할 파일을 선택해주세요.' <?if($use==1){echo 'required';}?> value='<?=$item_value;?>' readonly/>
                             
                            <?if(isset($memo)&&$memo!=''){
                            ?>
                            <div class='t_basic' style='width: 100%; float: left; padding-top: 0px;'>
                            <?echo $memo;?>
                            </div>
                            <?
                            }?>
                            <br/>
                            <?if(isset($item_value)&&$item_value!=''){
                            ?>
                            <div id='<?=$item_id;?>_down_area' style='width:100%; '>
                                <a href="<?if(isset($item_value)) echo $item_value;?>" target="_blank">첨부 파일 보기</a>
                            </div>
                            <?
                            }?>
                        <?
                        }else if($field_type=="date"){
                        ?>
                              <input id='<?=$item_id;?>' name="item_value[]" type='text' readonly placeholder='날짜를 선택해주세요.' <?if($use==1){echo 'required';}?> value='<?=$item_value;?>' tabindex='<?echo $key;?>' autocomplete="off" <?/*readonly*/?>/>
                                 <?if(isset($memo)&&$memo!=''){
                                 ?>
                                <div class='t_basic' style='width: 100%; float: left; padding-top: 0px;'>
                                  <?echo $memo;?>
                                </div>
                                <?
                                }?>
                        <?
                        }else if($field_type=="agree"){
                        ?>
                            <div style="width: 100%; float: left;">
                                 <?if(isset($memo)&&$memo!=''){
                                 ?>
                                <textarea style='width: 100%; height: 150px; float: left; padding-top: 0px;' readonly><?echo $memo;?></textarea>
                                <?
                                }?>
                                <input type='checkbox' id="<?=$item_id;?>" <?if($item_value==true){echo "checked";}?> tabindex='<?echo $key;?>' <?if($use==1){echo 'required';}?> onclick='agree_box_state("<?=$item_id;?>");' /><label for='<?=$item_id;?>'>동의합니다.</label> 
                                <input type="hidden" id="<?=$item_id.'_result';?>" name="item_value[]" value="<?=$item_value;?>" />
                            </div>

                        <?
                        }else{
                          echo '정해진 형식 없음';
                        }
                    }else{
                        echo '<br/>해당없음 </br>';
                    }
                   ?>
                <!--본문 콘텐츠 수정 버튼 출력-->
                </div>
            </div>
            <!--설문 콘텐츠 출력 끝-->
    <?
       }
    }
    ?>
      <!--signature 관련 시작 -->
      <link href="/assets/signature_pad/assets/jquery.signaturepad.css" rel="stylesheet">
      <!--[if lt IE 9]><script src="/assets/signature_pad/assets/flashcanvas.js"></script><![endif]-->
      <!--signature 관련 끝-->
    <div id='signature_area' style="padding-top: 15px; text-align: center; margin-bottom: 15px;">
      
      <div style="padding-top: 15px; text-align: center; margin-bottom: 15px;">
        제출내용은 공고사업 통합관리솔루션 Ⓖwon과<br/>
        <?echo $title;?> 담당자에게 제공되어 활용될 수 있습니다.
       </div>
      <div class="sigPad">
          서명
          <div class="sig sigWrapper" >
            <div class="typed"></div>
            <canvas class="pad" width="198" height="55"></canvas>
            <input type="hidden" name="sig_info" class="output">
          </div>
        </div>
     </div>
    <!--signature 관련 시작 -->
    <script src="/assets/signature_pad/jquery.signaturepad.js"></script>
      <script>
        $(document).ready(function() {
          
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


</div>
<div id='bt_area' class="con_area_div" style="text-align: center; margin-bottom: 10px;">
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
    ?>
    <?
    if($check_apply =='y'){
    ?>
    <button id='post_project_info' type="button" onClick='goto_edit();' class='btn btn-default' style='float: left;'>
        수정하기
    </button>
    <?
    }else{
    ?>
    <?
    }
    ?>
    <button id='post_project_info' type="button" onClick='apply_success();' class='btn btn-info' style='float: right;'>
        완료
    </button>
    
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
<script src="https://www.youtube.com/iframe_api"></script>
<script src="//f.vimeocdn.com/js/froogaloop2.min.js"></script>
<SCRIPT TYPE='text/javascript'>
        //업로드 파일
        function upload_file(w_num,item_id){
            var url = '/upload/up1/6?w_num='+w_num+'&item_id='+item_id;
            window.open(url,'upload_img','width=500,height=430,left=0,top=0,scrollbars=no');
        }

        //체크박스 실행
        function check_box_state(item_id, item_id_num, options_item){
            var id_item_result = '#'+item_id+'_result';
            var id_item_id_num = '#'+item_id_num;
            var class_item_id = '.'+item_id;
            var value_txt = '';
            var now_value_txt = '';

            $(class_item_id).each(function() {
              var now_checked = $(this).is(':checked');
              if(now_checked==true){
                now_value_txt = $(this).attr('value');
                if(value_txt==''){
                    value_txt = now_value_txt;
                }else{
                    value_txt = value_txt+'#PH#'+now_value_txt;
                }
              }
            });
            $(id_item_result).val(value_txt);

        }

        //로고 삭제
        function delete_file(w_num,item_id){

            var file_url = $('#'+item_id).val();
            //alert(file_url);

            $.post('/upload/delete_file',{
                    w_num: w_num,
                    item_id: item_id,
                    file_url: file_url
                },
                function(data){
                    //alert(data);
                    //입력값 초기화하기
                    if(data==1){
                        $('#'+item_id).val("");
                        $('#'+item_id).attr("value","");
                        $('#'+item_id+'_down_area').hide();
                        $('#'+item_id+'_img_upload').show();
                        $('#'+item_id+'_bt_file_delete').hide();
                    }else{
                        alert(data);
                    }
                    //추가 해야할 사항 로고 업로드시 변동 부분, 그리고 실제 하단 코드 부분에 버튼 추가하고 보이도록 설정
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

</SCRIPT>

