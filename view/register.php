<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>
<body>
    <div class="column" id="main">
        <?php include_once 'nav.php'; ?>
        <?php if ($msg != '') {
            echo '<div class="alert alert-danger" role="alert">'.$msg.'</div>';
        }?>
        <form method="post" class="container col-4 form-horizontal" role="form" action="?action=register" enctype="multipart/form-data">
	        <h4>Register</h4>
	        <div class="form-group" style="padding:14px;">
                <label for="nmfirst">Your name (first/last)</label>
                <input id="nmfirst" placeholder="Enter your first name" required type="text" name="first" class="form-control" value="<?=(isset($first) ? $first : '')?>">
                <br/>
                <input id="nmlast" placeholder="Enter your last name" required type="text" name="last" class="form-control" value="<?=(isset($last) ? $last : '')?>">
            </div>
            
	        <div class="form-group" style="padding:14px;">
                <label for="email">Email adress</label>
                <input id="email" placeholder="my@mail.com" required type="email" name="email" class="form-control" value="<?=(isset($email) ? $email : '')?>">
            </div>
            
	        <div class="form-group" style="padding:14px;">
                <label for="pwd">Password</label>
                <input id="pwd" placeholder="Enter password" required type="password" name="pwd" class="form-control" value="<?=(isset($pwd) ? $pwd : '')?>">
                <br/>
                <input id="repwd" placeholder="Repeat password" required type="password" name="repwd" class="form-control" value="<?=(isset($repwd) ? $repwd : '')?>">
	        </div>
            <div class="form-group">
                <label>Choose an education</label> 
                <div class="alert alert-warning" role="alert">⚠️Caution, once the account has been created, it will be impossible for you to change education.</div>

                <?= display_select(read_all_education()); ?>
            </div>

            <button id="btnRegister" name="do" class="btn btn-primary pull-right" type="submit" value="register">Register</button>  
    </div>
    
</body>
</html>