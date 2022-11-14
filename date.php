<?php

include_once('table.html');

require_once('connection.php');


session_start();

$ic = "971209095277";


$res1 = mysqli_query($connection, "SELECT ic, name, username, phone, email FROM user WHERE ic = '$ic'");

$row1 = mysqli_fetch_assoc($res1);


$id = 3;


$res = mysqli_query($connection, "SELECT * FROM park WHERE ic = '$ic'");

$row = mysqli_fetch_assoc($res);


  $id = 3;

  $status = true;


  date_default_timezone_set('Asia/Kuala_Lumpur');

  $Cdate = date('Y-m-d H:i:s');


  $Pdate = $row['dateenter'];

  $f = new DateTimeZone('Asia/Kuala_Lumpur');

  $d1 = new DateTime($Cdate);
  $d2 = new DateTime($Pdate);

  $diff = $d2->diff($d1);
  $hours = 0;

  if($diff->format('%a') > 0){
  $hour1 = $diff->format('%a')*24;
  $hours = $hours + $hour1;
  }

  if($diff->format('%h') > 0){
  $hour2 = $diff->format('%h');
  $hours = $hours + $hour2;
  }

  echo $hours . " hours";
  echo "<br>";
  if($hours < 1)
  {
    $price = 2;
  }
  else
  {
    $price = $hours * 3;
  }

  echo "RM " . $price;
?>