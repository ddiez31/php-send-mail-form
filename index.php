<?php

require('src/RulesetInterface.php');
require('src/ClientInterface.php');
require('src/Client.php');
require('src/Ruleset.php');
require('src/Emojione.php');

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>PHP Send Mail Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!-- Emoji -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/emojione/2.2.7/assets/css/emojione.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojione/2.2.7/assets/sprites/emojione.sprites.css"/>
    <!-- Semantic-ui CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.10/semantic.min.css" rel="stylesheet" crossorigin="anonymous">
  

</head>

<body>

    <form class="ui form" method="post" enctype="multipart/form-data">
        <div class="ui raised very padded text container segment">
            <div class="ui form success">
                <div class="field">
                    <label>Send mail to:</label>
                    <input type="text" name="email" placeholder="joe@schmoe.com, example@gmail.com">
                </div>
            </div>
            <div class="ui form success">
                <div class="field">
                    <label>Subject:</label>
                    <input type="text" name="subject" placeholder="subject">
                    <label>Your message:</label>
                    <textarea rows="2" name="message" maxlength="500" placeholder="Your message, emoji accept"></textarea>
                    <label for="file">File:</label>
                    <input type="file" name="file">
                    <?php
                        Emojione\Emojione::$imageType = 'png';
                        Emojione\Emojione::$imagePathPNG = 'https://cdn.jsdelivr.net/emojione/assets/png/';
                        if (!isset($_COOKIE['sent'])) { 
                            if (isset($_POST['send'])) {
                              if (isset($_POST['email'])) {
                                $headers = 'MIME-Version: 1.0' . "\r\n";
                                $headers .= 'Content-type: multipart/mixed; charset=iso-8859-1' . "\r\n";
                                $dest = array($_POST['email']);
                                $subject = $_POST['subject'];
                                $message = substr($_POST['message'], 0, 500); 
                                $message = wordwrap($message, 500, "\r\n");
                                $message = Emojione\Emojione::toImage($message);
                                if (strlen($message) > 500) {
                                    echo 'Your message is too long';
                                };
                                $uploaddir = 'upload/';
                                $uploadfile = $uploaddir.basename($_FILES['file']['name']);
                                echo '<pre>';
                                if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                                    echo "File ".$_FILES['file']['name']." success upload.\n";
                                } else {
                                    echo "Attack possible by uploading file : ";
                                    echo "File name : '".$_FILES['file']['tmp_name']."'.";
                                };

                                $_POST['email'] = htmlspecialchars($_POST['email']);
                                foreach($dest as $mail) {
                                    if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                                     // if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])) {
                                        // echo 'Adress mail '.$_POST['email'].' is correct!';
                                    } else {
                                        echo 'Adress mail '.$mail.' invalid, please try again!';
                                    };                 
                                    if (mail($mail, $subject, $message, $headers)) {
                                        setcookie('sent', '1', time() + 1);
                                        unset($_POST);
                                        echo("<script>alert('Email successfully sent!')</script>");
                                    } else {
                                        echo("<script>alert('Email delivery failed…')</script>");
                                    };
                                };
                            };
                        };
                    };
                    ?>
                </div>
                <button class="ui button" name="send" type="submit">Send</button>
            </div>
        </div>
    </form>


</body>
    <!-- Emoji -->
    <script src="https://cdn.jsdelivr.net/emojione/2.2.7/lib/js/emojione.min.js"></script>
 

</html>

