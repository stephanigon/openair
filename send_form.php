<?php
if(!isset($_POST['submit']))
{
    //This page should not be accessed directly. Need to submit the form.
    echo "error; you need to submit the form!";
}
$name = $_POST['name'] ;
$email = $_POST['email'] ;
$subject= $_POST['subject'] ;
$message= $_POST['message'] ;



//Validate first
if(empty($name)||empty($email))
{
   echo "Name and email are mandatory!";
   exit;
}

if(IsInjected($Email))
{
   echo "Bad email value!";
   exit;
}

$email_from = 'spgonza@live.com';//<== update the email address
$email_subject = "Quote Submission";
$email_body = "You have received a new message from the user $name.\n".
   "Here is the message:\n Name: $name \n Email: $email \n Subject: $subject \n Message: $message".  
   
$to = "spgonza@live.com";//<== update the email address
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $Email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
header('Location: thank_you.html');


// Function to validate against any email injection attempts
function IsInjected($str)
{
 $injections = array('(\n+)',
             '(\r+)',
             '(\t+)',
             '(%0A+)',
             '(%0D+)',
             '(%08+)',
             '(%09+)'
             );
 $inject = join('|', $injections);
 $inject = "/$inject/i";
 if(preg_match($inject,$str))
   {
   return true;
 }
 else
   {
   return false;
 }
}
 
?>