<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    managment
    <form action="?action=manage-module" method="post">
    <?php
    echo <<<FORM
    <input name="code" value="$code"/>
    <input name="name" value="$name"/>
    <input name="education" value="$education"/>
FORM;
    ?>
    <?= display_table(read_all_module(), true); ?>
    </form>
</body>
</html>