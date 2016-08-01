<h1>自己紹介</h1>

<table border = "1">
    <?php
        if($user)
        {
            echo "<tr>";
            echo "<td>名前：</td>";
            echo "<td>" .$user['User']['name']. "</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>民族：</td>";
            echo "<td>" .$user['User']['nation']. "</td>";
            echo "</tr>";

//            echo "<tr>";
//            echo "<td>血液型：</td>";
//            echo "<td>" ;
//            $user_blood = $user['User']['blood'];
//            if($user_blood)
//            {
//
//            }
//            echo "</td>";
//            echo "</tr>";

            echo "<tr>";
            echo "<td>興味：</td>";
            echo "<td>" .$user['User']['hobby']. "</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>性別：</td>";
            echo "<td>";
            $user_gender = $user['User']['gender'];
            if($user_gender !== null && $user_gender == 0 )
            {
                echo "男";
            }
            else{
                echo "女";
            }
            echo "</td>";
            echo "</tr>";
        }
    ?>
</table>

<br><br>

<h1>私の文章</h1>
<a href="add">添加文章</a>

<table border="1">
    <tr>
        <th>发表时间</th>
        <th>文章标题</th>
        <th>文章详细</th>
        <th>文章编辑</th>
        <th>文章削除</th>
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
            echo "<td><a href=\"delete?id=" .$essay['id']. "\">削除</a></td>";
            echo "</tr>";

        }
    }
    else
    {
        echo "<tr><td colspan='5'>文章がない</td></tr>";

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
            <input type = "button" value = "ログアウト" onclick = "location.href='/blogsys/users/login?from=logout'">
        </td>
    </tr>

</table>




