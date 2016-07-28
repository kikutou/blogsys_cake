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
      for($i = 0;$i<count($result);$i++)
      {
        $array = $result[$i]['File'];
        echo "<tr>";
        echo "<td>" .$array['date']. "</td>";
        echo "<td>" .$array['title']. "</td>";
        //gai id
       // echo "<td><a href=\"contents?id=" .$array['id']. "\">详细</a></td>";
        echo "<td><a href=\"contents?id=" .$array['id']. "\">详细</a></td>";
        echo "</tr>";
      }
    }
    else
    {
      echo "文章がない";

    }
 ?>

</table>
