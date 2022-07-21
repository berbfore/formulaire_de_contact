<?php
    define("IS_DEBUG", $_SERVER["HTTP_HOST"] == "localhost" ? true : false);

    $firstname = $lastname = $subject = $email = $message = ""; 
    $firstnameError = $lastnameError = $subjectError = $emailError = $messageError = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $firstname =  isset ($_POST["firstname"]) ? checkInput($_POST["firstname"]) : "";
        $lastname = isset ($_POST["lastname"]) ? checkInput($_POST["lastname"]) : "";
        $subject = isset ($_POST["subject"]) ? checkInput($_POST["subject"]) : "";
        $email = isset ($_POST["email"]) ? checkInput($_POST["email"]) : "";
        $message = isset ($_POST["message"]) ? checkInput($_POST["message"]) : "";
        if(!isEmail($email)){
            $emailError = "Veuillez vérifier votre email.";
        }
        $message = isset($_POST["message"]) ? checkInput($_POST["message"]) : "";

    }else{
        echo "Pas POST";
    }

    function checkInput($input){
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        if (IS_DEBUG) {
            echo $input;
            echo "<br>";
        }
        return $input;
    }

    function isEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
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
            <input type="text" name="firstname" value="<?php echo $firstname ?>"placeholder="Prénom" required>
            <input type="text" name="lastname" value="<?php echo $lastname ?>" placeholder="Nom" required>
            <input type="text" name="subject" value="<?php echo $subject ?>" placeholder="Sujet" required>
            <input type="email" name="email" value="<?php echo $email ?>" placeholder="exemple@email.com" required>
            <!-- <p class="error">Veuillez vérifier votre email</p> -->
            <textarea name="message" id="" cols="30" rows="10" required placeholder="Votre message"><?php echo $message ?></textarea>
            <?php
                if($emailError !=""){
                    echo '<p class="error">' . $emailError . '</p>';
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
        </form>
    </div>
</body></html>
