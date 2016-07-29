<h1>自己紹介</h1>

<?php
?>


<h1>私の文章</h1>
<a href="add">添加文章</a>

<table border="1">
    <tr>
        <th>发表时间</th>
        <th>文章标题</th>
        <th>文章详细</th>
        <th>文章编辑</th>
    </tr>
    <?php
    if($essays)
    {
        foreach ($essays as $record){
            $essay = $record['Essay'];
            echo "<tr>";
            echo "<td>" .$essay['date']. "</td>";
            echo "<td>" .$essay['title']. "</td>";
            echo "<td><a href=\"contents?id=" .$essay['id']. "\">详细</a></td>";
            echo "<td><a href=\"edit?id=" .$essay['id']. "\">编辑</a></td>";
            echo "</tr>";

        }
    }
    else
    {
        echo "<tr><td colspan='3'>文章がない</td></tr>";

    }
    ?>
</table>

<br>

<table>
    <tr>
        <td>
            <input type = "button" value = "文章一覧" onclick = "location.href='index'">
        </td>
        <td>
            <input type = "button" value = "ログアウト" onclick = "location.href='/blogsys/users/login'">
        </td>
    </tr>

</table>




