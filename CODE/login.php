<?php
$dbhost="localhost";
$dbuser="root";
$dbpass="1234";
$dbname="bank";
$connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(mysqli_connect_errno()){
   die("database connection faild: ".mysqli_connect_error()."(".mysqli_connect_errno().")");
}

?>
<?php
require_once("include.php");
?>
<?php

if(isset($_POST['login'])){
	
	if($_POST['username'] && $_POST['pass']){
	$username= mysqli_real_escape_string($connection,$_POST['username']);
	$password= mysqli_real_escape_string($connection,$_POST['pass']);
	$sql="select * from user where Username='$username'";
	$user=mysqli_query($connection,$sql);
	
	while ($row = mysqli_fetch_row($user))
{
	
	if($row==0){
	die("The user does not exist!!!!!<a href='login.php'>&larr; Back</a>");
	}
	if($row[1]!=$password){
		echo $row[1];
	die("Incorrect Password!!!!!<a href='login.php'>&larr; Back</a>");
	}
	if($row[1]==$password){
	redirect_to("update1.php");
	}
	
	}
	}
}

?>


<!doctype html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Form</title>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.12.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
 <style>
  body {
      position: relative; 
  }
  .affix {
      top:0;
      width: 85%;
	
      z-index: 9999 !important;
      
  }
 
  .affix ~ .container-fluid {
     position: relative;
     top: 50px;
  }
  </style>
</head> 
<body style="background-image:url(images/Mountain-Sea-Sky-Desktop-Wallpapers-4.jpg); background-size:cover" data-spy="scroll" data-target=".navbar" data-offset="50">
<div class="container" style="background-color:#F8F4F4; background-image:url(images/White-Color-Background-_07.jpg)">
<div class="container-fluid" style=" background-size:cover; background-repeat:no-repeat;background-image:url(images/b4.jpg);background-color:#F44336;color:#fff;height:200px;">
 <h1>ব্যাংক লভ্যাংশের তুলনা</h1>
  <h3>আপনার কষ্টার্জিত টাকার সঠিক লভ্যাংশ আপনি পাচ্ছেন তো? </h3>
  <p>আপনার উপার্জিত টাকা বিনিয়োগ করুন সঠিক ব্যাংকে। </p>
  
</div>

<nav class="navbar navbar-inverse"  data-spy="affix" data-offset-top="197">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
       <a href="bank.html"><button type="button" class="btn btn-lg btn-link active">
      <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
      </button></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav  navbar-nav ">
        <li ><a href="bank.html">হোম <span class="sr-only">(current)</span></a></li>
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">হিসাব  <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="fdr.html">ফিক্সড ডিপোজিট রিসিপ্ট(FDR)</a></li>
            <li><a href="dps.html">ডিপোজিট পেনশন স্কিম(DPS)</a></li>
            <li><a href="loan.html" >ঋণ(LOAN)</a></li>
            
            
            
          </ul>
        </li>
        <li><a href="Bweb.html">বিভিন্ন ব্যাংকের লিঙ্ক</a></li>
        <li><a href="#AboutUs">আমাদের সম্পর্কে</a></li>
        <li><a href="#Contact">যোগাযোগের জন্য </a></li>
       
      </ul>
       <ul class="nav navbar-nav navbar-right">
        <li><a href="login.php">লগ ইন </a></li>
        </ul>
      <form class="navbar-form navbar-right" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
      </form>
     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<hr>

<?php
// define variables and set to empty values
$nameErr = $emailErr = $passErr = $websiteErr =  $usernameErr="";
$name = $email = $pass = $comment = $website = $username="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["username"])) {
     $usernameErr = " Name is required";
   } else {
     $username = test_input($_POST["username"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*[0-9]*$/",$username)) {
       $usernameErr = "Only letters and white space allowed";
     }
   }
  
   if (empty($_POST["email"])) {
     $emailErr = " Email is required";
   } else {
     $email = test_input($_POST["email"]);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailErr = " Invalid email format";
     }
   }
    
   if (empty($_POST["website"])) {
     $website = "";
   } else {
     $website = test_input($_POST["website"]);
     // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
     if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
       $websiteErr = "Invalid URL";
     }
   }

   if (empty($_POST["comment"])) {
     $comment = "";
   } else {
     $comment = test_input($_POST["comment"]);
   }

   if (empty($_POST["gender"])) {
     $genderErr = " Gender is required";
   } else {
     $gender = test_input($_POST["gender"]);
   }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<center><h2>LOG IN</h2>
<p><span class="error" style="color:#F51317">* required field.</span></p></center>

<form class="form-group" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 <table class="table" align="center">
   <tr align="center">
   <td><b>Username:</b></td> 
   <td><input type="text" name="username" value="<?php echo $username;?>">
   <span class="error" style="color:#F51317">* </span>
   <td style="color:#F51317"><?php echo $usernameErr;?></td>
   </td>
   </tr>
   <br><br>
   <tr align="center">
   <td><b>E-mail:</b></td>
   <td> <input type="text" name="email" value="<?php echo $email;?>">
   <span class="error" style="color:#F51317">*</span></td>
   <td style="color:#F51317"> <?php echo $emailErr;?></td>
   </tr>
   <br><br>
   <tr align="center">
   <td><b>Password:</b></td>
   <td> <input type="password" name="pass" value="<?php echo $pass;?>">
   <span class="error" style="color:#F51317">*</span></td>
   <td style="color:#F51317"> <?php echo $passErr;?></td>
   <br><br>
   </tr>
   
   </table>
   <div align="center">
      <input type="submit"  name="login" value="login"/>
      </div>
</form>


<?php 
mysqli_close($connection);
?>

<br>
<br>
<br>
<hr>
</div>
<div class="container-fluid" style="color:#F5F5F5; background-color:#676767; margin-left:6.5%; margin-right:6.5%" >
 <div class="row">
<div class="col-xs-6 col-sm-6 col-lg-4 col-md-4" id="AboutUs" > <span class="text-right">
      </span>
  <h3>আমাদের সম্পর্কে </h3>
  <hr>
  <p>আমরা মিলিটারি ইনস্টিটিউট অব সায়েন্স এ্যান্ড টেকনোলজির অধীনে সি.এস.ই ডিপার্টমেন্ট এর লেভেল-৩ তে অধ্যয়নরত। </p> <!-- Write something about us -->
  <p>অ্যাপ ডেভলোপমেন্ট কোর্সের প্রজেক্ট হিসেবে আমরা 'ব্যাংক লভ্যাংশের তুলনা' নামক এই ওয়েব সার্ভিসটি তৈরি করেছি।</p> <!-- Write something about us  -->
</div>
<div class="col-xs-6 col-sm-6 col-lg-4 col-md-4 hidden-sm hidden-xs"> <span class="text-right"> </span>
  <h3>সাম্প্রতিক খবর</h3>
  <hr>
  <div class="media-object-default">
  <div class="media">
  <div class="media-body">
        <h4 class="media-heading">মুনাফা বৃদ্ধি</h4>
ট্রাস্ট ব্যাংক তাদের মুনাফা বৃদ্ধি করেছে। </div>

</div>
<div class="media">
  <div class="media-body">
    <h4 class="media-heading">মুনাফা হ্রাস</h4>
ডাচ-বাংলা-ব্যাংক মুনাফা হ্রাস করেছে। </div>
 
</div>
</div>
</div>
<div class="col-xs-6 col-sm-6 col-lg-4 col-md-4" id="Contact"> <span class="text-right"> </span>
  <h3>আমাদের সাথে  যোগাযোগ </h3>
  <hr>
<div class="media">
  <div class="media-left"> <a href="#"> <img class="media-object" src="images/logo.png" style="width:75px; height:75px" alt="placeholder image"></a></div>
  <div class="media-body">
    <address>
      <strong>MIST</strong><br>
      Mirpur Cantonment<br>
      Mirpur, Dhaka-1216<br>
  <abbr title="Phone"><span class="glyphicon glyphicon-phone-alt"></span></abbr> 90213166
      </address>
      </div>
</div>
<div class="media">

 <div class="media-left"> <a href="#"> <img class="media-object" src="images/Picture2.png" style="width:75px; height:75px"  alt="placeholder image"></a></div>
 <div class="media-body">
      <address>
        <strong>Ferdousur Rahman</strong><br>
        <a href="mailto:#" style="color:#2510D3">ferdousurrahman1994@gmail.com</a><br>
        <strong>Saleh Mohammed Nur Mokarrom</strong><br>
        <a href="mailto:#" style="color:#2510D3">mokarrom@yahoo.com</a><br>
        <strong>Shadman Faysal</strong><br>
        <a href="mailto:#" style="color:#2510D3">shadmanfaysal053@gmail.com</a>
      </address>
      </div>
      </div>
</div>
  </div>
  <footer class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <p style="color:#1FA2F5">Copyright @ Hridoy ? All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>

</div>
</body>
</html>