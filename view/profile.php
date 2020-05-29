<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_SESSION['email'] ?></title>
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>
<body>
    <h1>Profile</h1>
    <nav style="float:left;border:1px black;background-color:red;">
        <?= display_nav($resources)?>
    </nav>
    <nav style="float:right;border:1px red;background-color:lightblue;">
    own resources
        <?= display_nav($own)?>
        <h2>add resource</h2>
        <form method="post" action="?action=profile">
            <input type="text" name="name"/>
            <input type="text" name="desc"/>
            <?= display_select(read_module_by_education($education))?>
            <input type="file" name="upload[]" accept="images/*"/>
            <button type="submit" name="do" value="create">Create</button>
        </form>
    </nav>
</body>
</html>