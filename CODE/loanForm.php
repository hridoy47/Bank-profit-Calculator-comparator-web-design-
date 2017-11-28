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

<!doctype html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LOAN Form</title>
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
</head> <body style="background-image:url(images/Mountain-Sea-Sky-Desktop-Wallpapers-4.jpg); background-size:cover" data-spy="scroll" data-target=".navbar" data-offset="50">
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
 $p1 = $_POST['Loan_Ammount1(tk)'];
 $p2 = $_POST['Loan_Ammount(tk)'];
$p=$p1+$p2;
  $t1= $_POST['Loan_Period1(in_Month)'];
 $t2= $_POST['Loan_Period(in_Month)'];
 $t=$t1+$t2;
 $sql = "SELECT * FROM loan ORDER BY Loan_interest ASC";
 $result = mysqli_query($connection, $sql);

if(!$result){die("fail");}

?>
<?php
echo "<table class=table>";
echo "<center><h1>লোন হিসাবের ফলাফল</h1><center>";
echo "<tbody";
echo "<tr>";
	echo "<td>";
	echo "<b>ব্যাংকের নাম</b>";
	echo "</td>";
	echo "<td>";
	echo "<b>ঋণের পরিমাণ</b>";
	echo "</td>";
	echo "<td>";
	echo "<b>শতকরা মূনাফার হার</b>";
	echo "</td>";
	echo "<td>";
	echo "<b>মাসিক পরিশোধের পরিমাণ</b>";
	echo "</td>";
	echo "<td>";
	echo "<b>মোট পরিশোধের পরিমাণ</b>";
	echo "</td>";
	echo "<td>";
	echo "<b>মোট সুদের পরিমাণ</b>";
	echo "</td>";
echo "</tr>";
	
while ($row = mysqli_fetch_row($result))
{
	echo "<tr>";
	echo "<td>";
	echo $row[0];
	echo "</td>";
	$r=$row[1];
	
	
	echo "<td>";
	echo $p;
	echo "</td>";
	$k=($r/100)/$t;
	$m=pow(1+$k,$t);
	$a= $p*($k+$k/($m-1));
    echo "<td>";
	echo round($r,3);
	echo " %";
	echo "</td>";
	echo "<td>";
	echo round($a,3);
	echo "</td>";
	echo "<td>";
	echo round($a*$t,3);
	echo "</td>";
	echo "<td>";
	echo round($a*$t-$p,3);
	echo "</td>";
	echo "</tr>";
}
echo "</tbody>";
echo "</table>";

?>





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