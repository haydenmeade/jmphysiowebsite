<?php
// Script to send mail for contact form.

function died($error) {

    echo "We are very sorry, but there were error(s) found with the form you submitted: <br /><br />";

    echo $error."<br /><br />";

    die();

}

if(!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['message'])) {

    died('We are sorry, but there appears to be a problem with the form you submitted.');       

}

$name = $_POST['name'];
$email_from = $_POST['email'];
$comments = $_POST['message'];

$error_message = "";
 
$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
if(!preg_match($email_exp,$email_from)) {
 
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
 
 }
 
$string_exp = "/^[A-Za-z .'-]+$/";
 
if(!preg_match($string_exp,$name)) {
 
	$error_message .= 'The Name you entered does not appear to be valid.<br />';
 
}

if(strlen($comments) < 2) {
 
    $error_message .= 'The Message you entered does not appear to be valid.<br />';
 
}


if(strlen($error_message) > 0) {
 
    died($error_message);
 
}
 
$email_message = "Form submission below.\n\n";

function clean_string($string) {
 
  $bad = array("content-type","bcc:","to:","cc:","href");

  return str_replace($bad,"",$string);
 
}
 
     
 
$email_message .= "Name: ".clean_string($name)."\n";

$email_message .= "Email: ".clean_string($email_from)."\n";

$email_message .= "Message: ".clean_string($comments)."\n";

$headers = 'From:'.$email_from."\r\n".'Reply-To:  '.$email_from."\r\n".'X-Mailer: PHP/'.phpversion();


$subject = 'Feedback from website form';
$email_to = "qwertyda2nd@gmail.com";

mail($email_to,$subject,$email_message,$headers);
header('Location: thankyou.html');
?>