<?php
    session_start();
?>
<html>
    <head>
        <title>WELCOME</title> 
        <link rel="stylesheet" type="text/css"  href="./includes/csssample.css">
        <link rel="stylesheet" type="text/css"  href="./includes/main.css">
        <script src="/blockdata/node_modules/web3/dist/web3.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        	
    </head>
    <body >
        <script>
                var  aadharno=  <?=json_encode($_SESSION['aadhar'])?>;
                web3 = new Web3(new Web3.providers.HttpProvider("http://localhost:8545")) // else explicitly specify where to inject
                var abi = SERVICE BOOK SMART CONTRACT ABI
                var employeeDetails = new web3.eth.Contract(abi, SMART CONTRACT ADDRESS);
                web3.eth.getAccounts().then(function(accounts)
                {
                    var my_account = accounts[0];
                    console.log(my_account);
                    employeeDetails.methods.getEmployeeDetails(aadharno).call().then(function(obj){
                        var i;
                        var text = "";
                        document.getElementById("ad").value = obj[0];
                        document.getElementById("Name").value = obj[1];
                        document.getElementById("designation").value = obj[2];
                        document.getElementById("addr").value = obj[4];
                    });
                });
        </script>
        <div class="box">
            <br/>
            <div class="content">
                <center>
                    <h5>
                
                    <strong >PARTICULARS TO BE FILLED BY THE RETIRING GOVERNMENT SERVANT</strong></h5>
               
                </center>
                <div class="div">
                    <p  class="col-75">
                        <br/>
                        <b>1.</b> Name:
                        <input type = "text"  id = "Name"  class="col-25" style="cursor: not-allowed;"
							oncopy="return false" onpaste="return false">
                    </p>
                    <p  class="col-75">
                        <b>2.</b> Permanent Account Number for Income Tax(PAN):
                        <input type="text" pattern="\d*" id="pan" maxlength="10" class="col-25" >
                        
                    </p>

                    <p class="col-75">
                        <b>3.</b> Address after retirement/permanent address:
                        <textarea id = "addr" rows = "4" cols ="40" class="col-25" style="cursor: not-allowed;"
							oncopy="return false" onpaste="return false"></textarea>
                    </p>
                    <p class="col-75">
                        <b>4.</b> IFSC code of the branch through which pension is to be drawn:
                        <button onclick="ifsc()"class="col-6"> Check</button>
                        <input type="text"  id="ifsc" class="col-30">
                        
                        <script>
                            function ifsc()
                            {
                                $.post('bank.php', { ifsc_input: document.getElementById("ifsc").value}, function(result) { 
                                    alert(result);
                                    var display = result.split("\n");
                                    document.getElementById("bname").value = display[0];
                                    document.getElementById("bbranch").value = display[1];
                                    document.getElementById("baddr").value = display[2];
                                });
                                
                            }
                        </script>
                    </p>
                    <p class="col-75">
                        <b> (a).</b> Bank Name:
                        <textarea style="cursor: not-allowed;"
							oncopy="return false" onpaste="return false" rows = "2" cols ="40" class="col-25" id="bname" placeholder="-Type in valid IFSC to fill the detail-"></textarea> 
                    </p>
                    <p class="col-75">
                        <b> (b).</b> Bank Branch:
                        <textarea style="cursor: not-allowed;"
							oncopy="return false" onpaste="return false" rows = "2" cols ="40" class="col-25" id="bbranch" placeholder="-Type in valid IFSC to fill the detail-"></textarea> 
                    </p>
                    <p class="col-75">
                        <b> (c).</b> Bank Address:
                        <textarea style="cursor: not-allowed;"
							oncopy="return false" onpaste="return false" rows = "3" cols ="40" class="col-25" id="baddr" placeholder="-Type in valid IFSC to fill the detail-"></textarea> 
                    </p>
                    <p  class="col-75">
                        <b>5.</b> Aadhar Number:
                        <input type="text" pattern="\d*" maxlength="12" id="ad"  class="col-25" style="cursor: not-allowed;"
							oncopy="return false" onpaste="return false">
                    </p>
                    <p class="col-75">
                        <b>6.</b> Designation: 
                        <input type = "text"  id = "designation" class="col-25" style="cursor: not-allowed;"
							oncopy="return false" onpaste="return false">
                    </p>
                    <p class="col-75">
                        <b>7.</b> Final Date:
                        <input type = "text"  id = "closingDate" class="col-25" style="cursor: not-allowed;"
							oncopy="return false" onpaste="return false">
                        <script>
                            var endProcess = parseInt((new Date().getTime()/1000) + 2419200);
                            document.getElementById("closingDate").value = new Date(endProcess*1000);
                        </script>
                    </p>

                </div>
                <center>
                    <p  class="col-75" >
                      <button type="submit"  id = "confirm" class="block">SUBMIT</button>
                    </p>
                </center>
            </div>
        </div>
        <script>
            $(document).ready(function ()
            {
                $("#confirm").click(function()
                {
                    var name = $("#Name").val();
                    var aadharno = $("#ad").val();
                    var addr = $("#addr").val();
                    var designation = $("#designation").val();
                    var panno =$("#pan").val();
                    var ifsc = $("#ifsc").val();
                    var closingDate= $("#closingDate").val();
                    var bankname = $("#bname").val();
                    var branch = $("#bbranch").val();
                    var baddr = $("#baddr").val();

                    var d1 = new Date();
                    var startTime = parseInt(d1.getTime()/1000);

                    var counter = 0;
                    
                    var display_msg = "";
                    if((panno!= "") &&  (branch !="") && (ifsc!="") && (endProcess!=0)){
                        display_msg = display_msg.concat(checkPan(panno));
                        function checkPan(panno)
                        {
                            panno = panno.toUpperCase();
                            var regex = /[a-zA-Z]{3}[PCHFATBLJG]{1}[a-zA-Z]{1}[0-9]{4}[a-zA-Z]{1}$/;
                            var pan = {C:"Company", P:"Personal", H:"Hindu Undivided Family (HUF)", F:"Firm", A:"Association of Persons (AOP)", T:"AOP (Trust)", B:"Body of Individuals (BOI)", L:"Local Authority", J:"Artificial Juridical Person", G:"Govt"};
                            pan=pan[panno[3]];
                            if(regex.test(panno))
                            {
                                if(pan!="undefined")
                                {
                                    counter = counter + 1;
                                    display_msg ="Valid Pan number!"+ "\n";
                                    return display_msg;
                                }
                                else
                                {
                                    display_msg ="Invalid Pan number!"+ "\n";
                                    return display_msg;
                                }
                            }
                            else
                            {
                                display_msg ="Invalid Pan number!"+ "\n";
                                return display_msg;
                            } 
                        }

                        if(counter==1){
                 
                            web3 = new Web3(new Web3.providers.HttpProvider("http://localhost:8545")) // else explicitly specify where to inject
                            var gchain = new web3.eth.Contract(GCHAIN SMART CONTRACT ABI, SMART CONTRACT ADDRESS);
                            web3.eth.getAccounts().then(function(accounts)
                            {
                                var my_account = accounts[0];
                                var bank_details = bankname + ",\n" + branch + ",\n" + baddr;
                                var uid = <?=json_encode($_SESSION['uid'])?>;
                                console.log(uid);
                                
                                gchain.methods.SetUserInfo(uid,name,panno,aadharno,addr,ifsc,bank_details,designation,startTime,endProcess).send({from: my_account, gas:3000000}); 
                                $.post('formSubmit.php',{uniqueid:uid, emp1:1,emp2:0,emp3:0},function(result){
                                    if(result=="Data inserted!")
                                    {
                                        alert("Form has been submitted!");
                                        window.location.href='/blockdata/Applicant/logoutApplicant.php';
                                    }
                                    else
                                    {
                                        alert(result);
                                    }
                                });            
                            });
                        }
                        else
                        {
                            alert(display_msg + "Check details before submitting.\n");
                        }
                    }
                    else
                    {
                        alert("1 or more fields are empty!");
                    }
                });
            });

        </script>
    </body>
</html>
