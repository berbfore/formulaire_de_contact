<?php

    $getDebug = isset($_GET["debug"]) && $_GET["debug"] == true ? true : false;
    define("IS_DEBUG", $_SERVER["HTTP_HOST"] == "localhost" || $getDebug ? true : false);

    $firstname = $lastname = $subject = $email = $phone = $message = ""; 
    $firstnameError = $lastnameError = $subjectError = $emailError = $phoneError = $messageError = "";
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $noError = true;
        $emailTo = "bdgozop@hotmail.com";
        $emailText ="";
        //firstname
        $firstname =  isset ($_POST["firstname"]) ? checkInput($_POST["firstname"]) : "";
        if (empty ($firstname)) {
            $firstnameError = "Veuillez renseigner votre prénom";
            // $noError = false; première façon de gérer les erreurs
        }else{
            $emailText .= "Prénom : " . $firstname . "\n";
        }

        //lastname
        $lastname = isset ($_POST["lastname"]) ? checkInput($_POST["lastname"]) : "";
        if (empty ($lastname)) {
            $lastnameError = "Veuillez renseigner votre nom";
            // $noError = false; première façon de gérer les erreurs
        }else{
            $emailText .= "Nom : " . $lastname . "\n";
        }

        //sujet
        $subject = isset ($_POST["subject"]) ? checkInput($_POST["subject"]) : "";
        if (empty ($subject)) {
            $subjectError = "Veuillez renseigner le sujet";
            // $noError = false; première façon de gérer les erreurs
        }

        //email
        $email = isset ($_POST["email"]) ? checkInput($_POST["email"]) : "";
        if(!isEmail($email)){
            $emailError = "Veuillez vérifier votre email.";
        }

        //phone
        $phone = isset ($_POST["phone"]) ? checkInput($_POST["phone"]) : "";
        if(!isPhone($phone)){
            $phoneError = "Veuillez vérifier votre numero.";
        }

        $message = isset ($_POST["message"]) ? checkInput($_POST["message"]) : "";
        if (empty ($message)) {
            $messageError = "Veuillez écrire votre message";
            // $noError = false; première façon de gérer les erreurs
        }else{
            $emailText .= "Message : " . $message . "\n";
        }

        $noError = $firstnameError == "" && $lastnameError == "" && $subjectError == "" && $emailError == "" && $phoneError == "" && $messageError == "";

        if ($noError) {
            $headers = "From: $firstname $lastname  $phone <$email>\r\nReply-To: $email";
            mail($emailTo, $subject, $emailText, $phone, $headers);

            $firstname = $lastname = $subject = $email = $phone = $message = "";
        }

    }else{
        echo "Pas POST";
    }

    function checkInput($input){
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        $input = utf8_encode($input);
        if (IS_DEBUG) {
            echo $input;
            echo "<br>";
        }
        return $input;
    }

    function isEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    //regex pour formatage du numero de tel
    function isPhone($phone){
        return preg_match("/^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$/", $phone);
    }
    

    function getError($error){
        $html = '<h1 class="error">' . $error . '</h1>';
        return $html;
    }
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>TP Discord</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css" media="all and (max-width: 768px)">
</head>

<body>

    <div id="formulaire"> 
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">
            <input type="text" name="firstname" value="<?php echo $firstname ?>"placeholder="Prénom" <?php echo !IS_DEBUG ? "required" : "" ?>>
            <?php
                if($firstnameError !=""){
                    echo getError($firstnameError);
                }
            
            ?>
            <input type="text" name="lastname" value="<?php echo $lastname ?>" placeholder="Nom" <?php echo !IS_DEBUG ? "required" : "" ?>>
            <?php
                if($lastnameError !=""){
                    echo getError($lastnameError);
                }
            
            ?>
            <input type="text" name="subject" value="<?php echo $subject ?>" placeholder="Sujet" <?php echo !IS_DEBUG ? "required" : "" ?>>
            <?php
                if($subjectError !=""){
                    echo getError($subjectError);
                }
            
            ?>

            <input type="email" placeholder="exemple@email.com" name="email" value="<?php echo $email ?>" <?php echo !IS_DEBUG ? "required" : "" ?> >
            <?php 
                if($emailError != ""){
                    echo getError($emailError);   
                }
            ?>
            
            <input type="tel" name="phone" value="<?php echo $phone ?>" placeholder="0690 65-85-20" <?php echo !IS_DEBUG ? "required" : "" ?>>
            <!-- <p class="error">Veuillez vérifier votre numéro</p> -->
            <?php
                if($phoneError !=""){
                    echo getError($phoneError);
                }
            
            ?>
            <textarea name="message" id="" cols="30" rows="10"  placeholder="Votre message" <?php echo !IS_DEBUG ? "required" : "" ?>><?php echo $message ?></textarea>
            <?php
                if($messageError !=""){
                    echo getError($messageError);
                }
            
            ?>
            // <!-- <div id="select"> 
            // <select name="date">
            //     <option>1</option>
            //     <option>2</option>
            //     <option>3</option>
            //     <option>4</option>
            //     <option>5</option>
            // </select>
            // <select name="month">
            //     <option>Janviers</option>
            //     <option>Février</option>
            //     <option>Mars</option>
            //     <option>Avril</option>
            //     <option>Mai</option>
            // </select>
            // <select>
            //     <option>2021</option>
            //     <option> 2022</option>
            //     <option> 2023</option>
            //     <option> 2024</option>
            //     <option> 2025</option>
            // </select>
            // </div> -->
            <input type="submit" value="ENVOYER">
            <p class="message" style="display: <?php echo (isset($noError) && $noError) ? "block" : "none"; ?>" >Message envoyé !</p>
        </form>
    </div>
</body></html>
