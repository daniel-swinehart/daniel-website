<?php 
ob_start();

//Check for the required fields from 'email-form' on contact.html
if ((!$_POST['email-first-name']) || (!$_POST['email-last-name']) || (!$_POST['email-address']) || (!$_POST['email-message'])) {
   header("Location: contact.html");
   exit;
}
if (!filter_var(($_POST['email-message']), FILTER_VALIDATE_EMAIL)) {
    header("Location: contact.html");
    exit;
} else {
    $to = "daniel@danielmaroc.com"; // this is your Email address
    $from = $_POST['email-address']; // this is the sender's Email address
    $first_name = $_POST['email-first-name'];
    $last_name = $_POST['email-last-name'];
    $subject = "Form submission";
    $subject2 = "Copy of your form submission";
    $message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
    $message2 = "Here is a copy of your message " . $first_name . "\n\n" . $_POST['email-message'];

    $headers = "From:" . $from;
    $headers2 = "From:" . $to;
    mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
    
    header('Location: contact-thank-you.html');


}
ob_flush();
?>