<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Verifieer Uw Email Adres</h2>

        <div>
            Bedankt voor het aanmaken van een account.
            Volg alstublieft de link hieronder om uw email adres te verifiëren
            {{ URL::to('users/verify/' . $confirmation_code) }}.<br/>

        </div>

    </body>
</html>