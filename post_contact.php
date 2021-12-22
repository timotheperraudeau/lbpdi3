<?php
$errors = [];

if(empty($_POST['recaptcha-response'])){
    $errors['captcha'] = "Problème technique. Merci de rééssayer";
}

if(!array_key_exists('name', $_POST)||$_POST['name'] == ''){
    $errors['name'] = "Veuillez renseigner votre nom";
}

if(!array_key_exists('email', $_POST)||$_POST['email'] == '' || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $errors['email'] = "Veuillez renseigner un email valide";
}

if(!array_key_exists('message', $_POST)||$_POST['message'] == ''){
    $errors['message'] = "Veuillez renseigner un message";
}

session_start();



if(!empty($errors)){    
$_SESSION['errors'] = $errors;
$_SESSION['input'] = $_POST;
header('location: contact.php');
}else{
$_SESSION['Success'] = 1;
$message = $_POST['message'];
$headers = 'FROM: https//www.lbpdi.fr';
@mail("timotheeperraudeau@hotmail.fr", 'Formulaire de contact lbpdi.fr', "Nom: " . $_POST['name'] . "\n" . "Prénom: " . $_POST['surname'] . "\n" 
. "Mail: " . $_POST['email'] . "\n" . "Téléphone: " . $_POST['tel'] . "\n" . "Message: " . $message, $headers);  
header('location: contact.php');
}


?>