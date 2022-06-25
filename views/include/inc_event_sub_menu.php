<!--참여기관 왼쪽 메뉴-->
<script type="text/javascript">
        $(document).ready(function() {
            check_event_count();
            check_team_count();
        });


        //이벤트 수 카운트
        function check_event_count(){
            /**/
            //alert(at_val);
            $.post("/new/event/check_event_count",{
            },
            function(data){
                //alert(data);
                //입력값 초기화하기
                if(data!=0){
                    $('#event_count').html(data);
                }else{
                    $('#event_count').hide();
                }
                
                //if(data =="등록이 완료되었습니다."){}
            }); 

        }

        //팀 개수 카운트
        function check_team_count(){
            /**/
            //alert(at_val);
            $.post("/new/event/check_team_count",{
            },
            function(data){
                //alert(data);
                //입력값 초기화하기
                if(data!=0){
                    $('#team_count').html(data);
                }else{
                    $('#team_count').hide();
                }
                
                //if(data =="등록이 완료되었습니다."){}
            }); 

        }
</script>   
<div class='submenu_list'>

	<h3 class='main_con_title'>
		기관 정보
	</h3>
	
	<div class='submenu_list_con'>
		<a href='/new/event'>
			기관 정보 <span id='team_count' class="badge"></span>
		</a>
	</div>
	<div class='submenu_list_con'>
		<a href='/new/team/event_list'>
			이벤트 <span id='event_count' class="badge"></span>
		</a>
	</div>
	<!--
	<div class='submenu_list_con'>
		<a href='/new/event'>
			기부 쿠폰 <span class="badge">0</span>
		</a>
	</div>
-->

    <br/>
    <a href="/new/event/make_team">
        <button type="button" class="btn btn-info btn-block">
            기관 정보 등록하기
        </button>
    </a>
	
</div>