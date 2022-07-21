<?php
    // define("IS_DEBUG", $_SERVER["HTTP_HOST"] == "localhost" ? true : false);

    // $firstname = $lastname = $subject = 

    // if($_SERVER["REQUEST_METHOD"] == "POST"){

    // }else{
    //     echo "Pas POST";
    // }

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
            <input type="firstname" placeholder="Prénom" required>
            <input type="lastname" placeholder="Nom" required>
            <input type="subject" placeholder="Sujet" required>
            <input type="email" placeholder="exemple@email.com" required>
            <textarea name="message" id="" cols="30" rows="10" required placeholder="Votre message"></textarea>
            <!-- <div id="select"> 
            <select name="date">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
            <select name="month">
                <option>Janviers</option>
                <option>Février</option>
                <option>Mars</option>
                <option>Avril</option>
                <option>Mai</option>
            </select>
            <select>
                <option>2021</option>
                <option> 2022</option>
                <option> 2023</option>
                <option> 2024</option>
                <option> 2025</option>
            </select>
            </div> -->
            <input type="submit" value="ENVOYER">
        </form>
    </div>
</body></html>
