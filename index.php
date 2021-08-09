<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hackers Poulette</title>

    <link rel="stylesheet" href="/assets/style.css">
    <link rel="stylesheet" href="/assets/bellota_italic_macroman/stylesheet.css" type="text/css" charset="utf-8" />

</head>
<body>

<nav role="navigation">
<img src="https://github.com/FrankZiWANG-dev/hackers-poulette/blob/main/assets/images/logo.png?raw=true" alt="hackers-poulette-logo">
<a href="">Welcome</a>
<a href="">Our products</a>
<a href="">About us</a>
<a href="">Info</a>
<a href="">Contact us</a>
</nav>

<div id="intro" role="introduction-text">
<h1> Contact us! </h1>
<p> Do you have questions regarding our products or your order, or even suggestions on how we can improve our service? <br>
Feel free to fill the following form in and we'll get back to you ASAP!</p>
</div>

<?php
//import phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";

// check if field filled
if(filter_has_var(INPUT_GET, 'submit')){
    //variables
    $firstName = $_GET["firstName"];
    $lastName = $_GET["lastName"];
    $email = $_GET["email"];
    $country = $_GET["country"];
    $message = $_GET["message"];
    $subject = $_GET["subject"];

    $variables = array ($firstName, $lastName, $email, $country, $message);
    $error= "Please fill this field in.";

    //if all fields filled in but honeypot field empty
    if (!empty($firstName) AND !empty($lastName) AND !empty($email) AND !empty($country) AND !empty($message) AND empty($honey)){
        //if doesn't currently display error message
        if ( ($firstName !== $error) AND ($lastName !== $error) AND ($email !== $error) AND ($country !== $error) AND ($message !== $error) ){
            //sanitize
            for ($x=0; $x<sizeof($variables); $x++){
                if ($variables[$x]== $email){
                    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                }
                else if ($variables[$x] == $message){
                    continue;
                }
                else{
                    $variables[$x] = filter_var($variables[$x], FILTER_SANITIZE_STRING);
                }
            }
        
            //validate
            if (filter_var(trim($email), FILTER_VALIDATE_EMAIL) == true){
                $mailForHackers = new PHPMailer(true);
                try {
                    $mailForHackers ->isSMTP();
                    $mailForHackers ->Host = 'smtp.mailtrap.io';
                    $mailForHackers ->SMTPAuth = true;
                    $mailForHackers ->Port = 2525;
                    $mailForHackers ->Username = '3a523c273edefe';
                    $mailForHackers ->Password = 'd6c06b4ce1aea8';
                
                    $mailForHackers ->setFrom('info@hackers-poulette.com', 'Hackers-Poulette');
                    $mailForHackers ->addAddress($email);
            
                    $mailForHackers ->isHTML(true);
                    $mailForHackers ->Subject = 'Message from Client!';
                    $mailForHackers ->Body    = '<h2> A client has reached out! </h2>
                    <p>Here is their message:</p>
                    <p>'.$message.'</p>';
            
                    $mailForHackers ->send();
                    echo "Your message has been delivered!";
                }
                catch (Exception $e) {
                        echo "Sorry! An error has occurred. ";
                }

                $mailForClient = new PHPMailer(true);
                try {
                    $mailForClient->isSMTP();
                    $mailForClient->Host = 'smtp.mailtrap.io';
                    $mailForClient->SMTPAuth = true;
                    $mailForClient->Port = 2525;
                    $mailForClient->Username = '3a523c273edefe';
                    $mailForClient->Password = 'd6c06b4ce1aea8';
                
                    $mailForClient->setFrom('info@hackers-poulette.com', 'Hackers-Poulette');
                    $mailForClientr->addAddress($email);
            
                    $mailForClient->isHTML(true);
                    $mailForClient->Subject = 'Message delivered to Hackers Poulette!';
                    $mailForClient->Body    = '<h2> Thank you for getting in touch with Hackers Poulette! </h2>
                    <p>You have reached us with the following message:</p>
                    <p>'.$message.'</p>
                    <p> We will get back to you ASAP!</p>
                    <p> Thank you for your patience! </p>
                    <p> Hackers Poulette </p>';
            
                    $mailForClient->send();
                    echo "A copy of your message has been sent to you by mail!";
                }
                catch (Exception $e) {
                        echo "Your message was not delivered. Try again!";
                }
            }
        }
    }  
}   

//check and display message in field if field is empty
function checkEmpty($field){
    if(filter_has_var(INPUT_GET, 'submit')){
        if (empty($field) == true){
            echo 'value="Please fill this field in." style="color:red" ';
        }
    }
}

//function to display message in email field if invalid email
function invalidEmail(){
    if (filter_var(trim($_GET["email"]), FILTER_VALIDATE_EMAIL) == false AND !empty($_GET["email"]) AND $_GET["email"]!=="Please fill this field in."){
        echo 'value="Please use a valid email adress." style="color:red; font-weight:bold"';
    }
}

?>

<div id="container" role="contact-section">
<h2> Contact form </h2>

<form method="get" action="index.php" role="contact-form">
    

    <table>
        <tr>
        <td> <label for="firstName"> First Name: </label> </td>
        <td> <input type="text" name="firstName" onfocus="this.value=''" <?php checkEmpty($firstName);?> ></td>
        </tr>

        <tr>
        <td> <label for="lastName"> Last Name: </label></td>
        <td> <input type="text" name="lastName" onfocus="this.value=''" <?php checkEmpty($lastName);?> ></td>
        </tr>

        <tr>
        <td> <label for="gender"> Gender: </label></td>
        <td> <select>
            <option value="male"> Male </option>
            <option value="female"> Female </option>
            <option value="undisclosed" selected> Undisclosed </option>
            </select></td>
        </tr>

        <tr>
        <td> <label for="email"> E-mail: </label></td>
        <td> <input type="text" name="email" onfocus="this.value=''" <?php checkEmpty($email); invalidEmail();?> ></td>
        </tr>

        <tr>
        <td> <label for="country"> Country: </label></td>
        <td> <input type="text" name="country" onfocus="this.value=''" <?php checkEmpty($country);?> ></td>
        <input type="text" name="honey" id="honey">
        </tr>

        <tr>
        <td> <label for="subject"> Subject: </label></td>
        <td> <select name = "subject">
            <option value="product"> Information about product </option>
            <option value="delivery"> Status of delivery </option>
            <option value="other" selected> Other </option>
            </select></td>
        </tr>

        <tr>
        <td> <label for="message"> Message: </label></td>
        <td> <input type="text" name="message" id="message" <?php checkEmpty($message);?> ></td>
        </tr>
        
    </table>
    
    <input id="button" type="submit" name="submit" value="Send!">
   

</form>
</div>

<script type="text/javascript" src="/assets/script.js"></script>
</body>
</html>