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

<nav>
<a href="">Welcome</a>
<a href="">Our products</a>
<a href="">About us</a>
<a href="">Info</a>
<a href="">Contact us</a>
</nav>

<div id="intro">
<h1> Contact us! </h1>
<p> Do you have questions regarding our products or your order, or even suggestions on how we can improve our service? <br>
Feel free to fill the following form in and we'll get back to you ASAP!</p>
</div>

<div id="container">
<h2> Contact form </h2>

<form method="post" action="index.php">
    

    <table>
        <tr>
        <td> <label for="firstName"> First Name: </label> </td>
        <td> <input type="text" name="firstName" required></td>
        </tr>

        <tr>
        <td> <label for="lastName"> Last Name: </label></td>
        <td> <input type="text" name="lastName" required></td>
        </tr>

        <tr>
        <td> <label for="gender"> Gender: </label></td>
        <td> <select>
            <option value="male"> Male </option>
            <option value="female"> Female </option>
            <option value="undisclosed"> Undisclosed </option>
            </select></td>
        </tr>

        <tr>
        <td> <label for="email"> E-mail: </label></td>
        <td> <input type="text" name="email" required></td>
        </tr>

        <tr>
        <td> <label for="country"> Country: </label></td>
        <td> <input type="text" name="country"  required></td>
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
        <td> <input type="text" name="message" required></td>
        </tr>
        
    </table>
    
    <input id="button" type="submit" name="submit" value="Send!">
   

</form>
</div>


<script type="text/javascript" src="/assets/script.js"></script>
</body>
</html>