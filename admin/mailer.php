<?php
$SENDER = array('email' => "mailsurvey745@gmail.com", 'password' => "Cs153@ra1521");
$SENDER_DISPLAY_NAME = "Survey results";
$RECIPIENTS = array("samjessep77@gmail.com");

$CONTENTS = array('subject' => 'Here are the survey results', 'html_message' => '<h1>Survey results</h1><p>attached to this email is the excel file with the survey results</p>', 'alt_message' => 'attached to this email is the excel file with the survey results');


require "makeHtmlTable.php";
$data = makeTable();
$spreadsheet = $data['sheet'];
$filename = $data['name'];
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save($filename);

if(isset($_POST['email'])){
  $RECIPIENTS = array($_POST['email']);
  var_dump($RECIPIENTS);
}
//import PHPMailerAutoload.php file which located inside phpmailer folder
  require 'phpmailer/PHPMailerAutoload.php';

// create object of class PHPMailer
   $mail = new PHPMailer;

// print client server communication output if we don't want to print it we can use 3
   $mail->SMTPDebug = 4;

// Set mailer to use SMTP
   $mail->isSMTP();

// Specify main and backup SMTP servers
   $mail->Host = 'smtp.gmail.com';

// Enable SMTP authentication
   $mail->SMTPAuth = true;

// SMTP username mainly it is sender gmail replace 'techifind@gmail.com' with your gmail
   $mail->Username = $SENDER['email'];

// SMTP password it is your gmail password
   $mail->Password = $SENDER['password'];

// Enable TLS encryption, `ssl` also accepted
   $mail->SMTPSecure = 'tls';

// TCP port to connect to
   $mail->Port = 587;

// set from it show in from of your mail
   $mail->setFrom($SENDER['email'], $SENDER_DISPLAY_NAME);

// Add a recipient it is address where you want to send your email you can add multiple here
foreach ($RECIPIENTS as $key => $value) {
  $mail->addAddress($value);
}
// $mail->addAddress('ellen@example.com');   // to send multiple email

// set reply to
   $mail->addReplyTo($SENDER['email'], 'no-reply');

//set cc or bcc it is optional
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

// Add attachments it is optional
  $mail->addAttachment($filename);
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');

// Set email format to HTML if you want to send html document
   $mail->isHTML(true);

// set subject of your email
   $mail->Subject = $CONTENTS['subject'];

// write your body content we can use html
   $mail->Body    = $CONTENTS['html_message'];
   $mail->AltBody = $CONTENTS['alt_message'];

/* finally send email if email send is success then print 'Message has been sent'
   if not then print 'Message could not be sent'
*/
   if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
   }
   else
   {
    echo 'Message has been sent';
    unlink($filename);
   }

   // here we can change value dynamically with php variable as per required
   ?>
