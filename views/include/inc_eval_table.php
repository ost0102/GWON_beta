<div id="inc_eval_table_con">
    <form id="form_set"  method="post" action="/evaluate/save_eval_info">
        <b>평가표</b><br/>
        평가 대상 : <?echo $target_user_info['username'];?><hr/>
        <input id='w_num' name='eval_w_num' type='hidden' value='<?if(isset($w_num)) echo $w_num;?>'/>
        <input type="hidden" name="eval_user" value="<?echo $eval_user;?>"/>
        <input type="hidden" name="eval_step" value="<?echo $eval_step;?>"/>
        <input type="hidden" name="target_user" value="<?echo $target_user;?>"/>
    <?
      //새창에서 열었을 때는 전체 내용이 나오게
       
       $input_type_array = array('text', 'textarea', 'radio','select','checkbox','upload','date');
       if(isset($eval_table_info)){
        foreach ($eval_table_info as $form_set_infos)
            {
            //print_r($form_set_infos);
            $w_num = $form_set_infos['w_num'];
            $key = $form_set_infos['key'];
            $item_id = $form_set_infos['item_id'];
            $display_name = $form_set_infos['display_name'];
            $field_type = $form_set_infos['field_type'];
            $options = $form_set_infos['options'];
            $score = $form_set_infos['score'];
            $memo = $form_set_infos['memo'];
            $date = $form_set_infos['date'];
            $item_value = $form_set_infos['item_value'];
            $comment = $form_set_infos['comment'];

            $options_preg = preg_replace('/\r\n|\r|\n/','#PH#',$options);
            $config_option = explode('#PH#', $options_preg);
            ?>
                        <!--설문 콘텐츠 출력 시작-->
            <div id='con_con<?echo $key;?>' class='con_area_div'>
                <h3 id='con<?echo $key;?>_title' class='con_titles'><?echo $display_name;?></h3>
                <span class="t_say">
                <?echo $memo;?>
                </span>
                <br/>
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
                   <b>점수(<? echo $score ;?> 점 이내)</b><br/>
                   <?
                   if($options!=""){
                    $input_visible="hidden";
                    $options_arr = explode(",",$options);
                    $i=1;
                    foreach ($options_arr as $options_info) {
                      if($item_value==$options_info){
                        $now_selected = "checked";
                      }else{
                        $now_selected = "";
                      }
                      if($options_info<=$score){
                        echo "<input type='radio' ".$now_selected ." name='item_radio_".$item_id."[]' id='".$item_id."_".$i."' onclick='select_num(\"".$item_id."_number\",\"".$options_info."\");' ><label for='".$item_id."_".$i."'>".$options_info."</label> ";
                        $i++;
                      }
                      
                    }
                   }else{
                    $input_visible="number";
                   }
                   ?>
                   <input type='<?echo $input_visible;?>' name="item_value[]"  id="<?=$item_id;?>_number" min="0" max="<?echo $score ;?>" value="<?=$item_value;?>" tabindex='<?echo $key;?>' />
                   <br/>
                   <b>평가 의견</b><br/>
                   <textarea type='text' name="comment[]"  id="<?=$item_id;?>" tabindex='<?echo $key;?>' placeholder="평가의견이 있으시다면 남겨주세요."><?=$comment;?></textarea><hr/>
                </div>
            </div>
            <!--설문 콘텐츠 출력 끝-->
            <?
            }
       }
        
      ?>
      <div id='bt_area' class="con_area_div" style="width: 100%; text-align: center; margin-top: 10px; margin-bottom: 10px;">
        <button id='post_project_info' onClick='save_eval_info();' class='btn btn-info'>
            <img src='/img/icon/icon_save_w.png' style='width:16px; margin-right: 5px;' valign='middle' alt="icon" />저장하기
        </button>
     </div>
     </form>
</div>
<script>
//평가 정보 저장하기
    function save_eval_info(){
        //alert('test');
        
        var w_num = $('input[name=eval_w_num]').val();
        var eval_user = $('input[name=eval_user]').val();
        var eval_step = $('input[name=eval_step]').val();
        var target_user = $('input[name=target_user]').val();
        
        if(w_num==""||eval_step==""||target_user==""){
            alert("평가 정보를 확인할 수 없습니다. 새로고침 해주세요.");
        }else{
            //$("#form_eva_step").submit();
           /*
           //$("#form_eva_step").submit();
           $.post('/mypage/save_evaluation_set/',{
                            w_num: w_num,
                            page_secur: page_secur,
                            key: key,
                            display_name: display_name,
                            field_type: field_type

                        },
                        function(data){
                            alert(data);
                              //$("#form_set").submit();
                        });
                        */
        }
    }

    //점수 입력하기
    function select_num(target, value){
      var target_id = "#"+target;
      $(target_id).val(value);
    }
</script>