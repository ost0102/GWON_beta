<div id="dashboard_menu">
    <a href='/mypage/page_detail/<?echo $page_secur;?>' target='_self'>인사이트</a> | 
    <a href='/mypage/response/<?echo $page_secur;?>' target='_self'>응답</a>]
    <a href='/evaluate/evaluation_set/<?echo $page_secur;?>' target='_self'>평가/선정</a>
</div>
<?
if(isset($now_page)){
  if($now_page=='response'||$now_page=='resp_detail'){
?>

<div id="dashboard_menu_sub">
  <a href='/mypage/response/<?echo $page_secur;?>' target='_self'>요약</a> | 
  <a href='/mypage/resp_detail/<?echo $page_secur;?>' target='_self'>상세보기</a>
</div>
<?
  }else if($now_page=='evaluation_set'||$now_page=='evaluation_set_detail'||$now_page=='evaluation_list'){
?>
<div id="dashboard_menu_sub">
  <a href='/evaluate/evaluation_set/<?echo $page_secur;?>' target='_self'>단계 설정</a> | 
  <a href='/evaluate/evaluation_set_detail/<?echo $page_secur;?>' target='_self'>세부 설정</a> | 
  <a href='/evaluate/eval_list/<?echo $page_secur;?>' target='_self'>평가/선정</a>
</div>
<?
  }
?>
<?
  }
?>
<style>
@media ( min-width: 600px ) {
  #workspace_container{
    margin-top: 130px;
  }
}
  
</style>
