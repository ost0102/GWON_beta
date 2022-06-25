<script type="text/javascript">
$(document).ready(function() {	
	//사용자 정보 가져오기
    $('#co_authors').keyup(function(e){
    	//alert('test');
        var mail_addr = $('#co_authors').val();
        var now_page = $('#now_page').val();
        var reg_email = /^([0-9a-zA-Z_\.-]+)@([0-9a-zA-Z_-]+)(\.[0-9a-zA-Z_-]+){1,2}$/;
        if(!reg_email.test(mail_addr)) {         
            return false;         
        }else{
            //이메일 형식임      
            $.post('/team/check_mail/',{
                 mail_addr: mail_addr,
                 now_page: now_page
                },
                function(data){
                    //alert(data);
                    //입력값 초기화하기
                    //open_modal(data);
                    if(data!==''){
                        $('#co_authors_query_result').show();
                        $('#co_authors_query_result').html(data);
                    }else{
                        $('#co_authors_query_result').hide();
                        $('#co_authors_query_result').html(data);
                    }
                        
                });

        }         
            
    });
});
</script>
<div style='float: left; width: 100%;'>
    <input id="co_authors" name="co_authors" tabindex="3" class="form-control" type="text" placeholder="이메일을 입력해주세요."/>
    <div id='co_authors_query_result' style='display: none; padding-top: 10px;'></div>
    <div id='co_authors_backup' style='display: none;'></div>
    
    <input id="co_authors_result" name="co_authors_result" tabindex="3" 
    class="focus_area" type="hidden"  /><br/>
</div>