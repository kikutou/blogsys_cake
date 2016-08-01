

<table border="1">
    <?php
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
    ?>
</table>

<!--<a href="javascript:history.go(-1)">戻り</a>-->
<input type = "button" value = "戻り" onclick = "history.go(-1)">





