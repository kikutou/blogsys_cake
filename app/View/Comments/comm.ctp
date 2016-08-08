<h1>文章</h1>
<table border = "1">

    <?php
    if(isset($errorMsg))
    {
        echo $errorMsg;
    }
    else
    {
        if($result)
            //exit(var_dump($result)); //debug方法
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
    }
    ?>
</table>
<br><br>
<h1>文章的评论</h1>

<?php
echo "<tr>";
echo "<td><a href=\"addcomm?id=" .$result['Essay']['id']. "\">添加评论</a></td>";
echo "<tr>";
?>


<table border="1">
    <tr>
        <th>评论时间</th>
        <th>评论者</th>
        <th>评论内容</th>
    </tr>
    <?php
    if($comments)
    {
        foreach ($comments as $comment){
            echo "<tr>";
            echo "<td>" .$comment['Comment']['date']. "</td>";
            echo "<td>" .$comment['User']['name']. "</td>";
            echo "<td>" .$comment['Comment']['comment']. "</td>";
            echo "</tr>";
        }
    }
    else
    {
        echo "<tr><td colspan='5'>评论がない</td></tr>";

    }
    ?>
</table>

<input type = "button" onclick = "location.href='/blogsys/essays/index'" value = "文章一览" >
