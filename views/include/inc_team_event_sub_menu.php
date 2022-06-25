<!--참여기관 왼쪽 메뉴-->
<div class='main_con_left_w con_outline'>
    <div class='submenu_list'>
        <div class='submenu_list_con'>
            <a href='/new/event/event_info_view/<?echo $e_secur;?>'>
                이벤트 메인
            </a>
        </div>
        <div class='submenu_list_con'>
            <a href='/new/event/event_info_view/<?echo $e_secur;?>'>
                참여 정보
            </a>
        </div>
        <!--
        <div class='submenu_list_con'>
            <a href='/design/team_cupon_list'>
                기부 쿠폰 <span class="badge">14</span>
            </a>
        </div>
        -->
        <?if($member_user=='member'){?>
        <div class='submenu_list_con'>
            <a href='/new/event/event_info_edit/<?echo $e_secur;?>'>
                이벤트 정보 수정
            </a>
        </div>
        <div class='submenu_list_con'>
            <a href='/new/event/event_admin_campaign/<?echo $e_secur;?>'>
                사연 관리
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
                기관명
            </td>
            <td >
                <a href='/new/event/team_info/<?echo $t_secur;?>'>
                    <?echo $t_name;?>
                </a>
            </td>
        </tr>
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