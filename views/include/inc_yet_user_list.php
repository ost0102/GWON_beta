<div id="inc_eval_table_con">
    <form id="form_set"  method="post" action="/evaluate/save_eval_info">
        <b>작성중인 사용자 리스트</b><br/>
        <input id='w_num' name='w_num' type='hidden' value='<?if(isset($w_num)) echo $w_num;?>'/>

        <table class="inno_table">
    <?
      //새창에서 열었을 때는 전체 내용이 나오게
       
       if(isset($user_list)){
        //배열 순서 변경
        foreach ((array) $user_list as $key => $value) {
          $sort[$key] = $value['total_user_insert_data'];
        }

        array_multisort($sort, SORT_DESC, $user_list);

        echo "<tr><td>작성자</td><td>이메일</td><td>작성 수</td>";
        foreach ($user_list as $user_item)
            {
            //print_r($user_item);
            $w_num = $user_item['w_num'];
            $id_secur = $user_item['id_secur'];
            $user_id = $user_item['user_id'];
            $email = $user_item['email'];
            $username = $user_item['username'];
            $total_user_insert_data = $user_item['total_user_insert_data'];
            $date = $user_item['date'];
            $date = date("m/d", strtotime($date));

            ?>
            <tr>
              <td>
                <?echo $username;?>
              </td>
              <td>
                <?echo $email;?>
              </td>
              <td>
                <?echo $total_user_insert_data;?>
              </td>
           </tr>
            <?
            }
            echo "</table>";
       }
        
      ?>
      
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