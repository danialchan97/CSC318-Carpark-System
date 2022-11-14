<?php

include_once('table.html');

require_once('connection.php');


session_start();

$ic = $_POST['ic'];


$res1 = mysqli_query($connection, "SELECT ic, name, username, phone, email FROM user WHERE ic = '$ic'");

$row1 = mysqli_fetch_assoc($res1);


$id = $_POST['id'];


$res = mysqli_query($connection, "SELECT * FROM park WHERE id = '$id'");

$row = mysqli_fetch_assoc($res);

if(isset($_POST['ggwp1']))
{ 

  $ic1 = mysqli_real_escape_string($connection, $_POST['ic1']);

  $id1 = $_POST['id1'];
  $res = mysqli_query($connection, "SELECT * FROM park WHERE id = '$id1'");

  $row = mysqli_fetch_assoc($res);

  $status = true;

  date_default_timezone_set('Asia/Kuala_Lumpur');

  $Cdate = date('Y-m-d H:i:s');


  $Pdate = $row['dateenter'];

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


  $price = 0;

  if($hours < 1)
  {
    $price = 2;
  }

  else if($hours >= 1)
  {
    $price = $hours * 3;
  }

  $update = mysqli_query($connection, "UPDATE park SET dateout='$Cdate', 
  price='$price', status ='$status' WHERE id='$id1'") or die(mysqli_error());

  if($update){ // if update query execution successfull  
 header("Location: viewcust.php?ic=".$ic."&process=success"); // add process-success in URL  
 echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" 
 data-dismiss="alert" ariahidden="true">&times;</button>Success <a href="home.php"><- Back</a></div>'; // display data updated.'  
 }
}

?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Pay</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/cust.css">

      
</head>

<div class="login">
  <h1>Pay</h1>
  <hr>
    <form method="post" id="form" name="form" action="">
    <input type="text" name="name" value="<?php echo $row1['name']; ?>" placeholder="name" disabled>
    <input type="text" name="phone" value="<?php echo $row1['phone']; ?>" placeholder="IC No" disabled>
    <input type="hidden" name="ic1" value="<?php echo $row1['ic']; ?>" placeholder="IC No" >
    <input type="hidden" name="id1" value="<?php echo $row['id']; ?>" placeholder="IC No" >

        <button type="submit" name="ggwp1" class="btn btn-primary btn-block btn-large">Pay</button>
    </form>
</div>

