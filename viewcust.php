<?php
include_once('table.html');
session_start();

?>

<html>
<title> View Customer </title>
<html>

<?php

require_once('connection.php');

$res = mysqli_query($connection, "SELECT ic, name, username, phone, email FROM user WHERE type = 'Customer' ");

if(mysqli_num_rows($res) >= 1)
{
	echo '<table align="center" border="1" width="100%">
	<tr>

	<th> IC </th>
	<th> Name </th>
	<th> Username </th>
	<th> Contact Number </th>
	<th> Email </th>
	<th> Park </th>
	</tr>';

	while($row = mysqli_fetch_array($res))
	{	
		$temp = $row['ic'];
		$check = mysqli_query($connection, "SELECT * FROM park WHERE ic = '$temp' AND status = 0 ");

		$row2      = $check->fetch_array(); 

		$count    = $check->num_rows;

		echo '<tr>';
		echo '<td><p>'.$row['ic'].'</p></td>';
		echo '<td><p>'.$row['name'].'</p></td>';
		echo '<td><p>'.$row['username'].'</p></td>';
		echo '<td><p>'.$row['phone'].'</p></td>';
		echo '<td><p>'.$row['email'].'</p></td>';

		echo '<td>
		<form method ="post" action ="parkinfo.php">
		<button type="submit" name="park" value="Park"/> Park </button>
		<input type="hidden" name = "ic" value="'.$row['ic'].'"/>
		</form>';

		echo "<br>";

		if($count == 1)
		{
		echo '<form method ="post" action ="parkPay.php">
		<button type="submit" name="pay" value="Pay"/> Pay </button>
		<input type="hidden" name = "id" value="'.$row2['id'].'"/>
		<input type="hidden" name = "ic" value="'.$row['ic'].'"/>
		</form>';
     	}

		echo '</td>';


		echo '<tr>';
		
	}

	echo '</table>';
}
else
{
	echo "no result";
	echo "<br>";
	echo "<br>";

}

