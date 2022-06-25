<!--전체 접수 정보 엑셀다운로드. 시간 오래걸림-->
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
             //print_r($fuser_info_arr);
            echo '<tr>';
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
              $field_type = $fuser_info['field_type'];

              if($key ==1){
                   //print_r($fuser_info_arr);
                  echo "<td>".$username."</td>";
                  if($field_type!='page_branch'){
                    echo "<td>".$item_value."</td>";
                  }
                }else{
                  if($field_type!='page_branch'){
                    echo "<td>".$item_value."</td>";
                  }
                }
            }
            echo "<td>".$date."</td>";
            echo '</tr>';
        }

      //print_r($form_user_info);
    ?>
</table>