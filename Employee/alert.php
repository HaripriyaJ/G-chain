<?php
    // We need to use sessions, so you should always start sessions using the below code.
    session_start();
    
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) 
    {
        header('Location: index.html');
        exit;
    }
    $body = $_POST['body'];
    $time = $_POST['time'];
    $reason = $_POST['reason'];
    $id = $_POST['id'];

    require 'dependency/PHPMailer-master/PHPMailerAutoload.php';
    $mail = new PHPMailer();
    $mail ->IsSmtp();
    $mail ->SMTPDebug = 1;
    $mail ->SMTPAuth = true;
    $mail ->SMTPSecure = 'ssl';
    $mail ->Host = "smtp.gmail.com";
    $mail ->Port = 465; // or 587
    $mail ->IsHTML(true);

    $mail ->Username = YOUR REGISTERED MAIL ID;
    $mail ->Password = PASSWORD;
    $mail ->SetFrom(YOUR REGISTERED MAIL ID , USERNAME);

    $mail ->Subject = $body;
    if($body=="Application Rejected"){
        $mail ->Body = "<br/>Dear Applicant,<br/>Your application  was rejected at: <b><i>".$time."</i></b><br/>Reason stated by the official is: <b>".$reason."</b><br/>Check website for more details.You can re-apply in a 7 days.<br/><br/><b>Thank you for using G-chain services!</b>";
    }
    else if($body=="Application Approved"){
        $mail ->Body = "<br/>Dear Applicant,<br/>Your application  was approved at: <b><i>".$time."</i></b><br/>Check website for more details.<br/><br/><b>Thank you for using G-chain services!</b>";
    }
    $mail ->AddAddress($id,"APPLICANT");
    
    if(!$mail->Send())
    {
        echo "Mail Not Sent";
    }
    else
    {
        echo "Mail Sent";
    }
?>