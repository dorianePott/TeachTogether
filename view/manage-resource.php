<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    resource
    <form method="post" action="?action=manage-resource">
        <?= display_nav(read_all_resource(), 'Id_Resource', true, false, true); ?>
    </form>
</body>
</html>