<h1>文章の一覧</h1>
<table>
    <div class="demo" id="highcharts">
        <input type = "button" value = "图" onclick = "highcharts_js()">
    </div>
  <tr>
      <th>发表时间</th>
      <th>文章标题</th>
      <th>文章详细</th>
      <th>文章评论</th>
  </tr>

  <?php

    if($essays)
    {
        print '<pre>';
        print_r($essays);
        print '</pre>';
        exit();

        foreach ($essays as $record){
            $essay = $record['Essay'];
            echo "<tr>";
            echo "<td>" .$essay['date']. "</td>";
            echo "<td>" .$essay['title']. "</td>";
            //gai id
            // echo "<td><a href=\"contents?id=" .$array['id']. "\">详细</a></td>";
            echo "<td><a href=\"contents?id=" .$essay['id']. "\">详细</a></td>";
            echo "<td><a href=\"".$this->Html->url('/comments/comm')."?id=" .$essay['id']. "\">评论</a></td>";

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
    echo "<input type = \"button\" onclick=\"location.href='mypage'\" value=\"mypage\">";
  }
  else
  {
    echo "<input type = \"button\"  onclick = \"location.href='/blogsys/users/signup'\" value = \"サインアップ\">";
    echo "<input type = \"button\"  onclick = \"location.href='/blogsys/users/login'\" value = \"ログイン\">";
  }
?>



