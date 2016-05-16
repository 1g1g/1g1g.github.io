<?php
// check if fields passed are empty
/*if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['message'])	||
   empty($_POST['subject']) ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }*/
	
$name = $_POST['name'];
$email_address = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];
	
// create email body and send it	
$to = 'zcavdar14@ku.edu.tr'; // put your email
$to2 = 'murat.yigen@gmail.com'; //second mail
$email_subject = "1Genc1Gelecek Siteici Form:  $name";
$email_body = " Detaylar:\n \nİsim-Soyisim: $name \n ".
				  "Kimden: $email_address\n Subject: $subject \n\n Message: \n $message";
$headers = "From: 1Genc1Gelecek.com\n";
$headers .= "Reply-To: $email_address";	
mail($to,$email_subject,$email_body,$headers);
mail($to2,$email_subject,$email_body,$headers);
return true;			
?>