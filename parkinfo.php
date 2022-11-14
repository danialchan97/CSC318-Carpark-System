<?php

include_once('table.html');


session_start();

$ic = $_POST['ic'];

require_once('connection.php');

$res = mysqli_query($connection, "SELECT ic, name, username, phone, email FROM user WHERE ic = '$ic'");

$row = mysqli_fetch_assoc($res);

if(isset($_POST['ggwp']))
{
  $ic = mysqli_real_escape_string($connection, $_POST['ic1']);
  $plate = mysqli_real_escape_string($connection, $_POST['plate']);

  $status = false;

  $staffic = $_SESSION['icno'];

  date_default_timezone_set('Asia/Kuala_Lumpur');

  $date = date('Y-m-d H:i:s');


  $sql = "INSERT INTO park(ic, plate, dateenter, status, staffic)
  VALUES (?, ?, ?, ?, ?)";

  $stmt = $connection->prepare($sql);
  $stmt -> bind_param("sssss", $ic, $plate, $date, $status, $staffic);

  $stmt->execute();

  if($stmt){ // if update query execution successfull  
 header("Location: viewcust.php?icno=".$ic."&process=success"); // add process-success in URL  
 echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" 
 data-dismiss="alert" ariahidden="true">&times;</button>Success <a href="home.php"><- Back</a></div>'; // display data updated.'  
 }
}

?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Parking Information</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/cust.css">

      
</head>

<div class="login">
  <h1>Parking Information</h1>
  <hr>
    <form method="post" id="form" name="form" action="">
    <input type="text" name="name" value="<?php echo $row['name']; ?>" placeholder="name" disabled>
    <input type="text" name="phone" value="<?php echo $row['phone']; ?>" placeholder="IC No" disabled>
    <input type="hidden" name="ic1" value="<?php echo $row['ic']; ?>" placeholder="IC No" >
    <input type="text" name="plate" value="" placeholder="Car Plate Number" required>

        <button type="submit" name="ggwp" class="btn btn-primary btn-block btn-large">Park</button>
    </form>
</div>

