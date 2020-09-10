<?php
    require("database.php");
    session_start();
    if(isset($_POST['login'])){

        $email = $_POST['email'];
        $sql ="SELECT * FROM applicant_db WHERE email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
        {
            $row=mysqli_fetch_assoc($result);
            $uid = $row['aadhar'].$row['email'];
            $_SESSION['aadhar'] = $row['aadhar'];
            $_SESSION['uid']=$uid;
            $_SESSION['email']=$row['email'];
            $sql ="SELECT * FROM approvaldb WHERE uid='$uid'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) 
            {
                $_SESSION['status'] = "Yes";
                
            }
            else
            {
                $_SESSION['status'] = "No";
            }
            header("location: /blockdata/Applicant/applicantHome.php");
        } 
        else { 
            echo "NOT A REGISTERED USER"; 
        }
    }
?>
<html>
    <head>
        <title>Login</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="loginStyle.css" rel="stylesheet" type="text/css">
        <style>
            	html
		{
			position:fixed;
			top:0;
			bottom:0;
			left:0;
			right:0;
		}
        </style>
    </head>
    <body>
	    <nav class="navtop" style="box-shadow: 0px 0px 40px chocolate;height:90px;background-color:black;">
		    <div>
			<h1><a class="navbar-brand" href="#" style="float:left;">
			<img src="/blockdata/Applicant/dependency/images/gchan.png" alt="" style="height:80px;width:80px;"> </a></h1>
			<a href="home.php"><i class="fas fa-sign-out-alt"></i>Home</a>
		    </div>
	    </nav>
	    <div class="login" style="box-shadow: 0px 0px 40px chocolate;">
			<h1>APPLICANT LOGIN</h1>
		<form method="post">
		    <label for="username">
			<i class="fas fa-user"></i>
		    </label>
		    <input type="text"  placeholder="Enter your Registered Email ID" id="email" name="email"required>
		    <label for="password">
			<i class="fas fa-lock"></i>
		    </label>
		    <input type="password" name="password" placeholder="Password" id="pass" required>
		    <center><a href="Employee/index.html">Not an applicant? Sign in here!</a></center>
		    <input type="submit" id="login" value= "LOGIN" name="login">

		</form>
	    </div>
    </body>
</html>
