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
    <nav class="card" style="float:left;border:1px solid black;">
        <?= display_nav($resources, 'Id_Resource')?>
    </nav>
    <nav class="card" style="float:right;border:1px solid red;">
    own resources
        <?= display_nav($own, 'Id_Resource', true, false, true)?>
        </div><div class="card-body">
        <h5 class="card-title">add resource</h5>
        <form method="post" action="?action=profile" enctype="multipart/form-data">
            <input id="resource-name" type="text" name="name" placeholder="Name" value="<?=$name?>"/>
            <input id="resource-desc" type="text" name="desc" placeholder="Description" value="<?=$desc?>"/>
            <?= display_select(read_module_by_education($education)) ?>
            <input type="file" name="upload[]" multiple/>
            <button class="btn btn-outline-info" type="submit" name="do" value="create">Create</button>
        </form>
        </div>
    </nav>
</body>
</html>