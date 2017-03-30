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

    <form class="ui form">
        <div class="ui form">
            <div class="ui form success">
                <div class="field">
                    <label>E-mail</label>
                    <input type="email" placeholder="joe@schmoe.com">
                </div>
            </div>

            <div class="field">
                <label>Short Text</label>
                <textarea rows="2"></textarea>
            </div>
        </div>
        <button class="ui button" type="submit">Submit</button>
    </form>



</body>

</html>