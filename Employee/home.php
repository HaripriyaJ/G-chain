<?php
	// We need to use sessions, so you should always start sessions using the below code.
	session_start();
	// If the user is not logged in redirect to the login page...
	if (!isset($_SESSION['loggedin'])) 
	{
		header('Location: index.html');
		exit;
	}
	else
	{
		$conn= new mysqli("localhost","root","","blockdata");
		if ($conn->connect_error) 
		{
			die("Connection failed: " . $conn->connect_error);
		}
		
		if($_SESSION['name']=="Employee1")
		{
			$sql ="SELECT uid FROM approvaldb WHERE emp1=1";
			$result = $conn->query($sql);
			$uniqueids = array();
			$counter = 0;
			if ($result->num_rows > 0)
			{
				while($row=mysqli_fetch_assoc($result))
				{
					$uniqueids[]= $row['uid'];
					$counter++;
				}
			} 
		}
		elseif($_SESSION['name']=="Employee2")
		{
			//emp2
			$sql ="SELECT uid FROM approvaldb WHERE emp2=1";
			$result = $conn->query($sql);
			$uniqueids = array();
			$counter = 0;
			if ($result->num_rows > 0)
			{
				while($row=mysqli_fetch_assoc($result))
				{
					$uniqueids[]= $row['uid'];
					$counter++;
				}
			} 
		}
		else
		{
			//emp3
			$sql ="SELECT uid FROM approvaldb WHERE emp3=1";
			$result = $conn->query($sql);
			$uniqueids = array();
			$counter = 0;
			if ($result->num_rows > 0)
			{
				while($row=mysqli_fetch_assoc($result))
				{
					$uniqueids[]= $row['uid'];
					$counter++;
				}
			} 
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="./dependency/CSSstyle.css" rel="stylesheet" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="/blockdata/node_modules/web3/dist/web3.min.js"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
		<style>
		
		</style>
	</head>
	<body class="loggedin text-uppercase">
		<script>
			var employee = <?=json_encode($_SESSION['name'])?>;
			console.log(employee);
		</script>
		<nav class="navtop ">
			<div>
				<h1><a class="navbar-brand" href="#" style="float:left;">
          		<img src="/blockdata/Applicant/dependency/images/gchan.png" alt="" style="height:60px;width:80px;"> </a></h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
	
		<div class="content ">
			<p class="shadow-lg p-4 mb-4 border border-success"><b>YOUR DASHBOARD</b></p>
			<script> var employee3 = [];</script>
            <?php for($i=0;$i<$counter;$i++): ?>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.js"></script>
				<script>var uid = "<?php echo $uniqueids[$i];?>"; 
					web3 = new Web3(new Web3.providers.HttpProvider("http://localhost:8545")) // else explicitly specify where to inject
					var gchain = new web3.eth.Contract([
							{
								"constant": false,
								"inputs": [
									{
										"name": "_uid",
										"type": "string"
									},
									{
										"name": "_Name",
										"type": "string"
									},
									{
										"name": "_panno",
										"type": "string"
									},
									{
										"name": "_aadharno",
										"type": "string"
									},
									{
										"name": "_addr",
										"type": "string"
									},
									{
										"name": "_ifsc",
										"type": "string"
									},
									{
										"name": "_bankDetails",
										"type": "string"
									},
									{
										"name": "_designation",
										"type": "string"
									},
									{
										"name": "_startTime",
										"type": "uint256"
									},
									{
										"name": "_endProcess",
										"type": "uint256"
									}
								],
								"name": "SetUserInfo",
								"outputs": [],
								"payable": false,
								"stateMutability": "nonpayable",
								"type": "function"
							},
							{
								"constant": true,
								"inputs": [
									{
										"name": "_uid",
										"type": "string"
									}
								],
								"name": "GetUserInfo",
								"outputs": [
									{
										"name": "",
										"type": "string"
									},
									{
										"name": "",
										"type": "string"
									},
									{
										"name": "",
										"type": "uint256"
									},
									{
										"name": "",
										"type": "uint256"
									}
								],
								"payable": false,
								"stateMutability": "view",
								"type": "function"
							}
						], SMART CONTRACT ADRESS);
					gchain.methods.GetUserInfo(uid).call().then(function(obj){
						var text = obj[0];
						text = text.split("XX");
						var designation = obj[1];
						var startTime = obj[2];
						var endTime = obj[3];

						var trackingid = text[0];
						var applicantName = text[1];
						var panno = text[2];
						var aadharno = text[3];
						var address = text[4];
						var ifsc = text[5];
						var bankdetails = text[6];

						startTime = new Date(startTime*1000);
						endTime = new Date(endTime*1000);
						var employee1 = {}
						var keys = ["uid","name", "pan", "aadhar","address","ifsc","bankdetails","designation","start","end"];
						var values = [trackingid,applicantName, panno, aadharno,address,ifsc,bankdetails,designation,startTime,endTime];
						for(var i = 0; i < keys.length; i++){ 
							employee1[keys[i]] = values[i]; 
						} 
					
						employee3.push(employee1);
																														
					});
				</script>
            <?php endfor?>
			<br/>
			<?php if($counter>0): ?>
				<div class="container shadow-lg p-4 mb-4">
					<!--cards-->
					<div class="card border-info mb-3 shadow-lg p-4 mb-4 "v-for="(employee,index) in employees">
						<div class="card-body">
							
							<span class="float-right text-success" style="cursor: pointer;" @click="approveForm(index)" id="span1">
							ACCEPT <b><i class="fa fa-check"></i></b></span>
							<span id="span2" class="float-left text-danger" style="cursor: pointer;" 
							@click="deleteForm(index)"><b>X</b> REJECT</span><br/>
							<hr/>
							<h4 style="cursor: wait;" class="card-title p-3 mb-3 border border-warning text-center shadow-lg p-4 mb-4 " 
							oncopy="return false" onpaste="return false">{{employee.name}}</h4>
							<hr/>
							<div class="employee-form noselect" :id="employee.pan">
								<p>
									<div class="row ">
										<div class="col pl-5">
											<b>1: Name</b> 
										</div>
										<div class="col" >
											<input type="text" style="cursor: not-allowed;" class="form-control mb-2 text-uppercase" 
											oncopy="return false" onpaste="return false" v-model="employee.name" readonly>
										</div>
									</div>
								</p>
								<p>
									<div class="row">
										<div class="col  pl-5">
											<b>2: Designation:</b> 
										</div>
										<div class="col">
											<input type="text" style="cursor: not-allowed;" class="form-control mb-2 text-uppercase" 
											oncopy="return false" onpaste="return false"  v-model="employee.designation" readonly>
										</div>
									</div>
								</p>
								<p>
									<div class="row">
										<div class="col  pl-5 ">
											<b>2: Pan Number:</b> 
										</div>
										<div class="col">
											<input type="text" rows="2" style="cursor: not-allowed;" class="form-control mb-2 text-uppercase" 
											oncopy="return false" onpaste="return false" v-model="employee.pan" readonly>
										</div>
									</div>
								</p>
								<p>
									<div class="row">
										<div class="col  pl-5">
											<b>3: Aadhar Number:</b> 
										</div>
										<div class="col">
											<input type="text" style="cursor: not-allowed;" class="form-control mb-2 text-uppercase" 
											oncopy="return false" onpaste="return false" v-model="employee.aadhar" readonly>
										</div>
									</div>
								</p>
								<p>
									<div class="row">
										<div class="col  pl-5">
											<b>4: Address: </b> 
										</div>
										<div class="col">
											<textarea type="text" style="cursor: not-allowed;" rows="2"
											class="form-control mb-2 text-uppercase" oncopy="return false" onpaste="return false" v-model="employee.address" readonly></textarea>
										</div>
									</div>
								</p>
								<p>
									<div class="row">
										<div class="col  pl-5">
											<b>5: IFSC:</b> 
										</div>
										<div class="col">
											<input type="text" style="cursor: not-allowed;" class="form-control mb-2 text-uppercase" 
											oncopy="return false" onpaste="return false" v-model="employee.ifsc" readonly>
										</div>
									</div>
								</p>
								<p>
									<div class="row">
										<div class="col  pl-5">
											<b>6: Bank Details:</b> 
										</div>
										<div class="col">
											<textarea type="text" style="cursor: not-allowed;" rows="3" 
											class="form-control mb-2 text-uppercase" oncopy="return false" onpaste="return false" v-model="employee.bankdetails" readonly></textarea>
										</div>
									</div>
								</p>
								<p>
									<div class="row">
										<div class="col  pl-5">
											<b>7: Submitted On:</b> 
										</div>
										<div class="col">
											<input type="text" style="cursor: not-allowed;" class="form-control mb-2 text-uppercase" 
											oncopy="return false" onpaste="return false"  v-model="employee.start" readonly>
										</div>
									</div>
								</p>
								<p>
									<div class="row">
										<div class="col  pl-5">
											<b>8: End Date:</b> 
										</div>
										<div class="col">
											<input type="text" style="cursor: not-allowed;" class="form-control mb-2 text-uppercase" 
											oncopy="return false" onpaste="return false" v-model="employee.end" readonly>
										</div>
									</div>
								</p>
								<hr/>
								
							</div>
						</div>
					</div>
				</div>
			<?php else: ?>
				<p class="shadow-lg p-4 mb-4" > Yayy! All caught up! </p>
			<?php endif ?>
			
			<script>
				var changeDatabase = function(uid,emp)
				{
					console.log(uid + emp);
					Swal.fire({
						title: "REJECTION PROCEDURE",
						text: "Reason for rejecting the application:",
						input: "text",
						showCancelButton: true,
						confirmButtonText: 'REGISTER RESPONSE',
						cancelButtonText: 'CANCEL',
						inputPlaceholder: "Reason is..."
					}).then((result) => 
					{
						if(result.value!="")
						{
							var text = result.value;
							const swalWithBootstrapButtons = Swal.mixin({
							customClass: {
								confirmButton: 'btn btn-success',
								cancelButton: 'btn btn-danger'
							},
							buttonsStyling: false
							})
							swalWithBootstrapButtons.fire({
								title: 'Confirm Action?',
								text: "You won't be able to revert this!",
								icon: 'warning',
								showConfirmButton: true,
								showCancelButton: true,
								confirmButtonText: 'CONFIRM',
								cancelButtonText: 'CANCEL',
							}).then((result) => {
								if (result.value) 
								{
									var d1 = new Date();
									var currentTime = parseInt(d1.getTime()/1000);
									var alertTime = new Date(currentTime * 1000);
									console.log(text);
									var body = "Application Rejected";
									var mail = "";
									for(var i=12;i<uid.length;i++){
										mail= mail+uid[i];
									}
									console.log(mail);
									$.post('alert.php', {body:body, emp:emp, time:alertTime, reason:text, id:mail});
									$.post('rejection.php', {uid:uid, emp:emp, time:currentTime, reason:text}, function(result){
										if(result=="Request Rejected successfully")
										{
											location.reload();
										}
										else
										{
											window.location.reload(); 
										}
									});
								} 
								else if (
									result.dismiss === Swal.DismissReason.cancel
								) 
								{
									swalWithBootstrapButtons.fire(
									'Cancelled',
									'No action performed',
									'error'
									)
								}
							})
						}
											
					})	
				}
				var updateDatabase = function(uid,emp){
					const swalWithBootstrapButtons = Swal.mixin({
					customClass: {
						confirmButton: 'btn btn-success',
						cancelButton: 'btn btn-danger'
					},
					buttonsStyling: false
					})

					swalWithBootstrapButtons.fire({
						title: 'Confirm Action?',
						text: "You won't be able to revert this!",
						icon: 'warning',
						showConfirmButton: true,
						showCancelButton: true,
						confirmButtonText: 'CONFIRM',
						cancelButtonText: 'CANCEL',
					}).then((result) => {
					if (result.value) {
						var d1 = new Date();
                    	var currentTime = parseInt(d1.getTime()/1000);
						var alertTime = new Date(currentTime * 1000);
						var body = "Application Approved";
						var mail = "";
						for(var i=12;i<uid.length;i++){
							mail= mail+uid[i];
						}
						$.post('alert.php', {body:body, emp:emp, time:alertTime, id:mail});
						$.post('approval.php', {uid:uid, emp:emp, time:currentTime}, function(result){
							if(result=="Request Approved successfully")
							{
								Swal.fire({
									icon: 'success',
									title: 'You approved the request!',
									showConfirmButton: true,
									confirmButtonColor: '#3085d6'
								}).then((result) => {
									if(result.value) {
										location.reload();
									}
								})
								
							}
							else
							{
								location.reload();
							}
						});
					} 
					else if (
						/* Read more about handling dismissals below */
						result.dismiss === Swal.DismissReason.cancel
					) 
					{
						swalWithBootstrapButtons.fire(
						'Cancelled',
						'No action performed',
						'error'
						)
					}
					})			
				}
				var app = new Vue({
						el:'.container',
						data:{
							employees:employee3
						},
						methods: {
							deleteForm(index)
							{
								var toUse = employee3[index].uid;
								console.log(employee + "\n" + toUse);
								changeDatabase(toUse,employee);			
							},
							approveForm(index)
							{
								var toUse = employee3[index].uid;
								updateDatabase(toUse,employee);
							}
						}
					})
			</script>	
			</div>
		</div>
	</body>
</html>