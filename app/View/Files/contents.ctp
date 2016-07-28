
<div>
    <table border="1" heigth = "800px">
        <?php
            if($result)
                //exit(var_dump($result)); //debug方法
            {
                echo "<tr>";
                echo "<td>".$result['File']['date']."</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>" .$result['File']["title"]. "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>" .$result['File']["content"]. "</td>";
                echo "</tr>";
            }
        ?>
    </table>
</div>


<!--    <a href="javascript:history.go(-1)">戻り</a>-->
<div>
    <input type = "button" value = "戻り" onclick = "location.href='index'">
</div>





