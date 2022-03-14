<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 

<?php
$servername = "localhost";
$username = "Kari";
$password = "123456789";
$dbname = "test";
    
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// 檢查連線
if ($conn->connect_error) {
      die("連線失敗: " . $conn->connect_error);
}else{
     //echo "連線成功";
}


// $conn->close();
?>

<?php 
  // require_once('db_connect.php');
  // $result = $conn->query('SELECT * FROM `receipt`');
  // if (!$result) {
  //   die($conn->error);
  // }

  // while ($row = $result->fetch_assoc()) {
  //   echo '載具別: '. $row['receipt'] . '<br>';
  //   echo '張數: ' . $row['number'] . '<br>';
  // }

// $sql = "SELECT `city`, ` industry`, `receipt`, `number` FROM `receipt` WHERE 1;";
//   $result = $conn->query($sql);

//   if ($result->num_rows > 0) {
//       while($row = $result->fetch_assoc() ) {
//       echo "縣市別:". $row["city"]. "載具別:" .$row["receipt"]. "消費金額:" .$row["amount"] ."<br>";
//       } else {
//        echo "0 results";
//       }
//       }

?>