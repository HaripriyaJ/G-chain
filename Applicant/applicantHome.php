<?php
  session_start();
  if(!$_SESSION['email']){
    echo "<script>window.location.href='login.php'</script>";
    exit;
  }
  require("./dependency/database.php");
  $uid = $_SESSION['uid'];  # Unique id

?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>APPLICANT HOME</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
  <link rel="stylesheet" href="./dependency/applicantHome.css">
  <link rel="stylesheet" href="./dependency/style.css">
  <style>
    hr.new1 {
      border-top: 1px solid black;
    }
    html{
          position:fixed;
          top:0;
          bottom:0;
          left:0;
          right:0;
    }
  
  </style>
</head>
<body style="background-color:black;">
<div class="container-fluid main">

  <nav class="navbar navbar-default" style="background-color:black;box-shadow: 5px 5px 15px yellow;height:90px;" >
    <div class="container-fluid">
    <a class="navbar-brand" href="#" style="float:left;">
          <img src="./dependency/images/gchan.png" alt="" style="height:65px;width:80px;"> </a>

      <div class="collapse navbar-collapse" id="myNavbar" style="float:right;">
        <ul class="nav navbar-nav ml-auto">
          <li><a href="">Welcome,<?php echo $_SESSION['email'];?>!</a></li>

          <!-- Display only if the user has not submitted the application-->
          <?php if ($_SESSION['status'] == "No"): ?>
            <li><a href="Form/form.php">SUBMIT APPLICATION</a></li>
          <?php endif ?>
          
          <?php if ($_SESSION['status'] == "Yes"): ?>
            <li><a href="status.php">VIEW STATUS</a></li>
          <?php endif ?>
          <li><a href="logoutApplicant.php">LOG OUT</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <hr class="new1">
  <hr class="new1">
  <hr class="new1">
  <hr class="new1">
  <div id="myCarousel" class="carousel carousel-fade slide" data-ride="carousel" data-interval="3000" >
    <div class="carousel-inner" role="listbox">
      <div class="item active background a"></div>
      <div class="item background b"></div>
      <div class="item background c"></div>
    </div>
  </div>
  
  <div class="covertext">
    <div class="col-lg-10" style="float:none; margin:0 auto;">
      <h1 class="title">G-Chain</h1>
      <h3 class="subtitle">A File Tracking Government System</h3>
    </div>
    <div class="col-xs-12 explore">
      <a href="about.html"><button type="button" class="btn btn-lg explorebtn">EXPLORE</button></a>
    </div>
  </div>
  
</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script><script  src="./dependency/scriptApplicant.js"></script>
</body>
</html>