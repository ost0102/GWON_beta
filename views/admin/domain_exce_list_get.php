<?
 if(isset($de_info)){

echo '<table class="admin_table" border="1">
    <tr> 
    <th>도메인명</th>
    <th>관리 </th>
    </tr>';

    foreach ($de_info as $de_infos)
    {
        $de_id = $de_infos['de_id'];
        $domain = $de_infos['domain'];

        echo '<tr>';
        echo '<td>';
        echo $domain;
        echo '</td>';


        echo '<td>';
        echo '<a href="javascript:del_domain_ex(\''.$de_id.'\');">삭제</a>';
        echo '</td>';

        echo '</tr>';
    }
}


echo '</table>';

?>
<div style='width: 100%; text-align: center;' class="col-md-12">
<?=$pagination;?>
</div>