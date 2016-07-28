<h1>文章の一覧</h1>
<table>
  <tr>
    <th>发表时间</th>
    <th>文章标题</th>
    <th>文章详细</th>
  </tr>
  <?php
    if($result)
    {
        foreach ($result as $record){
            $file = $record['File'];
            echo "<tr>";
            echo "<td>" .$file['date']. "</td>";
            echo "<td>" .$file['title']. "</td>";
            //gai id
            // echo "<td><a href=\"contents?id=" .$array['id']. "\">详细</a></td>";
            echo "<td><a href=\"contents?id=" .$file['id']. "\">详细</a></td>";
            echo "</tr>";

        }
    }
    else
    {
      echo "<tr><td colspan='3'>文章がない</td></tr>";

    }
 ?>

</table>
