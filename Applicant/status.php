<?php
    //use unique id to identify the applicant
    require("./dependency/database.php");
    session_start();
    $use = array();

    $uid = $_SESSION['uid'];
    $sql ="SELECT emp1,emp2,emp3,emp1_time, emp2_time, emp3_time FROM approvaldb WHERE uid='$uid'";
    $result = $conn->query($sql);
    if($result){
        $row=mysqli_fetch_assoc($result);
        $emp1 = $row['emp1'];
        $emp2 = $row['emp2'];
        $emp3 = $row['emp3'];
        $emp1_time = $row['emp1_time'];
        $emp2_time = $row['emp2_time'];
        $emp3_time = $row['emp3_time'];        
    }
    else
    {
        echo "<script>alert('Some Error occured, try again later!');</script>";
    }
    // comment fetch
    $com = "SELECT * FROM commentdb WHERE uid='$uid'";
    $res = $conn->query($com);
    
    if($res){
        $cols = mysqli_fetch_assoc($res);
        $use[] = $cols['emp_name'];
        $use[] = $cols['comment'];
        $use[] = $cols['time'];
        // username, email, designation
    }
    $detail = "SELECT * FROM accounts WHERE username='$use[0]'";
    $r = $conn->query($detail);
    if($r){
        $ret = mysqli_fetch_assoc($r);
        $use[] = $ret['email'];
        $use[] = $ret['designation'];
    }
    $final = json_encode($use);   
   
?>
<!DOCTYPE html>
<html>
    <head>
		<link href="./dependency/style.css" rel="stylesheet" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="/blockdata/node_modules/web3/dist/web3.min.js"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
		<style>
			html{
				position:fixed;
				top:0;
				bottom:0;
				left:0;
				right:0;
            }
            table.table-bordered > thead > tr > th{
                border:1px solid red;
            }
            table.table-bordered > tbody > tr > td{
                border:1px solid red;
            }
		</style>
    </head>
    <body style="background-color: black;">
        <nav class="navtop" style="box-shadow: 5px 5px 20px purple; background-color:black;height:90px">
			<div>
				<h1><a class="navbar-brand" href="#" style="float:left;">
					<img src="/blockdata/Applicant/dependency/images/gchan.png" alt="" style="height:85px;width:80px;"> </a></h1>
				<a href="applicantHome.php"><i class="fas fa-sign-out-alt"></i>HOME</a>
			</div>
        </nav>
		<br/>
		<br/>
		<br/>
        <div class="span8 ">
            <span class="shadow-lg p-4 mb-4 rounded" style="color:purple;" ><center><h3>YOUR APPLICATION STATUS</h3><hr/></center></span>
        </div>
        <script>

            //acceptance status
            var time_emp1 = new Date(<?=$emp1_time?> * 1000);
            var time_emp2 = new Date(<?=$emp2_time?> * 1000);
            var time_emp3 = new Date(<?=$emp3_time?> * 1000);
            

            // rejection status
            var results = <?=$final?>;
            var t = new Date(results[2] * 1000);
            var datestring = t.getDate()  + "/" + (t.getMonth()+1) + "/" + t.getFullYear() + "; @" +t.getHours() + ":" + t.getMinutes()+":" + t.getSeconds();
            var result = '<table class="table table-bordered""><thead><hr><h5>DETAILED REPORT</h5><hr></thead><tbody><tr><td>AUTHORITY RESPONSIBLE</td><td>'+ results[0] + '</td></tr><tr class="table-danger"><td>REASON SPEFICIED</td><td>'+results[1]+ '</td></tr><tr><td>CONTACT EMAIL-ID</td><td>'+ results[3] + '</td></tr><tr class="table-danger"><td>DESIGNATION:</td><td>'+results[4]+ '</td></tr><tr><td>UPDATED ON:</td><td>'+datestring+'</td></tbody></table>';            
            
        </script>
        <div class="container" style="color:purple;">
            <div class="card-deck">
                <div class="card " id="card1" style=" background-color:black;">
                    <div class="card-body " style="box-shadow: 0px 0px 70px purple;">
                        <center><h5 class="card-title">STAGE 1</h5></center> <hr>
                        <p class="card-text">
                            <?php if($emp1 == 1 && $emp2 == 0): ?>
                                <center><i class="fas fa-exclamation fa-5x" style="color:chocolate;"></i></center><br/>
                                <hr>
                                <button type="button" class="btn btn-outline-warning btn-block" onclick="clerkWait()">VIEW DETAILS</button>
                                <script>
                                    function clerkWait(){
                                        Swal.fire({
                                            icon: 'warning',
                                            title: 'Action Pending!',
                                            showConfirmButton: true,
                                            confirmButtonColor: '#FFA500'
                                        }).then((result) => {
                                            if(result.value) {
                                                
                                            }
                                        })
                                    }
                                </script>
                            <?php endif ?>
                            <?php if(($emp1 == 0 && $emp2 ==1) || ($emp1 == 0 && $emp2 ==-1) || ($emp1 == 0 && $emp2 ==0) ): ?>
                                <center><i class="fa fa-check fa-5x" style="color: green;"></i></center><br/>
                                <hr>
                                <button type="button" class="btn btn-outline-success btn-block" onclick="clerkYes()">VIEW DETAILS</button>
                                <script>
                                    function clerkYes(){
                                        var content = "<div class='container'><hr/><b><i>Application status was updated at: </i></b><br/>"+time_emp1+"<hr/></div>";
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Application Approved!',
                                            html: content,
                                            showConfirmButton: true,
                                            confirmButtonColor: '#008000'
                                        }).then((result) => {
                                            if(result.value) {
                                                
                                            }
                                        })
                                    }
                                </script>
                            <?php endif ?>
                            <?php if($emp1 == -1): ?>
                                <center><i class="fa fa-times fa-5x" style="color: red;" ></i></center><br/>
                                <hr>
                                <button type="button" class="btn btn-outline-danger btn-block" onclick="clerkNo()">VIEW DETAILS</button>
                                <script>
                                    function clerkNo(){
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Application Rejected!',
                                            html: result,
                                            showConfirmButton: true,
                                            confirmButtonColor: '#d33'
                                        }).then((result) => {
                                            if(result.value) {
                                                
                                            }
                                        })
                                        
                                    }
                                </script>
                            <?php endif ?>
                        </p>
                    </div>
                </div>
                <div class="card ml-5" id="card2" style=" background-color:black;">
                    
                    <div class="card-body" style="box-shadow: 0px 0px 70px purple;">
                        <center><h5 class="card-title">STAGE 2</h5></center> <hr>
                        <p class="card-text">
                            <?php if($emp1 == 0 && $emp2 == 1): ?>
                                <center><i class="fas fa-exclamation fa-5x" style="color:chocolate;"></i></center><br/>
                                <hr>
                                <button type="button" class="btn btn-outline-warning btn-block" onclick="supWait()">VIEW DETAILS</button>
                                <script>
                                    function supWait(){
                                        Swal.fire({
                                            icon: 'warning',
                                            title: 'Action Pending!',
                                            showConfirmButton: true,
                                            confirmButtonColor: '#FFA500'
                                        }).then((result) => {
                                            if(result.value) {
                                                
                                            }
                                        })
                                    }
                                </script>
                            <?php endif ?>
                            <?php if(($emp1 ==0 && $emp2 == 0 && $emp3 ==1) || ($emp1 ==0 && $emp2 == 0 && $emp3 ==-1)): ?>
                                <center><i class="fa fa-check fa-5x" style="color: green;"></i></center><br/>
                                <hr>
                                <button type="button" class="btn btn-outline-success btn-block" onclick="supYes()">VIEW DETAILS</button>
                                <script>
                                    function supYes(){
                                        var content = "<div class='container'><hr/><b><i>Application status was updated at: </i></b><br/>"+time_emp2+"<hr/></div>";
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Application Approved!',
                                            html: content,
                                            showConfirmButton: true,
                                            confirmButtonColor: '#008000'
                                        }).then((result) => {
                                            if(result.value) {
                                                
                                            }
                                        })
                                    }
                                </script>
                            <?php endif ?>
                            <?php if($emp2 == -1): ?>
                                <center><i class="fa fa-times fa-5x" style="color: red;" ></i></center><br/>
                                <hr>
                                <button type="button" class="btn btn-outline-danger btn-block" onclick="supNo()">VIEW DETAILS</button>
                                <script>
                                    function supNo(){
                                        
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Application Rejected!',
                                            html:result,
                                            showConfirmButton: true,
                                            confirmButtonColor: '#d33'
                                        }).then((result) => {
                                            if(result.value) {
                                                
                                            }
                                        })
                                        
                                    }

                                </script>
                            <?php endif ?>
                        </p>
                    </div>
                </div>
                <div class="card ml-5" id="card3" style=" background-color:black;">
                    
                    <div class="card-body" style="box-shadow: 0px 0px 70px purple;">
                        <center><h5 class="card-title">STAGE 3</h5></center> <hr>
                        <p class="card-text">
                            <?php if($emp2 == 0 && $emp3 == 1): ?>
                                <center><i class="fas fa-exclamation fa-5x" style="color:chocolate;"></i></center><br/>
                                <hr>
                                <button type="button" class="btn btn-outline-warning btn-block" onclick="seWait()">VIEW DETAILS</button>
                                <script>
                                    function seWait(){
                                        Swal.fire({
                                            icon: 'warning',
                                            title: 'Action Pending!',
                                            showConfirmButton: true,
                                            confirmButtonColor: '#FFA500'
                                        }).then((result) => {
                                            if(result.value) {
                                                
                                            }
                                        })
                                    }
                                </script>
                            <?php endif ?>
                            <?php if($emp1 ==0 && $emp2 == 0 && $emp3 ==0): ?>
                                <center><i class="fa fa-check fa-5x" style="color: green;"></i></center><br/>
                                <hr>
                                <button type="button" class="btn btn-outline-secondary btn-block" onclick="seYes()">VIEW DETAILS</button>
                                <script>
                                    function seYes(){
                                        var content = "<div class='container'><hr/><b><i>Application status was updated at: </i></b><br/>"+time_emp3+"<hr/></div>";
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Application Approved!',
                                            html: content,
                                            showConfirmButton: true,
                                            confirmButtonColor: '#008000'
                                        }).then((result) => {
                                            if(result.value) {
                                                
                                            }
                                        })
                                    }
                                </script>
                            <?php endif ?>
                            <?php if($emp3 == -1): ?>
                                <center><i class="fa fa-times fa-5x" style="color: red;" ></i></center><br/>
                                <hr>
                                <button type="button" class="btn btn-outline-danger btn-block" onclick="seNo()">VIEW DETAILS</button>
                                <script>
                                    function seNo(){
                                        
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Application Rejected!',
                                            html: result,
                                            showConfirmButton: true,
                                            confirmButtonColor: '#d33'
                                        }).then((result) => {
                                            if(result.value) {
                                                
                                            }
                                        }) 
                                    }
                                </script>
                            <?php endif ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <hr/>
        <div class="container" style="color:purple;height:30px;">
            <div class="row">
                <div class="col">
                    <center>
                        <h5>
                            <i class="fa fa-check" style="color:green;"></i> : Form Approved &ensp;&emsp;
                            <i class="fas fa-exclamation" style="color:chocolate;"></i> : Form Pending (waiting for action) &ensp;&emsp;
                            <i class="fa fa-times" style="color:red;"></i> : Form Rejected 
                        </h5>
                    </center>
                </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->
        </div>
               
       
        <script> 
            $(document).ready(function ()
            {

                var emp1 = <?=$emp1?>;
                var emp2 = <?=$emp2?>;
                var emp3 = <?=$emp3?>;
            
                var statusCheck = "visible";
                if((emp1==1) && (emp2==0) && (emp3==0) )
                {
                    document.getElementById("card1").style.borderColor = "chocolate";
                    document.getElementById("card1").style.borderWidth = "5px";

                }
                else if((emp1==0) && (emp2==1) && (emp3==0))
                {
                    document.getElementById("card2").style.borderColor = "chocolate";
                    document.getElementById("card2").style.borderWidth = "5px";

                }
                else if ((emp1==0) && (emp2==0) && (emp3==1)){
                    document.getElementById("card3").style.borderColor = "chocolate";
                    document.getElementById("card3").style.borderWidth = "5px";
                }
                else if((emp1==-1)) //rejected by emp1
                {
                    document.getElementById("card1").style.borderColor = "red";
                    document.getElementById("card1").style.borderWidth = "5px";
                }
                else if((emp2==-1)) //rejected by emp2
                {
                    document.getElementById("card2").style.borderColor = "red";
                    document.getElementById("card2").style.borderWidth = "5px";
                }
                else if((emp3==-1)) //rejected by emp3
                {
                    document.getElementById("card3").style.borderColor = "red";
                    document.getElementById("card3").style.borderWidth = "5px";
                }
            });
        </script>

    </body>
</html>
