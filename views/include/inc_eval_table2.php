<div id="inc_eval_table_con">
    <form id="form_set"  method="post" action="/evaluate/select_eval_step">
        <b>평가 내용</b><br/>
        평가 대상 : <?echo $target_user_info['username'];?><hr/>
        <input id='w_num' name='eval_w_num' type='hidden' value='<?if(isset($w_num)) echo $w_num;?>'/>
        <input type="hidden" name="eval_step" value="<?echo $eval_step;?>"/>
        <input type="hidden" name="target_user" value="<?echo $target_user;?>"/>
        <input type="hidden" id="selected_type" name="selected_type" value="<?echo $selected_type;?>"/>
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
            $score = $form_set_infos['score'];
            $memo = $form_set_infos['memo'];
            $date = $form_set_infos['date'];
            $total_sum = $form_set_infos['total_sum'];
            $score_average = $form_set_infos['score_average'];
            $scrore_info = $form_set_infos['scrore_info'];
            $comment_info = $form_set_infos['comment_info'];

            ?>
                        <!--설문 콘텐츠 출력 시작-->
            <div id='con_con<?echo $key;?>' class='con_area_div'>
                <h3 id='con<?echo $key;?>_title' class='con_titles'><?echo $display_name;?></h3>
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
                   <b>점수(<? echo $score ;?> 점 이내) : 평균 <?echo $score_average;?></b>
                   합계 <?echo $total_sum;?><br/>
                   <hr/>
                   <b>평가 의견</b><br/>
                   <?
                   $total_com_null_check = 'y';
                   foreach ($comment_info as $comment_arr)
                    {
                      echo '<ul style="width: 100%;">';
                      if($comment_arr!=''){
                        echo '<li>'.$comment_arr.'</li>';
                        $total_com_null_check = 'n';
                      }
                    }
                    if($total_com_null_check=='y'){
                      echo '<li>작성된 평가 의견이 없습니다.</li>';
                    }

                      echo '</ul>';
                   ?>
                </div>
            </div>
            <!--설문 콘텐츠 출력 끝-->
            <?
            }
       }
        
      ?>
      <div id='bt_area' class="con_area_div" style="width: 100%; text-align: center; margin-top: 30px; margin-bottom: 10px;">
        <button id='post_project_info' onClick='select_eval_step(<?echo $selected_type;?>);' class='btn btn-info'>
            <?
            if($selected_type==1){
              echo '선정 취소';
            }else{
              echo '선정하기';
            }
            ?>
            
        </button>
     </div>
     </form>
</div>
<script>
//평가 정보 저장하기
    function select_eval_step(selected_type){
        //alert('test');
        
        var w_num = $('input[name=eval_w_num]').val();
        var eval_user = $('input[name=eval_user]').val();
        var eval_step = $('input[name=eval_step]').val();
        var target_user = $('input[name=target_user]').val();
        $('#selected_type').val(selected_type);
        
        if(w_num==""||eval_step==""||target_user==""){
            alert("평가 정보를 확인할 수 없습니다. 새로고침 해주세요.");
        }else{
            $("#form_eva_step").submit();
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
</script>