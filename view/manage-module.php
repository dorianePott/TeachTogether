<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Module</title>
</head>
<body>
    <form action="?action=manage-module" method="post">
    <?php
    if ($id != NULL) {
        echo <<<FORM
        <input name="code" value="$code"/>
        <input name="name" value="$name"/>
        <input name="link" value="$link"/>
FORM;
        echo display_select(read_all_education(), $education);
        echo '<button name="submit" value="update" type="submit">Update</button>';
    }
    if ($msg != '') {
        echo '<div class="alert">'.$msg.'</div>';
    }
    ?>
    </form>
    <form method="post" action="?action=manage-module">
        <?= display_table(read_all_module(), 'Id_Module', true); ?>
    </form>
</body>
</html>