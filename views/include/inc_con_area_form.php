<script type="text/javascript">
  //폼 값 저장하기
  function save_apply_info(){
      //alert('test');
      var w_num = $('#w_num').val();
      var output = $('#output').val();

      var use_array = Array();
      var send_cnt = 0;
      var chkbox = $("#sortable .use_check");

      //alert(w_num);
      if(w_num==""){
         alert("페이지 인식코드를 확인할 수 없습니다.");
      }else{
        // 공통입력폼내의 모든 입력오브젝트 
        var inputObjs = $("#form_set input");
        // 미입력여부(경우에 따라 사용)
        var bEmpty = true;
        var focus;

        // 각 오브젝트에 대해 입력체크
        inputObjs.each(function(index) {
          
          //if ($(this).val() == ""&&$(this).attr('required')=="required") {
            //체크박스 필수 체크여부 확인하기 - 체크박스, 사용자 동의 영역
            if ($(this).attr('type')== "checkbox"&&$(this).attr('required')=="required"&&$(this).is(":checked")==false) {
            focus = $(this);
            bEmpty = false;
            //alert($(this).attr('title')+"_"+$(this).attr('type')+"_"+$(this).attr('id')+"_"+$(this).attr('required')+"_"+$(this).is(":checked"));
            alert($(this).attr('title') + "은 필수 입력사항입니다.");
            focus.focus();
            return false;
            // 여기서는 each문을 탈출
            //return false;
          }
        });
        // 필수입력사항에 누락이 있으면 진행금지
        if (!bEmpty) return;

         $("#form_set").submit();

         $('#post_project_info').hide();
         alert('최종 제출 중입니다. 잠시만 기다려주세요.');
      }
  }

  function apply_back_page(page_num){
    var page_num = page_num*1;
    var back_page = page_num-1;
    var now_domain = '<?echo $domain;?>';
    var target_u_secur = '<?echo $target_u_secur;?>';
    if(target_u_secur!=""){
      target_u_secur_txt = '&u_secur='+target_u_secur;
    }else{
      target_u_secur_txt = '';
    }
    //alert(back_page);
    location.href = '/apl/'+now_domain+'?page_num='+back_page+target_u_secur_txt;
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
$intro_url = $this->config->item('intro_url');
?>
<style type="text/css">

</style>
    <form id="form_set"  method="post" action="/apply/save_apply_info">
        <input id='w_num' name='w_num' type='hidden' value='<?if(isset($w_num)) echo $w_num;?>'/>
        <input type="hidden" name="domain" value="<?echo $domain;?>"/>
        <input type="hidden" name="page_num" value="<?echo $page_num;?>"/>
        <input type="hidden" name="last_page_num" value="<?echo $last_page_num;?>"/>
        <input type="hidden" name="target_u_id" value="<?echo $target_u_id;?>"/>
    <?
    //div는 10개까지지만.. graph 출력위치가 11까지라서 11로..
    if(isset($form_set_info)){
          //print_r($form_set_info);
           //input type 비교를 위해 배열로 구성
          $input_type_array = array('text', 'textarea', 'page_branch', 'radio','select','checkbox','upload','date','agree');
          foreach ($form_set_info as $form_set_infos)
            {
            //print_r($form_set_infos);
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
                <?if($field_type=="page_branch"){?>
                <h3 id='con<?echo $key;?>_title' class='con_titles'><?echo $display_name;?></h3>
                <?}else{?>
                <h5 id='con<?echo $key;?>_title' class='con_titles'><?echo $display_name;?></h5>
                <?}?>
                <div id='con<?echo $key;?>_txt'>
                   <!--본문 내용 출력
                   key : <?echo $key;?><br/>
                   item_id : <?echo $item_id;?><br/>
                   field_type : <?echo $field_type;?><br/>
                   options : <?echo $options;?><br/>
                   use : <?echo $use;?><br/>
                   memo : <?echo $memo;?><br/>
                   item_value : <?echo $item_value;?><br/>
                   -->
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
                          <div style='width: 100%; float: left; padding-top: 0px; text-align: center;'>
                            <?echo $memo;?>
                          </div>
                          <?
                          }?>
                        <?
                        }else if($field_type=="text"){
                         ?>
                                <div class='t_basic' style='width: 100%; float: left; padding-top: 0px;'>
                                  <?echo $memo;?>
                                </div>
                                <input type='text' name="item_value[]"  id="<?=$item_id;?>" value="<?=$item_value;?>" tabindex='<?echo $key;?>' <?if($use==1){echo 'required';}?> title="<?echo $display_name;?>"/>
                                <?if(isset($memo)&&$memo!=''){
                                 ?>
                                <?
                                }?>
                        <?
                         }else if($field_type=="textarea"){
                        ?>
                                <div class='t_basic' style='width: 100%; float: left; padding-top: 0px;'>
                                  <?echo $memo;?><br/>
                                </div>
                                 <textarea name="item_value[]"  id="<?=$item_id;?>"  cols="10" rows="5"  tabindex='<?echo $key;?>' <?if($use==1){echo 'required';}?>  title="<?echo $display_name;?>"><?=$item_value;?></textarea>
                                <b>글자수</b><span id="<?=$item_id;?>_txt_leng">0</span>
                                 <?if(isset($memo)&&$memo!=''){
                                 ?>
                                 
                                <?
                                }?>

                                
                                <script>
                                //초기값이 있으면 글자수 세기
                                var now_con = $('#<?=$item_id;?>').val();
                                var now_con_len = now_con.length;
                                var target_area = '#<?=$item_id;?>_txt_leng';
                                $(target_area).html(now_con_len);    
                                //글자수 세기
                                 $('#<?=$item_id;?>').keyup(function (e){
                                     now_con = $(this).val();
                                     now_con_len = now_con.length;
                                     target_area = '#<?=$item_id;?>_txt_leng';
                                    //글자수 실시간 카운팅
                                    $(target_area).html(now_con_len);    
                                    //alert($('#<?=$item_id;?>_txt_leng').html());
                                  });
                                 </script>
                        <?
                        }else if($field_type=="radio"){
                        ?>
                            <div style="width: 100%; float: left;">
                              <input type="hidden" id="<?=$item_id.'_result';?>" name="item_value[]" value="<?=$item_value;?>" />
                              <?if(isset($memo)&&$memo!=''){
                               ?>
                              <div style='width: 100%; float: left; padding-top: 0px;'>
                                <?echo $memo;?>
                              </div>
                              <?
                              }?>
                            <? 
                                $i=1;
                                foreach($config_option as $options_item){
                                    if($options_item==$item_value){
                                        $check_checked = 'checked';
                                    }else{
                                        $check_checked = '';
                                    }
                              ?>
                               <input type="radio" name="<?=$item_id;?>"  id="<?=$item_id.'_'.$i;?>" value="<?=$options_item;?>"  title="<?echo $display_name;?>" onclick='radio_select_state("<?=$item_id;?>","<?=$item_id.'_'.$i;?>");' <?if($use==1){echo 'required';}?> <?echo $check_checked;?> tabindex='<?echo $key;?>'/><label for='<?=$item_id.'_'.$i;?>'><?=$options_item;?></label> 
                               
                               <br/>
                             <?
                                $i++;
                              }?>
                              </div>
                        <?
                        }else if($field_type=="select"){
                        ?>
                              <?if(isset($memo)&&$memo!=''){
                               ?>
                              <div class='t_basic' style='width: 100%; float: left; padding-top: 0px;'>
                                <?echo $memo;?>
                              </div>
                              <?
                              }?>
                            <select name="item_value[]" id="<?=$item_id;?>" t<?if($use==1){echo 'required';}?>  title="<?echo $display_name;?>" tabindex='<?echo $key;?>' style='width: 100%;'>
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
                               <option value="<?=$options_item;?>" <?echo $check_checked;?>><?=$options_item;?> </option>
                             <?
                                $i++;
                              }?>
                             </select>
                             
                        <?
                        }else if($field_type=="checkbox"){
                        ?>
                            <div style="width: 100%; float: left;">
                              <?if(isset($memo)&&$memo!=''){
                               ?>
                              <div class='t_basic' style='width: 100%; float: left; padding-top: 0px;'>
                                <?echo $memo;?>
                              </div>
                              <?
                              }?>
                            <? 
                                $i=1;
                                foreach($config_option as $options_item){
                                    if($options_item==$item_value){
                                        $check_checked = 'checked';
                                    }else{
                                        $check_checked = '';
                                    }
                                    if($i==1){
                                      $first_item = $options_item;
                                    }
                              ?>
                              <input type="checkbox" id="<?=$item_id.'_'.$i;?>" class="<?=$item_id;?>" <?if($use==1){echo 'required';}?>  title="<?echo $display_name;?>" onclick='check_box_state("<?=$item_id;?>","<?=$item_id.'_'.$i;?>","<?=$options_item;?>");' name="checkbox_con_<?=$item_id;?>" value="<?=$options_item;?>" tabindex='<?echo $key;?>' <?echo $check_checked;?>/><label for='<?=$item_id.'_'.$i;?>'><?=$options_item;?></label> 
                              <br/>
                             <?
                                $i++;
                              }?>
                              <input type="hidden" id="<?=$item_id.'_result';?>"  <?if($use==1){echo 'required';}?> name="item_value[]" value="<?=$item_value;?>"  title="<?echo $display_name;?>" />
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
                                 window.onload=function(){
                                       //기존 입력값이 있을 경우 필수입력 정보 확인 및 해제
                                       check_box_state("<?=$item_id;?>","<?=$item_id.'_1';?>","<?echo $first_item;?>");

                                };
                                </script>
                                <?
                                }
                              ?>
                               
                              </div>

                        <?
                        }else if($field_type=="upload"){
                        ?>
                            <?if(isset($memo)&&$memo!=''){
                            ?>
                            <div class='t_basic' style='width: 100%; float: left; padding-top: 0px;'>
                            <?echo $memo;?>
                            </div>
                            <?
                            }?>
                            <br/>
                            <input id='<?=$item_id;?>' name="item_value[]"  type='text' placeholder='업로드할 파일을 선택해주세요.'  title="<?echo $display_name;?>" <?if($use==1){echo 'required';}?> value='<?=$item_value;?>' readonly/>
                             
                            <?if(isset($item_value)&&$item_value!=''){
                            ?>
                            <div id='<?=$item_id;?>_down_area' style='width:100%; display: none;'>
                                <a href="<?if(isset($item_value)) echo $item_value;?>" target="_blank">첨부 파일 보기</a>
                            </div>
                            <?
                            }?>
                            <button id='<?=$item_id;?>_img_upload' onclick='upload_file("<?=$w_num;?>","<?=$item_id;?>");'class='btn btn-inverse' type='button' tabindex='<?echo $key;?>'>
                                <img src='/img/icon/icon_img_w.png' style='width:16px; margin-right: 5px;' valign='middle' alt="upload image button" />업로드
                            </button>
                            <button id="<?=$item_id;?>_bt_file_delete" onclick='delete_file("<?=$w_num;?>","<?=$item_id;?>");' style="display: none"  type='button' class="btn btn-inverse">삭제</button><br/>
                            <?
                            if($item_value!=''){
                                ?>
                                <script>
                                    $('#<?=$item_id;?>_down_area').show();
                                    //$('#<?=$item_id;?>_img_upload').hide();
                                    $('#<?=$item_id;?>_bt_file_delete').show();
                                    $('#<?=$item_id;?>_img_upload').hide();
                                </script>
                                <?
                            }
                            ?>
                        <?
                        }else if($field_type=="date"){
                        ?>
                              <div class='t_basic' style='width: 100%; float: left; padding-top: 0px;'>
                                <?echo $memo;?>
                              </div>
                              
                              <input id='<?=$item_id;?>' name="item_value[]" type='text' placeholder='날짜를 선택해주세요.'  title="<?echo $display_name;?>" <?if($use==1){echo 'required';}?> value='<?=$item_value;?>' tabindex='<?echo $key;?>' autocomplete="off" <?/*readonly*/?>/>
                              
                              <div class='t_basic' style='width: 100%; float: left; padding-top: 0px;'>
                                예: 2020-05-12
                              </div>
                               <script>
                                    $.datepicker.setDefaults( $.datepicker.regional[ "ko" ] );
                                    $("#<?=$item_id;?>").datepicker({
                                        showMonthAfterYear: true , // 월, 년순의 셀렉트 박스를 년,월 순으로 바꿔준다. 
                                        dayNamesMin: ['일','월', '화', '수', '목', '금', '토'], // 요일의 한글 형식.
                                         nextText: '다음 달',
                                         prevText: '이전 달', 
                                        monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'], 
                                        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'], // 월의 한글 형식
                                        yearSuffix: '년',
                                        dateFormat: "yy-mm-dd",  // 데이터 포멧 , 20120905 형식 
                                        beforeShow: function(input) {
                                            var i_offset = jQuery(input).offset();      // 클릭된 input의 위치값 체크
                                            setTimeout(function(){
                                                $('#ui-datepicker-div').css({'top':i_offset.top+30, 'bottom':''});  
                                                // datepicker의 div의 포지션을 강제로 클릭한 input 위취로 이동시킨다.

                                            })
                                        }
                                    });
                                 </script>
                                 <?if(isset($memo)&&$memo!=''){
                                 ?>
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
                                <input type='checkbox' id="<?=$item_id;?>" name="<?=$item_id;?>" tabindex='<?echo $key;?>'  title="<?echo $display_name;?>" onclick='agree_box_state("<?=$item_id;?>");' <?if($use==1){echo 'required';}?> <?if($item_value==true){echo "checked";}?>/><label for='<?=$item_id;?>'>동의합니다.</label> 
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
                  <?
                    $admin = $this->input->get_post("admin");
                    if($can_edit=='y'&&$admin){
                        echo '<div style="float: left; width: 100%; font-size: 12px;  margin-top: 10px; padding-top:5px;">
                        <img src="/img/icon/icon_set.png" style="width:16px; height: 16px; min-width: 16px; min-height: 16px;margin-right: 5px;"/>
                        <a href="javascript:edit_con('.$item_id.');">수정</a><br/></div>';
                    
                  }?>
                </div>
            </div>
            <!--설문 콘텐츠 출력 끝-->
  <?
     }
  }
  ?>
  <?
  if($last_page_num==$page_num){
  ?>
      <!--signature 관련 시작 -->
      <link href="/assets/signature_pad/assets/jquery.signaturepad.css" rel="stylesheet">
      <!--[if lt IE 9]><script src="/assets/signature_pad/assets/flashcanvas.js"></script><![endif]-->
      <!--signature 관련 끝-->
    <div id='signature_area' style="padding-top: 15px; text-align: center; margin-bottom: 30px;">
      <div style="padding-top: 15px; text-align: center; margin-bottom: 15px;">
        제출내용은 공고사업 통합관리솔루션 Ⓖwon과<br/>
        <?echo $title;?> 담당자에게 제공되어 활용될 수 있습니다.
       </div>
      <div class="sigPad">
          <ul class="sigNav">
            <li class="drawIt"><a href="#draw-it" >서명</a></li>
            <li id="sig_clear" class="clearButton"><a href="#clear">Clear</a></li>

          </ul>
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
          //서명 영역 불러오기
          $('.sigPad').signaturePad({drawOnly:true});

          $( '#sig_clear' ).click( function() {
            // function
            //$('#sig_info').attr("value","");
          } );

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

     <div id='bt_area' class="con_area_div" style="text-align: center; margin-bottom: 10px;">
          <?
          if(isset($page_num)&&$page_num!=1){
          ?>
            <button id='post_project_info' type="button" onClick='apply_back_page(<?echo $page_num;?>);' class='btn btn-default' style='float: left;'>
              <이전 
          </button>
          <?
          }?>
        <button id='post_project_info' type="button" onClick='save_apply_info();' class='btn btn-info' style='float: right;'>
            최종 제출하기
        </button>
     </div>
    <?
    }else{
    ?>
     <div id='bt_area' class="con_area_div" style="text-align: center; margin-bottom: 10px;">
          <?
          if(isset($page_num)&&$page_num!=1){
          ?>
            <button id='post_project_info' type="button" onClick='apply_back_page(<?echo $page_num;?>);' class='btn btn-default' style='float: left;'>
              <이전 
          </button>
          <?
          }?>
        <button id='post_project_info' type='submit' class='btn btn-info' style='float: right;'>
            다음
        </button>
     </div>
    <?
    }
    ?>
    
      
 </form>
  
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
            //필수 입력여부 체크하기
            var now_required = $(id_item_result).attr("required");

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

            var now_check_result = $(id_item_result).val();
              if(now_required=="required" && now_check_result!=""){
                //필수입력인데, 기록된 값이 있으면.. 체크박스의 리퀴드값 해제
                $(class_item_id).each(function() {
                  $(this).attr('required',false);
                });
              }else if(now_required=="required" && now_check_result==""){
                //필수입력인데, 기록된 값이 없으면..리퀴드값 복구
                $(class_item_id).each(function() {
                  $(this).attr('required',true);
                });
              }
        }

        //사용자 동의
        function agree_box_state(item_id){
            var id_item_result = '#'+item_id+'_result';
            var item_id = '#'+item_id;
            var now_checked = $(item_id).is(':checked');
            $(id_item_result).val(now_checked);

        }


        //사용자 동의
        function radio_select_state(item_id,item_selected){
            var id_item_result = '#'+item_id+'_result';
            var item_id = '#'+item_selected;
            var now_checked = $(item_id).val();
            $(id_item_result).val(now_checked);

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

