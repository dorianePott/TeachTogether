<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    login
    <table>
        <form method="post" class="form-horizontal" role="form" action="?action=login" enctype="multipart/form-data">
            <tr>
                <td><label name="email">Your email :</label></td>
                <td><input type="text" name="email" value="<?= ($email) ? $email : '' ?>"></td>
            </tr>
            <tr>
                <td><label name="password">Your password :</label></td>
                <td><input id="pwd" type="password" name="pwd"></td>
            </tr>
            <tr>
                <td><button id="btnLogin" type="submit" name="btnSubmit" value="login" class="btn btn-outline-primary">Validate</button></td>
                <td></td>
            </tr>
        </form>
        <?= (isset($msg) ? $msg : 'no error') ?>
    </table>
</body>
</html>