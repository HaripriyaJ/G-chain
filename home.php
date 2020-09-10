<html>
    <head>
        <title>HOME</title>
        <link href="style.css" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <style>
		html{
			position:fixed;
			top:0;
			bottom:0;
			left:0;
			right:0;
		}
		.flip-card {
			background-color: transparent;
			width: 300px;
			height: 300px;
		}

		.flip-card-inner {
			position: relative;
			width: 100%;
			height: 100%;
			text-align: center;
			transition: transform 0.6s;
			transform-style: preserve-3d;
			box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
		}

		.flip-card:hover .flip-card-inner {
			transform: rotateY(180deg);
		}

		.flip-card-front, .flip-card-back {
			position: absolute;
			width: 100%;
			height: 100%;
			-webkit-backface-visibility: hidden;
			backface-visibility: hidden;
		}

		.flip-card-front {
			background-color: black;
			color: brown;
		}

		.flip-card-back {
			background-color: black;
			color: white;
			transform: rotateY(180deg);
			box-shadow: 0px 0px 90px brown;

		}
		/* Float four columns side by side */
		.column {
			float: left;
			padding: 50px 0px;
		}


		
	</style>
        
    </head>
    <body style="background-color: black; ">
        <nav class="navtop" style="box-shadow: 5px 5px 20px brown; height:90px;">
			<div>
				<h1><a class="navbar-brand" href="#" style="float:left;">
				<img src="/blockdata/Applicant/dependency/images/gchan.png" alt="" style="height:80px;width:80px;"> </a></h1>
				<a href="Register/register.html"><i class="fas fa-user-circle"></i>REGISTER</a>
               			 <a href="login.php"><i class="fas fa-user-circle"></i>LOGIN</a>
			</div>
        </nav>
        <br/>
        <br/>
        <br/>
	<hr/>
        <div class="row">
			<div class="column" style="padding-left: 140px; ">
				<div class="flip-card" >
					<div class="flip-card-inner" >
						<div class="flip-card-front" >
							<h1 style="border: 1px solid brown;">#1</h1>
							<img src="/blockdata/Applicant/dependency/images/gchan.png" alt="Avatar" 
							style="width:300px;height:300px;border: 1px solid brown;">
						</div>
						<div class="flip-card-back">
							<hr/>
							<h2>OUR MISSION</h2>
							<hr/>
							<hr/>
							<p>In this digital era we provide a solution that makes the life of an employee more digitized and secure.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="column" style="padding-left: 30px;">
				<div class="flip-card">
					<div class="flip-card-inner">
						<div class="flip-card-front">
							<h1 style="border: 1px solid brown;">#2</h1>
							<img src="/blockdata/Applicant/dependency/images/gchan.png" alt="Avatar" 
							style="width:300px;height:300px;border: 1px solid brown;">
						</div>
						<div class="flip-card-back">
							<hr/>
							<h2>OUR PROMISE</h2>
							<hr/>
							<hr/>
							<p>One portal solution for all your Government provided benefit.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="column" style="padding-left: 30px;">
				<div class="flip-card">
					
					<div class="flip-card-inner">
						<div class="flip-card-front">
							<h1 style="border: 1px solid brown;">#3</h1>
							<img src="/blockdata/Applicant/dependency/images/gchan.png" alt="Avatar" 
							style="width:300px;height:300px;border: 1px solid brown;">
						</div>
						<div class="flip-card-back">
							<hr/>
							<h2>OUR ESSENCE</h2>
							<hr/>
							<hr/>
							<p>A click away from a better, secured, compatible and constructive future.</p>
						</div>
					</div>
				</div>
			</div>
			
			<div class="column" style="padding-left: 30px;">
				<div class="flip-card">
					<div class="flip-card-inner">
					<div class="flip-card-front">
						<h1 style="border: 1px solid brown;">#4</h1>
						<img src="/blockdata/Applicant/dependency/images/gchan.png" alt="Avatar" 
						style="width:300px;height:300px;border: 1px solid brown;">
					</div>
					<div class="flip-card-back">
						<hr/>
						<h2>OUR VIBE</h2>
						<hr/>
						<hr/>
						<p>Forget the tension of keeping tabs on your benfits and its various stages of progress. G-chain will do that for you.</p>
					</div>
					</div>
				</div>
			</div>
			
		</div>
    </body>
</html>
