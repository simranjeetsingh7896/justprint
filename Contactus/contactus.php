<?php
use Contactus\Model\{Contact, Database};

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

require_once './Model/Database.php';
require_once './Model/Contact.php';

if(isset($_POST['submit'])){

	$firstnameerr = $lastnameerr =  $emailerr = $feedbackerr =  $messageerr = "";

	$firstname = $lastname =  $email = $feedback =  $message = "";


    $firstname = $_POST['first-name'];
    $lastname = $_POST['last-name'];
    $email = $_POST['email'];
    $feedback = $_POST['feedback'];
    $message = $_POST['message'];
   
    if($firstname == ""){
        $firstnameerr = "Please enter first name";
     } 

     if($lastname == ""){
        $lastnameerr = "Please enter last name";
     } 
     if($email == ""){
        $emailerr = "Please enter email";
     } elseif (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)){
        $emailerr = "Please enter valid email";
     }  
     if($feedback == ""){
        $feedbackerr = "Please enter subject";
     }
     if($message == ""){
        $messageerr = "Please enter your message";
     } 
	 if (!$firstnameerr && !$lastnameerr && !$emailerr && !$feedbackerr &&  !$messageerr) {
	 $db =Database::getDb();
	 $s = new Contact();
	 $c = $s->addContact($firstname, $lastname, $email,$feedback,$message, $db);
 
	 if($c){    
		header ("Location: success.php");
	 } else {  
		 echo "errors";
	 }
	}

	$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'justprint1233@gmail.com';                     //SMTP username
    $mail->Password   = 'Simran@123';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('justprint1233@gmail.com', 'Just Print');
    $mail->addAddress($email, 'simranjeet singh');     //Add a recipient
  
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Team - Just Print';
    $mail->Body    = 'Thanks for contacting us.We will reply you back soon within 5-7 business days.';
  
    $mail->send();
   // echo 'Message has been sent';
} catch (Exception $e) {
    echo "";
}



}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Contact</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>


	<div class="container-contact100">
		<div class="wrap-contact100">
			<form action="" method="post" class="contact100-form validate-form">
				<span class="contact100-form-title">
					Contact Us
				</span>

				<label class="label-input100" for="first-name">Tell us your name </label>
				<div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate="Type first name">
					<input id="first-name" class="input100" type="text" name="first-name" value="<?= isset($firstname) ? $firstname : ''; ?>" placeholder="First name">
					<span style="color:red;"><?= isset($firstnameerr)? $firstnameerr: ''; ?></span> <!-- For display error-->
				</div>
				<div class="wrap-input100 rs2-wrap-input100 validate-input" data-validate="Type last name">
					<input class="input100" type="text" name="last-name" value="<?= isset($lastname) ? $lastname : ''; ?>" placeholder="Last name">
					<span style="color:red;"><?= isset($lastnameerr)? $lastnameerr: ''; ?></span> <!-- For display error-->
				</div>

				<label class="label-input100" for="email">Enter your email </label>
				<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
					<input id="email" class="input100" type="text" name="email" value="<?= isset($email) ? $email : ''; ?>" placeholder="Eg. example@email.com">
					<span style="color:red;"><?= isset($emailerr)? $emailerr: ''; ?></span> <!-- For display error-->
				</div>

				<label class="label-input100" for="feedback">Enter Subject</label>
				<div class="wrap-input100">
					<input id="feedback" class="input100" type="text" name="feedback" value="<?= isset($feedback) ? $feedback : ''; ?>" placeholder="Eg. Feedback">
					<span style="color:red;"><?= isset($feedbackerr)? $feedbackerr: ''; ?></span> <!-- For display error-->
				</div>
				

				<label class="label-input100" for="message">Message </label>
				<div class="wrap-input100 validate-input" data-validate = "Message is required">
					<input id="message" class="input100" name="message" value="<?= isset($message) ? $message : ''; ?>" placeholder="Write us a message" >
					<span style="color:red;"><?= isset($messageerr)? $messageerr: ''; ?></span> <!-- For display error-->
				</div>
				

				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn" name="submit">
						Send Message
					</button>
				</div>
			</form>

			<div class="contact100-more flex-col-c-m" style="background-image: url('images/picjpg.jpg');">
				<div class="flex-w size1 p-b-47">
					<div class="txt1 p-r-25">
						<span class="lnr lnr-map-marker"></span>
					</div>

					<div class="flex-col size2">
						<span class="txt1 p-b-20">
							Address
						</span>

						<span class="txt2">
							Toronto City Hall 100 Queen St W, Toronto, Ontario M5H 2N1 Canada
						</span>
					</div>
				</div>

				<div class="dis-flex size1 p-b-47">
					<div class="txt1 p-r-25">
						<span class="lnr lnr-phone-handset"></span>
					</div>

					<div class="flex-col size2">
						<span class="txt1 p-b-20">
							Lets Talk
						</span>

						<span class="txt3">
							+1 007 1234567
						</span>
					</div>
				</div>

				<div class="dis-flex size1 p-b-47">
					<div class="txt1 p-r-25">
						<span class="lnr lnr-envelope"></span>
					</div>

					<div class="flex-col size2">
						<span class="txt1 p-b-20">
							General Support
						</span>

						<span class="txt3">
						justprint1233@gmail.com
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
