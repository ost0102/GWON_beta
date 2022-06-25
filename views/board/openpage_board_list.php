<div id="board_con_area">
    <h3 class='main_con_title'>
        <?echo $link_board_title;?>
    </h3>
     <?echo $link_board_txt;?>
     <br/>
     <br/>
    <table class='inno_table'>
        <tr>
            <th>
                제목
            </th>
            <th width='100px;'>
                작성일
            </th>
        </tr>

    <?
    if($list){
    foreach($list as $item){?>

        <tr class='inno_table_last_tr'>
            <td>
                <a href='<?echo $link_board_detail;?><?=$item->bo_id;?>?domain=<?=$domain;?>'><?=$item->bo_title;?></a>
            </td>
            <td>
                <?
                echo date('Y-m-d', strtotime($item->bo_date));
                ?>
            </td>
        </tr>
        

    <?}
    }else{

        echo "
             <tr class='inno_table_last_tr'>
            <td colspan='2' style='text-align: center;'>
                작성된 게시물이 없습니다.
            </td>
        </tr>
        ";
    }?>

    </table>
    <br/>
     <?
    if(isset($edit_con)&&$edit_con==2){
        $can_edit = 'y';
    }else{
        $can_edit = 'n';
    }
    if($can_edit=='y'){
    ?>
        <div style='width:100%; text-align: right;'>
            <a href='<?echo $link_board_write;?>'>
            <button class='btn btn-default'>
                글쓰기
            </button>
            </a>
        </div>
    <?
    }?>
    <div style='width:100%; text-align: left; margin-top: 10px; margin-bottom: 10px;'>
        <input type="text" style='display: inline-block; width: 180px; height: 30px; margin-bottom: 0px;'class="form-control" placeholder="검색어를 입력하세요.">
        <button class='btn btn-default'>
            글 찾기
        </button>
    </div>
    <div style='width: 100%; text-align: center; padding-bottom: 10px;' class="col-md-12">
        <?=$pagination;?>
    </div>
</div>