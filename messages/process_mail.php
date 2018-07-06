<?php
require_once '../config.php';
require_once '../database_connection.php';
require_once '../functions.php';

if (isset($_POST['send'])){
  $to =  db_prepare_input($_POST['email']);
  $subject = db_prepare_input ($_POST['subject']);
  $msg = db_prepare_input($_POST['msg']);
  $card = db_prepare_input($_POST['attachment']);
  $from = db_prepare_input($_SESSION['email']);

    $message = '<html><body>';
    $message .= '';
    $message .= '<table style="border-color: #666;width:600px;" cellpadding="10">';
    $message .= '<tr style="background: #eee;"><td><h1><a href="http://www.Maseno.ac.ke/" target="_blank"><img src="../1.jpg" alt="Maseno University hospital" /></a></h1></td></tr>';
    $message .= "<tr style='background: #eee;'><td>" . $msg . "</td></tr>";
    $message .= "</table>";
    $message .= '<table rules="all" width="600px">';
    $message .= '<tr><td><br><br><hr>This email is sent via a secure system <a href="http://www.Maseno.ac.ke/" target="_blank">Maseno University</a> . <b>Please do not reply to this mail.</b></td></tr>';

    $message .= "</table>";
    $message .= "</body></html>";

 

 require_once '../PHPMailer/class.phpmailer.php';
    // defaults to using php "mail()"; 
    // the true param means it will throw exceptions on errors, 
    // which we need to catch
    $mail = new PHPMailer(true);

    $mail->SMTPDebug = 3;                               
        //Set PHPMailer to use SMTP.
        $mail->isSMTP();            
        //Set SMTP host name                          
        $mail->Host = "smtp.gmail.com";
        //Set this to true if SMTP host requires authentication to send email
        $mail->SMTPAuth = true;                          
        //Provide username and password     
        $mail->Username = "abramogol@gmail.com";                 
        $mail->Password = "masterabram";                           
        //If SMTP requires TLS encryption then set it
        $mail->SMTPSecure = "tls";                           
        //Set TCP port to connect to 
        $mail->Port = 587;                                   



        $mail->isHTML(true);

    try {
        
        // add your email address and name
        $mail->SetFrom($from, ' Maseno University hospital');

        $mail->AddAddress($to);
       

        $mail->Subject = $subject;

        $mail->MsgHTML($message);
        $mail->AddAttachment($card);      // attachment

        $mail->Send();
        // redirect_to("mail.php?msg=success");

if($_SESSION['level']==0){
redirect_to('../reception/reception.php?msg=success');
}elseif($_SESSION['level']==1){
redirect_to('../nurse/index.php?msg=success');
}elseif($_SESSION['level']==2){
redirect_to('../doctor/index.php?msg=success');
}elseif($_SESSION['level']==3){
redirect_to('../pharmacy/index.php?msg=success');
}elseif($_SESSION['level']==4){
redirect_to('../lab/index.php?msg=success');
}elseif($_SESSION['level']==5){
redirect_to('../admin/index.php?msg=success');
}

    } catch (phpmailerException $e) {
        #echo $e->errorMessage(); //Pretty error messages from PHPMailer
        // redirect_to("mail.php?msg=error");


if($_SESSION['level']==0){
redirect_to('../reception/reception.php?msg=error');
}elseif($_SESSION['level']==1){
redirect_to('../nurse/index.php?msg=error');
}elseif($_SESSION['level']==2){
redirect_to('../doctor/index.php?msg=error');
}elseif($_SESSION['level']==3){
redirect_to('../pharmacy/index.php?msg=error');
}elseif($_SESSION['level']==4){
redirect_to('../lab/index.php?msg=error');
}elseif($_SESSION['level']==5){
redirect_to('../admin/index.php?msg=error');
}
    } catch (Exception $e) {
        #echo $e->getMessage(); //Boring error messages from anything else!
        // redirect_to("mail.php?msg=error");


if($_SESSION['level']==0){
redirect_to('../reception/reception.php?msg=error');
}elseif($_SESSION['level']==1){
redirect_to('../nurse/index.php?msg=error');
}elseif($_SESSION['level']==2){
redirect_to('../doctor/index.php?msg=error');
}elseif($_SESSION['level']==3){
redirect_to('../pharmacy/index.php?msg=error');
}elseif($_SESSION['level']==4){
redirect_to('../lab/index.php?msg=error');
}elseif($_SESSION['level']==5){
redirect_to('../admin/index.php?msg=error');
}
    }

} 
?>