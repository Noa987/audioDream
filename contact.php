<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();

//Validation du formulaire
$array = array(
    "prenom" => "",
    "nom" => "",
    "email" => "",
    "sujet" => "",
    "message" => "",
    "prenomErreur" => "",
    "nomErreur" => "",
    "emailErreur" => "",
    "sujetErreur" => "",
    "messageErreur" => "",
    "bordurePrenom" => "",
    "bordureNom" => "",
    "bordureEmail" => "",
    "bordureSujet" => "",
    "bordureMessage" => "",
    "isSuccess" => false
);

$emailTo = "mailhedori@eisti.eu";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $array["prenom"] = verifyInput($_POST['fprenom']);
    $array["nom"] = verifyInput($_POST['fnom']);
    $array["email"] = verifyInput($_POST['femail']);
    $array["sujet"] = verifyInput($_POST['objet']);
    $array["message"] = verifyInput($_POST['message']);
    $array["isSuccess"] = true;
    $array["bordurePrenom"] = $array["bordureNom"] = $array["bordureEmail"] = $array["bordureSujet"] = $array["bordureMessage"] = "none";
    $emailText = "";
    
    if(empty($array["prenom"])){
        $array["prenomErreur"] = "Veuillez renseigner votre prénom.";
        $array["isSuccess"] = false;
        $array["bordurePrenom"] = "red";
    } else {
        $emailText .= "De : {$array["prenom"]} ";
    }
    
    
    if(empty($array["nom"])){
        $array["nomErreur"] = "Veuillez renseigner votre nom.";
        $array["isSuccess"] = false;
        $array["bordureNom"] = "red";
            } else {
        $emailText .= "{$array["nom"]}\n";
    }
    
        
    if(!isEmail($array["email"])){
        $array["emailErreur"] = "Veuillez renseigner un email valide.";
        $array["isSuccess"] = false;
        $array["bordureEmail"] = "red";
    } else {
        $emailText .= "Email : {$array["email"]}\n";
    }
        
        
    if(empty($array["sujet"])){
        $array["sujetErreur"] = "Veuillez renseigner un objet.";
        $array["isSuccess"] = false;
        $array["bordureSujet"] = "red";
    } else {
        $emailText .= "Objet: {$array["sujet"]}\n";
    }
        
        
    if(empty($array["message"])){
        $array["messageErreur"] = "Votre message ne doit pas être vide.";
        $array["isSuccess"] = false;
        $array["bordureMessage"] = "red";
    } else {
        $emailText .= "Message : \n{$array["message"]}\n";
    }
        
        
    if($array["isSuccess"]){
        //Swiftmail
        require_once 'vendor/autoload.php';

        // Create the Transport
        $transport = (new Swift_SmtpTransport('ssl0.ovh.net', 465,'ssl'))
        ->setUsername('contact@dodobwebsite.fr') //j'ai utilisé mon adresse ovh plutot que gmail
        ->setPassword('DORIANESTCON');

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message($array["sujet"]))
        ->setFrom(['contact@dodobwebsite.fr' => $array["prenom"] . ' ' . $array["nom"]])
        ->setTo(['mailhedori@eisti.eu', 'mourareaun@eisti.eu' => 'Noa et Dorian'])
        ->setBody($emailText);

        // Send the message
        $result = $mailer->send($message);

        $array["prenom"] = $array["nom"] = $array["email"] = $array["sujet"] = $array["message"] = "";
    }
}

function isEmail($var){
    return filter_var($var, FILTER_VALIDATE_EMAIL);
}

function verifyInput($var){
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <link rel="shortcut icon" type="image/x-icon" href="img/accueil/favicon.ico">
        <title>Contact - AudioDream</title>
    </head>

    <body>
        <!-- Haut de page (header) -->
        <?php include("php/header.php"); ?>

        <section id="contact" class="container shop">
            <h1>Contactez-nous !</h1>

            <div class="divider"></div>

            <!-- Formulaire de contact -->
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <!-- <form name="myForm" onsubmit="return validateForm()" > -->
                    <form name="myForm" method="post" action="">
                        <div class="form-wrapper">
                            <!-- Identité -->
                            <div class="row mt-5 mb-3">
                                <div class="col">
                                  <input type="text" class="form-control" style="border-color:<?php echo $array["bordurePrenom"]; ?>;" placeholder="Prénom" aria-label="Prénom" name="fprenom" id="casePrenom" value="<?php echo $array["prenom"]; ?>">
                                  <span id="prenomErr" style="color:red;"><?php echo $array["prenomErreur"] ?></span>
                                </div>
                                <div class="col">
                                  <input type="text" class="form-control" style="border-color:<?php echo $array["bordureNom"]; ?>;" placeholder="Nom" aria-label="Nom" name="fnom" id="caseNom" value="<?php echo $array["nom"]; ?>">
                                  <span id="nomErr" style="color:red;"><?php echo $array["nomErreur"] ?></span>
                                </div>
                            </div>
                            <input type="email" id="email" class="form-control" style="border-color:<?php echo $array["bordureEmail"]; ?>;" placeholder="Votre email" name="femail" value="<?php echo $array["email"]; ?>"/>
                            <span id="emailErr" style="color:red;"><?php echo $array["emailErreur"] ?></span>
        
                            <!-- Sexe/Naissance -->
                            <div class="row mt-3">
                                <div class="col">
                                    <p>Sexe
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sexe" value="homme" id="homme" checked="yes" />
                                            <label class="form-check-label" for="homme">Homme</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sexe" value="femme" id="femme" />
                                            <label class="form-check-label" for="femme">Femme</label>
                                        </div>
                                    </p>
                                </div>
                                <div class="col">
                                    <label for="naissance" class="form-label">Naissance</label>
                                    <input type="date" id="naissance" name="fdateNais" class="form-control" />
                                </div>
                            </div>
                            
                            
        
                            <!-- Métier -->
                            <label for="metier">Métier </label>
                            <select name="metier" id="metier" class="form-select">
                                <option value="ingenieur">Ingénieur</option>
                                <option value="commercial">Commercial</option>
                                <option value="sante">Médecin/Infirmier</option>
                                <option value="fonctionnaire">Fonctionnaire de l'Etat</option>
                                <option value="sansemploi">Sans emploi</option>
                                <option value="autre">Autre</option>
                            </select><br/>
        
        
                            <div class="black-divider"></div>
        
                            <!-- Mail -->
                            <div class="mail">
                                <input type="text" class="form-control" style="border-color:<?php echo $array["bordureSujet"]; ?>;" id="objet" name="objet" placeholder="Sujet" aria-label="Sujet" value="<?php echo $array["sujet"]; ?>">
                                <span id="sujetErr" style="color:red;"><?php echo $array["sujetErreur"] ?></span>
                                <div class="mb-3"></div>
                                <textarea class="form-control" name="message" style="border-color:<?php echo $array["bordureMessage"]; ?>;" id="message" placeholder="Message"><?php echo $array["message"]; ?></textarea>
                                <span id="messageErr" style="color:red;"><?php echo $array["messageErreur"] ?></span>
                                <div class="mb-3"></div>
        
                                <!-- Confirmer -->
                                <input type="submit" value="Envoyer" class="full-btn my-5" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </section>

        <!-- Pied de page (footer) -->
        <?php include("php/footer.php"); ?>
    </body>

    <script type="text/javascript" src="js/script.js" ></script>
</html>