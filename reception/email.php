<?php 

require_once '../config.php';
require_once '../database_connection.php';
require_once '../functions.php';;


 if(isset($_GET['reg_no'])){
    $reg_no = $_GET['reg_no'];
 //  }else{
 //    echo "No id found";
 //  }

 // if(isset($_GET['mode'])){
 //    $mode = $_GET['mode'];
 // if ($mode=='send'){
$query = "(SELECT reg_no, first_name, last_name, email, d_o_b FROM student_patient WHERE reg_no='{$reg_no}' ) union "
        . "(SELECT reg_no, first_name, last_name, email, d_o_b FROM staff_patient WHERE reg_no='{$reg_no}' ) ";
$res = mysqli_fetch_assoc(mysqli_query($connection, $query));

$d=$res["d_o_b"];
$age = date_diff(date_create($d), date_create('today'))->y;

$name =  ucwords($res["first_name"].' '.$res["last_name"]);

$msg = "Happy birthday $name . <br>As you celebrate. $age th  year on this world
		we as Maseno Hospital <br> join you togerther in Joy  and happiness. We take this moment to celebrate with you <br> togerther because we  believe
		in your support and being part of you. Thank you.";

// echo $msg ;
$to = $res["email"];
$from = "hospital@gmail.com";
$subject = " Happy birthday ";
$card = '<img src="../bootstrap/wordpress.jpg" alt="Happy Birthday " /> ';

    $message = '<html><body>';
    $message .= '';
    $message .= '<table style="border-color: #666;width:600px;" cellpadding="10">';
    $message .= '<tr style="background: #eee;"><td><h1><a href="http://www.Maseno.ac.ke/" target="_blank"><img src="../bootstrap/wordpress.jpg" alt="Happy Birthday " /></a></h1></td></tr>';
    $message .= "<tr style='background: #eee;'><td>" . $msg . "</td></tr>";
    $message .= 'Thank you for your support';
    $message .= 'This Email is automatically generated and therefore no need for a reply. Incase of feedback <a href="http://www.Maseno.ac.ke/" target="_blank"> Click here</a> ';
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
        $mail->SetFrom('abramogol@gmail.com', ' Abraham Mcogol ');

        $mail->AddAddress($to);
       

        $mail->Subject = $subject;

        $mail->MsgHTML($message);
        $mail->AddAttachment($ecard);      // attachment

        $mail->Send();
        redirect_to("birth_day.php?msg=success");
        } catch (phpmailerException $e) {
        #echo $e->errorMessage(); //Pretty error messages from PHPMailer
        redirect_to("birth_day.php?msg=error");

           } catch (Exception $e) {
        #echo $e->getMessage(); //Boring error messages from anything else!
        redirect_to("birth_day.php?msg=error");   

      }
 }else{
    echo "No Mode found";
  };

?>