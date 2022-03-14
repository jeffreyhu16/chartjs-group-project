<?php
require_once("./db_connect.php");
?>
<!doctype html>
<html lang="en">
<head>
    <title>各分位載具消費張數金額</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
   
    .text{
    background: linear-gradient(to left, #3a1c71, #d76d77);
    background: -webkit-linear-gradient(to top, #3a1c71, #d76d77, #ffaf7b);
    background-clip: text;
    -webkit-background-clip: text;
    color: transparent;
    font-size: 40px
    }
    .a{

    }

</style>

<body>
    <!-- php -->
    <?php
        $sql="SELECT*FROM march11 ORDER BY id ASC;";
        $result= $conn -> query($sql);
        $data=$result->fetch_all(MYSQLI_ASSOC);
        $datapolar= json_encode($data);
    ?>
    <?php
    require_once("./db_connect.php");
    $sql="SELECT `receipt`,sum(`number`) AS `total` FROM `receipt`group by`receipt`";
    $result= $conn -> query($sql);
    $data=$result->fetch_all(MYSQLI_ASSOC);
    $pie= json_encode($data);
    ?>
    <!-- php end -->

<div class="text-center"><h1>各分位載具消費張數金額</h1></div>
<div class="text-center">
        <h3>各縣市 <a class="text">電腦系統設計服務業</a> 支付載具_消費金額總平均</h4>
    </div>
<div class="container" style="position:relative;height:40vh;width:40vw">
    <canvas id="myChart"></canvas>
    <small class="fst-italic text-end">單位:百</small>
    <h3 class="text-center">載具別總類張數比例</h1>  
    <canvas id="myChart2"></canvas>
</div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
 
    <!-- 第一張圖表jenny -->
    <script>
        let label1=[];
        let data1=[];
        let datapol=<?=$datapolar?>.map(function(item){
            let datalet={
                one:item["one"],
                two:item["two"]
            };
        label1.push(datalet.one);
        data1.push(datalet.two);
        return datalet;
        })
        var ctx = document.getElementById('myChart');
        const dataA = {
        labels:label1,
        datasets: [{
            label: 'My First Dataset',
            data:data1,
            backgroundColor:[      
                "rgb(207,186,240)",// 台北市
                'rgb(163,196,243)',// 新北市
                'rgb(144,219,244)',// 台中
                'rgb(142,236,245)',// 基隆
                'rgb(152,245,225)',// 台南
                'rgb(185,251,192)',// 高雄
                'rgba(251,248,204,5)',// 宜蘭
                'rgb(253,228,207)',// 桃園
                'rgba(208, 140, 96,0.6)',// 嘉義市
                'rgba(122, 28, 11,0.4)',// 新竹縣
                'rgba(173, 46, 36,0.5)',// 彰化縣
                'rgb(222, 116, 135)',// 新竹市
                'rgb(255,207,210)',// 雲林縣
                'rgb(241,192,232)',// 嘉義縣
                ],
                hoverOffset: 20
            }]
        };

        const config1 = {
            type: 'doughnut',
            data: dataA,
            options: {
                responsive: true,
                // maintainAspectRatio: false
                aspectRatio: 2,
                plugins:{
                    legend:{
                        position:'right'
                    }
                }
            }
        };
        const myChart = new Chart(ctx, config1)
    </script>
    <!-- 第二張圖表kari -->
<script>
		let label2=[];
		let data2=[];
		let pieChart=<?=$pie?>.map(function(item){
            let newItem={
                a:item["receipt"],
                b:item["total"]
            };
            label2.push(newItem.a);
            data2.push(newItem.b);
            return newItem;
        });

		console.log(pieChart);

        
		var ctx = document.getElementById('myChart2');
		const dataB=  {
				labels: label2,
				datasets: [{
                    label:'載具別',
					data:data2,
					backgroundColor: [
						'rgba(251,248,204, 5)',
						'rgba(173, 46, 36, 0.5)',
						'rgba(207,186,240, 1)',
					],
					hoverOffset: 4
				}]
			};	

		const config2 = {
        	type: 'bar',
        	data: dataB,
        	options: {
				responsive: true,
            	aspectRatio: 2,
                plugins:{
                    legend:{
                        position:'right'
                    }
                }
        	},
};

    const myChart2= new Chart(ctx,config2)
        
    </script>
</body>
</html>