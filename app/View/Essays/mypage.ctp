<div id="pic">

</div>

<script>

    $(
        function(){
            //ajax请求
            $.ajax({
                url: 'ajax_mypage',
                type: 'post',
                success: function (result) {
                    essays = JSON.parse(result);
                    //取所有用户名
                    var essay_list = [];
                    for (var i = 0; i < essays.length; i++) {
                        essay_list[i] = essays[i]['Essay']['title'];
                    }
                    //取所有用户的文件数
                    var comment_num = [];
                    for (var i = 0; i < essays.length; i++) {
                        comment_num[i] = essays[i]['Essay']['comment_num'];
                    }
                    show_graph(comment_num, essay_list);
                },
                error: function (error) {
                    alert('エラーが発生しました。');
                }
            });
        }
    );

    function show_graph(dataset, nameset){
        //确定画布的大小
        var width = 800;
        var height = 400;
        //在 body 里添加一个 SVG 画布
        var svg = d3.select("#pic")
            .append("svg")
            .attr("width", width)
            .attr("height", height);

        //定义画布周围空白的地方
        var padding = {left: 30, right: 30, top: 20, bottom: 20};

        //x轴的比例尺
        var xScale = d3.scale.ordinal()
        //.domain(d3.range(dataset.length))
            .domain(nameset)
            //.rangeRoundBands([0, width - padding.left - padding.right]);
            .rangeBands([0, width - padding.left - padding.right]);

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
                return xScale(nameset[i]) + rectPadding / 2;
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
                return xScale(nameset[i]) + rectPadding / 2;
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
</script>




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
    $(
        function () {
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
        }
    )

</script>







