<?php
$errors = [];
$url = "http://www.google.com/recaptcha/api/siteverify?secret=6LdLNLwdAAAAAEs4Me7RCS59rn64Wa54fqs_RaH6&response={$_POST['recaptcha-response']}";

if(empty($_POST['recaptcha-response'])){
    $errors['captcha'] = "erreur de validation formulaire. Merci de rééssayer";
}else{
$response = file_get_contents($url);
}

if(empty($response) || is_null(($response))){
    $errors['response'] = "Problème technique. Veuillez recommencer";
}
$data = json_decode($response);

if($data['success'] = false){
    $errors['response'] = "Problème technique. Veuillez recommencer";
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
$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$message = $_POST['message'];
$headers = 'FROM: https//www.lbpdi.fr ';
@mail('contact@lbpdi.fr', 'Formulaire de contact',$name, $surname, $email, $tel, $message, $headers);  
header('location: contact.php');
}


?>