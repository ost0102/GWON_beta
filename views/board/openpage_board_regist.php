<script type="text/javascript">
function save_board_con(){
    var editor = document.getElementById("wsw_iframe");
    editor.contentWindow.save_txt();   //  에디터 내용 반영


    var bo_id = $("#bo_id").val();
    var name = $("#name").val();
    var name = $("#name").val();
    var email = $("#email").val();
    var bo_link = $("#bo_link").val();
    var bo_attach_link = $("#input_file_attachment").val();


    var title  =$("#title").val();
    var con_txt = $("#con_txt").val();


    $.post('<?echo $link_data_insert;?>',{
        bo_id: bo_id,
        bo_name: name,
        bo_email: email,
        bo_link: bo_link,
        bo_attach_link: bo_attach_link,
        bo_title: title,
        bo_content: con_txt
    },
    function(data){
        if(data==1){
            location.replace("<?echo $link_noti_list;?>");
        }else{
            alert(data)
        }

    });
 }
</script>
<h3 class='main_con_title'>
    <?echo $link_board_title;?>
</h3>
 <?echo $link_board_txt;?>
 <br/>
 <br/>
 <table class='inno_table'>
    <tr>
        <td style='width: 100px;'>
            이름
        </td>
        <td>
            <input id='name' type='text' class='form-control' style='width: 95%; margin-bottom: 10px;' value='<?echo $bo_name;?>'/>
            <input id='bo_id' type='hidden' class='form-control' style='width: 95%; margin-bottom: 10px;' value='<?echo $bo_id;?>'/>
        </td>
    </tr>
    <tr>
        <td>
            이메일
        </td>
        <td>
            <input id='email'  type='text' class='form-control' style='width: 95%; margin-bottom: 10px;' value='<?echo $bo_email;?>'/>
        </td>
    </tr>
    <tr>
        <td>
            제목
        </td>
        <td>
            <input id='title'  type='text' class='form-control' style='width: 95%; margin-bottom: 10px;' value='<?echo $bo_title;?>'/>
        </td>
    </tr>
    <tr>
        <td>
            링크
        </td>
        <td>
            <input id='bo_link'  type='text' class='form-control' style='width: 95%; margin-bottom: 10px;' value='<?echo $bo_link;?>'/>
        </td>
    </tr>

    <tr>
        <td>
            파일 첨부
        </td>
        <td>
            <input id='input_file_attachment' name='input_file_attachment' type='hidden' placeholder='' value='<?if(isset($bo_attach_link)) echo $bo_attach_link;?>'/>
            <button id='bt_file_attachment' onClick="upload_notice_file_attachment();" class="btn btn-inverse">업로드</button>
            <button id="bt_delete_file_attachment" onClick='del_notice_file_attachment();' class="btn btn-inverse">삭제</button>
            <?
            if(isset($bo_attach_link)){
                if($bo_attach_link==''){
                    echo '<script>
                    $("#bt_delete_file_attachment").hide();
                    </script>';
                }else{
                    echo '<script>
                    $("#bt_file_attachment").hide();
                    </script>';
                }
            }else{
                echo '<script>$("#bt_delete_file_attachment").hide();</script>';
            }
             ?>
            <div id='file_attachment_url'>
                <?
                if(isset($bo_attach_link)){
                    if($bo_attach_link!=''){
                       echo "<a href='".$bo_attach_link."' target='_blank'>첨부 파일 보기</a>";
                    }
                }
                ?>
            </div>
            <script>
            //첨부 서류 업로드
            function upload_notice_file_attachment(){
                window.open('/upload/up1/13?w_num=<?echo $w_num;?>&p_num=<?echo $p_num;?>&bo_id=<?echo $bo_id;?>','upload_img','width=500,height=430,left=0,top=0,scrollbars=no');
            }

            function del_notice_file_attachment(){
                var file_attachment_url = $('#input_file_attachment').val();
                var bo_id = '<?echo $bo_id;?>';
                var p_num = '<?echo $p_num;?>';
                //alert(post_logo_addr);
                //alert(post_logo_addr);

                $.post('/board/del_noti_file_attachment',{
                        file_attachment_url: file_attachment_url,
                        bo_id: bo_id,
                        p_num: p_num
                    },
                    function(data){
                        //alert(data);
                        //입력값 초기화하기
                        if(data==1){
                            $('#input_file_attachment').val('');
                            $('#file_attachment_url').html('');
                            $('#bt_file_attachment').show();
                            $('#bt_delete_file_attachment').hide();
                        }else{
                            alert(data);
                        }
                        //추가 해야할 사항 로고 업로드시 변동 부분, 그리고 실제 하단 코드 부분에 버튼 추가하고 보이도록 설정
                    });
            }
            </script>
        </td>
    </tr>

    <tr>
        <th colspan='2'>
                <div id='wsw_area' style='width:100%;'>
                    <iframe id='wsw_iframe' name='wsw_iframe' src='/board/load_wysiwyg' width='99%' height='500' scrolling='no' frameborder='0' style='margin-bottom: 15px; border: 1px solid #cdcdcd;'></iframe>

                    <textarea rows="2" cols="10" name="content" id="con_txt" class='form-control' style="display: none;"><?echo $bo_content;?></textarea>
                </div>
        </th>
    </tr>
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
<div style='width:100%; text-align: right; padding-bottom: 10px;'>
    <button id='board_write' onclick='save_board_con();' class='btn btn-default'>
        글쓰기
    </button>
</div>
<?}?>
