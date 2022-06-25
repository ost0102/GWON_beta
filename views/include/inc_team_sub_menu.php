<!--참여기관 왼쪽 메뉴-->
<script type="text/javascript">
        $(document).ready(function() {
            check_event_count();
        });


        //이벤트 수 카운트
        function check_event_count(){
            var t_secur = "<?echo $t_secur;?>";
            /**/
            //alert(at_val);
            $.post("/new/event/check_event_count",{
                t_secur: t_secur,
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
</script>      
<div class='main_con_left_w con_outline'>
    <div class='submenu_list'>
        <div style='width: 100%;'>
            <img src='<?echo $t_logo;?>' style='width: 100%;'/>
        </div>

        <div class='submenu_list_con'>
            <a href='/new/event/team_info/<?echo $t_secur;?>'>
                처음
            </a>
        </div>
        <div class='submenu_list_con'>
            <a href='/new/event/event_list/<?echo $t_secur;?>'>
                이벤트 <span id='event_count' class="badge"></span>
            </a>
        </div>
        <!--
        <div class='submenu_list_con'>
            <a href='/design/team_cupon_list'>
                기부 쿠폰 <span class="badge">14</span>
            </a>
        </div>
        -->
        <?if(isset($edit_user)){?>
        <div class='submenu_list_con'>
            <a href='/new/event/team_mate_list/<?echo $t_secur;?>'>
                팀원 관리
            </a>
        </div>
        <div class='submenu_list_con'>
            <a href='/new/event/make_team/<?echo $t_secur;?>'>
                기관 정보 수정하기
            </a>
        </div>
        <?}?>
        <br/>
        <button type="button" class="btn btn-info btn-block">
            소식받기
        </button>
        
    </div>
    <script>
        function now_making(){
            alert('현재 제작중에 있습니다.');
        }
    </script>

</div>
<!--기관 정보-->
<div class='main_con_left_w con_outline'>
    <h3 class='main_con_title'>
        기관 정보
    </h3>
    <table class='inno_table'>
        <tr>
            <td style='width:65px;'>
                연락처
            </td>
            <td >
                <?echo $t_tel;?>
            </td>
        </tr>
        <tr>
            <td>
                이메일
            </td>
            <td>
                <?echo $t_email;?>
            </td>
        </tr>
        <tr>
            <td>
                지역
            </td>
            <td>
                <?
                    $t_area_txt_arr = explode(',', $t_area_txt);
                    foreach($t_area_txt_arr as $value){
                        echo '<div class="label label-default" style="display: inline-block; margin-left: 5px; margin-bottom: 5px;">'.$value.'</div>';
                    }
                 ?>
            </td>
        </tr>
        <tr class='inno_table_last_tr'>
            <td>
                분야
            </td>
            <td>    
                <div class='tag_area'>
                    <?
                    $cate_info = explode(',', $t_cate2);
                    foreach($cate_info as $value){
                        echo '<div class="label label-default" style="display: inline-block; margin-left: 5px; margin-bottom: 5px;">'.$value.'</div>';
                    }
                    ?>
                </div>

            </td>
        </tr>
    </table>
    <!--
    <br/>
    <h3 class='main_con_title'>
        주요 태그
    </h3>
    <div class='tag_area'>
        <span class="label label-default">한부모 가정</span>
        <span class="label label-default">생활비</span>
    </div>
    -->
</div>