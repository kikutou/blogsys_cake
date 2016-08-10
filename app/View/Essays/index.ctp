<h1>文章の一覧</h1>

<div id="pic">

</div>

<script>

    $(
        function(){

            //确定画布的大小
            var width = 400;
            var height = 400;
            //在 body 里添加一个 SVG 画布
            var svg = d3.select("#pic")
                .append("svg")
                .attr("width", width)
                .attr("height", height);

            //定义画布周围空白的地方
            var padding = {left: 30, right: 30, top: 20, bottom: 20};

            //ajax请求
            $.ajax({
                url: 'ajax_index',
                type: 'post',
                //data: {id: essay_id},
                //dataType: 'text',
                success: function (result) {
                    //alert(typeof result);
                    users = JSON.parse(result);

                    //var user = users[0]['User']['id'];

                    //取所有用户名
                    var name_list = [];
                    for (var i = 0; i < users.length; i++) {
                        name_list[i] = users[i]['User']['name'];
                    }
                    alert(name_list);

                    //取所有用户的文件数
                    var essay_num = [];
                    for (var i = 0; i < users.length; i++) {
                        essay_num[i] = users[i]['User']['essay_num'];
                    }
                    alert(essay_num);
                }
            });


            //定义一个数组
            var dataset = [10, 20, 30, 40, 30, 20, 10, 5];
            //x轴的比例尺
            var xScale = d3.scale.ordinal()
                .domain(d3.range(dataset.length))
                .rangeRoundBands([0, width - padding.left - padding.right]);
            //y轴的比例尺
            var yScale = d3.scale.linear()
                .domain([0, d3.max(dataset)])
                .range([height - padding.top - padding.bottom, 0]);
            //定义x轴
            var xAxis = d3.svg.axis()
                .scale(xScale)
                .orient("bottom");
            //定义y轴
            var yAxis = d3.svg.axis()
                .scale(yScale)
                .orient("left");
            //矩形之间的空白
            var rectPadding = 4;
            //添加矩形元素
            var rects = svg.selectAll(".MyRect")
                .data(dataset)
                .enter()
                .append("rect")
                .attr("class", "MyRect")
                .attr("fill", "steelblue")
                .attr("transform", "translate(" + padding.left + "," + padding.top + ")")
                .attr("x", function (d, i) {
                    return xScale(i) + rectPadding / 2;
                })
                .attr("y", function (d) {
                    return yScale(d);
                })
                .attr("width", xScale.rangeBand() - rectPadding)
                .attr("height", function (d) {
                    return height - padding.top - padding.bottom - yScale(d);
                });
            //添加文字元素
            var texts = svg.selectAll(".MyText")
                .data(dataset)
                .enter()
                .append("text")
                .attr("class", "MyText")
                .attr("fill", "white")
                .attr("text-anchor", "middle")
                .attr("transform", "translate(" + padding.left + "," + padding.top + ")")
                .attr("x", function (d, i) {
                    return xScale(i) + rectPadding / 2;
                })
                .attr("y", function (d) {
                    return yScale(d);
                })
                .attr("dx", function () {
                    return (xScale.rangeBand() - rectPadding) / 2;
                })
                .attr("dy", function (d) {
                    return 20;
                })
                .text(function (d) {
                    return d;
                });
            //添加x轴
            svg.append("g")
                .attr("class", "axis")
                .attr("transform", "translate(" + padding.left + "," + (height - padding.bottom) + ")")
                .call(xAxis);
            //添加y轴
            svg.append("g")
                .attr("class", "axis")
                .attr("transform", "translate(" + padding.left + "," + padding.top + ")")
                .call(yAxis);

        }
    );




</script>



<table>
  <tr>
      <th>发表时间</th>
      <th>文章标题</th>
      <th>文章详细</th>
      <th>文章评论</th>
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



