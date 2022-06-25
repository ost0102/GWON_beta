<script type="text/javascript">
</script>
<div id="board_con_area">
    <h1><?echo $bo_title;?></h1>
    <p class='date_st'><?echo date('Y-m-d', strtotime($bo_date));?></p>
    <table class='inno_table'>
        <tr>
            <td>
                작성자 :
                <?echo $bo_name;?> 
                <?if($bo_email!=''){
                ?>
                (<?echo $bo_email;?>)
                <?
                }
                ?>
            </td>
            <td style='text-align: right;'>
                조회수 :  <?echo $count;?>
            </td>
        </tr>
        <?if($bo_link!=''){
            ?>
        <tr>
            <td colspan='2' style='text-align: left; background: #efefef;'>
                연관 링크 : <a href='<?echo $bo_link;?>' target='_blank'><?echo $bo_link;?></a>
            </td>
        </tr>
        <?}?>

        <?if($bo_attach_link!=''){
            ?>
        <tr>
            <td colspan='2' style='text-align: left; background: #efefef;'>
                <a href='<?echo $bo_attach_link;?>' target='_blank' >첨부 파일 보기</a>
            </td>
        </tr>
        <?}?>
        <tr>
            <th colspan='2' style='font-weight: normal; text-align: left;'>
                <?echo $bo_content;?>
            </th>
        </tr>
    </table>
    <br/>
    <div style='width:100%; text-align: right; padding-bottom: 10px;'>
        <table style='width:100%;'>
            <tr>
                <td style='text-align: left;'>
                    <a href='<?echo $link_board_list;?>'>
                        <button class='inno_bt'>
                            목록
                        </button>
                    </a>
                </td>
                <td style='text-align: right;'>
                     <?
                    if(isset($edit_con)&&$edit_con==2){
                        $can_edit = 'y';
                    }else{
                        $can_edit = 'n';
                    }
                    if($can_edit=='y'){
                    ?>
                        <a href='<?echo $link_board_write;?><?echo $bo_id;?>?domain=<?echo $domain;?>'>
                            <button class='inno_bt'>
                                수정
                            </button>
                        </a>
                        <a href='<?echo $link_board_delete;?><?echo $bo_id;?>?domain=<?echo $domain;?>'>
                        <button class='inno_bt'>
                            삭제
                        </button>
                    <?
                    }?>
                    
                    </a>
                </td>
            </tr>
        </table>
    </div>
</div>
