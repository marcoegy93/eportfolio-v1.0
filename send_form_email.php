<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "marco.balamon0506@gmail.com";
    $email_subject = "Message from http://marco.balamon.free.fr";
 
    function died($error) {
        // your error code can go here
        echo "Nous sommes d&eacute;sol&eacute;s, mais des erreurs ont &eacute;t&eacute; trouv&eacute;es dans le formulaire que vous avez soumis. ";
        echo "Ces erreurs apparaissent ci-dessous.<br/><br />";
        echo $error."<br /><br />";
        echo "Veuillez revenir en arri&egrave;re et corriger ces erreurs.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['phone']) ||
        !isset($_POST['subject']) ||
        !isset($_POST['message'])) {
        died('Nous sommes d&eacute;sol&eacute;s, mais il semble y avoir un probl&egrave;me avec le formulaire que vous avez soumis.');       
    }
 
     
 
    $name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $phone = $_POST['phone']; // required
    $subject = $_POST['subject']; // required
    $message = $_POST['message']; // required

    
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'Le mail que vous avez saisie ne semble pas &ecirc;tre valide.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'Le nom que vous avez entr&eacute; ne semble pas valide.<br />';
  }
 
   
  if(strlen($message) < 1) {
    $error_message .= 'Les commentaires que vous avez saisis ne semblent pas valides.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Détails du formulaire ci-dessous.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "First Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Phone: ".clean_string($phone)."\n";
    $email_message .= "Subject: ".clean_string($subject)."\n";
    $email_message .= "Message: ".clean_string(stripslashes($message))."\n";

 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail(utf8_decode($email_to), utf8_decode($email_subject), utf8_decode($email_message), utf8_decode($headers));  
?>
 
<!-- include your own success html here -->
 
<h3 class="text-center">Merci de m'avoir contact&eacute;. Je vous  recontacterai tr&egrave;s prochainement !</h3>
<br>
<h3 class="text-center"><a  href="index.html">Revenir &agrave; l&rsquo;accueil</a></h3>
 
<?php
 
}
?>