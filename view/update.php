<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>
<body>
    <form method="post" action="?action=update" enctype="multipart/form-data">
        <h1 class="card-title">update</h1>
        <input id="resource-name" type="text" name="name" placeholder="Name" value="<?=$name?>"/>
        <input id="resource-desc" type="text" name="desc" placeholder="Description" value="<?=$desc?>"/>
        <?= display_select(read_module_by_education($education), $code) ?>
        <?= display_table($media, 'Id_Attachment', false, false, true) ?>
        <h1 class="card-title">Add media</h1>
        <input type="file" name="upload[]" multiple/>
        <button class="btn btn-outline-info" type="submit" name="do" value="update">Validate</button>
    </form>
</body>
</html>