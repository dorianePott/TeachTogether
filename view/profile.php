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
    profile
    <nav style="float:left;border:1px black;">
    read resources
    <?= display_table(read_resource_by_module($module))?>
    </nav>
    <nav style="float:right;border:1px red;">
    own resources
    
    <a>add resource</a>
    <form method="post" action="?action=profile">
        <input type="text" name="name"/>
        <input type="text" name="desc"/>
        <input type="file" name="upload[]">
        <button type="submit" name="do" value="create">Create</button>
    </form>
    </nav>
</body>
</html>