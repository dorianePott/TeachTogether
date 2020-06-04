<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Module</title>
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

</head>
<body>
    <form action="?action=manage-module" method="post" class="container">
    <?php
    if ($id != NULL) {
        echo <<<FORM
        <div class="row">
        <div class="col">
        <label>code (5 char max)</label>
        <input class="form-control" name="code" value="$code"/></div>
        <div class="col"><label>module's name (45 char max.)</label><input class="form-control" name="name" value="$name"/></div>
        </div><div class="row">
        <div class="col"><label>ICT module's link (200 char max)</label><input class="form-control" name="link" value="$link"/>
        </div><div class="col"><label>Select an education</label>
FORM;
        echo display_select(read_all_education(), $education) . '</div></div>';
        echo '<br/><button name="submit" value="update" type="submit" class="btn btn-warning">Update</button> <br>';
    }
    if ($msg != '') {
        echo '<div class="alert bg-danger text-white">'.$msg.'</div>';
    }
    ?>
        <?= display_table(read_all_module(), 'Id_Module', true); ?>
    </form>
</body>
</html>