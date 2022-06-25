<div id="inc_responses_con_area">
    <?
      //새창에서 열었을 때는 전체 내용이 나오게
       
       $form_set_title = array();
       $field_type_arr = array();
       if(isset($form_set_info)){
        foreach ($form_set_info as $form_info)
        {
          //print_r($form_info);
          $key = $form_info['key'];
          $item_id = $form_info['item_id'];
          $display_name = $form_info['display_name'];
          $field_type = $form_info['field_type'];
          //항목별 이름 배열로 만들기
          $form_set_title[$key] = $display_name;
          $field_type_arr[$key] = $field_type;
        }
       }
        
      ?>
      <?
       if(isset($form_user_info)){
        if($form_user_info!=0){
          foreach ($form_user_info as $fuser_info_arr)
          {
            $count_num = 0;
              echo '<div class="inc_resp_con">';
              foreach ($fuser_info_arr as $fuser_info)
              {
                
                
                $key = $fuser_info['key'];
                $item_id = $fuser_info['item_id'];
                $item_value = $fuser_info['item_value'];
                //문자열 변경(다중 선택이 있을 경우)
                $item_value  = str_replace("#PH#", ",", $item_value); 
                $id_secur = $fuser_info['id_secur'];
                $username = $fuser_info['username'];
                $user_id = $fuser_info['user_id'];
                $date = $fuser_info['date'];
                $item_title = $form_set_title[$key];
                $field_type = $field_type_arr[$key];
                
                
                if($key ==1){
                   //print_r($fuser_info_arr);
                  echo "<b>작성자</b> ";
                  echo $username."<br/>";
                  echo "<b>등록일</b> ".$date."<br/>";

                
                  if($field_type!='page_branch'){
                    echo "<b>".$key.") ".$item_title."</b><br/>".$item_value."<br/>";
                  }
                }else{
                  if($field_type!='page_branch'){
                    if(strpos($item_value, '/uploads/') !== false) {

                        $download_url= "/mypage/download/".  my_simple_crypt($item_value);
                      echo "<hr/><b>".$key.") ".$item_title."</b><br/><a href='".$download_url."' target='_blank'>".$item_value."</a><br/>";
                    }else if(is_numeric($item_value)){
                      //입력값이 숫자인경우 나중에 넘버포맷을 어떻게 쓰면 될지 고민하기
                       echo "<hr/><b>".$key.") ".$item_title."</b><br/>".$item_value."<br/>";
                      /*
                      if (strpos("총 신청금액 시설비 사업개발비 운영비 매출액 자본총계 부채총계 영업이익 영업손실",$item_title)){
                          //echo "문자열이 존재함";
                          echo "<hr/><b>".$key.") ".$item_title."</b><br/>".number_format($item_value)."<br/>";
                      }else{
                          echo "<hr/><b>".$key.") ".$item_title."</b><br/>".$item_value."<br/>";
                      }*/
                    }else{
                      if($field_type=='textarea'){
                        echo "<hr/><b>".$key.") ".$item_title."</b><br/><pre>".$item_value."</pre><br/>";
                      }else{
                        echo "<hr/><b>".$key.") ".$item_title."</b><br/>".$item_value."<br/>";
                      }
                    }
                  }else{
                    echo "<hr/><br/>-----페이지 구분-----<b><br/>".$key.") ".$item_title."</b><br/>입력받지 않음<br/>";
                  }
                }
              }
              ?>
              <?
              if(isset($button_show)){
                if($button_show=='show'){
                  $button_show = "show";
                }else{
                  $button_show = "hidden";
                }
              }else{
                $button_show = "show";
              }

              if($button_show=='show'){
              ?>
            <table style="width: 100%; margin-top: 10px;">
              <tr>
                <td style='width: 50%;'>
                  <?if($type!="reject"){
                    ?>
                  <a href='javascript:reject_apply("<?echo $target_user_id;?>");'>
                    <img src='/img/icon/icon_x.png' style='margin-right: 5px; width: 15px;'/>접수정보 배제
                  </a>
                    <?
                  }
                  ?>
                </td>
                <td style='text-align: right; '>
                  <?if($type!="reject"){
                    ?>
                  <?
                  echo '<a href="/apl/'.$campaign_info["domain"].'?page_num=1&u_secur='.$target_user_secur.'" target="_blank">
                    <button id="edit_info" class="btn btn-info" >
                      접수정보 수정
                    </button></a>';

                  ?>
                    <?
                  }else{
                    ?>
                    <a href='javascript:restore_apply("<?echo $target_user_id;?>");'>
                      <button id="edit_info" class="btn btn-info" >
                        접수정보 재등록
                      </button>
                    </a>
                    <?
                  }
                    ?>
                  
                </td>
              </tr>
            </table>
            
              <?
                }else{
                }
              ?>
              <?
                echo '</div>';
                //print_r($campaign_info);
          }
        }else{
          echo '접수된 내용이 없습니다.';
        }
          
       }
          
        
    ?>
</div>