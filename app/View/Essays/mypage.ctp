
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

            echo "<tr>";
            echo "<td>民族：</td>";
            echo "<td>" .$user['User']['nation']. "</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>興味：</td>";
            echo "<td>" .$user['User']['hobby']. "</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>血液型：</td>";
            $user_blood = array(
                '0'=>'A',
                '1'=>'B',
                '2'=>'AB',
                '3'=>'0',
                '4'=>'HR'
            );
            if($user['User']['blood'] == "")
            {
                echo "<td>血液型ない</td>";
            }
            else
                {
                    foreach ($user_blood as $key=>$value)
                    {
                        if($user['User']['blood'] == $key && $user['User']['blood'] !== null )
                        {
                            echo "<td>" .$value. "</td>";
                        }
                    }
                }
            echo "</tr>";

            echo "<tr>";
            echo "<td>生年月日：</td>";
            echo "<td>" .$user['User']['birthday']. "</td>";
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
            //echo "<td><a href=\"delete?id=" .$essay['id']. "\">削除</a></td>";
            echo "<td><a href='javascript::' class='del'>削除<span hidden>" .$essay['id']. "</span></a></td>";

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
            <input type = "button" value = "ログアウト" onclick = "location.href='/blogsys/users/logout'">
        </td>
    </tr>

</table>



<script>
    $(function () {
        $(".del").click(function () {
            var essay_id = $(this).text().replace("削除", "");
            if (window.confirm('文章を削除しすか？')){
                $.ajax({
                    url: 'ajax_delete',
                    type: 'post',
                    data: {id: essay_id},
                    dataType: 'text',
                    success: function (result) {
                        result = JSON.parse(result);
                        if(result['response_code'] == 1){
                            alert(result['message']);
                            location.reload();
                        }else{
                            alert(result['message']);
                        }

                    },
                    error: function (error) {
                        alert('ajax error');
                    }
                })
            }
        })
    })

</script>







