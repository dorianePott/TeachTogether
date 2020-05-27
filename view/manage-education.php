<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>education</title>
</head>
<body>
    education
    <form method="post" action="?action=manage-education">
        <input id="name-education" type="text" name="education" id="education" value="<?= (isset($name)) ? $name : '' ?>"/>
        <button id="create-education" type="submit" name="do" value="create">create education</button>
    </form>
</body>
</html>