<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width"/>
	<style type='text/css'>
  /**********************************************
  * Ink v1.0.5 - Copyright 2013 ZURB Inc        *
  **********************************************/

  /* Client-specific Styles & Reset */
  /*기본 스타일 영역 시작*/
  #outlook a { 
    padding:0; 
  } 

  body{ 
    width:100% !important; 
    min-width: 100%;
    -webkit-text-size-adjust:100%; 
    -ms-text-size-adjust:100%; 
    margin:0; 
    padding:0;
  }
  .im{
    color: #000;
  }

  .ExternalClass { 
    width:100%;
  } 

  .ExternalClass, 
  .ExternalClass p, 
  .ExternalClass span, 
  .ExternalClass font, 
  .ExternalClass td, 
  .ExternalClass div { 
    line-height: 100%; 
  } 

  #backgroundTable { 
    margin:0; 
    padding:0; 
    width:100% !important; 
    line-height: 100% !important; 
  }

  img { 
    outline:none; 
    text-decoration:none; 
    -ms-interpolation-mode: bicubic;
    width: auto;
    max-width: 100%; 
    clear: both; 
    /*float: left; 
    
    display: block;*/
  }

  center {
    width: 100%;
    min-width: 580px;
  }

  a img { 
    border: none;
  }
  p.lead, p.lede, p.leed {
    font-size: 18px;
    line-height:21px;
  }
  p {
    margin: 0 0 0 10px;
  }

  table {
    border-spacing: 0;
    border-collapse: collapse;
  }

  td { 
    word-break: break-word;
    -webkit-hyphens: auto;
    -moz-hyphens: auto;
    hyphens: auto;
    border-collapse: collapse !important; 
  }

  table, tr, td {
    padding: 0;
    vertical-align: top;
    text-align: left;
  }

  hr {
    color: #d9d9d9; 
    background-color: #d9d9d9; 
    height: 1px; 
    border: none;
  }
  
  /* Responsive Grid */
  /* Block Grid */

  h1,
  h2,
  h3,
  h4,
  h5,
  h6 {
    text-align: center;
  }

  /* Typography */

  body, table.body, h1, h2, h3, h4, h5, h6, p, td { 
    color: #222222;
    font-family: "Nanum Gothic", "Helvetica", "Arial", "Gothic", sans-serif; 
    font-weight: normal; 
    padding:0; 
    margin: 0;
    text-align: left; 
    line-height: 1.3;
  }

  h1, h2, h3, h4, h5, h6 {
    word-break: normal;
  }

  h1 {font-size: 40px;}
  h2 {font-size: 36px;}
  h3 {font-size: 32px;}
  h4 {font-size: 28px;}
  h5 {font-size: 24px;}
  h6 {font-size: 20px;}
  body, table.body, p, td {font-size: 14px;line-height:19px;}

  p { 
    margin-bottom: 10px;
  }

  a {
    color: #2ba6cb; 
    text-decoration: none;
  }

  a:hover { 
    color: #2795b6 !important;
  }

  a:active { 
    color: #2795b6 !important;
  }

  a:visited { 
    color: #2ba6cb !important;
  }

  h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
    color: #2ba6cb;
  }

  h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active { 
    color: #2ba6cb !important; 
  } 

  h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited { 
    color: #2ba6cb !important; 
  } 

  
  /*기본 스타일 영역 끝*/
  /* Outlook First */

  body.outlook p {
    display: inline !important;
  }

    /*easymenu layout*/
    #mail_container{
      width: 600px;
    }
    #logo_area{
      width: 100%;
    }
    #logo_area img{
    }
    #bottom_area{
      width: 100%;
    }
    #ipg_table{
      width:600px; 
    }

  </style>
  <style type='text/css'>
     
    /*  Media Queries */
    /*600 이하 모바일에서 보일 부분*/
    @media only screen and (max-width: 600px) {
      /*easymenu layout*/
      #mail_container{
        width: 90%;
      }
      #logo_area{
        width: 100%;
      }
      #bottom_area{
        width: 100%;
      }
      #ipg_table{
        width: 90%; 
        
      }
      #logo_area img{
        width: 125px;
      }
      
    }

    
	</style>
</head>
<body>
  <table  id="ipg_table" cellspacing="0" cellpadding="0" align="center" style="margin-left: auto; margin-right: auto; margin-top: 10px; border-collapse:collapse; background-color:#ffffff;" border="0">
    <tbody>
      <tr>
        <td>
          <div id="mail_container" style="margin-left: auto; margin-right: auto;">
          <!--logo area start -->
          <div id="logo_area" style="padding-top: 20px; padding-bottom: 20px; border-bottom: 1px solid #cdcdcd; text-align: center;">
            <? if(isset($cam_logo)){
              ?>
               <img src="<?=$this->config->item('base_url');?><?echo $cam_logo;?>" title="gwon logo"/>
              <?
              }else{
              ?>
               <img src="<?=$this->config->item('base_url');?>/img/logo.png" title="gwon logo"/>
              <?
              }  
              ?>
            
           
          </div>
          <!--logo area finish -->
          <!--contents area start -->
          <div id="ipg_con_area" style="width: 90%; margin-top: 10px; background: #efefef; padding-top: 15px; padding-bottom: 15px; padding-left: 5%; padding-right: 5%;">
            <h1><? if(isset($title)) echo $title;?></h1>
            <? if(isset($username)){
              ?>
              <p class="lead">
            <?
            echo $username;
            if(isset($user_email)) echo ' ('.$user_email.')';
            ?>
            </p>
            <?
            } ?> 
            <p><? if(isset($mail_con)) echo $mail_con;?></p>
            <p><? if(isset($date_time)) echo $date_time;?></p>
          </div>
          <!--contents area finish -->
          <!--bottom area start -->
          <div id="bottom_area" style="border-top: 1px solid #cdcdcd; margin-top: 10px; padding-top: 10px; font-size: 11px; line-height: 15px;">
            이 메시지가 <? if(isset($user_email)) echo $user_email;?>에 전송되었습니다. 
            앞으로 Gwon서비스의 이메일을 받지 않으려면 <a href="<?=$this->config->item('base_url');?>/mail/stop_mail/<? if(isset($user_email)) echo $user_email;?>" target="_blank">그만 받기</a>를 누르세요.<br/>
            <a href="<?=$this->config->item('base_url');?>/" target="_blank"><?=$this->config->item('service_url');?></a>
          </div>
          <!--bottom area finish -->
        </td>
      </tr>
    </tbody>
  </table>
  </div>
</body>
</html>