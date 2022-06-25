<script type="text/javascript">
$(document).ready(function() {	
	//사용자 정보 가져오기
    $('#gwon_title_search').keyup(function(e){
    	//alert('test');
    	var gwon_title = $('#gwon_title_search').val();
        $.post('/admin/check_gwon_title/',{
        	 gwon_title: gwon_title,
            },
            function(data){
                //alert(data);
                //입력값 초기화하기
                //open_modal(data);
                if(data!==''){
	        		$('#gwon_title_search_query_result').show();
	                       $('#gwon_title_search_query_result').html(data);
	      		}else{
	      			$('#gwon_title_search_query_result').hide();
	      			$('#gwon_title_search_query_result').html(data);
	      		}
                
            });
    });
});
</script>
<input id="gwon_title_search" name="gwon_title_search" tabindex="3" class="focus_area" type="text" onblur="if (this.value.length==0) {this.className='focus_area';}else {this.className='focus_area';}" /><br/>
<div id='gwon_title_search_query_result' style='display: none;'></div>
<div id='co_authors_backup' style='display: none;'></div>
<span id='co_authors_scription' class='t_basic' style='font-size: 11px; padding-top:0px;'><br/></span>
<input id="co_authors_result" name="co_authors_result" tabindex="3" class="focus_area" type="hidden" onblur="if (this.value.length==0) {this.className='focus_area';}else {this.className='focus_area';}" /><br/>