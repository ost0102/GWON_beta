<h1><?echo $title;?> - 접수 정보</h1>
<?
	$base_url = $this->config->item('base_url');
?>
<a href="<?echo $base_url.'/'.$domain;?>" target="_self">
	<?echo $base_url.'/'.$domain;?></a>
<br/>
출력 날짜 : <? echo date("Y-m-d", mktime(0,0,0,date("m"), date("d"), date("Y")));?>
<br/>
<table class="inno_table">
      <?
      $page_branch_arr = array();
      $i=0;
      if($form_set_info!=''){
        echo "<tr><td>작성자</td>";
        foreach ($form_set_info as $form_info)
          {
            //print_r($form_info);
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
      }
      foreach ($form_user_info as $fuser_info_arr)
        {
            $count_num = 0;
            // print_r($form_user_info);
            echo '<tr>';
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
                    echo "<td>".$item_value."</td>";
                  }
                }

                $i++;
             }
             echo "<td>".$date."</td>";
            echo '</tr>';
        }

      //print_r($form_user_info);
    ?>
</table>