<h3>Tag 정보 </h3>
<div id='tag_backup' style='display: none; width: 100%; float: left; margin-bottom: 10px;'></div>
<script type="text/javascript">
$(document).ready(function() {  
  //사용자 정보 가져오기
    $('#input_tag').keyup(function(e){
      //alert('test');
      var keyword = $('#input_tag').val();
      if(keyword.indexOf("#") !== -1 || keyword.indexOf("@") !== -1){
        alert("#이나 @는 Tag에서 삭제됩니다.");
        var keyword = keyword.replace('#', '');
        var keyword = keyword.replace('@', '');
        $('#input_tag').val(keyword);
      }else{
        $.post('/tag/search_tag/',{
           keyword: keyword,
            },
            function(data){
                //alert(data);
                //입력값 초기화하기
                //open_modal(data);
                if(data!==''){
                  $('#tag_query_result').show();
                  $('#tag_query_result').html(data);
                }else{
                  $('#tag_query_result').hide();
                  $('#tag_query_result').html(data);
                }
            });
      }
        
    });
});
</script>
<input id="input_tag" name="input_tag" tabindex="3" class="focus_area" type="text" onblur="if (this.value.length==0) {this.className='focus_area';}else {this.className='focus_area';}" /><br/>
<div id='tag_query_result' style='display: none; width: 100%;'></div>
<span id='tag_scription' class='t_basic' style='font-size: 11px; padding-top:0px;'>적절한 태그를 추가해주세요.<br/></span>
<input id="input_tag_result" name="co_authors_result" tabindex="3" class="focus_area" type="hidden" onblur="if (this.value.length==0) {this.className='focus_area';}else {this.className='focus_area';}" /><br/>