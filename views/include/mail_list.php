<?
//print_r($linked_info);
echo '<ul style="margin-top: 10px;"">';
foreach ($mail_info as $mail_info)
{
	echo '<li style="font-size: 10px;"><a href="javascript:mail_detail(\''.$mail_info['m_id'].'\')">'.$mail_info['visitor_mail'].'님이 문의하였습니다.</a> &nbsp;[';
	echo date('Y-m-d',strtotime($mail_info['date'])).']</li>';
}
echo '</ul>';
?>
<div style='width: 100%; text-align: center;' class="col-md-12">
    <?
    for($num=1;$num<=$last_page;$num++){
    	echo '<a href="javascript:mail_send_list('.$num.');">'.$num.'</a>&nbsp;';
    }
    ?>
</div>