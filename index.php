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

// check if field filled
if(filter_has_var(INPUT_GET, 'submit')){
    //variables
    $firstName = $_GET["firstName"];
    $lastName = $_GET["lastName"];
    $email = $_GET["email"];
    $country = $_GET["country"];
    $message = $_GET["message"];

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
                    $variables[$x] = filter_input(INPUT_GET, $variables[$x], FILTER_SANITIZE_STRING);
                }
            }
            //validate
        if (filter_var(trim($email), FILTER_VALIDATE_EMAIL) == true){
            $toEmail = "wang.frank.zi@gmail.com";
            $subject = "Thanks for your message!";
            $body = "<h2>Thank you for reaching out!</h2> <p> We'll get back to you ASAP! </p>";
            $headers= "MIME-Version:1.0" ."\r\n";
            $headers .= "Content-Type:text/html;charset=UTF-!"."\r\n";
            $headers .= "From ".$firstName .$lastName ."<" .$email .">" ."\r\n";

                if (mail($toEmail, $subject, $body, $headers)){
                 echo "Your email has been sent";
                }

                else {
                    echo "There was a problem. You mail was not sent.";
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
        <td> <select>
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