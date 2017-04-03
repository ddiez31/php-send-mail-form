<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>PHP Send Mail Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!-- Semantic-ui CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.10/semantic.min.css" rel="stylesheet" crossorigin="anonymous">

</head>

<body>

    <form class="ui form" method="post">
        <div class="ui raised very padded text container segment">
            <div class="ui form success">
                <div class="field">
                    <label>Send mail to:</label>
                    <input type="email" name="email" placeholder="joe@schmoe.com">
                    <?php
                    if (isset($_POST['email'])) {
                        $_POST['email'] = htmlspecialchars($_POST['email']);
                        if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])) {
                            echo 'Adress mail '.$_POST['email'].' is correct!';
                        } else {
                            echo 'Adress mail '.$_POST['email'].' invalid, please try again!';
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="ui form success">
                <div class="field">
                    <label>Your message:</label>
                    <textarea rows="2" name="message" maxlength="500" placeholder="Your message"></textarea>
                    <?php
                    $message = substr($_POST['message'], 0, 500); 
                    $message = wordwrap($message, 500, "\r\n");
                    if (strlen($message) > 500) {
                        echo 'Your message is too long';
                    }
                    ?>
                </div>
                <button class="ui button" name="send" type="submit">Send</button>
            </div>
        </div>
    </form>


    <?php
    $subject = 'test mail';
    $dest = $_POST['email'];
    if (isset($_POST['send'])) {
        mail($dest, $subject, $message);
    }
    ?>

</body>

</html>