<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>manage education</title>
</head>
<body>
    <form method="post" action="?action=manage-education">
    <?php
        
        if ($id != NULL) {
            echo <<<FORM
            <input name="name" value="$name"/>
            <input name="link" value="$link"/>
FORM;
            echo '<button name="submit" value="update" type="submit">Update</button>';
        }
    ?>
        <?= display_table(read_all_education(), 'Id_Education', true); ?>
    <br/>
    <br/>
        <input id="name-education" type="text" name="education" id="education" value="<?= (isset($name)) ? $name : '' ?>"/>
        <button id="create-education" type="submit" name="do" value="create">create education</button>

    </form>
</body>
</html>