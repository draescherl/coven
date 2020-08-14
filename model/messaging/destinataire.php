<?php 
session_start();
echo("<div class = row>");
echo("<div class = 'center-align col s6 offset-s3'>");
echo("<div class = 'card '>");
echo("<div id = 'test'>");

if((!empty($_POST['message']) && (!empty($_POST['member'])))){
	$user = $_SESSION['username'];
	$member = $_POST['member'];
    $message = $_POST['message'];
    $date = date("H:i:s");
    $fic = $_SERVER['DOCUMENT_ROOT'] . "/database/messaging/" . $user . "-" . $member . ".txt";
    
    if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/database/messaging/" . $member . "-" . $user . ".txt")){
        $fic = $_SERVER['DOCUMENT_ROOT'] . "/database/messaging/" .  $member . "-" . $user . ".txt";
    }

    $monfichier = fopen($fic, "a+"); // ouverture du flux
	fseek($monfichier, 0); // se positionne au début
    echo("<br>");
    
    while (($ligne = fgets($monfichier)) !== FALSE) { // parcours le fichier ligne par ligne jusqu'a la fin
        $data = explode(";", $ligne);
        echo("<b>" . $data[0] . "</b>" . ": " . $data[1] . "<b> sent at </b> ". $data[2] ."<br>");
    }

	echo("<b>" . $user . "</b>" . ": " . $message . " <b> sent at  </b>" . $date ."\n"); // dernier message envoyé par l'utilisateur
	fputs($monfichier, $user . "; " . $message . "; " . $date ."\n"); // écriture dans le txt      
    fclose($monfichier); // fermeture  
} else {
    echo("Vous n'avez pas saisi de destinataire !");
}  

echo("</div>");
echo("</div>");
echo("</div>");
echo("</div>");
?>