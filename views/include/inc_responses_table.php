<table class="inno_table">
    <?
      if(!isset($open_type)){
        $open_type = '';
      }
      $page_branch_arr = array();
      $i=0;
      if($open_type=='blank'){
          //새창에서 열었을 때는 전체 내용이 나오게
         echo "<tr><td>작성자</td>";
          foreach ($form_set_info as $form_info)
          {
           // print_r($form_info);
            $key = $form_info['key'];
            $item_id = $form_info['item_id'];
            $display_name = $form_info['display_name'];
            $field_type = $form_info['field_type'];
            
            if($field_type!='page_branch'){
              echo "<td>".$display_name."</td>";
            }else{
              $page_branch_arr[$i]=$key;
              $i++;
            }
          }
          echo "<td>등록일</td>";
          echo '</tr>';
        }else{
          //iframe에서는 요약본으로 나오게
         echo "<td>작성자</td>";
         $count_num = 0;
          foreach ($form_set_info as $form_info)
          {
            //print_r($form_info);
            $field_type = $form_info['field_type'];
            
            if($field_type!='page_branch'){
              $count_num++;
            }
            
          }
          echo "<td style='width: 60%;'>항목 수 : ".$count_num."</td>";
          echo "<td style='width: 65px;'>등록일</td>";
          echo '</tr>';
        }
       
      ?>
      <?
      //새창일때
      if($open_type=='blank'){
        if($form_user_info!=0){
          foreach ($form_user_info as $fuser_info_arr)
          {
            $count_num = 0;
               //print_r($fuser_info_arr);
              echo '<tr>';
                //print_r($fuser_info_arr);

                $w_num = $fuser_info_arr['w_num'];
                $user_id = $fuser_info_arr['user_id'];
                $id_secur = $fuser_info_arr['id_secur'];
                $username = $fuser_info_arr['username'];
                $form_set = $fuser_info_arr['form_set'];
                $form_set = json_decode( $form_set );
                $form_data = $fuser_info_arr['form_data'];
                $form_data = json_decode( $form_data );
                $total_user_insert_data = $fuser_info_arr['total_user_insert_data'];
                $sig = $fuser_info_arr['sig'];
                $date = $fuser_info_arr['date'];

                $i=0;
                echo "<td>".$username."</td>";
               foreach ($form_data as $form_data_arr)
               {
                //print_r($form_data_arr);
                //print_r($form_set[$i]);
                //echo "<br/>";

                $item_value = $form_data_arr->item_value;
                //문자열 변경(다중 선택이 있을 경우)
                $item_value  = str_replace("#PH#", ",", $item_value); 
                $field_type = $form_set[$i]->field_type;
                $key = $form_set[$i]->key;
                if($key ==1){
                   //print_r($fuser_info_arr);
                  if($field_type!='page_branch'){
                    echo "<td>".$item_value."</td>";
                  }
                }else{
                  if($field_type!='page_branch'){
                    if(strpos($item_value, '/uploads/') !== false) {

                        $download_url= "/mypage/download/".  my_simple_crypt($item_value);

                      echo "<td><a href='".$download_url."' target='_blank'>".$item_value."</td>";
                    }else if(is_numeric($item_value)){
                      //입력값이 숫자형일때
                      /*//핸드폰번호 등 제외 - 개선해야함. 주민번호, 핸드폰 번호 등 오작동으로 보이니..
                      if(strpos($item_value, '010') !== false) {  
                          echo "<td>".$item_value."</td>";
                      } else {  
                          echo "<td>".number_format($item_value)."</td>";
                      }  
                      */
                      echo "<td>".$item_value."</td>";
                      
                    }else{
                      echo "<td>".$item_value."</td>";
                    }
                  }
                }
                $i++;
              }
              echo "<td>".$date."</td>";
              echo '</tr>';
          }
        }else{
          echo '접수된 내용이 없습니다.';
        }
        
      }else{
        //접수내용 요약 정보 
        if($form_user_info!=0){
          foreach ($form_user_info as $fuser_info)
          {
              //print_r($fuser_info);
              $w_num = $fuser_info['w_num'];
              $user_id = $fuser_info['user_id'];
              $username = $fuser_info['username'];
              $count_num = $fuser_info['total_user_insert_data'];
              $sig = $fuser_info['sig'];
              $date = $fuser_info['date'];
              $date = date("m/d", strtotime($date));
              $date2 = date("Y/m/d", strtotime($date));
              if($sig ==''){
                $check_finish = '작성 중';
              }else{
                $check_finish = '제출';
              }

              echo '<tr>';
              if($call_state=='iframe'){
                echo "<td>".$username."</td>";
              }else{
                if(!isset($con_type)){
                  $con_type = "";
                }
                if($con_type!="reject"){
                  echo "<td><a href='javascript:check_response_con(\"".$user_id ."\",\"".$con_type ."\");'>".$username."</a></td>";
                }else{
                  echo "<td><a href='javascript:check_response_con(\"".$user_id ."\",\"".$con_type ."\");'>".$username."</a></td>";
                }
              }
              
              echo "<td>입력 수 : ".$count_num." (".$check_finish.")</td>";
              echo "<td><span title='".$date2."'>".$date."</span></td></tr>";
          }
          
        }else{
          echo "<tr><td colspan='3' style='text-align: center;'>내용이 없습니다.</td></tr>";
        }
          
      }
        
    ?>
</table>