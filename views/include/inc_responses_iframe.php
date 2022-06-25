<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?$this->load->view('/include/head_info');?>
    <style>
    .inno_table tr td{
        min-width: 100px;
    }
    body{
      margin: 0px;
      padding: 5px;
    }
  </style>
</head>
<body>
  <?
   if($open_type=='blank'){
    echo '<h1>"'.$title.'"의 최종접수내역</h1>';
   }
  ?>
  <?include_once $this->config->item('basic_url')."/include/inc_responses_table.php";?>
</body>
</html>