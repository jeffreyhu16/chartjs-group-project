<?php
require_once("../db_connect.php");
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
   
    .font{
    background: linear-gradient(to left, #3a1c71, #d76d77);
    background: -webkit-linear-gradient(to top, #3a1c71, #d76d77, #ffaf7b);
    background-clip: text;
    -webkit-background-clip: text;
    color: transparent;
    
    }
    .a{
        font-size: 20px
    }

</style>

<body>
<!-- 1甜甜圈圖表 -->
  <div class="container vh-100">

    <div style="height: 15vh" class="d-flex align-items-center justify-content-evenly">
        <h1>各縣市 <a>電腦系統設計服務業</a> 支付載具_消費金額總平均</h1>
    </div>

    <div class="container vh-90 d-flex align-items-center">
        <div class="container " style="position: relative; height:40vh; width:40vw">
        
        <?php
                $sql="SELECT*FROM march11 ORDER BY id ASC;";
                $result= $conn -> query($sql);
                $data=$result->fetch_all(MYSQLI_ASSOC);
                $datapolar= json_encode($data);
        ?> 

            <canvas id="myChart"></canvas>
            <small class="fst-italic text-end">單位:百</small>

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
                "rgba(207,186,240, 1)",   // 台北市
                'rgba(163,196,243, 1)',   // 新北市
                'rgba(144,219,244, 1)',   // 台中
                'rgba(142,236,245, 1)', // 基隆
                'rgba(152,245,225, 1)', // 台南
                'rgba(185,251,192, 1)', // 高雄
                'rgba(251,248,204, 5)', // 宜蘭
                'rgba(253,228,207, 10)', // 桃園 
                'rgba(208, 140, 96, 0.5)', // 嘉義市
                'rgba(122, 28, 11, 0.5)', // 新竹縣
                'rgba(173, 46, 36, 0.5)', // 彰化縣
                'rgba(222, 116, 135, 0.8)', // 新竹市
                'rgba(255,207,210, 10)', // 雲林縣
                'rgba(241,192,232, 1)', // 嘉義縣
                ],
            }]
        };

            const config1 = {
                type: 'doughnut',
                data: dataA,
                options: {
                    responsive: true,
                    // maintainAspectRatio: false
                    aspectRatio: 1,
                }
            };
        const myChart = new Chart(ctx, config1)
        </script>

        </div>
    </div>
</div>

<!-- 2載具別總類張數比例-圓餅圖 -->
<div class="container vh-100">  

    <div style="height: 20vh" class="d-flex align-items-center justify-content-evenly">
        <h1>載具別總類張數比例</h1>   
    </div>

    <div class="container vh-90 d-flex align-items-center">
        <div class="container " style="position: relative; height:40vh; width:40vw">

    <?php
    require_once("../db_connect.php");
    $sql="SELECT `receipt`,sum(`number`) AS `total` FROM `receipt`group by`receipt`";
    $result= $conn -> query($sql);
    $data=$result->fetch_all(MYSQLI_ASSOC);
    $pie= json_encode($data);
    ?>

      
	<canvas id="myChart2"></canvas>

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

		var ctx = document.getElementById('myChart2');
		const dataB=  {
				labels: label2,
				datasets: [{
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
        	type: 'pie',
        	data: dataB,
        	options: {
				responsive: true,
            	aspectRatio: 1,
        	},
};

    const myChart2= new Chart(ctx,config2)
        
    </script>
    
        </div>
    </div>
</div>

<!-- 長條圖 2018各縣市載具消費比 -->
<div class="container vh-100">

    <div style="height: 20vh" class="d-flex align-items-center justify-content-evenly">
        <h1>2018各縣市載具消費總金額</h1>
    </div>

    <div class="container vh-90 d-flex align-items-center">
        <div class="container " style="position: relative; height:60vh; width:60vw">

            <?php
                require_once("../db_connect.php");
                $sql="SELECT `city`,sum(`amount`) AS `total` FROM `receipt`group by`city`";
                $result= $conn -> query($sql);
                $data= $result -> fetch_all(MYSQLI_ASSOC);
                $line= json_encode($data);
            ?>

            <canvas id="myChart3"></canvas>

            <script>

                let newlabel=[];
    		    let newdata=[];
    		    let lineChart=<?=$line?>.map(function(item){
                                let newItem={
                                    x:item["city"],
                                    y:item["total"]
                                };
                                return newItem;
                                });

                var ctx = document.getElementById('myChart3');

                const dataC = {

                    datasets: [{
                        label: '2018全台縣市載具消費總金額',
                        data: lineChart,
                        backgroundColor:
                            [
                                'rgba(241, 217, 218)',

                            ],
                        borderColor:
                            [
                                'rgb(220, 220, 220)',

                            ],
                        borderWidth: 1,
                        borderRadius: 5
                    }]

                };

                const config3 = {
                    type: 'bar',
                    data: dataC,
                    options: {
                        // maintainAspectRatio: false
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    },
                };

                const myChart3 = new Chart(ctx, config3)

            </script>

        </div>
    </div>
</div>

<!-- 長條圖 2018各縣市載具張數比 -->
<div class="container vh-100">

    <div style="height: 20vh" class="d-flex align-items-center justify-content-evenly">
        <h1>2018各縣市載具張數</h1>
    </div>

    <div class="container vh-90 d-flex align-items-center">
        <div class="container " style="position: relative; height:60vh; width:60vw">

        <?php
        require_once("../db_connect.php");
        $sql="SELECT `city`,sum(`number`) AS `total` FROM `receipt`group by`city`";
        $result= $conn -> query($sql);
        $data= $result -> fetch_all(MYSQLI_ASSOC);
        $index= json_encode($data);
        ?>

            <canvas id="myChart4"></canvas>

            <script>

                let freshlabel=[];
		        let freshdata=[];
		        let indexChart=<?=$index?>.map(function(item){
                                let newItem={
                                    x:item["city"],
                                    y:item["total"]
                                };
                                freshlabel.push(newItem.x);
                                freshdata.push(newItem.y);
                                return newItem;
                            });
                        
                var ctx = document.getElementById('myChart4');
                        
                const myChart4 = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: freshlabel,
                        datasets: [{
                            label: '2018各行業別載具消費金額',
                            data: freshdata,
                            backgroundColor: [
                                'rgba(199, 184, 161)',
                                'rgba(234, 208, 209)',
                                'rgb(181, 196, 177)',
                                'rgb(216, 191, 216)',
                                'rgb(188, 143, 143)',
                                'rgb(255, 239, 213)',
                                'rgb(255, 222, 173)',
                                'rgb(230, 230, 250)',
                                'rgb(238, 232, 170)'
                            
                            ],
                            borderColor: [
                                'rgba(220, 220, 220)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        // maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

            </script>

        </div>
    </div>
</div>






    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>