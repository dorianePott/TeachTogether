<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="text-center">
        <form method="post" class="form-horizontal" role="form" action="?action=login" enctype="multipart/form-data" class="form-signin">
            <img class="mb-4" src="assets/img/logo.svg" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Please signin</h1>
            <table class="mx-auto"><tr><td>
            <label name="email" for="inputEmail">Your email </label>
</td><td><input autofocus="" id="inputEmail" type="email" name="email" value="<?= ($email) ? $email : '' ?>" class="form-control" placeholder="my@mail.com">
</td><td></td></tr><tr><td>
            <label name="password">Your password </label>
</td><td><input id="pwd" type="password" name="pwd" class="form-control mb-3">
</td><td></td></tr></table>
            <button id="btnLogin" type="submit" name="btnSubmit" value="login" class="btn btn-outline-primary">Validate</button>
        </form>
            <?= ($msg != '' ? '<div class="alert alert-danger">'.$msg.'</div>' : '') ?>
    
</body>
</html>