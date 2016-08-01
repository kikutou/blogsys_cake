<h1>文章の一覧</h1>
<table>
  <tr>
    <th>发表时间</th>
    <th>文章标题</th>
    <th>文章详细</th>
  </tr>
  <?php
    if($essays)
    {
        foreach ($essays as $record){
            $essay = $record['Essay'];
            echo "<tr>";
            echo "<td>" .$essay['date']. "</td>";
            echo "<td>" .$essay['title']. "</td>";
            //gai id
            // echo "<td><a href=\"contents?id=" .$array['id']. "\">详细</a></td>";
            echo "<td><a href=\"contents?id=" .$essay['id']. "\">详细</a></td>";
            echo "</tr>";

        }
    }
    else
    {
      echo "<tr><td colspan='3'>文章がない</td></tr>";

    }
 ?>
</table>

<?php
  if(isset($user))
  {
    echo "<input type = \"button\" onclick=\"history.go(-1)\" value=\"戻り\">";
  }
  else
  {
    echo "<input type = \"button\"  onclick = \"location.href='/blogsys/users/signup'\" value = \"サインアップ\">";
    echo "<input type = \"button\"  onclick = \"location.href='/blogsys/users/login'\" value = \"ログイン\">";
  }
?>



