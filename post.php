<?php

if($_POST) {
  $content1 = $_POST["c1"];
  $content2 = $_POST["c2"];
  $content3 = $_POST["c3"];
}

include("net/config.php");

$insert = $db->prepare('INSERT INTO postmethod (`c1`, `c2`, `c3`) VALUES (:c1,:c2,:c3)');
$insert->execute([ ':c1' => $content1, ':c2' => $content2, ':c3' => $content3 ]);

if($insert && $_POST) {
  echo "1";
} else {

$dataMAX = $db->prepare('SELECT MAX(`id`) AS LargestID FROM `postmethod`');
$dataMAX->execute();
$dataMAXID = $dataMAX->fetch(\PDO::FETCH_ASSOC);
$maxID = $dataMAXID["LargestID"];
$maxID -= 500;

$dataPrepare = $db->prepare('SELECT * FROM `postmethod` WHERE (id>:id) ORDER BY id DESC');
$dataPrepare->execute([':id' => $maxID]);

?>

<!DOCTYPE html>
<html lang="tr" dir="ltr">
  <head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
    	* {
        text-decoration: none;
          color: white;
    		  background-color: #191919;
          font-family: Roboto;
          margin: 0px;
    	}

      td {
        border: 1px solid #fff;
        padding-left: 10px;
        padding-right: 10px;
      }

      td h5 {
        font-weight: bold;
      }

      table {
        margin-left: 5%;
        margin-right: 5%;
        width: 90%;
      }

      footer {
        width: 100%;
        text-align: center;
        background-color: purple;
      }
    </style>
  </head>
  <body>
    <header style="padding-top: 1vh;">
        <h2 style="font-family: Roboto; text-align: center;"><a href="https://yusufherdem.com">YH-IoT</a> Public Database</h2>
      </header>
    <table style="padding-bottom: 1vh;">
      <div class="stick" style="background-color: orange; width: 90%; height: 2px; margin-left: 5%; margin-left: 5%; margin-top: 4px; margin-bottom: 3px;"></div>
      <tr>


    <td><h5>ID</h5></td>
    <td><h5>C1</h5></td>
    <td><h5>C2</h5></td>
    <td><h5>C3</h5></td>
    <td><h5>TIME [TR]</h5></td>
          </tr>
    <?php


    while($row=$dataPrepare->fetch(\PDO::FETCH_ASSOC)){
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["c1"]."</td>";
        echo "<td>".$row["c2"]."</td>";
        echo "<td>".$row["c3"]."</td>";
        echo "<td>".$row["time"]."</td>";
        echo "</tr>";
      }
     ?>
  </table>
  <footer>
    2022© YH-IoT Public Database
  </footer>
  </body>
</html>
<?php
} ?>
