<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/style.css">

      
</head>

<?php
session_start();
include("connection.php"); // connection to database
?>

<?php if (isset($_POST['btnregister'])) {
    $ic = mysqli_real_escape_string($connection, $_POST['ic']);
    $username = mysqli_real_escape_string($connection, $_POST['user']);  
    $password = mysqli_real_escape_string($connection, $_POST['pass1']);
    $password = md5($password);
    $type   = "Customer"; 
    $name=mysqli_real_escape_string($connection,$_POST['name']);   
    $phone=mysqli_real_escape_string($connection,$_POST['phone']);
    $email=mysqli_real_escape_string($connection,$_POST['email']);  
    $check_icno = $connection->query("SELECT ic FROM user WHERE ic='$ic'"); 
    $countic = $check_icno->num_rows;
    $check_username = $connection->query("SELECT username FROM user WHERE username='$username'"); $countun = $check_username->num_rows;   if (($countic == 0) && ($countun == 0)) {
    $query  = "INSERT INTO user(ic, name,username,phone,email,password,type) VALUES ('$ic','$name','$username','$phone', '$email', '$password', '$type')";   
if ($connection->query($query)) {
            $msg = "<div class='alert alert-success'>  <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Successfully registered - User level is Customer !   </div>";
        } else {
            $msg = "<div class='alert alert-danger'>  <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error while registering !   </div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>   <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Sorry.. Username or IC Number already exist!    </div>";
    }
    $connection->close();
} ?>


<?php 
    if (isset($_POST['btn-login'])) {
    $username = mysqli_real_escape_string($connection, $_POST['username']);   
    $password = mysqli_real_escape_string($connection, $_POST['password']);   
    $passcode = md5($password); // Encrypted Password 
    $sql      = "SELECT * FROM user WHERE username='$username' and password='$passcode'"; 
    
    $query    = mysqli_query($connection,$sql); 
    
    $row      = $query->fetch_array(); 
    
    $count    = $query->num_rows; // if email/password are correct returns must be 1 row
    if ($count == 1)   {
        $_SESSION['username'] = $row['username'];   
        $_SESSION['level'] = $row['type'];   
        $_SESSION['icno'] = $row['ic'];
        $ic = $_SESSION['icno'];  

        if ($row['type'] == "Administrator")   {
            header("Location: admin.php");
        }   
        else if ($row['type'] == "Customer")   {
            header("Location: member.php");
        }
        else if ($row['type'] == "Staff")   {
            header("Location: member.php");
        }
    }  else  {
        $msg = "<div class='alert alert-danger'>    <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Username or Password is invalid !    </div>";
    }
    $connection->close();
}?>



<body>

  <div class="wrapper">
        

  <div class="login is-active">

    <?php
if (isset($msg)) {
    echo '<span style="color:#AFA;text-align:center;">'.$msg.'</span>';
    echo '<br>';
}
?>
    <h1>Login</h1>  <hr/>
<form action="" method="post" id="form1"> 

    <div class="form-element">
      <span><i class="fa fa-user"></i></span><input type="text" id="username" name ="username" placeholder="Username"/>
    </div>
    <div class="form-element">
      <span><i class="fa fa-lock"></i></span><input type="password" name ="password" id="password" placeholder=" Password"/>
    </div>
    <button type = "submit" class="btn-login" name="btn-login">Login</button>
  </form>
  </div>
  
  <form action="" method="post" name = "form" id="form" onsubmit="return validateform();">
  <div class="register down">

      <h1> Sign Up </h1>
    <div class="form-element">
      <span><i class="fa fa-user"></i></span><input type="text" name="name" id="name" placeholder="Full Name"/>
    </div>

    <div class="form-element">
      <span><i class="fa fa-user"></i></span><input type="text" name="user" id="user" placeholder="Username"/>
    </div>

    <div class="form-element">
      <span><i class="fa fa-user"></i></span><input type="text" name="ic" id="ic" placeholder="IC Number"/>
    </div>


    <div class="form-element">
      <span><i class="fa fa-user"></i></span><input type="text" name="phone" id="phone" placeholder="Phone Number"/>
    </div>

    <div class="form-element">
      <span><i class="fa fa-envelope"></i></span><input type="email" name="email" id="email" placeholder="Your Email Address"/>
    </div>

    <div class="form-element">
      <span><i class="fa fa-lock"></i></span><input type="password" name="pass1" id="pass1" placeholder="Password"/>
    </div>

    <div class="form-element">
      <span><i class="fa fa-lock"></i></span><input type="password" name="pass2" id="pass2" placeholder="Re-Enter Password"/>
    </div>

    <button type = "submit" class="btn-register" name="btnregister">Register</button>
  </div>

</form>
  
  <div class="login-view-toggle">
    <div class="sign-up-toggle is-active">Don't have an account? <a href="#">Sign Up</a></div>
    <div class="login-toggle">Already have an account? <a href="#">Login</a></div>
  </div>
</div>
  <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>

    <script  src="js/index.js"></script>

</body>
</html>

<script>


function validateform()
{

  var name=document.forms["form"]["name"].value;
  var user=document.forms["form"]["user"].value;
  var ic=document.forms["form"]["ic"].value;
  var email = document.forms["form"]["email"].value;
  var phone = document.forms["form"]["phone"].value;
  var pass1 = document.forms["form"]["pass1"].value;
  var pass2 = document.forms["form"]["pass2"].value;

  if(name == "")
  {
    alert('Name Cannot Be Empty!');
    return false;
  }

  if(user =="" || user.length < 5)
  {
    if(user=="")
    {
      alert('Username cannot be empty!');
      return false;
    }
    else if(user.length < 5)
    {
      alert('Username must be at least 5 characters!');
      return false;
    }

  }

if(ic.length != 12 || isNaN(ic) )
{
  if(ic.length != 12)
  {
    alert('IC must be exactly 12 characters!');
    return false;
  }
  else if( isNaN(ic))
  {
    alert('IC must contain numbers only!');
    return false;

  }
}

    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

 if(email == "" || reg.test(email) == false)
    {
      if(email == "")
      {
        alert('Email cannot be empty!');
        return false;
      }

      if (reg.test(email) == false) 
        {
          alert('Email is not valid!');
          return false;
        }
    }

    if(phone == "" || phone <= 11)
    {
      if(phone == "")
      {
        alert('Phone number cannot be empty!');
        return false;
      }

      if(phone <=1)
      {
        alert('Phone number must be less than 11');
        return false;
      }

    }


    if(pass1 == "" || pass1.length < 6)
    {
      if(pass1 =="")
      {
        alert('Password cannot be empty!');
        return false;
      }
      else if(pass1.length < 6)
      {
        alert('Password must be more than 6 characters!');
        return false;
      }
    }

    if(pass2 == "" || pass2.length < 6)
    {
      if(pass2 =="")
      {
        alert('Password cannot be empty!');
        return false;
      }
      else if(pass2.length < 6)
      {
        alert('Password must be more than 6 characters!');
        return false;
      }
    }

    if(pass1 != pass2)
    {
      alert('Password does not match!');
      return false;
    }

}
</script>