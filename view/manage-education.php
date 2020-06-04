<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>manage education</title>
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

</head>
<body>
    <form method="post" action="?action=manage-education" class="container">
    <?php
        
        if ($id != NULL) {
            echo <<<FORM
            <div class="row"><div class="col">
            <input name="name" value="$name" class="form-control"/></div><div class="col">
            <input name="link" value="$link" class="form-control"/></div><div class="col">
FORM;
            echo '<button name="submit" value="update" type="submit" class="btn btn-warning">Update</button></div></div><br/>';
        }
        if ($msg != '') {
            echo '<div class="alert bg-danger text-white">'.$msg.'</div>';
        }
    ?>
        <?= display_table(read_all_education(), 'Id_Education', true); ?>
    <br/>
    <br/>
    <div class="row"><div class="col">
        <input id="name-education" type="text" name="education" id="education" value="<?= (isset($name)) ? $name : '' ?>" class="form-control"/></div><div class="col">
        <button id="create-education" type="submit" name="do" value="create" class="btn btn-info">create education</button></div></div>

    </form>
</body>
</html>