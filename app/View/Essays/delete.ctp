<table border="1">
    <?php
    if($result)
    {
        echo "<tr>";
        echo "<td>".$result['Essay']['date']."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>" .$result['Essay']["title"]. "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>" .$result['Essay']["content"]. "</td>";
        echo "</tr>";
    }
    ?>
</table>

<br>

<?php
echo $this->Form->create(false,array('type'=>'post'));

//获得文章ID
echo $this->Form->text(
    'Essay.id',
    array(
        'type'=>'hidden',
        'value'=>$result['Essay']['id']
    )
);


//获取ユーザーID
//echo $this->Form->text(
//    'Essay.user_id',
//    array(
//        'type'=>'hidden',
//        'value'=>$result['Essay']['user_id']
//    )
//);



echo $this->Form->submit('確認删除');

echo $this->Form->end();
?>

<input type="button" onclick="history.go(-1)" value="キャンセル">
